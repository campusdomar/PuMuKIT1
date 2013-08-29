<?php
/**
 * MODULO FILES ACTIONS. 
 * Pseudomodulo usado por el modulo de objeto multimedia para administrar
 * los archivos multimedia de un objeto multimedia. 
 *
 * @package    pumukit
 * @subpackage files
 * @author     Ruben Gonzalez Gonzalez (rubenrua at uvigo dot com)
 * @version    1.0
 */
class filesActions extends sfActions
{
  /**
   * --  LIST -- /editar.php/files/list
   *
   * Parametros por URL: Identificador del objeto multimedia
   *
   */
  public function executeList()
  {
    return $this->renderComponent('files', 'list');
  }

  /**
   * --  CREATE -- /editar.php/files/create
   *
   * Parametros por URL: Identificador del objeto multimedia
   *
   */
  public function executeCreate()
  {
    $this->file = new File();

    $this->file->setMmId($this->getRequestParameter('mm'));
    $this->file->setLanguageId(LanguagePeer::getDefaultSelId());
    $this->file->setFormatId(FormatPeer::getDefaultSelId());
    $this->file->setCodecId(CodecPeer::getDefaultSelId());
    $this->file->setMimeTypeId(MimeTypePeer::getDefaultSelId());
    $this->file->setPerfilId(1);
    $this->file->setResolutionId(ResolutionPeer::getDefaultSelId());
    $this->file->setUrl(sfConfig::get('app_videoserver_url','mms://videoserver.uvigo.es/...'));
    
    $this->langs = sfConfig::get('app_lang_array', array('es'));

    $this->setTemplate('edit');
  }

