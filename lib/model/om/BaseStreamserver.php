<?php

/**
 * Base class that represents a row from the 'streamserver' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseStreamserver extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        StreamserverPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the streamserver_type_id field.
	 * @var        int
	 */
	protected $streamserver_type_id;


	/**
	 * The value for the ip field.
	 * @var        string
	 */
	protected $ip;


	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;


	/**
	 * The value for the description field.
	 * @var        string
	 */
	protected $description;


	/**
	 * The value for the dir_out field.
	 * @var        string
	 */
	protected $dir_out;


	/**
	 * The value for the url_out field.
	 * @var        string
	 */
	protected $url_out;

	/**
	 * @var        StreamserverType
	 */
	protected $aStreamserverType;

	/**
	 * Collection to store aggregation of collPerfils.
	 * @var        array
	 */
	protected $collPerfils;

	/**
	 * The criteria used to select the current contents of collPerfils.
	 * @var        Criteria
	 */
	protected $lastPerfilCriteria = null;

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
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{

		return $this->id;
	}

	/**
	 * Get the [streamserver_type_id] column value.
	 * 
	 * @return     int
	 */
	public function getStreamserverTypeId()
	{

		return $this->streamserver_type_id;
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
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{

		return $this->name;
	}

	/**
	 * Get the [description] column value.
	 * 
	 * @return     string
	 */
	public function getDescription()
	{

		return $this->description;
	}

	/**
	 * Get the [dir_out] column value.
	 * 
	 * @return     string
	 */
	public function getDirOut()
	{

		return $this->dir_out;
	}

	/**
	 * Get the [url_out] column value.
	 * 
	 * @return     string
	 */
	public function getUrlOut()
	{

		return $this->url_out;
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
			$this->modifiedColumns[] = StreamserverPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [streamserver_type_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setStreamserverTypeId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->streamserver_type_id !== $v) {
			$this->streamserver_type_id = $v;
			$this->modifiedColumns[] = StreamserverPeer::STREAMSERVER_TYPE_ID;
		}

		if ($this->aStreamserverType !== null && $this->aStreamserverType->getId() !== $v) {
			$this->aStreamserverType = null;
		}

	} // setStreamserverTypeId()

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
			$this->modifiedColumns[] = StreamserverPeer::IP;
		}

	} // setIp()

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
			$this->modifiedColumns[] = StreamserverPeer::NAME;
		}

	} // setName()

	/**
	 * Set the value of [description] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setDescription($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->description !== $v) {
			$this->description = $v;
			$this->modifiedColumns[] = StreamserverPeer::DESCRIPTION;
		}

	} // setDescription()

	/**
	 * Set the value of [dir_out] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setDirOut($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->dir_out !== $v) {
			$this->dir_out = $v;
			$this->modifiedColumns[] = StreamserverPeer::DIR_OUT;
		}

	} // setDirOut()

	/**
	 * Set the value of [url_out] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUrlOut($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url_out !== $v) {
			$this->url_out = $v;
			$this->modifiedColumns[] = StreamserverPeer::URL_OUT;
		}

	} // setUrlOut()

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

			$this->streamserver_type_id = $rs->getInt($startcol + 1);

			$this->ip = $rs->getString($startcol + 2);

			$this->name = $rs->getString($startcol + 3);

			$this->description = $rs->getString($startcol + 4);

			$this->dir_out = $rs->getString($startcol + 5);

			$this->url_out = $rs->getString($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 7; // 7 = StreamserverPeer::NUM_COLUMNS - StreamserverPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Streamserver object", $e);
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

    foreach (sfMixer::getCallables('BaseStreamserver:delete:pre') as $callable)
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
			$con = Propel::getConnection(StreamserverPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			StreamserverPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseStreamserver:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseStreamserver:save:pre') as $callable)
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
			$con = Propel::getConnection(StreamserverPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseStreamserver:save:post') as $callable)
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


			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aStreamserverType !== null) {
				if ($this->aStreamserverType->isModified()) {
					$affectedRows += $this->aStreamserverType->save($con);
				}
				$this->setStreamserverType($this->aStreamserverType);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = StreamserverPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += StreamserverPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collPerfils !== null) {
				foreach($this->collPerfils as $referrerFK) {
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


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aStreamserverType !== null) {
				if (!$this->aStreamserverType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aStreamserverType->getValidationFailures());
				}
			}


			if (($retval = StreamserverPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPerfils !== null) {
					foreach($this->collPerfils as $referrerFK) {
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
		$pos = StreamserverPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getStreamserverTypeId();
				break;
			case 2:
				return $this->getIp();
				break;
			case 3:
				return $this->getName();
				break;
			case 4:
				return $this->getDescription();
				break;
			case 5:
				return $this->getDirOut();
				break;
			case 6:
				return $this->getUrlOut();
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
		$keys = StreamserverPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getStreamserverTypeId(),
			$keys[2] => $this->getIp(),
			$keys[3] => $this->getName(),
			$keys[4] => $this->getDescription(),
			$keys[5] => $this->getDirOut(),
			$keys[6] => $this->getUrlOut(),
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
		$pos = StreamserverPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setStreamserverTypeId($value);
				break;
			case 2:
				$this->setIp($value);
				break;
			case 3:
				$this->setName($value);
				break;
			case 4:
				$this->setDescription($value);
				break;
			case 5:
				$this->setDirOut($value);
				break;
			case 6:
				$this->setUrlOut($value);
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
		$keys = StreamserverPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setStreamserverTypeId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIp($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setName($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDescription($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDirOut($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setUrlOut($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(StreamserverPeer::DATABASE_NAME);

		if ($this->isColumnModified(StreamserverPeer::ID)) $criteria->add(StreamserverPeer::ID, $this->id);
		if ($this->isColumnModified(StreamserverPeer::STREAMSERVER_TYPE_ID)) $criteria->add(StreamserverPeer::STREAMSERVER_TYPE_ID, $this->streamserver_type_id);
		if ($this->isColumnModified(StreamserverPeer::IP)) $criteria->add(StreamserverPeer::IP, $this->ip);
		if ($this->isColumnModified(StreamserverPeer::NAME)) $criteria->add(StreamserverPeer::NAME, $this->name);
		if ($this->isColumnModified(StreamserverPeer::DESCRIPTION)) $criteria->add(StreamserverPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(StreamserverPeer::DIR_OUT)) $criteria->add(StreamserverPeer::DIR_OUT, $this->dir_out);
		if ($this->isColumnModified(StreamserverPeer::URL_OUT)) $criteria->add(StreamserverPeer::URL_OUT, $this->url_out);

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
		$criteria = new Criteria(StreamserverPeer::DATABASE_NAME);

		$criteria->add(StreamserverPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Streamserver (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setStreamserverTypeId($this->streamserver_type_id);

		$copyObj->setIp($this->ip);

		$copyObj->setName($this->name);

		$copyObj->setDescription($this->description);

		$copyObj->setDirOut($this->dir_out);

		$copyObj->setUrlOut($this->url_out);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getPerfils() as $relObj) {
				$copyObj->addPerfil($relObj->copy($deepCopy));
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
	 * @return     Streamserver Clone of current object.
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
	 * @return     StreamserverPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new StreamserverPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a StreamserverType object.
	 *
	 * @param      StreamserverType $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setStreamserverType($v)
	{


		if ($v === null) {
			$this->setStreamserverTypeId(NULL);
		} else {
			$this->setStreamserverTypeId($v->getId());
		}


		$this->aStreamserverType = $v;
	}


	/**
	 * Get the associated StreamserverType object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     StreamserverType The associated StreamserverType object.
	 * @throws     PropelException
	 */
	public function getStreamserverType($con = null)
	{
		if ($this->aStreamserverType === null && ($this->streamserver_type_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseStreamserverTypePeer.php';

			$this->aStreamserverType = StreamserverTypePeer::retrieveByPK($this->streamserver_type_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = StreamserverTypePeer::retrieveByPK($this->streamserver_type_id, $con);
			   $obj->addStreamserverTypes($this);
			 */
		}
		return $this->aStreamserverType;
	}

	/**
	 * Temporary storage of collPerfils to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPerfils()
	{
		if ($this->collPerfils === null) {
			$this->collPerfils = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Streamserver has previously
	 * been saved, it will retrieve related Perfils from storage.
	 * If this Streamserver is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPerfils($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePerfilPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPerfils === null) {
			if ($this->isNew()) {
			   $this->collPerfils = array();
			} else {

				$criteria->add(PerfilPeer::STREAMSERVER_ID, $this->getId());

				PerfilPeer::addSelectColumns($criteria);
				$this->collPerfils = PerfilPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PerfilPeer::STREAMSERVER_ID, $this->getId());

				PerfilPeer::addSelectColumns($criteria);
				if (!isset($this->lastPerfilCriteria) || !$this->lastPerfilCriteria->equals($criteria)) {
					$this->collPerfils = PerfilPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPerfilCriteria = $criteria;
		return $this->collPerfils;
	}

	/**
	 * Returns the number of related Perfils.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPerfils($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePerfilPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PerfilPeer::STREAMSERVER_ID, $this->getId());

		return PerfilPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Perfil object to this object
	 * through the Perfil foreign key attribute
	 *
	 * @param      Perfil $l Perfil
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPerfil(Perfil $l)
	{
		$this->collPerfils[] = $l;
		$l->setStreamserver($this);
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Streamserver has previously
	 * been saved, it will retrieve related Perfils from storage.
	 * If this Streamserver is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPerfilsWithI18n($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePerfilPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPerfils === null) {
			if ($this->isNew()) {
			   $this->collPerfils = array();
			} else {

				$criteria->add(PerfilPeer::STREAMSERVER_ID, $this->getId());

				$this->collPerfils = PerfilPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PerfilPeer::STREAMSERVER_ID, $this->getId());

				if (!isset($this->lastPerfilCriteria) || !$this->lastPerfilCriteria->equals($criteria)) {
					$this->collPerfils = PerfilPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
				}
			}
		}
		$this->lastPerfilCriteria = $criteria;
		return $this->collPerfils;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseStreamserver:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseStreamserver::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseStreamserver
