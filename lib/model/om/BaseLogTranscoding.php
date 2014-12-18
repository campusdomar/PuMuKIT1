<?php

/**
 * Base class that represents a row from the 'log_transcoding' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseLogTranscoding extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        LogTranscodingPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the mm_id field.
	 * @var        int
	 */
	protected $mm_id;


	/**
	 * The value for the language_id field.
	 * @var        int
	 */
	protected $language_id;


	/**
	 * The value for the perfil_id field.
	 * @var        int
	 */
	protected $perfil_id;


	/**
	 * The value for the cpu_id field.
	 * @var        int
	 */
	protected $cpu_id;


	/**
	 * The value for the url field.
	 * @var        string
	 */
	protected $url;


	/**
	 * The value for the status_id field.
	 * @var        int
	 */
	protected $status_id;


	/**
	 * The value for the priority field.
	 * @var        int
	 */
	protected $priority;


	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;


	/**
	 * The value for the timeini field.
	 * @var        int
	 */
	protected $timeini;


	/**
	 * The value for the timestart field.
	 * @var        int
	 */
	protected $timestart;


	/**
	 * The value for the timeend field.
	 * @var        int
	 */
	protected $timeend;


	/**
	 * The value for the pid field.
	 * @var        int
	 */
	protected $pid;


	/**
	 * The value for the path_ini field.
	 * @var        string
	 */
	protected $path_ini;


	/**
	 * The value for the path_end field.
	 * @var        string
	 */
	protected $path_end;


	/**
	 * The value for the ext_ini field.
	 * @var        string
	 */
	protected $ext_ini;


	/**
	 * The value for the ext_end field.
	 * @var        string
	 */
	protected $ext_end;


	/**
	 * The value for the duration field.
	 * @var        int
	 */
	protected $duration = 0;


	/**
	 * The value for the size field.
	 * @var        int
	 */
	protected $size = 0;


	/**
	 * The value for the email field.
	 * @var        string
	 */
	protected $email;

	/**
	 * @var        Mm
	 */
	protected $aMm;

	/**
	 * @var        Language
	 */
	protected $aLanguage;

	/**
	 * @var        Perfil
	 */
	protected $aPerfil;

	/**
	 * @var        Cpu
	 */
	protected $aCpu;

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
	 * Get the [mm_id] column value.
	 * 
	 * @return     int
	 */
	public function getMmId()
	{

		return $this->mm_id;
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
	 * Get the [perfil_id] column value.
	 * 
	 * @return     int
	 */
	public function getPerfilId()
	{

		return $this->perfil_id;
	}

	/**
	 * Get the [cpu_id] column value.
	 * 
	 * @return     int
	 */
	public function getCpuId()
	{

		return $this->cpu_id;
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
	 * Get the [status_id] column value.
	 * 
	 * @return     int
	 */
	public function getStatusId()
	{

		return $this->status_id;
	}

	/**
	 * Get the [priority] column value.
	 * 
	 * @return     int
	 */
	public function getPriority()
	{

		return $this->priority;
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
	 * Get the [optionally formatted] [timeini] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getTimeini($format = 'Y-m-d H:i:s')
	{

		if ($this->timeini === null || $this->timeini === '') {
			return null;
		} elseif (!is_int($this->timeini)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->timeini);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [timeini] as date/time value: " . var_export($this->timeini, true));
			}
		} else {
			$ts = $this->timeini;
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
	 * Get the [optionally formatted] [timestart] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getTimestart($format = 'Y-m-d H:i:s')
	{

		if ($this->timestart === null || $this->timestart === '') {
			return null;
		} elseif (!is_int($this->timestart)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->timestart);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [timestart] as date/time value: " . var_export($this->timestart, true));
			}
		} else {
			$ts = $this->timestart;
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
	 * Get the [optionally formatted] [timeend] column value.
	 * 
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the integer unix timestamp will be returned.
	 * @return     mixed Formatted date/time value as string or integer unix timestamp (if format is NULL).
	 * @throws     PropelException - if unable to convert the date/time to timestamp.
	 */
	public function getTimeend($format = 'Y-m-d H:i:s')
	{

		if ($this->timeend === null || $this->timeend === '') {
			return null;
		} elseif (!is_int($this->timeend)) {
			// a non-timestamp value was set externally, so we convert it
			$ts = strtotime($this->timeend);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse value of [timeend] as date/time value: " . var_export($this->timeend, true));
			}
		} else {
			$ts = $this->timeend;
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
	 * Get the [pid] column value.
	 * 
	 * @return     int
	 */
	public function getPid()
	{

		return $this->pid;
	}

	/**
	 * Get the [path_ini] column value.
	 * 
	 * @return     string
	 */
	public function getPathIni()
	{

		return $this->path_ini;
	}

	/**
	 * Get the [path_end] column value.
	 * 
	 * @return     string
	 */
	public function getPathEnd()
	{

		return $this->path_end;
	}

	/**
	 * Get the [ext_ini] column value.
	 * 
	 * @return     string
	 */
	public function getExtIni()
	{

		return $this->ext_ini;
	}

	/**
	 * Get the [ext_end] column value.
	 * 
	 * @return     string
	 */
	public function getExtEnd()
	{

		return $this->ext_end;
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
	 * Get the [size] column value.
	 * 
	 * @return     int
	 */
	public function getSize()
	{

		return $this->size;
	}

	/**
	 * Get the [email] column value.
	 * 
	 * @return     string
	 */
	public function getEmail()
	{

		return $this->email;
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
			$this->modifiedColumns[] = LogTranscodingPeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [mm_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setMmId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->mm_id !== $v) {
			$this->mm_id = $v;
			$this->modifiedColumns[] = LogTranscodingPeer::MM_ID;
		}

		if ($this->aMm !== null && $this->aMm->getId() !== $v) {
			$this->aMm = null;
		}

	} // setMmId()

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
			$this->modifiedColumns[] = LogTranscodingPeer::LANGUAGE_ID;
		}

		if ($this->aLanguage !== null && $this->aLanguage->getId() !== $v) {
			$this->aLanguage = null;
		}

	} // setLanguageId()

	/**
	 * Set the value of [perfil_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setPerfilId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->perfil_id !== $v) {
			$this->perfil_id = $v;
			$this->modifiedColumns[] = LogTranscodingPeer::PERFIL_ID;
		}

		if ($this->aPerfil !== null && $this->aPerfil->getId() !== $v) {
			$this->aPerfil = null;
		}

	} // setPerfilId()

	/**
	 * Set the value of [cpu_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCpuId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->cpu_id !== $v) {
			$this->cpu_id = $v;
			$this->modifiedColumns[] = LogTranscodingPeer::CPU_ID;
		}

		if ($this->aCpu !== null && $this->aCpu->getId() !== $v) {
			$this->aCpu = null;
		}

	} // setCpuId()

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
			$this->modifiedColumns[] = LogTranscodingPeer::URL;
		}

	} // setUrl()

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

		if ($this->status_id !== $v) {
			$this->status_id = $v;
			$this->modifiedColumns[] = LogTranscodingPeer::STATUS_ID;
		}

	} // setStatusId()

	/**
	 * Set the value of [priority] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setPriority($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->priority !== $v) {
			$this->priority = $v;
			$this->modifiedColumns[] = LogTranscodingPeer::PRIORITY;
		}

	} // setPriority()

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
			$this->modifiedColumns[] = LogTranscodingPeer::NAME;
		}

	} // setName()

	/**
	 * Set the value of [timeini] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setTimeini($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [timeini] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->timeini !== $ts) {
			$this->timeini = $ts;
			$this->modifiedColumns[] = LogTranscodingPeer::TIMEINI;
		}

	} // setTimeini()

	/**
	 * Set the value of [timestart] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setTimestart($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [timestart] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->timestart !== $ts) {
			$this->timestart = $ts;
			$this->modifiedColumns[] = LogTranscodingPeer::TIMESTART;
		}

	} // setTimestart()

	/**
	 * Set the value of [timeend] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setTimeend($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { // in PHP 5.1 return value changes to FALSE
				throw new PropelException("Unable to parse date/time value for [timeend] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->timeend !== $ts) {
			$this->timeend = $ts;
			$this->modifiedColumns[] = LogTranscodingPeer::TIMEEND;
		}

	} // setTimeend()

	/**
	 * Set the value of [pid] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setPid($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->pid !== $v) {
			$this->pid = $v;
			$this->modifiedColumns[] = LogTranscodingPeer::PID;
		}

	} // setPid()

	/**
	 * Set the value of [path_ini] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setPathIni($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->path_ini !== $v) {
			$this->path_ini = $v;
			$this->modifiedColumns[] = LogTranscodingPeer::PATH_INI;
		}

	} // setPathIni()

	/**
	 * Set the value of [path_end] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setPathEnd($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->path_end !== $v) {
			$this->path_end = $v;
			$this->modifiedColumns[] = LogTranscodingPeer::PATH_END;
		}

	} // setPathEnd()

	/**
	 * Set the value of [ext_ini] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setExtIni($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ext_ini !== $v) {
			$this->ext_ini = $v;
			$this->modifiedColumns[] = LogTranscodingPeer::EXT_INI;
		}

	} // setExtIni()

	/**
	 * Set the value of [ext_end] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setExtEnd($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ext_end !== $v) {
			$this->ext_end = $v;
			$this->modifiedColumns[] = LogTranscodingPeer::EXT_END;
		}

	} // setExtEnd()

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
			$this->modifiedColumns[] = LogTranscodingPeer::DURATION;
		}

	} // setDuration()

	/**
	 * Set the value of [size] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setSize($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->size !== $v || $v === 0) {
			$this->size = $v;
			$this->modifiedColumns[] = LogTranscodingPeer::SIZE;
		}

	} // setSize()

	/**
	 * Set the value of [email] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setEmail($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = LogTranscodingPeer::EMAIL;
		}

	} // setEmail()

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

			$this->mm_id = $rs->getInt($startcol + 1);

			$this->language_id = $rs->getInt($startcol + 2);

			$this->perfil_id = $rs->getInt($startcol + 3);

			$this->cpu_id = $rs->getInt($startcol + 4);

			$this->url = $rs->getString($startcol + 5);

			$this->status_id = $rs->getInt($startcol + 6);

			$this->priority = $rs->getInt($startcol + 7);

			$this->name = $rs->getString($startcol + 8);

			$this->timeini = $rs->getTimestamp($startcol + 9, null);

			$this->timestart = $rs->getTimestamp($startcol + 10, null);

			$this->timeend = $rs->getTimestamp($startcol + 11, null);

			$this->pid = $rs->getInt($startcol + 12);

			$this->path_ini = $rs->getString($startcol + 13);

			$this->path_end = $rs->getString($startcol + 14);

			$this->ext_ini = $rs->getString($startcol + 15);

			$this->ext_end = $rs->getString($startcol + 16);

			$this->duration = $rs->getInt($startcol + 17);

			$this->size = $rs->getInt($startcol + 18);

			$this->email = $rs->getString($startcol + 19);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 20; // 20 = LogTranscodingPeer::NUM_COLUMNS - LogTranscodingPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating LogTranscoding object", $e);
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

    foreach (sfMixer::getCallables('BaseLogTranscoding:delete:pre') as $callable)
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
			$con = Propel::getConnection(LogTranscodingPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			LogTranscodingPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseLogTranscoding:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseLogTranscoding:save:pre') as $callable)
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
			$con = Propel::getConnection(LogTranscodingPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseLogTranscoding:save:post') as $callable)
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

			if ($this->aPerfil !== null) {
				if ($this->aPerfil->isModified() || $this->aPerfil->getCurrentPerfilI18n()->isModified()) {
					$affectedRows += $this->aPerfil->save($con);
				}
				$this->setPerfil($this->aPerfil);
			}

			if ($this->aCpu !== null) {
				if ($this->aCpu->isModified() || $this->aCpu->getCurrentCpuI18n()->isModified()) {
					$affectedRows += $this->aCpu->save($con);
				}
				$this->setCpu($this->aCpu);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = LogTranscodingPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += LogTranscodingPeer::doUpdate($this, $con);
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

			if ($this->aPerfil !== null) {
				if (!$this->aPerfil->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPerfil->getValidationFailures());
				}
			}

			if ($this->aCpu !== null) {
				if (!$this->aCpu->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCpu->getValidationFailures());
				}
			}


			if (($retval = LogTranscodingPeer::doValidate($this, $columns)) !== true) {
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
		$pos = LogTranscodingPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getMmId();
				break;
			case 2:
				return $this->getLanguageId();
				break;
			case 3:
				return $this->getPerfilId();
				break;
			case 4:
				return $this->getCpuId();
				break;
			case 5:
				return $this->getUrl();
				break;
			case 6:
				return $this->getStatusId();
				break;
			case 7:
				return $this->getPriority();
				break;
			case 8:
				return $this->getName();
				break;
			case 9:
				return $this->getTimeini();
				break;
			case 10:
				return $this->getTimestart();
				break;
			case 11:
				return $this->getTimeend();
				break;
			case 12:
				return $this->getPid();
				break;
			case 13:
				return $this->getPathIni();
				break;
			case 14:
				return $this->getPathEnd();
				break;
			case 15:
				return $this->getExtIni();
				break;
			case 16:
				return $this->getExtEnd();
				break;
			case 17:
				return $this->getDuration();
				break;
			case 18:
				return $this->getSize();
				break;
			case 19:
				return $this->getEmail();
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
		$keys = LogTranscodingPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getMmId(),
			$keys[2] => $this->getLanguageId(),
			$keys[3] => $this->getPerfilId(),
			$keys[4] => $this->getCpuId(),
			$keys[5] => $this->getUrl(),
			$keys[6] => $this->getStatusId(),
			$keys[7] => $this->getPriority(),
			$keys[8] => $this->getName(),
			$keys[9] => $this->getTimeini(),
			$keys[10] => $this->getTimestart(),
			$keys[11] => $this->getTimeend(),
			$keys[12] => $this->getPid(),
			$keys[13] => $this->getPathIni(),
			$keys[14] => $this->getPathEnd(),
			$keys[15] => $this->getExtIni(),
			$keys[16] => $this->getExtEnd(),
			$keys[17] => $this->getDuration(),
			$keys[18] => $this->getSize(),
			$keys[19] => $this->getEmail(),
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
		$pos = LogTranscodingPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setMmId($value);
				break;
			case 2:
				$this->setLanguageId($value);
				break;
			case 3:
				$this->setPerfilId($value);
				break;
			case 4:
				$this->setCpuId($value);
				break;
			case 5:
				$this->setUrl($value);
				break;
			case 6:
				$this->setStatusId($value);
				break;
			case 7:
				$this->setPriority($value);
				break;
			case 8:
				$this->setName($value);
				break;
			case 9:
				$this->setTimeini($value);
				break;
			case 10:
				$this->setTimestart($value);
				break;
			case 11:
				$this->setTimeend($value);
				break;
			case 12:
				$this->setPid($value);
				break;
			case 13:
				$this->setPathIni($value);
				break;
			case 14:
				$this->setPathEnd($value);
				break;
			case 15:
				$this->setExtIni($value);
				break;
			case 16:
				$this->setExtEnd($value);
				break;
			case 17:
				$this->setDuration($value);
				break;
			case 18:
				$this->setSize($value);
				break;
			case 19:
				$this->setEmail($value);
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
		$keys = LogTranscodingPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setMmId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setLanguageId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPerfilId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCpuId($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUrl($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setStatusId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPriority($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setName($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setTimeini($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setTimestart($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setTimeend($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setPid($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setPathIni($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setPathEnd($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setExtIni($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setExtEnd($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setDuration($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setSize($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setEmail($arr[$keys[19]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(LogTranscodingPeer::DATABASE_NAME);

		if ($this->isColumnModified(LogTranscodingPeer::ID)) $criteria->add(LogTranscodingPeer::ID, $this->id);
		if ($this->isColumnModified(LogTranscodingPeer::MM_ID)) $criteria->add(LogTranscodingPeer::MM_ID, $this->mm_id);
		if ($this->isColumnModified(LogTranscodingPeer::LANGUAGE_ID)) $criteria->add(LogTranscodingPeer::LANGUAGE_ID, $this->language_id);
		if ($this->isColumnModified(LogTranscodingPeer::PERFIL_ID)) $criteria->add(LogTranscodingPeer::PERFIL_ID, $this->perfil_id);
		if ($this->isColumnModified(LogTranscodingPeer::CPU_ID)) $criteria->add(LogTranscodingPeer::CPU_ID, $this->cpu_id);
		if ($this->isColumnModified(LogTranscodingPeer::URL)) $criteria->add(LogTranscodingPeer::URL, $this->url);
		if ($this->isColumnModified(LogTranscodingPeer::STATUS_ID)) $criteria->add(LogTranscodingPeer::STATUS_ID, $this->status_id);
		if ($this->isColumnModified(LogTranscodingPeer::PRIORITY)) $criteria->add(LogTranscodingPeer::PRIORITY, $this->priority);
		if ($this->isColumnModified(LogTranscodingPeer::NAME)) $criteria->add(LogTranscodingPeer::NAME, $this->name);
		if ($this->isColumnModified(LogTranscodingPeer::TIMEINI)) $criteria->add(LogTranscodingPeer::TIMEINI, $this->timeini);
		if ($this->isColumnModified(LogTranscodingPeer::TIMESTART)) $criteria->add(LogTranscodingPeer::TIMESTART, $this->timestart);
		if ($this->isColumnModified(LogTranscodingPeer::TIMEEND)) $criteria->add(LogTranscodingPeer::TIMEEND, $this->timeend);
		if ($this->isColumnModified(LogTranscodingPeer::PID)) $criteria->add(LogTranscodingPeer::PID, $this->pid);
		if ($this->isColumnModified(LogTranscodingPeer::PATH_INI)) $criteria->add(LogTranscodingPeer::PATH_INI, $this->path_ini);
		if ($this->isColumnModified(LogTranscodingPeer::PATH_END)) $criteria->add(LogTranscodingPeer::PATH_END, $this->path_end);
		if ($this->isColumnModified(LogTranscodingPeer::EXT_INI)) $criteria->add(LogTranscodingPeer::EXT_INI, $this->ext_ini);
		if ($this->isColumnModified(LogTranscodingPeer::EXT_END)) $criteria->add(LogTranscodingPeer::EXT_END, $this->ext_end);
		if ($this->isColumnModified(LogTranscodingPeer::DURATION)) $criteria->add(LogTranscodingPeer::DURATION, $this->duration);
		if ($this->isColumnModified(LogTranscodingPeer::SIZE)) $criteria->add(LogTranscodingPeer::SIZE, $this->size);
		if ($this->isColumnModified(LogTranscodingPeer::EMAIL)) $criteria->add(LogTranscodingPeer::EMAIL, $this->email);

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
		$criteria = new Criteria(LogTranscodingPeer::DATABASE_NAME);

		$criteria->add(LogTranscodingPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of LogTranscoding (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setMmId($this->mm_id);

		$copyObj->setLanguageId($this->language_id);

		$copyObj->setPerfilId($this->perfil_id);

		$copyObj->setCpuId($this->cpu_id);

		$copyObj->setUrl($this->url);

		$copyObj->setStatusId($this->status_id);

		$copyObj->setPriority($this->priority);

		$copyObj->setName($this->name);

		$copyObj->setTimeini($this->timeini);

		$copyObj->setTimestart($this->timestart);

		$copyObj->setTimeend($this->timeend);

		$copyObj->setPid($this->pid);

		$copyObj->setPathIni($this->path_ini);

		$copyObj->setPathEnd($this->path_end);

		$copyObj->setExtIni($this->ext_ini);

		$copyObj->setExtEnd($this->ext_end);

		$copyObj->setDuration($this->duration);

		$copyObj->setSize($this->size);

		$copyObj->setEmail($this->email);


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
	 * @return     LogTranscoding Clone of current object.
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
	 * @return     LogTranscodingPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new LogTranscodingPeer();
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
			$this->setMmId(NULL);
		} else {
			$this->setMmId($v->getId());
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
		if ($this->aMm === null && ($this->mm_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseMmPeer.php';

			$this->aMm = MmPeer::retrieveByPK($this->mm_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = MmPeer::retrieveByPK($this->mm_id, $con);
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
		if ($this->aMm === null && ($this->mm_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseMmPeer.php';

			$this->aMm = MmPeer::retrieveByPKWithI18n($this->mm_id, $this->getCulture(), $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = MmPeer::retrieveByPKWithI18n($this->mm_id, $this->getCulture(), $con);
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
	 * Declares an association between this object and a Perfil object.
	 *
	 * @param      Perfil $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setPerfil($v)
	{


		if ($v === null) {
			$this->setPerfilId(NULL);
		} else {
			$this->setPerfilId($v->getId());
		}


		$this->aPerfil = $v;
	}


	/**
	 * Get the associated Perfil object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Perfil The associated Perfil object.
	 * @throws     PropelException
	 */
	public function getPerfil($con = null)
	{
		if ($this->aPerfil === null && ($this->perfil_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BasePerfilPeer.php';

			$this->aPerfil = PerfilPeer::retrieveByPK($this->perfil_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = PerfilPeer::retrieveByPK($this->perfil_id, $con);
			   $obj->addPerfils($this);
			 */
		}
		return $this->aPerfil;
	}


	/**
	 * Get the associated Perfil object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Perfil The associated Perfil object.
	 * @throws     PropelException
	 */
	public function getPerfilWithI18n($con = null)
	{
		if ($this->aPerfil === null && ($this->perfil_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BasePerfilPeer.php';

			$this->aPerfil = PerfilPeer::retrieveByPKWithI18n($this->perfil_id, $this->getCulture(), $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = PerfilPeer::retrieveByPKWithI18n($this->perfil_id, $this->getCulture(), $con);
			   $obj->addPerfils($this);
			 */
		}
		return $this->aPerfil;
	}

	/**
	 * Declares an association between this object and a Cpu object.
	 *
	 * @param      Cpu $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setCpu($v)
	{


		if ($v === null) {
			$this->setCpuId(NULL);
		} else {
			$this->setCpuId($v->getId());
		}


		$this->aCpu = $v;
	}


	/**
	 * Get the associated Cpu object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Cpu The associated Cpu object.
	 * @throws     PropelException
	 */
	public function getCpu($con = null)
	{
		if ($this->aCpu === null && ($this->cpu_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseCpuPeer.php';

			$this->aCpu = CpuPeer::retrieveByPK($this->cpu_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = CpuPeer::retrieveByPK($this->cpu_id, $con);
			   $obj->addCpus($this);
			 */
		}
		return $this->aCpu;
	}


	/**
	 * Get the associated Cpu object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Cpu The associated Cpu object.
	 * @throws     PropelException
	 */
	public function getCpuWithI18n($con = null)
	{
		if ($this->aCpu === null && ($this->cpu_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseCpuPeer.php';

			$this->aCpu = CpuPeer::retrieveByPKWithI18n($this->cpu_id, $this->getCulture(), $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = CpuPeer::retrieveByPKWithI18n($this->cpu_id, $this->getCulture(), $con);
			   $obj->addCpus($this);
			 */
		}
		return $this->aCpu;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseLogTranscoding:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseLogTranscoding::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseLogTranscoding
