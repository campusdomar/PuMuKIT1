<?php

/**
 * Precinct (class)
 *
 * Clase que representa una entrada en la
 * tabla 'precinct'.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Precinct extends BasePrecinct
{

  /**
   * Devuelve una lista de series que pertenecen a este recinto.
   * Estas series estan inicializadas a la cultura del recinto
   *
   * @access public
   * @param integer limit numero de series por defecto todas
   * @return ResulSet of Serial 
   */
  public function getSerials($limit = 0)
  {
    $c = new Criteria();
    $c->addJoin(SerialPeer::ID, MmPeer::SERIAL_ID);
    $c->addJoin(MmPeer::PRECINCT_ID, PrecinctPeer::ID);
    $c->add(PrecinctPeer::ID, $this->getId());
    $c->setDistinct(true);
    if ($limit) $c->setLimit($limit);

    return SerialPeer::doSelectWithI18n($c, $this->getCulture());
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
   * Devuleve una cadena formada por el nombre del recinto, una coma,
   * el nobre del lugar y la direcion de este .Si alguno es nulo no
   * se inserta su coma. 
   *
   * @access public
   * @return string 
   */
  public function getCompleteName()
  {
    $address = ($this->getPlace()->getAddress() == '')?'':' - '.$this->getPlace()->getAddress();
    $pr = ($this->getName() == '')?'':$this->getName().', ';
    return $pr.$this->getPlace()->getName().$address;
  }  


  /**
   * Devuleve una cadena formada por el nombre del recinto, una coma
   * y el nombre del lugar. Si el nombre del recinto es nulo, no se 
   * inserta la coma. 
   *
   * @access public
   * @return string 
   */
  public function getAllName()
  {
    $pr = ($this->getName() == '')?'':$this->getName().', ';
    return $pr.$this->getPlace()->getName();
  }  

}

/** implementa comportamiento default_select*/
sfPropelBehavior::add('Precinct', array('default_select') );