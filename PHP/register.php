<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit.net | Login</title>
	<link rel="icon" type="image/png" href="../Images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="../CSS/register.css">
</head>
<body>
    <?php include 'header.php'?>

    <?php
        require 'config.php';

        if(isset($_POST['inscription'])){
            $firstName = htmlspecialchars($_POST['fname']);
            $lastName = htmlspecialchars($_POST['lname']);
            $mail = htmlspecialchars($_POST['email']);
            $mail2 = htmlspecialchars($_POST['email2']);
            $pw = sha1($_POST['password']);
            $pw2 = sha1($_POST['password2']);
            $type = $_POST['type'];

            if(!empty($_POST['fname']) &&  !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['email2']) && !empty($_POST['password']) && !empty($_POST['password2'])){
                if($mail == $mail2){
                    if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
                        $result1 = $mysqli->query("SELECT * FROM buyer WHERE email = '$mail'");
                        $result2 = $mysqli->query("SELECT * FROM seller WHERE email = '$mail'");
                        $result3 = $mysqli->query("SELECT * FROM administrator WHERE email = '$mail'");
                        if($result1->num_rows == 0 && $result2->num_rows == 0 && $result3->num_rows == 0){
                            if($pw == $pw2){
                                $myslqi->query("INSERT INTO ")
                            }else{
                                $msg = "The passwords are different !";
                            }
                        }else{
                            $msg = "This email adress already exists !";
                        } 
                    }else{
                        $msg = "The email address is not valid -> name@example.com";
                    }
                }else{
                    $msg = "Your email addresses are different !";
                }
            }

        }


    ?>

    <section class="main">
        <div class="content-register">
            <form class="register" action="" method="post">
                <h1 id="register-title">Register</h1>
                <input type="text" name="lname" id="lname" placeholder="Last name">
                <input type="text" name="fname" id="fname" placeholder="First name">
                <input type="text" name="email" id="email" placeholder="Email">
                <input type="text" name="email2" id="email2" placeholder="Confirm your Email">
                <input type="text" name="password" id="password" placeholder="Password">
                <input type="text" name="password2" id="password2" placeholder="Confirm your Password">

                
                <div class="radios">
                    <label for="buyer">Buyer</label>               
                        <input type="radio" name="type" value="buyer">

                    <label for="seller">Seller</label>
                        <input type="radio" name="type" value="seller">
                </div>

                <div id="button-register">
                    <input type="submit" name="inscription" value="Confirm">
                </div>
            </form>
            
        </div>
    </section>

    <?php include 'footer.php'?>
</body>
</html>