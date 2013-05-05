<?php

class locationlinkComponents extends sfComponents
{
  public function executeShow(sfWebRequest $request)
  {
    // fetch all categories and build trees excluding empty leaves
    $c = new Criteria();
    $c->add(LocationPeer::SHOW, 1);
//    $c->addJoin(LocationPeer::ID, LocationlinkPeer::LOCATION_ID);
//    $c->addJoin(LocationPeer::ID, LocationlinkPeer::UPTO_LOCATION_ID);
    $c->addAscendingOrderByColumn(LocationPeer::ORDER);
    $location_list = LocationPeer::doSelectWithI18n($c, null, null, Criteria::LEFT_JOIN, true);

    // building tree
    $this->locationlink_tree  = LocationPeer::buildTree($location_list);
  }
}