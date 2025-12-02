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
            for($i = 0; $i < $distance; $i++) {
                $total--;
                if($total == 0)
                    $count++;

                if($total < 0)
                    $total += 100;
            }
        }
        else {
            for($i = 0; $i < $distance; $i++) {
                $total++;
                if($total == 100) {
                    $count++;
                    $total = 0;
                }
            }
        }

        echo $total . ' -> ' . $count . '<br/>';
    }

    $end = microtime(true);

    $totalTime = $end - $start;

    echo('Answer: ' . $count . '<br/>');
    echo('Time: ' . $totalTime);

}