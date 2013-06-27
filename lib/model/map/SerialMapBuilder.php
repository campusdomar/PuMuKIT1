<?php


/**
 * This class adds structure of 'serial' table to 'propel' DatabaseMap object.
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
class SerialMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.SerialMapBuilder';

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

		$tMap = $this->dbMap->addTable('serial');
		$tMap->setPhpName('Serial');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('ANNOUNCE', 'Announce', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('DISPLAY', 'Display', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('MAIL', 'Mail', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('COPYRIGHT', 'Copyright', 'string', CreoleTypes::VARCHAR, true, 30);

		$tMap->addForeignKey('SERIAL_TYPE_ID', 'SerialTypeId', 'int', CreoleTypes::INTEGER, 'serial_type', 'ID', false, null);

		$tMap->addForeignKey('SERIAL_TEMPLATE_ID', 'SerialTemplateId', 'int', CreoleTypes::INTEGER, 'serial_template', 'ID', false, null);

		$tMap->addColumn('PUBLICDATE', 'Publicdate', 'int', CreoleTypes::TIMESTAMP, true, null);

	} // doBuild()

} // SerialMapBuilder
