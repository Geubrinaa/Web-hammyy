<?php
session_start();
require 'config.php';

// Ambil data penyakit dari database (gunakan MySQLi, bukan PDO)
$result = $conn->query("SELECT * FROM penyakit ORDER BY id_penyakit ASC");
$penyakit = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $penyakit[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Penyakit</title>
    <link rel="stylesheet" href="css/dashadmin.css">
    <link rel="stylesheet" href="css/tabel_penyakit.css">
     <link rel="icon" href="image/logo.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header-penyakit">
        <a href="dashboard.php" class="btn-kembali">&#8592; Kembali</a>
        <h1 class="judul-penyakit">Data Penyakit</h1>
        <div class="logout-container">
            <a href="logout.php" class="btn-logout"  onclick="return confirm('Anda yakin ingin keluar?')">Logout</a>
        </div>
    </div>
    <div class="table-page-container">
        <main class="table-main">
            <div class="tambah-penyakit-container">
                <a href="tambah_penyakit.php" class="btn-tambah">+ Tambah Penyakit</a>
            </div>
                        <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID Penyakit</th>
                            <th>Kode Penyakit</th>
                            <th>Nama Penyakit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($penyakit && is_array($penyakit)): ?>
                            <?php foreach ($penyakit as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id_penyakit']); ?></td>
                                <td><?php echo htmlspecialchars($row['kode_penyakit']); ?></td>
                                <td><?php echo htmlspecialchars($row['nama_penyakit']); ?></td>
                                <td>
                                    <a href="edit_penyakit.php?id=<?php echo $row['id_penyakit']; ?>" class="btn-edit">Edit</a>
                                    <a href="hapus_penyakit.php?id=<?php echo $row['id_penyakit']; ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align:center;">Data penyakit kosong atau query gagal.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>