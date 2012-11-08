<?php

/**
 * This class is the Propel implementation of sfPropelPager.  It interacts with the propel record set and
 * manages criteria.
 *
 * @package    symfony
 * @subpackage propel
 * @author     Igor Brovchenko
 */
class sfPropelPagerI18n extends sfPropelPager
{
  // add condition on culture field to JOIN to connect to I18n table using current culture
  protected $joinCulture = true;
  
  /**
    * Constructor.
    *
    * @param string $class
    * @param int $maxPerPage
    * @param string $culture
    * @param string $joinField default value 'ID'
    * @return sfPropelPagerI18n
    */
  public function __construct($class, $maxPerPage = 10, $culture =  null, $joinField = 'ID', $joinCulture = true)
  {
    if ($culture === null)
    {
      $culture = sfPropel::getDefaultCulture();
    }

    $this->joinField       = $joinField;
    $this->currentCulture  = $culture;
    
    $this->joinCulture = $joinCulture;

    parent::__construct($class, $maxPerPage);

    $this->setPeerMethod('doSelectWithI18n');
    //$this->setPeerCountMethod('doCountWithI18n');
  }

  /**
   * Set Criteria for Pager.
   *
   * @param Criteria $c
   */
  public function setCriteriaI18n($c)
  {
    $this->criteria = $c;
	// saynt2day
	// В Propel 1.4: [wrapped: SQLSTATE[42000]: Syntax error or access violation: 1066 Not unique table/alias...
	// http://oldforum.symfony-project.org/index.php/m/68868/
	
    /*$this->criteria->addJoin(
      constant($this->getClass() . 'Peer::' . $this->joinField),
      constant($this->getClass() . 'I18nPeer::' . $this->joinField),
      Criteria::INNER_JOIN
    );*/   
        
    // connect to I18n table using current culture
	$this->criteria->addJoin(
	  constant($this->getClass() . 'Peer::' . $this->joinField),
	  constant($this->getClass() . 'I18nPeer::' . $this->joinField)
	);
	if ($this->joinCulture) {
	  $this->criteria->add(constant($this->getClass() . 'I18nPeer::CULTURE'), $this->currentCulture);
	    
	  $c->add(constant($this->getClass() . 'I18nPeer::CULTURE'), $this->currentCulture);
	  $this->criteria->add(constant($this->getClass() . 'I18nPeer::CULTURE'), $this->currentCulture);
	} else {
      // without connection to I18n table using current culture
      $this->criteria->addGroupByColumn(constant($this->getClass() . 'Peer::' . $this->joinField));
    }
  }

  /**
   * Returns the result of Pager.
   *
   */
  public function getResults()
  {
    $c = $this->getCriteria();

    return call_user_func(array($this->getClassPeer(), $this->getPeerMethod()), $c, $this->currentCulture, 
                                null, Criteria::LEFT_JOIN, !$this->joinCulture);
  }
 
}
