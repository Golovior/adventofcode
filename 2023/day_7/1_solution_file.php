<?php
$fp = fopen("H:/AdventOfCode/2023/day_7/1_sourcefile.txt", "r");
$games = [];
$total = 0;

function getTypeOfHand($hand) {
    $values = str_split($hand);
    sort($values);

    if($values[0] == $values[1])
    {
      if($values[0] == $values[2])
      {
        if($values[0] == $values[3])
        {
          if($values[0] == $values[4])
          {
            return 6;
          }

          return 5;
        }

        if($values[3] == $values[4])
        {
          return 4;
        }

        return 3;
      }

      if($values[2] == $values[3])
      {
        if($values[2] == $values[4])
        {
          return 4;
        }

        return 2;
      }

      if($values[3] == $values[4])
      {
        return 2;
      }
      return 1;
    }

    if($values[1] == $values[2])
    {
      if($values[1] == $values[3])
      {
        if($values[1] == $values[4])
        {
          return 5;
        }

        return 3;
      }

      if($values[3] == $values[4])
      {
        return 2;
      }

      return 1;
    }

    if($values[2] == $values[3])
    {
      if($values[2] == $values[4])
      {
        return 3;
      }
      return 1;
    }

    if($values[3] == $values[4])
    {
      return 1;
    }

    return 0;
}

function sortHand($a, $b) {
    $valuesa = str_split($a['hand']);
    $valuesb = str_split($b['hand']);

    foreach($valuesa as $k => $va) {
        $vb = $valuesb[$k];
        if($va == $vb)
            continue;
            
        if(is_numeric($va) && !is_numeric($vb))
            return -1;
        if(!is_numeric($va) && is_numeric($vb))
            return 1;

        if(is_numeric($va) && is_numeric($vb))
            return $va > $vb ? 1 : -1;

        if(!is_numeric($va) && !is_numeric($vb))
            return strnatcmp($va, $vb);
    }
}

if ($fp) {
    $info = [];
    $types = [];
    while (($buffer = fgets($fp, 4096)) !== false) {
        $parts = explode(' ', trim($buffer));
        $hand = str_replace('A', 'E', $parts[0]);
        $hand = str_replace('K', 'D', $hand);
        $hand = str_replace('Q', 'C', $hand);
        $hand = str_replace('J', 'B', $hand);
        $hand = str_replace('T', 'A', $hand);
        $games[] = ['hand' => $hand, 'bet' => $parts[1]];
    }

    fclose($fp);

    foreach($games as $game) {
        $types[getTypeOfHand($game['hand'])][] = $game;
    }

    foreach($types as $rank => $type) {
        usort($type, "sortHand");
        $types[$rank] = $type;
    }

    $rank = 0;

    for($i = 0; $i < 7; $i++) {
        $type = $types[$i];

        echo '=============' . $i . '================<br/>';
        foreach($type as $k => $game) {
            echo $game['hand'] . ' ' . getTypeOfHand($game['hand']) . '<br/>';

            $rank++;
            $types[$i][$k]['rank'] = $rank;

            $total += $game['bet'] * $rank;
        }
    }

} else {
  echo 'file not found';
}

var_dump($total);

 ?>
