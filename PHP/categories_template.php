<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit.net | Categorie - Equipement</title>
	<link rel="icon" type="image/png" href="../Images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="../CSS/categorie.css">
</head>
<body>
	<?php include 'categories_header.php'?>

	<h1>Equipments</h1>
	<div>
		<form class="filter_form">
			<div class="title_filter">
				<img src="../Images/logo_filtre.png" width="18" height="auto">
				<label for="filter"><u>Filters by: </u></label>	
			</div>
			<table>
				<tr>
					<td>
						<label class="label_filter">All</label>
					</td>
					<td>
						<input class="radio_button_filter" type="radio" name="filter" value="All">
					</td>				
				</tr>
				<tr>
					<td><label class="label_filter" for="max_price_value">Max Price : <?php $p1=$_GET["max_price_value"]; if($p1=="")$p1=0; echo "$p1"; ?></label></td>
					<td><input class="radio_button_filter" type="radio" name="filter" value="Max Price">	
						<input class="max_price_range" type="range" name="max_price_value" value="0" min="0" max="250" ></td>
				</tr>
				<tr>
					<td><label class="label_filter">Name</label></td>
					<td><input class="radio_button_filter" type="radio" name="filter" value="Name"></td>
				</tr>
			</table>
	    </form>
		<div>
				
		</div>			


	</div>
    <?php include 'footer.php'?>
</body>
</html>