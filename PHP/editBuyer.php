<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit.net | Edit Profile</title>
	<link rel="icon" type="image/png" href="../Images/favicon.png" />
     <?php include '../CSS/modifyprofileCSS.php' ?>
</head>
<body>
    <?php include 'header.php'?>

    <?php
    
    $mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");

    $idbuyer = $_SESSION['id'];
    // last name
    if(isset($_POST['newlname']) && !empty($_POST['newlname']) && $_POST['newlname'] != $_SESSION['lname']){
        $newlname = htmlspecialchars($_POST['newlname']);
        $_SESSION['lname'] = $newlname;
        $mysqli->query("UPDATE buyer SET last_name='$newlname' WHERE id='$idbuyer'");
    }
    // first name
    if(isset($_POST['newfname']) && !empty($_POST['newfname']) && $_POST['newfname'] != $_SESSION['fname']){
        $newfname = htmlspecialchars($_POST['newfname']);
        $_SESSION['fname'] = $newfname;
        $mysqli->query("UPDATE buyer SET first_name='$newfname' WHERE id='$idbuyer'");
    }
    // address
    if(isset($_POST['newaddress']) && !empty($_POST['newaddress']) && $_POST['newaddress'] != $_SESSION['address']){
        $newaddress = htmlspecialchars($_POST['newaddress']);
        $_SESSION['address'] = $newaddress;
        $mysqli->query("UPDATE buyer SET address='$newaddress' WHERE id='$idbuyer'");
    }
    // mail
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
    // password
    if(isset($_POST['newpw']) && !empty($_POST['newpw']) && $_POST['newpw'] != $_SESSION['password']){
        if(isset($_POST['newpw2']) && !empty($_POST['newpw2'])){
            if($_POST['newpw'] == $_POST['newpw2']){
                $newpw = htmlspecialchars($_POST['newpw']);
                $_SESSION['password'] = $newpw;
                $mysqli->query("UPDATE buyer SET `password`='$newpw' WHERE `id`='$idbuyer' ");
            }else{
                $msg = "Your password confirmation is different";
            }
        }else{
            $msg = "Please confirm your new password !";
        }  
    }

    ?>
    
    <div class="profile" align="center">
        <h2 style="font-size : 35px;">Edit profile</h2>
        <form action="" method="post">
            <div class="profile_information_change">
                <div class="form_part_of_profile_information" id="last_name_profile_information_bloc" align="left">
                    <label for="newlname">Last name :</label>
                    <input class="text_label_for_modify_profile" type="text" name="newlname" id="newlname" placeholder="Last name" value=<?=$_SESSION['lname']?>>
                </div>
                <br>
                <div class="form_part_of_profile_information" id="first_name_profile_information_bloc" align="left">
                    <label for="newfname">First name :</label>
                    <input class="text_label_for_modify_profile" type="text" name="newfname" id="newfname" placeholder="First name" value=<?=$_SESSION['fname']?>>
                </div>
                <br>
                <div class="form_part_of_profile_information" id="adress_profile_information_bloc" align="left">
                    <label for="newaddress">Address :</label>
                    <input class="text_label_for_modify_profile" type="text" name="newaddress" id="newaddress" placeholder="Address" value=<?=$_SESSION['address']?>>
                </div>
                <br>
                <div class="form_part_of_profile_information" id="email_profile_information_bloc" align="left">
                    <label for="newmail">Email :</label>
                    <input class="text_label_for_modify_profile" type="email" name="newmail" id="newmail" placeholder="Email" value=<?=$_SESSION['email']?>>
                </div>
                <br>
                <div class="form_part_of_profile_information" id="confirm_email_profile_information_bloc" align="left">
                    <label for="newmail2">Email Confirmation :</label>
                    <input class="text_label_for_modify_profile" type="email" name="newmail2" id="newmail2" placeholder="Confirm new email">
                </div>
                <br>
                <div class="form_part_of_profile_information" id="password_profile_information_bloc" align="left">
                    <label for="newpw">Password :</label>
                    <input class="text_label_for_modify_profile" type="password" name="newpw" id="newpw" placeholder="Password">
                </div>
                <br>
                <div class="form_part_of_profile_information" id="confirm_pssword_profile_information_bloc" align="left">
                    <label for="newpw2">Password Confirmation :</label>
                    <input class="text_label_for_modify_profile" type="password" name="newpw2" id="newpw2" placeholder="Confirm new password">
                </div>
                <br>
                <input  class="button_validate_edit_profile" type="submit" value="confirm">
            </div>
        </form>
        <a href="buyerProfile.php"><button class="button_go_back_to_my_profile">← Go back to my profile</button></a>
        <?php if(isset($msg)) echo $msg;?>

    </div>


    <?php include 'footer.php'?>
</body>
</html>