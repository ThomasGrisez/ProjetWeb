<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit.net | Shopping Cart</title>
	<link rel="icon" type="image/png" href="../Images/favicon.png" />
    <?php include '../CSS/cartCSS.php' ?>
</head>
<body>
    <?php include 'header.php'?>

    <?php

        $mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");

        $idbuyer = $_SESSION['id'];

        //Every items in the shopping cart of the buyer
        $allInfos = array();
        $result1 = $mysqli->query("SELECT * FROM buyitnow WHERE status = 'shoppingcart' AND id_buyer='$idbuyer'");
        if($result1->num_rows != 0){
            while($row = $result1->fetch_assoc()) {
                $info=array($row["id_buyitnow"],$row["id_seller"],$row["id_buyer"],$row["price"],$row["status"],$row["id_item"],$row["quantity"]);
                $allInfos[]=$info;
            }
        }

        $nbItems = count($allInfos);

        //Infos on the items
        $allItems = array();
        for($i=0;$i<$nbItems;$i++){
            $currentId = $allInfos[$i][5];
            $result2 = $mysqli->query("SELECT * FROM `items` WHERE `id`='$currentId'");
            if($result2->num_rows != 0){
                while($row = $result2->fetch_assoc()) {
                    $item=array($row["id"],$row["name"],$row["photo1"],$row["price"],$row["description"],$row["quantity"],$row["type_of_selling"]);
                    
                }
            }
            $allItems[]=$item;
        }

        //When we press the pay Button
        if(isset($_POST['payment'])){
            header("Location: payment.php");
        }

        // Delete something in your shopping cart
        for($j=0;$j<$nbItems;$j++){
            $idItem = $allItems[$j][0];
            $qtinCart = $allInfos[$j][6];
            $qtinDB = $allItems[$j][5];
            $newQT = $qtinCart+$qtinDB;
            if(isset($_POST[$idItem])){
                $mysqli->query("DELETE FROM `buyitnow` WHERE `id_item`='$idItem' AND `status`='shoppingcart'");
                //Update quantity of the item 
                $queryupdate = $mysqli->query("UPDATE items SET quantity='$newQT' WHERE id='$idItem'");
                header("Location: shoppingCart.php");
            }

        }
    ?>
    <div>
        <div align="center">
            <h2 style="font-size : 35px;">Your Shopping Cart :<span style="color : #D86B27; weight : bold;"> <?= $nbItems ?> Product(s)</span></h2>
        </div>
        <div style='border-bottom : 1px rgba(0, 0, 0, 0.1) solid; '></div>
        <div class='main_div_for_cart'>
        <?php
            if($nbItems > 0){
                $totalprice = 0;
                echo "<div class='div_of_div_of_div'><form method='POST'>";
                for($j=0;$j<$nbItems;$j++){
                    $idItem = $allItems[$j][0];
                    $result3 = $mysqli->query("SELECT quantity FROM `buyitnow` WHERE `id_item`='$idItem' AND `status`='shoppingcart'");
                    while($row = $result3->fetch_assoc()){
                        $quantitywanted = $row["quantity"];
                    }
                    $pricetopay = $quantitywanted*$allItems[$j][3];
                    $image = "../itemImages/".$allItems[$j][2];
                    echo "<div class='one_item_in_the_cart'><div><input class='button_suppr_from_cart' type='submit' name='$idItem' value='-'></div>";
                    echo "<div><img src='$image' width=150 height=150></div>";
                    echo "<div class='caracteristic_item_list'><b>".$allItems[$j][1]."</b><br>";
                    echo "<span style='font-size :16px;'><b><em>Quantity </em>: </b>".$quantitywanted."</span><br>";
                    echo "<span style='font-size :15px;'><b>Price : </b><span style='color :#D86B27; font-weight : bold; '>".$pricetopay."$</span><br></span></div></div>";
                    $totalprice+=$pricetopay;
                }
                echo "</div>";
                echo "<div align='center' class='validate_my_cart_button_bloc'><span style='font-size : 25px;'><b>Total Price  : </b><span style='color : #D86B27; font-weight : bold;'>".$totalprice."$</span></span>";
                $_SESSION['price'] = $totalprice;
                echo "</form>";
                ?>
                <form style="padding-top : 20px; " method="POST"><input class="button_for_go_to_the_checkout" type="submit" value="Pay" name="payment"></form>
                <img src="../Images/paiement_securises_paypal.png" width="300" height="auto">
                </div>
            </div>
                <?php
            }else{
                echo "</div><div align='center' style='font-size : 20px;'><b>There is nothing in your Cart !</b><br><br><br><a href='index.php'><button class='button_go_back_to_my_profile'>← Go back to the store</button></a></div>";
            }
        ?>
    </div>
    <?php include 'footer.php'?>
</body>
</html>