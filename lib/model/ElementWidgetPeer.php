<?php

/**
 * Subclass for performing query and update operations on the 'element_widget' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class ElementWidgetPeer extends BaseElementWidgetPeer
{

  public static function doListJoinAll($bar)
  {
    $c = new Criteria();
    $c->addAscendingOrderByColumn(ElementWidgetPeer::RANK);
    $c->addJoin(ElementWidgetPeer::BAR_WIDGET_ID, BarWidgetPeer::ID);
    $c->add(BarWidgetPeer::NAME, $bar);
    return parent::doSelectJoinAll($c);
  }

}
