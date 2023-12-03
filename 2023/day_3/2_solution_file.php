<?php
$sourceFile = "H:/AdventOfCode/2023/day_3/1_sourcefile.txt";

$count = 0;
$total = 0;
$symbols = array();
$coordinates = array();
$records = array();

function getAllPositions(string $string, array $symbols) : array {
    $positions = array();

    $next = true;

    $index = -1;

    while($next) {
        $nextIndex = -1;
        foreach($symbols as $s) {
            $thisIndex = strpos($string, $s, $index + 1);
            if($thisIndex === false)
                continue;

            if($thisIndex < $nextIndex || $nextIndex == -1)
                $nextIndex = $thisIndex;
        }

        if($nextIndex == -1) {
            $next = false;
            continue;
        }

        $positions[] = $nextIndex;
        $index = $nextIndex;
    }

    return $positions;

}

$fp = fopen($sourceFile, "r");

if ($fp) {
    $symbols[] = '*';

    while (($buffer = fgets($fp, 4096)) !== false) {
        $coordinates[] = getAllPositions($buffer, $symbols);
    }

    $row = 0;
    $fp = fopen($sourceFile, "r");
    while (($buffer = fgets($fp, 4096)) !== false) {
        $checkNumbers = str_replace('.', '..', '.' . $buffer . '.');
        $checkNumbers = str_replace($symbols, '..', $checkNumbers);
        preg_match_all("|\D(\d+)\D|U",
            $checkNumbers,
            $out, PREG_PATTERN_ORDER);

        $pos = -1;

        foreach($out[1] as $number) {
            $pos = strpos($buffer, $number, $pos + 1);
            $checkCoordinates = array();
            $checkCoordinates[$row - 1] = array();
            $checkCoordinates[$row] = array();
            $checkCoordinates[$row + 1] = array();

            for($i = $pos - 1; $i <= $pos + strlen($number); $i++) {
                $checkCoordinates[$row - 1][] = $i;
                $checkCoordinates[$row][] = $i;
                $checkCoordinates[$row + 1][] = $i;
            }

            foreach($checkCoordinates as $r => $c) {
                if(!array_key_exists($r, $coordinates))
                    continue;

                foreach($c as $column) {
                    if(in_array($column, $coordinates[$r]))
                    {
                        if(!array_key_exists($r, $records))
                            $records[$r] = array();

                        if(!array_key_exists($column, $records[$r]))
                            $records[$r][$column] = array();

                        $records[$r][$column][] = $number;
                    }
                }
            }

            $pos += strlen($number);
        }

        $row++;
    }

    foreach($records as $r) {
        foreach($r as $numbers) {
            if(count($numbers) != 2)
                continue;

            $product = $numbers[0] * $numbers[1];

            $total += $product;
        }
    }

}

var_dump($total);

 ?>
