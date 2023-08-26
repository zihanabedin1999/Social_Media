<?php
session_start();
include("includes/data_connect.php");
include("functions/function.php");
?>

<html>
<head>
<title>Welcome User?</title>
<link rel="stylesheet" href="styles/home_style.css" media="all"/>
<style> input[type='file']{width:180px;}
</style>
</head>
<body>
<div class="container">
  <div id="head_wrap">
  <div id="header">
   <ul id="menu">
   <li><a href="home.php">Home</a></li>
   <li><a href="members.php">Members</a></li>
   <strong>Topics:</strong>
   <?php
   $get_topics="select * from topics";
   $run_topics=mysqli_query($con,$get_topics);
   while($row=mysqli_fetch_array($run_topics))
   {
	   $topic_id=$row['topic_id'];
	   $topic_name=$row['topic_name'];
	   echo "<li><a href='topic.php?topic=$topic_id'>$topic_name</a></li>";
   }
   ?>
  </div>
  <div class="content">
  <div id="user_timeline">
    <div id="user_details">
	
		<?php
		$user=$_SESSION['user_email'];
		$get_user="select * from users where user_email='$user'";
		$run_user=mysqli_query($con,$get_user);
		$row=mysqli_fetch_array($run_user);
		$user_id=$row['user_id'];
		$user_name=$row['user_name'];
		$user_pass=$row['user_password'];
		$user_country=$row['user_country'];
		$user_image=$row['user_image'];
		$register_date=$row['user_reg_date'];
		$last_login=$row['user_last_login'];
         
        $user_posts="select * from posts where user_id='$user_id'";
        $run_posts=mysqli_query($con,$user_posts);
         $posts=mysqli_num_rows($run_posts);
$sel_msg="select * from messages where receiver='$user_id'";
$run_msg=mysqli_query($con,$sel_msg);
$count_msg=mysqli_num_rows($run_msg);	
 echo "<center>
       <img src='Users/$user_image' width='200' height='200'/>
	    </center>
		<div id='user_mention'>
		<p><strong>Name:</strong>$user_name</p>
<p><strong>Country:</strong>$user_country</p>
<p><strong>Member Since:</strong>$register_date</p>
<p><a href='my_posts.php'?u_id=$user_id'>My Posts($posts)</a></p>
<p><a href='my_messages.php'?u_id=$user_id'>My Messsages($count_msg)</a></p>
<p><a href='edit_profile.php?u_id=$user_id'>Edit Profile</a></p>
<p><a href='logout.php'>Logout</a></p>
</div>
";		
		?>
	
  </div>
 
  </div>
  <div>
  <form action="" method="post" ID="f" class="ff" enctype="multipart/form-data">
  <table>
  <tr align="center">
    <td colspan="6"><h2>Edit Your Profile:</h2></td>
	</tr>
	<tr>
	<td align ="right"> Name:</td>
	<td>
	<input type ="text" name="u_name" required="required"
	
	value =" <?php echo $user_name;?> "/>
	</td> </tr>
	<tr>
	<td align ="right">Password:</td>
	<td>
	<input type ="password" name="u_pass" required="required"
	
	value ="<?php echo $user_pass;?> "/>
	</td> </tr>
	<tr>
	<td align="right"> Photo:</td>
	<td>
	<input type="file" name ="u_image" required="required"/>
	</td>
	</tr>
	<tr align ="center">
	<td colspan="6">
	<input type="submit" name="update" value="Update"/>
	</td>
	</tr>
	</table>
	</form>
<?php
if(isset($_POST['update']))
{
	$u_name=$_POST['u_name'];
	$u_pass=$_POST['u_pass'];
	
	$u_image=$_FILES['u_image']['name'];
	$image_name=$_FILES['u_image']['tmp_name'];
	move_uploaded_file($image_tmp,"Users/$u_image");
	$update="update users set user_name='$u_name',user_password='$u_pass',
	user_image='$u_image' where user_id='$user_id'";
	
	$run=mysqli_query($con,$update);
	if($run)
	{
		echo "<script>alert('Your Profile Updated!')</script>";
		echo "<script>window.open('home.php','_self')</script>";
	}
	
}

?>
  
    
  </div>
  </div>
  </div>
  </body>
  </html>

  
  