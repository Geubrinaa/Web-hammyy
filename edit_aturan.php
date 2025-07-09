<?php
// filepath: c:\xampp\htdocs\WebHammy\edit_aturan.php
session_start();
require 'config.php';

// Ambil data aturan berdasarkan id
if (!isset($_GET['id'])) {
    header('Location: data_aturan.php');
    exit();
}

// Ganti PDO dengan MySQLi
$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM aturan WHERE id_rule = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$aturan = $result->fetch_assoc();
$stmt->close();

if (!$aturan) {
    header('Location: data_aturan.php');
    exit();
}

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_penyakit = $_POST['id_penyakit'];
    $id_gejala = $_POST['id_gejala'];

    $stmt = $conn->prepare("UPDATE aturan SET id_penyakit = ?, id_gejala = ? WHERE id_rule = ?");
    $stmt->bind_param("iii", $id_penyakit, $id_gejala, $id);
    $stmt->execute();
    $stmt->close();
    header('Location: data_aturan.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Aturan</title>
    <link rel="stylesheet" href="css/tamdit.css">
</head>
<body>
    <div class="table-page-container">
        <h2>Edit Aturan</h2>
        <form method="post">
            <label for="id_penyakit">ID Penyakit:</label><br>
            <input type="text" id="id_penyakit" name="id_penyakit" value="<?php echo htmlspecialchars($aturan['id_penyakit']); ?>" required><br><br>
            <label for="id_gejala">ID Gejala:</label><br>
            <input type="text" id="id_gejala" name="id_gejala" value="<?php echo htmlspecialchars($aturan['id_gejala']); ?>" required><br><br>
            <button type="submit" class="btn-tambah">Simpan</button>
            <a href="data_aturan.php" class="btn-tambah">Batal</a>
        </form>
    </div>
</body>
</html>