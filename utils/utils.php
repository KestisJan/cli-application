<?php

/**
 * Ensure that a directory exists, creating it if necessary.
 * 
 * @param string $path The path to the directory.
 * 
 * @return void
 */
function ensureDirectoryExists(string $path): void
{
    if (!file_exists($path)) {
        if (mkdir($path, 0775, true)) {
            echo "Directory create: $path\n";
        } else {
            $error = error_get_last();
            echo "Failed to create directory: $path. Error: " . $error['message'] . "\n";
        }
    } 
}

?>