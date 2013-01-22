<?php


/**
 * This class adds structure of 'direct' table to 'propel' DatabaseMap object.
 *
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class DirectMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.DirectMapBuilder';

	/**
	 * The database map.
	 */
	private $dbMap;

	/**
	 * Tells us if this DatabaseMapBuilder is built so that we
	 * don't have to re-build it every time.
	 *
	 * @return     boolean true if this DatabaseMapBuilder is built, false otherwise.
	 */
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	/**
	 * Gets the databasemap this map builder built.
	 *
	 * @return     the databasemap
	 */
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	/**
	 * The doBuild() method builds the DatabaseMap
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('direct');
		$tMap->setPhpName('Direct');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('RESOLUTION_ID', 'ResolutionId', 'int', CreoleTypes::INTEGER, 'resolution', 'ID', false, null);

		$tMap->addColumn('URL', 'Url', 'string', CreoleTypes::VARCHAR, true, 250);

		$tMap->addColumn('PASSWD', 'Passwd', 'string', CreoleTypes::CHAR, true, 15);

		$tMap->addForeignKey('DIRECT_TYPE_ID', 'DirectTypeId', 'int', CreoleTypes::INTEGER, 'direct_type', 'ID', false, null);

		$tMap->addColumn('RESOLUTION_HOR', 'ResolutionHor', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('RESOLUTION_VER', 'ResolutionVer', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CALIDADES', 'Calidades', 'string', CreoleTypes::VARCHAR, true, 250);

		$tMap->addColumn('IP_SOURCE', 'IpSource', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('SOURCE_NAME', 'SourceName', 'string', CreoleTypes::VARCHAR, false, 100);

		$tMap->addColumn('INDEX_PLAY', 'IndexPlay', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('BROADCASTING', 'Broadcasting', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('DEBUG', 'Debug', 'boolean', CreoleTypes::BOOLEAN, true, null);

	} // doBuild()

} // DirectMapBuilder
