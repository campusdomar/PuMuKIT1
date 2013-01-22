<?php

/**
 * Base class that represents a row from the 'pub_channel_perfil' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BasePubChannelPerfil extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PubChannelPerfilPeer
	 */
	protected static $peer;


	/**
	 * The value for the pub_channel_id field.
	 * @var        int
	 */
	protected $pub_channel_id;


	/**
	 * The value for the perfil_43_id field.
	 * @var        int
	 */
	protected $perfil_43_id;


	/**
	 * The value for the perfil_169_id field.
	 * @var        int
	 */
	protected $perfil_169_id;


	/**
	 * The value for the perfil_audio_id field.
	 * @var        int
	 */
	protected $perfil_audio_id;

	/**
	 * @var        PubChannel
	 */
	protected $aPubChannel;

	/**
	 * @var        Perfil
	 */
	protected $aPerfilRelatedByPerfil43Id;

	/**
	 * @var        Perfil
	 */
	protected $aPerfilRelatedByPerfil169Id;

	/**
	 * @var        Perfil
	 */
	protected $aPerfilRelatedByPerfilAudioId;

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
	 * Get the [pub_channel_id] column value.
	 * 
	 * @return     int
	 */
	public function getPubChannelId()
	{

		return $this->pub_channel_id;
	}

	/**
	 * Get the [perfil_43_id] column value.
	 * 
	 * @return     int
	 */
	public function getPerfil43Id()
	{

		return $this->perfil_43_id;
	}

	/**
	 * Get the [perfil_169_id] column value.
	 * 
	 * @return     int
	 */
	public function getPerfil169Id()
	{

		return $this->perfil_169_id;
	}

	/**
	 * Get the [perfil_audio_id] column value.
	 * 
	 * @return     int
	 */
	public function getPerfilAudioId()
	{

		return $this->perfil_audio_id;
	}

	/**
	 * Set the value of [pub_channel_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setPubChannelId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->pub_channel_id !== $v) {
			$this->pub_channel_id = $v;
			$this->modifiedColumns[] = PubChannelPerfilPeer::PUB_CHANNEL_ID;
		}

		if ($this->aPubChannel !== null && $this->aPubChannel->getId() !== $v) {
			$this->aPubChannel = null;
		}

	} // setPubChannelId()

	/**
	 * Set the value of [perfil_43_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setPerfil43Id($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->perfil_43_id !== $v) {
			$this->perfil_43_id = $v;
			$this->modifiedColumns[] = PubChannelPerfilPeer::PERFIL_43_ID;
		}

		if ($this->aPerfilRelatedByPerfil43Id !== null && $this->aPerfilRelatedByPerfil43Id->getId() !== $v) {
			$this->aPerfilRelatedByPerfil43Id = null;
		}

	} // setPerfil43Id()

	/**
	 * Set the value of [perfil_169_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setPerfil169Id($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->perfil_169_id !== $v) {
			$this->perfil_169_id = $v;
			$this->modifiedColumns[] = PubChannelPerfilPeer::PERFIL_169_ID;
		}

		if ($this->aPerfilRelatedByPerfil169Id !== null && $this->aPerfilRelatedByPerfil169Id->getId() !== $v) {
			$this->aPerfilRelatedByPerfil169Id = null;
		}

	} // setPerfil169Id()

	/**
	 * Set the value of [perfil_audio_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setPerfilAudioId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->perfil_audio_id !== $v) {
			$this->perfil_audio_id = $v;
			$this->modifiedColumns[] = PubChannelPerfilPeer::PERFIL_AUDIO_ID;
		}

		if ($this->aPerfilRelatedByPerfilAudioId !== null && $this->aPerfilRelatedByPerfilAudioId->getId() !== $v) {
			$this->aPerfilRelatedByPerfilAudioId = null;
		}

	} // setPerfilAudioId()

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

			$this->pub_channel_id = $rs->getInt($startcol + 0);

			$this->perfil_43_id = $rs->getInt($startcol + 1);

			$this->perfil_169_id = $rs->getInt($startcol + 2);

			$this->perfil_audio_id = $rs->getInt($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 4; // 4 = PubChannelPerfilPeer::NUM_COLUMNS - PubChannelPerfilPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating PubChannelPerfil object", $e);
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

    foreach (sfMixer::getCallables('BasePubChannelPerfil:delete:pre') as $callable)
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
			$con = Propel::getConnection(PubChannelPerfilPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PubChannelPerfilPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePubChannelPerfil:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BasePubChannelPerfil:save:pre') as $callable)
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
			$con = Propel::getConnection(PubChannelPerfilPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePubChannelPerfil:save:post') as $callable)
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

			if ($this->aPubChannel !== null) {
				if ($this->aPubChannel->isModified()) {
					$affectedRows += $this->aPubChannel->save($con);
				}
				$this->setPubChannel($this->aPubChannel);
			}

			if ($this->aPerfilRelatedByPerfil43Id !== null) {
				if ($this->aPerfilRelatedByPerfil43Id->isModified() || $this->aPerfilRelatedByPerfil43Id->getCurrentPerfilI18n()->isModified()) {
					$affectedRows += $this->aPerfilRelatedByPerfil43Id->save($con);
				}
				$this->setPerfilRelatedByPerfil43Id($this->aPerfilRelatedByPerfil43Id);
			}

			if ($this->aPerfilRelatedByPerfil169Id !== null) {
				if ($this->aPerfilRelatedByPerfil169Id->isModified() || $this->aPerfilRelatedByPerfil169Id->getCurrentPerfilI18n()->isModified()) {
					$affectedRows += $this->aPerfilRelatedByPerfil169Id->save($con);
				}
				$this->setPerfilRelatedByPerfil169Id($this->aPerfilRelatedByPerfil169Id);
			}

			if ($this->aPerfilRelatedByPerfilAudioId !== null) {
				if ($this->aPerfilRelatedByPerfilAudioId->isModified() || $this->aPerfilRelatedByPerfilAudioId->getCurrentPerfilI18n()->isModified()) {
					$affectedRows += $this->aPerfilRelatedByPerfilAudioId->save($con);
				}
				$this->setPerfilRelatedByPerfilAudioId($this->aPerfilRelatedByPerfilAudioId);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PubChannelPerfilPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += PubChannelPerfilPeer::doUpdate($this, $con);
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

			if ($this->aPubChannel !== null) {
				if (!$this->aPubChannel->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPubChannel->getValidationFailures());
				}
			}

			if ($this->aPerfilRelatedByPerfil43Id !== null) {
				if (!$this->aPerfilRelatedByPerfil43Id->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPerfilRelatedByPerfil43Id->getValidationFailures());
				}
			}

			if ($this->aPerfilRelatedByPerfil169Id !== null) {
				if (!$this->aPerfilRelatedByPerfil169Id->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPerfilRelatedByPerfil169Id->getValidationFailures());
				}
			}

			if ($this->aPerfilRelatedByPerfilAudioId !== null) {
				if (!$this->aPerfilRelatedByPerfilAudioId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPerfilRelatedByPerfilAudioId->getValidationFailures());
				}
			}


			if (($retval = PubChannelPerfilPeer::doValidate($this, $columns)) !== true) {
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
		$pos = PubChannelPerfilPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getPubChannelId();
				break;
			case 1:
				return $this->getPerfil43Id();
				break;
			case 2:
				return $this->getPerfil169Id();
				break;
			case 3:
				return $this->getPerfilAudioId();
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
		$keys = PubChannelPerfilPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getPubChannelId(),
			$keys[1] => $this->getPerfil43Id(),
			$keys[2] => $this->getPerfil169Id(),
			$keys[3] => $this->getPerfilAudioId(),
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
		$pos = PubChannelPerfilPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setPubChannelId($value);
				break;
			case 1:
				$this->setPerfil43Id($value);
				break;
			case 2:
				$this->setPerfil169Id($value);
				break;
			case 3:
				$this->setPerfilAudioId($value);
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
		$keys = PubChannelPerfilPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setPubChannelId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPerfil43Id($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPerfil169Id($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPerfilAudioId($arr[$keys[3]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PubChannelPerfilPeer::DATABASE_NAME);

		if ($this->isColumnModified(PubChannelPerfilPeer::PUB_CHANNEL_ID)) $criteria->add(PubChannelPerfilPeer::PUB_CHANNEL_ID, $this->pub_channel_id);
		if ($this->isColumnModified(PubChannelPerfilPeer::PERFIL_43_ID)) $criteria->add(PubChannelPerfilPeer::PERFIL_43_ID, $this->perfil_43_id);
		if ($this->isColumnModified(PubChannelPerfilPeer::PERFIL_169_ID)) $criteria->add(PubChannelPerfilPeer::PERFIL_169_ID, $this->perfil_169_id);
		if ($this->isColumnModified(PubChannelPerfilPeer::PERFIL_AUDIO_ID)) $criteria->add(PubChannelPerfilPeer::PERFIL_AUDIO_ID, $this->perfil_audio_id);

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
		$criteria = new Criteria(PubChannelPerfilPeer::DATABASE_NAME);

		$criteria->add(PubChannelPerfilPeer::PUB_CHANNEL_ID, $this->pub_channel_id);
		$criteria->add(PubChannelPerfilPeer::PERFIL_43_ID, $this->perfil_43_id);
		$criteria->add(PubChannelPerfilPeer::PERFIL_169_ID, $this->perfil_169_id);
		$criteria->add(PubChannelPerfilPeer::PERFIL_AUDIO_ID, $this->perfil_audio_id);

		return $criteria;
	}

	/**
	 * Returns the composite primary key for this object.
	 * The array elements will be in same order as specified in XML.
	 * @return     array
	 */
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getPubChannelId();

		$pks[1] = $this->getPerfil43Id();

		$pks[2] = $this->getPerfil169Id();

		$pks[3] = $this->getPerfilAudioId();

		return $pks;
	}

	/**
	 * Set the [composite] primary key.
	 *
	 * @param      array $keys The elements of the composite key (order must match the order in XML file).
	 * @return     void
	 */
	public function setPrimaryKey($keys)
	{

		$this->setPubChannelId($keys[0]);

		$this->setPerfil43Id($keys[1]);

		$this->setPerfil169Id($keys[2]);

		$this->setPerfilAudioId($keys[3]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of PubChannelPerfil (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{


		$copyObj->setNew(true);

		$copyObj->setPubChannelId(NULL); // this is a pkey column, so set to default value

		$copyObj->setPerfil43Id(NULL); // this is a pkey column, so set to default value

		$copyObj->setPerfil169Id(NULL); // this is a pkey column, so set to default value

		$copyObj->setPerfilAudioId(NULL); // this is a pkey column, so set to default value

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
	 * @return     PubChannelPerfil Clone of current object.
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
	 * @return     PubChannelPerfilPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PubChannelPerfilPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a PubChannel object.
	 *
	 * @param      PubChannel $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setPubChannel($v)
	{


		if ($v === null) {
			$this->setPubChannelId(NULL);
		} else {
			$this->setPubChannelId($v->getId());
		}


		$this->aPubChannel = $v;
	}


	/**
	 * Get the associated PubChannel object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     PubChannel The associated PubChannel object.
	 * @throws     PropelException
	 */
	public function getPubChannel($con = null)
	{
		if ($this->aPubChannel === null && ($this->pub_channel_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BasePubChannelPeer.php';

			$this->aPubChannel = PubChannelPeer::retrieveByPK($this->pub_channel_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = PubChannelPeer::retrieveByPK($this->pub_channel_id, $con);
			   $obj->addPubChannels($this);
			 */
		}
		return $this->aPubChannel;
	}

	/**
	 * Declares an association between this object and a Perfil object.
	 *
	 * @param      Perfil $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setPerfilRelatedByPerfil43Id($v)
	{


		if ($v === null) {
			$this->setPerfil43Id(NULL);
		} else {
			$this->setPerfil43Id($v->getId());
		}


		$this->aPerfilRelatedByPerfil43Id = $v;
	}


	/**
	 * Get the associated Perfil object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Perfil The associated Perfil object.
	 * @throws     PropelException
	 */
	public function getPerfilRelatedByPerfil43Id($con = null)
	{
		if ($this->aPerfilRelatedByPerfil43Id === null && ($this->perfil_43_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BasePerfilPeer.php';

			$this->aPerfilRelatedByPerfil43Id = PerfilPeer::retrieveByPK($this->perfil_43_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = PerfilPeer::retrieveByPK($this->perfil_43_id, $con);
			   $obj->addPerfilsRelatedByPerfil43Id($this);
			 */
		}
		return $this->aPerfilRelatedByPerfil43Id;
	}


	/**
	 * Get the associated Perfil object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Perfil The associated Perfil object.
	 * @throws     PropelException
	 */
	public function getPerfilRelatedByPerfil43IdWithI18n($con = null)
	{
		if ($this->aPerfilRelatedByPerfil43Id === null && ($this->perfil_43_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BasePerfilPeer.php';

			$this->aPerfilRelatedByPerfil43Id = PerfilPeer::retrieveByPKWithI18n($this->perfil_43_id, $this->getCulture(), $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = PerfilPeer::retrieveByPKWithI18n($this->perfil_43_id, $this->getCulture(), $con);
			   $obj->addPerfilsRelatedByPerfil43Id($this);
			 */
		}
		return $this->aPerfilRelatedByPerfil43Id;
	}

	/**
	 * Declares an association between this object and a Perfil object.
	 *
	 * @param      Perfil $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setPerfilRelatedByPerfil169Id($v)
	{


		if ($v === null) {
			$this->setPerfil169Id(NULL);
		} else {
			$this->setPerfil169Id($v->getId());
		}


		$this->aPerfilRelatedByPerfil169Id = $v;
	}


	/**
	 * Get the associated Perfil object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Perfil The associated Perfil object.
	 * @throws     PropelException
	 */
	public function getPerfilRelatedByPerfil169Id($con = null)
	{
		if ($this->aPerfilRelatedByPerfil169Id === null && ($this->perfil_169_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BasePerfilPeer.php';

			$this->aPerfilRelatedByPerfil169Id = PerfilPeer::retrieveByPK($this->perfil_169_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = PerfilPeer::retrieveByPK($this->perfil_169_id, $con);
			   $obj->addPerfilsRelatedByPerfil169Id($this);
			 */
		}
		return $this->aPerfilRelatedByPerfil169Id;
	}


	/**
	 * Get the associated Perfil object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Perfil The associated Perfil object.
	 * @throws     PropelException
	 */
	public function getPerfilRelatedByPerfil169IdWithI18n($con = null)
	{
		if ($this->aPerfilRelatedByPerfil169Id === null && ($this->perfil_169_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BasePerfilPeer.php';

			$this->aPerfilRelatedByPerfil169Id = PerfilPeer::retrieveByPKWithI18n($this->perfil_169_id, $this->getCulture(), $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = PerfilPeer::retrieveByPKWithI18n($this->perfil_169_id, $this->getCulture(), $con);
			   $obj->addPerfilsRelatedByPerfil169Id($this);
			 */
		}
		return $this->aPerfilRelatedByPerfil169Id;
	}

	/**
	 * Declares an association between this object and a Perfil object.
	 *
	 * @param      Perfil $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setPerfilRelatedByPerfilAudioId($v)
	{


		if ($v === null) {
			$this->setPerfilAudioId(NULL);
		} else {
			$this->setPerfilAudioId($v->getId());
		}


		$this->aPerfilRelatedByPerfilAudioId = $v;
	}


	/**
	 * Get the associated Perfil object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Perfil The associated Perfil object.
	 * @throws     PropelException
	 */
	public function getPerfilRelatedByPerfilAudioId($con = null)
	{
		if ($this->aPerfilRelatedByPerfilAudioId === null && ($this->perfil_audio_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BasePerfilPeer.php';

			$this->aPerfilRelatedByPerfilAudioId = PerfilPeer::retrieveByPK($this->perfil_audio_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = PerfilPeer::retrieveByPK($this->perfil_audio_id, $con);
			   $obj->addPerfilsRelatedByPerfilAudioId($this);
			 */
		}
		return $this->aPerfilRelatedByPerfilAudioId;
	}


	/**
	 * Get the associated Perfil object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Perfil The associated Perfil object.
	 * @throws     PropelException
	 */
	public function getPerfilRelatedByPerfilAudioIdWithI18n($con = null)
	{
		if ($this->aPerfilRelatedByPerfilAudioId === null && ($this->perfil_audio_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BasePerfilPeer.php';

			$this->aPerfilRelatedByPerfilAudioId = PerfilPeer::retrieveByPKWithI18n($this->perfil_audio_id, $this->getCulture(), $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = PerfilPeer::retrieveByPKWithI18n($this->perfil_audio_id, $this->getCulture(), $con);
			   $obj->addPerfilsRelatedByPerfilAudioId($this);
			 */
		}
		return $this->aPerfilRelatedByPerfilAudioId;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePubChannelPerfil:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePubChannelPerfil::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BasePubChannelPerfil
