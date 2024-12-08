<?php

$code = 'iwrupvqb';
$number = 0;

$fiveLeadingZeros = false;
$key = '';
while(!$fiveLeadingZeros)
{
    $key = $code . $number;

    $hash = hash('md5',$key);
    if(str_starts_with($hash, '000000'))
        $fiveLeadingZeros = true;

    $number++;
}

var_dump($key);
