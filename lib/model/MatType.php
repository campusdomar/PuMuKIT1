<?php

/**
 * MatType (class)
 *
 * Clase que representa una entrada en la
 * tabla 'mat_type'.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class MatType extends BaseMatType
{
  /**
   * Devuelve la representacion textual de la columna.
   *
   * @access public
   * @return string representacion textual del objeto.
   */
  public function __toString()
  {
    return $this->getType().' - '.$this->getName();
  }
}

/** Implementa comportamiento default_select */
sfPropelBehavior::add('MatType', array('default_select') );
