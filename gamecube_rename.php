<?php

$ignore = [
    '.',
    '..',
    '.gitkeep',
    '.DS_Store',
];

$root = './games_pre';

$file_list = scandir($root);
$file_list = array_filter($file_list, fn($file) => !in_array($file, $ignore));
$file_list = array_values($file_list);

// var_dump($file_list);

mkdir('games');

foreach ($file_list as $key => $filename_extension) {
    $filename_extension_array = explode('.', $filename_extension);
    $filename = $filename_extension_array[0];
    $extension = $filename_extension_array[1] ?? '';

    $new_dir = './games/' . clean_string($filename);

    $source_file = $root . '/' . $filename_extension;
    $destiny_file = $new_dir . '/game.' . $extension;
    mkdir($new_dir);
    rename($source_file, $destiny_file);
}

echo 'Ended properly.' . PHP_EOL;
exit(0);

function clean_string($string)
{
    $string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.
    $string = preg_replace('/[^A-Za-z0-9\_]/', '', $string); // Removes special chars.
    $string = str_replace('__', '_', $string); // Replaces all spaces with hyphens.
    return $string;
}
