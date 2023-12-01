<?php
$fp = fopen("H:/AdventOfCode/day_1/1_sourcefile.txt", "r");
$count = 0;
$total = 0;
if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        preg_match_all("|\d|U",
            $buffer,
            $out, PREG_PATTERN_ORDER);

        $numberString = $out[0][0] . $out[0][count($out[0]) - 1];
        $number = (int)$numberString;

        $total += $number;

        $count++;
    }
    if (!feof($fp)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($fp);
} else {
  echo 'file not found';
}
echo $count;
echo 'Total is: ' . $total;
 ?>
