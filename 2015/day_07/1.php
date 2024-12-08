<?php

$fp = fopen("H:/AdventOfCode/2015/day_07/source.txt", "r");
$count = 0;
$total = 0;

if ($fp) {
    $wires = [];
    $binaryWires = [];
    while (($buffer = fgets($fp, 4096)) !== false) {
        $info = explode(' -> ', $buffer);
        $wires[$info[1]] = $info[0];


    }

    var_dump($wires);

}
