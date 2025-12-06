<?php

$total = 0;

$start = microtime(true);

$fp = fopen("input.txt", "r");

$sums = [];

if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        $buffer = trim($buffer);
        $buffer = preg_replace('/\s+/', ' ', $buffer);

        $numbers = explode(' ', $buffer);

        foreach($numbers as $k => $n) {
            if(!isset($sums[$k]))
                $sums[$k] = [];

            $sums[$k][] = $n;
        }
    }

    foreach($sums as $sum) {
        $sum = array_reverse($sum);

        switch($sum[0]) {
            case '+':
                $sumValue = 0;
                foreach($sum as $k => $n) {
                    if($k == '0')
                        continue;
                    $sumValue += $n;
                }
                break;
            case '*':
                $sumValue = 1;
                foreach($sum as $k => $n) {
                    if($k == '0')
                        continue;
                    $sumValue *= $n;
                }
                break;
        }

        $total += $sumValue;
    }
}

$end = microtime(true);

$totalTime = $end - $start;

echo('Answer: ' . $total . '<br/>');
echo('Time: ' . $totalTime);
