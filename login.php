<?php
include "db.php";
session_start();

if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    if(mysqli_num_rows($query) > 0){
        $_SESSION['username'] = $username;
        header("location:index.php");
        exit;
    } else {
        echo "<script>alert('Login gagal! Username / Password salah');</script>";
    }
}
?>

<h2>Login</h2>
<form method="post">
    Username<br>
    <input type="text" name="username" required><br><br>

    Password<br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="login">Login</button>
</form>
