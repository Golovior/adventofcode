<?php

$fp_rules = fopen("H:/AdventOfCode/2024/day_05/source_rules.txt", "r");
$fp_updates = fopen("H:/AdventOfCode/2024/day_05/source_updates.txt", "r");
$count = 0;
$total = 0;

if ($fp_rules && $fp_updates) {
    $rules = [];
    $updates = [];
    while (($buffer = fgets($fp_rules, 4096)) !== false) {
        $rules[] = explode('|',trim($buffer));
    }

    while (($buffer = fgets($fp_updates, 4096)) !== false) {
        $updates[] = explode(',',trim($buffer));
    }

    foreach($updates as $update) {
        $correctUpdate = true;
        foreach($update as $id => $number)
        {
            for($r = 0; $r < count($rules); $r++) {
                if($rules[$r][0] != $number)
                    continue;

                for($check = 0; $check < $id; $check++) {
                    if($update[$check] == $rules[$r][1])
                        $correctUpdate = false;
                }
            }
        }

        if(!$correctUpdate) {
            $orderedUpdate = orderUpdate($rules, $update);



            $length = count($orderedUpdate);
            $number = $orderedUpdate[($length - 1) / 2];
            $total += $number;
        }
    }

    var_dump($total);

}

function orderUpdate(array $rules, array $update) {

    $handleRules = [];
    foreach($rules as $rule) {
        if(in_array($rule[0], $update) && in_array($rule[1], $update))
            $handleRules[] = $rule;
    }

    $numbersBefore = [];
    foreach($update as $u) {
        $numbersBefore[$u] = [];
        foreach($handleRules as $hr) {
            if($hr[1] == $u)
                $numbersBefore[$u][] = $hr[0];
        }
    }

    $newUpdate = [];

    foreach($numbersBefore as $nr => $set) {
        $newUpdate[count($set)] = $nr;
    }

    ksort($newUpdate);

    return $newUpdate;
}
