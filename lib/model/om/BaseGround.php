<?php

/**
 * Base class that represents a row from the 'ground' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseGround extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        GroundPeer
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
	 * The value for the ground_type_id field.
	 * @var        int
	 */
	protected $ground_type_id;

	/**
	 * @var        GroundType
	 */
	protected $aGroundType;

	/**
	 * Collection to store aggregation of collGroundI18ns.
	 * @var        array
	 */
	protected $collGroundI18ns;

	/**
	 * The criteria used to select the current contents of collGroundI18ns.
	 * @var        Criteria
	 */
	protected $lastGroundI18nCriteria = null;

	/**
	 * Collection to store aggregation of collRelationGroundsRelatedByOneId.
	 * @var        array
	 */
	protected $collRelationGroundsRelatedByOneId;

	/**
	 * The criteria used to select the current contents of collRelationGroundsRelatedByOneId.
	 * @var        Criteria
	 */
	protected $lastRelationGroundRelatedByOneIdCriteria = null;

	/**
	 * Collection to store aggregation of collRelationGroundsRelatedByTwoId.
	 * @var        array
	 */
	protected $collRelationGroundsRelatedByTwoId;

	/**
	 * The criteria used to select the current contents of collRelationGroundsRelatedByTwoId.
	 * @var        Criteria
	 */
	protected $lastRelationGroundRelatedByTwoIdCriteria = null;

	/**
	 * Collection to store aggregation of collVirtualGroundRelations.
	 * @var        array
	 */
	protected $collVirtualGroundRelations;

	/**
	 * The criteria used to select the current contents of collVirtualGroundRelations.
	 * @var        Criteria
	 */
	protected $lastVirtualGroundRelationCriteria = null;

	/**
	 * Collection to store aggregation of collGroundMms.
	 * @var        array
	 */
	protected $collGroundMms;

	/**
	 * The criteria used to select the current contents of collGroundMms.
	 * @var        Criteria
	 */
	protected $lastGroundMmCriteria = null;

	/**
	 * Collection to store aggregation of collGroundMmTemplates.
	 * @var        array
	 */
	protected $collGroundMmTemplates;

	/**
	 * The criteria used to select the current contents of collGroundMmTemplates.
	 * @var        Criteria
	 */
	protected $lastGroundMmTemplateCriteria = null;

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
	 * Get the [ground_type_id] column value.
	 * 
	 * @return     int
	 */
	public function getGroundTypeId()
	{

		return $this->ground_type_id;
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
			$this->modifiedColumns[] = GroundPeer::ID;
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
			$this->modifiedColumns[] = GroundPeer::COD;
		}

	} // setCod()

	/**
	 * Set the value of [ground_type_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setGroundTypeId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ground_type_id !== $v) {
			$this->ground_type_id = $v;
			$this->modifiedColumns[] = GroundPeer::GROUND_TYPE_ID;
		}

		if ($this->aGroundType !== null && $this->aGroundType->getId() !== $v) {
			$this->aGroundType = null;
		}

	} // setGroundTypeId()

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

			$this->ground_type_id = $rs->getInt($startcol + 2);

			$this->resetModified();

			$this->setNew(false);
			$this->setCulture(sfContext::getInstance()->getUser()->getCulture());

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 3; // 3 = GroundPeer::NUM_COLUMNS - GroundPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Ground object", $e);
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

    foreach (sfMixer::getCallables('BaseGround:delete:pre') as $callable)
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
			$con = Propel::getConnection(GroundPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			GroundPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseGround:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseGround:save:pre') as $callable)
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
			$con = Propel::getConnection(GroundPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseGround:save:post') as $callable)
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

			if ($this->aGroundType !== null) {
				if ($this->aGroundType->isModified() || $this->aGroundType->getCurrentGroundTypeI18n()->isModified()) {
					$affectedRows += $this->aGroundType->save($con);
				}
				$this->setGroundType($this->aGroundType);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = GroundPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += GroundPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collGroundI18ns !== null) {
				foreach($this->collGroundI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRelationGroundsRelatedByOneId !== null) {
				foreach($this->collRelationGroundsRelatedByOneId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRelationGroundsRelatedByTwoId !== null) {
				foreach($this->collRelationGroundsRelatedByTwoId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collVirtualGroundRelations !== null) {
				foreach($this->collVirtualGroundRelations as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collGroundMms !== null) {
				foreach($this->collGroundMms as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collGroundMmTemplates !== null) {
				foreach($this->collGroundMmTemplates as $referrerFK) {
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

			if ($this->aGroundType !== null) {
				if (!$this->aGroundType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aGroundType->getValidationFailures());
				}
			}


			if (($retval = GroundPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collGroundI18ns !== null) {
					foreach($this->collGroundI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRelationGroundsRelatedByOneId !== null) {
					foreach($this->collRelationGroundsRelatedByOneId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRelationGroundsRelatedByTwoId !== null) {
					foreach($this->collRelationGroundsRelatedByTwoId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collVirtualGroundRelations !== null) {
					foreach($this->collVirtualGroundRelations as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collGroundMms !== null) {
					foreach($this->collGroundMms as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collGroundMmTemplates !== null) {
					foreach($this->collGroundMmTemplates as $referrerFK) {
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
		$pos = GroundPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getGroundTypeId();
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
		$keys = GroundPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCod(),
			$keys[2] => $this->getGroundTypeId(),
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
		$pos = GroundPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setGroundTypeId($value);
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
		$keys = GroundPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCod($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setGroundTypeId($arr[$keys[2]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(GroundPeer::DATABASE_NAME);

		if ($this->isColumnModified(GroundPeer::ID)) $criteria->add(GroundPeer::ID, $this->id);
		if ($this->isColumnModified(GroundPeer::COD)) $criteria->add(GroundPeer::COD, $this->cod);
		if ($this->isColumnModified(GroundPeer::GROUND_TYPE_ID)) $criteria->add(GroundPeer::GROUND_TYPE_ID, $this->ground_type_id);

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
		$criteria = new Criteria(GroundPeer::DATABASE_NAME);

		$criteria->add(GroundPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Ground (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCod($this->cod);

		$copyObj->setGroundTypeId($this->ground_type_id);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getGroundI18ns() as $relObj) {
				$copyObj->addGroundI18n($relObj->copy($deepCopy));
			}

			foreach($this->getRelationGroundsRelatedByOneId() as $relObj) {
				$copyObj->addRelationGroundRelatedByOneId($relObj->copy($deepCopy));
			}

			foreach($this->getRelationGroundsRelatedByTwoId() as $relObj) {
				$copyObj->addRelationGroundRelatedByTwoId($relObj->copy($deepCopy));
			}

			foreach($this->getVirtualGroundRelations() as $relObj) {
				$copyObj->addVirtualGroundRelation($relObj->copy($deepCopy));
			}

			foreach($this->getGroundMms() as $relObj) {
				$copyObj->addGroundMm($relObj->copy($deepCopy));
			}

			foreach($this->getGroundMmTemplates() as $relObj) {
				$copyObj->addGroundMmTemplate($relObj->copy($deepCopy));
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
	 * @return     Ground Clone of current object.
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
	 * @return     GroundPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new GroundPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a GroundType object.
	 *
	 * @param      GroundType $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setGroundType($v)
	{


		if ($v === null) {
			$this->setGroundTypeId(NULL);
		} else {
			$this->setGroundTypeId($v->getId());
		}


		$this->aGroundType = $v;
	}


	/**
	 * Get the associated GroundType object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     GroundType The associated GroundType object.
	 * @throws     PropelException
	 */
	public function getGroundType($con = null)
	{
		if ($this->aGroundType === null && ($this->ground_type_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseGroundTypePeer.php';

			$this->aGroundType = GroundTypePeer::retrieveByPK($this->ground_type_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = GroundTypePeer::retrieveByPK($this->ground_type_id, $con);
			   $obj->addGroundTypes($this);
			 */
		}
		return $this->aGroundType;
	}


	/**
	 * Get the associated GroundType object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     GroundType The associated GroundType object.
	 * @throws     PropelException
	 */
	public function getGroundTypeWithI18n($con = null)
	{
		if ($this->aGroundType === null && ($this->ground_type_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseGroundTypePeer.php';

			$this->aGroundType = GroundTypePeer::retrieveByPKWithI18n($this->ground_type_id, $this->getCulture(), $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = GroundTypePeer::retrieveByPKWithI18n($this->ground_type_id, $this->getCulture(), $con);
			   $obj->addGroundTypes($this);
			 */
		}
		return $this->aGroundType;
	}

	/**
	 * Temporary storage of collGroundI18ns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initGroundI18ns()
	{
		if ($this->collGroundI18ns === null) {
			$this->collGroundI18ns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Ground has previously
	 * been saved, it will retrieve related GroundI18ns from storage.
	 * If this Ground is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getGroundI18ns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseGroundI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGroundI18ns === null) {
			if ($this->isNew()) {
			   $this->collGroundI18ns = array();
			} else {

				$criteria->add(GroundI18nPeer::ID, $this->getId());

				GroundI18nPeer::addSelectColumns($criteria);
				$this->collGroundI18ns = GroundI18nPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(GroundI18nPeer::ID, $this->getId());

				GroundI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastGroundI18nCriteria) || !$this->lastGroundI18nCriteria->equals($criteria)) {
					$this->collGroundI18ns = GroundI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGroundI18nCriteria = $criteria;
		return $this->collGroundI18ns;
	}

	/**
	 * Returns the number of related GroundI18ns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countGroundI18ns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseGroundI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(GroundI18nPeer::ID, $this->getId());

		return GroundI18nPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a GroundI18n object to this object
	 * through the GroundI18n foreign key attribute
	 *
	 * @param      GroundI18n $l GroundI18n
	 * @return     void
	 * @throws     PropelException
	 */
	public function addGroundI18n(GroundI18n $l)
	{
		$this->collGroundI18ns[] = $l;
		$l->setGround($this);
	}

	/**
	 * Temporary storage of collRelationGroundsRelatedByOneId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRelationGroundsRelatedByOneId()
	{
		if ($this->collRelationGroundsRelatedByOneId === null) {
			$this->collRelationGroundsRelatedByOneId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Ground has previously
	 * been saved, it will retrieve related RelationGroundsRelatedByOneId from storage.
	 * If this Ground is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRelationGroundsRelatedByOneId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRelationGroundPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelationGroundsRelatedByOneId === null) {
			if ($this->isNew()) {
			   $this->collRelationGroundsRelatedByOneId = array();
			} else {

				$criteria->add(RelationGroundPeer::ONE_ID, $this->getId());

				RelationGroundPeer::addSelectColumns($criteria);
				$this->collRelationGroundsRelatedByOneId = RelationGroundPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RelationGroundPeer::ONE_ID, $this->getId());

				RelationGroundPeer::addSelectColumns($criteria);
				if (!isset($this->lastRelationGroundRelatedByOneIdCriteria) || !$this->lastRelationGroundRelatedByOneIdCriteria->equals($criteria)) {
					$this->collRelationGroundsRelatedByOneId = RelationGroundPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRelationGroundRelatedByOneIdCriteria = $criteria;
		return $this->collRelationGroundsRelatedByOneId;
	}

	/**
	 * Returns the number of related RelationGroundsRelatedByOneId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRelationGroundsRelatedByOneId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRelationGroundPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RelationGroundPeer::ONE_ID, $this->getId());

		return RelationGroundPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RelationGround object to this object
	 * through the RelationGround foreign key attribute
	 *
	 * @param      RelationGround $l RelationGround
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRelationGroundRelatedByOneId(RelationGround $l)
	{
		$this->collRelationGroundsRelatedByOneId[] = $l;
		$l->setGroundRelatedByOneId($this);
	}

	/**
	 * Temporary storage of collRelationGroundsRelatedByTwoId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRelationGroundsRelatedByTwoId()
	{
		if ($this->collRelationGroundsRelatedByTwoId === null) {
			$this->collRelationGroundsRelatedByTwoId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Ground has previously
	 * been saved, it will retrieve related RelationGroundsRelatedByTwoId from storage.
	 * If this Ground is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRelationGroundsRelatedByTwoId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRelationGroundPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelationGroundsRelatedByTwoId === null) {
			if ($this->isNew()) {
			   $this->collRelationGroundsRelatedByTwoId = array();
			} else {

				$criteria->add(RelationGroundPeer::TWO_ID, $this->getId());

				RelationGroundPeer::addSelectColumns($criteria);
				$this->collRelationGroundsRelatedByTwoId = RelationGroundPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RelationGroundPeer::TWO_ID, $this->getId());

				RelationGroundPeer::addSelectColumns($criteria);
				if (!isset($this->lastRelationGroundRelatedByTwoIdCriteria) || !$this->lastRelationGroundRelatedByTwoIdCriteria->equals($criteria)) {
					$this->collRelationGroundsRelatedByTwoId = RelationGroundPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRelationGroundRelatedByTwoIdCriteria = $criteria;
		return $this->collRelationGroundsRelatedByTwoId;
	}

	/**
	 * Returns the number of related RelationGroundsRelatedByTwoId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRelationGroundsRelatedByTwoId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRelationGroundPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RelationGroundPeer::TWO_ID, $this->getId());

		return RelationGroundPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RelationGround object to this object
	 * through the RelationGround foreign key attribute
	 *
	 * @param      RelationGround $l RelationGround
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRelationGroundRelatedByTwoId(RelationGround $l)
	{
		$this->collRelationGroundsRelatedByTwoId[] = $l;
		$l->setGroundRelatedByTwoId($this);
	}

	/**
	 * Temporary storage of collVirtualGroundRelations to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVirtualGroundRelations()
	{
		if ($this->collVirtualGroundRelations === null) {
			$this->collVirtualGroundRelations = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Ground has previously
	 * been saved, it will retrieve related VirtualGroundRelations from storage.
	 * If this Ground is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVirtualGroundRelations($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVirtualGroundRelationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVirtualGroundRelations === null) {
			if ($this->isNew()) {
			   $this->collVirtualGroundRelations = array();
			} else {

				$criteria->add(VirtualGroundRelationPeer::GROUND_ID, $this->getId());

				VirtualGroundRelationPeer::addSelectColumns($criteria);
				$this->collVirtualGroundRelations = VirtualGroundRelationPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VirtualGroundRelationPeer::GROUND_ID, $this->getId());

				VirtualGroundRelationPeer::addSelectColumns($criteria);
				if (!isset($this->lastVirtualGroundRelationCriteria) || !$this->lastVirtualGroundRelationCriteria->equals($criteria)) {
					$this->collVirtualGroundRelations = VirtualGroundRelationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVirtualGroundRelationCriteria = $criteria;
		return $this->collVirtualGroundRelations;
	}

	/**
	 * Returns the number of related VirtualGroundRelations.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVirtualGroundRelations($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVirtualGroundRelationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VirtualGroundRelationPeer::GROUND_ID, $this->getId());

		return VirtualGroundRelationPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a VirtualGroundRelation object to this object
	 * through the VirtualGroundRelation foreign key attribute
	 *
	 * @param      VirtualGroundRelation $l VirtualGroundRelation
	 * @return     void
	 * @throws     PropelException
	 */
	public function addVirtualGroundRelation(VirtualGroundRelation $l)
	{
		$this->collVirtualGroundRelations[] = $l;
		$l->setGround($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Ground is new, it will return
	 * an empty collection; or if this Ground has previously
	 * been saved, it will retrieve related VirtualGroundRelations from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Ground.
	 */
	public function getVirtualGroundRelationsJoinVirtualGround($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVirtualGroundRelationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVirtualGroundRelations === null) {
			if ($this->isNew()) {
				$this->collVirtualGroundRelations = array();
			} else {

				$criteria->add(VirtualGroundRelationPeer::GROUND_ID, $this->getId());

				$this->collVirtualGroundRelations = VirtualGroundRelationPeer::doSelectJoinVirtualGround($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VirtualGroundRelationPeer::GROUND_ID, $this->getId());

			if (!isset($this->lastVirtualGroundRelationCriteria) || !$this->lastVirtualGroundRelationCriteria->equals($criteria)) {
				$this->collVirtualGroundRelations = VirtualGroundRelationPeer::doSelectJoinVirtualGround($criteria, $con);
			}
		}
		$this->lastVirtualGroundRelationCriteria = $criteria;

		return $this->collVirtualGroundRelations;
	}

	/**
	 * Temporary storage of collGroundMms to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initGroundMms()
	{
		if ($this->collGroundMms === null) {
			$this->collGroundMms = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Ground has previously
	 * been saved, it will retrieve related GroundMms from storage.
	 * If this Ground is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getGroundMms($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseGroundMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGroundMms === null) {
			if ($this->isNew()) {
			   $this->collGroundMms = array();
			} else {

				$criteria->add(GroundMmPeer::GROUND_ID, $this->getId());

				GroundMmPeer::addSelectColumns($criteria);
				$this->collGroundMms = GroundMmPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(GroundMmPeer::GROUND_ID, $this->getId());

				GroundMmPeer::addSelectColumns($criteria);
				if (!isset($this->lastGroundMmCriteria) || !$this->lastGroundMmCriteria->equals($criteria)) {
					$this->collGroundMms = GroundMmPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGroundMmCriteria = $criteria;
		return $this->collGroundMms;
	}

	/**
	 * Returns the number of related GroundMms.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countGroundMms($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseGroundMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(GroundMmPeer::GROUND_ID, $this->getId());

		return GroundMmPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a GroundMm object to this object
	 * through the GroundMm foreign key attribute
	 *
	 * @param      GroundMm $l GroundMm
	 * @return     void
	 * @throws     PropelException
	 */
	public function addGroundMm(GroundMm $l)
	{
		$this->collGroundMms[] = $l;
		$l->setGround($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Ground is new, it will return
	 * an empty collection; or if this Ground has previously
	 * been saved, it will retrieve related GroundMms from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Ground.
	 */
	public function getGroundMmsJoinMm($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseGroundMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGroundMms === null) {
			if ($this->isNew()) {
				$this->collGroundMms = array();
			} else {

				$criteria->add(GroundMmPeer::GROUND_ID, $this->getId());

				$this->collGroundMms = GroundMmPeer::doSelectJoinMm($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(GroundMmPeer::GROUND_ID, $this->getId());

			if (!isset($this->lastGroundMmCriteria) || !$this->lastGroundMmCriteria->equals($criteria)) {
				$this->collGroundMms = GroundMmPeer::doSelectJoinMm($criteria, $con);
			}
		}
		$this->lastGroundMmCriteria = $criteria;

		return $this->collGroundMms;
	}

	/**
	 * Temporary storage of collGroundMmTemplates to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initGroundMmTemplates()
	{
		if ($this->collGroundMmTemplates === null) {
			$this->collGroundMmTemplates = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Ground has previously
	 * been saved, it will retrieve related GroundMmTemplates from storage.
	 * If this Ground is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getGroundMmTemplates($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseGroundMmTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGroundMmTemplates === null) {
			if ($this->isNew()) {
			   $this->collGroundMmTemplates = array();
			} else {

				$criteria->add(GroundMmTemplatePeer::GROUND_ID, $this->getId());

				GroundMmTemplatePeer::addSelectColumns($criteria);
				$this->collGroundMmTemplates = GroundMmTemplatePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(GroundMmTemplatePeer::GROUND_ID, $this->getId());

				GroundMmTemplatePeer::addSelectColumns($criteria);
				if (!isset($this->lastGroundMmTemplateCriteria) || !$this->lastGroundMmTemplateCriteria->equals($criteria)) {
					$this->collGroundMmTemplates = GroundMmTemplatePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGroundMmTemplateCriteria = $criteria;
		return $this->collGroundMmTemplates;
	}

	/**
	 * Returns the number of related GroundMmTemplates.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countGroundMmTemplates($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseGroundMmTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(GroundMmTemplatePeer::GROUND_ID, $this->getId());

		return GroundMmTemplatePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a GroundMmTemplate object to this object
	 * through the GroundMmTemplate foreign key attribute
	 *
	 * @param      GroundMmTemplate $l GroundMmTemplate
	 * @return     void
	 * @throws     PropelException
	 */
	public function addGroundMmTemplate(GroundMmTemplate $l)
	{
		$this->collGroundMmTemplates[] = $l;
		$l->setGround($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Ground is new, it will return
	 * an empty collection; or if this Ground has previously
	 * been saved, it will retrieve related GroundMmTemplates from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Ground.
	 */
	public function getGroundMmTemplatesJoinMmTemplate($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseGroundMmTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGroundMmTemplates === null) {
			if ($this->isNew()) {
				$this->collGroundMmTemplates = array();
			} else {

				$criteria->add(GroundMmTemplatePeer::GROUND_ID, $this->getId());

				$this->collGroundMmTemplates = GroundMmTemplatePeer::doSelectJoinMmTemplate($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(GroundMmTemplatePeer::GROUND_ID, $this->getId());

			if (!isset($this->lastGroundMmTemplateCriteria) || !$this->lastGroundMmTemplateCriteria->equals($criteria)) {
				$this->collGroundMmTemplates = GroundMmTemplatePeer::doSelectJoinMmTemplate($criteria, $con);
			}
		}
		$this->lastGroundMmTemplateCriteria = $criteria;

		return $this->collGroundMmTemplates;
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
    $obj = $this->getCurrentGroundI18n();

    return ($obj ? $obj->getName() : null);
  }

  public function setName($value)
  {
    $this->getCurrentGroundI18n()->setName($value);
  }

  protected $current_i18n = array();

  public function getCurrentGroundI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = GroundI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setGroundI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setGroundI18nForCulture(new GroundI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setGroundI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addGroundI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseGround:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseGround::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseGround
