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
  
  static public function getForLuceneQuery($query, $limit = 100)
  {
    $hits = self::getLuceneIndex()->find($query);

    $pks = array();
    foreach ($hits as $hit){
      $pks[] = $hit->pk;
    }
 
    $criteria = new Criteria();
    $criteria->add(self::ID, $pks, Criteria::IN);
    $criteria->setLimit($limit);
 
    return self::doSelect(($criteria));
  }

  /**
   * Devuelve un conjunto de objetos multimedia anunciados
   *
   * @access public
   * @param string $culture, valor por defecto es.
   * @param integer $limit
   * @param array credentials 
   * @return array de Serial y Mm
   */
  static public function getAnnounces($culture = 'es', $limit = 0, $credentials = array('pub', 'cor'), $genre = null, $anounce=true){
    
    $limitSQL = '';
    if ($limit != 0) $limitSQL = (' limit ' . $limit);

    $conexion = Propel::getConnection();
    if($anounce) {
      $consulta = "(SELECT 'mm' AS info, mm.id, recorddate FROM mm, broadcast, broadcast_type, pub_channel_mm WHERE mm.status_id = 0 "
        ."AND pub_channel_mm.mm_id=mm.id "
        ."AND pub_channel_mm.pub_channel_id = 1 "
        ."AND pub_channel_mm.status_id = 1 "
	."AND mm.announce=true AND mm.broadcast_id = broadcast.id "
	.($genre == null?"":"AND mm.genre_id = " . $genre) . " "
	."AND broadcast.broadcast_type_id=broadcast_type.id AND broadcast_type.name IN %s) ORDER BY recorddate DESC, id DESC" . $limitSQL;
    }else {
      $consulta = "(SELECT 'mm' AS info, mm.id, recorddate FROM mm, broadcast, broadcast_type, pub_channel_mm WHERE mm.status_id = 0 "
        ."AND pub_channel_mm.mm_id=mm.id "
        ."AND pub_channel_mm.pub_channel_id = 1 "
        ."AND pub_channel_mm.status_id = 1 "
	."AND mm.broadcast_id = broadcast.id "
	.($genre == null?"":"AND mm.genre_id = " . $genre) . " "
	."AND broadcast.broadcast_type_id=broadcast_type.id AND broadcast_type.name IN %s) ORDER BY recorddate DESC, id DESC" . $limitSQL;
    }

    $credentials = array_map(create_function('$a', 'return "\"" . $a . "\"";'), $credentials);
    $cr = "(" . implode(", ", $credentials) . ")";
    $consulta = sprintf($consulta, $cr, $cr);

    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    
    $volver = array();
    
    while ($resultset->next()){
      if ($resultset->getString('info') == 'mm'){
	//hydrate
	$aux = MmPeer::retrieveByPkWithI18n($resultset->getInt('id'), $culture);
	//$c = new Criteria();
	//$c->add(MmPeer::ID, $resultset->getInt('id'));
	//list($aux) = MmPeer::doSelectWithI18n($c, $culture);
      }
      $volver[]= $aux;
    }
    return $volver;
  }


  /**
   * Devuelve un conjunto de objetos multimedia anunciados en un rango de un mes
   *
   * @access public
   * @param DateTime $date_new valor del primer dia del rango
   * @param string $culture, valor por defecto es.
   * @param array credentials 
   */
  static public function getAnnouncesByDate($date_new, $culture = 'es', $credentials = array('pub', 'cor'), $anounce=false){

    $date = $date_new;
    $aux_date = strtotime($date_new);

    $date_new = date("Y/m/d", $aux_date);

    $next_month = strtotime('+1 month', $aux_date);

    $next_date = date('Y/m/d', $next_month);


    $conexion = Propel::getConnection();
    if($anounce) {
      $consulta = "(SELECT 'mm' AS info, mm.id, recorddate FROM mm, broadcast, broadcast_type, pub_channel_mm WHERE mm.status_id = 0 "
        ."AND pub_channel_mm.mm_id=mm.id "
        ."AND pub_channel_mm.pub_channel_id = 1 "
        ."AND pub_channel_mm.status_id = 1 "
	."AND mm.announce=true AND mm.broadcast_id = broadcast.id "
        ."AND mm.recorddate >= '$date' AND mm.recorddate < '$next_date' "
	."AND broadcast.broadcast_type_id=broadcast_type.id AND broadcast_type.name IN %s) ORDER BY recorddate DESC, id DESC";
    }else {
      $consulta = "(SELECT 'mm' AS info, mm.id, recorddate FROM mm, broadcast, broadcast_type, pub_channel_mm WHERE mm.status_id = 0 "
        ."AND pub_channel_mm.mm_id=mm.id "
        ."AND pub_channel_mm.pub_channel_id = 1 "
        ."AND pub_channel_mm.status_id = 1 "
	."AND mm.broadcast_id = broadcast.id "
        ."AND mm.recorddate >= '$date' AND mm.recorddate < '$next_date' "
	."AND broadcast.broadcast_type_id=broadcast_type.id AND broadcast_type.name IN %s) ORDER BY recorddate DESC, id DESC";
    }


    $credentials = array_map(create_function('$a', 'return "\"" . $a . "\"";'), $credentials);
    $cr = "(" . implode(", ", $credentials) . ")";
    $consulta = sprintf($consulta, $cr, $cr);
    
    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    
    $volver = array();
    
    while ($resultset->next()){
      if ($resultset->getString('info') == 'mm'){
        //hydrate
        $aux = MmPeer::retrieveByPkWithI18n($resultset->getInt('id'), $culture);
        //$c = new Criteria();
        //$c->add(MmPeer::ID, $resultset->getInt('id'));
        //list($aux) = MmPeer::doSelectWithI18n($c, $culture);
      }
      $volver[]= $aux;
    }
    return $volver;
  }
  
  /**
   * Performs a faceted search using a lucene (text-only) query and
   * criteria to limit the list.
   */
  static public function getFacetedSearch($unesco, $genre, $only, $duration, $year, $month, $day, $query, $limit = 10, $offset = 0)
  {
    $out = array();
    $c = new Criteria();
    
    self::addBroadcastCriteria($c);
    self::addPubChannelCriteria($c, 1);
    
    // Add lucene text search hits
    if ($query != '' && $query != null && $query != "\n"){   
      $hits = self::getLuceneIndex()->find($query);
      $pks  = array();
      foreach ($hits as $hit){
          $pks[] = $hit->pk;
      }   
      $c->add(self::ID, $pks, Criteria::IN);
    }

    // Add select conditions to criteria
    if ($unesco != 'all' && $unesco != null && $unesco != ''){
      $c->addJoin(CategoryMmPeer::MM_ID, MmPeer::ID);
      $c->addJoin(CategoryMmPeer::CATEGORY_ID, CategoryPeer::ID);
      $c->add(CategoryPeer::COD, $unesco);
    }

    if ($genre != 'all' && $genre != null && $genre != ''){
      $c->add(self::GENRE_ID, $genre);
    }
  
    if ($only == 'audio'){
      $c->add(self::AUDIO, 1);
    
    } else if ($only == 'video'){
      $c->add(self::AUDIO, 0);
    }

    if (($duration = intval($duration)) != 0){
      $duration_sec = 60 * abs($duration);
      $c->add(self::DURATION, $duration_sec, ($duration < 0)?Criteria::LESS_EQUAL:Criteria::GREATER_EQUAL);
    }

    $year_present  = intval($year) != 0;
    $month_present = intval($month) != 0;
    $day_present   = intval($day) != 0;
    if ($year_present || $month_present || $day_present){
      $date_format_string    = ''; // http://dev.mysql.com/doc/refman/5.6/en/date-and-time-functions.html#function_date-format
      $date_requested_string = '';

      if ($year_present){
        $date_format_string    .= '%Y';
        $date_requested_string .= sprintf('%04d', $year);
      }
      if ($month_present){
        $date_format_string    .= '%m'; // two digit month.
        $date_requested_string .= sprintf('%02d', $month); // two digit month
      }
      if ($day_present){
        $date_format_string    .= '%d'; // two digit day
        $date_requested_string .= sprintf('%02d', $day);
      }

      $custom_criteria =' DATE_FORMAT(mm.RECORDDATE, "' . $date_format_string . '") = "' . $date_requested_string . '"';
      $c->add(MmPeer::RECORDDATE, $custom_criteria, Criteria::CUSTOM);
    }

    $c->setDistinct(true);
    
    $c_count = clone($c);
    $out['total'] = self::doCount($c_count);

    $c->setLimit($limit);
    $c->setOffset($offset);
    $c->addDescendingOrderByColumn(MmPeer::RECORDDATE);
    $c->addDescendingOrderByColumn(MmPeer::ID);

    $out['mms'] = self::doSelect($c);
    
    return $out;
  }

  static public function getLuceneIndex()
  {
    //    ProjectConfiguration::registerZend();
    
    if (file_exists($index = self::getLuceneIndexFile()))
      {
	return Zend_Search_Lucene::open($index);
      }
    else
      {
	return Zend_Search_Lucene::create($index);
      }
  }
  
  static public function getLuceneIndexFile()
  {
    return sfConfig::get('sf_data_dir').'/pumukit.index';
  }


  
  public static function doDeleteAll($con = null)
  {
    if (file_exists($index = self::getLuceneIndexFile()))
      {
	sfToolkit::clearDirectory($index);
	rmdir($index);
      }
    
    return parent::doDeleteAll($con);
  }

  /**
   * Optimizacion de doSect para evitar la hifratacion
   *
   * @access public
   * @return array
   */
  public static function doList(Criteria $criteria, $culture = null)
  {
    $mms = array();
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
    $criteria->addSelectColumn(self::DURATION );
    $criteria->addSelectColumn(self::AUDIO );
    $criteria->addSelectColumn(self::SERIAL_ID);
    // Agregamos los Joins entre las distintas tablas
    $criteria->addJoin(self::ID, MmI18nPeer::ID, Criteria::LEFT_JOIN );
    $criteria->addJoin(self::ID, PicMmPeer::OTHER_ID, Criteria::LEFT_JOIN );
    $criteria->addJoin(PicMmPeer::PIC_ID, PicPeer::ID, Criteria::LEFT_JOIN );
    $criteria->addJoin(self::ID, PubChannelMmPeer::MM_ID, Criteria::LEFT_JOIN );
    $criteria->add(MmI18nPeer::CULTURE, $culture );
    $criteria->addGroupByColumn(MmPeer::ID);
    //Recuperamos los registros y generamos el arreglo de hashes
    $rs = self::doSelectRS($criteria);

    while ($rs->next())
      {
        $mm = array();
	$mm['id']          = $rs->getInt(1);
	$mm['status']      = $rs->getInt(2);
	$mm['announce']    = $rs->getBoolean(3);
	$mm['pic_url']     = ($rs->getString(4)?$rs->getString(4):'/images/sin_foto.jpg');
	$mm['title']       = $rs->getString(5);
	$mm['publicdate']  = date('d/m/Y', strtotime($rs->getTimestamp(6)));
	$mm['recorddate']  = date('d/m/Y', strtotime($rs->getTimestamp(7)));
        $mm['has_pub_channel']  = (strlen($rs->getString(8) != 0) ? '1' : '');
        $mm['duration']    = $rs->getInt(9);
        $mm['audio']       = $rs->getBoolean(10);
        $mm['serial_id']    = $rs->getInt(11);
	$mms[] = $mm;
      }
    return $mms;
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
    //$c->setDistinct(true);  //Ralentiza la query al comparar campos de i18n
 
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
   * Crea nuevo obeto multimedia, No se hace save.
   *
   * Observaciones no se comprueba que serial_id exist
   * @access public
   * @return Mm
   */
  static public function createNewMm($serial_id, $title = null)
  {
    $mm_template = MmTemplatePeer::get($serial_id);

    $mm = new Mm();    
    $mm->setSerialId($serial_id);
    //Por defecto los MM estan bloqueados
    $mm->setStatusId(MmPeer::STATUS_BLOQ);

    //METADATOS
    $mm->setPublicdate(date("Y-m-d H:i", mktime(date("H"), date("i"), 0, date("m"),date("d"),date("Y"))));
    $mm->setRecorddate(date("Y-m-d H:i", mktime(date("H"), date("i"), 0, date("m"),date("d"),date("Y"))));
    
    $mm->setSubserial($mm_template->getSubserial());
    $mm->setCopyright($mm_template->getCopyright());
    $mm->setPrecinctId($mm_template->getPrecinctId());
    $mm->setGenreId($mm_template->getGenreId());
    $mm->setBroadcastId($mm_template->getBroadcastId());

    $langs = sfConfig::get('app_lang_array', array('es'));
    foreach($langs as $lang){
      $mm->setCulture($lang);
      $mm_template->setCulture($lang);
      if ($title != null) {
	$mm->setTitle($title);
      }
      else {
	$mm->setTitle($mm_template->getTitle());
      }
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

    //CATEGORIES
    $categories = $mm_template->getCategories();
    foreach($categories as $c){
      $c->addMmId($mm->getId());
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
  static public function doCountPublic($pub_channel = false, $broadcast_and_status = true, $dates = null)
  {
    $c = new Criteria();
  
    if($dates != null){
      $c->add(MmPeer::PUBLICDATE, date("Y-m-01", $dates["end"]), Criteria::LESS_THAN);
      $c->addAnd(MmPeer::PUBLICDATE, date("Y-m-01", $dates["ini"]), Criteria::GREATER_THAN);
    }

    if ($pub_channel){
      $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
      $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, 1);
      $c->add(PubChannelMmPeer::STATUS_ID, 1);
    }
   
    if ($broadcast_and_status){
      $c->add(MmPeer::STATUS_ID, 0);

      $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
      $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
      $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
      $c->setDistinct(true);
    }
    return MmPeer::doCount($c, true);
  }

  /**
   * Cuenta los objetos multimedia publicos, es decir,
   * con su estado mayor que 1
   *
   * @access public
   * @return integer
   */
  //UPDATE 15
  static public function doCountVideoPublic($pub_channel = false, $broadcast_and_status = true, $dates = null)
  {
    $c = new Criteria();
  
    if($dates != null){
      $c->add(MmPeer::PUBLICDATE, date("Y-m-01", $dates["end"]), Criteria::LESS_THAN);
      $c->addAnd(MmPeer::PUBLICDATE, date("Y-m-01", $dates["ini"]), Criteria::GREATER_THAN);
    }

    if ($pub_channel){
      $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
      $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, 1);
      $c->add(PubChannelMmPeer::STATUS_ID, 1);
    }

    $c->add(self::AUDIO, 0);
      
    if ($broadcast_and_status){
      $c->add(MmPeer::STATUS_ID, 0);
      
      $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
      $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
      $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
      $c->setDistinct(true);
    }
    return MmPeer::doCount($c, true);
  }

  /**
   * Cuenta los objetos multimedia publicos, es decir,
   * con su estado mayor que 1
   *
   * @access public
   * @return integer
   */
  //UPDATE 15
  static public function doCountAudioPublic($pub_channel = false, $broadcast_and_status = true, $dates = null)
  {
    $c = new Criteria();
  
    if($dates != null){
      $c->add(MmPeer::PUBLICDATE, date("Y-m-01", $dates["end"]), Criteria::LESS_THAN);
      $c->addAnd(MmPeer::PUBLICDATE, date("Y-m-01", $dates["ini"]), Criteria::GREATER_THAN);
    }

    if ($pub_channel){
      $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
      $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, 1);
      $c->add(PubChannelMmPeer::STATUS_ID, 1);
    }
   
    $c->add(self::AUDIO, 1);

    if ($broadcast_and_status){
      $c->add(MmPeer::STATUS_ID, 0);

      $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
      $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
      $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
      $c->setDistinct(true);
    }
    return MmPeer::doCount($c, true);
  }


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
   * Modifica criteria para que realice la busqueda en objetos multimedia no ocultos.
   *
   * @access     public
   * @param      Criteria object.
   */
  public static function addPubChannelCriteria(Criteria $c, $pub_channel)
  {
    $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, $pub_channel, is_int($pub_channel)?null:Criteria::IN);
    $c->add(PubChannelMmPeer::STATUS_ID, 1);

    $c->add(MmPeer::STATUS_ID, MmPeer::STATUS_NORMAL);
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

  public static function getStatusText($status_id){
    $aux = array(
		 0 => 'Publicado',
		 1 => 'Bloqueado', 
		 2 => 'Oculto',
    );

    return $aux[$status_id];
  }
}
