<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../Images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="../CSS/categorie.css">
    <?php include '../CSS/equipmentsCSS.php' ?>

</head>
<body>
    <?php include 'header.php'?>
    <?php
        $mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");
    
        $allauctions = array();
        //Select all auctions
        $result2 = $mysqli->query("SELECT * FROM `auction`");
        if($result2->num_rows > 0){
            while($row = $result2->fetch_assoc()) {
                $auction=array($row["id_auction"],$row["id_seller"],$row["id_buyer"],$row["id_item"],$row["price"],$row["status"],$row["date"]);
                $allauctions[]=$auction;
            }
        }

        $nbAuctions = count($allauctions);

        for($i=0;$i<$nbAuctions;$i++){
            $currentId = $allauctions[$i][0];
            $actualDate = date("Y-m-d");
            $actualDate = date_create($actualDate);
            $dateauction = date_create($allauctions[$i][6]);
            $diff = date_diff($actualDate, $dateauction);//Diff > 0 if auction not finished
            if($diff->format('%R%a days')<0){
                $mysqli->query("UPDATE `auction` SET `status`='finished' WHERE `id_auction`='$currentId' ");
            }
        }


        $allProducts = array();
        //Select all products
        $result = $mysqli->query("SELECT * FROM `items` WHERE `category`='equipment'");
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                if($row["type_of_selling"] == "auction"){
                    $iditemauction = $row["id"];
                    $checkstatus = $mysqli->query("SELECT `status` FROM `auction` WHERE `id_item`='$iditemauction' ");
                    if($checkstatus->num_rows > 0){
                        while($row2 = $checkstatus->fetch_assoc()){
                            if($row2["status"] == "inprogress"){
                                $product=array($row["id"],$row["name"],$row["photo1"],$row["price"],$row["description"],$row["quantity"],$row["type_of_selling"]);
                                $allProducts[]=$product;
                            }
                        }
                    }
                }else{
                    $product=array($row["id"],$row["name"],$row["photo1"],$row["price"],$row["description"],$row["quantity"],$row["type_of_selling"]);
                    $allProducts[]=$product;
                }
            }
        }
        $nbProducts = count($allProducts);
    ?>

    <h1>Equipments</h1>
    <div  class="filter_item_categories_bloc">
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
                        <div id="selecteur_of_price_block" hidden><input class="range" type="range" name="max_price_value" id="max_price_value" value="0" step="5" min="0" max=""><output></output>$</div></td>
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
                 if($nbProducts > 0){ 
                     for ($row = 0; $row < $nbProducts ; $row++) {
                        // If quantity > 0
                        if($allProducts[$row][5]>0){
                         $photo = "../itemImages/".$allProducts[$row][2];
                         $linkproduct = "productPage.php?idproduct=".$allProducts[$row][0];
                         echo "<div class='one_table_of_items'><table  class='table_of_items' border=1>";
                         echo "<tr>";
                         echo "<td rowspan=5 id='picture_item'><a  class='link_for_article' href='$linkproduct'><img src=$photo width=300 height=300></a></td>";
                         echo "<td class='raw_table_items_list' id='title_item'>".$allProducts[$row][1]."</td></tr>";
                         echo "<tr><td class='raw_table_items_list'  id='prix_item'><b>Price : </b><span id='nuber_price_item'>$".$allProducts[$row][3]."</span></td></tr>";
                         echo "<tr><td class='raw_table_items_list' id='type_item'>Type : <em>".$allProducts[$row][6]."</em></td></tr>";
                         echo "<tr><td class='raw_table_items_list' id='quantity_item'><span style='text-decoration:overline;'>Quantity</span>  <br><span style='text-decoration:underline;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp".$allProducts[$row][5]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp&nbsp</span></td></tr>";
                         echo "<tr><td class='raw_table_items_list' id='description_item'>".$allProducts[$row][4]."</td></tr>";
                         echo "</table></div>";
                        }
                     } 
                 }
             ?>
        </div>
    </div>



    <?php include 'footer.php'?>
    
</body>
</html>