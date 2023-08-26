<?php
session_start();
include("includes/data_connect.php");
if(isset($_POST['login']))
{
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$pass=mysqli_real_escape_string($con,$_POST['pass']);
       
	$select_user = "select * from users where user_email='$email' AND user_password='$pass'";
	$zihan=mysqli_query($con,$select_user);
	$insert="UPDATE users SET user_last_login=NOW() where user_email='$email' AND user_password='$pass'" ;
	mysqli_query($con,$insert);
	$ax="UPDATE users SET status='Varified' where user_email='$email' AND user_password='$pass'" ;
	mysqli_query($con,$ax);
	$check_user=mysqli_num_rows($zihan);
//	 header("location: home.php");
$get_topics="select * from users where user_email='$email'";
$xyz=mysqli_query($con,$get_topics);
$row=mysqli_fetch_array($xyz);
$stat=$row['user_password'];
	if($check_user==1)
	{

		$_SESSION['user_email']=$email;
	    //echo "zihan";
		header("location: home.php");
		//echo "<script>window.open('home.php','_self')</script";
	   //echo $stat;
		

	}
	else
	{
		echo "<script>alert('Invalid Account')</script>";
	}
	
	
	
	
}


?>