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
session_start();
##ADD PRODUCT TO CART
if(isset($_POST['add_to_cart'])){
    echo "add_to_cart ";
    echo $_POST['add_to_cart'];
    $user_id=$_SESSION['ID'];
    $product_id=$_POST['id'];
    date_default_timezone_set('Europe/Athens');
    $dateofinsertion = date('Y-m-d');                
    $mysql="INSERT INTO `carts` (`ID`, `USERID`, `PRODUCTID`, `DATEOFINSERTION`) VALUES (NULL, '$user_id', '$product_id', '$dateofinsertion');";
    #$mysql="DELETE FROM users WHERE ID = ".$_POST['delete'];
    mysqli_query($connection,$mysql);
   


}





##SEARCH FOR PRODUCT
if(isset($_POST['search'])){
    //echo "search ";
    //echo $_POST['search'];
    //echo $_POST['search_in'];
    $search_input=$_POST['search_in'];
    //echo "i am inside search ";
    $mysql="SELECT * FROM products WHERE (`NAME` LIKE '%".$search_input."%') OR (`PRODUCTCODE` LIKE '%".$search_input."%') OR (`SELLERNAME` LIKE '%".$search_input."%') OR (`DATEOFWITHDRAWAL` LIKE '%".$search_input."%') OR (`CATEGORY` LIKE '%".$search_input."%')";
    $result=mysqli_query($connection,$mysql);
    while($row = mysqli_fetch_array($result)) {
        echo '<item_box>';
        echo   "id:".$row['ID']."<br/>product name:".$row['NAME']."<br/>product code:".$row['PRODUCTCODE']."<br/>price:".$row['PRICE']."$"."<br/>product Category:".$row['CATEGORY']."<br/>product seller:".$row['SELLERNAME']."<br/>DOW:".$row['DATEOFWITHDRAWAL']; 
        echo '<button type="button" id ="add_to_cart"  value = '.$row['ID'].'>Add To Cart '.$row['NAME'].'</button>';
        
        echo "<br/>";
        echo '</item_box>';
    }
    #printData($result,$connection);
    #$mysql="DELETE FROM users WHERE ID = ".$_POST['delete'];
    #mysqli_query($connection,$mysql);
   


}
if(!isset($_POST['search'])){
##PRINT DATA AND NESSESARY BUTTONS

$mysql="SELECT * FROM products ";
$result=mysqli_query($connection,$mysql);
while($row = mysqli_fetch_array($result)) {
    echo '<item_box>';
    echo   "id:".$row['ID']."<br/>product name:".$row['NAME']."<br/>product code:".$row['PRODUCTCODE']."<br/>price:".$row['PRICE']."$"."<br/>product Category:".$row['CATEGORY']."<br/>product seller:".$row['SELLERNAME']."<br/>DOW:".$row['DATEOFWITHDRAWAL']; 
    echo '<button type="button" id ="add_to_cart"  value = '.$row['ID'].'>Add To Cart '.$row['NAME'].'</button>';
    
    echo "<br/>";
    echo '</item_box>';
}
}

  

?>