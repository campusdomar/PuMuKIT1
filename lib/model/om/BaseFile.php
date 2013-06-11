<?php

/**
 * Base class that represents a row from the 'file' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseFile extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        FilePeer
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
	 * The value for the perfil_id field.
	 * @var        int
	 */
	protected $perfil_id;


	/**
	 * The value for the language_id field.
	 * @var        int
	 */
	protected $language_id;


	/**
	 * The value for the url field.
	 * @var        string
	 */
	protected $url;


	/**
	 * The value for the file field.
	 * @var        string
	 */
	protected $file;


	/**
	 * The value for the format_id field.
	 * @var        int
	 */
	protected $format_id;


	/**
	 * The value for the codec_id field.
	 * @var        int
	 */
	protected $codec_id;


	/**
	 * The value for the mime_type_id field.
	 * @var        int
	 */
	protected $mime_type_id;


	/**
	 * The value for the resolution_id field.
	 * @var        int
	 */
	protected $resolution_id;


	/**
	 * The value for the bitrate field.
	 * @var        string
	 */
	protected $bitrate;


	/**
	 * The value for the framerate field.
	 * @var        int
	 */
	protected $framerate = 25;


	/**
	 * The value for the channels field.
	 * @var        int
	 */
	protected $channels = 1;


	/**
	 * The value for the audio field.
	 * @var        boolean
	 */
	protected $audio = false;


	/**
	 * The value for the rank field.
	 * @var        int
	 */
	protected $rank = 1;


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
	 * The value for the size field.
	 * @var        int
	 */
	protected $size = 0;


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
	 * The value for the display field.
	 * @var        boolean
	 */
	protected $display = true;


	/**
	 * The value for the download field.
	 * @var        boolean
	 */
	protected $download = false;

	/**
	 * @var        Mm
	 */
	protected $aMm;

	/**
	 * @var        Perfil
	 */
	protected $aPerfil;

	/**
	 * @var        Language
	 */
	protected $aLanguage;

	/**
	 * @var        Format
	 */
	protected $aFormat;

	/**
	 * @var        Codec
	 */
	protected $aCodec;

	/**
	 * @var        MimeType
	 */
	protected $aMimeType;

	/**
	 * @var        Resolution
	 */
	protected $aResolution;

	/**
	 * Collection to store aggregation of collFileI18ns.
	 * @var        array
	 */
	protected $collFileI18ns;

	/**
	 * The criteria used to select the current contents of collFileI18ns.
	 * @var        Criteria
	 */
	protected $lastFileI18nCriteria = null;

	/**
	 * Collection to store aggregation of collLogFiles.
	 * @var        array
	 */
	protected $collLogFiles;

	/**
	 * The criteria used to select the current contents of collLogFiles.
	 * @var        Criteria
	 */
	protected $lastLogFileCriteria = null;

	/**
	 * Collection to store aggregation of collTickets.
	 * @var        array
	 */
	protected $collTickets;

	/**
	 * The criteria used to select the current contents of collTickets.
	 * @var        Criteria
	 */
	protected $lastTicketCriteria = null;

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
	 * Get the [mm_id] column value.
	 * 
	 * @return     int
	 */
	public function getMmId()
	{

		return $this->mm_id;
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
	 * Get the [language_id] column value.
	 * 
	 * @return     int
	 */
	public function getLanguageId()
	{

		return $this->language_id;
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
	 * Get the [file] column value.
	 * 
	 * @return     string
	 */
	public function getFile()
	{

		return $this->file;
	}

	/**
	 * Get the [format_id] column value.
	 * 
	 * @return     int
	 */
	public function getFormatId()
	{

		return $this->format_id;
	}

	/**
	 * Get the [codec_id] column value.
	 * 
	 * @return     int
	 */
	public function getCodecId()
	{

		return $this->codec_id;
	}

	/**
	 * Get the [mime_type_id] column value.
	 * 
	 * @return     int
	 */
	public function getMimeTypeId()
	{

		return $this->mime_type_id;
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
	 * Get the [bitrate] column value.
	 * 
	 * @return     string
	 */
	public function getBitrate()
	{

		return $this->bitrate;
	}

	/**
	 * Get the [framerate] column value.
	 * 
	 * @return     int
	 */
	public function getFramerate()
	{

		return $this->framerate;
	}

	/**
	 * Get the [channels] column value.
	 * 
	 * @return     int
	 */
	public function getChannels()
	{

		return $this->channels;
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
	 * Get the [rank] column value.
	 * 
	 * @return     int
	 */
	public function getRank()
	{

		return $this->rank;
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
	 * Get the [size] column value.
	 * 
	 * @return     int
	 */
	public function getSize()
	{

		return $this->size;
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
	 * Get the [display] column value.
	 * 
	 * @return     boolean
	 */
	public function getDisplay()
	{

		return $this->display;
	}

	/**
	 * Get the [download] column value.
	 * 
	 * @return     boolean
	 */
	public function getDownload()
	{

		return $this->download;
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
			$this->modifiedColumns[] = FilePeer::ID;
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
			$this->modifiedColumns[] = FilePeer::MM_ID;
		}

		if ($this->aMm !== null && $this->aMm->getId() !== $v) {
			$this->aMm = null;
		}

	} // setMmId()

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
			$this->modifiedColumns[] = FilePeer::PERFIL_ID;
		}

		if ($this->aPerfil !== null && $this->aPerfil->getId() !== $v) {
			$this->aPerfil = null;
		}

	} // setPerfilId()

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
			$this->modifiedColumns[] = FilePeer::LANGUAGE_ID;
		}

		if ($this->aLanguage !== null && $this->aLanguage->getId() !== $v) {
			$this->aLanguage = null;
		}

	} // setLanguageId()

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
			$this->modifiedColumns[] = FilePeer::URL;
		}

	} // setUrl()

	/**
	 * Set the value of [file] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setFile($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->file !== $v) {
			$this->file = $v;
			$this->modifiedColumns[] = FilePeer::FILE;
		}

	} // setFile()

	/**
	 * Set the value of [format_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setFormatId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->format_id !== $v) {
			$this->format_id = $v;
			$this->modifiedColumns[] = FilePeer::FORMAT_ID;
		}

		if ($this->aFormat !== null && $this->aFormat->getId() !== $v) {
			$this->aFormat = null;
		}

	} // setFormatId()

	/**
	 * Set the value of [codec_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setCodecId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->codec_id !== $v) {
			$this->codec_id = $v;
			$this->modifiedColumns[] = FilePeer::CODEC_ID;
		}

		if ($this->aCodec !== null && $this->aCodec->getId() !== $v) {
			$this->aCodec = null;
		}

	} // setCodecId()

	/**
	 * Set the value of [mime_type_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setMimeTypeId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->mime_type_id !== $v) {
			$this->mime_type_id = $v;
			$this->modifiedColumns[] = FilePeer::MIME_TYPE_ID;
		}

		if ($this->aMimeType !== null && $this->aMimeType->getId() !== $v) {
			$this->aMimeType = null;
		}

	} // setMimeTypeId()

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
			$this->modifiedColumns[] = FilePeer::RESOLUTION_ID;
		}

		if ($this->aResolution !== null && $this->aResolution->getId() !== $v) {
			$this->aResolution = null;
		}

	} // setResolutionId()

	/**
	 * Set the value of [bitrate] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setBitrate($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->bitrate !== $v) {
			$this->bitrate = $v;
			$this->modifiedColumns[] = FilePeer::BITRATE;
		}

	} // setBitrate()

	/**
	 * Set the value of [framerate] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setFramerate($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->framerate !== $v || $v === 25) {
			$this->framerate = $v;
			$this->modifiedColumns[] = FilePeer::FRAMERATE;
		}

	} // setFramerate()

	/**
	 * Set the value of [channels] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setChannels($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->channels !== $v || $v === 1) {
			$this->channels = $v;
			$this->modifiedColumns[] = FilePeer::CHANNELS;
		}

	} // setChannels()

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
			$this->modifiedColumns[] = FilePeer::AUDIO;
		}

	} // setAudio()

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

		if ($this->rank !== $v || $v === 1) {
			$this->rank = $v;
			$this->modifiedColumns[] = FilePeer::RANK;
		}

	} // setRank()

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
			$this->modifiedColumns[] = FilePeer::DURATION;
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
			$this->modifiedColumns[] = FilePeer::NUM_VIEW;
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
			$this->modifiedColumns[] = FilePeer::PUNT_SUM;
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
			$this->modifiedColumns[] = FilePeer::PUNT_NUM;
		}

	} // setPuntNum()

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
			$this->modifiedColumns[] = FilePeer::SIZE;
		}

	} // setSize()

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
			$this->modifiedColumns[] = FilePeer::RESOLUTION_HOR;
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
			$this->modifiedColumns[] = FilePeer::RESOLUTION_VER;
		}

	} // setResolutionVer()

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
			$this->modifiedColumns[] = FilePeer::DISPLAY;
		}

	} // setDisplay()

	/**
	 * Set the value of [download] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setDownload($v)
	{

		if ($this->download !== $v || $v === false) {
			$this->download = $v;
			$this->modifiedColumns[] = FilePeer::DOWNLOAD;
		}

	} // setDownload()

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

			$this->perfil_id = $rs->getInt($startcol + 2);

			$this->language_id = $rs->getInt($startcol + 3);

			$this->url = $rs->getString($startcol + 4);

			$this->file = $rs->getString($startcol + 5);

			$this->format_id = $rs->getInt($startcol + 6);

			$this->codec_id = $rs->getInt($startcol + 7);

			$this->mime_type_id = $rs->getInt($startcol + 8);

			$this->resolution_id = $rs->getInt($startcol + 9);

			$this->bitrate = $rs->getString($startcol + 10);

			$this->framerate = $rs->getInt($startcol + 11);

			$this->channels = $rs->getInt($startcol + 12);

			$this->audio = $rs->getBoolean($startcol + 13);

			$this->rank = $rs->getInt($startcol + 14);

			$this->duration = $rs->getInt($startcol + 15);

			$this->num_view = $rs->getInt($startcol + 16);

			$this->punt_sum = $rs->getInt($startcol + 17);

			$this->punt_num = $rs->getInt($startcol + 18);

			$this->size = $rs->getInt($startcol + 19);

			$this->resolution_hor = $rs->getInt($startcol + 20);

			$this->resolution_ver = $rs->getInt($startcol + 21);

			$this->display = $rs->getBoolean($startcol + 22);

			$this->download = $rs->getBoolean($startcol + 23);

			$this->resetModified();

			$this->setNew(false);
			$this->setCulture(sfContext::getInstance()->getUser()->getCulture());

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 24; // 24 = FilePeer::NUM_COLUMNS - FilePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating File object", $e);
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

    foreach (sfMixer::getCallables('BaseFile:delete:pre') as $callable)
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
			$con = Propel::getConnection(FilePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FilePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseFile:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseFile:save:pre') as $callable)
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
			$con = Propel::getConnection(FilePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseFile:save:post') as $callable)
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

			if ($this->aPerfil !== null) {
				if ($this->aPerfil->isModified() || $this->aPerfil->getCurrentPerfilI18n()->isModified()) {
					$affectedRows += $this->aPerfil->save($con);
				}
				$this->setPerfil($this->aPerfil);
			}

			if ($this->aLanguage !== null) {
				if ($this->aLanguage->isModified() || $this->aLanguage->getCurrentLanguageI18n()->isModified()) {
					$affectedRows += $this->aLanguage->save($con);
				}
				$this->setLanguage($this->aLanguage);
			}

			if ($this->aFormat !== null) {
				if ($this->aFormat->isModified()) {
					$affectedRows += $this->aFormat->save($con);
				}
				$this->setFormat($this->aFormat);
			}

			if ($this->aCodec !== null) {
				if ($this->aCodec->isModified()) {
					$affectedRows += $this->aCodec->save($con);
				}
				$this->setCodec($this->aCodec);
			}

			if ($this->aMimeType !== null) {
				if ($this->aMimeType->isModified()) {
					$affectedRows += $this->aMimeType->save($con);
				}
				$this->setMimeType($this->aMimeType);
			}

			if ($this->aResolution !== null) {
				if ($this->aResolution->isModified()) {
					$affectedRows += $this->aResolution->save($con);
				}
				$this->setResolution($this->aResolution);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FilePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += FilePeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collFileI18ns !== null) {
				foreach($this->collFileI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collLogFiles !== null) {
				foreach($this->collLogFiles as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTickets !== null) {
				foreach($this->collTickets as $referrerFK) {
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

			if ($this->aMm !== null) {
				if (!$this->aMm->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMm->getValidationFailures());
				}
			}

			if ($this->aPerfil !== null) {
				if (!$this->aPerfil->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPerfil->getValidationFailures());
				}
			}

			if ($this->aLanguage !== null) {
				if (!$this->aLanguage->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aLanguage->getValidationFailures());
				}
			}

			if ($this->aFormat !== null) {
				if (!$this->aFormat->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFormat->getValidationFailures());
				}
			}

			if ($this->aCodec !== null) {
				if (!$this->aCodec->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCodec->getValidationFailures());
				}
			}

			if ($this->aMimeType !== null) {
				if (!$this->aMimeType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMimeType->getValidationFailures());
				}
			}

			if ($this->aResolution !== null) {
				if (!$this->aResolution->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aResolution->getValidationFailures());
				}
			}


			if (($retval = FilePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collFileI18ns !== null) {
					foreach($this->collFileI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collLogFiles !== null) {
					foreach($this->collLogFiles as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTickets !== null) {
					foreach($this->collTickets as $referrerFK) {
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
		$pos = FilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getPerfilId();
				break;
			case 3:
				return $this->getLanguageId();
				break;
			case 4:
				return $this->getUrl();
				break;
			case 5:
				return $this->getFile();
				break;
			case 6:
				return $this->getFormatId();
				break;
			case 7:
				return $this->getCodecId();
				break;
			case 8:
				return $this->getMimeTypeId();
				break;
			case 9:
				return $this->getResolutionId();
				break;
			case 10:
				return $this->getBitrate();
				break;
			case 11:
				return $this->getFramerate();
				break;
			case 12:
				return $this->getChannels();
				break;
			case 13:
				return $this->getAudio();
				break;
			case 14:
				return $this->getRank();
				break;
			case 15:
				return $this->getDuration();
				break;
			case 16:
				return $this->getNumView();
				break;
			case 17:
				return $this->getPuntSum();
				break;
			case 18:
				return $this->getPuntNum();
				break;
			case 19:
				return $this->getSize();
				break;
			case 20:
				return $this->getResolutionHor();
				break;
			case 21:
				return $this->getResolutionVer();
				break;
			case 22:
				return $this->getDisplay();
				break;
			case 23:
				return $this->getDownload();
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
		$keys = FilePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getMmId(),
			$keys[2] => $this->getPerfilId(),
			$keys[3] => $this->getLanguageId(),
			$keys[4] => $this->getUrl(),
			$keys[5] => $this->getFile(),
			$keys[6] => $this->getFormatId(),
			$keys[7] => $this->getCodecId(),
			$keys[8] => $this->getMimeTypeId(),
			$keys[9] => $this->getResolutionId(),
			$keys[10] => $this->getBitrate(),
			$keys[11] => $this->getFramerate(),
			$keys[12] => $this->getChannels(),
			$keys[13] => $this->getAudio(),
			$keys[14] => $this->getRank(),
			$keys[15] => $this->getDuration(),
			$keys[16] => $this->getNumView(),
			$keys[17] => $this->getPuntSum(),
			$keys[18] => $this->getPuntNum(),
			$keys[19] => $this->getSize(),
			$keys[20] => $this->getResolutionHor(),
			$keys[21] => $this->getResolutionVer(),
			$keys[22] => $this->getDisplay(),
			$keys[23] => $this->getDownload(),
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
		$pos = FilePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setPerfilId($value);
				break;
			case 3:
				$this->setLanguageId($value);
				break;
			case 4:
				$this->setUrl($value);
				break;
			case 5:
				$this->setFile($value);
				break;
			case 6:
				$this->setFormatId($value);
				break;
			case 7:
				$this->setCodecId($value);
				break;
			case 8:
				$this->setMimeTypeId($value);
				break;
			case 9:
				$this->setResolutionId($value);
				break;
			case 10:
				$this->setBitrate($value);
				break;
			case 11:
				$this->setFramerate($value);
				break;
			case 12:
				$this->setChannels($value);
				break;
			case 13:
				$this->setAudio($value);
				break;
			case 14:
				$this->setRank($value);
				break;
			case 15:
				$this->setDuration($value);
				break;
			case 16:
				$this->setNumView($value);
				break;
			case 17:
				$this->setPuntSum($value);
				break;
			case 18:
				$this->setPuntNum($value);
				break;
			case 19:
				$this->setSize($value);
				break;
			case 20:
				$this->setResolutionHor($value);
				break;
			case 21:
				$this->setResolutionVer($value);
				break;
			case 22:
				$this->setDisplay($value);
				break;
			case 23:
				$this->setDownload($value);
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
		$keys = FilePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setMmId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPerfilId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setLanguageId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUrl($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setFile($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setFormatId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCodecId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setMimeTypeId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setResolutionId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setBitrate($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setFramerate($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setChannels($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setAudio($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setRank($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setDuration($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setNumView($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setPuntSum($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setPuntNum($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setSize($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setResolutionHor($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setResolutionVer($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setDisplay($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setDownload($arr[$keys[23]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(FilePeer::DATABASE_NAME);

		if ($this->isColumnModified(FilePeer::ID)) $criteria->add(FilePeer::ID, $this->id);
		if ($this->isColumnModified(FilePeer::MM_ID)) $criteria->add(FilePeer::MM_ID, $this->mm_id);
		if ($this->isColumnModified(FilePeer::PERFIL_ID)) $criteria->add(FilePeer::PERFIL_ID, $this->perfil_id);
		if ($this->isColumnModified(FilePeer::LANGUAGE_ID)) $criteria->add(FilePeer::LANGUAGE_ID, $this->language_id);
		if ($this->isColumnModified(FilePeer::URL)) $criteria->add(FilePeer::URL, $this->url);
		if ($this->isColumnModified(FilePeer::FILE)) $criteria->add(FilePeer::FILE, $this->file);
		if ($this->isColumnModified(FilePeer::FORMAT_ID)) $criteria->add(FilePeer::FORMAT_ID, $this->format_id);
		if ($this->isColumnModified(FilePeer::CODEC_ID)) $criteria->add(FilePeer::CODEC_ID, $this->codec_id);
		if ($this->isColumnModified(FilePeer::MIME_TYPE_ID)) $criteria->add(FilePeer::MIME_TYPE_ID, $this->mime_type_id);
		if ($this->isColumnModified(FilePeer::RESOLUTION_ID)) $criteria->add(FilePeer::RESOLUTION_ID, $this->resolution_id);
		if ($this->isColumnModified(FilePeer::BITRATE)) $criteria->add(FilePeer::BITRATE, $this->bitrate);
		if ($this->isColumnModified(FilePeer::FRAMERATE)) $criteria->add(FilePeer::FRAMERATE, $this->framerate);
		if ($this->isColumnModified(FilePeer::CHANNELS)) $criteria->add(FilePeer::CHANNELS, $this->channels);
		if ($this->isColumnModified(FilePeer::AUDIO)) $criteria->add(FilePeer::AUDIO, $this->audio);
		if ($this->isColumnModified(FilePeer::RANK)) $criteria->add(FilePeer::RANK, $this->rank);
		if ($this->isColumnModified(FilePeer::DURATION)) $criteria->add(FilePeer::DURATION, $this->duration);
		if ($this->isColumnModified(FilePeer::NUM_VIEW)) $criteria->add(FilePeer::NUM_VIEW, $this->num_view);
		if ($this->isColumnModified(FilePeer::PUNT_SUM)) $criteria->add(FilePeer::PUNT_SUM, $this->punt_sum);
		if ($this->isColumnModified(FilePeer::PUNT_NUM)) $criteria->add(FilePeer::PUNT_NUM, $this->punt_num);
		if ($this->isColumnModified(FilePeer::SIZE)) $criteria->add(FilePeer::SIZE, $this->size);
		if ($this->isColumnModified(FilePeer::RESOLUTION_HOR)) $criteria->add(FilePeer::RESOLUTION_HOR, $this->resolution_hor);
		if ($this->isColumnModified(FilePeer::RESOLUTION_VER)) $criteria->add(FilePeer::RESOLUTION_VER, $this->resolution_ver);
		if ($this->isColumnModified(FilePeer::DISPLAY)) $criteria->add(FilePeer::DISPLAY, $this->display);
		if ($this->isColumnModified(FilePeer::DOWNLOAD)) $criteria->add(FilePeer::DOWNLOAD, $this->download);

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
		$criteria = new Criteria(FilePeer::DATABASE_NAME);

		$criteria->add(FilePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of File (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setMmId($this->mm_id);

		$copyObj->setPerfilId($this->perfil_id);

		$copyObj->setLanguageId($this->language_id);

		$copyObj->setUrl($this->url);

		$copyObj->setFile($this->file);

		$copyObj->setFormatId($this->format_id);

		$copyObj->setCodecId($this->codec_id);

		$copyObj->setMimeTypeId($this->mime_type_id);

		$copyObj->setResolutionId($this->resolution_id);

		$copyObj->setBitrate($this->bitrate);

		$copyObj->setFramerate($this->framerate);

		$copyObj->setChannels($this->channels);

		$copyObj->setAudio($this->audio);

		$copyObj->setRank($this->rank);

		$copyObj->setDuration($this->duration);

		$copyObj->setNumView($this->num_view);

		$copyObj->setPuntSum($this->punt_sum);

		$copyObj->setPuntNum($this->punt_num);

		$copyObj->setSize($this->size);

		$copyObj->setResolutionHor($this->resolution_hor);

		$copyObj->setResolutionVer($this->resolution_ver);

		$copyObj->setDisplay($this->display);

		$copyObj->setDownload($this->download);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getFileI18ns() as $relObj) {
				$copyObj->addFileI18n($relObj->copy($deepCopy));
			}

			foreach($this->getLogFiles() as $relObj) {
				$copyObj->addLogFile($relObj->copy($deepCopy));
			}

			foreach($this->getTickets() as $relObj) {
				$copyObj->addTicket($relObj->copy($deepCopy));
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
	 * @return     File Clone of current object.
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
	 * @return     FilePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new FilePeer();
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
	 * Declares an association between this object and a Format object.
	 *
	 * @param      Format $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setFormat($v)
	{


		if ($v === null) {
			$this->setFormatId(NULL);
		} else {
			$this->setFormatId($v->getId());
		}


		$this->aFormat = $v;
	}


	/**
	 * Get the associated Format object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Format The associated Format object.
	 * @throws     PropelException
	 */
	public function getFormat($con = null)
	{
		if ($this->aFormat === null && ($this->format_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseFormatPeer.php';

			$this->aFormat = FormatPeer::retrieveByPK($this->format_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = FormatPeer::retrieveByPK($this->format_id, $con);
			   $obj->addFormats($this);
			 */
		}
		return $this->aFormat;
	}

	/**
	 * Declares an association between this object and a Codec object.
	 *
	 * @param      Codec $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setCodec($v)
	{


		if ($v === null) {
			$this->setCodecId(NULL);
		} else {
			$this->setCodecId($v->getId());
		}


		$this->aCodec = $v;
	}


	/**
	 * Get the associated Codec object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Codec The associated Codec object.
	 * @throws     PropelException
	 */
	public function getCodec($con = null)
	{
		if ($this->aCodec === null && ($this->codec_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseCodecPeer.php';

			$this->aCodec = CodecPeer::retrieveByPK($this->codec_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = CodecPeer::retrieveByPK($this->codec_id, $con);
			   $obj->addCodecs($this);
			 */
		}
		return $this->aCodec;
	}

	/**
	 * Declares an association between this object and a MimeType object.
	 *
	 * @param      MimeType $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setMimeType($v)
	{


		if ($v === null) {
			$this->setMimeTypeId(NULL);
		} else {
			$this->setMimeTypeId($v->getId());
		}


		$this->aMimeType = $v;
	}


	/**
	 * Get the associated MimeType object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     MimeType The associated MimeType object.
	 * @throws     PropelException
	 */
	public function getMimeType($con = null)
	{
		if ($this->aMimeType === null && ($this->mime_type_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseMimeTypePeer.php';

			$this->aMimeType = MimeTypePeer::retrieveByPK($this->mime_type_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = MimeTypePeer::retrieveByPK($this->mime_type_id, $con);
			   $obj->addMimeTypes($this);
			 */
		}
		return $this->aMimeType;
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
	 * Temporary storage of collFileI18ns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initFileI18ns()
	{
		if ($this->collFileI18ns === null) {
			$this->collFileI18ns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this File has previously
	 * been saved, it will retrieve related FileI18ns from storage.
	 * If this File is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getFileI18ns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFileI18ns === null) {
			if ($this->isNew()) {
			   $this->collFileI18ns = array();
			} else {

				$criteria->add(FileI18nPeer::ID, $this->getId());

				FileI18nPeer::addSelectColumns($criteria);
				$this->collFileI18ns = FileI18nPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FileI18nPeer::ID, $this->getId());

				FileI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastFileI18nCriteria) || !$this->lastFileI18nCriteria->equals($criteria)) {
					$this->collFileI18ns = FileI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFileI18nCriteria = $criteria;
		return $this->collFileI18ns;
	}

	/**
	 * Returns the number of related FileI18ns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countFileI18ns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseFileI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FileI18nPeer::ID, $this->getId());

		return FileI18nPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a FileI18n object to this object
	 * through the FileI18n foreign key attribute
	 *
	 * @param      FileI18n $l FileI18n
	 * @return     void
	 * @throws     PropelException
	 */
	public function addFileI18n(FileI18n $l)
	{
		$this->collFileI18ns[] = $l;
		$l->setFile($this);
	}

	/**
	 * Temporary storage of collLogFiles to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initLogFiles()
	{
		if ($this->collLogFiles === null) {
			$this->collLogFiles = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this File has previously
	 * been saved, it will retrieve related LogFiles from storage.
	 * If this File is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getLogFiles($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseLogFilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLogFiles === null) {
			if ($this->isNew()) {
			   $this->collLogFiles = array();
			} else {

				$criteria->add(LogFilePeer::FILE_ID, $this->getId());

				LogFilePeer::addSelectColumns($criteria);
				$this->collLogFiles = LogFilePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(LogFilePeer::FILE_ID, $this->getId());

				LogFilePeer::addSelectColumns($criteria);
				if (!isset($this->lastLogFileCriteria) || !$this->lastLogFileCriteria->equals($criteria)) {
					$this->collLogFiles = LogFilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastLogFileCriteria = $criteria;
		return $this->collLogFiles;
	}

	/**
	 * Returns the number of related LogFiles.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countLogFiles($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseLogFilePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(LogFilePeer::FILE_ID, $this->getId());

		return LogFilePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a LogFile object to this object
	 * through the LogFile foreign key attribute
	 *
	 * @param      LogFile $l LogFile
	 * @return     void
	 * @throws     PropelException
	 */
	public function addLogFile(LogFile $l)
	{
		$this->collLogFiles[] = $l;
		$l->setFile($this);
	}

	/**
	 * Temporary storage of collTickets to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initTickets()
	{
		if ($this->collTickets === null) {
			$this->collTickets = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this File has previously
	 * been saved, it will retrieve related Tickets from storage.
	 * If this File is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getTickets($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseTicketPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTickets === null) {
			if ($this->isNew()) {
			   $this->collTickets = array();
			} else {

				$criteria->add(TicketPeer::FILE_ID, $this->getId());

				TicketPeer::addSelectColumns($criteria);
				$this->collTickets = TicketPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TicketPeer::FILE_ID, $this->getId());

				TicketPeer::addSelectColumns($criteria);
				if (!isset($this->lastTicketCriteria) || !$this->lastTicketCriteria->equals($criteria)) {
					$this->collTickets = TicketPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTicketCriteria = $criteria;
		return $this->collTickets;
	}

	/**
	 * Returns the number of related Tickets.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countTickets($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseTicketPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TicketPeer::FILE_ID, $this->getId());

		return TicketPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Ticket object to this object
	 * through the Ticket foreign key attribute
	 *
	 * @param      Ticket $l Ticket
	 * @return     void
	 * @throws     PropelException
	 */
	public function addTicket(Ticket $l)
	{
		$this->collTickets[] = $l;
		$l->setFile($this);
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
			if ($this->collFileI18ns) {
				foreach ((array) $this->collFileI18ns as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collLogFiles) {
				foreach ((array) $this->collLogFiles as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collTickets) {
				foreach ((array) $this->collTickets as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collFileI18ns = null;
		$this->collLogFiles = null;
		$this->collTickets = null;
		$this->aMm = null;
		$this->aPerfil = null;
		$this->aLanguage = null;
		$this->aFormat = null;
		$this->aCodec = null;
		$this->aMimeType = null;
		$this->aResolution = null;
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
    $obj = $this->getCurrentFileI18n();

    return ($obj ? $obj->getDescription() : null);
  }

  public function setDescription($value)
  {
    $this->getCurrentFileI18n()->setDescription($value);
  }

  protected $current_i18n = array();

  public function getCurrentFileI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = FileI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setFileI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setFileI18nForCulture(new FileI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setFileI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addFileI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseFile:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseFile::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseFile
