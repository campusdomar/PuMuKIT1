<?php

/**
 * Subclass for representing a row from the 'template' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Template extends BaseTemplate
{
  
  /**
   *
   *
   *
   */
  public function __toString()
  {
    return $this->getName();
  }

  /**
   *
   *
   *
   */
  public function getTypeName()
  {
   
    switch ($this->getType()) {
    case 1:
      echo TemplatePeer::TEXT_CSS;
      break;
    case 2:
      echo TemplatePeer::TEXT_PAGE;
      break;
    case 3:
      echo TemplatePeer::TEXT_WIDGET;
      break;
    case 4:
      echo TemplatePeer::TEXT_MAIL;
      break;
    }


  }
}
