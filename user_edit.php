<?php
include "header.php";
include "db.php";
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $photo = $data['photo'];
    if(isset($_FILES['photo']) && $_FILES['photo']['name'] != ''){
        $photo = $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], "images/".$photo);
    }

    mysqli_query($conn, "UPDATE users SET name='$name', username='$username', password='$password', photo='$photo' WHERE id=$id");
    header("location:user.php");
    exit;
}
?>

<h2>Edit User</h2>
<form method="post" enctype="multipart/form-data">
    Nama:<br><input type="text" name="name" value="<?php echo $data['name']; ?>" required><br><br>
    Username:<br><input type="text" name="username" value="<?php echo $data['username']; ?>" required><br><br>
    Password:<br><input type="text" name="password" value="<?php echo $data['password']; ?>" required><br><br>
    Foto:<br><input type="file" name="photo"><br>
    <small>Foto saat ini: <?php echo $data['photo']; ?></small><br><br>
    <button type="submit" name="submit">Update</button>
</form>

<?php include "footer.php"; ?>
