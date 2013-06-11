<?php

/**
 * Base class that represents a row from the 'role' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseRole extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        RolePeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the cod field.
	 * @var        string
	 */
	protected $cod;


	/**
	 * The value for the rank field.
	 * @var        int
	 */
	protected $rank = 0;


	/**
	 * The value for the xml field.
	 * @var        string
	 */
	protected $xml;


	/**
	 * The value for the display field.
	 * @var        boolean
	 */
	protected $display = true;

	/**
	 * Collection to store aggregation of collRoleI18ns.
	 * @var        array
	 */
	protected $collRoleI18ns;

	/**
	 * The criteria used to select the current contents of collRoleI18ns.
	 * @var        Criteria
	 */
	protected $lastRoleI18nCriteria = null;

	/**
	 * Collection to store aggregation of collMmPersons.
	 * @var        array
	 */
	protected $collMmPersons;

	/**
	 * The criteria used to select the current contents of collMmPersons.
	 * @var        Criteria
	 */
	protected $lastMmPersonCriteria = null;

	/**
	 * Collection to store aggregation of collMmTemplatePersons.
	 * @var        array
	 */
	protected $collMmTemplatePersons;

	/**
	 * The criteria used to select the current contents of collMmTemplatePersons.
	 * @var        Criteria
	 */
	protected $lastMmTemplatePersonCriteria = null;

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
	 * Get the [cod] column value.
	 * 
	 * @return     string
	 */
	public function getCod()
	{

		return $this->cod;
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
	 * Get the [xml] column value.
	 * 
	 * @return     string
	 */
	public function getXml()
	{

		return $this->xml;
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
			$this->modifiedColumns[] = RolePeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [cod] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCod($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->cod !== $v) {
			$this->cod = $v;
			$this->modifiedColumns[] = RolePeer::COD;
		}

	} // setCod()

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
			$this->modifiedColumns[] = RolePeer::RANK;
		}

	} // setRank()

	/**
	 * Set the value of [xml] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setXml($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->xml !== $v) {
			$this->xml = $v;
			$this->modifiedColumns[] = RolePeer::XML;
		}

	} // setXml()

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
			$this->modifiedColumns[] = RolePeer::DISPLAY;
		}

	} // setDisplay()

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

			$this->cod = $rs->getString($startcol + 1);

			$this->rank = $rs->getInt($startcol + 2);

			$this->xml = $rs->getString($startcol + 3);

			$this->display = $rs->getBoolean($startcol + 4);

			$this->resetModified();

			$this->setNew(false);
			$this->setCulture(sfContext::getInstance()->getUser()->getCulture());

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 5; // 5 = RolePeer::NUM_COLUMNS - RolePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Role object", $e);
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

    foreach (sfMixer::getCallables('BaseRole:delete:pre') as $callable)
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
			$con = Propel::getConnection(RolePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RolePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseRole:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseRole:save:pre') as $callable)
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
			$con = Propel::getConnection(RolePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseRole:save:post') as $callable)
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
					$pk = RolePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += RolePeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collRoleI18ns !== null) {
				foreach($this->collRoleI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMmPersons !== null) {
				foreach($this->collMmPersons as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMmTemplatePersons !== null) {
				foreach($this->collMmTemplatePersons as $referrerFK) {
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


			if (($retval = RolePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collRoleI18ns !== null) {
					foreach($this->collRoleI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMmPersons !== null) {
					foreach($this->collMmPersons as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMmTemplatePersons !== null) {
					foreach($this->collMmTemplatePersons as $referrerFK) {
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
		$pos = RolePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCod();
				break;
			case 2:
				return $this->getRank();
				break;
			case 3:
				return $this->getXml();
				break;
			case 4:
				return $this->getDisplay();
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
		$keys = RolePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCod(),
			$keys[2] => $this->getRank(),
			$keys[3] => $this->getXml(),
			$keys[4] => $this->getDisplay(),
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
		$pos = RolePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCod($value);
				break;
			case 2:
				$this->setRank($value);
				break;
			case 3:
				$this->setXml($value);
				break;
			case 4:
				$this->setDisplay($value);
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
		$keys = RolePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCod($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRank($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setXml($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDisplay($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(RolePeer::DATABASE_NAME);

		if ($this->isColumnModified(RolePeer::ID)) $criteria->add(RolePeer::ID, $this->id);
		if ($this->isColumnModified(RolePeer::COD)) $criteria->add(RolePeer::COD, $this->cod);
		if ($this->isColumnModified(RolePeer::RANK)) $criteria->add(RolePeer::RANK, $this->rank);
		if ($this->isColumnModified(RolePeer::XML)) $criteria->add(RolePeer::XML, $this->xml);
		if ($this->isColumnModified(RolePeer::DISPLAY)) $criteria->add(RolePeer::DISPLAY, $this->display);

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
		$criteria = new Criteria(RolePeer::DATABASE_NAME);

		$criteria->add(RolePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Role (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCod($this->cod);

		$copyObj->setRank($this->rank);

		$copyObj->setXml($this->xml);

		$copyObj->setDisplay($this->display);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getRoleI18ns() as $relObj) {
				$copyObj->addRoleI18n($relObj->copy($deepCopy));
			}

			foreach($this->getMmPersons() as $relObj) {
				$copyObj->addMmPerson($relObj->copy($deepCopy));
			}

			foreach($this->getMmTemplatePersons() as $relObj) {
				$copyObj->addMmTemplatePerson($relObj->copy($deepCopy));
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
	 * @return     Role Clone of current object.
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
	 * @return     RolePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new RolePeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collRoleI18ns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRoleI18ns()
	{
		if ($this->collRoleI18ns === null) {
			$this->collRoleI18ns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Role has previously
	 * been saved, it will retrieve related RoleI18ns from storage.
	 * If this Role is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRoleI18ns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRoleI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRoleI18ns === null) {
			if ($this->isNew()) {
			   $this->collRoleI18ns = array();
			} else {

				$criteria->add(RoleI18nPeer::ID, $this->getId());

				RoleI18nPeer::addSelectColumns($criteria);
				$this->collRoleI18ns = RoleI18nPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RoleI18nPeer::ID, $this->getId());

				RoleI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastRoleI18nCriteria) || !$this->lastRoleI18nCriteria->equals($criteria)) {
					$this->collRoleI18ns = RoleI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRoleI18nCriteria = $criteria;
		return $this->collRoleI18ns;
	}

	/**
	 * Returns the number of related RoleI18ns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRoleI18ns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRoleI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RoleI18nPeer::ID, $this->getId());

		return RoleI18nPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RoleI18n object to this object
	 * through the RoleI18n foreign key attribute
	 *
	 * @param      RoleI18n $l RoleI18n
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRoleI18n(RoleI18n $l)
	{
		$this->collRoleI18ns[] = $l;
		$l->setRole($this);
	}

	/**
	 * Temporary storage of collMmPersons to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initMmPersons()
	{
		if ($this->collMmPersons === null) {
			$this->collMmPersons = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Role has previously
	 * been saved, it will retrieve related MmPersons from storage.
	 * If this Role is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getMmPersons($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmPersonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmPersons === null) {
			if ($this->isNew()) {
			   $this->collMmPersons = array();
			} else {

				$criteria->add(MmPersonPeer::ROLE_ID, $this->getId());

				MmPersonPeer::addSelectColumns($criteria);
				$this->collMmPersons = MmPersonPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmPersonPeer::ROLE_ID, $this->getId());

				MmPersonPeer::addSelectColumns($criteria);
				if (!isset($this->lastMmPersonCriteria) || !$this->lastMmPersonCriteria->equals($criteria)) {
					$this->collMmPersons = MmPersonPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMmPersonCriteria = $criteria;
		return $this->collMmPersons;
	}

	/**
	 * Returns the number of related MmPersons.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countMmPersons($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmPersonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MmPersonPeer::ROLE_ID, $this->getId());

		return MmPersonPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a MmPerson object to this object
	 * through the MmPerson foreign key attribute
	 *
	 * @param      MmPerson $l MmPerson
	 * @return     void
	 * @throws     PropelException
	 */
	public function addMmPerson(MmPerson $l)
	{
		$this->collMmPersons[] = $l;
		$l->setRole($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Role is new, it will return
	 * an empty collection; or if this Role has previously
	 * been saved, it will retrieve related MmPersons from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Role.
	 */
	public function getMmPersonsJoinMm($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmPersonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmPersons === null) {
			if ($this->isNew()) {
				$this->collMmPersons = array();
			} else {

				$criteria->add(MmPersonPeer::ROLE_ID, $this->getId());

				$this->collMmPersons = MmPersonPeer::doSelectJoinMm($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmPersonPeer::ROLE_ID, $this->getId());

			if (!isset($this->lastMmPersonCriteria) || !$this->lastMmPersonCriteria->equals($criteria)) {
				$this->collMmPersons = MmPersonPeer::doSelectJoinMm($criteria, $con);
			}
		}
		$this->lastMmPersonCriteria = $criteria;

		return $this->collMmPersons;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Role is new, it will return
	 * an empty collection; or if this Role has previously
	 * been saved, it will retrieve related MmPersons from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Role.
	 */
	public function getMmPersonsJoinPerson($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmPersonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmPersons === null) {
			if ($this->isNew()) {
				$this->collMmPersons = array();
			} else {

				$criteria->add(MmPersonPeer::ROLE_ID, $this->getId());

				$this->collMmPersons = MmPersonPeer::doSelectJoinPerson($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmPersonPeer::ROLE_ID, $this->getId());

			if (!isset($this->lastMmPersonCriteria) || !$this->lastMmPersonCriteria->equals($criteria)) {
				$this->collMmPersons = MmPersonPeer::doSelectJoinPerson($criteria, $con);
			}
		}
		$this->lastMmPersonCriteria = $criteria;

		return $this->collMmPersons;
	}

	/**
	 * Temporary storage of collMmTemplatePersons to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initMmTemplatePersons()
	{
		if ($this->collMmTemplatePersons === null) {
			$this->collMmTemplatePersons = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Role has previously
	 * been saved, it will retrieve related MmTemplatePersons from storage.
	 * If this Role is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getMmTemplatePersons($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmTemplatePersonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmTemplatePersons === null) {
			if ($this->isNew()) {
			   $this->collMmTemplatePersons = array();
			} else {

				$criteria->add(MmTemplatePersonPeer::ROLE_ID, $this->getId());

				MmTemplatePersonPeer::addSelectColumns($criteria);
				$this->collMmTemplatePersons = MmTemplatePersonPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmTemplatePersonPeer::ROLE_ID, $this->getId());

				MmTemplatePersonPeer::addSelectColumns($criteria);
				if (!isset($this->lastMmTemplatePersonCriteria) || !$this->lastMmTemplatePersonCriteria->equals($criteria)) {
					$this->collMmTemplatePersons = MmTemplatePersonPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMmTemplatePersonCriteria = $criteria;
		return $this->collMmTemplatePersons;
	}

	/**
	 * Returns the number of related MmTemplatePersons.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countMmTemplatePersons($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmTemplatePersonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MmTemplatePersonPeer::ROLE_ID, $this->getId());

		return MmTemplatePersonPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a MmTemplatePerson object to this object
	 * through the MmTemplatePerson foreign key attribute
	 *
	 * @param      MmTemplatePerson $l MmTemplatePerson
	 * @return     void
	 * @throws     PropelException
	 */
	public function addMmTemplatePerson(MmTemplatePerson $l)
	{
		$this->collMmTemplatePersons[] = $l;
		$l->setRole($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Role is new, it will return
	 * an empty collection; or if this Role has previously
	 * been saved, it will retrieve related MmTemplatePersons from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Role.
	 */
	public function getMmTemplatePersonsJoinMmTemplate($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmTemplatePersonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmTemplatePersons === null) {
			if ($this->isNew()) {
				$this->collMmTemplatePersons = array();
			} else {

				$criteria->add(MmTemplatePersonPeer::ROLE_ID, $this->getId());

				$this->collMmTemplatePersons = MmTemplatePersonPeer::doSelectJoinMmTemplate($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmTemplatePersonPeer::ROLE_ID, $this->getId());

			if (!isset($this->lastMmTemplatePersonCriteria) || !$this->lastMmTemplatePersonCriteria->equals($criteria)) {
				$this->collMmTemplatePersons = MmTemplatePersonPeer::doSelectJoinMmTemplate($criteria, $con);
			}
		}
		$this->lastMmTemplatePersonCriteria = $criteria;

		return $this->collMmTemplatePersons;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Role is new, it will return
	 * an empty collection; or if this Role has previously
	 * been saved, it will retrieve related MmTemplatePersons from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Role.
	 */
	public function getMmTemplatePersonsJoinPerson($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmTemplatePersonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmTemplatePersons === null) {
			if ($this->isNew()) {
				$this->collMmTemplatePersons = array();
			} else {

				$criteria->add(MmTemplatePersonPeer::ROLE_ID, $this->getId());

				$this->collMmTemplatePersons = MmTemplatePersonPeer::doSelectJoinPerson($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmTemplatePersonPeer::ROLE_ID, $this->getId());

			if (!isset($this->lastMmTemplatePersonCriteria) || !$this->lastMmTemplatePersonCriteria->equals($criteria)) {
				$this->collMmTemplatePersons = MmTemplatePersonPeer::doSelectJoinPerson($criteria, $con);
			}
		}
		$this->lastMmTemplatePersonCriteria = $criteria;

		return $this->collMmTemplatePersons;
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
			if ($this->collRoleI18ns) {
				foreach ((array) $this->collRoleI18ns as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collMmPersons) {
				foreach ((array) $this->collMmPersons as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collMmTemplatePersons) {
				foreach ((array) $this->collMmTemplatePersons as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collRoleI18ns = null;
		$this->collMmPersons = null;
		$this->collMmTemplatePersons = null;
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
    $obj = $this->getCurrentRoleI18n();

    return ($obj ? $obj->getName() : null);
  }

  public function setName($value)
  {
    $this->getCurrentRoleI18n()->setName($value);
  }

  public function getText()
  {
    $obj = $this->getCurrentRoleI18n();

    return ($obj ? $obj->getText() : null);
  }

  public function setText($value)
  {
    $this->getCurrentRoleI18n()->setText($value);
  }

  protected $current_i18n = array();

  public function getCurrentRoleI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = RoleI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setRoleI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setRoleI18nForCulture(new RoleI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setRoleI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addRoleI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseRole:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseRole::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseRole
