<?php
session_start();
require 'config.php';

// Ambil data aturan
$sql = "SELECT * FROM aturan ORDER BY id_rule ASC";
$result = $conn->query($sql);
$aturan = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $aturan[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Aturan</title>
    <link rel="stylesheet" href="css/dashadmin.css">
    <link rel="stylesheet" href="css/tabel_gejala.css">
     <link rel="icon" href="image/logo.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header-gejala">
        <a href="dashboard.php" class="btn-kembali">&#8592; Kembali</a>
        <h1 class="judul-gejala">Data Aturan</h1>
        <div class="logout-container">
            <a href="logout.php" class="btn-logout" onclick="return confirm('Anda yakin ingin keluar?')">Logout</a>
        </div>
    </div>
    <div class="table-page-container">
        <main class="table-main">
            <div class="tambah-gejala-container">
                <a href="tambah_aturan.php" class="btn-tambah">+ Tambah Aturan</a>
            </div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID Rule</th>
                            <th>ID Penyakit</th>
                            <th>ID Gejala</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($aturan as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id_rule']); ?></td>
                            <td><?php echo htmlspecialchars($row['id_penyakit']); ?></td>
                            <td><?php echo htmlspecialchars($row['id_gejala']); ?></td>
                            <td>
                                <a href="edit_aturan.php?id=<?php echo $row['id_rule']; ?>" class="btn-edit">Edit</a>
                                <a href="hapus_aturan.php?id=<?php echo $row['id_rule']; ?>" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($aturan)): ?>
                        <tr>
                            <td colspan="4" style="text-align:center;">Belum ada data aturan.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
<?php $conn->close(); ?>