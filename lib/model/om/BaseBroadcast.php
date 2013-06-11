<?php

/**
 * Base class that represents a row from the 'broadcast' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseBroadcast extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        BroadcastPeer
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
	 * The value for the broadcast_type_id field.
	 * @var        int
	 */
	protected $broadcast_type_id;


	/**
	 * The value for the passwd field.
	 * @var        string
	 */
	protected $passwd;


	/**
	 * The value for the default_sel field.
	 * @var        boolean
	 */
	protected $default_sel = false;

	/**
	 * @var        BroadcastType
	 */
	protected $aBroadcastType;

	/**
	 * Collection to store aggregation of collBroadcastI18ns.
	 * @var        array
	 */
	protected $collBroadcastI18ns;

	/**
	 * The criteria used to select the current contents of collBroadcastI18ns.
	 * @var        Criteria
	 */
	protected $lastBroadcastI18nCriteria = null;

	/**
	 * Collection to store aggregation of collMms.
	 * @var        array
	 */
	protected $collMms;

	/**
	 * The criteria used to select the current contents of collMms.
	 * @var        Criteria
	 */
	protected $lastMmCriteria = null;

	/**
	 * Collection to store aggregation of collMmTemplates.
	 * @var        array
	 */
	protected $collMmTemplates;

	/**
	 * The criteria used to select the current contents of collMmTemplates.
	 * @var        Criteria
	 */
	protected $lastMmTemplateCriteria = null;

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
	 * Get the [broadcast_type_id] column value.
	 * 
	 * @return     int
	 */
	public function getBroadcastTypeId()
	{

		return $this->broadcast_type_id;
	}

	/**
	 * Get the [passwd] column value.
	 * 
	 * @return     string
	 */
	public function getPasswd()
	{

		return $this->passwd;
	}

	/**
	 * Get the [default_sel] column value.
	 * 
	 * @return     boolean
	 */
	public function getDefaultSel()
	{

		return $this->default_sel;
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
			$this->modifiedColumns[] = BroadcastPeer::ID;
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
			$this->modifiedColumns[] = BroadcastPeer::NAME;
		}

	} // setName()

	/**
	 * Set the value of [broadcast_type_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setBroadcastTypeId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->broadcast_type_id !== $v) {
			$this->broadcast_type_id = $v;
			$this->modifiedColumns[] = BroadcastPeer::BROADCAST_TYPE_ID;
		}

		if ($this->aBroadcastType !== null && $this->aBroadcastType->getId() !== $v) {
			$this->aBroadcastType = null;
		}

	} // setBroadcastTypeId()

	/**
	 * Set the value of [passwd] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setPasswd($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->passwd !== $v) {
			$this->passwd = $v;
			$this->modifiedColumns[] = BroadcastPeer::PASSWD;
		}

	} // setPasswd()

	/**
	 * Set the value of [default_sel] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setDefaultSel($v)
	{

		if ($this->default_sel !== $v || $v === false) {
			$this->default_sel = $v;
			$this->modifiedColumns[] = BroadcastPeer::DEFAULT_SEL;
		}

	} // setDefaultSel()

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

			$this->broadcast_type_id = $rs->getInt($startcol + 2);

			$this->passwd = $rs->getString($startcol + 3);

			$this->default_sel = $rs->getBoolean($startcol + 4);

			$this->resetModified();

			$this->setNew(false);
			$this->setCulture(sfContext::getInstance()->getUser()->getCulture());

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 5; // 5 = BroadcastPeer::NUM_COLUMNS - BroadcastPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Broadcast object", $e);
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

    foreach (sfMixer::getCallables('BaseBroadcast:delete:pre') as $callable)
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
			$con = Propel::getConnection(BroadcastPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			BroadcastPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseBroadcast:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseBroadcast:save:pre') as $callable)
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
			$con = Propel::getConnection(BroadcastPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseBroadcast:save:post') as $callable)
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

			if ($this->aBroadcastType !== null) {
				if ($this->aBroadcastType->isModified()) {
					$affectedRows += $this->aBroadcastType->save($con);
				}
				$this->setBroadcastType($this->aBroadcastType);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = BroadcastPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += BroadcastPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collBroadcastI18ns !== null) {
				foreach($this->collBroadcastI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMms !== null) {
				foreach($this->collMms as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMmTemplates !== null) {
				foreach($this->collMmTemplates as $referrerFK) {
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

			if ($this->aBroadcastType !== null) {
				if (!$this->aBroadcastType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aBroadcastType->getValidationFailures());
				}
			}


			if (($retval = BroadcastPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collBroadcastI18ns !== null) {
					foreach($this->collBroadcastI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMms !== null) {
					foreach($this->collMms as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMmTemplates !== null) {
					foreach($this->collMmTemplates as $referrerFK) {
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
		$pos = BroadcastPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getBroadcastTypeId();
				break;
			case 3:
				return $this->getPasswd();
				break;
			case 4:
				return $this->getDefaultSel();
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
		$keys = BroadcastPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getBroadcastTypeId(),
			$keys[3] => $this->getPasswd(),
			$keys[4] => $this->getDefaultSel(),
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
		$pos = BroadcastPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setBroadcastTypeId($value);
				break;
			case 3:
				$this->setPasswd($value);
				break;
			case 4:
				$this->setDefaultSel($value);
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
		$keys = BroadcastPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setBroadcastTypeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPasswd($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDefaultSel($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(BroadcastPeer::DATABASE_NAME);

		if ($this->isColumnModified(BroadcastPeer::ID)) $criteria->add(BroadcastPeer::ID, $this->id);
		if ($this->isColumnModified(BroadcastPeer::NAME)) $criteria->add(BroadcastPeer::NAME, $this->name);
		if ($this->isColumnModified(BroadcastPeer::BROADCAST_TYPE_ID)) $criteria->add(BroadcastPeer::BROADCAST_TYPE_ID, $this->broadcast_type_id);
		if ($this->isColumnModified(BroadcastPeer::PASSWD)) $criteria->add(BroadcastPeer::PASSWD, $this->passwd);
		if ($this->isColumnModified(BroadcastPeer::DEFAULT_SEL)) $criteria->add(BroadcastPeer::DEFAULT_SEL, $this->default_sel);

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
		$criteria = new Criteria(BroadcastPeer::DATABASE_NAME);

		$criteria->add(BroadcastPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Broadcast (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);

		$copyObj->setBroadcastTypeId($this->broadcast_type_id);

		$copyObj->setPasswd($this->passwd);

		$copyObj->setDefaultSel($this->default_sel);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getBroadcastI18ns() as $relObj) {
				$copyObj->addBroadcastI18n($relObj->copy($deepCopy));
			}

			foreach($this->getMms() as $relObj) {
				$copyObj->addMm($relObj->copy($deepCopy));
			}

			foreach($this->getMmTemplates() as $relObj) {
				$copyObj->addMmTemplate($relObj->copy($deepCopy));
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
	 * @return     Broadcast Clone of current object.
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
	 * @return     BroadcastPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new BroadcastPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a BroadcastType object.
	 *
	 * @param      BroadcastType $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setBroadcastType($v)
	{


		if ($v === null) {
			$this->setBroadcastTypeId(NULL);
		} else {
			$this->setBroadcastTypeId($v->getId());
		}


		$this->aBroadcastType = $v;
	}


	/**
	 * Get the associated BroadcastType object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     BroadcastType The associated BroadcastType object.
	 * @throws     PropelException
	 */
	public function getBroadcastType($con = null)
	{
		if ($this->aBroadcastType === null && ($this->broadcast_type_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseBroadcastTypePeer.php';

			$this->aBroadcastType = BroadcastTypePeer::retrieveByPK($this->broadcast_type_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = BroadcastTypePeer::retrieveByPK($this->broadcast_type_id, $con);
			   $obj->addBroadcastTypes($this);
			 */
		}
		return $this->aBroadcastType;
	}

	/**
	 * Temporary storage of collBroadcastI18ns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initBroadcastI18ns()
	{
		if ($this->collBroadcastI18ns === null) {
			$this->collBroadcastI18ns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Broadcast has previously
	 * been saved, it will retrieve related BroadcastI18ns from storage.
	 * If this Broadcast is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getBroadcastI18ns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseBroadcastI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBroadcastI18ns === null) {
			if ($this->isNew()) {
			   $this->collBroadcastI18ns = array();
			} else {

				$criteria->add(BroadcastI18nPeer::ID, $this->getId());

				BroadcastI18nPeer::addSelectColumns($criteria);
				$this->collBroadcastI18ns = BroadcastI18nPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(BroadcastI18nPeer::ID, $this->getId());

				BroadcastI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastBroadcastI18nCriteria) || !$this->lastBroadcastI18nCriteria->equals($criteria)) {
					$this->collBroadcastI18ns = BroadcastI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastBroadcastI18nCriteria = $criteria;
		return $this->collBroadcastI18ns;
	}

	/**
	 * Returns the number of related BroadcastI18ns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countBroadcastI18ns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseBroadcastI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(BroadcastI18nPeer::ID, $this->getId());

		return BroadcastI18nPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a BroadcastI18n object to this object
	 * through the BroadcastI18n foreign key attribute
	 *
	 * @param      BroadcastI18n $l BroadcastI18n
	 * @return     void
	 * @throws     PropelException
	 */
	public function addBroadcastI18n(BroadcastI18n $l)
	{
		$this->collBroadcastI18ns[] = $l;
		$l->setBroadcast($this);
	}

	/**
	 * Temporary storage of collMms to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initMms()
	{
		if ($this->collMms === null) {
			$this->collMms = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Broadcast has previously
	 * been saved, it will retrieve related Mms from storage.
	 * If this Broadcast is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getMms($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMms === null) {
			if ($this->isNew()) {
			   $this->collMms = array();
			} else {

				$criteria->add(MmPeer::BROADCAST_ID, $this->getId());

				MmPeer::addSelectColumns($criteria);
				$this->collMms = MmPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmPeer::BROADCAST_ID, $this->getId());

				MmPeer::addSelectColumns($criteria);
				if (!isset($this->lastMmCriteria) || !$this->lastMmCriteria->equals($criteria)) {
					$this->collMms = MmPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMmCriteria = $criteria;
		return $this->collMms;
	}

	/**
	 * Returns the number of related Mms.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countMms($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MmPeer::BROADCAST_ID, $this->getId());

		return MmPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Mm object to this object
	 * through the Mm foreign key attribute
	 *
	 * @param      Mm $l Mm
	 * @return     void
	 * @throws     PropelException
	 */
	public function addMm(Mm $l)
	{
		$this->collMms[] = $l;
		$l->setBroadcast($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Broadcast is new, it will return
	 * an empty collection; or if this Broadcast has previously
	 * been saved, it will retrieve related Mms from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Broadcast.
	 */
	public function getMmsJoinSerial($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMms === null) {
			if ($this->isNew()) {
				$this->collMms = array();
			} else {

				$criteria->add(MmPeer::BROADCAST_ID, $this->getId());

				$this->collMms = MmPeer::doSelectJoinSerial($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmPeer::BROADCAST_ID, $this->getId());

			if (!isset($this->lastMmCriteria) || !$this->lastMmCriteria->equals($criteria)) {
				$this->collMms = MmPeer::doSelectJoinSerial($criteria, $con);
			}
		}
		$this->lastMmCriteria = $criteria;

		return $this->collMms;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Broadcast is new, it will return
	 * an empty collection; or if this Broadcast has previously
	 * been saved, it will retrieve related Mms from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Broadcast.
	 */
	public function getMmsJoinPrecinct($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMms === null) {
			if ($this->isNew()) {
				$this->collMms = array();
			} else {

				$criteria->add(MmPeer::BROADCAST_ID, $this->getId());

				$this->collMms = MmPeer::doSelectJoinPrecinct($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmPeer::BROADCAST_ID, $this->getId());

			if (!isset($this->lastMmCriteria) || !$this->lastMmCriteria->equals($criteria)) {
				$this->collMms = MmPeer::doSelectJoinPrecinct($criteria, $con);
			}
		}
		$this->lastMmCriteria = $criteria;

		return $this->collMms;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Broadcast is new, it will return
	 * an empty collection; or if this Broadcast has previously
	 * been saved, it will retrieve related Mms from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Broadcast.
	 */
	public function getMmsJoinGenre($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMms === null) {
			if ($this->isNew()) {
				$this->collMms = array();
			} else {

				$criteria->add(MmPeer::BROADCAST_ID, $this->getId());

				$this->collMms = MmPeer::doSelectJoinGenre($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmPeer::BROADCAST_ID, $this->getId());

			if (!isset($this->lastMmCriteria) || !$this->lastMmCriteria->equals($criteria)) {
				$this->collMms = MmPeer::doSelectJoinGenre($criteria, $con);
			}
		}
		$this->lastMmCriteria = $criteria;

		return $this->collMms;
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Broadcast has previously
	 * been saved, it will retrieve related Mms from storage.
	 * If this Broadcast is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getMmsWithI18n($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMms === null) {
			if ($this->isNew()) {
			   $this->collMms = array();
			} else {

				$criteria->add(MmPeer::BROADCAST_ID, $this->getId());

				$this->collMms = MmPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmPeer::BROADCAST_ID, $this->getId());

				if (!isset($this->lastMmCriteria) || !$this->lastMmCriteria->equals($criteria)) {
					$this->collMms = MmPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
				}
			}
		}
		$this->lastMmCriteria = $criteria;
		return $this->collMms;
	}

	/**
	 * Temporary storage of collMmTemplates to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initMmTemplates()
	{
		if ($this->collMmTemplates === null) {
			$this->collMmTemplates = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Broadcast has previously
	 * been saved, it will retrieve related MmTemplates from storage.
	 * If this Broadcast is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getMmTemplates($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmTemplates === null) {
			if ($this->isNew()) {
			   $this->collMmTemplates = array();
			} else {

				$criteria->add(MmTemplatePeer::BROADCAST_ID, $this->getId());

				MmTemplatePeer::addSelectColumns($criteria);
				$this->collMmTemplates = MmTemplatePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmTemplatePeer::BROADCAST_ID, $this->getId());

				MmTemplatePeer::addSelectColumns($criteria);
				if (!isset($this->lastMmTemplateCriteria) || !$this->lastMmTemplateCriteria->equals($criteria)) {
					$this->collMmTemplates = MmTemplatePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMmTemplateCriteria = $criteria;
		return $this->collMmTemplates;
	}

	/**
	 * Returns the number of related MmTemplates.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countMmTemplates($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MmTemplatePeer::BROADCAST_ID, $this->getId());

		return MmTemplatePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a MmTemplate object to this object
	 * through the MmTemplate foreign key attribute
	 *
	 * @param      MmTemplate $l MmTemplate
	 * @return     void
	 * @throws     PropelException
	 */
	public function addMmTemplate(MmTemplate $l)
	{
		$this->collMmTemplates[] = $l;
		$l->setBroadcast($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Broadcast is new, it will return
	 * an empty collection; or if this Broadcast has previously
	 * been saved, it will retrieve related MmTemplates from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Broadcast.
	 */
	public function getMmTemplatesJoinSerial($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmTemplates === null) {
			if ($this->isNew()) {
				$this->collMmTemplates = array();
			} else {

				$criteria->add(MmTemplatePeer::BROADCAST_ID, $this->getId());

				$this->collMmTemplates = MmTemplatePeer::doSelectJoinSerial($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmTemplatePeer::BROADCAST_ID, $this->getId());

			if (!isset($this->lastMmTemplateCriteria) || !$this->lastMmTemplateCriteria->equals($criteria)) {
				$this->collMmTemplates = MmTemplatePeer::doSelectJoinSerial($criteria, $con);
			}
		}
		$this->lastMmTemplateCriteria = $criteria;

		return $this->collMmTemplates;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Broadcast is new, it will return
	 * an empty collection; or if this Broadcast has previously
	 * been saved, it will retrieve related MmTemplates from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Broadcast.
	 */
	public function getMmTemplatesJoinPrecinct($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmTemplates === null) {
			if ($this->isNew()) {
				$this->collMmTemplates = array();
			} else {

				$criteria->add(MmTemplatePeer::BROADCAST_ID, $this->getId());

				$this->collMmTemplates = MmTemplatePeer::doSelectJoinPrecinct($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmTemplatePeer::BROADCAST_ID, $this->getId());

			if (!isset($this->lastMmTemplateCriteria) || !$this->lastMmTemplateCriteria->equals($criteria)) {
				$this->collMmTemplates = MmTemplatePeer::doSelectJoinPrecinct($criteria, $con);
			}
		}
		$this->lastMmTemplateCriteria = $criteria;

		return $this->collMmTemplates;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Broadcast is new, it will return
	 * an empty collection; or if this Broadcast has previously
	 * been saved, it will retrieve related MmTemplates from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Broadcast.
	 */
	public function getMmTemplatesJoinGenre($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmTemplates === null) {
			if ($this->isNew()) {
				$this->collMmTemplates = array();
			} else {

				$criteria->add(MmTemplatePeer::BROADCAST_ID, $this->getId());

				$this->collMmTemplates = MmTemplatePeer::doSelectJoinGenre($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmTemplatePeer::BROADCAST_ID, $this->getId());

			if (!isset($this->lastMmTemplateCriteria) || !$this->lastMmTemplateCriteria->equals($criteria)) {
				$this->collMmTemplates = MmTemplatePeer::doSelectJoinGenre($criteria, $con);
			}
		}
		$this->lastMmTemplateCriteria = $criteria;

		return $this->collMmTemplates;
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Broadcast has previously
	 * been saved, it will retrieve related MmTemplates from storage.
	 * If this Broadcast is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getMmTemplatesWithI18n($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmTemplates === null) {
			if ($this->isNew()) {
			   $this->collMmTemplates = array();
			} else {

				$criteria->add(MmTemplatePeer::BROADCAST_ID, $this->getId());

				$this->collMmTemplates = MmTemplatePeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmTemplatePeer::BROADCAST_ID, $this->getId());

				if (!isset($this->lastMmTemplateCriteria) || !$this->lastMmTemplateCriteria->equals($criteria)) {
					$this->collMmTemplates = MmTemplatePeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
				}
			}
		}
		$this->lastMmTemplateCriteria = $criteria;
		return $this->collMmTemplates;
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
			if ($this->collBroadcastI18ns) {
				foreach ((array) $this->collBroadcastI18ns as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collMms) {
				foreach ((array) $this->collMms as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collMmTemplates) {
				foreach ((array) $this->collMmTemplates as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collBroadcastI18ns = null;
		$this->collMms = null;
		$this->collMmTemplates = null;
		$this->aBroadcastType = null;
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
    $obj = $this->getCurrentBroadcastI18n();

    return ($obj ? $obj->getDescription() : null);
  }

  public function setDescription($value)
  {
    $this->getCurrentBroadcastI18n()->setDescription($value);
  }

  protected $current_i18n = array();

  public function getCurrentBroadcastI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = BroadcastI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setBroadcastI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setBroadcastI18nForCulture(new BroadcastI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setBroadcastI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addBroadcastI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseBroadcast:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseBroadcast::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseBroadcast
