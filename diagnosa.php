<?php
session_start();
require 'config.php';

$id_hamster = isset($_GET['id_hamster']) ? intval($_GET['id_hamster']) : 0;
$id_user = $_SESSION['id_user'] ?? 1;

// Ambil gejala yang dipilih user dari session
$selected_gejala = $_SESSION['selected_gejala'] ?? [];

// Ambil basis aturan (rule) dari database (MySQLi)
$result = $conn->query("SELECT id_rule, id_penyakit, id_gejala FROM aturan");
$rules = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $rules[] = $row;
    }
}

// Ambil data penyakit
$result2 = $conn->query("SELECT id_penyakit, nama_penyakit FROM penyakit");
$penyakit_list = [];
if ($result2) {
    while ($p = $result2->fetch_assoc()) {
        $penyakit_list[$p['id_penyakit']] = $p;
    }
}

// Ambil data gejala (untuk menampilkan detail gejala pilihan user)
$result3 = $conn->query("SELECT id_gejala, kode_gejala, nama_gejala FROM gejala");
$all_gejala = [];
if ($result3) {
    while ($g = $result3->fetch_assoc()) {
        $all_gejala[$g['id_gejala']] = $g;
    }
}

// === FORWARD CHAINING START ===
$hasil_diagnosa = [];
if (!empty($selected_gejala)) {
    // Kelompokkan rule per penyakit
    $rule_per_penyakit = [];
    foreach ($rules as $rule) {
        $rule_per_penyakit[$rule['id_penyakit']][] = $rule['id_gejala'];
    }
    // Proses forward chaining
    foreach ($rule_per_penyakit as $id_penyakit => $gejala_penyakit) {
        // Jika semua gejala penyakit ada di gejala yang dipilih user
        if (count(array_diff($gejala_penyakit, $selected_gejala)) === 0) {
            $hasil_diagnosa[] = $penyakit_list[$id_penyakit];
        }
    }
}
// === FORWARD CHAINING END ===

// Simpan hasil diagnosa ke tabel diagnosa (jika belum ada di hari yang sama & hamster yang sama)
// Ambil id_diagnosa yang benar untuk laporan
$id_diagnosa = null;
if (!empty($hasil_diagnosa)) {
    $penyakit = $hasil_diagnosa[0]; // Ambil penyakit pertama yang cocok
    $hasil_text = $penyakit['nama_penyakit'];
    $tanggal = date('Y-m-d H:i:s');

    // Cek apakah sudah ada diagnosa untuk hamster ini pada hari yang sama
    $cek = $conn->prepare("SELECT id_diagnosa FROM diagnosa WHERE id_user=? AND id_hamster=? AND DATE(tanggal)=CURDATE()");
    $cek->bind_param("ii", $id_user, $id_hamster);
    $cek->execute();
    $cek->bind_result($id_diagnosa_row);
    $cek->fetch();
    $cek->close();

    if (!$id_diagnosa_row) {
        $stmt = $conn->prepare("INSERT INTO diagnosa (id_user, id_hamster, id_penyakit, tanggal, hasil) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiss", $id_user, $id_hamster, $penyakit['id_penyakit'], $tanggal, $hasil_text);
        $stmt->execute();
        $id_diagnosa = $conn->insert_id;
        $stmt->close();
    } else {
        $id_diagnosa = $id_diagnosa_row;
    }
} else {
    $hasil_text = "Tidak ditemukan penyakit yang cocok dengan gejala yang dipilih.";
    $id_diagnosa = null; // pastikan null jika tidak ada hasil
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Diagnosa Hamster</title>
    <link rel="stylesheet" href="css/diagnosa.css">
</head>
<body>
    <div class="diagnosa-container">
        <h2 class="diagnosa-title">Hasil Diagnosa</h2>
        <div class="diagnosa-hasil">
            <span class="diagnosa-label">Penyakit:</span>
            <span class="diagnosa-value"><?= htmlspecialchars($hasil_text) ?></span>
        </div>
        <div class="diagnosa-gejala">
            <span class="diagnosa-label">Gejala yang dialami:</span>
            <ul class="diagnosa-gejala-list">
                <?php
                if (!empty($selected_gejala)) {
                    foreach ($selected_gejala as $idg) {
                        if (isset($all_gejala[$idg])) {
                            echo '<li><strong>' . htmlspecialchars($all_gejala[$idg]['kode_gejala']) . '</strong> - ' . htmlspecialchars($all_gejala[$idg]['nama_gejala']) . '</li>';
                        }
                    }
                } else {
                    echo '<li>Tidak ada gejala dipilih.</li>';
                }
                ?>
            </ul>
        </div>
        <a href="pilih_gejala.php" class="btn-kembali">Diagnosis ulang</a>
        <?php if ($id_diagnosa): ?>
            <a href="laporan.php?id_diagnosa=<?= $id_diagnosa ?>" class="btn-laporan" style="display:inline-block;margin-top:12px;">Lihat Laporan</a>
        <?php endif; ?>
    </div>
</body>
</html>