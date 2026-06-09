<?php

/**
 * Air Kvendor Command
 *
 * Displays information about the Kvendor engine.
 */

$manifest = require __DIR__ . '/../manifest.php';

echo PHP_EOL;
echo $manifest['name'] . PHP_EOL;
echo 'Version: ' . $manifest['version'] . PHP_EOL;

if (!empty($manifest['description'])) {
    echo $manifest['description'] . PHP_EOL;
}

echo PHP_EOL;