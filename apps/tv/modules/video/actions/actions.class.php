<?php

/**
 * video actions.
 *
 * @package    fin
 * @subpackage video
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class videoActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {

    if($this->hasRequestParameter('file_id')){
      $this->file = FilePeer::retrieveByPK($this->getRequestParameter('file_id'));
      $this->forward404Unless($this->file);
      //FIXME Comprobar que file es perfil de PubChannel 1

      $this->mm = $this->file->getMm();
    }else{
      $this->mm = MmPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($this->mm);
      $this->forward404Unless($this->mm->hasPubChannelId(1));
      
      $this->file = $this->mm->getFirstFile();
    }

    $this->forward404Unless($this->mm->hasPubChannelId(1));

    $this->getUser()->panNivelCuatro($this->mm);

    
    //vemos perfil de distribucion 
    if ($this->mm->getBroadcast()->getBroadcastTypeId() != 1){//Si el lugar al que accedemos no es publico
      if (sfConfig::get('app_cas_use',0) == 1){//Si usamos autenticacion CAS
	phpCAS::forceAuthentication();
	if (!in_array(phpCAS::getUser(), array($this->mm->getBroadcast()->getName(), "tv", "prueba", "admin"))){
	  $this->forward('mmobj', 'noaccess');
	}
      }
      elseif (!isset($_SERVER['PHP_AUTH_USER']) or ($this->mm->getBroadcast()->getPasswd() != $_SERVER['PHP_AUTH_PW'])){
	$this->passwd();	
      }
    }
      
    //phpCAS::forceAuthentication();
    //if(!in_array(phpCAS::getUser(), array($this->m->getBroadcast()->getName(), "tv", "prueba", "admin"))){ 
    //	  $this->forward('mmobj', 'noaccess');
    //}


//prueba Matterhorn
  $this->oc = MmMatterhornPeer::retrieveByPK($this->mm->getId());
    if($this->oc){
      //MATTERHORN REDIRECT.
      $this->getResponse()->addStylesheet('tv/matterhorn.css');
      $this->setTemplate('matterhorn');
      $this->setLayout('mhlayout');
      $this->oc->incNumView();
    }else{
      $this->file->incNumView();
    }

    $this->other_mms = PubChannelPeer::getMmsFromSerial(1, $this->mm->getSerialId());
    //$this->file->incNumView();
    // incnumview no funciona en matterhorn

    // logs this video in the views.log file
    $request = $this->getRequest();
    ViewsLog::logThisView($request);

    $c_r = new Criteria();
    $c_r->add(RolePeer::DISPLAY, true);
    $this->roles = RolePeer::doSelect($c_r);
    
    $this->setLayout('onelayout');
  }




  protected function passwd()
  {

    $this->getResponse()->setHttpHeader('WWW-Authenticate', 'Basic realm="'.sfConfig::get('app_info_title', 'Uvigotv').'"');
    $this->getResponse()->setStatusCode(401);

    $this->setLayout(false);
    $this->setTemplate('passwd');
  }


  public function executeIframe()
  {

    $this->setLayout(false);

    $this->mm = MmPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->mm);
    $this->forward404Unless($this->mm->hasPubChannelId(1));

    $this->file = $this->mm->getFirstFile();

    //vemos perfil de distribucion
    if ($this->mm->getBroadcast()->getBroadcastTypeId() != 1){//Si el lugar al que accedemos no es publico
    	if (sfConfig::get('app_cas_use',0) == 1){//Si usamos autenticacion CAS
    	  phpCAS::forceAuthentication();
    	  if(!in_array(phpCAS::getUser(), array($this->mm->getBroadcast()->getName(), "tv", "prueba", "admin"))){
    	    $this->forward('mmobj', 'noaccess');
    	  }
    	}
      elseif (!isset($_SERVER['PHP_AUTH_USER'])){
        $this->passwd();
      }
    } elseif ($this->mm->getBroadcast()->getPasswd() != $_SERVER['PHP_AUTH_PW']) {
      $this->passwd();
    }


    $this->file->incNumView();
    // logs this video in the views.log file
    $request = $this->getRequest();
    ViewsLog::logThisView($request);

    //Actulizar log
    LogFilePeer::act( $this->file->getId(), $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], $this->getRequest()->getUri() );


  }
}
