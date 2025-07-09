<?php
session_start();
require 'config.php';

// Ambil data user dari database (gunakan MySQLi, bukan PDO)
$result = $conn->query("SELECT id_user, nama_lengkap, username, password FROM user");
$data = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data User</title>
    <link rel="stylesheet" href="css/dashadmin.css">
    <link rel="stylesheet" href="css/tabel_user.css">
     <link rel="icon" href="image/logo.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header-user">
        <a href="dashboard.php" class="btn-kembali">&#8592; Kembali</a>
        <h1 class="judul-user">Data User</h1>
        <div class="logout-container">
            <a href="logout.php" class="btn-logout"  onclick="return confirm('Anda yakin ingin keluar?')">Logout</a>
        </div>
    </div> 
    <div class="table-page-container">
       <div class="table-page-container">
        <main class="table-main">
                    <div class="table-container">
                        <table class="data-table">
                            <tr>
                                <th>ID User</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Password</th>
                            </tr>
                            <tbody>
                                <?php foreach ($data as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id_user']) ?></td>
                                    <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                                    <td><?= htmlspecialchars($row['username']) ?></td>
                                    <td>
                                        <span class="password-mask">
                                            <?= str_repeat('•', strlen($row['password'])) ?>
                                        </span>
                                        <span class="real-password" style="display:none;">
                                            <?= htmlspecialchars($row['password']) ?>
                                        </span>
                                        <span class="password-toggle" onclick="togglePassword(this)" title="Tampilkan/Sembunyikan Password">
                                            <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" height="1.2em" viewBox="0 0 576 512"><path d="M572.52 241.4C518.06 135.5 410.13 64 288 64 165.87 64 57.94 135.5 3.48 241.4a48.35 48.35 0 0 0 0 29.2C57.94 376.5 165.87 448 288 448c122.13 0 230.06-71.5 284.52-177.4a48.35 48.35 0 0 0 0-29.2zM288 400c-97.2 0-189.8-57.2-240-144C98.2 169.2 190.8 112 288 112s189.8 57.2 240 144c-50.2 86.8-142.8 144-240 144zm0-272a128 128 0 1 0 128 128A128 128 0 0 0 288 128zm0 208a80 80 0 1 1 80-80 80 80 0 0 1-80 80zm0-128a48 48 0 1 0 48 48 48 48 0 0 0-48-48z" fill="#888"/><line x1="48" y1="464" x2="528" y2="48" stroke="#888" stroke-width="32"/></svg>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </main>
    </div>
    <script>
    function togglePassword(toggleBtn) {
        var row = toggleBtn.parentNode;
        var mask = row.querySelector('.password-mask');
        var real = row.querySelector('.real-password');
        var icon = toggleBtn.querySelector('svg');
        if (real.style.display === "none") {
            real.style.display = "inline";
            mask.style.display = "none";
            // Ganti ke ikon mata silang (hidden)
            icon.innerHTML = '<path d="M572.52 241.4C518.06 135.5 410.13 64 288 64 165.87 64 57.94 135.5 3.48 241.4a48.35 48.35 0 0 0 0 29.2C57.94 376.5 165.87 448 288 448c122.13 0 230.06-71.5 284.52-177.4a48.35 48.35 0 0 0 0-29.2zM288 400c-97.2 0-189.8-57.2-240-144C98.2 169.2 190.8 112 288 112s189.8 57.2 240 144c-50.2 86.8-142.8 144-240 144zm0-272a128 128 0 1 0 128 128A128 128 0 0 0 288 128zm0 208a80 80 0 1 1 80-80 80 80 0 0 1-80 80zm0-128a48 48 0 1 0 48 48 48 48 0 0 0-48-48z" fill="#888"/><line x1="48" y1="464" x2="528" y2="48" stroke="#888" stroke-width="32"/>';
        } else {
            real.style.display = "none";
            mask.style.display = "inline";
            // Ganti ke ikon mata (visible)
            icon.innerHTML = '<path d="M572.52 241.4C518.06 135.5 410.13 64 288 64 165.87 64 57.94 135.5 3.48 241.4a48.35 48.35 0 0 0 0 29.2C57.94 376.5 165.87 448 288 448c122.13 0 230.06-71.5 284.52-177.4a48.35 48.35 0 0 0 0-29.2zM288 400c-97.2 0-189.8-57.2-240-144C98.2 169.2 190.8 112 288 112s189.8 57.2 240 144c-50.2 86.8-142.8 144-240 144zm0-272a128 128 0 1 0 128 128A128 128 0 0 0 288 128zm0 208a80 80 0 1 1 80-80 80 80 0 0 1-80 80zm0-128a48 48 0 1 0 48 48 48 48 0 0 0-48-48z" fill="#888"/>';
        }
    }
    </script>
</body>
</html>