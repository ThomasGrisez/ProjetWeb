<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit.net | Login</title>
	<link rel="icon" type="image/png" href="../Images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="../CSS/login.css">
</head>
<body>
    <?php include 'header.php'?>

    <?php
        if(session_status() == PHP_SESSION_NONE){session_start();}
        $mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");

        if(isset($_POST['formlogin'])){
            $mail = htmlspecialchars($_POST['email']);
            $pw = htmlspecialchars($_POST['password']);

            if(!empty($mail) && !empty($pw)){
                $buyer = $mysqli->query("SELECT * FROM buyer WHERE email = '$mail' AND password='$pw'");
                $seller = $mysqli->query("SELECT * FROM seller WHERE email = '$mail' AND password='$pw'");
                $admin = $mysqli->query("SELECT * FROM administrator WHERE email = '$mail' AND password='$pw'");

                if($buyer->num_rows == 1){
                    $userinfos = $buyer->fetch_assoc();
                    $_SESSION['id'] = $userinfos['id'];
                    $_SESSION['lname'] = $userinfos['last_name'];
                    $_SESSION['fname'] = $userinfos['first_name'];
                    $_SESSION['address'] = $userinfos['address'];
                    $_SESSION['email'] = $userinfos['email'];
                    $_SESSION['shoppingcart'] = $userinfos['shopping_cart'];
                    $_SESSION['password'] = $userinfos['password'];
                    $_SESSION['status'] = "buyer";
                    header("Location: buyerProfile.php");
                }elseif($seller->num_rows == 1){
                    $userinfos = $seller->fetch_assoc();
                    $_SESSION['id'] = $userinfos['id'];
                    $_SESSION['lname'] = $userinfos['last_name'];
                    $_SESSION['fname'] = $userinfos['first_name'];
                    $_SESSION['email'] = $userinfos['email'];
                    $_SESSION['password'] = $userinfos['password'];
                    $_SESSION['photo'] = $userinfos['photo'];
                    $_SESSION['background'] = $userinfos['favorite_background'];
                    $_SESSION['status'] = "seller";
                    header("Location: sellerProfile.php");

                }elseif($admin->num_rows == 1){
                    $userinfos = $admin->fetch_assoc();
                    $_SESSION['id'] = $userinfos['id'];
                    $_SESSION['email'] = $userinfos['email'];
                    $_SESSION['password'] = $userinfos['password'];
                    $_SESSION['status'] = "administrator";
                    header("Location: adminProfile.php");
                }else{
                    $msg = "Wrong mail or password !";
                }

            }else{
                $msg = "All inputs must be filled !";
            }
        }

    ?>

    <section class="main">
        <div class="content">
            <form class="login" action="" method="post">
                <h1 id="login-title">Log In</h1>
                <input type="email" name="email" id="email" placeholder="Email">
                <input type="password" name="password" id="password" placeholder="Password">
                <div id="button-login">
                    <input class="register_submit" type="submit" name="formlogin" value="Log in">
                    <button id="button-fpw"><a href="#">Forgot password</a></button>
                    
                </div>
                <button id="button-register"><a href="register.php">Register</a></button>
                
            </form>
            <?php
                if(isset($msg)) {
                    echo '<font color="red">'.$msg."</font>";
                }
            ?>
        </div>
    </section>

    <?php include 'footer.php'?>
</body>
</html>