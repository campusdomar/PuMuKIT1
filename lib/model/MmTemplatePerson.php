<?php

/**
 * Subclass for representing a row from the 'mm_template_person' table.
 *
 * 
 *
 * @package lib.model
 */ 
class MmTemplatePerson extends BaseMmTemplatePerson
{
  public function getId()
  {   
    return $this->person_id;
  }
}

sfPropelBehavior::add('MmTemplatePerson', array(
				  'sortableFk2' => array('f_key' => 'mm_template_id', 'f_key2' => 'role_id'),
				  ) );
