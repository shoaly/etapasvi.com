<?php

class VideoPeer extends BaseVideoPeer
{ 
  const ITEMS_PER_PAGE = 12;
  const TITLE_LENGTH   = 55; //38;
  
  /**
   * Проверка есть ли контент на определённом языке
   *
   * @param unknown_type $item_id
   * @param unknown_type $item_lang
   */
  public static function hasCultureContent($item_id, $item_lang)
  {
    $c = new Criteria();
    $c->add( VideoPeer::ID, $item_id );
    $c->addJoin( VideoPeer::ID, VideoI18nPeer::ID );
    $c->add( VideoI18nPeer::CULTURE, $item_lang );    
    //$c->add( VideoI18nPeer::CODE, '', Criteria::NOT_EQUAL );
    self::addVisibleCriteria($c);
    
    $video_list = VideoPeer::doSelect($c);
    
    if (count($video_list)) {
      return true;
    } else {
      return false;
    }
  }
  
  /**
   * Добавляет условие, при котором элемент отображается на языке пользователя
   *
   * @param unknown_type $c
   */
  public static function addVisibleCriteria($c)
  {  
    $c->add( VideoPeer::SHOW, 1 );
    
    $c_all_cultueres = $c->getNewCriterion(VideoI18nPeer::CODE, '', Criteria::NOT_EQUAL);
    $c_all_cultueres->addOr($c->getNewCriterion(VideoI18nPeer::TITLE, '', Criteria::NOT_EQUAL));
    $c_all_cultueres->addOr( $c->getNewCriterion(VideoPeer::ALL_CULTURES, 1) );
    
    $culture = sfContext::getInstance()->getUser()->getCulture();
    
    $c_extra = $c->getNewCriterion(VideoPeer::ALL_CULTURES, 1);
    
    $c_code = $c->getNewCriterion(VideoI18nPeer::CODE, '', Criteria::NOT_EQUAL);
    $c_code->addAnd( $c->getNewCriterion(VideoI18nPeer::CULTURE, $culture) );
    $c_extra->addOr( $c_code );
    
    // in default culture (en) title must be always set
    if ($culture != sfConfig::get('sf_default_culture')) {
      $c_title = $c->getNewCriterion(VideoI18nPeer::TITLE, '', Criteria::NOT_EQUAL);
      $c_title->addAnd( $c->getNewCriterion(VideoI18nPeer::CULTURE, $culture) );
      
      $c_extra->addOr( $c_title );
    }

	$c->add($c_extra);
  }
  
  /**
   * Для RSS: добавляет условие, при котором элемент отображается на языке пользователя
   *
   * @param unknown_type $c
   */
  public static function addRssVisibleCriteria($c)
  {  
    self::addVisibleCriteria($c);
  }
  
  /**
   * Get URL by ID
   */
  public static function getUrl($id)
  {
    $item = VideoPeer::retrieveByPk( $id );
    if ($item) {
        return $item->getUrl();
    } else {
        return '';
    }
  }
}
