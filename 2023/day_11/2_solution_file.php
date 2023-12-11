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

    $coordinates = [];
    foreach($positions as $r => $row) {
        foreach($row as $c => $column) {
            $coordinates[] = [$r, $column];
        }
    }

    sort($notInCols);

    $overEmpty = 0;

    foreach($coordinates as $j => $k) {
        for($l = $j; $l < count($coordinates); $l++) {
            $horizontal = 0;
            if($k[1] > $coordinates[$l][1])
                $horizontal = $k[1] - $coordinates[$l][1];

            if($k[1] < $coordinates[$l][1])
                $horizontal = $coordinates[$l][1] - $k[1];

            foreach($notInCols as $c) {
                if(($k[1] < $c && $coordinates[$l][1] > $c) || ($k[1] > $c && $coordinates[$l][1] < $c))
                    $overEmpty++;
            }

            $vertical = 0;
            if($k[0] < $coordinates[$l][0])
                $vertical = $coordinates[$l][0] - $k[0];

            foreach($notInRows as $r) {
                if($k[0] < $r && $coordinates[$l][0] > $r)
                    $overEmpty++;
            }

            $total = bcadd($total, $horizontal);
            $total = bcadd($total, $vertical);
        }
    }

    $multiplied = bcmul($overEmpty, 999999);
    $total = bcadd($total, $multiplied);

    var_dump($total);

} else {
  echo 'file not found';
}


 ?>
