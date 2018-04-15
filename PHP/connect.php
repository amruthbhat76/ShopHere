<?php
$conn=mysqli_connect('localhost','root','root');
if(!$conn){
	die("Database Connection Failed!". mysqli_error($connection));
}
$db=mysqli_select_db($conn,'shop_here');
?>