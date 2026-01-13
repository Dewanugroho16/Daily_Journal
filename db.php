<?php
$conn = mysqli_connect("localhost", "root", "", "daily_journal");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
