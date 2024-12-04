<?php
$fp = fopen("H:/AdventOfCode/2023/day_16/1_sourcefile.txt", "r");

function getAmountOfActivated($toHandle, $rows) {
  $solution = $rows;

  $numberOfRows = count($rows);
  $numberOfCols = count($rows[0]);

  while(count($toHandle) > 0) {
      $handling = $toHandle[0];
      array_splice($toHandle, 0, 1);

      $continueLine = true;
      $row = $handling[0];
      $col = $handling[1];
      $dir = $handling[2];

      while($continueLine) {
          if(is_array($solution[$row][$col])) {
              if(($solution[$row][$col][1] == 'h' && ($dir == 'r' || $dir == 'l')) || ($solution[$row][$col][1] == 'v' && ($dir == 'd' || $dir == 'u')))
              {
                  if(!($rows[$row][$col] == '/' || $rows[$row][$col] == '\\'))
                      $continueLine = false;
              }
          }

          switch($dir) {
              case 'l':
              case 'r':
                  $solution[$row][$col] = ['#', 'h'];
                  break;
              case 'u':
              case 'd':
                  $solution[$row][$col] = ['#', 'v'];
                  break;
          }

          switch($rows[$row][$col])
          {
              case '.':
                  switch($dir) {
                      case 'r':
                          $col++;
                          break;
                      case 'l':
                          $col--;
                          break;
                      case 'u':
                          $row--;
                          break;
                      case 'd':
                          $row++;
                          break;
                  }
                  break;
              case '|';
                  switch($dir) {
                      case 'r':
                          $toHandle[] = [$row, $col, 'd'];
                          $row--;
                          $dir = 'u';
                          break;
                      case 'l':
                          $toHandle[] = [$row, $col, 'd'];
                          $row--;
                          $dir = 'u';
                          break;
                      case 'u':
                          $row--;
                          break;
                      case 'd':
                          $row++;
                          break;
                  }
                  break;
              case '-';
                  switch($dir) {
                      case 'r':
                          $col++;
                          break;
                      case 'l':
                          $col--;
                          break;
                      case 'u':
                          $toHandle[] = [$row, $col, 'l'];
                          $col++;
                          $dir = 'r';
                          break;
                      case 'd':
                          $toHandle[] = [$row, $col, 'l'];
                          $col++;
                          $dir = 'r';
                          break;
                  }
                  break;
              case '/':
                  switch($dir) {
                      case 'r':
                          $dir = 'u';
                          $row--;
                          break;
                      case 'u':
                          $dir = 'r';
                          $col++;
                          break;
                      case 'l':
                          $dir = 'd';
                          $row++;
                          break;
                      case 'd':
                          $dir = 'l';
                          $col--;
                          break;
                  }
                  break;
              case '\\':
                  switch($dir) {
                      case 'r':
                          $dir = 'd';
                          $row++;
                          break;
                      case 'u':
                          $dir = 'l';
                          $col--;
                          break;
                      case 'l':
                          $dir = 'u';
                          $row--;
                          break;
                      case 'd':
                          $dir = 'r';
                          $col++;
                          break;
                  }
                  break;
              default:
                  var_dump('ERROR!! '. $rows[$row][$col]);
          }

          if($row < 0 || $row >= $numberOfRows || $col < 0 || $col >= $numberOfCols)
              $continueLine = false;
      }
  }

  $count = 0;
  foreach($solution as $row) {
      foreach($row as $k => $col) {
          if(is_array($col)) {
              $count++;
              $row[$k] = '#';
          }
      }
  }

  return $count;
}

if ($fp) {
    while (($buffer = fgets($fp, 4096)) !== false) {
        $rows[] = str_split(trim($buffer));
    }

    fclose($fp);

    $direction = 'r';

    $solution = $rows;
    $toHandle = [[0,0,'r']];

    $numberOfRows = count($rows);
    $numberOfCols = count($rows[0]);

    var_dump($numberOfRows);
    var_dump($numberOfCols);

    $max = 0;

    for($i = 0; $i < $numberOfRows; $i++) {
        $toHandle = [[$i, 0, 'r']];
        $fromLeft = getAmountOfActivated($toHandle, $rows);

        $toHandle = [[$i, $numberOfCols - 1, 'l']];
        $fromRight = getAmountOfActivated($toHandle, $rows);

        var_dump($fromLeft);
        var_dump($fromRight);

        if($fromLeft > $fromRight)
        {
            if($max < $fromLeft)
                $max = $fromLeft;
        } else {
            if($max < $fromRight)
                $max = $fromRight;
        }
    }

    for($i = 0; $i < $numberOfCols; $i++) {
        $toHandle = [[0, $i, 'd']];
        $fromUp = getAmountOfActivated($toHandle, $rows);

        $toHandle = [[$numberOfRows - 1, $i, 'u']];
        $fromDown = getAmountOfActivated($toHandle, $rows);

        var_dump($fromUp);
        var_dump($fromDown);

        if($fromUp > $fromDown)
        {
            if($max < $fromUp)
                $max = $fromUp;
        } else {
            if($max < $fromDown)
                $max = $fromDown;
        }
    }

} else {
  echo 'file not found';
}

var_dump($max);
?>