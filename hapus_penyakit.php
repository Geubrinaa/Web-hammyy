<?php
session_start();
require 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Hapus data berdasarkan IdGejala
    $stmt = $pdo->prepare("DELETE FROM penyakit WHERE id_penyakit = :id");
    $stmt->execute(['id' => $id]);
}

header('Location: data_penyakit.php');
exit();