<?php

/**
 * Base static class for performing query and update operations on the 'pub_channel_perfil' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BasePubChannelPerfilPeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'pub_channel_perfil';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.PubChannelPerfil';

	/** The total number of columns. */
	const NUM_COLUMNS = 4;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the PUB_CHANNEL_ID field */
	const PUB_CHANNEL_ID = 'pub_channel_perfil.PUB_CHANNEL_ID';

	/** the column name for the PERFIL_43_ID field */
	const PERFIL_43_ID = 'pub_channel_perfil.PERFIL_43_ID';

	/** the column name for the PERFIL_169_ID field */
	const PERFIL_169_ID = 'pub_channel_perfil.PERFIL_169_ID';

	/** the column name for the PERFIL_AUDIO_ID field */
	const PERFIL_AUDIO_ID = 'pub_channel_perfil.PERFIL_AUDIO_ID';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('PubChannelId', 'Perfil43Id', 'Perfil169Id', 'PerfilAudioId', ),
		BasePeer::TYPE_COLNAME => array (PubChannelPerfilPeer::PUB_CHANNEL_ID, PubChannelPerfilPeer::PERFIL_43_ID, PubChannelPerfilPeer::PERFIL_169_ID, PubChannelPerfilPeer::PERFIL_AUDIO_ID, ),
		BasePeer::TYPE_FIELDNAME => array ('pub_channel_id', 'perfil_43_id', 'perfil_169_id', 'perfil_audio_id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('PubChannelId' => 0, 'Perfil43Id' => 1, 'Perfil169Id' => 2, 'PerfilAudioId' => 3, ),
		BasePeer::TYPE_COLNAME => array (PubChannelPerfilPeer::PUB_CHANNEL_ID => 0, PubChannelPerfilPeer::PERFIL_43_ID => 1, PubChannelPerfilPeer::PERFIL_169_ID => 2, PubChannelPerfilPeer::PERFIL_AUDIO_ID => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('pub_channel_id' => 0, 'perfil_43_id' => 1, 'perfil_169_id' => 2, 'perfil_audio_id' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PubChannelPerfilMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PubChannelPerfilMapBuilder');
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
			$map = PubChannelPerfilPeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. PubChannelPerfilPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(PubChannelPerfilPeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(PubChannelPerfilPeer::PUB_CHANNEL_ID);

		$criteria->addSelectColumn(PubChannelPerfilPeer::PERFIL_43_ID);

		$criteria->addSelectColumn(PubChannelPerfilPeer::PERFIL_169_ID);

		$criteria->addSelectColumn(PubChannelPerfilPeer::PERFIL_AUDIO_ID);

	}

	const COUNT = 'COUNT(pub_channel_perfil.PUB_CHANNEL_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT pub_channel_perfil.PUB_CHANNEL_ID)';

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
			$criteria->addSelectColumn(PubChannelPerfilPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PubChannelPerfilPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PubChannelPerfilPeer::doSelectRS($criteria, $con);
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
	 * @return     PubChannelPerfil
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = PubChannelPerfilPeer::doSelect($critcopy, $con);
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
		return PubChannelPerfilPeer::populateObjects(PubChannelPerfilPeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BasePubChannelPerfilPeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BasePubChannelPerfilPeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PubChannelPerfilPeer::addSelectColumns($criteria);
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
		$cls = PubChannelPerfilPeer::getOMClass();
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
	 * Returns the number of rows matching criteria, joining the related PubChannel table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinPubChannel(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PubChannelPerfilPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PubChannelPerfilPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PubChannelPerfilPeer::PUB_CHANNEL_ID, PubChannelPeer::ID);

		$rs = PubChannelPerfilPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related PerfilRelatedByPerfil43Id table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinPerfilRelatedByPerfil43Id(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PubChannelPerfilPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PubChannelPerfilPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PubChannelPerfilPeer::PERFIL_43_ID, PerfilPeer::ID);

		$rs = PubChannelPerfilPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related PerfilRelatedByPerfil169Id table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinPerfilRelatedByPerfil169Id(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PubChannelPerfilPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PubChannelPerfilPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PubChannelPerfilPeer::PERFIL_169_ID, PerfilPeer::ID);

		$rs = PubChannelPerfilPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related PerfilRelatedByPerfilAudioId table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinPerfilRelatedByPerfilAudioId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PubChannelPerfilPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PubChannelPerfilPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PubChannelPerfilPeer::PERFIL_AUDIO_ID, PerfilPeer::ID);

		$rs = PubChannelPerfilPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of PubChannelPerfil objects pre-filled with their PubChannel objects.
	 *
	 * @return     array Array of PubChannelPerfil objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinPubChannel(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PubChannelPerfilPeer::addSelectColumns($c);
		$startcol = (PubChannelPerfilPeer::NUM_COLUMNS - PubChannelPerfilPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PubChannelPeer::addSelectColumns($c);

		$c->addJoin(PubChannelPerfilPeer::PUB_CHANNEL_ID, PubChannelPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PubChannelPerfilPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PubChannelPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPubChannel(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addPubChannelPerfil($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initPubChannelPerfils();
				$obj2->addPubChannelPerfil($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of PubChannelPerfil objects pre-filled with their Perfil objects.
	 *
	 * @return     array Array of PubChannelPerfil objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinPerfilRelatedByPerfil43Id(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PubChannelPerfilPeer::addSelectColumns($c);
		$startcol = (PubChannelPerfilPeer::NUM_COLUMNS - PubChannelPerfilPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PerfilPeer::addSelectColumns($c);

		$c->addJoin(PubChannelPerfilPeer::PERFIL_43_ID, PerfilPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PubChannelPerfilPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PerfilPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPerfilRelatedByPerfil43Id(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addPubChannelPerfilRelatedByPerfil43Id($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initPubChannelPerfilsRelatedByPerfil43Id();
				$obj2->addPubChannelPerfilRelatedByPerfil43Id($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of PubChannelPerfil objects pre-filled with their Perfil objects.
	 *
	 * @return     array Array of PubChannelPerfil objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinPerfilRelatedByPerfil169Id(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PubChannelPerfilPeer::addSelectColumns($c);
		$startcol = (PubChannelPerfilPeer::NUM_COLUMNS - PubChannelPerfilPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PerfilPeer::addSelectColumns($c);

		$c->addJoin(PubChannelPerfilPeer::PERFIL_169_ID, PerfilPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PubChannelPerfilPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PerfilPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPerfilRelatedByPerfil169Id(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addPubChannelPerfilRelatedByPerfil169Id($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initPubChannelPerfilsRelatedByPerfil169Id();
				$obj2->addPubChannelPerfilRelatedByPerfil169Id($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of PubChannelPerfil objects pre-filled with their Perfil objects.
	 *
	 * @return     array Array of PubChannelPerfil objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinPerfilRelatedByPerfilAudioId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PubChannelPerfilPeer::addSelectColumns($c);
		$startcol = (PubChannelPerfilPeer::NUM_COLUMNS - PubChannelPerfilPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PerfilPeer::addSelectColumns($c);

		$c->addJoin(PubChannelPerfilPeer::PERFIL_AUDIO_ID, PerfilPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PubChannelPerfilPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PerfilPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPerfilRelatedByPerfilAudioId(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addPubChannelPerfilRelatedByPerfilAudioId($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initPubChannelPerfilsRelatedByPerfilAudioId();
				$obj2->addPubChannelPerfilRelatedByPerfilAudioId($obj1); //CHECKME
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
			$criteria->addSelectColumn(PubChannelPerfilPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PubChannelPerfilPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PubChannelPerfilPeer::PUB_CHANNEL_ID, PubChannelPeer::ID);

		$criteria->addJoin(PubChannelPerfilPeer::PERFIL_43_ID, PerfilPeer::ID);

		$criteria->addJoin(PubChannelPerfilPeer::PERFIL_169_ID, PerfilPeer::ID);

		$criteria->addJoin(PubChannelPerfilPeer::PERFIL_AUDIO_ID, PerfilPeer::ID);

		$rs = PubChannelPerfilPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of PubChannelPerfil objects pre-filled with all related objects.
	 *
	 * @return     array Array of PubChannelPerfil objects.
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

		PubChannelPerfilPeer::addSelectColumns($c);
		$startcol2 = (PubChannelPerfilPeer::NUM_COLUMNS - PubChannelPerfilPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PubChannelPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PubChannelPeer::NUM_COLUMNS;

		PerfilPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PerfilPeer::NUM_COLUMNS;

		PerfilPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + PerfilPeer::NUM_COLUMNS;

		PerfilPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + PerfilPeer::NUM_COLUMNS;

		$c->addJoin(PubChannelPerfilPeer::PUB_CHANNEL_ID, PubChannelPeer::ID);

		$c->addJoin(PubChannelPerfilPeer::PERFIL_43_ID, PerfilPeer::ID);

		$c->addJoin(PubChannelPerfilPeer::PERFIL_169_ID, PerfilPeer::ID);

		$c->addJoin(PubChannelPerfilPeer::PERFIL_AUDIO_ID, PerfilPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PubChannelPerfilPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


				// Add objects for joined PubChannel rows
	
			$omClass = PubChannelPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPubChannel(); // CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPubChannelPerfil($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initPubChannelPerfils();
				$obj2->addPubChannelPerfil($obj1);
			}


				// Add objects for joined Perfil rows
	
			$omClass = PerfilPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPerfilRelatedByPerfil43Id(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPubChannelPerfilRelatedByPerfil43Id($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initPubChannelPerfilsRelatedByPerfil43Id();
				$obj3->addPubChannelPerfilRelatedByPerfil43Id($obj1);
			}


				// Add objects for joined Perfil rows
	
			$omClass = PerfilPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getPerfilRelatedByPerfil169Id(); // CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addPubChannelPerfilRelatedByPerfil169Id($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initPubChannelPerfilsRelatedByPerfil169Id();
				$obj4->addPubChannelPerfilRelatedByPerfil169Id($obj1);
			}


				// Add objects for joined Perfil rows
	
			$omClass = PerfilPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getPerfilRelatedByPerfilAudioId(); // CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addPubChannelPerfilRelatedByPerfilAudioId($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj5->initPubChannelPerfilsRelatedByPerfilAudioId();
				$obj5->addPubChannelPerfilRelatedByPerfilAudioId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Returns the number of rows matching criteria, joining the related PubChannel table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptPubChannel(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PubChannelPerfilPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PubChannelPerfilPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PubChannelPerfilPeer::PERFIL_43_ID, PerfilPeer::ID);

		$criteria->addJoin(PubChannelPerfilPeer::PERFIL_169_ID, PerfilPeer::ID);

		$criteria->addJoin(PubChannelPerfilPeer::PERFIL_AUDIO_ID, PerfilPeer::ID);

		$rs = PubChannelPerfilPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related PerfilRelatedByPerfil43Id table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptPerfilRelatedByPerfil43Id(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PubChannelPerfilPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PubChannelPerfilPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PubChannelPerfilPeer::PUB_CHANNEL_ID, PubChannelPeer::ID);

		$rs = PubChannelPerfilPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related PerfilRelatedByPerfil169Id table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptPerfilRelatedByPerfil169Id(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PubChannelPerfilPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PubChannelPerfilPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PubChannelPerfilPeer::PUB_CHANNEL_ID, PubChannelPeer::ID);

		$rs = PubChannelPerfilPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related PerfilRelatedByPerfilAudioId table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptPerfilRelatedByPerfilAudioId(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PubChannelPerfilPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PubChannelPerfilPeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(PubChannelPerfilPeer::PUB_CHANNEL_ID, PubChannelPeer::ID);

		$rs = PubChannelPerfilPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of PubChannelPerfil objects pre-filled with all related objects except PubChannel.
	 *
	 * @return     array Array of PubChannelPerfil objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptPubChannel(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PubChannelPerfilPeer::addSelectColumns($c);
		$startcol2 = (PubChannelPerfilPeer::NUM_COLUMNS - PubChannelPerfilPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PerfilPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PerfilPeer::NUM_COLUMNS;

		PerfilPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PerfilPeer::NUM_COLUMNS;

		PerfilPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + PerfilPeer::NUM_COLUMNS;

		$c->addJoin(PubChannelPerfilPeer::PERFIL_43_ID, PerfilPeer::ID);

		$c->addJoin(PubChannelPerfilPeer::PERFIL_169_ID, PerfilPeer::ID);

		$c->addJoin(PubChannelPerfilPeer::PERFIL_AUDIO_ID, PerfilPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PubChannelPerfilPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PerfilPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPerfilRelatedByPerfil43Id(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPubChannelPerfilRelatedByPerfil43Id($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPubChannelPerfilsRelatedByPerfil43Id();
				$obj2->addPubChannelPerfilRelatedByPerfil43Id($obj1);
			}

			$omClass = PerfilPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3  = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPerfilRelatedByPerfil169Id(); //CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addPubChannelPerfilRelatedByPerfil169Id($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initPubChannelPerfilsRelatedByPerfil169Id();
				$obj3->addPubChannelPerfilRelatedByPerfil169Id($obj1);
			}

			$omClass = PerfilPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getPerfilRelatedByPerfilAudioId(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addPubChannelPerfilRelatedByPerfilAudioId($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initPubChannelPerfilsRelatedByPerfilAudioId();
				$obj4->addPubChannelPerfilRelatedByPerfilAudioId($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of PubChannelPerfil objects pre-filled with all related objects except PerfilRelatedByPerfil43Id.
	 *
	 * @return     array Array of PubChannelPerfil objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptPerfilRelatedByPerfil43Id(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PubChannelPerfilPeer::addSelectColumns($c);
		$startcol2 = (PubChannelPerfilPeer::NUM_COLUMNS - PubChannelPerfilPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PubChannelPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PubChannelPeer::NUM_COLUMNS;

		$c->addJoin(PubChannelPerfilPeer::PUB_CHANNEL_ID, PubChannelPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PubChannelPerfilPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PubChannelPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPubChannel(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPubChannelPerfil($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPubChannelPerfils();
				$obj2->addPubChannelPerfil($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of PubChannelPerfil objects pre-filled with all related objects except PerfilRelatedByPerfil169Id.
	 *
	 * @return     array Array of PubChannelPerfil objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptPerfilRelatedByPerfil169Id(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PubChannelPerfilPeer::addSelectColumns($c);
		$startcol2 = (PubChannelPerfilPeer::NUM_COLUMNS - PubChannelPerfilPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PubChannelPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PubChannelPeer::NUM_COLUMNS;

		$c->addJoin(PubChannelPerfilPeer::PUB_CHANNEL_ID, PubChannelPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PubChannelPerfilPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PubChannelPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPubChannel(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPubChannelPerfil($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPubChannelPerfils();
				$obj2->addPubChannelPerfil($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of PubChannelPerfil objects pre-filled with all related objects except PerfilRelatedByPerfilAudioId.
	 *
	 * @return     array Array of PubChannelPerfil objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptPerfilRelatedByPerfilAudioId(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		PubChannelPerfilPeer::addSelectColumns($c);
		$startcol2 = (PubChannelPerfilPeer::NUM_COLUMNS - PubChannelPerfilPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PubChannelPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PubChannelPeer::NUM_COLUMNS;

		$c->addJoin(PubChannelPerfilPeer::PUB_CHANNEL_ID, PubChannelPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = PubChannelPerfilPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PubChannelPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPubChannel(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addPubChannelPerfil($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initPubChannelPerfils();
				$obj2->addPubChannelPerfil($obj1);
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
		return PubChannelPerfilPeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a PubChannelPerfil or Criteria object.
	 *
	 * @param      mixed $values Criteria or PubChannelPerfil object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasePubChannelPerfilPeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePubChannelPerfilPeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from PubChannelPerfil object
		}


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

		
    foreach (sfMixer::getCallables('BasePubChannelPerfilPeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BasePubChannelPerfilPeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a PubChannelPerfil or Criteria object.
	 *
	 * @param      mixed $values Criteria or PubChannelPerfil object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BasePubChannelPerfilPeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BasePubChannelPerfilPeer', $values, $con);
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

			$comparison = $criteria->getComparison(PubChannelPerfilPeer::PUB_CHANNEL_ID);
			$selectCriteria->add(PubChannelPerfilPeer::PUB_CHANNEL_ID, $criteria->remove(PubChannelPerfilPeer::PUB_CHANNEL_ID), $comparison);

			$comparison = $criteria->getComparison(PubChannelPerfilPeer::PERFIL_43_ID);
			$selectCriteria->add(PubChannelPerfilPeer::PERFIL_43_ID, $criteria->remove(PubChannelPerfilPeer::PERFIL_43_ID), $comparison);

			$comparison = $criteria->getComparison(PubChannelPerfilPeer::PERFIL_169_ID);
			$selectCriteria->add(PubChannelPerfilPeer::PERFIL_169_ID, $criteria->remove(PubChannelPerfilPeer::PERFIL_169_ID), $comparison);

			$comparison = $criteria->getComparison(PubChannelPerfilPeer::PERFIL_AUDIO_ID);
			$selectCriteria->add(PubChannelPerfilPeer::PERFIL_AUDIO_ID, $criteria->remove(PubChannelPerfilPeer::PERFIL_AUDIO_ID), $comparison);

		} else { // $values is PubChannelPerfil object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BasePubChannelPerfilPeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BasePubChannelPerfilPeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the pub_channel_perfil table.
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
			$affectedRows += BasePeer::doDeleteAll(PubChannelPerfilPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a PubChannelPerfil or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or PubChannelPerfil object or primary key or array of primary keys
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
			$con = Propel::getConnection(PubChannelPerfilPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof PubChannelPerfil) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			// primary key is composite; we therefore, expect
			// the primary key passed to be an array of pkey
			// values
			if(count($values) == count($values, COUNT_RECURSIVE))
			{
				// array is not multi-dimensional
				$values = array($values);
			}
			$vals = array();
			foreach($values as $value)
			{

				$vals[0][] = $value[0];
				$vals[1][] = $value[1];
				$vals[2][] = $value[2];
				$vals[3][] = $value[3];
			}

			$criteria->add(PubChannelPerfilPeer::PUB_CHANNEL_ID, $vals[0], Criteria::IN);
			$criteria->add(PubChannelPerfilPeer::PERFIL_43_ID, $vals[1], Criteria::IN);
			$criteria->add(PubChannelPerfilPeer::PERFIL_169_ID, $vals[2], Criteria::IN);
			$criteria->add(PubChannelPerfilPeer::PERFIL_AUDIO_ID, $vals[3], Criteria::IN);
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
	 * Validates all modified columns of given PubChannelPerfil object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      PubChannelPerfil $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(PubChannelPerfil $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PubChannelPerfilPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PubChannelPerfilPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(PubChannelPerfilPeer::DATABASE_NAME, PubChannelPerfilPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PubChannelPerfilPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	/**
	 * Retrieve object using using composite pkey values.
	 * @param int $pub_channel_id
	   @param int $perfil_43_id
	   @param int $perfil_169_id
	   @param int $perfil_audio_id
	   
	 * @param      Connection $con
	 * @return     PubChannelPerfil
	 */
	public static function retrieveByPK( $pub_channel_id, $perfil_43_id, $perfil_169_id, $perfil_audio_id, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(PubChannelPerfilPeer::PUB_CHANNEL_ID, $pub_channel_id);
		$criteria->add(PubChannelPerfilPeer::PERFIL_43_ID, $perfil_43_id);
		$criteria->add(PubChannelPerfilPeer::PERFIL_169_ID, $perfil_169_id);
		$criteria->add(PubChannelPerfilPeer::PERFIL_AUDIO_ID, $perfil_audio_id);
		$v = PubChannelPerfilPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} // BasePubChannelPerfilPeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BasePubChannelPerfilPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/PubChannelPerfilMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PubChannelPerfilMapBuilder');
}
