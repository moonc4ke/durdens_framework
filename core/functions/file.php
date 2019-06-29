<?php

/**
 * @param $file
 * @param string $dir
 * @param array $allowed_types
 * @return bool|string
 */
function save_file($file, $dir = 'uploads', $allowed_types = ['image/png', 'image/jpeg', 'image/gif'])
{
    if ($file['error'] == 0 && in_array($file['type'], $allowed_types)) {
        $target_file_name = microtime() . '-' . strtolower($file['name']);
        $target_path = $dir . '/' . $target_file_name;

        if (move_uploaded_file($file['tmp_name'], $target_path)) {
            return $target_file_name;
        }
    }

    return false;
}