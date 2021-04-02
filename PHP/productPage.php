<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../Images/favicon.png" />
    <?php include '../CSS/equipmentsCSS.php' ?>
</head>
<body>

<?php include 'header.php'?>

<?php
    
    $mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");
    unset($msg);

    if(isset($_GET['idproduct'])){
        $id=htmlspecialchars($_GET['idproduct']);
        $result = $mysqli->query("SELECT * FROM items WHERE id='$id'");
        if($result->num_rows == 1){
            while($row = $result->fetch_assoc()) {
                $name = $row["name"];
                $photo1 = $row["photo1"];
                $photo2 = $row["photo2"];
                $photo3 = $row["photo3"];
                $price = $row["price"];
                $description = $row["description"];
                $quantity = $row["quantity"];
                $type = $row["type_of_selling"];
                $idseller = $row["id_seller"];
            }
        }
    }


    //Add to shopping if it's buyitnow
    if(isset($_POST['addtocart'])){
        if(isset($_SESSION['status']) && $_SESSION['status']=="buyer" && isset($_POST['quantitychosen'])){ 
            $idbuyer = $_SESSION['id'];
            $quantitychosen = $_POST['quantitychosen'];

            //Check if this item is already in the shopping cart
            $querycheck = $mysqli->query("SELECT id_item,quantity FROM buyitnow WHERE id_buyer='$idbuyer' AND status='shoppingcart' AND id_item='$id'");
            if($querycheck->num_rows == 1){
                while($row = $querycheck->fetch_assoc()) {
                    $iditem=$row['id_item'];
                    $quantityInCart = $row['quantity'];
                }
                $newqt = $quantityInCart+$quantitychosen;
                $mysqli->query("UPDATE buyitnow SET quantity='$newqt' WHERE id_item='$id' AND `status`='shoppingcart'");
            }else{
                $mysqli->query("INSERT INTO `buyitnow`(`id_buyitnow`, `id_seller`, `id_buyer`, `price`, `status`,`id_item`,`quantity`) VALUES(NULL,'$idseller','$idbuyer','$price','shoppingcart','$id','$quantitychosen')");
            }

            $msg = "<span style='color :  #219D57; font-weight : bold; font-style : italic;'>Added to your shopping cart</span>";
            $quantity -= $quantitychosen;
            $mysqli->query("UPDATE items SET quantity='$quantity' WHERE id='$id'");
            
        }else{
            if(isset($_SESSION['status']) && $_SESSION['status']=="seller")
                $msg = "<span style='color : #A20606;'>You need to be <em><a href='../PHP/sellerProfile.php' style='text-decoration : none; color : #A20606; font-weight : bold;'>logged in as a buyer</a></em> to buy something</span>";
            else
                $msg = "<span style='color : #A20606;'>You need to be <em><a href='../PHP/login.php' style='text-decoration : none; color : #A20606; font-weight : bold;'>logged in as a buyer</a></em> to buy something</span>";

        }
    }

    //Bid if auction
    if(isset($_POST['auctionoffer'])){
        if(isset($_SESSION['status']) && $_SESSION['status']=="buyer" && isset($_POST['priceoffer'])){
            $newprice = $_POST['priceoffer'];
            if($newprice > $price){
                $idbuyer = $_SESSION['id'];
                $mysqli->query("UPDATE auction SET price='$newprice', id_buyer='$idbuyer',secondbestprice='$price' WHERE id_item='$id'");
                $mysqli->query("UPDATE items SET price='$newprice'WHERE id='$id'");
                echo "<meta http-equiv='refresh' content='0'>";
            }else{
                $msg = "Your bid is too low !";
            }
        }else{
            if(isset($_SESSION['status']) && $_SESSION['status']=="seller")
                $msg = "<span style='color : #A20606;'>You need to be <em><a href='../PHP/sellerProfile.php' style='text-decoration : none; color : #A20606; font-weight : bold;'>logged in as a buyer</a></em> to bid</span>";
            else
                $msg = "<span style='color : #A20606;'>You need to be <em><a href='../PHP/login.php' style='text-decoration : none; color : #A20606; font-weight : bold;'>logged in as a buyer</a></em> to bid</span>";

        }
    }

    //Negotiation if bestoffer
    if(isset($_POST['bestoffernegotiation'])){
        if(isset($_SESSION['status']) && $_SESSION['status']=="buyer" && isset($_POST['negotiation'])){
            
            if(!empty($_POST['negotiation'])){
                $idbuyer = $_SESSION['id'];
                $negotiation = $_POST['negotiation'];
                $checknego = $mysqli->query("SELECT id_buyer,num_of_negotiations  FROM bestoffer WHERE id_item='$id'");
                if($checknego->num_rows >0){
                    while($row = $checknego->fetch_assoc()) {
                        $buyer = $row["id_buyer"];
                        $nb = $row["num_of_negotiations"];
                    }
                    if($buyer == $idbuyer)
                        $numbofnego = $nb+1;
                    else $numbofnego = 1;
                    $mysqli->query("UPDATE bestoffer SET price='$negotiation', id_buyer='$idbuyer',num_of_negotiations='$numbofnego',status='negotiationoffer'  WHERE id_item='$id'");
                    $mysqli->query("UPDATE items SET price='$negotiation' WHERE id='$id'");

                    $msg = "You will be notified on your profile when the seller accept or refuse your offer";
                }
            }else{
                $msg = "Please enter a price !";
            }
        }else{
            if(isset($_SESSION['status']) && $_SESSION['status']=="seller")
                $msg = "<span style='color : #A20606;'>You need to be <em><a href='../PHP/sellerProfile.php' style='text-decoration : none; color : #A20606; font-weight : bold;'>logged in as a buyer</a></em> to negotiate</span>";
            else
                $msg = "<span style='color : #A20606;'>You need to be <em><a href='../PHP/login.php' style='text-decoration : none; color : #A20606; font-weight : bold;'>logged in as a buyer</a></em> to negotiate</span>";

        }
    }

