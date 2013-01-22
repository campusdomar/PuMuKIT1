<?php

/**
 * Genre (class)
 *
 * Clase que representa una entrada en la
 * tabla 'genre'.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Genre extends BaseGenre
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
sfPropelBehavior::add('Genre', array('default_select'));
