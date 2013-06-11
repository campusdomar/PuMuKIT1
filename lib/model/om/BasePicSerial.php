<?php

/**
 * Base class that represents a row from the 'pic_serial' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BasePicSerial extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PicSerialPeer
	 */
	protected static $peer;


	/**
	 * The value for the pic_id field.
	 * @var        int
	 */
	protected $pic_id;


	/**
	 * The value for the other_id field.
	 * @var        int
	 */
	protected $other_id;


	/**
	 * The value for the rank field.
	 * @var        int
	 */
	protected $rank = 0;

	/**
	 * @var        Pic
	 */
	protected $aPic;

	/**
	 * @var        Serial
	 */
	protected $aSerial;

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
	 * Get the [pic_id] column value.
	 * 
	 * @return     int
	 */
	public function getPicId()
	{

		return $this->pic_id;
	}

	/**
	 * Get the [other_id] column value.
	 * 
	 * @return     int
	 */
	public function getOtherId()
	{

		return $this->other_id;
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
	 * Set the value of [pic_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setPicId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->pic_id !== $v) {
			$this->pic_id = $v;
			$this->modifiedColumns[] = PicSerialPeer::PIC_ID;
		}

		if ($this->aPic !== null && $this->aPic->getId() !== $v) {
			$this->aPic = null;
		}

	} // setPicId()

	/**
	 * Set the value of [other_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setOtherId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->other_id !== $v) {
			$this->other_id = $v;
			$this->modifiedColumns[] = PicSerialPeer::OTHER_ID;
		}

		if ($this->aSerial !== null && $this->aSerial->getId() !== $v) {
			$this->aSerial = null;
		}

	} // setOtherId()

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
			$this->modifiedColumns[] = PicSerialPeer::RANK;
		}

	} // setRank()

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

			$this->pic_id = $rs->getInt($startcol + 0);

			$this->other_id = $rs->getInt($startcol + 1);

			$this->rank = $rs->getInt($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 3; // 3 = PicSerialPeer::NUM_COLUMNS - PicSerialPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating PicSerial object", $e);
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

    foreach (sfMixer::getCallables('BasePicSerial:delete:pre') as $callable)
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
			$con = Propel::getConnection(PicSerialPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PicSerialPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePicSerial:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BasePicSerial:save:pre') as $callable)
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
			$con = Propel::getConnection(PicSerialPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePicSerial:save:post') as $callable)
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

			if ($this->aPic !== null) {
				if ($this->aPic->isModified()) {
					$affectedRows += $this->aPic->save($con);
				}
				$this->setPic($this->aPic);
			}

			if ($this->aSerial !== null) {
				if ($this->aSerial->isModified() || $this->aSerial->getCurrentSerialI18n()->isModified()) {
					$affectedRows += $this->aSerial->save($con);
				}
				$this->setSerial($this->aSerial);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PicSerialPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += PicSerialPeer::doUpdate($this, $con);
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

			if ($this->aPic !== null) {
				if (!$this->aPic->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPic->getValidationFailures());
				}
			}

			if ($this->aSerial !== null) {
				if (!$this->aSerial->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSerial->getValidationFailures());
				}
			}


			if (($retval = PicSerialPeer::doValidate($this, $columns)) !== true) {
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
		$pos = PicSerialPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getPicId();
				break;
			case 1:
				return $this->getOtherId();
				break;
			case 2:
				return $this->getRank();
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
		$keys = PicSerialPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getPicId(),
			$keys[1] => $this->getOtherId(),
			$keys[2] => $this->getRank(),
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
		$pos = PicSerialPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setPicId($value);
				break;
			case 1:
				$this->setOtherId($value);
				break;
			case 2:
				$this->setRank($value);
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
		$keys = PicSerialPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setPicId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setOtherId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRank($arr[$keys[2]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PicSerialPeer::DATABASE_NAME);

		if ($this->isColumnModified(PicSerialPeer::PIC_ID)) $criteria->add(PicSerialPeer::PIC_ID, $this->pic_id);
		if ($this->isColumnModified(PicSerialPeer::OTHER_ID)) $criteria->add(PicSerialPeer::OTHER_ID, $this->other_id);
		if ($this->isColumnModified(PicSerialPeer::RANK)) $criteria->add(PicSerialPeer::RANK, $this->rank);

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
		$criteria = new Criteria(PicSerialPeer::DATABASE_NAME);

		$criteria->add(PicSerialPeer::PIC_ID, $this->pic_id);
		$criteria->add(PicSerialPeer::OTHER_ID, $this->other_id);

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

		$pks[0] = $this->getPicId();

		$pks[1] = $this->getOtherId();

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

		$this->setPicId($keys[0]);

		$this->setOtherId($keys[1]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of PicSerial (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setRank($this->rank);


		$copyObj->setNew(true);

		$copyObj->setPicId(NULL); // this is a pkey column, so set to default value

		$copyObj->setOtherId(NULL); // this is a pkey column, so set to default value

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
	 * @return     PicSerial Clone of current object.
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
	 * @return     PicSerialPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PicSerialPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Pic object.
	 *
	 * @param      Pic $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setPic($v)
	{


		if ($v === null) {
			$this->setPicId(NULL);
		} else {
			$this->setPicId($v->getId());
		}


		$this->aPic = $v;
	}


	/**
	 * Get the associated Pic object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Pic The associated Pic object.
	 * @throws     PropelException
	 */
	public function getPic($con = null)
	{
		if ($this->aPic === null && ($this->pic_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BasePicPeer.php';

			$this->aPic = PicPeer::retrieveByPK($this->pic_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = PicPeer::retrieveByPK($this->pic_id, $con);
			   $obj->addPics($this);
			 */
		}
		return $this->aPic;
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
			$this->setOtherId(NULL);
		} else {
			$this->setOtherId($v->getId());
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
		if ($this->aSerial === null && ($this->other_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseSerialPeer.php';

			$this->aSerial = SerialPeer::retrieveByPK($this->other_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = SerialPeer::retrieveByPK($this->other_id, $con);
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
		if ($this->aSerial === null && ($this->other_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseSerialPeer.php';

			$this->aSerial = SerialPeer::retrieveByPKWithI18n($this->other_id, $this->getCulture(), $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = SerialPeer::retrieveByPKWithI18n($this->other_id, $this->getCulture(), $con);
			   $obj->addSerials($this);
			 */
		}
		return $this->aSerial;
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

		$this->aPic = null;
		$this->aSerial = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePicSerial:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePicSerial::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BasePicSerial
