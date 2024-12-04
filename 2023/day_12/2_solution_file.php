<?php
$fp = fopen("H:/AdventOfCode/2023/day_12/1_sourcefile.txt", "r");
$rows = [];
$arrangements = [];
$total = 0;

function determineDistance($distances, $totalDistances) {
    $first = true;
    $return = [];

    $distancesReverse = array_reverse($distances);
    foreach($distancesReverse as $k => $d) {
        if($first) {
            if($d > 0) {
                $return = $distances;
                $return[count($return) - 1]--;
                $return[count($return) - 2]++;

                return $return;
            }
            $first = false;
        }

        if($d > 1) {
            $unknownNumber = 0;

            for($i = $k + 1; $i < count($distancesReverse); $i++) {
                $unknownNumber += $distancesReverse[$i];
            }

            $return[] = $totalDistances - $unknownNumber - 1 - $k;

            for($i = 0; $i < $k; $i++) {
                $return[] = 1;
            }

            for($i = $k + 1; $i < count($distancesReverse); $i++) {
                if($i == $k + 1)
                    $return[] = $distancesReverse[$i] + 1;
                else
                    $return[] = $distancesReverse[$i];
            }

            return array_reverse($return);
        }
    }
}

if ($fp) {
    $rows = [];
    $arrangements = [];

    while (($buffer = fgets($fp, 4096)) !== false) {
        $parts = explode(' ', trim($buffer));
        $rowInfo = str_split(trim($parts[0]));
        $arrangementInfo = explode(',', trim($parts[1]));
        $row = [];
        $arrangement = [];

        for($i = 0; $i < 5; $i++) {
            foreach($rowInfo as $r) {
                $row[] = $r;
            }

            if($i < 4)
              $row[] = '?';

            foreach($arrangementInfo as $a) {
                $arrangement[] = $a;
            }
        }

        $rows[] = $row;
        $arrangements[] = $arrangement;
    }

    fclose($fp);

    foreach($rows as $k => $row) {
        $arrangement = $arrangements[$k];

        $totalBroken = 0;
        $distances = [];
        $distances[] = 0;
        foreach($arrangement as $a) {
            $totalBroken += $a;
            $distances[] = 1;
        }
        $lengthBrokenPattern = $totalBroken + count($arrangement) - 1;
        $distances[count($distances) - 1] = count($row) - $lengthBrokenPattern;

        $lastPattern = [];

        for($i = count($distances) - 1; $i >= 0; $i--) {
            $arrangementKey = $i;
            for($j = 0; $j <= $distances[$i] - 1; $j++) {
                $lastPattern[] = '.';
            }

            if(array_key_exists(count($arrangement) - $arrangementKey, $arrangement)) {
                for($j = 0; $j < $arrangement[count($arrangement) - $arrangementKey]; $j++) {
                    $lastPattern[] = '#';
                }
            }
        }

        $hasStillPatternsPossible = true;
        $totalDistances = 0;
        $countDistances = true;
        while($hasStillPatternsPossible) {
            set_time_limit(20);
            $pattern = [];
            foreach($distances as $dk => $d) {
                if($countDistances)
                    $totalDistances += $d;

                for($i = 0; $i < $d; $i++) {
                    $pattern[] = '.';
                }

                if(!array_key_exists($dk, $arrangement))
                    break;

                for($i = 0; $i < $arrangement[$dk]; $i++) {
                    $pattern[] = '#';
                }
            }

            $countDistances = false;

            if($pattern === $lastPattern) {
                $hasStillPatternsPossible = false;
            }

            $fits = true;
            foreach($pattern as $pk => $p) {
                if($row[$pk] != $p && $row[$pk] != '?')
                    $fits = false;
            }

            if($fits)
                $total++;

            if(!$hasStillPatternsPossible)
                continue;

            $distances = determineDistance($distances, $totalDistances);
        }

        var_dump($total);
    }

} else {
  echo 'file not found';
}

var_dump($total);
 ?>
