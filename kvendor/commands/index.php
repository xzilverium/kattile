<?php

/**
 * Kvendor Command Index
 *
 * This file routes Air commands to their registered command files.
 */

$command = $argv[1] ?? '--help';

$commands = require __DIR__ . '/registry.php';

if (! array_key_exists($command, $commands)) {
    echo PHP_EOL;
    echo "Unknown command: {$command}" . PHP_EOL;
    echo "Run: php air --help" . PHP_EOL;
    echo PHP_EOL;
    exit(1);
}

$commandFile = $commands[$command]['file'] ?? null;

if (! $commandFile || ! file_exists($commandFile)) {
    echo PHP_EOL;
    echo "Command file not found for: {$command}" . PHP_EOL;
    echo PHP_EOL;
    exit(1);
}

require $commandFile;