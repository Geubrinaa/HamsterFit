<?php

function moveFiles($sourceDir, $destDir) {
    if (!is_dir($destDir)) {
        mkdir($destDir, 0777, true);
    }

    $files = glob($sourceDir . '/*');

    foreach ($files as $file) {
        if (is_file($file)) {
            $destPath = $destDir . '/' . basename($file);
            rename($file, $destPath);
            echo "Moved: $file to $destPath\n";
        }
    }
}

// Move CSS files
moveFiles('css', 'assets/css');

// Move image files
moveFiles('image', 'assets/images');

echo "File moving completed!";
?>