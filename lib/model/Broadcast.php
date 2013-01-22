<?php

/**
 * Broadcast (class)
 *
 * Representa una fila de la tabla 'bloadcast' de la 
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
class Broadcast extends BaseBroadcast
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
sfPropelBehavior::add('Broadcast', array('default_select') );
