<?php

$fp = fopen("H:/AdventOfCode/2024/day_04/source.txt", "r");
$count = 0;
$total = 0;

if ($fp) {
    $rows = [];
    while (($buffer = fgets($fp, 4096)) !== false) {
        $rows[] = str_split($buffer);
    }

    foreach($rows as $id => $row) {
        foreach($row as $rid => $char) {
            if($char == 'X')
            {
                if(checkW($row, $rid))
                    $count++;

                if(checkE($row, $rid))
                    $count++;

                if(checkNW($rows, $id, $rid))
                    $count++;

                if(checkN($rows, $id, $rid))
                    $count++;

                if(checkNE($rows, $id, $rid))
                    $count++;

                if(checkSW($rows, $id, $rid))
                    $count++;

                if(checkS($rows, $id, $rid))
                    $count++;

                if(checkSE($rows, $id, $rid))
                    $count++;
            }
        }
    }

    var_dump($count);

}


function checkW(array $row, int $rid) {
    if($rid < 3)
        return false;

    if($row[$rid - 1] != 'M')
        return false;

    if($row[$rid - 2] != 'A')
        return false;

    if($row[$rid - 3] != 'S')
        return false;

    return true;
}

function checkE(array $row, int $rid) {
    if($rid > count($row) - 4)
        return false;

    if($row[$rid + 1] != 'M')
        return false;

    if($row[$rid + 2] != 'A')
        return false;

    if($row[$rid + 3] != 'S')
        return false;

    return true;
}

function checkN(array $rows, int $id, int $rid) {
    if($id < 3)
        return false;

    if($rows[$id - 1][$rid] != 'M')
        return false;

    if($rows[$id - 2][$rid] != 'A')
        return false;

    if($rows[$id - 3][$rid] != 'S')
        return false;

    return true;
}

function checkS(array $rows, int $id, int $rid) {
    if($id > count($rows) - 4)
        return false;

    if($rows[$id + 1][$rid] != 'M')
        return false;

    if($rows[$id + 2][$rid] != 'A')
        return false;

    if($rows[$id + 3][$rid] != 'S')
        return false;

    return true;
}

function checkNW(array $rows, int $id, int $rid) {
    if($id < 3 || $rid < 3)
        return false;

    if($rows[$id - 1][$rid - 1] != 'M')
        return false;

    if($rows[$id - 2][$rid - 2] != 'A')
        return false;

    if($rows[$id - 3][$rid - 3] != 'S')
        return false;

    return true;
}

function checkSE(array $rows, int $id, int $rid) {
    if($id > count($rows) - 4 || $rid > count($rows[0]) - 4)
        return false;

    if($rows[$id + 1][$rid + 1] != 'M')
        return false;

    if($rows[$id + 2][$rid + 2] != 'A')
        return false;

    if($rows[$id + 3][$rid + 3] != 'S')
        return false;

    return true;
}

function checkNE(array $rows, int $id, int $rid) {
    if($id < 3 || $rid > count($rows[0]) - 4)
        return false;

    if($rows[$id - 1][$rid + 1] != 'M')
        return false;

    if($rows[$id - 2][$rid + 2] != 'A')
        return false;

    if($rows[$id - 3][$rid + 3] != 'S')
        return false;

    return true;
}

function checkSW(array $rows, int $id, int $rid) {
    if($id > count($rows) - 4 || $rid < 3)
        return false;

    if($rows[$id + 1][$rid - 1] != 'M')
        return false;

    if($rows[$id + 2][$rid - 2] != 'A')
        return false;

    if($rows[$id + 3][$rid - 3] != 'S')
        return false;

    return true;
}
