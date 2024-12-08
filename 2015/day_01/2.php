<?php

$fp = file_get_contents("H:/AdventOfCode/2015/day_01/source.txt", "r");
$count = 0;
$total = 0;

if ($fp) {
    $change = str_split($fp);

    $pos = 0;
    foreach($change as $c) {
        $pos++;
        if($c == '(')
            $count++;
        if($c == ')')
            $count--;

        if($count < 0)
            break;
    }

    var_dump($pos);
}
