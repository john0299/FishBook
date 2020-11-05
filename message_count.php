<?php
include 'dbcon.php';
include 'session.php';
// $session_query = $conn->query("select * from members where member_id = '$session_id'");
$query = "select *, count(*) as 'mescount' from message where receiver_id = '$session_id'";
$stmt = $conn->prepare($query);
$stmt -> execute(array($query));

$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>