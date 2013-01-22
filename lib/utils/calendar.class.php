<?php


class calendar
{
  /**
   *
   */
  static $daysInMonth = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

  /**
   *
   */
  static function getDaysInMonth($month, $year)
  {
    if ($month < 1 || $month > 12){
      return 0;
    }

    $d = self::$daysInMonth[$month - 1];

    if ($month == 2){
      if ($year%4 == 0){
        if ($year%100 == 0){
          if ($year%400 == 0){
            $d = 29;
          }
        }else{
          $d = 29;
        }
      }
    }
    return $d;
  }

  /**
   *
   */
  static function generate_array($month, $year){
    $aux = array();

    $dweek = date('N', mktime(0,0,0,$month, 1, $year)) - 1;
    //var_dump(self::getDaysInMonth($month, $year));
    //var_dump(range(1, self::getDaysInMonth($month, $year)));
    foreach(range(1, self::getDaysInMonth($month, $year)) as $i){
      //echo "*", $i , "\t", intval($dweek / 7) , "\t", ($dweek % 7) , "--\n";
      $aux[intval($dweek / 7)][($dweek % 7)] = $i;
      $dweek++;
    }
    return $aux;
  }

}
