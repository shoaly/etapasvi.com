<?php

/**
 * text actions.
 *
 * @package    sf_sandbox
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class biographyActions extends sfActions
{

  public function executeBiography(sfWebRequest $request)
  {
    $this->redirect($this->generateUrl('biography'));
  }

  public function executeShow(sfWebRequest $request)
  {
    $context = sfContext::getInstance();
    $i18n =  $context->getI18N();

    $response = $this->getResponse();
    $response->setTitle($i18n->__('Maha Sambodhi Dharma Sangha') . ' - ' . $i18n->__('Biography'));
  }

}