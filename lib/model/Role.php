<?php

/**
 * Role (class)
 *
 * Clase que representa una entrada en la
 * tabla 'role'.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Role extends BaseRole
{
  /**
   * Devuelve la representacion textual de la columna.
   *
   * @access public
   * @return string representacion textual del objeto.
   */
  public function __toString()
  {
    $this->setCulture( 'es' );
    return $this->getName();
  }
}


/** Implementa comportamiento sortable */
sfPropelBehavior::add('Role', array('sortable') );
