<?php
session_start();
require 'config.php';

$id_hamster = isset($_GET['id_hamster']) ? intval($_GET['id_hamster']) : 0;

// Ambil daftar gejala dari database (gunakan MySQLi, bukan PDO)
$result = $conn->query("SELECT id_gejala, kode_gejala, nama_gejala FROM gejala ORDER BY kode_gejala");
$gejala_list = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $gejala_list[] = $row;
    }
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['gejala'])) {
    $_SESSION['selected_gejala'] = $_POST['gejala'];
    header("Location: diagnosa.php?id_hamster=$id_hamster");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pilih Gejala Hamster</title>
    <link rel="stylesheet" href="css/pilihgejala.css">
</head>
<body>
    <div class="outer-gejala-container">
        <h1 class="judul-gejala">Pilih Gejala Hamster</h1>
        <form method="post" autocomplete="off">
            <div class="gejala-bubble-wrap-all">
                <?php foreach ($gejala_list as $g): ?>
                    <label class="gejala-bubble">
                        <input type="checkbox" name="gejala[]" value="<?= htmlspecialchars($g['id_gejala']) ?>">
                        <span><strong><?= htmlspecialchars($g['kode_gejala']) ?></strong> - <?= htmlspecialchars($g['nama_gejala']) ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
            <div class="btn-lanjut-container">
                <button type="submit" class="btn-lanjut">Selanjutnya</button>
            </div>
        </form>
    </div>
</body>
</html>