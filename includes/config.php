<?php
$host     = "aws-1-ap-southeast-1.pooler.supabase.com";
$port     = "6543";
$username = "postgres.osqiutlpgtxliqtyudda";
$password = "rinabaik23.";
$database = "postgres";

try {
    // Menggunakan pgsql driver dengan sslmode=require yang disarankan untuk Supabase
    $dsn = "pgsql:host=$host;port=$port;dbname=$database;sslmode=require";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>
