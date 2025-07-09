<?php
// filepath: c:\xampp\htdocs\WebHammy\dashboard_user.php
session_start();
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['username'])) {
    header('Location: login_user.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.png" type="image/png">
    <link rel="stylesheet" href="css/dashuser.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="user-dashboard-container">
        <div class="logout-user-container">
            <a href="logout.php" class="btn-logout" onclick="return confirm('Anda yakin ingin keluar?')">Logout</a>
        </div>
        <header class="user-dashboard-header">
            <h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        </header>
        <main class="user-dashboard-main">
            <div class="hamster-info-horizontal">
  <img class="hamster-img" src="image/hamster.jpg" alt="Hamster">
  <div class="hamster-info-content">
    <div class="hamster-info-text">
      Hamster kecilmu sedang tidak sehat? Jangan khawatir!Ayo kita periksa bersama si mungil. Diagnosis dini adalah kunci menjaga kesehatan hamster.
    </div>
<a href="isi_data_hamster.php" class="btn-isi-data">Isi Data Hamster</a>
    <div class="hamster-note">
      *Catatan: Konsultasi dengan dokter hewan tetap disarankan untuk pemeriksaan lebih lanjut
    </div>
  </div>
</div>
        </main>
    </div>
</body>
</html>