<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit.net | Login</title>
	<script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../JS/index.js"></script>
	<link rel="icon" type="image/png" href="../Images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="../CSS/login.css">
</head>
<body>
    <?php include 'header.php'?>

    <section class="main">
        <div class="content">
            <form class="login" action="" method="post">
                <h1 id="login-title">Log In</h1>
                <input type="text" name="email" id="email" placeholder="Email">
                <input type="text" name="password" id="password" placeholder="Password">
                <div id="button-login">
                    <input type="submit" value="Log in">
                    <button id="button-fpw"><a href="#">Forgot password</a></button>
                    
                </div>
                <button id="button-register"><a href="register.php">Register</a></button>
            </form>
            
        </div>
    </section>

    <?php include 'footer.php'?>
</body>
</html>