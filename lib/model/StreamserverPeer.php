<?php

/**
 * Subclass for performing query and update operations on the 'streamserver' table.
 *
 * 
 *
 * @package lib.model
 */ 
class StreamserverPeer extends BaseStreamserverPeer
{
  /**
   *  Devuelve el numero de usuarios de un servidor de streaming
   *
   *
   */
  public static function getNumUsers()
  {
    $ch = curl_init("http://fms.usc.es:8080/admin/getAppStats?auser=tv&apswd=kk00usc&appName=live");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $xml = new SimpleXMLElement($output);
    
    return ((string)$xml->data[0]->connected);
  }
}
