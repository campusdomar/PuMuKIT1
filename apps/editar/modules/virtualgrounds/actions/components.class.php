<?php
/**
 * MODULO GROUND COMPONENTS. 
 * Modulo de administracion para las areas de conocimiento y sus tipos. Es decir 
 * las categorias con sus dominios
 *
 * @package    pumukit
 * @subpackage ground
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class virtualgroundsComponents extends sfComponents
{
  public function executeGrounds()
  {
    $c = new Criteria();
    $c->add(GroundPeer::GROUND_TYPE_ID, WidgetConstantPeer::get(10)); 
    $c->addAscendingOrderByColumn(GroundPeer::COD);
    $this->grounds = GroundPeer::doSelect($c);
  }


}
