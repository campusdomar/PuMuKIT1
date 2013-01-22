<?php

/**
 * Codec (class)
 *
 * Clase que representa una entrada en la
 * tabla 'codec'.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Codec extends BaseCodec
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
sfPropelBehavior::add('Codec', array('default_select') );