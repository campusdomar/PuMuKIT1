<?php


/**
 * SortableFK2Behavior (behavior)
 *
 * Comportamiento para las tablas cuyo order esta definido por
 * la columna RANK y dos referencias foraneas. Proporciona funciones 
 * utiles como pueden ser autoinicializarse, up y down.
 *
 *
 * @author Ruben Gonzalez Gonzalez
 * @author rubenrua@uvigo.es
 * @copyright Copyright (c) Universidad de Vigo
 * @version 1
 *
 * @package lib.model
 */ 
class SortableFK2Behavior
{  
  
  /**
   * Returns an item from the list based on its position
   *
   * @param string peer class of the sortable objects
   * @param integer position
   * @param integer foreign key
   * @param Connection an optional connection object
   *
   * @return mixed sortable object
   **/
  public static function retrieveByPosition($peerClass, $position, $fKey, $fKey2, $con = null)
  {
    $fKeyColumnName =  sfConfig::get('propel_behavior_sortableFk2_'.self::getClassFromPeerClass($peerClass).'_f_key', 'object_id');
    $fKeyColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $fKeyColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
    $fKey2ColumnName =  sfConfig::get('propel_behavior_sortableFk2_'.self::getClassFromPeerClass($peerClass).'_f_key2', 'object_id');
    $fKey2ColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $fKey2ColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
    $rankColumnName = 'rank';
    $rankColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $rankColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
    if(!$con) $con = Propel::getConnection(constant("$peerClass::DATABASE_NAME"));

    $c = new Criteria;
    $c->add($rankColumnPhpName, $position);
    $c->add($fKeyColumnPhpName, $fKey);
    $c->add($fKey2ColumnPhpName, $fKey2);

    return call_user_func(array($peerClass, 'doSelectOne'), $c, $con); 
  }

  /**
   * Returns the lowest position of a class of sortable objects
   *
   * @param string peer class of the sortable objects
   * @param integer foreign key
   * @param Connection an optional connection object
   *
   * @return integer minimum position
   **/
  public static function getMinPosition($peerClass, $fKey, $fKey2 ,$con = null)
  {
    $fKeyColumnName =  sfConfig::get('propel_behavior_sortableFk2_'.self::getClassFromPeerClass($peerClass).'_f_key', 'object_id');
    $fKeyColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $fKeyColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
    $fKey2ColumnName =  sfConfig::get('propel_behavior_sortableFk2_'.self::getClassFromPeerClass($peerClass).'_f_key2', 'object_id');
    $fKey2ColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $fKey2ColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
    $rankColumnName = 'rank';
    if(!$con) $con = Propel::getConnection(constant("$peerClass::DATABASE_NAME"));
    
    $sql = sprintf('SELECT MIN(%s) AS min FROM %s WHERE %s = ? AND %s = ?', 
      $rankColumnName,
      constant("$peerClass::TABLE_NAME"),
      $fKeyColumnPhpName,
      $fKey2ColumnPhpName
    ); 

    $ps = $con->prepareStatement($sql);
    $ps->setInt(1, $fKey);
    $ps->setInt(2, $fKey2);
    $rs = $ps->executeQuery();
    $rs->next();
    
    return $rs->getInt('min');
  }

  /**
   * Returns the highest position of a class of sortable objects
   *
   * @param string peer class of the sortable objects
   * @param integer foreign key
   * @param Connection an optional connection object
   *
   * @return integer maximum position
   **/
  public static function getMaxPosition($peerClass, $fKey, $fKey2 ,$con = null)
  {
    $fKeyColumnName =  sfConfig::get('propel_behavior_sortableFk2_'.self::getClassFromPeerClass($peerClass).'_f_key', 'object_id');
    $fKeyColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $fKeyColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
    $fKey2ColumnName =  sfConfig::get('propel_behavior_sortableFk2_'.self::getClassFromPeerClass($peerClass).'_f_key2', 'object_id');
    $fKey2ColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $fKey2ColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
    $rankColumnName = 'rank';
    if(!$con) $con = Propel::getConnection(constant("$peerClass::DATABASE_NAME"));
    
    $sql = sprintf('SELECT MAX(%s) AS max FROM %s WHERE %s = ? AND %s = ?', 
      $rankColumnName,
      constant("$peerClass::TABLE_NAME"),
      $fKeyColumnPhpName,
      $fKey2ColumnPhpName
    ); 

    $ps = $con->prepareStatement($sql);
    $ps->setInt(1, $fKey);
    $ps->setInt(2, $fKey2);
    $rs = $ps->executeQuery();
    $rs->next();
    
    return $rs->getInt('max');
  }

