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
    ?>
    
    <div class="profile" align="center">
        <h2>Administrator <?php echo " : ".$_SESSION['id']; ?></h2>
        Mail = <?php echo $_SESSION['email']; ?>
        <br>
        Password = <?php echo $_SESSION['password']; ?>
        <br><br>
        Seller(s):<br>
        <?php 
            $query = $mysqli->query("SELECT last_name, first_name, id FROM seller");
            if($query->num_rows > 0){
                while($row = $query->fetch_assoc()){
                    echo "-".$row['first_name']." ".$row['last_name'].", id : ".$row['id']."<br>";
                }
            }
        ?>
        <br>
        Buyer(s):<br>
        <?php 
            $query = $mysqli->query("SELECT last_name, first_name, id FROM buyer");
            if($query->num_rows > 0){
                while($row = $query->fetch_assoc()){
                    echo "-".$row['first_name']." ".$row['last_name'].", id : ".$row['id']."<br>";
                }
            }
        ?>
        <br>
        <a href="editAdmin.php">Edit my profile</a>
        <a href="logout.php">Log out</a>
    </div>
    <?php include 'footer.php'?>
</body>
</html>