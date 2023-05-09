<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>  
    //jQuery LIBRARY IS UTILISED BELLOW
    //AJAX CALL TO PRINT THE INITIAL DATA FROM THE DATABASE   
    $(document).ready(function(){
        $.ajax({url: "products_data.php", success: function(result){
        $("#db_items").html(result);
        }});
    });
    //LISTEN FOR BUTTON CLICKS AND IN CASE OF CLICK RECOGNISE OPERATION AND SENT THE APPROPRIATE POST REQUEST/DATA TO THE SERVER
    $(document).on("click", "button",function() {
        
        var operation =$(this).attr('id');
        var id_value=$(this).attr("value");
        var search_in = $("#search_in").val();
        //alert(operation);
        //alert(id_value); 
        if(operation=='add_to_cart'){
            $.ajax({type :"POST",url: "products_data.php",data:{add_to_cart : operation, id : id_value}, success: function(result){
            $("#db_items").html(result);
        }});
        }
        else if(operation=='search'){   
            //alert(search_in);        
            $.ajax({type :"POST",url: "products_data.php",data:{search : operation,search_in:search_in}, success: function(result){
            $("#db_items").html(result);
        }});
        }
        else{
            $.ajax({type :"GET",url: "products_data.php", success: function(result){
            $("#db_items").html(result);
        }});
        }
    });
    
    </script>
</head>
<body>


<form method="post">  
    <?php

    session_start();
    #CHECK IF THE USER IS SIGHNED IN ELSE REDIRECT TO INDEX PAGE
    if(!isset($_SESSION['name']) or !isset($_SESSION['surname']) or !isset($_SESSION['role'])){
        header("Location: index.php");
        exit;
    }
    ################## BUTTON EVENTS ########################
    if(isset($_POST['logout'])){
        header("Location: index.php");  
        session_destroy();         
        exit;


    }
    

    if(isset($_POST['cart'])){
        header("Location: cart.php");        
        exit;


    }
    
    ################## BUTTON EVENTS ########################



    ?>
    <div class ="right_place">
    <div class="container">   
            <label><?php 
            ##DISPLAY USER DATA
            echo "welcome :".$_SESSION['name']." ".$_SESSION['surname']." role:".$_SESSION['role'];
            
            ?></label>       
            
            
                
            <button type="submit" name = "logout">Logout</button>  
            <?php
            ## CHECK THAT THE CORRECT TYPE OF USER IS ACCESSING THIS PAGE ELSE REDIRECT
            if($_SESSION['role'] !="USER"){
                if($_SESSION['role']=="PRODUCTSELLER" or $_SESSION['role']=="ADMIN"){
                    header("Location: welcome.php");        
                    exit;
                }else{
                    header("Location: index.php");        
                    exit;
                }
            }
             ?> 
                  
    </div>  
    </div>
    
    <div class ="left_place">
    <div class="container">          
            <button type="submit" name = "cart">Cart</button>     
        </div>
    </div>      
    </div>  

    
        <div class="container">   
        <center><img src="HMMYzonsmallsmall.png"  alt="HMMYzon"></center> 
        </div>
        <label>Search : </label>   
            <input type="text" placeholder="Enter product info" id="search_in" > <button type="button" id="search" >Search</button>
        <item_box>
            <header> PRODUCTS </header>
        </item_box>
        
        <div id="db_items">db info will be listed here...</div>
            
</form>    
            
           
          
</body>
</html>