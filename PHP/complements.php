<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../Images/favicon.png" />
    <?php include '../CSS/equipmentsCSS.php' ?>
    <link rel="stylesheet" type="text/css" href="../CSS/categorie.css">
</head>
<body>
    <?php include 'categories_header.php'?>
    <h1>Clothes</h1>
       <div class="filter_item_categories_bloc">
          <div class="filter_form_block">
             <form class="filter_form" name="form" action="" method="post">
                   <div class="title_filter">
                       <img src="../Images/logo_filtre.png" width="18" height="auto">
                       <label for="radio_button_filter"><u>Filters by: </u></label>    
                   </div>
                   <table>
                       <tr class="filter_table_row_line">
                           <td>
                               <input checked="checked" class="radio_button_filter" type="radio" name="filter" value="All" onclick="cacher()" >
                           </td>
                           <td>
                               <label class="label_filter">All</label>
                           </td>               
                       </tr>
                       <tr class="filter_table_row_line">
                           <td><input class="radio_button_filter" type="radio" name="filter" value="Max Price" onclick="afficherPrice()"></td>
                           <td><label class="label_filter" for="max_price_value">Max Price</label>
                           <div id="selecteur_of_price_block" hidden><input class="range" type="range" name="max_price_value" id="max_price_value" value="0" step="5" min="0" max="250"><output></output>$</div></td>
                       </tr>
                       <tr class="filter_table_row_line">
                           <td><input class="radio_button_filter" type="radio" name="filter" value="Name" onclick="afficherType()"></td>
                           <td><label class="label_filter" for="type_of_selling">Type of Selling</label>
                           <div id="selecteur_of_type_block" hidden><select class="select_type_of_sell" name="type_of_selling">
                               <option value="buy_it_now" selected>Buy it Now</option>
                               <option value="auction">Auction</option>
                               <option value="best_offer">Best Offer</option>
                           </select></div>
       
       
                           </td>
                       </tr>
                   </table>
                   <script>
                       $(function() {
                       $('.range').next().text('--'); // Valeur par défaut
                       $('.range').on('input', function() {
                           var $set = $(this).val();
                           $(this).next().text($set);
                       });
                   });     
                           function afficherType(){
                               document.getElementById("selecteur_of_price_block").hidden = true;
                               document.getElementById("selecteur_of_type_block").hidden =false;
                           }
       
                           function afficherPrice()
                           {
                               document.getElementById("selecteur_of_price_block").hidden = false;
                               document.getElementById("selecteur_of_type_block").hidden =true;
                           }
                           function cacher()
                           {
                               document.getElementById("selecteur_of_type_block").hidden =true;
                               document.getElementById("selecteur_of_price_block").hidden = true;
                           }
       
                   </script>
                   <div class="filter_select_button_block">
                       <input type="submit" value="Filter" class="filter_select_button">
                   </div>
               </form>
           </div>
           <div  class="item_table_block"> 
             <?php
                 if(session_status() == PHP_SESSION_NONE){session_start();}
                 
                 $mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");
             
                 $allProducts = array();
                 //Select all products
                 $result = $mysqli->query("SELECT * FROM `items` WHERE `category`='complement'");
                 if($result->num_rows > 0){
                     while($row = $result->fetch_assoc()) {
                         $product=array($row["id"],$row["name"],$row["photo1"],$row["price"],$row["description"],$row["quantity"],$row["type_of_selling"]);
                         $allProducts[]=$product;
                     }
                 }
             ?>
             
             
             <?php
                 if($result->num_rows > 0){
                     for ($row = 0; $row < $result->num_rows ; $row++) {
                         $photo = "../itemImages/".$allProducts[$row][2];
                         $linkproduct = "productPage.php?idproduct=".$allProducts[$row][0];
                         echo "<a  class='link_for_article' href='$linkproduct'>";
                         echo "<table class='table_of_items' border=1>";
                         echo "<tr>";
                         echo "<td rowspan=5><img src=$photo width=300></td>";
                         echo "<td  class='raw_table_items_list'  id='title_item'>".$allProducts[$row][1]."</td></tr>";
                         echo "<tr><td  class='raw_table_items_list'  id='prix_item'><b>Price : </b>$".$allProducts[$row][3]."</td></tr>";
                         echo "<tr><td  class='raw_table_items_list' id='type_item'>Type : ".$allProducts[$row][6]."</td></tr>";
                         echo "<tr><td  class='raw_table_items_list'  id='quantity_item'>Quantity  <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp".$allProducts[$row][5]."</td></tr>";
                         echo "<tr><td  class='raw_table_items_list'>".$allProducts[$row][4]."</td></tr>";
                         echo "</table>";
                         echo "</a>";
                         
                     }
                 }
             ?>
            </div>
        </div>
        <?php include 'footer.php'?>
    </body>
</html>