<?php
include "db.php";
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));

if($data['photo'] != ''){
    @unlink("images/".$data['photo']);
}

mysqli_query($conn, "DELETE FROM users WHERE id=$id");
header("location:user.php");
exit;
?>
