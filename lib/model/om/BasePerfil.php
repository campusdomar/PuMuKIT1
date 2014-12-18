<?php

/**
 * Base class that represents a row from the 'perfil' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BasePerfil extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PerfilPeer
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
	 * The value for the rank field.
	 * @var        int
	 */
	protected $rank = 1;


	/**
	 * The value for the display field.
	 * @var        boolean
	 */
	protected $display = true;


	/**
	 * The value for the wizard field.
	 * @var        boolean
	 */
	protected $wizard = true;


	/**
	 * The value for the format field.
	 * @var        string
	 */
	protected $format;


	/**
	 * The value for the codec field.
	 * @var        string
	 */
	protected $codec;


	/**
	 * The value for the mime_type field.
	 * @var        string
	 */
	protected $mime_type;


	/**
	 * The value for the extension field.
	 * @var        string
	 */
	protected $extension;


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
	 * The value for the bat field.
	 * @var        string
	 */
	protected $bat;


	/**
	 * The value for the file_cfg field.
	 * @var        string
	 */
	protected $file_cfg;


	/**
	 * The value for the streamserver_id field.
	 * @var        int
	 */
	protected $streamserver_id;


	/**
	 * The value for the app field.
	 * @var        string
	 */
	protected $app;


	/**
	 * The value for the rel_duration_size field.
	 * @var        double
	 */
	protected $rel_duration_size = 1;


	/**
	 * The value for the rel_duration_trans field.
	 * @var        double
	 */
	protected $rel_duration_trans = 1;


	/**
	 * The value for the prescript field.
	 * @var        string
	 */
	protected $prescript;

	/**
	 * @var        Streamserver
	 */
	protected $aStreamserver;

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
	 * Collection to store aggregation of collPerfilI18ns.
	 * @var        array
	 */
	protected $collPerfilI18ns;

	/**
	 * The criteria used to select the current contents of collPerfilI18ns.
	 * @var        Criteria
	 */
	protected $lastPerfilI18nCriteria = null;

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
	 * Collection to store aggregation of collPubChannelPerfilsRelatedByPerfil43Id.
	 * @var        array
	 */
	protected $collPubChannelPerfilsRelatedByPerfil43Id;

	/**
	 * The criteria used to select the current contents of collPubChannelPerfilsRelatedByPerfil43Id.
	 * @var        Criteria
	 */
	protected $lastPubChannelPerfilRelatedByPerfil43IdCriteria = null;

	/**
	 * Collection to store aggregation of collPubChannelPerfilsRelatedByPerfil169Id.
	 * @var        array
	 */
	protected $collPubChannelPerfilsRelatedByPerfil169Id;

	/**
	 * The criteria used to select the current contents of collPubChannelPerfilsRelatedByPerfil169Id.
	 * @var        Criteria
	 */
	protected $lastPubChannelPerfilRelatedByPerfil169IdCriteria = null;

	/**
	 * Collection to store aggregation of collPubChannelPerfilsRelatedByPerfilAudioId.
	 * @var        array
	 */
	protected $collPubChannelPerfilsRelatedByPerfilAudioId;

	/**
	 * The criteria used to select the current contents of collPubChannelPerfilsRelatedByPerfilAudioId.
	 * @var        Criteria
	 */
	protected $lastPubChannelPerfilRelatedByPerfilAudioIdCriteria = null;

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
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{

		return $this->name;
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
	 * Get the [display] column value.
	 * 
	 * @return     boolean
	 */
	public function getDisplay()
	{

		return $this->display;
	}

	/**
	 * Get the [wizard] column value.
	 * 
	 * @return     boolean
	 */
	public function getWizard()
	{

		return $this->wizard;
	}

	/**
	 * Get the [format] column value.
	 * 
	 * @return     string
	 */
	public function getFormat()
	{

		return $this->format;
	}

	/**
	 * Get the [codec] column value.
	 * 
	 * @return     string
	 */
	public function getCodec()
	{

		return $this->codec;
	}

	/**
	 * Get the [mime_type] column value.
	 * 
	 * @return     string
	 */
	public function getMimeType()
	{

		return $this->mime_type;
	}

	/**
	 * Get the [extension] column value.
	 * 
	 * @return     string
	 */
	public function getExtension()
	{

		return $this->extension;
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
	 * Get the [bat] column value.
	 * 
	 * @return     string
	 */
	public function getBat()
	{

		return $this->bat;
	}

	/**
	 * Get the [file_cfg] column value.
	 * 
	 * @return     string
	 */
	public function getFileCfg()
	{

		return $this->file_cfg;
	}

	/**
	 * Get the [streamserver_id] column value.
	 * 
	 * @return     int
	 */
	public function getStreamserverId()
	{

		return $this->streamserver_id;
	}

	/**
	 * Get the [app] column value.
	 * 
	 * @return     string
	 */
	public function getApp()
	{

		return $this->app;
	}

	/**
	 * Get the [rel_duration_size] column value.
	 * 
	 * @return     double
	 */
	public function getRelDurationSize()
	{

		return $this->rel_duration_size;
	}

	/**
	 * Get the [rel_duration_trans] column value.
	 * 
	 * @return     double
	 */
	public function getRelDurationTrans()
	{

		return $this->rel_duration_trans;
	}

	/**
	 * Get the [prescript] column value.
	 * 
	 * @return     string
	 */
	public function getPrescript()
	{

		return $this->prescript;
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
			$this->modifiedColumns[] = PerfilPeer::ID;
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
			$this->modifiedColumns[] = PerfilPeer::NAME;
		}

	} // setName()

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
			$this->modifiedColumns[] = PerfilPeer::RANK;
		}

	} // setRank()

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
			$this->modifiedColumns[] = PerfilPeer::DISPLAY;
		}

	} // setDisplay()

	/**
	 * Set the value of [wizard] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setWizard($v)
	{

		if ($this->wizard !== $v || $v === true) {
			$this->wizard = $v;
			$this->modifiedColumns[] = PerfilPeer::WIZARD;
		}

	} // setWizard()

	/**
	 * Set the value of [format] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setFormat($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->format !== $v) {
			$this->format = $v;
			$this->modifiedColumns[] = PerfilPeer::FORMAT;
		}

	} // setFormat()

	/**
	 * Set the value of [codec] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCodec($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->codec !== $v) {
			$this->codec = $v;
			$this->modifiedColumns[] = PerfilPeer::CODEC;
		}

	} // setCodec()

	/**
	 * Set the value of [mime_type] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setMimeType($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mime_type !== $v) {
			$this->mime_type = $v;
			$this->modifiedColumns[] = PerfilPeer::MIME_TYPE;
		}

	} // setMimeType()

	/**
	 * Set the value of [extension] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setExtension($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->extension !== $v) {
			$this->extension = $v;
			$this->modifiedColumns[] = PerfilPeer::EXTENSION;
		}

	} // setExtension()

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
			$this->modifiedColumns[] = PerfilPeer::RESOLUTION_HOR;
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
			$this->modifiedColumns[] = PerfilPeer::RESOLUTION_VER;
		}

	} // setResolutionVer()

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
			$this->modifiedColumns[] = PerfilPeer::BITRATE;
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
			$this->modifiedColumns[] = PerfilPeer::FRAMERATE;
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
			$this->modifiedColumns[] = PerfilPeer::CHANNELS;
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
			$this->modifiedColumns[] = PerfilPeer::AUDIO;
		}

	} // setAudio()

	/**
	 * Set the value of [bat] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setBat($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->bat !== $v) {
			$this->bat = $v;
			$this->modifiedColumns[] = PerfilPeer::BAT;
		}

	} // setBat()

	/**
	 * Set the value of [file_cfg] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setFileCfg($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->file_cfg !== $v) {
			$this->file_cfg = $v;
			$this->modifiedColumns[] = PerfilPeer::FILE_CFG;
		}

	} // setFileCfg()

	/**
	 * Set the value of [streamserver_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setStreamserverId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->streamserver_id !== $v) {
			$this->streamserver_id = $v;
			$this->modifiedColumns[] = PerfilPeer::STREAMSERVER_ID;
		}

		if ($this->aStreamserver !== null && $this->aStreamserver->getId() !== $v) {
			$this->aStreamserver = null;
		}

	} // setStreamserverId()

	/**
	 * Set the value of [app] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setApp($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->app !== $v) {
			$this->app = $v;
			$this->modifiedColumns[] = PerfilPeer::APP;
		}

	} // setApp()

	/**
	 * Set the value of [rel_duration_size] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setRelDurationSize($v)
	{

		if ($this->rel_duration_size !== $v || $v === 1) {
			$this->rel_duration_size = $v;
			$this->modifiedColumns[] = PerfilPeer::REL_DURATION_SIZE;
		}

	} // setRelDurationSize()

	/**
	 * Set the value of [rel_duration_trans] column.
	 * 
	 * @param      double $v new value
	 * @return     void
	 */
	public function setRelDurationTrans($v)
	{

		if ($this->rel_duration_trans !== $v || $v === 1) {
			$this->rel_duration_trans = $v;
			$this->modifiedColumns[] = PerfilPeer::REL_DURATION_TRANS;
		}

	} // setRelDurationTrans()

	/**
	 * Set the value of [prescript] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setPrescript($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->prescript !== $v) {
			$this->prescript = $v;
			$this->modifiedColumns[] = PerfilPeer::PRESCRIPT;
		}

	} // setPrescript()

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

			$this->rank = $rs->getInt($startcol + 2);

			$this->display = $rs->getBoolean($startcol + 3);

			$this->wizard = $rs->getBoolean($startcol + 4);

			$this->format = $rs->getString($startcol + 5);

			$this->codec = $rs->getString($startcol + 6);

			$this->mime_type = $rs->getString($startcol + 7);

			$this->extension = $rs->getString($startcol + 8);

			$this->resolution_hor = $rs->getInt($startcol + 9);

			$this->resolution_ver = $rs->getInt($startcol + 10);

			$this->bitrate = $rs->getString($startcol + 11);

			$this->framerate = $rs->getInt($startcol + 12);

			$this->channels = $rs->getInt($startcol + 13);

			$this->audio = $rs->getBoolean($startcol + 14);

			$this->bat = $rs->getString($startcol + 15);

			$this->file_cfg = $rs->getString($startcol + 16);

			$this->streamserver_id = $rs->getInt($startcol + 17);

			$this->app = $rs->getString($startcol + 18);

			$this->rel_duration_size = $rs->getFloat($startcol + 19);

			$this->rel_duration_trans = $rs->getFloat($startcol + 20);

			$this->prescript = $rs->getString($startcol + 21);

			$this->resetModified();

			$this->setNew(false);
			$this->setCulture(sfContext::getInstance()->getUser()->getCulture());

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 22; // 22 = PerfilPeer::NUM_COLUMNS - PerfilPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Perfil object", $e);
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

    foreach (sfMixer::getCallables('BasePerfil:delete:pre') as $callable)
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
			$con = Propel::getConnection(PerfilPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PerfilPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePerfil:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BasePerfil:save:pre') as $callable)
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
			$con = Propel::getConnection(PerfilPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePerfil:save:post') as $callable)
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

			if ($this->aStreamserver !== null) {
				if ($this->aStreamserver->isModified()) {
					$affectedRows += $this->aStreamserver->save($con);
				}
				$this->setStreamserver($this->aStreamserver);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PerfilPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += PerfilPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collFiles !== null) {
				foreach($this->collFiles as $referrerFK) {
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

			if ($this->collPerfilI18ns !== null) {
				foreach($this->collPerfilI18ns as $referrerFK) {
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

			if ($this->collPubChannelPerfilsRelatedByPerfil43Id !== null) {
				foreach($this->collPubChannelPerfilsRelatedByPerfil43Id as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPubChannelPerfilsRelatedByPerfil169Id !== null) {
				foreach($this->collPubChannelPerfilsRelatedByPerfil169Id as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPubChannelPerfilsRelatedByPerfilAudioId !== null) {
				foreach($this->collPubChannelPerfilsRelatedByPerfilAudioId as $referrerFK) {
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

			if ($this->aStreamserver !== null) {
				if (!$this->aStreamserver->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aStreamserver->getValidationFailures());
				}
			}


			if (($retval = PerfilPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collFiles !== null) {
					foreach($this->collFiles as $referrerFK) {
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

				if ($this->collPerfilI18ns !== null) {
					foreach($this->collPerfilI18ns as $referrerFK) {
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

				if ($this->collPubChannelPerfilsRelatedByPerfil43Id !== null) {
					foreach($this->collPubChannelPerfilsRelatedByPerfil43Id as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPubChannelPerfilsRelatedByPerfil169Id !== null) {
					foreach($this->collPubChannelPerfilsRelatedByPerfil169Id as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPubChannelPerfilsRelatedByPerfilAudioId !== null) {
					foreach($this->collPubChannelPerfilsRelatedByPerfilAudioId as $referrerFK) {
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
		$pos = PerfilPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getRank();
				break;
			case 3:
				return $this->getDisplay();
				break;
			case 4:
				return $this->getWizard();
				break;
			case 5:
				return $this->getFormat();
				break;
			case 6:
				return $this->getCodec();
				break;
			case 7:
				return $this->getMimeType();
				break;
			case 8:
				return $this->getExtension();
				break;
			case 9:
				return $this->getResolutionHor();
				break;
			case 10:
				return $this->getResolutionVer();
				break;
			case 11:
				return $this->getBitrate();
				break;
			case 12:
				return $this->getFramerate();
				break;
			case 13:
				return $this->getChannels();
				break;
			case 14:
				return $this->getAudio();
				break;
			case 15:
				return $this->getBat();
				break;
			case 16:
				return $this->getFileCfg();
				break;
			case 17:
				return $this->getStreamserverId();
				break;
			case 18:
				return $this->getApp();
				break;
			case 19:
				return $this->getRelDurationSize();
				break;
			case 20:
				return $this->getRelDurationTrans();
				break;
			case 21:
				return $this->getPrescript();
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
		$keys = PerfilPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getRank(),
			$keys[3] => $this->getDisplay(),
			$keys[4] => $this->getWizard(),
			$keys[5] => $this->getFormat(),
			$keys[6] => $this->getCodec(),
			$keys[7] => $this->getMimeType(),
			$keys[8] => $this->getExtension(),
			$keys[9] => $this->getResolutionHor(),
			$keys[10] => $this->getResolutionVer(),
			$keys[11] => $this->getBitrate(),
			$keys[12] => $this->getFramerate(),
			$keys[13] => $this->getChannels(),
			$keys[14] => $this->getAudio(),
			$keys[15] => $this->getBat(),
			$keys[16] => $this->getFileCfg(),
			$keys[17] => $this->getStreamserverId(),
			$keys[18] => $this->getApp(),
			$keys[19] => $this->getRelDurationSize(),
			$keys[20] => $this->getRelDurationTrans(),
			$keys[21] => $this->getPrescript(),
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
		$pos = PerfilPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setRank($value);
				break;
			case 3:
				$this->setDisplay($value);
				break;
			case 4:
				$this->setWizard($value);
				break;
			case 5:
				$this->setFormat($value);
				break;
			case 6:
				$this->setCodec($value);
				break;
			case 7:
				$this->setMimeType($value);
				break;
			case 8:
				$this->setExtension($value);
				break;
			case 9:
				$this->setResolutionHor($value);
				break;
			case 10:
				$this->setResolutionVer($value);
				break;
			case 11:
				$this->setBitrate($value);
				break;
			case 12:
				$this->setFramerate($value);
				break;
			case 13:
				$this->setChannels($value);
				break;
			case 14:
				$this->setAudio($value);
				break;
			case 15:
				$this->setBat($value);
				break;
			case 16:
				$this->setFileCfg($value);
				break;
			case 17:
				$this->setStreamserverId($value);
				break;
			case 18:
				$this->setApp($value);
				break;
			case 19:
				$this->setRelDurationSize($value);
				break;
			case 20:
				$this->setRelDurationTrans($value);
				break;
			case 21:
				$this->setPrescript($value);
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
		$keys = PerfilPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRank($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDisplay($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setWizard($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setFormat($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setCodec($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setMimeType($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setExtension($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setResolutionHor($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setResolutionVer($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setBitrate($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setFramerate($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setChannels($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setAudio($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setBat($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setFileCfg($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setStreamserverId($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setApp($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setRelDurationSize($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setRelDurationTrans($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setPrescript($arr[$keys[21]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PerfilPeer::DATABASE_NAME);

		if ($this->isColumnModified(PerfilPeer::ID)) $criteria->add(PerfilPeer::ID, $this->id);
		if ($this->isColumnModified(PerfilPeer::NAME)) $criteria->add(PerfilPeer::NAME, $this->name);
		if ($this->isColumnModified(PerfilPeer::RANK)) $criteria->add(PerfilPeer::RANK, $this->rank);
		if ($this->isColumnModified(PerfilPeer::DISPLAY)) $criteria->add(PerfilPeer::DISPLAY, $this->display);
		if ($this->isColumnModified(PerfilPeer::WIZARD)) $criteria->add(PerfilPeer::WIZARD, $this->wizard);
		if ($this->isColumnModified(PerfilPeer::FORMAT)) $criteria->add(PerfilPeer::FORMAT, $this->format);
		if ($this->isColumnModified(PerfilPeer::CODEC)) $criteria->add(PerfilPeer::CODEC, $this->codec);
		if ($this->isColumnModified(PerfilPeer::MIME_TYPE)) $criteria->add(PerfilPeer::MIME_TYPE, $this->mime_type);
		if ($this->isColumnModified(PerfilPeer::EXTENSION)) $criteria->add(PerfilPeer::EXTENSION, $this->extension);
		if ($this->isColumnModified(PerfilPeer::RESOLUTION_HOR)) $criteria->add(PerfilPeer::RESOLUTION_HOR, $this->resolution_hor);
		if ($this->isColumnModified(PerfilPeer::RESOLUTION_VER)) $criteria->add(PerfilPeer::RESOLUTION_VER, $this->resolution_ver);
		if ($this->isColumnModified(PerfilPeer::BITRATE)) $criteria->add(PerfilPeer::BITRATE, $this->bitrate);
		if ($this->isColumnModified(PerfilPeer::FRAMERATE)) $criteria->add(PerfilPeer::FRAMERATE, $this->framerate);
		if ($this->isColumnModified(PerfilPeer::CHANNELS)) $criteria->add(PerfilPeer::CHANNELS, $this->channels);
		if ($this->isColumnModified(PerfilPeer::AUDIO)) $criteria->add(PerfilPeer::AUDIO, $this->audio);
		if ($this->isColumnModified(PerfilPeer::BAT)) $criteria->add(PerfilPeer::BAT, $this->bat);
		if ($this->isColumnModified(PerfilPeer::FILE_CFG)) $criteria->add(PerfilPeer::FILE_CFG, $this->file_cfg);
		if ($this->isColumnModified(PerfilPeer::STREAMSERVER_ID)) $criteria->add(PerfilPeer::STREAMSERVER_ID, $this->streamserver_id);
		if ($this->isColumnModified(PerfilPeer::APP)) $criteria->add(PerfilPeer::APP, $this->app);
		if ($this->isColumnModified(PerfilPeer::REL_DURATION_SIZE)) $criteria->add(PerfilPeer::REL_DURATION_SIZE, $this->rel_duration_size);
		if ($this->isColumnModified(PerfilPeer::REL_DURATION_TRANS)) $criteria->add(PerfilPeer::REL_DURATION_TRANS, $this->rel_duration_trans);
		if ($this->isColumnModified(PerfilPeer::PRESCRIPT)) $criteria->add(PerfilPeer::PRESCRIPT, $this->prescript);

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
		$criteria = new Criteria(PerfilPeer::DATABASE_NAME);

		$criteria->add(PerfilPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Perfil (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);

		$copyObj->setRank($this->rank);

		$copyObj->setDisplay($this->display);

		$copyObj->setWizard($this->wizard);

		$copyObj->setFormat($this->format);

		$copyObj->setCodec($this->codec);

		$copyObj->setMimeType($this->mime_type);

		$copyObj->setExtension($this->extension);

		$copyObj->setResolutionHor($this->resolution_hor);

		$copyObj->setResolutionVer($this->resolution_ver);

		$copyObj->setBitrate($this->bitrate);

		$copyObj->setFramerate($this->framerate);

		$copyObj->setChannels($this->channels);

		$copyObj->setAudio($this->audio);

		$copyObj->setBat($this->bat);

		$copyObj->setFileCfg($this->file_cfg);

		$copyObj->setStreamserverId($this->streamserver_id);

		$copyObj->setApp($this->app);

		$copyObj->setRelDurationSize($this->rel_duration_size);

		$copyObj->setRelDurationTrans($this->rel_duration_trans);

		$copyObj->setPrescript($this->prescript);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getFiles() as $relObj) {
				$copyObj->addFile($relObj->copy($deepCopy));
			}

			foreach($this->getLogTranscodings() as $relObj) {
				$copyObj->addLogTranscoding($relObj->copy($deepCopy));
			}

			foreach($this->getPerfilI18ns() as $relObj) {
				$copyObj->addPerfilI18n($relObj->copy($deepCopy));
			}

			foreach($this->getTranscodings() as $relObj) {
				$copyObj->addTranscoding($relObj->copy($deepCopy));
			}

			foreach($this->getPubChannelPerfilsRelatedByPerfil43Id() as $relObj) {
				$copyObj->addPubChannelPerfilRelatedByPerfil43Id($relObj->copy($deepCopy));
			}

			foreach($this->getPubChannelPerfilsRelatedByPerfil169Id() as $relObj) {
				$copyObj->addPubChannelPerfilRelatedByPerfil169Id($relObj->copy($deepCopy));
			}

			foreach($this->getPubChannelPerfilsRelatedByPerfilAudioId() as $relObj) {
				$copyObj->addPubChannelPerfilRelatedByPerfilAudioId($relObj->copy($deepCopy));
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
	 * @return     Perfil Clone of current object.
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
	 * @return     PerfilPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PerfilPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Streamserver object.
	 *
	 * @param      Streamserver $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setStreamserver($v)
	{


		if ($v === null) {
			$this->setStreamserverId(NULL);
		} else {
			$this->setStreamserverId($v->getId());
		}


		$this->aStreamserver = $v;
	}


	/**
	 * Get the associated Streamserver object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Streamserver The associated Streamserver object.
	 * @throws     PropelException
	 */
	public function getStreamserver($con = null)
	{
		if ($this->aStreamserver === null && ($this->streamserver_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseStreamserverPeer.php';

			$this->aStreamserver = StreamserverPeer::retrieveByPK($this->streamserver_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = StreamserverPeer::retrieveByPK($this->streamserver_id, $con);
			   $obj->addStreamservers($this);
			 */
		}
		return $this->aStreamserver;
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
	 * Otherwise if this Perfil has previously
	 * been saved, it will retrieve related Files from storage.
	 * If this Perfil is new, it will return
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

				$criteria->add(FilePeer::PERFIL_ID, $this->getId());

				FilePeer::addSelectColumns($criteria);
				$this->collFiles = FilePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FilePeer::PERFIL_ID, $this->getId());

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

		$criteria->add(FilePeer::PERFIL_ID, $this->getId());

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
		$l->setPerfil($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Perfil is new, it will return
	 * an empty collection; or if this Perfil has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Perfil.
	 */
	public function getFilesJoinMm($criteria = null, $con = null)
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

				$criteria->add(FilePeer::PERFIL_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectJoinMm($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FilePeer::PERFIL_ID, $this->getId());

			if (!isset($this->lastFileCriteria) || !$this->lastFileCriteria->equals($criteria)) {
				$this->collFiles = FilePeer::doSelectJoinMm($criteria, $con);
			}
		}
		$this->lastFileCriteria = $criteria;

		return $this->collFiles;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Perfil is new, it will return
	 * an empty collection; or if this Perfil has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Perfil.
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

				$criteria->add(FilePeer::PERFIL_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectJoinLanguage($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FilePeer::PERFIL_ID, $this->getId());

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
	 * Otherwise if this Perfil is new, it will return
	 * an empty collection; or if this Perfil has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Perfil.
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

				$criteria->add(FilePeer::PERFIL_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectJoinFormat($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FilePeer::PERFIL_ID, $this->getId());

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
	 * Otherwise if this Perfil is new, it will return
	 * an empty collection; or if this Perfil has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Perfil.
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

				$criteria->add(FilePeer::PERFIL_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectJoinCodec($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FilePeer::PERFIL_ID, $this->getId());

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
	 * Otherwise if this Perfil is new, it will return
	 * an empty collection; or if this Perfil has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Perfil.
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

				$criteria->add(FilePeer::PERFIL_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectJoinMimeType($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FilePeer::PERFIL_ID, $this->getId());

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
	 * Otherwise if this Perfil is new, it will return
	 * an empty collection; or if this Perfil has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Perfil.
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

				$criteria->add(FilePeer::PERFIL_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectJoinResolution($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FilePeer::PERFIL_ID, $this->getId());

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
	 * Otherwise if this Perfil has previously
	 * been saved, it will retrieve related Files from storage.
	 * If this Perfil is new, it will return
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

				$criteria->add(FilePeer::PERFIL_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FilePeer::PERFIL_ID, $this->getId());

				if (!isset($this->lastFileCriteria) || !$this->lastFileCriteria->equals($criteria)) {
					$this->collFiles = FilePeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
				}
			}
		}
		$this->lastFileCriteria = $criteria;
		return $this->collFiles;
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
	 * Otherwise if this Perfil has previously
	 * been saved, it will retrieve related LogTranscodings from storage.
	 * If this Perfil is new, it will return
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

				$criteria->add(LogTranscodingPeer::PERFIL_ID, $this->getId());

				LogTranscodingPeer::addSelectColumns($criteria);
				$this->collLogTranscodings = LogTranscodingPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(LogTranscodingPeer::PERFIL_ID, $this->getId());

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

		$criteria->add(LogTranscodingPeer::PERFIL_ID, $this->getId());

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
		$l->setPerfil($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Perfil is new, it will return
	 * an empty collection; or if this Perfil has previously
	 * been saved, it will retrieve related LogTranscodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Perfil.
	 */
	public function getLogTranscodingsJoinMm($criteria = null, $con = null)
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

				$criteria->add(LogTranscodingPeer::PERFIL_ID, $this->getId());

				$this->collLogTranscodings = LogTranscodingPeer::doSelectJoinMm($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(LogTranscodingPeer::PERFIL_ID, $this->getId());

			if (!isset($this->lastLogTranscodingCriteria) || !$this->lastLogTranscodingCriteria->equals($criteria)) {
				$this->collLogTranscodings = LogTranscodingPeer::doSelectJoinMm($criteria, $con);
			}
		}
		$this->lastLogTranscodingCriteria = $criteria;

		return $this->collLogTranscodings;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Perfil is new, it will return
	 * an empty collection; or if this Perfil has previously
	 * been saved, it will retrieve related LogTranscodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Perfil.
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

				$criteria->add(LogTranscodingPeer::PERFIL_ID, $this->getId());

				$this->collLogTranscodings = LogTranscodingPeer::doSelectJoinLanguage($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(LogTranscodingPeer::PERFIL_ID, $this->getId());

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
	 * Otherwise if this Perfil is new, it will return
	 * an empty collection; or if this Perfil has previously
	 * been saved, it will retrieve related LogTranscodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Perfil.
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

				$criteria->add(LogTranscodingPeer::PERFIL_ID, $this->getId());

				$this->collLogTranscodings = LogTranscodingPeer::doSelectJoinCpu($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(LogTranscodingPeer::PERFIL_ID, $this->getId());

			if (!isset($this->lastLogTranscodingCriteria) || !$this->lastLogTranscodingCriteria->equals($criteria)) {
				$this->collLogTranscodings = LogTranscodingPeer::doSelectJoinCpu($criteria, $con);
			}
		}
		$this->lastLogTranscodingCriteria = $criteria;

		return $this->collLogTranscodings;
	}

	/**
	 * Temporary storage of collPerfilI18ns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPerfilI18ns()
	{
		if ($this->collPerfilI18ns === null) {
			$this->collPerfilI18ns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Perfil has previously
	 * been saved, it will retrieve related PerfilI18ns from storage.
	 * If this Perfil is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPerfilI18ns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePerfilI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPerfilI18ns === null) {
			if ($this->isNew()) {
			   $this->collPerfilI18ns = array();
			} else {

				$criteria->add(PerfilI18nPeer::ID, $this->getId());

				PerfilI18nPeer::addSelectColumns($criteria);
				$this->collPerfilI18ns = PerfilI18nPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PerfilI18nPeer::ID, $this->getId());

				PerfilI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastPerfilI18nCriteria) || !$this->lastPerfilI18nCriteria->equals($criteria)) {
					$this->collPerfilI18ns = PerfilI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPerfilI18nCriteria = $criteria;
		return $this->collPerfilI18ns;
	}

	/**
	 * Returns the number of related PerfilI18ns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPerfilI18ns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePerfilI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PerfilI18nPeer::ID, $this->getId());

		return PerfilI18nPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a PerfilI18n object to this object
	 * through the PerfilI18n foreign key attribute
	 *
	 * @param      PerfilI18n $l PerfilI18n
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPerfilI18n(PerfilI18n $l)
	{
		$this->collPerfilI18ns[] = $l;
		$l->setPerfil($this);
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
	 * Otherwise if this Perfil has previously
	 * been saved, it will retrieve related Transcodings from storage.
	 * If this Perfil is new, it will return
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

				$criteria->add(TranscodingPeer::PERFIL_ID, $this->getId());

				TranscodingPeer::addSelectColumns($criteria);
				$this->collTranscodings = TranscodingPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TranscodingPeer::PERFIL_ID, $this->getId());

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

		$criteria->add(TranscodingPeer::PERFIL_ID, $this->getId());

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
		$l->setPerfil($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Perfil is new, it will return
	 * an empty collection; or if this Perfil has previously
	 * been saved, it will retrieve related Transcodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Perfil.
	 */
	public function getTranscodingsJoinMm($criteria = null, $con = null)
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

				$criteria->add(TranscodingPeer::PERFIL_ID, $this->getId());

				$this->collTranscodings = TranscodingPeer::doSelectJoinMm($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TranscodingPeer::PERFIL_ID, $this->getId());

			if (!isset($this->lastTranscodingCriteria) || !$this->lastTranscodingCriteria->equals($criteria)) {
				$this->collTranscodings = TranscodingPeer::doSelectJoinMm($criteria, $con);
			}
		}
		$this->lastTranscodingCriteria = $criteria;

		return $this->collTranscodings;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Perfil is new, it will return
	 * an empty collection; or if this Perfil has previously
	 * been saved, it will retrieve related Transcodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Perfil.
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

				$criteria->add(TranscodingPeer::PERFIL_ID, $this->getId());

				$this->collTranscodings = TranscodingPeer::doSelectJoinLanguage($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TranscodingPeer::PERFIL_ID, $this->getId());

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
	 * Otherwise if this Perfil is new, it will return
	 * an empty collection; or if this Perfil has previously
	 * been saved, it will retrieve related Transcodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Perfil.
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

				$criteria->add(TranscodingPeer::PERFIL_ID, $this->getId());

				$this->collTranscodings = TranscodingPeer::doSelectJoinCpu($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TranscodingPeer::PERFIL_ID, $this->getId());

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
	 * Otherwise if this Perfil has previously
	 * been saved, it will retrieve related Transcodings from storage.
	 * If this Perfil is new, it will return
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

				$criteria->add(TranscodingPeer::PERFIL_ID, $this->getId());

				$this->collTranscodings = TranscodingPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TranscodingPeer::PERFIL_ID, $this->getId());

				if (!isset($this->lastTranscodingCriteria) || !$this->lastTranscodingCriteria->equals($criteria)) {
					$this->collTranscodings = TranscodingPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
				}
			}
		}
		$this->lastTranscodingCriteria = $criteria;
		return $this->collTranscodings;
	}

	/**
	 * Temporary storage of collPubChannelPerfilsRelatedByPerfil43Id to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPubChannelPerfilsRelatedByPerfil43Id()
	{
		if ($this->collPubChannelPerfilsRelatedByPerfil43Id === null) {
			$this->collPubChannelPerfilsRelatedByPerfil43Id = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Perfil has previously
	 * been saved, it will retrieve related PubChannelPerfilsRelatedByPerfil43Id from storage.
	 * If this Perfil is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPubChannelPerfilsRelatedByPerfil43Id($criteria = null, $con = null)
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

		if ($this->collPubChannelPerfilsRelatedByPerfil43Id === null) {
			if ($this->isNew()) {
			   $this->collPubChannelPerfilsRelatedByPerfil43Id = array();
			} else {

				$criteria->add(PubChannelPerfilPeer::PERFIL_43_ID, $this->getId());

				PubChannelPerfilPeer::addSelectColumns($criteria);
				$this->collPubChannelPerfilsRelatedByPerfil43Id = PubChannelPerfilPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PubChannelPerfilPeer::PERFIL_43_ID, $this->getId());

				PubChannelPerfilPeer::addSelectColumns($criteria);
				if (!isset($this->lastPubChannelPerfilRelatedByPerfil43IdCriteria) || !$this->lastPubChannelPerfilRelatedByPerfil43IdCriteria->equals($criteria)) {
					$this->collPubChannelPerfilsRelatedByPerfil43Id = PubChannelPerfilPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPubChannelPerfilRelatedByPerfil43IdCriteria = $criteria;
		return $this->collPubChannelPerfilsRelatedByPerfil43Id;
	}

	/**
	 * Returns the number of related PubChannelPerfilsRelatedByPerfil43Id.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPubChannelPerfilsRelatedByPerfil43Id($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(PubChannelPerfilPeer::PERFIL_43_ID, $this->getId());

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
	public function addPubChannelPerfilRelatedByPerfil43Id(PubChannelPerfil $l)
	{
		$this->collPubChannelPerfilsRelatedByPerfil43Id[] = $l;
		$l->setPerfilRelatedByPerfil43Id($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Perfil is new, it will return
	 * an empty collection; or if this Perfil has previously
	 * been saved, it will retrieve related PubChannelPerfilsRelatedByPerfil43Id from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Perfil.
	 */
	public function getPubChannelPerfilsRelatedByPerfil43IdJoinPubChannel($criteria = null, $con = null)
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

		if ($this->collPubChannelPerfilsRelatedByPerfil43Id === null) {
			if ($this->isNew()) {
				$this->collPubChannelPerfilsRelatedByPerfil43Id = array();
			} else {

				$criteria->add(PubChannelPerfilPeer::PERFIL_43_ID, $this->getId());

				$this->collPubChannelPerfilsRelatedByPerfil43Id = PubChannelPerfilPeer::doSelectJoinPubChannel($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PubChannelPerfilPeer::PERFIL_43_ID, $this->getId());

			if (!isset($this->lastPubChannelPerfilRelatedByPerfil43IdCriteria) || !$this->lastPubChannelPerfilRelatedByPerfil43IdCriteria->equals($criteria)) {
				$this->collPubChannelPerfilsRelatedByPerfil43Id = PubChannelPerfilPeer::doSelectJoinPubChannel($criteria, $con);
			}
		}
		$this->lastPubChannelPerfilRelatedByPerfil43IdCriteria = $criteria;

		return $this->collPubChannelPerfilsRelatedByPerfil43Id;
	}

	/**
	 * Temporary storage of collPubChannelPerfilsRelatedByPerfil169Id to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPubChannelPerfilsRelatedByPerfil169Id()
	{
		if ($this->collPubChannelPerfilsRelatedByPerfil169Id === null) {
			$this->collPubChannelPerfilsRelatedByPerfil169Id = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Perfil has previously
	 * been saved, it will retrieve related PubChannelPerfilsRelatedByPerfil169Id from storage.
	 * If this Perfil is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPubChannelPerfilsRelatedByPerfil169Id($criteria = null, $con = null)
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

		if ($this->collPubChannelPerfilsRelatedByPerfil169Id === null) {
			if ($this->isNew()) {
			   $this->collPubChannelPerfilsRelatedByPerfil169Id = array();
			} else {

				$criteria->add(PubChannelPerfilPeer::PERFIL_169_ID, $this->getId());

				PubChannelPerfilPeer::addSelectColumns($criteria);
				$this->collPubChannelPerfilsRelatedByPerfil169Id = PubChannelPerfilPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PubChannelPerfilPeer::PERFIL_169_ID, $this->getId());

				PubChannelPerfilPeer::addSelectColumns($criteria);
				if (!isset($this->lastPubChannelPerfilRelatedByPerfil169IdCriteria) || !$this->lastPubChannelPerfilRelatedByPerfil169IdCriteria->equals($criteria)) {
					$this->collPubChannelPerfilsRelatedByPerfil169Id = PubChannelPerfilPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPubChannelPerfilRelatedByPerfil169IdCriteria = $criteria;
		return $this->collPubChannelPerfilsRelatedByPerfil169Id;
	}

	/**
	 * Returns the number of related PubChannelPerfilsRelatedByPerfil169Id.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPubChannelPerfilsRelatedByPerfil169Id($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(PubChannelPerfilPeer::PERFIL_169_ID, $this->getId());

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
	public function addPubChannelPerfilRelatedByPerfil169Id(PubChannelPerfil $l)
	{
		$this->collPubChannelPerfilsRelatedByPerfil169Id[] = $l;
		$l->setPerfilRelatedByPerfil169Id($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Perfil is new, it will return
	 * an empty collection; or if this Perfil has previously
	 * been saved, it will retrieve related PubChannelPerfilsRelatedByPerfil169Id from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Perfil.
	 */
	public function getPubChannelPerfilsRelatedByPerfil169IdJoinPubChannel($criteria = null, $con = null)
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

		if ($this->collPubChannelPerfilsRelatedByPerfil169Id === null) {
			if ($this->isNew()) {
				$this->collPubChannelPerfilsRelatedByPerfil169Id = array();
			} else {

				$criteria->add(PubChannelPerfilPeer::PERFIL_169_ID, $this->getId());

				$this->collPubChannelPerfilsRelatedByPerfil169Id = PubChannelPerfilPeer::doSelectJoinPubChannel($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PubChannelPerfilPeer::PERFIL_169_ID, $this->getId());

			if (!isset($this->lastPubChannelPerfilRelatedByPerfil169IdCriteria) || !$this->lastPubChannelPerfilRelatedByPerfil169IdCriteria->equals($criteria)) {
				$this->collPubChannelPerfilsRelatedByPerfil169Id = PubChannelPerfilPeer::doSelectJoinPubChannel($criteria, $con);
			}
		}
		$this->lastPubChannelPerfilRelatedByPerfil169IdCriteria = $criteria;

		return $this->collPubChannelPerfilsRelatedByPerfil169Id;
	}

	/**
	 * Temporary storage of collPubChannelPerfilsRelatedByPerfilAudioId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPubChannelPerfilsRelatedByPerfilAudioId()
	{
		if ($this->collPubChannelPerfilsRelatedByPerfilAudioId === null) {
			$this->collPubChannelPerfilsRelatedByPerfilAudioId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Perfil has previously
	 * been saved, it will retrieve related PubChannelPerfilsRelatedByPerfilAudioId from storage.
	 * If this Perfil is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPubChannelPerfilsRelatedByPerfilAudioId($criteria = null, $con = null)
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

		if ($this->collPubChannelPerfilsRelatedByPerfilAudioId === null) {
			if ($this->isNew()) {
			   $this->collPubChannelPerfilsRelatedByPerfilAudioId = array();
			} else {

				$criteria->add(PubChannelPerfilPeer::PERFIL_AUDIO_ID, $this->getId());

				PubChannelPerfilPeer::addSelectColumns($criteria);
				$this->collPubChannelPerfilsRelatedByPerfilAudioId = PubChannelPerfilPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PubChannelPerfilPeer::PERFIL_AUDIO_ID, $this->getId());

				PubChannelPerfilPeer::addSelectColumns($criteria);
				if (!isset($this->lastPubChannelPerfilRelatedByPerfilAudioIdCriteria) || !$this->lastPubChannelPerfilRelatedByPerfilAudioIdCriteria->equals($criteria)) {
					$this->collPubChannelPerfilsRelatedByPerfilAudioId = PubChannelPerfilPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPubChannelPerfilRelatedByPerfilAudioIdCriteria = $criteria;
		return $this->collPubChannelPerfilsRelatedByPerfilAudioId;
	}

	/**
	 * Returns the number of related PubChannelPerfilsRelatedByPerfilAudioId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPubChannelPerfilsRelatedByPerfilAudioId($criteria = null, $distinct = false, $con = null)
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

		$criteria->add(PubChannelPerfilPeer::PERFIL_AUDIO_ID, $this->getId());

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
	public function addPubChannelPerfilRelatedByPerfilAudioId(PubChannelPerfil $l)
	{
		$this->collPubChannelPerfilsRelatedByPerfilAudioId[] = $l;
		$l->setPerfilRelatedByPerfilAudioId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Perfil is new, it will return
	 * an empty collection; or if this Perfil has previously
	 * been saved, it will retrieve related PubChannelPerfilsRelatedByPerfilAudioId from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Perfil.
	 */
	public function getPubChannelPerfilsRelatedByPerfilAudioIdJoinPubChannel($criteria = null, $con = null)
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

		if ($this->collPubChannelPerfilsRelatedByPerfilAudioId === null) {
			if ($this->isNew()) {
				$this->collPubChannelPerfilsRelatedByPerfilAudioId = array();
			} else {

				$criteria->add(PubChannelPerfilPeer::PERFIL_AUDIO_ID, $this->getId());

				$this->collPubChannelPerfilsRelatedByPerfilAudioId = PubChannelPerfilPeer::doSelectJoinPubChannel($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PubChannelPerfilPeer::PERFIL_AUDIO_ID, $this->getId());

			if (!isset($this->lastPubChannelPerfilRelatedByPerfilAudioIdCriteria) || !$this->lastPubChannelPerfilRelatedByPerfilAudioIdCriteria->equals($criteria)) {
				$this->collPubChannelPerfilsRelatedByPerfilAudioId = PubChannelPerfilPeer::doSelectJoinPubChannel($criteria, $con);
			}
		}
		$this->lastPubChannelPerfilRelatedByPerfilAudioIdCriteria = $criteria;

		return $this->collPubChannelPerfilsRelatedByPerfilAudioId;
	}

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getLink()
  {
    $obj = $this->getCurrentPerfilI18n();

    return ($obj ? $obj->getLink() : null);
  }

  public function setLink($value)
  {
    $this->getCurrentPerfilI18n()->setLink($value);
  }

  public function getDescription()
  {
    $obj = $this->getCurrentPerfilI18n();

    return ($obj ? $obj->getDescription() : null);
  }

  public function setDescription($value)
  {
    $this->getCurrentPerfilI18n()->setDescription($value);
  }

  protected $current_i18n = array();

  public function getCurrentPerfilI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = PerfilI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setPerfilI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setPerfilI18nForCulture(new PerfilI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setPerfilI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addPerfilI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePerfil:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePerfil::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BasePerfil
