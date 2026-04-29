<?php
ob_start(); // Start output buffering to prevent premature output
session_start();

require '../../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? ''); // Ensure username is set
    $password = trim($_POST['password'] ?? ''); // Ensure password is set

    if (empty($username) || empty($password)) {
        $error = 'Username dan password tidak boleh kosong!';
    } else {
        try {
            // Cek user berdasarkan username
            $stmt = $pdo->prepare('SELECT * FROM "user" WHERE username = :username');
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            error_log("Login attempt - Username: '$username', User found: " . ($user ? "YES" : "NO"));
            
            if ($user) {
                // Check password - juga cek dengan trim
                $db_password = trim($user['password']);
                $input_password = trim($password);
                
                error_log("Password comparison - DB: '$db_password' | Input: '$input_password' | Match: " . ($db_password === $input_password ? "YES" : "NO"));
                
                if ($db_password === $input_password) {
                    // Set session variables
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['id_user'] = $user['id_user'];
                    $_SESSION['nama_user'] = $user['nama_user'];
                    
                    error_log("✓ LOGIN SUCCESS for user: " . $user['username'] . " (ID: " . $user['id_user'] . ")");
                    error_log("Session data: " . json_encode($_SESSION));
                    
                    // Clear buffer and redirect
                    ob_end_clean();
                    header('Location: ../user/dashboarduser.php', true, 302);
                    exit();
                } else {
                    $error = 'Username atau password salah!';
                    error_log("✗ Password mismatch for user: $username");
                }
            } else {
                $error = 'Username atau password salah!';
                error_log("✗ User tidak ditemukan: $username");
            }
        } catch (Exception $e) {
            $error = 'Terjadi kesalahan: ' . $e->getMessage();
            error_log("✗ Login error: " . $e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pemilik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gradient-to-br from-pink-100 via-rose-50 to-orange-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white/80 backdrop-blur-xl border border-white/50 shadow-2xl rounded-3xl p-8 max-w-sm w-full transition-all duration-300 transform hover:scale-[1.01]">
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-rose-100 text-rose-500 rounded-full mb-4 shadow-inner">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Login Pemilik</h2>
            <p class="text-sm text-gray-500 mt-1">Akses cek kesehatan hamster-mu</p>
        </div>

        <form method="post" action="" class="space-y-5">
            <div>
                <label for="username" class="block text-sm font-semibold text-gray-700 mb-1.5">Username</label>
                <input type="text" id="username" name="username" required
                    class="w-full px-4 py-3 rounded-xl bg-white/50 border border-rose-100 focus:border-rose-400 focus:ring-2 focus:ring-rose-100 transition-all outline-none text-gray-700 shadow-sm" placeholder="Username kamu">
            </div>
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-3 rounded-xl bg-white/50 border border-rose-100 focus:border-rose-400 focus:ring-2 focus:ring-rose-100 transition-all outline-none text-gray-700 shadow-sm" placeholder="••••••••">
            </div>
            
            <?php if (isset($error)) { echo "<div class='text-rose-500 text-sm bg-rose-50 p-3 rounded-lg border border-rose-100 flex items-center gap-2'><svg class='w-4 h-4 min-w-[1rem]' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'></path></svg>$error</div>"; } ?>

            <button type="submit" class="w-full bg-gradient-to-r from-rose-400 to-pink-500 hover:from-rose-500 hover:to-pink-600 text-white font-bold py-3.5 rounded-xl shadow-lg hover:shadow-rose-200 transition-all duration-300 transform hover:-translate-y-0.5 mt-2">
                Mulai Periksa
            </button>
        </form>
        
        <div class="mt-6 text-center space-y-2">
            <a href="registrasi.php" class="text-sm text-pink-500 hover:text-pink-600 font-bold transition-colors block">Belum punya akun? Daftar gratis</a>
            <a href="../../index.php" class="text-xs text-gray-400 hover:text-gray-500 transition-colors block">← Kembali ke Portal</a>
        </div>
    </div>
</body>
</html>