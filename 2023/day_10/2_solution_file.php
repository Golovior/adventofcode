<?php
$fp = fopen("H:/AdventOfCode/2023/day_10/1_sourcefile.txt", "r");
$rows = [];
$total = 0;
$position = [];
$loop = [];

function sortOnRow($a, $b) {
    if($a == $b) return 0;

    if($a > $b) return 1;

    if($a < $b) return -1;
}

if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        $rows[] = str_split(trim($buffer));

        $index = array_search('S', $rows[count($rows) - 1]);

        if($index !== false)
            $position = [count($rows) - 1, $index];
    }

    fclose($fp);

    var_dump($position);

    $continueLoop = true;
    $start = $position;

    $from = '';

    while($continueLoop)
    {
        $connecting = [];

        switch($rows[$position[0]][$position[1]]) {
            case 'S':
                if(isset($position[2])) {
                      echo 'LOOP COMPLETE!';
                      $continueLoop = false;
                      $connecting[] = $start;
                      break 2;
                }

                if($position[0] > 0) {
                    if($rows[$position[0] - 1][$position[1]] == 'F' ||
                            $rows[$position[0] - 1][$position[1]] == '7' ||
                            $rows[$position[0] - 1][$position[1]] == '|')
                        $connecting[] = [$position[0] - 1, $position[1], 'B', $rows[$position[0]][$position[1]]];
                }

                if($position[1] < count($rows[$position[0]])) {
                    if($rows[$position[0]][$position[1] + 1] == '7' ||
                            $rows[$position[0]][$position[1] + 1] == 'J' ||
                            $rows[$position[0]][$position[1] + 1] == '-')
                        $connecting[] = [$position[0], $position[1] + 1, 'L', $rows[$position[0]][$position[1]]];
                }

                if($position[0] < count($rows)) {
                    if($rows[$position[0] + 1][$position[1]] == 'J' ||
                            $rows[$position[0] + 1][$position[1]] == 'L' ||
                            $rows[$position[0] + 1][$position[1]] == '|')
                        $connecting[] = [$position[0] + 1, $position[1], 'T', $rows[$position[0]][$position[1]]];
                }

                if($position[1] > 0) {
                    if($rows[$position[0]][$position[1] - 1] == 'L' ||
                            $rows[$position[0]][$position[1] - 1] == 'F' ||
                            $rows[$position[0]][$position[1] - 1] == '-')
                        $connecting[] = [$position[0], $position[1] - 1, 'R', $rows[$position[0]][$position[1]]];
                }

                if(count($connecting) > 2) {
                    echo 'No clue where to start....';
                    return;
                }

                $position = $connecting[0];
                break;
            case '-' :
                switch($position[2]) {
                    case 'L':
                        if($rows[$position[0]][$position[1] + 1] == '7' ||
                                $rows[$position[0]][$position[1] + 1] == 'J' ||
                                $rows[$position[0]][$position[1] + 1] == '-' ||
                                $rows[$position[0]][$position[1] + 1] == 'S')
                            $connecting[] = [$position[0], $position[1] + 1, 'L', $rows[$position[0]][$position[1]]];
                        break;
                    case 'R':
                        if($rows[$position[0]][$position[1] - 1] == 'L' ||
                                $rows[$position[0]][$position[1] - 1] == 'F' ||
                                $rows[$position[0]][$position[1] - 1] == '-' ||
                                $rows[$position[0]][$position[1] - 1] == 'S')
                            $connecting[] = [$position[0], $position[1] - 1, 'R', $rows[$position[0]][$position[1]]];
                        break;
                    default:
                        echo 'FOUT IN LOOP!! <br>';
                        echo $rows[$position[0]][$position[1]] . ' -> ' . $position[2];
                        return;
                }

                $position = $connecting[0];
                break;
            case '|' :
                switch($position[2]) {
                    case 'T':
                        if($rows[$position[0] + 1][$position[1]] == '|' ||
                                $rows[$position[0] + 1][$position[1]] == 'J' ||
                                $rows[$position[0] + 1][$position[1]] == 'L' ||
                                $rows[$position[0] + 1][$position[1]] == 'S')
                            $connecting[] = [$position[0] + 1, $position[1], 'T', $rows[$position[0]][$position[1]]];
                        break;
                    case 'B':
                        if($rows[$position[0] - 1][$position[1]] == 'F' ||
                                $rows[$position[0] - 1][$position[1]] == '7' ||
                                $rows[$position[0] - 1][$position[1]] == '|' ||
                                $rows[$position[0] - 1][$position[1]] == 'S')
                            $connecting[] = [$position[0] - 1, $position[1], 'B', $rows[$position[0]][$position[1]]];
                        break;
                    default:
                        echo 'FOUT IN LOOP!! <br>';
                        echo $rows[$position[0]][$position[1]] . ' -> ' . $position[2];
                        return;
                }

                $position = $connecting[0];
                break;
            case 'J' :
                switch($position[2]) {
                    case 'T':
                        if($rows[$position[0]][$position[1] - 1] == '-' ||
                                $rows[$position[0]][$position[1] - 1] == 'F' ||
                                $rows[$position[0]][$position[1] - 1] == 'L' ||
                                $rows[$position[0]][$position[1] - 1] == 'S')
                            $connecting[] = [$position[0], $position[1] - 1, 'R', $rows[$position[0]][$position[1]]];
                        break;
                    case 'L':
                        if($rows[$position[0] - 1][$position[1]] == '|' ||
                                $rows[$position[0] - 1][$position[1]] == 'F' ||
                                $rows[$position[0] - 1][$position[1]] == '7' ||
                                $rows[$position[0] - 1][$position[1]] == 'S')
                            $connecting[] = [$position[0] - 1, $position[1], 'B', $rows[$position[0]][$position[1]]];
                        break;
                    default:
                        echo 'FOUT IN LOOP!! <br>';
                        echo $rows[$position[0]][$position[1]] . ' -> ' . $position[2];
                        return;
                }

                $position = $connecting[0];
                break;
            case 'F' :
                switch($position[2]) {
                    case 'B':
                        if($rows[$position[0]][$position[1] + 1] == '-' ||
                                $rows[$position[0]][$position[1] + 1] == '7' ||
                                $rows[$position[0]][$position[1] + 1] == 'J' ||
                                $rows[$position[0]][$position[1] + 1] == 'S')
                            $connecting[] = [$position[0], $position[1] + 1, 'L', $rows[$position[0]][$position[1]]];
                        break;
                    case 'R':
                        if($rows[$position[0] + 1][$position[1]] == '|' ||
                                $rows[$position[0] + 1][$position[1]] == 'J' ||
                                $rows[$position[0] + 1][$position[1]] == 'L' ||
                                $rows[$position[0] + 1][$position[1]] == 'S')
                            $connecting[] = [$position[0] + 1, $position[1], 'T', $rows[$position[0]][$position[1]]];
                        break;
                    default:
                        echo 'FOUT IN LOOP!! <br>';
                        echo $rows[$position[0]][$position[1]] . ' -> ' . $position[2];
                        return;
                }

                $position = $connecting[0];
                break;
            case '7' :
                switch($position[2]) {
                    case 'B':
                        if($rows[$position[0]][$position[1] - 1] == '-' ||
                                $rows[$position[0]][$position[1] - 1] == 'F' ||
                                $rows[$position[0]][$position[1] - 1] == 'L' ||
                                $rows[$position[0]][$position[1] - 1] == 'S')
                            $connecting[] = [$position[0], $position[1] - 1, 'R', $rows[$position[0]][$position[1]]];
                        break;
                    case 'L':
                        if($rows[$position[0] + 1][$position[1]] == '|' ||
                                $rows[$position[0] + 1][$position[1]] == 'J' ||
                                $rows[$position[0] + 1][$position[1]] == 'L' ||
                                $rows[$position[0] + 1][$position[1]] == 'S')
                            $connecting[] = [$position[0] + 1, $position[1], 'T', $rows[$position[0]][$position[1]]];
                        break;
                    default:
                        echo 'FOUT IN LOOP!! <br>';
                        echo $rows[$position[0]][$position[1]] . ' -> ' . $position[2];
                        return;
                }

                $position = $connecting[0];
                break;
            case 'L' :
                switch($position[2]) {
                    case 'T':
                        if($rows[$position[0]][$position[1] + 1] == '-' ||
                                $rows[$position[0]][$position[1] + 1] == '7' ||
                                $rows[$position[0]][$position[1] + 1] == 'J' ||
                                $rows[$position[0]][$position[1] + 1] == 'S')
                            $connecting[] = [$position[0], $position[1] + 1, 'L', $rows[$position[0]][$position[1]]];
                        break;
                    case 'R':
                        if($rows[$position[0] - 1][$position[1]] == '|' ||
                                $rows[$position[0] - 1][$position[1]] == 'F' ||
                                $rows[$position[0] - 1][$position[1]] == '7' ||
                                $rows[$position[0] - 1][$position[1]] == 'S')
                            $connecting[] = [$position[0] - 1, $position[1], 'B', $rows[$position[0]][$position[1]]];
                        break;
                    default:
                        echo 'FOUT IN LOOP!! <br>';
                        echo $rows[$position[0]][$position[1]] . ' -> ' . $position[2];
                        return;
                }

                $position = $connecting[0];
                break;
            default:
                echo 'Nog niet hier...' . $rows[$position[0]][$position[1]];
                break;
        }

        $loop[] = $position;
    }

    usort($loop, "sortOnRow");

    $rowInfo = [];
    foreach($loop as $position) {
        $rowInfo[$position[0]][] = $position[1];
    }

    $inside = 0;
    $additions = [];
    foreach($rowInfo as $nr => $row) {
        $prev = -1;
        $symbol = '.';
        $skip = true;
        $between = false;
        echo ' ---------------- ' . $nr .' ----------------- <br/>';
        foreach($row as $col) {
            $value = $rows[$nr][$col];
            echo $value . ': in column ' . $col .' has skipped ' . $skip . ' with prev ' . $prev .'<br>';
            if($value == '-')
            {
                $prev = $col;
            }

            if($value == '|')
            {
                if($between)
                    $between = false;
                else
                    $between = true;

                $skip = !$between;

                if(!$skip) {
                    $prev = $col;
                }
                else
                {
                    if($col - $prev > 1 && $prev > -1) {
                        $inside += $col - $prev - 1;
                        $additions[] = [$nr, $col, $prev];
                    }
                }
            }

            if($value == 'F')
            {
                if(!$skip) {
                    if($col - $prev > 1 && $prev > -1) {
                        $inside += $col - $prev - 1;
                        $additions[] = [$nr, $col, $prev];
                    }
                    $skip = true;
                }
                $prev = $col;
                $symbol = 'F';
            }

            if($value == 'L')
            {
                if(!$skip) {
                    if($col - $prev > 1 && $prev > -1) {
                        $inside += $col - $prev - 1;
                        $additions[] = [$nr, $col, $prev];
                    }
                    $skip = true;
                }
                $prev = $col;
                $symbol = 'L';
            }

            if($value == '7')
            {
                if($symbol == 'L') {
                    if($between)
                        $between = false;
                    else
                        $between = true;
                }

                $skip = !$between;

                $prev = $col;
            }

            if($value == 'J')
            {
                if($symbol == 'F') {
                    if($between)
                        $between = false;
                    else
                        $between = true;
                }

                $skip = !$between;

                $prev = $col;
            }
        }
    }

    var_dump($inside);
    var_dump($additions);

} else {
  echo 'file not found';
}

foreach($loop as $l) {
    echo $l[3] . ' ';
}

var_dump(count($loop) / 2);

?>
