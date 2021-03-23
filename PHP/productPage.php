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

    if(isset($_GET['idproduct'])){
        $id=htmlspecialchars($_GET['idproduct']);
        $result = $mysqli->query("SELECT * FROM items WHERE id='$id'");
        if($result->num_rows == 1){
            while($row = $result->fetch_assoc()) {
                $name = $row["name"];
                $photo1 = $row["photo1"];
                $photo2 = $row["photo2"];
                $photo3 = $row["photo3"];
                $price = $row["price"];
                $description = $row["description"];
                $quantity = $row["quantity"];
                $type = $row["type_of_selling"];
            }
        }
    }

?>
<?php include 'categories_header.php'?>

<table border="1">
    <tr>
        <td rowspan="4"><img src="../itemImages/<?= $photo1?>" width=300></td>
        <td><b><?= $name ?></b></td>
        
    </tr>
    <tr><td>Price : <?= $price ?></td></tr>
    <tr><td>Quantity : <?= $quantity ?></td></tr>
    <tr><td><?= $type ?></td></tr>
    <tr>
        <?php
            if($photo2 != "" && $photo3 ==""){?>
                <td><img src="../itemImages/<?= $photo1?>" width=50><img src="../itemImages/<?= $photo2?>" width=50></td>
            <?php
            }
            if($photo2 != "" && $photo3 != ""){?>
                <td><img src="../itemImages/<?= $photo1?>" width=50><img src="../itemImages/<?= $photo2?>" width=50><img src="../itemImages/<?= $photo3?>" width=50></td>
            <?php
            }  
        ?>
    </tr>
    <tr><td colspan="2"><?= $description ?></td></tr>
</table>

<?php include 'footer.php'?>
    
</body>
</html>