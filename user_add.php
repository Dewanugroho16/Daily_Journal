<?php
include "header.php";
include "db.php";
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit;
}

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $photo = '';
    if(isset($_FILES['photo']) && $_FILES['photo']['name'] != ''){
        $photo = $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], "images/".$photo);
    }

    mysqli_query($conn, "INSERT INTO users (name, username, password, photo) VALUES ('$name','$username','$password','$photo')");
    header("location:user.php");
    exit;
}
?>

<h2>Tambah User</h2>
<form method="post" enctype="multipart/form-data">
    Nama:<br><input type="text" name="name" required><br><br>
    Username:<br><input type="text" name="username" required><br><br>
    Password:<br><input type="text" name="password" required><br><br>
    Foto:<br><input type="file" name="photo"><br><br>
    <button type="submit" name="submit">Simpan</button>
</form>

<?php include "footer.php"; ?>
