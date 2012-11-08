<?php

/**
 * documents actions.
 *
 * @package    sf_sandbox
 * @subpackage documents
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class documentsActions extends sfActions
{
 
  public function executeShow(sfWebRequest $request)
  {  	
  	$this->id 	 = $request->getParameter('id');
  	$this->title = $request->getParameter('title');	
  	
  	$this->documents = DocumentsPeer::retrieveByPk( $this->id );
  	
  	$culture     = sfContext::getInstance()->getUser()->getCulture();
  	
  	if (!$this->documents || !$this->documents->getShow() || !$this->documents->getTitle($culture, $this->documents->getAllCultures())) {
  		throw new sfError404Exception();
  	}
  	
  	// проверка title
  	$documents_title = $this->documents->getTitle();
  	
  	if ($documents_title) {  		
  		// если на траницу перешли с другого языка, то title неверный
  		$documents_title_translit = TextPeer::urlTranslit($documents_title);
  		if ( $this->title != $documents_title_translit ) {
  			sfActions::redirect( $this->documents->getUrl() );
  		}
  		
	    $context = sfContext::getInstance();
	    $i18n =  $context->getI18N();
	       
	    $response = $this->getResponse(); 
	    $response->setTitle($documents_title);	
  	} elseif (!$documents_title && $this->title) {
  		// если у элемента нет Заголовка, а в URL передан title, редиректим
  		sfActions::redirect( $this->documents->getUrl() );
  	}  	
  }     
    
  public function executeIndex(sfWebRequest $request)
  {     
    $c = new Criteria();
    $c->add( DocumentsPeer::SHOW, 1);
    $c->addDescendingOrderByColumn( DocumentsPeer::ORDER );
    DocumentsPeer::addVisibleCriteria($c);
        
	$pager = new sfPropelPagerI18n('Documents', DocumentsPeer::ITEMS_PER_PAGE);
    $pager->setCriteriaI18n($c, true);
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    $this->pager = $pager;
    
    // если передан номер страницы больше, чем имеется страниц
    if ($request->getParameter('page') > $this->pager->getLastPage()) {
    	$this->forward404();
    }  
  }     
}