<?php

/**
 * Crea expresiones regulares javascript para date y timedate
 *
 * *
 * @author Ruben Gonzalez <rubenrua@uvigo.es>
 * @since  21 Apr 2008
 *
 */

function get_js_regexp_date($cul){
  $dateFormatInfo = @sfDateTimeFormatInfo::getInstance($cul);
  $dateFormat = $dateFormatInfo->getShortDatePattern();
  
  // We construct the regexp based on date format
  $dateRegexp = preg_replace('/[dmy]+/i', '(\d+)', $dateFormat);
  
  // Use timeformat (HH:mm:ss)
  return $dateRegexp = "/^" . str_replace('/', '\\/', $dateRegexp) . "$/";
}


function get_js_regexp_timedate($cul){
  $dateFormatInfo = @sfDateTimeFormatInfo::getInstance($cul);
  $dateFormat = $dateFormatInfo->getShortDatePattern();

  // We construct the regexp based on date format
  $dateRegexp = preg_replace('/[dmy]+/i', '(\d+)', $dateFormat);

  // Use timeformat (HH:mm:ss)
  $dateRegexp .= ' (\d+):(\d+)(:(\d+))?';
  return $dateRegexp = "/^" . str_replace('/', '\\/', $dateRegexp) . "$/";
}
