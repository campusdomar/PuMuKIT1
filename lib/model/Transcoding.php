<?php
/**
 * Subclass for representing a row from the 'transcoding' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Transcoding extends BaseTranscoding
{
  /**
   *
   *
   *
   */
  public function getPathIniWin()
  {
    return str_replace('/' ,'\\', str_replace(sfConfig::get('app_transcoder_path_unix'), sfConfig::get('app_transcoder_path_win'), $this->getPathIni()));
  }

  /**
   *
   *
   *
   */
  public function deleteTempFiles()
  {
    if ($this->getStatusId() !== TranscodingPeer::STATUS_FINALIZADO) {
      return false;
    }

    $c = new Criteria();
    $c->add(TranscodingPeer::PATH_INI, $this->getPathIni());
    $c->add(TranscodingPeer::STATUS_ID, array(TranscodingPeer::STATUS_FINALIZADO), Criteria::NOT_IN);
    
    //Si no hay otras tareas ejecutandose con el mismo PATH_INI
    if (TranscodingPeer::doCount($c) == 0){

      $tmp_path = sfConfig::get('app_transcoder_path_tmp');
      $inbox_paths = sfConfig::get('app_transcoder_inbox');
      
      if (false !== strpos($this->getPathIni(), $tmp_path)){
        unlink($this->getPathIni());
      }
      
      foreach($inbox_paths as $path){
        if (false !== strpos($this->getPathIni(), $path)){
          unlink($this->getPathIni());
        }
      }
    }
  }

  /**
   *
   *
   * Devuelve valor entre 0 y 1 indicando porcentaje de codificacion
   */
  public function getRatio()
  {
    if ($this->getFileSizeTemp() == 0) return 0;
    
    if (($this->getStatusId() == TranscodingPeer::STATUS_ERROR)||
	($this->getStatusId() == TranscodingPeer::STATUS_PAUSADO)||
	($this->getStatusId() == TranscodingPeer::STATUS_ERROR)||
	($this->getStatusId() == TranscodingPeer::STATUS_ESPERANDO))
      return 0;
    if ($this->getStatusId() == TranscodingPeer::STATUS_FINALIZADO)
      return 1;
    if($this->getFileSizeTemp() == 0)
      return 0;
    if ($this->getStatusId() == TranscodingPeer::STATUS_EJECUTANDOSE){ 
      $aux = sprintf('%.2f' , $this->getFileSizeTemp()/$this->getDuration()/$this->getPerfil()->getRelDurationSize());
      return ($aux < 1)?$aux:0.99;
    }
    
  }

  /**
   *
   *
   * Devuelve tamano de archivo codificande
   */
  public function getFileSizeTemp()
  {
    if(file_exists($this->getPathend()))
      return filesize($this->getPathend());
    return 0;
  }



  /**
   *
   *
   *
   */
  public function getStatusText()
  {
    $aux = $this->getRatio(); 
    $rel = ($aux == 0.0)?'?':(($aux*100).'%');
    $aux = array(
		 -1 => 'Error :(',
		 0  => 'Pausado',
		 1  => 'Esperando...',
		 2  => 'Ejecutandose ('.$rel.')...',
		 3  => 'Finalizado :)',
		 );
    return $aux[$this->getStatusId()];
  }


  public function setEmailOn()
  {
   $this->setEmail(str_replace('#', '@', $this->getEmail()));
  }


  public function setEmailOff()
  {
    $this->setEmail(str_replace('@', '#', $this->getEmail()));
  }


  public function hasEmailOn()
  {
    return eregi('^[\x20-\x2D\x2F-\x7E]+(\.[\x20-\x2D\x2F-\x7E]+)*@(([a-z0-9]([-a-z0-9]*[a-z0-9]+)?){1,63}\.)+[a-z0-9]{2,6}$', $this->getEmail());
  }


  public function getBeforet()
  {

    $conexion = Propel::getConnection();
    $consulta = 'SELECT COUNT(%s) AS number FROM %s WHERE %s=%s AND (%s>%s OR %s<%s)';
    $consulta = sprintf($consulta, TrancodingPeer::ID, TrancodingPeer::TABLE_NAME, 
			TrancodingPeer::STATUS_ID, TrancodingPeer::STATUS_ESPERANDO, 
			TranscodingPeer::PRIORITY, $this->getPriority(),
			TranscodingPeer::ID, $this->getId());

    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    $resultset->next();
    return $resultset->getInt('number');    
  }


  public function getBeforetDuration()
  {

    $conexion = Propel::getConnection();
    $consulta = 'SELECT SUM(%s) AS duration FROM %s WHERE %s=%s AND (%s>%s OR %s<%s)';
    $consulta = sprintf($consulta, TrancodingPeer::DURATION, TrancodingPeer::TABLE_NAME, 
			TrancodingPeer::STATUS_ID, TrancodingPeer::STATUS_ESPERANDO, 
			TranscodingPeer::PRIORITY, $this->getPriority(),
			TranscodingPeer::ID, $this->getId());

    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    $resultset->next();
    return $resultset->getInt('duration');    
  }


  /**
   *
   *
   *
   */
  public function createFile()
  {
    $file = new File();
    $file->setMmId($this->getMmId());  
    $file->setPerfilId($this->getPerfilId());  
    $file->setLanguageId($this->getLanguageId());
    $file->setDisplay($this->getPerfil()->getDisplay());
    $file->setDownload(!$this->getPerfil()->getMaster());

    //ojo Error
    if (strlen($this->getPerfil()->getUrlOut()) !== 0)
      $file->setUrl(str_replace($this->getPerfil()->getDirOut(), $this->getPerfil()->getUrlOut(), $this->getUrl()));
    $file->setFile($this->getUrl());
    
    
    // Obsolete fields
    $file->setFormatId(FormatPeer::getDefaultSelId());
    $file->setCodecId(CodecPeer::getDefaultSelId());
    $file->setMimeTypeId(MimeTypePeer::getDefaultSelId());
    $file->setResolutionId(ResolutionPeer::getDefaultSelId());
    

    $file->setBitrate($this->getPerfil()->getBitrate());
    $file->setFramerate($this->getPerfil()->getFramerate());
    $file->setChannels($this->getPerfil()->getChannels());
    $file->setAudio($this->getPerfil()->getAudio());

    $movie = new ffmpeg_movie($file->getFile());
    if ($movie){
      $file->setResolutionVer($movie->getFrameHeight());
      $file->setResolutionHor($movie->getFrameWidth());
      $file->setAudio(!$movie->hasVideo());  //MASTER_COPY error in with $file->setAudio($this->getPerfil()->getAudio());
    }
    
    $file->setDuration($this->getDuration());
    $file->setSize(filesize($this->getPathEnd()));

    
    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $file->setCulture($lang);
      $this->setCulture($lang);
      $file->setDescription($this->getDescription());
    }
    
    $file->save();
    if(count($file->getMm()->getPics()) == 0) {
      if($file->getAudio()){
	$file->getMm()->setPic(sfConfig::get('app_info_link')."/images/sound_bn.png");
      } else{
	$file->createPic();
      }
    }
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
   * Completa la ruta y la extension final (pathEnd, extEnd)
   *
   * @access public
   * @return string PATH END
   */
  public function setPathsAuto($path)
  {
    $this->setPathIni($path);
    
    if((strlen($this->getPathIni()) == 0)||is_null($this->getMmId())||is_null($this->getPerfilId())){
      throw new sfException("Error en autoEnd");
    }
    
    $parcial = explode(".", $this->getPathIni());
    $extension = $parcial[count($parcial)-1];
    //$extension = end(explode(".", $this->getPathIni()));

    $extension_final = (($this->getPerfil()->getExtension() == '???')?($extension):($this->getPerfil()->getExtension()));

    $dir_temp = $this->getPerfil()->getDirOut() . '/' . $this->getMm()->getSerialId();
    @mkdir($dir_temp, 0777, true);
    
    //ANTES  OJO MIRAR SI EXISTE
    //$dir_salida = $dir_temp.'/'.$mm->getRecordDate('ymd').'_'.$this->elimina_acentos($mm->getTitle()).'_'.
    //  $lang->getCod().'('.$profile->getName().')_'.$trans->getId().'.'.$extension_final;

    $aux = $dir_temp.'/'.$this->getId().'.'.$extension_final; //UNO
    $this->setPathEnd($aux);

    //FALTA MIRAR SI EXISTE PARA NO MACHACARLA (con id no problema)

    $this->setExtIni($extension);
    $this->setExtEnd($extension_final);
    return $aux;
  }

  /**
   * Genera la linea de ejecucion sustituyendo %1 %2 %3 por 
   * los archivos de entrada salida y cfg.
   *
   *  @return string linea de comandos
   */
  public function getBatAuto($file_in = null)
  {
    //CREO LINEA DE EJECUCION
    $linea_comandos = $this->getPerfil()->getBat();;
    $linea_comandos = str_replace('%1', (is_null($file_in)?$this->getPathIni():$file_in), $linea_comandos);
    $linea_comandos = str_replace('%2', $this->getPathEnd(), $linea_comandos);
    $perfil_path = sfConfig::get('app_transcoder_path_htdocs') . $this->getPerfil()->getFileCfg();
    $linea_comandos = str_replace('%3', $perfil_path, $linea_comandos);
    
    $path_tmp = "/mnt/vodhosting/tmp/" . substr(basename($this->getPathIni()), 0, -4) . "_(canopus).avi";
    $linea_comandos = str_replace('%4', $path_tmp, $linea_comandos);

    foreach(range(1, 9) as $identificador){
      do{
        $my_tmp_file = sfConfig::get('app_transcoder_path_tmp').'/'. rand() ;
      } while (file_exists($my_tmp_file));

      $linea_comandos = str_replace('%_' . $identificador, $my_tmp_file, $linea_comandos);
      //echo "cambio " , '%_' , $identificador, " por ",  $my_tmp_file, "\n";

    }
    
    //:)
    if($this->getCpu()->getType() == "windows"){
      $linea_comandos = str_replace(sfConfig::get('app_transcoder_path_unix'), sfConfig::get('app_transcoder_path_win'), $linea_comandos); 
      $linea_comandos = str_replace("\\/","----antes----",$linea_comandos);
      $linea_comandos = str_replace("/","\\",$linea_comandos);
      $linea_comandos = str_replace("----antes----", "/",$linea_comandos);
      $linea_comandos = str_replace(" \\i "," /i ",$linea_comandos); //CAMBIAR FORMA de hacerlo
    }

    
    $linea_comandos = urlencode($linea_comandos);
    $linea_comandos .= " \n";
    
    return $linea_comandos;
  }
}
