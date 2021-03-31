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

    $idseller = $_SESSION['id'];
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
                        $mysqli->query("UPDATE seller SET email='$newmail' WHERE id='$idseller'");
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
    if(isset($_FILES['photo']) && !empty($_FILES['photo']['name'])) {
        $photoname = $_FILES['photo']['name'];
        $photoExt = explode('.',$photoname);
        $photoActualExt = strtolower(end($photoExt));
        $validextensions = array('jpg', 'jpeg', 'gif', 'png');
        if(in_array($photoActualExt, $validextensions)) {
            $namephoto = "ID=".$_SESSION['id']."_".uniqid('',true);
            $path = "../profilepictures/".$namephoto.".".$photoActualExt;
            $upload = move_uploaded_file($_FILES['photo']['tmp_name'], $path);
            if($upload) {
                $prevPhoto = "../profilepictures/".$_SESSION['photo'];
                if(file_exists($prevPhoto))
                    unlink($prevPhoto);
                $newphoto = $namephoto.".".$photoActualExt;
                $mysqli->query("UPDATE seller SET photo='$newphoto' WHERE id='$idseller'");
                unset($_SESSION['photo']);
                $_SESSION['photo'] = $newphoto;
                header("Location: editSeller.php");
            }else {
            $msg = "Error while importing your photo";
            }
        }else {
            $msg = "Must be jpg, jpeg, gif or png";
        }
    }
    if(isset($_POST['itemtodelete'])){
        $id = htmlspecialchars($_POST['todelete']);
        $resultItemtoDelete = $mysqli->query("SELECT `photo1`,`photo2`,`photo3` FROM `items` WHERE `id` LIKE '$id'");
        if($resultItemtoDelete->num_rows > 0){
            while($row = $resultItemtoDelete->fetch_assoc()) {
                $product=array($row["photo1"],$row["photo2"],$row["photo3"]);
            }
        }
        if($product[0]!=""){
            $path = "../itemImages/".$product[0];
            unlink($path);
        }
        if($product[1]!=""){
            $path = "../itemImages/".$product[1];
            unlink($path);
        }
        if($product[2]!=""){
            $path = "../itemImages/".$product[2];
            unlink($path);
        }
        $mysqli->query("DELETE FROM items WHERE id='$id'");
    }
    
    $idseller = $_SESSION['id']."-%";
    $allProducts = array();
    //Select all products from the seller
    $resultProducts = $mysqli->query("SELECT `id`,`name`,`photo1`,`photo2`,`photo3` FROM `items` WHERE `photo1` LIKE '$idseller'");
    if($resultProducts->num_rows > 0){
        while($row = $resultProducts->fetch_assoc()) {
            $product=array($row["id"],$row["name"],$row["photo1"],$row["photo2"],$row["photo3"]);
            $allProducts[]=$product;
        }
    }
     
    ?>
    
    <div class="profile"  align="center">
        <h2 style="font-size : 35px;">Edit profile</h2>
        <form action="" method="post" enctype="multipart/form-data">
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
                <div class="form_part_of_profile_information" id="picture_profile_information_bloc" align="left">
                    <label for="photo">Photo :</label>
                    <input id="select_a_picture_file" type='file' name="photo" id="photo">
                </div>
            </div>
            <br>
            <input class="button_validate_edit_profile" type="submit" value="Confirm">
        </form>
    </div>
    <div align="left" style="width: 25%; padding-left: 40%" > 
        <?php
            if($resultProducts->num_rows > 0){
                echo "<h3 style='font-size : 28px; padding-top : 15px; '>List of your items</h3>";
                for ($row = 0; $row < $resultProducts->num_rows ; $row++) {
                    $photo = "../itemImages/".$allProducts[$row][2];
                    echo "<p style='padding-bottom : 5px; '><span style='padding-right : 10px;'><b>Name :</b> ".$allProducts[$row][1].",</span><span><b> Id :</b> <span style='color :#D86B27; font-weight : bolder;'>".$allProducts[$row][0]."</span></p>";
                  }
            }else{
                echo "<p style='font-size : 20px; font-weight : bold; padding-top : 15px; '>You have no items for sale </p><br>";
            }
        ?>
        <form action="" method="post">
            <label for="todelete">Id of the item you want to remove :</label>
            <div class="delete_an_item_menu">
                <input  class="text_label_for_delet_item_profile"  type="text" name="todelete" id="todelete" placeholder="Id to remove">
                <input  class="button_validate_delete_item_profile" type="submit" name="itemtodelete"value="Remove">
            </div>
        </form>
        <div style="padding-top: 30px; padding-bottom: 10px; " >
            <a href="sellerProfile.php"><button class="button_go_back_to_my_profile">← Go back to my profile</button></a>
        </div>
        <?php if(isset($msg)) echo $msg;?>

    </div>


    <?php include 'footer.php'?>
</body>
</html>