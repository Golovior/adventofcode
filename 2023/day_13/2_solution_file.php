<?php
$fp = fopen("H:/AdventOfCode/2023/day_13/1_sourcefile.txt", "r");
$fields = [];
$total = 0;

function getVerticalMirrorRow($field, $notValue) {
    $rows = [];
    foreach($field as $row) {
        $rows[] = str_split($row);
    }

    $turnedField = [];
    foreach($rows as $k => $r) {
        foreach($r as $ck => $c)
        {
            $turnedField[$ck][] = $c;
        }
    }

    $newField = [];

    foreach($turnedField as $row) {
        $newField[] = implode(array_reverse($row));
    }

    return getHorizontalMirrorRow($newField, $notValue);
}

function getHorizontalMirrorRow($field, $notValue) {
    for($i = 0; $i < count($field) - 1; $i++) {
        $noRowAvailable = false;
        $foundMirror = true;
        $j = $i;
        $k = $i + 1;
        while(!$noRowAvailable) {
            if(array_key_exists($j, $field) && array_key_exists($k, $field))
            {
                if($field[$j] !== $field[$k])
                {
                    $foundMirror = false;
                    $noRowAvailable = true;
                }

                $j--;
                $k++;
            }
            else {
                $noRowAvailable = true;
            }
        }

        if($foundMirror && $notValue != ($i + 1))
            return $i + 1;
    }

    return -1;
}

function updateSymbol($number, $field) {
    $row = floor($number / strlen($field[0]));
    $col = $number - ($row * strlen($field[0]));

    $rowInfo = str_split($field[$row]);

    if($rowInfo[$col] == '#')
    {
        $rowInfo[$col] = '.';
    }
    else {
        $rowInfo[$col] = '#';
    }

    $field[$row] = implode($rowInfo);

    return $field;
}

if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        if(trim($buffer) == '') {
                $fields[] = $field;
                $field = [];
        } else {
            if(!isset($field)) {
                $field = [];
            }
            $field[] = trim($buffer);
        }
    }

    fclose($fp);

    $fields[] = $field;
    $z = 0;

    foreach($fields as $field) {
        $foundMirror = false;
        $numberOfPossibilities = strlen($field[0]) * count($field);
        $z++;

        var_dump($field);
        $verticalMirroredOld = getVerticalMirrorRow($field, -1);
        $horizontalMirroredOld = getHorizontalMirrorRow($field, -1);

        while(!$foundMirror) {
            for($n = 0; $n < $numberOfPossibilities; $n++) {
                $show = false;
                $fieldUpdated = updateSymbol($n, $field);
                if($n > 32 && $n < 36)
                {
                    var_dump($n);
                    var_dump($fieldUpdated);
                    $show = true;
                }
                $verticalMirrored = getVerticalMirrorRow($fieldUpdated, $verticalMirroredOld);
                $horizontalMirrored = getHorizontalMirrorRow($fieldUpdated, $horizontalMirroredOld) * 100;

                if($verticalMirrored == -1 && $horizontalMirrored == -100)
                    continue;

                    var_dump($n);
                    var_dump($fieldUpdated);
                    var_dump($verticalMirrored);
                    var_dump($horizontalMirrored);

                if($verticalMirrored > -1 && $verticalMirrored != $verticalMirroredOld) {
                    $total += $verticalMirrored;
                }

                if($horizontalMirrored > -1 && $horizontalMirrored != $horizontalMirroredOld) {
                    $total += $horizontalMirrored;
                }
                $foundMirror = true;
                break;
            }

            if(!$foundMirror) {
                echo 'ERROR!!';
                die();
            }

        }
    }

} else {
  echo 'file not found';
}

var_dump($total);
 ?>
