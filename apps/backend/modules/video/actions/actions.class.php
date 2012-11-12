<?php

/**
 * video actions.
 *
 * @package    sf_sandbox
 * @subpackage video
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */
class videoActions extends autovideoActions
{
  protected function updateVideoFromRequest()
  {
    $video = $this->getRequestParameter('video');

    // Empty string to null
    //
    // backend saves empty strings as ''    
    // some fields in DB has DEFAULT NULL
    // so their value changes from NULL to ''
    // it is impossible to set DEFAULT '' for all types of fields:
    //     build-propel.xml:196:10: BLOB and TEXT columns cannot have DEFAULT values. in MySQL.    
    /*foreach ($video as $i => $value) {
    	if ($value === '') {
    		$video[ $i ] = null;
    	}
    }*/
    
    // set change_updated_at
    $this->video->setChangeUpdatedAt($video['change_updated_at']);
    $video_i18ns = $this->video->getVideoI18ns();
    foreach ($video_i18ns as $video_i18n) {
    	$video_i18n->setChangeUpdatedAt($video['change_updated_at']);
    }
    
    $this->video->setShow(isset($video['show']) ? $video['show'] : 0);
    if (isset($video['order']))
    {
      $this->video->setOrder($video['order']);
    }
    if (isset($video['created_at']))
    {
      if ($video['created_at'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                              if (!is_array($video['created_at']))
          {
            $value = $dateFormat->format($video['created_at'], 'I', $dateFormat->getInputPattern('g'));
          }
          else
          {
            $value_array = $video['created_at'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
          }
          $this->video->setCreatedAt($value);
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->video->setCreatedAt(null);
      }
    }
    if (isset($video['link']))
    {
      $this->video->setLink($video['link']);
    }
    $this->video->setAllCultures(isset($video['all_cultures']) ? $video['all_cultures'] : 0);
    if (isset($video['img_i18n_en']))
    {
      $this->video->setImgI18nEn($video['img_i18n_en']);
    }
    if (isset($video['img_i18n_en']))
    {
      $this->video->setImgI18nEn($video['img_i18n_en']);
    }
    if (isset($video['code_i18n_en']))
    {
      $this->video->setCodeI18nEn($video['code_i18n_en']);
    }
    if (isset($video['title_i18n_en']))
    {
      $this->video->setTitleI18nEn($video['title_i18n_en']);
    }
    if (isset($video['body_i18n_en']))
    {
      $this->video->setBodyI18nEn($video['body_i18n_en']);
    }
    if (isset($video['author_i18n_en']))
    {
      $this->video->setAuthorI18nEn($video['author_i18n_en']);
    }
    if (isset($video['img_i18n_ru']))
    {
      $this->video->setImgI18nRu($video['img_i18n_ru']);
    }
    if (isset($video['img_i18n_ru']))
    {
      $this->video->setImgI18nRu($video['img_i18n_ru']);
    }
    if (isset($video['code_i18n_ru']))
    {
      $this->video->setCodeI18nRu($video['code_i18n_ru']);
    }
    if (isset($video['title_i18n_ru']))
    {
      $this->video->setTitleI18nRu($video['title_i18n_ru']);
    }
    if (isset($video['body_i18n_ru']))
    {
      $this->video->setBodyI18nRu($video['body_i18n_ru']);
    }
    if (isset($video['author_i18n_ru']))
    {
      $this->video->setAuthorI18nRu($video['author_i18n_ru']);
    }
    if (isset($video['img_i18n_cs']))
    {
      $this->video->setImgI18nCs($video['img_i18n_cs']);
    }
    if (isset($video['img_i18n_cs']))
    {
      $this->video->setImgI18nCs($video['img_i18n_cs']);
    }
    if (isset($video['code_i18n_cs']))
    {
      $this->video->setCodeI18nCs($video['code_i18n_cs']);
    }
    if (isset($video['title_i18n_cs']))
    {
      $this->video->setTitleI18nCs($video['title_i18n_cs']);
    }
    if (isset($video['body_i18n_cs']))
    {
      $this->video->setBodyI18nCs($video['body_i18n_cs']);
    }
    if (isset($video['author_i18n_cs']))
    {
      $this->video->setAuthorI18nCs($video['author_i18n_cs']);
    }
    if (isset($video['img_i18n_hu']))
    {
      $this->video->setImgI18nHu($video['img_i18n_hu']);
    }
    if (isset($video['img_i18n_hu']))
    {
      $this->video->setImgI18nHu($video['img_i18n_hu']);
    }
    if (isset($video['code_i18n_hu']))
    {
      $this->video->setCodeI18nHu($video['code_i18n_hu']);
    }
    if (isset($video['title_i18n_hu']))
    {
      $this->video->setTitleI18nHu($video['title_i18n_hu']);
    }
    if (isset($video['body_i18n_hu']))
    {
      $this->video->setBodyI18nHu($video['body_i18n_hu']);
    }
    if (isset($video['author_i18n_hu']))
    {
      $this->video->setAuthorI18nHu($video['author_i18n_hu']);
    }
    if (isset($video['img_i18n_pl']))
    {
      $this->video->setImgI18nPl($video['img_i18n_pl']);
    }
    if (isset($video['img_i18n_pl']))
    {
      $this->video->setImgI18nPl($video['img_i18n_pl']);
    }
    if (isset($video['code_i18n_pl']))
    {
      $this->video->setCodeI18nPl($video['code_i18n_pl']);
    }
    if (isset($video['title_i18n_pl']))
    {
      $this->video->setTitleI18nPl($video['title_i18n_pl']);
    }
    if (isset($video['body_i18n_pl']))
    {
      $this->video->setBodyI18nPl($video['body_i18n_pl']);
    }
    if (isset($video['author_i18n_pl']))
    {
      $this->video->setAuthorI18nPl($video['author_i18n_pl']);
    }
    if (isset($video['img_i18n_fr']))
    {
      $this->video->setImgI18nFr($video['img_i18n_fr']);
    }
    if (isset($video['img_i18n_fr']))
    {
      $this->video->setImgI18nFr($video['img_i18n_fr']);
    }
    if (isset($video['code_i18n_fr']))
    {
      $this->video->setCodeI18nFr($video['code_i18n_fr']);
    }
    if (isset($video['title_i18n_fr']))
    {
      $this->video->setTitleI18nFr($video['title_i18n_fr']);
    }
    if (isset($video['body_i18n_fr']))
    {
      $this->video->setBodyI18nFr($video['body_i18n_fr']);
    }
    if (isset($video['author_i18n_fr']))
    {
      $this->video->setAuthorI18nFr($video['author_i18n_fr']);
    }
    if (isset($video['img_i18n_zh_cn']))
    {
      $this->video->setImgI18nZhCN($video['img_i18n_zh_cn']);
    }
    if (isset($video['img_i18n_zh_cn']))
    {
      $this->video->setImgI18nZhCN($video['img_i18n_zh_cn']);
    }
    if (isset($video['code_i18n_zh_cn']))
    {
      $this->video->setCodeI18nZhCN($video['code_i18n_zh_cn']);
    }
    if (isset($video['title_i18n_zh_cn']))
    {
      $this->video->setTitleI18nZhCN($video['title_i18n_zh_cn']);
    }
    if (isset($video['body_i18n_zh_cn']))
    {
      $this->video->setBodyI18nZhCN($video['body_i18n_zh_cn']);
    }
    if (isset($video['author_i18n_zh_cn']))
    {
      $this->video->setAuthorI18nZhCN($video['author_i18n_zh_cn']);
    }
    if (isset($video['img_i18n_vi']))
    {
      $this->video->setImgI18nVi($video['img_i18n_vi']);
    }
    if (isset($video['img_i18n_vi']))
    {
      $this->video->setImgI18nVi($video['img_i18n_vi']);
    }
    if (isset($video['code_i18n_vi']))
    {
      $this->video->setCodeI18nVi($video['code_i18n_vi']);
    }
    if (isset($video['title_i18n_vi']))
    {
      $this->video->setTitleI18nVi($video['title_i18n_vi']);
    }
    if (isset($video['body_i18n_vi']))
    {
      $this->video->setBodyI18nVi($video['body_i18n_vi']);
    }
    if (isset($video['author_i18n_vi']))
    {
      $this->video->setAuthorI18nVi($video['author_i18n_vi']);
    }
    if (isset($video['img_i18n_ja']))
    {
      $this->video->setImgI18nJa($video['img_i18n_ja']);
    }
    if (isset($video['img_i18n_ja']))
    {
      $this->video->setImgI18nJa($video['img_i18n_ja']);
    }
    if (isset($video['code_i18n_ja']))
    {
      $this->video->setCodeI18nJa($video['code_i18n_ja']);
    }
    if (isset($video['title_i18n_ja']))
    {
      $this->video->setTitleI18nJa($video['title_i18n_ja']);
    }
    if (isset($video['body_i18n_ja']))
    {
      $this->video->setBodyI18nJa($video['body_i18n_ja']);
    }
    if (isset($video['author_i18n_ja']))
    {
      $this->video->setAuthorI18nJa($video['author_i18n_ja']);
    }
    if (isset($video['img_i18n_es']))
    {
      $this->video->setImgI18nEs($video['img_i18n_es']);
    }
    if (isset($video['img_i18n_es']))
    {
      $this->video->setImgI18nEs($video['img_i18n_es']);
    }
    if (isset($video['code_i18n_es']))
    {
      $this->video->setCodeI18nEs($video['code_i18n_es']);
    }
    if (isset($video['title_i18n_es']))
    {
      $this->video->setTitleI18nEs($video['title_i18n_es']);
    }
    if (isset($video['body_i18n_es']))
    {
      $this->video->setBodyI18nEs($video['body_i18n_es']);
    }
    if (isset($video['author_i18n_es']))
    {
      $this->video->setAuthorI18nEs($video['author_i18n_es']);
    }
    if (isset($video['img_i18n_it']))
    {
      $this->video->setImgI18nIt($video['img_i18n_it']);
    }
    if (isset($video['img_i18n_it']))
    {
      $this->video->setImgI18nIt($video['img_i18n_it']);
    }
    if (isset($video['code_i18n_it']))
    {
      $this->video->setCodeI18nIt($video['code_i18n_it']);
    }
    if (isset($video['title_i18n_it']))
    {
      $this->video->setTitleI18nIt($video['title_i18n_it']);
    }
    if (isset($video['body_i18n_it']))
    {
      $this->video->setBodyI18nIt($video['body_i18n_it']);
    }
    if (isset($video['author_i18n_it']))
    {
      $this->video->setAuthorI18nIt($video['author_i18n_it']);
    }
    if (isset($video['img_i18n_et']))
    {
      $this->video->setImgI18nEt($video['img_i18n_et']);
    }
    if (isset($video['img_i18n_et']))
    {
      $this->video->setImgI18nEt($video['img_i18n_et']);
    }
    if (isset($video['code_i18n_et']))
    {
      $this->video->setCodeI18nEt($video['code_i18n_et']);
    }
    if (isset($video['title_i18n_et']))
    {
      $this->video->setTitleI18nEt($video['title_i18n_et']);
    }
    if (isset($video['body_i18n_et']))
    {
      $this->video->setBodyI18nEt($video['body_i18n_et']);
    }
    if (isset($video['author_i18n_et']))
    {
      $this->video->setAuthorI18nEt($video['author_i18n_et']);
    }
    if (isset($video['img_i18n_ne']))
    {
      $this->video->setImgI18nNe($video['img_i18n_ne']);
    }
    if (isset($video['img_i18n_ne']))
    {
      $this->video->setImgI18nNe($video['img_i18n_ne']);
    }
    if (isset($video['code_i18n_ne']))
    {
      $this->video->setCodeI18nNe($video['code_i18n_ne']);
    }
    if (isset($video['title_i18n_ne']))
    {
      $this->video->setTitleI18nNe($video['title_i18n_ne']);
    }
    if (isset($video['body_i18n_ne']))
    {
      $this->video->setBodyI18nNe($video['body_i18n_ne']);
    }
    if (isset($video['author_i18n_ne']))
    {
      $this->video->setAuthorI18nNe($video['author_i18n_ne']);
    }
    if (isset($video['img_i18n_bn']))
    {
      $this->video->setImgI18nBn($video['img_i18n_bn']);
    }
    if (isset($video['img_i18n_bn']))
    {
      $this->video->setImgI18nBn($video['img_i18n_bn']);
    }
    if (isset($video['code_i18n_bn']))
    {
      $this->video->setCodeI18nBn($video['code_i18n_bn']);
    }
    if (isset($video['title_i18n_bn']))
    {
      $this->video->setTitleI18nBn($video['title_i18n_bn']);
    }
    if (isset($video['body_i18n_bn']))
    {
      $this->video->setBodyI18nBn($video['body_i18n_bn']);
    }
    if (isset($video['author_i18n_bn']))
    {
      $this->video->setAuthorI18nBn($video['author_i18n_bn']);
    }
    if (isset($video['img_i18n_he']))
    {
      $this->video->setImgI18nHe($video['img_i18n_he']);
    }
    if (isset($video['img_i18n_he']))
    {
      $this->video->setImgI18nHe($video['img_i18n_he']);
    }
    if (isset($video['code_i18n_he']))
    {
      $this->video->setCodeI18nHe($video['code_i18n_he']);
    }
    if (isset($video['title_i18n_he']))
    {
      $this->video->setTitleI18nHe($video['title_i18n_he']);
    }
    if (isset($video['body_i18n_he']))
    {
      $this->video->setBodyI18nHe($video['body_i18n_he']);
    }
    if (isset($video['author_i18n_he']))
    {
      $this->video->setAuthorI18nHe($video['author_i18n_he']);
    }
    if (isset($video['img_i18n_zh_tw']))
    {
      $this->video->setImgI18nZhTw($video['img_i18n_zh_tw']);
    }
    if (isset($video['img_i18n_zh_tw']))
    {
      $this->video->setImgI18nZhTw($video['img_i18n_zh_tw']);
    }
    if (isset($video['code_i18n_zh_tw']))
    {
      $this->video->setCodeI18nZhTw($video['code_i18n_zh_tw']);
    }
    if (isset($video['title_i18n_zh_tw']))
    {
      $this->video->setTitleI18nZhTw($video['title_i18n_zh_tw']);
    }
    if (isset($video['body_i18n_zh_tw']))
    {
      $this->video->setBodyI18nZhTw($video['body_i18n_zh_tw']);
    }
    if (isset($video['author_i18n_zh_tw']))
    {
      $this->video->setAuthorI18nZhTw($video['author_i18n_zh_tw']);
    }
    if (isset($video['img_i18n_de']))
    {
      $this->video->setImgI18nDe($video['img_i18n_de']);
    }
    if (isset($video['img_i18n_de']))
    {
      $this->video->setImgI18nDe($video['img_i18n_de']);
    }
    if (isset($video['code_i18n_de']))
    {
      $this->video->setCodeI18nDe($video['code_i18n_de']);
    }
    if (isset($video['title_i18n_de']))
    {
      $this->video->setTitleI18nDe($video['title_i18n_de']);
    }
    if (isset($video['body_i18n_de']))
    {
      $this->video->setBodyI18nDe($video['body_i18n_de']);
    }
    if (isset($video['author_i18n_de']))
    {
      $this->video->setAuthorI18nDe($video['author_i18n_de']);
    }
    // clear cache of a changed item
    ClearcachePeer::processItem($this->video);
  }
}
