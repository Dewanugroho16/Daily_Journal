<?php
include "header.php";
include "db.php";
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit;
}

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = '';

    if(isset($_FILES['image']) && $_FILES['image']['name'] != ''){
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "images/".$image);
    }

    mysqli_query($conn, "INSERT INTO gallery (title, description, image) VALUES ('$title','$description','$image')");
    header("location:gallery.php");
    exit;
}
?>

<h2>Tambah Gallery</h2>
<form method="post" enctype="multipart/form-data">
    Judul:<br><input type="text" name="title" required><br><br>
    Deskripsi:<br><textarea name="description" required></textarea><br><br>
    Gambar:<br><input type="file" name="image"><br><br>
    <button type="submit" name="submit">Simpan</button>
</form>

<?php include "footer.php"; ?>
