<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Portal Login Hammy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gradient-to-br from-rose-100 via-pink-100 to-indigo-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white/70 backdrop-blur-xl border border-white/40 shadow-2xl rounded-3xl p-8 max-w-sm w-full text-center hover:shadow-indigo-200/50 transition-shadow duration-500">
        
        <div class="mb-6 inline-block bg-white p-3 rounded-full shadow-sm">
            <svg class="w-12 h-12 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>

        <h1 class="text-3xl font-bold text-gray-800 mb-8 tracking-tight">Portal <span class="text-rose-500">Hammy</span></h1>

        <div class="space-y-4">
            <a href="login_admin.php" class="group flex items-center justify-center gap-3 bg-white hover:bg-rose-50 border-2 border-transparent hover:border-rose-200 text-gray-700 py-3.5 px-6 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                <svg class="w-6 h-6 text-indigo-500 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                <span class="font-semibold text-lg">Login Admin</span>
            </a>

            <a href="login_user.php" class="group flex items-center justify-center gap-3 bg-gradient-to-r from-rose-400 to-pink-500 hover:from-rose-500 hover:to-pink-600 text-white py-3.5 px-6 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                <svg class="w-6 h-6 text-white group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                <span class="font-semibold text-lg">Pemilik Hammy</span>
            </a>
        </div>

        <p class="mt-8 text-sm text-gray-500 font-medium">Silakan pilih kategori masuk Anda</p>
    </div>
</body>
</html>
