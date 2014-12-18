<?php

/**
 * Base class that represents a row from the 'genre' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseGenre extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        GenrePeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the cod field.
	 * @var        string
	 */
	protected $cod;


	/**
	 * The value for the default_sel field.
	 * @var        boolean
	 */
	protected $default_sel = false;

	/**
	 * Collection to store aggregation of collGenreI18ns.
	 * @var        array
	 */
	protected $collGenreI18ns;

	/**
	 * The criteria used to select the current contents of collGenreI18ns.
	 * @var        Criteria
	 */
	protected $lastGenreI18nCriteria = null;

	/**
	 * Collection to store aggregation of collMms.
	 * @var        array
	 */
	protected $collMms;

	/**
	 * The criteria used to select the current contents of collMms.
	 * @var        Criteria
	 */
	protected $lastMmCriteria = null;

	/**
	 * Collection to store aggregation of collMmTemplates.
	 * @var        array
	 */
	protected $collMmTemplates;

	/**
	 * The criteria used to select the current contents of collMmTemplates.
	 * @var        Criteria
	 */
	protected $lastMmTemplateCriteria = null;

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
	 * Get the [cod] column value.
	 * 
	 * @return     string
	 */
	public function getCod()
	{

		return $this->cod;
	}

	/**
	 * Get the [default_sel] column value.
	 * 
	 * @return     boolean
	 */
	public function getDefaultSel()
	{

		return $this->default_sel;
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
			$this->modifiedColumns[] = GenrePeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [cod] column.
	 * 
	 * @param      string $v new value
	 * @return     void
	 */
	public function setCod($v)
	{

		// Since the native PHP type for this column is string,
		// we will cast the input to a string (if it is not).
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->cod !== $v) {
			$this->cod = $v;
			$this->modifiedColumns[] = GenrePeer::COD;
		}

	} // setCod()

	/**
	 * Set the value of [default_sel] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setDefaultSel($v)
	{

		if ($this->default_sel !== $v || $v === false) {
			$this->default_sel = $v;
			$this->modifiedColumns[] = GenrePeer::DEFAULT_SEL;
		}

	} // setDefaultSel()

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

			$this->cod = $rs->getString($startcol + 1);

			$this->default_sel = $rs->getBoolean($startcol + 2);

			$this->resetModified();

			$this->setNew(false);
			$this->setCulture(sfContext::getInstance()->getUser()->getCulture());

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 3; // 3 = GenrePeer::NUM_COLUMNS - GenrePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Genre object", $e);
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

    foreach (sfMixer::getCallables('BaseGenre:delete:pre') as $callable)
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
			$con = Propel::getConnection(GenrePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			GenrePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseGenre:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseGenre:save:pre') as $callable)
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
			$con = Propel::getConnection(GenrePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseGenre:save:post') as $callable)
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
					$pk = GenrePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += GenrePeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collGenreI18ns !== null) {
				foreach($this->collGenreI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMms !== null) {
				foreach($this->collMms as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMmTemplates !== null) {
				foreach($this->collMmTemplates as $referrerFK) {
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


			if (($retval = GenrePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collGenreI18ns !== null) {
					foreach($this->collGenreI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMms !== null) {
					foreach($this->collMms as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMmTemplates !== null) {
					foreach($this->collMmTemplates as $referrerFK) {
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
		$pos = GenrePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getCod();
				break;
			case 2:
				return $this->getDefaultSel();
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
		$keys = GenrePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCod(),
			$keys[2] => $this->getDefaultSel(),
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
		$pos = GenrePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setCod($value);
				break;
			case 2:
				$this->setDefaultSel($value);
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
		$keys = GenrePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCod($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDefaultSel($arr[$keys[2]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(GenrePeer::DATABASE_NAME);

		if ($this->isColumnModified(GenrePeer::ID)) $criteria->add(GenrePeer::ID, $this->id);
		if ($this->isColumnModified(GenrePeer::COD)) $criteria->add(GenrePeer::COD, $this->cod);
		if ($this->isColumnModified(GenrePeer::DEFAULT_SEL)) $criteria->add(GenrePeer::DEFAULT_SEL, $this->default_sel);

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
		$criteria = new Criteria(GenrePeer::DATABASE_NAME);

		$criteria->add(GenrePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Genre (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCod($this->cod);

		$copyObj->setDefaultSel($this->default_sel);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getGenreI18ns() as $relObj) {
				$copyObj->addGenreI18n($relObj->copy($deepCopy));
			}

			foreach($this->getMms() as $relObj) {
				$copyObj->addMm($relObj->copy($deepCopy));
			}

			foreach($this->getMmTemplates() as $relObj) {
				$copyObj->addMmTemplate($relObj->copy($deepCopy));
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
	 * @return     Genre Clone of current object.
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
	 * @return     GenrePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new GenrePeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collGenreI18ns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initGenreI18ns()
	{
		if ($this->collGenreI18ns === null) {
			$this->collGenreI18ns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Genre has previously
	 * been saved, it will retrieve related GenreI18ns from storage.
	 * If this Genre is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getGenreI18ns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseGenreI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGenreI18ns === null) {
			if ($this->isNew()) {
			   $this->collGenreI18ns = array();
			} else {

				$criteria->add(GenreI18nPeer::ID, $this->getId());

				GenreI18nPeer::addSelectColumns($criteria);
				$this->collGenreI18ns = GenreI18nPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(GenreI18nPeer::ID, $this->getId());

				GenreI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastGenreI18nCriteria) || !$this->lastGenreI18nCriteria->equals($criteria)) {
					$this->collGenreI18ns = GenreI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGenreI18nCriteria = $criteria;
		return $this->collGenreI18ns;
	}

	/**
	 * Returns the number of related GenreI18ns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countGenreI18ns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseGenreI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(GenreI18nPeer::ID, $this->getId());

		return GenreI18nPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a GenreI18n object to this object
	 * through the GenreI18n foreign key attribute
	 *
	 * @param      GenreI18n $l GenreI18n
	 * @return     void
	 * @throws     PropelException
	 */
	public function addGenreI18n(GenreI18n $l)
	{
		$this->collGenreI18ns[] = $l;
		$l->setGenre($this);
	}

	/**
	 * Temporary storage of collMms to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initMms()
	{
		if ($this->collMms === null) {
			$this->collMms = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Genre has previously
	 * been saved, it will retrieve related Mms from storage.
	 * If this Genre is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getMms($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMms === null) {
			if ($this->isNew()) {
			   $this->collMms = array();
			} else {

				$criteria->add(MmPeer::GENRE_ID, $this->getId());

				MmPeer::addSelectColumns($criteria);
				$this->collMms = MmPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmPeer::GENRE_ID, $this->getId());

				MmPeer::addSelectColumns($criteria);
				if (!isset($this->lastMmCriteria) || !$this->lastMmCriteria->equals($criteria)) {
					$this->collMms = MmPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMmCriteria = $criteria;
		return $this->collMms;
	}

	/**
	 * Returns the number of related Mms.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countMms($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MmPeer::GENRE_ID, $this->getId());

		return MmPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a Mm object to this object
	 * through the Mm foreign key attribute
	 *
	 * @param      Mm $l Mm
	 * @return     void
	 * @throws     PropelException
	 */
	public function addMm(Mm $l)
	{
		$this->collMms[] = $l;
		$l->setGenre($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Genre is new, it will return
	 * an empty collection; or if this Genre has previously
	 * been saved, it will retrieve related Mms from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Genre.
	 */
	public function getMmsJoinSerial($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMms === null) {
			if ($this->isNew()) {
				$this->collMms = array();
			} else {

				$criteria->add(MmPeer::GENRE_ID, $this->getId());

				$this->collMms = MmPeer::doSelectJoinSerial($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmPeer::GENRE_ID, $this->getId());

			if (!isset($this->lastMmCriteria) || !$this->lastMmCriteria->equals($criteria)) {
				$this->collMms = MmPeer::doSelectJoinSerial($criteria, $con);
			}
		}
		$this->lastMmCriteria = $criteria;

		return $this->collMms;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Genre is new, it will return
	 * an empty collection; or if this Genre has previously
	 * been saved, it will retrieve related Mms from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Genre.
	 */
	public function getMmsJoinPrecinct($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMms === null) {
			if ($this->isNew()) {
				$this->collMms = array();
			} else {

				$criteria->add(MmPeer::GENRE_ID, $this->getId());

				$this->collMms = MmPeer::doSelectJoinPrecinct($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmPeer::GENRE_ID, $this->getId());

			if (!isset($this->lastMmCriteria) || !$this->lastMmCriteria->equals($criteria)) {
				$this->collMms = MmPeer::doSelectJoinPrecinct($criteria, $con);
			}
		}
		$this->lastMmCriteria = $criteria;

		return $this->collMms;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Genre is new, it will return
	 * an empty collection; or if this Genre has previously
	 * been saved, it will retrieve related Mms from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Genre.
	 */
	public function getMmsJoinBroadcast($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMms === null) {
			if ($this->isNew()) {
				$this->collMms = array();
			} else {

				$criteria->add(MmPeer::GENRE_ID, $this->getId());

				$this->collMms = MmPeer::doSelectJoinBroadcast($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmPeer::GENRE_ID, $this->getId());

			if (!isset($this->lastMmCriteria) || !$this->lastMmCriteria->equals($criteria)) {
				$this->collMms = MmPeer::doSelectJoinBroadcast($criteria, $con);
			}
		}
		$this->lastMmCriteria = $criteria;

		return $this->collMms;
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Genre has previously
	 * been saved, it will retrieve related Mms from storage.
	 * If this Genre is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getMmsWithI18n($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMms === null) {
			if ($this->isNew()) {
			   $this->collMms = array();
			} else {

				$criteria->add(MmPeer::GENRE_ID, $this->getId());

				$this->collMms = MmPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmPeer::GENRE_ID, $this->getId());

				if (!isset($this->lastMmCriteria) || !$this->lastMmCriteria->equals($criteria)) {
					$this->collMms = MmPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
				}
			}
		}
		$this->lastMmCriteria = $criteria;
		return $this->collMms;
	}

	/**
	 * Temporary storage of collMmTemplates to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initMmTemplates()
	{
		if ($this->collMmTemplates === null) {
			$this->collMmTemplates = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Genre has previously
	 * been saved, it will retrieve related MmTemplates from storage.
	 * If this Genre is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getMmTemplates($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmTemplates === null) {
			if ($this->isNew()) {
			   $this->collMmTemplates = array();
			} else {

				$criteria->add(MmTemplatePeer::GENRE_ID, $this->getId());

				MmTemplatePeer::addSelectColumns($criteria);
				$this->collMmTemplates = MmTemplatePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmTemplatePeer::GENRE_ID, $this->getId());

				MmTemplatePeer::addSelectColumns($criteria);
				if (!isset($this->lastMmTemplateCriteria) || !$this->lastMmTemplateCriteria->equals($criteria)) {
					$this->collMmTemplates = MmTemplatePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMmTemplateCriteria = $criteria;
		return $this->collMmTemplates;
	}

	/**
	 * Returns the number of related MmTemplates.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countMmTemplates($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MmTemplatePeer::GENRE_ID, $this->getId());

		return MmTemplatePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a MmTemplate object to this object
	 * through the MmTemplate foreign key attribute
	 *
	 * @param      MmTemplate $l MmTemplate
	 * @return     void
	 * @throws     PropelException
	 */
	public function addMmTemplate(MmTemplate $l)
	{
		$this->collMmTemplates[] = $l;
		$l->setGenre($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Genre is new, it will return
	 * an empty collection; or if this Genre has previously
	 * been saved, it will retrieve related MmTemplates from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Genre.
	 */
	public function getMmTemplatesJoinSerial($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmTemplates === null) {
			if ($this->isNew()) {
				$this->collMmTemplates = array();
			} else {

				$criteria->add(MmTemplatePeer::GENRE_ID, $this->getId());

				$this->collMmTemplates = MmTemplatePeer::doSelectJoinSerial($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmTemplatePeer::GENRE_ID, $this->getId());

			if (!isset($this->lastMmTemplateCriteria) || !$this->lastMmTemplateCriteria->equals($criteria)) {
				$this->collMmTemplates = MmTemplatePeer::doSelectJoinSerial($criteria, $con);
			}
		}
		$this->lastMmTemplateCriteria = $criteria;

		return $this->collMmTemplates;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Genre is new, it will return
	 * an empty collection; or if this Genre has previously
	 * been saved, it will retrieve related MmTemplates from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Genre.
	 */
	public function getMmTemplatesJoinPrecinct($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmTemplates === null) {
			if ($this->isNew()) {
				$this->collMmTemplates = array();
			} else {

				$criteria->add(MmTemplatePeer::GENRE_ID, $this->getId());

				$this->collMmTemplates = MmTemplatePeer::doSelectJoinPrecinct($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmTemplatePeer::GENRE_ID, $this->getId());

			if (!isset($this->lastMmTemplateCriteria) || !$this->lastMmTemplateCriteria->equals($criteria)) {
				$this->collMmTemplates = MmTemplatePeer::doSelectJoinPrecinct($criteria, $con);
			}
		}
		$this->lastMmTemplateCriteria = $criteria;

		return $this->collMmTemplates;
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Genre is new, it will return
	 * an empty collection; or if this Genre has previously
	 * been saved, it will retrieve related MmTemplates from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Genre.
	 */
	public function getMmTemplatesJoinBroadcast($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmTemplates === null) {
			if ($this->isNew()) {
				$this->collMmTemplates = array();
			} else {

				$criteria->add(MmTemplatePeer::GENRE_ID, $this->getId());

				$this->collMmTemplates = MmTemplatePeer::doSelectJoinBroadcast($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmTemplatePeer::GENRE_ID, $this->getId());

			if (!isset($this->lastMmTemplateCriteria) || !$this->lastMmTemplateCriteria->equals($criteria)) {
				$this->collMmTemplates = MmTemplatePeer::doSelectJoinBroadcast($criteria, $con);
			}
		}
		$this->lastMmTemplateCriteria = $criteria;

		return $this->collMmTemplates;
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Genre has previously
	 * been saved, it will retrieve related MmTemplates from storage.
	 * If this Genre is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getMmTemplatesWithI18n($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseMmTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMmTemplates === null) {
			if ($this->isNew()) {
			   $this->collMmTemplates = array();
			} else {

				$criteria->add(MmTemplatePeer::GENRE_ID, $this->getId());

				$this->collMmTemplates = MmTemplatePeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmTemplatePeer::GENRE_ID, $this->getId());

				if (!isset($this->lastMmTemplateCriteria) || !$this->lastMmTemplateCriteria->equals($criteria)) {
					$this->collMmTemplates = MmTemplatePeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
				}
			}
		}
		$this->lastMmTemplateCriteria = $criteria;
		return $this->collMmTemplates;
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
    $obj = $this->getCurrentGenreI18n();

    return ($obj ? $obj->getName() : null);
  }

  public function setName($value)
  {
    $this->getCurrentGenreI18n()->setName($value);
  }

  protected $current_i18n = array();

  public function getCurrentGenreI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = GenreI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setGenreI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setGenreI18nForCulture(new GenreI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setGenreI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addGenreI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseGenre:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseGenre::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseGenre
