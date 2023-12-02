<?php
$fp = fopen("H:/AdventOfCode/2023/day_2/1_sourcefile.txt", "r");

$count = 0;
$total = 0;

if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        $red = 0;
        $blue = 0;
        $green = 0;

        $game = substr($buffer, 5, strpos($buffer, ':') - 5);

        $grabs = explode(';', substr($buffer,strpos($buffer, ':') + 1));
        foreach($grabs as $grab) {
            $cubes = explode(',', $grab);

            foreach($cubes as $cube) {
                $info = explode(' ', trim($cube));

                $color = $info[1];
                $number = $info[0];

                if($$color < $number)
                    $$color = $number;
            }
        }

        $product = $red * $blue * $green;

        $count++;

        $total += $product;
    }

    echo 'Totaal behandelde games: ' . $count . '<br>';
    echo 'Totaal opgetelde producten: ' . $total . '<br>';
}

 ?>
