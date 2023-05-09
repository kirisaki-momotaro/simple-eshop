<?php
function updateUser(){
    echo '<div class="container">   
    <label>Name : </label>   
    <input type="text" placeholder="Enter New User Name" id="uname" >  
    <label>Surname : </label>   
    <input type="text" placeholder="Enter New surname " id="usurname" >  
    <label>Username : </label>   
    <input type="text" placeholder="Enter New Username" id="uusername" >  


    <label>EMAIL : </label>   
    <input type="text" placeholder="Enter New Email" id="umail" >  
    
    
    


    <button type="button" id = "updateuser">Update User</button> 
    <div class="cancel">
    <button type="button" name = "ucancel" >Cancel</button>  
    </div>
    
    
    
    
   
</div>   ';
}


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

session_start();
if(isset($_POST['delete'])){
    echo "delete ";
    echo $_POST['delete'];
    $mysql="DELETE FROM users WHERE ID = ".$_POST['id'];
    mysqli_query($connection,$mysql);
   


}
##CONFIRM USER
if(isset($_POST['confirm'])){
    echo "confrim ";
    echo $_POST['confirm'];
    $mysql="UPDATE users
    SET CONFIRMED = 1
    WHERE ID =" .$_POST['id'];
    mysqli_query($connection,$mysql);


}
if(isset($_POST['updateuser'])){
    echo "updateuser ";
    echo $_POST['updateuser'];
    
    

    ## GET ID OF THE USER TO UPDATE FROM PRESSED BUTTON AND DRAW IT'S DATA FROM THE DATABASE
    
    $update_id = $_SESSION['change_id'];
    echo $update_id;
    $mysql="SELECT * FROM users WHERE ID='$update_id'";
    $result=mysqli_query($connection,$mysql);
    $row = mysqli_fetch_array($result);
   
    ##DRAW IT'S DATA FROM THE DATABASE
    $name=$row['NAME'];
    $surname=$row['SURNAME'];
    $username=$row['USERNAME'];
    $mail=$row['EMAIL'];
    ##DRAW IT'S DATA FROM THE DATABASE

    ## GET INPUT FORM DATA
    $uname=$_POST['uname'];
    $usurname=$_POST['usurname'];
    $uusername=$_POST['uusername'];
    $umail=$_POST['umail'];
    
    ## UPDATE ONLY THE ONES WHOOSE INPUT FIELD ISNT EMPTY
    if($uname!="" and $uname!=NULL)  {
        $name=$uname;
    }
    if($usurname!="" and $usurname!=NULL)  {
        $surname=$usurname;
    }
    if($uusername!="" and $uusername!=NULL)  {
        $username=$uusername;
    }
    if($umail!="" and $umail!=NULL)  {
        $mail=$umail;
    }

    $mysql="UPDATE users
    SET 
    NAME = '$name', 
    SURNAME = '$surname', 
    USERNAME = '$username',
    EMAIL= '$mail'
    WHERE ID ='$update_id'";
    mysqli_query($connection,$mysql);
    
   
    
   
    


}
if(isset($_POST['change'])){
    echo "change ";
    echo $_POST['change'];    
    $_SESSION['change_id'] = $_POST['id'];
    updateUser();
    


}

$mysql="SELECT * FROM users ";
$result=mysqli_query($connection,$mysql);
while ($row = mysqli_fetch_array($result)) {
    echo '<item_box>';
    echo "id:" . $row['ID'] . "<br/>user name:" . $row['NAME'] . "<br/>user surname:" . $row['SURNAME'] . "<br/>username:" . $row['USERNAME'] . "<br/>user mail:" . $row['EMAIL'] . "<br/>user role:" . $row['ROLE'];
    echo '<button type="button" id ="delete"  value = ' . $row['ID'] . '>Delete ' . $row['NAME'] . '</button>';

    echo '<button type="button" id="change" value = ' . $row['ID'] . '>Change info ' . $row['NAME'] . '</button>';

    if ($row['CONFIRMED'] == 0) {
        echo '<button type="button" id="confirm" value = ' . $row['ID'] . '>Confirm ' . $row['NAME'] . '</button>';
    }
    echo "<br/>";
    echo '</item_box>';
    ############CONNECT TO DATABASE #########
}

?>