<?php

/**
 * audio actions.
 *
 * @package    sf_sandbox
 * @subpackage audio
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */
class audioActions extends autoaudioActions
{
  protected function updateAudioFromRequest()
  {
    $audio = $this->getRequestParameter('audio');

    // Empty string to null
    //
    // backend saves empty strings as ''    
    // some fields in DB has DEFAULT NULL
    // so their value changes from NULL to ''
    // it is impossible to set DEFAULT '' for all types of fields:
    //     build-propel.xml:196:10: BLOB and TEXT columns cannot have DEFAULT values. in MySQL.    
    /*foreach ($audio as $i => $value) {
    	if ($value === '') {
    		$audio[ $i ] = null;
    	}
    }*/
    
    // set change_updated_at
    $this->audio->setChangeUpdatedAt($audio['change_updated_at']);
    $audio_i18ns = $this->audio->getAudioI18ns();
    foreach ($audio_i18ns as $audio_i18n) {
    	$audio_i18n->setChangeUpdatedAt($audio['change_updated_at']);
    }
    
    if (isset($audio['created_at']))
    {
      if ($audio['created_at'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                              if (!is_array($audio['created_at']))
          {
            $value = $dateFormat->format($audio['created_at'], 'I', $dateFormat->getInputPattern('g'));
          }
          else
          {
            $value_array = $audio['created_at'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
          }
          $this->audio->setCreatedAt($value);
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->audio->setCreatedAt(null);
      }
    }
    $this->audio->setShow(isset($audio['show']) ? $audio['show'] : 0);
    if (isset($audio['file']))
    {
      $this->audio->setFile($audio['file']);
    }
    if (isset($audio['remote']))
    {
      $this->audio->setRemote($audio['remote']);
    }
    if (isset($audio['size']))
    {
      $this->audio->setSize($audio['size']);
    }
    if (isset($audio['duration']))
    {
      $this->audio->setDuration($audio['duration']);
    }
    if (isset($audio['order']))
    {
      $this->audio->setOrder($audio['order']);
    }
    if (isset($audio['title_i18n_en']))
    {
      $this->audio->setTitleI18nEn($audio['title_i18n_en']);
    }
    if (isset($audio['body_i18n_en']))
    {
      $this->audio->setBodyI18nEn($audio['body_i18n_en']);
    }
    if (isset($audio['author_i18n_en']))
    {
      $this->audio->setAuthorI18nEn($audio['author_i18n_en']);
    }
    if (isset($audio['title_i18n_ru']))
    {
      $this->audio->setTitleI18nRu($audio['title_i18n_ru']);
    }
    if (isset($audio['body_i18n_ru']))
    {
      $this->audio->setBodyI18nRu($audio['body_i18n_ru']);
    }
    if (isset($audio['author_i18n_ru']))
    {
      $this->audio->setAuthorI18nRu($audio['author_i18n_ru']);
    }
    if (isset($audio['title_i18n_cs']))
    {
      $this->audio->setTitleI18nCs($audio['title_i18n_cs']);
    }
    if (isset($audio['body_i18n_cs']))
    {
      $this->audio->setBodyI18nCs($audio['body_i18n_cs']);
    }
    if (isset($audio['author_i18n_cs']))
    {
      $this->audio->setAuthorI18nCs($audio['author_i18n_cs']);
    }
    if (isset($audio['title_i18n_hu']))
    {
      $this->audio->setTitleI18nHu($audio['title_i18n_hu']);
    }
    if (isset($audio['body_i18n_hu']))
    {
      $this->audio->setBodyI18nHu($audio['body_i18n_hu']);
    }
    if (isset($audio['author_i18n_hu']))
    {
      $this->audio->setAuthorI18nHu($audio['author_i18n_hu']);
    }
    if (isset($audio['title_i18n_pl']))
    {
      $this->audio->setTitleI18nPl($audio['title_i18n_pl']);
    }
    if (isset($audio['body_i18n_pl']))
    {
      $this->audio->setBodyI18nPl($audio['body_i18n_pl']);
    }
    if (isset($audio['author_i18n_pl']))
    {
      $this->audio->setAuthorI18nPl($audio['author_i18n_pl']);
    }
    if (isset($audio['title_i18n_fr']))
    {
      $this->audio->setTitleI18nFr($audio['title_i18n_fr']);
    }
    if (isset($audio['body_i18n_fr']))
    {
      $this->audio->setBodyI18nFr($audio['body_i18n_fr']);
    }
    if (isset($audio['author_i18n_fr']))
    {
      $this->audio->setAuthorI18nFr($audio['author_i18n_fr']);
    }
    if (isset($audio['title_i18n_zh_cn']))
    {
      $this->audio->setTitleI18nZhCN($audio['title_i18n_zh_cn']);
    }
    if (isset($audio['body_i18n_zh_cn']))
    {
      $this->audio->setBodyI18nZhCN($audio['body_i18n_zh_cn']);
    }
    if (isset($audio['author_i18n_zh_cn']))
    {
      $this->audio->setAuthorI18nZhCN($audio['author_i18n_zh_cn']);
    }
    if (isset($audio['title_i18n_vi']))
    {
      $this->audio->setTitleI18nVi($audio['title_i18n_vi']);
    }
    if (isset($audio['body_i18n_vi']))
    {
      $this->audio->setBodyI18nVi($audio['body_i18n_vi']);
    }
    if (isset($audio['author_i18n_vi']))
    {
      $this->audio->setAuthorI18nVi($audio['author_i18n_vi']);
    }
    if (isset($audio['title_i18n_it']))
    {
      $this->audio->setTitleI18nIt($audio['title_i18n_it']);
    }
    if (isset($audio['body_i18n_it']))
    {
      $this->audio->setBodyI18nIt($audio['body_i18n_it']);
    }
    if (isset($audio['author_i18n_it']))
    {
      $this->audio->setAuthorI18nIt($audio['author_i18n_it']);
    }
    if (isset($audio['title_i18n_ja']))
    {
      $this->audio->setTitleI18nJa($audio['title_i18n_ja']);
    }
    if (isset($audio['body_i18n_ja']))
    {
      $this->audio->setBodyI18nJa($audio['body_i18n_ja']);
    }
    if (isset($audio['author_i18n_ja']))
    {
      $this->audio->setAuthorI18nJa($audio['author_i18n_ja']);
    }
    if (isset($audio['title_i18n_es']))
    {
      $this->audio->setTitleI18nEs($audio['title_i18n_es']);
    }
    if (isset($audio['body_i18n_es']))
    {
      $this->audio->setBodyI18nEs($audio['body_i18n_es']);
    }
    if (isset($audio['author_i18n_es']))
    {
      $this->audio->setAuthorI18nEs($audio['author_i18n_es']);
    }
    if (isset($audio['title_i18n_et']))
    {
      $this->audio->setTitleI18nEt($audio['title_i18n_et']);
    }
    if (isset($audio['body_i18n_et']))
    {
      $this->audio->setBodyI18nEt($audio['body_i18n_et']);
    }
    if (isset($audio['author_i18n_et']))
    {
      $this->audio->setAuthorI18nEt($audio['author_i18n_et']);
    }
    if (isset($audio['title_i18n_ne']))
    {
      $this->audio->setTitleI18nNe($audio['title_i18n_ne']);
    }
    if (isset($audio['body_i18n_ne']))
    {
      $this->audio->setBodyI18nNe($audio['body_i18n_ne']);
    }
    if (isset($audio['author_i18n_ne']))
    {
      $this->audio->setAuthorI18nNe($audio['author_i18n_ne']);
    }
    if (isset($audio['title_i18n_bn']))
    {
      $this->audio->setTitleI18nBn($audio['title_i18n_bn']);
    }
    if (isset($audio['body_i18n_bn']))
    {
      $this->audio->setBodyI18nBn($audio['body_i18n_bn']);
    }
    if (isset($audio['author_i18n_bn']))
    {
      $this->audio->setAuthorI18nBn($audio['author_i18n_bn']);
    }
    if (isset($audio['title_i18n_he']))
    {
      $this->audio->setTitleI18nHe($audio['title_i18n_he']);
    }
    if (isset($audio['body_i18n_he']))
    {
      $this->audio->setBodyI18nHe($audio['body_i18n_he']);
    }
    if (isset($audio['author_i18n_he']))
    {
      $this->audio->setAuthorI18nHe($audio['author_i18n_he']);
    }
    if (isset($audio['title_i18n_zh_tw']))
    {
      $this->audio->setTitleI18nZhTW($audio['title_i18n_zh_tw']);
    }
    if (isset($audio['body_i18n_zh_tw']))
    {
      $this->audio->setBodyI18nZhTW($audio['body_i18n_zh_tw']);
    }
    if (isset($audio['author_i18n_zh_tw']))
    {
      $this->audio->setAuthorI18nZhTW($audio['author_i18n_zh_tw']);
    }
    if (isset($audio['title_i18n_de']))
    {
      $this->audio->setTitleI18nDe($audio['title_i18n_de']);
    }
    if (isset($audio['body_i18n_de']))
    {
      $this->audio->setBodyI18nDe($audio['body_i18n_de']);
    }
    if (isset($audio['author_i18n_de']))
    {
      $this->audio->setAuthorI18nDe($audio['author_i18n_de']);
    }
    // clear cache of a changed item
    ClearcachePeer::processItem($this->audio);
  }
}
