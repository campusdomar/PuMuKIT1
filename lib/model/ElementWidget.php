<?php

/**
 * Subclass for representing a row from the 'element_widget' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class ElementWidget extends BaseElementWidget
{

  public function getId()
  {   
    return $this->widget_id;
  }
}


sfPropelBehavior::add('ElementWidget', array(
				  'sortableFk' => array('f_key' => 'bar_widget_id'),
				  ) );
