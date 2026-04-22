<?php
session_start();
require '../../includes/config.php';

// Proses simpan data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namahamster   = trim($_POST['namahamster']);
    $jenishamster  = $_POST['jenishamster'];
    $jeniskel      = $_POST['jeniskel'];
    $umur          = intval($_POST['umur']);
    $id_user       = $_SESSION['id_user'] ?? 1; // Ganti dengan session user login

    $stmt = $pdo->prepare("INSERT INTO data_hamster (id_user, namahamster, jenishamster, jeniskel, umur) VALUES (?, ?, ?, ?, ?)");
    $sukses = $stmt->execute([$id_user, $namahamster, $jenishamster, $jeniskel, $umur]);

    if ($sukses) {
        $id_hamster_baru = $pdo->lastInsertId();
        header("Location: pilih_gejala.php?id_hamster=$id_hamster_baru");
        exit();
    } else {
        $pesan = "Gagal menyimpan data hamster.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Hamster</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50 min-h-screen py-10 px-4">
    <div class="max-w-xl mx-auto">
        <a href="dashboarduser.php" class="inline-flex items-center text-rose-500 hover:text-rose-600 font-semibold mb-6 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>

        <div class="bg-white rounded-3xl shadow-xl border border-rose-50 overflow-hidden">
            <div class="bg-rose-50 p-6 border-b border-rose-100 text-center">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm text-rose-500">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800">Profil Pasien Hamster</h2>
                <p class="text-sm text-gray-500 mt-1">Lengkapi data agar diagnosis lebih akurat</p>
            </div>

            <?php if (isset($pesan)) echo "<div class='bg-rose-50 text-rose-600 p-4 font-semibold text-center mt-4 mx-8 rounded-xl'>$pesan</div>"; ?>
            
            <form method="post" autocomplete="off" class="p-8 space-y-5">
                <div>
                    <label for="namahamster" class="block text-sm font-semibold text-gray-700 mb-2">Nama Panggilan</label>
                    <input type="text" id="namahamster" name="namahamster" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-rose-200 focus:border-rose-400 outline-none transition-all placeholder-gray-400" placeholder="Siapa namanya?">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="jenishamster" class="block text-sm font-semibold text-gray-700 mb-2">Ras / Jenis</label>
                        <select id="jenishamster" name="jenishamster" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-rose-200 focus:border-rose-400 outline-none transition-all bg-white text-gray-700 font-medium">
                            <option value="">Pilih...</option>
                            <option value="Syrian">Syrian</option>
                            <option value="Winter White">Winter White</option>
                            <option value="Campbell">Campbell</option>
                            <option value="Roborovski">Roborovski</option>
                        </select>
                    </div>
                    <div>
                        <label for="jeniskel" class="block text-sm font-semibold text-gray-700 mb-2">Kelamin</label>
                        <select id="jeniskel" name="jeniskel" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-rose-200 focus:border-rose-400 outline-none transition-all bg-white text-gray-700 font-medium">
                            <option value="">Pilih...</option>
                            <option value="Jantan">Jantan</option>
                            <option value="Betina">Betina</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="umur" class="block text-sm font-semibold text-gray-700 mb-2">Umur (Bulan)</label>
                    <input type="number" id="umur" name="umur" min="1" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-rose-200 focus:border-rose-400 outline-none transition-all bg-white" placeholder="Contoh: 3">
                </div>

                <button type="submit" class="w-full mt-4 bg-gray-800 hover:bg-gray-900 text-white font-bold py-4 rounded-xl shadow-md transition-all transform hover:-translate-y-0.5 text-lg">
                    Simpan Profil
                </button>
            </form>
        </div>
    </div>
</body>
</html>