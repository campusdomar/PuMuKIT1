<?php


/**
 * This class adds structure of 'category_mm_template' table to 'propel' DatabaseMap object.
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
class CategoryMmTemplateMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.CategoryMmTemplateMapBuilder';

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

		$tMap = $this->dbMap->addTable('category_mm_template');
		$tMap->setPhpName('CategoryMmTemplate');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('CATEGORY_ID', 'CategoryId', 'int' , CreoleTypes::INTEGER, 'category', 'ID', true, null);

		$tMap->addForeignPrimaryKey('MM_TEMPLATE_ID', 'MmTemplateId', 'int' , CreoleTypes::INTEGER, 'mm_template', 'ID', true, null);

	} // doBuild()

} // CategoryMmTemplateMapBuilder
