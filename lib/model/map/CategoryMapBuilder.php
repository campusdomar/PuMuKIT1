<?php


/**
 * This class adds structure of 'category' table to 'propel' DatabaseMap object.
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
class CategoryMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.CategoryMapBuilder';

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

		$tMap = $this->dbMap->addTable('category');
		$tMap->setPhpName('Category');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('COD', 'Cod', 'string', CreoleTypes::VARCHAR, true, 25);

		$tMap->addColumn('TREE_LEFT', 'TreeLeft', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TREE_RIGHT', 'TreeRight', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('TREE_PARENT', 'TreeParent', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('SCOPE', 'Scope', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('METACATEGORY', 'Metacategory', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('DISPLAY', 'Display', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('REQUIRED', 'Required', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('NUM_MM', 'NumMm', 'int', CreoleTypes::INTEGER, true, null);

	} // doBuild()

} // CategoryMapBuilder
