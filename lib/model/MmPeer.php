<?php

/**
 * MmPeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'mm', sobre la tabla de Objetos
 * multimedia
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class MmPeer extends BaseMmPeer
{

  /**
   *
   * Diferentes valores para estado
   *
   */
  const STATUS_NORMAL = 0;	
  const STATUS_BLOQ = 1;
  const STATUS_HIDE = 2;


  /**
   * Optimizacion de doSect para evitar la hifratacion
   *
   * @access public
   * @return array
   */
  public static function doList(Criteria $criteria, $culture = null)
  {
    $serials = array();
    // Clonamos el objeto, para evitar modificar el objeto original
    $criteria = clone $criteria;
    // Eliminanos las columnas de selección en caso de que esten definidas
    $criteria->clearSelectColumns();
    // Agregamos las columnas de las tablas que queremos recuperar
    $criteria->addSelectColumn(self::ID );
    $criteria->addSelectColumn(self::STATUS_ID);
    $criteria->addSelectColumn(self::ANNOUNCE );
    $criteria->addSelectColumn(PicPeer::URL );
    $criteria->addSelectColumn(MmI18nPeer::TITLE );
    $criteria->addSelectColumn(self::PUBLICDATE );
    $criteria->addSelectColumn(self::RECORDDATE );
    $criteria->addSelectColumn(PubChannelMmPeer::PUB_CHANNEL_ID);
    // Agregamos los Joins entre las distintas tablas
    $criteria->addJoin(self::ID, MmI18nPeer::ID, Criteria::LEFT_JOIN );
    $criteria->addJoin(self::ID, PicMmPeer::OTHER_ID, Criteria::LEFT_JOIN );
    $criteria->addJoin(PicMmPeer::PIC_ID, PicPeer::ID, Criteria::LEFT_JOIN );
    $criteria->addJoin(self::ID, PubChannelMmPeer::MM_ID, Criteria::LEFT_JOIN );
    $criteria->add(SerialI18nPeer::CULTURE, $culture );
    $criteria->addGroupByColumn(MmPeer::ID);
    //Recuperamos los registros y generamos el arreglo de hashes
    $rs = self::doSelectRS($criteria);
    while ($rs->next())
      {
	$serial['id']          = $rs->getInt(1);
	$serial['status']     = $rs->getInt(2);
	$serial['announce']    = $rs->getBoolean(3);
	$serial['pic_url']     = ($rs->getString(4)?$rs->getString(4):'/images/sin_foto.jpg');
	$serial['title']       = $rs->getString(5);
	$serial['publicdate']  = date('d/m/Y', strtotime($rs->getTimestamp(6)));
	$serial['recorddate']  = date('d/m/Y', strtotime($rs->getTimestamp(7)));
        $serial['has_pub_channel']  = (strlen($rs->getString(8) != 0) ? '1' : '');
	$serials[] = $serial;
      }
    return $serials;
  }

  /**
   * Devuelve un lista de los videos
   * mas vistos. (ResultSet of Video)
   *
   *
   * @access public
   * @param string $culture
   * @param integer $dias define el periodo para realizar la busqueda de mas vistos
   * @param int $cuantos numero de video
   * @return int numero de Video
   *
   * @internal falta CULTURE.
   */
  //UPDATE 15 OJO15 poner mas visto en PubChannelPeer
  static public function masVistos($culture, $dias = 0, $cuantos = 3)
  {
    $c = new Criteria();

    $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, 1);
    $c->add(PubChannelMmPeer::STATUS_ID, 1);
    $c->add(MmPeer::STATUS_ID, 0);

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
    $c->setDistinct(true);
 
    $c->addJOIN(FilePeer::ID, LogFilePeer::FILE_ID);
    $c->addJOIN(FilePeer::MM_ID, MmPeer::ID );
    $c->addGroupByColumn(LogFilePeer::FILE_ID);
    $c->addAsColumn('count', 'count('. LogFilePeer::CREATED_AT .')');
    $c->addDescendingOrderByColumn('count');
  
    if($cuantos != 0) $c->setLimit($cuantos);
    if($dias != 0) $c->add(LogFilePeer::CREATED_AT,LogFilePeer::CREATED_AT . " >= DATE_SUB(CURDATE(),INTERVAL ".(int)$dias." DAY)", Criteria::CUSTOM);
  
    return MmPeer::doSelectWithI18n($c, $culture);
  }



  /**
   * Crea nuevo obeto multimedia 
   *
   * Observaciones no se comprueba que serial_id exist
   * @access public
   * @return Mm
   */
  static public function createNewMm($serial_id)
  {
    $mm_template = MmTemplatePeer::get($serial_id);

    $mm = new Mm();    
    $mm->setSerialId($serial_id);
    //Por defecto los MM estan bloqueados
    $mm->setStatusId(MmPeer::STATUS_BLOQ);

    //METADATOS
    $mm->setPublicdate($mm_template->getPublicdate());
    $mm->setRecorddate($mm_template->getRecorddate());
    
    $mm->setSubserial($mm_template->getSubserial());
    $mm->setCopyright($mm_template->getCopyright());
    $mm->setPrecinctId($mm_template->getPrecinctId());
    $mm->setGenreId($mm_template->getGenreId());
    $mm->setBroadcastId($mm_template->getBroadcastId());

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $mm->setCulture($lang);
      $mm_template->setCulture($lang);
      $mm->setTitle($mm_template->getTitle());
      $mm->setSubtitle($mm_template->getSubtitle());
      $mm->setKeyword($mm_template->getKeyword());
      $mm->setDescription($mm_template->getDescription());
      $mm->setLine2($mm_template->getLine2());
      $mm->setSubserialTitle($mm_template->getSubserialTitle());
    }

    return $mm;
  }


  /**
   * Crea nuevo Obeto multimedia inicializando valores
   *
   * Observaciones no se comprueba que serial_id exist
   * @access public
   * @return Mm
   */
  static public function createNew($serial_id)
  {
    $mm_template = MmTemplatePeer::get($serial_id);

    $mm = self::createNewMm($serial_id);
    $mm->save();
    
    //GROUNDS
    $grounds = $mm_template->getGrounds();
    foreach($grounds as $g){
      $mm->setGroundId($g->getId());
    }

    //PERSONAS
    $roles = RolePeer::doSelect(new Criteria());
    foreach($roles as $r){
      $persons = $mm_template->getPersons($r->getId());
      foreach($persons as $p){
	$aux = new MmPerson();
	$aux->setMmId($mm->getId());
	$aux->setRoleId($r->getId());
	$aux->setPersonId($p->getId());
	try{
	  $aux->save();
	}catch(Exception $e){
	} 
      }
    }

    return $mm;
  }


  /**
   * Cuenta los objetos multimedia publicos, es decir,
   * con su estado mayor que 1
   *
   * @access public
   * @return integer
   */
  //UPDATE 15
  //static public function doCountPublic($dates = null)
  //{
  //  $c = new Criteria();
  //
  //  if($dates != null){
  //    $c->add(MmPeer::PUBLICDATE, date("Y-m-01", $dates["end"]), Criteria::LESS_THAN);
  //    $c->addAnd(MmPeer::PUBLICDATE, date("Y-m-01", $dates["ini"]), Criteria::GREATER_THAN);
  //  }
  //  
  //  $c->add(MmPeer::STATUS_ID, 1, Criteria::GREATER_THAN);
  //
  //  return MmPeer::doCount($c, true);
  //}


  /**
   * Modifica criteria para que realice un filtrado en funcion de la
   * cadena search.
   *
   * @access     public
   * @param      Criteria object.
   * @parem      String search
   */
  //UPDATE 15
  //public static function addSeachCriteria(Criteria $c, $search, $culture)
  //{
  //  //falta string split.
  //  $crit0 = $c->getNewCriterion(MmI18nPeer::TITLE, '%' . $search. '%', Criteria::LIKE);
  //  $crit1 = $c->getNewCriterion(PersonPeer::NAME,  '%' . $search. '%', Criteria::LIKE);
  //  $crit2 = $c->getNewCriterion(MmI18nPeer::KEYWORD, '%' . $search. '%', Criteria::LIKE);
  //
  //  $crit0->addOr($crit1)->addOr($crit2);
  //
  //  $display0 = $c->getNewCriterion(RolePeer::DISPLAY, true);
  //  $display1 = $c->getNewCriterion(RolePeer::DISPLAY, null, Criteria::ISNULL);
  //  $display0->addOr($display1);
  //
  //  $crit0->addAnd($display0);
  //  $c->add($crit0);
  //
  //  $c->add(MmI18nPeer::CULTURE, $culture);
  //  $c->add(SerialI18nPeer::CULTURE, $culture);
  //  $c->addJoin(SerialPeer::ID, MmPeer::SERIAL_ID);
  //  $c->addJoin(SerialPeer::ID, SerialI18nPeer::ID);
  //  $c->addJoin(MmPeer::ID, MmI18nPeer::ID);
  //  $c->addJoin(MmPeer::ID, MmPersonPeer::MM_ID, Criteria::LEFT_JOIN);
  //  $c->addJoin(MmPersonPeer::PERSON_ID, PersonPeer::ID, Criteria::LEFT_JOIN);
  //  $c->addJoin(MmPersonPeer::ROLE_ID, RolePeer::ID, Criteria::LEFT_JOIN);
  //  
  //  $c->add(MmPeer::STATUS_ID, 1, Criteria::GREATER_THAN); 
  //  
  //  $c->setDistinct(true);
  //}


  /**
   * Modifica criteria para que realice la busqueda en objetos multimedia no ocultos.
   *
   * @access     public
   * @param      Criteria object.
   */
  public static function addPublicCriteria(Criteria $c)
  {
    $c->add(MmPeer::STATUS_ID, 0);
  }


  /**
   * Modifica criteria para que realice la busqueda en objetos multimedia no ocultos.
   *
   * @access     public
   * @param      Criteria object.
   */
  public static function addBroadcastCriteria(Criteria $c, $credentials = array('pub', 'cor'))
  {
    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, $credentials, Criteria::IN);
    $c->setDistinct(true);
  }


  /**
   * Devuelve un ResulSet de objetos Serial, que no estan ocultos y son publicos.
   *
   * @access     public
   * @param      Criteria object.
   * @param      string $culture
   * @param      array $credentials 
   */
  public static function doSelectPublicWithI18n(Criteria $c, $culture = null, $credentials = array('pub', 'cor'))
  {
    self::addBroadcastCriteria($c, $credentials);
    self::addPublicCriteria($c);
    $c->setDistinct(true);
    return self::doSelectWithI18n($c, $culture);
  }

  /**
   * Devuelve un objeto Mm que possea la url dada como parametro de entrada
   *
   * @access     public
   * @param      string $url
   * @param      string $culture
   */
  public static function retrieveByUrl($url, $culture = null)
  {
    $c = new Criteria();
    $c->add(FilePeer::URL, '%'. $url, Criteria::LIKE);
    $c->addJoin(MmPeer::ID, FilePeer::MM_ID);
    return MmPeer::doSelectOne($c);
  }

  /**
   *
   */
  public static function addPubChannelCriteria(Criteria $c, $pub_channel)
  {
    $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
    $c->addJoin(PubChannelMmPeer::PUB_CHANNEL_ID, PubChannelPeer::ID);
    $c->add(PubChannelPeer::NAME, $pub_channel, is_int($pub_channel)?null:Criteria::IN);

    $c->add(MmPeer::STATUS_ID, MmPeer::STATUS_NORMAL);
    $c->setDistinct(true);
  }
}
