<?php

/**
 * mmobj actions.
 *
 * @package    pumukit
 * @subpackage video
 * @author     Ruben Glez <rubenrua at uvigo.es>
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

            $this->m = $this->file->getMmWithI18n();
        }else{
            $this->m = MmPeer::retrieveByPKWithI18n($this->getRequestParameter('id'));
            $this->forward404Unless($this->m);
      
            $this->file = $this->m->getFirstPublicFile();
            if ($this->file) $this->file->setMm($this->m); //To update cache.
        }
        $this->forward404If(!$this->checkPublicationState($this->file, $this->m));
        
        $this->getUser()->panNivelCuatro($this->m);

        $this->roles = RolePeer::doSelectWithI18n(new Criteria(), $this->getUser()->getCulture());
        
        //vemos perfil de distribucion 
        if ($this->m->getBroadcast()->getBroadcastTypeId() != 1){//Si el lugar al que accedemos no es publico
          if (sfConfig::get('app_cas_use',0) == 1){//Si usamos autenticacion CAS
        phpCAS::forceAuthentication();
        if (!in_array(phpCAS::getUser(), array($this->m->getBroadcast()->getName(), "tv", "prueba", "admin"))){
          $this->forward('mmobj', 'noaccess');
        }
          }
          elseif (!isset($_SERVER['PHP_AUTH_USER']) or ($this->m->getBroadcast()->getPasswd() != $_SERVER['PHP_AUTH_PW'])){
        $this->passwd();    
          }
    }
      
    //phpCAS::forceAuthentication();
    //if(!in_array(phpCAS::getUser(), array($this->m->getBroadcast()->getName(), "tv", "prueba", "admin"))){ 
    //    $this->forward('mmobj', 'noaccess');
    //}


//prueba Matterhorn
  $this->oc = MmMatterhornPeer::retrieveByPK($this->m->getId());
    if($this->oc){
      //MATTERHORN REDIRECT.
      $this->getResponse()->addStylesheet('tv/matterhorn.css');
      $this->setTemplate('matterhorn');
      $this->setLayout('mhlayout');
      $this->oc->incNumView();
    }else{
      $this->file->incNumView();
    }

    $this->other_mms = PubChannelPeer::getMmsFromSerial(1, $this->m->getSerialId());
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

  public function executeIframe()
  {

    $this->setLayout(false);

    $this->m = MmPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->m);
    $this->forward404Unless($this->m->hasPubChannelId(1));

    $this->file = $this->m->getFirstPublicFile();

    //vemos perfil de distribucion
    if ($this->m->getBroadcast()->getBroadcastTypeId() != 1){//Si el lugar al que accedemos no es publico
        if (sfConfig::get('app_cas_use',0) == 1){//Si usamos autenticacion CAS
          phpCAS::forceAuthentication();
          if(!in_array(phpCAS::getUser(), array($this->m->getBroadcast()->getName(), "tv", "prueba", "admin"))){
            $this->forward('mmobj', 'noaccess');
          }
        }
      elseif (!isset($_SERVER['PHP_AUTH_USER'])){
        $this->passwd();
      }
    } elseif ($this->m->getBroadcast()->getPasswd() != $_SERVER['PHP_AUTH_PW']) {
      $this->passwd();
    }


    $this->file->incNumView();
    // logs this video in the views.log file
    $request = $this->getRequest();
    ViewsLog::logThisView($request);

    //Actulizar log
    LogFilePeer::act( $this->file->getId(), $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], $this->getRequest()->getUri() );


  }
    
    protected function passwd()
    {

        $this->getResponse()->setHttpHeader('WWW-Authenticate', 'Basic realm="'.sfConfig::get('app_info_title', 'Uvigotv').'"');
        $this->getResponse()->setStatusCode(401);

        $this->setLayout(false);
        $this->setTemplate('passwd');
    }

    private function checkPublicationState($file, $m)
    {
      // CHECK STATUS
      $status = array(MmPeer::STATUS_NORMAL, MmPeer::STATUS_HIDE);
      if (!$file) return false;
      if (!$m) return false;
      if ($file->isMaster()) return false;
      if($this->getUser()->isAuthenticated() && $this->getUser()->hasCredential('admin')) {
    $status[] = MmPeer::STATUS_BLOQ;
      } else {
    if (!$m->hasPubChannelId(1)) return false;
    if (!$file->getDisplay()) return false;
      }
      if (!in_array($m->getStatusId(), $status)) return false;
      return true;
    }
}
