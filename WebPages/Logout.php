<?php
session_start();
unset($_SESSION['User_name']);
unset($_SESSION['id']);  
unset($_SESSION['cart_id']);  
header("Location: Main.php");
?>