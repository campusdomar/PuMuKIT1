<?php

/**
 * Subclass for representing a row from the 'streamserver_type' table.
 *
 * 
 *
 * @package lib.model
 */ 
class StreamserverType extends BaseStreamserverType
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
