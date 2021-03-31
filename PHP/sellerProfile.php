<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit.net | Profile</title>
	<link rel="icon" type="image/png" href="../Images/favicon.png" />
    <?php include '../CSS/profileCSS.php' ?>
</head>
<body>
    <?php include 'header.php'?>

    <?php
    
        $mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");

        
        //  SELECT id,name FROM `items` WHERE photo1 LIKE '1-%'
        $idseller = $_SESSION['id']."-%";
        $allProducts = array();
        //Select all products from the seller
        $result = $mysqli->query("SELECT `id`,`name`,`photo1` FROM `items` WHERE `photo1` LIKE '$idseller'");
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $product=array($row["id"],$row["name"],$row["photo1"]);
                $allProducts[]=$product;
            }
        }

    ?>
    
    <div class="profile">
        <h2 class="main_title"  align="center">• Welcome back  <span style="text-transform: uppercase;"><?php echo $_SESSION['lname']?></span><?php echo" ".$_SESSION['fname']; ?> •</h2>
        <div class="main_aspect_of_profile_bloc">
          <div class="profile_image_bloc">
              <img src="../profilepictures/<?= $_SESSION['photo']?>" width="auto" height="250" alt="photoprofile">
          </div>
          <div>
              <p class="list_of_informations" id="mail_information_buyer"><span class="lis_of_information_title">Mail :</span> <?php echo $_SESSION['email']; ?></p>
              <p class="list_of_informations" id="password_information_buyer"><span class="lis_of_information_title">Password :</span> <?php echo $_SESSION['password']; ?></p>
          </div>
        </div>

        <div class="main_aspect_of_profile_bloc">
        <?php
            if($result->num_rows > 0){
                echo "<h3 class='list_of_informations' style='font-size : 20px;'><em><u>List of your items :</u></em></h3>";
                echo "<div  class='one_table_of_items'>";
                for ($row = 0; $row < $result->num_rows ; $row++) {
                    $photo = "../itemImages/".$allProducts[$row][2];
                    echo "<table  class='table_of_items' border=1><tr><td style='border : none;'><div class='div_for_border_in_table'><img src=$photo width='60' height='60'></td></tr>"."<tr><td style='border : none;'><span style='font-weight : bold; font-size : 20px; '>ID : </span><span style='color :#D86B27; font-weight : bold; font-size : 20px;'>".$allProducts[$row][0]."</span></td></tr></div><tr><td class='raw_table_items_list'  id='last_tr_of_table_item3'><span style='font-size : 16px; font-weight : bold;'>Name : </span>".$allProducts[$row][1]."</td></tr></table>";
                    
                  }

                echo "</div>";
            }else{
                echo "<span style='color : red;'><b><em>You have no items for sale </em></b><br></span>";
            }
        ?>
        </div>
        <div class="button_for_see_our_item_as_a_seller">
             <div class="main_aspect_of_profile_bloc" id="button_for_see_our_item_as_a_seller">
               <div class="button_add_to_list_an_item">  
                     <a href="addItem.php"><button class="button_of_informations"  id="add_an_item_to_sell">Add an item +</button></a>
               </div>
               <div class="button_add_to_list_an_item">  
                     <a href="seeAuction.php"><button class="button_of_informations"  id="add_an_item_to_sell">See Auction</button></a>
               </div> 
               <div class="button_add_to_list_an_item">  
                     <a href="seeNegotiations.php"><button class="button_of_informations"  id="add_an_item_to_sell">See Offers</button></a>
               </div>  
             </div>
        </div>
        <div class="main_aspect_of_profile_bloc" id="bloc_button_buyer_profil">
            <div class="button_list_buyer_profil">  
                 <a href="editSeller.php"><button class="button_of_informations"  id="edit_information_buyer">Edit my profile</button></a>
            </div>
            <div class="button_list_buyer_profil">  
            <a href="logout.php"><button class="button_of_informations"  id="logout_information_buyer">Log out</button></a>
            </div>
        </div>
    </div>
    <?php include 'footer.php'?>
</body>
</html>