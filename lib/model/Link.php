<?php

/**
 * Link (class)
 *
 * Clase que representa una entrada en la
 * tabla 'link'.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Link extends BaseLink
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

/** Implementa comportamiento sortableFk segun mm_id */
sfPropelBehavior::add('Link', array('sortableFk' => array('f_key' => 'mm_id')));
