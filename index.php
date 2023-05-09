<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <center><img src="HMMYzonsmall.png" alt="HMMYzon"></center>
<center> <h1><font color="red">THE ULTIMATE SHOP FOR HMMY TUC STUDENTS!!!</font>   </h1> </center>   
    <form method="post">  
        <?php
            session_start();

            ############CONNECT TO DATABASE #########
            $site_name="localhost";
            $user_name="root";
            $pass_name="";
            $db_name="online_shop";

            $connection=mysqli_connect($site_name,$user_name,$pass_name,$db_name);

            if($connection==false){
                echo "connection failed <br/>";
            }else{
                echo "connection success <br/>";
            }
            ############CONNECT TO DATABASE #########
            $info="";
            
            ################## BUTTON EVENTS ########################
            if(isset($_POST['signup'])){
                header("Location: signup.php");
                exit;
 

            }
            if(isset($_POST['login'])){
                ## CHECK IF CREDENTIALS ARE VALID, IF THEY ARE CREATE SESSION VARIABLES OF USER DATA AND REDIRECT TO WELCOME PAGE
                $username=$_POST['username'];
                $password=$_POST['password'];
                $mysql="SELECT * FROM users WHERE USERNAME= '$username' AND PASSWORD='$password'";
                $result=mysqli_query($connection,$mysql);
                if(mysqli_num_rows($result) != 0){
                    echo "user exists <br/>";
                    $row = mysqli_fetch_array($result);
                    $_SESSION['ID']=$row['ID'];
                    $_SESSION['name']=$row['NAME'];
                    $_SESSION['surname']=$row['SURNAME'];
                    $_SESSION['username']=$row['USERNAME'];
                    $_SESSION['role']=$row['ROLE'];
                    $_SESSION['confirmed']=$row['CONFIRMED'];
                    ##CHECK IF USER IS CONFIRMED,ELSE REDIRECT TO REDIRECT PAGE
                    if($_SESSION['confirmed']!=1){
                        
                        
                        session_destroy();
                        header("Location: user_not_confirmed.php");                                               
                        exit;




                    }
        
                    $info=  $_SESSION['ID'];
                    header("Location: welcome.php");
                    exit;
                }
                if(mysqli_num_rows($result) == 0){
                   $info= "user doesn't exist <br/>";

                }
                
               
            }
            ################## BUTTON EVENTS ########################
           
        ?>
        
        <label><?php echo $info; ?></label> 
        <div class="container">   
            <label>Username : </label>   
            <input type="text" placeholder="Enter Username" name="username" >  
            <label>Password : </label>   
            <input type="password" placeholder="Enter Password" name="password" >  
            <button type="submit" name = "login">Login</button>  
            <button type="submit" name = "signup">Sign Up</button> 
            
            
            
            
           
        </div>   
    </form>     
</body>
</html>