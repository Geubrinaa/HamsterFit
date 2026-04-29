<?php
/**
 * DEBUGGING GUIDE - Panduan Lengkap Debug Login Issue
 * 
 * Ikuti langkah-langkah berikut untuk menemukan masalahnya
 */

echo "<h1>🔍 LOGIN DEBUGGING GUIDE</h1>";

// Step 1: Session Configuration
echo "<h2>STEP 1: Session Configuration</h2>";
echo "Session save path: <strong>" . session_save_path() . "</strong><br>";
echo "Is writable? <strong>" . (is_writable(session_save_path()) ? "✓ YES" : "✗ NO") . "</strong><br>";
echo "If NO, this is the problem! Contact your hosting provider.<br><br>";

// Step 2: Database Connection
echo "<h2>STEP 2: Database Connection</h2>";
require '../../includes/config.php';
try {
    $stmt = $pdo->query('SELECT 1');
    echo "✓ Database connection OK<br>";
} catch (Exception $e) {
    echo "✗ Database connection FAILED: " . $e->getMessage() . "<br>";
    echo "Check includes/config.php credentials<br>";
}
echo "<br>";

// Step 3: Test User in Database
echo "<h2>STEP 3: Check Test User</h2>";
try {
    $stmt = $pdo->query('SELECT * FROM "user"');
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Total users in database: <strong>" . count($users) . "</strong><br>";
    
    if (count($users) > 0) {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Username</th><th>Password (DB)</th><th>Nama</th></tr>";
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . $user['id_user'] . "</td>";
            echo "<td>" . htmlspecialchars($user['username']) . "</td>";
            echo "<td><code>" . htmlspecialchars($user['password']) . "</code></td>";
            echo "<td>" . htmlspecialchars($user['nama_user']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "✗ NO USERS FOUND IN DATABASE!<br>";
        echo "You need to run the seeder: <code>database/seeders/initial_data.sql</code>";
    }
} catch (Exception $e) {
    echo "✗ Error querying users: " . $e->getMessage();
}
echo "<br><br>";

// Step 4: Session Test
echo "<h2>STEP 4: Session Persistence Test</h2>";
echo "<a href='test_session.php' style='padding: 10px; background: #4CAF50; color: white; text-decoration: none; border-radius: 5px;'>→ Click here to test session</a>";
echo "<br><br>";

// Step 5: Manual Login Test
echo "<h2>STEP 5: Manual Login Test</h2>";
echo "Test with username: <code>syarifah</code> | Password: <code>user123</code>";
echo "<br><br>";

// Step 6: Check PHP Version
echo "<h2>STEP 6: PHP Environment</h2>";
echo "PHP Version: <strong>" . phpversion() . "</strong><br>";
echo "Session handling: <strong>Files</strong><br>";
echo "Session auto start: <strong>" . (ini_get('session.auto_start') ? "YES" : "NO") . "</strong><br>";
echo "<br><br>";

// Step 7: Error Logs Location
echo "<h2>STEP 7: Error Logs</h2>";
echo "Check these log files for detailed error messages:<br>";
echo "<ul>";
echo "<li>Apache/PHP error log: <code>/var/log/php-fpm/error.log</code> atau <code>/var/log/apache2/error.log</code></li>";
echo "<li>Jika local (Laragon): <code>C:/laragon/var/log</code></li>";
echo "<li>PHP logs: <code>php_error_log</code> di root folder</li>";
echo "</ul>";
echo "<br>";

// Step 8: Quick Fixes Checklist
echo "<h2>STEP 8: Quick Fixes Checklist</h2>";
echo "<input type='checkbox'> ✓ Database seeder sudah dijalankan?<br>";
echo "<input type='checkbox'> ✓ Test user 'syarifah' sudah ada di database?<br>";
echo "<input type='checkbox'> ✓ Session directory writable?<br>";
echo "<input type='checkbox'> ✓ Cookies enabled di browser?<br>";
echo "<input type='checkbox'> ✓ Password tidak ada extra space di database?<br>";
echo "<input type='checkbox'> ✓ Sudah clear browser cookies?<br>";
echo "<br><br>";

?>

<style>
body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    padding: 20px;
}
table {
    background: white;
    border-collapse: collapse;
    width: 100%;
}
h1, h2 {
    color: #333;
}
code {
    background: #f0f0f0;
    padding: 2px 5px;
    border-radius: 3px;
}
</style>
