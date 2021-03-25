<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit.net | Profile</title>
	<link rel="icon" type="image/png" href="../Images/favicon.png" />
</head>
<body>
    <?php include 'header.php'?>

    <?php
        if(session_status() == PHP_SESSION_NONE){
        session_start();
        }
    
        $mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");

        
        //  SELECT id,name FROM `items` WHERE photo1 LIKE '1-%'
        $idseller = $_SESSION['id']."-%";
        $allProducts = array();
        //Select all products from the seller
        $result = $mysqli->query("SELECT `id`,`name`,`photo1` FROM `items` WHERE `photo1` LIKE '$idseller'");
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $product=array($row["id"],$row["name"],$row["photo1"]);
                $allProducts[]=$product;
            }
        }



    ?>
    
    <div class="profile" align="center">
        <h2>Profil de <?php echo $_SESSION['lname']." ".$_SESSION['fname']; ?></h2>
        <img src="../profilepictures/<?= $_SESSION['photo']?>" width="50"alt="photoprofile">
        <br>
        Mail : <?php echo $_SESSION['email']; ?>
        <br>
        Password : <?php echo $_SESSION['password']; ?>
        <br>
        <?php
            if($result->num_rows > 0){
                echo "<h3>List of your items</h3>";
                for ($row = 0; $row < $result->num_rows ; $row++) {
                    $photo = "../itemImages/".$allProducts[$row][2];
                    echo "<img src=$photo width=30>"."-Id : ".$allProducts[$row][0].", Name : ".$allProducts[$row][1]."<br>";
                    
                  }
            }else{
                echo "You have no items for sale <br>";
            }
        ?>
        
        
        <a href="addItem.php">Add an item</a>
        <a href="editSeller.php">Edit my profile</a>
        <a href="logout.php">Log out</a>
    </div>
    <?php include 'footer.php'?>
</body>
</html>