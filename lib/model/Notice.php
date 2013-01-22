<?php

/**
 * Notice (class)
 *
 * Clase que representa una entrada en la
 * tabla 'notice'.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Notice extends BaseNotice
{

  /**
   * Devuelve la representacion textual de la columna.
   *
   *
   */
  public function __toString()
  {
    return $this->getText();
  }
}
