<?php
/**
 * Generate documents for modified News
 * 
 * Example: 
 * ./symfony project:clearcache
 * 
 *
 */

class generatedocumentsTask extends sfBaseTask
{
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      new sfCommandOption('verbose', null, sfCommandOption::PARAMETER_REQUIRED, 'Enables verbose output', true),
      new sfCommandOption('all_news', null, sfCommandOption::PARAMETER_REQUIRED, 'Generate document for all news', 0),
      // add your own options here
    ));

    $this->namespace        = 'project';
    $this->name             = 'generatedocuments';
    $this->briefDescription = 'Generate documents for modified News';
    $this->detailedDescription = <<<EOF
Generate documents for modified News
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
  	// creating context
  	sfContext::createInstance($this->configuration);
  	
  	// establishing DB connection
    $databaseManager = new sfDatabaseManager(sfProjectConfiguration::getApplicationConfiguration($options['application'], $options['prod'], true));
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();    	
  	
    if (!$options['all_news']) {
      $result = ClearcachePeer::generateDocuments();
      if (count($result['items'])) {
    	  echo "Documents have been generated for the following items:\n";
    	  print_r($result['items']);
      } else {
        echo 'No items';
      }
    } else {
  	  $c = new Criteria();
  	  NewsPeer::addVisibleCriteria($c);
      $c->setLimit(1);
  	  $news_list = NewsPeer::doSelect($c);
  	  echo 'Begin';
  	  foreach ($news_list as $news_item) {
        $clearcache = new Clearcache();
        $clearcache->setItemCulture('all');
        $clearcache->setItemId($news_item->getId());
        ClearcachePeer::generateItemDocument($clearcache);
        unset($clearcache);
        echo $news_item->getId() . '<br/>';
  	  }
  	  exit();
    }
  }
  
}
