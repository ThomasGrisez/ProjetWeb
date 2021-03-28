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

        $idbuyer = $_SESSION['id'];

        //recherche dans buyitnow les items deja payé avec pour statut payed
        $allInfos = array();
        $result1 = $mysqli->query("SELECT * FROM buyitnow WHERE status = 'payed' AND id_buyer='$idbuyer'");
        if($result1->num_rows != 0){
            while($row = $result1->fetch_assoc()) {
                $info=array($row["id_buyitnow"],$row["id_seller"],$row["id_buyer"],$row["price"],$row["status"],$row["id_item"],$row["quantity"]);
                $allInfos[]=$info;
            }
        }
        //La on un tableau de toutes les transactions deja payée

        $nbItems = count($allInfos);

        $allItems = array();
        for($i=0;$i<$nbItems;$i++){
            $currentId = $allInfos[$i][5];
            $result2 = $mysqli->query("SELECT * FROM `items` WHERE `id`='$currentId'");
            if($result2->num_rows != 0){
                while($row = $result2->fetch_assoc()) {
                    $item=array($row["id"],$row["name"],$row["photo1"],$row["price"],$row["description"],$row["quantity"],$row["type_of_selling"]);
                    
                }
            }
            $allItems[]=$item;
        }
        //La je recupere le tableau avec les items et leurs infos
        //Donc la je connais les infos des items deja achetés
    ?>
    
    <div class="bloc_information_of">
        <h2 class="main_title" align="center">• Welcome back  <span style="text-transform: uppercase;"><?php echo $_SESSION['lname'] ?></span><?php echo " ".$_SESSION['fname']; ?> •</h2>
        <div class="main_aspect_of_profile_bloc">
            <p class="list_of_informations" id="mail_information_buyer"><span class="lis_of_information_title">Your E-Mail : </span><?php echo $_SESSION['email']; ?></p>
            
            <p class="list_of_informations" id="password_information_buyer"><span class="lis_of_information_title">Your Password : </span><?php echo $_SESSION['password']; ?></p>
            
            <p class="list_of_informations" id="adress_information_buyer"><span class="lis_of_information_title">Your Address : </span><?php echo $_SESSION['address']; ?></p>
        </div>
    </div>

    <div class="main_aspect_of_profile_bloc">
    <?php
        if($nbItems>0){
            echo "<h2 class='list_of_informations' style='font-size : 20px;'><em><u>Old orders :</u></em> </h2>";
            echo "<div  class='one_table_of_items'><table  class='table_of_items' border=1>";
            for($j=0;$j<$nbItems;$j++){
                $idItem = $allItems[$j][0];
                $result3 = $mysqli->query("SELECT quantity FROM `buyitnow` WHERE `id_item`='$idItem'");
                while($row = $result3->fetch_assoc()){
                    $quantitywanted = $row["quantity"];
                }
                $pricetopay = $quantitywanted*$allItems[$j][3];
                $image = "../itemImages/".$allItems[$j][2];
                echo "<tr><td style='border : none;'><img src='$image' width=50></td><td class='raw_table_items_list' id='title_item'>".$allItems[$j][1]."</td></tr><tr><td class='raw_table_items_list'  id='price_item'>Price :</td> <td class='raw_table_items_list'><span style='color :#D86B27; font-weight : bold;'>".$pricetopay."$</span></td></tr><tr><td class='raw_table_items_list'  id='quantity_item'>Quantity : </td><td class='raw_table_items_list'>".$quantitywanted."</td></tr><tr><td class='raw_table_items_list' id='last_tr_of_table_item2'><em>Buy It Now</em></td></tr>";
            }
            echo "</table></div>";
        }
    ?>
    </div>
    <div class="main_aspect_of_profile_bloc" id="bloc_button_buyer_profil">
      <div class="button_list_buyer_profil">  
          <a class="link_for_buttons_buyer_profil" href="editBuyer.php"><button class="button_of_informations" id="edit_information_buyer">Edit my profile</button></a>
      </div>
      <div  class="button_list_buyer_profil">
          <a class="link_for_buttons_buyer_profil" href="logout.php"><button class="button_of_informations" id="logout_information_buyer">Log out</button></a>
      </div>
    </div>

    <div class="itemsbuyed">

    </div>
    <?php include 'footer.php'?>

</body>
</html>