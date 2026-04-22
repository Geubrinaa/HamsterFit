<?php
session_start();
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['username'])) {
    header('Location: ../../login_admin.php');
    exit();
}
require '../../includes/config.php';

// Ambil data user dari database
$stmt = $pdo->query('SELECT id_user, nama_user, username, password FROM "user" ORDER BY id_user ASC');
$users = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fixed variable to $users
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50 min-h-screen">
    
    <nav class="bg-indigo-500 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center gap-4">
                    <a href="dashboard.php" class="text-white hover:text-indigo-100 transition-colors p-2 rounded-full hover:bg-indigo-600/50">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </a>
                    <span class="text-white font-bold text-xl tracking-wide">Data Pengguna</span>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="mb-6 bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-gray-700 font-semibold text-lg">Daftar Akun Pengguna (Pemilik)</h2>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Username</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Password (Raw)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-700">
                        <?php if (count($users) > 0): ?>
                            <?php foreach ($users as $i => $user): ?>
                            <tr class="hover:bg-indigo-50/30 transition-colors">
                                <td class="px-6 py-4 text-sm font-semibold text-gray-400"><?= $i+1 ?></td>
                                <td class="px-6 py-4 text-sm text-gray-500">#<?= htmlspecialchars($user['id_user']) ?></td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-800 flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-500 flex items-center justify-center font-bold text-xs">
                                        <?= strtoupper(substr($user['nama_user'], 0, 1)) ?>
                                    </div>
                                    <?= htmlspecialchars($user['nama_user']) ?>
                                </td>
                                <td class="px-6 py-4"><span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-lg text-xs font-semibold tracking-wide border border-gray-200">@<?= htmlspecialchars($user['username']) ?></span></td>
                                <td class="px-6 py-4 text-sm font-mono text-gray-400"><?= str_repeat('•', min(8, strlen($user['password']))) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                    Belum ada pengguna (pemilik) yang terdaftar.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>