<?php

/**
 * Base class that represents a row from the 'language' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseLanguage extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        LanguagePeer
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
	 * Collection to store aggregation of collLanguageI18ns.
	 * @var        array
	 */
	protected $collLanguageI18ns;

	/**
	 * The criteria used to select the current contents of collLanguageI18ns.
	 * @var        Criteria
	 */
	protected $lastLanguageI18nCriteria = null;

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
			$this->modifiedColumns[] = LanguagePeer::ID;
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
			$this->modifiedColumns[] = LanguagePeer::COD;
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
			$this->modifiedColumns[] = LanguagePeer::DEFAULT_SEL;
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
			return $startcol + 3; // 3 = LanguagePeer::NUM_COLUMNS - LanguagePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Language object", $e);
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

    foreach (sfMixer::getCallables('BaseLanguage:delete:pre') as $callable)
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
			$con = Propel::getConnection(LanguagePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			LanguagePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseLanguage:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseLanguage:save:pre') as $callable)
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
			$con = Propel::getConnection(LanguagePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseLanguage:save:post') as $callable)
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
					$pk = LanguagePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += LanguagePeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collLanguageI18ns !== null) {
				foreach($this->collLanguageI18ns as $referrerFK) {
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

			if ($this->collMmMatterhorns !== null) {
				foreach($this->collMmMatterhorns as $referrerFK) {
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


			if (($retval = LanguagePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collLanguageI18ns !== null) {
					foreach($this->collLanguageI18ns as $referrerFK) {
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

				if ($this->collMmMatterhorns !== null) {
					foreach($this->collMmMatterhorns as $referrerFK) {
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
		$pos = LanguagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
		$keys = LanguagePeer::getFieldNames($keyType);
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
		$pos = LanguagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
		$keys = LanguagePeer::getFieldNames($keyType);

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
		$criteria = new Criteria(LanguagePeer::DATABASE_NAME);

		if ($this->isColumnModified(LanguagePeer::ID)) $criteria->add(LanguagePeer::ID, $this->id);
		if ($this->isColumnModified(LanguagePeer::COD)) $criteria->add(LanguagePeer::COD, $this->cod);
		if ($this->isColumnModified(LanguagePeer::DEFAULT_SEL)) $criteria->add(LanguagePeer::DEFAULT_SEL, $this->default_sel);

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
		$criteria = new Criteria(LanguagePeer::DATABASE_NAME);

		$criteria->add(LanguagePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Language (or compatible) type.
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

			foreach($this->getLanguageI18ns() as $relObj) {
				$copyObj->addLanguageI18n($relObj->copy($deepCopy));
			}

			foreach($this->getFiles() as $relObj) {
				$copyObj->addFile($relObj->copy($deepCopy));
			}

			foreach($this->getLogTranscodings() as $relObj) {
				$copyObj->addLogTranscoding($relObj->copy($deepCopy));
			}

			foreach($this->getTranscodings() as $relObj) {
				$copyObj->addTranscoding($relObj->copy($deepCopy));
			}

			foreach($this->getMmMatterhorns() as $relObj) {
				$copyObj->addMmMatterhorn($relObj->copy($deepCopy));
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
	 * @return     Language Clone of current object.
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
	 * @return     LanguagePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new LanguagePeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collLanguageI18ns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initLanguageI18ns()
	{
		if ($this->collLanguageI18ns === null) {
			$this->collLanguageI18ns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Language has previously
	 * been saved, it will retrieve related LanguageI18ns from storage.
	 * If this Language is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getLanguageI18ns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseLanguageI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collLanguageI18ns === null) {
			if ($this->isNew()) {
			   $this->collLanguageI18ns = array();
			} else {

				$criteria->add(LanguageI18nPeer::ID, $this->getId());

				LanguageI18nPeer::addSelectColumns($criteria);
				$this->collLanguageI18ns = LanguageI18nPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(LanguageI18nPeer::ID, $this->getId());

				LanguageI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastLanguageI18nCriteria) || !$this->lastLanguageI18nCriteria->equals($criteria)) {
					$this->collLanguageI18ns = LanguageI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastLanguageI18nCriteria = $criteria;
		return $this->collLanguageI18ns;
	}

	/**
	 * Returns the number of related LanguageI18ns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countLanguageI18ns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseLanguageI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(LanguageI18nPeer::ID, $this->getId());

		return LanguageI18nPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a LanguageI18n object to this object
	 * through the LanguageI18n foreign key attribute
	 *
	 * @param      LanguageI18n $l LanguageI18n
	 * @return     void
	 * @throws     PropelException
	 */
	public function addLanguageI18n(LanguageI18n $l)
	{
		$this->collLanguageI18ns[] = $l;
		$l->setLanguage($this);
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
	 * Otherwise if this Language has previously
	 * been saved, it will retrieve related Files from storage.
	 * If this Language is new, it will return
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

				$criteria->add(FilePeer::LANGUAGE_ID, $this->getId());

				FilePeer::addSelectColumns($criteria);
				$this->collFiles = FilePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FilePeer::LANGUAGE_ID, $this->getId());

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

		$criteria->add(FilePeer::LANGUAGE_ID, $this->getId());

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
		$l->setLanguage($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Language is new, it will return
	 * an empty collection; or if this Language has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Language.
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

				$criteria->add(FilePeer::LANGUAGE_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectJoinMm($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FilePeer::LANGUAGE_ID, $this->getId());

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
	 * Otherwise if this Language is new, it will return
	 * an empty collection; or if this Language has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Language.
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

				$criteria->add(FilePeer::LANGUAGE_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectJoinPerfil($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FilePeer::LANGUAGE_ID, $this->getId());

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
	 * Otherwise if this Language is new, it will return
	 * an empty collection; or if this Language has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Language.
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

				$criteria->add(FilePeer::LANGUAGE_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectJoinFormat($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FilePeer::LANGUAGE_ID, $this->getId());

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
	 * Otherwise if this Language is new, it will return
	 * an empty collection; or if this Language has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Language.
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

				$criteria->add(FilePeer::LANGUAGE_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectJoinCodec($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FilePeer::LANGUAGE_ID, $this->getId());

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
	 * Otherwise if this Language is new, it will return
	 * an empty collection; or if this Language has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Language.
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

				$criteria->add(FilePeer::LANGUAGE_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectJoinMimeType($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FilePeer::LANGUAGE_ID, $this->getId());

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
	 * Otherwise if this Language is new, it will return
	 * an empty collection; or if this Language has previously
	 * been saved, it will retrieve related Files from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Language.
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

				$criteria->add(FilePeer::LANGUAGE_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectJoinResolution($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(FilePeer::LANGUAGE_ID, $this->getId());

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
	 * Otherwise if this Language has previously
	 * been saved, it will retrieve related Files from storage.
	 * If this Language is new, it will return
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

				$criteria->add(FilePeer::LANGUAGE_ID, $this->getId());

				$this->collFiles = FilePeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(FilePeer::LANGUAGE_ID, $this->getId());

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
	 * Otherwise if this Language has previously
	 * been saved, it will retrieve related LogTranscodings from storage.
	 * If this Language is new, it will return
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

				$criteria->add(LogTranscodingPeer::LANGUAGE_ID, $this->getId());

				LogTranscodingPeer::addSelectColumns($criteria);
				$this->collLogTranscodings = LogTranscodingPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(LogTranscodingPeer::LANGUAGE_ID, $this->getId());

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

		$criteria->add(LogTranscodingPeer::LANGUAGE_ID, $this->getId());

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
		$l->setLanguage($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Language is new, it will return
	 * an empty collection; or if this Language has previously
	 * been saved, it will retrieve related LogTranscodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Language.
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

				$criteria->add(LogTranscodingPeer::LANGUAGE_ID, $this->getId());

				$this->collLogTranscodings = LogTranscodingPeer::doSelectJoinMm($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(LogTranscodingPeer::LANGUAGE_ID, $this->getId());

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
	 * Otherwise if this Language is new, it will return
	 * an empty collection; or if this Language has previously
	 * been saved, it will retrieve related LogTranscodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Language.
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

				$criteria->add(LogTranscodingPeer::LANGUAGE_ID, $this->getId());

				$this->collLogTranscodings = LogTranscodingPeer::doSelectJoinPerfil($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(LogTranscodingPeer::LANGUAGE_ID, $this->getId());

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
	 * Otherwise if this Language is new, it will return
	 * an empty collection; or if this Language has previously
	 * been saved, it will retrieve related LogTranscodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Language.
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

				$criteria->add(LogTranscodingPeer::LANGUAGE_ID, $this->getId());

				$this->collLogTranscodings = LogTranscodingPeer::doSelectJoinCpu($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(LogTranscodingPeer::LANGUAGE_ID, $this->getId());

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
	 * Otherwise if this Language has previously
	 * been saved, it will retrieve related Transcodings from storage.
	 * If this Language is new, it will return
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

				$criteria->add(TranscodingPeer::LANGUAGE_ID, $this->getId());

				TranscodingPeer::addSelectColumns($criteria);
				$this->collTranscodings = TranscodingPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TranscodingPeer::LANGUAGE_ID, $this->getId());

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

		$criteria->add(TranscodingPeer::LANGUAGE_ID, $this->getId());

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
		$l->setLanguage($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Language is new, it will return
	 * an empty collection; or if this Language has previously
	 * been saved, it will retrieve related Transcodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Language.
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

				$criteria->add(TranscodingPeer::LANGUAGE_ID, $this->getId());

				$this->collTranscodings = TranscodingPeer::doSelectJoinMm($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TranscodingPeer::LANGUAGE_ID, $this->getId());

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
	 * Otherwise if this Language is new, it will return
	 * an empty collection; or if this Language has previously
	 * been saved, it will retrieve related Transcodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Language.
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

				$criteria->add(TranscodingPeer::LANGUAGE_ID, $this->getId());

				$this->collTranscodings = TranscodingPeer::doSelectJoinPerfil($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TranscodingPeer::LANGUAGE_ID, $this->getId());

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
	 * Otherwise if this Language is new, it will return
	 * an empty collection; or if this Language has previously
	 * been saved, it will retrieve related Transcodings from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Language.
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

				$criteria->add(TranscodingPeer::LANGUAGE_ID, $this->getId());

				$this->collTranscodings = TranscodingPeer::doSelectJoinCpu($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(TranscodingPeer::LANGUAGE_ID, $this->getId());

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
	 * Otherwise if this Language has previously
	 * been saved, it will retrieve related Transcodings from storage.
	 * If this Language is new, it will return
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

				$criteria->add(TranscodingPeer::LANGUAGE_ID, $this->getId());

				$this->collTranscodings = TranscodingPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(TranscodingPeer::LANGUAGE_ID, $this->getId());

				if (!isset($this->lastTranscodingCriteria) || !$this->lastTranscodingCriteria->equals($criteria)) {
					$this->collTranscodings = TranscodingPeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
				}
			}
		}
		$this->lastTranscodingCriteria = $criteria;
		return $this->collTranscodings;
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
	 * Otherwise if this Language has previously
	 * been saved, it will retrieve related MmMatterhorns from storage.
	 * If this Language is new, it will return
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

				$criteria->add(MmMatterhornPeer::LANGUAGE_ID, $this->getId());

				MmMatterhornPeer::addSelectColumns($criteria);
				$this->collMmMatterhorns = MmMatterhornPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(MmMatterhornPeer::LANGUAGE_ID, $this->getId());

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

		$criteria->add(MmMatterhornPeer::LANGUAGE_ID, $this->getId());

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
		$l->setLanguage($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Language is new, it will return
	 * an empty collection; or if this Language has previously
	 * been saved, it will retrieve related MmMatterhorns from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Language.
	 */
	public function getMmMatterhornsJoinMm($criteria = null, $con = null)
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

				$criteria->add(MmMatterhornPeer::LANGUAGE_ID, $this->getId());

				$this->collMmMatterhorns = MmMatterhornPeer::doSelectJoinMm($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(MmMatterhornPeer::LANGUAGE_ID, $this->getId());

			if (!isset($this->lastMmMatterhornCriteria) || !$this->lastMmMatterhornCriteria->equals($criteria)) {
				$this->collMmMatterhorns = MmMatterhornPeer::doSelectJoinMm($criteria, $con);
			}
		}
		$this->lastMmMatterhornCriteria = $criteria;

		return $this->collMmMatterhorns;
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
    $obj = $this->getCurrentLanguageI18n();

    return ($obj ? $obj->getName() : null);
  }

  public function setName($value)
  {
    $this->getCurrentLanguageI18n()->setName($value);
  }

  protected $current_i18n = array();

  public function getCurrentLanguageI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = LanguageI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setLanguageI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setLanguageI18nForCulture(new LanguageI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setLanguageI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addLanguageI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseLanguage:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseLanguage::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseLanguage
