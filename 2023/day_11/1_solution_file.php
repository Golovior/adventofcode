<?php
$fp = fopen("H:/AdventOfCode/2023/day_11/1_sourcefile.txt", "r");
$rows = [];
$total = 0;
$positions = [];
$notInRows = [];
$notInCols = [];

if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        $rows[] = str_split(trim($buffer));
    }

    fclose($fp);

    foreach($rows as $k => $row) {
        foreach($row as $c => $column) {
            if($column == '#')
                $positions[$k][] = $c;
        }
    }

    for($i = 0; $i < 140; $i++) {
        $notInCols[] = $i;
    }

    $i = 0;
    foreach($positions as $k => $row) {
        if($i != $k) {
            $notInRows[] = $i;
            $i = $k;
        }

        foreach($row as $c => $column) {
            $index = array_search($column, $notInCols);

            if($index !== false)
                unset($notInCols[$column]);
        }
        $i++;
    }

    sort($notInCols);

    $newRows = [];

    $ci = 0;
    $ri = 0;

    foreach($rows as $k => $row) {
        $ci = 0;
        $r = [];
        if(isset($notInRows[$ri]) && $notInRows[$ri] == $k) {
            $r = $row;
            foreach($notInCols as $i)
                $r[] = '.';
            $ri++;

            $newRows[] = $r;
            $newRows[] = $r;
            continue;
        }
        foreach($row as $c => $column)
        {
            if(isset($notInCols[$ci]) && $notInCols[$ci] == $c) {
                $r[] = '.';
                $ci++;
            }

            $r[] = $column;
        }

        $newRows[] = $r;
    }

    $newPositions = [];

    foreach($newRows as $k => $row) {
        foreach($row as $c => $column) {
            if($column == "#")
                $newPositions[] = [$k, $c];
        }
    }

    var_dump($newRows);
    var_dump($newPositions);

    foreach($newPositions as $j => $k) {
        for($l = $j; $l < count($newPositions); $l++) {
            $horizontal = 0;
            if($k[1] > $newPositions[$l][1])
                $horizontal = $k[1] - $newPositions[$l][1];

            if($k[1] < $newPositions[$l][1])
                $horizontal = $newPositions[$l][1] - $k[1];

            $vertical = 0;
            if($k[0] < $newPositions[$l][0])
                $vertical = $newPositions[$l][0] - $k[0];

            $total += $horizontal;
            $total += $vertical;
        }
    }

    var_dump($total);

} else {
  echo 'file not found';
}


 ?>
