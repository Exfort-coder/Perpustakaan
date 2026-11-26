<?php
require_once "koneksi.php";

// Mengambil data
$id = $_POST['id'];

// Membuat Query Delete
$delete = "DELETE FROM anggota WHERE id = ?";
// Menyiapkan statement
$stmt = mysqli_prepare($koneksi, $delete);
// Mengikat parameter
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)){
    mysqli_stmt_close($stmt);
    header("Location: data.php");
    exit;
} else {
    die("Gagal menghapus data: " . mysqli_stmt_error($stmt));
}
?>