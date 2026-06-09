<?php

/**
 * Air Version Command
 *
 * Displays information about the current project.
 */

$manifest = require __DIR__ . '/../project/manifest.php';

echo PHP_EOL;
echo $manifest['name'] . PHP_EOL;
echo 'Version: ' . $manifest['version'] . PHP_EOL;

if (!empty($manifest['manufacturer'])) {
    echo 'Manufacturer: ' . $manifest['manufacturer'] . PHP_EOL;
}

echo PHP_EOL;