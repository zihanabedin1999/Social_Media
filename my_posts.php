<?php
session_start();
include("includes/data_connect.php");
$get_topics="select * from users";
$xyz=mysqli_query($con,$get_topics);
$row=mysqli_fetch_array($xyz);
$stat=$row['status'];
if($stat=='None')
{
	header("location: index.php");
}
include("functions/function.php");

?>
<html>
<head>
<title>Welcome User?</title>
<link rel="stylesheet" href="styles/home_style.css" media="all"/>
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
  </div>
  <div id="content_timeline">
  
  <h3>See All Posts</h3>
  
  <?php 
     
     $abc=$user_id;
	 $get_posts="select * from posts where user_id='$abc'";
	 $abc_posts=mysqli_query($con,$get_posts);
	
	 
	 
	 while($row_posts=mysqli_fetch_array($abc_posts))
		{
			$post_id=$row_posts['post_id'];
			$user_id=$row_posts['user_id'];
			$post_title=$row_posts['post_title'];
			$content=substr($row_posts['post_content'],0,150);
			$post_date=$row_posts['post_date'];
			$user ="select * from users where user_id='$user_id' AND posts='yes'";
			$run_user=mysqli_query($con,$user);
			$row_user=mysqli_fetch_array($run_user);
			$user_name=$row_user['user_name'];
			$user_image=$row_user['user_image'];
			echo "<div id='posts'
			<p><img src='Users/$user_image' width='50' height='50'/></p>
			 <h2><a href='user_profile.php?user_id=$user_id'></a></h2>
			 <h2>$user_name</h2>
			 <p>$post_title</p>
			
			 <p>$post_date</p>
			 <p align='left'> <font color=violet  size='5pt'>$content</font> </p>
			 <a href='single.php?post_id=$post_id'
			 style='float:left;'><button>View</button></a>
			 <a href='functions/delete_post.php?post_id=$post_id'
			style='float:left;'><button>Delete</button></a> 
			 <a href='edit_post.php?post_id=$post_id'
			style='float:left;'><button>Edit</button></a>
			
			<p>Thank You</p>
			
			 
              			 
		    
			
			</div><br/>
			
			";
			//<a href='functions/delete_post.php?post_id=$post_id'
			//style='float:left;'><button>Edit</button></a> 
			// <a href='edit_post.php?post_id=$post_id'
			//style='float:left;'><button>Edit</button></a>
			//<h2 align='left'> <font color=violet  size='5pt'>$content</font> </h2>
			 //<a href='single.php?post_id=$post_id'
			// style='float:left;'><button>View</button></a>
			// <a href='functions/delete_post.php?post_id=$post_id'
			//style='float:left;'><button>Delete</button></a> 
			// <a href='edit_post.php?post_id=$post_id'
			//style='float:left;'><button>Edit</button></a>
		}
		include("functions/delete_post.php");
		
	 
  ?>
  
    
  </div>
  </div>
  </div>
  </body>
  </html>