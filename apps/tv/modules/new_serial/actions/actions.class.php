<?php
/**
 * new_serial actions.
 *
 * @package    pumukituvigo
 * @subpackage new_serial
 * @author     Ruben Glez <rubenrua at uvigo.es>
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class new_serialActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->serial = SerialPeer::retrieveByPKWithI18n($this->getRequestParameter('id'), $this->getUser()->getCulture());
    $this->forward404Unless($this->serial);
    $this->forward404If($this->serial->isWorking());

    //
    // Si es privado y no tiene credenciales error 404
    //
    $this->forward404If(($this->serial->getBroadcastMax()->getBroadcastTypeId() == 3) && (!$this->getUser()->hasCredential('pri')));

    
    $this->mms = $this->serial->getMmsPublic(true); //Se muestran los mm ocultos ya que conoce la url.
    $this->roles = RolePeer::doSelectWithI18n(new Criteria(), $this->getUser()->getCulture());

    //
    // Metadatos tecnicos
    //
    $this->getResponse()->setTitle($this->serial->getTitle()); 
    $this->getResponse()->addMeta('keywords', $this->serial->getKeyword());     
  }


  public function executeInfobar()
  {
    $this->mm = MmPeer::retrieveByPKWithI18n($this->getRequestParameter('id'), $this->getUser()->getCulture());
    $this->forward404Unless($this->mm);
    //$this->forward404If($this->mm->getStatusId());

    return $this->renderPartial('new_serial/info_video_bar', array('mm' => $this->mm));
  }

  public function executeInfo()
  {
    $this->mm = MmPeer::retrieveByPKWithI18n($this->getRequestParameter('id'), $this->getUser()->getCulture());
    $this->forward404Unless($this->mm);
    //$this->forward404If($this->mm->getStatusId());

    $this->roles = RolePeer::doSelectWithI18n(new Criteria(), $this->getUser()->getCulture());

    return $this->renderPartial('new_serial/video', array('mm' => $this->mm, 'roles' => $this->roles));
  }
}
