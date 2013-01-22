<?php

/**
 * LogEmailPeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'log_email'. Tabla que se utiliza
 * para manterner un log de los emails mandados.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class LogEmailPeer extends BaseLogEmailPeer
{

  /**
   * Actualiza el log
   * 
   *
   * @access public
   */
  public static function act($object, $id, $email, $userName, $ip)
  {
    $log = new LogEmail();
    $log->setEmail($email);
    $log->setUserName($userName);
    $log->setType($object);
    $log->setObjectId($id);
    $log->setIp($ip);
    $log->save();
  }

  /**
   *
   *
   */
  public static function getEmails($object, $id)
  {
    $c = new Criteria();
    $c->add(LogEmailPeer::TYPE, $object);
    $c->add(LogEmailPeer::OBJECT_ID, $id);

    $logs = LogEmailPeer::doSelect($c);

    $aux = '(';
    foreach($logs as $log){
      $aux .= ' ' . $log->getEmail();
    }
    $aux .= ')';

    return $aux;
  }
}
