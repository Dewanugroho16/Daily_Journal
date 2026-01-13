<?php
include "header.php";
include "db.php";
session_start();
if(!isset($_SESSION['username'])){
    header("location:login.php");
    exit;
}

// Pagination
$limit = 5; // 5 item per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

$total = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
$pages = ceil($total / $limit);

$result = mysqli_query($conn, "SELECT * FROM users LIMIT $start, $limit");
?>

<h2>User</h2>
<a href="user_add.php">Tambah User</a>
<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Username</th>
    <th>Password</th>
    <th>Foto</th>
    <th>Aksi</th>
</tr>
<?php 
$no = $start + 1; // penomoran sesuai halaman
while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['username']; ?></td>
    <td><?php echo $row['password']; ?></td>
    <td>
        <?php if($row['photo'] != ''): ?>
        <img src="images/<?php echo $row['photo']; ?>" width="100">
        <?php endif; ?>
    </td>
    <td>
        <a href="user_edit.php?id=<?php echo $row['id']; ?>">Edit</a> | 
        <a href="user_delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Hapus data?')">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>

<!-- Pagination -->
<?php for($i=1; $i<=$pages; $i++): ?>
<a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
<?php endfor; ?>

<?php include "footer.php"; ?>
