<?php

/**
 * Base class that represents a row from the 'widget' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseWidget extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        WidgetPeer
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
	 * The value for the widget_type_id field.
	 * @var        int
	 */
	protected $widget_type_id;


	/**
	 * The value for the configurable field.
	 * @var        boolean
	 */
	protected $configurable = true;

	/**
	 * @var        WidgetType
	 */
	protected $aWidgetType;

	/**
	 * Collection to store aggregation of collWidgetI18ns.
	 * @var        array
	 */
	protected $collWidgetI18ns;

	/**
	 * The criteria used to select the current contents of collWidgetI18ns.
	 * @var        Criteria
	 */
	protected $lastWidgetI18nCriteria = null;

	/**
	 * Collection to store aggregation of collElementWidgets.
	 * @var        array
	 */
	protected $collElementWidgets;

	/**
	 * The criteria used to select the current contents of collElementWidgets.
	 * @var        Criteria
	 */
	protected $lastElementWidgetCriteria = null;

	/**
	 * Collection to store aggregation of collWidgetTemplates.
	 * @var        array
	 */
	protected $collWidgetTemplates;

	/**
	 * The criteria used to select the current contents of collWidgetTemplates.
	 * @var        Criteria
	 */
	protected $lastWidgetTemplateCriteria = null;

	/**
	 * Collection to store aggregation of collWidgetConstants.
	 * @var        array
	 */
	protected $collWidgetConstants;

	/**
	 * The criteria used to select the current contents of collWidgetConstants.
	 * @var        Criteria
	 */
	protected $lastWidgetConstantCriteria = null;

	/**
	 * Collection to store aggregation of collWidgetModules.
	 * @var        array
	 */
	protected $collWidgetModules;

	/**
	 * The criteria used to select the current contents of collWidgetModules.
	 * @var        Criteria
	 */
	protected $lastWidgetModuleCriteria = null;

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
	 * Get the [widget_type_id] column value.
	 * 
	 * @return     int
	 */
	public function getWidgetTypeId()
	{

		return $this->widget_type_id;
	}

	/**
	 * Get the [configurable] column value.
	 * 
	 * @return     boolean
	 */
	public function getConfigurable()
	{

		return $this->configurable;
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
			$this->modifiedColumns[] = WidgetPeer::ID;
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
			$this->modifiedColumns[] = WidgetPeer::NAME;
		}

	} // setName()

	/**
	 * Set the value of [widget_type_id] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setWidgetTypeId($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->widget_type_id !== $v) {
			$this->widget_type_id = $v;
			$this->modifiedColumns[] = WidgetPeer::WIDGET_TYPE_ID;
		}

		if ($this->aWidgetType !== null && $this->aWidgetType->getId() !== $v) {
			$this->aWidgetType = null;
		}

	} // setWidgetTypeId()

	/**
	 * Set the value of [configurable] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setConfigurable($v)
	{

		if ($this->configurable !== $v || $v === true) {
			$this->configurable = $v;
			$this->modifiedColumns[] = WidgetPeer::CONFIGURABLE;
		}

	} // setConfigurable()

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

			$this->widget_type_id = $rs->getInt($startcol + 2);

			$this->configurable = $rs->getBoolean($startcol + 3);

			$this->resetModified();

			$this->setNew(false);
			$this->setCulture(sfContext::getInstance()->getUser()->getCulture());

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 4; // 4 = WidgetPeer::NUM_COLUMNS - WidgetPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Widget object", $e);
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

    foreach (sfMixer::getCallables('BaseWidget:delete:pre') as $callable)
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
			$con = Propel::getConnection(WidgetPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			WidgetPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseWidget:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseWidget:save:pre') as $callable)
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
			$con = Propel::getConnection(WidgetPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseWidget:save:post') as $callable)
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

			if ($this->aWidgetType !== null) {
				if ($this->aWidgetType->isModified()) {
					$affectedRows += $this->aWidgetType->save($con);
				}
				$this->setWidgetType($this->aWidgetType);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = WidgetPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += WidgetPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collWidgetI18ns !== null) {
				foreach($this->collWidgetI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collElementWidgets !== null) {
				foreach($this->collElementWidgets as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collWidgetTemplates !== null) {
				foreach($this->collWidgetTemplates as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collWidgetConstants !== null) {
				foreach($this->collWidgetConstants as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collWidgetModules !== null) {
				foreach($this->collWidgetModules as $referrerFK) {
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

			if ($this->aWidgetType !== null) {
				if (!$this->aWidgetType->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aWidgetType->getValidationFailures());
				}
			}


			if (($retval = WidgetPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collWidgetI18ns !== null) {
					foreach($this->collWidgetI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collElementWidgets !== null) {
					foreach($this->collElementWidgets as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWidgetTemplates !== null) {
					foreach($this->collWidgetTemplates as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWidgetConstants !== null) {
					foreach($this->collWidgetConstants as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collWidgetModules !== null) {
					foreach($this->collWidgetModules as $referrerFK) {
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
		$pos = WidgetPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getWidgetTypeId();
				break;
			case 3:
				return $this->getConfigurable();
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
		$keys = WidgetPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getWidgetTypeId(),
			$keys[3] => $this->getConfigurable(),
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
		$pos = WidgetPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setWidgetTypeId($value);
				break;
			case 3:
				$this->setConfigurable($value);
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
		$keys = WidgetPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setWidgetTypeId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setConfigurable($arr[$keys[3]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(WidgetPeer::DATABASE_NAME);

		if ($this->isColumnModified(WidgetPeer::ID)) $criteria->add(WidgetPeer::ID, $this->id);
		if ($this->isColumnModified(WidgetPeer::NAME)) $criteria->add(WidgetPeer::NAME, $this->name);
		if ($this->isColumnModified(WidgetPeer::WIDGET_TYPE_ID)) $criteria->add(WidgetPeer::WIDGET_TYPE_ID, $this->widget_type_id);
		if ($this->isColumnModified(WidgetPeer::CONFIGURABLE)) $criteria->add(WidgetPeer::CONFIGURABLE, $this->configurable);

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
		$criteria = new Criteria(WidgetPeer::DATABASE_NAME);

		$criteria->add(WidgetPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Widget (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);

		$copyObj->setWidgetTypeId($this->widget_type_id);

		$copyObj->setConfigurable($this->configurable);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getWidgetI18ns() as $relObj) {
				$copyObj->addWidgetI18n($relObj->copy($deepCopy));
			}

			foreach($this->getElementWidgets() as $relObj) {
				$copyObj->addElementWidget($relObj->copy($deepCopy));
			}

			foreach($this->getWidgetTemplates() as $relObj) {
				$copyObj->addWidgetTemplate($relObj->copy($deepCopy));
			}

			foreach($this->getWidgetConstants() as $relObj) {
				$copyObj->addWidgetConstant($relObj->copy($deepCopy));
			}

			foreach($this->getWidgetModules() as $relObj) {
				$copyObj->addWidgetModule($relObj->copy($deepCopy));
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
	 * @return     Widget Clone of current object.
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
	 * @return     WidgetPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new WidgetPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a WidgetType object.
	 *
	 * @param      WidgetType $v
	 * @return     void
	 * @throws     PropelException
	 */
	public function setWidgetType($v)
	{


		if ($v === null) {
			$this->setWidgetTypeId(NULL);
		} else {
			$this->setWidgetTypeId($v->getId());
		}


		$this->aWidgetType = $v;
	}


	/**
	 * Get the associated WidgetType object
	 *
	 * @param      Connection Optional Connection object.
	 * @return     WidgetType The associated WidgetType object.
	 * @throws     PropelException
	 */
	public function getWidgetType($con = null)
	{
		if ($this->aWidgetType === null && ($this->widget_type_id !== null)) {
			// include the related Peer class
			include_once 'lib/model/om/BaseWidgetTypePeer.php';

			$this->aWidgetType = WidgetTypePeer::retrieveByPK($this->widget_type_id, $con);

			/* The following can be used instead of the line above to
			   guarantee the related object contains a reference
			   to this object, but this level of coupling
			   may be undesirable in many circumstances.
			   As it can lead to a db query with many results that may
			   never be used.
			   $obj = WidgetTypePeer::retrieveByPK($this->widget_type_id, $con);
			   $obj->addWidgetTypes($this);
			 */
		}
		return $this->aWidgetType;
	}

	/**
	 * Temporary storage of collWidgetI18ns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initWidgetI18ns()
	{
		if ($this->collWidgetI18ns === null) {
			$this->collWidgetI18ns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Widget has previously
	 * been saved, it will retrieve related WidgetI18ns from storage.
	 * If this Widget is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getWidgetI18ns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseWidgetI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWidgetI18ns === null) {
			if ($this->isNew()) {
			   $this->collWidgetI18ns = array();
			} else {

				$criteria->add(WidgetI18nPeer::ID, $this->getId());

				WidgetI18nPeer::addSelectColumns($criteria);
				$this->collWidgetI18ns = WidgetI18nPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(WidgetI18nPeer::ID, $this->getId());

				WidgetI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastWidgetI18nCriteria) || !$this->lastWidgetI18nCriteria->equals($criteria)) {
					$this->collWidgetI18ns = WidgetI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWidgetI18nCriteria = $criteria;
		return $this->collWidgetI18ns;
	}

	/**
	 * Returns the number of related WidgetI18ns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countWidgetI18ns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseWidgetI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(WidgetI18nPeer::ID, $this->getId());

		return WidgetI18nPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a WidgetI18n object to this object
	 * through the WidgetI18n foreign key attribute
	 *
	 * @param      WidgetI18n $l WidgetI18n
	 * @return     void
	 * @throws     PropelException
	 */
	public function addWidgetI18n(WidgetI18n $l)
	{
		$this->collWidgetI18ns[] = $l;
		$l->setWidget($this);
	}

	/**
	 * Temporary storage of collElementWidgets to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initElementWidgets()
	{
		if ($this->collElementWidgets === null) {
			$this->collElementWidgets = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Widget has previously
	 * been saved, it will retrieve related ElementWidgets from storage.
	 * If this Widget is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getElementWidgets($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseElementWidgetPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collElementWidgets === null) {
			if ($this->isNew()) {
			   $this->collElementWidgets = array();
			} else {

				$criteria->add(ElementWidgetPeer::WIDGET_ID, $this->getId());

				ElementWidgetPeer::addSelectColumns($criteria);
				$this->collElementWidgets = ElementWidgetPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(ElementWidgetPeer::WIDGET_ID, $this->getId());

				ElementWidgetPeer::addSelectColumns($criteria);
				if (!isset($this->lastElementWidgetCriteria) || !$this->lastElementWidgetCriteria->equals($criteria)) {
					$this->collElementWidgets = ElementWidgetPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastElementWidgetCriteria = $criteria;
		return $this->collElementWidgets;
	}

	/**
	 * Returns the number of related ElementWidgets.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countElementWidgets($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseElementWidgetPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ElementWidgetPeer::WIDGET_ID, $this->getId());

		return ElementWidgetPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a ElementWidget object to this object
	 * through the ElementWidget foreign key attribute
	 *
	 * @param      ElementWidget $l ElementWidget
	 * @return     void
	 * @throws     PropelException
	 */
	public function addElementWidget(ElementWidget $l)
	{
		$this->collElementWidgets[] = $l;
		$l->setWidget($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Widget is new, it will return
	 * an empty collection; or if this Widget has previously
	 * been saved, it will retrieve related ElementWidgets from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Widget.
	 */
	public function getElementWidgetsJoinBarWidget($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseElementWidgetPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collElementWidgets === null) {
			if ($this->isNew()) {
				$this->collElementWidgets = array();
			} else {

				$criteria->add(ElementWidgetPeer::WIDGET_ID, $this->getId());

				$this->collElementWidgets = ElementWidgetPeer::doSelectJoinBarWidget($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(ElementWidgetPeer::WIDGET_ID, $this->getId());

			if (!isset($this->lastElementWidgetCriteria) || !$this->lastElementWidgetCriteria->equals($criteria)) {
				$this->collElementWidgets = ElementWidgetPeer::doSelectJoinBarWidget($criteria, $con);
			}
		}
		$this->lastElementWidgetCriteria = $criteria;

		return $this->collElementWidgets;
	}

	/**
	 * Temporary storage of collWidgetTemplates to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initWidgetTemplates()
	{
		if ($this->collWidgetTemplates === null) {
			$this->collWidgetTemplates = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Widget has previously
	 * been saved, it will retrieve related WidgetTemplates from storage.
	 * If this Widget is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getWidgetTemplates($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseWidgetTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWidgetTemplates === null) {
			if ($this->isNew()) {
			   $this->collWidgetTemplates = array();
			} else {

				$criteria->add(WidgetTemplatePeer::WIDGET_ID, $this->getId());

				WidgetTemplatePeer::addSelectColumns($criteria);
				$this->collWidgetTemplates = WidgetTemplatePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(WidgetTemplatePeer::WIDGET_ID, $this->getId());

				WidgetTemplatePeer::addSelectColumns($criteria);
				if (!isset($this->lastWidgetTemplateCriteria) || !$this->lastWidgetTemplateCriteria->equals($criteria)) {
					$this->collWidgetTemplates = WidgetTemplatePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWidgetTemplateCriteria = $criteria;
		return $this->collWidgetTemplates;
	}

	/**
	 * Returns the number of related WidgetTemplates.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countWidgetTemplates($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseWidgetTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(WidgetTemplatePeer::WIDGET_ID, $this->getId());

		return WidgetTemplatePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a WidgetTemplate object to this object
	 * through the WidgetTemplate foreign key attribute
	 *
	 * @param      WidgetTemplate $l WidgetTemplate
	 * @return     void
	 * @throws     PropelException
	 */
	public function addWidgetTemplate(WidgetTemplate $l)
	{
		$this->collWidgetTemplates[] = $l;
		$l->setWidget($this);
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Widget has previously
	 * been saved, it will retrieve related WidgetTemplates from storage.
	 * If this Widget is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getWidgetTemplatesWithI18n($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseWidgetTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWidgetTemplates === null) {
			if ($this->isNew()) {
			   $this->collWidgetTemplates = array();
			} else {

				$criteria->add(WidgetTemplatePeer::WIDGET_ID, $this->getId());

				$this->collWidgetTemplates = WidgetTemplatePeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(WidgetTemplatePeer::WIDGET_ID, $this->getId());

				if (!isset($this->lastWidgetTemplateCriteria) || !$this->lastWidgetTemplateCriteria->equals($criteria)) {
					$this->collWidgetTemplates = WidgetTemplatePeer::doSelectWithI18n($criteria, $this->getCulture(), $con);
				}
			}
		}
		$this->lastWidgetTemplateCriteria = $criteria;
		return $this->collWidgetTemplates;
	}

	/**
	 * Temporary storage of collWidgetConstants to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initWidgetConstants()
	{
		if ($this->collWidgetConstants === null) {
			$this->collWidgetConstants = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Widget has previously
	 * been saved, it will retrieve related WidgetConstants from storage.
	 * If this Widget is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getWidgetConstants($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseWidgetConstantPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWidgetConstants === null) {
			if ($this->isNew()) {
			   $this->collWidgetConstants = array();
			} else {

				$criteria->add(WidgetConstantPeer::WIDGET_ID, $this->getId());

				WidgetConstantPeer::addSelectColumns($criteria);
				$this->collWidgetConstants = WidgetConstantPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(WidgetConstantPeer::WIDGET_ID, $this->getId());

				WidgetConstantPeer::addSelectColumns($criteria);
				if (!isset($this->lastWidgetConstantCriteria) || !$this->lastWidgetConstantCriteria->equals($criteria)) {
					$this->collWidgetConstants = WidgetConstantPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWidgetConstantCriteria = $criteria;
		return $this->collWidgetConstants;
	}

	/**
	 * Returns the number of related WidgetConstants.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countWidgetConstants($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseWidgetConstantPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(WidgetConstantPeer::WIDGET_ID, $this->getId());

		return WidgetConstantPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a WidgetConstant object to this object
	 * through the WidgetConstant foreign key attribute
	 *
	 * @param      WidgetConstant $l WidgetConstant
	 * @return     void
	 * @throws     PropelException
	 */
	public function addWidgetConstant(WidgetConstant $l)
	{
		$this->collWidgetConstants[] = $l;
		$l->setWidget($this);
	}

	/**
	 * Temporary storage of collWidgetModules to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initWidgetModules()
	{
		if ($this->collWidgetModules === null) {
			$this->collWidgetModules = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Widget has previously
	 * been saved, it will retrieve related WidgetModules from storage.
	 * If this Widget is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getWidgetModules($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseWidgetModulePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collWidgetModules === null) {
			if ($this->isNew()) {
			   $this->collWidgetModules = array();
			} else {

				$criteria->add(WidgetModulePeer::WIDGET_ID, $this->getId());

				WidgetModulePeer::addSelectColumns($criteria);
				$this->collWidgetModules = WidgetModulePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(WidgetModulePeer::WIDGET_ID, $this->getId());

				WidgetModulePeer::addSelectColumns($criteria);
				if (!isset($this->lastWidgetModuleCriteria) || !$this->lastWidgetModuleCriteria->equals($criteria)) {
					$this->collWidgetModules = WidgetModulePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastWidgetModuleCriteria = $criteria;
		return $this->collWidgetModules;
	}

	/**
	 * Returns the number of related WidgetModules.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countWidgetModules($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseWidgetModulePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(WidgetModulePeer::WIDGET_ID, $this->getId());

		return WidgetModulePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a WidgetModule object to this object
	 * through the WidgetModule foreign key attribute
	 *
	 * @param      WidgetModule $l WidgetModule
	 * @return     void
	 * @throws     PropelException
	 */
	public function addWidgetModule(WidgetModule $l)
	{
		$this->collWidgetModules[] = $l;
		$l->setWidget($this);
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
    $obj = $this->getCurrentWidgetI18n();

    return ($obj ? $obj->getDescription() : null);
  }

  public function setDescription($value)
  {
    $this->getCurrentWidgetI18n()->setDescription($value);
  }

  protected $current_i18n = array();

  public function getCurrentWidgetI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = WidgetI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setWidgetI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setWidgetI18nForCulture(new WidgetI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setWidgetI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addWidgetI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseWidget:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseWidget::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseWidget
