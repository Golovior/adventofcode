<?php

$fp = fopen("input.txt", "r");

$count = 0;
$total = 50;

if ($fp) {

    $start = microtime(true);

    while (($buffer = fgets($fp, 4096)) !== false) {
        $turn = substr($buffer, 0,1);
        $distance = (int) substr($buffer, 1);

        if($turn == 'L') {
            $total -= $distance;
        }
        else {
            $total += $distance;
        }

        $total = $total % 100;

        if($total == 0) {
            $count++;
        }
    }

    $end = microtime(true);

    $totalTime = $end - $start;

    echo('Answer: ' . $count . '<br/>');
    echo('Time: ' . $totalTime);

}