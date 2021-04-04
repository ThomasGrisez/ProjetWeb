<?php include 'header.php'?>
<link rel="stylesheet" type="text/css" href="../CSS/payement.css">
<?php
    
$mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");

    if(isset($_POST['finalpayment'])){
        //if payment != paypal and every infos are filled or if payment == paypal and phone is filled
        if( (!empty($_POST['paymentcard']) && $_POST['paymentcard'] != "paypal" && !empty($_POST['cardnumber']) && !empty($_POST['cardname']) && !empty($_POST['carddate']) && !empty($_POST['cardcode'])) || ($_POST['paymentcard'] == "paypal" && !empty($_POST['phonenumber']))){
            if( (strlen($_POST['cardnumber']) == 16 && is_numeric($_POST['cardnumber']) ) || ($_POST['paymentcard'] == "paypal" && !empty($_POST['phonenumber'])) ){
                if((strlen($_POST['cardcode']) == 3 && is_numeric($_POST['cardcode']))    || ($_POST['paymentcard'] == "paypal" && !empty($_POST['phonenumber']))){  
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



<div class="paiement_bloc">
    <div>

        <form action="" method="POST">
            <div class="paymentcard">
                <p><b>Payment</b><br><span style="font-size : 13px; ">All transactions are secure and encrypted.</span></p>
                <div class="selector_of_way_to_pay">
                    <div class="pay_with_a_card_bloc">
                        <div class="title_bloc">
                            <div>
                                <input type="radio" class="radio_button_choice" name="paymentcard" id="paymentcard1" value="visa" checked onclick="afficher()">
                                <label for="paymentcard1">Credit card</label>
                            </div>
                            <div style="padding-right: 10px;">
                                <img src="../Images/choice_card.png" height="auto" width="200">
                            </div>
                        </div>
                            <div class="cardinfo" id="cardinfo_for_pay">
                                <div class="bloc_for_card1">
                                    <label for="cardnumber"></label>
                                    <input class="text_field_for_card1" type="text" name="cardnumber" id="cardnumber" placeholder="Card number"><br>
                                </div>
                                <div class="bloc_for_card1">
                                    <label for="cardname"></label>
                                    <input class="text_field_for_card1" type="text" name="cardname" id="cardname" placeholder="Name on the card"><br>
                                </div>
                                <div class="second_part_information_paiement">
                                    <div class="bloc_for_card2">
                                        <label for="carddate"></label>
                                        <input class="text_field_for_card2" type="month" name="carddate" id="carddate"><br>
                                    </div>
                                    <div>
                                        <label for="cardcode"></label>
                                        <input class="text_field_for_card2" type="text" name="cardcode" id="cardcode" placeholder="Security Code">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="pay_with_paypal_bloc">
                        <div class="title_bloc">
                            <div>
                                <input type="radio" class="radio_button_choice" name="paymentcard" id="paymentcard4" value="paypal" onclick="cacher()">
                                <label for="paymentcard4">PayPal</label>
                            </div>
                            <div style="padding-right: 10px;">
                                   <img src="../Images/choice_paypal.png" height="auto" width="50">
                            </div>
                        </div>
                        <div class="paypalinfo" id="paypal_for_pay" hidden="hidden">
                                <div class="bloc_for_card3">
                                    <label for="cardnumber"></label>
                                    <input class="text_field_for_card1" type="phone" name="phonenumber" id="phonenumber" placeholder="Phone number"><br>
                                </div>        
                        </div>
                    </div>
                </div>
            </div>
            <div class="bloc_button_pay">
                <input type="submit" value="Confirm and pay" name="finalpayment" class="button_pay">
            </div>
        </form>
        <div style="padding-top : 15px; ">
            <?php if(isset($msg)) echo "<span style='color : red; font-weight : bold; font-style : italic;'>".$msg."</span>"; ?>
        </div>
    </div>
    <script>
        $(function() {
            $('.range').next().text('--'); // Valeur par défaut
            $('.range').on('input', function() {
            var $set = $(this).val();
            $(this).next().text($set);
            });
        });     
        function afficher(){
            document.getElementById("cardinfo_for_pay").hidden = false;
            document.getElementById("paypal_for_pay").hidden =true;
        }
        function cacher()
        {
            document.getElementById("paypal_for_pay").hidden =false;
            document.getElementById("cardinfo_for_pay").hidden = true;
        }
       
    </script>
    <div class='summup_info_bloc'>
        <?php   
        echo "<table>";
        echo "<tr><td style='padding-bottom: 10px; padding-top: 10px; border-bottom : solid 1px  rgba(0,0,0,0.3);'><span style='color : rgba(0,0,0,0.6) ;'>Contact :</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='text-transform : uppercase;'>".$_SESSION['lname']."</span>&nbsp;".$_SESSION['fname']."</td><td style='padding-left : 10px; '><a style='text-decoration : none; color : #D86B27;' href='../PHP/editBuyer.php'  target='_blank'>Modify</a></td></tr>";
        echo "<tr><td style='padding-bottom: 10px; padding-top: 10px; border-bottom : solid 1px  rgba(0,0,0,0.3);'><span style='color : rgba(0,0,0,0.6);'>Address :</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$_SESSION['address']."</td><td style='padding-left : 10px; '><a style='text-decoration : none; color : #D86B27;' href='../PHP/editBuyer.php'  target='_blank'>Modify</a></td></tr>"; 
        echo "<tr><td style='padding-bottom: 10px; padding-top: 10px;'><span style='color : rgba(0,0,0,0.6) ;'>Total Price : </span>".$_SESSION['price']."$</td><td style='padding-left : 10px; '><a style='text-decoration : none; color : #D86B27;' href='../PHP/shoppingCart.php' target='_blank'>Change</a></td></tr>";  
        echo "</table>" 
        ?>
    </div>
</div>
<?php include 'footer.php'?>