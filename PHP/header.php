<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit.net | Home Page</title>
	<link rel="icon" type="image/png" href="../Images/Sans_titre_5.png" />
	<link rel="stylesheet" type="text/css" href="../CSS/header.css">
</head>
<body>

	<?php

		if(session_status() == PHP_SESSION_NONE){
			session_start();
		}
    
        $mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");

		// Display profile photo if someone is connected as a seller
		if(isset($_SESSION['photo'])){
			$photo = "../profilepictures/".$_SESSION['photo'];
		}else{
			$photo = "../Images/account_icon.png";
		}

		$linkSell = "";
		$linkCart = "";
		// Links are different if you are connected or not
		if(isset($_SESSION['status'])){
			if($_SESSION['status']=="seller"){
				$linkProfile = "sellerProfile.php";
				$linkSell = "addItem.php";
			}
			if($_SESSION['status']=="buyer"){
				$linkProfile = "buyerProfile.php";
				$linkCart = "shoppingCart.php";
			}
			if($_SESSION['status']=="administrator")
				$linkProfile = "adminProfile.php";
		}else{
			$linkProfile = "login.php";
			$linkSell = "login.php";
		}
		
		// we check the name of the current page to determine if we need hide or not the navigation menu
		$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);  
    ?>

    <header>
    	<ul id="selectionMode">
    		<a href="../PHP/index.php" class="selectionType1"><li>Categories</li></a>
    		<a href="" class="selectionType1"><li>Buying</li></a>
    		<a href="<?= $linkSell?>" class="selectionType1"><li>Sell</li></a>
    	</ul>
    	<div id="logoHeader">
    		<a href="../PHP/index.php"><img src="../Images/Fit.net.png" alt="logo"></a>
    		<div>
    			<a href="<?= $linkProfile?>" class="customerIcons"><img src="<?= $photo ?>" alt="account" width=35 height=35></a>
    			<a href="<?= $linkCart?>" class="customerIcons"><img src="../Images/cart_icon.png" alt="cart"></a>
    		</div>
    	</div>
		<div>
		<?php
		// we display the navigation menu if it's not one of those pages
			if($curPageName != "payment.php" && $curPageName != "shoppingCart.php" && $curPageName != "adminProfile.php" && $curPageName != "buyerProfile.php" && $curPageName != "sellerProfile.php" && $curPageName != "editAdmin.php" && $curPageName != "editSeller.php" && $curPageName != "editBuyer.php" && $curPageName != "addItem.php" && $curPageName != "privacy_policy.php" && $curPageName != "refund_policy.php"){
		?>
    		<ul id="categoryMode">
    		    <a href="../PHP/index.php" class="selectionType2"><li>Home Page</li></a>
    		    <a href="../PHP/equipment.php" class="selectionType2"><li>Equipments</li></a>
    		    <a href="../PHP/complements.php" class="selectionType2"><li>Complements</li></a>
    		    <a href="../PHP/clothes.php" class="selectionType2"><li>Clothes</li></a>
    		</ul>
		<?php
			}
		?>
    	</div>
    </header>
</body>
</html>