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
				<input type="submit" value="Filter"	class="filter_select_button">
			</div>
	  	</form>
	</div>
    <?php include 'footer.php'?>
</body>
</html>