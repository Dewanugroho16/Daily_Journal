<?php
include "header.php";
include "db.php";
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM gallery WHERE id=$id"));

if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $data['image'];

    if(isset($_FILES['image']) && $_FILES['image']['name'] != ''){
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "images/".$image);
    }

    mysqli_query($conn, "UPDATE gallery SET title='$title', description='$description', image='$image' WHERE id=$id");
    header("location:gallery.php");
    exit;
}
?>

<h2>Edit Gallery</h2>
<form method="post" enctype="multipart/form-data">
    Judul:<br><input type="text" name="title" value="<?php echo $data['title']; ?>" required><br><br>
    Deskripsi:<br><textarea name="description" required><?php echo $data['description']; ?></textarea><br><br>
    Gambar:<br><input type="file" name="image"><br>
    <small>Gambar saat ini: <?php echo $data['image']; ?></small><br><br>
    <button type="submit" name="submit">Update</button>
</form>

<?php include "footer.php"; ?>
