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
  <script>function removeItem(pid,cid) {

   $.ajax({
       
        type: 'POST',
         url: 'RemoveFromCart.php',
         dataType:"json",
        data: {'Cart_id':cid,'Prod_Id':pid},
        success: function(data, status) {
           document.getElementById(pid).innerHTML="";
           document.getElementById("TOTAL").innerHTML=data;
           console.log(" in ajax");
        },
        error: function(xhr, desc, err) {
          console.log(xhr);
          console.log("Details: " + desc + "\nError:" + err);
        }
      }); // end ajax call
   console.log("done!");
}</script>
  <link rel="stylesheet" type="text/css" href="../css/main.css">
 <style>
table,#checkout {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 50%;
    margin-top:10%;
    margin-left:20%;
    margin-bottom:10%;

}

td, th {
    border: 1px solid #31F584;
    text-align: left;
    padding: 8px;
}
  
  #checkout{
     margin-left:40%;
    margin-top:2%;
    width:20%;
  }

/*tr:nth-child(even) {
    background-color: #31F584;
}*/
</style>
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
       </ul>
    </div>
  </div>
</nav>
<p>hgfhg</p>
<table>
<tr>
    <th>Product Id</th>
    <th>Product Name</th>
    <th>Price</th>
 </tr>
<?php
$cid=$_SESSION['cart_id'];
$query="SELECT * FROM `prods_in_carts` WHERE Cart_Id='$cid'";
$result=mysqli_query($conn,$query);
while($row = mysqli_fetch_assoc($result)) {
    $Prod_id = $row['Prod_Id'];
   $Prod_name=str_replace('"', '', $row['Prod_Name']);
    $Price=$row['Price'];
    echo '<tr id='.$Prod_id.'><td>'.$Prod_id.'</td><td>'.$Prod_name.'</td><td>'.$Price.'</td><td><button onclick="removeItem('.$Prod_id.','.$_SESSION['cart_id'].')">Remove</button></td></tr>';
}
$query="SELECT SUM(Price) AS value_sum FROM `prods_in_carts` WHERE Cart_Id='$cid'";
$result=mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result); 

?>
<tr ><td/><td>TOTAL</td><td id="TOTAL"><?php echo $row['value_sum'];?></td></tr>
</table>

<button type="button" id="checkout" class="btn btn-primary"><span class="glyphicon glyphicon-heart"></span>Check Out!</button>
</body>
</html>