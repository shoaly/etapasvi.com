<?php


/**
 * This class defines the structure of the 'itemcategory' table.
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
class ItemcategoryTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ItemcategoryTableMap';

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
		$this->setName('itemcategory');
		$this->setPhpName('Itemcategory');
		$this->setClassname('Itemcategory');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('ITEMCATEGORY_ID', 'ItemcategoryId', 'INTEGER', 'itemcategory', 'ID', false, null, null);
		$this->addColumn('SHOW', 'Show', 'BOOLEAN', false, null, true);
		$this->addColumn('ORDER', 'Order', 'INTEGER', true, null, null);
		$this->addColumn('CODE', 'Code', 'VARCHAR', false, 255, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('ItemcategoryRelatedByItemcategoryId', 'Itemcategory', RelationMap::MANY_TO_ONE, array('itemcategory_id' => 'id', ), null, null);
    $this->addRelation('ItemcategoryRelatedByItemcategoryId', 'Itemcategory', RelationMap::ONE_TO_MANY, array('id' => 'itemcategory_id', ), null, null);
    $this->addRelation('ItemcategoryI18n', 'ItemcategoryI18n', RelationMap::ONE_TO_MANY, array('id' => 'id', ), 'CASCADE', null);
    $this->addRelation('Item2itemcategory', 'Item2itemcategory', RelationMap::ONE_TO_MANY, array('id' => 'itemcategory_id', ), null, null);
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
			'symfony_i18n' => array('i18n_table' => 'itemcategory_i18n', ),
		);
	} // getBehaviors()

} // ItemcategoryTableMap