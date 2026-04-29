<?php
// Test file untuk debug session

error_log("=== SESSION TEST START ===");

// Check session directory
echo "<h3>Session Configuration:</h3>";
echo "Session save path: " . session_save_path() . "<br>";
echo "Session dir writable? " . (is_writable(session_save_path()) ? "YES ✓" : "NO ✗") . "<br>";
echo "Session name: " . session_name() . "<br><br>";

// Start session
session_start();
echo "Session ID: " . session_id() . "<br>";
error_log("Test session started with ID: " . session_id());

// Set test data
$_SESSION['test'] = 'Session working!';
$_SESSION['timestamp'] = date('Y-m-d H:i:s');

echo "<h3>Session Data:</h3>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<h3>Test Actions:</h3>";
echo "<a href='test_session_verify.php'>Check if session persists →</a><br><br>";

// Database test
require '../../includes/config.php';

echo "<h3>Database Test:</h3>";
try {
    $stmt = $pdo->prepare('SELECT * FROM "user" WHERE username = :username');
    $stmt->execute(['username' => 'syarifah']);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        echo "✓ Test user found!<br>";
        echo "<pre>";
        print_r($user);
        echo "</pre>";
    } else {
        echo "✗ Test user NOT found<br>";
    }
} catch (Exception $e) {
    echo "✗ Database error: " . $e->getMessage();
}

error_log("=== SESSION TEST END ===");
?>
