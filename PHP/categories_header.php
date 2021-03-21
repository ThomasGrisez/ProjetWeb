<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit.net | Home Page</title>
	<script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../JS/index.js"></script>
	<link rel="icon" type="image/png" href="../Images/Sans_titre_5.png" />
	<link rel="stylesheet" type="text/css" href="../CSS/header.css">
</head>
<body>

	<?php
        if(session_status() == PHP_SESSION_NONE){session_start();}
    
        $mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");

		if(isset($_SESSION['photo'])){
			$photo = "../profilepictures/".$_SESSION['photo'];
		}else{
			$photo = "../Images/account_icon.png";
		}

    ?>

    <header>
    	<ul id="selectionMode">
    		<a href="../PHP/" class="selectionType1"><li>Categories</li></a>
    		<a href="" class="selectionType1"><li>Buying</li></a>
    		<a href="" class="selectionType1"><li>Sell</li></a>
    	</ul>
    	<div id="logoHeader">
    		<img src="../Images/Fit.net.png" alt="logo">
    		<div>
    			<a href="login.php" class="customerIcons"><img src="<?= $photo?>" alt="account" width=35 height=35></a>
    			<a href="" class="customerIcons"><img src="../Images/cart_icon.png" alt="cart"></a>
    		</div>
    	</div>
    	 <div>
    <ul id="categoryMode">
            <a href="../PHP/index.php" class="selectionType2"><li>Home Page</li></a>
            <a href="" class="selectionType2"><li>Equipments</li></a>
            <a href="" class="selectionType2"><li>Complements</li></a>
            <a href="" class="selectionType2"><li>Closes</li></a>
        </ul>
     </div>
    </header>
</body>
</html>