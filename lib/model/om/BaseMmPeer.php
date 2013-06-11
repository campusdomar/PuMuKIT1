<?php

/**
 * Base static class for performing query and update operations on the 'mm' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseMmPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'mm';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.Mm';

	/** The total number of columns. */
	const NUM_COLUMNS = 19;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'mm.ID';

	/** the column name for the SUBSERIAL field */
	const SUBSERIAL = 'mm.SUBSERIAL';

	/** the column name for the ANNOUNCE field */
	const ANNOUNCE = 'mm.ANNOUNCE';

	/** the column name for the MAIL field */
	const MAIL = 'mm.MAIL';

	/** the column name for the SERIAL_ID field */
	const SERIAL_ID = 'mm.SERIAL_ID';

	/** the column name for the RANK field */
	const RANK = 'mm.RANK';

	/** the column name for the PRECINCT_ID field */
	const PRECINCT_ID = 'mm.PRECINCT_ID';

	/** the column name for the GENRE_ID field */
	const GENRE_ID = 'mm.GENRE_ID';

	/** the column name for the BROADCAST_ID field */
	const BROADCAST_ID = 'mm.BROADCAST_ID';

	/** the column name for the COPYRIGHT field */
	const COPYRIGHT = 'mm.COPYRIGHT';

	/** the column name for the STATUS_ID field */
	const STATUS_ID = 'mm.STATUS_ID';

	/** the column name for the RECORDDATE field */
	const RECORDDATE = 'mm.RECORDDATE';

	/** the column name for the PUBLICDATE field */
	const PUBLICDATE = 'mm.PUBLICDATE';

	/** the column name for the EDITORIAL1 field */
	const EDITORIAL1 = 'mm.EDITORIAL1';

	/** the column name for the EDITORIAL2 field */
	const EDITORIAL2 = 'mm.EDITORIAL2';

	/** the column name for the EDITORIAL3 field */
	const EDITORIAL3 = 'mm.EDITORIAL3';

	/** the column name for the AUDIO field */
	const AUDIO = 'mm.AUDIO';

	/** the column name for the DURATION field */
	const DURATION = 'mm.DURATION';

	/** the column name for the NUM_VIEW field */
	const NUM_VIEW = 'mm.NUM_VIEW';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Subserial', 'Announce', 'Mail', 'SerialId', 'Rank', 'PrecinctId', 'GenreId', 'BroadcastId', 'Copyright', 'StatusId', 'Recorddate', 'Publicdate', 'Editorial1', 'Editorial2', 'Editorial3', 'Audio', 'Duration', 'NumView', ),
		BasePeer::TYPE_COLNAME => array (MmPeer::ID, MmPeer::SUBSERIAL, MmPeer::ANNOUNCE, MmPeer::MAIL, MmPeer::SERIAL_ID, MmPeer::RANK, MmPeer::PRECINCT_ID, MmPeer::GENRE_ID, MmPeer::BROADCAST_ID, MmPeer::COPYRIGHT, MmPeer::STATUS_ID, MmPeer::RECORDDATE, MmPeer::PUBLICDATE, MmPeer::EDITORIAL1, MmPeer::EDITORIAL2, MmPeer::EDITORIAL3, MmPeer::AUDIO, MmPeer::DURATION, MmPeer::NUM_VIEW, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'subserial', 'announce', 'mail', 'serial_id', 'rank', 'precinct_id', 'genre_id', 'broadcast_id', 'copyright', 'status_id', 'recordDate', 'publicDate', 'editorial1', 'editorial2', 'editorial3', 'audio', 'duration', 'num_view', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Subserial' => 1, 'Announce' => 2, 'Mail' => 3, 'SerialId' => 4, 'Rank' => 5, 'PrecinctId' => 6, 'GenreId' => 7, 'BroadcastId' => 8, 'Copyright' => 9, 'StatusId' => 10, 'Recorddate' => 11, 'Publicdate' => 12, 'Editorial1' => 13, 'Editorial2' => 14, 'Editorial3' => 15, 'Audio' => 16, 'Duration' => 17, 'NumView' => 18, ),
		BasePeer::TYPE_COLNAME => array (MmPeer::ID => 0, MmPeer::SUBSERIAL => 1, MmPeer::ANNOUNCE => 2, MmPeer::MAIL => 3, MmPeer::SERIAL_ID => 4, MmPeer::RANK => 5, MmPeer::PRECINCT_ID => 6, MmPeer::GENRE_ID => 7, MmPeer::BROADCAST_ID => 8, MmPeer::COPYRIGHT => 9, MmPeer::STATUS_ID => 10, MmPeer::RECORDDATE => 11, MmPeer::PUBLICDATE => 12, MmPeer::EDITORIAL1 => 13, MmPeer::EDITORIAL2 => 14, MmPeer::EDITORIAL3 => 15, MmPeer::AUDIO => 16, MmPeer::DURATION => 17, MmPeer::NUM_VIEW => 18, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'subserial' => 1, 'announce' => 2, 'mail' => 3, 'serial_id' => 4, 'rank' => 5, 'precinct_id' => 6, 'genre_id' => 7, 'broadcast_id' => 8, 'copyright' => 9, 'status_id' => 10, 'recordDate' => 11, 'publicDate' => 12, 'editorial1' => 13, 'editorial2' => 14, 'editorial3' => 15, 'audio' => 16, 'duration' => 17, 'num_view' => 18, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/MmMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.MmMapBuilder');
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
			$map = MmPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. MmPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(MmPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(MmPeer::ID);

		$criteria->addSelectColumn(MmPeer::SUBSERIAL);

		$criteria->addSelectColumn(MmPeer::ANNOUNCE);

		$criteria->addSelectColumn(MmPeer::MAIL);

		$criteria->addSelectColumn(MmPeer::SERIAL_ID);

		$criteria->addSelectColumn(MmPeer::RANK);

		$criteria->addSelectColumn(MmPeer::PRECINCT_ID);

		$criteria->addSelectColumn(MmPeer::GENRE_ID);

		$criteria->addSelectColumn(MmPeer::BROADCAST_ID);

		$criteria->addSelectColumn(MmPeer::COPYRIGHT);

		$criteria->addSelectColumn(MmPeer::STATUS_ID);

		$criteria->addSelectColumn(MmPeer::RECORDDATE);

		$criteria->addSelectColumn(MmPeer::PUBLICDATE);

		$criteria->addSelectColumn(MmPeer::EDITORIAL1);

		$criteria->addSelectColumn(MmPeer::EDITORIAL2);

		$criteria->addSelectColumn(MmPeer::EDITORIAL3);

		$criteria->addSelectColumn(MmPeer::AUDIO);

		$criteria->addSelectColumn(MmPeer::DURATION);

		$criteria->addSelectColumn(MmPeer::NUM_VIEW);

	}

	const COUNT = 'COUNT(mm.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT mm.ID)';

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
			$criteria->addSelectColumn(MmPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = MmPeer::doSelectRS($criteria, $con);
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
	 * @return     Mm
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = MmPeer::doSelect($critcopy, $con);
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
		return MmPeer::populateObjects(MmPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseMmPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseMmPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			MmPeer::addSelectColumns($criteria);
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
		$cls = MmPeer::getOMClass();
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
			$criteria->addSelectColumn(MmPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmPeer::SERIAL_ID, SerialPeer::ID);

		$rs = MmPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(MmPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmPeer::PRECINCT_ID, PrecinctPeer::ID);

		$rs = MmPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(MmPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmPeer::GENRE_ID, GenrePeer::ID);

		$rs = MmPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(MmPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);

		$rs = MmPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Mm objects pre-filled with their Serial objects.
	 *
	 * @return     array Array of Mm objects.
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

		MmPeer::addSelectColumns($c);
		$startcol = (MmPeer::NUM_COLUMNS - MmPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SerialPeer::addSelectColumns($c);

		$c->addJoin(MmPeer::SERIAL_ID, SerialPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmPeer::getOMClass();

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
					$temp_obj2->addMm($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initMms();
				$obj2->addMm($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Mm objects pre-filled with their Precinct objects.
	 *
	 * @return     array Array of Mm objects.
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

		MmPeer::addSelectColumns($c);
		$startcol = (MmPeer::NUM_COLUMNS - MmPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PrecinctPeer::addSelectColumns($c);

		$c->addJoin(MmPeer::PRECINCT_ID, PrecinctPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmPeer::getOMClass();

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
					$temp_obj2->addMm($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initMms();
				$obj2->addMm($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Mm objects pre-filled with their Genre objects.
	 *
	 * @return     array Array of Mm objects.
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

		MmPeer::addSelectColumns($c);
		$startcol = (MmPeer::NUM_COLUMNS - MmPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		GenrePeer::addSelectColumns($c);

		$c->addJoin(MmPeer::GENRE_ID, GenrePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmPeer::getOMClass();

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
					$temp_obj2->addMm($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initMms();
				$obj2->addMm($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Mm objects pre-filled with their Broadcast objects.
	 *
	 * @return     array Array of Mm objects.
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

		MmPeer::addSelectColumns($c);
		$startcol = (MmPeer::NUM_COLUMNS - MmPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		BroadcastPeer::addSelectColumns($c);

		$c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmPeer::getOMClass();

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
					$temp_obj2->addMm($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initMms();
				$obj2->addMm($obj1); //CHECKME
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
			$criteria->addSelectColumn(MmPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmPeer::SERIAL_ID, SerialPeer::ID);

		$criteria->addJoin(MmPeer::PRECINCT_ID, PrecinctPeer::ID);

		$criteria->addJoin(MmPeer::GENRE_ID, GenrePeer::ID);

		$criteria->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);

		$rs = MmPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Mm objects pre-filled with all related objects.
	 *
	 * @return     array Array of Mm objects.
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

		MmPeer::addSelectColumns($c);
		$startcol2 = (MmPeer::NUM_COLUMNS - MmPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SerialPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SerialPeer::NUM_COLUMNS;

		PrecinctPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PrecinctPeer::NUM_COLUMNS;

		GenrePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + GenrePeer::NUM_COLUMNS;

		BroadcastPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + BroadcastPeer::NUM_COLUMNS;

		$c->addJoin(MmPeer::SERIAL_ID, SerialPeer::ID);

		$c->addJoin(MmPeer::PRECINCT_ID, PrecinctPeer::ID);

		$c->addJoin(MmPeer::GENRE_ID, GenrePeer::ID);

		$c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmPeer::getOMClass();


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
					$temp_obj2->addMm($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initMms();
				$obj2->addMm($obj1);
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
					$temp_obj3->addMm($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initMms();
				$obj3->addMm($obj1);
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
					$temp_obj4->addMm($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initMms();
				$obj4->addMm($obj1);
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
					$temp_obj5->addMm($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj5->initMms();
				$obj5->addMm($obj1);
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
			$criteria->addSelectColumn(MmPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmPeer::PRECINCT_ID, PrecinctPeer::ID);

		$criteria->addJoin(MmPeer::GENRE_ID, GenrePeer::ID);

		$criteria->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);

		$rs = MmPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(MmPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmPeer::SERIAL_ID, SerialPeer::ID);

		$criteria->addJoin(MmPeer::GENRE_ID, GenrePeer::ID);

		$criteria->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);

		$rs = MmPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(MmPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmPeer::SERIAL_ID, SerialPeer::ID);

		$criteria->addJoin(MmPeer::PRECINCT_ID, PrecinctPeer::ID);

		$criteria->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);

		$rs = MmPeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(MmPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MmPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MmPeer::SERIAL_ID, SerialPeer::ID);

		$criteria->addJoin(MmPeer::PRECINCT_ID, PrecinctPeer::ID);

		$criteria->addJoin(MmPeer::GENRE_ID, GenrePeer::ID);

		$rs = MmPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of Mm objects pre-filled with all related objects except Serial.
	 *
	 * @return     array Array of Mm objects.
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

		MmPeer::addSelectColumns($c);
		$startcol2 = (MmPeer::NUM_COLUMNS - MmPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PrecinctPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PrecinctPeer::NUM_COLUMNS;

		GenrePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + GenrePeer::NUM_COLUMNS;

		BroadcastPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + BroadcastPeer::NUM_COLUMNS;

		$c->addJoin(MmPeer::PRECINCT_ID, PrecinctPeer::ID);

		$c->addJoin(MmPeer::GENRE_ID, GenrePeer::ID);

		$c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmPeer::getOMClass();

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
					$temp_obj2->addMm($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initMms();
				$obj2->addMm($obj1);
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
					$temp_obj3->addMm($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initMms();
				$obj3->addMm($obj1);
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
					$temp_obj4->addMm($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initMms();
				$obj4->addMm($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Mm objects pre-filled with all related objects except Precinct.
	 *
	 * @return     array Array of Mm objects.
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

		MmPeer::addSelectColumns($c);
		$startcol2 = (MmPeer::NUM_COLUMNS - MmPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SerialPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SerialPeer::NUM_COLUMNS;

		GenrePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + GenrePeer::NUM_COLUMNS;

		BroadcastPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + BroadcastPeer::NUM_COLUMNS;

		$c->addJoin(MmPeer::SERIAL_ID, SerialPeer::ID);

		$c->addJoin(MmPeer::GENRE_ID, GenrePeer::ID);

		$c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmPeer::getOMClass();

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
					$temp_obj2->addMm($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initMms();
				$obj2->addMm($obj1);
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
					$temp_obj3->addMm($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initMms();
				$obj3->addMm($obj1);
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
					$temp_obj4->addMm($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initMms();
				$obj4->addMm($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Mm objects pre-filled with all related objects except Genre.
	 *
	 * @return     array Array of Mm objects.
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

		MmPeer::addSelectColumns($c);
		$startcol2 = (MmPeer::NUM_COLUMNS - MmPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SerialPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SerialPeer::NUM_COLUMNS;

		PrecinctPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PrecinctPeer::NUM_COLUMNS;

		BroadcastPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + BroadcastPeer::NUM_COLUMNS;

		$c->addJoin(MmPeer::SERIAL_ID, SerialPeer::ID);

		$c->addJoin(MmPeer::PRECINCT_ID, PrecinctPeer::ID);

		$c->addJoin(MmPeer::BROADCAST_ID, BroadcastPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmPeer::getOMClass();

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
					$temp_obj2->addMm($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initMms();
				$obj2->addMm($obj1);
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
					$temp_obj3->addMm($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initMms();
				$obj3->addMm($obj1);
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
					$temp_obj4->addMm($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initMms();
				$obj4->addMm($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of Mm objects pre-filled with all related objects except Broadcast.
	 *
	 * @return     array Array of Mm objects.
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

		MmPeer::addSelectColumns($c);
		$startcol2 = (MmPeer::NUM_COLUMNS - MmPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SerialPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SerialPeer::NUM_COLUMNS;

		PrecinctPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PrecinctPeer::NUM_COLUMNS;

		GenrePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + GenrePeer::NUM_COLUMNS;

		$c->addJoin(MmPeer::SERIAL_ID, SerialPeer::ID);

		$c->addJoin(MmPeer::PRECINCT_ID, PrecinctPeer::ID);

		$c->addJoin(MmPeer::GENRE_ID, GenrePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MmPeer::getOMClass();

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
					$temp_obj2->addMm($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initMms();
				$obj2->addMm($obj1);
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
					$temp_obj3->addMm($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initMms();
				$obj3->addMm($obj1);
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
					$temp_obj4->addMm($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initMms();
				$obj4->addMm($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


  /**
   * Selects a collection of Mm objects pre-filled with their i18n objects.
   *
   * @return array Array of Mm objects.
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

    MmPeer::addSelectColumns($c);
    $startcol = (MmPeer::NUM_COLUMNS - MmPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

    MmI18nPeer::addSelectColumns($c);

    $c->addJoin(MmPeer::ID, MmI18nPeer::ID);
    $c->add(MmI18nPeer::CULTURE, $culture);

    if(count($c->getOrderByColumns()) == 0) $c->addAscendingOrderByColumn(self::RANK);

    $rs = BasePeer::doSelect($c, $con);
    $results = array();

    while($rs->next()) {

      $omClass = MmPeer::getOMClass();

      $cls = Propel::import($omClass);
      $obj1 = new $cls();
      $obj1->hydrate($rs);
      $obj1->setCulture($culture);

      $omClass = MmI18nPeer::getOMClass($rs, $startcol);

      $cls = Propel::import($omClass);
      $obj2 = new $cls();
      $obj2->hydrate($rs, $startcol);

      $obj1->setMmI18nForCulture($obj2, $culture);
      $obj2->setMm($obj1);

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
		return MmPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a Mm or Criteria object.
	 *
	 * @param      mixed $values Criteria or Mm object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseMmPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseMmPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from Mm object
		}

		$criteria->remove(MmPeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseMmPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseMmPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a Mm or Criteria object.
	 *
	 * @param      mixed $values Criteria or Mm object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseMmPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseMmPeer', $values, $con);
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

			$comparison = $criteria->getComparison(MmPeer::ID);
			$selectCriteria->add(MmPeer::ID, $criteria->remove(MmPeer::ID), $comparison);

		} else { // $values is Mm object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseMmPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseMmPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the mm table.
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
			$affectedRows += MmPeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(MmPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a Mm or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or Mm object or primary key or array of primary keys
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
			$con = Propel::getConnection(MmPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof Mm) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(MmPeer::ID, (array) $values, Criteria::IN);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			$affectedRows += MmPeer::doOnDeleteCascade($criteria, $con);
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
		$objects = MmPeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/MmI18n.php';

			// delete related MmI18n objects
			$c = new Criteria();
			
			$c->add(MmI18nPeer::ID, $obj->getId());
			$affectedRows += MmI18nPeer::doDelete($c, $con);

			include_once 'lib/model/File.php';

			// delete related File objects
			$c = new Criteria();
			
			$c->add(FilePeer::MM_ID, $obj->getId());
			$affectedRows += FilePeer::doDelete($c, $con);

			include_once 'lib/model/Link.php';

			// delete related Link objects
			$c = new Criteria();
			
			$c->add(LinkPeer::MM_ID, $obj->getId());
			$affectedRows += LinkPeer::doDelete($c, $con);

			include_once 'lib/model/MmPerson.php';

			// delete related MmPerson objects
			$c = new Criteria();
			
			$c->add(MmPersonPeer::MM_ID, $obj->getId());
			$affectedRows += MmPersonPeer::doDelete($c, $con);

			include_once 'lib/model/PicMm.php';

			// delete related PicMm objects
			$c = new Criteria();
			
			$c->add(PicMmPeer::OTHER_ID, $obj->getId());
			$affectedRows += PicMmPeer::doDelete($c, $con);

			include_once 'lib/model/GroundMm.php';

			// delete related GroundMm objects
			$c = new Criteria();
			
			$c->add(GroundMmPeer::MM_ID, $obj->getId());
			$affectedRows += GroundMmPeer::doDelete($c, $con);

			include_once 'lib/model/Material.php';

			// delete related Material objects
			$c = new Criteria();
			
			$c->add(MaterialPeer::MM_ID, $obj->getId());
			$affectedRows += MaterialPeer::doDelete($c, $con);

			include_once 'lib/model/LogTranscoding.php';

			// delete related LogTranscoding objects
			$c = new Criteria();
			
			$c->add(LogTranscodingPeer::MM_ID, $obj->getId());
			$affectedRows += LogTranscodingPeer::doDelete($c, $con);

			include_once 'lib/model/Transcoding.php';

			// delete related Transcoding objects
			$c = new Criteria();
			
			$c->add(TranscodingPeer::MM_ID, $obj->getId());
			$affectedRows += TranscodingPeer::doDelete($c, $con);

			include_once 'lib/model/PubChannelMm.php';

			// delete related PubChannelMm objects
			$c = new Criteria();
			
			$c->add(PubChannelMmPeer::MM_ID, $obj->getId());
			$affectedRows += PubChannelMmPeer::doDelete($c, $con);

			include_once 'lib/model/AnnounceChannelMm.php';

			// delete related AnnounceChannelMm objects
			$c = new Criteria();
			
			$c->add(AnnounceChannelMmPeer::MM_ID, $obj->getId());
			$affectedRows += AnnounceChannelMmPeer::doDelete($c, $con);

			include_once 'lib/model/MmMatterhorn.php';

			// delete related MmMatterhorn objects
			$c = new Criteria();
			
			$c->add(MmMatterhornPeer::ID, $obj->getId());
			$affectedRows += MmMatterhornPeer::doDelete($c, $con);

			include_once 'lib/model/CategoryMm.php';

			// delete related CategoryMm objects
			$c = new Criteria();
			
			$c->add(CategoryMmPeer::MM_ID, $obj->getId());
			$affectedRows += CategoryMmPeer::doDelete($c, $con);

			include_once 'lib/model/CategoryMmTimeframe.php';

			// delete related CategoryMmTimeframe objects
			$c = new Criteria();
			
			$c->add(CategoryMmTimeframePeer::MM_ID, $obj->getId());
			$affectedRows += CategoryMmTimeframePeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	/**
	 * Validates all modified columns of given Mm object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      Mm $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(Mm $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(MmPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(MmPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(MmPeer::DATABASE_NAME, MmPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = MmPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     Mm
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(MmPeer::DATABASE_NAME);

		$criteria->add(MmPeer::ID, $pk);


		$v = MmPeer::doSelect($criteria, $con);

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
			$criteria->add(MmPeer::ID, $pks, Criteria::IN);
			$objs = MmPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

	/**
	 * Retrieve a single object by pkey with their i18n objects.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     Mm
	 */
	public static function retrieveByPKWithI18n($pk, $culture = null, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(MmPeer::DATABASE_NAME);

		$criteria->add(MmPeer::ID, $pk);


		$v = MmPeer::doSelectWithI18n($criteria, $culture, $con);

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
			$criteria->add(MmPeer::ID, $pks, Criteria::IN);
			$objs = MmPeer::doSelectWithI18n($criteria, $culture, $con);
		}
		return $objs;
	}

} // BaseMmPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseMmPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/MmMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.MmMapBuilder');
}
