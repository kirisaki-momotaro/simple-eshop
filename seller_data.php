<?php  
 

  ##DISPLAY FORM FOR NEW PRODUCT CREATION FUNCTION
function addItem(){
    echo '<div class="container">   
    <label>Name : </label>   
    <input type="text" placeholder="Enter Product Name" id="name" >  
    <label>Product Code : </label>   
    <input type="text" placeholder="Enter Product Code " id="productcode" >  
    <label>Price : </label>   
    <input type="text" placeholder="Enter price" id="price" >  


    <label>Category : </label>   
    <input type="text" placeholder="Enter Category" id="category" >  
    
    
    


    <button type="button" id = "addproduct">Add Product</button> 
    <div class="cancel">
    <button type="button" name = "cancel" >Cancel</button>  
    </div>
    
    
    
    
   
</div>   ';
}
#DISPLAY FORM FOR PRODUCT DATA UPDATE FUNCTION
function updateItem(){
    echo '<div class="container">   
    <label>Name : </label>   
    <input type="text" placeholder="Enter Product Name" id="uname" >  
    <label>Product Code : </label>   
    <input type="text" placeholder="Enter Product Code " id="uproductcode" >  
    <label>Price : </label>   
    <input type="text" placeholder="Enter price" id="uprice" >  


    <label>Category : </label>   
    <input type="text" placeholder="Enter Category" id="ucategory" >  
    
    
    


    <button type="button" id = "updateproduct">Update Product</button> 
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
############CONNECT TO DATABASE #########

session_start();
## MAKE REQUESTED INPUT FIELDS APPEAR FOR PRODUCT CREATION/UPDATE
if(isset($_POST['additem'])){
    echo "additem ";
    echo $_POST['additem'];
    addItem();
    } 
##ADD NEW PRODUCT
if(isset($_POST['addproduct'])){
    $name=$_POST['name'];
    $productcode=$_POST['productcode'];
    $price=$_POST['price'];
    $category=$_POST['category'];
    $username=$_SESSION['username'];
    date_default_timezone_set('Europe/Athens');
    $dateofwithdrawal = date('Y-m-d');          
    
   
    
    $info= "creating product <br/>";
    $mysql="INSERT INTO `products` (`ID`, `NAME`, `PRODUCTCODE`, `PRICE`, `DATEOFWITHDRAWAL`, `SELLERNAME`, `CATEGORY`) VALUES (NULL, '$name', '$productcode', '$price',$dateofwithdrawal,'$username', '$category');";
    mysqli_query($connection,$mysql);
    


}
##DELETE PRODUCT WHOOSE DELETE BUTTON IS PRESSED
if(isset($_POST['delete'])){
    echo "delete ";
    echo $_POST['delete'];
    $mysql="DELETE FROM products WHERE ID = ".$_POST['id'];
    mysqli_query($connection,$mysql);
   


}



if(isset($_POST['change'])){
    echo "change ";
    echo $_POST['change'];    
    $_SESSION['change_id'] = $_POST['id'];
    updateItem();
    


}
if(isset($_POST['updateproduct'])){
    echo "updateproduct ";
    echo $_POST['updateproduct'];
    //echo "im updatin gthe product ";
    
    

    ## GET ID OF THE PRODUCT TO UPDATE FROM PRESSED BUTTON AND DRAW IT'S DATA FROM THE DATABASE    
    $id_to_update=$_SESSION['change_id'];
    $mysql="SELECT * FROM products WHERE ID='$id_to_update'";
    $result=mysqli_query($connection,$mysql);
    $row = mysqli_fetch_array($result);
   
    ##DRAW IT'S DATA FROM THE DATABASE
    $name=$row['NAME'];
    $productcode=$row['PRODUCTCODE'];
    $price=$row['PRICE'];
    $category=$row['CATEGORY'];
    ##DRAW IT'S DATA FROM THE DATABASE

    ## GET INPUT FORM DATA
    $uname=$_POST['uname'];
    $uproductcode=$_POST['uproductcode'];
    $uprice=$_POST['uprice'];
    $ucategory=$_POST['ucategory'];
    
    ## UPDATE ONLY THE ONES WHOOSE INPUT FIELD ISNT EMPTY
    if($uname!="" and $uname!=NULL)  {
        $name=$uname;
    }
    if($uproductcode!="" and $uproductcode!=NULL)  {
        $productcode=$uproductcode;
    }
    if($uprice!="" and $uprice!=NULL)  {
        $price=$uprice;
    }
    if($ucategory!="" and $ucategory!=NULL)  {
        $category=$ucategory;
    }

    $mysql="UPDATE products
    SET 
    NAME = '$name', 
    CATEGORY = '$category', 
    PRICE = '$price',
    PRODUCTCODE= '$productcode'
    WHERE ID ='$id_to_update'";
    mysqli_query($connection,$mysql);
    
   
    
   
    


}



#PRINT THE SELLER'S PRODUCTS FUNCTON

$seller_username=$_SESSION['username'];
$mysql="SELECT * FROM products WHERE SELLERNAME='$seller_username'";
$result=mysqli_query($connection,$mysql);
while($row = mysqli_fetch_array($result)) {
    echo '<item_box>';
    echo  "id:".$row['ID']."<br/>product name:".$row['NAME']."<br/>product code:".$row['PRODUCTCODE']."<br/>price:".$row['PRICE']."$"."<br/>product Category:".$row['CATEGORY']."<br/>DOW:".$row['DATEOFWITHDRAWAL'];
    echo '<button type="button" id ="delete"  value = '.$row['ID'].'>Delete '.$row['NAME'].'</button>';
    #################################
    
    echo '<button type="button" id="change" value = '.$row['ID'].'>Change info '.$row['NAME'].'</button>';
    
    echo "<br/>";
    echo '</item_box>';
}
?>