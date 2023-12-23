<?php
$fp = fopen("H:/AdventOfCode/2023/day_13/1_sourcefile.txt", "r");
$fields = [];
$total = 0;

function getVerticalMirrorRow($field) {
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

    return getHorizontalMirrorRow($newField);
}

function getHorizontalMirrorRow($field) {
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

        if($foundMirror)
            return $i + 1;
    }

    return -1;
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

    foreach($fields as $field) {
        $verticalMirrored = getVerticalMirrorRow($field);
        $horizontalMirrored = getHorizontalMirrorRow($field) * 100;

        if($verticalMirrored > -1) {
            $total += $verticalMirrored;
        }

        if($horizontalMirrored > -1) {
            $total += $horizontalMirrored;
        }
    }

} else {
  echo 'file not found';
}

var_dump($total);
 ?>
