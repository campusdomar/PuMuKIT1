<?php

/**
 * Subclass for performing query and update operations on the 'mm_matterhorn' table.
 *
 *	MAY REQUIRE FINE TUNING 
 *
 * @package lib.model
 */

class MmMatterhornPeer extends BaseMmMatterhornPeer
{
  public static function numHours($dates = null)
  {
    //OJO15 arreglar
    $conexion = Propel::getConnection();
    $consulta = 'SELECT SUM(%s) AS total FROM %s, %s WHERE %s = %s ';
    $consulta = sprintf($consulta, MmMatterhornPeer::DURATION, MmMatterhornPeer::TABLE_NAME, MmPeer::TABLE_NAME, 
	MmMatterhornPeer::ID, MmPeer::ID);
  
    if ($dates != null){
      $consulta .= ' AND %s > "%s" AND %s < "%s"';
      $consulta = sprintf($consulta, MmPeer::PUBLICDATE, date("Y-m-01", $dates["ini"]), MmPeer::PUBLICDATE, date("Y-m-01", $dates["end"]));
    }
  
    $sentencia = $conexion->prepareStatement($consulta);
    $resultset = $sentencia->executeQuery();
    $resultset->next();
    return $resultset->getInt('total')/3600;    
  }


  public static function getCookie($server, $user, $password)
  {
    $init_endpoint = '/welcome.html';
    
    $ch = curl_init($server . $init_endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
    curl_setopt($ch, CURLOPT_USERPWD, $user . ':' . $password);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Requested-Auth: Digest"));
    
    $var = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    preg_match_all('#Set-Cookie: (.*)#', $var, $matches);
    
    if ($status === 200 && is_array($matches[1])){
      return end($matches[1]);
    }else{
      return false;
    }   
  }
}
