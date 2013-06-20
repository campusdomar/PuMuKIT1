<?php

/**
 * DataBaseProxy (class)
 *
 * Proxy de la base de datos para cachear consultas 
 * muy frecuentes en el modulo virtualserial
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@teltek.es
 * @version 1
 *
 * @package 
 */ 

class DataBaseProxy {

  private static $unesco = null;

  public static function getUnesco()
  {
    if(!self::$unesco) {
      self::$unesco = CategoryPeer::retrieveByCode("UNESCO");
    }

    return self::$unesco;
  }
}