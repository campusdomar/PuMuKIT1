<?php

/**
 * Subclass for representing a row from the 'pic_mm' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class PicMm extends BasePicMm
{
  public function getId()
  {   
    return $this->pic_id;
  }
}

sfPropelBehavior::add('PicMm', array(
				  'sortableFk' => array('f_key' => 'other_id'),
				  ) );

