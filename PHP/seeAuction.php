<?php include 'header.php'?>

<?php
$mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");
$idseller = $_SESSION['id'];


// All auctions in progress of the seller
$queryauctions = $mysqli->query("SELECT * FROM `auction` WHERE `id_seller`='$idseller' AND `status`='inprogress' ");
$allauctions = array();
if($queryauctions->num_rows > 0){
    while($row = $queryauctions->fetch_assoc()) {
        $auction= array($row['id_auction'],$row['id_buyer'],$row['id_seller'],$row['id_item'],$row['price'],$row['status'],$row['date']);
        $allauctions[] = $auction;
    }
}

// All infos on the items on auction
$nbAuctions = count($allauctions);
$allItems = array();
for($i=0;$i<$nbAuctions;$i++){
    $idItem = $allauctions[$i][3];
    $queryItem = $mysqli->query("SELECT id,name,photo1,price FROM `items` WHERE `id`='$idItem' ");
    if ($queryItem->num_rows > 0) {
        while($row = $queryItem->fetch_assoc()) {
            $item= array($row["id"],$row["name"],$row["photo1"],$row["price"]);
            $allItems[] = $item;
        }
    }
}
?>


<h2>List of your auctions</h2>

<?php
if($nbAuctions > 0){
    echo "<table border=1>";
    for($i=0;$i<$nbAuctions;$i++){
        $id = $allItems[$i][0];
        $name = $allItems[$i][1];
        $photo1 = $allItems[$i][2];
        $photo1 = "../itemImages/".$photo1;
        $price = $allItems[$i][3];

        echo "<tr><td><img src=".$photo1." width=50></td><td>".$name."</td><td>Current Price : ".$price."$</td><td>Id : ".$id."</td></tr>";
    }
    echo "</table>";
}else echo "No auctions, <a href='addItem.php'>want to add one ?</a>";


?>


<?php include 'footer.php'?>