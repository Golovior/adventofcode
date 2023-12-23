<?php
$fp = fopen("H:/AdventOfCode/2023/day_15/1_sourcefile.txt", "r");
$total = 0;
$boxes = [];

function remove($box, $label) {
    GLOBAL $boxes;

    foreach($boxes[$box] as $index => $array) {
        if(array_key_exists($label,$array))
        {
            array_splice($boxes[$box], $index, 1);
            return;
        }
    }
}

function add($box, $label, $lens) {
    GLOBAL $boxes;

    foreach($boxes[$box] as $index => $array) {
        if(array_key_exists($label,$array))
        {
            $boxes[$box][$index][$label] = $lens;
            return;
        }
    }

    $boxes[$box][] = [
        $label => $lens
    ];
}

if ($fp) {
    $buffer = fgets($fp);

    fclose($fp);

    $parts = explode(',', $buffer);
    var_dump($parts);

    for($i = 0; $i < 256; $i++)
        $boxes[$i] = [];

    foreach($parts as $part) {
        $current = 0;
        $label = '';
        $list = str_split(trim($part));

        foreach($list as $l) {
            if($l == '=')
            {
                add($current, $label, $list[count($list) - 1]);
                break;
            }

            if($l == '-')
            {
                remove($current, $label);
                break;
            }

            $label .= $l;
            $ascii = ord($l);
            $current += $ascii;

            $current = $current * 17;
            $current = $current % 256;
        }
    }

    foreach($boxes as $boxId => $box) {
        foreach($box as $index => $lens) {
            foreach($lens as $waarde) {
                $total += ($boxId + 1) * ($index + 1) * $waarde;
            }
        }

    }

} else {
  echo 'file not found';
}

var_dump($total);

?>
