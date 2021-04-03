<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit.net | Contact Us</title>
	<link rel="icon" type="image/png" href="../Images/favicon.png" />
	<link rel="stylesheet" type="text/css" href="../CSS/contact_us.css">	
</head>
	<body>
	 	<?php include 'header.php'?>
	 	<form class="contact_us_form" method="POST">

	 		<div class="bloc_name_email">
	 			<div class="bloc_text">
	 				<label for="name">Name *</label>
	 				<input class="first_part_text" type="text" name="name" required>
	 			</div>
	 			<div class="bloc_text">
	 				<label for="email">Email *</label>
	 				<input  class="first_part_text" type="email" name="email" required>
	 			</div>
	 		</div>
	 		<div class="bloc_text">
	 			<label for="phone">Phone number</label>
	 			<input  class="second_part_text" type="tel" name="phone">
	 		</div>
	 		<div class="bloc_text">
	 			<label for="message">Message *</label>
	 			<input  class="last_part_text" type="text" name="message" required>
	 		</div>
	 		<input class="button_contac_us" type="submit" name="validate" value="SEND">
	 	</form>

		<?php

		if(isset($_POST['validate'])){
			if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])){
				$message = $_POST['message'];
				$username = $_POST['name'];
				$usermail = $_POST['email'];
				if(!empty($_POST['phone'])){
					$phone = $_POST['phone'];
					$message .= "<br><br>Phone number : ".$phone;
				}

				// Mail
				$to = "fitnet@email.com";
				$subject = "Problem : ".$username;
				$from = $usermail;

				// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				// Create email headers
				$headers .= 'From: '.$from."\r\n".
				'Reply-To: '.$from."\r\n" .
				'X-Mailer: PHP/' . phpversion();

				// Sending email
				mail($to, $subject, $message, $headers);
				header("Location: index.php");

			}else echo "You must enter your name, email and message !";
		}
		?>
 		<?php include 'footer.php'?>
	</body>