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

#DELETE ITEM
if(isset($_POST['delete'])){
    echo "delete ";
    echo $_POST['delete'];
    $mysql="DELETE FROM carts WHERE ID = ".$_POST['id'];
    mysqli_query($connection,$mysql);
    


}
#PRINT THE CART'S PRODUCTS 

    $mysql="SELECT carts.ID ,carts.PRODUCTID,carts.USERID,carts.PRODUCTID,carts.DATEOFINSERTION,products.NAME,products.PRODUCTCODE,products.PRICE,products.DATEOFWITHDRAWAL,products.SELLERNAME,products.CATEGORY FROM carts 
    INNER JOIN products ON carts.PRODUCTID=products.ID WHERE USERID=".$_SESSION['ID'] ;
    $result=mysqli_query($connection,$mysql);
    $total_price=0;
    while($row = mysqli_fetch_array($result)) {
        $total_price += $row['PRICE'];
        echo '<item_box>';
        echo  "id:".$row['PRODUCTID']."<br/>product name:".$row['NAME']."<br/>price:".$row['PRICE']."$" ; 
        echo '<button type="button" id ="delete"  value = '.$row['ID'].'>Remove From Cart'.'</button>';
        
        
        echo "<br/>";
        echo '</item_box>';
    }
    echo "<center><h1> Total price is : $total_price $</h1></center>"
  
?>