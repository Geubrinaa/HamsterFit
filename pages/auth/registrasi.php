<?php
session_start();
require '../../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = trim($_POST['nama']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validasi
    if ($password !== $confirm_password) {
        $error = "Konfirmasi password tidak cocok!";
    } else {
        // Cek username sudah ada atau belum
        $stmt = $pdo->prepare('SELECT * FROM "user" WHERE username = :username');
        $stmt->execute(['username' => $username]);
        if ($stmt->fetch()) {
            $error = "Username sudah terdaftar!";
        } else {
            // Simpan user baru
            $stmt = $pdo->prepare('INSERT INTO "user" (nama_user, username, password) VALUES (:nama, :username, :password)');
            $stmt->execute([
                'nama' => $nama,
                'username' => $username,
                'password' => $password // Ganti dengan password_hash jika ingin hash
            ]);
            header('Location: login_user.php');
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pemilik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gradient-to-br from-pink-100 via-rose-50 to-orange-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white/80 backdrop-blur-xl border border-white/50 shadow-2xl rounded-3xl p-8 max-w-sm w-full transition-all duration-300 transform hover:scale-[1.01]">
        
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Daftar Akun</h2>
            <p class="text-sm text-gray-500 mt-1">Gabung untuk cek kesehatan hamstermu!</p>
        </div>

        <form method="post" action="" class="space-y-4">
            <div>
                <label for="nama" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" required
                    class="w-full px-4 py-2.5 rounded-xl bg-white/50 border border-rose-100 focus:border-rose-400 focus:ring-2 focus:ring-rose-100 transition-all outline-none text-gray-700 shadow-sm" placeholder="Nama asli kamu">
            </div>
            <div>
                <label for="username" class="block text-sm font-semibold text-gray-700 mb-1">Username</label>
                <input type="text" id="username" name="username" required
                    class="w-full px-4 py-2.5 rounded-xl bg-white/50 border border-rose-100 focus:border-rose-400 focus:ring-2 focus:ring-rose-100 transition-all outline-none text-gray-700 shadow-sm" placeholder="Pilih username unik">
            </div>
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2.5 rounded-xl bg-white/50 border border-rose-100 focus:border-rose-400 focus:ring-2 focus:ring-rose-100 transition-all outline-none text-gray-700 shadow-sm" placeholder="••••••••">
            </div>
            <div>
                <label for="confirm_password" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required
                    class="w-full px-4 py-2.5 rounded-xl bg-white/50 border border-rose-100 focus:border-rose-400 focus:ring-2 focus:ring-rose-100 transition-all outline-none text-gray-700 shadow-sm" placeholder="••••••••">
            </div>
            
            <?php if (isset($error)) { echo "<div class='text-rose-500 text-sm bg-rose-50 p-3 rounded-lg border border-rose-100 flex items-center gap-2'><svg class='w-4 h-4 min-w-[1rem]' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'></path></svg>$error</div>"; } ?>

            <button type="submit" class="w-full bg-gradient-to-r from-rose-400 to-pink-500 hover:from-rose-500 hover:to-pink-600 text-white font-bold py-3.5 rounded-xl shadow-lg hover:shadow-rose-200 transition-all duration-300 transform hover:-translate-y-0.5 mt-2">
                Daftar Sekarang
            </button>
        </form>
        
        <div class="mt-6 text-center space-y-2">
            <p class="text-sm text-gray-500">Sudah punya akun? <a href="login_user.php" class="text-pink-500 hover:text-pink-600 font-bold transition-colors">Masuk di sini</a></p>
        </div>
    </div>
</body>
</html>