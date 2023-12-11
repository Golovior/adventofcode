<?php
function getNextSetOfArray($originals, $map) {
    $new = array();

    foreach($originals as $original) {
        foreach($map as $m) {
            $info = explode(' ', $m);
            if(bccomp($info[1],$original) == -1 && bccomp($info[1] + $info[2], $original) == 1)
            {
                $plus = bcsub($original, $info[1]);
                $new[] = bcadd($info[0], $plus);
                continue 2;
            }
        }
        $new[] = $original;
    }

    return $new;
}

$fp = fopen("H:/AdventOfCode/2023/day_5/1_sourcefile.txt", "r");
if ($fp) {
    $row = 1;
    $seeds = '';
    $seedToSoil = [];
    $soilToFertilizer = [];
    $fertilizerToWater = [];
    $waterToLight = [];
    $lightToTemperature = [];
    $temperatureToHumidity = [];
    $humidityToLocation = [];

    $variable = '';

    while (($buffer = fgets($fp, 4096)) !== false) {
        if($row == 1)
        {
            $seeds = trim($buffer);
            $row++;
            continue;
        }

        $row++;

        if(strlen(trim($buffer)) == 0)
            continue;

        if(is_numeric($buffer[0]))
            $$variable[] = trim($buffer);
        else
        {
            switch(trim($buffer)) {
                case 'seed-to-soil map:':
                    $variable = 'seedToSoil';
                    break;
                case 'soil-to-fertilizer map:':
                    $variable = 'soilToFertilizer';
                    break;
                case 'fertilizer-to-water map:':
                    $variable = 'fertilizerToWater';
                    break;
                case 'water-to-light map:':
                    $variable = 'waterToLight';
                    break;
                case 'light-to-temperature map:':
                    $variable = 'lightToTemperature';
                    break;
                case 'temperature-to-humidity map:':
                    $variable = 'temperatureToHumidity';
                    break;
                case 'humidity-to-location map:':
                    $variable = 'humidityToLocation';
                    break;
                default:
                    var_dump('ERROR!! ' . $buffer);
            }
        }
    }

    fclose($fp);

    $seeds = explode(' ',trim(substr($seeds, 7)));

    var_dump($seeds);

    $soils = getNextSetOfArray($seeds, $seedToSoil);
    $fertilizer = getNextSetOfArray($soils, $soilToFertilizer);
    $water = getNextSetOfArray($fertilizer, $fertilizerToWater);
    $light = getNextSetOfArray($water, $waterToLight);
    $temperature = getNextSetOfArray($light, $lightToTemperature);
    $humidity = getNextSetOfArray($temperature, $temperatureToHumidity);
    $location = getNextSetOfArray($humidity, $humidityToLocation);

    var_dump($location);

    $min = $location[0];

    foreach($location as $l) {
        if(bccomp($min, $l) == 1)
            $min = $l;
    }

} else {
  echo 'file not found';
}

var_dump($min);

 ?>
