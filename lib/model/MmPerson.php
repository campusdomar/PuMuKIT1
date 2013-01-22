<?php

/**
 * Subclass for representing a row from the 'mm_person' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class MmPerson extends BaseMmPerson
{

  public function getId()
  {   
    return $this->person_id;
  }
}

sfPropelBehavior::add('MmPerson', array(
				  'sortableFk2' => array('f_key' => 'mm_id', 'f_key2' => 'role_id'),
				  ) );
