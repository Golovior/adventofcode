<?php

$fp = fopen("H:/AdventOfCode/2024/day_07/source.txt", "r");
$count = 0;
$total = 0;

if ($fp) {
    $equations = [];
    while (($buffer = fgets($fp, 4096)) !== false) {
        $data = explode(':', $buffer);

        $numbers = explode(' ', trim($data[1]));

        $equation = [
            'testresult' => $data[0],
            'numbers' => $numbers];

        $equations[] = $equation;
    }

    foreach($equations as $e) {
        $results = getAllAnswers($e['numbers']);

        if(in_array($e['testresult'], $results)))
            $total += $e['testresult'];
    }

    var_dump($total);

}


function getAllAnswers(array $numbers) {
    $combinationsFor = [];
    foreach($numbers as $x => $n) {
        if($x == count($numbers) - 1)
            continue;

        $combinationsFor[] = ['+', 'x'];
    }

    $allOperators = combinations($combinationsFor);

    foreach($allOperators as $set) {
        foreach($numbers as $i => $n) {
            if($i == 0)
                $result = $n;
            else {
                switch($set[$i - 1]) {
                    case '+':
                        $result += $n;
                        break;
                    case 'x':
                        $result *= $n;
                        break;
                }
            }
        }
        $results[] = $result;
    }

    return $results;
}

function combinations($arrays, $i = 0) {
    if (!isset($arrays[$i])) {
        return array();
    }
    if ($i == count($arrays) - 1) {
        return $arrays[$i];
    }

    // get combinations from subsequent arrays
    $tmp = combinations($arrays, $i + 1);

    $result = array();

    // concat each array from tmp with each element from $arrays[$i]
    foreach ($arrays[$i] as $v) {
        foreach ($tmp as $t) {
            $result[] = is_array($t) ?
                array_merge(array($v), $t) :
                array($v, $t);
        }
    }

    return $result;
}
