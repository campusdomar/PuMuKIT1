<?php

/**
 * Base class that represents a row from the 'mm_matterhorn' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseMmMatterhorn extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        MmMatterhornPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the mh_id field.
	 * @var        string
	 */
	protected $mh_id;


	/**
	 * The value for the created_at field.
	 * @var        int
	 */
	protected $created_at;


	/**
	 * The value for the player_url field.
	 * @var        string
	 */
	protected $player_url;


	/**
	 * The value for the duration field.
	 * @var        int
	 */
	protected $duration = 0;


	/**
	 * The value for the num_view field.
	 * @var        int
	 */
	protected $num_view = 0;


	/**
	 * The value for the punt_sum field.
	 * @var        int
	 */
	protected $punt_sum = 0;


	/**
	 * The value for the punt_num field.
	 * @var        int
	 */
	protected $punt_num = 0;


	/**
	 * The value for the language_id field.
	 * @var        int
	 */
	protected $language_id;


	/**
	 * The value for the display field.
	 * @var        boolean
	 */
	protected $display = true;


	/**
	 * The value for the invert field.
	 * @var        boolean
	 */
	protected $invert = true;

	/**
	 * @var        Mm
	 */
	protected $aMm;

	/**
	 * @var        Language
	 */
	protected $aLanguage;

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
	 * Get the [mh_id] column value.
	 * 
	 * @return     string
	 */
	public function getMhId()
	{

		return $this->mh_id;
	}

	/**
	 * Get the [optionally formatted] [created_at] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
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
	 * Get the [player_url] column value.
	 * 
	 * @return     string
	 */
	public function getPlayerUrl()
	{

		return $this->player_url;
	}

	/**
	 * Get the [duration] column value.
	 * 
	 * @return     int
	 */
	public function getDuration()
	{

		return $this->duration;
	}

	/**
	 * Get the [num_view] column value.
	 * 
	 * @return     int
	 */
	public function getNumView()
	{

		return $this->num_view;
	}

	/**
	 * Get the [punt_sum] column value.
	 * 
	 * @return     int
	 */
	public function getPuntSum()
	{

		return $this->punt_sum;
	}

	/**
	 * Get the [punt_num] column value.
	 * 
	 * @return     int
	 */
	public function getPuntNum()
	{

		return $this->punt_num;
	}

	/**
	 * Get the [language_id] column value.
	 * 
	 * @return     int
	 */
	public function getLanguageId()
	{

		return $this->language_id;
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
	 * Get the [invert] column value.
	 * 
	 * @return     boolean
	 */
	public function getInvert()
	{

		return $this->invert;
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
			$this->modifiedColumns[] = MmMatterhornPeer::ID;
		}

		if ($this->aMm !== null && $this->aMm->getId() !== $v) {
			$this->aMm = null;
		}

	} // setId()

	/**
	 * Set the value of [mh_id] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMhId($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mh_id !== $v) {
			$this->mh_id = $v;
			$this->modifiedColumns[] = MmMatterhornPeer::MH_ID;
		}

	} // setMhId()

	/**
	 * Set the value of [created_at] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = MmMatterhornPeer::CREATED_AT;
		}

	} // setCreatedAt()

	/**
	 * Set the value of [player_url] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setPlayerUrl($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->player_url !== $v) {
			$this->player_url = $v;
			$this->modifiedColumns[] = MmMatterhornPeer::PLAYER_URL;
		}

	} // setPlayerUrl()

	/**
	 * Set the value of [duration] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setDuration($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->duration !== $v || $v === 0) {
			$this->duration = $v;
			$this->modifiedColumns[] = MmMatterhornPeer::DURATION;
		}

	} // setDuration()

	/**
	 * Set the value of [num_view] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setNumView($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->num_view !== $v || $v === 0) {
			$this->num_view = $v;
			$this->modifiedColumns[] = MmMatterhornPeer::NUM_VIEW;
		}

	} // setNumView()

	/**
	 * Set the value of [punt_sum] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setPuntSum($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->punt_sum !== $v || $v === 0) {
			$this->punt_sum = $v;
			$this->modifiedColumns[] = MmMatterhornPeer::PUNT_SUM;
		}

	} // setPuntSum()

	/**
	 * Set the value of [punt_num] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setPuntNum($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->punt_num !== $v || $v === 0) {
			$this->punt_num = $v;
			$this->modifiedColumns[] = MmMatterhornPeer::PUNT_NUM;
		}

	} // setPuntNum()

	/**
	 * Set the value of [language_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setLanguageId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->language_id !== $v) {
			$this->language_id = $v;
			$this->modifiedColumns[] = MmMatterhornPeer::LANGUAGE_ID;
		}

		if ($this->aLanguage !== null && $this->aLanguage->getId() !== $v) {
			$this->aLanguage = null;
		}

	} // setLanguageId()

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
			$this->modifiedColumns[] = MmMatterhornPeer::DISPLAY;
		}

	} // setDisplay()

	/**
	 * Set the value of [invert] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setInvert($v)
	{

		if ($this->invert !== $v || $v === true) {
			$this->invert = $v;
			$this->modifiedColumns[] = MmMatterhornPeer::INVERT;
		}

	} // setInvert()

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

			$this->mh_id = $rs->getString($startcol + 1);

			$this->created_at = $rs->getTimestamp($startcol + 2, null);

			$this->player_url = $rs->getString($startcol + 3);

			$this->duration = $rs->getInt($startcol + 4);

			$this->num_view = $rs->getInt($startcol + 5);

			$this->punt_sum = $rs->getInt($startcol + 6);

			$this->punt_num = $rs->getInt($startcol + 7);

			$this->language_id = $rs->getInt($startcol + 8);

			$this->display = $rs->getBoolean($startcol + 9);

			$this->invert = $rs->getBoolean($startcol + 10);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 11; // 11 = MmMatterhornPeer::NUM_COLUMNS - MmMatterhornPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating MmMatterhorn object", $e);
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

    foreach (sfMixer::getCallables('BaseMmMatterhorn:delete:pre') as $callable)
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
			$con = Propel::getConnection(MmMatterhornPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			MmMatterhornPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseMmMatterhorn:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseMmMatterhorn:save:pre') as $callable)
    {
      $affectedRows = call_user_func($callable, $this, $con);
      if (is_int($affectedRows))
      {
        return $affectedRows;
      }
    }


    if ($this->isNew() && !$this->isColumnModified(MmMatterhornPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MmMatterhornPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseMmMatterhorn:save:post') as $callable)
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

			if ($this->aMm !== null) {
				if ($this->aMm->isModified() || $this->aMm->getCurrentMmI18n()->isModified()) {
					$affectedRows += $this->aMm->save($con);
				}
				$this->setMm($this->aMm);
			}

			if ($this->aLanguage !== null) {
				if ($this->aLanguage->isModified() || $this->aLanguage->getCurrentLanguageI18n()->isModified()) {
					$affectedRows += $this->aLanguage->save($con);
				}
				$this->setLanguage($this->aLanguage);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = MmMatterhornPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += MmMatterhornPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
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

			if ($this->aMm !== null) {
				if (!$this->aMm->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMm->getValidationFailures());
				}
			}

			if ($this->aLanguage !== null) {
				if (!$this->aLanguage->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aLanguage->getValidationFailures());
				}
			}


			if (($retval = MmMatterhornPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = MmMatterhornPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getMhId();
				break;
			case 2:
				return $this->getCreatedAt();
				break;
			case 3:
				return $this->getPlayerUrl();
				break;
			case 4:
				return $this->getDuration();
				break;
			case 5:
				return $this->getNumView();
				break;
			case 6:
				return $this->getPuntSum();
				break;
			case 7:
				return $this->getPuntNum();
				break;
			case 8:
				return $this->getLanguageId();
				break;
			case 9:
				return $this->getDisplay();
				break;
			case 10:
				return $this->getInvert();
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
		$keys = MmMatterhornPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getMhId(),
			$keys[2] => $this->getCreatedAt(),
			$keys[3] => $this->getPlayerUrl(),
			$keys[4] => $this->getDuration(),
			$keys[5] => $this->getNumView(),
			$keys[6] => $this->getPuntSum(),
			$keys[7] => $this->getPuntNum(),
			$keys[8] => $this->getLanguageId(),
			$keys[9] => $this->getDisplay(),
			$keys[10] => $this->getInvert(),
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
		$pos = MmMatterhornPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setMhId($value);
				break;
			case 2:
				$this->setCreatedAt($value);
				break;
			case 3:
				$this->setPlayerUrl($value);
				break;
			case 4:
				$this->setDuration($value);
				break;
			case 5:
				$this->setNumView($value);
				break;
			case 6:
				$this->setPuntSum($value);
				break;
			case 7:
				$this->setPuntNum($value);
				break;
			case 8:
				$this->setLanguageId($value);
				break;
			case 9:
				$this->setDisplay($value);
				break;
			case 10:
				$this->setInvert($value);
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
		$keys = MmMatterhornPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setMhId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCreatedAt($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPlayerUrl($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDuration($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setNumView($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPuntSum($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPuntNum($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setLanguageId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setDisplay($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setInvert($arr[$keys[10]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(MmMatterhornPeer::DATABASE_NAME);

		if ($this->isColumnModified(MmMatterhornPeer::ID)) $criteria->add(MmMatterhornPeer::ID, $this->id);
		if ($this->isColumnModified(MmMatterhornPeer::MH_ID)) $criteria->add(MmMatterhornPeer::MH_ID, $this->mh_id);
		if ($this->isColumnModified(MmMatterhornPeer::CREATED_AT)) $criteria->add(MmMatterhornPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(MmMatterhornPeer::PLAYER_URL)) $criteria->add(MmMatterhornPeer::PLAYER_URL, $this->player_url);
		if ($this->isColumnModified(MmMatterhornPeer::DURATION)) $criteria->add(MmMatterhornPeer::DURATION, $this->duration);
		if ($this->isColumnModified(MmMatterhornPeer::NUM_VIEW)) $criteria->add(MmMatterhornPeer::NUM_VIEW, $this->num_view);
		if ($this->isColumnModified(MmMatterhornPeer::PUNT_SUM)) $criteria->add(MmMatterhornPeer::PUNT_SUM, $this->punt_sum);
		if ($this->isColumnModified(MmMatterhornPeer::PUNT_NUM)) $criteria->add(MmMatterhornPeer::PUNT_NUM, $this->punt_num);
		if ($this->isColumnModified(MmMatterhornPeer::LANGUAGE_ID)) $criteria->add(MmMatterhornPeer::LANGUAGE_ID, $this->language_id);
		if ($this->isColumnModified(MmMatterhornPeer::DISPLAY)) $criteria->add(MmMatterhornPeer::DISPLAY, $this->display);
		if ($this->isColumnModified(MmMatterhornPeer::INVERT)) $criteria->add(MmMatterhornPeer::INVERT, $this->invert);

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
		$criteria = new Criteria(MmMatterhornPeer::DATABASE_NAME);

		$criteria->add(MmMatterhornPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of MmMatterhorn (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setMhId($this->mh_id);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setPlayerUrl($this->player_url);

		$copyObj->setDuration($this->duration);

		$copyObj->setNumView($this->num_view);

		$copyObj->setPuntSum($this->punt_sum);

		$copyObj->setPuntNum($this->punt_num);

		$copyObj->setLanguageId($this->language_id);

		$copyObj->setDisplay($this->display);

		$copyObj->setInvert($this->invert);


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
	 * @return     MmMatterhorn Clone of current object.
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
	 * @return     MmMatterhornPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new MmMatterhornPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Mm object.
	 *
	 * @param      Mm $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setMm($v)
	{


		if ($v === null) {
			$this->setId(NULL);
		} else {
			$this->setId($v->getId());
		}


		$this->aMm = $v;
	}


	/**
	 * Get the associated Mm object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Mm The associated Mm object.
	 * @throws     PropelException
	 */
	public function getMm($con = null)
	{
		if ($this->aMm === null && ($this->id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseMmPeer.php';

			$this->aMm = MmPeer::retrieveByPK($this->id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = MmPeer::retrieveByPK($this->id, $con);
			   $obj->addMms($this);
			 */
		}
		return $this->aMm;
	}


	/**
	 * Get the associated Mm object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Mm The associated Mm object.
	 * @throws     PropelException
	 */
	public function getMmWithI18n($con = null)
	{
		if ($this->aMm === null && ($this->id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseMmPeer.php';

			$this->aMm = MmPeer::retrieveByPKWithI18n($this->id, $this->getCulture(), $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = MmPeer::retrieveByPKWithI18n($this->id, $this->getCulture(), $con);
			   $obj->addMms($this);
			 */
		}
		return $this->aMm;
	}

	/**
	 * Declares an association between this object and a Language object.
	 *
	 * @param      Language $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setLanguage($v)
	{


		if ($v === null) {
			$this->setLanguageId(NULL);
		} else {
			$this->setLanguageId($v->getId());
		}


		$this->aLanguage = $v;
	}


	/**
	 * Get the associated Language object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Language The associated Language object.
	 * @throws     PropelException
	 */
	public function getLanguage($con = null)
	{
		if ($this->aLanguage === null && ($this->language_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseLanguagePeer.php';

			$this->aLanguage = LanguagePeer::retrieveByPK($this->language_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = LanguagePeer::retrieveByPK($this->language_id, $con);
			   $obj->addLanguages($this);
			 */
		}
		return $this->aLanguage;
	}


	/**
	 * Get the associated Language object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Language The associated Language object.
	 * @throws     PropelException
	 */
	public function getLanguageWithI18n($con = null)
	{
		if ($this->aLanguage === null && ($this->language_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseLanguagePeer.php';

			$this->aLanguage = LanguagePeer::retrieveByPKWithI18n($this->language_id, $this->getCulture(), $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = LanguagePeer::retrieveByPKWithI18n($this->language_id, $this->getCulture(), $con);
			   $obj->addLanguages($this);
			 */
		}
		return $this->aLanguage;
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
		} // if ($deep)

		$this->aMm = null;
		$this->aLanguage = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseMmMatterhorn:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseMmMatterhorn::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseMmMatterhorn
