<?php

$fp = file_get_contents("H:/AdventOfCode/2015/day_03/source.txt", "r");
$count = 0;
$total = 0;

if ($fp) {
    $houses = array_fill(0,500,array_fill(0,500,0));

    $position = [250, 250];

    $visit = str_split($fp);

    foreach($visit as $v) {
        $houses[$position[0]][$position[1]]++;
        switch($v) {
            case '^':
                $position[0]--;
                break;
            case '>':
                $position[1]++;
                break;
            case '<':
                $position[1]--;
                break;
            case 'v':
                $position[0]++;
                break;
        }

        if($position[0] == 500 || $position[0] < 0) {
            var_dump('ERROR pos 0');
            die();
        }

        if($position[1] == 500 || $position[1] < 0) {
            var_dump('ERROR pos 1');
            die();
        }
    }

    foreach($houses as $street) {
        foreach($street as $house) {
            if($house > 0)
                $count++;
        }
    }

    var_dump($count);
}
