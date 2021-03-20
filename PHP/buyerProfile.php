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
    <?php include 'footer.php'?>

</body>
</html>