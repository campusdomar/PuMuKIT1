<?php

/**
 * Base static class for performing query and update operations on the 'mm_template' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseMmTemplatePeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'mm_template';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.MmTemplate';

	/** The total number of columns. */
	const NUM_COLUMNS = 13;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'mm_template.ID';

	/** the column name for the SUBSERIAL field */
	const SUBSERIAL = 'mm_template.SUBSERIAL';

	/** the column name for the ANNOUNCE field */
	const ANNOUNCE = 'mm_template.ANNOUNCE';

	/** the column name for the MAIL field */
	const MAIL = 'mm_template.MAIL';

	/** the column name for the SERIAL_ID field */
	const SERIAL_ID = 'mm_template.SERIAL_ID';

	/** the column name for the RANK field */
	const RANK = 'mm_template.RANK';

	/** the column name for the PRECINCT_ID field */
	const PRECINCT_ID = 'mm_template.PRECINCT_ID';

	/** the column name for the GENRE_ID field */
	const GENRE_ID = 'mm_template.GENRE_ID';

	/** the column name for the BROADCAST_ID field */
	const BROADCAST_ID = 'mm_template.BROADCAST_ID';

	/** the column name for the COPYRIGHT field */
	const COPYRIGHT = 'mm_template.COPYRIGHT';

	/** the column name for the STATUS_ID field */
	const STATUS_ID = 'mm_template.STATUS_ID';

	/** the column name for the RECORDDATE field */
	const RECORDDATE = 'mm_template.RECORDDATE';

	/** the column name for the PUBLICDATE field */
	const PUBLICDATE = 'mm_template.PUBLICDATE';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Subserial', 'Announce', 'Mail', 'SerialId', 'Rank', 'PrecinctId', 'GenreId', 'BroadcastId', 'Copyright', 'StatusId', 'Recorddate', 'Publicdate', ),
		BasePeer::TYPE_COLNAME => array (MmTemplatePeer::ID, MmTemplatePeer::SUBSERIAL, MmTemplatePeer::ANNOUNCE, MmTemplatePeer::MAIL, MmTemplatePeer::SERIAL_ID, MmTemplatePeer::RANK, MmTemplatePeer::PRECINCT_ID, MmTemplatePeer::GENRE_ID, MmTemplatePeer::BROADCAST_ID, MmTemplatePeer::COPYRIGHT, MmTemplatePeer::STATUS_ID, MmTemplatePeer::RECORDDATE, MmTemplatePeer::PUBLICDATE, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'subserial', 'announce', 'mail', 'serial_id', 'rank', 'precinct_id', 'genre_id', 'broadcast_id', 'copyright', 'status_id', 'recordDate', 'publicDate', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Subserial' => 1, 'Announce' => 2, 'Mail' => 3, 'SerialId' => 4, 'Rank' => 5, 'PrecinctId' => 6, 'GenreId' => 7, 'BroadcastId' => 8, 'Copyright' => 9, 'StatusId' => 10, 'Recorddate' => 11, 'Publicdate' => 12, ),
		BasePeer::TYPE_COLNAME => array (MmTemplatePeer::ID => 0, MmTemplatePeer::SUBSERIAL => 1, MmTemplatePeer::ANNOUNCE => 2, MmTemplatePeer::MAIL => 3, MmTemplatePeer::SERIAL_ID => 4, MmTemplatePeer::RANK => 5, MmTemplatePeer::PRECINCT_ID => 6, MmTemplatePeer::GENRE_ID => 7, MmTemplatePeer::BROADCAST_ID => 8, MmTemplatePeer::COPYRIGHT => 9, MmTemplatePeer::STATUS_ID => 10, MmTemplatePeer::RECORDDATE => 11, MmTemplatePeer::PUBLICDATE => 12, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'subserial' => 1, 'announce' => 2, 'mail' => 3, 'serial_id' => 4, 'rank' => 5, 'precinct_id' => 6, 'genre_id' => 7, 'broadcast_id' => 8, 'copyright' => 9, 'status_id' => 10, 'recordDate' => 11, 'publicDate' => 12, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/MmTemplateMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.MmTemplateMapBuilder');
	}
	/**
	 * Gets a map (hash) of PHP names to DB column names.
	 *
	 * @return     array The PHP to DB name map for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @deprecated Use the getFieldNames() and translateFieldName() methods instead of this.
	 */
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = MmTemplatePeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants TYPE_PHPNAME,
	 *                         TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants TYPE_PHPNAME,
	 *                      TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. MmTemplatePeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(MmTemplatePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      criteria object containing the columns to add.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(MmTemplatePeer::ID);

		$criteria->addSelectColumn(MmTemplatePeer::SUBSERIAL);

		$criteria->addSelectColumn(MmTemplatePeer::ANNOUNCE);

		$criteria->addSelectColumn(MmTemplatePeer::MAIL);

		$criteria->addSelectColumn(MmTemplatePeer::SERIAL_ID);

		$criteria->addSelectColumn(MmTemplatePeer::RANK);

		$criteria->addSelectColumn(MmTemplatePeer::PRECINCT_ID);

		$criteria->addSelectColumn(MmTemplatePeer::GENRE_ID);

		$criteria->addSelectColumn(MmTemplatePeer::BROADCAST_ID);

		$criteria->addSelectColumn(MmTemplatePeer::COPYRIGHT);

		$criteria->addSelectColumn(MmTemplatePeer::STATUS_ID);

		$criteria->addSelectColumn(MmTemplatePeer::RECORDDATE);

		$criteria->addSelectColumn(MmTemplatePeer::PUBLICDATE);

	}

	const COUNT = 'COUNT(mm_template.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT mm_template.ID)';

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MmTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmTemplatePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = MmTemplatePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}
	/**
	 * Method to select one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      Connection $con
	 * @return     MmTemplate
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = MmTemplatePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Method to do selects.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      Connection $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return MmTemplatePeer::populateObjects(MmTemplatePeer::doSelectRS($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect()
	 * method to get a ResultSet.
	 *
	 * Use this method directly if you want to just get the resultset
	 * (instead of an array of objects).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     ResultSet The resultset object with numerically-indexed fields.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectRS(Criteria $criteria, $con = null)
	{

    foreach (sfMixer::getCallables('BaseMmTemplatePeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseMmTemplatePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			MmTemplatePeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

        //ADD DEFAULT ORDER
        if(count($criteria->getOrderByColumns()) == 0)
            $criteria->addAscendingOrderByColumn(self::RANK);

		// BasePeer returns a Creole ResultSet, set to return
		// rows indexed numerically.
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = MmTemplatePeer::getOMClass();
		$cls = Propel::import($cls);
		// populate the object(s)
		while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	/**
	 * Returns the number of rows matching criteria, joining the related Serial table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinSerial(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MmTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmTemplatePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmTemplatePeer::SERIAL_ID, SerialPeer::ID);

		$rs = MmTemplatePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Precinct table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinPrecinct(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MmTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmTemplatePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmTemplatePeer::PRECINCT_ID, PrecinctPeer::ID);

		$rs = MmTemplatePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Genre table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinGenre(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MmTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmTemplatePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmTemplatePeer::GENRE_ID, GenrePeer::ID);

		$rs = MmTemplatePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Broadcast table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinBroadcast(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MmTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmTemplatePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmTemplatePeer::BROADCAST_ID, BroadcastPeer::ID);

		$rs = MmTemplatePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of MmTemplate objects pre-filled with their Serial objects.
	 *
	 * @return     array Array of MmTemplate objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinSerial(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MmTemplatePeer::addSelectColumns($c);
		$startcol = (MmTemplatePeer::NUM_COLUMNS - MmTemplatePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SerialPeer::addSelectColumns($c);

		$c->addJoin(MmTemplatePeer::SERIAL_ID, SerialPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmTemplatePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SerialPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSerial(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addMmTemplate($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initMmTemplates();
				$obj2->addMmTemplate($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of MmTemplate objects pre-filled with their Precinct objects.
	 *
	 * @return     array Array of MmTemplate objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinPrecinct(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MmTemplatePeer::addSelectColumns($c);
		$startcol = (MmTemplatePeer::NUM_COLUMNS - MmTemplatePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PrecinctPeer::addSelectColumns($c);

		$c->addJoin(MmTemplatePeer::PRECINCT_ID, PrecinctPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmTemplatePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PrecinctPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPrecinct(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addMmTemplate($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initMmTemplates();
				$obj2->addMmTemplate($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of MmTemplate objects pre-filled with their Genre objects.
	 *
	 * @return     array Array of MmTemplate objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinGenre(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MmTemplatePeer::addSelectColumns($c);
		$startcol = (MmTemplatePeer::NUM_COLUMNS - MmTemplatePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		GenrePeer::addSelectColumns($c);

		$c->addJoin(MmTemplatePeer::GENRE_ID, GenrePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmTemplatePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = GenrePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getGenre(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addMmTemplate($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initMmTemplates();
				$obj2->addMmTemplate($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of MmTemplate objects pre-filled with their Broadcast objects.
	 *
	 * @return     array Array of MmTemplate objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinBroadcast(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MmTemplatePeer::addSelectColumns($c);
		$startcol = (MmTemplatePeer::NUM_COLUMNS - MmTemplatePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		BroadcastPeer::addSelectColumns($c);

		$c->addJoin(MmTemplatePeer::BROADCAST_ID, BroadcastPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmTemplatePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = BroadcastPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getBroadcast(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addMmTemplate($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initMmTemplates();
				$obj2->addMmTemplate($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining all related tables
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MmTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmTemplatePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmTemplatePeer::SERIAL_ID, SerialPeer::ID);

		$criteria->addJoin(MmTemplatePeer::PRECINCT_ID, PrecinctPeer::ID);

		$criteria->addJoin(MmTemplatePeer::GENRE_ID, GenrePeer::ID);

		$criteria->addJoin(MmTemplatePeer::BROADCAST_ID, BroadcastPeer::ID);

		$rs = MmTemplatePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of MmTemplate objects pre-filled with all related objects.
	 *
	 * @return     array Array of MmTemplate objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MmTemplatePeer::addSelectColumns($c);
		$startcol2 = (MmTemplatePeer::NUM_COLUMNS - MmTemplatePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SerialPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SerialPeer::NUM_COLUMNS;

		PrecinctPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PrecinctPeer::NUM_COLUMNS;

		GenrePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + GenrePeer::NUM_COLUMNS;

		BroadcastPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + BroadcastPeer::NUM_COLUMNS;

		$c->addJoin(MmTemplatePeer::SERIAL_ID, SerialPeer::ID);

		$c->addJoin(MmTemplatePeer::PRECINCT_ID, PrecinctPeer::ID);

		$c->addJoin(MmTemplatePeer::GENRE_ID, GenrePeer::ID);

		$c->addJoin(MmTemplatePeer::BROADCAST_ID, BroadcastPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmTemplatePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined Serial rows
	
			$omClass = SerialPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSerial(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addMmTemplate($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initMmTemplates();
				$obj2->addMmTemplate($obj1);
			}


				// Add objects for joined Precinct rows
	
			$omClass = PrecinctPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPrecinct(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addMmTemplate($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initMmTemplates();
				$obj3->addMmTemplate($obj1);
			}


				// Add objects for joined Genre rows
	
			$omClass = GenrePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getGenre(); // CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addMmTemplate($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initMmTemplates();
				$obj4->addMmTemplate($obj1);
			}


				// Add objects for joined Broadcast rows
	
			$omClass = BroadcastPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getBroadcast(); // CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addMmTemplate($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj5->initMmTemplates();
				$obj5->addMmTemplate($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Serial table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptSerial(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MmTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmTemplatePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmTemplatePeer::PRECINCT_ID, PrecinctPeer::ID);

		$criteria->addJoin(MmTemplatePeer::GENRE_ID, GenrePeer::ID);

		$criteria->addJoin(MmTemplatePeer::BROADCAST_ID, BroadcastPeer::ID);

		$rs = MmTemplatePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Precinct table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptPrecinct(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MmTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmTemplatePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmTemplatePeer::SERIAL_ID, SerialPeer::ID);

		$criteria->addJoin(MmTemplatePeer::GENRE_ID, GenrePeer::ID);

		$criteria->addJoin(MmTemplatePeer::BROADCAST_ID, BroadcastPeer::ID);

		$rs = MmTemplatePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Genre table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptGenre(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MmTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmTemplatePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmTemplatePeer::SERIAL_ID, SerialPeer::ID);

		$criteria->addJoin(MmTemplatePeer::PRECINCT_ID, PrecinctPeer::ID);

		$criteria->addJoin(MmTemplatePeer::BROADCAST_ID, BroadcastPeer::ID);

		$rs = MmTemplatePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Broadcast table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptBroadcast(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MmTemplatePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmTemplatePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmTemplatePeer::SERIAL_ID, SerialPeer::ID);

		$criteria->addJoin(MmTemplatePeer::PRECINCT_ID, PrecinctPeer::ID);

		$criteria->addJoin(MmTemplatePeer::GENRE_ID, GenrePeer::ID);

		$rs = MmTemplatePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of MmTemplate objects pre-filled with all related objects except Serial.
	 *
	 * @return     array Array of MmTemplate objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptSerial(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MmTemplatePeer::addSelectColumns($c);
		$startcol2 = (MmTemplatePeer::NUM_COLUMNS - MmTemplatePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PrecinctPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PrecinctPeer::NUM_COLUMNS;

		GenrePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + GenrePeer::NUM_COLUMNS;

		BroadcastPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + BroadcastPeer::NUM_COLUMNS;

		$c->addJoin(MmTemplatePeer::PRECINCT_ID, PrecinctPeer::ID);

		$c->addJoin(MmTemplatePeer::GENRE_ID, GenrePeer::ID);

		$c->addJoin(MmTemplatePeer::BROADCAST_ID, BroadcastPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmTemplatePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PrecinctPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPrecinct(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addMmTemplate($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initMmTemplates();
				$obj2->addMmTemplate($obj1);
			}

			$omClass = GenrePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getGenre(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addMmTemplate($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initMmTemplates();
				$obj3->addMmTemplate($obj1);
			}

			$omClass = BroadcastPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getBroadcast(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addMmTemplate($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initMmTemplates();
				$obj4->addMmTemplate($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of MmTemplate objects pre-filled with all related objects except Precinct.
	 *
	 * @return     array Array of MmTemplate objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptPrecinct(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MmTemplatePeer::addSelectColumns($c);
		$startcol2 = (MmTemplatePeer::NUM_COLUMNS - MmTemplatePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SerialPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SerialPeer::NUM_COLUMNS;

		GenrePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + GenrePeer::NUM_COLUMNS;

		BroadcastPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + BroadcastPeer::NUM_COLUMNS;

		$c->addJoin(MmTemplatePeer::SERIAL_ID, SerialPeer::ID);

		$c->addJoin(MmTemplatePeer::GENRE_ID, GenrePeer::ID);

		$c->addJoin(MmTemplatePeer::BROADCAST_ID, BroadcastPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmTemplatePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SerialPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSerial(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addMmTemplate($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initMmTemplates();
				$obj2->addMmTemplate($obj1);
			}

			$omClass = GenrePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getGenre(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addMmTemplate($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initMmTemplates();
				$obj3->addMmTemplate($obj1);
			}

			$omClass = BroadcastPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getBroadcast(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addMmTemplate($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initMmTemplates();
				$obj4->addMmTemplate($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of MmTemplate objects pre-filled with all related objects except Genre.
	 *
	 * @return     array Array of MmTemplate objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptGenre(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MmTemplatePeer::addSelectColumns($c);
		$startcol2 = (MmTemplatePeer::NUM_COLUMNS - MmTemplatePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SerialPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SerialPeer::NUM_COLUMNS;

		PrecinctPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PrecinctPeer::NUM_COLUMNS;

		BroadcastPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + BroadcastPeer::NUM_COLUMNS;

		$c->addJoin(MmTemplatePeer::SERIAL_ID, SerialPeer::ID);

		$c->addJoin(MmTemplatePeer::PRECINCT_ID, PrecinctPeer::ID);

		$c->addJoin(MmTemplatePeer::BROADCAST_ID, BroadcastPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmTemplatePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SerialPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSerial(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addMmTemplate($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initMmTemplates();
				$obj2->addMmTemplate($obj1);
			}

			$omClass = PrecinctPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPrecinct(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addMmTemplate($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initMmTemplates();
				$obj3->addMmTemplate($obj1);
			}

			$omClass = BroadcastPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getBroadcast(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addMmTemplate($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initMmTemplates();
				$obj4->addMmTemplate($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of MmTemplate objects pre-filled with all related objects except Broadcast.
	 *
	 * @return     array Array of MmTemplate objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptBroadcast(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MmTemplatePeer::addSelectColumns($c);
		$startcol2 = (MmTemplatePeer::NUM_COLUMNS - MmTemplatePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SerialPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SerialPeer::NUM_COLUMNS;

		PrecinctPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PrecinctPeer::NUM_COLUMNS;

		GenrePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + GenrePeer::NUM_COLUMNS;

		$c->addJoin(MmTemplatePeer::SERIAL_ID, SerialPeer::ID);

		$c->addJoin(MmTemplatePeer::PRECINCT_ID, PrecinctPeer::ID);

		$c->addJoin(MmTemplatePeer::GENRE_ID, GenrePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmTemplatePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SerialPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSerial(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addMmTemplate($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initMmTemplates();
				$obj2->addMmTemplate($obj1);
			}

			$omClass = PrecinctPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPrecinct(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addMmTemplate($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initMmTemplates();
				$obj3->addMmTemplate($obj1);
			}

			$omClass = GenrePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getGenre(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addMmTemplate($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initMmTemplates();
				$obj4->addMmTemplate($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


  /**
   * Selects a collection of MmTemplate objects pre-filled with their i18n objects.
   *
   * @return array Array of MmTemplate objects.
   * @throws PropelException Any exceptions caught during processing will be
   *     rethrown wrapped into a PropelException.
   */
  public static function doSelectWithI18n(Criteria $c, $culture = null, $con = null)
  {
    // we're going to modify criteria, so copy it first
    $c = clone $c;
    if ($culture === null)
    {
      $culture = sfContext::getInstance()->getUser()->getCulture();
    }

    // Set the correct dbName if it has not been overridden
    if ($c->getDbName() == Propel::getDefaultDB())
    {
      $c->setDbName(self::DATABASE_NAME);
    }

    MmTemplatePeer::addSelectColumns($c);
    $startcol = (MmTemplatePeer::NUM_COLUMNS - MmTemplatePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

    MmTemplateI18nPeer::addSelectColumns($c);

    $c->addJoin(MmTemplatePeer::ID, MmTemplateI18nPeer::ID);
    $c->add(MmTemplateI18nPeer::CULTURE, $culture);

    if(count($c->getOrderByColumns()) == 0) $c->addAscendingOrderByColumn(self::RANK);

    $rs = BasePeer::doSelect($c, $con);
    $results = array();

    while($rs->next()) {

      $omClass = MmTemplatePeer::getOMClass();

      $cls = Propel::import($omClass);
      $obj1 = new $cls();
      $obj1->hydrate($rs);
      $obj1->setCulture($culture);

      $omClass = MmTemplateI18nPeer::getOMClass($rs, $startcol);

      $cls = Propel::import($omClass);
      $obj2 = new $cls();
      $obj2->hydrate($rs, $startcol);

      $obj1->setMmTemplateI18nForCulture($obj2, $culture);
      $obj2->setMmTemplate($obj1);

      $results[] = $obj1;
    }
    return $results;
  }

	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 * This uses a dot-path notation which is tranalted into a path
	 * relative to a location on the PHP include_path.
	 * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
	 *
	 * @return     string path.to.ClassName
	 */
	public static function getOMClass()
	{
		return MmTemplatePeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a MmTemplate or Criteria object.
	 *
	 * @param      mixed $values Criteria or MmTemplate object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseMmTemplatePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseMmTemplatePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from MmTemplate object
		}

		$criteria->remove(MmTemplatePeer::ID); // remove pkey col since this table uses auto-increment


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		
    foreach (sfMixer::getCallables('BaseMmTemplatePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseMmTemplatePeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a MmTemplate or Criteria object.
	 *
	 * @param      mixed $values Criteria or MmTemplate object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseMmTemplatePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseMmTemplatePeer', $values, $con);
      if (false !== $ret)
      {
        return $ret;
      }
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(MmTemplatePeer::ID);
			$selectCriteria->add(MmTemplatePeer::ID, $criteria->remove(MmTemplatePeer::ID), $comparison);

		} else { // $values is MmTemplate object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseMmTemplatePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseMmTemplatePeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the mm_template table.
	 *
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			$affectedRows += MmTemplatePeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(MmTemplatePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a MmTemplate or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or MmTemplate object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      Connection $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(MmTemplatePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof MmTemplate) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(MmTemplatePeer::ID, (array) $values, Criteria::IN);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			$affectedRows += MmTemplatePeer::doOnDeleteCascade($criteria, $con);
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * This is a method for emulating ON DELETE CASCADE for DBs that don't support this
	 * feature (like MySQL or SQLite).
	 *
	 * This method is not very speedy because it must perform a query first to get
	 * the implicated records and then perform the deletes by calling those Peer classes.
	 *
	 * This method should be used within a transaction if possible.
	 *
	 * @param      Criteria $criteria
	 * @param      Connection $con
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	protected static function doOnDeleteCascade(Criteria $criteria, Connection $con)
	{
		// initialize var to track total num of affected rows
		$affectedRows = 0;

		// first find the objects that are implicated by the $criteria
		$objects = MmTemplatePeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/MmTemplateI18n.php';

			// delete related MmTemplateI18n objects
			$c = new Criteria();
			
			$c->add(MmTemplateI18nPeer::ID, $obj->getId());
			$affectedRows += MmTemplateI18nPeer::doDelete($c, $con);

			include_once 'lib/model/MmTemplatePerson.php';

			// delete related MmTemplatePerson objects
			$c = new Criteria();
			
			$c->add(MmTemplatePersonPeer::MM_TEMPLATE_ID, $obj->getId());
			$affectedRows += MmTemplatePersonPeer::doDelete($c, $con);

			include_once 'lib/model/GroundMmTemplate.php';

			// delete related GroundMmTemplate objects
			$c = new Criteria();
			
			$c->add(GroundMmTemplatePeer::MM_TEMPLATE_ID, $obj->getId());
			$affectedRows += GroundMmTemplatePeer::doDelete($c, $con);

			include_once 'lib/model/CategoryMmTemplate.php';

			// delete related CategoryMmTemplate objects
			$c = new Criteria();
			
			$c->add(CategoryMmTemplatePeer::MM_TEMPLATE_ID, $obj->getId());
			$affectedRows += CategoryMmTemplatePeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	/**
	 * Validates all modified columns of given MmTemplate object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      MmTemplate $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(MmTemplate $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(MmTemplatePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(MmTemplatePeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(MmTemplatePeer::DATABASE_NAME, MmTemplatePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = MmTemplatePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     MmTemplate
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(MmTemplatePeer::DATABASE_NAME);

		$criteria->add(MmTemplatePeer::ID, $pk);


		$v = MmTemplatePeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(MmTemplatePeer::ID, $pks, Criteria::IN);
			$objs = MmTemplatePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

	/**
	 * Retrieve a single object by pkey with their i18n objects.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     MmTemplate
	 */
	public static function retrieveByPKWithI18n($pk, $culture = null, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(MmTemplatePeer::DATABASE_NAME);

		$criteria->add(MmTemplatePeer::ID, $pk);


		$v = MmTemplatePeer::doSelectWithI18n($criteria, $culture, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys with their i18n objects.
	 * @param      Connection $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKsWithI18n($pks, $culture = null, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(MmTemplatePeer::ID, $pks, Criteria::IN);
			$objs = MmTemplatePeer::doSelectWithI18n($criteria, $culture, $con);
		}
		return $objs;
	}

} // BaseMmTemplatePeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseMmTemplatePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/MmTemplateMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.MmTemplateMapBuilder');
}
