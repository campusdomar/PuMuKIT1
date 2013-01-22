<?php

/**
 * DirectPeer (class)
 *
 * Subclase para generar consultas y actualizaciones
 * sobre la tabla 'direct'. 
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class DirectPeer extends BaseDirectPeer
{
  static public function getIndexPlay()
  {
  
    $c = new Criteria();
    $c->add(DirectPeer::BROADCASTING, true);
    $c->add(DirectPeer::INDEX_PLAY, true);
    
    if (StreamserverPeer::getNumUsers() >= 700){
      return null;
    }
    return DirectPeer::doSelectOne($c);
  }
}
