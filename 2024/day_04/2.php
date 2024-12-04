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
            if($char == 'A')
            {
                if(check($rows, $id, $rid))
                    $count++;
            }
        }
    }

    var_dump($count);

}

function check(array $rows, int $id, int $rid) {
    if($id == 0 || $id == count($rows) - 1)
        return false;

    if($rid == 0 || $rid == count($rows[0]) - 1)
        return false;

    if($rows[$id - 1][$rid - 1] == 'X' ||
            $rows[$id - 1][$rid + 1] == 'X' ||
            $rows[$id + 1][$rid - 1] == 'X' ||
            $rows[$id + 1][$rid + 1] == 'X' ||
            $rows[$id - 1][$rid - 1] == 'A' ||
            $rows[$id - 1][$rid + 1] == 'A' ||
            $rows[$id + 1][$rid - 1] == 'A' ||
            $rows[$id + 1][$rid + 1] == 'A')
        return false;

    if($rows[$id - 1][$rid - 1] == 'M') {
        if($rows[$id + 1][$rid + 1] != 'S')
            return false;
    } else if($rows[$id - 1][$rid - 1] == 'S') {
        if($rows[$id + 1][$rid + 1] != 'M')
            return false;
    }

    if($rows[$id - 1][$rid + 1] == 'M') {
        if($rows[$id + 1][$rid - 1] != 'S')
            return false;
    } else if($rows[$id - 1][$rid + 1] == 'S') {
        if($rows[$id + 1][$rid - 1] != 'M')
            return false;
    }

    return true;
}
