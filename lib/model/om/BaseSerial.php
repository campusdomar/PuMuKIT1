<?php

/**
 * Base class that represents a row from the 'serial' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseSerial extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        SerialPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the announce field.
	 * @var        boolean
	 */
	protected $announce = false;


	/**
	 * The value for the mail field.
	 * @var        boolean
	 */
	protected $mail = false;


	/**
	 * The value for the copyright field.
	 * @var        string
	 */
	protected $copyright = 'Uvigo-Tv';


	/**
	 * The value for the serial_type_id field.
	 * @var        int
	 */
	protected $serial_type_id;


	/**
	 * The value for the serial_template_id field.
	 * @var        int
	 */
	protected $serial_template_id;


	/**
	 * The value for the publicdate field.
	 * @var        int
	 */
	protected $publicdate;

	/**
	 * @var        SerialType
	 */
	protected $aSerialType;

	/**
	 * @var        SerialTemplate
	 */
	protected $aSerialTemplate;

	/**
	 * Collection to store aggregation of collSerialI18ns.
	 * @var        array
	 */
	protected $collSerialI18ns;

	/**
	 * The criteria used to select the current contents of collSerialI18ns.
	 * @var        Criteria
	 */
	protected $lastSerialI18nCriteria = null;

	/**
	 * Collection to store aggregation of collSerialItuness.
	 * @var        array
	 */
	protected $collSerialItuness;

	/**
	 * The criteria used to select the current contents of collSerialItuness.
	 * @var        Criteria
	 */
	protected $lastSerialItunesCriteria = null;

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
	 * Collection to store aggregation of collPicSerials.
	 * @var        array
	 */
	protected $collPicSerials;

	/**
	 * The criteria used to select the current contents of collPicSerials.
	 * @var        Criteria
	 */
	protected $lastPicSerialCriteria = null;

	/**
	 * Collection to store aggregation of collSerialMatterhorns.
	 * @var        array
	 */
	protected $collSerialMatterhorns;

	/**
	 * The criteria used to select the current contents of collSerialMatterhorns.
	 * @var        Criteria
	 */
	protected $lastSerialMatterhornCriteria = null;

	/**
	 * Collection to store aggregation of collSerialHashs.
	 * @var        array
	 */
	protected $collSerialHashs;

	/**
	 * The criteria used to select the current contents of collSerialHashs.
	 * @var        Criteria
	 */
	protected $lastSerialHashCriteria = null;

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
	 * Get the [announce] column value.
	 * 
	 * @return     boolean
	 */
	public function getAnnounce()
	{

		return $this->announce;
	}

	/**
	 * Get the [mail] column value.
	 * 
	 * @return     boolean
	 */
	public function getMail()
	{

		return $this->mail;
	}

	/**
	 * Get the [copyright] column value.
	 * 
	 * @return     string
	 */
	public function getCopyright()
	{

		return $this->copyright;
	}

	/**
	 * Get the [serial_type_id] column value.
	 * 
	 * @return     int
	 */
	public function getSerialTypeId()
	{

		return $this->serial_type_id;
	}

	/**
	 * Get the [serial_template_id] column value.
	 * 
	 * @return     int
	 */
	public function getSerialTemplateId()
	{

		return $this->serial_template_id;
	}

	/**
	 * Get the [optionally formatted] [publicdate] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getPublicdate($format = 'Y-m-d H:i:s')
	{

		if ($this->publicdate === null || $this->publicdate === '') {
			return null;
		} elseif (!is_int($this->publicdate)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->publicdate);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [publicdate] as date/time value: " . var_export($this->publicdate, true));
			}
		} else {
			$ts = $this->publicdate;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
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
			$this->modifiedColumns[] = SerialPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [announce] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setAnnounce($v)
	{

		if ($this->announce !== $v || $v === false) {
			$this->announce = $v;
			$this->modifiedColumns[] = SerialPeer::ANNOUNCE;
		}

	} // setAnnounce()

	/**
	 * Set the value of [mail] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setMail($v)
	{

		if ($this->mail !== $v || $v === false) {
			$this->mail = $v;
			$this->modifiedColumns[] = SerialPeer::MAIL;
		}

	} // setMail()

	/**
	 * Set the value of [copyright] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCopyright($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->copyright !== $v || $v === 'Uvigo-Tv') {
			$this->copyright = $v;
			$this->modifiedColumns[] = SerialPeer::COPYRIGHT;
		}

	} // setCopyright()

	/**
	 * Set the value of [serial_type_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setSerialTypeId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->serial_type_id !== $v) {
			$this->serial_type_id = $v;
			$this->modifiedColumns[] = SerialPeer::SERIAL_TYPE_ID;
		}

		if ($this->aSerialType !== null && $this->aSerialType->getId() !== $v) {
			$this->aSerialType = null;
		}

	} // setSerialTypeId()

	/**
	 * Set the value of [serial_template_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setSerialTemplateId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->serial_template_id !== $v) {
			$this->serial_template_id = $v;
			$this->modifiedColumns[] = SerialPeer::SERIAL_TEMPLATE_ID;
		}

		if ($this->aSerialTemplate !== null && $this->aSerialTemplate->getId() !== $v) {
			$this->aSerialTemplate = null;
		}

	} // setSerialTemplateId()

	/**
	 * Set the value of [publicdate] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setPublicdate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [publicdate] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->publicdate !== $ts) {
			$this->publicdate = $ts;
			$this->modifiedColumns[] = SerialPeer::PUBLICDATE;
		}

	} // setPublicdate()

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

			$this->announce = $rs->getBoolean($startcol + 1);

			$this->mail = $rs->getBoolean($startcol + 2);

			$this->copyright = $rs->getString($startcol + 3);

			$this->serial_type_id = $rs->getInt($startcol + 4);

			$this->serial_template_id = $rs->getInt($startcol + 5);

			$this->publicdate = $rs->getTimestamp($startcol + 6, null);

			$this->resetModified();

			$this->setNew(false);
			$this->setCulture(sfContext::getInstance()->getUser()->getCulture());

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 7; // 7 = SerialPeer::NUM_COLUMNS - SerialPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Serial object", $e);
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

    foreach (sfMixer::getCallables('BaseSerial:delete:pre') as $callable)
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
			$con = Propel::getConnection(SerialPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SerialPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseSerial:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseSerial:save:pre') as $callable)
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
			$con = Propel::getConnection(SerialPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseSerial:save:post') as $callable)
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

			if ($this->aSerialType !== null) {
				if ($this->aSerialType->isModified() || $this->aSerialType->getCurrentSerialTypeI18n()->isModified()) {
					$affectedRows += $this->aSerialType->save($con);
				}
				$this->setSerialType($this->aSerialType);
			}

			if ($this->aSerialTemplate !== null) {
				if ($this->aSerialTemplate->isModified()) {
					$affectedRows += $this->aSerialTemplate->save($con);
				}
				$this->setSerialTemplate($this->aSerialTemplate);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SerialPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += SerialPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collSerialI18ns !== null) {
				foreach($this->collSerialI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSerialItuness !== null) {
				foreach($this->collSerialItuness as $referrerFK) {
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

			if ($this->collPicSerials !== null) {
				foreach($this->collPicSerials as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSerialMatterhorns !== null) {
				foreach($this->collSerialMatterhorns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collSerialHashs !== null) {
				foreach($this->collSerialHashs as $referrerFK) {
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

			if ($this->aSerialType !== null) {
				if (!$this->aSerialType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSerialType->getValidationFailures());
				}
			}

			if ($this->aSerialTemplate !== null) {
				if (!$this->aSerialTemplate->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSerialTemplate->getValidationFailures());
				}
			}


			if (($retval = SerialPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSerialI18ns !== null) {
					foreach($this->collSerialI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSerialItuness !== null) {
					foreach($this->collSerialItuness as $referrerFK) {
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

				if ($this->collPicSerials !== null) {
					foreach($this->collPicSerials as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSerialMatterhorns !== null) {
					foreach($this->collSerialMatterhorns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSerialHashs !== null) {
					foreach($this->collSerialHashs as $referrerFK) {
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
		$pos = SerialPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getAnnounce();
				break;
			case 2:
				return $this->getMail();
				break;
			case 3:
				return $this->getCopyright();
				break;
			case 4:
				return $this->getSerialTypeId();
				break;
			case 5:
				return $this->getSerialTemplateId();
				break;
			case 6:
				return $this->getPublicdate();
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
		$keys = SerialPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getAnnounce(),
			$keys[2] => $this->getMail(),
			$keys[3] => $this->getCopyright(),
			$keys[4] => $this->getSerialTypeId(),
			$keys[5] => $this->getSerialTemplateId(),
			$keys[6] => $this->getPublicdate(),
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
		$pos = SerialPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setAnnounce($value);
				break;
			case 2:
				$this->setMail($value);
				break;
			case 3:
				$this->setCopyright($value);
				break;
			case 4:
				$this->setSerialTypeId($value);
				break;
			case 5:
				$this->setSerialTemplateId($value);
				break;
			case 6:
				$this->setPublicdate($value);
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
		$keys = SerialPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setAnnounce($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setMail($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCopyright($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSerialTypeId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSerialTemplateId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPublicdate($arr[$keys[6]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(SerialPeer::DATABASE_NAME);

		if ($this->isColumnModified(SerialPeer::ID)) $criteria->add(SerialPeer::ID, $this->id);
		if ($this->isColumnModified(SerialPeer::ANNOUNCE)) $criteria->add(SerialPeer::ANNOUNCE, $this->announce);
		if ($this->isColumnModified(SerialPeer::MAIL)) $criteria->add(SerialPeer::MAIL, $this->mail);
		if ($this->isColumnModified(SerialPeer::COPYRIGHT)) $criteria->add(SerialPeer::COPYRIGHT, $this->copyright);
		if ($this->isColumnModified(SerialPeer::SERIAL_TYPE_ID)) $criteria->add(SerialPeer::SERIAL_TYPE_ID, $this->serial_type_id);
		if ($this->isColumnModified(SerialPeer::SERIAL_TEMPLATE_ID)) $criteria->add(SerialPeer::SERIAL_TEMPLATE_ID, $this->serial_template_id);
		if ($this->isColumnModified(SerialPeer::PUBLICDATE)) $criteria->add(SerialPeer::PUBLICDATE, $this->publicdate);

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
		$criteria = new Criteria(SerialPeer::DATABASE_NAME);

		$criteria->add(SerialPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Serial (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setAnnounce($this->announce);

		$copyObj->setMail($this->mail);

		$copyObj->setCopyright($this->copyright);

		$copyObj->setSerialTypeId($this->serial_type_id);

		$copyObj->setSerialTemplateId($this->serial_template_id);

		$copyObj->setPublicdate($this->publicdate);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getSerialI18ns() as $relObj) {
				$copyObj->addSerialI18n($relObj->copy($deepCopy));
			}

			foreach($this->getSerialItuness() as $relObj) {
				$copyObj->addSerialItunes($relObj->copy($deepCopy));
			}

			foreach($this->getMms() as $relObj) {
				$copyObj->addMm($relObj->copy($deepCopy));
			}

			foreach($this->getMmTemplates() as $relObj) {
				$copyObj->addMmTemplate($relObj->copy($deepCopy));
			}

			foreach($this->getPicSerials() as $relObj) {
				$copyObj->addPicSerial($relObj->copy($deepCopy));
			}

			foreach($this->getSerialMatterhorns() as $relObj) {
				$copyObj->addSerialMatterhorn($relObj->copy($deepCopy));
			}

			foreach($this->getSerialHashs() as $relObj) {
				$copyObj->addSerialHash($relObj->copy($deepCopy));
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
	 * @return     Serial Clone of current object.
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
	 * @return     SerialPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new SerialPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a SerialType object.
	 *
	 * @param      SerialType $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setSerialType($v)
	{


		if ($v === null) {
			$this->setSerialTypeId(NULL);
		} else {
			$this->setSerialTypeId($v->getId());
		}


		$this->aSerialType = $v;
	}


	/**
	 * Get the associated SerialType object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     SerialType The associated SerialType object.
	 * @throws     PropelException
	 */
	public function getSerialType($con = null)
	{
		if ($this->aSerialType === null && ($this->serial_type_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseSerialTypePeer.php';

			$this->aSerialType = SerialTypePeer::retrieveByPK($this->serial_type_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = SerialTypePeer::retrieveByPK($this->serial_type_id, $con);
			   $obj->addSerialTypes($this);
			 */
		}
		return $this->aSerialType;
	}


	/**
	 * Get the associated SerialType object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     SerialType The associated SerialType object.
	 * @throws     PropelException
	 */
	public function getSerialTypeWithI18n($con = null)
	{
		if ($this->aSerialType === null && ($this->serial_type_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseSerialTypePeer.php';

			$this->aSerialType = SerialTypePeer::retrieveByPKWithI18n($this->serial_type_id, $this->getCulture(), $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = SerialTypePeer::retrieveByPKWithI18n($this->serial_type_id, $this->getCulture(), $con);
			   $obj->addSerialTypes($this);
			 */
		}
		return $this->aSerialType;
	}

	/**
	 * Declares an association between this object and a SerialTemplate object.
	 *
	 * @param      SerialTemplate $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setSerialTemplate($v)
	{


		if ($v === null) {
			$this->setSerialTemplateId(NULL);
		} else {
			$this->setSerialTemplateId($v->getId());
		}


		$this->aSerialTemplate = $v;
	}


	/**
	 * Get the associated SerialTemplate object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     SerialTemplate The associated SerialTemplate object.
	 * @throws     PropelException
	 */
	public function getSerialTemplate($con = null)
	{
		if ($this->aSerialTemplate === null && ($this->serial_template_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseSerialTemplatePeer.php';

			$this->aSerialTemplate = SerialTemplatePeer::retrieveByPK($this->serial_template_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = SerialTemplatePeer::retrieveByPK($this->serial_template_id, $con);
			   $obj->addSerialTemplates($this);
			 */
		}
		return $this->aSerialTemplate;
	}

	/**
	 * Temporary storage of collSerialI18ns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSerialI18ns()
	{
		if ($this->collSerialI18ns === null) {
			$this->collSerialI18ns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Serial has previously
	 * been saved, it will retrieve related SerialI18ns from storage.
	 * If this Serial is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSerialI18ns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSerialI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSerialI18ns === null) {
			if ($this->isNew()) {
			   $this->collSerialI18ns = array();
			} else {

				$criteria->add(SerialI18nPeer::ID, $this->getId());

				SerialI18nPeer::addSelectColumns($criteria);
				$this->collSerialI18ns = SerialI18nPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SerialI18nPeer::ID, $this->getId());

				SerialI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastSerialI18nCriteria) || !$this->lastSerialI18nCriteria->equals($criteria)) {
					$this->collSerialI18ns = SerialI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSerialI18nCriteria = $criteria;
		return $this->collSerialI18ns;
	}

	/**
	 * Returns the number of related SerialI18ns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSerialI18ns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSerialI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SerialI18nPeer::ID, $this->getId());

		return SerialI18nPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SerialI18n object to this object
	 * through the SerialI18n foreign key attribute
	 *
	 * @param      SerialI18n $l SerialI18n
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSerialI18n(SerialI18n $l)
	{
		$this->collSerialI18ns[] = $l;
		$l->setSerial($this);
	}

	/**
	 * Temporary storage of collSerialItuness to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSerialItuness()
	{
		if ($this->collSerialItuness === null) {
			$this->collSerialItuness = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Serial has previously
	 * been saved, it will retrieve related SerialItuness from storage.
	 * If this Serial is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSerialItuness($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSerialItunesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSerialItuness === null) {
			if ($this->isNew()) {
			   $this->collSerialItuness = array();
			} else {

				$criteria->add(SerialItunesPeer::SERIAL_ID, $this->getId());

				SerialItunesPeer::addSelectColumns($criteria);
				$this->collSerialItuness = SerialItunesPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SerialItunesPeer::SERIAL_ID, $this->getId());

				SerialItunesPeer::addSelectColumns($criteria);
				if (!isset($this->lastSerialItunesCriteria) || !$this->lastSerialItunesCriteria->equals($criteria)) {
					$this->collSerialItuness = SerialItunesPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSerialItunesCriteria = $criteria;
		return $this->collSerialItuness;
	}

	/**
	 * Returns the number of related SerialItuness.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSerialItuness($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSerialItunesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SerialItunesPeer::SERIAL_ID, $this->getId());

		return SerialItunesPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SerialItunes object to this object
	 * through the SerialItunes foreign key attribute
	 *
	 * @param      SerialItunes $l SerialItunes
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSerialItunes(SerialItunes $l)
	{
		$this->collSerialItuness[] = $l;
		$l->setSerial($this);
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
	 * Otherwise if this Serial has previously
	 * been saved, it will retrieve related Mms from storage.
	 * If this Serial is new, it will return
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

				$criteria->add(MmPeer::SERIAL_ID, $this->getId());

				MmPeer::addSelectColumns($criteria);
				$this->collMms = MmPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmPeer::SERIAL_ID, $this->getId());

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

		$criteria->add(MmPeer::SERIAL_ID, $this->getId());

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
		$l->setSerial($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Serial is new, it will return
	 * an empty collection; or if this Serial has previously
	 * been saved, it will retrieve related Mms from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Serial.
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

				$criteria->add(MmPeer::SERIAL_ID, $this->getId());

				$this->collMms = MmPeer::doSelectJoinPrecinct($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmPeer::SERIAL_ID, $this->getId());

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
	 * Otherwise if this Serial is new, it will return
	 * an empty collection; or if this Serial has previously
	 * been saved, it will retrieve related Mms from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Serial.
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

				$criteria->add(MmPeer::SERIAL_ID, $this->getId());

				$this->collMms = MmPeer::doSelectJoinGenre($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmPeer::SERIAL_ID, $this->getId());

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
	 * Otherwise if this Serial is new, it will return
	 * an empty collection; or if this Serial has previously
	 * been saved, it will retrieve related Mms from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Serial.
	 */
	public function getMmsJoinBroadcast($criteria = null, $con = null)
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

				$criteria->add(MmPeer::SERIAL_ID, $this->getId());

				$this->collMms = MmPeer::doSelectJoinBroadcast($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmPeer::SERIAL_ID, $this->getId());

			if (!isset($this->lastMmCriteria) || !$this->lastMmCriteria->equals($criteria)) {
				$this->collMms = MmPeer::doSelectJoinBroadcast($criteria, $con);
			}
		}
		$this->lastMmCriteria = $criteria;

		return $this->collMms;
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Serial has previously
	 * been saved, it will retrieve related Mms from storage.
	 * If this Serial is new, it will return
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

				$criteria->add(MmPeer::SERIAL_ID, $this->getId());

				$this->collMms = MmPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmPeer::SERIAL_ID, $this->getId());

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
	 * Otherwise if this Serial has previously
	 * been saved, it will retrieve related MmTemplates from storage.
	 * If this Serial is new, it will return
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

				$criteria->add(MmTemplatePeer::SERIAL_ID, $this->getId());

				MmTemplatePeer::addSelectColumns($criteria);
				$this->collMmTemplates = MmTemplatePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmTemplatePeer::SERIAL_ID, $this->getId());

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

		$criteria->add(MmTemplatePeer::SERIAL_ID, $this->getId());

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
		$l->setSerial($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Serial is new, it will return
	 * an empty collection; or if this Serial has previously
	 * been saved, it will retrieve related MmTemplates from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Serial.
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

				$criteria->add(MmTemplatePeer::SERIAL_ID, $this->getId());

				$this->collMmTemplates = MmTemplatePeer::doSelectJoinPrecinct($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmTemplatePeer::SERIAL_ID, $this->getId());

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
	 * Otherwise if this Serial is new, it will return
	 * an empty collection; or if this Serial has previously
	 * been saved, it will retrieve related MmTemplates from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Serial.
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

				$criteria->add(MmTemplatePeer::SERIAL_ID, $this->getId());

				$this->collMmTemplates = MmTemplatePeer::doSelectJoinGenre($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmTemplatePeer::SERIAL_ID, $this->getId());

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
	 * Otherwise if this Serial is new, it will return
	 * an empty collection; or if this Serial has previously
	 * been saved, it will retrieve related MmTemplates from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Serial.
	 */
	public function getMmTemplatesJoinBroadcast($criteria = null, $con = null)
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

				$criteria->add(MmTemplatePeer::SERIAL_ID, $this->getId());

				$this->collMmTemplates = MmTemplatePeer::doSelectJoinBroadcast($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmTemplatePeer::SERIAL_ID, $this->getId());

			if (!isset($this->lastMmTemplateCriteria) || !$this->lastMmTemplateCriteria->equals($criteria)) {
				$this->collMmTemplates = MmTemplatePeer::doSelectJoinBroadcast($criteria, $con);
			}
		}
		$this->lastMmTemplateCriteria = $criteria;

		return $this->collMmTemplates;
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Serial has previously
	 * been saved, it will retrieve related MmTemplates from storage.
	 * If this Serial is new, it will return
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

				$criteria->add(MmTemplatePeer::SERIAL_ID, $this->getId());

				$this->collMmTemplates = MmTemplatePeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmTemplatePeer::SERIAL_ID, $this->getId());

				if (!isset($this->lastMmTemplateCriteria) || !$this->lastMmTemplateCriteria->equals($criteria)) {
					$this->collMmTemplates = MmTemplatePeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
				}
			}
		}
		$this->lastMmTemplateCriteria = $criteria;
		return $this->collMmTemplates;
	}

	/**
	 * Temporary storage of collPicSerials to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPicSerials()
	{
		if ($this->collPicSerials === null) {
			$this->collPicSerials = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Serial has previously
	 * been saved, it will retrieve related PicSerials from storage.
	 * If this Serial is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPicSerials($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePicSerialPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPicSerials === null) {
			if ($this->isNew()) {
			   $this->collPicSerials = array();
			} else {

				$criteria->add(PicSerialPeer::OTHER_ID, $this->getId());

				PicSerialPeer::addSelectColumns($criteria);
				$this->collPicSerials = PicSerialPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PicSerialPeer::OTHER_ID, $this->getId());

				PicSerialPeer::addSelectColumns($criteria);
				if (!isset($this->lastPicSerialCriteria) || !$this->lastPicSerialCriteria->equals($criteria)) {
					$this->collPicSerials = PicSerialPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPicSerialCriteria = $criteria;
		return $this->collPicSerials;
	}

	/**
	 * Returns the number of related PicSerials.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPicSerials($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePicSerialPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PicSerialPeer::OTHER_ID, $this->getId());

		return PicSerialPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a PicSerial object to this object
	 * through the PicSerial foreign key attribute
	 *
	 * @param      PicSerial $l PicSerial
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPicSerial(PicSerial $l)
	{
		$this->collPicSerials[] = $l;
		$l->setSerial($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Serial is new, it will return
	 * an empty collection; or if this Serial has previously
	 * been saved, it will retrieve related PicSerials from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Serial.
	 */
	public function getPicSerialsJoinPic($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePicSerialPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPicSerials === null) {
			if ($this->isNew()) {
				$this->collPicSerials = array();
			} else {

				$criteria->add(PicSerialPeer::OTHER_ID, $this->getId());

				$this->collPicSerials = PicSerialPeer::doSelectJoinPic($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PicSerialPeer::OTHER_ID, $this->getId());

			if (!isset($this->lastPicSerialCriteria) || !$this->lastPicSerialCriteria->equals($criteria)) {
				$this->collPicSerials = PicSerialPeer::doSelectJoinPic($criteria, $con);
			}
		}
		$this->lastPicSerialCriteria = $criteria;

		return $this->collPicSerials;
	}

	/**
	 * Temporary storage of collSerialMatterhorns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSerialMatterhorns()
	{
		if ($this->collSerialMatterhorns === null) {
			$this->collSerialMatterhorns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Serial has previously
	 * been saved, it will retrieve related SerialMatterhorns from storage.
	 * If this Serial is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSerialMatterhorns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSerialMatterhornPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSerialMatterhorns === null) {
			if ($this->isNew()) {
			   $this->collSerialMatterhorns = array();
			} else {

				$criteria->add(SerialMatterhornPeer::ID, $this->getId());

				SerialMatterhornPeer::addSelectColumns($criteria);
				$this->collSerialMatterhorns = SerialMatterhornPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SerialMatterhornPeer::ID, $this->getId());

				SerialMatterhornPeer::addSelectColumns($criteria);
				if (!isset($this->lastSerialMatterhornCriteria) || !$this->lastSerialMatterhornCriteria->equals($criteria)) {
					$this->collSerialMatterhorns = SerialMatterhornPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSerialMatterhornCriteria = $criteria;
		return $this->collSerialMatterhorns;
	}

	/**
	 * Returns the number of related SerialMatterhorns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSerialMatterhorns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSerialMatterhornPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SerialMatterhornPeer::ID, $this->getId());

		return SerialMatterhornPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SerialMatterhorn object to this object
	 * through the SerialMatterhorn foreign key attribute
	 *
	 * @param      SerialMatterhorn $l SerialMatterhorn
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSerialMatterhorn(SerialMatterhorn $l)
	{
		$this->collSerialMatterhorns[] = $l;
		$l->setSerial($this);
	}

	/**
	 * Temporary storage of collSerialHashs to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initSerialHashs()
	{
		if ($this->collSerialHashs === null) {
			$this->collSerialHashs = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Serial has previously
	 * been saved, it will retrieve related SerialHashs from storage.
	 * If this Serial is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getSerialHashs($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSerialHashPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSerialHashs === null) {
			if ($this->isNew()) {
			   $this->collSerialHashs = array();
			} else {

				$criteria->add(SerialHashPeer::SERIAL_ID, $this->getId());

				SerialHashPeer::addSelectColumns($criteria);
				$this->collSerialHashs = SerialHashPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(SerialHashPeer::SERIAL_ID, $this->getId());

				SerialHashPeer::addSelectColumns($criteria);
				if (!isset($this->lastSerialHashCriteria) || !$this->lastSerialHashCriteria->equals($criteria)) {
					$this->collSerialHashs = SerialHashPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSerialHashCriteria = $criteria;
		return $this->collSerialHashs;
	}

	/**
	 * Returns the number of related SerialHashs.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countSerialHashs($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseSerialHashPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SerialHashPeer::SERIAL_ID, $this->getId());

		return SerialHashPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a SerialHash object to this object
	 * through the SerialHash foreign key attribute
	 *
	 * @param      SerialHash $l SerialHash
	 * @return     void
	 * @throws     PropelException
	 */
	public function addSerialHash(SerialHash $l)
	{
		$this->collSerialHashs[] = $l;
		$l->setSerial($this);
	}

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getTitle()
  {
    $obj = $this->getCurrentSerialI18n();

    return ($obj ? $obj->getTitle() : null);
  }

  public function setTitle($value)
  {
    $this->getCurrentSerialI18n()->setTitle($value);
  }

  public function getSubtitle()
  {
    $obj = $this->getCurrentSerialI18n();

    return ($obj ? $obj->getSubtitle() : null);
  }

  public function setSubtitle($value)
  {
    $this->getCurrentSerialI18n()->setSubtitle($value);
  }

  public function getKeyword()
  {
    $obj = $this->getCurrentSerialI18n();

    return ($obj ? $obj->getKeyword() : null);
  }

  public function setKeyword($value)
  {
    $this->getCurrentSerialI18n()->setKeyword($value);
  }

  public function getDescription()
  {
    $obj = $this->getCurrentSerialI18n();

    return ($obj ? $obj->getDescription() : null);
  }

  public function setDescription($value)
  {
    $this->getCurrentSerialI18n()->setDescription($value);
  }

  public function getHeader()
  {
    $obj = $this->getCurrentSerialI18n();

    return ($obj ? $obj->getHeader() : null);
  }

  public function setHeader($value)
  {
    $this->getCurrentSerialI18n()->setHeader($value);
  }

  public function getFooter()
  {
    $obj = $this->getCurrentSerialI18n();

    return ($obj ? $obj->getFooter() : null);
  }

  public function setFooter($value)
  {
    $this->getCurrentSerialI18n()->setFooter($value);
  }

  public function getLine2()
  {
    $obj = $this->getCurrentSerialI18n();

    return ($obj ? $obj->getLine2() : null);
  }

  public function setLine2($value)
  {
    $this->getCurrentSerialI18n()->setLine2($value);
  }

  protected $current_i18n = array();

  public function getCurrentSerialI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = SerialI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setSerialI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setSerialI18nForCulture(new SerialI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setSerialI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addSerialI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseSerial:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseSerial::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseSerial
