<?php

class announcementsComponents extends sfComponents
{
  /**
   * Latest Announcements
   *
   */
  public function executeLatest()
  {
  	$c = new Criteria();
    AnnouncementsPeer::addVisibleCriteria($c);
    $c->addDescendingOrderByColumn(AnnouncementsPeer::ORDER );
    $c->setLimit(AnnouncementsPeer::LATEST_COUNT);

    $this->announcements_list = AnnouncementsPeer::doSelectWithI18n($c);
  }

  /**
   * Embed Announcement
   *
   */
  public function executeShow()
  {
    if (empty($this->announcements)) {
  	  $this->announcements = AnnouncementsPeer::retrieveByPk( $this->id );
    }
  }

  /**
   * Embed short version of Announcement
   *
   */
  public function executeShowShort()
  {
    if (empty($this->announcements)) {
  	  $this->announcements = AnnouncementsPeer::retrieveByPk( $this->id );
    }
  }

}