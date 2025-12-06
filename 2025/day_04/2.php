<?php

$total = 0;

$start = microtime(true);

$fp = fopen("input.txt", "r");
$rows = [];

if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        $row = str_split($buffer);
        $rows[] = $row;
    }

    $foundNew = true;
    while($foundNew) {
        $foundNew = false;
        foreach($rows as $x => $row) {
            foreach($row as $y => $cell) {
                if($cell == '@') {
                    $add = freeEnough($rows, $x, $y);
                    if($add == 1)
                        $foundNew = true;

                    $total += $add;
                }
            }
        }
    }

}

function freeEnough(&$rows, $x, $y) {
    $count = 0;
    for($i = $x - 1; $i <= $x + 1; $i++) {
        for($j = $y - 1; $j <= $y + 1; $j++) {
            if($i >= 0 && $i < count($rows) && $j >= 0 && $j < count($rows[$i])) {
                if($i == $x && $j == $y)
                    continue;
                if($rows[$i][$j] == '@')
                    $count++;
            }
        }
    }

    if($count < 4) {
        $rows[$x][$y] = '.';
        return 1;
    }


    return 0;
}

$end = microtime(true);

$totalTime = $end - $start;

echo('Answer: ' . $total . '<br/>');
echo('Time: ' . $totalTime);
