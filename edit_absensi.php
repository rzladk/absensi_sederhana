<?php
session_start();
if (!isset($_SESSION['user'])) {// jika belum login 
    header("Location: login.php");// kembali ke halaman login
    exit;// hentikan eksekusi
}
include "db.php";// koneksi database

if (isset($_GET['id'])) {// jika ada id di URL
    $id = $_GET['id'];// dapatkan id
    $q = mysqli_query($conn, "SELECT absensi.*, siswa.nama 
    FROM absensi JOIN siswa ON absensi.siswa_id = siswa.id WHERE absensi.id=$id");
    $data = mysqli_fetch_assoc($q);// ambil data absensi
}// jika tidak ada id, kembali ke riwayat
else {
    header("Location: riwayat.php");// kembali ke halaman riwayat
    exit;
}

if (isset($_POST['update'])) {// jika tombol update ditekan
    $id = $_GET['id'];// dapatkan id dari URL
    $materi = $_POST['materi'];// materi
    $status = $_POST['status'];// status
    $tanggal = $_POST['tanggal'];// tanggal

    mysqli_query($conn, "UPDATE absensi SET materi='$materi', status='$status', tanggal='$tanggal' WHERE id=$id");// update data absensi
    echo "<p class='success'>✅ Data absensi berhasil diperbarui!</p>";// tampilkan pesan sukses
    echo "<p><a href='riwayat.php'>⬅️ Kembali ke Riwayat</a></p>";// link kembali ke riwayat
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Absensi</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>📝 Edit Absensi</h2>
        <form method="POST">
            <label>Nama:</label>
            <input type="text" value="<?php echo $data['nama']; // tampilkan nama?>" disabled>
            <label>Materi:</label>
            <select name="materi" required>
                <option value="Ms Word" <?php if ($data['materi'] == "Ms Word") echo "selected"; ?>>Ms Word</option>
                <option value="Ms Excel" <?php if ($data['materi'] == "Ms Excel") echo "selected"; ?>>Ms Excel</option>
                <option value="Desain Grafis" <?php if ($data['materi'] == "Desain Grafis") echo "selected"; ?>>Desain Grafis</option>
                <option value="Pemrograman Web" <?php if ($data['materi'] == "Pemrograman Web") echo "selected"; ?>>Pemrograman Web</option>
                <option value="Pemrograman Web" <?php if ($data['materi'] == "Pemrograman Web") echo "selected"; ?>>Auto Cad</option>
                
            </select>
            <label>Status:</label>
            <select name="status" required>
                <option value="Hadir" <?php if ($data['status'] == "Hadir") echo "selected"; ?>>Hadir</option>
                <option value="Izin" <?php if ($data['status'] == "Izin") echo "selected"; ?>>Izin</option>
                <option value="Sakit" <?php if ($data['status'] == "Sakit") echo "selected"; ?>>Sakit</option>
                <option value="Alpa" <?php if ($data['status'] == "Alpa") echo "selected"; ?>>Alpa</option>
            </select>
            <label>Tanggal:</label>
            <input type="date" name="tanggal" value="<?php echo $data['tanggal']; ?>" required>
            <button type="submit" name="update">Update</button>
        </form>
        <p><a href="riwayat.php">⬅️ Kembali ke Riwayat</a></p>
    </div>
</body>

</html>