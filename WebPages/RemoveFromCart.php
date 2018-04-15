<?php
session_start();
require_once('../PHP/connect.php');

if(isset($_POST['Prod_Id']) && isset($_POST['Cart_id'])){
     $Cart_Id = strip_tags(mysqli_real_escape_string($conn,$_POST['Cart_id']));

    $Prod_Id = strip_tags(mysqli_real_escape_string($conn,$_POST['Prod_Id']));
    $SQL ="DELETE FROM `prods_in_carts` WHERE Prod_Id=$Prod_Id AND Cart_Id=$Cart_Id";
     $result = mysqli_query($conn,$SQL);

$query="SELECT SUM(Price) AS value_sum FROM `prods_in_carts` WHERE Cart_Id='$Cart_Id'";
$result=mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result); 
     if($result){
          echo $row['value_sum'];
          
     }else{
       
          echo '{"code":"There was a problem. Please try again later."}';
          
     }
     
}else{
     echo 'Your test wasnt passed in the request. Make sure you add ?Test1=data1_HERE&Test2=data2_here&Test3=data3_here&Test4=data4_here&Test5=data5_here to the tags.';
}
?>