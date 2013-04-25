<?php

/**
 * quote actions.
 *
 * @package    sf_sandbox
 * @subpackage quote
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */
class quoteActions extends autoquoteActions
{
  protected function addFiltersCriteria($c)
  {
    if (isset($this->filters['show_is_empty']))
    {
      $criterion = $c->getNewCriterion(QuotePeer::SHOW, '');
      $criterion->addOr($c->getNewCriterion(QuotePeer::SHOW, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['show']) && $this->filters['show'] !== '')
    {
      $c->add(QuotePeer::SHOW, $this->filters['show']);
    }
    if (isset($this->filters['news_id_is_empty']))
    {
      $criterion = $c->getNewCriterion(QuotePeer::NEWS_ID, '');
      $criterion->addOr($c->getNewCriterion(QuotePeer::NEWS_ID, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['news_id']) && $this->filters['news_id'] !== '')
    {
      $c->add(QuotePeer::NEWS_ID, $this->filters['news_id']);
    }
    // Title
    if (!empty($this->filters['title']))
    {
      $c->add(QuoteI18nPeer::TITLE, '%'.$this->filters['title'].'%', Criteria::LIKE);
    }
  }
}
