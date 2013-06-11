<?php

/**
 * Base class that represents a row from the 'person' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BasePerson extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PersonPeer
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
	 * The value for the email field.
	 * @var        string
	 */
	protected $email;


	/**
	 * The value for the web field.
	 * @var        string
	 */
	protected $web;


	/**
	 * The value for the phone field.
	 * @var        string
	 */
	protected $phone;

	/**
	 * Collection to store aggregation of collPersonI18ns.
	 * @var        array
	 */
	protected $collPersonI18ns;

	/**
	 * The criteria used to select the current contents of collPersonI18ns.
	 * @var        Criteria
	 */
	protected $lastPersonI18nCriteria = null;

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
	 * Collection to store aggregation of collPicPersons.
	 * @var        array
	 */
	protected $collPicPersons;

	/**
	 * The criteria used to select the current contents of collPicPersons.
	 * @var        Criteria
	 */
	protected $lastPicPersonCriteria = null;

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
	 * Get the [email] column value.
	 * 
	 * @return     string
	 */
	public function getEmail()
	{

		return $this->email;
	}

	/**
	 * Get the [web] column value.
	 * 
	 * @return     string
	 */
	public function getWeb()
	{

		return $this->web;
	}

	/**
	 * Get the [phone] column value.
	 * 
	 * @return     string
	 */
	public function getPhone()
	{

		return $this->phone;
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
			$this->modifiedColumns[] = PersonPeer::ID;
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
			$this->modifiedColumns[] = PersonPeer::NAME;
		}

	} // setName()

	/**
	 * Set the value of [email] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setEmail($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = PersonPeer::EMAIL;
		}

	} // setEmail()

	/**
	 * Set the value of [web] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setWeb($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->web !== $v) {
			$this->web = $v;
			$this->modifiedColumns[] = PersonPeer::WEB;
		}

	} // setWeb()

	/**
	 * Set the value of [phone] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setPhone($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->phone !== $v) {
			$this->phone = $v;
			$this->modifiedColumns[] = PersonPeer::PHONE;
		}

	} // setPhone()

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

			$this->email = $rs->getString($startcol + 2);

			$this->web = $rs->getString($startcol + 3);

			$this->phone = $rs->getString($startcol + 4);

			$this->resetModified();

			$this->setNew(false);
			$this->setCulture(sfContext::getInstance()->getUser()->getCulture());

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 5; // 5 = PersonPeer::NUM_COLUMNS - PersonPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Person object", $e);
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

    foreach (sfMixer::getCallables('BasePerson:delete:pre') as $callable)
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
			$con = Propel::getConnection(PersonPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PersonPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePerson:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BasePerson:save:pre') as $callable)
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
			$con = Propel::getConnection(PersonPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePerson:save:post') as $callable)
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
					$pk = PersonPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += PersonPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collPersonI18ns !== null) {
				foreach($this->collPersonI18ns as $referrerFK) {
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

			if ($this->collPicPersons !== null) {
				foreach($this->collPicPersons as $referrerFK) {
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


			if (($retval = PersonPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPersonI18ns !== null) {
					foreach($this->collPersonI18ns as $referrerFK) {
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

				if ($this->collPicPersons !== null) {
					foreach($this->collPicPersons as $referrerFK) {
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
		$pos = PersonPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getEmail();
				break;
			case 3:
				return $this->getWeb();
				break;
			case 4:
				return $this->getPhone();
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
		$keys = PersonPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getEmail(),
			$keys[3] => $this->getWeb(),
			$keys[4] => $this->getPhone(),
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
		$pos = PersonPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setEmail($value);
				break;
			case 3:
				$this->setWeb($value);
				break;
			case 4:
				$this->setPhone($value);
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
		$keys = PersonPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEmail($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setWeb($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPhone($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PersonPeer::DATABASE_NAME);

		if ($this->isColumnModified(PersonPeer::ID)) $criteria->add(PersonPeer::ID, $this->id);
		if ($this->isColumnModified(PersonPeer::NAME)) $criteria->add(PersonPeer::NAME, $this->name);
		if ($this->isColumnModified(PersonPeer::EMAIL)) $criteria->add(PersonPeer::EMAIL, $this->email);
		if ($this->isColumnModified(PersonPeer::WEB)) $criteria->add(PersonPeer::WEB, $this->web);
		if ($this->isColumnModified(PersonPeer::PHONE)) $criteria->add(PersonPeer::PHONE, $this->phone);

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
		$criteria = new Criteria(PersonPeer::DATABASE_NAME);

		$criteria->add(PersonPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Person (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);

		$copyObj->setEmail($this->email);

		$copyObj->setWeb($this->web);

		$copyObj->setPhone($this->phone);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getPersonI18ns() as $relObj) {
				$copyObj->addPersonI18n($relObj->copy($deepCopy));
			}

			foreach($this->getMmPersons() as $relObj) {
				$copyObj->addMmPerson($relObj->copy($deepCopy));
			}

			foreach($this->getMmTemplatePersons() as $relObj) {
				$copyObj->addMmTemplatePerson($relObj->copy($deepCopy));
			}

			foreach($this->getPicPersons() as $relObj) {
				$copyObj->addPicPerson($relObj->copy($deepCopy));
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
	 * @return     Person Clone of current object.
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
	 * @return     PersonPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PersonPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collPersonI18ns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPersonI18ns()
	{
		if ($this->collPersonI18ns === null) {
			$this->collPersonI18ns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Person has previously
	 * been saved, it will retrieve related PersonI18ns from storage.
	 * If this Person is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPersonI18ns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePersonI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPersonI18ns === null) {
			if ($this->isNew()) {
			   $this->collPersonI18ns = array();
			} else {

				$criteria->add(PersonI18nPeer::ID, $this->getId());

				PersonI18nPeer::addSelectColumns($criteria);
				$this->collPersonI18ns = PersonI18nPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PersonI18nPeer::ID, $this->getId());

				PersonI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastPersonI18nCriteria) || !$this->lastPersonI18nCriteria->equals($criteria)) {
					$this->collPersonI18ns = PersonI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPersonI18nCriteria = $criteria;
		return $this->collPersonI18ns;
	}

	/**
	 * Returns the number of related PersonI18ns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPersonI18ns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePersonI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PersonI18nPeer::ID, $this->getId());

		return PersonI18nPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a PersonI18n object to this object
	 * through the PersonI18n foreign key attribute
	 *
	 * @param      PersonI18n $l PersonI18n
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPersonI18n(PersonI18n $l)
	{
		$this->collPersonI18ns[] = $l;
		$l->setPerson($this);
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
	 * Otherwise if this Person has previously
	 * been saved, it will retrieve related MmPersons from storage.
	 * If this Person is new, it will return
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

				$criteria->add(MmPersonPeer::PERSON_ID, $this->getId());

				MmPersonPeer::addSelectColumns($criteria);
				$this->collMmPersons = MmPersonPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmPersonPeer::PERSON_ID, $this->getId());

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

		$criteria->add(MmPersonPeer::PERSON_ID, $this->getId());

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
		$l->setPerson($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Person is new, it will return
	 * an empty collection; or if this Person has previously
	 * been saved, it will retrieve related MmPersons from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Person.
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

				$criteria->add(MmPersonPeer::PERSON_ID, $this->getId());

				$this->collMmPersons = MmPersonPeer::doSelectJoinMm($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmPersonPeer::PERSON_ID, $this->getId());

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
	 * Otherwise if this Person is new, it will return
	 * an empty collection; or if this Person has previously
	 * been saved, it will retrieve related MmPersons from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Person.
	 */
	public function getMmPersonsJoinRole($criteria = null, $con = null)
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

				$criteria->add(MmPersonPeer::PERSON_ID, $this->getId());

				$this->collMmPersons = MmPersonPeer::doSelectJoinRole($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmPersonPeer::PERSON_ID, $this->getId());

			if (!isset($this->lastMmPersonCriteria) || !$this->lastMmPersonCriteria->equals($criteria)) {
				$this->collMmPersons = MmPersonPeer::doSelectJoinRole($criteria, $con);
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
	 * Otherwise if this Person has previously
	 * been saved, it will retrieve related MmTemplatePersons from storage.
	 * If this Person is new, it will return
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

				$criteria->add(MmTemplatePersonPeer::PERSON_ID, $this->getId());

				MmTemplatePersonPeer::addSelectColumns($criteria);
				$this->collMmTemplatePersons = MmTemplatePersonPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmTemplatePersonPeer::PERSON_ID, $this->getId());

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

		$criteria->add(MmTemplatePersonPeer::PERSON_ID, $this->getId());

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
		$l->setPerson($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Person is new, it will return
	 * an empty collection; or if this Person has previously
	 * been saved, it will retrieve related MmTemplatePersons from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Person.
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

				$criteria->add(MmTemplatePersonPeer::PERSON_ID, $this->getId());

				$this->collMmTemplatePersons = MmTemplatePersonPeer::doSelectJoinMmTemplate($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmTemplatePersonPeer::PERSON_ID, $this->getId());

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
	 * Otherwise if this Person is new, it will return
	 * an empty collection; or if this Person has previously
	 * been saved, it will retrieve related MmTemplatePersons from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Person.
	 */
	public function getMmTemplatePersonsJoinRole($criteria = null, $con = null)
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

				$criteria->add(MmTemplatePersonPeer::PERSON_ID, $this->getId());

				$this->collMmTemplatePersons = MmTemplatePersonPeer::doSelectJoinRole($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmTemplatePersonPeer::PERSON_ID, $this->getId());

			if (!isset($this->lastMmTemplatePersonCriteria) || !$this->lastMmTemplatePersonCriteria->equals($criteria)) {
				$this->collMmTemplatePersons = MmTemplatePersonPeer::doSelectJoinRole($criteria, $con);
			}
		}
		$this->lastMmTemplatePersonCriteria = $criteria;

		return $this->collMmTemplatePersons;
	}

	/**
	 * Temporary storage of collPicPersons to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPicPersons()
	{
		if ($this->collPicPersons === null) {
			$this->collPicPersons = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Person has previously
	 * been saved, it will retrieve related PicPersons from storage.
	 * If this Person is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPicPersons($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePicPersonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPicPersons === null) {
			if ($this->isNew()) {
			   $this->collPicPersons = array();
			} else {

				$criteria->add(PicPersonPeer::OTHER_ID, $this->getId());

				PicPersonPeer::addSelectColumns($criteria);
				$this->collPicPersons = PicPersonPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PicPersonPeer::OTHER_ID, $this->getId());

				PicPersonPeer::addSelectColumns($criteria);
				if (!isset($this->lastPicPersonCriteria) || !$this->lastPicPersonCriteria->equals($criteria)) {
					$this->collPicPersons = PicPersonPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPicPersonCriteria = $criteria;
		return $this->collPicPersons;
	}

	/**
	 * Returns the number of related PicPersons.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPicPersons($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePicPersonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PicPersonPeer::OTHER_ID, $this->getId());

		return PicPersonPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a PicPerson object to this object
	 * through the PicPerson foreign key attribute
	 *
	 * @param      PicPerson $l PicPerson
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPicPerson(PicPerson $l)
	{
		$this->collPicPersons[] = $l;
		$l->setPerson($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Person is new, it will return
	 * an empty collection; or if this Person has previously
	 * been saved, it will retrieve related PicPersons from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Person.
	 */
	public function getPicPersonsJoinPic($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePicPersonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPicPersons === null) {
			if ($this->isNew()) {
				$this->collPicPersons = array();
			} else {

				$criteria->add(PicPersonPeer::OTHER_ID, $this->getId());

				$this->collPicPersons = PicPersonPeer::doSelectJoinPic($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PicPersonPeer::OTHER_ID, $this->getId());

			if (!isset($this->lastPicPersonCriteria) || !$this->lastPicPersonCriteria->equals($criteria)) {
				$this->collPicPersons = PicPersonPeer::doSelectJoinPic($criteria, $con);
			}
		}
		$this->lastPicPersonCriteria = $criteria;

		return $this->collPicPersons;
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
			if ($this->collPersonI18ns) {
				foreach ((array) $this->collPersonI18ns as $o) {
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
			if ($this->collPicPersons) {
				foreach ((array) $this->collPicPersons as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collPersonI18ns = null;
		$this->collMmPersons = null;
		$this->collMmTemplatePersons = null;
		$this->collPicPersons = null;
	}

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getHonorific()
  {
    $obj = $this->getCurrentPersonI18n();

    return ($obj ? $obj->getHonorific() : null);
  }

  public function setHonorific($value)
  {
    $this->getCurrentPersonI18n()->setHonorific($value);
  }

  public function getFirm()
  {
    $obj = $this->getCurrentPersonI18n();

    return ($obj ? $obj->getFirm() : null);
  }

  public function setFirm($value)
  {
    $this->getCurrentPersonI18n()->setFirm($value);
  }

  public function getPost()
  {
    $obj = $this->getCurrentPersonI18n();

    return ($obj ? $obj->getPost() : null);
  }

  public function setPost($value)
  {
    $this->getCurrentPersonI18n()->setPost($value);
  }

  public function getBio()
  {
    $obj = $this->getCurrentPersonI18n();

    return ($obj ? $obj->getBio() : null);
  }

  public function setBio($value)
  {
    $this->getCurrentPersonI18n()->setBio($value);
  }

  protected $current_i18n = array();

  public function getCurrentPersonI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = PersonI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setPersonI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setPersonI18nForCulture(new PersonI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setPersonI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addPersonI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePerson:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePerson::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BasePerson
