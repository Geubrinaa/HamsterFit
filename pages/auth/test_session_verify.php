<?php
// Verify if session data persists

session_start();

echo "<h3>Session Persistence Test:</h3>";
echo "Session ID: " . session_id() . "<br>";
echo "Test data set? " . (isset($_SESSION['test']) ? "YES ✓" : "NO ✗") . "<br>";
echo "Session content: <br>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

if (isset($_SESSION['test'])) {
    echo "<p style='color: green;'>✓ Session is WORKING!</p>";
} else {
    echo "<p style='color: red;'>✗ Session data was LOST! This means session persistence is broken.</p>";
}

error_log("Session verify - Session ID: " . session_id() . " | Test data exists? " . (isset($_SESSION['test']) ? "YES" : "NO"));
?>
