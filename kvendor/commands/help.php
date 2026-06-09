<?php

/**
 * Air Help Command
 *
 * Displays all registered Kattile Air commands.
 */

$commands = require __DIR__ . '/registry.php';

echo PHP_EOL;
echo "Kattile Air" . PHP_EOL;
echo "-----------" . PHP_EOL;
echo "Available commands:" . PHP_EOL;
echo PHP_EOL;

foreach ($commands as $name => $details) {
    $description = $details['description'] ?? 'No description';

    echo "  php air " . str_pad($name, 14) . $description . PHP_EOL;
}

echo PHP_EOL;