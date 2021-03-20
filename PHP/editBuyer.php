<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit.net | Edit Profile</title>
	<link rel="icon" type="image/png" href="../Images/favicon.png" />
</head>
<body>
    <?php include 'header.php'?>

    <?php
    if(session_status() == PHP_SESSION_NONE){session_start();}
    
    $mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");

    $idbuyer = $_SESSION['id'];
    if(isset($_POST['newlname']) && !empty($_POST['newlname']) && $_POST['newlname'] != $_SESSION['lname']){
        $newlname = htmlspecialchars($_POST['newlname']);
        $_SESSION['lname'] = $newlname;
        $mysqli->query("UPDATE seller SET last_name='$newlname' WHERE id='$idseller'");
    }
    if(isset($_POST['newfname']) && !empty($_POST['newfname']) && $_POST['newfname'] != $_SESSION['fname']){
        $newfname = htmlspecialchars($_POST['newfname']);
        $_SESSION['fname'] = $newfname;
        $mysqli->query("UPDATE seller SET first_name='$newfname' WHERE id='$idseller'");
    }
    if(isset($_POST['newaddress']) && !empty($_POST['newaddress']) && $_POST['newaddress'] != $_SESSION['address']){
        $newaddress = htmlspecialchars($_POST['newaddress']);
        $_SESSION['address'] = $newaddress;
        $mysqli->query("UPDATE buyer SET address='$newaddress' WHERE id='$idbuyer'");
    }
    if(isset($_POST['newmail']) && !empty($_POST['newmail']) && $_POST['newmail'] != $_SESSION['email']){
        if(isset($_POST['newmail2']) && !empty($_POST['newmail2'])){
            if($_POST['newmail'] == $_POST['newmail2']){
                $newmail = htmlspecialchars($_POST['newmail']);

                if(filter_var($newmail, FILTER_VALIDATE_EMAIL)){
                    $result1 = $mysqli->query("SELECT * FROM buyer WHERE email = '$newmail'");
                    $result2 = $mysqli->query("SELECT * FROM seller WHERE email = '$newmail'");
                    $result3 = $mysqli->query("SELECT * FROM administrator WHERE email = '$newmail'");
                    if($result1->num_rows == 0 && $result2->num_rows == 0 && $result3->num_rows == 0){
                        $_SESSION['email'] = $newmail;
                        $mysqli->query("UPDATE buyer SET email='$newmail' WHERE id='$idbuyer'");
                    }
                }else{
                    $msg = "Your email address is not valid !";
                }
                
            }else{
                $msg = "Your email confirmation is different";
            }
        }else{
            $msg = "Please confirm your new email !";
        }  
    }
    if(isset($_POST['newpw']) && !empty($_POST['newpw']) && $_POST['newpw'] != $_SESSION['password']){
        if(isset($_POST['newpw2']) && !empty($_POST['newpw2'])){
            if($_POST['newpw'] == $_POST['newpw2']){
                $newpw = htmlspecialchars($_POST['newpw']);
                $_SESSION['password'] = $newpw;
                $mysqli->query("UPDATE seller SET password='$newpw' WHERE id='$idseller'");
            }else{
                $msg = "Your password confirmation is different";
            }
        }else{
            $msg = "Please confirm your new password !";
        }  
    }

    ?>
    
    <div class="profile" align="center">
        <h2>Edit profile</h2>
        <form action="" method="post">
            <label for="newlname">Last name :</label>
            <input type="text" name="newlname" id="newlname" placeholder="Last name" value=<?=$_SESSION['lname']?>>
            <br>
            <label for="newfname">First name :</label>
            <input type="text" name="newfname" id="newfname" placeholder="First name" value=<?=$_SESSION['fname']?>>
            <br>
            <label for="newaddress">Address :</label>
            <input type="text" name="newaddress" id="newaddress" placeholder="Address" value=<?=$_SESSION['address']?>>
            <br>
            <label for="newmail">Email :</label>
            <input type="email" name="newmail" id="newmail" placeholder="Email" value=<?=$_SESSION['email']?>>
            <br>
            <label for="newmail2">Email Confirmation :</label>
            <input type="email" name="newmail2" id="newmail2" placeholder="Confirm new email">
            <br>
            <label for="newpw">Password :</label>
            <input type="password" name="newpw" id="newpw" placeholder="Password">
            <br>
            <label for="newpw2">Password Confirmation :</label>
            <input type="password" name="newpw2" id="newpw2" placeholder="Confirm new password">
            <br>
            <input type="submit" value="confirm">
        </form>
        <a href="buyerProfile.php">Go back to my profile</a>
        <?php if(isset($msg)) echo $msg;?>

    </div>


    <?php include 'footer.php'?>
</body>
</html>