<?php

/**
 * serial actions.
 *
 * @package    fin
 * @subpackage serial
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class serialActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $status = array(MmPeer::STATUS_NORMAL);

    if($this->hasRequestParameter('hash')){
      $hash = SerialHashPeer::retrieveByHash($this->getRequestParameter('hash'));
      $this->forward404Unless($hash);

      $this->serial = $hash->getSerial();
      $status[] = MmPeer::STATUS_HIDE;

      if(($this->getRequestParameter('preview')  == 'true')
	 && $this->getUser()->isAuthenticated() 
	 && $this->getUser()->hasCredential('admin')) {
	 $status[] = MmPeer::STATUS_BLOQ;
      }

      $this->forward404If(PubChannelPeer::countMmsFromSerialByStatus(1, $this->serial->getId(), $status) == 0);
    } else {
      $this->serial = SerialPeer::retrieveByPK($this->getRequestParameter('id'));
      $this->forward404Unless($this->serial);
      $this->forward404If(PubChannelPeer::countMmsFromSerial(1, $this->serial->getId()) == 0);
    }

    $this->getUser()->panNivelTres($this->serial);

    $this->mms = PubChannelPeer::getMmsFromSerialByStatus(1, $this->serial->getId(), $status);
    $this->roles = RolePeer::doSelectWithI18n(new Criteria(), $this->getUser()->getCulture());

    //
    // Metadatos tecnicos
    //
    $this->getResponse()->setTitle($this->serial->getTitle()); 
    $this->getResponse()->addMeta('keywords', $this->serial->getKeyword()); 
  }
}
