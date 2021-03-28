<?php if(session_status() == PHP_SESSION_NONE){
			session_start();
		}
?>

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


	/*For the list of items================*/
        .table_of_items{
        	padding-bottom : 5px; 
        	background-color : #EFEFEF; 
             margin: 0 auto;
             width: 900px;
             border : none;
             border-bottom :  1px solid black;  
        }

        .raw_table_items_list{
        	padding-left : 20px; 
		border: none; 
		overflow: hidden; 
		width: 100%; 
        }

        #picture_item{
        	border : 1px grey solid; 
    	}

         #title_item{
        	height : 10%;
     	    color : #0F00F; 
        	font-weight : bolder; 
        	font-size : 35px; 
    	}

    	#prix_item{
    		font-size : 20px; 
    		height :10%;
    	}

    	#nuber_price_item{
    		color : #D86B27;
    		font-weight : bold;  
    	}

    	#quantity_item{
    		height : 20%; 

    	}

    	#type_item{
    		height : 7%; 
    	}

    	#description_item{
    	padding-top : 10px;
    	font-size : 15px; 
    		display : flex; 
    		align-items : flex-start;  
    	}


        .link_for_article{
        	text-decoration : none; 
        	color : black; 
 	   }




 	   /*For a specific item============================== */
       .table_of_item_bloc{
            padding-bottom : 40px; 
       }


 	   .table_of_item{
 	   		padding-bottom : 1px; 
        	background-color : #EFEFEF; 
            border : none;
            border-bottom :  1px solid black;  
 	   }

 	   #title_of_an_item{
 	    	height : 2%;
        	color : #0F00F; 
        	font-weight : bolder; 
        	font-size : 45px; 
 		}
 		#prix_of_an_item{
		font-size : 30px; 
    		height :1%;
 		}

 		#type_item_an_item{
		font-size : 22px; 
    		height :2%;
 		}

 		#quantity_of_an_item{
		height : 2%; 
 		}


        #paybutton{
            height : 7%; 
            border-bottom: 1px grey solid;
        }

 		#description_of_an_item{
            height : 200%;
 			padding-top : 10px;
    		font-size : 15px; 
    		display : flex; 
    		align-items : flex-start;  
 		}

        .add_to_cart{
            padding: 10px 20px 10px 20px; 
            font-family: lato; 
            text-align: center;
            border-radius: 4px; 
            color : white;
            border-color: #D86B27;
            background-color: #D86B27; 
          
        }

        .add_to_cart:hover{
            background-color: #B44500; 
            cursor: pointer; 
            animation: shake 0.4s ease-out;
        }
        @keyframes shake {
        0% {
             transform: skewX(-10deg);
              }
        25% {
           transform: skewX(10deg);
              }
    
        50% {
            transform: skewX(-10deg);
            }
       75% {
            transform: skewX(10deg);
            }
        100% {
            transform: skewX(-10deg);
            }
        }
        input[type=number]{
        left: 10px;
        top: 10px;
        width: 50px;
        height: 30px;
        padding: 0px;
        font-size: 14pt;
        border: solid 0.5px #000;
        z-index: 1;

        </style>';

?>