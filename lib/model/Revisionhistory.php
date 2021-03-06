<?php

require 'lib/model/om/BaseRevisionhistory.php';


/**
 * Skeleton subclass for representing a row from the 'revisionhistory' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Wed Nov  2 11:08:58 2011
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Revisionhistory extends BaseRevisionhistory {

	/**
	 * Initializes internal state of Revisionhistory object.
	 * @see        parent::__construct()
	 */
	public function __construct()
	{
		// Make sure that parent constructor is always invoked, since that
		// is where any default values for this object are set.
		parent::__construct();
	}
	
	/**
	 * Получение адреса страницы для ревизии
	 *
	 * @return unknown
	 */
	public function getUrl()
	{
        if (!$this->getItemId()) {
            // page revision
            // получаем язык		
            $culture = self::getPageMnemonicCulture();

            if (!$culture) {
                return false;
            }
            $url_pattern = 'revision/show?sf_culture=' . $culture . '&id=' . $this->getId();
            return sfContext::getInstance()->getController()->genUrl($url_pattern, true, $culture);
        } else {
            // item revision
            $item = ItemtypesPeer::getItem($this->getItemId(), $this->getItemtypesId());
            if (!$item) {
                return false;
            } else {
                $url = $item->getUrl($this->getItemCulture());
                // add rivision id to the title
                $title = ItemtypesPeer::getItemTitleFromUrl($url);
                
                if ($title) {
                    $url .= '-';
                } else {
                    $url .= '/';
                }
                $url .= 'revision'.$this->getId().'-from-'
                        .date('Y-m-d', strtotime($this->getCreatedAt())).
                        '-at-'.date('H-i-s', strtotime($this->getCreatedAt()));
                
                return $url;
            }
        }
	}
	
	/**
	 * Получение языка версии
	 *
	 * @return unknown
	 */
	public function getPageMnemonicCulture()
	{
		// из мнемноники получаем язык		
		preg_match("/^\/([^\/]+)\//", $this->getPageMnemonic(), $matches);
		$culture = $matches[1];
		return $culture;		
	}

} // Revisionhistory
