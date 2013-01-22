<?php

/**
 * directo actions.
 *
 * @package    fin
 * @subpackage directo
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class directoActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {

    $this->setLayout('onelayout');

    $canal_id = $this->getRequestParameter('canal', 1);

    //if($canal_id == 1){
    //  $this->getResponse()->addStyleSheet('tv/pontenasondas');
    //}

    $this->canal = DirectPeer::retrieveByPk($canal_id);
    $this->forward404Unless($this->canal);


    $this->getUser()->panNivelDos($this->canal->getName(), 'directo/index?canal=' . $this->canal->getId());


    if(($this->canal->getPasswd() != "")&&($this->canal->getPasswd() != $this->getRequestParameter('passwd', ''))){
      if($this->hasRequestParameter('passwd')){
	return  "Passwderror";
      }else{
	return "Passwd";
      }
    }
  }

  public function executeXml()
  {

    $this->setLayout(false);
    $this->getResponse()->setContentType('application/rss+xml; charset=utf-8');

    $canal_id = $this->getRequestParameter('canal', 1);

    $this->canal = DirectPeer::retrieveByPk($canal_id);
    $this->forward404Unless($this->canal);

    if($this->canal->getBroadcasting()){
      return "Broadcasting";
    }else{
      return "Waiting";
    }
  }
}
