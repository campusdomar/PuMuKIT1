<?php

/**
 * Base class that represents a row from the 'pic' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BasePic extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        PicPeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the url field.
	 * @var        string
	 */
	protected $url;

	/**
	 * Collection to store aggregation of collPicPersons.
	 * @var        array
	 */
	protected $collPicPersons;

	/**
	 * The criteria used to select the current contents of collPicPersons.
	 * @var        Criteria
	 */
	protected $lastPicPersonCriteria = null;

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
	 * Get the [url] column value.
	 * 
	 * @return     string
	 */
	public function getUrl()
	{

		return $this->url;
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
			$this->modifiedColumns[] = PicPeer::ID;
		}

	} // setId()

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
			$this->modifiedColumns[] = PicPeer::URL;
		}

	} // setUrl()

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

			$this->url = $rs->getString($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 2; // 2 = PicPeer::NUM_COLUMNS - PicPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Pic object", $e);
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

    foreach (sfMixer::getCallables('BasePic:delete:pre') as $callable)
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
			$con = Propel::getConnection(PicPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PicPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BasePic:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BasePic:save:pre') as $callable)
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
			$con = Propel::getConnection(PicPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BasePic:save:post') as $callable)
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


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PicPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += PicPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collPicPersons !== null) {
				foreach($this->collPicPersons as $referrerFK) {
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

			if ($this->collPicMms !== null) {
				foreach($this->collPicMms as $referrerFK) {
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


			if (($retval = PicPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collPicPersons !== null) {
					foreach($this->collPicPersons as $referrerFK) {
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

				if ($this->collPicMms !== null) {
					foreach($this->collPicMms as $referrerFK) {
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
		$pos = PicPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getUrl();
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
		$keys = PicPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getUrl(),
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
		$pos = PicPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setUrl($value);
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
		$keys = PicPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUrl($arr[$keys[1]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(PicPeer::DATABASE_NAME);

		if ($this->isColumnModified(PicPeer::ID)) $criteria->add(PicPeer::ID, $this->id);
		if ($this->isColumnModified(PicPeer::URL)) $criteria->add(PicPeer::URL, $this->url);

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
		$criteria = new Criteria(PicPeer::DATABASE_NAME);

		$criteria->add(PicPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Pic (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUrl($this->url);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getPicPersons() as $relObj) {
				$copyObj->addPicPerson($relObj->copy($deepCopy));
			}

			foreach($this->getPicSerials() as $relObj) {
				$copyObj->addPicSerial($relObj->copy($deepCopy));
			}

			foreach($this->getPicMms() as $relObj) {
				$copyObj->addPicMm($relObj->copy($deepCopy));
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
	 * @return     Pic Clone of current object.
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
	 * @return     PicPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PicPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collPicPersons to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initPicPersons()
	{
		if ($this->collPicPersons === null) {
			$this->collPicPersons = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Pic has previously
	 * been saved, it will retrieve related PicPersons from storage.
	 * If this Pic is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getPicPersons($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePicPersonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPicPersons === null) {
			if ($this->isNew()) {
			   $this->collPicPersons = array();
			} else {

				$criteria->add(PicPersonPeer::PIC_ID, $this->getId());

				PicPersonPeer::addSelectColumns($criteria);
				$this->collPicPersons = PicPersonPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PicPersonPeer::PIC_ID, $this->getId());

				PicPersonPeer::addSelectColumns($criteria);
				if (!isset($this->lastPicPersonCriteria) || !$this->lastPicPersonCriteria->equals($criteria)) {
					$this->collPicPersons = PicPersonPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPicPersonCriteria = $criteria;
		return $this->collPicPersons;
	}

	/**
	 * Returns the number of related PicPersons.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countPicPersons($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePicPersonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PicPersonPeer::PIC_ID, $this->getId());

		return PicPersonPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a PicPerson object to this object
	 * through the PicPerson foreign key attribute
	 *
	 * @param      PicPerson $l PicPerson
	 * @return     void
	 * @throws     PropelException
	 */
	public function addPicPerson(PicPerson $l)
	{
		$this->collPicPersons[] = $l;
		$l->setPic($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Pic is new, it will return
	 * an empty collection; or if this Pic has previously
	 * been saved, it will retrieve related PicPersons from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Pic.
	 */
	public function getPicPersonsJoinPerson($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BasePicPersonPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPicPersons === null) {
			if ($this->isNew()) {
				$this->collPicPersons = array();
			} else {

				$criteria->add(PicPersonPeer::PIC_ID, $this->getId());

				$this->collPicPersons = PicPersonPeer::doSelectJoinPerson($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PicPersonPeer::PIC_ID, $this->getId());

			if (!isset($this->lastPicPersonCriteria) || !$this->lastPicPersonCriteria->equals($criteria)) {
				$this->collPicPersons = PicPersonPeer::doSelectJoinPerson($criteria, $con);
			}
		}
		$this->lastPicPersonCriteria = $criteria;

		return $this->collPicPersons;
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
	 * Otherwise if this Pic has previously
	 * been saved, it will retrieve related PicSerials from storage.
	 * If this Pic is new, it will return
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

				$criteria->add(PicSerialPeer::PIC_ID, $this->getId());

				PicSerialPeer::addSelectColumns($criteria);
				$this->collPicSerials = PicSerialPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PicSerialPeer::PIC_ID, $this->getId());

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

		$criteria->add(PicSerialPeer::PIC_ID, $this->getId());

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
		$l->setPic($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Pic is new, it will return
	 * an empty collection; or if this Pic has previously
	 * been saved, it will retrieve related PicSerials from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Pic.
	 */
	public function getPicSerialsJoinSerial($criteria = null, $con = null)
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

				$criteria->add(PicSerialPeer::PIC_ID, $this->getId());

				$this->collPicSerials = PicSerialPeer::doSelectJoinSerial($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PicSerialPeer::PIC_ID, $this->getId());

			if (!isset($this->lastPicSerialCriteria) || !$this->lastPicSerialCriteria->equals($criteria)) {
				$this->collPicSerials = PicSerialPeer::doSelectJoinSerial($criteria, $con);
			}
		}
		$this->lastPicSerialCriteria = $criteria;

		return $this->collPicSerials;
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
	 * Otherwise if this Pic has previously
	 * been saved, it will retrieve related PicMms from storage.
	 * If this Pic is new, it will return
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

				$criteria->add(PicMmPeer::PIC_ID, $this->getId());

				PicMmPeer::addSelectColumns($criteria);
				$this->collPicMms = PicMmPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(PicMmPeer::PIC_ID, $this->getId());

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

		$criteria->add(PicMmPeer::PIC_ID, $this->getId());

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
		$l->setPic($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Pic is new, it will return
	 * an empty collection; or if this Pic has previously
	 * been saved, it will retrieve related PicMms from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Pic.
	 */
	public function getPicMmsJoinMm($criteria = null, $con = null)
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

				$criteria->add(PicMmPeer::PIC_ID, $this->getId());

				$this->collPicMms = PicMmPeer::doSelectJoinMm($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(PicMmPeer::PIC_ID, $this->getId());

			if (!isset($this->lastPicMmCriteria) || !$this->lastPicMmCriteria->equals($criteria)) {
				$this->collPicMms = PicMmPeer::doSelectJoinMm($criteria, $con);
			}
		}
		$this->lastPicMmCriteria = $criteria;

		return $this->collPicMms;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BasePic:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BasePic::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BasePic
