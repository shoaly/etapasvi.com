<?php
 
class itemcategoryComponents extends sfComponents
{
  /**
   * Show categories tree
   *
   */
  public function executeShow()
  {
    //if (empty($this->item_type_list)) {
  	
    // fetch all categories and build trees excluding empty leaves
    $c = new Criteria();
    $c->add(ItemcategoryPeer::SHOW, 1);
    $c->addAscendingOrderByColumn(ItemcategoryPeer::ORDER);
    $itemcategory_list = ItemcategoryPeer::doSelectWithI18n($c, null, null, Criteria::LEFT_JOIN, true);
    
    // building tree
    $this->itemcategory_tree  = ItemcategoryPeer::buildTree($itemcategory_list);
  }
  
  /**
   * Show categories for an item
   *
   */
  public function executeShowitemcategories()
  {
    $this->itemcategory_list = Item2itemcategoryPeer::getItemCategories($this->item_type, $this->item_id);
  }
}