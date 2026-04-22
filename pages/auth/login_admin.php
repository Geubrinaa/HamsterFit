<?php
session_start();
require '../../includes/config.php'; // Pastikan $pdo sudah ada di sini

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek user
    $stmt = $pdo->prepare('SELECT * FROM admin WHERE username = :username');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Jika user ditemukan dan password cocok
    if ($user && $password === $user['password']) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user['username'];
        header('Location: ../admin/dashboard.php');
        exit();
    } else {
        $error = 'Username atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gradient-to-br from-indigo-100 via-purple-50 to-pink-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white/80 backdrop-blur-xl border border-white/50 shadow-2xl rounded-3xl p-8 max-w-sm w-full transition-all duration-300 transform hover:scale-[1.01]">
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-100 text-indigo-500 rounded-full mb-4 shadow-inner">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-800">Admin Login</h2>
            <p class="text-sm text-gray-500 mt-1">Sistem Manajemen Hamster</p>
        </div>

        <form method="post" action="" class="space-y-5">
            <div>
                <label for="username" class="block text-sm font-semibold text-gray-700 mb-1.5">Username</label>
                <input type="text" id="username" name="username" required
                    class="w-full px-4 py-3 rounded-xl bg-white/50 border border-indigo-100 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all outline-none text-gray-700 shadow-sm" placeholder="Masukkan username admin">
            </div>
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-3 rounded-xl bg-white/50 border border-indigo-100 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all outline-none text-gray-700 shadow-sm" placeholder="••••••••">
            </div>
            
            <?php if (isset($error)) { echo "<div class='text-rose-500 text-sm bg-rose-50 p-3 rounded-lg border border-rose-100 flex items-center gap-2'><svg class='w-4 h-4' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'></path></svg>$error</div>"; } ?>

            <button type="submit" class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-3.5 rounded-xl shadow-lg hover:shadow-indigo-200 transition-all duration-300 transform hover:-translate-y-0.5 mt-2">
                Sign In
            </button>
        </form>
        
        <div class="mt-6 text-center">
            <a href="../../index.php" class="text-sm text-indigo-400 hover:text-indigo-600 font-medium transition-colors">← Kembali ke Portal</a>
        </div>
    </div>
</body>
</html>