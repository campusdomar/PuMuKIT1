<?php

/**
 * Direct (class)
 *
 * Clase que representa una entrada en la
 * tabla 'direct'.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Direct extends BaseDirect
{


  /**
   * Devuelve la representacion textual de la columna.
   *
   * @access public
   * @return string representacion textual del objeto.
   */
  public function __toString()
  {
    return $this->getName() . " (" . $this->getUrl() . ")";
  }

 /**
   *
   *
   */
  public function getEventFuture(){
    $c = new Criteria();
    $c->add(EventPeer::DIRECT_ID, $this->getId());
    $c->add(EventPeer::DATE, date('Y-m-d'), Criteria::GREATER_EQUAL);
    $c->add(EventPeer::DISPLAY, true);
    $c->addAscendingOrderByColumn(EventPeer::DATE);

    return EventPeer::doSelectOne($c);
  }


}

