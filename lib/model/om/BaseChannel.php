<?php

/**
 * Base class that represents a row from the 'channel' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseChannel extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ChannelPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the pic field.
	 * @var        string
	 */
	protected $pic;


	/**
	 * The value for the working field.
	 * @var        boolean
	 */
	protected $working = true;


	/**
	 * The value for the sql field.
	 * @var        string
	 */
	protected $sql;


	/**
	 * The value for the rank field.
	 * @var        int
	 */
	protected $rank = 0;

	/**
	 * Collection to store aggregation of collChannelI18ns.
	 * @var        array
	 */
	protected $collChannelI18ns;

	/**
	 * The criteria used to select the current contents of collChannelI18ns.
	 * @var        Criteria
	 */
	protected $lastChannelI18nCriteria = null;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

  /**
   * The value for the culture field.
   * @var string
   */
  protected $culture;

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{

		return $this->id;
	}

	/**
	 * Get the [pic] column value.
	 * 
	 * @return     string
	 */
	public function getPic()
	{

		return $this->pic;
	}

	/**
	 * Get the [working] column value.
	 * 
	 * @return     boolean
	 */
	public function getWorking()
	{

		return $this->working;
	}

	/**
	 * Get the [sql] column value.
	 * 
	 * @return     string
	 */
	public function getSql()
	{

		return $this->sql;
	}

	/**
	 * Get the [rank] column value.
	 * 
	 * @return     int
	 */
	public function getRank()
	{

		return $this->rank;
	}

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ChannelPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [pic] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setPic($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->pic !== $v) {
			$this->pic = $v;
			$this->modifiedColumns[] = ChannelPeer::PIC;
		}

	} // setPic()

	/**
	 * Set the value of [working] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setWorking($v)
	{

		if ($this->working !== $v || $v === true) {
			$this->working = $v;
			$this->modifiedColumns[] = ChannelPeer::WORKING;
		}

	} // setWorking()

	/**
	 * Set the value of [sql] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setSql($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sql !== $v) {
			$this->sql = $v;
			$this->modifiedColumns[] = ChannelPeer::SQL;
		}

	} // setSql()

	/**
	 * Set the value of [rank] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setRank($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->rank !== $v || $v === 0) {
			$this->rank = $v;
			$this->modifiedColumns[] = ChannelPeer::RANK;
		}

	} // setRank()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (1-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      ResultSet $rs The ResultSet class with cursor advanced to desired record pos.
	 * @param      int $startcol 1-based offset column which indicates which restultset column to start with.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->pic = $rs->getString($startcol + 1);

			$this->working = $rs->getBoolean($startcol + 2);

			$this->sql = $rs->getString($startcol + 3);

			$this->rank = $rs->getInt($startcol + 4);

			$this->resetModified();

			$this->setNew(false);
			$this->setCulture(sfContext::getInstance()->getUser()->getCulture());

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 5; // 5 = ChannelPeer::NUM_COLUMNS - ChannelPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Channel object", $e);
		}
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      Connection $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete($con = null)
	{

    foreach (sfMixer::getCallables('BaseChannel:delete:pre') as $callable)
    {
      $ret = call_user_func($callable, $this, $con);
      if ($ret)
      {
        return;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ChannelPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ChannelPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseChannel:delete:post') as $callable)
    {
      call_user_func($callable, $this, $con);
    }

  }
	/**
	 * Stores the object in the database.  If the object is new,
	 * it inserts it; otherwise an update is performed.  This method
	 * wraps the doSave() worker method in a transaction.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save($con = null)
	{

    foreach (sfMixer::getCallables('BaseChannel:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ChannelPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseChannel:save:post') as $callable)
    {
      call_user_func($callable, $this, $con, $affectedRows);
    }

			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Stores the object in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      Connection $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave($con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ChannelPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += ChannelPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collChannelI18ns !== null) {
				foreach($this->collChannelI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = ChannelPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collChannelI18ns !== null) {
					foreach($this->collChannelI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ChannelPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getPic();
				break;
			case 2:
				return $this->getWorking();
				break;
			case 3:
				return $this->getSql();
				break;
			case 4:
				return $this->getRank();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param      string $keyType One of the class type constants TYPE_PHPNAME,
	 *                        TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ChannelPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getPic(),
			$keys[2] => $this->getWorking(),
			$keys[3] => $this->getSql(),
			$keys[4] => $this->getRank(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants TYPE_PHPNAME,
	 *                     TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ChannelPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setPic($value);
				break;
			case 2:
				$this->setWorking($value);
				break;
			case 3:
				$this->setSql($value);
				break;
			case 4:
				$this->setRank($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME,
	 * TYPE_NUM. The default key type is the column's phpname (e.g. 'authorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ChannelPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPic($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setWorking($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSql($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRank($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ChannelPeer::DATABASE_NAME);

		if ($this->isColumnModified(ChannelPeer::ID)) $criteria->add(ChannelPeer::ID, $this->id);
		if ($this->isColumnModified(ChannelPeer::PIC)) $criteria->add(ChannelPeer::PIC, $this->pic);
		if ($this->isColumnModified(ChannelPeer::WORKING)) $criteria->add(ChannelPeer::WORKING, $this->working);
		if ($this->isColumnModified(ChannelPeer::SQL)) $criteria->add(ChannelPeer::SQL, $this->sql);
		if ($this->isColumnModified(ChannelPeer::RANK)) $criteria->add(ChannelPeer::RANK, $this->rank);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ChannelPeer::DATABASE_NAME);

		$criteria->add(ChannelPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Channel (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setPic($this->pic);

		$copyObj->setWorking($this->working);

		$copyObj->setSql($this->sql);

		$copyObj->setRank($this->rank);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getChannelI18ns() as $relObj) {
				$copyObj->addChannelI18n($relObj->copy($deepCopy));
			}

		} // if ($deepCopy)


		$copyObj->setNew(true);

		$copyObj->setId(NULL); // this is a pkey column, so set to default value

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Channel Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     ChannelPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ChannelPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collChannelI18ns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initChannelI18ns()
	{
		if ($this->collChannelI18ns === null) {
			$this->collChannelI18ns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Channel has previously
	 * been saved, it will retrieve related ChannelI18ns from storage.
	 * If this Channel is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getChannelI18ns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseChannelI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collChannelI18ns === null) {
			if ($this->isNew()) {
			   $this->collChannelI18ns = array();
			} else {

				$criteria->add(ChannelI18nPeer::ID, $this->getId());

				ChannelI18nPeer::addSelectColumns($criteria);
				$this->collChannelI18ns = ChannelI18nPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ChannelI18nPeer::ID, $this->getId());

				ChannelI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastChannelI18nCriteria) || !$this->lastChannelI18nCriteria->equals($criteria)) {
					$this->collChannelI18ns = ChannelI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastChannelI18nCriteria = $criteria;
		return $this->collChannelI18ns;
	}

	/**
	 * Returns the number of related ChannelI18ns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countChannelI18ns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseChannelI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ChannelI18nPeer::ID, $this->getId());

		return ChannelI18nPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ChannelI18n object to this object
	 * through the ChannelI18n foreign key attribute
	 *
	 * @param      ChannelI18n $l ChannelI18n
	 * @return     void
	 * @throws     PropelException
	 */
	public function addChannelI18n(ChannelI18n $l)
	{
		$this->collChannelI18ns[] = $l;
		$l->setChannel($this);
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collChannelI18ns) {
				foreach ((array) $this->collChannelI18ns as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collChannelI18ns = null;
	}

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getName()
  {
    $obj = $this->getCurrentChannelI18n();

    return ($obj ? $obj->getName() : null);
  }

  public function setName($value)
  {
    $this->getCurrentChannelI18n()->setName($value);
  }

  public function getDescription()
  {
    $obj = $this->getCurrentChannelI18n();

    return ($obj ? $obj->getDescription() : null);
  }

  public function setDescription($value)
  {
    $this->getCurrentChannelI18n()->setDescription($value);
  }

  protected $current_i18n = array();

  public function getCurrentChannelI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = ChannelI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setChannelI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setChannelI18nForCulture(new ChannelI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setChannelI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addChannelI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseChannel:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseChannel::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseChannel
