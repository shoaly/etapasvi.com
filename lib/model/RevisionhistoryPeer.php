<?php

require 'lib/model/om/BaseRevisionhistoryPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'revisionhistory' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Wed Nov  2 11:08:57 2011
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class RevisionhistoryPeer extends BaseRevisionhistoryPeer {
	
  /**
   * Генерация PageMnemonic для текущей страницы, либо для переданного URL
   *
   * @return unknown
   */
  public static function generatePageMnemonic($url = '')
  {
    $page_mnemonic = '';
    
    if ($url) {
    	// @todo
    } else {
    	$page_mnemonic = CommentsPeer::getCommentsIdentifier();
    }
    
    return $page_mnemonic;
  }
  
  /**
   * Получение истории обновлений по мнемонике страницы
   *
   * @param unknown_type $page_mnemonic
   * @return unknown
   */
  public static function getByPageMnemonic($page_mnemonic)
  {
    $c = new Criteria();
    $c->add(RevisionhistoryPeer::PAGE_MNEMONIC, $page_mnemonic);
    $c->addDescendingOrderByColumn(RevisionhistoryPeer::CREATED_AT);
        
    return RevisionhistoryPeer::doSelect($c);
  }

} // RevisionhistoryPeer
