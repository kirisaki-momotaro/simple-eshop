<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<form method="post">  

<?php
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
            if(isset($_POST['cancel'])){
                header("Location: index.php");
                exit;
 

            }
            if(isset($_POST['signup'])){
                ## GET INFO FROM FORM
                $name=$_POST['name'];
                $surname=$_POST['surname'];
                $mail=$_POST['mail'];
                $username=$_POST['username'];
                $password=$_POST['password'];
                $role=$_POST['role'];
                
                ##CHECK IF USER ALREADY EXISTS
                $mysql="SELECT * FROM users WHERE USERNAME= '$username' AND PASSWORD='$password'";
                $result=mysqli_query($connection,$mysql);
                if(mysqli_num_rows($result) != 0){
                    echo "user already exists <br/>";
                    
                }
                ## IF USER DOES NOT EXIST CREATE USER ACCORDING TO INPUTED FORM DATA AND REDIRECT TO INDEX PAGE FOR LOG IN
                if(mysqli_num_rows($result) == 0){
                   $info= "creating user <br/>";
                   $mysql="INSERT INTO `users` (`ID`, `NAME`, `SURNAME`, `USERNAME`, `PASSWORD`, `EMAIL`, `ROLE`, `CONFIRMED`) VALUES (NULL, '$name', '$surname', '$username', '$password', '$mail', '$role', '0');";
                   $result=mysqli_query($connection,$mysql);
                   header("Location: index.php");
                   exit;
                }
                
               
            }
            ################## BUTTON EVENTS ########################
           
        ?>

<center><img src="HMMYzonsmall.png" alt="HMMYzon"></center>
<center> <h1><font color="black">Sign Up</font>   </h1> </center>     
    <div class="container">   
            <label>Name : </label>   
            <input type="text" placeholder="Enter Name" name="name" >  
            <label>Surname : </label>   
            <input type="text" placeholder="Enter Surname" name="surname" >  
            <label>Mail : </label>   
            <input type="text" placeholder="Enter Mail" name="mail" >  


            <label>Username : </label>   
            <input type="text" placeholder="Enter Username" name="username" >  
            <label>Password : </label>   
            <input type="password" placeholder="Enter Password" name="password" > 
            
            <label>Role : </label> 
            <select name="role" id="role">
                <option value="ADMIN">Admin</option>
                <option value="PRODUCTSELLER">Seller</option>
                <option value="USER">User</option>                
            </select>


            <button type="submit" name = "signup">Sign Up</button> 
            <div class="cancel">
            <button type="submit" name = "cancel" >Cancel</button>  
            </div>
            
            
            
            
           
        </div>   
</form>
</body>
</html>