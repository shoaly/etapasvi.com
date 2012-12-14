<?php
 
class textComponents extends sfComponents
{
  public function executeShow()
  {
  	$text = TextPeer::retrieveByPk( $this->id );
    //$this->forward404Unless($text);  
    if ($text) {
      $this->text = $text->getBody();
    }
  }
  
  public function executeJs(sfWebRequest $request)
  {
    // получаем список Цитат
    $c = new Criteria();
    $c->add(QuotePeer::SHOW, 1);
    $c->add(QuoteI18nPeer::TITLE, '', Criteria::NOT_EQUAL);
  	$this->quote_list = QuotePeer::doSelectWithI18n($c);
  	
  	if (empty($this->quote_list)) {
      $c = new Criteria();
      $c->add(QuotePeer::SHOW, 1);
      $c->add(QuoteI18nPeer::TITLE, '', Criteria::NOT_EQUAL);
  	  $this->quote_list = QuotePeer::doSelectWithI18n($c, sfConfig::get('sf_default_culture'));
  	}
  	
    // get list of photos for carousel
  	$this->carousel_photo_list = PhotoPeer::getCarouselPhotoList();
  	
    // получаем список Аудио
    /*
    $c = new Criteria();
    $c->add(AudioI18nPeer::TITLE, '', Criteria::NOT_EQUAL);
    $c->add(AudioPeer::REMOTE, '', Criteria::NOT_EQUAL);
    $c->add(AudioPeer::SHOW, 1);
  	$this->audio_list = AudioPeer::doSelectWithI18n($c);*/
  }
  
  /**
   * Предолжить перевод
   *
   * @param sfWebRequest $request
   */
  public function executeOffertranslation(sfWebRequest $request)
  {
    $sf_context     = sfContext::getInstance();
    
  	$this->module    =  $sf_context->getModuleName();
  	$this->action    =  $sf_context->getActionName();
  	$this->id        =  $request->getParameter('id');
  	$this->uri       =  $sf_context->getRequest()->getUri();;
  }
}