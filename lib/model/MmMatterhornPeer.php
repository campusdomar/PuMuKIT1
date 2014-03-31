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


  public static function get($user, $password, $url){
    $sal = array();
   
    //var_dump($url); exit;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($ch, CURLOPT_HEADER, true);     

    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);

    if ($user != "") {
      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
      curl_setopt($ch, CURLOPT_USERPWD, $user . ':' . $password);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Requested-Auth: Digest", 
						 "X-Opencast-Matterhorn-Authorization: true"));
    }

    $sal["var"] = curl_exec($ch);
    $sal["error"] = curl_error($ch);
    $sal["status"] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);
    return $sal;

  }

  public static function getJson($user, $password, $url)
  {
    $sal = self::get($user, $password, $url);

    if ($sal["status"] !== 200) return false;
    $decode = json_decode($sal["var"], true);

    return $decode;
  }

  public static function getMediaPackagesFromWorkflows($server, $user, $password, $startPage = 0, $limit = 5, $q = null)
  {
    $url_q = is_null($q)?'':('&q=' . urlencode($q));
    $url = $server . "/workflow/instances.json?state=SUCCEEDED&sort=DATE_CREATED_DESC&count=" . $limit . "&startPage=" . $startPage . $url_q;


    if (!($decode = self::getJson($user, $password, $url))) {
      throw new sfException("Matterhorn communication error");
    }

    $return = array();

    if ($decode["workflows"]["totalCount"] == 0)
      return $return;

    if (($limit == 1) || ($decode["workflows"]["totalCount"] == 1))
      $return[] = $decode["workflows"]["workflow"]["mediapackage"];
    else
      foreach($decode["workflows"]["workflow"] as $media){
	$return[] = $media["mediapackage"];
      }
    
    return $return;
  }


  public static function getMediaPackagesFromSearch($server, $user, $password, $startPage = 0, $limit = 5, $q = null)
  {
    $url_q = is_null($q)?'':('&q=' . urlencode($q));
    $url = $server . "/search/episode.json?limit=" . $limit . "&offset=" . ($startPage * $limit) . $url_q;
    
    if (!($decode = self::getJson($user, $password, $url))) {
      throw new sfException("Matterhorn communication error");
    }
    
    $return = array();
    
    if ($decode["search-results"]["total"] == 0)
      return $return;
    
    if ($decode["search-results"]["limit"] > 1)
      foreach($decode["search-results"]["result"] as $media)
	$return[] = $media["mediapackage"];
    else
      $return[] = $decode["search-results"]["mediapackage"];
    
    return $return;
  }


  public static function getNumMediaPackagesFromWorkflows($server, $user, $password, $q = null)
  {
    $url_q = is_null($q)?'':('&q=' . urlencode($q));
    $url = $server . "/workflow/instances.json?state=SUCCEEDED&sort=DATE_CREATED_DESC" . $url_q;


    if (!($decode = self::getJson($user, $password, $url))) {
      throw new sfException("Matterhorn communication error");
    }

    return intval($decode["workflows"]["totalCount"]);
  }


  public static function getNumMediaPackagesFromSearch($server, $user, $password, $q = null)
  {
    $url_q = is_null($q)?'':('&q=' . urlencode($q));
    $url = $server . "/search/episode.json?" . $url_q;
    
    if (!($decode = self::getJson($user, $password, $url))) {
      throw new sfException("Matterhorn communication error");
    }
    
    return intval($decode["search-results"]["total"]);
  }


  public static function getMediaPackageFromWorkflows($server, $user, $password, $id)
  {
    $url = $server . "/workflow/instances.json?state=SUCCEEDED&sort=DATE_CREATED_DESC&mp=" . $id;
    
    if (!($decode = self::getJson($user, $password, $url))) {
      throw new sfException("Matterhorn communication error");
    }
        
    if ($decode["workflows"]["totalCount"] == 0)
      return $return;
    
    if ($decode["workflows"]["totalCount"] > 1)
      $return = $decode["workflows"]["workflow"][0]["mediapackage"];     
    else
      $return = $decode["workflows"]["workflow"]["mediapackage"];
    
    return $return; 
  }
  
  
  public static function getMediaPackageFromSearch($server, $user, $password, $id)
  {
    $url = $server . "/search/episode.json?id=". $id;
    
    if (!($decode = self::getJson($user, $password, $url))) {
      throw new sfException("Matterhorn communication error");
    }
        
    if ($decode["search-results"]["total"] == 0)
      return $return;
    
    if ($decode["search-results"]["total"] > 1)
      $return = $decode["search-results"]["result"][0]["mediapackage"];
    else
      $return = $decode["search-results"]["result"]["mediapackage"];
    
    return $return;
  }


  /**
   *
   */
  public static function getMediaPackage($id)
  {
    $server       = sfConfig::get('app_matterhorn_server');
    $server_admin = sfConfig::get('app_matterhorn_server_admin');
    $user         = sfConfig::get('app_matterhorn_user');
    $password     = sfConfig::get('app_matterhorn_password');

    if($user == "") {
      return self::getMediaPackageFromSearch($server, $user, $password, $id);
    } else {
      return self::getMediaPackageFromWorkflows($server_admin, $user, $password, $id);
    }
  }


  /**
   *
   */
  public static function getMediaPackages($offset = 0, $limit = 5, $q = null)
  {
    $server       = sfConfig::get('app_matterhorn_server');
    $server_admin = sfConfig::get('app_matterhorn_server_admin');
    $user         = sfConfig::get('app_matterhorn_user');
    $password     = sfConfig::get('app_matterhorn_password');

    if($user == "") {
      return self::getMediaPackagesFromSearch($server, $user, $password, $limit, $offset, $q);
    } else {
      return self::getMediaPackagesFromWorkflows($server_admin, $user, $password, $limit, $offset, $q);
    }
  }

  /**
   *
   */
  public static function getNumMediaPackages($q = null)
  {
    $server       = sfConfig::get('app_matterhorn_server');
    $server_admin = sfConfig::get('app_matterhorn_server_admin');
    $user         = sfConfig::get('app_matterhorn_user');
    $password     = sfConfig::get('app_matterhorn_password');

    if($user == "") {
      return self::getNumMediaPackagesFromSearch($server, $user, $password, $q);
    } else {
      return self::getNumMediaPackagesFromWorkflows($server_admin, $user, $password, $q);
    }
  }


  public static function serverInfo()
  {
    $server       = sfConfig::get('app_matterhorn_server');
    $server_admin = sfConfig::get('app_matterhorn_server_admin');
    $user         = sfConfig::get('app_matterhorn_user');
    $password     = sfConfig::get('app_matterhorn_password');

    return MmMatterhornPeer::getJson($user, $password, $server . '/info/me.json'); 
  }


  public static function series($id)
  {
    $server       = sfConfig::get('app_matterhorn_server');
    $server_admin = sfConfig::get('app_matterhorn_server_admin');
    $user         = sfConfig::get('app_matterhorn_user');
    $password     = sfConfig::get('app_matterhorn_password');

    return MmMatterhornPeer::getJson($user, $password, $server . "/series/" . $id. ".json"); 
  }
}
