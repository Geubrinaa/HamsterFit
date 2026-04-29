<?php
function renderMenu() {
    echo "<div class='dashboard-menu'>";
    echo "<a href='data_user.php' class='menu-card'>";
    echo "<div class='menu-icon'>&#128100;</div>";
    echo "<div class='menu-title'>Data User</div>";
    echo "</a>";
    echo "<a href='data_gejala.php' class='menu-card'>";
    echo "<div class='menu-icon'>";
    echo "<svg width='48' height='48' fill='none' stroke='#3498db' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>";
    echo "<rect x='12' y='8' width='24' height='32' rx='4'/>";
    echo "<path d='M16 12h16M16 20h16M16 28h8'/>";
    echo "</svg>";
    echo "</div>";
    echo "<div class='menu-title'>Data Gejala</div>";
    echo "</a>";
    echo "<a href='data_penyakit.php' class='menu-card'>";
    echo "<div class='menu-icon'>";
    echo "<svg width='48' height='48' fill='none' stroke='#3498db' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>";
    echo "<circle cx='16' cy='32' r='6'/>";
    echo "<circle cx='32' cy='32' r='6'/>";
    echo "<path d='M16 38v4a8 8 0 0 0 16 0v-4'/>";
    echo "<path d='M16 26v-8a8 8 0 0 1 16 0v8'/>";
    echo "</svg>";
    echo "</div>";
    echo "<div class='menu-title'>Data Penyakit</div>";
    echo "</a>";
    echo "</div>";
}
?>