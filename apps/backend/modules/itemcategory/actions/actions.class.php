<?php

/**
 * Itemcategory actions.
 *
 * @package    sf_sandbox
 * @subpackage audio
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */
class itemcategoryActions extends autoitemcategoryActions
{
  /**
   * Update ITEMS_COUNT field in Itemcategory table for all Item Types, cultures and Item Categories.
   * ITEMS_COUNT is stored in JSON
   *
   * @param unknown_type $request
   * @return unknown
   */
  public function executeUpdateitemscount($request)
  {
  	$result = UserPeer::runTask('updateitemscountTask', $this->dispatcher);
  	
  	if ($result['result']) {
  	  $this->getUser()->setFlash('notice', 'Update items count task has been successfully ran');
  	  return $this->redirect($_SERVER['SCRIPT_NAME'] . '/itemcategory/list');
  	} else {
  	  $this->getUser()->setFlash('updateitemscount_error', 'Could not run Update items count task: ' . $result['error_message']);
  	  return $this->redirect($_SERVER['SCRIPT_NAME'] . '/itemcategory/list');
  	}
  }
            
}
