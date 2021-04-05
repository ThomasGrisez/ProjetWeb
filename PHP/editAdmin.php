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
    
    $mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");

    $idadmin = $_SESSION['id'];
    // Modification of email address
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
                        $mysqli->query("UPDATE administrator SET email='$newmail' WHERE id='$idadmin'");
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
    // Modification of the password
    if(isset($_POST['newpw']) && !empty($_POST['newpw']) && $_POST['newpw'] != $_SESSION['password']){
        if(isset($_POST['newpw2']) && !empty($_POST['newpw2'])){
            if($_POST['newpw'] == $_POST['newpw2']){
                $newpw = htmlspecialchars($_POST['newpw']);
                $_SESSION['password'] = $newpw;
                $mysqli->query("UPDATE seller SET password='$newpw' WHERE id='$idadmin'");
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
        <a href="adminProfile.php">Go back to my profile</a>
        <?php if(isset($msg)) echo $msg;?>

    </div>


    <?php include 'footer.php'?>
</body>
</html>