<?php

return [
    '--help' => [
        'file' => __DIR__ . '/help.php',
        'description' => 'Show available commands',
    ],

    '--version' => [
        'file' => __DIR__ . '/version.php',
        'description' => 'Show project version',
    ],

    '--kvendor' => [
        'file' => __DIR__ . '/kvendor.php',
        'description' => 'Show Kvendor engine version',
    ],

    'list' => [
    'file' => __DIR__ . '/list.php',
    'description' => 'List all available Air commands',
    ],

    'rebrand' => [
    'file' => __DIR__ . '/rebrand.php',
    'description' => 'Update project branding configuration',
    ],

    'pull' => [
    'file' => __DIR__ . '/pull.php',
    'description' => 'Pull a file from Kvendor templates into the project',
    ],
];