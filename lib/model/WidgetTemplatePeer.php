<?php

/**
 * Subclass for performing query and update operations on the 'widget_template' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class WidgetTemplatePeer extends BaseWidgetTemplatePeer
{
  /**
   *
   * GET & PUT
   *
   */
  public static function get($id, $culture, $default = null)
  {
    $c = new Criteria();
    $c->add(WidgetTemplatePeer::ID, $id);
    list($ele) = WidgetTemplatePeer::doSelectWithI18n($c,$culture);
    if($ele){
      $default = $ele->getText();
    }
    return $default;
  }


  public static function put($id, $value)
  {
    $ele = WidgetTemplatePeer::retrieveByPK($id);
    if ($ele){
      foreach($value as $v1=>$v2){
	$ele->setCulture($v1);
	$ele->setText($v2);
      }
      $ele->save();
    }
  }


  public static function getByName($name, $culture, $default = null)
  {
    $c = new Criteria();
    $c->add(WidgetTemplatePeer::NAME, $name);
    list($ele) = WidgetTemplatePeer::doSelectWithI18n($c,$culture);
    if($ele){
      $default = $ele->getText();
    }
    return $default;
  }

}
