<?php

$fp = fopen("H:/AdventOfCode/2024/day_01/source.txt", "r");
$count = 0;
$total = 0;

if ($fp) {
    $left = [];
    $right = [];

    while (($buffer = fgets($fp, 4096)) !== false) {
        $numbers = explode('   ', $buffer);

        $left[] = intval($numbers[0]);
        $right[] = intval($numbers[1]);
    }

    $sleft = sort($left);
    $sright = sort($right);

    foreach($left as $v) {
        $occurences = 0;
        foreach($right as $w) {
            if($v == $w)
                $occurences++;
        }

        $total += $occurences * $v;
    }

    var_dump($total);
}
