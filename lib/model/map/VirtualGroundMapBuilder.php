<?php


/**
 * This class adds structure of 'virtual_ground' table to 'propel' DatabaseMap object.
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
class VirtualGroundMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.VirtualGroundMapBuilder';

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

		$tMap = $this->dbMap->addTable('virtual_ground');
		$tMap->setPhpName('VirtualGround');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('COD', 'Cod', 'string', CreoleTypes::VARCHAR, true, 25);

		$tMap->addColumn('DISPLAY', 'Display', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('RANK', 'Rank', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('DESCRIPTION', 'Description', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('IMG', 'Img', 'string', CreoleTypes::VARCHAR, true, 100);

		$tMap->addColumn('EDITORIAL1', 'Editorial1', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('EDITORIAL2', 'Editorial2', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('EDITORIAL3', 'Editorial3', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('OTHER', 'Other', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addForeignKey('GROUND_TYPE_ID', 'GroundTypeId', 'int', CreoleTypes::INTEGER, 'ground_type', 'ID', false, null);

	} // doBuild()

} // VirtualGroundMapBuilder
