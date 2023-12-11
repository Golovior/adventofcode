<?php
function getNextSetOfArray($original, $map) {
    $new = $original;
    foreach($map as $m) {
        $info = explode(' ', $m);
        if(bccomp($info[1],$original) == -1 && bccomp($info[1] + $info[2], $original) == 1)
        {
            $plus = bcsub($original, $info[1]);
            $new = bcadd($info[0], $plus);
            break;
        }
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

    $serie = [];
    $min = '10000000000';

    $beginning = 4;
    $aantal = 5;
    $count = 0;

    while($beginning < count($seeds)) {
        for($i = $seeds[$beginning]; $i < $seeds[$beginning] + $seeds[$aantal]; $i++) {
            if($i == $seeds[$beginning]) {
                  echo 'First seed: ' . $seeds[$beginning]. '</br>';
                  echo 'Last seed: ' . bcadd($seeds[$aantal], $seeds[$beginning]) . '</br>';
            }
            set_time_limit(5);
            $soil = getNextSetOfArray($i, $seedToSoil);
            $fertilizer = getNextSetOfArray($soil, $soilToFertilizer);
            $water = getNextSetOfArray($fertilizer, $fertilizerToWater);
            $light = getNextSetOfArray($water, $waterToLight);
            $temperature = getNextSetOfArray($light, $lightToTemperature);
            $humidity = getNextSetOfArray($temperature, $temperatureToHumidity);
            $location = getNextSetOfArray($humidity, $humidityToLocation);

            if(bccomp($min, $location) == 1)
                $min = $location;

            $count++;
            if($count > 10000 || $min == $location)
            {
                $count = 0;
                var_dump($i);
                var_dump($min);
                echo '------------------------------------------';
            }

        }
        $beginning += 2;
        $aantal += 2;
    }
} else {
  echo 'file not found';
}

var_dump($min);

 ?>
