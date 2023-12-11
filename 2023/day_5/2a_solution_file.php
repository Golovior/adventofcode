<?php
function getNextSetOfArray($original, $map) {
    $new = $original;
    $extra = 0;
    foreach($map as $info) {
        if(($info[1] == $original || bccomp($info[1],$original) == -1) && (bcadd($info[2],$info[1]) == $original || bccomp(bcadd($info[2],$info[1]), $original) == 1))
        {
            $plus = bcsub($original, $info[1]);
            $new = bcadd($info[0], $plus);
            var_dump($info[2]);
            $extra = bcsub(bcsub($info[2], $plus), '1');
            break;
        }
    }

    if($extra == 0) {
        $difference = 10000000000;
        foreach($map as $info) {
            if(bccomp($info[1],$original) == 1 && bccomp($difference, bcsub($info[1],$original)) == 1)
            {
                $difference = bcsub($info[1],$original);
            }
        }
        $extra = $difference;
    }
    var_dump([$new, $extra]);
    echo '-------------------------------------';
    return [$new, $extra];
}

function beginning($a, $b) {
    return bccomp($a[0], $b[0]);
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
            $$variable[] = explode(' ',trim($buffer));
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

    usort($seedToSoil, 'beginning');
    usort($soilToFertilizer, 'beginning');
    usort($fertilizerToWater, 'beginning');
    usort($waterToLight, 'beginning');
    usort($lightToTemperature, 'beginning');
    usort($temperatureToHumidity, 'beginning');
    usort($humidityToLocation, 'beginning');

    // var_dump($seedToSoil);
    // var_dump($soilToFertilizer);
    // var_dump($fertilizerToWater);
    // var_dump($waterToLight);
    // var_dump($lightToTemperature);
    // var_dump($temperatureToHumidity);
    // var_dump($humidityToLocation);

    $seeds = explode(' ',trim(substr($seeds, 7)));

    $serie = [];
    $min = '10000000000';

    $beginning = 0;
    $aantal = 1;
    $count = 0;
    $continueSeeds = true;

    while($continueSeeds) {
        for($i = $seeds[$beginning]; $i < bcadd($seeds[$beginning], $seeds[$aantal]); $i += 1) {
            var_dump($i);
            set_time_limit(5);
            $soil = getNextSetOfArray($i, $seedToSoil);
            $fertilizer = getNextSetOfArray($soil[0], $soilToFertilizer);
            $water = getNextSetOfArray($fertilizer[0], $fertilizerToWater);
            $light = getNextSetOfArray($water[0], $waterToLight);
            $temperature = getNextSetOfArray($light[0], $lightToTemperature);
            $humidity = getNextSetOfArray($temperature[0], $temperatureToHumidity);
            $location = getNextSetOfArray($humidity[0], $humidityToLocation);

            if(bccomp($min, $location[0]) == 1)
                $min = $location[0];

            $plus = $soil[1];
            if(bccomp($plus, $fertilizer[1]) == 1)
                $plus = $fertilizer[1];

            if(bccomp($plus, $water[1]) == 1)
                $plus = $water[1];

            if(bccomp($plus, $light[1]) == 1)
                $plus = $light[1];

            if(bccomp($plus, $temperature[1]) == 1)
                $plus = $temperature[1];

            if(bccomp($plus, $humidity[1]) == 1)
                $plus = $humidity[1];

            if(bccomp($plus, $location[1]) == 1)
                $plus = $location[1];

            echo '<br>PLUS: ' . $plus . '<br>';
            $i = bcadd(bcadd($i, $plus),'1');
        }
        $beginning += 2;
        $aantal += 2;

        if(!isset($seeds[$beginning]))
            $continueSeeds = false;
    }
} else {
  echo 'file not found';
}

var_dump($min);

 ?>
