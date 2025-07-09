<?php
require 'config.php';

$id_diagnosa = isset($_GET['id_diagnosa']) ? intval($_GET['id_diagnosa']) : 0;
$data = [];
if ($id_diagnosa) {
    $stmt = $conn->prepare("SELECT d.*, h.nama, h.jenis_hamster, h.jenis_kelamin, h.umur 
        FROM diagnosa d
        INNER JOIN hamster h ON d.id_hamster = h.id_hamster
        WHERE d.id_diagnosa = ?");
    $stmt->bind_param("i", $id_diagnosa);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Diagnosa Hamster</title>
    <link rel="stylesheet" href="css/laporan_diagnosa.css">
</head>
<body>
<div class="laporan-container">
    <h2 style="text-align:center;">Laporan Diagnosa Hamster</h2>
    <table>
        <tr>
            <td class="judul">Nama Hamster</td>
            <td>: <?= htmlspecialchars($data['nama'] ?? '-') ?></td>
        </tr>
        <tr>
            <td class="judul">Jenis Hamster</td>
            <td>: <?= htmlspecialchars($data['jenis_hamster'] ?? '-') ?></td>
        </tr>
        <tr>
            <td class="judul">Jenis Kelamin</td>
            <td>: <?= htmlspecialchars($data['jenis_kelamin'] ?? '-') ?></td>
        </tr>
        <tr>
            <td class="judul">Umur</td>
            <td>: <?= htmlspecialchars($data['umur'] ?? '-') ?></td>
        </tr>
    </table>
    <div class="hasil-diagnosa">
        Hasil Diagnosa: <br>
        <?= htmlspecialchars($data['hasil'] ?? 'Belum ada hasil diagnosa') ?>
    </div>
    <div class="ttd-container">
        <?php
            $namaHari = [
                'Sunday' => 'Minggu',
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu'
            ];
            $tanggal = $data['tanggal'] ?? '2025-07-09';
            $hari = $namaHari[date('l', strtotime($tanggal))];
            $tanggalIndo = date('d-m-y', strtotime($tanggal));
        ?>
        Jakarta, <?= $hari . ', ' . $tanggalIndo ?><br>
        Dokter Spesialis Hewan
        <br><br><br>
        Mengetahui,<br>
        <strong>Dr. John Doe</strong>
    </div>
    <div class="btn-print-container">
        <button class="btn-print" onclick="window.print()">Print Laporan</button>
    </div>
</div>
</body>
</html>