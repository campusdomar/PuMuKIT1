<?php

/**
 * Subclass for representing a row from the 'streamserver' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Streamserver extends BaseStreamserver
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
