<?php

/**
 * Subclass for representing a row from the 'pub_channel' table.
 *
 * 
 *
 * @package lib.model
 */ 
class PubChannel extends BasePubChannel
{


  /**
   * Devuelve un conjunto de las series y objetos multimedia anunciados
   *
   * @access public
   * @param string $culture, valor por defecto es.
   * @param integer $limit
   * @param array credentials 
   * @return array de Serial y Mm
   */
  //OJO15
  public function getAnnounces($culture = 'es', $limit = 0, $credentials = array('pub', 'cor'), $genre = null){
    
    //falta serie
    $c = new Criteria();
    $c->addJoin(MmPeer::ID, PubChannelMmPeer::MM_ID);
    $c->add(PubChannelMmPeer::PUB_CHANNEL_ID, $this->getId());
    $c->add(PubChannelMmPeer::STATUS_ID, 1);
    $c->add(MmPeer::ANNOUNCE, 1);
    $c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
    $c->addJoin(BroadcastPeer::BROADCAST_TYPE_ID, BroadcastTypePeer::ID);
    $c->add(BroadcastTypePeer::NAME, $credentials, Criteria::IN);
    if ($genre != null) $c->add(MmPeer::GENRE_ID, $genre);

    if ($limit != 0) $c->setLimit($limit);

    return MmPeer::doSelect($c);

    $limitSQL = '';
    if ($limit != 0) $limitSQL = (' limit ' . $limit);

    $conexion = Propel::getConnection();
    $consulta = "(SELECT 'serial' AS info, serial.id as id ,serial.publicDate as publicDate FROM serial, mm, broadcast, broadcast_type "
      ."WHERE mm.serial_id=serial.id AND serial.announce=true AND mm.broadcast_id = broadcast.id AND "
      ."broadcast.broadcast_type_id=broadcast_type.id "
      .($genre == null?"":"AND mm.genre_id = " . $genre) . " "
      ."AND broadcast_type.name IN %s GROUP BY serial.id HAVING max(mm.status_id) = 0) "
      ."UNION (SELECT 'mm' AS info, mm.id, publicDate FROM mm, broadcast, broadcast_type WHERE mm.status_id = 0 "
      ."AND mm.announce=true AND mm.broadcast_id = broadcast.id "
      .($genre == null?"":"AND mm.genre_id = " . $genre) . " "
      ."AND broadcast.broadcast_type_id=broadcast_type.id AND broadcast_type.name IN %s) ORDER BY publicDate DESC" . $limitSQL;

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
    * Esta funcion devuelve
    *   - 0: No hay relacion.
    *   - 1: Si hay
    *   - 2: Si hay pero aun se estan transcodificando los videos
    *   - 3: Si hay pero esta esperando que termine de hacerse master para pasar al estado 2.
    */
   public function hasMm($mm_id){
     $aux = PubChannelMmPeer::retrieveByPK($this->getId(), $mm_id);
     if (is_null($aux)) return 0;
     return $aux->getStatusId();
   }


  public function startSelectWorkflow(Mm $mm){
    $perfiles_usados = array();
    
    $master = $mm->getMaster();
    
    $aux = PubChannelMmPeer::retrieveByPK($this->getId(), $mm->getId());
    if(is_null($aux)){
      $aux = new PubChannelMm();
      $aux->setMm($mm);
      $aux->setPubChannel($this);
      $aux->setStatusId(3);
      $aux->save();
    }

    if(is_null($master)) {
      return false;
    }

    $has_all_files = true;
    foreach($this->getPubChannelPerfils() as $pcp){
      
      if ($master->getAspect() == 0){
        $perfil = $pcp->getPerfilRelatedByPerfilAudioId(); 
      }else if($master->getAspect() < 1.5){
	      $perfil = $pcp->getPerfilRelatedByPerfil43Id();
      }else{
	      $perfil = $pcp->getPerfilRelatedByPerfil169Id();
      }
      
      if(count($mm->getFilesByPerfil($perfil->getId())) == 0){
      	$has_all_files = false;
      	//SI SI ESTA TRANSCODIFICANDO NO LO PONGO DENUEVO
      	if(count($mm->getTranscodingsByPerfil($perfil->getId())) == 0){

      	  $master->retranscoding($perfil->getId(), 2, sfContext::getInstance()->getUser()->getAttribute('email', 0));
      	  $perfiles_usados[] = $perfil;
      	}
      }
    }

    $aux->setStatusId($has_all_files ? 1 : 2);
    $aux->save();

    $class_name = $this->getName() . "Workflow";
    $class = new $class_name;
    $class->select($mm);
    return $perfiles_usados;
  }

  public function startDeselectWorkflow(Mm $mm){
    //YA SE COMPRUEBA ANTES QUE NO SEA STATUS_ID 2
    $aux = PubChannelMmPeer::retrieveByPK($this->getId(), $mm->getId());
    $aux->delete();

    $class_name = $this->getName() . "Workflow";
    $class = new $class_name;
    $class->deselect($mm);
  }
}


/** Implementa comportamiento sortable */
sfPropelBehavior::add('PubChannel', array('sortable') );
