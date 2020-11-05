<?php
include('dbcon.php');
$get_id = $_GET['id'];
$conn->query("delete from message where message_id = '$get_id'");

$_SESSION['success']='Message Deleted.';
// echo("<html><div>Message Deleted</div></html>");


?>
<!-- <script>alert('Message Deleted');</script> -->
<script>window.location = 'message.php'; </script>