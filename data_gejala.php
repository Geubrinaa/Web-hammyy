<?php
session_start();
require 'config.php';

// Ambil data gejala dari database (gunakan MySQLi, bukan PDO)
$result = $conn->query("SELECT * FROM gejala ORDER BY id_gejala ASC");
$gejala = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $gejala[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Gejala</title>
    <link rel="stylesheet" href="css/dashadmin.css">
    <link rel="stylesheet" href="css/tabel_gejala.css">
    <link rel="icon" href="image/logo.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header-gejala">
        <a href="dashboard.php" class="btn-kembali">&#8592; Kembali</a>
        <h1 class="judul-gejala">Data Gejala</h1>
        <div class="logout-container">
            <a href="logout.php" class="btn-logout"  onclick="return confirm('Anda yakin ingin keluar?')">Logout</a>
        </div>
    </div>
    <div class="table-page-container">
        <main class="table-main">
            <div class="tambah-gejala-container">
                <a href="tambah_gejala.php" class="btn-tambah">+ Tambah Gejala</a>
            </div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID Gejala</th>
                            <th>Kode Gejala</th>
                            <th>Nama Gejala</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($gejala as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id_gejala']); ?></td>
                            <td><?php echo htmlspecialchars($row['kode_gejala']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_gejala']); ?></td>
                            <td>
                                <a href="edit_gejala.php?id=<?php echo $row['id_gejala']; ?>" class="btn-edit">Edit</a>
                                <a href="hapus_gejala.php?id=<?php echo $row['id_gejala']; ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($gejala)): ?>
                        <tr>
                            <td colspan="4" style="text-align:center;">Belum ada data gejala.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>