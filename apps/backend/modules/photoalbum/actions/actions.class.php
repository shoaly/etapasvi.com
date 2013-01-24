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
    $photoalbum = $this->getRequestParameter('photoalbum');
    
    $this->photoalbum->setShow(isset($photoalbum['show']) ? $photoalbum['show'] : 0);
    if (isset($photoalbum['order']))
    {
      $this->photoalbum->setOrder($photoalbum['order']);
    }
    if (isset($photoalbum['created_at']))
    {
      if ($photoalbum['created_at'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                              if (!is_array($photoalbum['created_at']))
          {
            $value = $dateFormat->format($photoalbum['created_at'], 'I', $dateFormat->getInputPattern('g'));
          }
          else
          {
            $value_array = $photoalbum['created_at'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
          }
          $this->photoalbum->setCreatedAt($value);
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->photoalbum->setCreatedAt(null);
      }
    }
    if (isset($photoalbum['title_i18n_en']))
    {
      $this->photoalbum->setTitleI18nEn($photoalbum['title_i18n_en']);
    }
    if (isset($photoalbum['body_i18n_en']))
    {
      $this->photoalbum->setBodyI18nEn($photoalbum['body_i18n_en']);
    }
    if (isset($photoalbum['author_i18n_en']))
    {
      $this->photoalbum->setAuthorI18nEn($photoalbum['author_i18n_en']);
    }
    if (isset($photoalbum['title_i18n_ru']))
    {
      $this->photoalbum->setTitleI18nRu($photoalbum['title_i18n_ru']);
    }
    if (isset($photoalbum['body_i18n_ru']))
    {
      $this->photoalbum->setBodyI18nRu($photoalbum['body_i18n_ru']);
    }
    if (isset($photoalbum['author_i18n_ru']))
    {
      $this->photoalbum->setAuthorI18nRu($photoalbum['author_i18n_ru']);
    }
    if (isset($photoalbum['title_i18n_cs']))
    {
      $this->photoalbum->setTitleI18nCs($photoalbum['title_i18n_cs']);
    }
    if (isset($photoalbum['body_i18n_cs']))
    {
      $this->photoalbum->setBodyI18nCs($photoalbum['body_i18n_cs']);
    }
    if (isset($photoalbum['author_i18n_cs']))
    {
      $this->photoalbum->setAuthorI18nCs($photoalbum['author_i18n_cs']);
    }
    if (isset($photoalbum['title_i18n_hu']))
    {
      $this->photoalbum->setTitleI18nHu($photoalbum['title_i18n_hu']);
    }
    if (isset($photoalbum['body_i18n_hu']))
    {
      $this->photoalbum->setBodyI18nHu($photoalbum['body_i18n_hu']);
    }
    if (isset($photoalbum['author_i18n_hu']))
    {
      $this->photoalbum->setAuthorI18nHu($photoalbum['author_i18n_hu']);
    }
    if (isset($photoalbum['title_i18n_pl']))
    {
      $this->photoalbum->setTitleI18nPl($photoalbum['title_i18n_pl']);
    }
    if (isset($photoalbum['body_i18n_pl']))
    {
      $this->photoalbum->setBodyI18nPl($photoalbum['body_i18n_pl']);
    }
    if (isset($photoalbum['author_i18n_pl']))
    {
      $this->photoalbum->setAuthorI18nPl($photoalbum['author_i18n_pl']);
    }
    if (isset($photoalbum['title_i18n_fr']))
    {
      $this->photoalbum->setTitleI18nFr($photoalbum['title_i18n_fr']);
    }
    if (isset($photoalbum['body_i18n_fr']))
    {
      $this->photoalbum->setBodyI18nFr($photoalbum['body_i18n_fr']);
    }
    if (isset($photoalbum['author_i18n_fr']))
    {
      $this->photoalbum->setAuthorI18nFr($photoalbum['author_i18n_fr']);
    }
    if (isset($photoalbum['title_i18n_zh_cn']))
    {
      $this->photoalbum->setTitleI18nZhCN($photoalbum['title_i18n_zh_cn']);
    }
    if (isset($photoalbum['body_i18n_zh_cn']))
    {
      $this->photoalbum->setBodyI18nZhCN($photoalbum['body_i18n_zh_cn']);
    }
    if (isset($photoalbum['author_i18n_zh_cn']))
    {
      $this->photoalbum->setAuthorI18nZhCN($photoalbum['author_i18n_zh_cn']);
    }
    if (isset($photoalbum['title_i18n_vi']))
    {
      $this->photoalbum->setTitleI18nVi($photoalbum['title_i18n_vi']);
    }
    if (isset($photoalbum['body_i18n_vi']))
    {
      $this->photoalbum->setBodyI18nVi($photoalbum['body_i18n_vi']);
    }
    if (isset($photoalbum['author_i18n_vi']))
    {
      $this->photoalbum->setAuthorI18nVi($photoalbum['author_i18n_vi']);
    }
    if (isset($photoalbum['title_i18n_ja']))
    {
      $this->photoalbum->setTitleI18nJa($photoalbum['title_i18n_ja']);
    }
    if (isset($photoalbum['body_i18n_ja']))
    {
      $this->photoalbum->setBodyI18nJa($photoalbum['body_i18n_ja']);
    }
    if (isset($photoalbum['author_i18n_ja']))
    {
      $this->photoalbum->setAuthorI18nJa($photoalbum['author_i18n_ja']);
    }
    if (isset($photoalbum['title_i18n_es']))
    {
      $this->photoalbum->setTitleI18nEs($photoalbum['title_i18n_es']);
    }
    if (isset($photoalbum['body_i18n_es']))
    {
      $this->photoalbum->setBodyI18nEs($photoalbum['body_i18n_es']);
    }
    if (isset($photoalbum['author_i18n_es']))
    {
      $this->photoalbum->setAuthorI18nEs($photoalbum['author_i18n_es']);
    }
    if (isset($photoalbum['title_i18n_it']))
    {
      $this->photoalbum->setTitleI18nIt($photoalbum['title_i18n_it']);
    }
    if (isset($photoalbum['body_i18n_it']))
    {
      $this->photoalbum->setBodyI18nIt($photoalbum['body_i18n_it']);
    }
    if (isset($photoalbum['author_i18n_it']))
    {
      $this->photoalbum->setAuthorI18nIt($photoalbum['author_i18n_it']);
    }
    if (isset($photoalbum['title_i18n_et']))
    {
      $this->photoalbum->setTitleI18nEt($photoalbum['title_i18n_et']);
    }
    if (isset($photoalbum['body_i18n_et']))
    {
      $this->photoalbum->setBodyI18nEt($photoalbum['body_i18n_et']);
    }
    if (isset($photoalbum['author_i18n_et']))
    {
      $this->photoalbum->setAuthorI18nEt($photoalbum['author_i18n_et']);
    }
    if (isset($photoalbum['title_i18n_ne']))
    {
      $this->photoalbum->setTitleI18nNe($photoalbum['title_i18n_ne']);
    }
    if (isset($photoalbum['body_i18n_ne']))
    {
      $this->photoalbum->setBodyI18nNe($photoalbum['body_i18n_ne']);
    }
    if (isset($photoalbum['author_i18n_ne']))
    {
      $this->photoalbum->setAuthorI18nNe($photoalbum['author_i18n_ne']);
    }
    if (isset($photoalbum['title_i18n_bn']))
    {
      $this->photoalbum->setTitleI18nBn($photoalbum['title_i18n_bn']);
    }
    if (isset($photoalbum['body_i18n_bn']))
    {
      $this->photoalbum->setBodyI18nBn($photoalbum['body_i18n_bn']);
    }
    if (isset($photoalbum['author_i18n_bn']))
    {
      $this->photoalbum->setAuthorI18nBn($photoalbum['author_i18n_bn']);
    }
    if (isset($photoalbum['title_i18n_he']))
    {
      $this->photoalbum->setTitleI18nHe($photoalbum['title_i18n_he']);
    }
    if (isset($photoalbum['body_i18n_he']))
    {
      $this->photoalbum->setBodyI18nHe($photoalbum['body_i18n_he']);
    }
    if (isset($photoalbum['author_i18n_he']))
    {
      $this->photoalbum->setAuthorI18nHe($photoalbum['author_i18n_he']);
    }
    if (isset($photoalbum['title_i18n_zh_tw']))
    {
      $this->photoalbum->setTitleI18nZhTw($photoalbum['title_i18n_zh_tw']);
    }
    if (isset($photoalbum['body_i18n_zh_tw']))
    {
      $this->photoalbum->setBodyI18nZhTw($photoalbum['body_i18n_zh_tw']);
    }
    if (isset($photoalbum['author_i18n_zh_tw']))
    {
      $this->photoalbum->setAuthorI18nZhTw($photoalbum['author_i18n_zh_tw']);
    }
    if (isset($photoalbum['title_i18n_de']))
    {
      $this->photoalbum->setTitleI18nDe($photoalbum['title_i18n_de']);
    }
    if (isset($photoalbum['body_i18n_de']))
    {
      $this->photoalbum->setBodyI18nDe($photoalbum['body_i18n_de']);
    }
    if (isset($photoalbum['author_i18n_de']))
    {
      $this->photoalbum->setAuthorI18nDe($photoalbum['author_i18n_de']);
    }
    
    // clear cache of a changed item
    ClearcachePeer::processItem($this->photoalbum);
  }
  
  /**
   * Save Photoalbum
   *
   * @param unknown_type $photoalbum
   */
  protected function savePhotoalbum($photoalbum)
  {
    $photoalbum->save();

    // Process Item Categories
    $photoalbum = $this->getRequestParameter('photoalbum');
    if ($photoalbum['itemcategory'] && $this->photoalbum->getId()) {
      Item2itemcategoryPeer::updateItemCategories($photoalbum['itemcategory'], ItemtypesPeer::ITEM_TYPE_PHOTOALBUM, $this->photoalbum->getId());
    }
  }
  
  protected function addFiltersCriteria($c)
  {
    if (isset($this->filters['show_is_empty']))
    {
      $criterion = $c->getNewCriterion(PhotoalbumPeer::SHOW, '');
      $criterion->addOr($c->getNewCriterion(PhotoalbumPeer::SHOW, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['show']) && $this->filters['show'] !== '')
    {
      $c->add(PhotoalbumPeer::SHOW, $this->filters['show']);
    }
    
    // Title
    if (isset($this->filters['title']))
    {
      $c->add(PhotoalbumI18nPeer::TITLE, '%'.$this->filters['title'].'%', Criteria::LIKE);
    }
    // Body
    if (isset($this->filters['body']))
    {
      $c->add(PhotoalbumI18nPeer::BODY, '%'.$this->filters['body'].'%', Criteria::LIKE);
    }
    // Author
    if (isset($this->filters['author']))
    {
      $c->add(PhotoalbumI18nPeer::AUTHOR, '%'.$this->filters['author'].'%', Criteria::LIKE);
    }
  }
}
