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
  
}