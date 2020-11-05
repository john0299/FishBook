<?php
include 'dbcon.php';
$get_id = $_GET['id'];
try {
    $conn->query("delete from photos where photos_id='$get_id'");
    $_SESSION['psuccess']='Photo Deleted.';
} catch (\Throwable $th) {
    //throw $th;
}


header('location:profile.php');
?>
