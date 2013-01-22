<?php

/**
 * Subclass for performing query and update operations on the 'serial_hash' table.
 *
 * 
 *
 * @package lib.model
 */ 
class SerialHashPeer extends BaseSerialHashPeer
{
  public static function get($serial)
  {
    $c = new Criteria();
    $c->add(SerialHashPeer::SERIAL_ID, $serial->getId());
    $hash = SerialHashPeer::doSelectOne($c);

    if(!$hash){
      $hash = new SerialHash();
      $hash->setSerialId($serial->getId());
      $hash->setHash(md5($serial->getId()));
      $hash->save();
    }

    return $hash;
  }



  public static function retrieveByHash($hash, $con = null)
  {
    if ($con === null) {
      $con = Propel::getConnection(self::DATABASE_NAME);
    }
    
    $criteria = new Criteria(SerialHashPeer::DATABASE_NAME);
    
    $criteria->add(SerialHashPeer::HASH, $hash);
    
    $v = SerialHashPeer::doSelect($criteria, $con);
    
    return !empty($v) > 0 ? $v[0] : null;
  }
}
