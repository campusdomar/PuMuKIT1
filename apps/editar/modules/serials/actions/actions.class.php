<?php
/**
 * MODULO SERIALS ACTIONS. 
 * Modulo de administracion de las series de objetos multimedia. Permite 
 * modificar los metadatos de las series(tectinicos, de estilo y pics), y 
 * da acceso el modulo de administracion de objtos multimedia de casa serie. 
 *
 * @package    pumukit
 * @subpackage serials
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class serialsActions extends sfActions
{

  /**
   * --  INDEX -- /editar.php/serials
   * Muestra el modulo de administracion de las series, con la vista previa, formulario
   * de filtrado, listado de usuarios y formulario de edicion...
   *
   * Accion por defecto del modulo. Layout: layout
   *
   */
  public function executeIndex()
  {
    sfConfig::set('serial_menu','active');

    $this->getUser()->setAttribute('sort', 'publicDate', 'tv_admin/serial');
    $this->getUser()->setAttribute('type', 'desc', 'tv_admin/serial');
    if (!$this->getUser()->hasAttribute('page', 'tv_admin/serial'))
      $this->getUser()->setAttribute('page', 1, 'tv_admin/serial');
    $this->getUser()->setAttribute('id', 0, 'tv_admin/mm');

    $this->broadcasts = BroadcastPeer::doSelectWithI18n(new Criteria(), $this->getUser()->getCulture());
    $this->serialtypes = SerialTypePeer::doSelectWithI18n(new Criteria(), $this->getUser()->getCulture());
  }


  /**
   * --  LIST -- /editar.php/serials/list
   *
   * Sin parametros
   *
   */
  public function executeList()
  {
    return $this->renderComponent('serials', 'list');
  }

  /**
   * --  EDIT -- /editar.php/serials/edit
   *
   * Parametros por URL: id de la serie
   *
   */
  public function executeEdit()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/serial');
    }
    return $this->renderComponent('serials', 'edit');
  }


  /**
   * --  PREVIEW -- /editar.php/serials/preview
   *
   * Parametros por URL: id de la serie
   *
   */
  public function executePreview()
  {
    if ($this->hasRequestParameter('id'))
    {
      $this->getUser()->setAttribute('id', $this->getRequestParameter('id'), 'tv_admin/serial');
    }
    return $this->renderComponent('serials', 'preview');
  }


  /**
   * --  UPDATE -- /editar.php/serials/update
   *
   * Parametros por POST: parameteros del formulario
   *
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $serial = new Serial();
    }
    else
    {
      $serial = SerialPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($serial);
    }

    if ($this->getRequestParameter('publicdate'))
    {
      $timestamp = sfI18N::getTimestampForCulture($this->getRequestParameter('publicdate'), $this->getUser()->getCulture());
      
      $serial->setPublicdate($timestamp);
    }

    $serial->setAnnounce($this->getRequestParameter('announce', 0));
    $serial->setCopyright($this->getRequestParameter('copyright', 0));
    $serial->setSerialTypeId($this->getRequestParameter('serial_type_id', 0));
    $serial->setSerialTemplateId($this->getRequestParameter('serial_template_id', 1));

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $serial->setCulture($lang);
      $serial->setTitle($this->getRequestParameter('title_' . $lang, 0));
      $serial->setSubtitle($this->getRequestParameter('subtitle_' . $lang, 0));
      $serial->setKeyword($this->getRequestParameter('keyword_' . $lang, ' '));
      $serial->setDescription($this->getRequestParameter('description_' . $lang, ' '));
      $serial->setHeader($this->getRequestParameter('header_' . $lang, ' '));
      $serial->setFooter($this->getRequestParameter('footer_' . $lang, ' '));
      $serial->setLine2($this->getRequestParameter('line2_' . $lang, ' '));
    }
    
    $serial->save();
    $this->msg_alert = array('info', "Serie \"" . $serial->getTitle() . "\" guardada OK.");

    

    return $this->renderComponent('serials', 'list');
  }

  /**
   * --  CREATE -- /editar.php/serials/create
   *
   * Sin parametros
   *
   */
  public function executeCreate()
  {
    $serial = SerialPeer::createNew();
    
    $this->getUser()->setAttribute('serial', $serial->getId() );
    $this->getUser()->setAttribute('page', 1, 'tv_admin/serial');
    $this->getUser()->setAttribute('sort', 'publicDate', 'tv_admin/serial');
    $this->getUser()->setAttribute('type', 'desc', 'tv_admin/serial');

    $this->msg_alert = array('info', "Serie de id :" . $serial->getId() . " creada con un objeto multimedia.");
    return $this->renderComponent('serials', 'list');
  }


  /**
   * --  DELETE -- /editar.php/serials/delete
   * OJO: Borra en cascada.
   *
   * Parametros por URL: identificador de la serie. o por POST: array en JSON de identificadores
   *
   */
  public function executeDelete()
  {
    if($this->hasRequestParameter('ids')){
      $serials = SerialPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($serials as $serial){
	$serial->delete();
      }
      $this->msg_alert = array('info', "Series borradas.");

    }elseif($this->hasRequestParameter('id')){
      $serial = SerialPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->msg_alert = array('info', "Serie \"" . $serial->getTitle() . "\" borrada.");
      $serial->delete();
    }

    $text = '<script type="text/javascript"> click_fila_edit("serial", null, -1)</script>';
    $this->getResponse()->setContent($this->getResponse()->getContent().$text);

    return $this->renderComponent('serials', 'list');
  }


  /**
   * --  COPY -- /editar.php/serials/copy
   *
   * Parametros por URL: identificador de la serie.
   *
   */
  public function executeCopy()
  {
    $serial = SerialPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($serial);

    $serial2 = $serial->copy();
    $this->getUser()->setAttribute('serial', $serial2->getId() ); //selecione el nuevo                                                                                                
    return $this->renderComponent('serials', 'list');
  }


  /**
   * --  ANNOUNCE -- /editar.php/serials/announce
   *
   * Parametros por URL: identificador de la serie.
   *
   */
  public function executeAnnounce()
  {
    if($this->hasRequestParameter('ids')){
      $serials = SerialPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids')));

      foreach($serials as $serial){
	$serial->setAnnounce(!$serial->getAnnounce());
	$serial->save();
      }
    $this->msg_alert = array('info', "Series anunciadas/desanunciada correctamente.");

    }elseif($this->hasRequestParameter('id')){
      $serial = SerialPeer::retrieveByPk($this->getRequestParameter('id'));
      $serial->setAnnounce(!$serial->getAnnounce());
      $serial->save();
      $this->msg_alert = array('info', "Serie \"" . $serial->getTitle() . "\" anunciada/desanunciada.");
    }

    return $this->renderComponent('serials', 'list');
  }


  /**
   * --  PREVIEWALL -- /editar.php/serials/previewall
   * Muestra  una vista previa de la representacion de la serie. De como se va a mostrar, 
   * si todos lo videos son publicos, una vez publicado.
   *
   * Parametros por URL: identificador de la serie. Layout: tvlayout
   *
   */
  public function executePreviewall()
  {

    $id = $this->getRequestParameter('id', $this->getUser()->getAttribute('serial'));
    $serial = SerialPeer::retrieveByPk($id);
    $this->forward404Unless($serial);
    $hash = SerialHashPeer::get($serial);

    $this->redirect($hash->getUrl(true, true));

    /*
    $this->setLayout('tvlayout');
    //ADD CSS

    //$this->

    $c = new Criteria();
    $c->add(SerialPeer::ID, $this->getRequestParameter('id', $this->getUser()->getAttribute('serial')));
    list($aux) = SerialPeer::doSelectWithI18n($c, $this->getUser()->getCulture());
    $this->serial = $aux;
    $this->forward404Unless($this->serial);

    $this->mms = $this->serial->getMms();
    $this->roles = RolePeer::doSelectWithI18n(new Criteria(), $this->getUser()->getCulture());

    $this->getResponse()->setTitle($this->serial->getTitle());
    $this->getResponse()->addMeta('keywords', $this->serial->getKeyword());
    */
  }


  /**
   * --  CHANGE PUB -- /editar.php/serials/changePub
   *
   * Parametros por URL: identificador de la serie. Layout: none
   *
   */
  public function executeChangePub()
  {
    $this->serial = SerialPeer::retrieveByPk($this->getRequestParameter('serial'));
    $this->forward404Unless($this->serial);
  }


  /**
   * --  CHANGE PUB -- /editar.php/serials/changePub
   *
   * Parametros por URL: identificador de la serie. Layout: none
   *
   */
  public function executeAnnouncech()
  {
    $serial = SerialPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($serial);
    
    if($this->getRequestParameter('type') == "all"){

      $achs = AnnounceChannelPeer::doSelect(new Criteria());
      foreach($achs as $ach){
	$ach->announceSerial($serial);
      }
      
    }else{
      $ach = AnnounceChannelPeer::retrieveByPk($this->getRequestParameter('type'));
      $this->forward404Unless($ach);
      $ach->announceSerial($serial);
    }

    $this->msg_alert = array('info', "Serie \"" . $serial->getTitle() . "\" anunciada OK.");
    return $this->renderComponent('serials', 'list');    
  }


  /**
   * --  UPDATE_PUB -- /editar.php/mms/update_pub
   *
   *
   */
  public function executeUpdate_pub()
  {
    $data = $this->getRequestParameter('data');

    foreach($data as $id => $d){
      $mm = MmPeer::retrieveByPK($id);
      if(is_null($mm)) continue;
      if ($this->getUser()->getAttribute('user_type_id', 1) == 0){
        $mm->setStatusId($d['status']);
      }
      if(isset($d['pub_channels'])){
	$mm->updatePubChannels($d['pub_channels']);
      }
      $mm->save();     
    }
    return $this->renderComponent('serials', 'list');
  }



  /**
   * --  UPDATE PUB -- /editar.php/serials/updatePub
   *
   * Parametros por URL: identificadoes de los objeos multimedia y nuevo estado. Layout: none
   *
   */
  public function executeUpdatePub()
  {
    $mms = array_reverse(MmPeer::retrieveByPKs(json_decode($this->getRequestParameter('ids'))));
    
    $status_id = $this->getRequestParameter('status', 0);
    //$return_js = '<script type="text/javascript">$("filters_anounce").setValue('.$mm->getStatusId().')</script>'; 
    //$return_js = "<script type=\"text/javascript\"></script>";

    $error = -1000;

    foreach($mms as $mm){
      $aux = EncoderWorkflow::changeStatus($mm, $status_id, $this->getUser()->getAttribute('user_type_id'));      
      if($aux < 0){
	$error = max($aux, $error);
      }
    }

      $new_status = $mm->getSerial()->getMmStatus();
      $return_js = '<script type="text/javascript">$("table_serials_status_'.$mm->getSerial()->getId().'").src="/images/admin/bbuttons/'.$new_status['min'].$new_status['max'].'_inline.gif"; Modalbox.resizeToContent();</script>';

    switch($error){
    case -1:
      return $this->renderText('<span style="font-weight:bolder; color:red">Error</span> Error de permisos.'. $return_js);
    case -2:
      return $this->renderText('<span style="font-weight:bolder; color:red">Error</span> El Objeto Multimedia no tiene master.'. $return_js);
    case -3:
      return $this->renderText('<span style="font-weight:bolder; color:red">Error</span> El Objeto Multimedia no tiene archivos de video. <a href="#mediaMmHash" onclick="menuTab.select(\'mediaMm\'); update_file.stop(); return false;"> Se genera automaticamente</a>'. $return_js);
    case -4:
      return $this->renderText('<span style="font-weight:bolder; color:red">Error</span> El Objeto Multimedia no tiene archivo con perfil <em>podcast_video</em><a href="#mediaMmHash" onclick="menuTab.select(\'mediaMm\'); update_file.stop(); return false;"> Se genera automaticamente</a>'. $return_js);
    case -5:
      return $this->renderText('<span style="font-weight:bolder; color:red">Error</span> El Objeto Multimedia no tiene archivo con perfil <em>podcast_audio.</em><a href="#mediaMmHash" onclick="menuTab.select(\'mediaMm\'); update_file.stop(); return false;"> Se genera automaticamente</a>'. $return_js);
    case -6:
      return $this->renderText('<span style="font-weight:bolder; color:red">Error</span> El Objeto Multimedia no esta catalogado en iTunesU'. $return_js);
    default:
      return $this->renderText("Estado actualizado" . $return_js);
    }
  }


  public function executeInfo()
  {
    $this->serial = SerialPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->serial);

    $this->hash = SerialHashPeer::get($this->serial);
  }
}
