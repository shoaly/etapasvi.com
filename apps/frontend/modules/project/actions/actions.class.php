<?php

/**
 * text actions.
 *
 * @package    sf_sandbox
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class projectActions extends sfActions
{

  public function executeShow(sfWebRequest $request)
  {
    if (strstr($request->getUri(), '/show')) {
      $this->redirect($this->generateUrl('project'));
    }
  }

  public function executeRedirect(sfWebRequest $request)
  {
    sfContext::getInstance()->getConfiguration()->loadHelpers('Url');
    $this->redirect(url_for('news/index?itemcategory=projects', true));
  }

}