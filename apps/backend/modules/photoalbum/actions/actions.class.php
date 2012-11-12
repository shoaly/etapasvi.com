<?php

/**
 * photoalbum actions.
 *
 * @package    sf_sandbox
 * @subpackage photoalbum
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */
class photoalbumActions extends autophotoalbumActions
{
  protected function updatePhotoalbumFromRequest()
  {
  	parent::updatePhotoalbumFromRequest();
    // clear cache of a changed item
    ClearcachePeer::processItem($this->photoalbum);
  }
}
