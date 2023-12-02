<?php

$red_max = 12;
$green_max = 13;
$blue_max = 14;

$fp = fopen("H:/AdventOfCode/2023/day_2/1_sourcefile.txt", "r");

$count = 0;
$total = 0;

if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        $takeIntoAccount = true;

        $game = substr($buffer, 5, strpos($buffer, ':') - 5);

        $grabs = explode(';', substr($buffer,strpos($buffer, ':') + 1));
        foreach($grabs as $grab) {
            $cubes = explode(',', $grab);

            foreach($cubes as $cube) {
                $info = explode(' ', trim($cube));

                $color = $info[1];
                $number = $info[0];

                if(${$color . '_max'} < $number)
                    $takeIntoAccount = false;
            }
        }

        $count++;

        if($takeIntoAccount)
            $total += $game;
    }

    echo 'Totaal behandelde games: ' . $count . '<br>';
    echo 'Totaal opgetelde game ids: ' . $total . '<br>';
}

 ?>
