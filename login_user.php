<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user && $password == $user['password']) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user['username'];
        // ...set session lain jika perlu...
        header('Location: dashboarduser.php');
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login User</title>
    <link rel="icon" href="image/logo.png" type="image/png">
    <link rel="stylesheet" href="css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main-container">
        <div class="right-panel">
            <div class="login-container">
                <h2 class="text-center">Login Pemilik Hamster</h2>
                <form class="login-box" method="post" action="">
                    <div class="icon-user">
                        <span>&#128100;</span>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                    <?php if (isset($error)) { echo "<div class='error'>$error</div>"; } ?>
                </form>
                <div class="text-center mt-3">
                    <a href="registrasi.php" class="d-block">Belum punya akun? Daftar sekarang</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>