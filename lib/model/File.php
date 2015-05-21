<?php
/**
 * File (class)
 *
 * Clase que representa una entrada en la
 * tabla 'file'.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class File extends BaseFile
{

  /**
   * Devuelve el titulo usado el el ASX, fomado por el titulo de la serie,
   * el titulo del objeto multimedia
   *
   * @access public
   * @return string
   */
  public function getTitleASX( )
  {
    return $this->getMm()->getSerial()->getTitle() . ' - ' . $this->getMm()->getTitle() . ' - ' . $this->getDescription();
  }


  /**
   * Devuelve la copyright de archivo de video
   *
   * @access public
   * @return string
   */
  public function getCopyright( )
  {
    return $this->getMm()->getCopyright();
  }

  /**
   * Devuelve la difusion de archivo de video
   *
   * @access public
   * @return Broadcast
   */
  public function getBroadcast(){
    $c = new Criteria();
    $c->add(FilePeer::ID, $this->getId());
    $c->addJoin(MmPeer::ID, FilePeer::MM_ID);
    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);

    $objects = BroadcastPeer::doSelectWithI18n($c, $this->getCulture());

    if ($objects) {
      return $objects[0];
    }
    return null;
  }

  /**
   * Devuelve los minutos de la duracion del archivo
   *
   * @access public
   * @return integer min
   */
  public function getDurationMin()
  {
    return floor($this->getDuration() / 60);
  }

  /**
   * Devuelve los segundos de la duracion del archivo
   *
   * @access public
   * @return integer seg
   */
  public function getDurationSeg()
  {
    $aux = $this->getDuration() %60;
    if ($aux < 10 ) $aux= '0' . $aux;
    return $aux;
  }

  /**
   * Devuelve un texto que representa la duracion del
   * archivo multimedia, del formato 1' 32''
   *
   * @access public
   * @return integer seg
   */
  public function getDurationString()
  {
    $min = $this->getDurationMin();
    if ($min == 0 ) $aux = $this->getDurationSeg() ."''";
    else $aux = $min . "' ". $this->getDurationSeg() ."''";
    return $aux;
  }

  /**
   * Devuleve la url absoluta del webserver donde esta el video.
   * Se supone que videoserver esta montado en webserver.
   *
   * @access public
   * @return url absoluta
   */
  public function getUrlMount()
  {
    if ($this->getFile()) return $this->getFile();
    else return FilePeer::urlWeb2Mount($this->getUrl());
  }


  /**
   * Devuleve la path samba para que transcodificadores accedan al video
   * \\*.*.*.*\qwer\123\123.avi
   *
   * @access public
   * @return string ruta para acceder al video desde windows
   */
  public function getFileWin()
  {
    return str_replace('/' ,'\\', str_replace(sfConfig::get('app_transcoder_path_unix'), sfConfig::get('app_transcoder_path_win'), $this->getFile()));
  }

  /**
   * Genera un la url relativa o absoluta  de la pagina web de su asx o archivo.
   *
   * @access public
   * @parem boolean indica si la ruta es absoluta o no.
   * @return String Url relativa.
   */
  public function getUrlLink($absolute = false)
  {
    $host = ($absolute)?sfConfig::get('app_info_link'):''; 
    return ($host . '/es/video/' . $this->getMm()->getId() . '.html');
  }


  /**
   * Incrementa el numero de veces que se vio el video.
   *
   * @access public
   */
  public function incNumView()
  {
    $this->setNumView($this->getNumView() + 1);
    $this->save();
  }


  /**
   * Utilizando la libreria ffmpeg_php se genera un Pic que se asocia con el objeto
   * multimedia al que pertenece el archivo.
   *
   * @access public
   * @param integer $frame numero del frame donde se realiza la captura.
   * @return PIC o null si mal
   */
  public function createPic($frame = 25)
  {

    /*SIN PHP-FFMPEG*/

    $currentDir = 'Serial/' . $this->getMm()->getSerialId() . '/Video/' . $this->getMmId();  //ciao
    $absCurrentDir = sfConfig::get('sf_upload_dir').'/pic/' . $currentDir;
    $fileName = date('ymdGis').'.jpg';
    $aux = null;

    @mkdir($absCurrentDir, 0777, true);

    $width = sfConfig::get('app_thumbnail_hor');
    $height = sfConfig::get('app_thumbnail_ver');
    $new_height = intval(1.0 * $width / $this->getAspect());

    if($new_height <= $height) {
      $new_width = $width;
    }else{
      $new_height = $height;
      $new_width = intval(1.0 * $height * $this->getAspect());
    }
    
    $ffmpeg_path = is_executable('/usr/local/bin/ffmpeg')?'/usr/local/bin/ffmpeg':'ffmpeg';

    /*
    echo $ffmpeg_path . " -ss ".intval($frame/25)." -y -i \"".$this->getFile()."\" -r 1 -vframes 1 -s ".
      $new_width . "x" . $new_height . " -f image2 \"" . $absCurrentDir . '/' . $fileName . "\"";
    exit;
    */
    exec($ffmpeg_path . " -ss ".intval($frame/25)." -y -i \"".$this->getFile()."\" -r 1 -vframes 1 -s ".
	 $new_width . "x" . $new_height . " -f image2 \"" . $absCurrentDir . '/' . $fileName . "\"");

    if(file_exists($absCurrentDir .'/' . $fileName)){
      $aux = $this->getMm()->setPic('/uploads/pic/' . $currentDir . '/' . $fileName);
    }

    return $aux;

    $currentDir = 'Serial/' . $this->getMm()->getSerialId() . '/Video/' . $this->getMmId();  //ciao
    $absCurrentDir = sfConfig::get('sf_upload_dir').'/pic/' . $currentDir;
    $fileName = date('ymdGis').'.jpg';

    $movie = new ffmpeg_movie($this->getUrlMount(), false);
    if (!$movie) return null;
    $frame = $movie->getFrame($frame);
    if (!$frame) return null;
    
    //if(($frame->getWidth()/$frame->getHeight()) > 1.4)
    //  $frame->crop(0, 0, $frame->getWidth() - intval(4 * $frame->getHeight() / 3));


    //$frame->resize(sfConfig::get('app_thumbnail_hor'), sfConfig::get('app_thumbnail_ver'));
    @mkdir($absCurrentDir, 0777, true);
    $imageGD = $frame->toGDImage();
    imagejpeg($imageGD, $absCurrentDir .'/' . $fileName);

    return $this->getMm()->setPic('/uploads/pic/' . $currentDir . '/' . $fileName);
  }


  /**
   * Devuelve la relacion de aspecto.(Mirar que sea !=0)
   *
   * @access public
   * @return float relacion de aspecto
   */
  public function getAspect(){
    if ($this->getResolutionVer() == 0) return 0;
    return (1.0 * $this->getResolutionHor() / $this->getResolutionVer());
  }
  

  /**
   * Codifica el archivo de video 
   *
   * @access public
   * @param integer $perfil_id nuevo perfil
   * @param opt integer $prioridad 
   * @param opt integer $user_email (0 si se desconoce)
   * @param force boolena para crear otro aunque exista
   * @return la tarea creada o null is error
   */
  //OJO SI YA ESTA TRANSOCODIFICANDO NO LO HAGAS
  public function retranscoding($perfil_id, $priority = 2, $user_email = 0, $force = false){
    $trans = TranscodingPeer::getTranscodingsFromMmAndPerfil($this->getMmId(), $perfil_id);

    if((!is_null($trans))&&(!$force)){
      return $trans;
    }

    $trans = new Transcoding();
    $trans->setPerfilId($perfil_id);
    $trans->setStatusId(1);

    $trans->setPriority($priority);  
    if ($perfil_id == 6){
      $trans->setPriority($priority - 1);  
    }
    $trans->setTimeini('now');
    $trans->setMmId($this->getMmId());

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $l){
      $trans->setCulture($l);
      $this->setCulture($l);
      $trans->setDescription($this->getDescription());
    }

    $trans->setName(substr($this->getFile(), 0 , strlen($this->getFile())- 4));
    $trans->setLanguage($this->getLanguage());
    
    $trans->setPid(0);

    if($user_email !== 0){
      $trans->setEmail($user_email);
    }

    $trans->save();      //Necesario para setPathAuto

    $trans->setDuration($this->getDuration());
    $trans->setPathsAuto($this->getFile());
    $trans->setUrl($trans->getPathEnd());

    $trans->save();      
    TranscodingPeer::execNext();   
    
    return $trans;
  }

  public function isMaster() 
  {
    return $this->getPerfil()->getMaster();
  }


  public function save($con = null)
  {
    parent::save($con);
    if($mm = $this->getMm()){
      if ($this->getDuration() > $mm->getDuration()) {
	$mm->setDuration($this->getDuration());
      }
      if ($this->getNumView() > $mm->getNumView()) {
	$mm->setNumView($this->getNumView());
      }
      if($this->isMaster()) {
	$mm->setAudio($this->getAudio());
      }
      $mm->saveInDB();
    }
  }


  /**
   * Usada para guardar en la BBDD sin actualizar Lucene de Mm. Usar con cuidado.
   */
  public function saveInDB($con = null)
  {
     parent::save($con);
  }

  /**
   *
   */
  public function getExtension() 
  {
    return (substr($this->getFile(), strrpos($this->getFile(), '.') + 1));
  }
  

  /**
   * Genera un la url relativa al video.
   *
   * @access public
   * @return String Url relativa.
   */
  public function getInternalUrl($absolute = false)
  { 
    //Hack
    $old = sfConfig::get('sf_no_script_name');
    sfConfig::set('sf_no_script_name', true);
    $controller = sfContext::getInstance()->getController();
    $url = $controller->genUrl(array('module'=> 'file', 'action' => 'index', 'id' => $this->getId() . "." . $this->getExtension()), $absolute);
    sfConfig::set('sf_no_script_name', $old);
    return $url;
  }

  /**
   * Lógica de editar/modules/files/actions.php para autocompletar resolución, size y duración.
   *
   */
  public function autocomplete()
  {
    $this->setDuration(intval(FilePeer::getDuration($this->getUrlMount())));                                                                                                                               
    $this->setSize(filesize($this->getUrlMount()));                                                                                                                                                        
                                                                                                                                                                                                           
    //Autocompletar resolution                                                                                                                                                                              
    $movie = new ffmpeg_movie($this->getFile());                                                                                                                                                           
    if (!is_null($movie)){                                                                                                                                                                                 
      $this->setResolutionVer($movie->getFrameHeight());                                                                                                                                                   
      $this->setResolutionHor($movie->getFrameWidth());                                                                                                                                                    
    }
  }

}


/** Implementa comportamiento sortableFK */
sfPropelBehavior::add('File', array('sortableFk' => array('f_key' => 'mm_id')));
