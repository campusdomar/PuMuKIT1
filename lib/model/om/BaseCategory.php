<?php

/**
 * Base class that represents a row from the 'category' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseCategory extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        CategoryPeer
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
	 * The value for the tree_left field.
	 * @var        int
	 */
	protected $tree_left;


	/**
	 * The value for the tree_right field.
	 * @var        int
	 */
	protected $tree_right;


	/**
	 * The value for the tree_parent field.
	 * @var        int
	 */
	protected $tree_parent;


	/**
	 * The value for the scope field.
	 * @var        int
	 */
	protected $scope;


	/**
	 * The value for the metacategory field.
	 * @var        boolean
	 */
	protected $metacategory = false;


	/**
	 * The value for the display field.
	 * @var        boolean
	 */
	protected $display = true;


	/**
	 * The value for the required field.
	 * @var        boolean
	 */
	protected $required = false;


	/**
	 * The value for the num_mm field.
	 * @var        int
	 */
	protected $num_mm = 0;

	/**
	 * Collection to store aggregation of collVirtualGroundRelations.
	 * @var        array
	 */
	protected $collVirtualGroundRelations;

	/**
	 * The criteria used to select the current contents of collVirtualGroundRelations.
	 * @var        Criteria
	 */
	protected $lastVirtualGroundRelationCriteria = null;

	/**
	 * Collection to store aggregation of collCategoryI18ns.
	 * @var        array
	 */
	protected $collCategoryI18ns;

	/**
	 * The criteria used to select the current contents of collCategoryI18ns.
	 * @var        Criteria
	 */
	protected $lastCategoryI18nCriteria = null;

	/**
	 * Collection to store aggregation of collRelationCategorysRelatedByOneId.
	 * @var        array
	 */
	protected $collRelationCategorysRelatedByOneId;

	/**
	 * The criteria used to select the current contents of collRelationCategorysRelatedByOneId.
	 * @var        Criteria
	 */
	protected $lastRelationCategoryRelatedByOneIdCriteria = null;

	/**
	 * Collection to store aggregation of collRelationCategorysRelatedByTwoId.
	 * @var        array
	 */
	protected $collRelationCategorysRelatedByTwoId;

	/**
	 * The criteria used to select the current contents of collRelationCategorysRelatedByTwoId.
	 * @var        Criteria
	 */
	protected $lastRelationCategoryRelatedByTwoIdCriteria = null;

	/**
	 * Collection to store aggregation of collCategoryMms.
	 * @var        array
	 */
	protected $collCategoryMms;

	/**
	 * The criteria used to select the current contents of collCategoryMms.
	 * @var        Criteria
	 */
	protected $lastCategoryMmCriteria = null;

	/**
	 * Collection to store aggregation of collCategoryMmTemplates.
	 * @var        array
	 */
	protected $collCategoryMmTemplates;

	/**
	 * The criteria used to select the current contents of collCategoryMmTemplates.
	 * @var        Criteria
	 */
	protected $lastCategoryMmTemplateCriteria = null;

	/**
	 * Collection to store aggregation of collCategoryMmTimeframes.
	 * @var        array
	 */
	protected $collCategoryMmTimeframes;

	/**
	 * The criteria used to select the current contents of collCategoryMmTimeframes.
	 * @var        Criteria
	 */
	protected $lastCategoryMmTimeframeCriteria = null;

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
	 * Get the [tree_left] column value.
	 * 
	 * @return     int
	 */
	public function getTreeLeft()
	{

		return $this->tree_left;
	}

	/**
	 * Get the [tree_right] column value.
	 * 
	 * @return     int
	 */
	public function getTreeRight()
	{

		return $this->tree_right;
	}

	/**
	 * Get the [tree_parent] column value.
	 * 
	 * @return     int
	 */
	public function getTreeParent()
	{

		return $this->tree_parent;
	}

	/**
	 * Get the [scope] column value.
	 * 
	 * @return     int
	 */
	public function getScope()
	{

		return $this->scope;
	}

	/**
	 * Get the [metacategory] column value.
	 * 
	 * @return     boolean
	 */
	public function getMetacategory()
	{

		return $this->metacategory;
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
	 * Get the [required] column value.
	 * 
	 * @return     boolean
	 */
	public function getRequired()
	{

		return $this->required;
	}

	/**
	 * Get the [num_mm] column value.
	 * 
	 * @return     int
	 */
	public function getNumMm()
	{

		return $this->num_mm;
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
			$this->modifiedColumns[] = CategoryPeer::ID;
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
			$this->modifiedColumns[] = CategoryPeer::COD;
		}

	} // setCod()

	/**
	 * Set the value of [tree_left] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setTreeLeft($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_left !== $v) {
			$this->tree_left = $v;
			$this->modifiedColumns[] = CategoryPeer::TREE_LEFT;
		}

	} // setTreeLeft()

	/**
	 * Set the value of [tree_right] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setTreeRight($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_right !== $v) {
			$this->tree_right = $v;
			$this->modifiedColumns[] = CategoryPeer::TREE_RIGHT;
		}

	} // setTreeRight()

	/**
	 * Set the value of [tree_parent] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setTreeParent($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->tree_parent !== $v) {
			$this->tree_parent = $v;
			$this->modifiedColumns[] = CategoryPeer::TREE_PARENT;
		}

	} // setTreeParent()

	/**
	 * Set the value of [scope] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setScope($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->scope !== $v) {
			$this->scope = $v;
			$this->modifiedColumns[] = CategoryPeer::SCOPE;
		}

	} // setScope()

	/**
	 * Set the value of [metacategory] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setMetacategory($v)
	{

		if ($this->metacategory !== $v || $v === false) {
			$this->metacategory = $v;
			$this->modifiedColumns[] = CategoryPeer::METACATEGORY;
		}

	} // setMetacategory()

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
			$this->modifiedColumns[] = CategoryPeer::DISPLAY;
		}

	} // setDisplay()

	/**
	 * Set the value of [required] column.
	 * 
	 * @param      boolean $v new value
	 * @return     void
	 */
	public function setRequired($v)
	{

		if ($this->required !== $v || $v === false) {
			$this->required = $v;
			$this->modifiedColumns[] = CategoryPeer::REQUIRED;
		}

	} // setRequired()

	/**
	 * Set the value of [num_mm] column.
	 * 
	 * @param      int $v new value
	 * @return     void
	 */
	public function setNumMm($v)
	{

		// Since the native PHP type for this column is integer,
		// we will cast the input value to an int (if it is not).
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->num_mm !== $v || $v === 0) {
			$this->num_mm = $v;
			$this->modifiedColumns[] = CategoryPeer::NUM_MM;
		}

	} // setNumMm()

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

			$this->tree_left = $rs->getInt($startcol + 2);

			$this->tree_right = $rs->getInt($startcol + 3);

			$this->tree_parent = $rs->getInt($startcol + 4);

			$this->scope = $rs->getInt($startcol + 5);

			$this->metacategory = $rs->getBoolean($startcol + 6);

			$this->display = $rs->getBoolean($startcol + 7);

			$this->required = $rs->getBoolean($startcol + 8);

			$this->num_mm = $rs->getInt($startcol + 9);

			$this->resetModified();

			$this->setNew(false);
			$this->setCulture(sfContext::getInstance()->getUser()->getCulture());

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 10; // 10 = CategoryPeer::NUM_COLUMNS - CategoryPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating Category object", $e);
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

    foreach (sfMixer::getCallables('BaseCategory:delete:pre') as $callable)
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
			$con = Propel::getConnection(CategoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			CategoryPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	

    foreach (sfMixer::getCallables('BaseCategory:delete:post') as $callable)
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

    foreach (sfMixer::getCallables('BaseCategory:save:pre') as $callable)
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
			$con = Propel::getConnection(CategoryPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
    foreach (sfMixer::getCallables('BaseCategory:save:post') as $callable)
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
					$pk = CategoryPeer::doInsert($this, $con);
					$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

					$this->setId($pk);  //[IMV] update autoincrement primary key

					$this->setNew(false);
				} else {
					$affectedRows += CategoryPeer::doUpdate($this, $con);
				}
				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			if ($this->collVirtualGroundRelations !== null) {
				foreach($this->collVirtualGroundRelations as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCategoryI18ns !== null) {
				foreach($this->collCategoryI18ns as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRelationCategorysRelatedByOneId !== null) {
				foreach($this->collRelationCategorysRelatedByOneId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collRelationCategorysRelatedByTwoId !== null) {
				foreach($this->collRelationCategorysRelatedByTwoId as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCategoryMms !== null) {
				foreach($this->collCategoryMms as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCategoryMmTemplates !== null) {
				foreach($this->collCategoryMmTemplates as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCategoryMmTimeframes !== null) {
				foreach($this->collCategoryMmTimeframes as $referrerFK) {
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


			if (($retval = CategoryPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collVirtualGroundRelations !== null) {
					foreach($this->collVirtualGroundRelations as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCategoryI18ns !== null) {
					foreach($this->collCategoryI18ns as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRelationCategorysRelatedByOneId !== null) {
					foreach($this->collRelationCategorysRelatedByOneId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collRelationCategorysRelatedByTwoId !== null) {
					foreach($this->collRelationCategorysRelatedByTwoId as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCategoryMms !== null) {
					foreach($this->collCategoryMms as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCategoryMmTemplates !== null) {
					foreach($this->collCategoryMmTemplates as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCategoryMmTimeframes !== null) {
					foreach($this->collCategoryMmTimeframes as $referrerFK) {
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
		$pos = CategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getTreeLeft();
				break;
			case 3:
				return $this->getTreeRight();
				break;
			case 4:
				return $this->getTreeParent();
				break;
			case 5:
				return $this->getScope();
				break;
			case 6:
				return $this->getMetacategory();
				break;
			case 7:
				return $this->getDisplay();
				break;
			case 8:
				return $this->getRequired();
				break;
			case 9:
				return $this->getNumMm();
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
		$keys = CategoryPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getCod(),
			$keys[2] => $this->getTreeLeft(),
			$keys[3] => $this->getTreeRight(),
			$keys[4] => $this->getTreeParent(),
			$keys[5] => $this->getScope(),
			$keys[6] => $this->getMetacategory(),
			$keys[7] => $this->getDisplay(),
			$keys[8] => $this->getRequired(),
			$keys[9] => $this->getNumMm(),
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
		$pos = CategoryPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setTreeLeft($value);
				break;
			case 3:
				$this->setTreeRight($value);
				break;
			case 4:
				$this->setTreeParent($value);
				break;
			case 5:
				$this->setScope($value);
				break;
			case 6:
				$this->setMetacategory($value);
				break;
			case 7:
				$this->setDisplay($value);
				break;
			case 8:
				$this->setRequired($value);
				break;
			case 9:
				$this->setNumMm($value);
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
		$keys = CategoryPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCod($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setTreeLeft($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTreeRight($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTreeParent($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setScope($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setMetacategory($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setDisplay($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setRequired($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setNumMm($arr[$keys[9]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(CategoryPeer::DATABASE_NAME);

		if ($this->isColumnModified(CategoryPeer::ID)) $criteria->add(CategoryPeer::ID, $this->id);
		if ($this->isColumnModified(CategoryPeer::COD)) $criteria->add(CategoryPeer::COD, $this->cod);
		if ($this->isColumnModified(CategoryPeer::TREE_LEFT)) $criteria->add(CategoryPeer::TREE_LEFT, $this->tree_left);
		if ($this->isColumnModified(CategoryPeer::TREE_RIGHT)) $criteria->add(CategoryPeer::TREE_RIGHT, $this->tree_right);
		if ($this->isColumnModified(CategoryPeer::TREE_PARENT)) $criteria->add(CategoryPeer::TREE_PARENT, $this->tree_parent);
		if ($this->isColumnModified(CategoryPeer::SCOPE)) $criteria->add(CategoryPeer::SCOPE, $this->scope);
		if ($this->isColumnModified(CategoryPeer::METACATEGORY)) $criteria->add(CategoryPeer::METACATEGORY, $this->metacategory);
		if ($this->isColumnModified(CategoryPeer::DISPLAY)) $criteria->add(CategoryPeer::DISPLAY, $this->display);
		if ($this->isColumnModified(CategoryPeer::REQUIRED)) $criteria->add(CategoryPeer::REQUIRED, $this->required);
		if ($this->isColumnModified(CategoryPeer::NUM_MM)) $criteria->add(CategoryPeer::NUM_MM, $this->num_mm);

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
		$criteria = new Criteria(CategoryPeer::DATABASE_NAME);

		$criteria->add(CategoryPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Category (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCod($this->cod);

		$copyObj->setTreeLeft($this->tree_left);

		$copyObj->setTreeRight($this->tree_right);

		$copyObj->setTreeParent($this->tree_parent);

		$copyObj->setScope($this->scope);

		$copyObj->setMetacategory($this->metacategory);

		$copyObj->setDisplay($this->display);

		$copyObj->setRequired($this->required);

		$copyObj->setNumMm($this->num_mm);


		if ($deepCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);

			foreach($this->getVirtualGroundRelations() as $relObj) {
				$copyObj->addVirtualGroundRelation($relObj->copy($deepCopy));
			}

			foreach($this->getCategoryI18ns() as $relObj) {
				$copyObj->addCategoryI18n($relObj->copy($deepCopy));
			}

			foreach($this->getRelationCategorysRelatedByOneId() as $relObj) {
				$copyObj->addRelationCategoryRelatedByOneId($relObj->copy($deepCopy));
			}

			foreach($this->getRelationCategorysRelatedByTwoId() as $relObj) {
				$copyObj->addRelationCategoryRelatedByTwoId($relObj->copy($deepCopy));
			}

			foreach($this->getCategoryMms() as $relObj) {
				$copyObj->addCategoryMm($relObj->copy($deepCopy));
			}

			foreach($this->getCategoryMmTemplates() as $relObj) {
				$copyObj->addCategoryMmTemplate($relObj->copy($deepCopy));
			}

			foreach($this->getCategoryMmTimeframes() as $relObj) {
				$copyObj->addCategoryMmTimeframe($relObj->copy($deepCopy));
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
	 * @return     Category Clone of current object.
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
	 * @return     CategoryPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new CategoryPeer();
		}
		return self::$peer;
	}

	/**
	 * Temporary storage of collVirtualGroundRelations to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initVirtualGroundRelations()
	{
		if ($this->collVirtualGroundRelations === null) {
			$this->collVirtualGroundRelations = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Category has previously
	 * been saved, it will retrieve related VirtualGroundRelations from storage.
	 * If this Category is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getVirtualGroundRelations($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVirtualGroundRelationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVirtualGroundRelations === null) {
			if ($this->isNew()) {
			   $this->collVirtualGroundRelations = array();
			} else {

				$criteria->add(VirtualGroundRelationPeer::CATEGORY_ID, $this->getId());

				VirtualGroundRelationPeer::addSelectColumns($criteria);
				$this->collVirtualGroundRelations = VirtualGroundRelationPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(VirtualGroundRelationPeer::CATEGORY_ID, $this->getId());

				VirtualGroundRelationPeer::addSelectColumns($criteria);
				if (!isset($this->lastVirtualGroundRelationCriteria) || !$this->lastVirtualGroundRelationCriteria->equals($criteria)) {
					$this->collVirtualGroundRelations = VirtualGroundRelationPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastVirtualGroundRelationCriteria = $criteria;
		return $this->collVirtualGroundRelations;
	}

	/**
	 * Returns the number of related VirtualGroundRelations.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countVirtualGroundRelations($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVirtualGroundRelationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(VirtualGroundRelationPeer::CATEGORY_ID, $this->getId());

		return VirtualGroundRelationPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a VirtualGroundRelation object to this object
	 * through the VirtualGroundRelation foreign key attribute
	 *
	 * @param      VirtualGroundRelation $l VirtualGroundRelation
	 * @return     void
	 * @throws     PropelException
	 */
	public function addVirtualGroundRelation(VirtualGroundRelation $l)
	{
		$this->collVirtualGroundRelations[] = $l;
		$l->setCategory($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Category is new, it will return
	 * an empty collection; or if this Category has previously
	 * been saved, it will retrieve related VirtualGroundRelations from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Category.
	 */
	public function getVirtualGroundRelationsJoinVirtualGround($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseVirtualGroundRelationPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collVirtualGroundRelations === null) {
			if ($this->isNew()) {
				$this->collVirtualGroundRelations = array();
			} else {

				$criteria->add(VirtualGroundRelationPeer::CATEGORY_ID, $this->getId());

				$this->collVirtualGroundRelations = VirtualGroundRelationPeer::doSelectJoinVirtualGround($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(VirtualGroundRelationPeer::CATEGORY_ID, $this->getId());

			if (!isset($this->lastVirtualGroundRelationCriteria) || !$this->lastVirtualGroundRelationCriteria->equals($criteria)) {
				$this->collVirtualGroundRelations = VirtualGroundRelationPeer::doSelectJoinVirtualGround($criteria, $con);
			}
		}
		$this->lastVirtualGroundRelationCriteria = $criteria;

		return $this->collVirtualGroundRelations;
	}

	/**
	 * Temporary storage of collCategoryI18ns to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCategoryI18ns()
	{
		if ($this->collCategoryI18ns === null) {
			$this->collCategoryI18ns = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Category has previously
	 * been saved, it will retrieve related CategoryI18ns from storage.
	 * If this Category is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCategoryI18ns($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCategoryI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCategoryI18ns === null) {
			if ($this->isNew()) {
			   $this->collCategoryI18ns = array();
			} else {

				$criteria->add(CategoryI18nPeer::ID, $this->getId());

				CategoryI18nPeer::addSelectColumns($criteria);
				$this->collCategoryI18ns = CategoryI18nPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CategoryI18nPeer::ID, $this->getId());

				CategoryI18nPeer::addSelectColumns($criteria);
				if (!isset($this->lastCategoryI18nCriteria) || !$this->lastCategoryI18nCriteria->equals($criteria)) {
					$this->collCategoryI18ns = CategoryI18nPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCategoryI18nCriteria = $criteria;
		return $this->collCategoryI18ns;
	}

	/**
	 * Returns the number of related CategoryI18ns.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCategoryI18ns($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCategoryI18nPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CategoryI18nPeer::ID, $this->getId());

		return CategoryI18nPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a CategoryI18n object to this object
	 * through the CategoryI18n foreign key attribute
	 *
	 * @param      CategoryI18n $l CategoryI18n
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCategoryI18n(CategoryI18n $l)
	{
		$this->collCategoryI18ns[] = $l;
		$l->setCategory($this);
	}

	/**
	 * Temporary storage of collRelationCategorysRelatedByOneId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRelationCategorysRelatedByOneId()
	{
		if ($this->collRelationCategorysRelatedByOneId === null) {
			$this->collRelationCategorysRelatedByOneId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Category has previously
	 * been saved, it will retrieve related RelationCategorysRelatedByOneId from storage.
	 * If this Category is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRelationCategorysRelatedByOneId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRelationCategoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelationCategorysRelatedByOneId === null) {
			if ($this->isNew()) {
			   $this->collRelationCategorysRelatedByOneId = array();
			} else {

				$criteria->add(RelationCategoryPeer::ONE_ID, $this->getId());

				RelationCategoryPeer::addSelectColumns($criteria);
				$this->collRelationCategorysRelatedByOneId = RelationCategoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RelationCategoryPeer::ONE_ID, $this->getId());

				RelationCategoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastRelationCategoryRelatedByOneIdCriteria) || !$this->lastRelationCategoryRelatedByOneIdCriteria->equals($criteria)) {
					$this->collRelationCategorysRelatedByOneId = RelationCategoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRelationCategoryRelatedByOneIdCriteria = $criteria;
		return $this->collRelationCategorysRelatedByOneId;
	}

	/**
	 * Returns the number of related RelationCategorysRelatedByOneId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRelationCategorysRelatedByOneId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRelationCategoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RelationCategoryPeer::ONE_ID, $this->getId());

		return RelationCategoryPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RelationCategory object to this object
	 * through the RelationCategory foreign key attribute
	 *
	 * @param      RelationCategory $l RelationCategory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRelationCategoryRelatedByOneId(RelationCategory $l)
	{
		$this->collRelationCategorysRelatedByOneId[] = $l;
		$l->setCategoryRelatedByOneId($this);
	}

	/**
	 * Temporary storage of collRelationCategorysRelatedByTwoId to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initRelationCategorysRelatedByTwoId()
	{
		if ($this->collRelationCategorysRelatedByTwoId === null) {
			$this->collRelationCategorysRelatedByTwoId = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Category has previously
	 * been saved, it will retrieve related RelationCategorysRelatedByTwoId from storage.
	 * If this Category is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getRelationCategorysRelatedByTwoId($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRelationCategoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collRelationCategorysRelatedByTwoId === null) {
			if ($this->isNew()) {
			   $this->collRelationCategorysRelatedByTwoId = array();
			} else {

				$criteria->add(RelationCategoryPeer::TWO_ID, $this->getId());

				RelationCategoryPeer::addSelectColumns($criteria);
				$this->collRelationCategorysRelatedByTwoId = RelationCategoryPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(RelationCategoryPeer::TWO_ID, $this->getId());

				RelationCategoryPeer::addSelectColumns($criteria);
				if (!isset($this->lastRelationCategoryRelatedByTwoIdCriteria) || !$this->lastRelationCategoryRelatedByTwoIdCriteria->equals($criteria)) {
					$this->collRelationCategorysRelatedByTwoId = RelationCategoryPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastRelationCategoryRelatedByTwoIdCriteria = $criteria;
		return $this->collRelationCategorysRelatedByTwoId;
	}

	/**
	 * Returns the number of related RelationCategorysRelatedByTwoId.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countRelationCategorysRelatedByTwoId($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseRelationCategoryPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(RelationCategoryPeer::TWO_ID, $this->getId());

		return RelationCategoryPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a RelationCategory object to this object
	 * through the RelationCategory foreign key attribute
	 *
	 * @param      RelationCategory $l RelationCategory
	 * @return     void
	 * @throws     PropelException
	 */
	public function addRelationCategoryRelatedByTwoId(RelationCategory $l)
	{
		$this->collRelationCategorysRelatedByTwoId[] = $l;
		$l->setCategoryRelatedByTwoId($this);
	}

	/**
	 * Temporary storage of collCategoryMms to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCategoryMms()
	{
		if ($this->collCategoryMms === null) {
			$this->collCategoryMms = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Category has previously
	 * been saved, it will retrieve related CategoryMms from storage.
	 * If this Category is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCategoryMms($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCategoryMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCategoryMms === null) {
			if ($this->isNew()) {
			   $this->collCategoryMms = array();
			} else {

				$criteria->add(CategoryMmPeer::CATEGORY_ID, $this->getId());

				CategoryMmPeer::addSelectColumns($criteria);
				$this->collCategoryMms = CategoryMmPeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CategoryMmPeer::CATEGORY_ID, $this->getId());

				CategoryMmPeer::addSelectColumns($criteria);
				if (!isset($this->lastCategoryMmCriteria) || !$this->lastCategoryMmCriteria->equals($criteria)) {
					$this->collCategoryMms = CategoryMmPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCategoryMmCriteria = $criteria;
		return $this->collCategoryMms;
	}

	/**
	 * Returns the number of related CategoryMms.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCategoryMms($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCategoryMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CategoryMmPeer::CATEGORY_ID, $this->getId());

		return CategoryMmPeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a CategoryMm object to this object
	 * through the CategoryMm foreign key attribute
	 *
	 * @param      CategoryMm $l CategoryMm
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCategoryMm(CategoryMm $l)
	{
		$this->collCategoryMms[] = $l;
		$l->setCategory($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Category is new, it will return
	 * an empty collection; or if this Category has previously
	 * been saved, it will retrieve related CategoryMms from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Category.
	 */
	public function getCategoryMmsJoinMm($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCategoryMmPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCategoryMms === null) {
			if ($this->isNew()) {
				$this->collCategoryMms = array();
			} else {

				$criteria->add(CategoryMmPeer::CATEGORY_ID, $this->getId());

				$this->collCategoryMms = CategoryMmPeer::doSelectJoinMm($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CategoryMmPeer::CATEGORY_ID, $this->getId());

			if (!isset($this->lastCategoryMmCriteria) || !$this->lastCategoryMmCriteria->equals($criteria)) {
				$this->collCategoryMms = CategoryMmPeer::doSelectJoinMm($criteria, $con);
			}
		}
		$this->lastCategoryMmCriteria = $criteria;

		return $this->collCategoryMms;
	}

	/**
	 * Temporary storage of collCategoryMmTemplates to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCategoryMmTemplates()
	{
		if ($this->collCategoryMmTemplates === null) {
			$this->collCategoryMmTemplates = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Category has previously
	 * been saved, it will retrieve related CategoryMmTemplates from storage.
	 * If this Category is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCategoryMmTemplates($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCategoryMmTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCategoryMmTemplates === null) {
			if ($this->isNew()) {
			   $this->collCategoryMmTemplates = array();
			} else {

				$criteria->add(CategoryMmTemplatePeer::CATEGORY_ID, $this->getId());

				CategoryMmTemplatePeer::addSelectColumns($criteria);
				$this->collCategoryMmTemplates = CategoryMmTemplatePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CategoryMmTemplatePeer::CATEGORY_ID, $this->getId());

				CategoryMmTemplatePeer::addSelectColumns($criteria);
				if (!isset($this->lastCategoryMmTemplateCriteria) || !$this->lastCategoryMmTemplateCriteria->equals($criteria)) {
					$this->collCategoryMmTemplates = CategoryMmTemplatePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCategoryMmTemplateCriteria = $criteria;
		return $this->collCategoryMmTemplates;
	}

	/**
	 * Returns the number of related CategoryMmTemplates.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCategoryMmTemplates($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCategoryMmTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CategoryMmTemplatePeer::CATEGORY_ID, $this->getId());

		return CategoryMmTemplatePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a CategoryMmTemplate object to this object
	 * through the CategoryMmTemplate foreign key attribute
	 *
	 * @param      CategoryMmTemplate $l CategoryMmTemplate
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCategoryMmTemplate(CategoryMmTemplate $l)
	{
		$this->collCategoryMmTemplates[] = $l;
		$l->setCategory($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Category is new, it will return
	 * an empty collection; or if this Category has previously
	 * been saved, it will retrieve related CategoryMmTemplates from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Category.
	 */
	public function getCategoryMmTemplatesJoinMmTemplate($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCategoryMmTemplatePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCategoryMmTemplates === null) {
			if ($this->isNew()) {
				$this->collCategoryMmTemplates = array();
			} else {

				$criteria->add(CategoryMmTemplatePeer::CATEGORY_ID, $this->getId());

				$this->collCategoryMmTemplates = CategoryMmTemplatePeer::doSelectJoinMmTemplate($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CategoryMmTemplatePeer::CATEGORY_ID, $this->getId());

			if (!isset($this->lastCategoryMmTemplateCriteria) || !$this->lastCategoryMmTemplateCriteria->equals($criteria)) {
				$this->collCategoryMmTemplates = CategoryMmTemplatePeer::doSelectJoinMmTemplate($criteria, $con);
			}
		}
		$this->lastCategoryMmTemplateCriteria = $criteria;

		return $this->collCategoryMmTemplates;
	}

	/**
	 * Temporary storage of collCategoryMmTimeframes to save a possible db hit in
	 * the event objects are add to the collection, but the
	 * complete collection is never requested.
	 * @return     void
	 */
	public function initCategoryMmTimeframes()
	{
		if ($this->collCategoryMmTimeframes === null) {
			$this->collCategoryMmTimeframes = array();
		}
	}

	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Category has previously
	 * been saved, it will retrieve related CategoryMmTimeframes from storage.
	 * If this Category is new, it will return
	 * an empty collection or the current collection, the criteria
	 * is ignored on a new object.
	 *
	 * @param      Connection $con
	 * @param      Criteria $criteria
	 * @throws     PropelException
	 */
	public function getCategoryMmTimeframes($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCategoryMmTimeframePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCategoryMmTimeframes === null) {
			if ($this->isNew()) {
			   $this->collCategoryMmTimeframes = array();
			} else {

				$criteria->add(CategoryMmTimeframePeer::CATEGORY_ID, $this->getId());

				CategoryMmTimeframePeer::addSelectColumns($criteria);
				$this->collCategoryMmTimeframes = CategoryMmTimeframePeer::doSelect($criteria, $con);
			}
		} else {
			// criteria has no effect for a new object
			if (!$this->isNew()) {
				// the following code is to determine if a new query is
				// called for.  If the criteria is the same as the last
				// one, just return the collection.


				$criteria->add(CategoryMmTimeframePeer::CATEGORY_ID, $this->getId());

				CategoryMmTimeframePeer::addSelectColumns($criteria);
				if (!isset($this->lastCategoryMmTimeframeCriteria) || !$this->lastCategoryMmTimeframeCriteria->equals($criteria)) {
					$this->collCategoryMmTimeframes = CategoryMmTimeframePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCategoryMmTimeframeCriteria = $criteria;
		return $this->collCategoryMmTimeframes;
	}

	/**
	 * Returns the number of related CategoryMmTimeframes.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      Connection $con
	 * @throws     PropelException
	 */
	public function countCategoryMmTimeframes($criteria = null, $distinct = false, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCategoryMmTimeframePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CategoryMmTimeframePeer::CATEGORY_ID, $this->getId());

		return CategoryMmTimeframePeer::doCount($criteria, $distinct, $con);
	}

	/**
	 * Method called to associate a CategoryMmTimeframe object to this object
	 * through the CategoryMmTimeframe foreign key attribute
	 *
	 * @param      CategoryMmTimeframe $l CategoryMmTimeframe
	 * @return     void
	 * @throws     PropelException
	 */
	public function addCategoryMmTimeframe(CategoryMmTimeframe $l)
	{
		$this->collCategoryMmTimeframes[] = $l;
		$l->setCategory($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Category is new, it will return
	 * an empty collection; or if this Category has previously
	 * been saved, it will retrieve related CategoryMmTimeframes from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Category.
	 */
	public function getCategoryMmTimeframesJoinMm($criteria = null, $con = null)
	{
		// include the Peer class
		include_once 'lib/model/om/BaseCategoryMmTimeframePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCategoryMmTimeframes === null) {
			if ($this->isNew()) {
				$this->collCategoryMmTimeframes = array();
			} else {

				$criteria->add(CategoryMmTimeframePeer::CATEGORY_ID, $this->getId());

				$this->collCategoryMmTimeframes = CategoryMmTimeframePeer::doSelectJoinMm($criteria, $con);
			}
		} else {
			// the following code is to determine if a new query is
			// called for.  If the criteria is the same as the last
			// one, just return the collection.

			$criteria->add(CategoryMmTimeframePeer::CATEGORY_ID, $this->getId());

			if (!isset($this->lastCategoryMmTimeframeCriteria) || !$this->lastCategoryMmTimeframeCriteria->equals($criteria)) {
				$this->collCategoryMmTimeframes = CategoryMmTimeframePeer::doSelectJoinMm($criteria, $con);
			}
		}
		$this->lastCategoryMmTimeframeCriteria = $criteria;

		return $this->collCategoryMmTimeframes;
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
			if ($this->collVirtualGroundRelations) {
				foreach ((array) $this->collVirtualGroundRelations as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCategoryI18ns) {
				foreach ((array) $this->collCategoryI18ns as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRelationCategorysRelatedByOneId) {
				foreach ((array) $this->collRelationCategorysRelatedByOneId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collRelationCategorysRelatedByTwoId) {
				foreach ((array) $this->collRelationCategorysRelatedByTwoId as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCategoryMms) {
				foreach ((array) $this->collCategoryMms as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCategoryMmTemplates) {
				foreach ((array) $this->collCategoryMmTemplates as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collCategoryMmTimeframes) {
				foreach ((array) $this->collCategoryMmTimeframes as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		$this->collVirtualGroundRelations = null;
		$this->collCategoryI18ns = null;
		$this->collRelationCategorysRelatedByOneId = null;
		$this->collRelationCategorysRelatedByTwoId = null;
		$this->collCategoryMms = null;
		$this->collCategoryMmTemplates = null;
		$this->collCategoryMmTimeframes = null;
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
    $obj = $this->getCurrentCategoryI18n();

    return ($obj ? $obj->getName() : null);
  }

  public function setName($value)
  {
    $this->getCurrentCategoryI18n()->setName($value);
  }

  protected $current_i18n = array();

  public function getCurrentCategoryI18n()
  {
    if (!isset($this->current_i18n[$this->culture]))
    {
      $obj = CategoryI18nPeer::retrieveByPK($this->getId(), $this->culture);
      if ($obj)
      {
        $this->setCategoryI18nForCulture($obj, $this->culture);
      }
      else
      {
        $this->setCategoryI18nForCulture(new CategoryI18n(), $this->culture);
        $this->current_i18n[$this->culture]->setCulture($this->culture);
      }
    }

    return $this->current_i18n[$this->culture];
  }

  public function setCategoryI18nForCulture($object, $culture)
  {
    $this->current_i18n[$culture] = $object;
    $this->addCategoryI18n($object);
  }


  public function __call($method, $arguments)
  {
    if (!$callable = sfMixer::getCallable('BaseCategory:'.$method))
    {
      throw new sfException(sprintf('Call to undefined method BaseCategory::%s', $method));
    }

    array_unshift($arguments, $this);

    return call_user_func_array($callable, $arguments);
  }


} // BaseCategory
