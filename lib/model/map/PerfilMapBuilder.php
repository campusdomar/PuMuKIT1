<?php


/**
 * This class adds structure of 'perfil' table to 'propel' DatabaseMap object.
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
class PerfilMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.PerfilMapBuilder';

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

		$tMap = $this->dbMap->addTable('perfil');
		$tMap->setPhpName('Perfil');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NAME', 'Name', 'string', CreoleTypes::VARCHAR, true, 25);

		$tMap->addColumn('RANK', 'Rank', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('DISPLAY', 'Display', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('WIZARD', 'Wizard', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('FORMAT', 'Format', 'string', CreoleTypes::VARCHAR, false, 35);

		$tMap->addColumn('CODEC', 'Codec', 'string', CreoleTypes::VARCHAR, false, 35);

		$tMap->addColumn('MIME_TYPE', 'MimeType', 'string', CreoleTypes::VARCHAR, false, 35);

		$tMap->addColumn('EXTENSION', 'Extension', 'string', CreoleTypes::VARCHAR, true, 6);

		$tMap->addColumn('RESOLUTION_HOR', 'ResolutionHor', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('RESOLUTION_VER', 'ResolutionVer', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('BITRATE', 'Bitrate', 'string', CreoleTypes::VARCHAR, true, 50);

		$tMap->addColumn('FRAMERATE', 'Framerate', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CHANNELS', 'Channels', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('AUDIO', 'Audio', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('BAT', 'Bat', 'string', CreoleTypes::LONGVARCHAR, true, null);

		$tMap->addColumn('FILE_CFG', 'FileCfg', 'string', CreoleTypes::VARCHAR, false, 150);

		$tMap->addForeignKey('STREAMSERVER_ID', 'StreamserverId', 'int', CreoleTypes::INTEGER, 'streamserver', 'ID', false, null);

		$tMap->addColumn('APP', 'App', 'string', CreoleTypes::VARCHAR, true, 50);

		$tMap->addColumn('REL_DURATION_SIZE', 'RelDurationSize', 'double', CreoleTypes::DOUBLE, false, null);

		$tMap->addColumn('REL_DURATION_TRANS', 'RelDurationTrans', 'double', CreoleTypes::DOUBLE, false, null);

		$tMap->addColumn('PRESCRIPT', 'Prescript', 'string', CreoleTypes::LONGVARCHAR, false, null);

	} // doBuild()

} // PerfilMapBuilder
