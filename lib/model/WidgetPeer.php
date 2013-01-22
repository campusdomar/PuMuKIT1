<?php

/**
 * Subclass for performing query and update operations on the 'widget' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class WidgetPeer extends BaseWidgetPeer
{

  public static function doListWithI18n($type, $culture)
  {
    $c = new Criteria();
    $c->add(WidgetPeer::WIDGET_TYPE_ID, $type);
    return parent::doSelectWithI18n($c, $culture);
  }



}
