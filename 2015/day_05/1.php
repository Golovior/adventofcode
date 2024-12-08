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
        if(strpos($s, 'ab') !== false || strpos($s, 'cd') !== false || strpos($s, 'pq') !== false || strpos($s, 'xy') !== false)
            continue;

        $vowels = 0;
        $consideredVowels = ['a','e','i','o','u'];

        $foundDouble = false;

        $stringArray = str_split($s);
        foreach($stringArray as $i => $c) {
            if(in_array($c, $consideredVowels))
                $vowels++;

            if(array_key_exists($i + 1, $stringArray) && $stringArray[$i + 1] == $c)
                $foundDouble = true;
        }

        if($vowels < 3)
            continue;

        if(!$foundDouble)
            continue;

        $count++;
    }

    var_dump($count);
}
