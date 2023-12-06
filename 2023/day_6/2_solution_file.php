<?php
$fp = fopen("H:/AdventOfCode/2023/day_6/1_sourcefile.txt", "r");
$count = 0;

if ($fp) {
    $info = [];
    while (($buffer = fgets($fp, 4096)) !== false) {
        $total = '';
        $parts = explode(' ', trim($buffer));
        foreach($parts as $p) {
            if(empty($p))
                continue;
            if(!is_numeric($p))
                continue;

            $total .= $p;
        }
        $info[] = $total;
    }

    var_dump($info);

    $race[$info[0]] = $info[1];

    $race1 = 0;

    foreach($race as $time => $distance) {
        $win = 0;
        for($i = 0; $i < $time; $i++) {
            $sailing = bcsub($time, $i);
            $sailed = bcmul($sailing, $i);

            if(bccomp($sailed, $distance) == 1)
            {
                $race1++;
                $win = 1;
            } else if ($win == 1) {
                break;
            }
        }
    }

    var_dump($race1);

    fclose($fp);
} else {
  echo 'file not found';
}

var_dump($race1);

 ?>
