<?php

/**
 * Announcements actions.
 *
 * @package    sf_sandbox
 * @subpackage announcements
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class announcementsActions extends sfActions
{

  public function executeShow(sfWebRequest $request)
  {
  	$this->id 	 = $request->getParameter('id');
  	$this->title = $request->getParameter('title');

  	$this->announcements = AnnouncementsPeer::retrieveByPk( $this->id );

  	$culture     = sfContext::getInstance()->getUser()->getCulture();

  	if (!$this->announcements || !$this->announcements->getShow()) {
  		throw new sfError404Exception();
  	}

    if (!$this->announcements->getTitle($culture, $this->announcements->getAllCultures())) {
        sfActions::forward('default', 'nottranslated');
    }

  	// проверка title
  	$announcements_title = $this->announcements->getTitle();

  	if ($announcements_title) {
  		// если на траницу перешли с другого языка, то title неверный
//  		$announcements_title_translit = TextPeer::urlTranslit($announcements_title);
//  		if ( $this->title != $announcements_title_translit ) {
//  			sfActions::redirect( $this->announcements->getUrl() );
//  		}
        if (!ItemtypesPeer::isItemUrlValid($this->announcements->getUrl())) {
            sfActions::redirect( $this->announcements->getUrl() );
        }

	    $context = sfContext::getInstance();
	    $i18n =  $context->getI18N();

	    $response = $this->getResponse();
	    $response->setTitle($announcements_title);
  	} elseif (!$announcements_title && $this->title) {
  		// если у элемента нет Заголовка, а в URL передан title, редиректим
        if (!ItemtypesPeer::isItemUrlValid($this->announcements->getUrl())) {
          sfActions::redirect( $this->announcements->getUrl() );
        }
  	}
  }

  public function executeIndex(sfWebRequest $request)
  {
    $c = new Criteria();
    $c->addDescendingOrderByColumn( AnnouncementsPeer::ORDER );
    AnnouncementsPeer::addVisibleCriteria($c);

    // take Itemcategory into account
    $itemcategory = $this->getRequestParameter('itemcategory');

    // check if Itemcategory exists
    if ($itemcategory && !ItemcategoryPeer::getByCode($itemcategory)) {
    	$this->forward404();
    }

    ItemcategoryPeer::getIndexCriteria($c, ItemtypesPeer::ITEM_TYPE_ANNOUNCEMENTS, $itemcategory);

	$pager = new sfPropelPagerI18n('Announcements', AnnouncementsPeer::ITEMS_PER_PAGE, null, 'ID', false);
    $pager->setCriteriaI18n($c);
    $pager->setPeerMethod('doSelectWithI18n');
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    $this->pager = $pager;

    // если передан номер страницы больше, чем имеется страниц
    if ($request->getParameter('page') > $this->pager->getLastPage()) {
    	$this->forward404();
    }
  }
}