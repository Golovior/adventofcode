<?php
$fp = fopen("H:/AdventOfCode/2023/day_4/1_sourcefile.txt", "r");
$count = 0;
$total = 0;


if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        $parts = explode(':', $buffer);

        $numbers = explode('|', $parts[1]);
        $priceNumbers = str_replace(' ', '  ', $numbers[0]);
        preg_match_all("|\s(\d+)\s|U",
            $priceNumbers,
            $price, PREG_PATTERN_ORDER);


        $scratchNumbers = str_replace(' ', '  ', $numbers[1]);
        preg_match_all("|\s(\d+)\s|U",
            $scratchNumbers,
            $scratch, PREG_PATTERN_ORDER);

        $score = 0.5;

        foreach($price[0] as $number) {
            if(in_array($number, $scratch[0]))
                $score *= 2;
        }

        if($score > 0.5)
            $total += $score;

    }

    fclose($fp);
} else {
  echo 'file not found';
}

var_dump($total);

 ?>
