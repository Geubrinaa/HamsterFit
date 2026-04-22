<?php
session_start();
require '../../includes/config.php';

// Ambil id_hamster dari URL
$id_hamster = isset($_GET['id_hamster']) ? intval($_GET['id_hamster']) : 0;
$id_user = $_SESSION['id_user'] ?? 1;

// Ambil gejala yang dipilih user dari session
$selected_gejala = isset($_SESSION['selected_gejala']) ? $_SESSION['selected_gejala'] : [];

// Ambil basis aturan dari database
try {
    $stmt = $pdo->query("SELECT id_rule, id_penyakit, id_gejala FROM rule");
    $rules = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt2 = $pdo->query("SELECT id_penyakit, nama_penyakit, solusi FROM penyakit");
    $penyakit_list = [];
    foreach ($stmt2->fetchAll(PDO::FETCH_ASSOC) as $p) {
        $penyakit_list[$p['id_penyakit']] = $p;
    }
} catch (PDOException $e) {
    // Supress db errors for demonstration if tables are missing
    $rules = [];
    $penyakit_list = [];
}

// === FORWARD CHAINING ===
$hasil_diagnosa = [];
if (!empty($selected_gejala) && !empty($rules)) {
    $rule_per_penyakit = [];
    foreach ($rules as $rule) {
        $rule_per_penyakit[$rule['id_penyakit']][] = $rule['id_gejala'];
    }
    foreach ($rule_per_penyakit as $id_penyakit => $gejala_penyakit) {
        if (count(array_diff($gejala_penyakit, $selected_gejala)) === 0) {
            $hasil_diagnosa[] = $penyakit_list[$id_penyakit];
        }
    }
}

if (!empty($hasil_diagnosa)) {
    $penyakit = $hasil_diagnosa[0]; 
    $hasil_text = $penyakit['nama_penyakit'];
    $solusi_text = $penyakit['solusi'];
    $tanggal = date('Y-m-d H:i:s');

    try {
        $cek = $pdo->prepare("SELECT id_diagnosa FROM diagnosa WHERE id_user=? AND \"IdBio\"=? AND DATE(tanggal)=CURRENT_DATE");
        $cek->execute([$id_user, $id_hamster]);
        if (!$cek->fetch()) {
            $stmt = $pdo->prepare("INSERT INTO diagnosa (id_user, \"IdBio\", id_penyakit, tanggal, hasil) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$id_user, $id_hamster, $penyakit['id_penyakit'], $tanggal, $hasil_text]);
        }
    } catch(PDOException $e){ }
} else {
    $hasil_text = "Tidak teridentifikasi.";
    $solusi_text = "Bawa hamster ke dokter hewan segera, gejala yang diberikan tidak cukup cocok dengan basis pengetahuan kami.";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Akhir Diagnosa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gradient-to-tr from-rose-50 to-indigo-50 min-h-screen py-10 px-4">
    <div class="max-w-2xl mx-auto mt-10">
        
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-rose-100">
            <div class="bg-emerald-500 p-8 text-center text-white relative">
                <div class="absolute top-0 right-0 p-10 opacity-20 transform translate-x-4 -translate-y-4">
                    <svg class="w-32 h-32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                </div>
                <h1 class="text-3xl font-bold tracking-tight relative z-10">Hasil Diagnosa</h1>
                <p class="text-emerald-100 mt-2 relative z-10">Analisis sistem pakar telah selesai.</p>
            </div>

            <div class="p-8 md:p-12">
                <div class="mb-8">
                    <h3 class="text-sm uppercase tracking-wider text-gray-400 font-bold mb-2">Teridentifikasi Penyakit</h3>
                    <div class="text-2xl md:text-3xl font-bold text-gray-800 bg-gray-50 border-l-4 border-rose-400 pl-4 py-3 rounded-r-xl">
                        <?= htmlspecialchars($hasil_text) ?>
                    </div>
                </div>

                <div class="mb-10">
                    <h3 class="text-sm uppercase tracking-wider text-gray-400 font-bold mb-2">Solusi Perawatan</h3>
                    <div class="text-gray-600 bg-emerald-50 rounded-xl p-5 border border-emerald-100 leading-relaxed font-medium">
                        <?= nl2br(htmlspecialchars($solusi_text)) ?>
                    </div>
                </div>

                <div class="flex justify-center border-t border-gray-100 pt-8">
                    <a href="dashboarduser.php" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-3.5 px-8 rounded-xl shadow-md transition-all transform hover:-translate-y-0.5 text-center w-full sm:w-auto">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>

    </div>
</body>
</html>