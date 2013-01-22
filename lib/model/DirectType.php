<?php

/**
 * Subclass for representing a row from the 'direct_type' table.
 *
 * 
 *
 * @package lib.model
 */ 
class DirectType extends BaseDirectType
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
