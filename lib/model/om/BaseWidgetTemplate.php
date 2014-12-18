<?php

/**
 * Base class that represents a row from the 'widget_template' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseWidgetTemplate extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        WidgetTemplatePeer
	 */
	protected static $peer;


	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;


	/**
	 * The value for the widget_id field.
	 * @var        int
	 */
	protected $widget_id;


	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * @var        Widget
	 */
	protected $aWidget;

	/**
	 * Collection to store aggregation of collWidgetTemplateI18ns.
	 * @var        array
	 */
	protected $collWidgetTemplateI18ns;

	/**
	 * The criteria used to select the current contents of collWidgetTemplateI18ns.
	 * @var        Criteria
	 */
	protected $lastWidgetTemplateI18nCriteria = null;

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
	 * Get the [widget_id] column value.
	 * 
	 * @return     int
	 */
	public function getWidgetId()
	{

		return $this->widget_id;
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
			$this->modifiedColumns[] = WidgetTemplatePeer::ID;
		}

	} // setId()

	/**
	 * Set the value of [widget_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setWidgetId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->widget_id !== $v) {
			$this->widget_id = $v;
			$this->modifiedColumns[] = WidgetTemplatePeer::WIDGET_ID;
		}

		if ($this->aWidget !== null && $this->aWidget->getId() !== $v) {
			$this->aWidget = null;
		}

	} // setWidgetId()

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
			$this->modifiedColumns[] = WidgetTemplatePeer::NAME;
		}

	} // setName()

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

			$this->widget_id = $rs->getInt($startcol + 1);

			$this->name = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);
			$this->setCulture(sfContext::getInstance()->getUser()->getCulture());

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 3; // 3 = WidgetTemplatePeer::NUM_COLUMNS - WidgetTemplatePeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating WidgetTemplate object", $e);
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

    foreach (sfMixer::getCallables('BaseWidgetTemplate:delete:pre') as $callable)
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
			$con = Propel::getConnection(WidgetTemplatePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			WidgetTemplatePeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseWidgetTemplate:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseWidgetTemplate:save:pre') as $callable)
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
			$con = Propel::getConnection(WidgetTemplatePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseWidgetTemplate:save:post') as $callable)
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

			if ($this->aWidget !== null) {
				if ($this->aWidget->isModified() || $this->aWidget->getCurrentWidgetI18n()->isModified()) {
					$affectedRows += $this->aWidget->save($con);
				}
				$this->setWidget($this->aWidget);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WidgetTemplatePeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += WidgetTemplatePeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collWidgetTemplateI18ns !== null) {
				foreach($this->collWidgetTemplateI18ns as $referrerFK) {
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

			if ($this->aWidget !== null) {
				if (!$this->aWidget->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWidget->getValidationFailures());
				}
			}


			if (($retval = WidgetTemplatePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collWidgetTemplateI18ns !== null) {
					foreach($this->collWidgetTemplateI18ns as $referrerFK) {
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
		$pos = WidgetTemplatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getWidgetId();
				break;
			case 2:
				return $this->getName();
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
		$keys = WidgetTemplatePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getWidgetId(),
			$keys[2] => $this->getName(),
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
		$pos = WidgetTemplatePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setWidgetId($value);
				break;
			case 2:
				$this->setName($value);
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
		$keys = WidgetTemplatePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setWidgetId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(WidgetTemplatePeer::DATABASE_NAME);

		if ($this->isColumnModified(WidgetTemplatePeer::ID)) $criteria->add(WidgetTemplatePeer::ID, $this->id);
		if ($this->isColumnModified(WidgetTemplatePeer::WIDGET_ID)) $criteria->add(WidgetTemplatePeer::WIDGET_ID, $this->widget_id);
		if ($this->isColumnModified(WidgetTemplatePeer::NAME)) $criteria->add(WidgetTemplatePeer::NAME, $this->name);

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
		$criteria = new Criteria(WidgetTemplatePeer::DATABASE_NAME);

		$criteria->add(WidgetTemplatePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of WidgetTemplate (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setWidgetId($this->widget_id);

		$copyObj->setName($this->name);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getWidgetTemplateI18ns() as $relObj) {
				$copyObj->addWidgetTemplateI18n($relObj->copy($deepCopy));
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
	 * @return     WidgetTemplate Clone of current object.
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
	 * @return     WidgetTemplatePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new WidgetTemplatePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Widget object.
	 *
	 * @param      Widget $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setWidget($v)
	{


		if ($v === null) {
			$this->setWidgetId(NULL);
		} else {
			$this->setWidgetId($v->getId());
		}


		$this->aWidget = $v;
	}


	/**
	 * Get the associated Widget object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Widget The associated Widget object.
	 * @throws     PropelException
	 */
	public function getWidget($con = null)
	{
		if ($this->aWidget === null && ($this->widget_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseWidgetPeer.php';

			$this->aWidget = WidgetPeer::retrieveByPK($this->widget_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = WidgetPeer::retrieveByPK($this->widget_id, $con);
			   $obj->addWidgets($this);
			 */
		}
		return $this->aWidget;
	}


	/**
	 * Get the associated Widget object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     Widget The associated Widget object.
	 * @throws     PropelException
	 */
	public function getWidgetWithI18n($con = null)
	{
		if ($this->aWidget === null && ($this->widget_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseWidgetPeer.php';

			$this->aWidget = WidgetPeer::retrieveByPKWithI18n($this->widget_id, $this->getCulture(), $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = WidgetPeer::retrieveByPKWithI18n($this->widget_id, $this->getCulture(), $con);
			   $obj->addWidgets($this);
			 */
		}
		return $this->aWidget;
	}

	/**
	 * Temporary storage of collWidgetTemplateI18ns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initWidgetTemplateI18ns()
	{
		if ($this->collWidgetTemplateI18ns === null) {
			$this->collWidgetTemplateI18ns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this WidgetTemplate has previously
	 * been saved, it will retrieve related WidgetTemplateI18ns from storage.
	 * If this WidgetTemplate is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getWidgetTemplateI18ns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseWidgetTemplateI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWidgetTemplateI18ns === null) {
			if ($this->isNew()) {
			   $this->collWidgetTemplateI18ns = array();
			} else {

				$criteria->add(WidgetTemplateI18nPeer::ID, $this->getId());

				WidgetTemplateI18nPeer::addSelectColumns($criteria);
				$this->collWidgetTemplateI18ns = WidgetTemplateI18nPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(WidgetTemplateI18nPeer::ID, $this->getId());

				WidgetTemplateI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastWidgetTemplateI18nCriteria) || !$this->lastWidgetTemplateI18nCriteria->equals($criteria)) {
					$this->collWidgetTemplateI18ns = WidgetTemplateI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWidgetTemplateI18nCriteria = $criteria;
		return $this->collWidgetTemplateI18ns;
	}

	/**
	 * Returns the number of related WidgetTemplateI18ns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countWidgetTemplateI18ns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseWidgetTemplateI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(WidgetTemplateI18nPeer::ID, $this->getId());

		return WidgetTemplateI18nPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a WidgetTemplateI18n object to this object
	 * through the WidgetTemplateI18n foreign key attribute
	 *
	 * @param      WidgetTemplateI18n $l WidgetTemplateI18n
	 * @return     void
	 * @throws     PropelException
	 */
	public function addWidgetTemplateI18n(WidgetTemplateI18n $l)
	{
		$this->collWidgetTemplateI18ns[] = $l;
		$l->setWidgetTemplate($this);
	}

  public function getCulture()
  {
    return $this->culture;
  }

  public function setCulture($culture)
  {
    $this->culture = $culture;
  }

  public function getText()
  {
    $obj = $this->getCurrentWidgetTemplateI18n();

    return ($obj ? $obj->getText() : null);
  }

  public function setText($value)
  {
    $this->getCurrentWidgetTemplateI18n()->setText($value);
  }

  protected $current_i18n = array();

  public function getCurrentWidgetTemplateI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = WidgetTemplateI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setWidgetTemplateI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setWidgetTemplateI18nForCulture(new WidgetTemplateI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setWidgetTemplateI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addWidgetTemplateI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseWidgetTemplate:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseWidgetTemplate::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseWidgetTemplate
