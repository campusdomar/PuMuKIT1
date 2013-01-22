<?php

/**
 * Subclass for representing a row from the 'pic_serial' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class PicSerial extends BasePicSerial
{

  public function getId()
  {   
    return $this->pic_id;
  }
}


sfPropelBehavior::add('PicSerial', array(
				  'sortableFk' => array('f_key' => 'other_id'),
				  ) );
