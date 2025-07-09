<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kodepenyakit = trim($_POST['kode_penyakit']);
    $namapenyakit = trim($_POST['nama_penyakit']);
    if (!empty($kodepenyakit) && !empty($namapenyakit)) {
        $stmt = $pdo->prepare("INSERT INTO penyakit(kode_penyakit, nama_penyakit) VALUES (:kode_penyakit, :nama_penyakit)");
        try {
            $stmt->execute(['kode_penyakit' => $kodepenyakit, 'nama_penyakit' => $namapenyakit]);
            header('Location: data_penyakit.php');
            exit();
        } catch (PDOException $e) {
            $error = "Kode Penyakit sudah digunakan atau terjadi kesalahan!";
        }
    } else {
        $error = "Kode Penyakit dan Nama Penyakit tidak boleh kosong!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Penyakit</title>
    <link rel="stylesheet" href="css/tamdit.css">
</head>
<body>
    <div class="table-page-container">
        <h2 class="judul-penyakit">Tambah Penyakit</h2>
        <?php if (!empty($error)): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" class="form-tambah-penyakit">
            <div class="form-group">
                <label for="kode_penyakit">Kode Penyakit:</label>
                <input type="text" id="kode_penyakit" name="kode_penyakit" maxlength="10" required>
            </div>
            <div class="form-group">
                <label for="nama_penyakit">Nama Penyakit:</label>
                <input type="text" id="nama_penyakit" name="nama_penyakit" required>
            </div>
            <button type="submit" class="btn-tambah">Simpan</button>
            <a href="data_penyakit.php" class="btn-tambah btn-batal">Batal</a>
        </form>
    </div>
</body>
</html>
