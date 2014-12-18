<?php

/**
 * Base class that represents a row from the 'cpu' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseCpu extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        CpuPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the ip field.
	 * @var        string
	 */
	protected $ip;


	/**
	 * The value for the max field.
	 * @var        int
	 */
	protected $max;


	/**
	 * The value for the min field.
	 * @var        int
	 */
	protected $min;


	/**
	 * The value for the number field.
	 * @var        int
	 */
	protected $number;


	/**
	 * The value for the type field.
	 * @var        string
	 */
	protected $type;


	/**
	 * The value for the user field.
	 * @var        string
	 */
	protected $user;


	/**
	 * The value for the password field.
	 * @var        string
	 */
	protected $password;

	/**
	 * Collection to store aggregation of collLogTranscodings.
	 * @var        array
	 */
	protected $collLogTranscodings;

	/**
	 * The criteria used to select the current contents of collLogTranscodings.
	 * @var        Criteria
	 */
	protected $lastLogTranscodingCriteria = null;

	/**
	 * Collection to store aggregation of collTranscodings.
	 * @var        array
	 */
	protected $collTranscodings;

	/**
	 * The criteria used to select the current contents of collTranscodings.
	 * @var        Criteria
	 */
	protected $lastTranscodingCriteria = null;

	/**
	 * Collection to store aggregation of collCpuI18ns.
	 * @var        array
	 */
	protected $collCpuI18ns;

	/**
	 * The criteria used to select the current contents of collCpuI18ns.
	 * @var        Criteria
	 */
	protected $lastCpuI18nCriteria = null;

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
	 * Get the [ip] column value.
	 * 
	 * @return     string
	 */
	public function getIp()
	{

		return $this->ip;
	}

	/**
	 * Get the [max] column value.
	 * 
	 * @return     int
	 */
	public function getMax()
	{

		return $this->max;
	}

	/**
	 * Get the [min] column value.
	 * 
	 * @return     int
	 */
	public function getMin()
	{

		return $this->min;
	}

	/**
	 * Get the [number] column value.
	 * 
	 * @return     int
	 */
	public function getNumber()
	{

		return $this->number;
	}

	/**
	 * Get the [type] column value.
	 * 
	 * @return     string
	 */
	public function getType()
	{

		return $this->type;
	}

	/**
	 * Get the [user] column value.
	 * 
	 * @return     string
	 */
	public function getUser()
	{

		return $this->user;
	}

	/**
	 * Get the [password] column value.
	 * 
	 * @return     string
	 */
	public function getPassword()
	{

		return $this->password;
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
			$this->modifiedColumns[] = CpuPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [ip] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setIp($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ip !== $v) {
			$this->ip = $v;
			$this->modifiedColumns[] = CpuPeer::IP;
		}

	} // setIp()

	/**
	 * Set the value of [max] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setMax($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->max !== $v) {
			$this->max = $v;
			$this->modifiedColumns[] = CpuPeer::MAX;
		}

	} // setMax()

	/**
	 * Set the value of [min] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setMin($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->min !== $v) {
			$this->min = $v;
			$this->modifiedColumns[] = CpuPeer::MIN;
		}

	} // setMin()

	/**
	 * Set the value of [number] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setNumber($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->number !== $v) {
			$this->number = $v;
			$this->modifiedColumns[] = CpuPeer::NUMBER;
		}

	} // setNumber()

	/**
	 * Set the value of [type] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setType($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->type !== $v) {
			$this->type = $v;
			$this->modifiedColumns[] = CpuPeer::TYPE;
		}

	} // setType()

	/**
	 * Set the value of [user] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUser($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->user !== $v) {
			$this->user = $v;
			$this->modifiedColumns[] = CpuPeer::USER;
		}

	} // setUser()

	/**
	 * Set the value of [password] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setPassword($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->password !== $v) {
			$this->password = $v;
			$this->modifiedColumns[] = CpuPeer::PASSWORD;
		}

	} // setPassword()

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

			$this->ip = $rs->getString($startcol + 1);

			$this->max = $rs->getInt($startcol + 2);

			$this->min = $rs->getInt($startcol + 3);

			$this->number = $rs->getInt($startcol + 4);

			$this->type = $rs->getString($startcol + 5);

			$this->user = $rs->getString($startcol + 6);

			$this->password = $rs->getString($startcol + 7);

			$this->resetModified();

			$this->setNew(false);
			$this->setCulture(sfContext::getInstance()->getUser()->getCulture());

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 8; // 8 = CpuPeer::NUM_COLUMNS - CpuPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Cpu object", $e);
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

    foreach (sfMixer::getCallables('BaseCpu:delete:pre') as $callable)
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
			$con = Propel::getConnection(CpuPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CpuPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseCpu:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseCpu:save:pre') as $callable)
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
			$con = Propel::getConnection(CpuPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseCpu:save:post') as $callable)
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
					$pk = CpuPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += CpuPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collLogTranscodings !== null) {
				foreach($this->collLogTranscodings as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTranscodings !== null) {
				foreach($this->collTranscodings as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCpuI18ns !== null) {
				foreach($this->collCpuI18ns as $referrerFK) {
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


			if (($retval = CpuPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collLogTranscodings !== null) {
					foreach($this->collLogTranscodings as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTranscodings !== null) {
					foreach($this->collTranscodings as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCpuI18ns !== null) {
					foreach($this->collCpuI18ns as $referrerFK) {
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
		$pos = CpuPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getIp();
				break;
			case 2:
				return $this->getMax();
				break;
			case 3:
				return $this->getMin();
				break;
			case 4:
				return $this->getNumber();
				break;
			case 5:
				return $this->getType();
				break;
			case 6:
				return $this->getUser();
				break;
			case 7:
				return $this->getPassword();
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
		$keys = CpuPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIp(),
			$keys[2] => $this->getMax(),
			$keys[3] => $this->getMin(),
			$keys[4] => $this->getNumber(),
			$keys[5] => $this->getType(),
			$keys[6] => $this->getUser(),
			$keys[7] => $this->getPassword(),
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
		$pos = CpuPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setIp($value);
				break;
			case 2:
				$this->setMax($value);
				break;
			case 3:
				$this->setMin($value);
				break;
			case 4:
				$this->setNumber($value);
				break;
			case 5:
				$this->setType($value);
				break;
			case 6:
				$this->setUser($value);
				break;
			case 7:
				$this->setPassword($value);
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
		$keys = CpuPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIp($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setMax($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMin($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setNumber($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setType($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUser($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPassword($arr[$keys[7]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(CpuPeer::DATABASE_NAME);

		if ($this->isColumnModified(CpuPeer::ID)) $criteria->add(CpuPeer::ID, $this->id);
		if ($this->isColumnModified(CpuPeer::IP)) $criteria->add(CpuPeer::IP, $this->ip);
		if ($this->isColumnModified(CpuPeer::MAX)) $criteria->add(CpuPeer::MAX, $this->max);
		if ($this->isColumnModified(CpuPeer::MIN)) $criteria->add(CpuPeer::MIN, $this->min);
		if ($this->isColumnModified(CpuPeer::NUMBER)) $criteria->add(CpuPeer::NUMBER, $this->number);
		if ($this->isColumnModified(CpuPeer::TYPE)) $criteria->add(CpuPeer::TYPE, $this->type);
		if ($this->isColumnModified(CpuPeer::USER)) $criteria->add(CpuPeer::USER, $this->user);
		if ($this->isColumnModified(CpuPeer::PASSWORD)) $criteria->add(CpuPeer::PASSWORD, $this->password);

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
		$criteria = new Criteria(CpuPeer::DATABASE_NAME);

		$criteria->add(CpuPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Cpu (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setIp($this->ip);

		$copyObj->setMax($this->max);

		$copyObj->setMin($this->min);

		$copyObj->setNumber($this->number);

		$copyObj->setType($this->type);

		$copyObj->setUser($this->user);

		$copyObj->setPassword($this->password);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getLogTranscodings() as $relObj) {
				$copyObj->addLogTranscoding($relObj->copy($deepCopy));
			}

			foreach($this->getTranscodings() as $relObj) {
				$copyObj->addTranscoding($relObj->copy($deepCopy));
			}

			foreach($this->getCpuI18ns() as $relObj) {
				$copyObj->addCpuI18n($relObj->copy($deepCopy));
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
	 * @return     Cpu Clone of current object.
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
	 * @return     CpuPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new CpuPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collLogTranscodings to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initLogTranscodings()
	{
		if ($this->collLogTranscodings === null) {
			$this->collLogTranscodings = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cpu has previously
	 * been saved, it will retrieve related LogTranscodings from storage.
	 * If this Cpu is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getLogTranscodings($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseLogTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLogTranscodings === null) {
			if ($this->isNew()) {
			   $this->collLogTranscodings = array();
			} else {

				$criteria->add(LogTranscodingPeer::CPU_ID, $this->getId());

				LogTranscodingPeer::addSelectColumns($criteria);
				$this->collLogTranscodings = LogTranscodingPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(LogTranscodingPeer::CPU_ID, $this->getId());

				LogTranscodingPeer::addSelectColumns($criteria);
				if (!isset($this->lastLogTranscodingCriteria) || !$this->lastLogTranscodingCriteria->equals($criteria)) {
					$this->collLogTranscodings = LogTranscodingPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastLogTranscodingCriteria = $criteria;
		return $this->collLogTranscodings;
	}

	/**
	 * Returns the number of related LogTranscodings.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countLogTranscodings($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseLogTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(LogTranscodingPeer::CPU_ID, $this->getId());

		return LogTranscodingPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a LogTranscoding object to this object
	 * through the LogTranscoding foreign key attribute
	 *
	 * @param      LogTranscoding $l LogTranscoding
	 * @return     void
	 * @throws     PropelException
	 */
	public function addLogTranscoding(LogTranscoding $l)
	{
		$this->collLogTranscodings[] = $l;
		$l->setCpu($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cpu is new, it will return
	 * an empty collection; or if this Cpu has previously
	 * been saved, it will retrieve related LogTranscodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Cpu.
	 */
	public function getLogTranscodingsJoinMm($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseLogTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLogTranscodings === null) {
			if ($this->isNew()) {
				$this->collLogTranscodings = array();
			} else {

				$criteria->add(LogTranscodingPeer::CPU_ID, $this->getId());

				$this->collLogTranscodings = LogTranscodingPeer::doSelectJoinMm($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(LogTranscodingPeer::CPU_ID, $this->getId());

			if (!isset($this->lastLogTranscodingCriteria) || !$this->lastLogTranscodingCriteria->equals($criteria)) {
				$this->collLogTranscodings = LogTranscodingPeer::doSelectJoinMm($criteria, $con);
			}
		}
		$this->lastLogTranscodingCriteria = $criteria;

		return $this->collLogTranscodings;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cpu is new, it will return
	 * an empty collection; or if this Cpu has previously
	 * been saved, it will retrieve related LogTranscodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Cpu.
	 */
	public function getLogTranscodingsJoinLanguage($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseLogTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLogTranscodings === null) {
			if ($this->isNew()) {
				$this->collLogTranscodings = array();
			} else {

				$criteria->add(LogTranscodingPeer::CPU_ID, $this->getId());

				$this->collLogTranscodings = LogTranscodingPeer::doSelectJoinLanguage($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(LogTranscodingPeer::CPU_ID, $this->getId());

			if (!isset($this->lastLogTranscodingCriteria) || !$this->lastLogTranscodingCriteria->equals($criteria)) {
				$this->collLogTranscodings = LogTranscodingPeer::doSelectJoinLanguage($criteria, $con);
			}
		}
		$this->lastLogTranscodingCriteria = $criteria;

		return $this->collLogTranscodings;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cpu is new, it will return
	 * an empty collection; or if this Cpu has previously
	 * been saved, it will retrieve related LogTranscodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Cpu.
	 */
	public function getLogTranscodingsJoinPerfil($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseLogTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLogTranscodings === null) {
			if ($this->isNew()) {
				$this->collLogTranscodings = array();
			} else {

				$criteria->add(LogTranscodingPeer::CPU_ID, $this->getId());

				$this->collLogTranscodings = LogTranscodingPeer::doSelectJoinPerfil($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(LogTranscodingPeer::CPU_ID, $this->getId());

			if (!isset($this->lastLogTranscodingCriteria) || !$this->lastLogTranscodingCriteria->equals($criteria)) {
				$this->collLogTranscodings = LogTranscodingPeer::doSelectJoinPerfil($criteria, $con);
			}
		}
		$this->lastLogTranscodingCriteria = $criteria;

		return $this->collLogTranscodings;
	}

	/**
	 * Temporary storage of collTranscodings to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initTranscodings()
	{
		if ($this->collTranscodings === null) {
			$this->collTranscodings = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cpu has previously
	 * been saved, it will retrieve related Transcodings from storage.
	 * If this Cpu is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getTranscodings($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTranscodings === null) {
			if ($this->isNew()) {
			   $this->collTranscodings = array();
			} else {

				$criteria->add(TranscodingPeer::CPU_ID, $this->getId());

				TranscodingPeer::addSelectColumns($criteria);
				$this->collTranscodings = TranscodingPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TranscodingPeer::CPU_ID, $this->getId());

				TranscodingPeer::addSelectColumns($criteria);
				if (!isset($this->lastTranscodingCriteria) || !$this->lastTranscodingCriteria->equals($criteria)) {
					$this->collTranscodings = TranscodingPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTranscodingCriteria = $criteria;
		return $this->collTranscodings;
	}

	/**
	 * Returns the number of related Transcodings.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countTranscodings($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TranscodingPeer::CPU_ID, $this->getId());

		return TranscodingPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Transcoding object to this object
	 * through the Transcoding foreign key attribute
	 *
	 * @param      Transcoding $l Transcoding
	 * @return     void
	 * @throws     PropelException
	 */
	public function addTranscoding(Transcoding $l)
	{
		$this->collTranscodings[] = $l;
		$l->setCpu($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cpu is new, it will return
	 * an empty collection; or if this Cpu has previously
	 * been saved, it will retrieve related Transcodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Cpu.
	 */
	public function getTranscodingsJoinMm($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTranscodings === null) {
			if ($this->isNew()) {
				$this->collTranscodings = array();
			} else {

				$criteria->add(TranscodingPeer::CPU_ID, $this->getId());

				$this->collTranscodings = TranscodingPeer::doSelectJoinMm($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TranscodingPeer::CPU_ID, $this->getId());

			if (!isset($this->lastTranscodingCriteria) || !$this->lastTranscodingCriteria->equals($criteria)) {
				$this->collTranscodings = TranscodingPeer::doSelectJoinMm($criteria, $con);
			}
		}
		$this->lastTranscodingCriteria = $criteria;

		return $this->collTranscodings;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cpu is new, it will return
	 * an empty collection; or if this Cpu has previously
	 * been saved, it will retrieve related Transcodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Cpu.
	 */
	public function getTranscodingsJoinLanguage($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTranscodings === null) {
			if ($this->isNew()) {
				$this->collTranscodings = array();
			} else {

				$criteria->add(TranscodingPeer::CPU_ID, $this->getId());

				$this->collTranscodings = TranscodingPeer::doSelectJoinLanguage($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TranscodingPeer::CPU_ID, $this->getId());

			if (!isset($this->lastTranscodingCriteria) || !$this->lastTranscodingCriteria->equals($criteria)) {
				$this->collTranscodings = TranscodingPeer::doSelectJoinLanguage($criteria, $con);
			}
		}
		$this->lastTranscodingCriteria = $criteria;

		return $this->collTranscodings;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cpu is new, it will return
	 * an empty collection; or if this Cpu has previously
	 * been saved, it will retrieve related Transcodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Cpu.
	 */
	public function getTranscodingsJoinPerfil($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTranscodings === null) {
			if ($this->isNew()) {
				$this->collTranscodings = array();
			} else {

				$criteria->add(TranscodingPeer::CPU_ID, $this->getId());

				$this->collTranscodings = TranscodingPeer::doSelectJoinPerfil($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TranscodingPeer::CPU_ID, $this->getId());

			if (!isset($this->lastTranscodingCriteria) || !$this->lastTranscodingCriteria->equals($criteria)) {
				$this->collTranscodings = TranscodingPeer::doSelectJoinPerfil($criteria, $con);
			}
		}
		$this->lastTranscodingCriteria = $criteria;

		return $this->collTranscodings;
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cpu has previously
	 * been saved, it will retrieve related Transcodings from storage.
	 * If this Cpu is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getTranscodingsWithI18n($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTranscodings === null) {
			if ($this->isNew()) {
			   $this->collTranscodings = array();
			} else {

				$criteria->add(TranscodingPeer::CPU_ID, $this->getId());

				$this->collTranscodings = TranscodingPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TranscodingPeer::CPU_ID, $this->getId());

				if (!isset($this->lastTranscodingCriteria) || !$this->lastTranscodingCriteria->equals($criteria)) {
					$this->collTranscodings = TranscodingPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
				}
			}
		}
		$this->lastTranscodingCriteria = $criteria;
		return $this->collTranscodings;
	}

	/**
	 * Temporary storage of collCpuI18ns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCpuI18ns()
	{
		if ($this->collCpuI18ns === null) {
			$this->collCpuI18ns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Cpu has previously
	 * been saved, it will retrieve related CpuI18ns from storage.
	 * If this Cpu is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCpuI18ns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCpuI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCpuI18ns === null) {
			if ($this->isNew()) {
			   $this->collCpuI18ns = array();
			} else {

				$criteria->add(CpuI18nPeer::ID, $this->getId());

				CpuI18nPeer::addSelectColumns($criteria);
				$this->collCpuI18ns = CpuI18nPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CpuI18nPeer::ID, $this->getId());

				CpuI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastCpuI18nCriteria) || !$this->lastCpuI18nCriteria->equals($criteria)) {
					$this->collCpuI18ns = CpuI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCpuI18nCriteria = $criteria;
		return $this->collCpuI18ns;
	}

	/**
	 * Returns the number of related CpuI18ns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCpuI18ns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCpuI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CpuI18nPeer::ID, $this->getId());

		return CpuI18nPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a CpuI18n object to this object
	 * through the CpuI18n foreign key attribute
	 *
	 * @param      CpuI18n $l CpuI18n
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCpuI18n(CpuI18n $l)
	{
		$this->collCpuI18ns[] = $l;
		$l->setCpu($this);
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
    $obj = $this->getCurrentCpuI18n();

    return ($obj ? $obj->getDescription() : null);
  }

  public function setDescription($value)
  {
    $this->getCurrentCpuI18n()->setDescription($value);
  }

  protected $current_i18n = array();

  public function getCurrentCpuI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = CpuI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setCpuI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setCpuI18nForCulture(new CpuI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setCpuI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addCpuI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseCpu:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseCpu::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseCpu
