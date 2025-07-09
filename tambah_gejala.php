<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kodegejala = trim($_POST['kode_gejala']);
    $namagejala = trim($_POST['nama_gejala']);
    if (!empty($kodegejala) && !empty($namagejala)) {
        $stmt = $pdo->prepare("INSERT INTO gejala(kode_gejala, nama_gejala VALUES (:kode_gejala, :nama_gejala)");
        try {
            $stmt->execute(['kode_gejalat' => $kodegejala, 'nama_gejala' => $namagejala]);
            header('Location: data_gejala.php');
            exit();
        } catch (PDOException $e) {
            $error = "Kode Gejala sudah digunakan atau terjadi kesalahan!";
        }
    } else {
        $error = "Kode Gejala dan Nama Gejala tidak boleh kosong!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Gejala</title>
    <link rel="stylesheet" href="css/tamdit.css">
</head>
<body>
    <div class="table-page-container">
        <h2 class="judul-gejala">Tambah Gejala</h2>
        <?php if (!empty($error)): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" class="form-tambah-gejala">
            <div class="form-group">
                <label for="kode_gejala">Kode Gejala:</label>
                <input type="text" id="kode_gejala" name="kode_gejala" maxlength="10" required>
            </div>
            <div class="form-group">
                <label for="nama_gejala">Nama Gejala:</label>
                <input type="text" id="nama_gejala" name="nama_gejala" required>
            </div>
            <button type="submit" class="btn-tambah">Simpan</button>
            <a href="data_gejala.php" class="btn-tambah btn-batal">Batal</a>
        </form>
    </div>
</body>
</html>
