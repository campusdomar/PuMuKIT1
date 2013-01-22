<?php

/**
 * Resolution (class)
 *
 * Clase que representa una entrada en la
 * tabla 'resolution'.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Resolution extends BaseResolution
{
  /**
   * Devuelve la representacion textual de la columna.
   *
   * @access public
   * @return string representacion textual del objeto.
   */
  public function __toString()
  {
    return ($this->getHor() .'x'. $this->getVer());
  }
}

/** Implementa comportamiento default_select */
sfPropelBehavior::add('Resolution', array('default_select') );
