<?php

$fp = file_get_contents("H:/AdventOfCode/2024/day_03/source.txt", "r");
$count = 0;
$total = 0;

if ($fp) {
    preg_match_all("/(mul\(\d{1,3},\d{1,3}\)|do\(\)|don't\(\))/i",
        $fp,
        $out, PREG_PATTERN_ORDER);

var_dump($out);
    $enabled = true;
    foreach($out[0] as $mul) {
        if($mul == "don't()") {
            $enabled = false;
            continue;
        }

        if($mul == "do()") {
            $enabled = true;
            continue;
        }

        if($enabled) {
            $break1 = explode('(', $mul);
            $break2 = explode(',', $break1[1]);
            $break3 = explode(')', $break2[1]);

            $total += $break2[0] * $break3[0];
        }
    }

    var_dump($total);
}
