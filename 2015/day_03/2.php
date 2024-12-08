<?php

$fp = file_get_contents("H:/AdventOfCode/2015/day_03/source.txt", "r");
$count = 0;
$total = 0;

if ($fp) {
    $houses = array_fill(0,500,array_fill(0,500,0));

    $position[0] = [250, 250];
    $position[1] = [250, 250];

    $visit = str_split($fp);
    $robo = false;
    $key = 0;
    foreach($visit as $v) {
        if($robo) {
            $robo = false;
            $key = 0;
        } else {
            $robo = true;
            $key = 1;
        }
        $houses[$position[$key][0]][$position[$key][1]]++;
        switch($v) {
            case '^':
                $position[$key][0]--;
                break;
            case '>':
                $position[$key][1]++;
                break;
            case '<':
                $position[$key][1]--;
                break;
            case 'v':
                $position[$key][0]++;
                break;
        }

        if($position[$key][0] == 500 || $position[$key][0] < 0) {
            var_dump('ERROR pos 0');
            die();
        }

        if($position[$key][1] == 500 || $position[$key][1] < 0) {
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
