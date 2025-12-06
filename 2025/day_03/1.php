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

        $banks[] = $nrow;
    }

    foreach($banks as $bank) {
        $bankClone = json_decode(json_encode($bank));
        array_pop($bankClone);
        $maxA = max($bankClone);
        $index = array_search($maxA, $bank);
        array_splice($bank, 0, $index + 1);
        $maxB = max($bank);

        $totalMax = $maxA . $maxB;

        $total += intval($totalMax);
    }
}

$end = microtime(true);

$totalTime = $end - $start;

echo('Answer: ' . $total . '<br/>');
echo('Time: ' . $totalTime);
