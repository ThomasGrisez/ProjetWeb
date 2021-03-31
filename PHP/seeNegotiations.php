<?php include 'header.php'?>

<?php
$mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");
$idseller = $_SESSION['id'];


// All best offer negotiations
$queryoffers = $mysqli->query("SELECT * FROM bestoffer WHERE id_seller='$idseller' AND status='negotiationoffer'");
$alloffers = array();
if($queryoffers->num_rows > 0){
    while($row = $queryoffers->fetch_assoc()) {
        $offer= array($row['id_bestoffer'],$row['id_buyer'],$row['id_seller'],$row['id_item'],$row['price'],$row['status'],$row['num_of_negotiations']);
        $alloffers[] = $offer;
    }
}

// All infos on the items on bestoffer
$nbOffers = count($alloffers);
$allItems = array();
for($i=0;$i<$nbOffers;$i++){
    $idItem = $alloffers[$i][3];
    $queryItem = $mysqli->query("SELECT id,name,photo1,price FROM `items` WHERE `id`='$idItem' ");
    if ($queryItem->num_rows > 0) {
        while($row = $queryItem->fetch_assoc()) {
            $item= array($row["id"],$row["name"],$row["photo1"],$row["price"]);
            $allItems[] = $item;
        }
    }
}

//If the seller accept the offer
for($i=0;$i<$nbOffers;$i++){
    $id = $allItems[$i][0];
    $accept = $id."accept";
    if(isset($_POST[$accept])){
        $mysqli->query("UPDATE bestoffer SET status='accepted'  WHERE id_item='$id'");
        //Add it to the shopping cart of the buyer

        $queryBestOffer = $mysqli->query("SELECT id_buyer,price FROM bestoffer WHERE id_item='$id'");
        if ($queryBestOffer->num_rows > 0) {
            while($row = $queryBestOffer->fetch_assoc()) {
                $finalprice = $row['price'];
                $id_buyer = $row['id_buyer'];
            }
        }
        $mysqli->query("INSERT INTO `buyitnow`(`id_buyitnow`, `id_seller`, `id_buyer`, `price`, `status`,`id_item`,`quantity`) VALUES(NULL,'$idseller','$id_buyer','$finalprice','shoppingcart','$id','1')");

        header("Location: seeNegotiations.php");
    }
}

//If the seller decline the offer
for($i=0;$i<$nbOffers;$i++){
    $id = $allItems[$i][0];
    $counter = $id."counter";
    if(isset($_POST[$counter]) && isset($_POST['counter']) && !empty($_POST['counter'])){
        $priceoffer = $_POST['counter'];
        $mysqli->query("UPDATE bestoffer SET status='counteroffer',price='$priceoffer'  WHERE id_item='$id'");
        $mysqli->query("UPDATE items SET price='$priceoffer'  WHERE id='$id'");
        header("Location: seeNegotiations.php");
    }
}



?>

<h2>List of your offers</h2>
<?php
if($nbOffers > 0){
    echo "<form method='POST'><table border=1>";
    for($i=0;$i<$nbOffers;$i++){
        $id = $allItems[$i][0];
        $name = $allItems[$i][1];
        $photo1 = $allItems[$i][2];
        $photo1 = "../itemImages/".$photo1;
        $price = $allItems[$i][3];
        $offeraccept = $id."accept";
        $counteroffer = $id."counter";
        echo "<tr><td><img src=".$photo1." width=50></td><td><b>".$name."</b></td><td>Price Offer : ".$price."$</td><td>Id : ".$id."</td>";
        echo "<td><input type='submit' value='Accept' name='$offeraccept'</td>";
        echo "<td><input type='number' name='counter' min='1'><input type='submit' value='Counter Offer' name='$counteroffer'</td></tr>";
    }
    echo "</table></form>";
}else echo "No offers, <a href='addItem.php'>want to add one ?</a>";
?>




<?php include 'footer.php'?>