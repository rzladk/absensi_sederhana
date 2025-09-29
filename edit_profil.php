<?php
session_start();
if (!isset($_SESSION['user'])) {// jika belum login
    header("Location: login.php");// kembali ke halaman login
    exit;// hentikan eksekusi
}
include "db.php";// koneksi database

if (isset($_POST['update'])) {// jika tombol update ditekan
    $id = $_POST['id'];// dapatkan id siswa
    $nama = $_POST['nama'];// nama baru
    mysqli_query($conn, "UPDATE siswa SET nama='$nama' WHERE id=$id");// update nama siswa
    echo "<p class='success'>✅ Profil siswa berhasil diperbarui!</p>";//tampilkan pesan sukses
}

$siswa = mysqli_query($conn, "SELECT * FROM siswa ORDER BY nama ASC");// ambil semua data siswa
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>👤 Edit Profil Siswa</h2>
    <form method="POST">
        <label>Pilih Siswa:</label>
        <select name="id" required>
            <option value="">-- Pilih --</option>
            <?php while($row = mysqli_fetch_assoc($siswa)) { // ambil semua data siswa?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['nama'];// tampilkan nama ?></option>
            <?php } ?>
        </select>
        <label>Nama Baru:</label>
        <input type="text" name="nama" required placeholder="Masukkan nama baru">
        <button type="submit" name="update">Update</button>
    </form>
    <p><a href="index.php">⬅️ Kembali ke Absensi</a></p>
</div>
</body>
</html>
