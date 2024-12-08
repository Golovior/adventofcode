<?php

$fp = fopen("H:/AdventOfCode/2015/day_06/source.txt", "r");
$count = 0;
$total = 0;

if ($fp) {
    $lamps = array_fill(0,1000,array_fill(0,1000,0));
    $actions = [];
    while (($buffer = fgets($fp, 4096)) !== false) {
        $info = explode(' ', $buffer);

        $action = [];
        if($info[0] == 'turn') {
            $action['change'] = $info[1] == 'off' ? '0' : '1';
            $topLeft = 2;
        }
        else {
            $action['change'] = 'T';
            $topLeft = 1;
        }

        $action['topLeft'] = explode(',', $info[$topLeft]);
        $action['bottomRight'] = explode(',', $info[$topLeft + 2]);

        $actions[] = $action;
    }

    foreach($actions as $a) {
        for($lr = $a['topLeft'][0]; $lr <= $a['bottomRight'][0]; $lr++) {
            for($lc = $a['topLeft'][1]; $lc <= $a['bottomRight'][1]; $lc++) {
                switch($a['change']) {
                    case '1':
                        $lamps[$lr][$lc]++;
                        break;
                    case '0':
                        $lamps[$lr][$lc]--;
                        if($lamps[$lr][$lc] < 0)
                            $lamps[$lr][$lc] = 0;
                        break;
                    case 'T':
                        $lamps[$lr][$lc]++;
                        $lamps[$lr][$lc]++;
                }
            }
        }
    }

    foreach($lamps as $lr) {
        foreach($lr as $l) {
            $total += $l;
        }
    }

    var_dump($total);
}