?>

<div class="table_of_item_bloc">
    <table class="table_of_item" border="1">
     <tr>
         <td rowspan=<?php if($type != "buyitnow")echo 6; else echo 5;?> id="picture_item"><img src="../itemImages/<?= $photo1?>" width=400 height=400></td>
         <td class="raw_table_items_list"  id="title_of_an_item" id='prix_item'><b><?= $name ?></b></td>
         
     </tr>
     <tr><td class="raw_table_items_list"  id="prix_of_an_item"><b>Price : </b><span style="color : #D86B27;font-weight : bold; ">$<?= $price ?></span></td></tr>
     <tr><td class="raw_table_items_list" id="type_item_an_item">Type : <em><?= $type ?></em></td></tr>
     <tr><td class="raw_table_items_list" id="quantity_of_an_item">Quantity : <?= $quantity ?></td></tr>

    <?php
        if($type == "auction"){
            $querydate = $mysqli->query("SELECT date FROM auction WHERE id_item='$id'");
            if($querydate->num_rows == 1){
                while($row = $querydate->fetch_assoc()) {
                    $date = $row["date"];
                }
            }
            echo "<tr><td class='raw_table_items_list' id='date_of_an_item'>End of the auction :".$date."</td></tr> ";  
        }
        if($type == "bestoffer"){
            $querynego = $mysqli->query("SELECT num_of_negotiations FROM bestoffer WHERE id_item='$id'");
            if($querynego->num_rows == 1){
                while($row = $querynego->fetch_assoc()) {
                    $nego = $row["num_of_negotiations"];
                }
            }
            $nego = 5-$nego;
            echo "<tr><td class='raw_table_items_list' id='nego_of_an_item'>You have 5 tries to negotiate, remaining tries :".$nego."</td></tr> ";  
        }
    ?>


     <tr><td class="raw_table_items_list" id="paybutton">
     <?php
         if($type == "buyitnow" && $quantity != 0){?>
             <form class="form_for_add_to_cart" method="post">
                 <input type="number" class="quantity_chosen" name="quantitychosen" min="0" max="<?= $quantity?>" placeholder="0" value="1">
                 <input type='submit' class="add_to_cart" name='addtocart' value='Add to your cart'>
             </form>
         <?php
             if(isset($msg))
                 echo $msg;
         }
         if($type == "bestoffer" && $quantity != 0){?>
             <form method="post">
             <input type="number" class="priceoffer" name="negotiation" min="1" value="<?= $price ?>">
             <input type='submit'class="add_to_cart" name='bestoffernegotiation' value='Negotiate'>
             </form>
         <?php
            if(isset($msg))
            echo $msg;
         }
        if($type == "auction" && $quantity != 0){?>
             <form method="post">
             <label for="negotiation">Price Offer :</label>
             <input type="number" class="priceoffer" name="priceoffer" min="<?= $price+1 ?>" value="<?= $price+1 ?>">
             <input type='submit' class="add_to_cart" name='auctionoffer' value='Bid'>
             </form>
         <?php
            if(isset($msg))
            echo $msg;
         }
        ?> 
     </td></tr>

     <tr><td colspan="2" class="raw_table_items_list" id="description_of_an_item"><?= $description ?></td></tr>
     <tr>
         <?php
             if($photo2 != "" && $photo3 ==""){?>
                 <td><img src="../itemImages/<?= $photo1?>" width=50><img src="../itemImages/<?= $photo2?>" width=50></td>
             <?php
             }
             if($photo2 != "" && $photo3 != ""){?>
                 <td><img src="../itemImages/<?= $photo1?>" width=50><img src="../itemImages/<?= $photo2?>" width=50><img src="../itemImages/<?= $photo3?>" width=50></td>
             <?php
             }  
         ?>
     </tr>
    </table>
</div>



<?php include 'footer.php'?>
    
</body>
</html>