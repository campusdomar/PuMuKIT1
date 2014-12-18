<?php


/**
 * This class adds structure of 'log_transcoding' table to 'propel' DatabaseMap object.
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
class LogTranscodingMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.LogTranscodingMapBuilder';

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

		$tMap = $this->dbMap->addTable('log_transcoding');
		$tMap->setPhpName('LogTranscoding');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('MM_ID', 'MmId', 'int', CreoleTypes::INTEGER, 'mm', 'ID', true, null);

		$tMap->addForeignKey('LANGUAGE_ID', 'LanguageId', 'int', CreoleTypes::INTEGER, 'language', 'ID', false, null);

		$tMap->addForeignKey('PERFIL_ID', 'PerfilId', 'int', CreoleTypes::INTEGER, 'perfil', 'ID', false, null);

		$tMap->addForeignKey('CPU_ID', 'CpuId', 'int', CreoleTypes::INTEGER, 'cpu', 'ID', false, null);

		$tMap->addColumn('URL', 'Url', 'string', CreoleTypes::VARCHAR, true, 250);

		$tMap->addColumn('STATUS_ID', 'StatusId', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PRIORITY', 'Priority', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 150);

		$tMap->addColumn('TIMEINI', 'Timeini', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('TIMESTART', 'Timestart', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('TIMEEND', 'Timeend', 'int', CreoleTypes::TIMESTAMP, true, null);

		$tMap->addColumn('PID', 'Pid', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PATH_INI', 'PathIni', 'string', CreoleTypes::VARCHAR, true, 250);

		$tMap->addColumn('PATH_END', 'PathEnd', 'string', CreoleTypes::VARCHAR, true, 250);

		$tMap->addColumn('EXT_INI', 'ExtIni', 'string', CreoleTypes::CHAR, true, 6);

		$tMap->addColumn('EXT_END', 'ExtEnd', 'string', CreoleTypes::CHAR, true, 6);

		$tMap->addColumn('DURATION', 'Duration', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('SIZE', 'Size', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, false, 30);

	} // doBuild()

} // LogTranscodingMapBuilder
