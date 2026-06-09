<?php

/**
 * Air Rebrand Command
 *
 * Safely updates config/brand.php without bootstrapping Laravel.
 */

$rootPath = dirname(__DIR__, 2);
$brandFile = $rootPath . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'brand.php';

function air_line(string $text = ''): void
{
    echo $text . PHP_EOL;
}

function air_ask(string $question, string $default = ''): string
{
    $current = $default !== '' ? " [current: {$default}]" : '';

    air_line("  {$question}{$current}");
    echo "  > ";

    $input = trim((string) fgets(STDIN));

    return $input !== '' ? $input : $default;
}

function air_confirm(string $question, bool $default = true): bool
{
    $hint = $default ? 'Y/n' : 'y/N';

    air_line();
    air_line("  {$question} ({$hint})");
    echo "  > ";

    $input = strtolower(trim((string) fgets(STDIN)));

    if ($input === '') {
        return $default;
    }

    return in_array($input, ['y', 'yes'], true);
}

function air_php_value(string $value): string
{
    return var_export($value, true);
}

function air_extract_brand_value(string $content, string $key, string $default = ''): string
{
    $pattern = "/'{$key}'\s*=>\s*env\(\s*'[^']+'\s*,\s*'([^']*)'\s*\)/";

    if (preg_match($pattern, $content, $matches)) {
        return stripcslashes($matches[1]);
    }

    $pattern = "/'{$key}'\s*=>\s*'([^']*)'/";

    if (preg_match($pattern, $content, $matches)) {
        return stripcslashes($matches[1]);
    }

    return $default;
}

if (! file_exists($brandFile)) {
    air_line();
    air_line('✗ Brand file not found: config/brand.php');
    air_line();
    exit(1);
}

$oldContent = file_get_contents($brandFile);

if ($oldContent === false) {
    air_line();
    air_line('✗ Could not read config/brand.php');
    air_line();
    exit(1);
}

$current = [
    'name' => air_extract_brand_value($oldContent, 'name', 'Kattile'),
    'version' => air_extract_brand_value($oldContent, 'version', '26.6.1'),
    'description' => air_extract_brand_value($oldContent, 'description', 'The skeleton for Kattile Apps.'),
    'manufacturer' => air_extract_brand_value($oldContent, 'manufacturer', 'Xzilverium Realms'),
    'icon' => air_extract_brand_value($oldContent, 'icon', 'icon.svg'),
];

air_line();
air_line('╔══════════════════════════════════════╗');
air_line('║           Kattile Rebrand            ║');
air_line('╚══════════════════════════════════════╝');
air_line();
air_line('This will update: config/brand.php');
air_line('Press Enter to keep the current value.');
air_line();

$name = air_ask('What should be the brand name?', $current['name']);
$version = air_ask('What version should this project show?', $current['version']);
$description = air_ask('Write a short description.', $current['description']);
$manufacturer = air_ask('Who is the manufacturer / creator?', $current['manufacturer']);
$icon = air_ask('What icon file should be used?', $current['icon']);

air_line();
air_line('Brand preview');
air_line('-------------');
air_line("  Name         : {$name}");
air_line("  Version      : {$version}");
air_line("  Description  : {$description}");
air_line("  Manufacturer : {$manufacturer}");
air_line("  Icon         : {$icon}");
if (! air_confirm('Save these changes now?', true)) {
    air_line();
    air_line('Rebrand cancelled. No files were changed.');
    air_line();
    exit(0);
}

$backupFile = $brandFile . '.backup-' . date('Ymd-His');

if (! copy($brandFile, $backupFile)) {
    air_line();
    air_line('✗ Could not create backup. Rebrand stopped.');
    air_line();
    exit(1);
}

$newContent = "<?php\n\n";
$newContent .= "/**\n";
$newContent .= " * Brand Configuration\n";
$newContent .= " *\n";
$newContent .= " * This file contains the public branding details used across\n";
$newContent .= " * the application interface.\n";
$newContent .= " */\n\n";
$newContent .= "return [\n";
$newContent .= "    'name' => env('BRAND_NAME', " . air_php_value($name) . "),\n";
$newContent .= "    'version' => env('BRAND_VERSION', " . air_php_value($version) . "),\n";
$newContent .= "    'description' => env('BRAND_DESCRIPTION', " . air_php_value($description) . "),\n";
$newContent .= "    'manufacturer' => env('BRAND_MANUFACTURER', " . air_php_value($manufacturer) . "),\n\n";
$newContent .= "    'icon' => env('BRAND_ICON', " . air_php_value($icon) . "),\n";
$newContent .= "];\n";

if (file_put_contents($brandFile, $newContent, LOCK_EX) === false) {
    air_line();
    air_line('✗ Failed to update config/brand.php');
    air_line("Backup available at: {$backupFile}");
    air_line();
    exit(1);
}

air_line();
air_line('✓ Brand updated successfully.');
air_line("✓ Backup created: {$backupFile}");
air_line();