<?php

/**
 * SerialType (class)
 *
 * Clase que representa una entrada en la
 * tabla 'serial_type'.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */
class SerialType extends BaseSerialType
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

/** Implemeta comportamiento default_select */
sfPropelBehavior::add('SerialType', array('default_select') );
