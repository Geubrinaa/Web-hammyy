<?php
session_start();
require 'config.php';

// Gunakan $conn (MySQLi) bukan $pdo (PDO)
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Hapus data berdasarkan id_rule
    $stmt = $conn->prepare("DELETE FROM aturan WHERE id_rule = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header('Location: data_aturan.php');
exit();