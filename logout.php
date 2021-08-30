<?php 
session_start(); 
unset($_SESSION['reg_id']);
unset($_SESSION['role']);
session_destroy();
header("Location:index.php");
exit; 

 ?>