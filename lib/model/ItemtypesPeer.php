<?php
/**
 * Типы дублируются в БД
 *
 */
class ItemtypesPeer extends BaseItemtypesPeer
{
  // ID элементов
  const ITEM_TYPE_NEWS  	 = 1;
  const ITEM_TYPE_PHOTOALBUM = 2;
  const ITEM_TYPE_VIDEO 	 = 3;
  const ITEM_TYPE_PHOTO 	 = 4;
  //const ITEM_TYPE_MAIL 	     = 5;
  const ITEM_TYPE_AUDIO	     = 5;
  const ITEM_TYPE_DOCUMENTS	 = 6;
  
  // названия элементов
  const ITEM_TYPE_NAME_NEWS  	  = 'News';
  const ITEM_TYPE_NAME_PHOTOALBUM = 'Photoalbum';
  const ITEM_TYPE_NAME_VIDEO 	  = 'Video';
  const ITEM_TYPE_NAME_PHOTO 	  = 'Photo';
  const ITEM_TYPE_NAME_AUDIO 	  = 'Audio';
  const ITEM_TYPE_NAME_DOCUMENTS  = 'Documents';
  
  // Названия элементов
  static $item_type_names 	    = array(
  	self::ITEM_TYPE_NEWS 	   => self::ITEM_TYPE_NAME_NEWS,
  	self::ITEM_TYPE_PHOTOALBUM => self::ITEM_TYPE_NAME_PHOTOALBUM,
  	self::ITEM_TYPE_VIDEO      => self::ITEM_TYPE_NAME_VIDEO,
  	self::ITEM_TYPE_PHOTO      => self::ITEM_TYPE_NAME_PHOTO,
  	self::ITEM_TYPE_AUDIO      => self::ITEM_TYPE_NAME_AUDIO,
  	self::ITEM_TYPE_DOCUMENTS  => self::ITEM_TYPE_NAME_DOCUMENTS,
  );
  
  // names used in index URLs
  // used for clearing Item Categories cache
  static $item_type_indexes  = array(
  	self::ITEM_TYPE_NEWS 	   => 'news',
  	self::ITEM_TYPE_PHOTOALBUM => 'photoalbums',
  	self::ITEM_TYPE_VIDEO      => 'video',
  	self::ITEM_TYPE_PHOTO      => 'photoalbums',
  	self::ITEM_TYPE_AUDIO      => 'audio',
  	self::ITEM_TYPE_DOCUMENTS  => 'documents',
  );
  
  /**
   * Получение названия типа по ID.
   *
   * @param unknown_type $item_type_id
   * @return unknown
   */
  public static function getItemTypeName( $item_type_id )
  {
  	return self::$item_type_names[ $item_type_id ];
  }
  
  /**
   * Получение ID по названию типа.
   *
   * @param unknown_type $item_type_id
   * @return unknown
   */
  public static function getItemTypeId( $item_type_name )
  {
  	foreach (self::$item_type_names as $id=>$name) {
  	  if (strtolower($name) == strtolower($item_type_name)) {
  	  	return $id;
  	  }
  	}
  	return '';
  }
  
  /**
   * Get Item Type index part of URL
   *
   * @param unknown_type $item_type_id
   * @return unknown
   */
  public static function getItemTypeIndex( $item_type_id )
  {
  	return self::$item_type_indexes[ $item_type_id ];
  }
  
  public static function getItemTypeNameLower( $item_type_id )
  {
  	return strtolower(self::$item_type_names[ $item_type_id ]);
  }
  
  /**
   * Get item type names in lower case
   *
   * @return unknown
   */
  public static function getItemTypeNamesLower()
  {
  	$item_type_names = array();
  	foreach (self::$item_type_names as $name) {
  		$item_type_names[] = strtolower($name);
  	}
  	return $item_type_names;
  }
  
