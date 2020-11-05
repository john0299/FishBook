<?php include('dbcon.php'); ?>
<?php include('session.php'); ?>
<?php
	$content = $_POST['content'];
	$my_id = $_POST['my_id'];
	$conn ->query("insert into post (member_id,content,date_posted) values('$my_id','$content',Now())");
 	header('location:home.php'); 
?>