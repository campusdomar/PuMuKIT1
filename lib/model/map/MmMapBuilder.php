<?php


/**
 * This class adds structure of 'mm' table to 'propel' DatabaseMap object.
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
class MmMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.MmMapBuilder';

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

		$tMap = $this->dbMap->addTable('mm');
		$tMap->setPhpName('Mm');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('SUBSERIAL', 'Subserial', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('ANNOUNCE', 'Announce', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('MAIL', 'Mail', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addForeignKey('SERIAL_ID', 'SerialId', 'int', CreoleTypes::INTEGER, 'serial', 'ID', true, null);

		$tMap->addColumn('RANK', 'Rank', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('PRECINCT_ID', 'PrecinctId', 'int', CreoleTypes::INTEGER, 'precinct', 'ID', false, null);

		$tMap->addForeignKey('GENRE_ID', 'GenreId', 'int', CreoleTypes::INTEGER, 'genre', 'ID', false, null);

		$tMap->addForeignKey('BROADCAST_ID', 'BroadcastId', 'int', CreoleTypes::INTEGER, 'broadcast', 'ID', false, null);

		$tMap->addColumn('COPYRIGHT', 'Copyright', 'string', CreoleTypes::VARCHAR, true, 30);

		$tMap->addColumn('STATUS_ID', 'StatusId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('RECORDDATE', 'Recorddate', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('PUBLICDATE', 'Publicdate', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('EDITORIAL1', 'Editorial1', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('EDITORIAL2', 'Editorial2', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('EDITORIAL3', 'Editorial3', 'boolean', CreoleTypes::BOOLEAN, true, null);

	} // doBuild()

} // MmMapBuilder
