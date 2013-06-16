<?php

/**
 * audio actions.
 *
 * @package    sf_sandbox
 * @subpackage audio
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */
class announcementsActions extends autoannouncementsActions
{
  protected function updateAnnouncementsFromRequest()
  {
    $announcements = $this->getRequestParameter('announcements');

    // set change_updated_at
    $this->announcements->setChangeUpdatedAt($announcements['change_updated_at']);
    $announcements_i18ns = $this->announcements->getAnnouncementsI18ns();
    foreach ($announcements_i18ns as $announcements_i18n) {
    	$announcements_i18n->setChangeUpdatedAt($announcements['change_updated_at']);
    }

    if (isset($announcements['created_at']))
    {
      if ($announcements['created_at'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                              if (!is_array($announcements['created_at']))
          {
            $value = $dateFormat->format($announcements['created_at'], 'I', $dateFormat->getInputPattern('g'));
          }
          else
          {
            $value_array = $announcements['created_at'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
          }
          $this->announcements->setCreatedAt($value);
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->announcements->setCreatedAt(null);
      }
    }
    if (isset($announcements['active_till']))
    {
      if ($announcements['active_till'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                              if (!is_array($announcements['active_till']))
          {
            $value = $dateFormat->format($announcements['active_till'], 'i', $dateFormat->getInputPattern('d'));
          }
          else
          {
            $value_array = $announcements['active_till'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
          }
          $this->announcements->setActiveTill($value);
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->announcements->setActiveTill(null);
      }
    }
    $this->announcements->setShow(isset($announcements['show']) ? $announcements['show'] : 0);
    if (isset($announcements['order']))
    {
      $this->announcements->setOrder($announcements['order']);
    }
    $this->announcements->setAllCultures(isset($announcements['all_cultures']) ? $announcements['all_cultures'] : 0);
    if (isset($announcements['item2item_list']))
    {
      $this->announcements->setItem2itemList($announcements['item2item_list']);
    }
    if (isset($announcements['title_i18n_en']))
    {
      $this->announcements->setTitleI18nEn($announcements['title_i18n_en']);
    }
    if (isset($announcements['body_i18n_en']))
    {
      $this->announcements->setBodyI18nEn($announcements['body_i18n_en']);
    }
    if (isset($announcements['title_i18n_ru']))
    {
      $this->announcements->setTitleI18nRu($announcements['title_i18n_ru']);
    }
    if (isset($announcements['body_i18n_ru']))
    {
      $this->announcements->setBodyI18nRu($announcements['body_i18n_ru']);
    }
    if (isset($announcements['title_i18n_cs']))
    {
      $this->announcements->setTitleI18nCs($announcements['title_i18n_cs']);
    }
    if (isset($announcements['body_i18n_cs']))
    {
      $this->announcements->setBodyI18nCs($announcements['body_i18n_cs']);
    }
    if (isset($announcements['title_i18n_hu']))
    {
      $this->announcements->setTitleI18nHu($announcements['title_i18n_hu']);
    }
    if (isset($announcements['body_i18n_hu']))
    {
      $this->announcements->setBodyI18nHu($announcements['body_i18n_hu']);
    }
    if (isset($announcements['title_i18n_pl']))
    {
      $this->announcements->setTitleI18nPl($announcements['title_i18n_pl']);
    }
    if (isset($announcements['body_i18n_pl']))
    {
      $this->announcements->setBodyI18nPl($announcements['body_i18n_pl']);
    }
    if (isset($announcements['title_i18n_fr']))
    {
      $this->announcements->setTitleI18nFr($announcements['title_i18n_fr']);
    }
    if (isset($announcements['body_i18n_fr']))
    {
      $this->announcements->setBodyI18nFr($announcements['body_i18n_fr']);
    }
    if (isset($announcements['title_i18n_zh_cn']))
    {
      $this->announcements->setTitleI18nZhCN($announcements['title_i18n_zh_cn']);
    }
    if (isset($announcements['body_i18n_zh_cn']))
    {
      $this->announcements->setBodyI18nZhCN($announcements['body_i18n_zh_cn']);
    }
    if (isset($announcements['title_i18n_vi']))
    {
      $this->announcements->setTitleI18nVi($announcements['title_i18n_vi']);
    }
    if (isset($announcements['body_i18n_vi']))
    {
      $this->announcements->setBodyI18nVi($announcements['body_i18n_vi']);
    }
    if (isset($announcements['title_i18n_ja']))
    {
      $this->announcements->setTitleI18nJa($announcements['title_i18n_ja']);
    }
    if (isset($announcements['body_i18n_ja']))
    {
      $this->announcements->setBodyI18nJa($announcements['body_i18n_ja']);
    }
    if (isset($announcements['title_i18n_es']))
    {
      $this->announcements->setTitleI18nEs($announcements['title_i18n_es']);
    }
    if (isset($announcements['body_i18n_es']))
    {
      $this->announcements->setBodyI18nEs($announcements['body_i18n_es']);
    }
    if (isset($announcements['title_i18n_it']))
    {
      $this->announcements->setTitleI18nIt($announcements['title_i18n_it']);
    }
    if (isset($announcements['body_i18n_it']))
    {
      $this->announcements->setBodyI18nIt($announcements['body_i18n_it']);
    }
    if (isset($announcements['title_i18n_et']))
    {
      $this->announcements->setTitleI18nEt($announcements['title_i18n_et']);
    }
    if (isset($announcements['body_i18n_et']))
    {
      $this->announcements->setBodyI18nEt($announcements['body_i18n_et']);
    }
    if (isset($announcements['title_i18n_ne']))
    {
      $this->announcements->setTitleI18nNe($announcements['title_i18n_ne']);
    }
    if (isset($announcements['body_i18n_ne']))
    {
      $this->announcements->setBodyI18nNe($announcements['body_i18n_ne']);
    }
    if (isset($announcements['title_i18n_bn']))
    {
      $this->announcements->setTitleI18nBn($announcements['title_i18n_bn']);
    }
    if (isset($announcements['body_i18n_bn']))
    {
      $this->announcements->setBodyI18nBn($announcements['body_i18n_bn']);
    }
    if (isset($announcements['title_i18n_he']))
    {
      $this->announcements->setTitleI18nHe($announcements['title_i18n_he']);
    }
    if (isset($announcements['body_i18n_he']))
    {
      $this->announcements->setBodyI18nHe($announcements['body_i18n_he']);
    }
    if (isset($announcements['title_i18n_zh_tw']))
    {
      $this->announcements->setTitleI18nZhTW($announcements['title_i18n_zh_tw']);
    }
    if (isset($announcements['body_i18n_zh_tw']))
    {
      $this->announcements->setBodyI18nZhTW($announcements['body_i18n_zh_tw']);
    }
    if (isset($announcements['title_i18n_de']))
    {
      $this->announcements->setTitleI18nDe($announcements['title_i18n_de']);
    }
    if (isset($announcements['body_i18n_de']))
    {
      $this->announcements->setBodyI18nDe($announcements['body_i18n_de']);
    }
    // clear cache of a changed item
    ClearcachePeer::processItem($this->announcements);
  }

  protected function saveAnnouncements($announcements)
  {
    $announcements->save();

    // Process Item Categories
    $announcements = $this->getRequestParameter('announcements');
    if ($announcements['itemcategory'] && $this->announcements->getId()) {
      Item2itemcategoryPeer::updateItemCategories($announcements['itemcategory'], ItemtypesPeer::ITEM_TYPE_ANNOUNCEMENTS, $this->announcements->getId());
    }
  }

  protected function addFiltersCriteria($c)
  {
    if (isset($this->filters['show_is_empty']))
    {
      $criterion = $c->getNewCriterion(AnnouncementsPeer::SHOW, '');
      $criterion->addOr($c->getNewCriterion(AnnouncementsPeer::SHOW, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['show']) && $this->filters['show'] !== '')
    {
      $c->add(AnnouncementsPeer::SHOW, $this->filters['show']);
    }
    if (isset($this->filters['all_cultures_is_empty']))
    {
      $criterion = $c->getNewCriterion(AnnouncementsPeer::ALL_CULTURES, '');
      $criterion->addOr($c->getNewCriterion(AnnouncementsPeer::ALL_CULTURES, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['all_cultures']) && $this->filters['all_cultures'] !== '')
    {
      $c->add(AnnouncementsPeer::ALL_CULTURES, $this->filters['all_cultures']);
    }

    // Title
    if (!empty($this->filters['title']))
    {
      $c->add(AnnouncementsI18nPeer::TITLE, '%'.$this->filters['title'].'%', Criteria::LIKE);
    }
    // Body
    if (!empty($this->filters['body']))
    {
      $c->add(AnnouncementsI18nPeer::BODY, '%'.$this->filters['body'].'%', Criteria::LIKE);
    }
  }

}
