<?php
/**
 * Syntax-check every PHP file in the project with `php -l`.
 *
 * Reports the files that fail to parse and exits non-zero when any do, so CI
 * can gate on it. Vendored/generated trees are skipped.
 */

$root = dirname(__DIR__);
$skipDirs = array('.git', 'vendor', 'node_modules', '.svn');

$files = array();
$it = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS)
);
foreach ($it as $file) {
    if (!$file->isFile() || strtolower($file->getExtension()) !== 'php') {
        continue;
    }
    $rel = substr($file->getPathname(), strlen($root) + 1);
    $parts = explode(DIRECTORY_SEPARATOR, $rel);
    $skip = false;
    foreach ($parts as $part) {
        if (in_array($part, $skipDirs, true)) {
            $skip = true;
            break;
        }
    }
    if ($skip) {
        continue;
    }
    $files[] = $file->getPathname();
}
sort($files);

$failed = 0;
$checked = 0;
$failures = array();

foreach ($files as $file) {
    $cmd = escapeshellarg(PHP_BINARY) . ' -l ' . escapeshellarg($file);
    $output = array();
    $code = 0;
    exec($cmd . ' 2>&1', $output, $code);
    $checked++;
    if ($code !== 0) {
        $failed++;
        $rel = substr($file, strlen($root) + 1);
        $failures[$rel] = trim(implode("\n", $output));
    }
}

echo "Checked $checked PHP files, $failed with syntax errors.\n";

if ($failed > 0) {
    fwrite(STDERR, "\nSyntax errors:\n");
    foreach ($failures as $rel => $msg) {
        fwrite(STDERR, " - " . $rel . "\n" . $msg . "\n");
    }
    exit(1);
}

echo "No syntax errors found.\n";
exit(0);
