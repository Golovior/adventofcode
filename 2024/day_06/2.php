<?php

$fp = fopen("H:/AdventOfCode/2024/day_06/source.txt", "r");
$count = 0;
$total = 0;

if ($fp) {
    $rowsBasics = [];
    $startRow = 0;
    $startPos = 0;
    while (($buffer = fgets($fp, 4096)) !== false) {
        $rowsBasics[] = str_split($buffer);
        foreach($rowsBasics[count($rowsBasics) - 1] as $pos => $row) {
            if($row == '^') {
                $startRow = count($rowsBasics) - 1;
                $startPos = $pos;
            }
        }
    }

    for($y = 0; $y < count($rowsBasics); $y++)
    {
        for($x = 0; $x < count($rowsBasics[0]); $x++)
        {
            $currentRow = $startRow;
            $currentPos = $startPos;
            $rows = $rowsBasics;
            $rows[$y][$x] = '#';
            $direction = 'N';
            $inLoop = null;
            while(is_null($inLoop)) {
                $inLoop = inLab($rows, $currentRow, $currentPos, $direction);
            }

            if($inLoop) {
                $count++;
            }
        }
    }

    var_dump($count);

}


function inLab(array &$rows, int &$currentRow, int &$currentPos, string &$dir) {
    switch($dir) {
        case 'N':
            if($currentRow == 0)
                return false;
            $currentRow--;
            if($rows[$currentRow][$currentPos] == 'N')
                return true;
            $nextPos = $rows[$currentRow][$currentPos];
            if($nextPos == '#') {
                $currentRow++;
                $dir = 'E';
                return inLab($rows, $currentRow, $currentPos, $dir);
            } else {
                $rows[$currentRow][$currentPos] = 'N';
            }
            break;
        case 'E':
            if(count($rows[0]) - 1 == $currentPos)
                return false;
            $currentPos++;
            if($rows[$currentRow][$currentPos] == 'E')
                return true;
            $nextPos = $rows[$currentRow][$currentPos];
            if($nextPos == '#') {
                $currentPos--;
                $dir = 'S';
                return inLab($rows, $currentRow, $currentPos, $dir);
            } else {
                $rows[$currentRow][$currentPos] = 'E';
            }
            break;
        case 'S':
            if(count($rows) - 1 == $currentRow)
                return false;
            $currentRow++;
            if($rows[$currentRow][$currentPos] == 'S')
                return true;
            $nextPos = $rows[$currentRow][$currentPos];
            if($nextPos == '#') {
                $currentRow--;
                $dir = 'W';
                return inLab($rows, $currentRow, $currentPos, $dir);
            } else {
                $rows[$currentRow][$currentPos] = 'S';
            }
            break;
        case 'W':
            if($currentPos == 0)
                return false;
            $currentPos--;
            if($rows[$currentRow][$currentPos] == 'W')
                return true;
            $nextPos = $rows[$currentRow][$currentPos];
            if($nextPos == '#') {
                $currentPos++;
                $dir = 'N';
                return inLab($rows, $currentRow, $currentPos, $dir);
            } else {
                $rows[$currentRow][$currentPos] = 'W';
            }
            break;
    }

    return null;
}
