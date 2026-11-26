<?php
require_once "koneksi.php";

// Mengambil data anggota berdasarkan ID dari parameter GET
$id = $_GET['id'];

$query = "SELECT * FROM anggota WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $query);
// Mengikat parameter
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
// Merubah hasil menjadi array asosiatif
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Anggota</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px }
        h1 { color #1f3864; }
        label { 
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }
        input[type="text"], select, textarea { width: 320px; padding: 6px; }
        button { margin-top: 16px; padding: 8px 20px }
        .sukses {
            background: #e6f4ea;
            border-left: 5px solid #2e7d32;
            padding: 10px;
            width: 320px;
        }
    </style>
    </head>
<body>
    <h1>Edit Data Anggota</h1>
    <form action="proses_update.php" method="POST">

    <input type="hidden" name="id" value="<?= $data['id'] ?>">
    <label>Nomor Anggota:</label>
    <input type="text" name="no_anggota" value="<?= htmlspecialchars($data['no_anggota']); ?>"
    maxlength="15" required>
   
    <label>Nama Lengkap:</label>
    <input type="text" name="nama_lengkap" value="<?= htmlspecialchars($data['nama_lengkap']); ?>"
    maxlength="100" required>

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($data['email']); ?>"
    maxlength="100" required>

    <label>Nomor HP:</label>
    <input type="text" name="no_hp" value="<?= htmlspecialchars($data['no_hp']); ?>"
    maxlength="15" required>   

    <label>Jenis Anggota:</label>
    <select name="jenis_anggota" required>

        <option value="Mahasiswa" <?= $data['jenis_anggota'] == "Mahasiswa" ? "selected" : ""; ?>>
            Mahasiswa
        </option>

        <option value="Dosen" <?= $data['jenis_anggota'] == "Dosen" ? "selected" : ""; ?>>
            Dosen
        </option>

        <option value="Tenaga Kependidikan" <?= $data['jenis_anggota'] == "Tenaga Kependidikan" ? "selected" : ""; ?>>
            Tenaga Kependidikan
        </option>
    </select>
    
    <label>Alamat:</label>
    <textarea name="alamat" rows="4" cols="50"
        required><?= htmlspecialchars($data['alamat']); ?>
    </textarea><br>
    
    <button type="submit">Simpan Perubahan</button><br><br>

    <a href="data.php">Kembali</a>

    </form>
</body>
</html>