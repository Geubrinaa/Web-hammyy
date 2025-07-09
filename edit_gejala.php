<?php
// filepath: c:\xampp\htdocs\WebHammy\edit_gejala.php
session_start();
require 'config.php';

// Ambil data gejala berdasarkan id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Gunakan MySQLi, bukan PDO
    $stmt = $conn->prepare("SELECT * FROM gejala WHERE id_gejala = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $gejala = $result->fetch_assoc();
    $stmt->close();

    if (!$gejala) {
        header('Location: data_gejala.php');
        exit();
    }
} else {
    header('Location: data_gejala.php');
    exit();
}

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namagejala = $_POST['nama_gejala'];
    $stmt = $conn->prepare("UPDATE gejala SET nama_gejala = ? WHERE id_gejala = ?");
    $stmt->bind_param("si", $namagejala, $id);
    $stmt->execute();
    $stmt->close();
    header('Location: data_gejala.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Gejala</title>
    <link rel="stylesheet" href="css/tamdit.css">
</head>
<body>
    <div class="table-page-container">
        <h2>Edit Gejala</h2>
        <form method="post">
            <label for="nama_gejala">Nama Gejala:</label><br>
            <input type="text" id="nama_gejala" name="nama_gejala" value="<?php echo htmlspecialchars($gejala['nama_gejala']); ?>" required><br><br>
            <button type="submit" class="btn-tambah">Simpan</button>
            <a href="data_gejala.php" class="btn-tambah">Batal</a>
        </form>
    </div>
</body>
</html>