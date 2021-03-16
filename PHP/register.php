<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit.net | Login</title>
	<script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../JS/index.js"></script>
	<link rel="icon" type="image/png" href="../Images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="../CSS/register.css">
</head>
<body>
    <?php include 'header.php'?>

    <section class="main">
        <div class="content-register">
            <form class="register" action="" method="post">
                <h1 id="register-title">Register</h1>
                <input type="text" name="lname" id="lname" placeholder="Last name">
                <input type="text" name="fname" id="fname" placeholder="First name">
                <input type="text" name="email" id="email" placeholder="Email">
                <input type="text" name="password" id="password" placeholder="Password">
                
                <div class="radios">
                    <label for="buyer">Buyer</label>               
                        <input type="radio" name="type" value="buyer">

                    <label for="seller">Seller</label>
                        <input type="radio" name="type" value="seller">
                </div>

                <div id="button-register">
                    <input type="submit" value="Confirm">
                </div>
            </form>
            
        </div>
    </section>

    <?php include 'footer.php'?>
</body>
</html>