<?php

$con = mysqli_connect("localhost","root","","social_media") or die
("Connection was not established");
$email=$_SESSION['user_email'];
$get_topics="select * from users where user_email='$email'";
$ax=mysqli_query($con,$get_topics);
$row=mysqli_fetch_array($ax);
$stat=$row['status'];
if($stat=='None')
{
	header("location: index.php");
}
function getTopics(){
	global $con;
	$get_topics="select * from topics";
	$run_topics=mysqli_query($con,$get_topics);
	while($row=mysqli_fetch_array($run_topics))
	{
		$topic_id=$row['topic_id'];
		$topic_name=$row['topic_name'];
		//echo $topic_name;
		echo "<option value='$topic_id'>$topic_name</option>";
	}
}
function insertPost()
{
	if(isset($_POST['sub']))
	{
		global $con;
		global $user_id;
		$title=addslashes($_POST['title']);
		$content=addslashes($_POST['content']);
		$topic=addslashes($_POST['topic']);
		
		if($content=='' OR  $title=='')
		{
			echo "<h2>Please Enter title and Description</h2>";
			
        }
         else

		 {
			// echo $user_id;
			 $insert="insert into posts 
			 (	user_id	,topic_id,post_title,post_content,post_date)
			 values('$user_id','$topic','$title','$content',NOW())";
			 $run=mysqli_query($con,$insert);
			 $update="UPDATE users SET posts='YES' where user_id='$user_id'";
			 $zihan=mysqli_query($con,$update);
			 
			 
		 }			 
	          
	     
	}
}
function get_posts()
{
	global $con;
	$per_page=5;
	if(isset($_GET['page']))
	{
		$page=$_GET['page'];
	}
	else
	{
		$page=1;
	}
	$start_from=($page-1)*($per_page);
	$get_posts="select * from posts ORDER by 1 DESC LIMIT 
	$start_from,$per_page";
	$run_posts=mysqli_query($con,$get_posts);
	while($row_posts=mysqli_fetch_array($run_posts))
	{
		$post_id=$row_posts['post_id'];
		$user_id=$row_posts['user_id'];
		$post_title=$row_posts['post_title'];
		$content=substr($row_posts['post_content'],0,150);
		$post_date=$row_posts['post_date'];
		  $user="select * from users where user_id='$user_id'
		  AND posts='YES'";
		  $run_user=mysqli_query($con,$user);
		  $row_user=mysqli_fetch_array($run_user);
		  echo $user_id;
		  $user_name=$row_user['user_name'];
		  $user_image=$row_user['user_image'];
		  
		  echo "<div id='posts'>
		   
            <p><img src='Users/$user_image' width='50' height='50'/></p>
		  <h3><a href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
		 
		  <h3>$post_title</h3>
		  
		  <h3>$post_date</h3> 
		  <p align='left'> <font color=pink  size='4pt'>$content</font> </p>
		  <a href='single.php?post_id=$post_id'>
		  <button>See Replies or Reply to This</button?</a>
		  </div><br/>
		 
		  
		  ";
	}
	     
		  include("pagination.php");
		 
		  
		 
		  
	}
	function single_post()
	{
		if(isset($_GET['post_id']))
		{
			global $con;
			$get_id=($_GET['post_id']);
			$get_posts="select * from posts where post_id='$get_id'";
			$run_posts=mysqli_query($con,$get_posts);
			$row_posts=mysqli_fetch_array($run_posts);
			$post_id=$row_posts['post_id'];
		$user_id=$row_posts['user_id'];
		$post_title=$row_posts['post_title'];
		$content=$row_posts['post_content'];
		$post_date=$row_posts['post_date'];
		 $user="select * from users where user_id='$user_id'
		  AND posts='YES'";
		  $run_user=mysqli_query($con,$user);
		  $row_user=mysqli_fetch_array($run_user);
		  $user_name=$row_user['user_name'];
		  $user_image=$row_user['user_image'];
		  $user_com=$_SESSION['user_email'];
		  $get_com= "select * from users where user_email='$user_com'";
		  $run_com=mysqli_query($con,$get_com);
		  $row_com=mysqli_fetch_array($run_com);
		  $user_com_id=$row_com['user_id'];
		  $user_com_name=$row_com['user_name'];
		  
		  echo "<div id='posts'>
		  <p><img src='Users/$user_image' width='50' height='50'/></p>
		  <h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
		  <h3>$post_title</h3>
		  <p>$post_date</p>
		    <p align='left'> <font color=gray  size='6pt'>$content</font> </p>
		  
		  
		  ";
		  include("comments.php");
		  echo "
		  <form actiom='' method='post' id='reply'>
		  <textarea cols='50' rows='5' name='comment' placeholder='write your reply'></textarea><br/>
		  <input type='submit' name='reply' value='Reply To This'/>
		  </form>";
		  if(isset($_POST['reply']))
		  {
			  $comment=$_POST['comment'];
			  $insert="insert into comments
			  (post_id,user_id,comment,comment_author,date)
			  values('$post_id','$user_id','$comment','$user_com_name',
			  NOW())";
			  $run=mysqli_query($con,$insert);
			  echo "<h2><Your Reply was added!</h2>";
		  }
		  
			
		}
	}
	function members()
	{
		global $con;
		$user="select * from users LIMIT 0,10";
		$run_users=mysqli_query($con,$user);
		echo "<br/<h2>Members on this site:</h2><hr>";
		while($row_user=mysqli_fetch_array($run_users))
		{
			$user_id=$row_user['user_id'];
			$user_name=$row_user['user_name'];
			$user_image=$row_user['user_image'];
			echo "<span>
			<a href='user_profile.php?u_id=$user_id'>
			<img src='Users/$user_image' width='150' height='150'
			title='$user_name' style='float:left;'/>
			</a>
			<span>
			
			";
		}
	}
	function user_profile()
	{
		if(isset($_GET['u_id']))
		{
			//echo "zihan";
			global $con;
			$user_id=$_GET['u_id'];
			$select="select * from users where user_id='$user_id'";
			$run=mysqli_query($con,$select);
			$row=mysqli_fetch_array($run);
			$id=$row['user_id'];
			$image=$row['user_image'];
			$name=$row['user_name'];
			$country=$row['user_country'];
			$gender=$row['user_gender'];
			$last_login=$row['user_last_login'];
			$register_date=$row['user_reg_date'];
			if($gender=='Male')
			{
			$msg="Send him a message";
			}
			else
			{
				$msg="Send her a message";
			}
			echo "<div id='user_profile'>
			<img src='Users/$image' width='150' height='150' /><br/>
			<p><strong>Name:</strong> $name </p><br/>
			<p><strong>Gender:</strong> $gender </p><br/>
			<p><strong>Country:</strong> $country </p><br/>
			<p><strong>Last Login:</strong>$last_login</p><br/>
			<a href='messages.php?u_id=$id'><button>$msg</button></a>
			</div>
			
			";
		}
	}
	function topic_show()
	{
		global $con;
		if(isset($_GET['topic']))
		{
			$id=$_GET['topic'];
		}
		//echo "zihan";
		$get_posts="select * from posts where topic_id='$id'";
		$run_posts=mysqli_query($con,$get_posts);
		while($row_posts=mysqli_fetch_array($run_posts))
		{
			$post_id=$row_posts['post_id'];
			$user_id=$row_posts['user_id'];
			$post_title=$row_posts['post_title'];
			$content=$row_posts['post_content'];
			$post_date=$row_posts['post_date'];
			$user="select * from users where user_id='$user_id'";
			$run_user=mysqli_query($con,$user);
			$row_user=mysqli_fetch_array($run_user);
			$user_name=$row_user['user_name'];
			$user_image=$row_user['user_image'];
			echo "<div id='posts'>
			<p><img src='Users/$user_image' width='50' height='50'</p>
			<h3><a href='user_profile.php user_id=$user_id'>$user_name</a></h3>
			<h3>$post_title</h3>
			 
             <p>$post_date</p> <p><$content</p>
			 <a href ='single.php?post_id=$post_id' style='float:left;'>
			 <button>Veiw</button></a>
			 <a href ='edit_post.php?post_id=$post_id' style='float:left;'>
			 <button>Edit</button></a>
			  <a href ='functions/delete_post.php?post_id=$post_id' style='float:left;'>
			 <button>Delete</button></a>
			 </div><br/>
			 ";
			 include("delete_post.php");
	
		}
		
	}
	function results()
	{
		global $con;
		if(isset($_GET['search']))
		{
			$sq=$_GET['user_query'];
		}
		$ac="select topic_id from topics where topic_name='$sq'";
		$ax=mysqli_query($con,$ac);
		$a_z=mysqli_fetch_array($ax);
		$t_id=$a_z['topic_id'];
		//echo $t_id;
		$get_posts="select * from posts where topic_id='$t_id' OR post_title like '%$sq%' OR post_content like '%$sq%'";
		$run_posts=mysqli_query($con,$get_posts);
		while($row_posts=mysqli_fetch_array($run_posts))
		{
			$post_id=$row_posts['post_id'];
			$user_id=$row_posts['user_id'];
			$post_title=$row_posts['post_title'];
			$content=$row_posts['post_content'];
			$post_date=$row_posts['post_date'];
			$user="select * from users where user_id='$user_id'";
			$run_user=mysqli_query($con,$user);
			$row_user=mysqli_fetch_array($run_user);
			$user_name=$row_user['user_name'];
			$user_image=$row_user['user_image'];
			echo "<div id='posts'>
			<p><img src='Users/$user_image' width='50' height='50'</p>
			<h3><a href='user_profile.php user_id=$user_id'>$user_name</a></h3>
			<h3>$post_title</h3>
			 
             <p>$post_date</p> <p><$content</p>
			 <a href ='single.php?post_id=$post_id' style='float:left;'>
			 <button>Veiw</button></a>
			 <a href ='edit_post.php?post_id=$post_id' style='float:left;'>
			 <button>Edit</button></a>
			  <a href ='functions/delete_post.php?post_id=$post_id' style='float:left;'>
			 <button>Delete</button></a>
			 </div><br/>
			 ";
			 include("delete_post.php");
	
		}
		
		
	
	}
	
	



?>