  /**
   * Returns an array of sortable objects ordered by position
   *
   * @param string peer class of the sortable objects
   * @param string sorting order, to be chosen between Criteria::ASC (default) and Criteria::DESC
   * @param integer foreign key
   * @param Criteria optional criteria object
   * @param Connection an optional connection object
   *
   * @return array list of sortable objects
   **/
  public static function doSelectOrderByPosition($peerClass, $order = Criteria::ASC, $fKey, $criteria = null, $con = null)
  {
    $rankColumnName = 'rank';
    $rankColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $rankColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
    $fKeyColumnName =  sfConfig::get('propel_behavior_sortableFk2_'.get_class($object).'_f_key', 'object_id');
    $fKeyColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $fKeyColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
    if(!$con) $con = Propel::getConnection(constant("$peerClass::DATABASE_NAME"));
    
    if ($criteria === null) 
    {
      $criteria = new Criteria();
    }
    elseif ($criteria instanceof Criteria)
    {
      $criteria = clone $criteria;
    }
    
    $criteria->clearOrderByColumns();
    
    if($order == Criteria::ASC)
    {
      $criteria->addAscendingOrderByColumn($rankColumnPhpName);
    }
    else
    {
      $criteria->addDescendingOrderByColumn($rankColumnPhpName);
    }

    $criteria->add($fKeyColumnPhpName, $fKey);
    
    return call_user_func(array($peerClass, 'doSelect'), $criteria, $con); 
  }
  
  /**
   * Gets the Foreign Key
   *
   * @param mixed sortable object
   *
   * @return integer foreigh key of the sortable object
   **/
  public function getFKey($object)
  {
    return $object->getByName(sfConfig::get('propel_behavior_sortableFk2_'.get_class($object).'_f_key', 'object_id'), BasePeer::TYPE_FIELDNAME);
  }

  /**
   * Gets the Foreign Key
   *
   * @param mixed sortable object
   *
   * @return integer foreigh key of the sortable object
   **/
  public function getFKey2($object)
  {
    return $object->getByName(sfConfig::get('propel_behavior_sortableFk2_'.get_class($object).'_f_key2', 'object_id'), BasePeer::TYPE_FIELDNAME);
  }


  /**
   * Gets the position of a sortable object
   *
   * @param mixed sortable object
   *
   * @return integer position of the sortable object
   **/
  public function getPosition($object)
  {
    return $object->getByName('rank', BasePeer::TYPE_FIELDNAME);
  }

  /**
   * Sets the position of a sortable object
   * Beware that there is no check made on the value passed
   * If the position already exists, or if it is superior to the highest position + 1, 
   * the method does not throw any exception
   *
   * @param mixed sortable object
   * @param integer position value
   *
   **/
  public function setPosition($object, $position)
  {
    return $object->setByName('rank', $position, BasePeer::TYPE_FIELDNAME);
  }

  /**
   * Returns the next item in the list, i.e. the one for which position is immediately higher
   *
   * @param mixed sortable object
   *
   * @return mixed sortable object of the same class as the argument
   **/
  public function getNext($object)
  {
    return self::retrieveByPosition(get_class($object).'Peer', self::getPosition($object) + 1, self::getFKey($object), self::getFKey2($object));
  }
  
  /**
   * Returns the previous item in the list, i.e. the one for which position is immediately lower
   *
   * @param mixed sortable object
   *
   * @return mixed sortable object of the same class as the argument
   **/
  public function getPrevious($object)
  {
    return self::retrieveByPosition(get_class($object).'Peer', self::getPosition($object) - 1, self::getFKey($object), self::getFKey2($object));
  }

  /**
   * Checks if the object is first in the list, i.e. if it has 1 for position
   *
   * @param mixed sortable object
   *
   * @return boolean True if the item is the first in the list
   **/  
  public function isFirst($object)
  {
    return self::getPosition($object) == self::getMinPosition(get_class($object).'Peer', self::getFKey($object), self::getFKey2($object));
    //return self::getPosition($object) == 1;
  }

  /**
   * Checks if the object is last in the list, i.e. if its position is the highest position
   *
   * @param mixed sortable object
   *
   * @return boolean True if the item is the last in the list
   **/    
  public function isLast($object)
  {
    return self::getPosition($object) == self::getMaxPosition(get_class($object).'Peer', self::getFKey($object), self::getFKey2($object));
  }

