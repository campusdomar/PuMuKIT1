<?php

/**
 * Base class that represents a row from the 'pub_channel' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BasePubChannel extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PubChannelPeer
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
	 * The value for the default_sel field.
	 * @var        boolean
	 */
	protected $default_sel = false;


	/**
	 * The value for the rank field.
	 * @var        int
	 */
	protected $rank = 0;


	/**
	 * The value for the enable field.
	 * @var        boolean
	 */
	protected $enable = true;

	/**
	 * @var        BroadcastType
	 */
	protected $aBroadcastType;

	/**
	 * Collection to store aggregation of collPubChannelMms.
	 * @var        array
	 */
	protected $collPubChannelMms;

	/**
	 * The criteria used to select the current contents of collPubChannelMms.
	 * @var        Criteria
	 */
	protected $lastPubChannelMmCriteria = null;

	/**
	 * Collection to store aggregation of collPubChannelPerfils.
	 * @var        array
	 */
	protected $collPubChannelPerfils;

	/**
	 * The criteria used to select the current contents of collPubChannelPerfils.
	 * @var        Criteria
	 */
	protected $lastPubChannelPerfilCriteria = null;

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
	 * Get the [default_sel] column value.
	 * 
	 * @return     boolean
	 */
	public function getDefaultSel()
	{

		return $this->default_sel;
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
	 * Get the [enable] column value.
	 * 
	 * @return     boolean
	 */
	public function getEnable()
	{

		return $this->enable;
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
			$this->modifiedColumns[] = PubChannelPeer::ID;
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
			$this->modifiedColumns[] = PubChannelPeer::NAME;
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
			$this->modifiedColumns[] = PubChannelPeer::BROADCAST_TYPE_ID;
		}

		if ($this->aBroadcastType !== null && $this->aBroadcastType->getId() !== $v) {
			$this->aBroadcastType = null;
		}

	} // setBroadcastTypeId()

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
			$this->modifiedColumns[] = PubChannelPeer::DEFAULT_SEL;
		}

	} // setDefaultSel()

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
			$this->modifiedColumns[] = PubChannelPeer::RANK;
		}

	} // setRank()

	/**
	 * Set the value of [enable] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setEnable($v)
	{

		if ($this->enable !== $v || $v === true) {
			$this->enable = $v;
			$this->modifiedColumns[] = PubChannelPeer::ENABLE;
		}

	} // setEnable()

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

			$this->default_sel = $rs->getBoolean($startcol + 3);

			$this->rank = $rs->getInt($startcol + 4);

			$this->enable = $rs->getBoolean($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 6; // 6 = PubChannelPeer::NUM_COLUMNS - PubChannelPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating PubChannel object", $e);
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

    foreach (sfMixer::getCallables('BasePubChannel:delete:pre') as $callable)
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
			$con = Propel::getConnection(PubChannelPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PubChannelPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePubChannel:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BasePubChannel:save:pre') as $callable)
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
			$con = Propel::getConnection(PubChannelPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePubChannel:save:post') as $callable)
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
					$pk = PubChannelPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += PubChannelPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collPubChannelMms !== null) {
				foreach($this->collPubChannelMms as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPubChannelPerfils !== null) {
				foreach($this->collPubChannelPerfils as $referrerFK) {
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


			if (($retval = PubChannelPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPubChannelMms !== null) {
					foreach($this->collPubChannelMms as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPubChannelPerfils !== null) {
					foreach($this->collPubChannelPerfils as $referrerFK) {
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
		$pos = PubChannelPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getDefaultSel();
				break;
			case 4:
				return $this->getRank();
				break;
			case 5:
				return $this->getEnable();
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
		$keys = PubChannelPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getBroadcastTypeId(),
			$keys[3] => $this->getDefaultSel(),
			$keys[4] => $this->getRank(),
			$keys[5] => $this->getEnable(),
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
		$pos = PubChannelPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setDefaultSel($value);
				break;
			case 4:
				$this->setRank($value);
				break;
			case 5:
				$this->setEnable($value);
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
		$keys = PubChannelPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setBroadcastTypeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDefaultSel($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRank($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEnable($arr[$keys[5]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PubChannelPeer::DATABASE_NAME);

		if ($this->isColumnModified(PubChannelPeer::ID)) $criteria->add(PubChannelPeer::ID, $this->id);
		if ($this->isColumnModified(PubChannelPeer::NAME)) $criteria->add(PubChannelPeer::NAME, $this->name);
		if ($this->isColumnModified(PubChannelPeer::BROADCAST_TYPE_ID)) $criteria->add(PubChannelPeer::BROADCAST_TYPE_ID, $this->broadcast_type_id);
		if ($this->isColumnModified(PubChannelPeer::DEFAULT_SEL)) $criteria->add(PubChannelPeer::DEFAULT_SEL, $this->default_sel);
		if ($this->isColumnModified(PubChannelPeer::RANK)) $criteria->add(PubChannelPeer::RANK, $this->rank);
		if ($this->isColumnModified(PubChannelPeer::ENABLE)) $criteria->add(PubChannelPeer::ENABLE, $this->enable);

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
		$criteria = new Criteria(PubChannelPeer::DATABASE_NAME);

		$criteria->add(PubChannelPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of PubChannel (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);

		$copyObj->setBroadcastTypeId($this->broadcast_type_id);

		$copyObj->setDefaultSel($this->default_sel);

		$copyObj->setRank($this->rank);

		$copyObj->setEnable($this->enable);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getPubChannelMms() as $relObj) {
				$copyObj->addPubChannelMm($relObj->copy($deepCopy));
			}

			foreach($this->getPubChannelPerfils() as $relObj) {
				$copyObj->addPubChannelPerfil($relObj->copy($deepCopy));
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
	 * @return     PubChannel Clone of current object.
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
	 * @return     PubChannelPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PubChannelPeer();
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
	 * Temporary storage of collPubChannelMms to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPubChannelMms()
	{
		if ($this->collPubChannelMms === null) {
			$this->collPubChannelMms = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this PubChannel has previously
	 * been saved, it will retrieve related PubChannelMms from storage.
	 * If this PubChannel is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPubChannelMms($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePubChannelMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPubChannelMms === null) {
			if ($this->isNew()) {
			   $this->collPubChannelMms = array();
			} else {

				$criteria->add(PubChannelMmPeer::PUB_CHANNEL_ID, $this->getId());

				PubChannelMmPeer::addSelectColumns($criteria);
				$this->collPubChannelMms = PubChannelMmPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PubChannelMmPeer::PUB_CHANNEL_ID, $this->getId());

				PubChannelMmPeer::addSelectColumns($criteria);
				if (!isset($this->lastPubChannelMmCriteria) || !$this->lastPubChannelMmCriteria->equals($criteria)) {
					$this->collPubChannelMms = PubChannelMmPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPubChannelMmCriteria = $criteria;
		return $this->collPubChannelMms;
	}

	/**
	 * Returns the number of related PubChannelMms.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPubChannelMms($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePubChannelMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PubChannelMmPeer::PUB_CHANNEL_ID, $this->getId());

		return PubChannelMmPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a PubChannelMm object to this object
	 * through the PubChannelMm foreign key attribute
	 *
	 * @param      PubChannelMm $l PubChannelMm
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPubChannelMm(PubChannelMm $l)
	{
		$this->collPubChannelMms[] = $l;
		$l->setPubChannel($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this PubChannel is new, it will return
	 * an empty collection; or if this PubChannel has previously
	 * been saved, it will retrieve related PubChannelMms from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in PubChannel.
	 */
	public function getPubChannelMmsJoinMm($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePubChannelMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPubChannelMms === null) {
			if ($this->isNew()) {
				$this->collPubChannelMms = array();
			} else {

				$criteria->add(PubChannelMmPeer::PUB_CHANNEL_ID, $this->getId());

				$this->collPubChannelMms = PubChannelMmPeer::doSelectJoinMm($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PubChannelMmPeer::PUB_CHANNEL_ID, $this->getId());

			if (!isset($this->lastPubChannelMmCriteria) || !$this->lastPubChannelMmCriteria->equals($criteria)) {
				$this->collPubChannelMms = PubChannelMmPeer::doSelectJoinMm($criteria, $con);
			}
		}
		$this->lastPubChannelMmCriteria = $criteria;

		return $this->collPubChannelMms;
	}

	/**
	 * Temporary storage of collPubChannelPerfils to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPubChannelPerfils()
	{
		if ($this->collPubChannelPerfils === null) {
			$this->collPubChannelPerfils = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this PubChannel has previously
	 * been saved, it will retrieve related PubChannelPerfils from storage.
	 * If this PubChannel is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPubChannelPerfils($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePubChannelPerfilPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPubChannelPerfils === null) {
			if ($this->isNew()) {
			   $this->collPubChannelPerfils = array();
			} else {

				$criteria->add(PubChannelPerfilPeer::PUB_CHANNEL_ID, $this->getId());

				PubChannelPerfilPeer::addSelectColumns($criteria);
				$this->collPubChannelPerfils = PubChannelPerfilPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PubChannelPerfilPeer::PUB_CHANNEL_ID, $this->getId());

				PubChannelPerfilPeer::addSelectColumns($criteria);
				if (!isset($this->lastPubChannelPerfilCriteria) || !$this->lastPubChannelPerfilCriteria->equals($criteria)) {
					$this->collPubChannelPerfils = PubChannelPerfilPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPubChannelPerfilCriteria = $criteria;
		return $this->collPubChannelPerfils;
	}

	/**
	 * Returns the number of related PubChannelPerfils.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPubChannelPerfils($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePubChannelPerfilPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PubChannelPerfilPeer::PUB_CHANNEL_ID, $this->getId());

		return PubChannelPerfilPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a PubChannelPerfil object to this object
	 * through the PubChannelPerfil foreign key attribute
	 *
	 * @param      PubChannelPerfil $l PubChannelPerfil
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPubChannelPerfil(PubChannelPerfil $l)
	{
		$this->collPubChannelPerfils[] = $l;
		$l->setPubChannel($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this PubChannel is new, it will return
	 * an empty collection; or if this PubChannel has previously
	 * been saved, it will retrieve related PubChannelPerfils from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in PubChannel.
	 */
	public function getPubChannelPerfilsJoinPerfilRelatedByPerfil43Id($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePubChannelPerfilPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPubChannelPerfils === null) {
			if ($this->isNew()) {
				$this->collPubChannelPerfils = array();
			} else {

				$criteria->add(PubChannelPerfilPeer::PUB_CHANNEL_ID, $this->getId());

				$this->collPubChannelPerfils = PubChannelPerfilPeer::doSelectJoinPerfilRelatedByPerfil43Id($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PubChannelPerfilPeer::PUB_CHANNEL_ID, $this->getId());

			if (!isset($this->lastPubChannelPerfilCriteria) || !$this->lastPubChannelPerfilCriteria->equals($criteria)) {
				$this->collPubChannelPerfils = PubChannelPerfilPeer::doSelectJoinPerfilRelatedByPerfil43Id($criteria, $con);
			}
		}
		$this->lastPubChannelPerfilCriteria = $criteria;

		return $this->collPubChannelPerfils;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this PubChannel is new, it will return
	 * an empty collection; or if this PubChannel has previously
	 * been saved, it will retrieve related PubChannelPerfils from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in PubChannel.
	 */
	public function getPubChannelPerfilsJoinPerfilRelatedByPerfil169Id($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePubChannelPerfilPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPubChannelPerfils === null) {
			if ($this->isNew()) {
				$this->collPubChannelPerfils = array();
			} else {

				$criteria->add(PubChannelPerfilPeer::PUB_CHANNEL_ID, $this->getId());

				$this->collPubChannelPerfils = PubChannelPerfilPeer::doSelectJoinPerfilRelatedByPerfil169Id($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PubChannelPerfilPeer::PUB_CHANNEL_ID, $this->getId());

			if (!isset($this->lastPubChannelPerfilCriteria) || !$this->lastPubChannelPerfilCriteria->equals($criteria)) {
				$this->collPubChannelPerfils = PubChannelPerfilPeer::doSelectJoinPerfilRelatedByPerfil169Id($criteria, $con);
			}
		}
		$this->lastPubChannelPerfilCriteria = $criteria;

		return $this->collPubChannelPerfils;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this PubChannel is new, it will return
	 * an empty collection; or if this PubChannel has previously
	 * been saved, it will retrieve related PubChannelPerfils from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in PubChannel.
	 */
	public function getPubChannelPerfilsJoinPerfilRelatedByPerfilAudioId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePubChannelPerfilPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPubChannelPerfils === null) {
			if ($this->isNew()) {
				$this->collPubChannelPerfils = array();
			} else {

				$criteria->add(PubChannelPerfilPeer::PUB_CHANNEL_ID, $this->getId());

				$this->collPubChannelPerfils = PubChannelPerfilPeer::doSelectJoinPerfilRelatedByPerfilAudioId($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PubChannelPerfilPeer::PUB_CHANNEL_ID, $this->getId());

			if (!isset($this->lastPubChannelPerfilCriteria) || !$this->lastPubChannelPerfilCriteria->equals($criteria)) {
				$this->collPubChannelPerfils = PubChannelPerfilPeer::doSelectJoinPerfilRelatedByPerfilAudioId($criteria, $con);
			}
		}
		$this->lastPubChannelPerfilCriteria = $criteria;

		return $this->collPubChannelPerfils;
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
			if ($this->collPubChannelMms) {
				foreach ((array) $this->collPubChannelMms as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPubChannelPerfils) {
				foreach ((array) $this->collPubChannelPerfils as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collPubChannelMms = null;
		$this->collPubChannelPerfils = null;
		$this->aBroadcastType = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePubChannel:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePubChannel::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BasePubChannel
