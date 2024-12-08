<?php

$fp = fopen("H:/AdventOfCode/2024/day_08/source.txt", "r");
$count = 0;
$total = 0;

if ($fp) {
    $map = [];
    $nodes = [];
    while (($buffer = fgets($fp, 4096)) !== false) {
        $visual = str_split(trim($buffer));
        $street = [];
        foreach($visual as $v) {
            if($v != '.')
                $nodes[] = [$v, [count($map), count($street)]];
            $house = [$v, 0];
            $street[] = $house;
        }
        $map[] = $street;
    }

    // var_dump($map);
    // var_dump($nodes);

    foreach($nodes as $id => $n) {
        foreach($nodes as $that => $o) {
            if($id == $that)
                continue;

            if($n[0] != $o[0])
                continue;

            $verticalDiff = $o[1][1] - $n[1][1];
            $horizontalDiff = $o[1][0] - $n[1][0];

            $antinode = [$n[1][1] - $verticalDiff, $n[1][0] - $horizontalDiff];

            if(array_key_exists($antinode[1], $map) && array_key_exists($antinode[0], $map[$antinode[1]]))
                $map[$antinode[1]][$antinode[0]][1]++;
        }
    }

    foreach($map as $street) {
        foreach($street as $house) {
            if($house[1] > 0)
                $count++;
        }
    }

    var_dump($count);

}
