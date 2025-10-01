<?php
session_start();// mulai session
if (!isset($_SESSION['user'])) {
    header("Location: login.php");// kembali ke halaman login
    exit;// hentikan eksekusi jika tidak login
}
include "db.php";// koneksi database

if (isset($_POST['simpan'])) {// jika tombol simpan ditekan
    $nama   = $_POST['nama'];// nama siswa
    $materi = $_POST['materi'];// materi pelajaran
    $status = $_POST['status'];// status kehadiran
    $tanggal = $_POST['tanggal'];// tanggal absensi

    // cek siswa
    $cek = mysqli_query($conn, "SELECT * FROM siswa WHERE nama='$nama'");// cek apakah siswa sudah ada
    if (mysqli_num_rows($cek) == 0) {// jika siswa belum ada, tambahkan
        mysqli_query($conn, "INSERT INTO siswa (nama) VALUES ('$nama')");// tambahkan siswa baru
        $siswa_id = mysqli_insert_id($conn);// dapatkan id siswa baru
    } else {// jika siswa sudah ada, ambil id-nya
        $s = mysqli_fetch_assoc($cek);// ambil data siswa
        $siswa_id = $s['id'];// dapatkan id siswa yang sudah ada
    }
    
    mysqli_query($conn, "INSERT INTO absensi (siswa_id, materi, status, tanggal) VALUES 
    ('$siswa_id', '$materi', '$status', '$tanggal')");// simpan data absensi
    echo "<p class='success'>✅ Absensi berhasil disimpan!</p>";// tampilkan pesan sukses
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Absensi</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Form Absensi Kursus Online</h2>
        <form method="POST">
            <label>Nama Siswa:</label>
            <input type="text" name="nama" required>
            <label>Materi:</label>
            <select name="materi" required>
                <option value="Ms Word">Ms Word</option>
                <option value="Ms Excel">Ms Excel</option>
                <option value="Desain Grafis">Desain Grafis</option>
                <option value="Pemrograman Web">Pemrograman Web</option>
                <option value="Auto Cad">Auto Cad</option>
            </select>
            <label>Status:</label>
            <select name="status" required>
                <option value="Hadir">Hadir</option>
                <option value="Izin">Izin</option>
                <option value="Sakit">Sakit</option>
                <option value="Alpa">Alpa</option>
            </select>
            <label>Tanggal:</label>
            <input type="date" name="tanggal" required>
            <button type="submit" name="simpan">Simpan</button>
        </form>

        <p><a href="riwayat.php">📋 Lihat Riwayat</a> | <a href="edit_profil.php">👤 Edit Profil</a> | <a href="logout.php">🚪 Logout</a></p>
    </div>
</body>

</html>