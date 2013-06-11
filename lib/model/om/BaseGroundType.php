<?php

/**
 * Base class that represents a row from the 'ground_type' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseGroundType extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        GroundTypePeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;


	/**
	 * The value for the display field.
	 * @var        boolean
	 */
	protected $display = true;


	/**
	 * The value for the rank field.
	 * @var        int
	 */
	protected $rank = 0;

	/**
	 * Collection to store aggregation of collGrounds.
	 * @var        array
	 */
	protected $collGrounds;

	/**
	 * The criteria used to select the current contents of collGrounds.
	 * @var        Criteria
	 */
	protected $lastGroundCriteria = null;

	/**
	 * Collection to store aggregation of collGroundTypeI18ns.
	 * @var        array
	 */
	protected $collGroundTypeI18ns;

	/**
	 * The criteria used to select the current contents of collGroundTypeI18ns.
	 * @var        Criteria
	 */
	protected $lastGroundTypeI18nCriteria = null;

	/**
	 * Collection to store aggregation of collVirtualGrounds.
	 * @var        array
	 */
	protected $collVirtualGrounds;

	/**
	 * The criteria used to select the current contents of collVirtualGrounds.
	 * @var        Criteria
	 */
	protected $lastVirtualGroundCriteria = null;

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
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{

		return $this->name;
	}

	/**
	 * Get the [display] column value.
	 * 
	 * @return     boolean
	 */
	public function getDisplay()
	{

		return $this->display;
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
			$this->modifiedColumns[] = GroundTypePeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setName($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = GroundTypePeer::NAME;
		}

	} // setName()

	/**
	 * Set the value of [display] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setDisplay($v)
	{

		if ($this->display !== $v || $v === true) {
			$this->display = $v;
			$this->modifiedColumns[] = GroundTypePeer::DISPLAY;
		}

	} // setDisplay()

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
			$this->modifiedColumns[] = GroundTypePeer::RANK;
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

			$this->name = $rs->getString($startcol + 1);

			$this->display = $rs->getBoolean($startcol + 2);

			$this->rank = $rs->getInt($startcol + 3);

			$this->resetModified();

			$this->setNew(false);
			$this->setCulture(sfContext::getInstance()->getUser()->getCulture());

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 4; // 4 = GroundTypePeer::NUM_COLUMNS - GroundTypePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating GroundType object", $e);
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

    foreach (sfMixer::getCallables('BaseGroundType:delete:pre') as $callable)
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
			$con = Propel::getConnection(GroundTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			GroundTypePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseGroundType:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseGroundType:save:pre') as $callable)
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
			$con = Propel::getConnection(GroundTypePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseGroundType:save:post') as $callable)
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
					$pk = GroundTypePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += GroundTypePeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collGrounds !== null) {
				foreach($this->collGrounds as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collGroundTypeI18ns !== null) {
				foreach($this->collGroundTypeI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVirtualGrounds !== null) {
				foreach($this->collVirtualGrounds as $referrerFK) {
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


			if (($retval = GroundTypePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collGrounds !== null) {
					foreach($this->collGrounds as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collGroundTypeI18ns !== null) {
					foreach($this->collGroundTypeI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVirtualGrounds !== null) {
					foreach($this->collVirtualGrounds as $referrerFK) {
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
		$pos = GroundTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getName();
				break;
			case 2:
				return $this->getDisplay();
				break;
			case 3:
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
		$keys = GroundTypePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getDisplay(),
			$keys[3] => $this->getRank(),
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
		$pos = GroundTypePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setName($value);
				break;
			case 2:
				$this->setDisplay($value);
				break;
			case 3:
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
		$keys = GroundTypePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDisplay($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRank($arr[$keys[3]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(GroundTypePeer::DATABASE_NAME);

		if ($this->isColumnModified(GroundTypePeer::ID)) $criteria->add(GroundTypePeer::ID, $this->id);
		if ($this->isColumnModified(GroundTypePeer::NAME)) $criteria->add(GroundTypePeer::NAME, $this->name);
		if ($this->isColumnModified(GroundTypePeer::DISPLAY)) $criteria->add(GroundTypePeer::DISPLAY, $this->display);
		if ($this->isColumnModified(GroundTypePeer::RANK)) $criteria->add(GroundTypePeer::RANK, $this->rank);

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
		$criteria = new Criteria(GroundTypePeer::DATABASE_NAME);

		$criteria->add(GroundTypePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of GroundType (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);

		$copyObj->setDisplay($this->display);

		$copyObj->setRank($this->rank);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getGrounds() as $relObj) {
				$copyObj->addGround($relObj->copy($deepCopy));
			}

			foreach($this->getGroundTypeI18ns() as $relObj) {
				$copyObj->addGroundTypeI18n($relObj->copy($deepCopy));
			}

			foreach($this->getVirtualGrounds() as $relObj) {
				$copyObj->addVirtualGround($relObj->copy($deepCopy));
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
	 * @return     GroundType Clone of current object.
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
	 * @return     GroundTypePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new GroundTypePeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collGrounds to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initGrounds()
	{
		if ($this->collGrounds === null) {
			$this->collGrounds = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this GroundType has previously
	 * been saved, it will retrieve related Grounds from storage.
	 * If this GroundType is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getGrounds($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseGroundPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGrounds === null) {
			if ($this->isNew()) {
			   $this->collGrounds = array();
			} else {

				$criteria->add(GroundPeer::GROUND_TYPE_ID, $this->getId());

				GroundPeer::addSelectColumns($criteria);
				$this->collGrounds = GroundPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(GroundPeer::GROUND_TYPE_ID, $this->getId());

				GroundPeer::addSelectColumns($criteria);
				if (!isset($this->lastGroundCriteria) || !$this->lastGroundCriteria->equals($criteria)) {
					$this->collGrounds = GroundPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGroundCriteria = $criteria;
		return $this->collGrounds;
	}

	/**
	 * Returns the number of related Grounds.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countGrounds($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseGroundPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(GroundPeer::GROUND_TYPE_ID, $this->getId());

		return GroundPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Ground object to this object
	 * through the Ground foreign key attribute
	 *
	 * @param      Ground $l Ground
	 * @return     void
	 * @throws     PropelException
	 */
	public function addGround(Ground $l)
	{
		$this->collGrounds[] = $l;
		$l->setGroundType($this);
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this GroundType has previously
	 * been saved, it will retrieve related Grounds from storage.
	 * If this GroundType is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getGroundsWithI18n($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseGroundPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGrounds === null) {
			if ($this->isNew()) {
			   $this->collGrounds = array();
			} else {

				$criteria->add(GroundPeer::GROUND_TYPE_ID, $this->getId());

				$this->collGrounds = GroundPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(GroundPeer::GROUND_TYPE_ID, $this->getId());

				if (!isset($this->lastGroundCriteria) || !$this->lastGroundCriteria->equals($criteria)) {
					$this->collGrounds = GroundPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
				}
			}
		}
		$this->lastGroundCriteria = $criteria;
		return $this->collGrounds;
	}

	/**
	 * Temporary storage of collGroundTypeI18ns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initGroundTypeI18ns()
	{
		if ($this->collGroundTypeI18ns === null) {
			$this->collGroundTypeI18ns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this GroundType has previously
	 * been saved, it will retrieve related GroundTypeI18ns from storage.
	 * If this GroundType is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getGroundTypeI18ns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseGroundTypeI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGroundTypeI18ns === null) {
			if ($this->isNew()) {
			   $this->collGroundTypeI18ns = array();
			} else {

				$criteria->add(GroundTypeI18nPeer::ID, $this->getId());

				GroundTypeI18nPeer::addSelectColumns($criteria);
				$this->collGroundTypeI18ns = GroundTypeI18nPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(GroundTypeI18nPeer::ID, $this->getId());

				GroundTypeI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastGroundTypeI18nCriteria) || !$this->lastGroundTypeI18nCriteria->equals($criteria)) {
					$this->collGroundTypeI18ns = GroundTypeI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGroundTypeI18nCriteria = $criteria;
		return $this->collGroundTypeI18ns;
	}

	/**
	 * Returns the number of related GroundTypeI18ns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countGroundTypeI18ns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseGroundTypeI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(GroundTypeI18nPeer::ID, $this->getId());

		return GroundTypeI18nPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a GroundTypeI18n object to this object
	 * through the GroundTypeI18n foreign key attribute
	 *
	 * @param      GroundTypeI18n $l GroundTypeI18n
	 * @return     void
	 * @throws     PropelException
	 */
	public function addGroundTypeI18n(GroundTypeI18n $l)
	{
		$this->collGroundTypeI18ns[] = $l;
		$l->setGroundType($this);
	}

	/**
	 * Temporary storage of collVirtualGrounds to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVirtualGrounds()
	{
		if ($this->collVirtualGrounds === null) {
			$this->collVirtualGrounds = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this GroundType has previously
	 * been saved, it will retrieve related VirtualGrounds from storage.
	 * If this GroundType is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVirtualGrounds($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVirtualGroundPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVirtualGrounds === null) {
			if ($this->isNew()) {
			   $this->collVirtualGrounds = array();
			} else {

				$criteria->add(VirtualGroundPeer::GROUND_TYPE_ID, $this->getId());

				VirtualGroundPeer::addSelectColumns($criteria);
				$this->collVirtualGrounds = VirtualGroundPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VirtualGroundPeer::GROUND_TYPE_ID, $this->getId());

				VirtualGroundPeer::addSelectColumns($criteria);
				if (!isset($this->lastVirtualGroundCriteria) || !$this->lastVirtualGroundCriteria->equals($criteria)) {
					$this->collVirtualGrounds = VirtualGroundPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVirtualGroundCriteria = $criteria;
		return $this->collVirtualGrounds;
	}

	/**
	 * Returns the number of related VirtualGrounds.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVirtualGrounds($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVirtualGroundPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VirtualGroundPeer::GROUND_TYPE_ID, $this->getId());

		return VirtualGroundPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a VirtualGround object to this object
	 * through the VirtualGround foreign key attribute
	 *
	 * @param      VirtualGround $l VirtualGround
	 * @return     void
	 * @throws     PropelException
	 */
	public function addVirtualGround(VirtualGround $l)
	{
		$this->collVirtualGrounds[] = $l;
		$l->setGroundType($this);
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this GroundType has previously
	 * been saved, it will retrieve related VirtualGrounds from storage.
	 * If this GroundType is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVirtualGroundsWithI18n($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVirtualGroundPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVirtualGrounds === null) {
			if ($this->isNew()) {
			   $this->collVirtualGrounds = array();
			} else {

				$criteria->add(VirtualGroundPeer::GROUND_TYPE_ID, $this->getId());

				$this->collVirtualGrounds = VirtualGroundPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VirtualGroundPeer::GROUND_TYPE_ID, $this->getId());

				if (!isset($this->lastVirtualGroundCriteria) || !$this->lastVirtualGroundCriteria->equals($criteria)) {
					$this->collVirtualGrounds = VirtualGroundPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
				}
			}
		}
		$this->lastVirtualGroundCriteria = $criteria;
		return $this->collVirtualGrounds;
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
			if ($this->collGrounds) {
				foreach ((array) $this->collGrounds as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collGroundTypeI18ns) {
				foreach ((array) $this->collGroundTypeI18ns as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collVirtualGrounds) {
				foreach ((array) $this->collVirtualGrounds as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collGrounds = null;
		$this->collGroundTypeI18ns = null;
		$this->collVirtualGrounds = null;
	}

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getDescription()
  {
    $obj = $this->getCurrentGroundTypeI18n();

    return ($obj ? $obj->getDescription() : null);
  }

  public function setDescription($value)
  {
    $this->getCurrentGroundTypeI18n()->setDescription($value);
  }

  protected $current_i18n = array();

  public function getCurrentGroundTypeI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = GroundTypeI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setGroundTypeI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setGroundTypeI18nForCulture(new GroundTypeI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setGroundTypeI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addGroundTypeI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseGroundType:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseGroundType::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseGroundType
