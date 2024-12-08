<?php

$fp = fopen("H:/AdventOfCode/2015/day_02/source.txt", "r");
$count = 0;
$total = 0;

if ($fp) {
    $presents = [];
    while (($buffer = fgets($fp, 4096)) !== false) {
        $presents[] = explode('x', $buffer);
    }

    foreach($presents as $present) {
        $a = $present[0] * $present[1];
        $b = $present[0] * $present[2];
        $c = $present[1] * $present[2];

        $smallest = min($a, $b, $c);

        $totalPresent = $a * 2 + $b * 2 + $c * 2 + $smallest;

        $total += $totalPresent;
    }

    var_dump($total);
}
