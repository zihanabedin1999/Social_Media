
<?php
 if(isset($_GET['msg_id']))
		  {
			  $get_id= $_GET['msg_id'];
			 // echo "zihan";
			 $sel_message="select * from messages where msg_id='$get_id'";
			 $run_message=mysqli_query($con,$sel_message);
			 $row_message=mysqli_fetch_array($run_message);
			 $msg_subject=$row_message['msg_sub'];
			 $msg_topic=$row_message['msg_topic'];
			 $reply_content=$row_message['reply'];
			 echo "<center><br/><hr>
			 <h2>$msg_subject</h2>
			 <p><b>My Message:</b> $msg_topic</p>
			 <p><b>Their Reply:</b> $reply_content</p>
			 </center>
			 ";
		  }
		  
		 ?>