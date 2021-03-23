<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../Images/favicon.png" />
    <?php include '../CSS/equipmentsCSS.php' ?>
</head>
<body>

<?php
    if(session_status() == PHP_SESSION_NONE){session_start();}
    
    $mysqli = new mysqli('127.0.0.1','root', '', 'fitnet', NULL) or die("Connect failed");

    $allProducts = array();
    //Select all products
    $result = $mysqli->query("SELECT * FROM `items` WHERE `category`='equipment'");
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            $product=array($row["id"],$row["name"],$row["photo1"],$row["price"],$row["description"],$row["quantity"],$row["type_of_selling"]);
            $allProducts[]=$product;
        }
    }
?>
<?php include 'categories_header.php'?>

<?php
    if($result->num_rows > 0){ 
        for ($row = 0; $row < $result->num_rows ; $row++) {
            $photo = "../itemImages/".$allProducts[$row][2];
            $linkproduct = "productPage.php?idproduct=".$allProducts[$row][0];
            echo "<a href='$linkproduct'>";
            echo "<table border=1>";
            echo "<tr>";
            echo "<td rowspan=5><img src=$photo width=120></td>";
            echo "<td>".$allProducts[$row][1]."</td></tr>";
            echo "<tr><td>Price : ".$allProducts[$row][3]."</td></tr>";
            echo "<tr><td>Quantity : ".$allProducts[$row][5]."</td></tr>";
            echo "<tr><td>Type : ".$allProducts[$row][6]."</td></tr>";
            echo "<tr><td>".$allProducts[$row][4]."</td></tr>";
            echo "</table>";
            echo "</a>";
            
        } 
    }
?>




<?php include 'footer.php'?>
    
</body>
</html>