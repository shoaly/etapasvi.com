<?php

require 'lib/model/om/BaseClearcachePeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'clearcache' table.
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
class ClearcachePeer extends BaseClearcachePeer {
	
  /**
   * Add records for clearing cache of a modified item
   *
   * @param unknown_type $item
   * @param unknown_type $item_type_name
   */
  public static function processItem($item)
  {
    // if main object has been modified, clearing cache for all cultures
    if ($item->isModified()) {
      
      $user_id      = sfContext::getInstance()->getUser()->getAttribute('user_id','','sfGuardSecurityUser');
      $item_id      = $item->getId();
      $itemtypes_id = ItemtypesPeer::getObjectItemTypeId($item);
      $item_culture = UserPeer::ALL_CULTURES;
      
      self::add($user_id, $item_id, $itemtypes_id, $item_culture);

    } else {
      // clear cache for those cultures which have been changed
      $user_id      = sfContext::getInstance()->getUser()->getAttribute('user_id','','sfGuardSecurityUser');
      $item_id      = $item->getId();
      $itemtypes_id = ItemtypesPeer::getObjectItemTypeId($item);
        
      // get I18n items
      try {
        $item_i18ns = call_user_func(array($item, 'get'.get_class($item).'I18ns'));
      } catch(Exception $e) {}
      
      foreach ($item_i18ns as $i18n) {
      	if ($i18n->isModified()) {
      	  // check if any non-service fields have been modified
      	  $only_service_fields_modified = true;
		  foreach ($i18n->getModifiedColumns() as $modified_column) {
		  	// news_i18n.UPDATED_AT_EXTRA -> UpdatedAtExtra
			$modified_column_name = preg_replace("/^[^\.]+\./", '', $modified_column);
			if (in_array($modified_column_name, array('ID', 'CULTURE', 'UPDATED_AT', 'UPDATED_AT_EXTRA'))) {
				continue;
			}
			$only_service_fields_modified = false;
			break;
		  }
		  if (!$only_service_fields_modified) {
            $item_culture = $i18n->getCulture();
    	    self::add($user_id, $item_id, $itemtypes_id, $item_culture);
		  }
      	}
      }
    }
  }
  
  /**
   * Add item to clearcache table
   *
   * @param unknown_type $user_id
   * @param unknown_type $item_id
   * @param unknown_type $itemtypes_id
   * @param unknown_type $item_culture
   * @return unknown
   */
  public static function add($user_id, $item_id, $itemtypes_id, $item_culture)
  {
  	if (!$user_id || !$item_id || !$itemtypes_id || !$item_culture) {
  	  return false;
  	}
  	
  	// check if there is unprocessed item
  	$c = new Criteria();
  	$c->add(ClearcachePeer::ITEM_ID, $item_id);
  	$c->add(ClearcachePeer::ITEMTYPES_ID, $itemtypes_id);
  	$c->add(ClearcachePeer::ITEM_CULTURE, $item_culture);
  	$c->add(ClearcachePeer::CLEARED, false);
  	$unprocessed_item = ClearcachePeer::doCount($c);
  	if ($unprocessed_item) {
  	  return true;
  	}
  	
  	$clearcache = new Clearcache();
    $clearcache->setSfGuardUserId($user_id);
    $clearcache->setItemId($item_id);
    $clearcache->setItemtypesId($itemtypes_id);
    $clearcache->setItemCulture($item_culture);
    try {
      $clearcache->save();
    } catch(Exception $e) {}
    
    if ($clearcache->getId()) {
      return true;
    } else {
      return false;
    }
  }
  
  /**
   * Clear cache of items listed in clearcache table
   *
   */
  public static function clearCache()
  {
  	$result = array(
  	  'items' => array(),
  	  'errorDescription' => ''
  	);
    // get list of items
    $clearcache_list = ClearcachePeer::doSelect(new Criteria());
    if (count($clearcache_list)) {
      foreach ($clearcache_list as $clearcache) {
  	    sfSuperCache::clearCacheOfItem(
		  $clearcache->getId(), 
		  $clearcache->getItemtypes()->getName(),
		  $clearcache->getItemCulture()
  	    );
        $result['items'][] = $clearcache->toArray();
        $clearcache->setCleared(true);
        $clearcache->save();
      }
    }
    return $result;
  }
} // ClearcachePeer
