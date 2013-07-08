<?php

/**
 * text actions.
 *
 * @package    sf_sandbox
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class contactusActions extends sfActions
{
  /**
   * Redirect to Sangha page
   *
   * @param sfWebRequest $request
   */
  public function executeRedirect(sfWebRequest $request)
  {
    $this->redirect($this->generateUrl('sangha'));
  }

  public function executeShow(sfWebRequest $request)
  {
    //$this->chapter_list = TextPeer::getGoogleDocAsArray( 'https://spreadsheets.google.com/spreadsheet/pub?hl=en_US&hl=en_US&key=0ApLTjOcBiwykdHBZbXpYTUJRWU1pdEdrZi1OTU9jb2c&single=true&gid=0&output=html' );

    // get contacts from DB
    $c = new Criteria();
    $c->add(ContactusPeer::SHOW, 1);
    $c->addAscendingOrderByColumn( ContactusPeer::ORDER );

    $contactus_db_list = ContactusPeer::doSelect($c);

    $cultures_data  = UserPeer::getCulturesData();
    $contactus_list = array();

    $cur_culture = sfContext::getInstance()->getUser()->getCulture();

    foreach ($cultures_data as $culture => $culture_data) {

      $list = array();

      // Google
      if (UserPeer::getCultureGoogle($culture)) {
        $list[] = array(
          'description' => 'Google',
          'link'        => ContactusPeer::getGoogleLink(UserPeer::getCultureGoogle($culture))
        );
      }
      // Facebook
      if (UserPeer::getCultureFbGroup($culture)) {
        $list[] = array(
          'description' => 'Facebook',
          'link'        => ContactusPeer::getFbLink(UserPeer::getCultureFbGroup($culture))
        );
      }
      // Twitter
      if (UserPeer::getCultureTwitter($culture)) {
        $list[] = array(
          'description' => 'Twitter',
          'link'        => ContactusPeer::getTwitterLink(UserPeer::getCultureTwitter($culture))
        );
      }

      foreach($contactus_db_list as $contactus_db) {
        if ($contactus_db->getCulture() != $culture) {
          continue;
        }
        $list[] = array(
          'description' => $contactus_db->getTitle(),
          'link'        => $contactus_db->getLink()
        );
      }

      $contactus_list[] = array(
        'culture'      => $culture,
        'language'     => $culture_data['name'],
        'language_en'  => $culture_data['en_name'],
        'list'         => $list,
      );
    }

    $this->contactus_list = array();

    // show current language first
    foreach ($contactus_list as $i=>$contactus_item) {
      if ($contactus_item['culture'] == $cur_culture) {
      	unset($contactus_list[$i]);
      	array_unshift($contactus_list, $contactus_item);
      	break;
      }
    }

    $this->contactus_list = $contactus_list;
  }

}