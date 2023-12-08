<?php
$fp = fopen("H:/AdventOfCode/2023/day_8/1_sourcefile.txt", "r");
$route = [];
$total = 0;
$directions = [];
$locations = [];
$rounds = 0;

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

        if(substr($key, 2,1) == 'A')
          $locations[] = $key;
    }
    fclose($fp);
    var_dump($locations);

    $total = 0;
    $allLocationsZ = false;
    var_dump($locations);
    $zs = [0 => [], 1 => [], 2 => [], 3 => [], 4 => [], 5 => []];

    while(!$allLocationsZ) {
      $rounds++;
      foreach($route as $d) {
        set_time_limit(1);
        foreach($locations as $k => $location)
        {
          $locations[$k] = $directions[$location][$d];
        }

        $total++;

        $allLocationsZ = true;
        foreach($locations as $k => $location)
        {
          if(substr($location, 2,1) != 'Z')
          {
            $allLocationsZ = false;
          }
          else {
            $zs[$k][] = $total;
          }
        }

        if($allLocationsZ)
          break;
      }
      var_dump($zs);
      if($rounds > 500)
        break;
    }

    $difference = [];

    foreach($zs as $k => $z) {
      $difference[$k] = [];
      for($i = 0; $i < count($z) - 1; $i++)
      {
        $difference[$k][] = $z[$i+1] - $z[$i];
      }
    }

    var_dump($difference);

    $difdifference = [];

    foreach($difference as $k => $z) {
      $difdifference[$k] = [];
      for($i = 0; $i < count($z) - 1; $i++)
      {
        $difdifference[$k][] = $z[$i+1] - $z[$i];
      }
    }

    var_dump($difdifference);

    $lcm1 = gmp_lcm($zs[0][0], $zs[1][0]);
    $lcm2 = gmp_lcm($zs[2][0], $zs[3][0]);
    $lcm3 = gmp_lcm($zs[4][0], $zs[5][0]);

    $lcm4 = gmp_lcm($lcm1, $lcm2);
    $lcm = gmp_lcm($lcm3, $lcm4);

} else {
  echo 'file not found';
}

var_dump($lcm);

 ?>
