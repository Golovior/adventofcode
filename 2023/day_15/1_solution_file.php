<?php
$fp = fopen("H:/AdventOfCode/2023/day_15/1_sourcefile.txt", "r");
$total = 0;

if ($fp) {
    $buffer = fgets($fp);

    fclose($fp);

    $parts = explode(',', $buffer);
    var_dump($parts);

    foreach($parts as $part) {
        $current = 0;
        $list = str_split(trim($part));

        foreach($list as $l) {
            $ascii = ord($l);
            $current += $ascii;

            $current = $current * 17;
            $current = $current % 256;
        }
        var_dump($current);

        $total += $current;
    }

} else {
  echo 'file not found';
}

var_dump($total);
?>
