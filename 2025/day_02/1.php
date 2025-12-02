<?php

$total = 0;

$start = microtime(true);

$content = file_get_contents("input.txt");
$ranges = explode(',', $content);


foreach($ranges as $range) {
    $parts = explode('-', $range);
    $startRange = $parts[0];
    $endRange = $parts[1];

    for($i = $startRange; $i <= $endRange; $i++) {
        $length = strlen($i);
        if ($length % 2 != 0)
            continue;

        $half = $length / 2;

        $substrFront = substr($i, 0, $half);
        $substrBack = substr($i, $half);

        if ($substrFront == $substrBack) {
            $total += $i;
            var_dump($i);
        }
    }
}

$end = microtime(true);

$totalTime = $end - $start;

echo('Answer: ' . $total . '<br/>');
echo('Time: ' . $totalTime);
