<?php
 
class revisionhistoryComponents extends sfComponents
{
  public function executeShow()
  {
    // revision for the page
  	$this->revisionhistory = RevisionhistoryPeer::getByPageMnemonic(
  	  RevisionhistoryPeer::generatePageMnemonic()
  	);
    
    // revision for an item
    if (empty($this->revisionhistory)) {
        
      $item_info = ItemtypesPeer::getCurrentItemInfo();
      
      if ($item_info['item_id'] && $item_info['itemtypes_id'] && $item_info['item_culture']) {
        $this->revisionhistory = RevisionhistoryPeer::getByItem(
  	      $item_info['item_id'],
  	      $item_info['itemtypes_id'],
    	  $item_info['item_culture']
  	    );
      }
    }
  } 
}