<?php
$get_id=$_GET['post_id'];
$get_com="select * from comments where post_id='$get_id' ORDER by 1 DESC";
$run_com=mysqli_query($con,$get_com);
while($row=mysqli_fetch_array($run_com))
{
	$com=$row['comment'];
	$com_name=$row['comment_author'];
	$date=$row['date'];
	echo "
	<div id='comments'>
	
	<h3>$com_name</h3><span><i> Replied </i> on $date</span>
	
	<p align='left'> <font color=blue  size='6pt'>$com</font> </p>
	
	</div>
	";
}
?>
