<?php include 'header.php'?>
<?php
    
$mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");

    if(isset($_POST['finalpayment'])){
        if(!empty($_POST['paymentcard']) && !empty($_POST['cardnumber']) && !empty($_POST['cardname']) && !empty($_POST['carddate']) && !empty($_POST['cardcode'])){
            if(strlen($_POST['cardnumber']) == 16 && is_numeric($_POST['cardnumber'])){
                if(strlen($_POST['cardcode']) == 3 && is_numeric($_POST['cardcode'])){  
                    $id_buyer = $_SESSION['id']; 
                    $mysqli->query("UPDATE `buyitnow` SET `status`='inpayment' WHERE `id_buyer`='$id_buyer' AND `status`='shoppingcart'");
                    //recherche dans buyitnow les id items et quantity 
                    $allInfos = array();
                    $result1 = $mysqli->query("SELECT id_item,quantity,id_buyitnow FROM buyitnow WHERE `status` = 'inpayment' AND id_buyer='$id_buyer'");
                    if($result1->num_rows != 0){
                        while($row = $result1->fetch_assoc()) {
                            $info=array($row["id_item"],$row["quantity"],$row["id_buyitnow"]);
                            $allInfos[]=$info;
                        }
                    }
                    //La on un tableau de tous les items et quantity que le buyer veut acheter
                
                    $nbItems = count($allInfos);
                
                    $allItems = array();
                    for($i=0;$i<$nbItems;$i++){
                        $currentId = $allInfos[$i][0];
                        $result2 = $mysqli->query("SELECT id,quantity,name,price FROM `items` WHERE `id`='$currentId'");
                        if($result2->num_rows != 0){
                            while($row = $result2->fetch_assoc()) {
                                $item=array($row["id"],$row["quantity"],$row["name"],$row['price']);
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
                        $idbin = $allInfos[$j][2];
                        //$mysqli->query("UPDATE `items` SET `quantity`='$newqt' WHERE `id`='$currentId'");
                        $mysqli->query("UPDATE `buyitnow` SET `status`='payed' WHERE `id_item`='$currentId' AND `id_buyitnow`='$idbin'");
                    }

                    // Mail
                    $to = $_SESSION['email'];
                    $subject = 'Confirmation of payment - FitNet';
                    $from = 'fitnet@email.com';
                    
                    // To send HTML mail, the Content-type header must be set
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    
                    // Create email headers
                    $headers .= 'From: '.$from."\r\n".
                        'Reply-To: '.$from."\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                    
                    // Compose a simple HTML email message
                    $message = '<html><body>';
                    $message .= '<h1 style="color:#f40;">Thank you ! '.$_SESSION['fname'].' '.$_SESSION['lname'].'</h1>';
                    $message .= '<h3>Here is a resume of your order :</h3>';
                    for($i=0;$i<$nbItems;$i++){
                        $nameitem = $allItems[$i][2];
                        $message .="-<b>".$nameitem.", quantity purchased : ".$allInfos[$i][1].", price : ".($allItems[$i][3]*$allInfos[$i][1])."$</b><br>";
                    }
                    $message .= "<b>Total price : ".$_SESSION['price']."$</b><br>";
                    $message .= "<b>You will be delivered at your address : ".$_SESSION['address']."</b><br>";
                    $message .= '</body></html>';
                    
                    // Sending email
                    mail($to, $subject, $message, $headers);
                    
                    $_SESSION['price'] = 0;
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