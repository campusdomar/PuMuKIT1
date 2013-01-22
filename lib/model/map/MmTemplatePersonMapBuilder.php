<?php


/**
 * This class adds structure of 'mm_template_person' table to 'propel' DatabaseMap object.
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
class MmTemplatePersonMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.MmTemplatePersonMapBuilder';

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

		$tMap = $this->dbMap->addTable('mm_template_person');
		$tMap->setPhpName('MmTemplatePerson');

		$tMap->setUseIdGenerator(false);

		$tMap->addForeignPrimaryKey('MM_TEMPLATE_ID', 'MmTemplateId', 'int' , CreoleTypes::INTEGER, 'mm_template', 'ID', true, null);

		$tMap->addForeignPrimaryKey('PERSON_ID', 'PersonId', 'int' , CreoleTypes::INTEGER, 'person', 'ID', true, null);

		$tMap->addForeignPrimaryKey('ROLE_ID', 'RoleId', 'int' , CreoleTypes::INTEGER, 'role', 'ID', true, null);

		$tMap->addColumn('RANK', 'Rank', 'int', CreoleTypes::INTEGER, true, null);

	} // doBuild()

} // MmTemplatePersonMapBuilder
