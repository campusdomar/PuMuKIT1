<?php

/**
 * PlacePeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'place'. 
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class PlacePeer extends BasePlacePeer
{

  /**
   * Seleciona, ordenados alfabeticamente, la lista de lugares
   * que poseen algun recincto
   *
   * @access public
   * @param Criteria $c 
   * @param string $culture cultura con la que se devuelven los Lugales
   * @param integer $con conexion a la BBDD
   * @return ResulSet de objetos Place
   */
  public static function doSelectOrderWithPrecinctWithI18n(Criteria $c, $culture = null, $con = null)
  {
    $c = new Criteria;
    $c->setDistinct(true);
    $c->addAscendingOrderByColumn(PlaceI18nPeer::NAME);
    $c->addJoin(PlacePeer::ID, PrecinctPeer::PLACE_ID, Criteria::LEFT_JOIN);
    return PlacePeer::doSelectWithI18n($c, $culture);
  }

  public static function getArrayPlaceSeries(){
    $conexion = Propel::getConnection();
    $consulta = 'select distinct serial.id as id, MIN(place.id) as min, MAX(place.id) as max from serial left join mm on mm.serial_id=serial.id '
      . 'left join precinct on precinct.id= mm.precinct_id left join place on place.id = precinct.place_id group by serial.id;';
    $sentencia = $conexion->prepareStatement($consulta);
    $rs = $sentencia->executeQuery();
    $relations = array();
    while ($rs->next())
      {
        $min      = $rs->getInt('min');
        $max      = $rs->getInt('max');
        if ($min == $max){
          $place = $min;
        }else{
          $place = null;
        }
        $relations[$rs->getInt('id')] = $place;
      }
    return $relations;
  }

}
