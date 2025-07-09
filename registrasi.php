<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validasi
    if ($password !== $confirm_password) {
        $error = "Konfirmasi password tidak cocok!";
    } else {
        // Cek username sudah ada atau belum (gunakan MySQLi)
        $stmt = $conn->prepare('SELECT * FROM user WHERE username = ?');
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->fetch_assoc()) {
            $error = "Username sudah terdaftar!";
        } else {
            // Simpan user baru
            $stmt = $conn->prepare("INSERT INTO user (username, password, nama_lengkap) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $password, $nama);
            $stmt->execute();
            $stmt->close();
            header('Location: login_user.php');
            exit();
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pemilik</title>
    <link rel="icon" href="image/logo.png" type="image/png">
    <link rel="stylesheet" href="css/regis.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="center-panel">
            <div class="register-container">
                <h2 class="text-center">Buat Akun Baru</h2>
                <form class="register-box" method="post" action="">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Konfirmasi Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                    <?php if (isset($error)) { echo "<div class='error'>$error</div>"; } ?>
                </form>
                <div class="text-center mt-3">
                    <a href="login_user.php" class="d-block">Sudah punya akun? Login di sini</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>