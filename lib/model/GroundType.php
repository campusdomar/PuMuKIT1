<?php

/**
 * Subclass for representing a row from the 'ground_type' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class GroundType extends BaseGroundType
{
  public function __toString()
  {
    return $this->getName();
  }
}


sfPropelBehavior::add('GroundType', array('sortable'));