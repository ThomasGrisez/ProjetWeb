<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit.net | Profile</title>
	<link rel="icon" type="image/png" href="../Images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="../CSS/profile.css">
</head>
<body>
    <?php include 'header.php'?>
    <?php
        if(session_status() == PHP_SESSION_NONE){
        session_start();
        }
    
        $mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");

        $idbuyer = $_SESSION['id'];

        //recherche dans buyitnow les items deja payé avec pour statut payed
        $allInfos = array();
        $result1 = $mysqli->query("SELECT * FROM buyitnow WHERE status = 'payed' AND id_buyer='$idbuyer'");
        if($result1->num_rows != 0){
            while($row = $result1->fetch_assoc()) {
                $info=array($row["id_buyitnow"],$row["id_seller"],$row["id_buyer"],$row["price"],$row["status"],$row["id_item"],$row["quantity"]);
                $allInfos[]=$info;
            }
        }
        //La on un tableau de toutes les transactions deja payée

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
        //Donc la je connais les infos des items deja achetés
    ?>
    
    <div class="profile" align="center">
        <h2>Profil de <?php echo $_SESSION['lname']." ".$_SESSION['fname']; ?></h2>
        Mail = <?php echo $_SESSION['email']; ?>
        <br>
        Password = <?php echo $_SESSION['password']; ?>
        <br>
        Address = <?php echo $_SESSION['address']; ?>
        <br>
        <a href="editBuyer.php">Edit my profile</a>
        <a href="logout.php">Log out</a>
    </div>

    <?php
        if($nbItems>0){
            echo "<h2>Old orders : </h2>";
            echo "<table border=1>";
            for($j=0;$j<$nbItems;$j++){
                $idItem = $allItems[$j][0];
                $result3 = $mysqli->query("SELECT quantity FROM `buyitnow` WHERE `id_item`='$idItem'");
                while($row = $result3->fetch_assoc()){
                    $quantitywanted = $row["quantity"];
                }
                $pricetopay = $quantitywanted*$allItems[$j][3];
                $image = "../itemImages/".$allItems[$j][2];
                echo "<tr><td><img src='$image' width=50></td><td>".$allItems[$j][1]."</td><td>Price : ".$pricetopay."$</td><td>Quantity : ".$quantitywanted."</td><td>Buy It Now</td></tr>";
            }
            echo "</table>";
        }
    ?>
    

    <div class="itemsbuyed">

    </div>
    <?php include 'footer.php'?>

</body>
</html>