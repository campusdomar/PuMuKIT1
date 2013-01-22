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
    return ($host . '/es/video/' . $this->getId() . '.html');
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
    //echo "ffmpeg -i ".$this->getFile()." -f image2 -s ".sfConfig::get('app_thumbnail_hor') ."x". sfConfig::get('app_thumbnail_ver')." -r 1 -ss ".intval($frame/25)." -t 1 ". $absCurrentDir .'/' . $fileName; exit;
    exec("ffmpeg -ss ".intval($frame/25)." -i \"".$this->getFile()."\" -f image2 -s ".sfConfig::get('app_thumbnail_hor') ."x". sfConfig::get('app_thumbnail_ver')." -r 1 -t 1 \"". $absCurrentDir .'/' . $fileName . "\"");
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
    return ($this->getResolutionHor()/$this->getResolutionVer());
  }
  

  /**
   * Codifica el archivo de video 
   *
   * @access public
   * @param integer $perfil_id nuevo perfil
   * @param opt integer $prioridad 
   * @param opt integer $user_id (0 si se desconoce)
   * @param force boolena para crear otro aunque exista
   * @return la tarea creada o null is error
   */
  //OJO SI YA ESTA TRANSOCODIFICANDO NO LO HAGAS
  public function retranscoding($perfil_id, $priority = 2, $user_id = 0, $force = false){
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

    if($user_id !== 0){
      $user = UserPeer::retrieveByPK($user_id);
      $trans->setEmail($user->getEmail());
    }

    $trans->save();      //Necesario para setPathAuto

    $trans->setDuration($this->getDuration());
    $trans->setPathsAuto($this->getFile());
    $trans->setUrl($trans->getPathEnd());

    $trans->save();      
    TranscodingPeer::execNext();   
    
    return $trans;
  }
}


/** Implementa comportamiento sortableFK */
sfPropelBehavior::add('File', array('sortableFk' => array('f_key' => 'mm_id')));
