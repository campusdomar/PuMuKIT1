<?php

/**
 * LogFilePeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'log_file'. Tabla que se utiliza
 * tener un log de los accesos a los videos.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class LogFilePeer extends BaseLogFilePeer
{

  /**
   * Actualiza el log
   * 
   *
   * @access public
   */
  public static function act($file_id, $ip, $client, $uri)
  {
    $log = new LogFile();
    $log->setFileId($file_id);
    $log->setIp($ip);
    $log->setReferer($uri);
    $log->setNavigator($client);
    $log->save();
  }
}
