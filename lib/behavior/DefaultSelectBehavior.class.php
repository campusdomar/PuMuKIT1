<?php

/**
 * DefaultSelect (behavior)
 *
 * Comportamiento para las tablas que tienen un objeto 
 * selecionado por defecto.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class DefaultSelectBehavior
{  

  /**
   * Metodo de la Clase PEER
   *
   * Devuelve el id del elemento selecionado por defecto. Si no existe
   * elemento selecionado por defecto devuelve el id del primer elemento
   *
   * @param    Object Peer
   * @return   integer id
   **/  
  public static function getDefaultSelectId($peerClass)
  {
    $obj = self::getDefaultSelect($peerClass);
    
    if($obj) return $obj->getId();
    else {
      $aux = call_user_func(array($peerClass, 'doSelectOne'), new Criteria()); 
      return $aux->getId();
    }
  }


  /**
   * Metodo de la Clase PEER
   *
   * Devuelve el elemento selecionado por defecto. Si no existe
   * elemento selecionado por defecto devuelve null.
   *
   * @param    Object Peer
   * @return   integer id
   **/  
  public static function getDefaultSelect($peerClass)
  {
    $defaultSelColumnName = 'default_sel';
    $defaultSelColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $defaultSelColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);

    $c = new Criteria;
    $c->add($defaultSelColumnPhpName, 1);

    return call_user_func(array($peerClass, 'doSelectOne'), $c); 
  }


  /**
   * Metodo de la Clase Object
   *
   * Marca el objeto como el selecionado por defecto.
   *
   * @param    Object Peer
   * @return   integer id
   **/  
  public function setDefaultSelect($object, $con = null)
  {
    $class = get_class($object);
    $peerClass = $class.'Peer';
    $defaultSelectColumnName = 'default_sel';
    if(!$con) $con = Propel::getConnection(constant("$peerClass::DATABASE_NAME"));
    
    $query = sprintf('UPDATE %s SET %s = (%s = ?)',
      constant("$peerClass::TABLE_NAME"),
      $defaultSelectColumnName,
      'id'
    );
    $stmt = $con->prepareStatement($query);
    $stmt->setInt(1, $object->getId());
    $stmt->executeQuery();

    return $object;
  }
}
