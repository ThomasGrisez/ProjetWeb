<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit.net | Home Page</title>
	<script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../JS/index.js"></script>
	<link rel="icon" type="image/png" href="../Images/Sans_titre_5.png" />
	<link rel="stylesheet" type="text/css" href="../CSS/footer.css">
</head>
<body>

<footer class="footer">
    	<table class="footer_table">
    		<tbody>
    			<tr>
    				<td class="first_footerpart">
    					<h5 class="title_footer1">Social Media</h5>
    					<table>
    						<tr>
    							<td class="different_socialMedia">
    								<a href="https://www.facebook.com/" target="_blank"><img src="../Images/fb_logo.png"></td></a>
    							</td>
    							<td class="different_socialMedia">
    								<a href="https://twitter.com/" target="_blank"><img src="../Images/twitter_logo.png"></a>
    							</td>
    						</tr>
    						<tr>
    							<td class="different_socialMedia">
    								<a href="https://www.instagram.com/" target="_blank"><img src="../Images/insta_logo.png"></a>
    							</td>
    							<td class="different_socialMedia">
    								<a href="https://www.reddit.com/" target="_blank"><img src="../Images/reddit_logo.png"></a>
    							</td>
    						</tr>
    						<tr>
    							<td class="different_socialMedia">
    								<a href="https://www.pinterest.fr/" target="_blank"><img src="../Images/pinterest_logo.png"></a>
    							</td>
    							<td class="different_socialMedia">
    								<a href="https://www.youtube.com/" target="_blank"><img src="../Images/youtube_logo.png"></a>
    							</td>
    						</tr>
    					</table>
    				</td>
    				<td class="second_footerpart">
    					<h4 class="title_footer2">Subscribe to the newletter</h4>
                        <form method="post">
                            <input type="email" name="email_marketing" id="textLabel_email_marketing" size="50">
							<input  id="button_email_marketing" type="submit" name="newsletter" value="Subscribe">
                        </form>
						<?php
						// mail newsletter
							if(isset($_POST['newsletter']) && isset($_POST['email_marketing'])){
								$email = $_POST['email_marketing'];
								if(!empty($email)){
									mail($email, "Subscription to the newsletter", "<h1>Hi ! You are now subscribed to the newsletter</h1>,<br> you will recieve mails with discounts and every news on the website !");
								}else echo "Please enter your email address";
							}
						?>
    				</td>
    				<td class="third_footerpart">
    					<h5 class="title_footer3" >Help Center</h5>
                        <ul id="help_center">
                          <a href="../PHP/contact_us.php" class="selectionType1"> <li>A Problem ?</li></a>
                          <a href="../PHP/general_terms_of_sale_and_use.php" class="selectionType1"> <li>General terms of sale and use</li></a>
                          <a href="../PHP/privacy_policy.php" class="selectionType1"><li></li>Privacy Policy</a>
                          <a href="../PHP/refund_policy.php" class="selectionType1"><li></li>Refund Policy</a>
                        </ul>
    				</td>
    			</tr>
    		</tbody>
    	</table>
    </footer>
</body>
</html>