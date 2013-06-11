<?php

/**
 * Base class that represents a row from the 'direct' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseDirect extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        DirectPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the resolution_id field.
	 * @var        int
	 */
	protected $resolution_id;


	/**
	 * The value for the url field.
	 * @var        string
	 */
	protected $url;


	/**
	 * The value for the passwd field.
	 * @var        string
	 */
	protected $passwd;


	/**
	 * The value for the direct_type_id field.
	 * @var        int
	 */
	protected $direct_type_id;


	/**
	 * The value for the resolution_hor field.
	 * @var        int
	 */
	protected $resolution_hor = 0;


	/**
	 * The value for the resolution_ver field.
	 * @var        int
	 */
	protected $resolution_ver = 0;


	/**
	 * The value for the calidades field.
	 * @var        string
	 */
	protected $calidades;


	/**
	 * The value for the ip_source field.
	 * @var        string
	 */
	protected $ip_source;


	/**
	 * The value for the source_name field.
	 * @var        string
	 */
	protected $source_name;


	/**
	 * The value for the index_play field.
	 * @var        boolean
	 */
	protected $index_play = false;


	/**
	 * The value for the broadcasting field.
	 * @var        boolean
	 */
	protected $broadcasting = false;


	/**
	 * The value for the debug field.
	 * @var        boolean
	 */
	protected $debug = false;

	/**
	 * @var        Resolution
	 */
	protected $aResolution;

	/**
	 * @var        DirectType
	 */
	protected $aDirectType;

	/**
	 * Collection to store aggregation of collDirectI18ns.
	 * @var        array
	 */
	protected $collDirectI18ns;

	/**
	 * The criteria used to select the current contents of collDirectI18ns.
	 * @var        Criteria
	 */
	protected $lastDirectI18nCriteria = null;

	/**
	 * Collection to store aggregation of collEvents.
	 * @var        array
	 */
	protected $collEvents;

	/**
	 * The criteria used to select the current contents of collEvents.
	 * @var        Criteria
	 */
	protected $lastEventCriteria = null;

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
	 * Get the [resolution_id] column value.
	 * 
	 * @return     int
	 */
	public function getResolutionId()
	{

		return $this->resolution_id;
	}

	/**
	 * Get the [url] column value.
	 * 
	 * @return     string
	 */
	public function getUrl()
	{

		return $this->url;
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
	 * Get the [direct_type_id] column value.
	 * 
	 * @return     int
	 */
	public function getDirectTypeId()
	{

		return $this->direct_type_id;
	}

	/**
	 * Get the [resolution_hor] column value.
	 * 
	 * @return     int
	 */
	public function getResolutionHor()
	{

		return $this->resolution_hor;
	}

	/**
	 * Get the [resolution_ver] column value.
	 * 
	 * @return     int
	 */
	public function getResolutionVer()
	{

		return $this->resolution_ver;
	}

	/**
	 * Get the [calidades] column value.
	 * 
	 * @return     string
	 */
	public function getCalidades()
	{

		return $this->calidades;
	}

	/**
	 * Get the [ip_source] column value.
	 * 
	 * @return     string
	 */
	public function getIpSource()
	{

		return $this->ip_source;
	}

	/**
	 * Get the [source_name] column value.
	 * 
	 * @return     string
	 */
	public function getSourceName()
	{

		return $this->source_name;
	}

	/**
	 * Get the [index_play] column value.
	 * 
	 * @return     boolean
	 */
	public function getIndexPlay()
	{

		return $this->index_play;
	}

	/**
	 * Get the [broadcasting] column value.
	 * 
	 * @return     boolean
	 */
	public function getBroadcasting()
	{

		return $this->broadcasting;
	}

	/**
	 * Get the [debug] column value.
	 * 
	 * @return     boolean
	 */
	public function getDebug()
	{

		return $this->debug;
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
			$this->modifiedColumns[] = DirectPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [resolution_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setResolutionId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->resolution_id !== $v) {
			$this->resolution_id = $v;
			$this->modifiedColumns[] = DirectPeer::RESOLUTION_ID;
		}

		if ($this->aResolution !== null && $this->aResolution->getId() !== $v) {
			$this->aResolution = null;
		}

	} // setResolutionId()

	/**
	 * Set the value of [url] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setUrl($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->url !== $v) {
			$this->url = $v;
			$this->modifiedColumns[] = DirectPeer::URL;
		}

	} // setUrl()

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
			$this->modifiedColumns[] = DirectPeer::PASSWD;
		}

	} // setPasswd()

	/**
	 * Set the value of [direct_type_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setDirectTypeId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->direct_type_id !== $v) {
			$this->direct_type_id = $v;
			$this->modifiedColumns[] = DirectPeer::DIRECT_TYPE_ID;
		}

		if ($this->aDirectType !== null && $this->aDirectType->getId() !== $v) {
			$this->aDirectType = null;
		}

	} // setDirectTypeId()

	/**
	 * Set the value of [resolution_hor] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setResolutionHor($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->resolution_hor !== $v || $v === 0) {
			$this->resolution_hor = $v;
			$this->modifiedColumns[] = DirectPeer::RESOLUTION_HOR;
		}

	} // setResolutionHor()

	/**
	 * Set the value of [resolution_ver] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setResolutionVer($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->resolution_ver !== $v || $v === 0) {
			$this->resolution_ver = $v;
			$this->modifiedColumns[] = DirectPeer::RESOLUTION_VER;
		}

	} // setResolutionVer()

	/**
	 * Set the value of [calidades] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCalidades($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->calidades !== $v) {
			$this->calidades = $v;
			$this->modifiedColumns[] = DirectPeer::CALIDADES;
		}

	} // setCalidades()

	/**
	 * Set the value of [ip_source] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setIpSource($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ip_source !== $v) {
			$this->ip_source = $v;
			$this->modifiedColumns[] = DirectPeer::IP_SOURCE;
		}

	} // setIpSource()

	/**
	 * Set the value of [source_name] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setSourceName($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->source_name !== $v) {
			$this->source_name = $v;
			$this->modifiedColumns[] = DirectPeer::SOURCE_NAME;
		}

	} // setSourceName()

	/**
	 * Set the value of [index_play] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setIndexPlay($v)
	{

		if ($this->index_play !== $v || $v === false) {
			$this->index_play = $v;
			$this->modifiedColumns[] = DirectPeer::INDEX_PLAY;
		}

	} // setIndexPlay()

	/**
	 * Set the value of [broadcasting] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setBroadcasting($v)
	{

		if ($this->broadcasting !== $v || $v === false) {
			$this->broadcasting = $v;
			$this->modifiedColumns[] = DirectPeer::BROADCASTING;
		}

	} // setBroadcasting()

	/**
	 * Set the value of [debug] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setDebug($v)
	{

		if ($this->debug !== $v || $v === false) {
			$this->debug = $v;
			$this->modifiedColumns[] = DirectPeer::DEBUG;
		}

	} // setDebug()

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

			$this->resolution_id = $rs->getInt($startcol + 1);

			$this->url = $rs->getString($startcol + 2);

			$this->passwd = $rs->getString($startcol + 3);

			$this->direct_type_id = $rs->getInt($startcol + 4);

			$this->resolution_hor = $rs->getInt($startcol + 5);

			$this->resolution_ver = $rs->getInt($startcol + 6);

			$this->calidades = $rs->getString($startcol + 7);

			$this->ip_source = $rs->getString($startcol + 8);

			$this->source_name = $rs->getString($startcol + 9);

			$this->index_play = $rs->getBoolean($startcol + 10);

			$this->broadcasting = $rs->getBoolean($startcol + 11);

			$this->debug = $rs->getBoolean($startcol + 12);

			$this->resetModified();

			$this->setNew(false);
			$this->setCulture(sfContext::getInstance()->getUser()->getCulture());

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 13; // 13 = DirectPeer::NUM_COLUMNS - DirectPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Direct object", $e);
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

    foreach (sfMixer::getCallables('BaseDirect:delete:pre') as $callable)
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
			$con = Propel::getConnection(DirectPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DirectPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseDirect:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseDirect:save:pre') as $callable)
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
			$con = Propel::getConnection(DirectPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseDirect:save:post') as $callable)
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

			if ($this->aResolution !== null) {
				if ($this->aResolution->isModified()) {
					$affectedRows += $this->aResolution->save($con);
				}
				$this->setResolution($this->aResolution);
			}

			if ($this->aDirectType !== null) {
				if ($this->aDirectType->isModified()) {
					$affectedRows += $this->aDirectType->save($con);
				}
				$this->setDirectType($this->aDirectType);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DirectPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += DirectPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collDirectI18ns !== null) {
				foreach($this->collDirectI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collEvents !== null) {
				foreach($this->collEvents as $referrerFK) {
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

			if ($this->aResolution !== null) {
				if (!$this->aResolution->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aResolution->getValidationFailures());
				}
			}

			if ($this->aDirectType !== null) {
				if (!$this->aDirectType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDirectType->getValidationFailures());
				}
			}


			if (($retval = DirectPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDirectI18ns !== null) {
					foreach($this->collDirectI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collEvents !== null) {
					foreach($this->collEvents as $referrerFK) {
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
		$pos = DirectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getResolutionId();
				break;
			case 2:
				return $this->getUrl();
				break;
			case 3:
				return $this->getPasswd();
				break;
			case 4:
				return $this->getDirectTypeId();
				break;
			case 5:
				return $this->getResolutionHor();
				break;
			case 6:
				return $this->getResolutionVer();
				break;
			case 7:
				return $this->getCalidades();
				break;
			case 8:
				return $this->getIpSource();
				break;
			case 9:
				return $this->getSourceName();
				break;
			case 10:
				return $this->getIndexPlay();
				break;
			case 11:
				return $this->getBroadcasting();
				break;
			case 12:
				return $this->getDebug();
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
		$keys = DirectPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getResolutionId(),
			$keys[2] => $this->getUrl(),
			$keys[3] => $this->getPasswd(),
			$keys[4] => $this->getDirectTypeId(),
			$keys[5] => $this->getResolutionHor(),
			$keys[6] => $this->getResolutionVer(),
			$keys[7] => $this->getCalidades(),
			$keys[8] => $this->getIpSource(),
			$keys[9] => $this->getSourceName(),
			$keys[10] => $this->getIndexPlay(),
			$keys[11] => $this->getBroadcasting(),
			$keys[12] => $this->getDebug(),
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
		$pos = DirectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setResolutionId($value);
				break;
			case 2:
				$this->setUrl($value);
				break;
			case 3:
				$this->setPasswd($value);
				break;
			case 4:
				$this->setDirectTypeId($value);
				break;
			case 5:
				$this->setResolutionHor($value);
				break;
			case 6:
				$this->setResolutionVer($value);
				break;
			case 7:
				$this->setCalidades($value);
				break;
			case 8:
				$this->setIpSource($value);
				break;
			case 9:
				$this->setSourceName($value);
				break;
			case 10:
				$this->setIndexPlay($value);
				break;
			case 11:
				$this->setBroadcasting($value);
				break;
			case 12:
				$this->setDebug($value);
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
		$keys = DirectPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setResolutionId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUrl($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPasswd($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDirectTypeId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setResolutionHor($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setResolutionVer($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCalidades($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIpSource($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setSourceName($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setIndexPlay($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setBroadcasting($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setDebug($arr[$keys[12]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(DirectPeer::DATABASE_NAME);

		if ($this->isColumnModified(DirectPeer::ID)) $criteria->add(DirectPeer::ID, $this->id);
		if ($this->isColumnModified(DirectPeer::RESOLUTION_ID)) $criteria->add(DirectPeer::RESOLUTION_ID, $this->resolution_id);
		if ($this->isColumnModified(DirectPeer::URL)) $criteria->add(DirectPeer::URL, $this->url);
		if ($this->isColumnModified(DirectPeer::PASSWD)) $criteria->add(DirectPeer::PASSWD, $this->passwd);
		if ($this->isColumnModified(DirectPeer::DIRECT_TYPE_ID)) $criteria->add(DirectPeer::DIRECT_TYPE_ID, $this->direct_type_id);
		if ($this->isColumnModified(DirectPeer::RESOLUTION_HOR)) $criteria->add(DirectPeer::RESOLUTION_HOR, $this->resolution_hor);
		if ($this->isColumnModified(DirectPeer::RESOLUTION_VER)) $criteria->add(DirectPeer::RESOLUTION_VER, $this->resolution_ver);
		if ($this->isColumnModified(DirectPeer::CALIDADES)) $criteria->add(DirectPeer::CALIDADES, $this->calidades);
		if ($this->isColumnModified(DirectPeer::IP_SOURCE)) $criteria->add(DirectPeer::IP_SOURCE, $this->ip_source);
		if ($this->isColumnModified(DirectPeer::SOURCE_NAME)) $criteria->add(DirectPeer::SOURCE_NAME, $this->source_name);
		if ($this->isColumnModified(DirectPeer::INDEX_PLAY)) $criteria->add(DirectPeer::INDEX_PLAY, $this->index_play);
		if ($this->isColumnModified(DirectPeer::BROADCASTING)) $criteria->add(DirectPeer::BROADCASTING, $this->broadcasting);
		if ($this->isColumnModified(DirectPeer::DEBUG)) $criteria->add(DirectPeer::DEBUG, $this->debug);

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
		$criteria = new Criteria(DirectPeer::DATABASE_NAME);

		$criteria->add(DirectPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Direct (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setResolutionId($this->resolution_id);

		$copyObj->setUrl($this->url);

		$copyObj->setPasswd($this->passwd);

		$copyObj->setDirectTypeId($this->direct_type_id);

		$copyObj->setResolutionHor($this->resolution_hor);

		$copyObj->setResolutionVer($this->resolution_ver);

		$copyObj->setCalidades($this->calidades);

		$copyObj->setIpSource($this->ip_source);

		$copyObj->setSourceName($this->source_name);

		$copyObj->setIndexPlay($this->index_play);

		$copyObj->setBroadcasting($this->broadcasting);

		$copyObj->setDebug($this->debug);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getDirectI18ns() as $relObj) {
				$copyObj->addDirectI18n($relObj->copy($deepCopy));
			}

			foreach($this->getEvents() as $relObj) {
				$copyObj->addEvent($relObj->copy($deepCopy));
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
	 * @return     Direct Clone of current object.
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
	 * @return     DirectPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new DirectPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Resolution object.
	 *
	 * @param      Resolution $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setResolution($v)
	{


		if ($v === null) {
			$this->setResolutionId(NULL);
		} else {
			$this->setResolutionId($v->getId());
		}


		$this->aResolution = $v;
	}


	/**
	 * Get the associated Resolution object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Resolution The associated Resolution object.
	 * @throws     PropelException
	 */
	public function getResolution($con = null)
	{
		if ($this->aResolution === null && ($this->resolution_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseResolutionPeer.php';

			$this->aResolution = ResolutionPeer::retrieveByPK($this->resolution_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = ResolutionPeer::retrieveByPK($this->resolution_id, $con);
			   $obj->addResolutions($this);
			 */
		}
		return $this->aResolution;
	}

	/**
	 * Declares an association between this object and a DirectType object.
	 *
	 * @param      DirectType $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setDirectType($v)
	{


		if ($v === null) {
			$this->setDirectTypeId(NULL);
		} else {
			$this->setDirectTypeId($v->getId());
		}


		$this->aDirectType = $v;
	}


	/**
	 * Get the associated DirectType object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     DirectType The associated DirectType object.
	 * @throws     PropelException
	 */
	public function getDirectType($con = null)
	{
		if ($this->aDirectType === null && ($this->direct_type_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseDirectTypePeer.php';

			$this->aDirectType = DirectTypePeer::retrieveByPK($this->direct_type_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = DirectTypePeer::retrieveByPK($this->direct_type_id, $con);
			   $obj->addDirectTypes($this);
			 */
		}
		return $this->aDirectType;
	}

	/**
	 * Temporary storage of collDirectI18ns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initDirectI18ns()
	{
		if ($this->collDirectI18ns === null) {
			$this->collDirectI18ns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Direct has previously
	 * been saved, it will retrieve related DirectI18ns from storage.
	 * If this Direct is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getDirectI18ns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDirectI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDirectI18ns === null) {
			if ($this->isNew()) {
			   $this->collDirectI18ns = array();
			} else {

				$criteria->add(DirectI18nPeer::ID, $this->getId());

				DirectI18nPeer::addSelectColumns($criteria);
				$this->collDirectI18ns = DirectI18nPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(DirectI18nPeer::ID, $this->getId());

				DirectI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastDirectI18nCriteria) || !$this->lastDirectI18nCriteria->equals($criteria)) {
					$this->collDirectI18ns = DirectI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDirectI18nCriteria = $criteria;
		return $this->collDirectI18ns;
	}

	/**
	 * Returns the number of related DirectI18ns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countDirectI18ns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseDirectI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DirectI18nPeer::ID, $this->getId());

		return DirectI18nPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a DirectI18n object to this object
	 * through the DirectI18n foreign key attribute
	 *
	 * @param      DirectI18n $l DirectI18n
	 * @return     void
	 * @throws     PropelException
	 */
	public function addDirectI18n(DirectI18n $l)
	{
		$this->collDirectI18ns[] = $l;
		$l->setDirect($this);
	}

	/**
	 * Temporary storage of collEvents to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initEvents()
	{
		if ($this->collEvents === null) {
			$this->collEvents = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Direct has previously
	 * been saved, it will retrieve related Events from storage.
	 * If this Direct is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getEvents($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collEvents === null) {
			if ($this->isNew()) {
			   $this->collEvents = array();
			} else {

				$criteria->add(EventPeer::DIRECT_ID, $this->getId());

				EventPeer::addSelectColumns($criteria);
				$this->collEvents = EventPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(EventPeer::DIRECT_ID, $this->getId());

				EventPeer::addSelectColumns($criteria);
				if (!isset($this->lastEventCriteria) || !$this->lastEventCriteria->equals($criteria)) {
					$this->collEvents = EventPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastEventCriteria = $criteria;
		return $this->collEvents;
	}

	/**
	 * Returns the number of related Events.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countEvents($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseEventPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(EventPeer::DIRECT_ID, $this->getId());

		return EventPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Event object to this object
	 * through the Event foreign key attribute
	 *
	 * @param      Event $l Event
	 * @return     void
	 * @throws     PropelException
	 */
	public function addEvent(Event $l)
	{
		$this->collEvents[] = $l;
		$l->setDirect($this);
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
			if ($this->collDirectI18ns) {
				foreach ((array) $this->collDirectI18ns as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collEvents) {
				foreach ((array) $this->collEvents as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collDirectI18ns = null;
		$this->collEvents = null;
		$this->aResolution = null;
		$this->aDirectType = null;
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
    $obj = $this->getCurrentDirectI18n();

    return ($obj ? $obj->getName() : null);
  }

  public function setName($value)
  {
    $this->getCurrentDirectI18n()->setName($value);
  }

  public function getDescription()
  {
    $obj = $this->getCurrentDirectI18n();

    return ($obj ? $obj->getDescription() : null);
  }

  public function setDescription($value)
  {
    $this->getCurrentDirectI18n()->setDescription($value);
  }

  protected $current_i18n = array();

  public function getCurrentDirectI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = DirectI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setDirectI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setDirectI18nForCulture(new DirectI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setDirectI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addDirectI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseDirect:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseDirect::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseDirect
