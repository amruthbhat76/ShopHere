<?php
  session_start();
require_once('../PHP/connect.php');

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
  <link rel="stylesheet" type="text/css" href="../css/main.css">
 
</head>
<body>

<nav class="navbar  navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="Main.php">ShopHere!</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="Main.php">Home</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <?php
      if(isset($_SESSION['User_name']))
        echo '<li><a href="Cart.php"><span class="glyphicon glyphicon-shopping-cart"></span></a></li>
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> '.$_SESSION['User_name'].'</a></li>
       <li><a href="Logout.php"><span class="glyphicon glyphicon-off"></span> Sign Out</a></li>';
      else{
       echo '<li><a href="SignUp.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="Login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';}
        ?>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
 <div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a href="#Clothing">Clothing</a>
  <a href="#Footwear">Footwear</a>
  <a href="#Mobiles">Mobiles</a>
  <a href="#HomeAppliances">Home Appliances</a>

  </div>
<!---->

</div>
  <div id="mainbody">
  <div id="main">
 <span  style="font-size:30px;cursor:pointer" onclick="openNav()">&#9754;Categories</span>
 </div>
 <div class="products">
<div class="products_container container" id="Clothing">
<legend>Clothing</legend>
<ul class="products">
   
   <!-- <?php

   // while($r=mysqli_fetch_assoc($res)){
    
      ?>
      <li><img src=<?php// echo $r['Prod_image']?> alt="bell sleeves"><br/><?php// echo $r['Prod_name']?>&nbsp;&nbsp;<?php //echo $r['Price'] ?><br/><button class="btn">View</button></a>&nbsp;&nbsp;<button class="btn">Add To Cart</button></li>';
   <?php 

?>  -->
<?php
$query="SELECT * FROM `Product`"; 
$res=mysqli_query($conn,$query);

while($row = mysqli_fetch_assoc($res)) {
    $Prod_id = $row['Prod_id'];

   $Prod_name=$row['Prod_name'];

    $Price=$row['Price'];
    $Prod_desc=$row['Prod_Description'];
    $ProdFileName=$row['ProdFileName'];
    $Category=$row['Category'];

//echo $fromID;
$dirname = "../img/";
//$images = glob($dirname."*.jpg");\'' . $name . '\'

//$id=1;
//foreach($images as $image) {
if($Category=='Clothing'){
$type=".jpg";
if(isset($_SESSION['User_name'])){
    echo ' <li id="'.$Prod_id.'"><img src="'.$dirname."/".$Category."/".$ProdFileName.$type.'" /><br/><br/><button class="btn" data-toggle="modal" data-target="#myModal'.$Prod_id.'">View</button>&nbsp;&nbsp;<button class="btn" onclick="submitFunction('.$_SESSION['cart_id'].','.$Prod_id.','.$Price.',\''.$Prod_name.'\')" type="submit" name="submit" value="submit">Add To Cart</button><h4>'.$Prod_name.' ₹ '.$Price.'</h4><h4 id="output">'.$Prod_desc.'</h4>';}
  else{
    echo ' <li id="'.$Prod_id.'"><img src="'.$dirname."/".$Category."/".$ProdFileName.$type.'" /><br/><br/><button class="btn" data-toggle="modal" data-target="#myModal'.$Prod_id.'">View</button>&nbsp;&nbsp;<button class="btn" onclick="loginfirst()" type="submit" name="submit" value="submit">Add To Cart</button><h4>'.$Prod_name.' ₹ '.$Price.'</h4><h4 id="output">'.$Prod_desc.'</h4>';}
    echo '
  <!-- Modal -->
  <div class="modal fade" id="myModal'.$Prod_id.'" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                <h3 class="modal-title">'.$Prod_name.'</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 product_img">
                        <img src="'.$dirname."/".$Category."/".$ProdFileName.$type.'" class="img-responsive">
                    </div>
                    <div class="col-md-6 product_content">
                        <h4>Product Id: <span>'.$Prod_id.'</span></h4>
                       
                        <p>'.$Prod_desc.'</p>
                        <p id="output"></p>
                        <h3 class="cost"> ₹ '.$Price.'</h3>
                       
                        </div>
                        <div class="space-ten"></div>
                       
                        <div class="btn-ground">';
                       
                            if(isset($_SESSION['User_name'])){
                            echo '<button  onclick="submitFunction('.$_SESSION['cart_id'].','.$Prod_id.','.$Price.',\''.$Prod_name.'\')") ><span class="glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>';
                          }
                          else{
                              echo '<button  onclick="loginfirst()" ><span class="glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>';
                          }

                            echo '<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-heart"></span>Buy Now</button>
                     
                       
                        </div>
                    </div>
                    </div>
                    </div>
                      </li>';




   
                  
  
  } 
}
?>
          
    
    
</ul>
</div>

<div class="products_container container" id="Footwear">
<legend>Footwear</legend>
<ul class="products">
   
    <?php
$query="SELECT * FROM `Product`"; 
$res=mysqli_query($conn,$query);

