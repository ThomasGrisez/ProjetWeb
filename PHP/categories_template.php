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
	<form>
		<label for="filter">Filters by: </label>	
		<div>
			<label>All</label>
			<input type="radio" name="filter" value="All">
		</div>
		<div>
			<label>Max Price</label>
			<input type="radio" name="filter" value="Max Price">
			<input type="range" name="filter" min="0" max="250" >
		</div>
		<div>
			<label>Name</label>
			<input type="radio" name="filter" value="Name">
		</div>


	</form>


    <?php include 'footer.php'?>
</body>
</html>