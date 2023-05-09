<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>seller</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script> 
    //jQuery LIBRARY IS UTILISED BELLOW
    //AJAX CALL TO PRINT THE INITIAL DATA FROM THE DATABASE    
    $(document).ready(function(){
        $.ajax({url: "seller_data.php", success: function(result){
        $("#db_items").html(result);
        }});
    });
    //LISTEN FOR BUTTON CLICKS AND IN CASE OF CLICK RECOGNISE OPERATION AND SENT THE APPROPRIATE POST REQUEST/DATA TO THE SERVER
    $(document).on("click", "button",function() {
        
        var operation =$(this).attr('id');
        var id_value=$(this).attr("value");
        //alert(operation);
        //alert(id_value); 
        if(operation=='delete'){
            $.ajax({type :"POST",url: "seller_data.php",data:{delete : operation, id : id_value}, success: function(result){
            $("#db_items").html(result);
        }});
        }
        else if(operation=='change'){
            //alert(operation);
            $.ajax({type :"POST",url: "seller_data.php",data:{change : operation,id:id_value}, success: function(result){
            $("#db_items").html(result);
        }});
        }else if(operation=='updateproduct'){
            //alert(operation);
            var uname = $("#uname").val();
            var uproductcode = $("#uproductcode").val();
            var uprice = $("#uprice").val();
            var ucategory = $("#ucategory").val();
            $.ajax({type :"POST",url: "seller_data.php",
                data:{updateproduct : operation,
                    uname :uname,
                    uproductcode:uproductcode,
                    uprice:uprice,
                    ucategory:ucategory
                }
            , success: function(result){
            $("#db_items").html(result);
        }});
        }
        else if(operation=='additem'){
            //alert(operation);
            $.ajax({type :"POST",url: "seller_data.php",data:{additem : operation}, success: function(result){
            $("#db_items").html(result);
        }});
        }else if(operation=='addproduct'){
            //alert(operation);
            var name = $("#name").val();
            var productcode = $("#productcode").val();
            var price = $("#price").val();
            var category = $("#category").val();
            $.ajax({type :"POST",url: "seller_data.php",
                data:{addproduct : operation,
                    name :name,
                    productcode:productcode,
                    price:price,
                    category:category
                }
            , success: function(result){
            $("#db_items").html(result);
        }});
        }
        else{
            $.ajax({type :"GET",url: "seller_data.php", success: function(result){
            $("#db_items").html(result);
        }});
        }
    });
    
    </script>
</head>
<body>









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
    
    
    if(isset($_POST['cancel'])){
        echo "cancel item add/update";
       

    }        
    ################## BUTTON EVENTS ########################



    ?>

<form method="post">  
    
    <div class ="right_place">
    <div class="container">   
            <label><?php 
            echo "welcome :".$_SESSION['name']." ".$_SESSION['surname']." role:".$_SESSION['role'];
            
            ?></label>       
            
            
                
            <button type="submit" name = "logout">Logout</button>  
            <?php
            ## CHECK THAT THE CORRECT TYPE OF USER IS ACCESSING THIS PAGE ELSE REDIRECT
            if($_SESSION['role'] !="PRODUCTSELLER"){
                if($_SESSION['role']=="ADMIN" or $_SESSION['role']=="USER"){
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
    
    
        <div class="container">   
        <center><img src="HMMYzonsmallsmall.png"  alt="HMMYzon"></center> 
        </div>
        <?php 
                
                

            ?>
        <item_box>
            <header> Products of seller <?php echo $_SESSION['username'] ?> </header>
        </item_box>


        <button type="button" id="additem" value ="add" >Add new item</button>
        <div id="db_items">db info will be listed here...</div>
        
        
        
        
            
</form>    
            
           
          
</body>
</html>