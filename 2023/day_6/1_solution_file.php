<?php
$fp = fopen("H:/AdventOfCode/2023/day_6/1_sourcefile.txt", "r");
$count = 0;
$total = 0;


if ($fp) {
    $info = [];
    while (($buffer = fgets($fp, 4096)) !== false) {
        $parts = explode(' ', trim($buffer));
        foreach($parts as $p) {
            if(empty($p))
                continue;
            $info[] = $p;
        }
    }

    var_dump($info);

    $race[$info[1]] = $info[6];
    $race[$info[2]] = $info[7];
    $race[$info[3]] = $info[8];
    $race[$info[4]] = $info[9];

    $race1 = 0;
    $race2 = 0;
    $race3 = 0;
    $race4 = 0;

    $current = 1;

    foreach($race as $time => $distance) {
        for($i = 0; $i < $time; $i++) {
            $speed = $i;
            $sailing = $time - $i;

            $sailed = $sailing * $speed;

            if($sailed > $distance)
                ${'race'.$current}++;
        }

        $current++;
    }

    var_dump($race1);
    var_dump($race2);
    var_dump($race3);
    var_dump($race4);

    fclose($fp);
} else {
  echo 'file not found';
}

var_dump($race1 * $race2 * $race3 * $race4);

 ?>
