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
        $a = $present[0];
        $b = $present[1];
        $c = $present[2];

        $not = max($a, $b, $c);
        
        $maxFound = false;
        foreach([$a, $b, $c] as $side) {
            if($side == $not && !$maxFound)
            {
                $maxFound = true;
                continue;
            }

            $total += 2 * $side;
        }

        $total += $present[0] * $present[1] * $present[2];

    }

    var_dump($total);
}
