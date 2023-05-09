<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
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
    if(isset($_POST['administration'])){
        header("Location: administration.php");        
        exit;


    }
    if(isset($_POST['seller'])){
        header("Location: seller.php");        
        exit;


    }
    if(isset($_POST['cart'])){
        header("Location: cart.php");        
        exit;


    }
    if(isset($_POST['products'])){
        header("Location: products.php");        
        exit;


    }
    ################## BUTTON EVENTS ########################


    ?>
    <div class ="right_place">
    <div class="container">   
            <label><?php 
            #PRINT USER INFO
            echo "welcome :".$_SESSION['name']." ".$_SESSION['surname']." role:".$_SESSION['role'];
            
            ?></label>       
            
            
                
            <button type="submit" name = "logout">Logout</button>  
                  
    </div>  
    </div>
    
    <div class ="left_place">
    <div class="container">  
    <div class="dropdown">
            <button class="dropbtn">Menu</button>
            <div class="dropdown-content">
            <?php
            
            ## SHOW APPROPRIATE PAGES TO EACH ROLE 
            if($_SESSION['role'] =="ADMIN"){
                echo '<button type="submit" name = "administration">Administration</button>  
                
                  ';
            }else if($_SESSION['role'] =="PRODUCTSELLER"){
                echo '   <button type="submit" name = "seller">Seller Page</button> ';
            }else{
                echo '<button type="submit" name = "cart">Cart</button>  
                <button type="submit" name = "products">Products</button>  ';
            } ?> 
            
            </div>
        </div>
    </div>      
        </div>       
        <div class="container">   
        <center><img src="HMMYzonsmallsmall.png"  alt="HMMYzon"></center> 
        </div>
        
</form>    
            
           
          
</body>
</html>