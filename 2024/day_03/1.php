<?php

$fp = file_get_contents("H:/AdventOfCode/2024/day_03/source.txt", "r");
$count = 0;
$total = 0;

if ($fp) {
    preg_match_all("/mul\(\d{1,3},\d{1,3}\)/i",
        $fp,
        $out, PREG_PATTERN_ORDER);

    foreach($out[0] as $mul) {
        $break1 = explode('(', $mul);
        $break2 = explode(',', $break1[1]);
        $break3 = explode(')', $break2[1]);

        $total += $break2[0] * $break3[0];
    }

    var_dump($total);
}
