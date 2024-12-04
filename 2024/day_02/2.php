<?php

$fp = fopen("H:/AdventOfCode/2024/day_02/source.txt", "r");
$count = 0;
$total = 0;

if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        $levels = explode(' ', $buffer);

        for($i = 0; $i < count($levels); $i++)
        {
            $prevNumber = null;
            $incOrDec = null;

            $save = true;
            foreach($levels as $k => $level) {
                if($k == $i)
                    continue;
                
                $iLevel = intval($level);
                if(is_null($prevNumber)) {
                    $prevNumber = $iLevel;
                    continue;
                }

                if(is_null($incOrDec)) {
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

            if($save)
                break;
        }

        if($save) {
            $count++;
        }
    }

    var_dump($count);
}
