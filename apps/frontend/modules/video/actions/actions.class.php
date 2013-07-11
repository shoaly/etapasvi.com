<?php

/**
 * idea actions.
 *
 * @package    sf_sandbox
 * @subpackage idea
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class videoActions extends sfActions
{

  public function executeShow(sfWebRequest $request)
  {
  	$this->id 	 = $request->getParameter('id');
  	$this->title = $request->getParameter('title');

    $this->video = VideoPeer::retrieveByPk( $this->id );
  	//$this->forward404Unless( $this->video && $this->video->getCode() && $this->video->getShow() );
  	$culture = sfContext::getInstance()->getUser()->getCulture();

  	if (!$this->video || !$this->video->getShow()) {
  		throw new sfError404Exception();
  	}

    if (!$this->video->getCode($culture, $this->video->getAllCultures())) {
        sfActions::forward('default', 'nottranslated');
    }

  	$video_title = $this->video->getTitle();

  	if ($video_title) {
        if (!ItemtypesPeer::isItemUrlValid($this->video->getUrl())) {
            sfActions::redirect( $this->video->getUrl() );
        }

	    $context = sfContext::getInstance();
	    $i18n =  $context->getI18N();

	    //$title = $i18n->__('Dharma Sangha') . ' -';
	    $response = $this->getResponse();
	    $response->setTitle($video_title);
  	} elseif (!$video_title && $this->title) {
  		// если у элемента нет Заголовка, а в URL передан title, редиректим
  		//sfActions::redirect( $this->video->getUrl() );
        if (!ItemtypesPeer::isItemUrlValid($this->video->getUrl())) {
          sfActions::redirect( $this->video->getUrl() );
        }
  	}

    // set attributes from revision if needed
    $this->from_revision = ItemtypesPeer::setItemFromRevision($this->video);
  }

  public function executeIndex(sfWebRequest $request)
  {
    $c = new Criteria();
    $c->add( VideoPeer::SHOW, 1);
    $c->addDescendingOrderByColumn( VideoPeer::ORDER );
    //$c->add( VideoI18nPeer::CODE, '', Criteria::NOT_EQUAL );\
    VideoPeer::addVisibleCriteria($c);

    // take Itemcategory into account
    $itemcategory = $this->getRequestParameter('itemcategory');

    // check if Itemcategory exists
    if ($itemcategory && !ItemcategoryPeer::getByCode($itemcategory)) {
    	$this->forward404();
    }

    ItemcategoryPeer::getIndexCriteria($c, ItemtypesPeer::ITEM_TYPE_VIDEO, $itemcategory);

	$pager = new sfPropelPagerI18n('Video', VideoPeer::ITEMS_PER_PAGE, null, 'ID', false);
    $pager->setCriteriaI18n($c, true);
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    $this->pager = $pager;

    // если передан номер страницы больше, чем имеется страниц
    /*if ($request->getParameter('page') > $this->pager->getLastPage()) {
    	$this->forward404();
    }*/

    // запоминаем адрес
    //$_SESSION['back_to_video'] = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
  }

  /**
   * Live Video
   *
   * @param sfWebRequest $request
   */
  public function executeLive(sfWebRequest $request)
  {

  }

}