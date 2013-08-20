<?php

/**
 * Base static class for performing query and update operations on the 'file' table.
 *
 * 
 *
 * @package    lib.model.om
 */
abstract class BaseFilePeer {

	/** the default database name for this class */
	const DATABASE_NAME = 'propel';

	/** the table name for this class */
	const TABLE_NAME = 'file';

	/** A class that can be returned by this peer. */
	const CLASS_DEFAULT = 'lib.model.File';

	/** The total number of columns. */
	const NUM_COLUMNS = 24;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;


	/** the column name for the ID field */
	const ID = 'file.ID';

	/** the column name for the MM_ID field */
	const MM_ID = 'file.MM_ID';

	/** the column name for the PERFIL_ID field */
	const PERFIL_ID = 'file.PERFIL_ID';

	/** the column name for the LANGUAGE_ID field */
	const LANGUAGE_ID = 'file.LANGUAGE_ID';

	/** the column name for the URL field */
	const URL = 'file.URL';

	/** the column name for the FILE field */
	const FILE = 'file.FILE';

	/** the column name for the FORMAT_ID field */
	const FORMAT_ID = 'file.FORMAT_ID';

	/** the column name for the CODEC_ID field */
	const CODEC_ID = 'file.CODEC_ID';

	/** the column name for the MIME_TYPE_ID field */
	const MIME_TYPE_ID = 'file.MIME_TYPE_ID';

	/** the column name for the RESOLUTION_ID field */
	const RESOLUTION_ID = 'file.RESOLUTION_ID';

	/** the column name for the BITRATE field */
	const BITRATE = 'file.BITRATE';

	/** the column name for the FRAMERATE field */
	const FRAMERATE = 'file.FRAMERATE';

	/** the column name for the CHANNELS field */
	const CHANNELS = 'file.CHANNELS';

	/** the column name for the AUDIO field */
	const AUDIO = 'file.AUDIO';

	/** the column name for the RANK field */
	const RANK = 'file.RANK';

	/** the column name for the DURATION field */
	const DURATION = 'file.DURATION';

	/** the column name for the NUM_VIEW field */
	const NUM_VIEW = 'file.NUM_VIEW';

	/** the column name for the PUNT_SUM field */
	const PUNT_SUM = 'file.PUNT_SUM';

	/** the column name for the PUNT_NUM field */
	const PUNT_NUM = 'file.PUNT_NUM';

	/** the column name for the SIZE field */
	const SIZE = 'file.SIZE';

	/** the column name for the RESOLUTION_HOR field */
	const RESOLUTION_HOR = 'file.RESOLUTION_HOR';

	/** the column name for the RESOLUTION_VER field */
	const RESOLUTION_VER = 'file.RESOLUTION_VER';

	/** the column name for the DISPLAY field */
	const DISPLAY = 'file.DISPLAY';

	/** the column name for the DOWNLOAD field */
	const DOWNLOAD = 'file.DOWNLOAD';

