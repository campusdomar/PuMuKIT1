<?php

/**
 * Subclass for performing query and update operations on the 'log_transcoding' table.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class LogTranscodingPeer extends BaseLogTranscodingPeer
{

  /**
   * Actualiza el log
   * 
   *
   * @access public
   */
  public static function act($tr)
  {
    $log = new LogTranscoding();
    
    $log->setMmId($tr->getMmId());
    $log->setLanguageId($tr->getLanguageId());
    $log->setPerfilId($tr->getPerfilId());
    $log->setCpuId($tr->getCpuId());
    $log->setUrl($tr->getUrl());
    $log->setStatusId($tr->getStatusId());
    $log->setPriority($tr->getPriority());
    $log->setName($tr->getName());
    $log->setTimeini($tr->getTimeini());
    $log->setTimestart($tr->getTimestart());
    $log->setTimeend($tr->getTimeend());
    $log->setPid($tr->getPid());
    $log->setPathIni($tr->getPathIni());
    $log->setPathEnd($tr->getPathEnd());
    $log->setExtIni($tr->getExtIni());
    $log->setExtEnd($tr->getExtEnd());
    $log->setDuration($tr->getDuration());
    $log->setSize($tr->getSize());
    $log->setEmail($tr->getEmail());
    
    $log->save();
    
    return $log;
  }


  
}
