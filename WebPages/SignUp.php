<?php
session_start();
require_once('../PHP/connect.php');
if(!empty($_POST)){ 
    $username=mysqli_real_escape_string($conn,$_POST['name']);
    $password=md5($_POST['password']);
    $password2=md5($_POST['password2']);
    if($password==$password2){
        $query="INSERT INTO `user` (User_name,Password) VALUES ('$username','$password')";
        $res=mysqli_query($conn,$query);
        if($res){
           $_SESSION['User_name']= $username;
           $q="INSERT INTO `Cart` (User_name) VALUES ('$username')";
           $r=mysqli_query($conn,$q);
           if($r){
              $query="SELECT * FROM `Cart` WHERE User_name like '$username'";
              $r=mysqli_query($conn,$query);
              $f=mysqli_fetch_array($r);
              $_SESSION['cart_id']=$f['CartId'];
           }
          $query="SELECT * FROM `user` WHERE User_name like '$username' &&  Password LIKE'$password'";
          $res=mysqli_query($conn,$query);
          $first = mysqli_fetch_array($res);
          $_SESSION['id']=$first['User_id'];
          header("Location: Main.php");
        }
        else 
          echo "Failed!";
    }
    else{
       echo "both password entries should match";
    }

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>ShopHere</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/LoginSignUp.css">
</head>
<body><div class="container">
    <div class="col-md-6">
    <div id="logbox">
      <form id="signup" method="post">
        <h1>Create a <i>ShopHere!</i> Account</h1>
        <input name="name" type="text" placeholder="What's your username?" pattern="^[\w]{3,16}$" autofocus="autofocus" required="required" class="input pass"/>
        <input name="password" type="password" placeholder="Choose a password" required="required" class="input pass"/>
        <input name="password2" type="password" placeholder="Confirm password" required="required" class="input pass"/>
        <!--<input name="user[email]" type="email" placeholder="Email address" class="input pass"/>-->
        <input type="submit" value="Sign me up!" class="inputButton"/>
        <div class="text-center">
            already have an account? <a href="Login.php" id="login_id">login</a>
        </div>
      </form>
    </div>
   </div>
    <!--col-md-6-->
   </body>
</html> 
   