<?php


/**
 * This class defines the structure of the 'itemtypes' table.
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
class ItemtypesTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.map.ItemtypesTableMap';

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
		$this->setName('itemtypes');
		$this->setPhpName('Itemtypes');
		$this->setClassname('Itemtypes');
		$this->setPackage('lib.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 13, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Item2itemRelatedByItem1Type', 'Item2item', RelationMap::ONE_TO_MANY, array('id' => 'item1_type', ), null, null);
    $this->addRelation('Item2itemRelatedByItem2Type', 'Item2item', RelationMap::ONE_TO_MANY, array('id' => 'item2_type', ), null, null);
    $this->addRelation('Item2itemcategory', 'Item2itemcategory', RelationMap::ONE_TO_MANY, array('id' => 'item_type', ), null, null);
    $this->addRelation('Revisionhistory', 'Revisionhistory', RelationMap::ONE_TO_MANY, array('id' => 'itemtypes_id', ), null, null);
    $this->addRelation('Clearcache', 'Clearcache', RelationMap::ONE_TO_MANY, array('id' => 'itemtypes_id', ), null, null);
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
		);
	} // getBehaviors()

} // ItemtypesTableMap
