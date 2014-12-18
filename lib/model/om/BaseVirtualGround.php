<?php

/**
 * Base class that represents a row from the 'virtual_ground' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseVirtualGround extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        VirtualGroundPeer
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
	 * The value for the description field.
	 * @var        string
	 */
	protected $description;


	/**
	 * The value for the img field.
	 * @var        string
	 */
	protected $img;


	/**
	 * The value for the editorial1 field.
	 * @var        boolean
	 */
	protected $editorial1 = false;


	/**
	 * The value for the editorial2 field.
	 * @var        boolean
	 */
	protected $editorial2 = false;


	/**
	 * The value for the editorial3 field.
	 * @var        boolean
	 */
	protected $editorial3 = false;


	/**
	 * The value for the other field.
	 * @var        boolean
	 */
	protected $other = false;


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
	 * Collection to store aggregation of collVirtualGroundI18ns.
	 * @var        array
	 */
	protected $collVirtualGroundI18ns;

	/**
	 * The criteria used to select the current contents of collVirtualGroundI18ns.
	 * @var        Criteria
	 */
	protected $lastVirtualGroundI18nCriteria = null;

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
	 * Get the [description] column value.
	 * 
	 * @return     string
	 */
	public function getDescription()
	{

		return $this->description;
	}

	/**
	 * Get the [img] column value.
	 * 
	 * @return     string
	 */
	public function getImg()
	{

		return $this->img;
	}

	/**
	 * Get the [editorial1] column value.
	 * 
	 * @return     boolean
	 */
	public function getEditorial1()
	{

		return $this->editorial1;
	}

	/**
	 * Get the [editorial2] column value.
	 * 
	 * @return     boolean
	 */
	public function getEditorial2()
	{

		return $this->editorial2;
	}

	/**
	 * Get the [editorial3] column value.
	 * 
	 * @return     boolean
	 */
	public function getEditorial3()
	{

		return $this->editorial3;
	}

	/**
	 * Get the [other] column value.
	 * 
	 * @return     boolean
	 */
	public function getOther()
	{

		return $this->other;
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
			$this->modifiedColumns[] = VirtualGroundPeer::ID;
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
			$this->modifiedColumns[] = VirtualGroundPeer::COD;
		}

	} // setCod()

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
			$this->modifiedColumns[] = VirtualGroundPeer::DISPLAY;
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
			$this->modifiedColumns[] = VirtualGroundPeer::RANK;
		}

	} // setRank()

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
			$this->modifiedColumns[] = VirtualGroundPeer::DESCRIPTION;
		}

	} // setDescription()

	/**
	 * Set the value of [img] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setImg($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->img !== $v) {
			$this->img = $v;
			$this->modifiedColumns[] = VirtualGroundPeer::IMG;
		}

	} // setImg()

	/**
	 * Set the value of [editorial1] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setEditorial1($v)
	{

		if ($this->editorial1 !== $v || $v === false) {
			$this->editorial1 = $v;
			$this->modifiedColumns[] = VirtualGroundPeer::EDITORIAL1;
		}

	} // setEditorial1()

	/**
	 * Set the value of [editorial2] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setEditorial2($v)
	{

		if ($this->editorial2 !== $v || $v === false) {
			$this->editorial2 = $v;
			$this->modifiedColumns[] = VirtualGroundPeer::EDITORIAL2;
		}

	} // setEditorial2()

	/**
	 * Set the value of [editorial3] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setEditorial3($v)
	{

		if ($this->editorial3 !== $v || $v === false) {
			$this->editorial3 = $v;
			$this->modifiedColumns[] = VirtualGroundPeer::EDITORIAL3;
		}

	} // setEditorial3()

	/**
	 * Set the value of [other] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setOther($v)
	{

		if ($this->other !== $v || $v === false) {
			$this->other = $v;
			$this->modifiedColumns[] = VirtualGroundPeer::OTHER;
		}

	} // setOther()

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
			$this->modifiedColumns[] = VirtualGroundPeer::GROUND_TYPE_ID;
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

			$this->display = $rs->getBoolean($startcol + 2);

			$this->rank = $rs->getInt($startcol + 3);

			$this->description = $rs->getString($startcol + 4);

			$this->img = $rs->getString($startcol + 5);

			$this->editorial1 = $rs->getBoolean($startcol + 6);

			$this->editorial2 = $rs->getBoolean($startcol + 7);

			$this->editorial3 = $rs->getBoolean($startcol + 8);

			$this->other = $rs->getBoolean($startcol + 9);

			$this->ground_type_id = $rs->getInt($startcol + 10);

			$this->resetModified();

			$this->setNew(false);
			$this->setCulture(sfContext::getInstance()->getUser()->getCulture());

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 11; // 11 = VirtualGroundPeer::NUM_COLUMNS - VirtualGroundPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating VirtualGround object", $e);
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

    foreach (sfMixer::getCallables('BaseVirtualGround:delete:pre') as $callable)
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
			$con = Propel::getConnection(VirtualGroundPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			VirtualGroundPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseVirtualGround:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseVirtualGround:save:pre') as $callable)
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
			$con = Propel::getConnection(VirtualGroundPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseVirtualGround:save:post') as $callable)
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
					$pk = VirtualGroundPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += VirtualGroundPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collVirtualGroundI18ns !== null) {
				foreach($this->collVirtualGroundI18ns as $referrerFK) {
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


			if (($retval = VirtualGroundPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collVirtualGroundI18ns !== null) {
					foreach($this->collVirtualGroundI18ns as $referrerFK) {
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
		$pos = VirtualGroundPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getDisplay();
				break;
			case 3:
				return $this->getRank();
				break;
			case 4:
				return $this->getDescription();
				break;
			case 5:
				return $this->getImg();
				break;
			case 6:
				return $this->getEditorial1();
				break;
			case 7:
				return $this->getEditorial2();
				break;
			case 8:
				return $this->getEditorial3();
				break;
			case 9:
				return $this->getOther();
				break;
			case 10:
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
		$keys = VirtualGroundPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCod(),
			$keys[2] => $this->getDisplay(),
			$keys[3] => $this->getRank(),
			$keys[4] => $this->getDescription(),
			$keys[5] => $this->getImg(),
			$keys[6] => $this->getEditorial1(),
			$keys[7] => $this->getEditorial2(),
			$keys[8] => $this->getEditorial3(),
			$keys[9] => $this->getOther(),
			$keys[10] => $this->getGroundTypeId(),
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
		$pos = VirtualGroundPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setDisplay($value);
				break;
			case 3:
				$this->setRank($value);
				break;
			case 4:
				$this->setDescription($value);
				break;
			case 5:
				$this->setImg($value);
				break;
			case 6:
				$this->setEditorial1($value);
				break;
			case 7:
				$this->setEditorial2($value);
				break;
			case 8:
				$this->setEditorial3($value);
				break;
			case 9:
				$this->setOther($value);
				break;
			case 10:
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
		$keys = VirtualGroundPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCod($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDisplay($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRank($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDescription($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setImg($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setEditorial1($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setEditorial2($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setEditorial3($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setOther($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setGroundTypeId($arr[$keys[10]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(VirtualGroundPeer::DATABASE_NAME);

		if ($this->isColumnModified(VirtualGroundPeer::ID)) $criteria->add(VirtualGroundPeer::ID, $this->id);
		if ($this->isColumnModified(VirtualGroundPeer::COD)) $criteria->add(VirtualGroundPeer::COD, $this->cod);
		if ($this->isColumnModified(VirtualGroundPeer::DISPLAY)) $criteria->add(VirtualGroundPeer::DISPLAY, $this->display);
		if ($this->isColumnModified(VirtualGroundPeer::RANK)) $criteria->add(VirtualGroundPeer::RANK, $this->rank);
		if ($this->isColumnModified(VirtualGroundPeer::DESCRIPTION)) $criteria->add(VirtualGroundPeer::DESCRIPTION, $this->description);
		if ($this->isColumnModified(VirtualGroundPeer::IMG)) $criteria->add(VirtualGroundPeer::IMG, $this->img);
		if ($this->isColumnModified(VirtualGroundPeer::EDITORIAL1)) $criteria->add(VirtualGroundPeer::EDITORIAL1, $this->editorial1);
		if ($this->isColumnModified(VirtualGroundPeer::EDITORIAL2)) $criteria->add(VirtualGroundPeer::EDITORIAL2, $this->editorial2);
		if ($this->isColumnModified(VirtualGroundPeer::EDITORIAL3)) $criteria->add(VirtualGroundPeer::EDITORIAL3, $this->editorial3);
		if ($this->isColumnModified(VirtualGroundPeer::OTHER)) $criteria->add(VirtualGroundPeer::OTHER, $this->other);
		if ($this->isColumnModified(VirtualGroundPeer::GROUND_TYPE_ID)) $criteria->add(VirtualGroundPeer::GROUND_TYPE_ID, $this->ground_type_id);

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
		$criteria = new Criteria(VirtualGroundPeer::DATABASE_NAME);

		$criteria->add(VirtualGroundPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of VirtualGround (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCod($this->cod);

		$copyObj->setDisplay($this->display);

		$copyObj->setRank($this->rank);

		$copyObj->setDescription($this->description);

		$copyObj->setImg($this->img);

		$copyObj->setEditorial1($this->editorial1);

		$copyObj->setEditorial2($this->editorial2);

		$copyObj->setEditorial3($this->editorial3);

		$copyObj->setOther($this->other);

		$copyObj->setGroundTypeId($this->ground_type_id);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getVirtualGroundI18ns() as $relObj) {
				$copyObj->addVirtualGroundI18n($relObj->copy($deepCopy));
			}

			foreach($this->getVirtualGroundRelations() as $relObj) {
				$copyObj->addVirtualGroundRelation($relObj->copy($deepCopy));
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
	 * @return     VirtualGround Clone of current object.
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
	 * @return     VirtualGroundPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new VirtualGroundPeer();
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
	 * Temporary storage of collVirtualGroundI18ns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVirtualGroundI18ns()
	{
		if ($this->collVirtualGroundI18ns === null) {
			$this->collVirtualGroundI18ns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this VirtualGround has previously
	 * been saved, it will retrieve related VirtualGroundI18ns from storage.
	 * If this VirtualGround is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVirtualGroundI18ns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVirtualGroundI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVirtualGroundI18ns === null) {
			if ($this->isNew()) {
			   $this->collVirtualGroundI18ns = array();
			} else {

				$criteria->add(VirtualGroundI18nPeer::ID, $this->getId());

				VirtualGroundI18nPeer::addSelectColumns($criteria);
				$this->collVirtualGroundI18ns = VirtualGroundI18nPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VirtualGroundI18nPeer::ID, $this->getId());

				VirtualGroundI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastVirtualGroundI18nCriteria) || !$this->lastVirtualGroundI18nCriteria->equals($criteria)) {
					$this->collVirtualGroundI18ns = VirtualGroundI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVirtualGroundI18nCriteria = $criteria;
		return $this->collVirtualGroundI18ns;
	}

	/**
	 * Returns the number of related VirtualGroundI18ns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVirtualGroundI18ns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVirtualGroundI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VirtualGroundI18nPeer::ID, $this->getId());

		return VirtualGroundI18nPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a VirtualGroundI18n object to this object
	 * through the VirtualGroundI18n foreign key attribute
	 *
	 * @param      VirtualGroundI18n $l VirtualGroundI18n
	 * @return     void
	 * @throws     PropelException
	 */
	public function addVirtualGroundI18n(VirtualGroundI18n $l)
	{
		$this->collVirtualGroundI18ns[] = $l;
		$l->setVirtualGround($this);
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
	 * Otherwise if this VirtualGround has previously
	 * been saved, it will retrieve related VirtualGroundRelations from storage.
	 * If this VirtualGround is new, it will return
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

				$criteria->add(VirtualGroundRelationPeer::VIRTUAL_GROUND_ID, $this->getId());

				VirtualGroundRelationPeer::addSelectColumns($criteria);
				$this->collVirtualGroundRelations = VirtualGroundRelationPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VirtualGroundRelationPeer::VIRTUAL_GROUND_ID, $this->getId());

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

		$criteria->add(VirtualGroundRelationPeer::VIRTUAL_GROUND_ID, $this->getId());

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
		$l->setVirtualGround($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this VirtualGround is new, it will return
	 * an empty collection; or if this VirtualGround has previously
	 * been saved, it will retrieve related VirtualGroundRelations from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in VirtualGround.
	 */
	public function getVirtualGroundRelationsJoinGround($criteria = null, $con = null)
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

				$criteria->add(VirtualGroundRelationPeer::VIRTUAL_GROUND_ID, $this->getId());

				$this->collVirtualGroundRelations = VirtualGroundRelationPeer::doSelectJoinGround($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VirtualGroundRelationPeer::VIRTUAL_GROUND_ID, $this->getId());

			if (!isset($this->lastVirtualGroundRelationCriteria) || !$this->lastVirtualGroundRelationCriteria->equals($criteria)) {
				$this->collVirtualGroundRelations = VirtualGroundRelationPeer::doSelectJoinGround($criteria, $con);
			}
		}
		$this->lastVirtualGroundRelationCriteria = $criteria;

		return $this->collVirtualGroundRelations;
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
    $obj = $this->getCurrentVirtualGroundI18n();

    return ($obj ? $obj->getName() : null);
  }

  public function setName($value)
  {
    $this->getCurrentVirtualGroundI18n()->setName($value);
  }

  protected $current_i18n = array();

  public function getCurrentVirtualGroundI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = VirtualGroundI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setVirtualGroundI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setVirtualGroundI18nForCulture(new VirtualGroundI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setVirtualGroundI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addVirtualGroundI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseVirtualGround:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseVirtualGround::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseVirtualGround
