<?php

/**
 * Subclass for performing query and update operations on the 'pub_channel' table.
 *
 * 
 *
 * @package lib.model
 */ 
class PubChannelPeer extends BasePubChannelPeer
{

  //OJO METER UN CRITERIA COMO PARAMETRO DE ENTRADA
  public static function getSerials($pub_channel_id)
  {
    $c = new Criteria();
    SerialPeer::addPubChannelCriteria($c, $pub_channel_id);
    SerialPeer::addBroadcastCriteria($c);

    return SerialPeer::doSelent($c);
  }


  public static function getMmsFromSerial($pub_channel_id, $serial_id)
  {
    $c = new Criteria();

    $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, $pub_channel_id);
    $c->add(PubChannelMmPeer::STATUS_ID, 1);
    $c->add(MmPeer::STATUS_ID, 0);

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
    $c->setDistinct(true);
    
    $c->add(MmPeer::SERIAL_ID, $serial_id);
    $c->addAscendingOrderByColumn(MmPeer::RANK);

    return MmPeer::doSelect($c);
  }

  public static function getMmsFromSerialByStatus($pub_channel_id, $serial_id, $status)
  {
    $c = new Criteria();

    $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, $pub_channel_id);
    $c->add(PubChannelMmPeer::STATUS_ID, 1);
    $c->add(MmPeer::STATUS_ID, $status, Criteria::IN);

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
    $c->setDistinct(true);
    
    $c->add(MmPeer::SERIAL_ID, $serial_id);
    $c->addAscendingOrderByColumn(MmPeer::RANK);

    return MmPeer::doSelect($c);
  }

  public static function getFirstMmFromSerial($pub_channel_id, $serial_id)
  {
    $c = new Criteria();

    $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, $pub_channel_id);
    $c->add(PubChannelMmPeer::STATUS_ID, 1);
    $c->add(MmPeer::STATUS_ID, 0);

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
    $c->setDistinct(true);
    
    $c->add(MmPeer::SERIAL_ID, $serial_id);
    $c->addAscendingOrderByColumn(MmPeer::RANK);

    return MmPeer::doSelectOne($c);
  }


  public static function countMmsFromSerial($pub_channel_id, $serial_id)
  {
    $c = new Criteria();

    $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, $pub_channel_id);
    $c->add(PubChannelMmPeer::STATUS_ID, 1);
    $c->add(MmPeer::STATUS_ID, 0);

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
    $c->setDistinct(true);
    
    $c->add(MmPeer::SERIAL_ID, $serial_id);
    $c->addAscendingOrderByColumn(MmPeer::RANK);

    return MmPeer::doCount($c);
  }


  public static function countMmsFromSerialByStatus($pub_channel_id, $serial_id, $status) 
  {
    $c = new Criteria();

    $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, $pub_channel_id);
    $c->add(PubChannelMmPeer::STATUS_ID, 1);
    $c->add(MmPeer::STATUS_ID, $status, Criteria::IN);

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
    $c->setDistinct(true);
    
    $c->add(MmPeer::SERIAL_ID, $serial_id);
    $c->addAscendingOrderByColumn(MmPeer::RANK);

    return MmPeer::doCount($c);
  }



  public static function getFilesFromMm($pub_channel_id, $mm_id)
  {
    $c = new Criteria();

    $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, $pub_channel_id);
    $c->add(PubChannelMmPeer::STATUS_ID, 1);

    $c->add(MmPeer::STATUS_ID, 0);

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
    $c->setDistinct(true);
    
    $c->add(MmPeer::ID, $mm_id);
    $c->addAscendingOrderByColumn(FilePeer::RANK);

    $c->addJoin(FilePeer::MM_ID, MmPeer::ID);
    $c->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);
    


    return FilePeer::doSelect($c);
  }



  public static function getAnnounces($pub_channel_id, $culture = 'es', $limit = 0, $credentials = array('pub', 'cor'), $genre = null)
  {
    $c = new Criteria();

    $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, $pub_channel_id);
    $c->add(PubChannelMmPeer::STATUS_ID, 1);

    $c->add(MmPeer::STATUS_ID, 0);

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, $credentials, Criteria::IN);
    $c->setDistinct(true);
    
    $c->add(MmPeer::ANNOUNCE, true);

    if($genre != null){
      $c->add(MmPeer::GENRE_ID, $genre);
    }
    if($limit != 0){
      $c->setLimit($limit);
    }

    $c->addDescendingOrderByColumn(MmPeer::PUBLICDATE);
    // $c->addAscendingOrderByColumn(MmPeer::RANK);
    return MmPeer::doSelectWithI18n($c);
  }
  
  
  public static function numSerials($pub_channel_id)
  {
    $c = new Criteria();
    SerialPeer::addPubChannelCriteria($c, $pub_channel_id);
    SerialPeer::addBroadcastCriteria($c);

    return SerialPeer::doCount($c);
  }

  public static function numMms($pub_channel_id)
  {
    $c = new Criteria();
    //OJO15 crear funcion con esto
    $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, $pub_channel_id);

    $c->add(MmPeer::STATUS_ID, MmPeer::STATUS_NORMAL);
    $c->setDistinct(true);

    //OJO15 crear funcion con esto
    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);

    return MmPeer::doCount($c);
  }

  public static function numHours($pub_channel_id, $dates = null)
  {
    //OJO15 arreglar
    $conexion = Propel::getConnection();
    $consulta = 'SELECT SUM(%s) AS total FROM %s, %s, %s, %s WHERE %s = %s AND %s = %s AND %s = %s AND %s = "%d" AND %s = %s ';
    $consulta = sprintf($consulta, FilePeer::DURATION, FilePeer::TABLE_NAME, PerfilPeer::TABLE_NAME,
                        PubChannelMmPeer::TABLE_NAME, MmPeer::TABLE_NAME,
                        FilePeer::MM_ID, MmPeer::ID,
                        FilePeer::MM_ID, PubChannelMmPeer::MM_ID,
                        FilePeer::PERFIL_ID, PerfilPeer::ID,
                        PubChannelMmPeer::PUB_CHANNEL_ID, $pub_channel_id,
                        PerfilPeer::DISPLAY , 1);

  
    if ($dates != null){
      $consulta .= ' AND %s > "%s" AND %s < "%s"';
      $consulta = sprintf($consulta, MmPeer::PUBLICDATE, date("Y-m-01", $dates["ini"]), MmPeer::PUBLICDATE, date("Y-m-01", $dates["end"]));
    }
  
    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    $resultset->next();
    return $resultset->getInt('total')/3600;    
  }


  static public function masVistosDias($pub_channel_id, $culture, $dias = 0, $cuantos = 3)
  {
    $c = new Criteria();

    $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, $pub_channel_id);
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


  static public function masVistos($pub_channel_id, $culture, $cuantos = 3)
  {
    $c = new Criteria();

    $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, $pub_channel_id);
    $c->add(PubChannelMmPeer::STATUS_ID, 1);
    $c->add(MmPeer::STATUS_ID, 0);

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
    $c->setDistinct(true);


    $c->addJoin(MmPeer::ID, FilePeer::MM_ID);
    $c->add(FilePeer::DISPLAY, true);
    $c->addDescendingOrderByColumn(FilePeer::NUM_VIEW);

    if($cuantos != 0) $c->setLimit($cuantos);

    return MmPeer::doSelectWithI18n($c, $culture);
  }

  static public function ultimos($pub_channel_id, $culture, $cuantos = 3)
  {
    $c = new Criteria();

    $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, $pub_channel_id);
    $c->add(PubChannelMmPeer::STATUS_ID, 1);
    $c->add(MmPeer::STATUS_ID, 0);

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
    $c->setDistinct(true);

    $c->add(MmPeer::ANNOUNCE, true);

    $c->addDescendingOrderByColumn(MmPeer::PUBLICDATE);
    if($cuantos != 0) $c->setLimit($cuantos);

    return MmPeer::doSelectWithI18n($c, $culture);
  }

  static public function anunciados($pub_channel_id, $culture, $cuantos = 3)
  {
    $c = new Criteria();

    $c->addJoin(PubChannelMmPeer::MM_ID, MmPeer::ID);
    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, $pub_channel_id);
    $c->add(PubChannelMmPeer::STATUS_ID, 1);
    $c->add(MmPeer::STATUS_ID, 0);

    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, array('pub', 'cor'), Criteria::IN);
    $c->setDistinct(true);

    $c->add(MmPeer::ANNOUNCE, 1);

    $c->addDescendingOrderByColumn(MmPeer::PUBLICDATE);
    if($cuantos != 0) $c->setLimit($cuantos);

    return MmPeer::doSelectWithI18n($c, $culture);
  }


  static public function getSerialAndMmAnnounces($pub_channel_id, $culture = 'es', $limit = 0){
    $limitSQL = ($limit != 0) ? (' limit ' . $limit) : '';
    
    $conexion = Propel::getConnection();
    
    // MmPeer::STATUS_NORMAL = 0 => objeto multimedia publicado
    $consulta = "(SELECT 'serial' AS info, serial.id as id ,serial.publicDate as publicDate FROM serial, mm "
      ."WHERE serial.id = mm.serial_id AND mm.status_id = 0 AND serial.announce = true ) "
      ."UNION (SELECT 'mm' AS info, mm.id, publicDate FROM mm, pub_channel_mm WHERE mm.status_id = 0 "
      ."AND mm.announce = true AND mm.status_id = 0 "
      ."AND pub_channel_mm.PUB_CHANNEL_ID=" . $pub_channel_id . " AND pub_channel_mm.STATUS_ID=1) ORDER BY publicDate DESC" . $limitSQL;
    
    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    
    $volver = array();
    
    while ($resultset->next()){
      if ($resultset->getString('info') == 'serial'){
	//hydrate
        $aux = SerialPeer::retrieveByPkWithI18n($resultset->getInt('id'), $culture);
      }else{
	//hydrate
        $aux = MmPeer::retrieveByPkWithI18n($resultset->getInt('id'), $culture);
      }
      $volver[]= $aux;
    }
    return $volver;
  }

}
