<?php

/**
 * Serial (class)
 *
 * Clase que representa una entrada en la
 * tabla 'serial'.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class Serial extends BaseSerial
{

  /**
   * Devuelve el id de difusion maximo y minimo de los objetos multimedia pertenecientes a la serie.
   * el valor devuelto es un array asociativo.
   *
   * @access public
   * @return array
   */
  public function getMmStatus()
  {
    $conexion = Propel::getConnection();
    $consulta = 'SELECT MAX(%s) AS max, MIN(%s) as min FROM %s WHERE %s=%s';
    $consulta = sprintf($consulta, MmPeer::STATUS_ID, MmPeer::STATUS_ID, MmPeer::TABLE_NAME, MmPeer::SERIAL_ID, $this->getId());
    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    $resultset->next();
    return array('max' => $resultset->getInt('max'), 'min' => $resultset->getInt('min'));    
  }


  /**
   * Devuelve verdadero si existe un objeto multimedia visible, ya este 
   * oculto, el la mediateca o en arca.
   *
   * @access public
   * @return boolean
   */
  public function isWorking()
  {
    $aux = $this->getMmStatus();
    return ($aux['min'] != MmPeer::STATUS_NORMAL);
  }


  /**
   * Devuelve el objeto difusion maximo de los objetos multimedia pertenecientes a la serie.
   * El valor maximo es el que describe la difucion que tiene la serie.
   *
   * @access public
   * @return array
   */
  public function getBroadcastMax()
  {
    $c = new Criteria();
    $c->addJoin(BroadcastPeer::ID, MmPeer::BROADCAST_ID);
    $c->add(MmPeer::SERIAL_ID, $this->getId());
    $c->add(MmPeer::STATUS_ID, MmPeer::STATUS_NORMAL);
    $c->addDescendingOrderByColumn(BroadcastPeer::BROADCAST_TYPE_ID);
      
    return BroadcastPeer::doSelectOne($c);
  }


  /**
   * Devuelve numero de objetos multimedia que dicha serie tiene publicos
   *
   * @access public
   * @return integer
   */
  //UPDATE_15
  //public function countMmsPublic($criteria = null, $distinct = false, $con = null)
  //{
  //  $c = new Criteria();
  //  $c->add(MmPeer::STATUS_ID, 1, Criteria::GREATER_THAN);
  //  /*Ojo broadcast*/
  //  $c->add(MmPeer::SERIAL_ID, $this->getId());
  //  return MmPeer::doCount($c, $distinct, $con);
  //}

  /**
   * Devuelve numero de objetos multimedia que dicha serie tiene publicos
   * Modificado usando el valor MmPeer::STATUS_NORMAL de pumukit 1.7
   *
   * @access public
   * @return integer
   */
  public function countMmsPublic($criteria = null, $distinct = false, $con = null)
  {
    if ($criteria === null) {
      $criteria = new Criteria();
    } 
    elseif ($criteria instanceof Criteria)
    {
      $criteria = clone $criteria;
    }
    $criteria->add(MmPeer::STATUS_ID, MmPeer::STATUS_NORMAL);            
    
    return $this->countMms($criteria);
  }

  /**
   * Devuelve numero de objetos multimedia que dicha serie tiene publicos
   * Modificado usando el valor MmPeer::STATUS_NORMAL de pumukit 1.7
   *
   * @access public
   * @return integer
   */
  public function countMmsPublicPub()
  {
    $c = new Criteria();

    //Pub_channel
    $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, 1);
    $c->add(PubChannelMmPeer::STATUS_ID, 1);
    
    //Broadcast_status
    $c->add(MmPeer::STATUS_ID, MmPeer::STATUS_NORMAL);
    $c->addJoin(SerialPeer::ID, MmPeer::SERIAL_ID);
    
    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
    $c->setDistinct(true);

    return $this->countMms($c);
  }

  /**
   * Genera la segunda linea enriquezida de la serie.
   * Esta segunda linea, si esta vacia en la bbdd,
   * se genera con el lugar donde fue grabado el video.
   *
   * @access public
   * @return String Line2
   */
  public function getLine2Rich()
  {
    $aux = parent::getLine2();
    if ($aux == '') {
      $place = $this->getPlace();
      if($place) $aux = 'Realizado: '.$place->getName();
    }
    return '<strong>' . $aux . '</strong>';
  }


  /**
   * Genera la segunda linea enriquezida de la serie.
   * Esta segunda linea, si esta vacia en la bbdd,
   * se genera con el lugar donde fue grabado el video.
   *
   * @access public
   * @return String Line2
   */
  public function getLine2Basic()
  {
    return $this->getPlace()->getName();
  }


  /**
   * Devuleve el nombre de la tabla
   *
   * @access public
   * @return String video
   */
  public function hasMmAnnounce()
  {
    $conexion = Propel::getConnection();
    $consulta = 'SELECT MAX(%s) AS max FROM %s WHERE %s=%s';
    $consulta = sprintf($consulta, MmPeer::ANNOUNCE, MmPeer::TABLE_NAME, MmPeer::SERIAL_ID, $this->getId());
    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    $resultset->next();
    return $resultset->getInt('max');
  }


  /**
   * Devuelve el lugar donde fueron grabados los videos
   * suponiendo que todos fueron grabados en el mismo lugar.
   * En caso de que fueses grabados el lugares distintos 
   * devuelve false.
   *
   * @access public
   * @return Precinct
   * 
   * @internal OJO CULTURE
   */
  public function getPrecinct()
  {
    if  ($this->isNew()) return false;
    $conexion = Propel::getConnection();
    $consulta = 'SELECT VARIANCE(%s) AS var, AVG(%s) AS avg  FROM %s WHERE %s=%s ';
    $consulta = sprintf($consulta, MmPeer::PRECINCT_ID, MmPeer::PRECINCT_ID, MmPeer::TABLE_NAME, MmPeer::SERIAL_ID, $this->getId() );
    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    $resultset->next();
    $precinct_id = $resultset->getInt('avg');
    
    if ($resultset->getFloat('var') === 0.0){
      //Usar hydrate
      $c = new Criteria();
      $c->add(PrecinctPeer::ID, $precinct_id);
      list($resp) = PrecinctPeer::doSelectWithI18n($c, $this->getCulture());
    }else{
      $resp = false;
    }
    
    return $resp;
  }
  
  
  
  /**
   * Devuelve verdadero si la serie tiene un objeto multimedia grabado el en id que se indica
   *
   * @access    public
   * @parameter integer $place_id
   * @return    boolean
   */
  public function hasPlace($place_id)
  {
    if  ($this->isNew()) return false;
    $c = new Criteria();
    $c->addJoin(SerialPeer::ID, MmPeer::SERIAL_ID);
    $c->addJoin(MmPeer::PRECINCT_ID, PrecinctPeer::ID);
    $c->add(PrecinctPeer::PLACE_ID, $place_id);
    $c->add(SerialPeer::ID, $this->getId());
  
    return (SerialPeer::doCount($c) != 0);
  }


  /**
   * Devuelve un array con los lugares donde fueron grabados los videos
   *
   * @access public
   * @return Array Palces
   * 
   */
  public function getPlaces()
  {
    $c = new Criteria();
    $c->setDistinct(true);
    $c->addJoin(PrecinctPeer::PLACE_ID, PlacePeer::ID);
    $c->addJoin(MmPeer::PRECINCT_ID, PrecinctPeer::ID);
    $c->add(MmPeer::SERIAL_ID, $this->getId());

    return PlacePeer::doSelectWithI18n($c, $this->getCulture());
  }

  /**
   * Devuelve el lugar donde fueron grabados los videos
   * suponiendo que todos fueron grabados en el mismo lugar.
   * En caso de que fueses grabados el lugares distintos 
   * devuelve false.
   *
   * @access public
   * @return Place
   * 
   * @internal OJO CULTURE
   */
  public function getPlace()
  {
    if  ($this->isNew()) return false;
    $conexion = Propel::getConnection();
    $consulta = 'SELECT VARIANCE(%s) AS var, AVG(%s) AS avg  FROM %s, %s WHERE %s=%s AND %s=%s';
    $consulta = sprintf($consulta, PrecinctPeer::PLACE_ID, PrecinctPeer::PLACE_ID, PrecinctPeer::TABLE_NAME, MmPeer::TABLE_NAME, PrecinctPeer::ID, MmPeer::PRECINCT_ID, MmPeer::SERIAL_ID, $this->getId() );
    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    $resultset->next();
    $place_id = $resultset->getInt('avg');
    
    if ($resultset->getFloat('var') === 0.0){
      //Usar hydrate
      $c = new Criteria();
      $c->add(PlacePeer::ID, $place_id);
      list($resp) = PlacePeer::doSelectWithI18n($c, $this->getCulture());
    }else{
      $resp = false;
    }

    return $resp;
  }


  /**
   * Devuelve la lista de  Objeto area
   * de conocimento que identifican
   * el video (ResulSet od Ground)
   *
   * @access public
   * @return ResulSet of Ground.
   */
  public function getGroundsWithI18n($ground_type = 0)
  {
    $c = new Criteria();
    $c->setDistinct(true);
    $c->addJoin(GroundPeer::ID, GroundMmPeer::GROUND_ID);
    $c->addJoin(GroundMmPeer::MM_ID, MmPeer::ID);
    $c->add(MmPeer::SERIAL_ID, $this->getId());
    $c->addAscendingOrderByColumn(GroundPeer::COD);
    if($ground_type != 0) $c->add(GroundPeer::GROUND_TYPE_ID, $ground_type);

    return GroundPeer::doSelectWithI18n($c, $this->getCulture());
  }

  /**
   * Devuelve la lista de  Objeto area
   * de conocimento que identifican
   * el video (ResulSet od Ground)
   *
   * @access public
   * @return ResulSet of Grounds.
   */
  public function getGrounds($ground_type = 0)
  {
    $c = new Criteria();
    $c->setDistinct(true);
    $c->addJoin(GroundPeer::ID, GroundMmPeer::GROUND_ID);
    $c->addJoin(GroundMmPeer::MM_ID, MmPeer::ID);
    $c->add(MmPeer::SERIAL_ID, $this->getId());
    $c->addAscendingOrderByColumn(GroundPeer::COD);
    if($ground_type != 0) $c->add(GroundPeer::GROUND_TYPE_ID, $ground_type);

    return GroundPeer::doSelect($c);
  }


  /**
   * Devuelve un array con los perfiles que contien el objeto multimedia
   *
   * @access     public
   * @return     array de integer ids de los perfiles
   */
  public function getLanguages()
  {
    $c = new Criteria();
    $c->add(MmPeer::SERIAL_ID, $this->getId());
    $c->addJoin(FilePeer::MM_ID, MmPeer::ID);
    $c->addJoin(FilePeer::LANGUAGE_ID, LanguagePeer::ID);
    $c->setDistinct(true);

    return  LanguagePeer::doSelect($c);
  }
  

  /**
   * Genera un la url relativa de la pagina web de su serie.
   *
   * @access public
   * @return String Url relativa.
   */
  public function getUrl($absolute = false)
  {
    //Hack
    $old = sfConfig::get('sf_no_script_name');
    sfConfig::set('sf_no_script_name', true);
    $controller = sfContext::getInstance()->getController();
    $url = $controller->genUrl(array('module'=> 'serial', 'action' => 'index', 'id' => $this->getId()), $absolute);
    sfConfig::set('sf_no_script_name', $old);
    return $url;
  }

  /**
   * Devuelve una lista los mms desocultos
   * de esa serie. Inicializando la cultura a la cultura
   * de la serie.
   * 
   *
   * @access    public.
   * @param     boolean indica si se ven mm ocultos o no.
   * @return    Precint.
   * 
   * @internal OJO CULTURE OJO PUBLIC?????????
   */
  public function getMmsPublic($all = false)
  {
    $valor = $all?array(MmPeer::STATUS_NORMAL, MmPeer::STATUS_HIDE):array(MmPeer::STATUS_NORMAL);
    $c = new Criteria();
    $c->addAscendingOrderByColumn(MmPeer::RANK);
    $c->add(MmPeer::SERIAL_ID, $this->getId());
    $c->add(MmPeer::STATUS_ID, $valor, Criteria::IN); //Si se muestras mm ocultos.
    return MmPeer::doSelectWithI18n($c, $this->getCulture());
  }



  /**
   * Devuelve una lista los mms desocultos
   * de esa serie. Inicializando la cultura a la cultura
   * de la serie.
   * 
   *
   * @access    public.
   * @param     boolean indica si se ven mm ocultos o no.
   * @return    Precint.
   * 
   * @internal OJO CULTURE OJO PUBLIC?????????
   */
  //UPDATE_15
  //public function getMmsPublicPub($all = false)
  //{
  //  $valor = $all?0:1;
  //  $c = new Criteria();
  //  $c->add(MmPeer::BROADCAST_ID, 1);  //OJO
  //  $c->addAscendingOrderByColumn(MmPeer::RANK);
  //  $c->add(MmPeer::SERIAL_ID, $this->getId());
  //  $c->add(MmPeer::STATUS_ID, $valor, Criteria::GREATER_THAN); //Si se muestras mm ocultos.
  //  return MmPeer::doSelectWithI18n($c, $this->getCulture());
  //}



  /**
   * UPDATE
   * Devuelve una lista los mms de un canal de pub dado.
   * Inicializando la cultura a la cultura
   * de la serie.
   * 
   *
   * @access    public.
   * @param     boolean indica si se ven mm ocultos o no.
   * @return    Precint.
   * @warning   OJO15 al OJO de BROADCAST_ID
   * 
   */
  public function getMmsPubChannel($pub_channel)
  {
    $c = new Criteria();
    $c->add(MmPeer::BROADCAST_ID, 1);  //OJO OJO
    $c->addAscendingOrderByColumn(MmPeer::RANK);
    $c->add(MmPeer::SERIAL_ID, $this->getId());
    //OJO15 PONER SerialPeer::addPubChannelCriteria($c, $pub_channel);
    $c->addJoin(MmPeer::ID, PubChannelMmPeer::MM_ID);
    $c->addJoin(PubChannelMmPeer::PUB_CHANNEL_ID, PubChannelPeer::ID);
    $c->add(PubChannelPeer::NAME, $pub_channel, is_int($pub_channel)?null:Criteria::IN);
    $c->add(MmPeer::STATUS_ID, MmPeer::STATUS_NORMAL);
    return MmPeer::doSelectWithI18n($c, $this->getCulture());
  }



  /**
   * Devuelve una lista los mms ocultos
   * de esa serie. Inicializando la cultura a la cultura
   * de la serie.
   * 
   *
   * @access public
   * @return Precint 
   * 
   * @internal OJO CULTURE OJO PUBLIC ???????????
   */
  //UPDATE_15
  //public function getMmsWorking($criteria = null, $con = null)
  //{
  //  $c = new Criteria();
  //  $c->addAscendingOrderByColumn(MmPeer::RANK);
  //  $c->add(MmPeer::SERIAL_ID, $this->getId());
  //  $c->add(MmPeer::STATUS_ID, 0);
  //  return MmPeer::doSelectWithI18n($c, $this->getCulture());
  //}



  /**
   * Sobrecarga la funcion copy
   *
   * @access public
   */
  public function copy($bool = false)
  {
    $serial2 = new Serial();

    $serial2->setMail($this->getMail());
    $serial2->setCopyright($this->getCopyright());
    $serial2->setSerialTypeId($this->getSerialTypeId());
    $serial2->setPublicDate('now');
    $serial2->setSerialTemplateId($this->getSerialTemplateId());

    $serial2->setAnnounce(false);

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $serial2->setCulture($lang);
      $this->setCulture($lang);
      $serial2->setTitle($this->getTitle());
      $serial2->setSubtitle($this->getSubtitle());
      $serial2->setKeyword($this->getKeyword());
      $serial2->setDescription($this->getDescription());
      $serial2->setHeader($this->getHeader());
      $serial2->setFooter($this->getFooter());
      $serial2->setLine2($this->getLine2());
    }
    $serial2->save();

    $mms = $this->getMms();
    foreach($mms as $mm){
      $mm2 = $mm->copy();
      $mm2->setSerialId($serial2->getId());
      $mm2->setRank($mm->getRank());
      $mm2->save();
    }

    return $serial2;
  }

  public function getTableName()
  {
    return 'serial';
  }

  /**
   * Devuelve el numero de objetos multimedia que poseen dicho perfil.
   *
   * @param integer $perfil_id identificador del perfil
   * @access public
   * @return integer numero de objetos multimedia que tiene ese perfil.
   */
  public function countFileByPerfil($perfil_id){
    $c = new Criteria();
    $c->add(MmPeer::SERIAL_ID, $this->getId());
    $c->addJoin(MmPeer::ID, FilePeer::MM_ID);
    $c->add(FilePeer::PERFIL_ID, $perfil_id, is_int($perfil_id)?null:Criteria::IN);
    
    return MmPeer::doCount($c);
  }

  /**
   * Genera un string con el numero de video de la serie.
   *
   * @access public
   * @return String Duracion
   */
  public function getNumber()
  {
    $aux = $this->countMmsPublic();
    return ($aux . " Vídeo" . ($aux==1?'':'s'));
  }

  public function getSerialId(){
    return $this->getId();
  }

  public function isSerial(){
    return true;
  }

  public function getDefaultPic(){
    return '/images/folder.png';
  }
  public function getSerial(){
    return $this;
  }

  public function getRecordDate($format = 'Y-m-d H:i:s'){
    return $this->getPublicDate($format);
  }

  /**
   * Tiene subtitulos
   *
   * @access public
   * @return boolena
   */
  public function hasSubtitles(){
    $c = new Criteria();
    $c->add(MmPeer::SERIAL_ID, $this->getId());
    $c->addJoin(MmPeer::ID, FilePeer::MM_ID);
    $c->add(FilePeer::LANGUAGE_ID, 19);

    return LanguagePeer::doCount($c);
  }



  /**
   * 
   */
  public function hasPubChannel($pub_channel)
  {
    $c = new Criteria();
    $c->add(MmPeer::SERIAL_ID, $this->getId());
    $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
    $c->addJoin(PubChannelMmPeer::PUB_CHANNEL_ID, PubChannelPeer::ID);
    $c->add(PubChannelPeer::NAME, $pub_channel, is_int($pub_channel)?null:Criteria::IN);
    $c->add(PubChannelMmPeer::STATUS_ID, 1);
    $c->add(MmPeer::STATUS_ID, MmPeer::STATUS_NORMAL);

    return PubChannelMmPeer::doCount($c, false);
  }


  /**
   *
   * Obtiene las series para iTunes
   *
   */
  public static function getiTunesSerials($broadcast, $search = null, $culture = 'es')
  {  
    $c = new Criteria();
    SerialPeer::addPubChannelCriteria($c, 1);
    SerialPeer::addBroadcastCriteria($c, $broadcast);
    if ($search != null){
      SerialPeer::addSeachCriteria($c, $search , $culture);
    }

    //$c->add(MmPeer::EDITORIAL1, 1);
    

    $c->clearOrderByColumns();
    $c->addDescendingOrderByColumn(MmPeer::RECORDDATE);
    return SerialPeer::doSelectWithI18n($c);
  }

}

/** implementa comportameinto pic */
sfPropelBehavior::add('Serial', array('pic') );