<?php
session_start();
require 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPenyakit = trim($_POST['id_penyakit']);
    $idGejala = trim($_POST['id_gejala']);

    if (!empty($idPenyakit) && !empty($idGejala)) {
        // Gunakan MySQLi, bukan PDO, agar konsisten dengan file lain
        $stmt = $conn->prepare("INSERT INTO aturan (id_penyakit, id_gejala) VALUES (?, ?)");
        if ($stmt) {
            $stmt->bind_param("ii", $idPenyakit, $idGejala);
            if ($stmt->execute()) {
                header('Location: data_aturan.php');
                exit();
            } else {
                $error = "Aturan sudah ada atau terjadi kesalahan!";
            }
            $stmt->close();
        } else {
            $error = "Terjadi kesalahan pada query!";
        }
    } else {
        $error = "Semua field harus diisi!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Aturan</title>
    <link rel="stylesheet" href="css/tamdit.css">
</head>
<body>
    <div class="table-page-container">
        <h2 class="judul-penyakit">Tambah Aturan</h2>
        <?php if (!empty($error)): ?>
            <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post" class="form-tambah-penyakit">
            <div class="form-group">
                <label for="id_penyakit">ID Penyakit:</label>
                <input type="number" id="id_penyakit" name="id_penyakit" required>
            </div>
            <div class="form-group">
                <label for="id_gejala">ID Gejala:</label>
                <input type="number" id="id_gejala" name="id_gejala" required>
            </div>
            <button type="submit" class="btn-tambah">Simpan</button>
            <a href="data_aturan.php" class="btn-tambah btn-batal">Batal</a>
        </form>
    </div>
</body>
</html>
