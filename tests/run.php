<?php
/**
 * Minimal test runner - no external dependencies (no PHPUnit needed).
 *
 * Runs every tests/case_*.php file in its own process, prints a per-case
 * result and a summary, and exits non-zero if anything failed so CI can gate
 * on it.
 */
$root = dirname(__DIR__);
$cases = glob(__DIR__ . '/case_*.php');
sort($cases);

if (empty($cases)) {
    fwrite(STDERR, "No test cases found in " . __DIR__ . "\n");
    exit(1);
}

$passed = 0;
$failed = 0;
$failures = array();

foreach ($cases as $case) {
    $name = basename($case);
    $cmd = escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg($case);

    $output = array();
    $code = 0;
    exec($cmd . ' 2>&1', $output, $code);

    $text = implode("\n", $output);

    if ($code === 0) {
        $passed++;
        echo "PASS  $name\n";
    } else {
        $failed++;
        $failures[$name] = $text;
        echo "FAIL  $name\n";
        echo $text . "\n";
    }
}

echo "\n";
echo 'Passed: ' . $passed . ', Failed: ' . $failed . "\n";

if ($failed > 0) {
    fwrite(STDERR, "\nFailing cases:\n");
    foreach (array_keys($failures) as $name) {
        fwrite(STDERR, ' - ' . $name . "\n");
    }
    exit(1);
}

echo "All test cases passed.\n";
exit(0);
