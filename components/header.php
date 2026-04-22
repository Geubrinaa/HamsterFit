<?php
function renderHeader($title) {
    echo "<header class='dashboard-header'>";
    echo "<h1>$title</h1>";
    echo "<div class='admin-info'>";
    echo "<span class='icon-user'>&#128100;</span>";
    echo "<span class='admin-name'>Halo, " . htmlspecialchars($_SESSION['username']) . "</span>";
    echo "<a href='logout.php' class='logout-btn' onclick='return confirm(\"Anda yakin ingin keluar?\")'>Logout</a>";
    echo "</div>";
    echo "</header>";
}
?>