<?php
// filepath: c:\xampp\htdocs\WebHammy\edit_penyakti.php
session_start();
require 'config.php';

// Ambil data penyakit berdasarkan id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM penyakit WHERE id_penyakit = :id");
    $stmt->execute(['id' => $id]);
    $penyakit = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$penyakit) {
        header('Location: data_penyakit.php');
        exit();
    }
} else {
    header('Location: data_penyakit.php');
    exit();
}
// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namapenyakit = $_POST['nama_penyakit'];
    $stmt = $pdo->prepare("UPDATE penyakit SET nama_penyakit = :nama_penyakit WHERE id_penyakit = :id");
    $stmt->execute([
        'nama_penyakit' => $namapenyakit,
        'id' => $id
    ]);
    header('Location: data_penyakit.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Penyakit</title>
    <link rel="stylesheet" href="css/tamdit.css">
</head>
<body>
    <div class="table-page-container">
        <h2>Edit Penyakit</h2>
        <form method="post">
            <label for="nama_penyakit">Nama Penyakit:</label><br>
            <input type="text" id="nama_penyakit" name="nama_penyakit" value="<?php echo htmlspecialchars($penyakit['nama_penyakit']); ?>" required><br><br>
            <button type="submit" class="btn-tambah">Simpan</button>
            <a href="data_penyakit.php" class="btn-tambah">Batal</a>
        </form>
    </div>
</body>
</html>
