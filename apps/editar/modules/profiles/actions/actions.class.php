<?php
/**
 * MODULO PROFILE ACTIONS. 
 * Modulo de administracion de las generos que estan asociadas a algun
 * objeto multimedia del catalogo. 
 *
 * @package    pumukit
 * @subpackage profile
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class profilesActions extends sfActions
{
  /**
   * --  INDEX -- /editar.php/profiles
   *
   * Accion por defecto en la aplicacion. Acceso publico. Layout: layout
   *
   */
  public function executeIndex()
  {
    sfConfig::set('transcoder_menu','active');

    if(!$this->getUser()->hasAttribute('page', 'tv_admin/profile'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/profile');
  }


  /**
   * --  LIST -- /editar.php/profiles/list
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeList()
  {
    return $this->renderComponent('profiles', 'list');
  }


  /**
   * --  CREATE -- /editar.php/profiles/create
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeCreate()
  {
    $this->langs = sfConfig::get('app_lang_array', array('es'));
    $this->profile = new Perfil();

    //$this->profile->setCulture($this->getUser()->getCulture()); //No hace falta con hydrate

    $this->setTemplate('edit');
  }


  /**
   * --  EDIT -- /editar.php/profiles/edit/id/?
   *
   * Accion asincrona. Acceso privado. Parametros id por URL, 
   *
   */
  public function executeEdit()
  {
    $this->langs = sfConfig::get('app_lang_array', array('es'));
    $this->profile = PerfilPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->profile);

  }

  /**
   * --  UPDATE -- /editar.php/profiles/update
   *
   * Accion asincrona. Acceso privado. Parametros por POST resultado de formulario de edicion
   *
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $profile = new Perfil();
    }
    else
    {
      $profile = PerfilPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($profile);
    }
    
    $profile->setName($this->getRequestParameter('name', ' '));
    $profile->setDisplay($this->getRequestParameter('display', ' '));
    $profile->setWizard($this->getRequestParameter('wizard', ' '));
    $profile->setMaster($this->getRequestParameter('master', ' '));
    $profile->setFormat($this->getRequestParameter('format', ' '));
    $profile->setCodec($this->getRequestParameter('codec', ' '));
    $profile->setMimeType($this->getRequestParameter('mimetype', ' '));
    $profile->setExtension($this->getRequestParameter('extension', ' '));
    $profile->setResolutionHor($this->getRequestParameter('resolutionhor', ' '));
    $profile->setResolutionVer($this->getRequestParameter('resolutionver', ' '));
    $profile->setBitrate($this->getRequestParameter('bitrate', ' '));
    $profile->setFramerate($this->getRequestParameter('framerate', ' '));
    $profile->setChannels($this->getRequestParameter('channels', ' '));
    $profile->setAudio($this->getRequestParameter('audio', ' '));
    $profile->setBat($this->getRequestParameter('bat', ' '));
    $profile->setFileCfg($this->getRequestParameter('filecfg', ' '));
    $profile->setStreamserverId($this->getRequestParameter('streamserver_id', 1));
    $profile->setApp($this->getRequestParameter('app', ' '));
    $profile->setRelDurationSize($this->getRequestParameter('rel_duration_size', 1));
    $profile->setRelDurationTrans($this->getRequestParameter('rel_duration_trans', 1));
    $profile->setPrescript(trim($this->getRequestParameter('prescript', '')));
    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $profile->setCulture($lang);
      $profile->setLink($this->getRequestParameter('link_' . $lang, ' '));
      $profile->setDescription($this->getRequestParameter('description_' . $lang, ' '));
    }
    
    $profile->save();
    $this->msg_alert = array('info', "Metadatos del perfil actualizados.");

    $this->getUser()->setAttribute('id', $profile->getId(), 'tv_admin/profile');

    return $this->renderComponent('profiles', 'list');
  }


  /**
   * --  DELETE -- /editar.php/profiles/delete
   *
   * Accion asincrona. Acceso privado. Parametros id por URL o ids JSON por POST.
   *
   */
  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $profiles = PerfilPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($profiles as $profile){
	if ($profile->countFiles() == 0)
          $profile->delete();
      }

    }elseif($this->hasRequestParameter('id')){
      $profile = PerfilPeer::retrieveByPk($this->getRequestParameter('id'));
      if ($profile->countFiles() == 0)
        $profile->delete();
    }
    $this->msg_alert = array('info', "Perfil borrado.");
    return $this->renderComponent('profiles', 'list');
  }


  /**
   * --  COPY -- /editar.php/profiles/copy
   *
   * Accion asincrona. Acceso privado. Parametros por URL identificador de la difusion a copiar
   *
   */
  public function executeCopy()
  {
    $profile = PerfilPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($profile);

    $profile2 = $profile->copy();
    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $profile2->setCulture($lang);
      $profile->setCulture($lang);
      $profile2->setLink($profile->getLink());
      $profile2->setDescription($profile->getDescription());
    }
            
    $profile2->save();
    $this->msg_alert = array('info', "Perfil clonado.");

    return $this->renderComponent('profiles', 'list');
  }


  /**
   * --  PREVIEW -- /editar.php/profiles/preview
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */
  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/profile');
    }

    return $this->renderComponent('profiles', 'preview');
  }


  /**
   * --  UP -- /editar.php/profiles/ip
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */
  public function executeUp()
  {
    $profile = PerfilPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($profile);

    $profile->moveUp();
    $profile->save();

    return $this->renderComponent('profiles', 'list');
  }

  /**
   * --  DOWN -- /editar.php/profiles/down
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */
  public function executeDown()
  {
    $profile = PerfilPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($profile);

    $profile->moveDown();
    $profile->save();

    return $this->renderComponent('profiles', 'list');
  }


  /**
   * --  TOP -- /editar.php/profiles/top
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */
  public function executeTop()
  {
    $profile = PerfilPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($profile);

    $profile->moveToTop();
    $profile->save();

    return $this->renderComponent('profiles', 'list');
  }


  /**
   * --  BUTTON -- /editar.php/profiles/button
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */
  public function executeBottom()
  {
    $profile = PerfilPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($profile);

    $profile->moveToBottom();
    $profile->save();

    return $this->renderComponent('profiles', 'list');
  }
}
