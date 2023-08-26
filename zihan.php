  <table width="700">
	<tr> <th>Sender:</th>
	 <th>Subject</th>
	 <th>Date</th>
	 <th>Reply</th>
	 </tr>
	 <?php
$sel_msg="select * from messages where receiver='$user_id'";
	 $run_msg=mysqli_query($con,$sel_msg);
	 $count_msg=mysqli_num_rows($run_msg);
	 while($row_msg=mysqli_fetch_array($run_msg))
	 {
		 $msg_id=$row_msg['msg_id'];
		  $msg_receiver=$row_msg['receiver'];
		   $msg_sender=$row_msg['sender'];
		    $msg_sub=$row_msg['msg_sub'];
	     $msg_topic=$row_msg['msg_topic'];
		// echo $msg_sender;
		// echo $msg_receiver;
		 $msg_date=$row_msg['msg_date'];
		 $get_sender="select * from users where user_id='$msg_sender'";
		 $run_sender=mysqli_query($con,$get_sender);
		 $row=mysqli_fetch_array($run_sender);
		 $sender_name=$row['user_name'];
		// echo $sender_name;
       		 
	 
	 
	 ?>
 <tr align="center">
	 <td>
	 <a href="user_profile.php?u_id=<?php echo $msg_sender;?>"
	 target="blank"> <?php echo $sender_name; ?>
	 </a>
	 </td>
	 <td>
	 <a href="my_messages.php?inbox&msg_id=<?php
	 echo $msg_id; ?>">  <?php echo $msg_sub; ?> 
	 </a>
	 </td>
	 <td>
	 <?php echo $msg_date; ?></td>
	 <td><a href ="my_messages.php?inbox&msg_id=<?php echo $msg_id;
	 ?>" >Reply</a></td>
	 </tr>
	 
	 <?php }  ?>	 
	 
	 
	 </table>
	 
	 