<?php

/**
 * Base class that represents a row from the 'mm_template' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseMmTemplate extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        MmTemplatePeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the subserial field.
	 * @var        boolean
	 */
	protected $subserial = false;


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
	 * The value for the serial_id field.
	 * @var        int
	 */
	protected $serial_id;


	/**
	 * The value for the rank field.
	 * @var        int
	 */
	protected $rank = 0;


	/**
	 * The value for the precinct_id field.
	 * @var        int
	 */
	protected $precinct_id;


	/**
	 * The value for the genre_id field.
	 * @var        int
	 */
	protected $genre_id;


	/**
	 * The value for the broadcast_id field.
	 * @var        int
	 */
	protected $broadcast_id;


	/**
	 * The value for the copyright field.
	 * @var        string
	 */
	protected $copyright;


	/**
	 * The value for the status_id field.
	 * @var        int
	 */
	protected $status_id = 0;


	/**
	 * The value for the recorddate field.
	 * @var        int
	 */
	protected $recorddate;


	/**
	 * The value for the publicdate field.
	 * @var        int
	 */
	protected $publicdate;

	/**
	 * @var        Serial
	 */
	protected $aSerial;

	/**
	 * @var        Precinct
	 */
	protected $aPrecinct;

	/**
	 * @var        Genre
	 */
	protected $aGenre;

	/**
	 * @var        Broadcast
	 */
	protected $aBroadcast;

	/**
	 * Collection to store aggregation of collMmTemplateI18ns.
	 * @var        array
	 */
	protected $collMmTemplateI18ns;

	/**
	 * The criteria used to select the current contents of collMmTemplateI18ns.
	 * @var        Criteria
	 */
	protected $lastMmTemplateI18nCriteria = null;

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
	 * Get the [subserial] column value.
	 * 
	 * @return     boolean
	 */
	public function getSubserial()
	{

		return $this->subserial;
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
	 * Get the [serial_id] column value.
	 * 
	 * @return     int
	 */
	public function getSerialId()
	{

		return $this->serial_id;
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
	 * Get the [precinct_id] column value.
	 * 
	 * @return     int
	 */
	public function getPrecinctId()
	{

		return $this->precinct_id;
	}

	/**
	 * Get the [genre_id] column value.
	 * 
	 * @return     int
	 */
	public function getGenreId()
	{

		return $this->genre_id;
	}

	/**
	 * Get the [broadcast_id] column value.
	 * 
	 * @return     int
	 */
	public function getBroadcastId()
	{

		return $this->broadcast_id;
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
	 * Get the [status_id] column value.
	 * 
	 * @return     int
	 */
	public function getStatusId()
	{

		return $this->status_id;
	}

	/**
	 * Get the [optionally formatted] [recorddate] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getRecorddate($format = 'Y-m-d H:i:s')
	{

		if ($this->recorddate === null || $this->recorddate === '') {
			return null;
		} elseif (!is_int($this->recorddate)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->recorddate);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [recorddate] as date/time value: " . var_export($this->recorddate, true));
			}
		} else {
			$ts = $this->recorddate;
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
			$this->modifiedColumns[] = MmTemplatePeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [subserial] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setSubserial($v)
	{

		if ($this->subserial !== $v || $v === false) {
			$this->subserial = $v;
			$this->modifiedColumns[] = MmTemplatePeer::SUBSERIAL;
		}

	} // setSubserial()

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
			$this->modifiedColumns[] = MmTemplatePeer::ANNOUNCE;
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
			$this->modifiedColumns[] = MmTemplatePeer::MAIL;
		}

	} // setMail()

	/**
	 * Set the value of [serial_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setSerialId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->serial_id !== $v) {
			$this->serial_id = $v;
			$this->modifiedColumns[] = MmTemplatePeer::SERIAL_ID;
		}

		if ($this->aSerial !== null && $this->aSerial->getId() !== $v) {
			$this->aSerial = null;
		}

	} // setSerialId()

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
			$this->modifiedColumns[] = MmTemplatePeer::RANK;
		}

	} // setRank()

	/**
	 * Set the value of [precinct_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setPrecinctId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->precinct_id !== $v) {
			$this->precinct_id = $v;
			$this->modifiedColumns[] = MmTemplatePeer::PRECINCT_ID;
		}

		if ($this->aPrecinct !== null && $this->aPrecinct->getId() !== $v) {
			$this->aPrecinct = null;
		}

	} // setPrecinctId()

	/**
	 * Set the value of [genre_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setGenreId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->genre_id !== $v) {
			$this->genre_id = $v;
			$this->modifiedColumns[] = MmTemplatePeer::GENRE_ID;
		}

		if ($this->aGenre !== null && $this->aGenre->getId() !== $v) {
			$this->aGenre = null;
		}

	} // setGenreId()

	/**
	 * Set the value of [broadcast_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setBroadcastId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->broadcast_id !== $v) {
			$this->broadcast_id = $v;
			$this->modifiedColumns[] = MmTemplatePeer::BROADCAST_ID;
		}

		if ($this->aBroadcast !== null && $this->aBroadcast->getId() !== $v) {
			$this->aBroadcast = null;
		}

	} // setBroadcastId()

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

		if ($this->copyright !== $v) {
			$this->copyright = $v;
			$this->modifiedColumns[] = MmTemplatePeer::COPYRIGHT;
		}

	} // setCopyright()

	/**
	 * Set the value of [status_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setStatusId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->status_id !== $v || $v === 0) {
			$this->status_id = $v;
			$this->modifiedColumns[] = MmTemplatePeer::STATUS_ID;
		}

	} // setStatusId()

	/**
	 * Set the value of [recorddate] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setRecorddate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [recorddate] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->recorddate !== $ts) {
			$this->recorddate = $ts;
			$this->modifiedColumns[] = MmTemplatePeer::RECORDDATE;
		}

	} // setRecorddate()

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
			$this->modifiedColumns[] = MmTemplatePeer::PUBLICDATE;
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

			$this->subserial = $rs->getBoolean($startcol + 1);

			$this->announce = $rs->getBoolean($startcol + 2);

			$this->mail = $rs->getBoolean($startcol + 3);

			$this->serial_id = $rs->getInt($startcol + 4);

			$this->rank = $rs->getInt($startcol + 5);

			$this->precinct_id = $rs->getInt($startcol + 6);

			$this->genre_id = $rs->getInt($startcol + 7);

			$this->broadcast_id = $rs->getInt($startcol + 8);

			$this->copyright = $rs->getString($startcol + 9);

			$this->status_id = $rs->getInt($startcol + 10);

			$this->recorddate = $rs->getTimestamp($startcol + 11, null);

			$this->publicdate = $rs->getTimestamp($startcol + 12, null);

			$this->resetModified();

			$this->setNew(false);
			$this->setCulture(sfContext::getInstance()->getUser()->getCulture());

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 13; // 13 = MmTemplatePeer::NUM_COLUMNS - MmTemplatePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating MmTemplate object", $e);
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

    foreach (sfMixer::getCallables('BaseMmTemplate:delete:pre') as $callable)
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
			$con = Propel::getConnection(MmTemplatePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			MmTemplatePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseMmTemplate:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseMmTemplate:save:pre') as $callable)
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
			$con = Propel::getConnection(MmTemplatePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseMmTemplate:save:post') as $callable)
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

			if ($this->aSerial !== null) {
				if ($this->aSerial->isModified() || $this->aSerial->getCurrentSerialI18n()->isModified()) {
					$affectedRows += $this->aSerial->save($con);
				}
				$this->setSerial($this->aSerial);
			}

			if ($this->aPrecinct !== null) {
				if ($this->aPrecinct->isModified() || $this->aPrecinct->getCurrentPrecinctI18n()->isModified()) {
					$affectedRows += $this->aPrecinct->save($con);
				}
				$this->setPrecinct($this->aPrecinct);
			}

			if ($this->aGenre !== null) {
				if ($this->aGenre->isModified() || $this->aGenre->getCurrentGenreI18n()->isModified()) {
					$affectedRows += $this->aGenre->save($con);
				}
				$this->setGenre($this->aGenre);
			}

			if ($this->aBroadcast !== null) {
				if ($this->aBroadcast->isModified() || $this->aBroadcast->getCurrentBroadcastI18n()->isModified()) {
					$affectedRows += $this->aBroadcast->save($con);
				}
				$this->setBroadcast($this->aBroadcast);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = MmTemplatePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += MmTemplatePeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collMmTemplateI18ns !== null) {
				foreach($this->collMmTemplateI18ns as $referrerFK) {
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

			if ($this->aSerial !== null) {
				if (!$this->aSerial->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSerial->getValidationFailures());
				}
			}

			if ($this->aPrecinct !== null) {
				if (!$this->aPrecinct->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPrecinct->getValidationFailures());
				}
			}

			if ($this->aGenre !== null) {
				if (!$this->aGenre->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aGenre->getValidationFailures());
				}
			}

			if ($this->aBroadcast !== null) {
				if (!$this->aBroadcast->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aBroadcast->getValidationFailures());
				}
			}


			if (($retval = MmTemplatePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collMmTemplateI18ns !== null) {
					foreach($this->collMmTemplateI18ns as $referrerFK) {
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
		$pos = MmTemplatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getSubserial();
				break;
			case 2:
				return $this->getAnnounce();
				break;
			case 3:
				return $this->getMail();
				break;
			case 4:
				return $this->getSerialId();
				break;
			case 5:
				return $this->getRank();
				break;
			case 6:
				return $this->getPrecinctId();
				break;
			case 7:
				return $this->getGenreId();
				break;
			case 8:
				return $this->getBroadcastId();
				break;
			case 9:
				return $this->getCopyright();
				break;
			case 10:
				return $this->getStatusId();
				break;
			case 11:
				return $this->getRecorddate();
				break;
			case 12:
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
		$keys = MmTemplatePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getSubserial(),
			$keys[2] => $this->getAnnounce(),
			$keys[3] => $this->getMail(),
			$keys[4] => $this->getSerialId(),
			$keys[5] => $this->getRank(),
			$keys[6] => $this->getPrecinctId(),
			$keys[7] => $this->getGenreId(),
			$keys[8] => $this->getBroadcastId(),
			$keys[9] => $this->getCopyright(),
			$keys[10] => $this->getStatusId(),
			$keys[11] => $this->getRecorddate(),
			$keys[12] => $this->getPublicdate(),
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
		$pos = MmTemplatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setSubserial($value);
				break;
			case 2:
				$this->setAnnounce($value);
				break;
			case 3:
				$this->setMail($value);
				break;
			case 4:
				$this->setSerialId($value);
				break;
			case 5:
				$this->setRank($value);
				break;
			case 6:
				$this->setPrecinctId($value);
				break;
			case 7:
				$this->setGenreId($value);
				break;
			case 8:
				$this->setBroadcastId($value);
				break;
			case 9:
				$this->setCopyright($value);
				break;
			case 10:
				$this->setStatusId($value);
				break;
			case 11:
				$this->setRecorddate($value);
				break;
			case 12:
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
		$keys = MmTemplatePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSubserial($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAnnounce($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMail($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSerialId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setRank($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPrecinctId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setGenreId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setBroadcastId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCopyright($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setStatusId($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setRecorddate($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setPublicdate($arr[$keys[12]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(MmTemplatePeer::DATABASE_NAME);

		if ($this->isColumnModified(MmTemplatePeer::ID)) $criteria->add(MmTemplatePeer::ID, $this->id);
		if ($this->isColumnModified(MmTemplatePeer::SUBSERIAL)) $criteria->add(MmTemplatePeer::SUBSERIAL, $this->subserial);
		if ($this->isColumnModified(MmTemplatePeer::ANNOUNCE)) $criteria->add(MmTemplatePeer::ANNOUNCE, $this->announce);
		if ($this->isColumnModified(MmTemplatePeer::MAIL)) $criteria->add(MmTemplatePeer::MAIL, $this->mail);
		if ($this->isColumnModified(MmTemplatePeer::SERIAL_ID)) $criteria->add(MmTemplatePeer::SERIAL_ID, $this->serial_id);
		if ($this->isColumnModified(MmTemplatePeer::RANK)) $criteria->add(MmTemplatePeer::RANK, $this->rank);
		if ($this->isColumnModified(MmTemplatePeer::PRECINCT_ID)) $criteria->add(MmTemplatePeer::PRECINCT_ID, $this->precinct_id);
		if ($this->isColumnModified(MmTemplatePeer::GENRE_ID)) $criteria->add(MmTemplatePeer::GENRE_ID, $this->genre_id);
		if ($this->isColumnModified(MmTemplatePeer::BROADCAST_ID)) $criteria->add(MmTemplatePeer::BROADCAST_ID, $this->broadcast_id);
		if ($this->isColumnModified(MmTemplatePeer::COPYRIGHT)) $criteria->add(MmTemplatePeer::COPYRIGHT, $this->copyright);
		if ($this->isColumnModified(MmTemplatePeer::STATUS_ID)) $criteria->add(MmTemplatePeer::STATUS_ID, $this->status_id);
		if ($this->isColumnModified(MmTemplatePeer::RECORDDATE)) $criteria->add(MmTemplatePeer::RECORDDATE, $this->recorddate);
		if ($this->isColumnModified(MmTemplatePeer::PUBLICDATE)) $criteria->add(MmTemplatePeer::PUBLICDATE, $this->publicdate);

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
		$criteria = new Criteria(MmTemplatePeer::DATABASE_NAME);

		$criteria->add(MmTemplatePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of MmTemplate (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setSubserial($this->subserial);

		$copyObj->setAnnounce($this->announce);

		$copyObj->setMail($this->mail);

		$copyObj->setSerialId($this->serial_id);

		$copyObj->setRank($this->rank);

		$copyObj->setPrecinctId($this->precinct_id);

		$copyObj->setGenreId($this->genre_id);

		$copyObj->setBroadcastId($this->broadcast_id);

		$copyObj->setCopyright($this->copyright);

		$copyObj->setStatusId($this->status_id);

		$copyObj->setRecorddate($this->recorddate);

		$copyObj->setPublicdate($this->publicdate);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getMmTemplateI18ns() as $relObj) {
				$copyObj->addMmTemplateI18n($relObj->copy($deepCopy));
			}

			foreach($this->getMmTemplatePersons() as $relObj) {
				$copyObj->addMmTemplatePerson($relObj->copy($deepCopy));
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
	 * @return     MmTemplate Clone of current object.
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
	 * @return     MmTemplatePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new MmTemplatePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Serial object.
	 *
	 * @param      Serial $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setSerial($v)
	{


		if ($v === null) {
			$this->setSerialId(NULL);
		} else {
			$this->setSerialId($v->getId());
		}


		$this->aSerial = $v;
	}


	/**
	 * Get the associated Serial object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Serial The associated Serial object.
	 * @throws     PropelException
	 */
	public function getSerial($con = null)
	{
		if ($this->aSerial === null && ($this->serial_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseSerialPeer.php';

			$this->aSerial = SerialPeer::retrieveByPK($this->serial_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = SerialPeer::retrieveByPK($this->serial_id, $con);
			   $obj->addSerials($this);
			 */
		}
		return $this->aSerial;
	}


	/**
	 * Get the associated Serial object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Serial The associated Serial object.
	 * @throws     PropelException
	 */
	public function getSerialWithI18n($con = null)
	{
		if ($this->aSerial === null && ($this->serial_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseSerialPeer.php';

			$this->aSerial = SerialPeer::retrieveByPKWithI18n($this->serial_id, $this->getCulture(), $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = SerialPeer::retrieveByPKWithI18n($this->serial_id, $this->getCulture(), $con);
			   $obj->addSerials($this);
			 */
		}
		return $this->aSerial;
	}

	/**
	 * Declares an association between this object and a Precinct object.
	 *
	 * @param      Precinct $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setPrecinct($v)
	{


		if ($v === null) {
			$this->setPrecinctId(NULL);
		} else {
			$this->setPrecinctId($v->getId());
		}


		$this->aPrecinct = $v;
	}


	/**
	 * Get the associated Precinct object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Precinct The associated Precinct object.
	 * @throws     PropelException
	 */
	public function getPrecinct($con = null)
	{
		if ($this->aPrecinct === null && ($this->precinct_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BasePrecinctPeer.php';

			$this->aPrecinct = PrecinctPeer::retrieveByPK($this->precinct_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = PrecinctPeer::retrieveByPK($this->precinct_id, $con);
			   $obj->addPrecincts($this);
			 */
		}
		return $this->aPrecinct;
	}


	/**
	 * Get the associated Precinct object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Precinct The associated Precinct object.
	 * @throws     PropelException
	 */
	public function getPrecinctWithI18n($con = null)
	{
		if ($this->aPrecinct === null && ($this->precinct_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BasePrecinctPeer.php';

			$this->aPrecinct = PrecinctPeer::retrieveByPKWithI18n($this->precinct_id, $this->getCulture(), $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = PrecinctPeer::retrieveByPKWithI18n($this->precinct_id, $this->getCulture(), $con);
			   $obj->addPrecincts($this);
			 */
		}
		return $this->aPrecinct;
	}

	/**
	 * Declares an association between this object and a Genre object.
	 *
	 * @param      Genre $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setGenre($v)
	{


		if ($v === null) {
			$this->setGenreId(NULL);
		} else {
			$this->setGenreId($v->getId());
		}


		$this->aGenre = $v;
	}


	/**
	 * Get the associated Genre object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Genre The associated Genre object.
	 * @throws     PropelException
	 */
	public function getGenre($con = null)
	{
		if ($this->aGenre === null && ($this->genre_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseGenrePeer.php';

			$this->aGenre = GenrePeer::retrieveByPK($this->genre_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = GenrePeer::retrieveByPK($this->genre_id, $con);
			   $obj->addGenres($this);
			 */
		}
		return $this->aGenre;
	}


	/**
	 * Get the associated Genre object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Genre The associated Genre object.
	 * @throws     PropelException
	 */
	public function getGenreWithI18n($con = null)
	{
		if ($this->aGenre === null && ($this->genre_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseGenrePeer.php';

			$this->aGenre = GenrePeer::retrieveByPKWithI18n($this->genre_id, $this->getCulture(), $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = GenrePeer::retrieveByPKWithI18n($this->genre_id, $this->getCulture(), $con);
			   $obj->addGenres($this);
			 */
		}
		return $this->aGenre;
	}

	/**
	 * Declares an association between this object and a Broadcast object.
	 *
	 * @param      Broadcast $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setBroadcast($v)
	{


		if ($v === null) {
			$this->setBroadcastId(NULL);
		} else {
			$this->setBroadcastId($v->getId());
		}


		$this->aBroadcast = $v;
	}


	/**
	 * Get the associated Broadcast object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Broadcast The associated Broadcast object.
	 * @throws     PropelException
	 */
	public function getBroadcast($con = null)
	{
		if ($this->aBroadcast === null && ($this->broadcast_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseBroadcastPeer.php';

			$this->aBroadcast = BroadcastPeer::retrieveByPK($this->broadcast_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = BroadcastPeer::retrieveByPK($this->broadcast_id, $con);
			   $obj->addBroadcasts($this);
			 */
		}
		return $this->aBroadcast;
	}


	/**
	 * Get the associated Broadcast object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Broadcast The associated Broadcast object.
	 * @throws     PropelException
	 */
	public function getBroadcastWithI18n($con = null)
	{
		if ($this->aBroadcast === null && ($this->broadcast_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseBroadcastPeer.php';

			$this->aBroadcast = BroadcastPeer::retrieveByPKWithI18n($this->broadcast_id, $this->getCulture(), $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = BroadcastPeer::retrieveByPKWithI18n($this->broadcast_id, $this->getCulture(), $con);
			   $obj->addBroadcasts($this);
			 */
		}
		return $this->aBroadcast;
	}

	/**
	 * Temporary storage of collMmTemplateI18ns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initMmTemplateI18ns()
	{
		if ($this->collMmTemplateI18ns === null) {
			$this->collMmTemplateI18ns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this MmTemplate has previously
	 * been saved, it will retrieve related MmTemplateI18ns from storage.
	 * If this MmTemplate is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getMmTemplateI18ns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmTemplateI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmTemplateI18ns === null) {
			if ($this->isNew()) {
			   $this->collMmTemplateI18ns = array();
			} else {

				$criteria->add(MmTemplateI18nPeer::ID, $this->getId());

				MmTemplateI18nPeer::addSelectColumns($criteria);
				$this->collMmTemplateI18ns = MmTemplateI18nPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmTemplateI18nPeer::ID, $this->getId());

				MmTemplateI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastMmTemplateI18nCriteria) || !$this->lastMmTemplateI18nCriteria->equals($criteria)) {
					$this->collMmTemplateI18ns = MmTemplateI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMmTemplateI18nCriteria = $criteria;
		return $this->collMmTemplateI18ns;
	}

	/**
	 * Returns the number of related MmTemplateI18ns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countMmTemplateI18ns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmTemplateI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MmTemplateI18nPeer::ID, $this->getId());

		return MmTemplateI18nPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a MmTemplateI18n object to this object
	 * through the MmTemplateI18n foreign key attribute
	 *
	 * @param      MmTemplateI18n $l MmTemplateI18n
	 * @return     void
	 * @throws     PropelException
	 */
	public function addMmTemplateI18n(MmTemplateI18n $l)
	{
		$this->collMmTemplateI18ns[] = $l;
		$l->setMmTemplate($this);
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
	 * Otherwise if this MmTemplate has previously
	 * been saved, it will retrieve related MmTemplatePersons from storage.
	 * If this MmTemplate is new, it will return
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

				$criteria->add(MmTemplatePersonPeer::MM_TEMPLATE_ID, $this->getId());

				MmTemplatePersonPeer::addSelectColumns($criteria);
				$this->collMmTemplatePersons = MmTemplatePersonPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmTemplatePersonPeer::MM_TEMPLATE_ID, $this->getId());

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

		$criteria->add(MmTemplatePersonPeer::MM_TEMPLATE_ID, $this->getId());

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
		$l->setMmTemplate($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this MmTemplate is new, it will return
	 * an empty collection; or if this MmTemplate has previously
	 * been saved, it will retrieve related MmTemplatePersons from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in MmTemplate.
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

				$criteria->add(MmTemplatePersonPeer::MM_TEMPLATE_ID, $this->getId());

				$this->collMmTemplatePersons = MmTemplatePersonPeer::doSelectJoinPerson($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmTemplatePersonPeer::MM_TEMPLATE_ID, $this->getId());

			if (!isset($this->lastMmTemplatePersonCriteria) || !$this->lastMmTemplatePersonCriteria->equals($criteria)) {
				$this->collMmTemplatePersons = MmTemplatePersonPeer::doSelectJoinPerson($criteria, $con);
			}
		}
		$this->lastMmTemplatePersonCriteria = $criteria;

		return $this->collMmTemplatePersons;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this MmTemplate is new, it will return
	 * an empty collection; or if this MmTemplate has previously
	 * been saved, it will retrieve related MmTemplatePersons from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in MmTemplate.
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

				$criteria->add(MmTemplatePersonPeer::MM_TEMPLATE_ID, $this->getId());

				$this->collMmTemplatePersons = MmTemplatePersonPeer::doSelectJoinRole($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmTemplatePersonPeer::MM_TEMPLATE_ID, $this->getId());

			if (!isset($this->lastMmTemplatePersonCriteria) || !$this->lastMmTemplatePersonCriteria->equals($criteria)) {
				$this->collMmTemplatePersons = MmTemplatePersonPeer::doSelectJoinRole($criteria, $con);
			}
		}
		$this->lastMmTemplatePersonCriteria = $criteria;

		return $this->collMmTemplatePersons;
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
	 * Otherwise if this MmTemplate has previously
	 * been saved, it will retrieve related GroundMmTemplates from storage.
	 * If this MmTemplate is new, it will return
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

				$criteria->add(GroundMmTemplatePeer::MM_TEMPLATE_ID, $this->getId());

				GroundMmTemplatePeer::addSelectColumns($criteria);
				$this->collGroundMmTemplates = GroundMmTemplatePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(GroundMmTemplatePeer::MM_TEMPLATE_ID, $this->getId());

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

		$criteria->add(GroundMmTemplatePeer::MM_TEMPLATE_ID, $this->getId());

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
		$l->setMmTemplate($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this MmTemplate is new, it will return
	 * an empty collection; or if this MmTemplate has previously
	 * been saved, it will retrieve related GroundMmTemplates from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in MmTemplate.
	 */
	public function getGroundMmTemplatesJoinGround($criteria = null, $con = null)
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

				$criteria->add(GroundMmTemplatePeer::MM_TEMPLATE_ID, $this->getId());

				$this->collGroundMmTemplates = GroundMmTemplatePeer::doSelectJoinGround($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(GroundMmTemplatePeer::MM_TEMPLATE_ID, $this->getId());

			if (!isset($this->lastGroundMmTemplateCriteria) || !$this->lastGroundMmTemplateCriteria->equals($criteria)) {
				$this->collGroundMmTemplates = GroundMmTemplatePeer::doSelectJoinGround($criteria, $con);
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

  public function getTitle()
  {
    $obj = $this->getCurrentMmTemplateI18n();

    return ($obj ? $obj->getTitle() : null);
  }

  public function setTitle($value)
  {
    $this->getCurrentMmTemplateI18n()->setTitle($value);
  }

  public function getSubtitle()
  {
    $obj = $this->getCurrentMmTemplateI18n();

    return ($obj ? $obj->getSubtitle() : null);
  }

  public function setSubtitle($value)
  {
    $this->getCurrentMmTemplateI18n()->setSubtitle($value);
  }

  public function getKeyword()
  {
    $obj = $this->getCurrentMmTemplateI18n();

    return ($obj ? $obj->getKeyword() : null);
  }

  public function setKeyword($value)
  {
    $this->getCurrentMmTemplateI18n()->setKeyword($value);
  }

  public function getDescription()
  {
    $obj = $this->getCurrentMmTemplateI18n();

    return ($obj ? $obj->getDescription() : null);
  }

  public function setDescription($value)
  {
    $this->getCurrentMmTemplateI18n()->setDescription($value);
  }

  public function getSubserialTitle()
  {
    $obj = $this->getCurrentMmTemplateI18n();

    return ($obj ? $obj->getSubserialTitle() : null);
  }

  public function setSubserialTitle($value)
  {
    $this->getCurrentMmTemplateI18n()->setSubserialTitle($value);
  }

  public function getLine2()
  {
    $obj = $this->getCurrentMmTemplateI18n();

    return ($obj ? $obj->getLine2() : null);
  }

  public function setLine2($value)
  {
    $this->getCurrentMmTemplateI18n()->setLine2($value);
  }

  protected $current_i18n = array();

  public function getCurrentMmTemplateI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = MmTemplateI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setMmTemplateI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setMmTemplateI18nForCulture(new MmTemplateI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setMmTemplateI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addMmTemplateI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseMmTemplate:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseMmTemplate::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseMmTemplate
