<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit.net | Add item</title>
	<link rel="icon" type="image/png" href="../Images/favicon.png" />
</head>
<body>
    <?php include 'header.php'?>

    <?php
        if(session_status() == PHP_SESSION_NONE){
        session_start();
        }
    
        $mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");

        if(isset($_POST['submititem'])){
            $name = htmlspecialchars($_POST['nameitem']);
            // $name = str_replace(" ", "_", $name1);
            $price = htmlspecialchars($_POST['priceitem']);
            $quantity = htmlspecialchars($_POST['quantity']);
            $description = htmlspecialchars($_POST['descriptionitem']);
            $category = htmlspecialchars($_POST['categoryitem']);
            $type = htmlspecialchars($_POST['typesale']);
            unset($msg);
            

            if(!empty($name) && !empty($price) && !empty($quantity) && !empty($description) && !empty($category) && !empty($type)){
                if(isset($_FILES['photos']) && !empty($_FILES['photos']['name'])){  
                    $validextensions = array('jpg', 'jpeg', 'gif', 'png');
                    $extension = strtolower(substr(strrchr($_FILES['photos']['name'], '.'), 1));

                    if(in_array($extension, $validextensions)) {
                        
                        $path = "../itemImages/".$_SESSION['id']."-".$name."-1.".$extension;
                        $result = move_uploaded_file($_FILES['photos']['tmp_name'], $path);
                        if($result) {
                            $photo = $_SESSION['id']."-".$name."-1.".$extension;
                            $idseller = $_SESSION['id'];
                            $mysqli->query("INSERT INTO `items` (`id`, `name`, `description`, `price`, `category`, `photo1`, `photo2`, `photo3`, `video`, `quantity`, `type_of_selling`, `id_seller`) VALUES(NULL,'$name','$description','$price','$category','$photo','','','','$quantity','$type', '$idseller')");
                        }else {
                        $msg = "Error while importing your photo 1";
                        }
                    }else {
                        $msg = "Your photo format must be jpg, jpeg, gif or png";
                    }

                    if(isset($_FILES['photo2']) && !empty($_FILES['photo2']['name'])) {
                    
                        $extension = strtolower(substr(strrchr($_FILES['photo2']['name'], '.'), 1));
    
                        if(in_array($extension, $validextensions)) {
                            $path = "../itemImages/".$_SESSION['id']."-".$name."-2.".$extension;
                            $result = move_uploaded_file($_FILES['photo2']['tmp_name'], $path);
                            if($result) {
                                $photo1 = $_SESSION['id']."-".$name."-1.".$extension;
                                $photo = $_SESSION['id']."-".$name."-2.".$extension;
                                $mysqli->query("UPDATE items SET photo2='$photo' WHERE photo1='$photo1'");
                            }else {
                            $msg = "Error while importing your photo 2";
                            }
                        }else {
                            $msg = "Your photo format must be jpg, jpeg, gif or png";
                        }
                        
                    }
                    if(isset($_FILES['photo3']) && !empty($_FILES['photo3']['name'])) {
                    
                        $extension = strtolower(substr(strrchr($_FILES['photo3']['name'], '.'), 1));
    
                        if(in_array($extension, $validextensions)) {
                            $path = "../itemImages/".$_SESSION['id']."-".$name."-3.".$extension;
                            $result = move_uploaded_file($_FILES['photo3']['tmp_name'], $path);
                            if($result) {
                                $photo1 = $_SESSION['id']."-".$name."-1.".$extension;
                                $photo = $_SESSION['id']."-".$name."-3.".$extension;
                                $mysqli->query("UPDATE items SET photo3='$photo' WHERE photo1='$photo1'");
                            }else {
                            $msg = "Error while importing your photo 3";
                            }
                        }else {
                            $msg = "Your photo format must be jpg, jpeg, gif or png";
                        }
                    }
                }else $msg = "you need a photo";
                
            }else $msg = "one the input is inccorect";
        }
    ?>


    <div class="add">
        <h2>Add Item</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="nameitem">Name :</label>
            <input type="text" name="nameitem" id="nameitem" placeholder="Name">
            <br>
            <label for="priceitem">Price :</label>
            <input type="text" name="priceitem" id="priceitem" placeholder="Price">
            <br>
            <label for="quantity">Quantity :</label>
            <input type="text" name="quantity" id="quantity" placeholder="Quantity" value="1">
            <br>
            <label for="descriptionitem">Description :</label>
            <input type="text" name="descriptionitem" id="descriptionitem" placeholder="Description">
            <br>
            <label for="categoryitem">Category :</label>
            <select name="categoryitem" id="categoryitem">
                <option value="equipment">Equipments</option>
                <option value="complement">Complements</option>
                <option value="clothe">Clothes</option>
            </select>
            <br>
            <label for="typesale">Type of sale :</label>
            <select name="typesale" id="typesale">
                <option value="buyitnow">Buy It Now</option>
                <option value="bestoffer">Best Offer</option>
                <option value="auction">Auction</option>
            </select>
            <br>
            <label for="numberphotos">How many photos ? :</label>
            <input type="number" id="numberphotos" id="numberphotos" min="1" max="3" value="1" onclick="visibility()">
            <br>

            <label id="l1" for="photos">Import photo:</label>
            <input type="file" name="photos" id="photos"/>
            <br>
            <label id="l2" for="photo2" hidden>Import photo:</label>
            <input type="file" name="photo2" id="photo2" hidden/>
            <br id="b2" hidden>
            <label id="l3" for="photo3" hidden>Import photo:</label>
            <input type="file" name="photo3" id="photo3" hidden/>
            <br id="b3" hidden>
            <script>
                function visibility(){
                    if(document.getElementById("numberphotos").value == 1){
                    document.getElementById("l2").hidden = true;
                    document.getElementById("photo2").hidden = true;
                    document.getElementById("b2").hidden = true;
                    document.getElementById("l3").hidden = true;
                    document.getElementById("photo3").hidden = true;
                    document.getElementById("b3").hidden = true;
                    }
                    if(document.getElementById("numberphotos").value == 2){
                    document.getElementById("l2").hidden = false;
                    document.getElementById("photo2").hidden = false;
                    document.getElementById("b2").hidden = false;
                    document.getElementById("l3").hidden = true;
                    document.getElementById("photo3").hidden = true;
                    document.getElementById("b3").hidden = true;
                    }
                    if(document.getElementById("numberphotos").value == 3){
                    document.getElementById("l2").hidden = false;
                    document.getElementById("photo2").hidden = false;
                    document.getElementById("b2").hidden = false;
                    document.getElementById("l3").hidden = false;
                    document.getElementById("photo3").hidden = false;
                    document.getElementById("b3").hidden = false;
                    }
                    
                }
            </script>
            
            <input type="submit" name="submititem" value="Add Item">
        </form>
        <a href="sellerProfile.php">Go back to my profile</a>
        <?php  if(isset($msg)) {
                    echo '<font color="red">'.$msg."</font>";
                } ?>
    </div>


    <?php include 'footer.php'?>
</body>
</html>