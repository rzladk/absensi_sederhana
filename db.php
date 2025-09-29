<?php
$host = "localhost";// host database
$user = "root";// user database
$pass = "";// password database
$db   = "absensi_sederhana";// nama database

$conn = mysqli_connect($host, $user, $pass, $db);// koneksi database

if (!$conn) {// cek koneksi
    die("Koneksi gagal: " . mysqli_connect_error());// tampilkan pesan error jika koneksi gagal
}// koneksi berhasil
?>
