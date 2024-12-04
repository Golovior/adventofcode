<?php
$fp = fopen("H:/AdventOfCode/2023/day_14/1_sourcefile.txt", "r");
$total = 0;
$rows = [];

if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        $rows[] = str_split(trim($buffer));
    }

    fclose($fp);

    $rows = array_reverse($rows);

    for($i = 0; $i < count($rows[0]); $i++) {
        $rolling = 0;
        foreach($rows as $k => $row) {
            if($row[$i] == 'O')
            {
                $rolling++;
            }

            if($row[$i] == '#') {
                for($j = 1; $j <= $rolling; $j++) {
                    $rows[$k - $j][$i] = 'O';
                }
                $rolling = 0;

                for($j; $j <= $k; $j++)
                {
                    if($rows[$k - $j][$i] == '#')
                        break;
                    else
                        $rows[$k - $j][$i] = '.';
                }
            }

            if($k == count($rows) - 1) {
                for($j = 0; $j < $rolling; $j++) {
                    $rows[$k - $j][$i] = 'O';
                }

                for($j; $j <= $k; $j++)
                {
                    if($rows[$k - $j][$i] == '#')
                        break;
                    else
                        $rows[$k - $j][$i] = '.';
                }
            }
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