  /**
   * Moves the object higher in the list, i.e. exchanges its position with the one of the previous object
   *
   * @param mixed sortable object
   *
   * @return mixed False if the object cannot be moved further up, an array of the swapped ranks otherwise
   **/
  public function moveUp($object)
  {
    return self::isFirst($object) ? false : self::swapWith($object, self::getPrevious($object));
  }
  
  /**
   * Moves the object lower in the list, i.e. exchanges its position with the one of the next object
   *
   * @param mixed sortable object
   *
   * @return mixed False if the object cannot be moved further down, an array of the swapped ranks otherwise
   **/
  public function moveDown($object)
  {
    return self::isLast($object) ? false : self::swapWith($object, self::getNext($object));
  }

  /**
   * Exchanges the position of the object with the one passed as argument
   *
   * @param mixed sortable object
   * @param mixed sortable object
   * @param Connection an optional connection object
   *
   * @return array the swapped ranks
   *
   * @throws Exception if the database cannot execute the two updates
   **/
  public function swapWith($object, $item, $con = null)
  {
    $class = get_class($object);
    $peerClass = $class.'Peer';
    if(!$con) $con = Propel::getConnection(constant("$peerClass::DATABASE_NAME"));
    try
    {
      $con->begin();
      $rankColumnName = 'rank';
      $oldRank = self::getPosition($object);
      $newRank = self::getPosition($item);
      self::setPosition($object, $newRank);
      $object->save();
      self::setPosition($item, $oldRank);
      $item->save();
   
      $con->commit();
      return array($oldRank, $newRank);
    }
    catch (Exception $e)
    {
      $con->rollback();
      throw $e;
    }
  }
  
  /**
   * Moves the object to a new position, and shifts the position 
   * Of the objects inbetween the old and new position accordingly
   *
   * @param mixed sortable object
   * @param integer position value
   * @param Connection an optional connection object
   *
   * @return integer the old object's position
   *
   * @throws Exception if the database cannot execute the position updates
   **/
  public function moveToPosition($object, $newPosition, $con = null)
  {
    $class = get_class($object);
    $peerClass = $class.'Peer';
    $rankColumnName = 'rank';
    $fKeyColumnName =  sfConfig::get('propel_behavior_sortableFk2_'.get_class($object).'_f_key', 'object_id');
    $fKeyColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $fKeyColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
    $fKey2ColumnName =  sfConfig::get('propel_behavior_sortableFk2_'.get_class($object).'_f_key2', 'object_id');
    $fKey2ColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $fKey2ColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
    if(!$con) $con = Propel::getConnection(constant("$peerClass::DATABASE_NAME"));

    $oldPosition = self::getPosition($object);
    if ($oldPosition == $newPosition) return $oldPosition;

    try
    {
      $con->begin();

      // Move the object away
      self::setPosition($object, self::getMaxPosition($peerClass, self::getFKey($object), self::getFKey2($object)) + 1);
      $object->save();
      
      // Shift the objects between the old and the new position
      $query = sprintf('UPDATE %s SET %s = %s %s 1 WHERE (%s BETWEEN ? AND ?) AND (%s = ?) AND (%s = ?)',
        constant("$peerClass::TABLE_NAME"),
        $rankColumnName,
        $rankColumnName,
        ($oldPosition < $newPosition) ? '-' : '+',
        $rankColumnName,
	$fKeyColumnPhpName,
        $fKey2ColumnPhpName
      );
      $stmt = $con->prepareStatement($query);
      $stmt->setInt(1, min($oldPosition, $newPosition));
      $stmt->setInt(2, max($oldPosition, $newPosition));
      $stmt->setInt(3, self::getFKey($object));
      $stmt->setInt(4, self::getFKey2($object));
      $stmt->executeQuery();

      // Move the object back in
      self::setPosition($object, $newPosition);
      $object->save();

      $con->commit();
      return $oldPosition;
    }
    catch (Exception $e)
    {
      $con->rollback();
      throw $e;
    }
  }

  /**
   * Moves the object to the top of the list (i.e. gives it position 1), 
   * and shifts the position of the objects lower in the list accordingly
   *
   * @param mixed sortable object
   * @param Connection an optional connection object
   *
   * @return integer the old object's position
   *
   * @throws Exception if the database cannot execute the position updates
   **/  
  public function moveToTop($object, $con = null)
  {
    return self::moveToPosition($object, 1, $con);
  }
    
