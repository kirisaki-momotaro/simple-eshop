<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script> 
    //jQuery LIBRARY IS UTILISED BELLOW
    //AJAX CALL TO PRINT THE INITIAL DATA FROM THE DATABASE   
    $(document).ready(function(){
        $.ajax({url: "administration_data.php", success: function(result){
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
            $.ajax({type :"POST",url: "administration_data.php",data:{delete : operation, id : id_value}, success: function(result){
            $("#db_items").html(result);
        }});
        }
        else if(operation=='confirm'){
            $.ajax({type :"POST",url: "administration_data.php",data:{confirm : operation,id:id_value}, success: function(result){
            $("#db_items").html(result);
        }});
        }else if(operation=='change'){
            $.ajax({type :"POST",url: "administration_data.php",data:{change : operation,id:id_value}, success: function(result){
            $("#db_items").html(result);
        }});
        }else if(operation=='updateuser'){
            //alert(operation);
            var uname = $("#uname").val();
            var usurname = $("#usurname").val();
            var uusername = $("#uusername").val();
            var umail = $("#umail").val();
            $.ajax({type :"POST",url: "administration_data.php",
                data:{updateuser : operation,
                    uname :uname,
                    usurname:usurname,
                    uusername:uusername,
                    umail:umail
                }
            , success: function(result){
            $("#db_items").html(result);
        }});
        }
        else{
            $.ajax({type :"GET",url: "administration_data.php", success: function(result){
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
    ################## BUTTON EVENTS ########################



    ?>
    <div class ="right_place">
    <div class="container">   
            <label><?php 
            #DISPLAY CREDENTIALS
            echo "welcome :".$_SESSION['name']." ".$_SESSION['surname']." role:".$_SESSION['role'];
            
            ?></label>       
            
            
                
            <button type="submit" name = "logout">Logout</button>  
            <?php
            #ONLY ADMIN CAN ACCESS THIS PAGE ELSE REDIRECT
            if($_SESSION['role'] !="ADMIN"){
                if($_SESSION['role']=="PRODUCTSELLER" or $_SESSION['role']=="USER"){
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
        
        <item_box>
            <center><header> Users </header></center>
        </item_box>
        
       

        <div id="db_items">db info will be listed here...</div>
        
         
       
        
           
            
</form>    



        
           
          
</body>
</html>