<?php

/**
 * Subclass for performing query and update operations on the 'widget_constant' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class WidgetConstantPeer extends BaseWidgetConstantPeer
{
  /**
   *
   * GET & PUT
   *
   */
  public static function get($id, $default = null)
  {
    $ele = WidgetConstantPeer::retrieveByPK($id);
    if($ele){
      $default = $ele->getText();
    }
    return $default;
  }


  public static function put($id, $value)
  {
    $ele = WidgetConstantPeer::retrieveByPK($id);
    if($ele){
      $ele->setText($value);
      $ele->save();
    }
  }

  public static function getMasVistosFalso($id_start, $id_stop)
  {
    $mms = array();
    for($i = $id_start; $i < $id_stop; $i++){
      $num = WidgetConstantPeer::get($i);
      if(($num[0] == 'S') || ($num[0] == 's')){
	$aux = SerialPeer::retrieveByPk(substr($num, 1));
      }elseif(is_numeric($num[0])){
	$aux = SerialPeer::retrieveByPk(intval($num));
      }elseif(substr($num , -4, 1) == '.'){
	$aux = MmPeer::retrieveByUrl($num);
      }else{
	$aux = MmPeer::retrieveByPk(substr($num, 1));
      }
      if ($aux !== null) $mms[] = $aux;
    }
    return $mms;
  }
}
