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
		<form class="filter_form" name="form" action="" method="get">
			<div class="title_filter">
				<img src="../Images/logo_filtre.png" width="18" height="auto">
				<label for="filter"><u>Filters by: </u></label>	
			</div>
			<table>
				<tr>
					<td>
						<input class="radio_button_filter" type="radio" name="filter" value="All">
					</td>
					<td>
						<label class="label_filter">All</label>
					</td>				
				</tr>
				<tr>
					<td><input class="radio_button_filter" type="radio" name="filter" value="Max Price"></td>
					<td><label class="label_filter" for="max_price_value">Max Price : </label>
					<input class="max_price_value" type="range" name="max_price_value" id="max_price_value" value="0" step="5" min="0" max="250"></td>
						<?php 
						echo $_GET["max_price_value"]; 
						?>
						
				</tr>
				<tr>
					<td><input class="radio_button_filter" type="radio" name="filter" value="Name"></td>
					<td><label class="label_filter">Name</label></td>
				</tr>
			</table>
	    </form>
		<div>
				
		</div>			


	</div>
    <?php include 'footer.php'?>
</body>
</html>