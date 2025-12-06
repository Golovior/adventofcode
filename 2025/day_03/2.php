<?php

$total = 0;

$start = microtime(true);

$fp = fopen("input.txt", "r");
$banks = [];

if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        $row = str_split($buffer);
        $nrow = [];
        foreach($row as $r) {
            if(preg_match('/\d/', $r) !== 1)
                continue;

            $nrow[] = $r;
        }

        if (!empty($nrow)) {
            $banks[] = $nrow;
        }
    }
}

// Function to compute the maximum m-length subsequence (preserving order)
// using a greedy stack approach.
function maxSubsequence(array $digits, int $m): array {
    $n = count($digits);
    if ($m >= $n) return $digits;
    $k = $n - $m; // number of digits we can remove
    $stack = [];
    foreach ($digits as $d) {
        while ($k > 0 && !empty($stack) && end($stack) < $d) {
            array_pop($stack);
            $k--;
        }
        $stack[] = $d;
    }
    // If removals remain, trim from the end
    if ($k > 0) {
        $stack = array_slice($stack, 0, count($stack) - $k);
    }
    // Ensure length m
    if (count($stack) > $m) {
        $stack = array_slice($stack, 0, $m);
    }
    return $stack;
}

// For each bank row, build the largest 12-digit number and sum them
foreach ($banks as $row) {
    $best = maxSubsequence($row, 12);
    $numStr = implode('', $best);
    $total += (int)$numStr;
}

$end = microtime(true);

$totalTime = $end - $start;

echo('Answer: ' . $total . '<br/>');
echo('Time: ' . $totalTime);
