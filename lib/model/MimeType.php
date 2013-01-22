<?php

/**
 * MimeType (class)
 *
 * Representa una fila de la tabla 'mime_type' de la 
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
class MimeType extends BaseMimeType
{
  /**
   * Devuelve la representacion textual de la columna.
   *
   * @access public
   * @return string representacion textual del objeto.
   */
  public function __toString()
  {
    return ($this->getName() .' ('. $this->getType().')');
  }
}


/** Implementa comportamiento default_select */
sfPropelBehavior::add('MimeType', array('default_select') );
