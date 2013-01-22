<?php

/**
 * Base static class for performing query and update operations on the 'log_transcoding' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseLogTranscodingPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'log_transcoding';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.LogTranscoding';

	/** The total number of columns. */
	const NUM_COLUMNS = 20;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'log_transcoding.ID';

	/** the column name for the MM_ID field */
	const MM_ID = 'log_transcoding.MM_ID';

	/** the column name for the LANGUAGE_ID field */
	const LANGUAGE_ID = 'log_transcoding.LANGUAGE_ID';

	/** the column name for the PERFIL_ID field */
	const PERFIL_ID = 'log_transcoding.PERFIL_ID';

	/** the column name for the CPU_ID field */
	const CPU_ID = 'log_transcoding.CPU_ID';

	/** the column name for the URL field */
	const URL = 'log_transcoding.URL';

	/** the column name for the STATUS_ID field */
	const STATUS_ID = 'log_transcoding.STATUS_ID';

	/** the column name for the PRIORITY field */
	const PRIORITY = 'log_transcoding.PRIORITY';

	/** the column name for the NAME field */
	const NAME = 'log_transcoding.NAME';

	/** the column name for the TIMEINI field */
	const TIMEINI = 'log_transcoding.TIMEINI';

	/** the column name for the TIMESTART field */
	const TIMESTART = 'log_transcoding.TIMESTART';

	/** the column name for the TIMEEND field */
	const TIMEEND = 'log_transcoding.TIMEEND';

	/** the column name for the PID field */
	const PID = 'log_transcoding.PID';

	/** the column name for the PATH_INI field */
	const PATH_INI = 'log_transcoding.PATH_INI';

	/** the column name for the PATH_END field */
	const PATH_END = 'log_transcoding.PATH_END';

	/** the column name for the EXT_INI field */
	const EXT_INI = 'log_transcoding.EXT_INI';

	/** the column name for the EXT_END field */
	const EXT_END = 'log_transcoding.EXT_END';

	/** the column name for the DURATION field */
	const DURATION = 'log_transcoding.DURATION';

	/** the column name for the SIZE field */
	const SIZE = 'log_transcoding.SIZE';

	/** the column name for the EMAIL field */
	const EMAIL = 'log_transcoding.EMAIL';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'MmId', 'LanguageId', 'PerfilId', 'CpuId', 'Url', 'StatusId', 'Priority', 'Name', 'Timeini', 'Timestart', 'Timeend', 'Pid', 'PathIni', 'PathEnd', 'ExtIni', 'ExtEnd', 'Duration', 'Size', 'Email', ),
		BasePeer::TYPE_COLNAME => array (LogTranscodingPeer::ID, LogTranscodingPeer::MM_ID, LogTranscodingPeer::LANGUAGE_ID, LogTranscodingPeer::PERFIL_ID, LogTranscodingPeer::CPU_ID, LogTranscodingPeer::URL, LogTranscodingPeer::STATUS_ID, LogTranscodingPeer::PRIORITY, LogTranscodingPeer::NAME, LogTranscodingPeer::TIMEINI, LogTranscodingPeer::TIMESTART, LogTranscodingPeer::TIMEEND, LogTranscodingPeer::PID, LogTranscodingPeer::PATH_INI, LogTranscodingPeer::PATH_END, LogTranscodingPeer::EXT_INI, LogTranscodingPeer::EXT_END, LogTranscodingPeer::DURATION, LogTranscodingPeer::SIZE, LogTranscodingPeer::EMAIL, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'mm_id', 'language_id', 'perfil_id', 'cpu_id', 'url', 'status_id', 'priority', 'name', 'timeini', 'timestart', 'timeend', 'pid', 'path_ini', 'path_end', 'ext_ini', 'ext_end', 'duration', 'size', 'email', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'MmId' => 1, 'LanguageId' => 2, 'PerfilId' => 3, 'CpuId' => 4, 'Url' => 5, 'StatusId' => 6, 'Priority' => 7, 'Name' => 8, 'Timeini' => 9, 'Timestart' => 10, 'Timeend' => 11, 'Pid' => 12, 'PathIni' => 13, 'PathEnd' => 14, 'ExtIni' => 15, 'ExtEnd' => 16, 'Duration' => 17, 'Size' => 18, 'Email' => 19, ),
		BasePeer::TYPE_COLNAME => array (LogTranscodingPeer::ID => 0, LogTranscodingPeer::MM_ID => 1, LogTranscodingPeer::LANGUAGE_ID => 2, LogTranscodingPeer::PERFIL_ID => 3, LogTranscodingPeer::CPU_ID => 4, LogTranscodingPeer::URL => 5, LogTranscodingPeer::STATUS_ID => 6, LogTranscodingPeer::PRIORITY => 7, LogTranscodingPeer::NAME => 8, LogTranscodingPeer::TIMEINI => 9, LogTranscodingPeer::TIMESTART => 10, LogTranscodingPeer::TIMEEND => 11, LogTranscodingPeer::PID => 12, LogTranscodingPeer::PATH_INI => 13, LogTranscodingPeer::PATH_END => 14, LogTranscodingPeer::EXT_INI => 15, LogTranscodingPeer::EXT_END => 16, LogTranscodingPeer::DURATION => 17, LogTranscodingPeer::SIZE => 18, LogTranscodingPeer::EMAIL => 19, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'mm_id' => 1, 'language_id' => 2, 'perfil_id' => 3, 'cpu_id' => 4, 'url' => 5, 'status_id' => 6, 'priority' => 7, 'name' => 8, 'timeini' => 9, 'timestart' => 10, 'timeend' => 11, 'pid' => 12, 'path_ini' => 13, 'path_end' => 14, 'ext_ini' => 15, 'ext_end' => 16, 'duration' => 17, 'size' => 18, 'email' => 19, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/LogTranscodingMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.LogTranscodingMapBuilder');
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
			$map = LogTranscodingPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. LogTranscodingPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(LogTranscodingPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(LogTranscodingPeer::ID);

		$criteria->addSelectColumn(LogTranscodingPeer::MM_ID);

		$criteria->addSelectColumn(LogTranscodingPeer::LANGUAGE_ID);

		$criteria->addSelectColumn(LogTranscodingPeer::PERFIL_ID);

		$criteria->addSelectColumn(LogTranscodingPeer::CPU_ID);

		$criteria->addSelectColumn(LogTranscodingPeer::URL);

		$criteria->addSelectColumn(LogTranscodingPeer::STATUS_ID);

		$criteria->addSelectColumn(LogTranscodingPeer::PRIORITY);

		$criteria->addSelectColumn(LogTranscodingPeer::NAME);

		$criteria->addSelectColumn(LogTranscodingPeer::TIMEINI);

		$criteria->addSelectColumn(LogTranscodingPeer::TIMESTART);

		$criteria->addSelectColumn(LogTranscodingPeer::TIMEEND);

		$criteria->addSelectColumn(LogTranscodingPeer::PID);

		$criteria->addSelectColumn(LogTranscodingPeer::PATH_INI);

		$criteria->addSelectColumn(LogTranscodingPeer::PATH_END);

		$criteria->addSelectColumn(LogTranscodingPeer::EXT_INI);

		$criteria->addSelectColumn(LogTranscodingPeer::EXT_END);

		$criteria->addSelectColumn(LogTranscodingPeer::DURATION);

		$criteria->addSelectColumn(LogTranscodingPeer::SIZE);

		$criteria->addSelectColumn(LogTranscodingPeer::EMAIL);

	}

	const COUNT = 'COUNT(log_transcoding.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT log_transcoding.ID)';

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
			$criteria->addSelectColumn(LogTranscodingPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(LogTranscodingPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = LogTranscodingPeer::doSelectRS($criteria, $con);
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
	 * @return     LogTranscoding
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = LogTranscodingPeer::doSelect($critcopy, $con);
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
		return LogTranscodingPeer::populateObjects(LogTranscodingPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseLogTranscodingPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseLogTranscodingPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			LogTranscodingPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

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
		$cls = LogTranscodingPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related Mm table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinMm(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(LogTranscodingPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(LogTranscodingPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(LogTranscodingPeer::MM_ID, MmPeer::ID);

		$rs = LogTranscodingPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Language table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinLanguage(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(LogTranscodingPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(LogTranscodingPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(LogTranscodingPeer::LANGUAGE_ID, LanguagePeer::ID);

		$rs = LogTranscodingPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Perfil table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinPerfil(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(LogTranscodingPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(LogTranscodingPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(LogTranscodingPeer::PERFIL_ID, PerfilPeer::ID);

		$rs = LogTranscodingPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Cpu table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinCpu(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(LogTranscodingPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(LogTranscodingPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(LogTranscodingPeer::CPU_ID, CpuPeer::ID);

		$rs = LogTranscodingPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of LogTranscoding objects pre-filled with their Mm objects.
	 *
	 * @return     array Array of LogTranscoding objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinMm(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		LogTranscodingPeer::addSelectColumns($c);
		$startcol = (LogTranscodingPeer::NUM_COLUMNS - LogTranscodingPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		MmPeer::addSelectColumns($c);

		$c->addJoin(LogTranscodingPeer::MM_ID, MmPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = LogTranscodingPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = MmPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getMm(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addLogTranscoding($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initLogTranscodings();
				$obj2->addLogTranscoding($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of LogTranscoding objects pre-filled with their Language objects.
	 *
	 * @return     array Array of LogTranscoding objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinLanguage(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		LogTranscodingPeer::addSelectColumns($c);
		$startcol = (LogTranscodingPeer::NUM_COLUMNS - LogTranscodingPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		LanguagePeer::addSelectColumns($c);

		$c->addJoin(LogTranscodingPeer::LANGUAGE_ID, LanguagePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = LogTranscodingPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = LanguagePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getLanguage(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addLogTranscoding($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initLogTranscodings();
				$obj2->addLogTranscoding($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of LogTranscoding objects pre-filled with their Perfil objects.
	 *
	 * @return     array Array of LogTranscoding objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinPerfil(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		LogTranscodingPeer::addSelectColumns($c);
		$startcol = (LogTranscodingPeer::NUM_COLUMNS - LogTranscodingPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PerfilPeer::addSelectColumns($c);

		$c->addJoin(LogTranscodingPeer::PERFIL_ID, PerfilPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = LogTranscodingPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PerfilPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPerfil(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addLogTranscoding($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initLogTranscodings();
				$obj2->addLogTranscoding($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of LogTranscoding objects pre-filled with their Cpu objects.
	 *
	 * @return     array Array of LogTranscoding objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinCpu(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		LogTranscodingPeer::addSelectColumns($c);
		$startcol = (LogTranscodingPeer::NUM_COLUMNS - LogTranscodingPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CpuPeer::addSelectColumns($c);

		$c->addJoin(LogTranscodingPeer::CPU_ID, CpuPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = LogTranscodingPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CpuPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCpu(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addLogTranscoding($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initLogTranscodings();
				$obj2->addLogTranscoding($obj1); //CHECKME
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
			$criteria->addSelectColumn(LogTranscodingPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(LogTranscodingPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(LogTranscodingPeer::MM_ID, MmPeer::ID);

		$criteria->addJoin(LogTranscodingPeer::LANGUAGE_ID, LanguagePeer::ID);

		$criteria->addJoin(LogTranscodingPeer::PERFIL_ID, PerfilPeer::ID);

		$criteria->addJoin(LogTranscodingPeer::CPU_ID, CpuPeer::ID);

		$rs = LogTranscodingPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of LogTranscoding objects pre-filled with all related objects.
	 *
	 * @return     array Array of LogTranscoding objects.
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

		LogTranscodingPeer::addSelectColumns($c);
		$startcol2 = (LogTranscodingPeer::NUM_COLUMNS - LogTranscodingPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MmPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MmPeer::NUM_COLUMNS;

		LanguagePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + LanguagePeer::NUM_COLUMNS;

		PerfilPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + PerfilPeer::NUM_COLUMNS;

		CpuPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + CpuPeer::NUM_COLUMNS;

		$c->addJoin(LogTranscodingPeer::MM_ID, MmPeer::ID);

		$c->addJoin(LogTranscodingPeer::LANGUAGE_ID, LanguagePeer::ID);

		$c->addJoin(LogTranscodingPeer::PERFIL_ID, PerfilPeer::ID);

		$c->addJoin(LogTranscodingPeer::CPU_ID, CpuPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = LogTranscodingPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined Mm rows
	
			$omClass = MmPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getMm(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addLogTranscoding($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initLogTranscodings();
				$obj2->addLogTranscoding($obj1);
			}


				// Add objects for joined Language rows
	
			$omClass = LanguagePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getLanguage(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addLogTranscoding($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initLogTranscodings();
				$obj3->addLogTranscoding($obj1);
			}


				// Add objects for joined Perfil rows
	
			$omClass = PerfilPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getPerfil(); // CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addLogTranscoding($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initLogTranscodings();
				$obj4->addLogTranscoding($obj1);
			}


				// Add objects for joined Cpu rows
	
			$omClass = CpuPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getCpu(); // CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addLogTranscoding($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj5->initLogTranscodings();
				$obj5->addLogTranscoding($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Mm table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptMm(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(LogTranscodingPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(LogTranscodingPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(LogTranscodingPeer::LANGUAGE_ID, LanguagePeer::ID);

		$criteria->addJoin(LogTranscodingPeer::PERFIL_ID, PerfilPeer::ID);

		$criteria->addJoin(LogTranscodingPeer::CPU_ID, CpuPeer::ID);

		$rs = LogTranscodingPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Language table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptLanguage(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(LogTranscodingPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(LogTranscodingPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(LogTranscodingPeer::MM_ID, MmPeer::ID);

		$criteria->addJoin(LogTranscodingPeer::PERFIL_ID, PerfilPeer::ID);

		$criteria->addJoin(LogTranscodingPeer::CPU_ID, CpuPeer::ID);

		$rs = LogTranscodingPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Perfil table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptPerfil(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(LogTranscodingPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(LogTranscodingPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(LogTranscodingPeer::MM_ID, MmPeer::ID);

		$criteria->addJoin(LogTranscodingPeer::LANGUAGE_ID, LanguagePeer::ID);

		$criteria->addJoin(LogTranscodingPeer::CPU_ID, CpuPeer::ID);

		$rs = LogTranscodingPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Cpu table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptCpu(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(LogTranscodingPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(LogTranscodingPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(LogTranscodingPeer::MM_ID, MmPeer::ID);

		$criteria->addJoin(LogTranscodingPeer::LANGUAGE_ID, LanguagePeer::ID);

		$criteria->addJoin(LogTranscodingPeer::PERFIL_ID, PerfilPeer::ID);

		$rs = LogTranscodingPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of LogTranscoding objects pre-filled with all related objects except Mm.
	 *
	 * @return     array Array of LogTranscoding objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptMm(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		LogTranscodingPeer::addSelectColumns($c);
		$startcol2 = (LogTranscodingPeer::NUM_COLUMNS - LogTranscodingPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		LanguagePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + LanguagePeer::NUM_COLUMNS;

		PerfilPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PerfilPeer::NUM_COLUMNS;

		CpuPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + CpuPeer::NUM_COLUMNS;

		$c->addJoin(LogTranscodingPeer::LANGUAGE_ID, LanguagePeer::ID);

		$c->addJoin(LogTranscodingPeer::PERFIL_ID, PerfilPeer::ID);

		$c->addJoin(LogTranscodingPeer::CPU_ID, CpuPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = LogTranscodingPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = LanguagePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getLanguage(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addLogTranscoding($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initLogTranscodings();
				$obj2->addLogTranscoding($obj1);
			}

			$omClass = PerfilPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPerfil(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addLogTranscoding($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initLogTranscodings();
				$obj3->addLogTranscoding($obj1);
			}

			$omClass = CpuPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getCpu(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addLogTranscoding($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initLogTranscodings();
				$obj4->addLogTranscoding($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of LogTranscoding objects pre-filled with all related objects except Language.
	 *
	 * @return     array Array of LogTranscoding objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptLanguage(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		LogTranscodingPeer::addSelectColumns($c);
		$startcol2 = (LogTranscodingPeer::NUM_COLUMNS - LogTranscodingPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MmPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MmPeer::NUM_COLUMNS;

		PerfilPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PerfilPeer::NUM_COLUMNS;

		CpuPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + CpuPeer::NUM_COLUMNS;

		$c->addJoin(LogTranscodingPeer::MM_ID, MmPeer::ID);

		$c->addJoin(LogTranscodingPeer::PERFIL_ID, PerfilPeer::ID);

		$c->addJoin(LogTranscodingPeer::CPU_ID, CpuPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = LogTranscodingPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = MmPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getMm(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addLogTranscoding($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initLogTranscodings();
				$obj2->addLogTranscoding($obj1);
			}

			$omClass = PerfilPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPerfil(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addLogTranscoding($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initLogTranscodings();
				$obj3->addLogTranscoding($obj1);
			}

			$omClass = CpuPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getCpu(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addLogTranscoding($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initLogTranscodings();
				$obj4->addLogTranscoding($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of LogTranscoding objects pre-filled with all related objects except Perfil.
	 *
	 * @return     array Array of LogTranscoding objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptPerfil(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		LogTranscodingPeer::addSelectColumns($c);
		$startcol2 = (LogTranscodingPeer::NUM_COLUMNS - LogTranscodingPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MmPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MmPeer::NUM_COLUMNS;

		LanguagePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + LanguagePeer::NUM_COLUMNS;

		CpuPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + CpuPeer::NUM_COLUMNS;

		$c->addJoin(LogTranscodingPeer::MM_ID, MmPeer::ID);

		$c->addJoin(LogTranscodingPeer::LANGUAGE_ID, LanguagePeer::ID);

		$c->addJoin(LogTranscodingPeer::CPU_ID, CpuPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = LogTranscodingPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = MmPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getMm(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addLogTranscoding($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initLogTranscodings();
				$obj2->addLogTranscoding($obj1);
			}

			$omClass = LanguagePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getLanguage(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addLogTranscoding($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initLogTranscodings();
				$obj3->addLogTranscoding($obj1);
			}

			$omClass = CpuPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getCpu(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addLogTranscoding($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initLogTranscodings();
				$obj4->addLogTranscoding($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of LogTranscoding objects pre-filled with all related objects except Cpu.
	 *
	 * @return     array Array of LogTranscoding objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptCpu(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		LogTranscodingPeer::addSelectColumns($c);
		$startcol2 = (LogTranscodingPeer::NUM_COLUMNS - LogTranscodingPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MmPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MmPeer::NUM_COLUMNS;

		LanguagePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + LanguagePeer::NUM_COLUMNS;

		PerfilPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + PerfilPeer::NUM_COLUMNS;

		$c->addJoin(LogTranscodingPeer::MM_ID, MmPeer::ID);

		$c->addJoin(LogTranscodingPeer::LANGUAGE_ID, LanguagePeer::ID);

		$c->addJoin(LogTranscodingPeer::PERFIL_ID, PerfilPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = LogTranscodingPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = MmPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getMm(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addLogTranscoding($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initLogTranscodings();
				$obj2->addLogTranscoding($obj1);
			}

			$omClass = LanguagePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getLanguage(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addLogTranscoding($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initLogTranscodings();
				$obj3->addLogTranscoding($obj1);
			}

			$omClass = PerfilPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getPerfil(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addLogTranscoding($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initLogTranscodings();
				$obj4->addLogTranscoding($obj1);
			}

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
		return LogTranscodingPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a LogTranscoding or Criteria object.
	 *
	 * @param      mixed $values Criteria or LogTranscoding object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseLogTranscodingPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseLogTranscodingPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from LogTranscoding object
		}

		$criteria->remove(LogTranscodingPeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseLogTranscodingPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseLogTranscodingPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a LogTranscoding or Criteria object.
	 *
	 * @param      mixed $values Criteria or LogTranscoding object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseLogTranscodingPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseLogTranscodingPeer', $values, $con);
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

			$comparison = $criteria->getComparison(LogTranscodingPeer::ID);
			$selectCriteria->add(LogTranscodingPeer::ID, $criteria->remove(LogTranscodingPeer::ID), $comparison);

		} else { // $values is LogTranscoding object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseLogTranscodingPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseLogTranscodingPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the log_transcoding table.
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
			$affectedRows += BasePeer::doDeleteAll(LogTranscodingPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a LogTranscoding or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or LogTranscoding object or primary key or array of primary keys
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
			$con = Propel::getConnection(LogTranscodingPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof LogTranscoding) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(LogTranscodingPeer::ID, (array) $values, Criteria::IN);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Validates all modified columns of given LogTranscoding object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      LogTranscoding $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(LogTranscoding $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(LogTranscodingPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(LogTranscodingPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(LogTranscodingPeer::DATABASE_NAME, LogTranscodingPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = LogTranscodingPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     LogTranscoding
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(LogTranscodingPeer::DATABASE_NAME);

		$criteria->add(LogTranscodingPeer::ID, $pk);


		$v = LogTranscodingPeer::doSelect($criteria, $con);

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
			$criteria->add(LogTranscodingPeer::ID, $pks, Criteria::IN);
			$objs = LogTranscodingPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseLogTranscodingPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseLogTranscodingPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/LogTranscodingMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.LogTranscodingMapBuilder');
}
