<?php
session_start();
require_once('../PHP/connect.php');

if(isset($_POST['Cart_Id']) && isset($_POST['Prod_Id']) && isset($_POST['Prod_Name']) && isset($_POST['Price'])){

     $Cart_Id = strip_tags(mysqli_real_escape_string($conn,$_POST['Cart_Id']));
     $Prod_Id = strip_tags(mysqli_real_escape_string($conn,$_POST['Prod_Id']));
     $Prod_Name = strip_tags(mysqli_real_escape_string($conn,$_POST['Prod_Name']));
     $Price = strip_tags(mysqli_real_escape_string($conn,$_POST['Price']));
    
    $SQL ="INSERT INTO `prods_in_carts` (Cart_Id,Prod_Id,Prod_Name,Price) VALUES ('$Cart_Id','$Prod_Id','$Prod_Name','$Price')";
     $result = mysqli_query($conn,$SQL);

     
     if($result){
          echo '{"code":"Your data was submitted"}';
          
     }else{
       
          echo '{"code":"There was a problem. Please try again later."}';
          
     }
     
}else{
     echo 'Your test wasnt passed in the request. Make sure you add ?Test1=data1_HERE&Test2=data2_here&Test3=data3_here&Test4=data4_here&Test5=data5_here to the tags.';
}
?>