  /**
   * Moves the object to the top of the list (i.e. gives it position maxPosition), 
   * and shifts the position of the objects higher in the list accordingly
   *
   * @param mixed sortable object
   * @param Connection an optional connection object
   *
   * @return integer the old object's position
   *
   * @throws Exception if the database cannot execute the position updates
   **/  
  public function moveToBottom($object, $con = null)
  {
    $class = get_class($object);
    $peerClass = $class.'Peer';

    return self::moveToPosition($object, self::getMaxPosition($peerClass, self::getFKey($object), self::getFKey2($object), $con), $con);
  }

  /**
   * Inserts the object in the list at a given position, 
   * and shifts the position of the objects lower in the list accordingly
   *
   * @param mixed sortable object
   * @param integer position value
   * @param Connection an optional connection object
   *
   * @return integer the new object's position
   *
   * @throws Exception if the database cannot execute the position updates
   **/
  public function insertAtPosition($object, $position, $con = null)
  {
    $fKeyColumnName =  sfConfig::get('propel_behavior_sortableFk2_'.get_class($object).'_f_key', 'object_id');
    $fKeyColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $fKeyColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
    $fKey2ColumnName =  sfConfig::get('propel_behavior_sortableFk2_'.get_class($object).'_f_key2', 'object_id');
    $fKey2ColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $fKey2ColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
    $class = get_class($object);
    $peerClass = $class.'Peer';
    $rankColumnName = 'rank';
    if(!$con) $con = Propel::getConnection(constant("$peerClass::DATABASE_NAME"));

    try
    {
      $con->begin();
      
      // Shift the objects with a position higher than the given position
      $query = sprintf('UPDATE %s SET %s = %s + 1 WHERE %s >= ? AND %s = ? AND %s = ?',
        constant("$peerClass::TABLE_NAME"),
        $rankColumnName,
        $rankColumnName,
        $rankColumnName,
        $fKeyColumnPhpName,
        $fKey2ColumnPhpName
      );
      $stmt = $con->prepareStatement($query);
      $stmt->setInt(1, $position);
      $stmt->setInt(2, self::getFKey($object));
      $stmt->setInt(3, self::getFKey2($object));
      $stmt->executeQuery();

      // Move the object in the list, at the given position
      self::setPosition($object, $position);
      $object->save();

      $con->commit();
      return $position;
    }
    catch (Exception $e)
    {
      $con->rollback();
      throw $e;
    }
  } 
  
  /**
   * Sets the position of a new object before saving it
   *
   * @param mixed sortable object
   * @param Connection an optional connection object
   *
   **/  
  public function preSave($object, $con = null)
  {
    $class = get_class($object);
    $peerClass = $class.'Peer';
    $rankColumnName = 'rank';
    $rankColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $rankColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
    
    // new records need to be initialized with position = maxPosition +1 unless position is already set
    //if(!$object->getId() && !$object->isColumnModified($rankColumnPhpName))
    if($object->isNew() && !$object->isColumnModified($rankColumnPhpName))
    {
      self::setPosition($object, self::getMaxPosition($peerClass, self::getFKey($object), self::getFKey2($object))+1);
    }
  } 

  /**
   * Decreases all the positions of the items of the same class with higher positions
   *
   * @param mixed sortable object
   * @param Connection an optional connection object
   *
   **/  
  public function preDelete($object, $con = null)
  {  
    $class = get_class($object);
    $peerClass = $class.'Peer';
    $fKeyColumnName =  sfConfig::get('propel_behavior_sortableFk2_'.get_class($object).'_f_key', 'object_id');
    $fKeyColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $fKeyColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
    $fKey2ColumnName =  sfConfig::get('propel_behavior_sortableFk2_'.get_class($object).'_f_key2', 'object_id');
    $fKey2ColumnPhpName = call_user_func(array($peerClass, 'translateFieldName'), $fKey2ColumnName, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
    $class = get_class($object);
    $peerClass = $class.'Peer';
    $rankColumnName = 'rank';
    if(!$con) $con = Propel::getConnection(constant("$peerClass::DATABASE_NAME"));
    
    $query = sprintf('UPDATE %s SET %s = %s - 1 WHERE %s > ? AND %s = ?',
      constant("$peerClass::TABLE_NAME"),
      $rankColumnName,
      $rankColumnName,
      $rankColumnName,
      $fKeyColumnPhpName
    );
    $stmt = $con->prepareStatement($query);
    $stmt->setInt(1, $object->getPosition());
    $stmt->setInt(2, self::getFKey($object));
    $stmt->setInt(3, self::getFKey2($object));
    $stmt->executeQuery();
  }

  /**
   *
   */
  protected static function getClassFromPeerClass($peerClass)
  {
    return substr($peerClass, 0, -4);
  }

}
