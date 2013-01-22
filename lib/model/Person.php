<?php

/**
 * Person (class)
 *
 * Clase que representa una entrada en la
 * tabla 'person'.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Person extends BasePerson
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
    $c->addJoin(MmPersonPeer::MM_ID, MmPeer::ID);
    $c->add(MmPersonPeer::PERSON_ID, $this->getId());
    $c->setDistinct(true);
    if ($limit) $c->setLimit($limit);

    return SerialPeer::doSelectWithI18n($c, $this->getCulture());
  }


  /**
   * Devuelve el nombre de la persona con sus honores
   *
   * @return string 
   */
  public function getHName()
  {
    return $this->getHonorific().' '.$this->getName();
  }

  /**
   * Devuelve el una cadena con los cargos de la persona
   *
   * @return string
   */
  public function getOther()
  {
    return $this->getPost().' '.$this->getFirm().' '.$this->getBio();
  }

  /**
   * Devuelve un string con la infomacion de la persona.
   * Este string se compone de Firm, Pos y Bio separadas por comas
   *
   *
   * @access public
   * @return String info
   */
  public function getInfo()
  {
    $aux = array($this->getPost(), $this->getFirm(), $this->getBio());
    $aux = array_filter($aux, create_function('$a', 'return (!is_null($a)&&(""!=$a));'));
    return implode(', ', $aux);
  } 
}
