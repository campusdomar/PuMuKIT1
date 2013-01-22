<?php

/**
 * Language (class)
 *
 * Representa una fila de la tabla 'language' de la 
 * base de datos
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Language extends BaseLanguage
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

/** Implementa comportamiento default_select*/
sfPropelBehavior::add('Language', array('default_select') );
