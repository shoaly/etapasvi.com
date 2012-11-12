<?php
/**
 * Clear cache of items listed in clearcache table
 * 
 * Example: 
 * ./symfony project:clearcache
 * 
 *
 */

class clearcacheTask extends sfBaseTask
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
    $this->name             = 'clearcache';
    $this->briefDescription = 'Clear cache of items listed in clearcache table';
    $this->detailedDescription = <<<EOF
Clear cache of items listed in clearcache table
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
  	// creating context
  	sfContext::createInstance($this->configuration);
  	
  	// establishing DB connection
    $databaseManager = new sfDatabaseManager(sfProjectConfiguration::getApplicationConfiguration($options['application'], $options['prod'], true));
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();    	
  	
    $result = ClearcachePeer::clearCache();
    if (count($result['items'])) {
    	echo "Cleared cache of the following items:\n";
    	print_r($result['items']);
    } else {
      echo 'No items';
    }
  }
  
}