while($row = mysqli_fetch_assoc($res)) {
    $Prod_id = $row['Prod_id'];
    $Prod_name=$row['Prod_name'];
    $Price=$row['Price'];
    $Prod_desc=$row['Prod_Description'];
    $ProdFileName=$row['ProdFileName'];
    $Category=$row['Category'];

//echo $fromID;
$dirname = "../img/";
//$images = glob($dirname."*.jpg");

//$id=1;
//foreach($images as $image) {
if($Category=='Footwear'){
$type=".jpg";
   if(isset($_SESSION['User_name'])){
    echo ' <li id="'.$Prod_id.'"><img src="'.$dirname."/".$Category."/".$ProdFileName.$type.'" /><br/><br/><button class="btn" data-toggle="modal" data-target="#myModal'.$Prod_id.'">View</button>&nbsp;&nbsp;<button class="btn" onclick="submitFunction('.$_SESSION['cart_id'].','.$Prod_id.','.$Price.',\''.$Prod_name.'\')" type="submit" name="submit" value="submit">Add To Cart</button><h4>'.$Prod_name.' ₹ '.$Price.'</h4><h4 id="output">'.$Prod_desc.'</h4>';}
  else{
    echo ' <li id="'.$Prod_id.'"><img src="'.$dirname."/".$Category."/".$ProdFileName.$type.'" /><br/><br/><button class="btn" data-toggle="modal" data-target="#myModal'.$Prod_id.'">View</button>&nbsp;&nbsp;<button class="btn" onclick="loginfirst()" type="submit" name="submit" value="submit">Add To Cart</button><h4>'.$Prod_name.' ₹ '.$Price.'</h4><h4 id="output">'.$Prod_desc.'</h4>';}
    echo '
  <!-- Modal -->
  <div class="modal fade" id="myModal'.$Prod_id.'" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                <h3 class="modal-title">'.$Prod_name.'</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 product_img">
                        <img src="'.$dirname."/".$Category."/".$ProdFileName.$type.'" class="img-responsive">
                    </div>
                    <div class="col-md-6 product_content">
                        <h4>Product Id: <span>'.$Prod_id.'</span></h4>
                       
                        <p>'.$Prod_desc.'</p>
                        <h3 class="cost"> ₹ '.$Price.'</h3>
                       
                        </div>
                        <div class="space-ten"></div>
                        <div class="btn-ground">';
                            if(isset($_SESSION['User_name'])){
                            echo '<button  onclick="submitFunction('.$_SESSION['cart_id'].','.$Prod_id.','.$Price.',\''.$Prod_name.'\')") ><span class="glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>';
                          }
                          else{
                              echo '<button  onclick="loginfirst()" ><span class="glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>';
                          }

                            echo ' <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-heart"></span>Buy Now</button>
                        </div>
                    </div>
                    </div>
                    </div>
                      </li>';
  } 
}
?>
    
</ul>
</div>

<div class="products_container container" id="Mobiles">
<legend>Mobiles</legend>
<ul class="products">
   
    <?php
$query="SELECT * FROM `Product`"; 
$res=mysqli_query($conn,$query);

while($row = mysqli_fetch_assoc($res)) {
    $Prod_id = $row['Prod_id'];
    $Prod_name=$row['Prod_name'];
    $Price=$row['Price'];
    $Prod_desc=$row['Prod_Description'];
    $ProdFileName=$row['ProdFileName'];
    $Category=$row['Category'];

//echo $fromID;
$dirname = "../img/";
//$images = glob($dirname."*.jpg");

//$id=1;
//foreach($images as $image) {
if($Category=='Mobiles'){
$type=".jpg";
   if(isset($_SESSION['User_name'])){
    echo ' <li id="'.$Prod_id.'"><img src="'.$dirname."/".$Category."/".$ProdFileName.$type.'" /><br/><br/><button class="btn" data-toggle="modal" data-target="#myModal'.$Prod_id.'">View</button>&nbsp;&nbsp;<button class="btn" onclick="submitFunction('.$_SESSION['cart_id'].','.$Prod_id.','.$Price.',\''.$Prod_name.'\')" type="submit" name="submit" value="submit">Add To Cart</button><h4>'.$Prod_name.' ₹ '.$Price.'</h4><h4 id="output">'.$Prod_desc.'</h4>';}
  else{
    echo ' <li id="'.$Prod_id.'"><img src="'.$dirname."/".$Category."/".$ProdFileName.$type.'" /><br/><br/><button class="btn" data-toggle="modal" data-target="#myModal'.$Prod_id.'">View</button>&nbsp;&nbsp;<button class="btn" onclick="loginfirst()" type="submit" name="submit" value="submit">Add To Cart</button><h4>'.$Prod_name.' ₹ '.$Price.'</h4><h4 id="output">'.$Prod_desc.'</h4>';}
    echo '
  <!-- Modal -->
  <div class="modal fade" id="myModal'.$Prod_id.'" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                <h3 class="modal-title">'.$Prod_name.'</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 product_img">
                        <img src="'.$dirname."/".$Category."/".$ProdFileName.$type.'" class="img-responsive">
                    </div>
                    <div class="col-md-6 product_content">
                        <h4>Product Id: <span>'.$Prod_id.'</span></h4>
                       
                        <p>'.$Prod_desc.'</p>
                        <h3 class="cost"> ₹ '.$Price.'</h3>
                       
                        </div>
                        <div class="space-ten"></div>
                        <div class="btn-ground">';
                         if(isset($_SESSION['User_name'])){
                            echo '<button  onclick="submitFunction('.$_SESSION['cart_id'].','.$Prod_id.','.$Price.',\''.$Prod_name.'\')") ><span class="glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>';
                          }
                          else{
                              echo '<button  onclick="loginfirst()" ><span class="glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>';
                          }

                            echo '
                            <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-heart"></span>Buy Now</button>
                        </div>
                    </div>
                    </div>
                    </div>
                      </li>';
  } 
}
?>
    
