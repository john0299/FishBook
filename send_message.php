<?php
include 'dbcon.php';
include 'session.php';

$myid = $_POST['my_id'];
$friend_id  = $_POST['friend_id'];
$my_message  = $_POST['my_message'];
$conn->query("insert into message(sender_id,reciever_id,content,date_sended) values('$myid','$friend_id','$my_message',NOW())");
$_SESSION['success']='Message Sent.';

?>
<script>window.location = 'message.php'; </script>
