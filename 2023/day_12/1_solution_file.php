<?php
$fp = fopen("H:/AdventOfCode/2023/day_12/1_sourcefile.txt", "r");
$rows = [];
$arrangements = [];
$total = 0;

if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        $parts = explode(' ', trim($buffer));
        $rows[] = str_split(trim($parts[0]));
        $arrangements[] = explode(',', trim($parts[1]));
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

            switch(count($distances)) {
                case 2:
                    if($distances[1] > 0) {
                        $distances[0]++;
                        $distances[1]--;
                    }
                    break;
                case 3:
                    if($distances[2] > 0) {
                        $distances[1]++;
                        $distances[2]--;
                    } else {
                        $distances[0]++;
                        $distances[1] = 1;
                        $distances[2] = $totalDistances - $distances[0] - 1;
                    }
                    break;
                case 4:
                    if($distances[3] > 0) {
                        $distances[2]++;
                        $distances[3]--;
                    } else {
                        if($distances[2] > 1) {
                            $distances[1]++;
                            $distances[2] = 1;
                            $distances[3] = $totalDistances - ($distances[0] + $distances[1] + 1);
                        } else {
                            $distances[0]++;
                            $distances[1] = 1;
                            $distances[2] = 1;
                            $distances[3] = $totalDistances - ($distances[0] + 2);
                        }
                    }
                    break;
                case 5:
                    if($distances[4] > 0) {
                        $distances[3]++;
                        $distances[4]--;
                    } else {
                        if($distances[3] > 1) {
                            $distances[2]++;
                            $distances[3] = 1;
                            $distances[4] = $totalDistances - ($distances[0] + $distances[1] + $distances[2] + 1);
                        } else {
                            if($distances[2] > 1) {
                                $distances[1]++;
                                $distances[2] = 1;
                                $distances[3] = 1;
                                $distances[4] = $totalDistances - ($distances[0] + $distances[1] + 2);
                            } else {
                                $distances[0]++;
                                $distances[1] = 1;
                                $distances[2] = 1;
                                $distances[3] = 1;
                                $distances[4] = $totalDistances - ($distances[0] + 3);
                            }
                        }
                    }
                    break;
                case 6:
                    if($distances[5] > 0) {
                        $distances[4]++;
                        $distances[5]--;
                    } else {
                        if($distances[4] > 1) {
                            $distances[3]++;
                            $distances[4] = 1;
                            $distances[5] = $totalDistances - ($distances[0] + $distances[1] + $distances[2] + $distances[3] + 1);
                        } else {
                            if($distances[3] > 1) {
                                $distances[2]++;
                                $distances[3] = 1;
                                $distances[4] = 1;
                                $distances[5] = $totalDistances - ($distances[0] + $distances[1] + $distances[2] + 2);
                            } else {
                                if($distances[2] > 1) {
                                    $distances[1]++;
                                    $distances[2] = 1;
                                    $distances[3] = 1;
                                    $distances[4] = 1;
                                    $distances[5] = $totalDistances - ($distances[0] + $distances[1] + 3);
                                } else {
                                    $distances[0]++;
                                    $distances[1] = 1;
                                    $distances[2] = 1;
                                    $distances[3] = 1;
                                    $distances[4] = 1;
                                    $distances[5] = $totalDistances - ($distances[0] + 4);
                                }
                            }
                        }
                    }
                    break;
                case 7:
                    if($distances[6] > 0) {
                        $distances[5]++;
                        $distances[6]--;
                    } else {
                        if($distances[5] > 1) {
                            $distances[4]++;
                            $distances[5] = 1;
                            $distances[6] = $totalDistances - ($distances[0] + $distances[1] + $distances[2] + $distances[3] + $distances[4] + 1);
                        } else {
                            if($distances[4] > 1) {
                                $distances[3]++;
                                $distances[4] = 1;
                                $distances[5] = 1;
                                $distances[6] = $totalDistances - ($distances[0] + $distances[1] + $distances[2] + $distances[3] + 2);
                            } else {
                                if($distances[3] > 1) {
                                    $distances[2]++;
                                    $distances[3] = 1;
                                    $distances[4] = 1;
                                    $distances[5] = 1;
                                    $distances[6] = $totalDistances - ($distances[0] + $distances[1] + $distances[2] + 3);
                                } else {
                                    if($distances[2] > 1) {
                                        $distances[1]++;
                                        $distances[2] = 1;
                                        $distances[3] = 1;
                                        $distances[4] = 1;
                                        $distances[5] = 1;
                                        $distances[6] = $totalDistances - ($distances[0] + $distances[1] + 4);
                                    } else {
                                        $distances[0]++;
                                        $distances[1] = 1;
                                        $distances[2] = 1;
                                        $distances[3] = 1;
                                        $distances[4] = 1;
                                        $distances[5] = 1;
                                        $distances[6] = $totalDistances - ($distances[0] + 5);
                                    }
                                }
                            }
                        }
                    }
                    break;
                default:
                    var_dump(count($distances));
                    die();
            }
        }

        if($k % 10)
            var_dump($total);
    }

} else {
  echo 'file not found';
}

var_dump($total);
 ?>
