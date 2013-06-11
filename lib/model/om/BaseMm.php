<?php

/**
 * Base class that represents a row from the 'mm' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseMm extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        MmPeer
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
	 * The value for the audio field.
	 * @var        boolean
	 */
	protected $audio = false;


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
	 * Collection to store aggregation of collMmI18ns.
	 * @var        array
	 */
	protected $collMmI18ns;

	/**
	 * The criteria used to select the current contents of collMmI18ns.
	 * @var        Criteria
	 */
	protected $lastMmI18nCriteria = null;

	/**
	 * Collection to store aggregation of collFiles.
	 * @var        array
	 */
	protected $collFiles;

	/**
	 * The criteria used to select the current contents of collFiles.
	 * @var        Criteria
	 */
	protected $lastFileCriteria = null;

	/**
	 * Collection to store aggregation of collLinks.
	 * @var        array
	 */
	protected $collLinks;

	/**
	 * The criteria used to select the current contents of collLinks.
	 * @var        Criteria
	 */
	protected $lastLinkCriteria = null;

	/**
	 * Collection to store aggregation of collMmPersons.
	 * @var        array
	 */
	protected $collMmPersons;

	/**
	 * The criteria used to select the current contents of collMmPersons.
	 * @var        Criteria
	 */
	protected $lastMmPersonCriteria = null;

	/**
	 * Collection to store aggregation of collPicMms.
	 * @var        array
	 */
	protected $collPicMms;

	/**
	 * The criteria used to select the current contents of collPicMms.
	 * @var        Criteria
	 */
	protected $lastPicMmCriteria = null;

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
	 * Collection to store aggregation of collMaterials.
	 * @var        array
	 */
	protected $collMaterials;

	/**
	 * The criteria used to select the current contents of collMaterials.
	 * @var        Criteria
	 */
	protected $lastMaterialCriteria = null;

	/**
	 * Collection to store aggregation of collLogTranscodings.
	 * @var        array
	 */
	protected $collLogTranscodings;

	/**
	 * The criteria used to select the current contents of collLogTranscodings.
	 * @var        Criteria
	 */
	protected $lastLogTranscodingCriteria = null;

	/**
	 * Collection to store aggregation of collTranscodings.
	 * @var        array
	 */
	protected $collTranscodings;

	/**
	 * The criteria used to select the current contents of collTranscodings.
	 * @var        Criteria
	 */
	protected $lastTranscodingCriteria = null;

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
	 * Collection to store aggregation of collAnnounceChannelMms.
	 * @var        array
	 */
	protected $collAnnounceChannelMms;

	/**
	 * The criteria used to select the current contents of collAnnounceChannelMms.
	 * @var        Criteria
	 */
	protected $lastAnnounceChannelMmCriteria = null;

	/**
	 * Collection to store aggregation of collMmMatterhorns.
	 * @var        array
	 */
	protected $collMmMatterhorns;

	/**
	 * The criteria used to select the current contents of collMmMatterhorns.
	 * @var        Criteria
	 */
	protected $lastMmMatterhornCriteria = null;

	/**
	 * Collection to store aggregation of collCategoryMms.
	 * @var        array
	 */
	protected $collCategoryMms;

	/**
	 * The criteria used to select the current contents of collCategoryMms.
	 * @var        Criteria
	 */
	protected $lastCategoryMmCriteria = null;

	/**
	 * Collection to store aggregation of collCategoryMmTimeframes.
	 * @var        array
	 */
	protected $collCategoryMmTimeframes;

	/**
	 * The criteria used to select the current contents of collCategoryMmTimeframes.
	 * @var        Criteria
	 */
	protected $lastCategoryMmTimeframeCriteria = null;

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
	 * Get the [audio] column value.
	 * 
	 * @return     boolean
	 */
	public function getAudio()
	{

		return $this->audio;
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
			$this->modifiedColumns[] = MmPeer::ID;
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
			$this->modifiedColumns[] = MmPeer::SUBSERIAL;
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
			$this->modifiedColumns[] = MmPeer::ANNOUNCE;
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
			$this->modifiedColumns[] = MmPeer::MAIL;
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
			$this->modifiedColumns[] = MmPeer::SERIAL_ID;
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
			$this->modifiedColumns[] = MmPeer::RANK;
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
			$this->modifiedColumns[] = MmPeer::PRECINCT_ID;
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
			$this->modifiedColumns[] = MmPeer::GENRE_ID;
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
			$this->modifiedColumns[] = MmPeer::BROADCAST_ID;
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
			$this->modifiedColumns[] = MmPeer::COPYRIGHT;
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
			$this->modifiedColumns[] = MmPeer::STATUS_ID;
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
			$this->modifiedColumns[] = MmPeer::RECORDDATE;
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
			$this->modifiedColumns[] = MmPeer::PUBLICDATE;
		}

	} // setPublicdate()

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
			$this->modifiedColumns[] = MmPeer::EDITORIAL1;
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
			$this->modifiedColumns[] = MmPeer::EDITORIAL2;
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
			$this->modifiedColumns[] = MmPeer::EDITORIAL3;
		}

	} // setEditorial3()

	/**
	 * Set the value of [audio] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setAudio($v)
	{

		if ($this->audio !== $v || $v === false) {
			$this->audio = $v;
			$this->modifiedColumns[] = MmPeer::AUDIO;
		}

	} // setAudio()

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
			$this->modifiedColumns[] = MmPeer::DURATION;
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
			$this->modifiedColumns[] = MmPeer::NUM_VIEW;
		}

	} // setNumView()

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

			$this->editorial1 = $rs->getBoolean($startcol + 13);

			$this->editorial2 = $rs->getBoolean($startcol + 14);

			$this->editorial3 = $rs->getBoolean($startcol + 15);

			$this->audio = $rs->getBoolean($startcol + 16);

			$this->duration = $rs->getInt($startcol + 17);

			$this->num_view = $rs->getInt($startcol + 18);

			$this->resetModified();

			$this->setNew(false);
			$this->setCulture(sfContext::getInstance()->getUser()->getCulture());

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 19; // 19 = MmPeer::NUM_COLUMNS - MmPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Mm object", $e);
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

    foreach (sfMixer::getCallables('BaseMm:delete:pre') as $callable)
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
			$con = Propel::getConnection(MmPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			MmPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseMm:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseMm:save:pre') as $callable)
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
			$con = Propel::getConnection(MmPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseMm:save:post') as $callable)
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
					$pk = MmPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += MmPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collMmI18ns !== null) {
				foreach($this->collMmI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFiles !== null) {
				foreach($this->collFiles as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collLinks !== null) {
				foreach($this->collLinks as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMmPersons !== null) {
				foreach($this->collMmPersons as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPicMms !== null) {
				foreach($this->collPicMms as $referrerFK) {
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

			if ($this->collMaterials !== null) {
				foreach($this->collMaterials as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collLogTranscodings !== null) {
				foreach($this->collLogTranscodings as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTranscodings !== null) {
				foreach($this->collTranscodings as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPubChannelMms !== null) {
				foreach($this->collPubChannelMms as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collAnnounceChannelMms !== null) {
				foreach($this->collAnnounceChannelMms as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMmMatterhorns !== null) {
				foreach($this->collMmMatterhorns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCategoryMms !== null) {
				foreach($this->collCategoryMms as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCategoryMmTimeframes !== null) {
				foreach($this->collCategoryMmTimeframes as $referrerFK) {
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


			if (($retval = MmPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collMmI18ns !== null) {
					foreach($this->collMmI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFiles !== null) {
					foreach($this->collFiles as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collLinks !== null) {
					foreach($this->collLinks as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMmPersons !== null) {
					foreach($this->collMmPersons as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPicMms !== null) {
					foreach($this->collPicMms as $referrerFK) {
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

				if ($this->collMaterials !== null) {
					foreach($this->collMaterials as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collLogTranscodings !== null) {
					foreach($this->collLogTranscodings as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTranscodings !== null) {
					foreach($this->collTranscodings as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPubChannelMms !== null) {
					foreach($this->collPubChannelMms as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collAnnounceChannelMms !== null) {
					foreach($this->collAnnounceChannelMms as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMmMatterhorns !== null) {
					foreach($this->collMmMatterhorns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCategoryMms !== null) {
					foreach($this->collCategoryMms as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCategoryMmTimeframes !== null) {
					foreach($this->collCategoryMmTimeframes as $referrerFK) {
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
		$pos = MmPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
			case 13:
				return $this->getEditorial1();
				break;
			case 14:
				return $this->getEditorial2();
				break;
			case 15:
				return $this->getEditorial3();
				break;
			case 16:
				return $this->getAudio();
				break;
			case 17:
				return $this->getDuration();
				break;
			case 18:
				return $this->getNumView();
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
		$keys = MmPeer::getFieldNames($keyType);
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
			$keys[13] => $this->getEditorial1(),
			$keys[14] => $this->getEditorial2(),
			$keys[15] => $this->getEditorial3(),
			$keys[16] => $this->getAudio(),
			$keys[17] => $this->getDuration(),
			$keys[18] => $this->getNumView(),
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
		$pos = MmPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
			case 13:
				$this->setEditorial1($value);
				break;
			case 14:
				$this->setEditorial2($value);
				break;
			case 15:
				$this->setEditorial3($value);
				break;
			case 16:
				$this->setAudio($value);
				break;
			case 17:
				$this->setDuration($value);
				break;
			case 18:
				$this->setNumView($value);
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
		$keys = MmPeer::getFieldNames($keyType);

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
		if (array_key_exists($keys[13], $arr)) $this->setEditorial1($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setEditorial2($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setEditorial3($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setAudio($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setDuration($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setNumView($arr[$keys[18]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(MmPeer::DATABASE_NAME);

		if ($this->isColumnModified(MmPeer::ID)) $criteria->add(MmPeer::ID, $this->id);
		if ($this->isColumnModified(MmPeer::SUBSERIAL)) $criteria->add(MmPeer::SUBSERIAL, $this->subserial);
		if ($this->isColumnModified(MmPeer::ANNOUNCE)) $criteria->add(MmPeer::ANNOUNCE, $this->announce);
		if ($this->isColumnModified(MmPeer::MAIL)) $criteria->add(MmPeer::MAIL, $this->mail);
		if ($this->isColumnModified(MmPeer::SERIAL_ID)) $criteria->add(MmPeer::SERIAL_ID, $this->serial_id);
		if ($this->isColumnModified(MmPeer::RANK)) $criteria->add(MmPeer::RANK, $this->rank);
		if ($this->isColumnModified(MmPeer::PRECINCT_ID)) $criteria->add(MmPeer::PRECINCT_ID, $this->precinct_id);
		if ($this->isColumnModified(MmPeer::GENRE_ID)) $criteria->add(MmPeer::GENRE_ID, $this->genre_id);
		if ($this->isColumnModified(MmPeer::BROADCAST_ID)) $criteria->add(MmPeer::BROADCAST_ID, $this->broadcast_id);
		if ($this->isColumnModified(MmPeer::COPYRIGHT)) $criteria->add(MmPeer::COPYRIGHT, $this->copyright);
		if ($this->isColumnModified(MmPeer::STATUS_ID)) $criteria->add(MmPeer::STATUS_ID, $this->status_id);
		if ($this->isColumnModified(MmPeer::RECORDDATE)) $criteria->add(MmPeer::RECORDDATE, $this->recorddate);
		if ($this->isColumnModified(MmPeer::PUBLICDATE)) $criteria->add(MmPeer::PUBLICDATE, $this->publicdate);
		if ($this->isColumnModified(MmPeer::EDITORIAL1)) $criteria->add(MmPeer::EDITORIAL1, $this->editorial1);
		if ($this->isColumnModified(MmPeer::EDITORIAL2)) $criteria->add(MmPeer::EDITORIAL2, $this->editorial2);
		if ($this->isColumnModified(MmPeer::EDITORIAL3)) $criteria->add(MmPeer::EDITORIAL3, $this->editorial3);
		if ($this->isColumnModified(MmPeer::AUDIO)) $criteria->add(MmPeer::AUDIO, $this->audio);
		if ($this->isColumnModified(MmPeer::DURATION)) $criteria->add(MmPeer::DURATION, $this->duration);
		if ($this->isColumnModified(MmPeer::NUM_VIEW)) $criteria->add(MmPeer::NUM_VIEW, $this->num_view);

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
		$criteria = new Criteria(MmPeer::DATABASE_NAME);

		$criteria->add(MmPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Mm (or compatible) type.
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

		$copyObj->setEditorial1($this->editorial1);

		$copyObj->setEditorial2($this->editorial2);

		$copyObj->setEditorial3($this->editorial3);

		$copyObj->setAudio($this->audio);

		$copyObj->setDuration($this->duration);

		$copyObj->setNumView($this->num_view);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getMmI18ns() as $relObj) {
				$copyObj->addMmI18n($relObj->copy($deepCopy));
			}

			foreach($this->getFiles() as $relObj) {
				$copyObj->addFile($relObj->copy($deepCopy));
			}

			foreach($this->getLinks() as $relObj) {
				$copyObj->addLink($relObj->copy($deepCopy));
			}

			foreach($this->getMmPersons() as $relObj) {
				$copyObj->addMmPerson($relObj->copy($deepCopy));
			}

			foreach($this->getPicMms() as $relObj) {
				$copyObj->addPicMm($relObj->copy($deepCopy));
			}

			foreach($this->getGroundMms() as $relObj) {
				$copyObj->addGroundMm($relObj->copy($deepCopy));
			}

			foreach($this->getMaterials() as $relObj) {
				$copyObj->addMaterial($relObj->copy($deepCopy));
			}

			foreach($this->getLogTranscodings() as $relObj) {
				$copyObj->addLogTranscoding($relObj->copy($deepCopy));
			}

			foreach($this->getTranscodings() as $relObj) {
				$copyObj->addTranscoding($relObj->copy($deepCopy));
			}

			foreach($this->getPubChannelMms() as $relObj) {
				$copyObj->addPubChannelMm($relObj->copy($deepCopy));
			}

			foreach($this->getAnnounceChannelMms() as $relObj) {
				$copyObj->addAnnounceChannelMm($relObj->copy($deepCopy));
			}

			foreach($this->getMmMatterhorns() as $relObj) {
				$copyObj->addMmMatterhorn($relObj->copy($deepCopy));
			}

			foreach($this->getCategoryMms() as $relObj) {
				$copyObj->addCategoryMm($relObj->copy($deepCopy));
			}

			foreach($this->getCategoryMmTimeframes() as $relObj) {
				$copyObj->addCategoryMmTimeframe($relObj->copy($deepCopy));
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
	 * @return     Mm Clone of current object.
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
	 * @return     MmPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new MmPeer();
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
	 * Temporary storage of collMmI18ns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initMmI18ns()
	{
		if ($this->collMmI18ns === null) {
			$this->collMmI18ns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm has previously
	 * been saved, it will retrieve related MmI18ns from storage.
	 * If this Mm is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getMmI18ns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmI18ns === null) {
			if ($this->isNew()) {
			   $this->collMmI18ns = array();
			} else {

				$criteria->add(MmI18nPeer::ID, $this->getId());

				MmI18nPeer::addSelectColumns($criteria);
				$this->collMmI18ns = MmI18nPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmI18nPeer::ID, $this->getId());

				MmI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastMmI18nCriteria) || !$this->lastMmI18nCriteria->equals($criteria)) {
					$this->collMmI18ns = MmI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMmI18nCriteria = $criteria;
		return $this->collMmI18ns;
	}

	/**
	 * Returns the number of related MmI18ns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countMmI18ns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MmI18nPeer::ID, $this->getId());

		return MmI18nPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a MmI18n object to this object
	 * through the MmI18n foreign key attribute
	 *
	 * @param      MmI18n $l MmI18n
	 * @return     void
	 * @throws     PropelException
	 */
	public function addMmI18n(MmI18n $l)
	{
		$this->collMmI18ns[] = $l;
		$l->setMm($this);
	}

	/**
	 * Temporary storage of collFiles to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initFiles()
	{
		if ($this->collFiles === null) {
			$this->collFiles = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm has previously
	 * been saved, it will retrieve related Files from storage.
	 * If this Mm is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getFiles($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFiles === null) {
			if ($this->isNew()) {
			   $this->collFiles = array();
			} else {

				$criteria->add(FilePeer::MM_ID, $this->getId());

				FilePeer::addSelectColumns($criteria);
				$this->collFiles = FilePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FilePeer::MM_ID, $this->getId());

				FilePeer::addSelectColumns($criteria);
				if (!isset($this->lastFileCriteria) || !$this->lastFileCriteria->equals($criteria)) {
					$this->collFiles = FilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFileCriteria = $criteria;
		return $this->collFiles;
	}

	/**
	 * Returns the number of related Files.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countFiles($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FilePeer::MM_ID, $this->getId());

		return FilePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a File object to this object
	 * through the File foreign key attribute
	 *
	 * @param      File $l File
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFile(File $l)
	{
		$this->collFiles[] = $l;
		$l->setMm($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getFilesJoinPerfil($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFiles === null) {
			if ($this->isNew()) {
				$this->collFiles = array();
			} else {

				$criteria->add(FilePeer::MM_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectJoinPerfil($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FilePeer::MM_ID, $this->getId());

			if (!isset($this->lastFileCriteria) || !$this->lastFileCriteria->equals($criteria)) {
				$this->collFiles = FilePeer::doSelectJoinPerfil($criteria, $con);
			}
		}
		$this->lastFileCriteria = $criteria;

		return $this->collFiles;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getFilesJoinLanguage($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFiles === null) {
			if ($this->isNew()) {
				$this->collFiles = array();
			} else {

				$criteria->add(FilePeer::MM_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectJoinLanguage($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FilePeer::MM_ID, $this->getId());

			if (!isset($this->lastFileCriteria) || !$this->lastFileCriteria->equals($criteria)) {
				$this->collFiles = FilePeer::doSelectJoinLanguage($criteria, $con);
			}
		}
		$this->lastFileCriteria = $criteria;

		return $this->collFiles;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getFilesJoinFormat($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFiles === null) {
			if ($this->isNew()) {
				$this->collFiles = array();
			} else {

				$criteria->add(FilePeer::MM_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectJoinFormat($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FilePeer::MM_ID, $this->getId());

			if (!isset($this->lastFileCriteria) || !$this->lastFileCriteria->equals($criteria)) {
				$this->collFiles = FilePeer::doSelectJoinFormat($criteria, $con);
			}
		}
		$this->lastFileCriteria = $criteria;

		return $this->collFiles;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getFilesJoinCodec($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFiles === null) {
			if ($this->isNew()) {
				$this->collFiles = array();
			} else {

				$criteria->add(FilePeer::MM_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectJoinCodec($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FilePeer::MM_ID, $this->getId());

			if (!isset($this->lastFileCriteria) || !$this->lastFileCriteria->equals($criteria)) {
				$this->collFiles = FilePeer::doSelectJoinCodec($criteria, $con);
			}
		}
		$this->lastFileCriteria = $criteria;

		return $this->collFiles;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getFilesJoinMimeType($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFiles === null) {
			if ($this->isNew()) {
				$this->collFiles = array();
			} else {

				$criteria->add(FilePeer::MM_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectJoinMimeType($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FilePeer::MM_ID, $this->getId());

			if (!isset($this->lastFileCriteria) || !$this->lastFileCriteria->equals($criteria)) {
				$this->collFiles = FilePeer::doSelectJoinMimeType($criteria, $con);
			}
		}
		$this->lastFileCriteria = $criteria;

		return $this->collFiles;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getFilesJoinResolution($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFiles === null) {
			if ($this->isNew()) {
				$this->collFiles = array();
			} else {

				$criteria->add(FilePeer::MM_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectJoinResolution($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FilePeer::MM_ID, $this->getId());

			if (!isset($this->lastFileCriteria) || !$this->lastFileCriteria->equals($criteria)) {
				$this->collFiles = FilePeer::doSelectJoinResolution($criteria, $con);
			}
		}
		$this->lastFileCriteria = $criteria;

		return $this->collFiles;
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm has previously
	 * been saved, it will retrieve related Files from storage.
	 * If this Mm is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getFilesWithI18n($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFiles === null) {
			if ($this->isNew()) {
			   $this->collFiles = array();
			} else {

				$criteria->add(FilePeer::MM_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FilePeer::MM_ID, $this->getId());

				if (!isset($this->lastFileCriteria) || !$this->lastFileCriteria->equals($criteria)) {
					$this->collFiles = FilePeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
				}
			}
		}
		$this->lastFileCriteria = $criteria;
		return $this->collFiles;
	}

	/**
	 * Temporary storage of collLinks to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initLinks()
	{
		if ($this->collLinks === null) {
			$this->collLinks = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm has previously
	 * been saved, it will retrieve related Links from storage.
	 * If this Mm is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getLinks($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseLinkPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLinks === null) {
			if ($this->isNew()) {
			   $this->collLinks = array();
			} else {

				$criteria->add(LinkPeer::MM_ID, $this->getId());

				LinkPeer::addSelectColumns($criteria);
				$this->collLinks = LinkPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(LinkPeer::MM_ID, $this->getId());

				LinkPeer::addSelectColumns($criteria);
				if (!isset($this->lastLinkCriteria) || !$this->lastLinkCriteria->equals($criteria)) {
					$this->collLinks = LinkPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastLinkCriteria = $criteria;
		return $this->collLinks;
	}

	/**
	 * Returns the number of related Links.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countLinks($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseLinkPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(LinkPeer::MM_ID, $this->getId());

		return LinkPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Link object to this object
	 * through the Link foreign key attribute
	 *
	 * @param      Link $l Link
	 * @return     void
	 * @throws     PropelException
	 */
	public function addLink(Link $l)
	{
		$this->collLinks[] = $l;
		$l->setMm($this);
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm has previously
	 * been saved, it will retrieve related Links from storage.
	 * If this Mm is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getLinksWithI18n($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseLinkPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLinks === null) {
			if ($this->isNew()) {
			   $this->collLinks = array();
			} else {

				$criteria->add(LinkPeer::MM_ID, $this->getId());

				$this->collLinks = LinkPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(LinkPeer::MM_ID, $this->getId());

				if (!isset($this->lastLinkCriteria) || !$this->lastLinkCriteria->equals($criteria)) {
					$this->collLinks = LinkPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
				}
			}
		}
		$this->lastLinkCriteria = $criteria;
		return $this->collLinks;
	}

	/**
	 * Temporary storage of collMmPersons to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initMmPersons()
	{
		if ($this->collMmPersons === null) {
			$this->collMmPersons = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm has previously
	 * been saved, it will retrieve related MmPersons from storage.
	 * If this Mm is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getMmPersons($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmPersonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmPersons === null) {
			if ($this->isNew()) {
			   $this->collMmPersons = array();
			} else {

				$criteria->add(MmPersonPeer::MM_ID, $this->getId());

				MmPersonPeer::addSelectColumns($criteria);
				$this->collMmPersons = MmPersonPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmPersonPeer::MM_ID, $this->getId());

				MmPersonPeer::addSelectColumns($criteria);
				if (!isset($this->lastMmPersonCriteria) || !$this->lastMmPersonCriteria->equals($criteria)) {
					$this->collMmPersons = MmPersonPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMmPersonCriteria = $criteria;
		return $this->collMmPersons;
	}

	/**
	 * Returns the number of related MmPersons.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countMmPersons($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmPersonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MmPersonPeer::MM_ID, $this->getId());

		return MmPersonPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a MmPerson object to this object
	 * through the MmPerson foreign key attribute
	 *
	 * @param      MmPerson $l MmPerson
	 * @return     void
	 * @throws     PropelException
	 */
	public function addMmPerson(MmPerson $l)
	{
		$this->collMmPersons[] = $l;
		$l->setMm($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related MmPersons from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getMmPersonsJoinPerson($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmPersonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmPersons === null) {
			if ($this->isNew()) {
				$this->collMmPersons = array();
			} else {

				$criteria->add(MmPersonPeer::MM_ID, $this->getId());

				$this->collMmPersons = MmPersonPeer::doSelectJoinPerson($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmPersonPeer::MM_ID, $this->getId());

			if (!isset($this->lastMmPersonCriteria) || !$this->lastMmPersonCriteria->equals($criteria)) {
				$this->collMmPersons = MmPersonPeer::doSelectJoinPerson($criteria, $con);
			}
		}
		$this->lastMmPersonCriteria = $criteria;

		return $this->collMmPersons;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related MmPersons from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getMmPersonsJoinRole($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmPersonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmPersons === null) {
			if ($this->isNew()) {
				$this->collMmPersons = array();
			} else {

				$criteria->add(MmPersonPeer::MM_ID, $this->getId());

				$this->collMmPersons = MmPersonPeer::doSelectJoinRole($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmPersonPeer::MM_ID, $this->getId());

			if (!isset($this->lastMmPersonCriteria) || !$this->lastMmPersonCriteria->equals($criteria)) {
				$this->collMmPersons = MmPersonPeer::doSelectJoinRole($criteria, $con);
			}
		}
		$this->lastMmPersonCriteria = $criteria;

		return $this->collMmPersons;
	}

	/**
	 * Temporary storage of collPicMms to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPicMms()
	{
		if ($this->collPicMms === null) {
			$this->collPicMms = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm has previously
	 * been saved, it will retrieve related PicMms from storage.
	 * If this Mm is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPicMms($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePicMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPicMms === null) {
			if ($this->isNew()) {
			   $this->collPicMms = array();
			} else {

				$criteria->add(PicMmPeer::OTHER_ID, $this->getId());

				PicMmPeer::addSelectColumns($criteria);
				$this->collPicMms = PicMmPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PicMmPeer::OTHER_ID, $this->getId());

				PicMmPeer::addSelectColumns($criteria);
				if (!isset($this->lastPicMmCriteria) || !$this->lastPicMmCriteria->equals($criteria)) {
					$this->collPicMms = PicMmPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPicMmCriteria = $criteria;
		return $this->collPicMms;
	}

	/**
	 * Returns the number of related PicMms.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPicMms($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePicMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PicMmPeer::OTHER_ID, $this->getId());

		return PicMmPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a PicMm object to this object
	 * through the PicMm foreign key attribute
	 *
	 * @param      PicMm $l PicMm
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPicMm(PicMm $l)
	{
		$this->collPicMms[] = $l;
		$l->setMm($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related PicMms from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getPicMmsJoinPic($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePicMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPicMms === null) {
			if ($this->isNew()) {
				$this->collPicMms = array();
			} else {

				$criteria->add(PicMmPeer::OTHER_ID, $this->getId());

				$this->collPicMms = PicMmPeer::doSelectJoinPic($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PicMmPeer::OTHER_ID, $this->getId());

			if (!isset($this->lastPicMmCriteria) || !$this->lastPicMmCriteria->equals($criteria)) {
				$this->collPicMms = PicMmPeer::doSelectJoinPic($criteria, $con);
			}
		}
		$this->lastPicMmCriteria = $criteria;

		return $this->collPicMms;
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
	 * Otherwise if this Mm has previously
	 * been saved, it will retrieve related GroundMms from storage.
	 * If this Mm is new, it will return
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

				$criteria->add(GroundMmPeer::MM_ID, $this->getId());

				GroundMmPeer::addSelectColumns($criteria);
				$this->collGroundMms = GroundMmPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(GroundMmPeer::MM_ID, $this->getId());

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

		$criteria->add(GroundMmPeer::MM_ID, $this->getId());

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
		$l->setMm($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related GroundMms from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getGroundMmsJoinGround($criteria = null, $con = null)
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

				$criteria->add(GroundMmPeer::MM_ID, $this->getId());

				$this->collGroundMms = GroundMmPeer::doSelectJoinGround($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(GroundMmPeer::MM_ID, $this->getId());

			if (!isset($this->lastGroundMmCriteria) || !$this->lastGroundMmCriteria->equals($criteria)) {
				$this->collGroundMms = GroundMmPeer::doSelectJoinGround($criteria, $con);
			}
		}
		$this->lastGroundMmCriteria = $criteria;

		return $this->collGroundMms;
	}

	/**
	 * Temporary storage of collMaterials to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initMaterials()
	{
		if ($this->collMaterials === null) {
			$this->collMaterials = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm has previously
	 * been saved, it will retrieve related Materials from storage.
	 * If this Mm is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getMaterials($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMaterialPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMaterials === null) {
			if ($this->isNew()) {
			   $this->collMaterials = array();
			} else {

				$criteria->add(MaterialPeer::MM_ID, $this->getId());

				MaterialPeer::addSelectColumns($criteria);
				$this->collMaterials = MaterialPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MaterialPeer::MM_ID, $this->getId());

				MaterialPeer::addSelectColumns($criteria);
				if (!isset($this->lastMaterialCriteria) || !$this->lastMaterialCriteria->equals($criteria)) {
					$this->collMaterials = MaterialPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMaterialCriteria = $criteria;
		return $this->collMaterials;
	}

	/**
	 * Returns the number of related Materials.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countMaterials($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMaterialPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MaterialPeer::MM_ID, $this->getId());

		return MaterialPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Material object to this object
	 * through the Material foreign key attribute
	 *
	 * @param      Material $l Material
	 * @return     void
	 * @throws     PropelException
	 */
	public function addMaterial(Material $l)
	{
		$this->collMaterials[] = $l;
		$l->setMm($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related Materials from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getMaterialsJoinMatType($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMaterialPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMaterials === null) {
			if ($this->isNew()) {
				$this->collMaterials = array();
			} else {

				$criteria->add(MaterialPeer::MM_ID, $this->getId());

				$this->collMaterials = MaterialPeer::doSelectJoinMatType($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MaterialPeer::MM_ID, $this->getId());

			if (!isset($this->lastMaterialCriteria) || !$this->lastMaterialCriteria->equals($criteria)) {
				$this->collMaterials = MaterialPeer::doSelectJoinMatType($criteria, $con);
			}
		}
		$this->lastMaterialCriteria = $criteria;

		return $this->collMaterials;
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm has previously
	 * been saved, it will retrieve related Materials from storage.
	 * If this Mm is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getMaterialsWithI18n($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMaterialPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMaterials === null) {
			if ($this->isNew()) {
			   $this->collMaterials = array();
			} else {

				$criteria->add(MaterialPeer::MM_ID, $this->getId());

				$this->collMaterials = MaterialPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MaterialPeer::MM_ID, $this->getId());

				if (!isset($this->lastMaterialCriteria) || !$this->lastMaterialCriteria->equals($criteria)) {
					$this->collMaterials = MaterialPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
				}
			}
		}
		$this->lastMaterialCriteria = $criteria;
		return $this->collMaterials;
	}

	/**
	 * Temporary storage of collLogTranscodings to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initLogTranscodings()
	{
		if ($this->collLogTranscodings === null) {
			$this->collLogTranscodings = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm has previously
	 * been saved, it will retrieve related LogTranscodings from storage.
	 * If this Mm is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getLogTranscodings($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseLogTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLogTranscodings === null) {
			if ($this->isNew()) {
			   $this->collLogTranscodings = array();
			} else {

				$criteria->add(LogTranscodingPeer::MM_ID, $this->getId());

				LogTranscodingPeer::addSelectColumns($criteria);
				$this->collLogTranscodings = LogTranscodingPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(LogTranscodingPeer::MM_ID, $this->getId());

				LogTranscodingPeer::addSelectColumns($criteria);
				if (!isset($this->lastLogTranscodingCriteria) || !$this->lastLogTranscodingCriteria->equals($criteria)) {
					$this->collLogTranscodings = LogTranscodingPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastLogTranscodingCriteria = $criteria;
		return $this->collLogTranscodings;
	}

	/**
	 * Returns the number of related LogTranscodings.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countLogTranscodings($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseLogTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(LogTranscodingPeer::MM_ID, $this->getId());

		return LogTranscodingPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a LogTranscoding object to this object
	 * through the LogTranscoding foreign key attribute
	 *
	 * @param      LogTranscoding $l LogTranscoding
	 * @return     void
	 * @throws     PropelException
	 */
	public function addLogTranscoding(LogTranscoding $l)
	{
		$this->collLogTranscodings[] = $l;
		$l->setMm($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related LogTranscodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getLogTranscodingsJoinLanguage($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseLogTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLogTranscodings === null) {
			if ($this->isNew()) {
				$this->collLogTranscodings = array();
			} else {

				$criteria->add(LogTranscodingPeer::MM_ID, $this->getId());

				$this->collLogTranscodings = LogTranscodingPeer::doSelectJoinLanguage($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(LogTranscodingPeer::MM_ID, $this->getId());

			if (!isset($this->lastLogTranscodingCriteria) || !$this->lastLogTranscodingCriteria->equals($criteria)) {
				$this->collLogTranscodings = LogTranscodingPeer::doSelectJoinLanguage($criteria, $con);
			}
		}
		$this->lastLogTranscodingCriteria = $criteria;

		return $this->collLogTranscodings;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related LogTranscodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getLogTranscodingsJoinPerfil($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseLogTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLogTranscodings === null) {
			if ($this->isNew()) {
				$this->collLogTranscodings = array();
			} else {

				$criteria->add(LogTranscodingPeer::MM_ID, $this->getId());

				$this->collLogTranscodings = LogTranscodingPeer::doSelectJoinPerfil($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(LogTranscodingPeer::MM_ID, $this->getId());

			if (!isset($this->lastLogTranscodingCriteria) || !$this->lastLogTranscodingCriteria->equals($criteria)) {
				$this->collLogTranscodings = LogTranscodingPeer::doSelectJoinPerfil($criteria, $con);
			}
		}
		$this->lastLogTranscodingCriteria = $criteria;

		return $this->collLogTranscodings;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related LogTranscodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getLogTranscodingsJoinCpu($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseLogTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLogTranscodings === null) {
			if ($this->isNew()) {
				$this->collLogTranscodings = array();
			} else {

				$criteria->add(LogTranscodingPeer::MM_ID, $this->getId());

				$this->collLogTranscodings = LogTranscodingPeer::doSelectJoinCpu($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(LogTranscodingPeer::MM_ID, $this->getId());

			if (!isset($this->lastLogTranscodingCriteria) || !$this->lastLogTranscodingCriteria->equals($criteria)) {
				$this->collLogTranscodings = LogTranscodingPeer::doSelectJoinCpu($criteria, $con);
			}
		}
		$this->lastLogTranscodingCriteria = $criteria;

		return $this->collLogTranscodings;
	}

	/**
	 * Temporary storage of collTranscodings to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initTranscodings()
	{
		if ($this->collTranscodings === null) {
			$this->collTranscodings = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm has previously
	 * been saved, it will retrieve related Transcodings from storage.
	 * If this Mm is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getTranscodings($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTranscodings === null) {
			if ($this->isNew()) {
			   $this->collTranscodings = array();
			} else {

				$criteria->add(TranscodingPeer::MM_ID, $this->getId());

				TranscodingPeer::addSelectColumns($criteria);
				$this->collTranscodings = TranscodingPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TranscodingPeer::MM_ID, $this->getId());

				TranscodingPeer::addSelectColumns($criteria);
				if (!isset($this->lastTranscodingCriteria) || !$this->lastTranscodingCriteria->equals($criteria)) {
					$this->collTranscodings = TranscodingPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTranscodingCriteria = $criteria;
		return $this->collTranscodings;
	}

	/**
	 * Returns the number of related Transcodings.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countTranscodings($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TranscodingPeer::MM_ID, $this->getId());

		return TranscodingPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Transcoding object to this object
	 * through the Transcoding foreign key attribute
	 *
	 * @param      Transcoding $l Transcoding
	 * @return     void
	 * @throws     PropelException
	 */
	public function addTranscoding(Transcoding $l)
	{
		$this->collTranscodings[] = $l;
		$l->setMm($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related Transcodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getTranscodingsJoinLanguage($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTranscodings === null) {
			if ($this->isNew()) {
				$this->collTranscodings = array();
			} else {

				$criteria->add(TranscodingPeer::MM_ID, $this->getId());

				$this->collTranscodings = TranscodingPeer::doSelectJoinLanguage($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TranscodingPeer::MM_ID, $this->getId());

			if (!isset($this->lastTranscodingCriteria) || !$this->lastTranscodingCriteria->equals($criteria)) {
				$this->collTranscodings = TranscodingPeer::doSelectJoinLanguage($criteria, $con);
			}
		}
		$this->lastTranscodingCriteria = $criteria;

		return $this->collTranscodings;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related Transcodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getTranscodingsJoinPerfil($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTranscodings === null) {
			if ($this->isNew()) {
				$this->collTranscodings = array();
			} else {

				$criteria->add(TranscodingPeer::MM_ID, $this->getId());

				$this->collTranscodings = TranscodingPeer::doSelectJoinPerfil($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TranscodingPeer::MM_ID, $this->getId());

			if (!isset($this->lastTranscodingCriteria) || !$this->lastTranscodingCriteria->equals($criteria)) {
				$this->collTranscodings = TranscodingPeer::doSelectJoinPerfil($criteria, $con);
			}
		}
		$this->lastTranscodingCriteria = $criteria;

		return $this->collTranscodings;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related Transcodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getTranscodingsJoinCpu($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTranscodings === null) {
			if ($this->isNew()) {
				$this->collTranscodings = array();
			} else {

				$criteria->add(TranscodingPeer::MM_ID, $this->getId());

				$this->collTranscodings = TranscodingPeer::doSelectJoinCpu($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TranscodingPeer::MM_ID, $this->getId());

			if (!isset($this->lastTranscodingCriteria) || !$this->lastTranscodingCriteria->equals($criteria)) {
				$this->collTranscodings = TranscodingPeer::doSelectJoinCpu($criteria, $con);
			}
		}
		$this->lastTranscodingCriteria = $criteria;

		return $this->collTranscodings;
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm has previously
	 * been saved, it will retrieve related Transcodings from storage.
	 * If this Mm is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getTranscodingsWithI18n($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseTranscodingPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTranscodings === null) {
			if ($this->isNew()) {
			   $this->collTranscodings = array();
			} else {

				$criteria->add(TranscodingPeer::MM_ID, $this->getId());

				$this->collTranscodings = TranscodingPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TranscodingPeer::MM_ID, $this->getId());

				if (!isset($this->lastTranscodingCriteria) || !$this->lastTranscodingCriteria->equals($criteria)) {
					$this->collTranscodings = TranscodingPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
				}
			}
		}
		$this->lastTranscodingCriteria = $criteria;
		return $this->collTranscodings;
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
	 * Otherwise if this Mm has previously
	 * been saved, it will retrieve related PubChannelMms from storage.
	 * If this Mm is new, it will return
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

				$criteria->add(PubChannelMmPeer::MM_ID, $this->getId());

				PubChannelMmPeer::addSelectColumns($criteria);
				$this->collPubChannelMms = PubChannelMmPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PubChannelMmPeer::MM_ID, $this->getId());

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

		$criteria->add(PubChannelMmPeer::MM_ID, $this->getId());

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
		$l->setMm($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related PubChannelMms from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getPubChannelMmsJoinPubChannel($criteria = null, $con = null)
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

				$criteria->add(PubChannelMmPeer::MM_ID, $this->getId());

				$this->collPubChannelMms = PubChannelMmPeer::doSelectJoinPubChannel($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PubChannelMmPeer::MM_ID, $this->getId());

			if (!isset($this->lastPubChannelMmCriteria) || !$this->lastPubChannelMmCriteria->equals($criteria)) {
				$this->collPubChannelMms = PubChannelMmPeer::doSelectJoinPubChannel($criteria, $con);
			}
		}
		$this->lastPubChannelMmCriteria = $criteria;

		return $this->collPubChannelMms;
	}

	/**
	 * Temporary storage of collAnnounceChannelMms to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initAnnounceChannelMms()
	{
		if ($this->collAnnounceChannelMms === null) {
			$this->collAnnounceChannelMms = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm has previously
	 * been saved, it will retrieve related AnnounceChannelMms from storage.
	 * If this Mm is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getAnnounceChannelMms($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAnnounceChannelMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAnnounceChannelMms === null) {
			if ($this->isNew()) {
			   $this->collAnnounceChannelMms = array();
			} else {

				$criteria->add(AnnounceChannelMmPeer::MM_ID, $this->getId());

				AnnounceChannelMmPeer::addSelectColumns($criteria);
				$this->collAnnounceChannelMms = AnnounceChannelMmPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(AnnounceChannelMmPeer::MM_ID, $this->getId());

				AnnounceChannelMmPeer::addSelectColumns($criteria);
				if (!isset($this->lastAnnounceChannelMmCriteria) || !$this->lastAnnounceChannelMmCriteria->equals($criteria)) {
					$this->collAnnounceChannelMms = AnnounceChannelMmPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAnnounceChannelMmCriteria = $criteria;
		return $this->collAnnounceChannelMms;
	}

	/**
	 * Returns the number of related AnnounceChannelMms.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countAnnounceChannelMms($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAnnounceChannelMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AnnounceChannelMmPeer::MM_ID, $this->getId());

		return AnnounceChannelMmPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a AnnounceChannelMm object to this object
	 * through the AnnounceChannelMm foreign key attribute
	 *
	 * @param      AnnounceChannelMm $l AnnounceChannelMm
	 * @return     void
	 * @throws     PropelException
	 */
	public function addAnnounceChannelMm(AnnounceChannelMm $l)
	{
		$this->collAnnounceChannelMms[] = $l;
		$l->setMm($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related AnnounceChannelMms from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getAnnounceChannelMmsJoinAnnounceChannel($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseAnnounceChannelMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAnnounceChannelMms === null) {
			if ($this->isNew()) {
				$this->collAnnounceChannelMms = array();
			} else {

				$criteria->add(AnnounceChannelMmPeer::MM_ID, $this->getId());

				$this->collAnnounceChannelMms = AnnounceChannelMmPeer::doSelectJoinAnnounceChannel($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(AnnounceChannelMmPeer::MM_ID, $this->getId());

			if (!isset($this->lastAnnounceChannelMmCriteria) || !$this->lastAnnounceChannelMmCriteria->equals($criteria)) {
				$this->collAnnounceChannelMms = AnnounceChannelMmPeer::doSelectJoinAnnounceChannel($criteria, $con);
			}
		}
		$this->lastAnnounceChannelMmCriteria = $criteria;

		return $this->collAnnounceChannelMms;
	}

	/**
	 * Temporary storage of collMmMatterhorns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initMmMatterhorns()
	{
		if ($this->collMmMatterhorns === null) {
			$this->collMmMatterhorns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm has previously
	 * been saved, it will retrieve related MmMatterhorns from storage.
	 * If this Mm is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getMmMatterhorns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmMatterhornPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmMatterhorns === null) {
			if ($this->isNew()) {
			   $this->collMmMatterhorns = array();
			} else {

				$criteria->add(MmMatterhornPeer::ID, $this->getId());

				MmMatterhornPeer::addSelectColumns($criteria);
				$this->collMmMatterhorns = MmMatterhornPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmMatterhornPeer::ID, $this->getId());

				MmMatterhornPeer::addSelectColumns($criteria);
				if (!isset($this->lastMmMatterhornCriteria) || !$this->lastMmMatterhornCriteria->equals($criteria)) {
					$this->collMmMatterhorns = MmMatterhornPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMmMatterhornCriteria = $criteria;
		return $this->collMmMatterhorns;
	}

	/**
	 * Returns the number of related MmMatterhorns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countMmMatterhorns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmMatterhornPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MmMatterhornPeer::ID, $this->getId());

		return MmMatterhornPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a MmMatterhorn object to this object
	 * through the MmMatterhorn foreign key attribute
	 *
	 * @param      MmMatterhorn $l MmMatterhorn
	 * @return     void
	 * @throws     PropelException
	 */
	public function addMmMatterhorn(MmMatterhorn $l)
	{
		$this->collMmMatterhorns[] = $l;
		$l->setMm($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related MmMatterhorns from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getMmMatterhornsJoinLanguage($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmMatterhornPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmMatterhorns === null) {
			if ($this->isNew()) {
				$this->collMmMatterhorns = array();
			} else {

				$criteria->add(MmMatterhornPeer::ID, $this->getId());

				$this->collMmMatterhorns = MmMatterhornPeer::doSelectJoinLanguage($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmMatterhornPeer::ID, $this->getId());

			if (!isset($this->lastMmMatterhornCriteria) || !$this->lastMmMatterhornCriteria->equals($criteria)) {
				$this->collMmMatterhorns = MmMatterhornPeer::doSelectJoinLanguage($criteria, $con);
			}
		}
		$this->lastMmMatterhornCriteria = $criteria;

		return $this->collMmMatterhorns;
	}

	/**
	 * Temporary storage of collCategoryMms to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCategoryMms()
	{
		if ($this->collCategoryMms === null) {
			$this->collCategoryMms = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm has previously
	 * been saved, it will retrieve related CategoryMms from storage.
	 * If this Mm is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCategoryMms($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCategoryMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCategoryMms === null) {
			if ($this->isNew()) {
			   $this->collCategoryMms = array();
			} else {

				$criteria->add(CategoryMmPeer::MM_ID, $this->getId());

				CategoryMmPeer::addSelectColumns($criteria);
				$this->collCategoryMms = CategoryMmPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CategoryMmPeer::MM_ID, $this->getId());

				CategoryMmPeer::addSelectColumns($criteria);
				if (!isset($this->lastCategoryMmCriteria) || !$this->lastCategoryMmCriteria->equals($criteria)) {
					$this->collCategoryMms = CategoryMmPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCategoryMmCriteria = $criteria;
		return $this->collCategoryMms;
	}

	/**
	 * Returns the number of related CategoryMms.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCategoryMms($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCategoryMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CategoryMmPeer::MM_ID, $this->getId());

		return CategoryMmPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a CategoryMm object to this object
	 * through the CategoryMm foreign key attribute
	 *
	 * @param      CategoryMm $l CategoryMm
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCategoryMm(CategoryMm $l)
	{
		$this->collCategoryMms[] = $l;
		$l->setMm($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related CategoryMms from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getCategoryMmsJoinCategory($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCategoryMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCategoryMms === null) {
			if ($this->isNew()) {
				$this->collCategoryMms = array();
			} else {

				$criteria->add(CategoryMmPeer::MM_ID, $this->getId());

				$this->collCategoryMms = CategoryMmPeer::doSelectJoinCategory($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CategoryMmPeer::MM_ID, $this->getId());

			if (!isset($this->lastCategoryMmCriteria) || !$this->lastCategoryMmCriteria->equals($criteria)) {
				$this->collCategoryMms = CategoryMmPeer::doSelectJoinCategory($criteria, $con);
			}
		}
		$this->lastCategoryMmCriteria = $criteria;

		return $this->collCategoryMms;
	}

	/**
	 * Temporary storage of collCategoryMmTimeframes to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCategoryMmTimeframes()
	{
		if ($this->collCategoryMmTimeframes === null) {
			$this->collCategoryMmTimeframes = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm has previously
	 * been saved, it will retrieve related CategoryMmTimeframes from storage.
	 * If this Mm is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCategoryMmTimeframes($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCategoryMmTimeframePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCategoryMmTimeframes === null) {
			if ($this->isNew()) {
			   $this->collCategoryMmTimeframes = array();
			} else {

				$criteria->add(CategoryMmTimeframePeer::MM_ID, $this->getId());

				CategoryMmTimeframePeer::addSelectColumns($criteria);
				$this->collCategoryMmTimeframes = CategoryMmTimeframePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CategoryMmTimeframePeer::MM_ID, $this->getId());

				CategoryMmTimeframePeer::addSelectColumns($criteria);
				if (!isset($this->lastCategoryMmTimeframeCriteria) || !$this->lastCategoryMmTimeframeCriteria->equals($criteria)) {
					$this->collCategoryMmTimeframes = CategoryMmTimeframePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCategoryMmTimeframeCriteria = $criteria;
		return $this->collCategoryMmTimeframes;
	}

	/**
	 * Returns the number of related CategoryMmTimeframes.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCategoryMmTimeframes($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCategoryMmTimeframePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CategoryMmTimeframePeer::MM_ID, $this->getId());

		return CategoryMmTimeframePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a CategoryMmTimeframe object to this object
	 * through the CategoryMmTimeframe foreign key attribute
	 *
	 * @param      CategoryMmTimeframe $l CategoryMmTimeframe
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCategoryMmTimeframe(CategoryMmTimeframe $l)
	{
		$this->collCategoryMmTimeframes[] = $l;
		$l->setMm($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Mm is new, it will return
	 * an empty collection; or if this Mm has previously
	 * been saved, it will retrieve related CategoryMmTimeframes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Mm.
	 */
	public function getCategoryMmTimeframesJoinCategory($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCategoryMmTimeframePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCategoryMmTimeframes === null) {
			if ($this->isNew()) {
				$this->collCategoryMmTimeframes = array();
			} else {

				$criteria->add(CategoryMmTimeframePeer::MM_ID, $this->getId());

				$this->collCategoryMmTimeframes = CategoryMmTimeframePeer::doSelectJoinCategory($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CategoryMmTimeframePeer::MM_ID, $this->getId());

			if (!isset($this->lastCategoryMmTimeframeCriteria) || !$this->lastCategoryMmTimeframeCriteria->equals($criteria)) {
				$this->collCategoryMmTimeframes = CategoryMmTimeframePeer::doSelectJoinCategory($criteria, $con);
			}
		}
		$this->lastCategoryMmTimeframeCriteria = $criteria;

		return $this->collCategoryMmTimeframes;
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
			if ($this->collMmI18ns) {
				foreach ((array) $this->collMmI18ns as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collFiles) {
				foreach ((array) $this->collFiles as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collLinks) {
				foreach ((array) $this->collLinks as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collMmPersons) {
				foreach ((array) $this->collMmPersons as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPicMms) {
				foreach ((array) $this->collPicMms as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collGroundMms) {
				foreach ((array) $this->collGroundMms as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collMaterials) {
				foreach ((array) $this->collMaterials as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collLogTranscodings) {
				foreach ((array) $this->collLogTranscodings as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collTranscodings) {
				foreach ((array) $this->collTranscodings as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collPubChannelMms) {
				foreach ((array) $this->collPubChannelMms as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collAnnounceChannelMms) {
				foreach ((array) $this->collAnnounceChannelMms as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collMmMatterhorns) {
				foreach ((array) $this->collMmMatterhorns as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCategoryMms) {
				foreach ((array) $this->collCategoryMms as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCategoryMmTimeframes) {
				foreach ((array) $this->collCategoryMmTimeframes as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collMmI18ns = null;
		$this->collFiles = null;
		$this->collLinks = null;
		$this->collMmPersons = null;
		$this->collPicMms = null;
		$this->collGroundMms = null;
		$this->collMaterials = null;
		$this->collLogTranscodings = null;
		$this->collTranscodings = null;
		$this->collPubChannelMms = null;
		$this->collAnnounceChannelMms = null;
		$this->collMmMatterhorns = null;
		$this->collCategoryMms = null;
		$this->collCategoryMmTimeframes = null;
		$this->aSerial = null;
		$this->aPrecinct = null;
		$this->aGenre = null;
		$this->aBroadcast = null;
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
    $obj = $this->getCurrentMmI18n();

    return ($obj ? $obj->getTitle() : null);
  }

  public function setTitle($value)
  {
    $this->getCurrentMmI18n()->setTitle($value);
  }

  public function getSubtitle()
  {
    $obj = $this->getCurrentMmI18n();

    return ($obj ? $obj->getSubtitle() : null);
  }

  public function setSubtitle($value)
  {
    $this->getCurrentMmI18n()->setSubtitle($value);
  }

  public function getKeyword()
  {
    $obj = $this->getCurrentMmI18n();

    return ($obj ? $obj->getKeyword() : null);
  }

  public function setKeyword($value)
  {
    $this->getCurrentMmI18n()->setKeyword($value);
  }

  public function getDescription()
  {
    $obj = $this->getCurrentMmI18n();

    return ($obj ? $obj->getDescription() : null);
  }

  public function setDescription($value)
  {
    $this->getCurrentMmI18n()->setDescription($value);
  }

  public function getSubserialTitle()
  {
    $obj = $this->getCurrentMmI18n();

    return ($obj ? $obj->getSubserialTitle() : null);
  }

  public function setSubserialTitle($value)
  {
    $this->getCurrentMmI18n()->setSubserialTitle($value);
  }

  public function getLine2()
  {
    $obj = $this->getCurrentMmI18n();

    return ($obj ? $obj->getLine2() : null);
  }

  public function setLine2($value)
  {
    $this->getCurrentMmI18n()->setLine2($value);
  }

  protected $current_i18n = array();

  public function getCurrentMmI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = MmI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setMmI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setMmI18nForCulture(new MmI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setMmI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addMmI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseMm:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseMm::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseMm
