<?php

/**
 * Air Pull Command
 *
 * Pulls files or folders from kvendor/templates into the project.
 * Template files are read as plain text, not executed.
 */

$kvendorPath = dirname(__DIR__);
$projectPath = dirname($kvendorPath);
$templatesPath = $kvendorPath . DIRECTORY_SEPARATOR . 'templates';

function air_line(string $text = ''): void
{
    echo $text . PHP_EOL;
}

function air_path(string $path): string
{
    return ltrim(str_replace('\\', '/', $path), '/');
}

function air_safe_path(string $path): bool
{
    return $path !== '' && ! str_contains($path, '..');
}

function air_slug(string $path): string
{
    $path = air_path($path);
    $path = str_replace('/', '-', $path);
    $path = preg_replace('/[^A-Za-z0-9._-]/', '-', $path);

    return trim($path, '-');
}

function air_file_target_from_content(string $content): ?string
{
    if (preg_match('/@target\s+([^\r\n]+)/', $content, $m)) {
        return air_path(trim($m[1]));
    }

    return null;
}

function air_folder_target_from_content(string $content): ?string
{
    if (preg_match('/@target-root\s+([^\r\n]+)/', $content, $m)) {
        return rtrim(air_path(trim($m[1])), '/');
    }

    if (preg_match('/@target\s+([^\r\n]+)/', $content, $m)) {
        return rtrim(air_path(dirname(trim($m[1]))), '/');
    }

    return null;
}

function air_find_files(string $folder): array
{
    $files = [];

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($folder, FilesystemIterator::SKIP_DOTS)
    );

    foreach ($iterator as $file) {
        if ($file->isFile()) {
            $files[] = $file->getPathname();
        }
    }

    sort($files);

    return $files;
}

function air_find_folder_target(string $folder): ?string
{
    $files = air_find_files($folder);

    foreach ($files as $file) {
        if (dirname($file) !== $folder) {
            continue;
        }

        $content = file_get_contents($file);

        if ($content !== false) {
            $target = air_folder_target_from_content($content);

            if ($target) {
                return $target;
            }
        }
    }

    foreach ($files as $file) {
        $content = file_get_contents($file);

        if ($content !== false) {
            $target = air_folder_target_from_content($content);

            if ($target) {
                return $target;
            }
        }
    }

    return null;
}

function air_progress(int $done, int $total, string $label = 'Working'): void
{
    $frames = ['|', '/', '-', '\\'];
    $frame = $frames[$done % count($frames)];

    $width = 24;
    $percent = $total > 0 ? (int) floor(($done / $total) * 100) : 100;
    $filled = (int) floor(($percent / 100) * $width);

    $bar = str_repeat('█', $filled) . str_repeat('░', $width - $filled);

    echo "\r{$frame} {$label} [{$bar}] {$percent}% ({$done}/{$total})";

    if ($done >= $total) {
        echo PHP_EOL;
    }
}

function air_backup_single_file(string $file, string $projectPath, string $templateRequest)
{
    if (! file_exists($file)) {
        return null;
    }

    $backupName = air_slug($templateRequest) . '.' . date('H-i-s.d-m-y') . '.backup';

    $backupPath = $projectPath
        . DIRECTORY_SEPARATOR
        . 'backups'
        . DIRECTORY_SEPARATOR
        . $backupName;

    $backupDirectory = dirname($backupPath);

    if (! is_dir($backupDirectory)) {
        if (! mkdir($backupDirectory, 0755, true)) {
            return false;
        }
    }

    return copy($file, $backupPath) ? $backupPath : false;
}

function air_backup_folder_file(string $file, string $projectPath, string $backupRoot)
{
    if (! file_exists($file)) {
        return null;
    }

    $relativePath = air_path(substr($file, strlen($projectPath) + 1));

    $backupPath = $backupRoot
        . DIRECTORY_SEPARATOR
        . str_replace('/', DIRECTORY_SEPARATOR, $relativePath);

    $backupDirectory = dirname($backupPath);

    if (! is_dir($backupDirectory)) {
        if (! mkdir($backupDirectory, 0755, true)) {
            return false;
        }
    }

    return copy($file, $backupPath) ? $backupPath : false;
}

function air_list_templates(string $templatesPath): void
{
    air_line();
    air_line('Kattile Air Pull');
    air_line('----------------');
    air_line();

    if (! is_dir($templatesPath)) {
        air_line('No templates folder found.');
        air_line();
        return;
    }

    $files = air_find_files($templatesPath);

    if (empty($files)) {
        air_line('No templates found.');
        air_line();
        return;
    }

    air_line('+--------------------------------+--------------------------------+');
    air_line('| Template                       | Target                         |');
    air_line('+--------------------------------+--------------------------------+');

    foreach ($files as $file) {
        $relative = air_path(substr($file, strlen($templatesPath) + 1));
        $content = file_get_contents($file);
        $target = $content !== false ? air_file_target_from_content($content) : null;

        air_line('| ' . str_pad(substr($relative, 0, 30), 30) . ' | ' . str_pad(substr($target ?: '-', 0, 30), 30) . ' |');
    }

    air_line('+--------------------------------+--------------------------------+');
    air_line();
    air_line('Examples:');
    air_line('  php air pull config/brand.php');
    air_line('  php air pull public/css');
    air_line();
}

$templateRequest = $argv[2] ?? null;

if (! $templateRequest) {
    air_list_templates($templatesPath);
    exit(0);
}

$templateRequest = air_path($templateRequest);

if (! air_safe_path($templateRequest)) {
    air_line();
    air_line('Invalid template path.');
    air_line();
    exit(1);
}

$templatePath = $templatesPath . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $templateRequest);

if (! file_exists($templatePath)) {
    air_line();
    air_line('Template not found:');
    air_line("  kvendor/templates/{$templateRequest}");
    air_line();
    exit(1);
}

air_line();
air_line('Kattile Air Pull');
air_line('----------------');

if (is_file($templatePath)) {
    $content = file_get_contents($templatePath);

    if ($content === false) {
        air_line('Could not read template file.');
        air_line();
        exit(1);
    }

    $target = air_file_target_from_content($content) ?: $templateRequest;

    if (! air_safe_path($target)) {
        air_line('Invalid target path.');
        air_line();
        exit(1);
    }

    $targetPath = $projectPath . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $target);

    air_line("Template : kvendor/templates/{$templateRequest}");
    air_line("Target   : {$target}");
    air_line();

    $backup = air_backup_single_file($targetPath, $projectPath, $target);

    if ($backup === false) {
        air_line('Could not create backup. Pull stopped.');
        air_line();
        exit(1);
    }

    if ($backup) {
        air_line("Backup   : {$backup}");
    }

    if (! is_dir(dirname($targetPath))) {
        mkdir(dirname($targetPath), 0755, true);
    }

    air_progress(0, 1, 'Pulling');

    if (file_put_contents($targetPath, $content, LOCK_EX) === false) {
        air_line();
        air_line('Failed to pull template.');
        air_line();
        exit(1);
    }

    air_progress(1, 1, 'Pulling');

    air_line('Status   : Pulled successfully');
    air_line();
    exit(0);
}

if (is_dir($templatePath)) {
    $files = air_find_files($templatePath);
    $targetRoot = air_find_folder_target($templatePath) ?: $templateRequest;
    $targetRoot = air_path($targetRoot);

    if (! air_safe_path($targetRoot)) {
        air_line('Invalid target root.');
        air_line();
        exit(1);
    }

    $backupFolderName = air_slug($targetRoot) . '.' . date('H-i-s.d-m-y');
    $backupRoot = $projectPath
        . DIRECTORY_SEPARATOR
        . 'backups'
        . DIRECTORY_SEPARATOR
        . $backupFolderName;

    air_line("Template : kvendor/templates/{$templateRequest}");
    air_line("Target   : {$targetRoot}");
    air_line("Backup   : backups/{$backupFolderName}");
    air_line();

    $total = count($files);
    $done = 0;
    $backups = 0;

    air_progress(0, $total, 'Pulling');

    foreach ($files as $file) {
        $relative = air_path(substr($file, strlen($templatePath) + 1));

        $targetPath = $projectPath
            . DIRECTORY_SEPARATOR
            . str_replace('/', DIRECTORY_SEPARATOR, $targetRoot . '/' . $relative);

        $backup = air_backup_folder_file($targetPath, $projectPath, $backupRoot);

        if ($backup === false) {
            air_line();
            air_line("Could not create backup for: {$targetPath}");
            air_line();
            exit(1);
        }

        if ($backup) {
            $backups++;
        }

        if (! is_dir(dirname($targetPath))) {
            mkdir(dirname($targetPath), 0755, true);
        }

        if (! copy($file, $targetPath)) {
            air_line();
            air_line("Failed to copy: {$relative}");
            air_line();
            exit(1);
        }

        $done++;
        air_progress($done, $total, 'Pulling');
        usleep(40000);
    }

    air_line("Status   : {$done} files pulled successfully");
    air_line("Backups  : {$backups}");
    air_line();
    exit(0);
}

air_line('Invalid template type.');
air_line();
exit(1);