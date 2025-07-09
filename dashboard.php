<?php
session_start();
// Cek login admin
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['username'])) {
    header('Location: login_admin.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="css/dashadmin.css">
     <link rel="icon" href="image/logo.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1>Dashboard Kamu</h1>
            <div class="admin-info">
                <span class="icon-user">&#128100;</span>
                <span class="admin-name">Halo, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php" class="logout-btn"  onclick="return confirm('Anda yakin ingin keluar?')">Logout</a>
            </div>
        </header>
        <main class="dashboard-main">
            <div class="dashboard-menu">
                <a href="data_user.php" class="menu-card">
                    <div class="menu-icon">👥</div>
                    <div class="menu-title">Data User</div>
                </a>
                <a href="data_gejala.php" class="menu-card">
                    <div class="menu-icon">📑
                    </div>
                    <div class="menu-title">Data Gejala</div>
                </a>
                <a href="data_penyakit.php" class="menu-card">
                    <div class="menu-icon"> 👩🏼‍⚕️
                    </div>
                    <div class="menu-title">Data Penyakit</div>
                </a>
                  <a href="data_aturan.php" class="menu-card">
                    <div class="menu-icon"> 🤝
                    </div>
                    <div class="menu-title">Data Aturan</div>
                </a>
            </div>
        </main>
    </div>
</body>
</html>