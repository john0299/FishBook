<?php
include('dbcon.php');
include('session.php');
$id = $_GET['id'];

	$conn ->query("delete from post where post_id = '$id'");
	header('location:profile.php');
?>