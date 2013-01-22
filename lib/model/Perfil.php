<?php

/**
 * Subclass for representing a row from the 'perfil' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Perfil extends BasePerfil
{

  /*
   * TEMPORAL
   */
  public function getDirOut(){
    return $this->getStreamserver()->getDirOut();
  }

  /*
   * TEMPORAL
   */
  public function getUrlOut(){
    return $this->getStreamserver()->getUrlOut();
  }

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

  /**
   * Devuelve la cadena MASTER o VOD en funcion del tipo
   *
   * @access public
   * @return string representacion textual del tipo objeto.
   */
  public function getTypeString(){
    if(stripos($this->getName(), "master") === false){
      return 'VOD';
    }else{
      return 'MASTER';
    }
  }
}

/** Implementa comportamiento sortable */
sfPropelBehavior::add('Perfil', array('sortable') );
