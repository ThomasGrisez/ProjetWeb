<?php include '../CSS/modifyprofileCSS.php' ?>
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

<div  align='center'>
<h2 style="font-size : 35px;">List of your auctions</h2>

<?php
//display the auctions of the seller and he current highest bid
if($nbAuctions > 0){
    echo "<div class='profile_information_change'><table border=1 class='table_of_differnets_items'>";
    for($i=0;$i<$nbAuctions;$i++){
        $id = $allItems[$i][0];
        $name = $allItems[$i][1];
        $photo1 = $allItems[$i][2];
        $photo1 = "../itemImages/".$photo1;
        $price = $allItems[$i][3];

        echo "<tr><td style='border : none; '><img src=".$photo1." width='70' height='70'></td><td style=' border : none;' class='raw_table_items_list' id='title_item'>".$name."</td></tr><tr><td style='border : none;' class='raw_table_items_list' id='price_item'>Actual Price: </td><td style='color :#D86B27; font-weight : bold;' class='raw_table_items_list'>".$price."$</td></tr><tr ><td style='border : none; border-bottom : grey 1px solid; padding-bottom : 10px;' class='raw_table_items_list'>Id : ".$id."</td></tr>";
    }
    echo "</table><div style='padding :40px 0px 3px 0px;'><a href='sellerProfile.php'><button class='button_go_back_to_my_profile'>← Go back to my profile</button></a></div>";
}else echo "<b>NO AUCTIONS !</b> <a href='addItem.php' style='text-decoration : none; color: #D86B27; font-style : italic; font-weight : bold;'>want to add one ?</a><br><br><br><a href='sellerProfile.php'><button class='button_go_back_to_my_profile'>← Go back to my profile</button></a></div>";


?>
</div>

<?php include 'footer.php'?>