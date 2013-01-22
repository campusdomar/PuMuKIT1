<?php

/**
 * prueba actions.
 *
 * @package    pumukituvigo
 * @subpackage prueba
 * @author     Ruben Glez <rubenrua at uvigo.es>
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class pruebaActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
  }

  /**
   * Executes grounds actions
   *
   */
  public function executeGroundsitunesu()
  {
    $this->sts = SerialTypePeer::doSelect(new Criteria());
  }

  public function executeAddground(){
    $serial_id = $this->getRequestParameter('id', 0);  //OJO SI NO EXISTEN
    $ground_id = $this->getRequestParameter('ground', 0);  //OJO SI NO EXISTEN
    $this->serial = SerialPeer::retrieveByPk($serial_id); 

    $mms = $this->serial->getMms();
    foreach($mms as $mm){
      $mm->setGroundId($ground_id);
    }

    return $this->renderComponent('prueba', 'ground');    
  }

  public function executeDeleteground(){
    $serial_id = $this->getRequestParameter('id', 0);  //OJO SI NO EXISTEN
    $ground_id = $this->getRequestParameter('ground', 0);  //OJO SI NO EXISTEN
    $this->serial = SerialPeer::retrieveByPk($serial_id); 
    

    $mms = $this->serial->getMms();
    foreach($mms as $mm){
      $gv = GroundMmPeer::retrieveByPK($ground_id, $mm->getId());
      if (isset($gv)) $gv->delete();
    }

    return $this->renderComponent('prueba', 'ground');    
  }

}
