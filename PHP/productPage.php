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

<?php
    if(session_status() == PHP_SESSION_NONE){session_start();}
    
    $mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");

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

    if(isset($_POST['addtocart'])){
        if(isset($_SESSION['status']) && $_SESSION['status']=="buyer" && isset($_POST['quantitychosen'])){ 
            $idbuyer = $_SESSION['id'];
            $quantitychosen = $_POST['quantitychosen'];
            $mysqli->query("INSERT INTO `buyitnow`(`id_buyitnow`, `id_seller`, `id_buyer`, `price`, `status`,`id_item`,`quantity`) VALUES(NULL,'$idseller','$idbuyer','$price','shoppingcart','$id','$quantitychosen')");
            $msg = "Added to your shopping cart";
            $quantity-=$quantitychosen;
            
        }else{
            $msg = "You need to be logged in to buy something";
        }
    }

?>
<?php include 'categories_header.php'?>

<table class="table_of_item" border="1">
    <tr>
        <td rowspan="5" id="picture_item"><img src="../itemImages/<?= $photo1?>" width=600 height=600></td>
        <td class="raw_table_items_list"  id="title_of_an_item" id='prix_item'><b><?= $name ?></b></td>
        
    </tr>
    <tr><td class="raw_table_items_list"  id="prix_of_an_item"><b>Price : </b><span style="color : #D86B27;font-weight : bold; ">$<?= $price ?></span></td></tr>
    <tr><td class="raw_table_items_list" id="type_item_an_item">Type : <em><?= $type ?></em></td></tr>
    <tr><td class="raw_table_items_list" id="quantity_of_an_item">Quantity : <?= $quantity ?></td></tr>
    <tr><td class="raw_table_items_list" id="paybutton">
    <?php
        if($type == "buyitnow" && $quantity != 0){?>
            <form method="post">
                <input type="number" name="quantitychosen" min="0" max="<?= $quantity?>" placeholder="0" value="1">
                <input type='submit' name='addtocart' value='Add to your cart'>
            </form>
        <?php
            if(isset($msg))
                echo $msg;
        }
        if($type == "bestoffer"){?>
            <form method="post">
            <input type="number" name="negotiation">
            <input type='submit' name='addtocart' value='Add to your cart'>
            </form>
        <?php
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




<?php include 'footer.php'?>
    
</body>
</html>