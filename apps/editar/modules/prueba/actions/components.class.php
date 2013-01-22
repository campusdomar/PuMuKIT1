<?php

/**
 * prueba components.
 *
 * @package    pumukituvigo
 * @subpackage prueba
 * @author     Ruben Glez <rubenrua at uvigo.es>
 * @version    SVN: $Id: components.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class pruebaComponents extends sfComponents
{
  /**
   * Executes index component
   *
   */
  public function executeGround()
  {
    $c = new Criteria();
    $c->add(GroundPeer::GROUND_TYPE_ID, 3);
    $c->add(MmPeer::SERIAL_ID, $this->serial->getId());
    $c->addJoin(MmPeer::ID, GroundMmPeer::MM_ID);
    $c->addJoin(GroundPeer::ID, GroundMmPeer::GROUND_ID);
    $c->addAscendingOrderByColumn(GroundPeer::COD);
    //FALTA
    $this->grounds_sel = GroundPeer::doSelectWithI18n($c, $this->getUser()->getCulture());
 
    $c = new Criteria();
    $c->add(GroundPeer::GROUND_TYPE_ID, 3);
    $c->addAscendingOrderByColumn(GroundPeer::COD);
    $this->grounds = GroundPeer::doSelectWithI18n($c, $this->getUser()->getCulture());
  }
}
