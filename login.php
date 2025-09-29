<?php
session_start();
include "db.php";

if (isset($_SESSION['user'])) {// jika sudah login
    header("Location: index.php");// langsung ke halaman utama
    exit;// hentikan eksekusi
}

if (isset($_POST['login'])) {   // jika tombol login ditekan
    $username = $_POST['username'];// username
    $password = md5($_POST['password']);// password (md5)

    $q = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");// cek username dan password
    if (mysqli_num_rows($q) > 0) {// jika ada
        $_SESSION['user'] = $username;// set session
        header("Location: index.php");// ke halaman utama
        exit;// hentikan eksekusi
    } else {
        $error = "❌ Username atau password salah!";// pesan error jika username atau password salah
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>🔑 Login</h2>
    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit" name="login">Login</button>
    </form>
</div>
</body>
</html>
