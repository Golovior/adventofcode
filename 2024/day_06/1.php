<?php

$fp = fopen("H:/AdventOfCode/2024/day_06/source.txt", "r");
$count = 0;
$total = 0;

if ($fp) {
    $rows = [];
    $currentRow = 0;
    $currentPos = 0;
    while (($buffer = fgets($fp, 4096)) !== false) {
        $rows[] = str_split($buffer);
        foreach($rows[count($rows) - 1] as $pos => $row) {
            if($row == '^') {
                $currentRow = count($rows) - 1;
                $currentPos = $pos;
            }
        }
    }

    $rows[$currentRow][$currentPos] = 'X';

    $direction = 'N';
    while(inLab($rows, $currentRow, $currentPos, $direction)) {
        $total++;
    }

    foreach($rows as $row) {
        foreach($row as $track) {
            if($track == 'X')
                $count++;
        }
    }

    echo '<code>';
    foreach($rows as $id => $row){
      echo ($id + 1) . '   ' . implode('', $row) . '<br>';
    }
    echo '</code>';

    var_dump($total, $count);

}


function inLab(array &$rows, int &$currentRow, int &$currentPos, string &$dir) {
    switch($dir) {
        case 'N':
            if($currentRow == 0)
                return false;
            $currentRow--;
            $nextPos = $rows[$currentRow][$currentPos];
            if($nextPos == '#') {
                $currentRow++;
                $dir = 'E';
                return inLab($rows, $currentRow, $currentPos, $dir);
            } else {
                $rows[$currentRow][$currentPos] = 'X';
            }
            break;
        case 'E':
            if(count($rows[0]) - 1 == $currentPos)
                return false;
            $currentPos++;
            $nextPos = $rows[$currentRow][$currentPos];
            if($nextPos == '#') {
                $currentPos--;
                $dir = 'S';
                return inLab($rows, $currentRow, $currentPos, $dir);
            } else {
                $rows[$currentRow][$currentPos] = 'X';
            }
            break;
        case 'S':
            if(count($rows) - 1 == $currentRow)
                return false;
            $currentRow++;
            $nextPos = $rows[$currentRow][$currentPos];
            if($nextPos == '#') {
                $currentRow--;
                $dir = 'W';
                return inLab($rows, $currentRow, $currentPos, $dir);
            } else {
                $rows[$currentRow][$currentPos] = 'X';
            }
            break;
        case 'W':
            if($currentPos == 0)
                return false;
            $currentPos--;
            $nextPos = $rows[$currentRow][$currentPos];
            if($nextPos == '#') {
                $currentPos++;
                $dir = 'N';
                return inLab($rows, $currentRow, $currentPos, $dir);
            } else {
                $rows[$currentRow][$currentPos] = 'X';
            }
            break;
    }

    return true;
}
