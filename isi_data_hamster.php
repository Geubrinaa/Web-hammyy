<?php
session_start();
require 'config.php';
$id_user = $_SESSION['id_user'] ?? 1;

// Proses simpan data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namahamster  = trim($_POST['nama']);
    $jenishamster = $_POST['jenishamster'];
    $jeniskel     = $_POST['jeniskel'];
    $umur         = intval($_POST['umur']);
    $id_user      = $_SESSION['id_user'] ?? 1; // Ganti dengan session user login

    $stmt = $conn->prepare("INSERT INTO hamster (id_user, nama, jenis_hamster, jenis_kelamin, umur) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $id_user, $namahamster, $jenishamster, $jeniskel, $umur);
    $sukses = $stmt->execute();
    $id_hamster_baru = $conn->insert_id;
    $stmt->close();

    if ($sukses) {
        header("Location: pilih_gejala.php?id_hamster=$id_hamster_baru");
        exit();
    } else {
        $pesan = "Gagal menyimpan data hamster.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Data Hamster</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="image/logo.png" type="image/png">
    <link rel="stylesheet" href="css/hamster.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="hamster-form-container">
        <h2>Isi Data Hamster</h2>
        <?php if (isset($pesan)) echo "<div class='pesan'>$pesan</div>"; ?>
        <form method="post" autocomplete="off">
            <div class="form-group">
                <label for="nama">Nama Hamster</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="jenishamster">Jenis Hamster</label>
                <select id="jenishamster" name="jenishamster" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="Syrian">Syrian</option>
                    <option value="Winter White">Winter White</option>
                    <option value="Campbell">Campbell</option>
                    <option value="Roborovski">Roborovski</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jeniskel">Jenis Kelamin</label>
                <select id="jeniskel" name="jeniskel" required>
                    <option value="">-- Pilih Kelamin --</option>
                    <option value="Jantan">Jantan</option>
                    <option value="Betina">Betina</option>
                </select>
            </div>
            <div class="form-group">
                <label for="umur">Umur (bulan)</label>
                <input type="number" id="umur" name="umur" min="1" required>
            </div>
            <button type="submit">Simpan</button>
        </form>
    </div>
</body>
</html>