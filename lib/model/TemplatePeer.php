<?php

/**
 * Subclass for performing query and update operations on the 'template' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class TemplatePeer extends BaseTemplatePeer
{

  const TYPE_CSS    = 1;
  const TYPE_PAGE   = 2;
  const TYPE_WIDGET = 3;  /*Existe tabla widget_template_peer*/
  const TYPE_MAIL   = 4;  /*Existe tabla widget_template_pelar*/

  const TEXT_CSS    = "CSS";
  const TEXT_PAGE   = "HTML";
  const TEXT_WIDGET = "WGT";  /*Existe tabla widget_template_peer*/
  const TEXT_MAIL   = "MAIL";  /*Existe tabla widget_template_peer*/

  /**
   * Devuelve el texto caracteriazado no name un
   * la cultura especificada.
   *
   * @access public
   * @return string texto
   * @param String $name
   * @param String $culture
   */
  public static function get($name, $culture = 'es'){
    $c = new Criteria();
    $c->add(TemplatePeer::NAME, $name);

    //mejorable
    $info = parent::doSelectOne($c);

    if ($info instanceof Template){
      $info->setCulture( $culture );
      return $info;
    }
    return null;
  }

  public static function getText($name, $culture = 'es'){
    return self::get($name, $culture)->getText();
  }
}