	/** The PHP to DB Name Mapping */
	private static $phpNameMap = null;


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'MmId', 'PerfilId', 'LanguageId', 'Url', 'File', 'FormatId', 'CodecId', 'MimeTypeId', 'ResolutionId', 'Bitrate', 'Framerate', 'Channels', 'Audio', 'Rank', 'Duration', 'NumView', 'PuntSum', 'PuntNum', 'Size', 'ResolutionHor', 'ResolutionVer', 'Display', 'Download', ),
		BasePeer::TYPE_COLNAME => array (FilePeer::ID, FilePeer::MM_ID, FilePeer::PERFIL_ID, FilePeer::LANGUAGE_ID, FilePeer::URL, FilePeer::FILE, FilePeer::FORMAT_ID, FilePeer::CODEC_ID, FilePeer::MIME_TYPE_ID, FilePeer::RESOLUTION_ID, FilePeer::BITRATE, FilePeer::FRAMERATE, FilePeer::CHANNELS, FilePeer::AUDIO, FilePeer::RANK, FilePeer::DURATION, FilePeer::NUM_VIEW, FilePeer::PUNT_SUM, FilePeer::PUNT_NUM, FilePeer::SIZE, FilePeer::RESOLUTION_HOR, FilePeer::RESOLUTION_VER, FilePeer::DISPLAY, FilePeer::DOWNLOAD, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'mm_id', 'perfil_id', 'language_id', 'url', 'file', 'format_id', 'codec_id', 'mime_type_id', 'resolution_id', 'bitrate', 'framerate', 'channels', 'audio', 'rank', 'duration', 'num_view', 'punt_sum', 'punt_num', 'size', 'resolution_hor', 'resolution_ver', 'display', 'download', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'MmId' => 1, 'PerfilId' => 2, 'LanguageId' => 3, 'Url' => 4, 'File' => 5, 'FormatId' => 6, 'CodecId' => 7, 'MimeTypeId' => 8, 'ResolutionId' => 9, 'Bitrate' => 10, 'Framerate' => 11, 'Channels' => 12, 'Audio' => 13, 'Rank' => 14, 'Duration' => 15, 'NumView' => 16, 'PuntSum' => 17, 'PuntNum' => 18, 'Size' => 19, 'ResolutionHor' => 20, 'ResolutionVer' => 21, 'Display' => 22, 'Download' => 23, ),
		BasePeer::TYPE_COLNAME => array (FilePeer::ID => 0, FilePeer::MM_ID => 1, FilePeer::PERFIL_ID => 2, FilePeer::LANGUAGE_ID => 3, FilePeer::URL => 4, FilePeer::FILE => 5, FilePeer::FORMAT_ID => 6, FilePeer::CODEC_ID => 7, FilePeer::MIME_TYPE_ID => 8, FilePeer::RESOLUTION_ID => 9, FilePeer::BITRATE => 10, FilePeer::FRAMERATE => 11, FilePeer::CHANNELS => 12, FilePeer::AUDIO => 13, FilePeer::RANK => 14, FilePeer::DURATION => 15, FilePeer::NUM_VIEW => 16, FilePeer::PUNT_SUM => 17, FilePeer::PUNT_NUM => 18, FilePeer::SIZE => 19, FilePeer::RESOLUTION_HOR => 20, FilePeer::RESOLUTION_VER => 21, FilePeer::DISPLAY => 22, FilePeer::DOWNLOAD => 23, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'mm_id' => 1, 'perfil_id' => 2, 'language_id' => 3, 'url' => 4, 'file' => 5, 'format_id' => 6, 'codec_id' => 7, 'mime_type_id' => 8, 'resolution_id' => 9, 'bitrate' => 10, 'framerate' => 11, 'channels' => 12, 'audio' => 13, 'rank' => 14, 'duration' => 15, 'num_view' => 16, 'punt_sum' => 17, 'punt_num' => 18, 'size' => 19, 'resolution_hor' => 20, 'resolution_ver' => 21, 'display' => 22, 'download' => 23, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, )
	);

	/**
	 * @return     MapBuilder the map builder for this peer
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/FileMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.FileMapBuilder');
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
			$map = FilePeer::getTableMap();
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
	 * @param      string $column The column name for current table. (i.e. FilePeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(FilePeer::TABLE_NAME.'.', $alias.'.', $column);
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

		$criteria->addSelectColumn(FilePeer::ID);

		$criteria->addSelectColumn(FilePeer::MM_ID);

		$criteria->addSelectColumn(FilePeer::PERFIL_ID);

		$criteria->addSelectColumn(FilePeer::LANGUAGE_ID);

		$criteria->addSelectColumn(FilePeer::URL);

		$criteria->addSelectColumn(FilePeer::FILE);

		$criteria->addSelectColumn(FilePeer::FORMAT_ID);

		$criteria->addSelectColumn(FilePeer::CODEC_ID);

		$criteria->addSelectColumn(FilePeer::MIME_TYPE_ID);

		$criteria->addSelectColumn(FilePeer::RESOLUTION_ID);

		$criteria->addSelectColumn(FilePeer::BITRATE);

		$criteria->addSelectColumn(FilePeer::FRAMERATE);

		$criteria->addSelectColumn(FilePeer::CHANNELS);

		$criteria->addSelectColumn(FilePeer::AUDIO);

		$criteria->addSelectColumn(FilePeer::RANK);

		$criteria->addSelectColumn(FilePeer::DURATION);

		$criteria->addSelectColumn(FilePeer::NUM_VIEW);

		$criteria->addSelectColumn(FilePeer::PUNT_SUM);

		$criteria->addSelectColumn(FilePeer::PUNT_NUM);

		$criteria->addSelectColumn(FilePeer::SIZE);

		$criteria->addSelectColumn(FilePeer::RESOLUTION_HOR);

		$criteria->addSelectColumn(FilePeer::RESOLUTION_VER);

		$criteria->addSelectColumn(FilePeer::DISPLAY);

		$criteria->addSelectColumn(FilePeer::DOWNLOAD);

	}

	const COUNT = 'COUNT(file.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT file.ID)';

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
			$criteria->addSelectColumn(FilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = FilePeer::doSelectRS($criteria, $con);
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
	 * @return     File
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = FilePeer::doSelect($critcopy, $con);
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
		return FilePeer::populateObjects(FilePeer::doSelectRS($criteria, $con));
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

    foreach (sfMixer::getCallables('BaseFilePeer:addDoSelectRS:addDoSelectRS') as $callable)
    {
      call_user_func($callable, 'BaseFilePeer', $criteria, $con);
    }


		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			FilePeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

        //ADD DEFAULT ORDER
        if((count($criteria->getOrderByColumns()) == 0) &&
           (array_diff($criteria->getSelectColumns(), array(self::COUNT_DISTINCT, self::COUNT)))) 
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
		$cls = FilePeer::getOMClass();
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
			$criteria->addSelectColumn(FilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FilePeer::MM_ID, MmPeer::ID);

		$rs = FilePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(FilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);

		$rs = FilePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(FilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FilePeer::LANGUAGE_ID, LanguagePeer::ID);

		$rs = FilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Format table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinFormat(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FilePeer::FORMAT_ID, FormatPeer::ID);

		$rs = FilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Codec table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinCodec(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FilePeer::CODEC_ID, CodecPeer::ID);

		$rs = FilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related MimeType table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinMimeType(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FilePeer::MIME_TYPE_ID, MimeTypePeer::ID);

		$rs = FilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Resolution table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinResolution(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FilePeer::RESOLUTION_ID, ResolutionPeer::ID);

		$rs = FilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of File objects pre-filled with their Mm objects.
	 *
	 * @return     array Array of File objects.
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

		FilePeer::addSelectColumns($c);
		$startcol = (FilePeer::NUM_COLUMNS - FilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		MmPeer::addSelectColumns($c);

		$c->addJoin(FilePeer::MM_ID, MmPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FilePeer::getOMClass();

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
					$temp_obj2->addFile($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initFiles();
				$obj2->addFile($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of File objects pre-filled with their Perfil objects.
	 *
	 * @return     array Array of File objects.
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

		FilePeer::addSelectColumns($c);
		$startcol = (FilePeer::NUM_COLUMNS - FilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PerfilPeer::addSelectColumns($c);

		$c->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FilePeer::getOMClass();

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
					$temp_obj2->addFile($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initFiles();
				$obj2->addFile($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of File objects pre-filled with their Language objects.
	 *
	 * @return     array Array of File objects.
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

		FilePeer::addSelectColumns($c);
		$startcol = (FilePeer::NUM_COLUMNS - FilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		LanguagePeer::addSelectColumns($c);

		$c->addJoin(FilePeer::LANGUAGE_ID, LanguagePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FilePeer::getOMClass();

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
					$temp_obj2->addFile($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initFiles();
				$obj2->addFile($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of File objects pre-filled with their Format objects.
	 *
	 * @return     array Array of File objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinFormat(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FilePeer::addSelectColumns($c);
		$startcol = (FilePeer::NUM_COLUMNS - FilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		FormatPeer::addSelectColumns($c);

		$c->addJoin(FilePeer::FORMAT_ID, FormatPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FormatPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getFormat(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addFile($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initFiles();
				$obj2->addFile($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of File objects pre-filled with their Codec objects.
	 *
	 * @return     array Array of File objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinCodec(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FilePeer::addSelectColumns($c);
		$startcol = (FilePeer::NUM_COLUMNS - FilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		CodecPeer::addSelectColumns($c);

		$c->addJoin(FilePeer::CODEC_ID, CodecPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = CodecPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getCodec(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addFile($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initFiles();
				$obj2->addFile($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of File objects pre-filled with their MimeType objects.
	 *
	 * @return     array Array of File objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinMimeType(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FilePeer::addSelectColumns($c);
		$startcol = (FilePeer::NUM_COLUMNS - FilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		MimeTypePeer::addSelectColumns($c);

		$c->addJoin(FilePeer::MIME_TYPE_ID, MimeTypePeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = MimeTypePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getMimeType(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addFile($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initFiles();
				$obj2->addFile($obj1); //CHECKME
			}
			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of File objects pre-filled with their Resolution objects.
	 *
	 * @return     array Array of File objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinResolution(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FilePeer::addSelectColumns($c);
		$startcol = (FilePeer::NUM_COLUMNS - FilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ResolutionPeer::addSelectColumns($c);

		$c->addJoin(FilePeer::RESOLUTION_ID, ResolutionPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FilePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ResolutionPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getResolution(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					// e.g. $author->addBookRelatedByBookId()
					$temp_obj2->addFile($obj1); //CHECKME
					break;
				}
			}
			if ($newObject) {
				$obj2->initFiles();
				$obj2->addFile($obj1); //CHECKME
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
			$criteria->addSelectColumn(FilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FilePeer::MM_ID, MmPeer::ID);

		$criteria->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);

		$criteria->addJoin(FilePeer::LANGUAGE_ID, LanguagePeer::ID);

		$criteria->addJoin(FilePeer::FORMAT_ID, FormatPeer::ID);

		$criteria->addJoin(FilePeer::CODEC_ID, CodecPeer::ID);

		$criteria->addJoin(FilePeer::MIME_TYPE_ID, MimeTypePeer::ID);

		$criteria->addJoin(FilePeer::RESOLUTION_ID, ResolutionPeer::ID);

		$rs = FilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of File objects pre-filled with all related objects.
	 *
	 * @return     array Array of File objects.
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

		FilePeer::addSelectColumns($c);
		$startcol2 = (FilePeer::NUM_COLUMNS - FilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MmPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MmPeer::NUM_COLUMNS;

		PerfilPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PerfilPeer::NUM_COLUMNS;

		LanguagePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + LanguagePeer::NUM_COLUMNS;

		FormatPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + FormatPeer::NUM_COLUMNS;

		CodecPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + CodecPeer::NUM_COLUMNS;

		MimeTypePeer::addSelectColumns($c);
		$startcol8 = $startcol7 + MimeTypePeer::NUM_COLUMNS;

		ResolutionPeer::addSelectColumns($c);
		$startcol9 = $startcol8 + ResolutionPeer::NUM_COLUMNS;

		$c->addJoin(FilePeer::MM_ID, MmPeer::ID);

		$c->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);

		$c->addJoin(FilePeer::LANGUAGE_ID, LanguagePeer::ID);

		$c->addJoin(FilePeer::FORMAT_ID, FormatPeer::ID);

		$c->addJoin(FilePeer::CODEC_ID, CodecPeer::ID);

		$c->addJoin(FilePeer::MIME_TYPE_ID, MimeTypePeer::ID);

		$c->addJoin(FilePeer::RESOLUTION_ID, ResolutionPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FilePeer::getOMClass();


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
					$temp_obj2->addFile($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj2->initFiles();
				$obj2->addFile($obj1);
			}


				// Add objects for joined Perfil rows
	
			$omClass = PerfilPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getPerfil(); // CHECKME
				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addFile($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj3->initFiles();
				$obj3->addFile($obj1);
			}


				// Add objects for joined Language rows
	
			$omClass = LanguagePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4 = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getLanguage(); // CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addFile($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj4->initFiles();
				$obj4->addFile($obj1);
			}


				// Add objects for joined Format rows
	
			$omClass = FormatPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5 = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getFormat(); // CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addFile($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj5->initFiles();
				$obj5->addFile($obj1);
			}


				// Add objects for joined Codec rows
	
			$omClass = CodecPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6 = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getCodec(); // CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addFile($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj6->initFiles();
				$obj6->addFile($obj1);
			}


				// Add objects for joined MimeType rows
	
			$omClass = MimeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7 = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getMimeType(); // CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addFile($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj7->initFiles();
				$obj7->addFile($obj1);
			}


				// Add objects for joined Resolution rows
	
			$omClass = ResolutionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj8 = new $cls();
			$obj8->hydrate($rs, $startcol8);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj8 = $temp_obj1->getResolution(); // CHECKME
				if ($temp_obj8->getPrimaryKey() === $obj8->getPrimaryKey()) {
					$newObject = false;
					$temp_obj8->addFile($obj1); // CHECKME
					break;
				}
			}

			if ($newObject) {
				$obj8->initFiles();
				$obj8->addFile($obj1);
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
			$criteria->addSelectColumn(FilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);

		$criteria->addJoin(FilePeer::LANGUAGE_ID, LanguagePeer::ID);

		$criteria->addJoin(FilePeer::FORMAT_ID, FormatPeer::ID);

		$criteria->addJoin(FilePeer::CODEC_ID, CodecPeer::ID);

		$criteria->addJoin(FilePeer::MIME_TYPE_ID, MimeTypePeer::ID);

		$criteria->addJoin(FilePeer::RESOLUTION_ID, ResolutionPeer::ID);

		$rs = FilePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(FilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FilePeer::MM_ID, MmPeer::ID);

		$criteria->addJoin(FilePeer::LANGUAGE_ID, LanguagePeer::ID);

		$criteria->addJoin(FilePeer::FORMAT_ID, FormatPeer::ID);

		$criteria->addJoin(FilePeer::CODEC_ID, CodecPeer::ID);

		$criteria->addJoin(FilePeer::MIME_TYPE_ID, MimeTypePeer::ID);

		$criteria->addJoin(FilePeer::RESOLUTION_ID, ResolutionPeer::ID);

		$rs = FilePeer::doSelectRS($criteria, $con);
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
			$criteria->addSelectColumn(FilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FilePeer::MM_ID, MmPeer::ID);

		$criteria->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);

		$criteria->addJoin(FilePeer::FORMAT_ID, FormatPeer::ID);

		$criteria->addJoin(FilePeer::CODEC_ID, CodecPeer::ID);

		$criteria->addJoin(FilePeer::MIME_TYPE_ID, MimeTypePeer::ID);

		$criteria->addJoin(FilePeer::RESOLUTION_ID, ResolutionPeer::ID);

		$rs = FilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Format table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptFormat(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FilePeer::MM_ID, MmPeer::ID);

		$criteria->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);

		$criteria->addJoin(FilePeer::LANGUAGE_ID, LanguagePeer::ID);

		$criteria->addJoin(FilePeer::CODEC_ID, CodecPeer::ID);

		$criteria->addJoin(FilePeer::MIME_TYPE_ID, MimeTypePeer::ID);

		$criteria->addJoin(FilePeer::RESOLUTION_ID, ResolutionPeer::ID);

		$rs = FilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Codec table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptCodec(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FilePeer::MM_ID, MmPeer::ID);

		$criteria->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);

		$criteria->addJoin(FilePeer::LANGUAGE_ID, LanguagePeer::ID);

		$criteria->addJoin(FilePeer::FORMAT_ID, FormatPeer::ID);

		$criteria->addJoin(FilePeer::MIME_TYPE_ID, MimeTypePeer::ID);

		$criteria->addJoin(FilePeer::RESOLUTION_ID, ResolutionPeer::ID);

		$rs = FilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related MimeType table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptMimeType(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FilePeer::MM_ID, MmPeer::ID);

		$criteria->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);

		$criteria->addJoin(FilePeer::LANGUAGE_ID, LanguagePeer::ID);

		$criteria->addJoin(FilePeer::FORMAT_ID, FormatPeer::ID);

		$criteria->addJoin(FilePeer::CODEC_ID, CodecPeer::ID);

		$criteria->addJoin(FilePeer::RESOLUTION_ID, ResolutionPeer::ID);

		$rs = FilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Returns the number of rows matching criteria, joining the related Resolution table
	 *
	 * @param      Criteria $c
	 * @param      boolean $distinct Whether to select only distinct columns (You can also set DISTINCT modifier in Criteria).
	 * @param      Connection $con
	 * @return     int Number of matching rows.
	 */
	public static function doCountJoinAllExceptResolution(Criteria $criteria, $distinct = false, $con = null)
	{
		// we're going to modify criteria, so copy it first
		$criteria = clone $criteria;

		// clear out anything that might confuse the ORDER BY clause
		$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(FilePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(FilePeer::COUNT);
		}

		// just in case we're grouping: add those columns to the select statement
		foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(FilePeer::MM_ID, MmPeer::ID);

		$criteria->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);

		$criteria->addJoin(FilePeer::LANGUAGE_ID, LanguagePeer::ID);

		$criteria->addJoin(FilePeer::FORMAT_ID, FormatPeer::ID);

		$criteria->addJoin(FilePeer::CODEC_ID, CodecPeer::ID);

		$criteria->addJoin(FilePeer::MIME_TYPE_ID, MimeTypePeer::ID);

		$rs = FilePeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
			// no rows returned; we infer that means 0 matches.
			return 0;
		}
	}


	/**
	 * Selects a collection of File objects pre-filled with all related objects except Mm.
	 *
	 * @return     array Array of File objects.
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

		FilePeer::addSelectColumns($c);
		$startcol2 = (FilePeer::NUM_COLUMNS - FilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PerfilPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PerfilPeer::NUM_COLUMNS;

		LanguagePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + LanguagePeer::NUM_COLUMNS;

		FormatPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + FormatPeer::NUM_COLUMNS;

		CodecPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + CodecPeer::NUM_COLUMNS;

		MimeTypePeer::addSelectColumns($c);
		$startcol7 = $startcol6 + MimeTypePeer::NUM_COLUMNS;

		ResolutionPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ResolutionPeer::NUM_COLUMNS;

		$c->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);

		$c->addJoin(FilePeer::LANGUAGE_ID, LanguagePeer::ID);

		$c->addJoin(FilePeer::FORMAT_ID, FormatPeer::ID);

		$c->addJoin(FilePeer::CODEC_ID, CodecPeer::ID);

		$c->addJoin(FilePeer::MIME_TYPE_ID, MimeTypePeer::ID);

		$c->addJoin(FilePeer::RESOLUTION_ID, ResolutionPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FilePeer::getOMClass();

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
				$temp_obj2 = $temp_obj1->getPerfil(); //CHECKME
				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initFiles();
				$obj2->addFile($obj1);
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
					$temp_obj3->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initFiles();
				$obj3->addFile($obj1);
			}

			$omClass = FormatPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getFormat(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initFiles();
				$obj4->addFile($obj1);
			}

			$omClass = CodecPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getCodec(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initFiles();
				$obj5->addFile($obj1);
			}

			$omClass = MimeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getMimeType(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initFiles();
				$obj6->addFile($obj1);
			}

			$omClass = ResolutionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getResolution(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initFiles();
				$obj7->addFile($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of File objects pre-filled with all related objects except Perfil.
	 *
	 * @return     array Array of File objects.
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

		FilePeer::addSelectColumns($c);
		$startcol2 = (FilePeer::NUM_COLUMNS - FilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MmPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MmPeer::NUM_COLUMNS;

		LanguagePeer::addSelectColumns($c);
		$startcol4 = $startcol3 + LanguagePeer::NUM_COLUMNS;

		FormatPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + FormatPeer::NUM_COLUMNS;

		CodecPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + CodecPeer::NUM_COLUMNS;

		MimeTypePeer::addSelectColumns($c);
		$startcol7 = $startcol6 + MimeTypePeer::NUM_COLUMNS;

		ResolutionPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ResolutionPeer::NUM_COLUMNS;

		$c->addJoin(FilePeer::MM_ID, MmPeer::ID);

		$c->addJoin(FilePeer::LANGUAGE_ID, LanguagePeer::ID);

		$c->addJoin(FilePeer::FORMAT_ID, FormatPeer::ID);

		$c->addJoin(FilePeer::CODEC_ID, CodecPeer::ID);

		$c->addJoin(FilePeer::MIME_TYPE_ID, MimeTypePeer::ID);

		$c->addJoin(FilePeer::RESOLUTION_ID, ResolutionPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FilePeer::getOMClass();

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
					$temp_obj2->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initFiles();
				$obj2->addFile($obj1);
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
					$temp_obj3->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initFiles();
				$obj3->addFile($obj1);
			}

			$omClass = FormatPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getFormat(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initFiles();
				$obj4->addFile($obj1);
			}

			$omClass = CodecPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getCodec(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initFiles();
				$obj5->addFile($obj1);
			}

			$omClass = MimeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getMimeType(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initFiles();
				$obj6->addFile($obj1);
			}

			$omClass = ResolutionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getResolution(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initFiles();
				$obj7->addFile($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of File objects pre-filled with all related objects except Language.
	 *
	 * @return     array Array of File objects.
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

		FilePeer::addSelectColumns($c);
		$startcol2 = (FilePeer::NUM_COLUMNS - FilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MmPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MmPeer::NUM_COLUMNS;

		PerfilPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PerfilPeer::NUM_COLUMNS;

		FormatPeer::addSelectColumns($c);
		$startcol5 = $startcol4 + FormatPeer::NUM_COLUMNS;

		CodecPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + CodecPeer::NUM_COLUMNS;

		MimeTypePeer::addSelectColumns($c);
		$startcol7 = $startcol6 + MimeTypePeer::NUM_COLUMNS;

		ResolutionPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ResolutionPeer::NUM_COLUMNS;

		$c->addJoin(FilePeer::MM_ID, MmPeer::ID);

		$c->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);

		$c->addJoin(FilePeer::FORMAT_ID, FormatPeer::ID);

		$c->addJoin(FilePeer::CODEC_ID, CodecPeer::ID);

		$c->addJoin(FilePeer::MIME_TYPE_ID, MimeTypePeer::ID);

		$c->addJoin(FilePeer::RESOLUTION_ID, ResolutionPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FilePeer::getOMClass();

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
					$temp_obj2->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initFiles();
				$obj2->addFile($obj1);
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
					$temp_obj3->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initFiles();
				$obj3->addFile($obj1);
			}

			$omClass = FormatPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getFormat(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initFiles();
				$obj4->addFile($obj1);
			}

			$omClass = CodecPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getCodec(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initFiles();
				$obj5->addFile($obj1);
			}

			$omClass = MimeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getMimeType(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initFiles();
				$obj6->addFile($obj1);
			}

			$omClass = ResolutionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getResolution(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initFiles();
				$obj7->addFile($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of File objects pre-filled with all related objects except Format.
	 *
	 * @return     array Array of File objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptFormat(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FilePeer::addSelectColumns($c);
		$startcol2 = (FilePeer::NUM_COLUMNS - FilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MmPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MmPeer::NUM_COLUMNS;

		PerfilPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PerfilPeer::NUM_COLUMNS;

		LanguagePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + LanguagePeer::NUM_COLUMNS;

		CodecPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + CodecPeer::NUM_COLUMNS;

		MimeTypePeer::addSelectColumns($c);
		$startcol7 = $startcol6 + MimeTypePeer::NUM_COLUMNS;

		ResolutionPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ResolutionPeer::NUM_COLUMNS;

		$c->addJoin(FilePeer::MM_ID, MmPeer::ID);

		$c->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);

		$c->addJoin(FilePeer::LANGUAGE_ID, LanguagePeer::ID);

		$c->addJoin(FilePeer::CODEC_ID, CodecPeer::ID);

		$c->addJoin(FilePeer::MIME_TYPE_ID, MimeTypePeer::ID);

		$c->addJoin(FilePeer::RESOLUTION_ID, ResolutionPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FilePeer::getOMClass();

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
					$temp_obj2->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initFiles();
				$obj2->addFile($obj1);
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
					$temp_obj3->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initFiles();
				$obj3->addFile($obj1);
			}

			$omClass = LanguagePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getLanguage(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initFiles();
				$obj4->addFile($obj1);
			}

			$omClass = CodecPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getCodec(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initFiles();
				$obj5->addFile($obj1);
			}

			$omClass = MimeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getMimeType(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initFiles();
				$obj6->addFile($obj1);
			}

			$omClass = ResolutionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getResolution(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initFiles();
				$obj7->addFile($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of File objects pre-filled with all related objects except Codec.
	 *
	 * @return     array Array of File objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptCodec(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FilePeer::addSelectColumns($c);
		$startcol2 = (FilePeer::NUM_COLUMNS - FilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MmPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MmPeer::NUM_COLUMNS;

		PerfilPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PerfilPeer::NUM_COLUMNS;

		LanguagePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + LanguagePeer::NUM_COLUMNS;

		FormatPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + FormatPeer::NUM_COLUMNS;

		MimeTypePeer::addSelectColumns($c);
		$startcol7 = $startcol6 + MimeTypePeer::NUM_COLUMNS;

		ResolutionPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ResolutionPeer::NUM_COLUMNS;

		$c->addJoin(FilePeer::MM_ID, MmPeer::ID);

		$c->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);

		$c->addJoin(FilePeer::LANGUAGE_ID, LanguagePeer::ID);

		$c->addJoin(FilePeer::FORMAT_ID, FormatPeer::ID);

		$c->addJoin(FilePeer::MIME_TYPE_ID, MimeTypePeer::ID);

		$c->addJoin(FilePeer::RESOLUTION_ID, ResolutionPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FilePeer::getOMClass();

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
					$temp_obj2->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initFiles();
				$obj2->addFile($obj1);
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
					$temp_obj3->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initFiles();
				$obj3->addFile($obj1);
			}

			$omClass = LanguagePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getLanguage(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initFiles();
				$obj4->addFile($obj1);
			}

			$omClass = FormatPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getFormat(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initFiles();
				$obj5->addFile($obj1);
			}

			$omClass = MimeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getMimeType(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initFiles();
				$obj6->addFile($obj1);
			}

			$omClass = ResolutionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getResolution(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initFiles();
				$obj7->addFile($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of File objects pre-filled with all related objects except MimeType.
	 *
	 * @return     array Array of File objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptMimeType(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FilePeer::addSelectColumns($c);
		$startcol2 = (FilePeer::NUM_COLUMNS - FilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MmPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MmPeer::NUM_COLUMNS;

		PerfilPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PerfilPeer::NUM_COLUMNS;

		LanguagePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + LanguagePeer::NUM_COLUMNS;

		FormatPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + FormatPeer::NUM_COLUMNS;

		CodecPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + CodecPeer::NUM_COLUMNS;

		ResolutionPeer::addSelectColumns($c);
		$startcol8 = $startcol7 + ResolutionPeer::NUM_COLUMNS;

		$c->addJoin(FilePeer::MM_ID, MmPeer::ID);

		$c->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);

		$c->addJoin(FilePeer::LANGUAGE_ID, LanguagePeer::ID);

		$c->addJoin(FilePeer::FORMAT_ID, FormatPeer::ID);

		$c->addJoin(FilePeer::CODEC_ID, CodecPeer::ID);

		$c->addJoin(FilePeer::RESOLUTION_ID, ResolutionPeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FilePeer::getOMClass();

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
					$temp_obj2->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initFiles();
				$obj2->addFile($obj1);
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
					$temp_obj3->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initFiles();
				$obj3->addFile($obj1);
			}

			$omClass = LanguagePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getLanguage(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initFiles();
				$obj4->addFile($obj1);
			}

			$omClass = FormatPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getFormat(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initFiles();
				$obj5->addFile($obj1);
			}

			$omClass = CodecPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getCodec(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initFiles();
				$obj6->addFile($obj1);
			}

			$omClass = ResolutionPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getResolution(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initFiles();
				$obj7->addFile($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	/**
	 * Selects a collection of File objects pre-filled with all related objects except Resolution.
	 *
	 * @return     array Array of File objects.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptResolution(Criteria $c, $con = null)
	{
		$c = clone $c;

		// Set the correct dbName if it has not been overridden
		// $c->getDbName() will return the same object if not set to another value
		// so == check is okay and faster
		if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		FilePeer::addSelectColumns($c);
		$startcol2 = (FilePeer::NUM_COLUMNS - FilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		MmPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + MmPeer::NUM_COLUMNS;

		PerfilPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + PerfilPeer::NUM_COLUMNS;

		LanguagePeer::addSelectColumns($c);
		$startcol5 = $startcol4 + LanguagePeer::NUM_COLUMNS;

		FormatPeer::addSelectColumns($c);
		$startcol6 = $startcol5 + FormatPeer::NUM_COLUMNS;

		CodecPeer::addSelectColumns($c);
		$startcol7 = $startcol6 + CodecPeer::NUM_COLUMNS;

		MimeTypePeer::addSelectColumns($c);
		$startcol8 = $startcol7 + MimeTypePeer::NUM_COLUMNS;

		$c->addJoin(FilePeer::MM_ID, MmPeer::ID);

		$c->addJoin(FilePeer::PERFIL_ID, PerfilPeer::ID);

		$c->addJoin(FilePeer::LANGUAGE_ID, LanguagePeer::ID);

		$c->addJoin(FilePeer::FORMAT_ID, FormatPeer::ID);

		$c->addJoin(FilePeer::CODEC_ID, CodecPeer::ID);

		$c->addJoin(FilePeer::MIME_TYPE_ID, MimeTypePeer::ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = FilePeer::getOMClass();

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
					$temp_obj2->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initFiles();
				$obj2->addFile($obj1);
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
					$temp_obj3->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj3->initFiles();
				$obj3->addFile($obj1);
			}

			$omClass = LanguagePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj4  = new $cls();
			$obj4->hydrate($rs, $startcol4);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj4 = $temp_obj1->getLanguage(); //CHECKME
				if ($temp_obj4->getPrimaryKey() === $obj4->getPrimaryKey()) {
					$newObject = false;
					$temp_obj4->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj4->initFiles();
				$obj4->addFile($obj1);
			}

			$omClass = FormatPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj5  = new $cls();
			$obj5->hydrate($rs, $startcol5);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj5 = $temp_obj1->getFormat(); //CHECKME
				if ($temp_obj5->getPrimaryKey() === $obj5->getPrimaryKey()) {
					$newObject = false;
					$temp_obj5->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj5->initFiles();
				$obj5->addFile($obj1);
			}

			$omClass = CodecPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj6  = new $cls();
			$obj6->hydrate($rs, $startcol6);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj6 = $temp_obj1->getCodec(); //CHECKME
				if ($temp_obj6->getPrimaryKey() === $obj6->getPrimaryKey()) {
					$newObject = false;
					$temp_obj6->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj6->initFiles();
				$obj6->addFile($obj1);
			}

			$omClass = MimeTypePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj7  = new $cls();
			$obj7->hydrate($rs, $startcol7);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj7 = $temp_obj1->getMimeType(); //CHECKME
				if ($temp_obj7->getPrimaryKey() === $obj7->getPrimaryKey()) {
					$newObject = false;
					$temp_obj7->addFile($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj7->initFiles();
				$obj7->addFile($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


  /**
   * Selects a collection of File objects pre-filled with their i18n objects.
   *
   * @return array Array of File objects.
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

    FilePeer::addSelectColumns($c);
    $startcol = (FilePeer::NUM_COLUMNS - FilePeer::NUM_LAZY_LOAD_COLUMNS) + 1;

    FileI18nPeer::addSelectColumns($c);

    $c->addJoin(FilePeer::ID, FileI18nPeer::ID);
    $c->add(FileI18nPeer::CULTURE, $culture);

    if(count($c->getOrderByColumns()) == 0) $c->addAscendingOrderByColumn(self::RANK);

    $rs = BasePeer::doSelect($c, $con);
    $results = array();

    while($rs->next()) {

      $omClass = FilePeer::getOMClass();

      $cls = Propel::import($omClass);
      $obj1 = new $cls();
      $obj1->hydrate($rs);
      $obj1->setCulture($culture);

      $omClass = FileI18nPeer::getOMClass($rs, $startcol);

      $cls = Propel::import($omClass);
      $obj2 = new $cls();
      $obj2->hydrate($rs, $startcol);

      $obj1->setFileI18nForCulture($obj2, $culture);
      $obj2->setFile($obj1);

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
		return FilePeer::CLASS_DEFAULT;
	}

	/**
	 * Method perform an INSERT on the database, given a File or Criteria object.
	 *
	 * @param      mixed $values Criteria or File object containing data that is used to create the INSERT statement.
	 * @param      Connection $con the connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseFilePeer:doInsert:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFilePeer', $values, $con);
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
			$criteria = $values->buildCriteria(); // build Criteria from File object
		}

		$criteria->remove(FilePeer::ID); // remove pkey col since this table uses auto-increment


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

		
    foreach (sfMixer::getCallables('BaseFilePeer:doInsert:post') as $callable)
    {
      call_user_func($callable, 'BaseFilePeer', $values, $con, $pk);
    }

    return $pk;
	}

	/**
	 * Method perform an UPDATE on the database, given a File or Criteria object.
	 *
	 * @param      mixed $values Criteria or File object containing data that is used to create the UPDATE statement.
	 * @param      Connection $con The connection to use (specify Connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, $con = null)
	{

    foreach (sfMixer::getCallables('BaseFilePeer:doUpdate:pre') as $callable)
    {
      $ret = call_user_func($callable, 'BaseFilePeer', $values, $con);
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

			$comparison = $criteria->getComparison(FilePeer::ID);
			$selectCriteria->add(FilePeer::ID, $criteria->remove(FilePeer::ID), $comparison);

		} else { // $values is File object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$ret = BasePeer::doUpdate($selectCriteria, $criteria, $con);
	

    foreach (sfMixer::getCallables('BaseFilePeer:doUpdate:post') as $callable)
    {
      call_user_func($callable, 'BaseFilePeer', $values, $con, $ret);
    }

    return $ret;
  }

	/**
	 * Method to DELETE all rows from the file table.
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
			$affectedRows += FilePeer::doOnDeleteCascade(new Criteria(), $con);
			$affectedRows += BasePeer::doDeleteAll(FilePeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	/**
	 * Method perform a DELETE on the database, given a File or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or File object or primary key or array of primary keys
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
			$con = Propel::getConnection(FilePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} elseif ($values instanceof File) {

			$criteria = $values->buildPkeyCriteria();
		} else {
			// it must be the primary key
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(FilePeer::ID, (array) $values, Criteria::IN);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->begin();
			$affectedRows += FilePeer::doOnDeleteCascade($criteria, $con);
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
		$objects = FilePeer::doSelect($criteria, $con);
		foreach($objects as $obj) {


			include_once 'lib/model/FileI18n.php';

			// delete related FileI18n objects
			$c = new Criteria();
			
			$c->add(FileI18nPeer::ID, $obj->getId());
			$affectedRows += FileI18nPeer::doDelete($c, $con);

			include_once 'lib/model/Ticket.php';

			// delete related Ticket objects
			$c = new Criteria();
			
			$c->add(TicketPeer::FILE_ID, $obj->getId());
			$affectedRows += TicketPeer::doDelete($c, $con);
		}
		return $affectedRows;
	}

	/**
	 * Validates all modified columns of given File object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      File $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate(File $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(FilePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(FilePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(FilePeer::DATABASE_NAME, FilePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = FilePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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
	 * @return     File
	 */
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(FilePeer::DATABASE_NAME);

		$criteria->add(FilePeer::ID, $pk);


		$v = FilePeer::doSelect($criteria, $con);

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
			$criteria->add(FilePeer::ID, $pks, Criteria::IN);
			$objs = FilePeer::doSelect($criteria, $con);
		}
		return $objs;
	}

	/**
	 * Retrieve a single object by pkey with their i18n objects.
	 *
	 * @param      mixed $pk the primary key.
	 * @param      Connection $con the connection to use
	 * @return     File
	 */
	public static function retrieveByPKWithI18n($pk, $culture = null, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(FilePeer::DATABASE_NAME);

		$criteria->add(FilePeer::ID, $pk);


		$v = FilePeer::doSelectWithI18n($criteria, $culture, $con);

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
			$criteria->add(FilePeer::ID, $pks, Criteria::IN);
			$objs = FilePeer::doSelectWithI18n($criteria, $culture, $con);
		}
		return $objs;
	}

} // BaseFilePeer

// static code to register the map builder for this Peer with the main Propel class
if (Propel::isInit()) {
	// the MapBuilder classes register themselves with Propel during initialization
	// so we need to load them here.
	try {
		BaseFilePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
	// even if Propel is not yet initialized, the map builder class can be registered
	// now and then it will be loaded when Propel initializes.
	require_once 'lib/model/map/FileMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.FileMapBuilder');
}
