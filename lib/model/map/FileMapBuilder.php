<?php


/**
 * This class adds structure of 'file' table to 'propel' DatabaseMap object.
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
class FileMapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.FileMapBuilder';

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

		$tMap = $this->dbMap->addTable('file');
		$tMap->setPhpName('File');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('MM_ID', 'MmId', 'int', CreoleTypes::INTEGER, 'mm', 'ID', true, null);

		$tMap->addForeignKey('PERFIL_ID', 'PerfilId', 'int', CreoleTypes::INTEGER, 'perfil', 'ID', false, null);

		$tMap->addForeignKey('LANGUAGE_ID', 'LanguageId', 'int', CreoleTypes::INTEGER, 'language', 'ID', false, null);

		$tMap->addColumn('URL', 'Url', 'string', CreoleTypes::VARCHAR, true, 250);

		$tMap->addColumn('FILE', 'File', 'string', CreoleTypes::VARCHAR, true, 250);

		$tMap->addForeignKey('FORMAT_ID', 'FormatId', 'int', CreoleTypes::INTEGER, 'format', 'ID', false, null);

		$tMap->addForeignKey('CODEC_ID', 'CodecId', 'int', CreoleTypes::INTEGER, 'codec', 'ID', false, null);

		$tMap->addForeignKey('MIME_TYPE_ID', 'MimeTypeId', 'int', CreoleTypes::INTEGER, 'mime_type', 'ID', false, null);

		$tMap->addForeignKey('RESOLUTION_ID', 'ResolutionId', 'int', CreoleTypes::INTEGER, 'resolution', 'ID', false, null);

		$tMap->addColumn('BITRATE', 'Bitrate', 'string', CreoleTypes::VARCHAR, true, 50);

		$tMap->addColumn('FRAMERATE', 'Framerate', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('CHANNELS', 'Channels', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('AUDIO', 'Audio', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('RANK', 'Rank', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('DURATION', 'Duration', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('NUM_VIEW', 'NumView', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PUNT_SUM', 'PuntSum', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('PUNT_NUM', 'PuntNum', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('SIZE', 'Size', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('RESOLUTION_HOR', 'ResolutionHor', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('RESOLUTION_VER', 'ResolutionVer', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addColumn('DISPLAY', 'Display', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('DOWNLOAD', 'Download', 'boolean', CreoleTypes::BOOLEAN, true, null);

	} // doBuild()

} // FileMapBuilder
