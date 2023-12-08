<?php
$fp = fopen("H:/AdventOfCode/2023/day_8/1_sourcefile.txt", "r");
$route = [];
$total = 0;
$directions = [];

if ($fp) {
    $row = 0;
    while (($buffer = fgets($fp, 4096)) !== false) {
        $row++;

        if($row == 1)
        {
          $route = str_split(trim($buffer));
          continue;
        }

        if(strlen(trim($buffer)) == 0)
          continue;

        $key = substr($buffer, 0, 3);
        $l = substr($buffer, 7, 3);
        $r = substr($buffer, 12, 3);

        $directions[$key] = ['L' => $l, 'R' => $r ];
    }

    fclose($fp);

    var_dump($route);

    $total = 0;
    $location = 'AAA';
    while($location != 'ZZZ') {
      foreach($route as $d) {
        $location = $directions[$location][$d];
        $total++;
        if($location == 'ZZZ')
          break;
      }
    }

} else {
  echo 'file not found';
}

var_dump($total);

 ?>
