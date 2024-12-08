<?php

$fp = fopen("H:/AdventOfCode/2015/day_05/source.txt", "r");
$count = 0;
$total = 0;

if ($fp) {
    $strings = [];
    while (($buffer = fgets($fp, 4096)) !== false) {
        $string[] = $buffer;
    }

    foreach($string as $s) {
        $foundDouble = false;

        $sets = [];
        $doubleSetFound = false;

        $stringArray = str_split($s);
        foreach($stringArray as $i => $c) {
            if(array_key_exists($i + 2, $stringArray) && $stringArray[$i + 2] == $c)
                $foundDouble = true;

            if(array_key_exists($i + 4, $stringArray) && strpos($s, $c . $stringArray[$i+1], $i + 2))
                $doubleSetFound = true;
        }

        if(!$foundDouble)
            continue;

        if(!$doubleSetFound)
            continue;

        $count++;
    }

    var_dump($count);
}
