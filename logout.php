<?php
session_start();
include("includes/data_connect.php");
//echo $u_id;
$email=$_SESSION['user_email'];
$ac="UPDATE users SET status='None' where user_email='$email'";
mysqli_query($con,$ac);
//session_destroy();
header("location: index.php");
//session_destroy();

?>