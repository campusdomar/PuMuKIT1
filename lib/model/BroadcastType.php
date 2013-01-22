<?php

/**
 * BroadcastType (class)
 *
 * Representa una fila de la tabla 'bloadcast_type' de la 
 * base de datos
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class BroadcastType extends BaseBroadcastType
{


  /**
   * Devuelve la representacion textual de la columna.
   *
   * @access public
   * @return string representacion textual del objeto.
   */
  public function __toString()
  {
    return $this->getName();
  }
}

/** Implementa comportamiento default_select */
sfPropelBehavior::add('BroadcastType', array('default_select') );
