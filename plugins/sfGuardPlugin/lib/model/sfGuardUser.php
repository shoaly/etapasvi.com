<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardUser.php 7634 2008-02-27 18:01:40Z fabien $
 */
class sfGuardUser extends PluginsfGuardUser
{
  public function hasGroup($name)
  {
  	$criteria = new Criteria();
  	$criteria->add(sfGuardGroupPeer::NAME, $name);
  	$criteria->addJoin(sfGuardGroupPeer::ID, sfGuardUserGroupPeer::GROUP_ID);
  	
	$group_list = $this->getsfGuardUserGroups($criteria);

	if (count($group_list)) {
	  return true;
	} else {
	  return false;
	}
  }
}
