<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit.net | Profile</title>
	<link rel="icon" type="image/png" href="../Images/favicon.png" />
     <?php include '../CSS/profileCSS.php' ?>
</head>
<body>
    <?php include 'header.php'?>
    <?php
    
        $mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");
    ?>
    
    <div class="profile" align="center">
        <h2 class="main_title">Administrator access<?php echo " : ".$_SESSION['id']; ?></h2>
        <p><span class="lis_of_information_title">Mail :</span> <?php echo $_SESSION['email']; ?></p>
        <p><span class="lis_of_information_title">Password :</span>  <?php echo $_SESSION['password']; ?></p>
        <br><br>
         <h3 style='font-size : 20px;'><u><em>Seller(s):</em></u></h3>
        <?php 
            $query = $mysqli->query("SELECT last_name, first_name, id FROM seller");
            if($query->num_rows > 0){
                while($row = $query->fetch_assoc()){
                    echo "-".$row['first_name']." ".$row['last_name'].", id : ".$row['id']."<br>";
                }
            }
        ?>
        <br>
        <h3 style='font-size : 20px;'><u><em>Buyer(s):</em></u></h3>
        <?php 
            $query = $mysqli->query("SELECT last_name, first_name, id FROM buyer");
            if($query->num_rows > 0){
                while($row = $query->fetch_assoc()){
                    echo "-".$row['first_name']." ".$row['last_name'].", id : ".$row['id']."<br>";
                }
            }
        ?>
        <br><br><br>
        <div class="main_aspect_of_profile_bloc" id="bloc_button_buyer_profil">
            <div class="button_list_buyer_profil">  
                <a href="editAdmin.php"><button class="button_of_informations"  id="edit_information_buyer">Edit my profile</button></a>
            </div>
            <div class="button_list_buyer_profil">  
                <a href="logout.php"><button class="button_of_informations"  id="logout_information_buyer">Log out</button></a>
            </div>
        </div>
    </div>
    <?php include 'footer.php'?>
</body>
</html>