</ul>
</div>

<div class="products_container container" id="HomeAppliances">
<legend>Home Appliances</legend>
<ul class="products">
   
   <?php
$query="SELECT * FROM `Product`"; 
$res=mysqli_query($conn,$query);

while($row = mysqli_fetch_assoc($res)) {
    $Prod_id = $row['Prod_id'];
    $Prod_name=$row['Prod_name'];
    $Price=$row['Price'];
    $Prod_desc=$row['Prod_Description'];
    $ProdFileName=$row['ProdFileName'];
    $Category=$row['Category'];

//echo $fromID;
$dirname = "../img/";
//$images = glob($dirname."*.jpg");

//$id=1;
//foreach($images as $image) {
if($Category=='Appliances'){
$type=".jpg";
   if(isset($_SESSION['User_name'])){
    echo ' <li id="'.$Prod_id.'"><img src="'.$dirname."/".$Category."/".$ProdFileName.$type.'" /><br/><br/><button class="btn" data-toggle="modal" data-target="#myModal'.$Prod_id.'">View</button>&nbsp;&nbsp;<button class="btn" onclick="submitFunction('.$_SESSION['cart_id'].','.$Prod_id.','.$Price.',\''.$Prod_name.'\')" type="submit" name="submit" value="submit">Add To Cart</button><h4>'.$Prod_name.' ₹ '.$Price.'</h4><h4 id="output">'.$Prod_desc.'</h4>';}
  else{
    echo ' <li id="'.$Prod_id.'"><img src="'.$dirname."/".$Category."/".$ProdFileName.$type.'" /><br/><br/><button class="btn" data-toggle="modal" data-target="#myModal'.$Prod_id.'">View</button>&nbsp;&nbsp;<button class="btn" onclick="loginfirst()" type="submit" name="submit" value="submit">Add To Cart</button><h4>'.$Prod_name.' ₹ '.$Price.'</h4><h4 id="output">'.$Prod_desc.'</h4>';}
    echo '
  <!-- Modal -->
  <div class="modal fade" id="myModal'.$Prod_id.'" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                <h3 class="modal-title">'.$Prod_name.'</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 product_img">
                        <img src="'.$dirname."/".$Category."/".$ProdFileName.$type.'" class="img-responsive">
                    </div>
                    <div class="col-md-6 product_content">
                        <h4>Product Id: <span>'.$Prod_id.'</span></h4>
                       
                        <p>'.$Prod_desc.'</p>
                        <h3 class="cost"> ₹ '.$Price.'</h3>
                       
                        </div>
                        <div class="space-ten"></div>
                        <div class="btn-ground">';
                         if(isset($_SESSION['User_name'])){
                            echo '<button  onclick="submitFunction('.$_SESSION['cart_id'].','.$Prod_id.','.$Price.',\''.$Prod_name.'\')") ><span class="glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>';
                          }
                          else{
                              echo '<button  onclick="loginfirst()" ><span class="glyphicon glyphicon-shopping-cart"></span> Add To Cart</button>';
                          }

                            echo '
                           
                            <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-heart"></span>Buy Now</button>
                        </div>
                    </div>
                    </div>
                    </div>
                      </li>';
  } 
}
?>
    
</ul>
</div>


</div>
  </div>
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("mainbody").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("mainbody").style.marginLeft= "0";
}
function loginfirst(){
  alert("Login or Signup to Add to Cart");
}

function submitFunction(cid,pid,price,pname) {
  console.log("Here i am"+cid+pid+pname+price);
   $.ajax({
       
        type: 'POST',
         url: 'AddToCart.php',
         dataType:"json",
        data: {'Cart_Id':cid, 'Prod_Id':pid, 'Prod_Name':JSON.stringify(pname), 'Price': price},
        success: function(data, status) {
        
          
           console.log(" in ajax");
        },
        error: function(xhr, desc, err) {
          console.log(xhr);
          console.log("Details: " + desc + "\nError:" + err);
        }
      }); // end ajax call
   console.log("done!");
}
</script>
</body>
</html>