<?php
session_start();
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['username'])) {
    header('Location: ../auth/login_admin.php');
    exit();
}
require '../../includes/config.php';

// Ambil data gejala berdasarkan id
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM gejala WHERE id_gejala = :id");
    $stmt->execute(['id' => $id]);
    $gejala = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$gejala) {
        header('Location: data_gejala.php');
        exit();
    }
} else {
    header('Location: data_gejala.php');
    exit();
}

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namagejala = $_POST['nama_gejala'];
    $stmt = $pdo->prepare("UPDATE gejala SET nama_gejala = :nama_gejala WHERE id_gejala = :id");
    $stmt->execute([
        'nama_gejala' => $namagejala,
        'id' => $id
    ]);
    header('Location: data_gejala.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Gejala</title>
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
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Edit Data Gejala</h2>
                <p class="text-sm text-gray-500 mt-1">Perbarui nama gejala untuk Kode <span class="font-bold text-indigo-500 font-mono"><?php echo htmlspecialchars($gejala['kode_gejala']); ?></span></p>
            </div>
            
            <form method="post" class="p-8 space-y-5">
                <div>
                    <label for="nama_gejala" class="block text-sm font-semibold text-gray-700 mb-2">Nama Gejala Baru</label>
                    <input type="text" id="nama_gejala" name="nama_gejala" value="<?php echo htmlspecialchars($gejala['nama_gejala']); ?>" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-400 outline-none transition-all">
                </div>

                <div class="pt-4 flex gap-4">
                    <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 rounded-xl shadow-md transition-all transform hover:-translate-y-0.5">
                        Simpan Perubahan
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