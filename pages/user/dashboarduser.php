<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../auth/login_user.php');
    exit();
}

if (!isset($_SESSION['username'])) {
    header('Location: ../auth/login_user.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pemilik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-gradient-to-r from-rose-400 to-pink-500 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-white font-bold text-xl tracking-wide">Area Pemilik</span>
                </div>
                <a href="../auth/logout.php" onclick="return confirm('Anda yakin ingin keluar?')" class="bg-white/10 hover:bg-white/20 text-white border border-white/30 px-4 py-2 rounded-xl text-sm font-semibold transition-all shadow-sm">Logout / Keluar</a>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <header class="mb-10 text-center">
            <h1 class="text-4xl font-bold text-gray-800 tracking-tight">Selamat Datang, <span class="text-rose-500"><?php echo htmlspecialchars($_SESSION['username']); ?>!</span></h1>
            <p class="mt-2 text-gray-500">Mari jaga kesehatan hamstermu agar selalu ceria.</p>
        </header>

        <div class="bg-white rounded-3xl p-8 sm:p-12 shadow-xl border border-rose-50 flex flex-col md:flex-row items-center gap-8 relative overflow-hidden transform hover:-translate-y-1 transition-transform duration-500">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-pink-100 rounded-full blur-3xl opacity-50"></div>
            
            <div class="w-48 h-48 flex-shrink-0 relative z-10">
                <div class="w-full h-full bg-rose-100 rounded-full flex items-center justify-center shadow-inner overflow-hidden border-4 border-white shadow-md">
                    <!-- Inline SVG Hamster Icon instead of missing image -->
                    <svg class="w-24 h-24 text-rose-400" fill="currentColor" viewBox="0 0 24 24">
                        <circle cx="12" cy="14" r="8" opacity="0.2"/>
                        <circle cx="9" cy="11" r="1.5" fill="#333"/>
                        <circle cx="15" cy="11" r="1.5" fill="#333"/>
                        <path d="M12 13c-.5 0-1 .5-1 1h2c0-.5-.5-1-1-1z" fill="#333"/>
                        <path d="M7 6c1-2 4-2 5 0 1-2 4-2 5 0 1 1.5 0 4-1 6-2 3-5 5-9 0-1-2-2-4.5-1-6z" fill="currentColor"/>
                    </svg>
                </div>
            </div>

            <div class="flex-1 text-center md:text-left relative z-10 box-border">
                <h2 class="text-2xl font-bold text-gray-800 mb-3">Hamster kecilmu sedang tidak sehat?</h2>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Jangan khawatir! Ayo kita periksa bersama si mungil kesayanganmu.<br>
                    <span class="text-emerald-500 font-semibold inline-block mt-2 bg-emerald-50 px-3 py-1 rounded-lg">Diagnosis dini adalah kunci menjaga kesehatan hamster.</span>
                </p>
                <a href="isi_data_hamster.php" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-rose-400 to-pink-500 hover:from-rose-500 hover:to-pink-600 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    Mulai Periksa
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>
    </main>
</body>
</html>