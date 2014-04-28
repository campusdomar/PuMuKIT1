<?php
/**
 * MODULO DIRECT ACTIONS. 
 * Modulo de administracion de las canales en directo que esisten.
 *
 * @package    pumukit
 * @subpackage direct
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class directsActions extends sfActions
{

  /**
   * --  INDEX -- /editar.php/directs
   *
   * Accion por defecto en la aplicacion. Acceso publico. Layout: layout
   *
   */
  public function executeIndex()
  {
    sfConfig::set('tv_menu','active');
    if (!$this->getUser()->hasAttribute('page', 'tv_admin/direct'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/direct');
  }



  /**
   * --  LIST -- /editar.php/directs/list
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeList()
  {
    return $this->renderComponent('directs', 'list');
  }

  /**
   * --  PREVIEW -- /editar.php/directs/preview
   *
   * Accion asincrona. Acceso privado. Paremetros id de la difusion
   *
   */
  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/direct');
    }
    return $this->renderComponent('directs', 'preview');
  }


  /**
   * --  CREATE -- /editar.php/directs/create
   *
   * Accion asincrona. Acceso privado.
   *
   */
  public function executeCreate()
  {
    $this->direct = new Direct();

    $this->direct->setResolutionId(1);  //poner el que sea por defecto
    $this->direct->setDirectTypeId(1);    //poner el que sea por defecto

    $this->langs = sfConfig::get('app_lang_array', array('es'));

    $this->setTemplate('edit');
  }


  /**
   * --  EDIT -- /editar.php/directs/edit/id/?
   *
   * Accion asincrona. Acceso privado. Parametros id por URL
   *
   */
  public function executeEdit()
  {
    $this->setLayout(false); 
    $this->direct = DirectPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->direct);

    $this->multi = explode("_",$this->direct->getCalidades());
    $this->langs = sfConfig::get('app_lang_array', array('es')); 
  }



  /**
   * --  UPDATE -- /editar.php/directs/update
   *
   * Accion asincrona. Acceso privado. Parametros por POST resultado de formulario de edicion
   *
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $direct = new Direct();
    }
    else
    {
      $direct = DirectPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($direct);
    }

    $direct->setUrl($this->getRequestParameter('url', ' '));
    $direct->setResolutionId($this->getRequestParameter('resolution_id', ' '));
    $direct->setDirectTypeId($this->getRequestParameter('direct_type_id', 'falsh'));
    $direct->setPasswd($this->getRequestParameter('passwd', ''));
    $direct->setSourceName($this->getRequestParameter('source_name', ' '));
    $direct->setIpSource($this->getRequestParameter('ip_source', ' '));
    $direct->setBroadcasting($this->getRequestParameter('broadcasting', 0));
    $direct->setDebug($this->hasRequestParameter('debug'));
    $direct->setIndexPlay($this->hasRequestParameter('homeplayer'));


    $calidades = $this->getRequestParameter('calidad');
    
    $ress = ResolutionPeer::retrieveByPK($this->getRequestParameter('resolution_id', ' '));
    
    //Fixed. This asigns a resolution to direct
    if ($ress != null){
      $direct->setResolutionHor($ress->getHor());
      $direct->setResolutionVer($ress->getVer());
    }
    
    $direct->setCalidades(implode("_",array_merge($calidades,$ress)));


    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $direct->setCulture($lang);
      $direct->setName($this->getRequestParameter('name_'. $lang, ' '));
      $direct->setDescription($this->getRequestParameter('description_'. $lang, ' '));
    }

    $direct->save();
    $this->msg_alert = array('info', $this->getContext()->getI18N()->__("Metadatos del canal en directo actualizados."));
    $this->getUser()->setAttribute('id', $direct->getId(), 'tv_admin/direct');

    return $this->renderComponent('directs', 'list');
  }


  /**
   * --  DELETE -- /editar.php/directs/delete
   *
   * Accion asincrona. Acceso privado. Parametros id por URL o ids JSON por POST.
   *
   */
  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $directs = DirectPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($directs as $direct){
	$direct->delete();
      }

    }elseif($this->hasRequestParameter('id')){
      $direct = DirectPeer::retrieveByPk($this->getRequestParameter('id'));
      $direct->delete();
    }
    $this->msg_alert = array('info', $this->getContext()->getI18N()->__("Canal en directo borrado."));
    return $this->renderComponent('directs', 'list');
  }


  /**
   * --  COPY -- /editar.php/directs/copy
   *
   * Accion asincrona. Acceso privado. Parametros por URL identificador de la difusion a copiar
   *
   */
  public function executeCopy()
  {
    $direct = DirectPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($direct);

    $direct2 = $direct->copy();
    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $direct->setCulture($lang);
      $direct2->setCulture($lang);
      $direct2->setName($direct->getName());
      $direct2->setDescription($direct->getDescription());
    }
    $this->msg_alert = array('info', $this->getContext()->getI18N()->__("Canal en directo clonado."));
    $direct2->save();

    return $this->renderComponent('directs', 'list');
  }
}
