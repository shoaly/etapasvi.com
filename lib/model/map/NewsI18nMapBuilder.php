<?php


/**
 * This class adds structure of 'news_i18n' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Mon Feb 28 06:46:51 2011
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class NewsI18nMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.NewsI18nMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(NewsI18nPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(NewsI18nPeer::TABLE_NAME);
		$tMap->setPhpName('NewsI18n');
		$tMap->setClassname('NewsI18n');

		$tMap->setUseIdGenerator(false);

		$tMap->addColumn('TITLE', 'Title', 'LONGVARCHAR', true, null);

		$tMap->addColumn('SHORTBODY', 'Shortbody', 'LONGVARCHAR', true, null);

		$tMap->addColumn('BODY', 'Body', 'LONGVARCHAR', true, null);

		$tMap->addColumn('AUTHOR', 'Author', 'VARCHAR', false, 255);

		$tMap->addColumn('TRANSLATED_BY', 'TranslatedBy', 'VARCHAR', false, 255);

		$tMap->addColumn('LINK', 'Link', 'VARCHAR', false, 255);

		$tMap->addColumn('EXTRADATE', 'Extradate', 'VARCHAR', false, 255);

		$tMap->addForeignPrimaryKey('ID', 'Id', 'INTEGER' , 'news', 'ID', true, null);

		$tMap->addPrimaryKey('CULTURE', 'Culture', 'VARCHAR', true, 7);

	} // doBuild()

} // NewsI18nMapBuilder