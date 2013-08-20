<?php

/**
 * Subclass for representing a row from the 'mm_matterhorn' table.
 *
 * 
 *
 * @package lib.model
 */ 
class MmMatterhorn extends BaseMmMatterhorn
{

  private $manifest = null;

  /**
   *
   */
  public function getUrl(){
    $invert = $this->getInvert()?"&display=invert":"";
    return str_replace('%id%', $this->getMhId(), $this->getPlayerUrl()) . $invert;
  }


  public function getIframeUrl($broadcast_type = 'pub'){
    if($broadcast_type == 'pub'){
      $url_player = 'cmarwatch.html';
    }else{
      $url_player = 'securitywatch.html';
    }

    $invert = $this->getInvert()?"&display=invert":"";

    return str_replace(array('%id%', 'watch.html'), array($this->getMhId(), $url_player), $this->getPlayerUrl()) . $invert;
  }


  /**
   *
   */
  public function getMasterUrl($cookie = null){
    return $this->getTrackUrlByType("presenter/master", $cookie);
  }

  /**
   *
   */
  public function getTrackUrlByType($trackType, $cookie = null){
    $manifest = $this->getManifest($cookie);

    foreach($manifest["media"]["track"] as $track){
      if($track["type"] == $trackType){
	return $track["url"];
      }
    }
  }



  /**
   *
   */
  public function getMasterFile($cookie = null){
    return $this->getTrackFileByType("presenter/master", $cookie);
  }


  /**
   *
   */
  public function getTrackFileByType($trackType, $cookie = null){
    $manifest = $this->getManifest($cookie);
    
    foreach($manifest["media"]["track"] as $track){
      if($track["type"] == $trackType){
	$ret =  $track["url"];
	foreach(StreamserverPeer::doSelect(new Criteria()) as $server) {
	  $ret = str_replace($server->getUrlOut(), $server->getDirOut(), $ret);
	}
	return $ret;
      }
    }
  }

  /**
   *
   */
  public function getManifest($cookie = null){
    

    if ($this->manifest != null){
      return $this->manifest;
    }

    $server = sfConfig::get('app_matterhorn_server');
    # server_admin and workflow_endpoint are used to retrieve information
    # from "workflow" instead of "search"
    # old url example: http://mh-engage.campusdomar.es/search/episode.xml?id=29676
    # new url example: http://admin.matterhorn.uvigo.es/workflow/instances.xml?mp=29676&state=SUCCEEDED&sort=DATE_CREATED_DESC
    
    # "search" returns media package id's but workflow must be queried for 
    # "?mp=" (media package)
    
    $server_admin = sfConfig::get('app_matterhorn_server_admin');
    $user         = sfConfig::get('app_matterhorn_user');
    $password     = sfConfig::get('app_matterhorn_password');

    // $search_endpoint   = '/search/episode.json';
    $workflow_endpoint = '/workflow/instances.json';
    $workflow_filter   = '&state=SUCCEEDED&sort=DATE_CREATED_DESC';
    
    $cookie = MmMatterhornPeer::getCookie($server_admin, $user, $password);
    $ch = curl_init($server_admin . $workflow_endpoint . "?mp=" . $this->getMhId() . $workflow_filter); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if ($cookie != null) {
      curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    }
 
    $var    = curl_exec($ch); 
    $error  = curl_error($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if ($status !== 200) return false;
    //FIXME capturar si falla.
    
    $aux = json_decode(utf8_encode($var), true);
    
    // Old manifest parsed from search page
    // $this->manifest =  $aux['search-results']['result']["mediapackage"];

    $this->manifest =  $aux['workflows']['workflow']["mediapackage"];
    return $this->manifest;
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
  public function retranscoding($priority = 2, $user_email = 0, $force = false){
    
    //TODO.
    $profile = PerfilPeer::retrieveByPK(16);
    $trans = TranscodingPeer::getTranscodingsFromMmAndPerfil($this->getId(), $profile->getId());

    if((!is_null($trans))&&(!$force)){
      return $trans;
    }

    $trans = new Transcoding();
    $trans->setPerfilId($profile->getId());
    $trans->setStatusId(1);

    $trans->setPriority($priority);  

    $trans->setTimeini('now');
    $trans->setMmId($this->getMm()->getId());

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $l){
      $trans->setCulture($l);
      $trans->setDescription("Matterhon composition");
    }

    $trans->setName("Matterhon composition");
    $trans->setLanguage($this->getLanguage());
    
    $trans->setPid(0);

    if($user_email !== 0){
      $trans->setEmail($user_email);
    }

    $trans->save();      //Necesario para setPathAuto

    $trans->setDuration($this->getDuration());
    //$trans->setPathsAuto($this->getFile());
    //$trans->setUrl($trans->getPathEnd());

    $extension_final = $profile->getExtension();

    $dir_temp = $profile->getDirOut() . '/' . $this->getMm()->getSerialId();
    @mkdir($dir_temp, 0777, true);
    

    $aux = $dir_temp.'/MH_'.$this->getId().'.'.$extension_final; //UNO

    $trans->setPathEnd($aux);
    $trans->setUrl($aux);
    $trans->setExtEnd($extension_final);

    $trans->save();      
    TranscodingPeer::execNext();   
    
    return $trans;
  }


}
