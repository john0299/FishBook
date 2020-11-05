<?php
include('dbcon.php');
$get_id = $_GET['id'];
try {
    $conn->query("select from photos where photos_id='$get_id'");
    
} catch (\Throwable $th) {
    //throw $th;
}

?>