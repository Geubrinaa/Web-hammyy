<?php
session_start();
require 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Hapus aturan yang terkait dengan id_gejala ini
    $delAturan = $conn->prepare("DELETE FROM aturan WHERE id_gejala = ?");
    $delAturan->bind_param("i", $id);
    $delAturan->execute();
    $delAturan->close();

    // Hapus data gejala
    $delGejala = $conn->prepare("DELETE FROM gejala WHERE id_gejala = ?");
    $delGejala->bind_param("i", $id);
    $delGejala->execute();
    if ($conn->affected_rows === 0) {
        die("Data tidak terhapus. Mungkin id ($id) tidak ditemukan di tabel gejala, atau error lain.");
    }
    $delGejala->close();
}

header('Location: data_gejala.php');
exit();