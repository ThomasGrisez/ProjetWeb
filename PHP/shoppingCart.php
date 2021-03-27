<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit.net | Shopping Cart</title>
	<link rel="icon" type="image/png" href="../Images/favicon.png" />
</head>
<body>
    <?php include 'header.php'?>

    <?php
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        $mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");

        $idbuyer = $_SESSION['id'];

        //recherche dans buyitnow les items pas encore payé avec pour statut shoppingcart
        $allInfos = array();
        $result1 = $mysqli->query("SELECT * FROM buyitnow WHERE status = 'shoppingcart' AND id_buyer='$idbuyer'");
        if($result1->num_rows != 0){
            while($row = $result1->fetch_assoc()) {
                $info=array($row["id_buyitnow"],$row["id_seller"],$row["id_buyer"],$row["price"],$row["status"],$row["id_item"],$row["quantity"]);
                $allInfos[]=$info;
            }
        }
        //La on un tableau de toutes les transactions en cours, cad ce que le client a dans son panier

        $nbItems = count($allInfos);

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
        //La je recupere le tableau avec les items et leurs infos
        //Donc la je connais les infos du panier + les infos de chaque item de ce panier

        //une fois qu on appuie sur le bouton de paiement
        if(isset($_POST['payment'])){
            header("Location: payment.php");
        }





    ?>

    <h2>Your Shopping Cart : <?= $nbItems ?> Product(s)</h2>
    <?php
        if($nbItems > 0){
            $totalprice = 0;
            for($j=0;$j<$nbItems;$j++){
    
                $idItem = $allItems[$j][0];
                $result3 = $mysqli->query("SELECT quantity FROM `buyitnow` WHERE `id_item`='$idItem'");
                while($row = $result3->fetch_assoc()){
                    $quantitywanted = $row["quantity"];
                }
                $pricetopay = $quantitywanted*$allItems[$j][3];
                $image = "../itemImages/".$allItems[$j][2];
                echo "<b>Item : </b>".$allItems[$j][1]."<input type='submit' value='Delete'><br>";
                echo "<b>Quantity : </b>".$quantitywanted."<br>";
                echo "<b>Price : </b>".$pricetopay."$<br>";
                echo "<img src='$image' width=50>"."<br>";
                echo "<hr>";
                $totalprice+=$pricetopay;
            }
            echo "<b>Total Price  : </b>".$totalprice."$";
            $_SESSION['price'] = $totalprice;
            ?>
            
            <form action="" method="POST"><input type="submit" value="Pay" name="payment"></form>
            <?php
        }else{
            echo "There is nothing in your shopping cart";
        }
        
    ?>

    <?php include 'footer.php'?>
</body>
</html>