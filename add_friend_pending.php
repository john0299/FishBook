<?php include('dbcon.php'); ?>
<?php include('session.php'); ?>
<?php
	$my_friend_id = $_POST['my_friend_id'];
	$my_id = $_POST['my_id'];
	$conn ->query("insert into friends (my_id,friends_id,friend_status) values('$my_id','$my_friend_id','pending')");
 	header('location:friends.php'); 
?>