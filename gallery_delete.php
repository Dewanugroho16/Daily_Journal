<?php
include "db.php";
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM gallery WHERE id=$id"));

if($data['image'] != ''){
    @unlink("images/".$data['image']);
}

mysqli_query($conn, "DELETE FROM gallery WHERE id=$id");
header("location:gallery.php");
exit;
?>
