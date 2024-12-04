<?php
$fp = fopen("H:/AdventOfCode/2023/day_14/1_sourcefile.txt", "r");
$total = 0;
$rows = [];
$opbouw = [];
$oldRows = [];

function turnRightArray($array) {
    $rArray = array_reverse($array);
    $return = [];

    foreach($rArray as $k => $r) {
        $return[$k] = [];
        foreach($rArray as $c) {
            $return[$k][] = $c[$k];
        }
    }
    return $return;
}

if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        $rows[] = str_split(trim($buffer));
    }

    fclose($fp);
    $ms = 0;
    $trT = 0;
    $round = [];

    for($t = 0; $t < 4000000000; $t++) {
        $time_start = microtime(true);
        $rows = array_reverse($rows);
        for($i = 0; $i < count($rows[0]); $i++) {
            $rolling = 0;
            foreach($rows as $k => $row) {
                if($row[$i] == 'O')
                {
                    $rolling++;
                    $rows[$k][$i] = '.';
                }

                if($row[$i] == '#') {
                    for($j = 1; $j <= $rolling; $j++) {
                        $rows[$k - $j][$i] = 'O';
                    }
                    $rolling = 0;
                }

                if($k == count($rows) - 1) {
                    for($j = 0; $j < $rolling; $j++) {
                        $rows[$k - $j][$i] = 'O';
                    }
                }
            }
        }
        $rows = array_reverse($rows);
        if($t % 4 == 0) {
            $regels = [];
            foreach($rows as $r) {
                $regels[] = implode('', $r);
            }

            $string = implode('', $regels);
            $index = array_search($string, $opbouw);
            var_dump($index);
            var_dump($t);

            if($index !== false) {
                $rest = 4000000000 % ($t - ($index * 4));
                var_dump($opbouw[($rest / 4)]);
                var_dump($rest);
                $rows = $oldRows[($rest / 4)];
                $t = 1000000000000;
                continue;
            }
            else {
                $opbouw[] = $string;
                $oldRows[] = $rows;
            }
        }

        $trTS = microtime(true);
        $rows = turnRightArray($rows);

        $trT += microtime(true) - $trTS;

        $ms += microtime(true) - $time_start;
        if($t % 10000 == 0) {
            echo '<br/>--------------------<br/>';

            set_time_limit(8);
            echo 'Had ' . $t . '. Average time = ' . ($ms) . ' seconden. En ' . $trT . ' seconden in turn.<br/>';
            $trT = 0;
            $ms = 0;
        }
    }

    foreach($rows as $k => $r)
    {
        foreach($r as $c)
        {
            if($c == 'O')
                $total += ($k + 1);
        }
    }

} else {
  echo 'file not found';
}

var_dump($total);
?>
