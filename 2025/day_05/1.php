<?php

$total = 0;

$start = microtime(true);

$fp = fopen("input.txt", "r");
$idRanges = [];
$ids = [];

if ($fp) {
    $idRange = true;
    while (($buffer = fgets($fp, 4096)) !== false) {
        if(trim($buffer) == '') {
            $idRange = false;
            continue;
        }

        if($idRange) {
            $idRanges[] = explode('-', trim($buffer));
        }
        else {
            $ids[] = trim($buffer);
        }

    }

    foreach($ids as $id) {
        foreach($idRanges as $range) {
            if($id >= $range[0] && $id <= $range[1]) {
                $total++;
                break;
            }
        }
    }
}

$end = microtime(true);

$totalTime = $end - $start;

echo('Answer: ' . $total . '<br/>');
echo('Time: ' . $totalTime);
