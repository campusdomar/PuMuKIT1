<?php

/**
 * Format (class)
 *
 * Clase que representa una entrada en la
 * tabla 'format'.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Format extends BaseFormat
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
sfPropelBehavior::add('Format', array('default_select') );