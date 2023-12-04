<?php
$fp = fopen("H:/AdventOfCode/2023/day_4/1_sourcefile.txt", "r");
$count = 0;
$total = 0;

$array = array();

for($i = 1; $i < 207; $i++){
    $array[$i] = 1;
}

var_dump($array);

if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        $parts = explode(':', $buffer);
        $gameParts = explode(' ', $parts[0]);
        $i = $gameParts[count($gameParts) - 1];

        $numbers = explode('|', $parts[1]);
        $priceNumbers = str_replace(' ', '  ', $numbers[0]);
        preg_match_all("|\s(\d+)\s|U",
            $priceNumbers,
            $price, PREG_PATTERN_ORDER);

        $scratchNumbers = str_replace(' ', '  ', $numbers[1]);
        preg_match_all("|\s(\d+)\s|U",
            $scratchNumbers,
            $scratch, PREG_PATTERN_ORDER);

        $score = 0;

        foreach($price[0] as $number) {
            if(in_array($number, $scratch[0]))
                $score++;
        }

        echo $i . ' -> ' . $score . '<br>';

        for($s = 1; $s <= $score; $s++) {
            $multiplier = $array[$i];
            $array[$i + $s] += $multiplier;
        }
    }

    foreach($array as $a) {
        $total += $a;
    }

    fclose($fp);
} else {
  echo 'file not found';
}

var_dump($total);

 ?>
