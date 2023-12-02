<?php

function getNumber(string $number, bool $forward = true) : int {
  $return = 0;

  if($forward) {
    $index = 9999;
    $return = getStartNumber($number, 1, 'one', $index, $return);
    $return = getStartNumber($number, 2, 'two', $index, $return);
    $return = getStartNumber($number, 3, 'three', $index, $return);
    $return = getStartNumber($number, 4, 'four', $index, $return);
    $return = getStartNumber($number, 5, 'five', $index, $return);
    $return = getStartNumber($number, 6, 'six', $index, $return);
    $return = getStartNumber($number, 7, 'seven', $index, $return);
    $return = getStartNumber($number, 8, 'eight', $index, $return);
    $return = getStartNumber($number, 9, 'nine', $index, $return);
  } else {
    $index = -1;
    $return = getEndNumber($number, 1, 'one', $index, $return);
    $return = getEndNumber($number, 2, 'two', $index, $return);
    $return = getEndNumber($number, 3, 'three', $index, $return);
    $return = getEndNumber($number, 4, 'four', $index, $return);
    $return = getEndNumber($number, 5, 'five', $index, $return);
    $return = getEndNumber($number, 6, 'six', $index, $return);
    $return = getEndNumber($number, 7, 'seven', $index, $return);
    $return = getEndNumber($number, 8, 'eight', $index, $return);
    $return = getEndNumber($number, 9, 'nine', $index, $return);
  }

  return $return;
}

function getStartNumber($string, $number, $text, &$index, $return) : int {
  $workingIndex = strpos($string, $text);
  if($workingIndex !== false && $workingIndex < $index) {
    $index = $workingIndex;
    $return = $number;
  }

  $workingIndex = strpos($string, $number);
  if($workingIndex !== false && $workingIndex < $index) {
    $index = $workingIndex;
    $return = $number;
  }

  return $return;
}

function getEndNumber($string, $number, $text, &$index, $return) : int {
  $workingIndex = strrpos($string, $text);
  if($workingIndex !== false && $workingIndex > $index) {
    $index = $workingIndex;
    $return = $number;
  }

  $workingIndex = strrpos($string, $number);
  if($workingIndex !== false && $workingIndex > $index) {
    $index = $workingIndex;
    $return = $number;
  }

  return $return;
}

$fp = fopen("H:/AdventOfCode/2023/day_1/1_sourcefile.txt", "r");
$count = 0;
$total = 0;
if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        $first = getNumber($buffer);
        $second = getNumber($buffer, false);

        if($first === 0 || $second === 0)
          echo ('Error on ' . $count);

        $numberString = $first . $second;
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
