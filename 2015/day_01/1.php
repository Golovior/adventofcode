<?php

$fp = file_get_contents("H:/AdventOfCode/2015/day_01/source.txt", "r");
$count = 0;
$total = 0;

if ($fp) {
    $change = str_split($fp);

    foreach($change as $c) {
        if($c == '(')
            $count++;
        if($c == ')')
            $count--;
    }

    var_dump($count);
}
