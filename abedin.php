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