  /**
   * --  EDIT -- /editar.php/files/edit
   *
   * Parametros por URL: Identificador del archivo multimedia
   *
   */
  public function executeEdit()
  {
    $this->file = FilePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->file);
    $this->langs = sfConfig::get('app_lang_array', array('es'));
  }

  /**
   * --  DELETE -- /editar.php/files/delete
   *
   * Parametros por URL: Identificador del archivo multimedia
   *
   */
  public function executeDelete()
  {
    $file = FilePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($file);
    $file->delete();

    $mm = $file->getMm();

    if($mm->getFirstPublicFile() == null){
      $c = new Criteria();
      $c->add(PubChannelMmPeer::MM_ID, $mm->getId());
      $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, 1);
      PubChannelMmPeer::doDelete($c);
      $this->reload_pub_channel = true;
    }
    
    return $this->renderComponent('files', 'list');
  }

  /**
   * --  CREATE -- /editar.php/files/create
   *
   * Parametros por URL: Identificador del objeto multimedia
   *
   */
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $file = new File();
    }
    else
    {
      $file = FilePeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($file);
    }


    $file->setMmId($this->getRequestParameter('mm', 0));
    $file->setLanguageId($this->getRequestParameter('language_id', 0));
    $file->setUrl($this->getRequestParameter('url', 0));
    $file->setFile($this->getRequestParameter('file', 0));
    $file->setPerfilId($this->getRequestParameter('perfil_id', 1));
    //$file->setFormatId($this->getRequestParameter('format_id', 0));
    //$file->setCodecId($this->getRequestParameter('codec_id', 0));
    //$file->setMimeTypeId($this->getRequestParameter('mime_type_id', 0));
    //$file->setResolutionId($this->getRequestParameter('resolution_id', 0));
    //$file->setBitrate($this->getRequestParameter('bitrate', 0));
    //$file->setFramerate($this->getRequestParameter('framerate', 0));
    //$file->setChannels($this->getRequestParameter('channels', 0));
    //$file->setAudio($this->getRequestParameter('audio', 0));
    $file->setDuration($this->getRequestParameter('duration_min', 0) * 60 + $this->getRequestParameter('duration_seg', 0));
    $file->setSize($this->getRequestParameter('size', 0));
    $file->setResolutionHor($this->getRequestParameter('resolutionhor', 0));
    $file->setResolutionVer($this->getRequestParameter('resolutionver', 0));
    $file->setDisplay($this->getRequestParameter('display', 0));

    //iniSort
    //num_view
    //tamano

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $file->setCulture($lang);
      $file->setDescription($this->getRequestParameter('description_' . $lang, ' '));
    }
    
    $file->save();

    return $this->renderComponent('files', 'list'); 
  }

  /**
   * --  AUTOCOMPLETE -- /editar.php/files/autocomplete
   *
   * Parametros por URL: Identificador del archivo multimedia
   *
   */
  public function executeAutocomplete(){
  
    $file = FilePeer::retrieveByPk($this->getRequestParameter('id'));
    if ($file == null) return $this->renderText('K0');

    if(!file_exists($file->getUrlMount())){
      $this->msg_alert = array('error', "Error en autocompletado los datos del archivo multimedia.");
      return $this->renderComponent('files', 'list');
    }

    $file->setDuration(intval(FilePeer::getDuration($file->getUrlMount())));
    $file->setSize(filesize($file->getUrlMount()));

    //Autocmpletar resolution
    $movie = new ffmpeg_movie($file->getFile());
    if (!is_null($movie)){
      $file->setResolutionVer($movie->getFrameHeight());
      $file->setResolutionHor($movie->getFrameWidth());
    }
    
    if (file_exists($file->getUrlMount())) $file->setFile($file->getUrlMount());
    $file->save();

    $this->msg_alert = array('info', "Autocompletados los datos del archivo multimedia.");
    return $this->renderComponent('files', 'list');
  }


  /**
   * --  INFO -- /editar.php/files/info
   *
   * Parametros por URL: Identificador del archivo multimedia
   *
   */
  public function executeInfo(){
    $this->file = FilePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->file);
  }


  /**
   * --  DOWNLOAD -- /editar.php/files/download
   *
   * Parametros por URL: Identificador del archivo multimedia
   *
   */
  public function executeDownload(){
    set_time_limit(0);

    $file = FilePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($file);

    //-  A)   ***** SIN TICKET ln -s file->getUrl web/tickets *****
    //-  // Cabeceras HTTP
    //-  header('HTTP/1.1 200 OK');
    //-  if ($file->getSize() != 0) header('Content-Length: '.$file->getSize());
    //-  header ('Content-Disposition: attachment; filename='.basename($file->getFile())); 
    //-  header('Content-type: application/octet-stream');
    //-  
    //-  ob_end_clean();
    //-  //DATOS
    //-  $aux= readfile($file->getUrlMount());
    //-  
    //-  file_put_contents(sfConfig::get('sf_log_dir') . '/readfile.log', $aux . " \n", FILE_APPEND);
    //-  

    //-  B)   ***** CON TICKET ln -s file->getUrl web/tickets *****
    // Compruebo que acede desde pumukit.
    $ticket = TicketPeer::new_web($file);
    $this->getController()->redirect($ticket->getUrl(), 0);
    throw new sfStopException();
  }


  /**
   * --  PIC -- /editar.php/files/pic
   *
   * Parametros por URL: Identificador del archivo multimedia y opcionalmente, numero de frame
   *
   */
  public function executePic(){
  
    $file = FilePeer::retrieveByPk($this->getRequestParameter('id'));
    if ($file == null) return $this->renderText('K0');

    if(!file_exists($file->getUrlMount())){
      $this->msg_alert = array('error', "Error en autocompletado los datos del archivo multimedia.");
      return $this->renderComponent('pics', 'list');
    }

    $aux = $this->getRequestParameter('numframe', null);
    $num_frames = FilePeer::getFrameCountFfmpeg($file->getFile());
    if((is_null($aux)||($num_frames == 0))){
      $num = 125 * (count($file->getMm()->getPics())) + 1;
    }elseif(substr($aux, -1, 1) === '%'){
      $num = intval($aux)* $num_frames /100;
    }else{
      $num = intval($aux);
    }
	    //$num = count($file->getMm()->getPics());
	    //$num = $this->getRequestParameter('numframe', 125 * ($num +1));
    $file->createPic($num);

    $this->msg_alert = array('info', "Capturado el FRAME " .  $num. " como imagen.");
    return $this->renderComponent('pics', 'list');
  }

  /**
   * --  UP -- /editar.php/files/up
   *
   * Parametros por URL: Identificador del archivo multimedia
   *
   */
  public function executeUp()
  {
    $file = FilePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($file);

    $file->moveUp();
    $file->save();

    return $this->renderComponent('files', 'list');
  }

  /**
   * --  DOWN -- /editar.php/files/down
   *
   * Parametros por URL: Identificador del archivo multimedia
   *
   */
  public function executeDown()
  {
    $file = FilePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($file);

    $file->moveDown();
    $file->save();

    return $this->renderComponent('files', 'list');
  }

  /**
   * --  RETRANSCODIFICAR -- /editar.php/files/retrans
   *
   * Parametros por URL: 
   *   - Identificador del archivo multimedia
   *   - Identificador del perfil nuevo
   *
   */
  public function executeRetrans()
  {
    $file = FilePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($file);
    
    $profile = PerfilPeer::retrieveByPk($this->getRequestParameter('profile'));
    $this->forward404Unless($profile);

    //retranscodifico creando uno nuevo si es necesario.
    $file->retranscoding($profile->getId(), $this->getRequestParameter('prioridad', 2), $this->getUser()->getAttribute('user_id'), true);

    $this->msg_alert = array('info', "Creada nueva tarea para retranscodificar al nuevo formato.");
    return $this->renderComponent('files', 'list');
  }





  /*
   * 
   */
  protected function sanitizeDir($dir)
  {
    return preg_replace('/[^a-z0-9_-]/i', '_', $dir);
  }

  protected function sanitizeFile($file)
  {
    return preg_replace('/[^a-z0-9_\.-]/i', '_', $file);
  }
}
