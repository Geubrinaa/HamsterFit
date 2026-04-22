<?php
session_start();
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['username'])) {
    header('Location: ../../login_admin.php');
    exit();
}
require '../../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kodegejala = trim($_POST['kode_gejala']);
    $namagejala = trim($_POST['nama_gejala']);
    if (!empty($kodegejala) && !empty($namagejala)) {
        $stmt = $pdo->prepare("INSERT INTO gejala (kode_gejala, nama_gejala) VALUES (:kode_gejala, :nama_gejala)");
        try {
            $stmt->execute(['kode_gejala' => $kodegejala, 'nama_gejala' => $namagejala]);
            header('Location: data_gejala.php');
            exit();
        } catch (PDOException $e) {
            $error = "Kode Gejala sudah digunakan atau terjadi kesalahan!";
        }
    } else {
        $error = "Kode Gejala dan Nama Gejala tidak boleh kosong!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Gejala</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50 min-h-screen py-10 px-4">
    <div class="max-w-xl mx-auto">
        <a href="data_gejala.php" class="inline-flex items-center text-indigo-500 hover:text-indigo-600 font-semibold mb-6 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Data Gejala
        </a>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-indigo-50 p-6 border-b border-indigo-100 text-center">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-sm text-indigo-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Tambah Gejala Penyakit</h2>
                <p class="text-sm text-gray-500 mt-1">Masukkan rincian gejala baru untuk melengkapi basis pengetahuan</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="bg-rose-50 text-rose-600 p-4 font-semibold text-center mt-4 mx-8 rounded-xl border border-rose-100"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="post" class="p-8 space-y-5">
                <div>
                    <label for="kode_gejala" class="block text-sm font-semibold text-gray-700 mb-2">Kode Gejala</label>
                    <input type="text" id="kode_gejala" name="kode_gejala" maxlength="10" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 outline-none transition-all placeholder-gray-400 font-mono" placeholder="Contoh: G001">
                </div>
                
                <div>
                    <label for="nama_gejala" class="block text-sm font-semibold text-gray-700 mb-2">Nama Gejala</label>
                    <input type="text" id="nama_gejala" name="nama_gejala" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 outline-none transition-all placeholder-gray-400" placeholder="Contoh: Bulu rontok berlebihan">
                </div>

                <div class="pt-4 flex gap-4">
                    <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 rounded-xl shadow-md transition-all transform hover:-translate-y-0.5">
                        Simpan Data
                    </button>
                    <a href="data_gejala.php" class="flex-1 bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 font-bold py-3.5 rounded-xl text-center transition-all">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
