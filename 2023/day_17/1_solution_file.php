<?php
$fp = fopen("H:/AdventOfCode/2023/day_17/1_sourcefile.txt", "r");

if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        $rows[] = str_split(trim($buffer));
    }

    fclose($fp);

    var_dump($rows);



} else {
  echo 'file not found';
}

?>
