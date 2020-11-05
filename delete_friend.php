<?php
include('dbcon.php');
$id = $_GET['id'];
	$conn ->query("delete from friends where friends_id = '$id' or my_id = '$id' and friend_status ='friends'");
	header('location:friends.php');
?>