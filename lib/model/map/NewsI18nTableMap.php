<?php


/**
 * This class defines the structure of the 'news_i18n' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.map
 */
class NewsI18nTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.NewsI18nTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('news_i18n');
		$this->setPhpName('NewsI18n');
		$this->setClassname('NewsI18n');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(false);
		// columns
		$this->addColumn('UPDATED_AT_EXTRA', 'UpdatedAtExtra', 'TIMESTAMP', false, null, null);
		$this->addColumn('TITLE', 'Title', 'LONGVARCHAR', true, null, null);
		$this->addColumn('SHORTBODY', 'Shortbody', 'LONGVARCHAR', true, null, null);
		$this->addColumn('BODY', 'Body', 'LONGVARCHAR', true, null, null);
		$this->addColumn('AUTHOR', 'Author', 'VARCHAR', false, 255, null);
		$this->addColumn('TRANSLATED_BY', 'TranslatedBy', 'VARCHAR', false, 255, null);
		$this->addColumn('LINK', 'Link', 'VARCHAR', false, 255, null);
		$this->addColumn('EXTRADATE', 'Extradate', 'VARCHAR', false, 255, null);
		$this->addColumn('DOC', 'Doc', 'VARCHAR', false, 255, null);
		$this->addForeignPrimaryKey('ID', 'Id', 'INTEGER' , 'news', 'ID', true, null, null);
		$this->addPrimaryKey('CULTURE', 'Culture', 'VARCHAR', true, 7, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('News', 'News', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
			'symfony_timestampable' => array('update_column_extra' => 'updated_at_extra', ),
			'symfony_i18n_translation' => array('culture_column' => 'culture', ),
		);
	} // getBehaviors()

} // NewsI18nTableMap
