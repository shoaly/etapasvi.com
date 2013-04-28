<?php
/**
 * Generate teachings documents
 *
 */

class generateteachingsdocumentsTask extends sfBaseTask
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
    $this->name             = 'generateteachingsdocuments';
    $this->briefDescription = 'Generate teachigns documents';
    $this->detailedDescription = <<<EOF
Generate teachigns documents
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
  	// creating context
  	sfContext::createInstance($this->configuration);

  	// establishing DB connection
    $databaseManager = new sfDatabaseManager(sfProjectConfiguration::getApplicationConfiguration($options['application'], $options['prod'], true));
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    // i18n
    $context = sfContext::getInstance();
    $i18n =  $context->getI18N();

    foreach (UserPeer::getCultures() as $culture) {

      // fetch teachigns
      $c = new Criteria();
      NewsPeer::addVisibleCriteria($c);

      $c->addJoin(
        array(Item2itemcategoryPeer::ITEM_ID, Item2itemcategoryPeer::ITEM_TYPE),
        array(NewsPeer::ID, ItemtypesPeer::ITEM_TYPE_NEWS)
      );

      $c->add(Item2itemcategoryPeer::ITEMCATEGORY_ID, ItemcategoryPeer::ITEMCATEGORY_MESSAGES);

      $c->addDescendingOrderByColumn(NewsPeer::DATE);
      $list = NewsPeer::doSelectWithI18n($c, $culture);

      echo '[' . $culture . '] Teachings found: ' . count($list) ."\n";

      $html = '';
      foreach ($list as $news_item) {
        $news_item->setCulture($culture);
        $html .= $news_item->getHtml($culture) . "<br/><br/><br/><br/>";
      }

      $title = $i18n->__('Teachings', array('culture'=>$culture));
      if (!$title) {
        $title = 'Teachings';
      }

      $generated_document_id = DocumentsPeer::createFromHtml(
      	  $html, $title, '', $culture, ItemtypesPeer::ITEM_TYPE_NEWS, 'teachings', false
      );

  	  // add document to Messages Itemcategory
      if ($generated_document_id) {
        Item2itemcategoryPeer::add(ItemcategoryPeer::ITEMCATEGORY_MESSAGES, $generated_document_id, ItemtypesPeer::ITEM_TYPE_DOCUMENTS);
      }

      if ($generated_document_id) {
        echo "Document successfully generated\n";
      } else {
        echo "Error generating document\n";
      }

    }
  }
}
