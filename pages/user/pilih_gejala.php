<?php
session_start();
require '../../includes/config.php';

// Ambil id_hamster dari URL
$id_hamster = isset($_GET['id_hamster']) ? intval($_GET['id_hamster']) : 0;

// Ambil daftar gejala dari database
$stmt = $pdo->query("SELECT id_gejala, kode_gejala, nama_gejala FROM gejala ORDER BY kode_gejala");
$gejala = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Jika form disubmit, redirect ke diagnosa dengan data gejala terpilih
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['gejala'])) {
    $selected_gejala = $_POST['gejala'];
    $_SESSION['selected_gejala'] = $selected_gejala;
    header('Location: diagnosa.php?id_hamster=' . $id_hamster);
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pilih Gejala Hamster</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50 min-h-screen py-10 px-4">
    <div class="max-w-3xl mx-auto">
        <a href="isi_data_hamster.php" class="inline-flex items-center text-rose-500 hover:text-rose-600 font-semibold mb-6 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-rose-100">
            <div class="bg-gradient-to-r from-rose-400 to-pink-500 p-8 text-center text-white">
                <svg class="w-16 h-16 mx-auto mb-4 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                <h2 class="text-3xl font-bold tracking-tight">Pilih Gejala</h2>
                <p class="text-rose-100 mt-2">Centang semua yang dialami oleh hamstermu saat ini</p>
            </div>

            <form method="post" class="p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                    <?php foreach ($gejala as $g): ?>
                        <label class="flex items-start gap-4 p-4 border border-gray-200 rounded-2xl hover:bg-rose-50/50 hover:border-rose-200 cursor-pointer transition-all duration-300 group">
                            <div class="flex items-center h-5 mt-1">
                                <input type="checkbox" name="gejala[]" value="<?= htmlspecialchars($g['id_gejala']) ?>" class="w-5 h-5 text-rose-500 bg-gray-100 border-gray-300 rounded focus:ring-rose-500 focus:ring-2 cursor-pointer">
                            </div>
                            <div class="text-sm">
                                <p class="font-bold text-gray-800 group-hover:text-rose-600 transition-colors"><?= htmlspecialchars($g['kode_gejala']) ?></p>
                                <p class="text-gray-500"><?= htmlspecialchars($g['nama_gejala']) ?></p>
                            </div>
                        </label>
                    <?php endforeach; ?>
                </div>

                <div class="flex justify-center border-t border-gray-100 pt-8">
                    <button type="submit" class="bg-gradient-to-r from-emerald-400 to-teal-500 hover:from-emerald-500 hover:to-teal-600 text-white font-bold py-3.5 px-10 rounded-full shadow-lg hover:shadow-emerald-200 transition-all duration-300 transform hover:-translate-y-0.5 text-lg w-full max-w-sm">
                        Lanjut Diagnosa
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>