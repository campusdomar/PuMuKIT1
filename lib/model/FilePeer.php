<?php

/**
 * FilePeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'file'. 
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class FilePeer extends BaseFilePeer
{

  /**
   * Sobrecarga la funcion doDelete para borrar, si existe,
   * el archivo alojado en el servidor.
   *
   */
  public static function doDelete($values, $con = null)
  {
    // DESCOMENTAR ESTE CODIGO PARA BORRAR ARCHIVOS
    /* if ($values instanceof File){
      if (file_exists($values->getFile())) @unlink($values->getFile());
      }*/

    parent::doDelete($values, $con);
  }

  /**
   * Devuelve todos los archivos asociados al objeto
   * multimedia cuya id se pasa por parametro.
   *
   * @param integer $id id del objeto multimedia
   * @param string $culture cultura en la que se desea completar los materiales
   * @return ResulSet de objetos File.
   */
  public static function getFilesFromMm($id, $culture)
  {
    $criteria = new Criteria();
    $criteria->add(FilePeer::MM_ID, $id);
    $criteria->addAscendingOrderByColumn(FilePeer::RANK);

    return FilePeer::doSelectWithI18n($criteria, $culture);
  }

  /**
   * Combierte la url de Web en url de Mount
   *
   *
   * @access public
   * @param string $url mms://videoserver.uvigo.es/abc/...
   * @return url /mnt/videoserver/abc/...
   */
  static public function urlWeb2Mount($url)
  {
    $antes = sfConfig::get('app_videoserv_url');
    $despues = sfConfig::get('app_videoserv_mount');
    //$antes = array('mms://videoserver.uvigo.es/VoD/', 'mms://videoserver.uvigo.es/VoDprivado');
    //$despues = array('/mnt/videoserver/VoD Publico/', '/mnt/videoserver/VoDPrivado/');
    return str_ireplace($antes, $despues, $url);
  }


  /**
   * Devuelve el numero de horas que componen la serie
   *
   * @access public
   * @return integer
   */
  static public function doCountDurationPublic($dates = null)
  {
    $conexion = Propel::getConnection();
    $consulta = 'SELECT SUM(%s) AS total FROM %s, %s, %s WHERE %s = %s AND %s = %s AND %s = %s AND %s = %s';
    $consulta = sprintf($consulta, FilePeer::DURATION, FilePeer::TABLE_NAME, MmPeer::TABLE_NAME, PerfilPeer::TABLE_NAME, FilePeer::MM_ID, MmPeer::ID, MmPeer::STATUS_ID, 0, FilePeer::PERFIL_ID, PerfilPeer::ID, PerfilPeer::DISPLAY , 1);
  
    if ($dates != null){
      $consulta .= ' AND %s > "%s" AND %s < "%s"';
      $consulta = sprintf($consulta, MmPeer::RECORDDATE, date("Y-m-01", $dates["ini"]), MmPeer::RECORDDATE, date("Y-m-01", $dates["end"]));
    }
  
    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    $resultset->next();
    return $resultset->getInt('total')/3600;
  }

  /**
   * Devuelve el numero de horas que componen la serie
   *
   * @access public
   * @return integer
   */
  static public function doCountDuration($dates = null)
  {
    $conexion = Propel::getConnection();
    $consulta = 'SELECT SUM(%s) AS total FROM %s, %s, %s WHERE %s = %s AND %s = %s AND %s = %s';
    $consulta = sprintf($consulta, FilePeer::DURATION, FilePeer::TABLE_NAME, MmPeer::TABLE_NAME, PerfilPeer::TABLE_NAME, FilePeer::MM_ID, MmPeer::ID, FilePeer::PERFIL_ID, PerfilPeer::ID, PerfilPeer::MASTER , 1);
  
    if ($dates != null){
      $consulta .= ' AND %s > "%s" AND %s < "%s"';
      $consulta = sprintf($consulta, MmPeer::RECORDDATE, date("Y-m-01", $dates["ini"]), MmPeer::RECORDDATE, date("Y-m-01", $dates["end"]));
    }
  
    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    $resultset->next();
    return $resultset->getInt('total')/3600;
  }


  /**
   * Devuelve el numero de horas publicadas en el ultimo mes
   *
   * @access public
   * @return integer
   */
  //UPDATE 1.5
  //static public function doCountDurationLastMounth()
  //{
  //  $conexion = Propel::getConnection();
  //  $consulta = 'SELECT SUM(%s) AS total FROM %s, %s, %s WHERE %s = %s AND %s  > %s AND %s >= "%s" AND %s = %s AND %s = %s';
  //  $consulta = sprintf($consulta, FilePeer::DURATION, FilePeer::TABLE_NAME, MmPeer::TABLE_NAME, PerfilPeer::TABLE_NAME, FilePeer::MM_ID, 
  //			MmPeer::ID, MmPeer::STATUS_ID, 1, MmPeer::PUBLICDATE, date("Y-m-d", time() - (31 * 24 * 60 * 60)),
  //			FilePeer::PERFIL_ID, PerfilPeer::ID, PerfilPeer::DISPLAY, 1);
  //  $sentencia = $conexion->prepareStatement($consulta);
  //  $resultset = $sentencia->executeQuery();
  //  $resultset->next();
  //  return $resultset->getInt('total')/3600;
  //}



  /**
   * Devuelve la duracion de un fichero de multimedia, utiliza la libreria getid3 y ffmpeg-php. 
   * Getid3 es mas rapida pero no parsea archivos muy grandes, ffmpeg es mas lenta pero no comprueba que el archivo sea de 
   * multimedia
   *
   * @access public.
   * @param  string file ruta absolute para acceder al archivo.
   * @return integer duration.
   */
  static public function getDuration($file){
    if (!file_exists($file)) return 0;
    //////////////////////////////////////////////
    //GETID3
    //////////////////////////////////////////////
    if(extension_loaded('ffmpeg')){
      $movie = new ffmpeg_movie($file);
      if (!$movie){
        return 0;
      }
      $duration = intval($movie->getDuration());
    }else{
      $getid3 = new getid3();
      $getid3->encoding = 'UTF-8';
      try{
        $getid3->Analyze($file);
      }catch(Exception $e){
        $movie = new ffmpeg_movie($file);
        if (!$movie){
          return 0;
        }
        return intval($movie->getDuration());
      }
    
      if(!strstr($getid3->info['mime_type'], 'video/') && !strstr($getid3->info['mime_type'], 'audio/')){
        throw new Exception('No multimedia file to get duration');
      }
      $duration = intval($getid3->info['playtime_seconds']);
    }
    
    return($duration);
  }



  /**
   * Devuelve la duracion de un fichero de multimedia, utiliza la libreria ffmpeg-php. 
   *
   * @access public.
   * @param  string file ruta absolute para acceder al archivo.
   * @return integer duration.
   */
  static public function getDurationFfmpeg($file){
    if (!file_exists($file)) return 0;
    $movie = new ffmpeg_movie($file);
    if (!$movie){
      return 0;
    }
    //echo $movie->getDuration();
    return intval($movie->getDuration());
  }

  /**
   * Devuelve la el numero de frames de un fichero de multimedia, utiliza la libreria ffmpeg-php. 
   *
   * @access public.
   * @param  string file ruta absolute para acceder al archivo.
   * @return integer duration.
   */
  static public function getFrameCountFfmpeg($file){
    if (!file_exists($file)) return 0;
    $movie = new ffmpeg_movie($file);
    if (!$movie){
      return 0;
    }
    //echo $movie->getFrameCount();
    return intval($movie->getFrameCount());
  }



  /**
   * Devuelve la duracion de un fichero de multimedia, utiliza la libreria getid3. 
   *
   * @access public.
   * @param  string file ruta absolute para acceder al archivo.
   * @return integer duration.
   */
  static public function getDurationGetId3($file){
    if (!file_exists($file)) return 0;
    $getid3 = new getid3();
    $getid3->encoding = 'UTF-8';
    $getid3->Analyze($file);
    
    if(!strstr($getid3->info['mime_type'], 'video/') && !strstr($getid3->info['mime_type'], 'audio/')){
      throw new Exception('No multimedia file to get duration');
    }
    return intval($getid3->info['playtime_seconds']);
  }

  /**
   * Utilizando la libreria ffmpeg_php se genera un Pic que se asocia con el objeto
   * multimedia al que pertenece el archivo.
   *
   * @access public
   * @param String $file.
   * @param integer $frame numero del frame donde se realiza la captura.
   * @return Object Maga
   */
  static public function createPic($file, $frame = 25)
  {
    $movie = new ffmpeg_movie($file, false);
    if (!$movie) return null;
    $frame = $movie->getFrame($frame);
    if (!$frame) return null;
    $frame->resize(sfConfig::get('app_thumbnail_hor'), sfConfig::get('app_thumbnail_ver'));
    return $frame->toGDImage();

    //imagejpeg($frame->toGDImage(), $absCurrentDir .'/' . $fileName);
  }


  /**
   *
   *
   */
  static public function getDurationString($duration)
  {
    $min =  floor($duration / 60);

    $seg = $duration %60;
    if ($seg < 10 ) $seg = '0' . $seg;
    
    if ($min == 0 ) $aux = $seg . "''";
    else $aux = $min . "' ". $seg ."''";

    return $aux;
  }

  /**
   *
   * Devuelve false 
   *
   */
  static public function isAudio($path)
  {
    return ((strpos(mime_content_type($path),"audio") === false)?false : true);
  }
}
