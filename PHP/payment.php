<?php include 'categories_header.php'?>
<?php
if(session_status() == PHP_SESSION_NONE){session_start();}
    
$mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");

    if(isset($_POST['finalpayment'])){
        if(!empty($_POST['paymentcard']) && !empty($_POST['cardnumber']) && !empty($_POST['cardname']) && !empty($_POST['carddate']) && !empty($_POST['cardcode'])){
            if(strlen($_POST['cardnumber']) == 16 && is_numeric($_POST['cardnumber'])){
                if(strlen($_POST['cardcode']) == 3 && is_numeric($_POST['cardcode'])){  
                    $id_buyer = $_SESSION['id']; 
                    $mysqli->query("UPDATE `buyitnow` SET `status`='inpayment' WHERE `id_buyer`='$id_buyer' AND `status`='shoppingcart'");
                    $_SESSION['price'] = 0;
                    //recherche dans buyitnow les id items et quantity 
                    $allInfos = array();
                    $result1 = $mysqli->query("SELECT id_item,quantity,id_buyitnow FROM buyitnow WHERE `status` = 'inpayment' AND id_buyer='$id_buyer'");
                    if($result1->num_rows != 0){
                        while($row = $result1->fetch_assoc()) {
                            $info=array($row["id_item"],$row["quantity"],$row["id_buyitnow"]);
                            echo "test";
                            $allInfos[]=$info;
                        }
                    }
                    //La on un tableau de tous les items et quantity que le buyer veut acheter
                
                    $nbItems = count($allInfos);
                
                    $allItems = array();
                    for($i=0;$i<$nbItems;$i++){
                        $currentId = $allInfos[$i][0];
                        $result2 = $mysqli->query("SELECT id,quantity FROM `items` WHERE `id`='$currentId'");
                        if($result2->num_rows != 0){
                            while($row = $result2->fetch_assoc()) {
                                $item=array($row["id"],$row["quantity"]);
                                echo "test2";
                            }
                        }
                        $allItems[]=$item;
                    }
                    //La je recupere le tableau avec les items et leurs infos
                    //Mise à jour dans la bdd des quantités 
                    for($j=0;$j<$nbItems;$j++){
                        $qttobuy= $allInfos[$j][1];
                        $qtindb = $allItems[$j][1];
                        $newqt = $qtindb - $qttobuy;
                        $currentId = $allInfos[$j][0];
                        $idbiw = $allInfos[$j][2];
                        $mysqli->query("UPDATE `items` SET `quantity`='$newqt' WHERE `id`='$currentId'");
                        $mysqli->query("UPDATE `buyitnow` SET `status`='payed' WHERE `id_item`='$currentId' AND `id_buyitnow`='$idbiw'");
                        echo "test3";
                    }

                    header("Location: buyerProfile.php");


                }else{
                    $msg = "The security code is a 3 digit number";
                }
            }else{
                $msg = "Card number incorrect";
            }
        }else{
            $msg = "You must enter all the informations";
        }
    }
?>



<?php   
echo "Total Price : ".$_SESSION['price']."$<br>"; 
echo "Total Price : ".$_SESSION['id']."$<br>"; 
echo "Your address : ".$_SESSION['address']."<br>"; 
echo "You are : ".$_SESSION['lname']."&nbsp;".$_SESSION['fname']; 
?>

<form action="" method="POST">
    <div class="paymentcard">
        <p><b>Type of Payment Card</b></p>
        <label for="paymentcard1">Visa</label>
        <input type="radio" name="paymentcard" id="paymentcard1" value="visa" checked>
        <label for="paymentcard2">MasterCard</label>
        <input type="radio" name="paymentcard" id="paymentcard2" value="mastercard">
        <label for="paymentcard3">American Express</label>
        <input type="radio" name="paymentcard" id="paymentcard3" value="americanexpress">
        <label for="paymentcard4">PayPal</label>
        <input type="radio" name="paymentcard" id="paymentcard4" value="paypal">
    </div>
    <div class="cardinfo">
        <label for="cardnumber"><b>Card number</b></label>
        <input type="text" name="cardnumber" id="cardnumber" placeholder="0000 0000 0000 0000"><br>
        <label for="cardname"><b>Name on the card</b></label>
        <input type="text" name="cardname" id="cardname" placeholder="Name"><br>
        <label for="carddate"><b>Expiration Date</b></label>
        <input type="month" name="carddate" id="carddate"><br>
        <label for="cardcode"><b>Security Code</b></label>
        <input type="text" name="cardcode" id="cardcode">
    </div>
    <input type="submit" value="Confirm and pay" name="finalpayment">
</form>

<?php if(isset($msg)) echo $msg;?>



<?php include 'footer.php'?>