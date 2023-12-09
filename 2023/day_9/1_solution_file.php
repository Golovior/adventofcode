<?php
$fp = fopen("H:/AdventOfCode/2023/day_9/1_sourcefile.txt", "r");
$rows = [];
$total = 0;

function allDiffValuesZero ($values) {
    foreach($values as $v) {
        if($v != 0)
            return false;
    }

    return true;
}

if ($fp) {
    $row = 0;
    while (($buffer = fgets($fp, 4096)) !== false) {
        if(strlen(trim($buffer)) == 0)
          continue;

        $rows[] = explode(' ',trim($buffer));
    }

    fclose($fp);

    var_dump($rows);

    foreach($rows as $row) {
        $continueDifferenceCheck = true;
        $differenceIndex = 1;
        $differences = [];
        $differences[0] = $row;
        while($continueDifferenceCheck) {
            for($i = 0; $i < (count($differences[$differenceIndex - 1]) - 1); $i++)
            {
                $differences[$differenceIndex][] = $differences[$differenceIndex - 1][$i + 1] - $differences[$differenceIndex - 1][$i];
            }

            if(allDiffValuesZero($differences[$differenceIndex]))
                $continueDifferenceCheck = false;

            $differenceIndex++;

            if($differenceIndex > 1000)
            {
                  echo 'Might be something wrong!! ' . implode(' ', $row) . '<br/>';
            }
        }

        var_dump($differences);
        $additions = [];
        for($i = count($differences) - 1; $i >= 0; $i--)
        {
            if(count($additions) == 0)
            {
                $additions[] = 0;
                continue;
            }
            $additions[] = $differences[$i][count($differences[$i]) - 1] + $additions[count($additions) - 1];
        }

        var_dump($additions);

        $total += $additions[count($additions) - 1];
    }

} else {
  echo 'file not found';
}

var_dump($total);

 ?>
