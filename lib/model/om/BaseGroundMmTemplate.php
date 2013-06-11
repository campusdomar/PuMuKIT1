<?php

/**
 * Base class that represents a row from the 'ground_mm_template' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseGroundMmTemplate extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        GroundMmTemplatePeer
	 */
	protected static $peer;


	/**
	 * The value for the ground_id field.
	 * @var        int
	 */
	protected $ground_id;


	/**
	 * The value for the mm_template_id field.
	 * @var        int
	 */
	protected $mm_template_id;


	/**
	 * The value for the rank field.
	 * @var        int
	 */
	protected $rank = 0;

	/**
	 * @var        Ground
	 */
	protected $aGround;

	/**
	 * @var        MmTemplate
	 */
	protected $aMmTemplate;

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
	 * Get the [ground_id] column value.
	 * 
	 * @return     int
	 */
	public function getGroundId()
	{

		return $this->ground_id;
	}

	/**
	 * Get the [mm_template_id] column value.
	 * 
	 * @return     int
	 */
	public function getMmTemplateId()
	{

		return $this->mm_template_id;
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
	 * Set the value of [ground_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setGroundId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ground_id !== $v) {
			$this->ground_id = $v;
			$this->modifiedColumns[] = GroundMmTemplatePeer::GROUND_ID;
		}

		if ($this->aGround !== null && $this->aGround->getId() !== $v) {
			$this->aGround = null;
		}

	} // setGroundId()

	/**
	 * Set the value of [mm_template_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setMmTemplateId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->mm_template_id !== $v) {
			$this->mm_template_id = $v;
			$this->modifiedColumns[] = GroundMmTemplatePeer::MM_TEMPLATE_ID;
		}

		if ($this->aMmTemplate !== null && $this->aMmTemplate->getId() !== $v) {
			$this->aMmTemplate = null;
		}

	} // setMmTemplateId()

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
			$this->modifiedColumns[] = GroundMmTemplatePeer::RANK;
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

			$this->ground_id = $rs->getInt($startcol + 0);

			$this->mm_template_id = $rs->getInt($startcol + 1);

			$this->rank = $rs->getInt($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 3; // 3 = GroundMmTemplatePeer::NUM_COLUMNS - GroundMmTemplatePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating GroundMmTemplate object", $e);
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

    foreach (sfMixer::getCallables('BaseGroundMmTemplate:delete:pre') as $callable)
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
			$con = Propel::getConnection(GroundMmTemplatePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			GroundMmTemplatePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseGroundMmTemplate:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseGroundMmTemplate:save:pre') as $callable)
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
			$con = Propel::getConnection(GroundMmTemplatePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseGroundMmTemplate:save:post') as $callable)
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

			if ($this->aGround !== null) {
				if ($this->aGround->isModified() || $this->aGround->getCurrentGroundI18n()->isModified()) {
					$affectedRows += $this->aGround->save($con);
				}
				$this->setGround($this->aGround);
			}

			if ($this->aMmTemplate !== null) {
				if ($this->aMmTemplate->isModified() || $this->aMmTemplate->getCurrentMmTemplateI18n()->isModified()) {
					$affectedRows += $this->aMmTemplate->save($con);
				}
				$this->setMmTemplate($this->aMmTemplate);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = GroundMmTemplatePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setNew(false);
				} else {
					$affectedRows += GroundMmTemplatePeer::doUpdate($this, $con);
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

			if ($this->aGround !== null) {
				if (!$this->aGround->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aGround->getValidationFailures());
				}
			}

			if ($this->aMmTemplate !== null) {
				if (!$this->aMmTemplate->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aMmTemplate->getValidationFailures());
				}
			}


			if (($retval = GroundMmTemplatePeer::doValidate($this, $columns)) !== true) {
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
		$pos = GroundMmTemplatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getGroundId();
				break;
			case 1:
				return $this->getMmTemplateId();
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
		$keys = GroundMmTemplatePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getGroundId(),
			$keys[1] => $this->getMmTemplateId(),
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
		$pos = GroundMmTemplatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setGroundId($value);
				break;
			case 1:
				$this->setMmTemplateId($value);
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
		$keys = GroundMmTemplatePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setGroundId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setMmTemplateId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRank($arr[$keys[2]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(GroundMmTemplatePeer::DATABASE_NAME);

		if ($this->isColumnModified(GroundMmTemplatePeer::GROUND_ID)) $criteria->add(GroundMmTemplatePeer::GROUND_ID, $this->ground_id);
		if ($this->isColumnModified(GroundMmTemplatePeer::MM_TEMPLATE_ID)) $criteria->add(GroundMmTemplatePeer::MM_TEMPLATE_ID, $this->mm_template_id);
		if ($this->isColumnModified(GroundMmTemplatePeer::RANK)) $criteria->add(GroundMmTemplatePeer::RANK, $this->rank);

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
		$criteria = new Criteria(GroundMmTemplatePeer::DATABASE_NAME);

		$criteria->add(GroundMmTemplatePeer::GROUND_ID, $this->ground_id);
		$criteria->add(GroundMmTemplatePeer::MM_TEMPLATE_ID, $this->mm_template_id);

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

		$pks[0] = $this->getGroundId();

		$pks[1] = $this->getMmTemplateId();

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

		$this->setGroundId($keys[0]);

		$this->setMmTemplateId($keys[1]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of GroundMmTemplate (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setRank($this->rank);


		$copyObj->setNew(true);

		$copyObj->setGroundId(NULL); // this is a pkey column, so set to default value

		$copyObj->setMmTemplateId(NULL); // this is a pkey column, so set to default value

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
	 * @return     GroundMmTemplate Clone of current object.
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
	 * @return     GroundMmTemplatePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new GroundMmTemplatePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Ground object.
	 *
	 * @param      Ground $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setGround($v)
	{


		if ($v === null) {
			$this->setGroundId(NULL);
		} else {
			$this->setGroundId($v->getId());
		}


		$this->aGround = $v;
	}


	/**
	 * Get the associated Ground object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Ground The associated Ground object.
	 * @throws     PropelException
	 */
	public function getGround($con = null)
	{
		if ($this->aGround === null && ($this->ground_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseGroundPeer.php';

			$this->aGround = GroundPeer::retrieveByPK($this->ground_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = GroundPeer::retrieveByPK($this->ground_id, $con);
			   $obj->addGrounds($this);
			 */
		}
		return $this->aGround;
	}


	/**
	 * Get the associated Ground object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Ground The associated Ground object.
	 * @throws     PropelException
	 */
	public function getGroundWithI18n($con = null)
	{
		if ($this->aGround === null && ($this->ground_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseGroundPeer.php';

			$this->aGround = GroundPeer::retrieveByPKWithI18n($this->ground_id, $this->getCulture(), $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = GroundPeer::retrieveByPKWithI18n($this->ground_id, $this->getCulture(), $con);
			   $obj->addGrounds($this);
			 */
		}
		return $this->aGround;
	}

	/**
	 * Declares an association between this object and a MmTemplate object.
	 *
	 * @param      MmTemplate $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setMmTemplate($v)
	{


		if ($v === null) {
			$this->setMmTemplateId(NULL);
		} else {
			$this->setMmTemplateId($v->getId());
		}


		$this->aMmTemplate = $v;
	}


	/**
	 * Get the associated MmTemplate object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     MmTemplate The associated MmTemplate object.
	 * @throws     PropelException
	 */
	public function getMmTemplate($con = null)
	{
		if ($this->aMmTemplate === null && ($this->mm_template_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseMmTemplatePeer.php';

			$this->aMmTemplate = MmTemplatePeer::retrieveByPK($this->mm_template_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = MmTemplatePeer::retrieveByPK($this->mm_template_id, $con);
			   $obj->addMmTemplates($this);
			 */
		}
		return $this->aMmTemplate;
	}


	/**
	 * Get the associated MmTemplate object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     MmTemplate The associated MmTemplate object.
	 * @throws     PropelException
	 */
	public function getMmTemplateWithI18n($con = null)
	{
		if ($this->aMmTemplate === null && ($this->mm_template_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseMmTemplatePeer.php';

			$this->aMmTemplate = MmTemplatePeer::retrieveByPKWithI18n($this->mm_template_id, $this->getCulture(), $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = MmTemplatePeer::retrieveByPKWithI18n($this->mm_template_id, $this->getCulture(), $con);
			   $obj->addMmTemplates($this);
			 */
		}
		return $this->aMmTemplate;
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

		$this->aGround = null;
		$this->aMmTemplate = null;
	}


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseGroundMmTemplate:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseGroundMmTemplate::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseGroundMmTemplate
