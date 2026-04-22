<?php
session_start();
require '../../includes/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Hapus data berdasarkan IdGejala
    $stmt = $pdo->prepare("DELETE FROM gejala WHERE id_gejala = :id");
    $stmt->execute(['id' => $id]);
}

header('Location: data_gejala.php');
exit();