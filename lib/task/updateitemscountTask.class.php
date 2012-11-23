<?php
/**
 * Update ITEMS_COUNT field in Itemcategory table for all Item Types, cultures and Item Categories.
 * ITEMS_COUNT is stored in JSON
 * 
 *
 */

class updateitemscountTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      new sfCommandOption('verbose', null, sfCommandOption::PARAMETER_REQUIRED, 'Enables verbose output', true),
      // add your own options here
    ));

    $this->namespace        = 'project';
    $this->name             = 'updateitemscount';
    $this->briefDescription = 'Update ITEMS_COUNT field in Itemcategory table for all Item Types, cultures and Item Categories';
    $this->detailedDescription = <<<EOF
Update ITEMS_COUNT field in Itemcategory table for all Item Types, cultures and Item Categories
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
  	// creating context
  	sfContext::createInstance($this->configuration);
  	
  	// establishing DB connection
    $databaseManager = new sfDatabaseManager(sfProjectConfiguration::getApplicationConfiguration($options['application'], $options['prod'], true));
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();    	
  	
    $result = ItemcategoryPeer::updateItemsCount();
    print_r($result);

  }
  
}
