<?php echo'<style type="text/css">

/*Change scroll bar aspect===================*/ 
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
	.one_table_of_items{
		padding-bottom : 20px; 
	}


/*CSS FOR INFORMATIONS PROFILE =============*/
.main_aspect_of_profile_bloc{
	margin : 0 auto;
    padding-right: 20%;
	padding-left: 20%; 
	padding-bottom : 60px; 
	display : flex; 
}

.main_aspect_of_profile_bloc1{
	margin : 0 auto;
    padding-right: 30%;
	padding-left: 30%; 
	padding-bottom : 60px; 
}


.profile_image_bloc{
	padding-left : 20%; 
}

.main_title{
	 color : #D86B27;
	 font-size: 35px;
}

.list_of_informations{
	font-size : 18px; 
	padding-left : 60px; 
}
 
.lis_of_information_title{
	font-weight : bold; 
	color : #2B2B2B; 
}

.bloc_information_of_buyer{
	padding-bottom : 20px; 
 }



/*CSS FOR ITEM BUY ===============*/

.one_table_of_items{ 		
	padding-left : 60px; 
	display : flex; 
	flex-wrap : wrap;
	justify-content : flex-start; 
	padding-top : 10px; 
}

.table_of_items{
    padding-bottom : 5px; 
    border : none; 
    padding-left : 10px;
    padding-right : 20px;  
    width : 150px; 
}

.table_of_differnets_items{
	 border : none; 
}

.div_for_border_in_table{

  border-right : 1px solid grey;  
}

.raw_table_items_list{
	border: none; 
	overflow: hidden; 

}


#price_item, #quantity_item, last_tr_of_table_item2{
	text-align : center; 
	font-weight : bold;  


}
#title_item{
	font-weight : bold;
	font-size : 19px; 
}


#last_tr_of_table_item1{
	border-bottom : 1px solid black; 
}


#last_tr_of_table_item2{
	border-bottom : 1px solid black; 
	padding-bottom : 10px; 
}

#last_tr_of_table_item3{
	padding-bottom : 10px; 
}

/*CSS FOR BUTTONS ON BUYER PROFILE======= */
#bloc_button_buyer_profil{
	display : flex; 
	padding-right : 70px;  
	padding-left : 40%; 
}

.button_list_buyer_profil{
	padding-right : 10px; 
	padding-bottom : 40px; 
}

.button_of_informations{
	text-align : center; 
	font-size : 17px; 
}

.link_for_buttons_buyer_profil{
	text-decoration : none; 
}

#edit_information_buyer{
	padding: 10px 20px 10px 20px; 
	font-family: lato; 
	text-align: center;
	border-radius: 4px; 
	color : white;
	border-color: #D86B27;
	background-color: #D86B27; 

}

#edit_information_buyer:hover{
	background-color: #B44500; 
	cursor: pointer; 
}

#logout_information_buyer{
	padding: 10px 20px 10px 20px; 
	font-family: lato; 
	text-align: center;
	border-radius: 4px; 
	color : #D86B27;
	border-color:  #D86B27;
	background-color: white; 
}

#logout_information_buyer:hover{
	background-color: #823200; 
	border-color :#823200; 
	color : white;
	cursor: pointer; 
}

.button_add_to_list_an_item{

	padding-right : 20px; 
}
#button_for_see_our_item_as_a_seller{
	padding-left : 40%; 
}

#add_an_item_to_sell{
	padding: 5px 10px 5px 10px; 
	font-family: lato; 
	text-align: center;
	border-radius: 4px; 
	color : #D86B27;
	border-color:  #D86B27;
	background-color: white; 
}

#add_an_item_to_sell:hover{
	background-color: #D86B27; 
	border-color :#D86B27; 
	color : white;
	cursor: pointer;
}


 </style>';

?>