<?php

/**
 * SerialPeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'serial'. 
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class SerialPeer extends BaseSerialPeer
{

  /**
   * Funcion que optimiza el doSelect evitando el hidrate. Utilizado al listar las series.
   * """select serial.id, serial_i18n.title, pic_serial.serial_id, pic_serial.pic_id, pic.id, pic.url, 
   *    count(video.id), max(video.announce) from serial left join serial_i18n on serial.id = serial_i18n.id 
   *    left join video on serial.id = video.serial_id left join pic_serial on serial.id = pic_serial.serial_id 
   *    left join pic on pic_serial.pic_id = pic.id  where serial_i18n.culture = 'es' 
   *    group by serial.id limit 11\G"""
   *
   * @access public
   * @param Criteria $criteria
   * @parame string culture
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
    $criteria->addSelectColumn('min(mm.status_id)');
    $criteria->addSelectColumn('max(mm.status_id)');
    $criteria->addSelectColumn(self::ANNOUNCE );
    $criteria->addSelectColumn('max(mm.announce)');
    $criteria->addSelectColumn(PicPeer::URL );
    $criteria->addSelectColumn(SerialI18nPeer::TITLE );
    $criteria->addSelectColumn(self::PUBLICDATE );
    $criteria->addSelectColumn('count(distinct mm.id) as num_videos' );
    $criteria->addSelectColumn(self::DISPLAY);
    // Agregamos los Joins entre las distintas tablas
    $criteria->addJoin(self::ID, SerialI18nPeer::ID, Criteria::LEFT_JOIN );
    $criteria->addJoin(self::ID, MmPeer::SERIAL_ID, Criteria::LEFT_JOIN );
    $criteria->addJoin(self::ID, PicSerialPeer::OTHER_ID, Criteria::LEFT_JOIN );
    $criteria->addJoin(PicSerialPeer::PIC_ID, PicPeer::ID, Criteria::LEFT_JOIN );
    $criteria->add(SerialI18nPeer::CULTURE, $culture );
    $criteria->addGroupByColumn(SerialPeer::ID);
    //Recuperamos los registros y generamos el arreglo de hashes
    $criteria->addAscendingOrderByColumn(PicSerialPeer::RANK);
    $rs = self::doSelectRS($criteria);
    while ($rs->next())
      {
	$serial['id']            = $rs->getInt(1);
	$serial['mm_status_min'] = $rs->getInt(2);
	$serial['mm_status_max'] = $rs->getInt(3);
	$serial['announce']      = $rs->getBoolean(4);
	$serial['mm_announce']   = $rs->getBoolean(5);
	$serial['pic_url']       = ($rs->getString(6)?$rs->getString(6):'/images/folder.png');
	$serial['title']         = $rs->getString(7);
	$serial['publicdate']    = date('d/m/Y', strtotime($rs->getTimestamp(8)));
	$serial['mm_count']      = $rs->getInt(9);
	$serial['display']      = $rs->getInt(10);
	$serials[] = $serial;
      }
    return $serials;
  }


  /**
   * Devuelve un conjunto de las series y objetos multimedia anunciados
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
      $consulta = "(SELECT 'serial' AS info, serial.id as id ,serial.publicDate as publicDate FROM serial, mm, broadcast, broadcast_type, pub_channel_mm "
	."WHERE mm.serial_id=serial.id AND serial.announce=true AND serial.display=true AND mm.broadcast_id = broadcast.id AND "
        ."pub_channel_mm.mm_id=mm.id "
        ."AND pub_channel_mm.pub_channel_id = 1 "
        ."AND pub_channel_mm.status_id = 1 AND "
	."broadcast.broadcast_type_id=broadcast_type.id "
	.($genre == null?"":"AND mm.genre_id = " . $genre) . " "
	."AND broadcast_type.name IN %s GROUP BY serial.id HAVING min(mm.status_id) = 0) "
	."UNION (SELECT 'mm' AS info, mm.id, publicDate FROM mm, broadcast, broadcast_type, pub_channel_mm WHERE mm.status_id = 0 "
        ."AND pub_channel_mm.mm_id=mm.id "
        ."AND pub_channel_mm.pub_channel_id = 1 "
        ."AND pub_channel_mm.status_id = 1 "
	."AND mm.announce=true AND mm.broadcast_id = broadcast.id "
	.($genre == null?"":"AND mm.genre_id = " . $genre) . " "
	."AND broadcast.broadcast_type_id=broadcast_type.id AND broadcast_type.name IN %s) ORDER BY publicDate DESC, id DESC" . $limitSQL;
    } else {
      $consulta = "(SELECT 'serial' AS info, serial.id as id ,serial.publicDate as publicDate FROM serial, mm, broadcast, broadcast_type, pub_channel_mm "
	."WHERE mm.serial_id=serial.id AND mm.broadcast_id = broadcast.id AND "
        ."pub_channel_mm.mm_id=mm.id "
        ."AND pub_channel_mm.pub_channel_id = 1 "
        ."AND pub_channel_mm.status_id = 1 AND "
	."broadcast.broadcast_type_id=broadcast_type.id "
	.($genre == null?"":"AND mm.genre_id = " . $genre) . " "
	."AND broadcast_type.name IN %s GROUP BY serial.id HAVING min(mm.status_id) = 0) "
	."UNION (SELECT 'mm' AS info, mm.id, publicDate FROM mm, broadcast, broadcast_type, pub_channel_mm WHERE mm.status_id = 0 "
        ."AND pub_channel_mm.mm_id=mm.id "
        ."AND pub_channel_mm.pub_channel_id = 1 "
        ."AND pub_channel_mm.status_id = 1 "
	."AND mm.broadcast_id = broadcast.id "
	.($genre == null?"":"AND mm.genre_id = " . $genre) . " "
	."AND broadcast.broadcast_type_id=broadcast_type.id AND broadcast_type.name IN %s) ORDER BY publicDate DESC, id DESC" . $limitSQL;
    }

    $credentials = array_map(create_function('$a', 'return "\"" . $a . "\"";'), $credentials);
    $cr = "(" . implode(", ", $credentials) . ")";
    $consulta = sprintf($consulta, $cr, $cr);

    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    
    $volver = array();
    
    while ($resultset->next()){
      if ($resultset->getString('info') == 'serial'){
	//hydrate
	$aux = SerialPeer::retrieveByPkWithI18n($resultset->getInt('id'), $culture);
	//$c = new Criteria();
        //$c->add(SerialPeer::ID, $resultset->getInt('id'));
	//list($aux) = SerialPeer::doSelectWithI18n($c, $culture);
      }else{
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
   * Devuelve un conjunto de las series y objetos multimedia anunciados en un rango de un mes
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
      $consulta = "(SELECT 'serial' AS info, serial.id as id ,serial.publicDate as publicDate FROM serial, mm, broadcast, broadcast_type, pub_channel_mm "
	."WHERE mm.serial_id=serial.id AND serial.announce=true AND serial.display=true AND mm.broadcast_id = broadcast.id AND "
        ."pub_channel_mm.mm_id=mm.id "
        ."AND pub_channel_mm.pub_channel_id = 1 "
        ."AND pub_channel_mm.status_id = 1 AND "
	."broadcast.broadcast_type_id=broadcast_type.id "
        ."AND serial.publicDate >= '$date' AND serial.publicDate < '$next_date' "
	."AND broadcast_type.name IN %s GROUP BY serial.id HAVING min(mm.status_id) = 0) "
	."UNION (SELECT 'mm' AS info, mm.id, publicDate FROM mm, broadcast, broadcast_type, pub_channel_mm WHERE mm.status_id = 0 "
        ."AND pub_channel_mm.mm_id=mm.id "
        ."AND pub_channel_mm.pub_channel_id = 1 "
        ."AND pub_channel_mm.status_id = 1 "
	."AND mm.announce=true AND mm.broadcast_id = broadcast.id "
        ."AND mm.publicDate >= '$date' AND mm.publicDate < '$next_date' "
	."AND broadcast.broadcast_type_id=broadcast_type.id AND broadcast_type.name IN %s) ORDER BY publicDate DESC, id DESC";
    }else {
      $consulta = "(SELECT 'serial' AS info, serial.id as id ,serial.publicDate as publicDate FROM serial, mm, broadcast, broadcast_type, pub_channel_mm "
	."WHERE mm.serial_id=serial.id AND mm.broadcast_id = broadcast.id AND "
        ."pub_channel_mm.mm_id=mm.id "
        ."AND pub_channel_mm.pub_channel_id = 1 "
        ."AND pub_channel_mm.status_id = 1 AND "
	."broadcast.broadcast_type_id=broadcast_type.id "
        ."AND serial.publicDate >= '$date' AND serial.publicDate < '$next_date' "
	."AND broadcast_type.name IN %s GROUP BY serial.id HAVING min(mm.status_id) = 0) "
	."UNION (SELECT 'mm' AS info, mm.id, publicDate FROM mm, broadcast, broadcast_type, pub_channel_mm WHERE mm.status_id = 0 "
        ."AND pub_channel_mm.mm_id=mm.id "
        ."AND pub_channel_mm.pub_channel_id = 1 "
        ."AND pub_channel_mm.status_id = 1 "
	."AND mm.broadcast_id = broadcast.id "
        ."AND mm.publicDate >= '$date' AND mm.publicDate < '$next_date' "
	."AND broadcast.broadcast_type_id=broadcast_type.id AND broadcast_type.name IN %s) ORDER BY publicDate DESC, id DESC";
    }


    $credentials = array_map(create_function('$a', 'return "\"" . $a . "\"";'), $credentials);
    $cr = "(" . implode(", ", $credentials) . ")";
    $consulta = sprintf($consulta, $cr, $cr);
    
    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    
    $volver = array();
    
    while ($resultset->next()){
      if ($resultset->getString('info') == 'serial'){
        //hydrate
        $aux = SerialPeer::retrieveByPkWithI18n($resultset->getInt('id'), $culture);
        //$c = new Criteria();
        //$c->add(SerialPeer::ID, $resultset->getInt('id'));
        //list($aux) = SerialPeer::doSelectWithI18n($c, $culture);
      }else{
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
   * Devuelve los ultimos objetos multimedia vistos.
   *
   * @access public
   * @param strng $culture, valor por defecto 'es'
   * @param integer $cuantos, valor por defecto 5
   * @return Resulset Mm
   */
  //UPDATE_15
  //static public function getLast($culture = 'es', $cuantos = 5){
  //  $c = new Criteria();
  //  $c->add(MmPeer::STATUS_ID, 1, Criteria::GREATER_THAN);
  //  $c->addJoin(FilePeer::ID, LogFilePeer::FILE_ID);
  //  $c->addJoin(FilePeer::MM_ID, MmPeer::ID );
  //  $c->addJoin(SerialPeer::ID, MmPeer::SERIAL_ID);
  //  $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID );
  //  $c->add(BroadcastPeer::BROADCAST_TYPE_ID, 1);
  //  $c->addDescendingOrderByColumn(LogFilePeer::CREATED_AT);
  //  $c->setDistinct(true);
  //  $c->setLimit($cuantos);
  //
  //  return MmPeer::doSelectWithI18n($c, $culture);
  //}  


  /**
   * Crea un serie nueva con los valores por defecto, si se desea se inicializa con un objeto multimedia nuevo vacio.
   *
   * @access public
   * @param boolean $with_mm indica si la serie nueva tiene un objeto multimedia nuevo, o esta vacia (def. no vacia)
   * @return Serial
   */
  static public function createNew($with_mm = true, $title = null)
    {
      $serial = new Serial();
      
      $serial->setCopyright(sfConfig::get('app_info_copyright', 'Universidade de Vigo'));
      $serial->setSerialTypeId(SerialTypePeer::getDefaultSelId());
      $serial->setSerialTemplateId(1);
      
      $serial->setPublicdate('now');
      
      $langs = sfConfig::get('app_lang_array', array('es'));
      foreach($langs as $lang){
	$serial->setCulture($lang);
	if ($title != null ) {
	  $serial->setTitle($title);
	}
	else {
	  $serial->setTitle('Nuevo');
	}
      }
      $serial->save();
      
      if ($with_mm) MmPeer::createNew($serial->getId());
      return $serial;
    }


  /**
   * Cuenta las series que tienen videos publicos, es decir,
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
      $c->add(SerialPeer::PUBLICDATE, date("Y-m-01", $dates["end"]), Criteria::LESS_THAN);
      $c->addAnd(SerialPeer::PUBLICDATE, date("Y-m-01", $dates["ini"]), Criteria::GREATER_THAN);
    }
  
    if ($pub_channel){
      $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
      $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, 1);
      $c->add(PubChannelMmPeer::STATUS_ID, 1);
    }

    if ($broadcast_and_status){
      $c->add(MmPeer::STATUS_ID, MmPeer::STATUS_NORMAL);
      $c->addJoin(SerialPeer::ID, MmPeer::SERIAL_ID);

      $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
      $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
      $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
      $c->setDistinct(true);
    }
  
    return SerialPeer::doCount($c, true);   
  }


  /**
   * Modifica criteria para que realice un filtrado en funcion de la
   * cadena search.
   *
   * @access     public
   * @param      Criteria object.
   * @parem      String search
   */
  public static function addSeachCriteria(Criteria $c, $search, $culture)
  {
    //falta string split.
    $crit0 = $c->getNewCriterion(MmI18nPeer::TITLE, '%' . $search. '%', Criteria::LIKE);
    $crit0->addOr($c->getNewCriterion(SerialI18nPeer::KEYWORD, '%' . $search. '%', Criteria::LIKE));
    $crit0->addOr($c->getNewCriterion(SerialI18nPeer::TITLE, '%' . $search. '%', Criteria::LIKE));
  
    $c->add($crit0);
  
    $c->add(MmI18nPeer::CULTURE, $culture);
    $c->add(SerialI18nPeer::CULTURE, $culture);
    $c->addJoin(SerialPeer::ID, MmPeer::SERIAL_ID);
    $c->addJoin(SerialPeer::ID, SerialI18nPeer::ID);
    $c->addJoin(MmPeer::ID, MmI18nPeer::ID);
        
    $c->setDistinct();
  }


  /**
   * Modifica criteria para que realice la busqueda en series no ocultas. Es decir las
   * que tienen un objeto multimedia anunciado
   *
   * @access     public
   * @param      Criteria object.
   */
  //UPDATE 15
  public static function addPublicCriteria(Criteria $c)
  {
    $c->add(MmPeer::STATUS_ID, 0);
    $c->addJoin(SerialPeer::ID, MmPeer::SERIAL_ID);
    $c->setDistinct(true);
  }


  /**
   * Modifica criteria para que realice la busqueda en series de una determinada canal de publicacion.
   *
   * @access     public
   * @param      Criteria object.
   */
  public static function addPubChannelCriteria(Criteria $c, $pub_channel_id)
  {
    $c->addJoin(SerialPeer::ID, MmPeer::SERIAL_ID);
    $c->addJoin(MmPeer::ID, PubChannelMmPeer::MM_ID);
    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, $pub_channel_id);

    $c->add(MmPeer::STATUS_ID, MmPeer::STATUS_NORMAL);


    $c->setDistinct(true);
  }


  /**
   * Modifica criteria para que realice la busqueda en series no ocultas. Es decir las
   * que tienen un objeto multimedia anunciado
   *
   * @access     public
   * @param      Criteria object.
   * @param      array $credentials 
   */
  public static function addBroadcastCriteria(Criteria $c, $credentials = array('pub', 'cor'))
  {
    $c->addJoin(SerialPeer::ID, MmPeer::SERIAL_ID);
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
  public function doSelectPublicWithI18n(Criteria $c, $culture = null, $credentials = array('pub', 'cor'))
  {
    self::addBroadcastCriteria($c, $credentials);
    self::addPublicCriteria($c);
    $c->setDistinct(true);
    return self::doSelectWithI18n($c, $culture);
  }

  /**
   * Devuelve un ResulSet de objetos Serial, que no estan ocultos y son publicos.
   *
   * @access     public
   * @param      Criteria object.
   * @param      string $culture
   * @param      array $credentials
   */

  static public function doSelectByPersonWithI18n(Criteria $c, $person_id, $culture = null)
  {
    $c->addJoin(SerialPeer::ID, MmPeer::SERIAL_ID);
    $c->addJoin(MmPeer::ID, MmPersonPeer::MM_ID);
    $c->add(MmPersonPeer::PERSON_ID, $person_id);
    $c->add(MmPersonPeer::ROLE_ID, 2);

    return self::doSelectWithI18n($c, $culture);
  }

  /**
   * Retrieve a single object by pkey with their i18n objects.
   *
   * @param      mixed $pk the primary key.
   * @param      Connection $con the connection to use
   * @return     Serial
   */
  public static function retrieveByPKByPersonWithI18n($pk, $person_id, $culture = null, $con = null)
  {
    if ($con === null) {
      $con = Propel::getConnection(self::DATABASE_NAME);
    }

    $criteria = new Criteria(SerialPeer::DATABASE_NAME);

    $criteria->add(SerialPeer::ID, $pk);

    $criteria->addJoin(SerialPeer::ID, MmPeer::SERIAL_ID);
    $criteria->addJoin(MmPeer::ID, MmPersonPeer::MM_ID);
    $criteria->add(MmPersonPeer::PERSON_ID, $person_id);
    $criteria->add(MmPersonPeer::ROLE_ID, 2);

    $v = SerialPeer::doSelectWithI18n($criteria, $culture, $con);

    return !empty($v) > 0 ? $v[0] : null;
  }



  /**
   * Retrieve a single object by title.
   *
   * @param      $title .
   * @param      Connection $con the connection to use
   * @return     Serial
   */
  public static function retrieveByTitle($title, $con = null)
  {
    if ($con === null) {
      $con = Propel::getConnection(self::DATABASE_NAME);
    }

    $criteria = new Criteria(SerialPeer::DATABASE_NAME);

    $criteria->addJoin(SerialPeer::ID, SerialI18nPeer::ID);
    $criteria->add(SerialI18nPeer::TITLE, $title, Criteria::LIKE);

    return SerialPeer::doSelectOne($criteria, $con);
  }

}