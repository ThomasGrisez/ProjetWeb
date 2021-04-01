<?php echo'<style type="text/css">

/*Change scroll bar aspect*/ 
::-webkit-scrollbar-track {
    background-color: #F5F5F5;
}

::-webkit-scrollbar {
    height: 6px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb {
    background-color: #3d4852;
    border-radius: 3px;
}

/*CART ASPECT*/
.button_suppr_from_cart{
	background-color :  white;
	color : black; 
	font-size : 20px;
	font-weight : bold; 
	border: 1px black solid;
	border-radius : 50px; 
	height : 80px;
	text-align : center; 
}

.button_suppr_from_cart:hover{
	cursor : pointer; 
	color : white;
	background-color : black;
	border-color : black;  
}

.one_item_in_the_cart{
	display: flex; 
	align-items : center; 
	padding : 10px 0px 5px 0px; 
	width : 500px; 
	border-bottom : 1px rgba(0, 0, 0, 0.1) solid; 
}

.caracteristic_item_list{
	font-size : 25px; 
}

.div_of_div_of_div{
	padding : 20px 0px 30px 150px; 
}

.main_div_for_cart{
	display : flex; 
	justify-content : space-between; 
	align-items : flex-start; 
}

.validate_my_cart_button_bloc{
	padding-top : 150px; 
}

.button_for_go_to_the_checkout{
	padding: 10px 140px 10px 140px; 
	font-family: lato; 
	text-align: center;
	border-radius: 4px; 
	color : white;
	border-color: #D86B27;
	background-color: #D86B27; 
}


.button_for_go_to_the_checkout:hover{
	background-color: #B44500; 
	cursor: pointer; 
}

</style>';

?>