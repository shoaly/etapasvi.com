<?php

require 'lib/model/om/BaseItemcategoryPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'itemcategory' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class ItemcategoryPeer extends BaseItemcategoryPeer {
	
  /**
   * Build a tree from given list of Itemcategory elements
   *
   * @param unknown_type $itemcategory_list
   * @param unknown_type $itemcategory_el
   * @return unknown
   */
  public static function buildTree( $list, $element = null, $level = 0 )
  {
  	$next_level = $level + 1;
  	$tree_element    = array();
  	
  	if ($element) {
  	  $tree_element['object'] = $element; //'$list_item';
  	  $tree_element['level']  = $level;
  	}
  	
  	foreach ($list as $list_item) {
  		
      if ($level) {
      	
	    if ($list_item->getItemcategoryId() == $element->getId()) {
	      $new_tree_element           = array();
	  	  $new_tree_element['object'] = $list_item;
	  	  $new_tree_element['level']  = $next_level;
          $children 			      = ItemcategoryPeer::buildTree($list, $list_item, $next_level);
          if ($children) {
            $tree_element['children'][] = $children;
          }
        }
        
      } else {
      	
        // first level - choose elements without parent only
        if (!$list_item->getItemcategoryId()) {
          $tree_element[] = ItemcategoryPeer::buildTree($list, $list_item, $next_level);
        }
        
      }
    }
  	
  	return $tree_element;
  }
  
  /**
   * Get conditions for indexing items
   *
   * @param unknown_type $c
   * @param unknown_type $item_type_id
   * @param unknown_type $itemcategory_id
   */
  public static function getIndexCriteria( $c, $item_type_id, $itemcategory_code )
  {
  	if (!$itemcategory_code) {
  	  return;
  	}
  	$itemcategory = self::getByCode($itemcategory_code);
  	if (empty($itemcategory)) {
  	  return;
  	}
  	$itemcategory_id = $itemcategory->getId();
  	
  	$item_peer = ItemtypesPeer::getItemTypeName($item_type_id).'Peer';
  	
  	$c->addJoin(
  	  array($item_peer::ID, Item2itemcategoryPeer::ITEM_TYPE), 
  	  array(Item2itemcategoryPeer::ITEM_ID, $item_type_id),
  	  Criteria::INNER_JOIN
  	);
  	$c->add(Item2itemcategoryPeer::ITEMCATEGORY_ID, $itemcategory_id);
  }
  
  /**
   * Get element by Code
   *
   * @param unknown_type $code
   * @return unknown
   */
  public static function getByCode( $code )
  {
  	$c = new Criteria();
  	$c->add(ItemcategoryPeer::CODE, trim($code));
  	return ItemcategoryPeer::doSelectOne($c);
  }
  
  /**
   * Generate URL
   *
   * @param unknown_type $module_action
   * @param unknown_type $code
   * @param unknown_type $parameters
   * @param unknown_type $culture
   */
  public static function getUrl($module_action, $code, $parameters = array(), $culture = '')
  {
	  if (!$module_action) {
	  	return '';
	  }
	  if (empty($culture)){
		$culture = sfContext::getInstance()->getUser()->getCulture();
	  }	 
	  
      $url_pattern = $module_action.'?itemcategory=' . $code;
	  
	  
	  foreach ($parameters as $parameter=>$value) {
	  	if ('' != $value) {
	      $url_pattern .= '&' . $parameter . '=' . $value;
	  	}
	  }

	  $url = sfContext::getInstance()->getController()->genUrl($url_pattern, true, $culture);
	  return $url;
  }
  
} // ItemcategoryPeer
