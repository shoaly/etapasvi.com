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
  const ITEM_TYPE_ANNOUNCEMENTS	 = 7;

  // названия элементов
  const ITEM_TYPE_NAME_NEWS  	  = 'News';
  const ITEM_TYPE_NAME_PHOTOALBUM = 'Photoalbum';
  const ITEM_TYPE_NAME_VIDEO 	  = 'Video';
  const ITEM_TYPE_NAME_PHOTO 	  = 'Photo';
  const ITEM_TYPE_NAME_AUDIO 	  = 'Audio';
  const ITEM_TYPE_NAME_DOCUMENTS  = 'Documents';
  const ITEM_TYPE_NAME_ANNOUNCEMENTS  = 'Announcements';

  // Названия элементов
  static $item_type_names 	    = array(
  	self::ITEM_TYPE_NEWS 	   => self::ITEM_TYPE_NAME_NEWS,
  	self::ITEM_TYPE_PHOTOALBUM => self::ITEM_TYPE_NAME_PHOTOALBUM,
  	self::ITEM_TYPE_VIDEO      => self::ITEM_TYPE_NAME_VIDEO,
  	self::ITEM_TYPE_PHOTO      => self::ITEM_TYPE_NAME_PHOTO,
  	self::ITEM_TYPE_AUDIO      => self::ITEM_TYPE_NAME_AUDIO,
  	self::ITEM_TYPE_DOCUMENTS  => self::ITEM_TYPE_NAME_DOCUMENTS,
  	self::ITEM_TYPE_ANNOUNCEMENTS  => self::ITEM_TYPE_NAME_ANNOUNCEMENTS,
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
  	self::ITEM_TYPE_ANNOUNCEMENTS  => 'announcements',
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

  /**
   * Retrieving current item info
   *
   * @return type
   */
  public static function getCurrentItemInfo()
  {
    $item_info = array(
      'item_id'         => '',
      'itemtypes_id'    => '',
      'item_culture'    => '',
    );

    $sf_context  = sfContext::getInstance();

    $item_info['item_culture'] = $sf_context->getUser()->getCulture();
    $item_info['item_id']      = $sf_context->getRequest()->getParameter('id');

    // determine Item Type by module and action
    $module    	 = $sf_context->getModuleName();
	$action      = $sf_context->getActionName();

    if ($module == self::getItemTypeNameLower(self::ITEM_TYPE_NEWS) && $action == 'show') {
      $item_info['itemtypes_id'] = self::ITEM_TYPE_NEWS;
    }
    if ($module == self::getItemTypeNameLower(self::ITEM_TYPE_PHOTO) && $action == 'album') {
      $item_info['itemtypes_id'] = self::ITEM_TYPE_PHOTOALBUM;
    }
    if ($module == self::getItemTypeNameLower(self::ITEM_TYPE_VIDEO) && $action == 'show') {
      $item_info['itemtypes_id'] = self::ITEM_TYPE_VIDEO;
    }
    if ($module == self::getItemTypeNameLower(self::ITEM_TYPE_PHOTO) && $action == 'show') {
      $item_info['itemtypes_id'] = self::ITEM_TYPE_PHOTO;
    }
    if ($module == self::getItemTypeNameLower(self::ITEM_TYPE_AUDIO) && $action == 'show') {
      $item_info['itemtypes_id'] = self::ITEM_TYPE_AUDIO;
    }
    if ($module == self::getItemTypeNameLower(self::ITEM_TYPE_DOCUMENTS) && $action == 'show') {
      $item_info['itemtypes_id'] = self::ITEM_TYPE_DOCUMENTS;
    }

    return $item_info;
  }

  /**
   * Get Item by ID and Type ID
   *
   * @param type $item_id
   * @param type $itemtypes_id
   * @return null
   */
  public static function getItem($item_id, $itemtypes_id)
  {
    if (!$item_id || !$itemtypes_id) {
      return null;
    }
	$type = self::getItemTypeName($itemtypes_id);
	$fn = array($type . 'Peer', 'retrieveByPk');

	try {
	  return call_user_func( $fn, $item_id );
    } catch(Exception $e) {
      return null;
    }
  }

  /**
   * Retrieve item title from URL
   *
   * @param type $url
   */
  public static function getItemTitleFromUrl($url)
  {
    $parse_url = parse_url($url);

    preg_match("/^\/[^\/]+\/[^\/]+\/\d+\/(.*)/", $parse_url['path'], $matches);
    return $matches[1];
  }

  /**
   * Check if check_url is valid
   *
   * @param type $item_utl
   * @param type $check_url
   */
  public static function isItemUrlValid($item_url)
  {
    // for photo: /ru/photo/view
    if ($_SERVER['PATH_INFO']) {
      $path_info_url = $_SERVER['PATH_INFO'];
    } else {
      $path_info_url = $_SERVER['REQUEST_URI'];
    }

    $path_info_url = preg_replace("/\?.*/", "", $path_info_url);

    // cut out revision id
    $path_info_url = preg_replace(RevisionhistoryPeer::getRevisionUrlRegex(), "", $path_info_url);

  	// если адрес новости неверный, редиректим на нужный адрес
  	$url_parse = parse_url($item_url);

  	if ( $path_info_url && ($path_info_url != $url_parse['path'])) {
	  return false;
	} else {
      return true;
    }
  }

  /**
   * Get current item revision from URL
   *
   */
  public static function getCurrentItemRevision()
  {
    $revision = RevisionhistoryPeer::getRevisionFromUrl();

    if (!$revision) {
      return null;
    }

    // check if passed revision belongs to current item
    $item_info = self::getCurrentItemInfo();

    if ($revision->getItemId() == $item_info['item_id'] &&
        $revision->getItemtypesId() == $item_info['itemtypes_id'] &&
        $revision->getItemCulture() == $item_info['item_culture'])
    {
      return $revision;
    }
    return null;
  }

  /**
   * Set item attributes from revision passed in URL
   *
   * @param type $item
   */
  public static function setItemFromRevision($item)
  {
    $revision = ItemtypesPeer::getCurrentItemRevision();
    if ($revision && $revision->getBody()) {

      $context = sfContext::getInstance();
      $i18n =  $context->getI18N();

      // use default culture title if empty
      $title = $item->getTitle(sfContext::getInstance()->getUser()->getCulture(), true);
      $title .= ' ('.$i18n->__('Revision from').' '.$revision->getCreatedAt().')';

      $item->setTitle($title);
      $item->setBody($revision->getBody());

      return true;
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
