<?php

$total = 0;

$start = microtime(true);

$fp = fopen("input.txt", "r");

$sums = [];
$handlers = [];
$numbers = [];

if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        $cols = str_split($buffer);

        foreach($cols as $k => $n) {
            if(!isset($numbers[$k]))
                $numbers[$k] = '';

            if(trim($n) == '')
                continue;

            if(preg_match('/\d+/', $n) !== 1) {
                $handlers[] = $n;
                continue;
            }

            $numbers[$k] .= $n;
        }
    }

    $number = 0;

    foreach($handlers as $k => $handler) {
        $sumValue = 0;
        switch($handler) {
            case '+':
                while($numbers[$number] != '') {
                    $sumValue += $numbers[$number];
                    $number++;
                }
                $number++;
                break;
            case '*':
                $sumValue = 1;
                while($numbers[$number] != '') {
                    $sumValue *= $numbers[$number];
                    $number++;
                }
                $number++;
                break;
        }

        $total += $sumValue;
    }
}

$end = microtime(true);

$totalTime = $end - $start;

echo('Answer: ' . $total . '<br/>');
echo('Time: ' . $totalTime);
