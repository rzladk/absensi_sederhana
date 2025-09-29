<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
include "db.php";

if (isset($_GET['hapus'])) {// jika tombol hapus ditekan
    $id = $_GET['hapus'];// dapatkan id siswa
    mysqli_query($conn, "DELETE FROM siswa WHERE id=$id");// hapus data siswa
    echo "<p class='success'>✅ Data siswa & semua absensinya berhasil dihapus!</p>";// tampilkan pesan sukses
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Absensi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>📋 Riwayat Absensi</h2>
    <?php
    $q = mysqli_query($conn, "SELECT absensi.id, absensi.tanggal, absensi.materi, absensi.status,siswa.nama, siswa.id AS siswa_id FROM absensi JOIN siswa ON absensi.siswa_id = siswa.id ORDER BY absensi.tanggal DESC");// ambil semua data absensi dengan nama siswa terkait 
    if (mysqli_num_rows($q) > 0) {// jika ada data absensi 
        echo "<table>";// buat tabel
        echo "<tr><th>Nama</th><th>Materi</th><th>Status</th><th>Tanggal</th><th>Aksi</th><th>Aksi</th></tr>";// header tabel
        while ($row = mysqli_fetch_assoc($q)) {// tampilkan semua data absensi 
            echo "<tr>
                    <td>".$row['nama']."</td>
                    <td>".$row['materi']."</td>
                    <td>".$row['status']."</td>
                    <td>".$row['tanggal']."</td>
                    <td>
                    <a href='edit_absensi.php?id=".$row['id']."'>📝 Edit</a>
                    </td>
                    <td>
                    <a href='riwayat.php?hapus=".$row['siswa_id']."' onclick=\"return confirm('Yakin ingin menghapus data siswa ini beserta semua absensinya?');\">❌ Hapus</a>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>❌ Tidak ada data absensi.</p>";
    }
    ?>
    <p><a href="index.php">⬅️ Kembali ke Absensi</a></p>
</div>
</body>
</html>
