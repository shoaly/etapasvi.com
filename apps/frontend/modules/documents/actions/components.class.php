<?php

class documentsComponents extends sfComponents
{
  /**
   * Последние Документы
   *
   */
  public function executeLatest()
  {
  	$c = new Criteria();
    DocumentsPeer::addVisibleCriteria($c);
    $c->addDescendingOrderByColumn( DocumentsPeer::ORDER );
    $c->setLimit(DocumentsPeer::LATEST_COUNT);

    $this->documents_list = DocumentsPeer::doSelectWithI18n($c);
  }

  /**
   * Встраивание отдельного Документы
   *
   */
  public function executeShow()
  {
    if (empty($this->documents)) {
  	  $this->documents = DocumentsPeer::retrieveByPk( $this->id );
    }
  }

  /**
   * Встраивание отдельного Документы
   *
   */
  public function executeShowShort()
  {
    if (empty($this->documents)) {
  	  $this->documents = DocumentsPeer::retrieveByPk( $this->id );
    }
  }

  /**
   * Get document containing teachings.
   *
   */
  public function executeShowTeachings()
  {
  	$c = new Criteria();
    DocumentsPeer::addVisibleCriteria($c);
    $c->add(DocumentsPeer::FILE, '%_teachings_%', Criteria::LIKE);
    $c->addJoin(
      array(Item2itemcategoryPeer::ITEM_ID, Item2itemcategoryPeer::ITEM_TYPE),
      array(DocumentsPeer::ID, ItemtypesPeer::ITEM_TYPE_DOCUMENTS)
    );
    $c->add(Item2itemcategoryPeer::ITEMCATEGORY_ID, ItemcategoryPeer::ITEMCATEGORY_MESSAGES);
    $c->setLimit(1);

    $documents_list = DocumentsPeer::doSelectWithI18n($c);
    $this->document = $documents_list[0];
  }

}