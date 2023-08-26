<?php
include("includes/data_connect.php");
   if(isset($_POST['sign_up']))
   {
	   
	   $name = mysqli_real_escape_string($con,$_POST['Name']);
	   $pass = mysqli_real_escape_string($con,$_POST['pass']);
	   $email = mysqli_real_escape_string($con,$_POST['Email']);
	   filter_var($email,FILTER_VALIDATE_EMAIL);
	   $country = mysqli_real_escape_string($con,$_POST['country']);
	   $gender = mysqli_real_escape_string($con,$_POST['gender']);
	   $birthday = mysqli_real_escape_string($con,$_POST['birthday']);
	   $status ="Varified";
	   
	   $posts ="NO";
	   $val_code=mt_rand();
	   if(strlen($pass)<6)
	   {
		   echo "<script>alert('Password shpuld be minimum 6 characters!')</script>";
		   exit();
	   }
	   $check_email="select * from users where user_email='$email'";
	   $run_email = mysqli_query($con,$check_email);
	   $check = mysqli_num_rows($run_email);
	   if($check==1)
	   {
		  echo "<script>alert('Password shpuld be minimum 6 characters!')</script>";
		   exit(); 
	   }
	 $insert = "insert into users (	user_name,user_password,
	 user_email,user_country,user_gender,
	 user_birthday	,user_image,	user_reg_date,status,validation_code,
	 posts)    values('$name','$pass','$email','$country',
	 '$gender','$birthday','abc.jpg',NOW(),'$status'
	 ,'$val_code','$posts') ";
	 mysqli_query($con,$insert);
	 
	 
	 
	 
	 
	 
	
	 
	 
	 
   }

?>