  /**
   * Get Item Type Id for an object provided
   *
   * @param unknown_type $object
   */
  public static function getObjectItemTypeId( $object )
  {
  	$classname = get_class( $object );
  	foreach (self::$item_type_names as $item_type_id => $item_type_name) {
  	  if ($item_type_name == $classname) {
  	  	return $item_type_id;
  	  }
  	}
  	return false;
  }
  
//  /**
//   * URL элемента
//   *
//   * @param unknown_type $item_lang
//   * @param unknown_type $item_id
//   * @param unknown_type $item_type
//   * @return unknown
//   */
//  public static function getItemUrl( $item_lang, $item_id, $item_type )
//  {         	
//	$url = UserPeer::SITE_123PROTOCOL . '://' . UserPeer::SITE_XXX_ADDRESS . '/' 
//			. $item_lang . '/' . self::getItemTypeNameLower( $item_type ) 
//			. '/show/id/' . $item_id . '/';       
//	return $url;
//  }
  
//  public static function getItemTypeId( $item_type_name )
//  {
//    foreach (self::$item_type_names as $item_type => $name ) {
//  	  if (strtolower($name) == strtolower($item_type_name)) {
//
//  		return $item_type;
//  	  }
//    }
//    return 0;
//  }
  
//  /**
//   * Получение заголовка элемента по типу
//   *
//   * @param unknown_type $item_id
//   * @param unknown_type $item_type
//   * @param unknown_type $item_lang
//   * @return unknown
//   */
//  static public function getItemTitle( $item_id, $item_type, $item_lang )
//  {
//	// получение названия элемента		
//    $c = new Criteria();
//    
//	switch ($item_type) {
//        
//      case ItemtypesPeer::ITEM_TYPE_NEWS:          	
//      	$c->add( NewsI18nPeer::ID, $item_id );
//      	$c->add( NewsI18nPeer::CULTURE, $item_lang );
//      	$c->addSelectColumn( NewsI18nPeer::TITLE );
//      	$item = NewsI18nPeer::doSelectOne( $c );          	          
//        break;
//        
//      case ItemtypesPeer::ITEM_TYPE_PHOTO:
//      	$c->add( PhotoI18nPeer::ID, $item_id );
//      	$c->add( PhotoI18nPeer::CULTURE, $item_lang );
//      	$c->addSelectColumn( PhotoI18nPeer::TITLE );
//      	$item = PhotoI18nPeer::doSelectOne( $c );
//        break;
//        
//      case ItemtypesPeer::ITEM_TYPE_VIDEO:
//      	$c->add( VideoI18nPeer::ID, $item_id );
//      	$c->add( VideoI18nPeer::CULTURE, $item_lang );
//      	$c->addSelectColumn( VideoI18nPeer::TITLE );
//      	$item = VideoI18nPeer::doSelectOne( $c );          
//        break;
//        
//      case ItemtypesPeer::ITEM_TYPE_MAIL:
//      	$c->add( MailI18nPeer::ID, $item_id );
//      	$c->add( MailI18nPeer::CULTURE, $item_lang );
//      	$c->addSelectColumn( MailI18nPeer::TITLE );
//      	$item = MailI18nPeer::doSelectOne( $c );          
//        break;
//	}
//  	if ($item) {
//    	return $item->getTitle();
//  	} else {
//  		return '';
//  	}
//  }
  
//  /**
//   * Получение элементов по типам
//   *
//   * @param unknown_type $item_id
//   * @param unknown_type $item_type
//   * @param unknown_type $item_lang
//   * @return unknown
//   */
//  static public function getItem( $item_id, $item_type, $item_lang )
//  {
//	// получение названия элемента		
//    $c = new Criteria();
//    
//	switch ($item_type) {
//        
//      case ItemtypesPeer::ITEM_TYPE_NEWS:          	
//      	$c->add( NewsI18nPeer::ID, $item_id );
//      	$c->add( NewsI18nPeer::CULTURE, $item_lang );
//      	$item = NewsI18nPeer::doSelectOne( $c );          	          
//        break;
//        
//      case ItemtypesPeer::ITEM_TYPE_PHOTO:
//      	$c->add( PhotoI18nPeer::ID, $item_id );
//      	$c->add( PhotoI18nPeer::CULTURE, $item_lang );
//      	$item = PhotoI18nPeer::doSelectOne( $c );
//        break;
//        
//      case ItemtypesPeer::ITEM_TYPE_VIDEO:
//      	$c->add( VideoI18nPeer::ID, $item_id );
//      	$c->add( VideoI18nPeer::CULTURE, $item_lang );
//      	$item = VideoI18nPeer::doSelectOne( $c );          
//        break;
//        
//      case ItemtypesPeer::ITEM_TYPE_MAIL:
//      	$c->add( MailI18nPeer::ID, $item_id );
//      	$c->add( MailI18nPeer::CULTURE, $item_lang );
//      	$item = MailI18nPeer::doSelectOne( $c );          
//        break;
//	}
//
//    return $item;
//  }
    
}
