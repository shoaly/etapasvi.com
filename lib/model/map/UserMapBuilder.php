<?php


/**
 * This class adds structure of 'user' table to 'propel' DatabaseMap object.
 *
 *
 * This class was autogenerated by Propel 1.3.0-dev on:
 *
 * Mon Feb 28 06:46:50 2011
 *
 *
 * These statically-built map classes are used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class UserMapBuilder implements MapBuilder {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.UserMapBuilder';

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
		$this->dbMap = Propel::getDatabaseMap(UserPeer::DATABASE_NAME);

		$tMap = $this->dbMap->addTable(UserPeer::TABLE_NAME);
		$tMap->setPhpName('User');
		$tMap->setClassname('User');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'INTEGER', true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null);

		$tMap->addForeignKey('TIMEZONE_ID', 'TimezoneId', 'INTEGER', 'timezone', 'ID', false, null);

		$tMap->addColumn('NAME', 'Name', 'VARCHAR', true, 255);

		$tMap->addColumn('EMAIL', 'Email', 'VARCHAR', true, 255);

		$tMap->addColumn('PASSWORD', 'Password', 'VARCHAR', true, 255);

		$tMap->addColumn('PROFILE', 'Profile', 'VARCHAR', false, 255);

		$tMap->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', false, null);

		$tMap->addColumn('REMEMBER_ME_CODE', 'RememberMeCode', 'VARCHAR', false, 255);

		$tMap->addColumn('IP', 'Ip', 'VARCHAR', false, 20);

		$tMap->addColumn('LAST_LOGIN', 'LastLogin', 'TIMESTAMP', false, null);

		$tMap->addColumn('LANG', 'Lang', 'VARCHAR', false, 7);

		$tMap->addColumn('PHPBB_ID', 'PhpbbId', 'INTEGER', false, null);

		$tMap->addColumn('REMIND_CODE', 'RemindCode', 'VARCHAR', false, 32);

		$tMap->addColumn('SUBSCRIBE_NEWS', 'SubscribeNews', 'BOOLEAN', false, null);

		$tMap->addColumn('SUBSCRIBE_PHOTO', 'SubscribePhoto', 'BOOLEAN', false, null);

		$tMap->addColumn('SUBSCRIBE_VIDEO', 'SubscribeVideo', 'BOOLEAN', false, null);

		$tMap->addColumn('NOTES', 'Notes', 'LONGVARCHAR', false, null);

	} // doBuild()

} // UserMapBuilder