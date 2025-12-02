<?php

$total = 0;

$start = microtime(true);

$content = file_get_contents("input.txt");
$ranges = explode(',', $content);


foreach($ranges as $range) {
    $parts = explode('-', $range);
    $startRange = $parts[0];
    $endRange = $parts[1];

    for($i = $startRange; $i <= $endRange; $i++) {
        $length = strlen($i);
        if ($length % 2 == 0) {
            if(sumForTwo($i)) {
                $total += $i;
                continue;
            }
        }

        if ($length % 3 == 0) {
            if(sumForThree($i)) {
                $total += $i;
                continue;
            }
        }

        if ($length % 5 == 0) {
            if(sumForFive($i)) {
                $total += $i;
                continue;
            }
        }

        if ($length % 7 == 0) {
            if(sumForSeven($i)) {
                $total += $i;
                continue;
            }
        }

        if ($length % 9 == 0) {
            if(sumForNine($i)) {
                $total += $i;
                continue;
            }
        }

        if ($length % 11 == 0) {
            if(sumForEleven($i)) {
                $total += $i;
                continue;
            }
        }
    }
}

$end = microtime(true);

$totalTime = $end - $start;

echo('Answer: ' . $total . '<br/>');
echo('Time: ' . $totalTime);


function sumForTwo($number) {
    $length = strlen($number);
    $half = $length / 2;

    $substrFront = substr($number, 0, $half);
    $substrBack = substr($number, $half);

    if ($substrFront == $substrBack) {
        return true;
    }
    return false;
}

function sumForThree($number) {
    $length = strlen($number);
    $part = $length / 3;

    $substrA = substr($number, 0, $part);
    $substrB = substr($number, $part, $part);
    $substrC = substr($number, $part * 2);

    if ($substrA == $substrB && $substrB == $substrC) {
        return true;
    }

    return false;
}

function sumForFive($number) {
    $length = strlen($number);
    $part = $length / 5;

    $substrA = substr($number, 0, $part);
    $substrB = substr($number, $part, $part);
    $substrC = substr($number, $part * 2, $part);
    $substrD = substr($number, $part * 3, $part);
    $substrE = substr($number, $part * 4);

    if ($substrA == $substrB
            && $substrB == $substrC
            && $substrC == $substrD
            && $substrD == $substrE) {
        return true;
    }

    return false;
}

function sumForSeven($number) {
    $length = strlen($number);
    $part = $length / 7;

    $substrA = substr($number, 0, $part);
    $substrB = substr($number, $part, $part);
    $substrC = substr($number, $part * 2, $part);
    $substrD = substr($number, $part * 3, $part);
    $substrE = substr($number, $part * 4, $part);
    $substrF = substr($number, $part * 5, $part);
    $substrG = substr($number, $part * 6, $part);

    if ($substrA == $substrB
            && $substrB == $substrC
            && $substrC == $substrD
            && $substrD == $substrE
            && $substrE == $substrF
            && $substrF == $substrG) {
        return true;
    }

    return false;
}

function sumForNine($number) {
    $length = strlen($number);
    $part = $length / 9;

    $substrA = substr($number, 0, $part);
    $substrB = substr($number, $part, $part);
    $substrC = substr($number, $part * 2, $part);
    $substrD = substr($number, $part * 3, $part);
    $substrE = substr($number, $part * 4, $part);
    $substrF = substr($number, $part * 5, $part);
    $substrG = substr($number, $part * 6, $part);
    $substrH = substr($number, $part * 7, $part);
    $substrI = substr($number, $part * 8, $part);

    if ($substrA == $substrB
            && $substrB == $substrC
            && $substrC == $substrD
            && $substrD == $substrE
            && $substrE == $substrF
            && $substrF == $substrG
            && $substrG == $substrH
            && $substrH == $substrI) {
        return true;
    }

    return false;
}

function sumForEleven($number) {
    $length = strlen($number);
    $part = $length / 11;

    $substrA = substr($number, 0, $part);
    $substrB = substr($number, $part, $part);
    $substrC = substr($number, $part * 2, $part);
    $substrD = substr($number, $part * 3, $part);
    $substrE = substr($number, $part * 4, $part);
    $substrF = substr($number, $part * 5, $part);
    $substrG = substr($number, $part * 6, $part);
    $substrH = substr($number, $part * 7, $part);
    $substrI = substr($number, $part * 8, $part);
    $substrJ = substr($number, $part * 9, $part);
    $substrK = substr($number, $part * 10, $part);

    if ($substrA == $substrB
            && $substrB == $substrC
            && $substrC == $substrD
            && $substrD == $substrE
            && $substrE == $substrF
            && $substrF == $substrG
            && $substrG == $substrH
            && $substrH == $substrI
            && $substrI == $substrJ
            && $substrJ == $substrK) {
        return true;
    }

    return false;
}