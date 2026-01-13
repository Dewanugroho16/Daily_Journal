<?php
include "header.php";
include "db.php";
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit;
}

// Pagination
$limit = 3; // 3 item per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM gallery"));
$pages = ceil($total / $limit);

$result = mysqli_query($conn, "SELECT * FROM gallery LIMIT $start, $limit");
?>

<h2>Gallery</h2>
<a href="gallery_add.php">Tambah Gallery</a>
<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Judul</th>
    <th>Deskripsi</th>
    <th>Gambar</th>
    <th>Aksi</th>
</tr>
<?php 
$no = $start + 1; // penomoran sesuai halaman
while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $row['title']; ?></td>
    <td><?php echo $row['description']; ?></td>
    <td>
        <?php if($row['image'] != ''): ?>
        <img src="images/<?php echo $row['image']; ?>" width="100">
        <?php endif; ?>
    </td>
    <td>
        <a href="gallery_edit.php?id=<?php echo $row['id']; ?>">Edit</a> | 
        <a href="gallery_delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Hapus data?')">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>

<!-- Pagination -->
<?php for($i=1; $i<=$pages; $i++): ?>
<a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
<?php endfor; ?>

<?php include "footer.php"; ?>
