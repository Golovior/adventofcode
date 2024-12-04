<?php

$fp = fopen("H:/AdventOfCode/2024/day_02/source.txt", "r");
$count = 0;
$total = 0;

if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        $incOrDec = null;
        $levels = explode(' ', $buffer);
        
        $prevNumber = 0;
        $save = true;
        foreach($levels as $k => $level) {
            $iLevel = intval($level);
            if($k == 0) {
                $prevNumber = $iLevel;
                continue;
            }

            if($k == 1) {
                if($prevNumber > $iLevel)
                    $incOrDec = 'inc';

                if($prevNumber == $iLevel) {
                    $save = false;
                    break;
                }

                if($prevNumber < $iLevel)
                    $incOrDec = 'dec';

            }

            $levelDiff = $prevNumber - $iLevel;
            if($levelDiff < 0)
                $levelDiff = 0 - $levelDiff;

            if((($incOrDec == 'inc' && $prevNumber > $iLevel) || ($incOrDec == 'dec' && $prevNumber < $iLevel)) && $levelDiff < 4 ) {
                $prevNumber = $iLevel;
                continue;
            }

            $save = false;
            break;
        }

        if($save) {
            $count++;
        }
    }

    var_dump($count);
}
