<?php

/**
 * Subclass for performing query and update operations on the 'cpu' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class CpuPeer extends BaseCpuPeer
{
  /**
   *  Devuleve la cpu libre para usar, null en caso que no existe cpu libre.
   *
   *
   */
  public static function getFree()
  {
    $con = Propel::getConnection();
    
    // if not using a driver that supports sub-selects
    // you must do a cross join (left join w/ NULL)
    $sql = "SELECT cpu.*, COUNT(transcoding.id) AS ocupados FROM  transcoding ".
           "RIGHT JOIN cpu ON transcoding.cpu_id=cpu.id AND transcoding.status_id = 2  ".
           "GROUP BY cpu.id having ocupados < cpu.number ORDER BY ocupados asc, cpu.number DESC LIMIT 1";
    

    $stmt = $con->createStatement();
    $rs = $stmt->executeQuery($sql, ResultSet::FETCHMODE_NUM);
    
    $objects = parent::populateObjects($rs);
    if ($objects) {
      return $objects[0];
    }
    return null;
  }
}
