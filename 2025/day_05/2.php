<?php

$total = 0;

$start = microtime(true);

$fp = fopen("input.txt", "r");
$idRanges = [];

if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        if(trim($buffer) == '') {
            break;
        }

        $idRanges[] = explode('-', trim($buffer));

    }

    $ranges = [];

    foreach($idRanges as $range) {
        $thisRange = [$range[0], $range[1]];

        foreach($ranges as $k => $r) {
            if($r[0] >= $thisRange[0] && $thisRange[1] >= $r[1]) {
                unset($ranges[$k]);
                continue;
            }

            if($r[0] <= $thisRange[0] && $r[1] >= $thisRange[0]) {
                $thisRange[0] = $r[1] + 1;
            }

            if($r[0] <= $thisRange[1] && $r[1] >= $thisRange[1]) {
                $thisRange[1] = $r[0] - 1;
            }
        }

        $thisRange[2] = $thisRange[1] - $thisRange[0] + 1;

        if($thisRange[2] > 0)
            $ranges[] = $thisRange;
    }

    foreach($ranges as $r) {
        $total = bcadd($r[2], $total);
    }
}

$end = microtime(true);

$totalTime = $end - $start;

echo('Answer: ' . $total . '<br/>');
echo('Time: ' . $totalTime);
