<?php

/**
 * news actions.
 *
 * @package    sf_sandbox
 * @subpackage news
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */

class newsActions extends autonewsActions
{

  protected function updateNewsFromRequest()
  {
    $news = $this->getRequestParameter('news');

    // Empty string to null
    //
    // backend saves empty strings as ''
    // some fields in DB has DEFAULT NULL
    // so their value changes from NULL to ''
    // it is impossible to set DEFAULT '' for all types of fields:
    //     build-propel.xml:196:10: BLOB and TEXT columns cannot have DEFAULT values. in MySQL.
    /*foreach ($news as $i => $value) {
    	if ($value === '') {
    		$news[ $i ] = null;
    	}
    }*/

    // set change_updated_at
    $this->news->setChangeUpdatedAt($news['change_updated_at']);
    $news_i18ns = $this->news->getNewsI18ns();
    foreach ($news_i18ns as $news_i18n) {
    	$news_i18n->setChangeUpdatedAt($news['change_updated_at']);
    }

    $this->news->setShow(isset($news['show']) ? $news['show'] : 0);
    if (isset($news['order']))
    {
      $this->news->setOrder($news['order']);
    }
    if (isset($news['date']))
    {
      if ($news['date'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                              if (!is_array($news['date']))
          {
            $value = $dateFormat->format($news['date'], 'i', $dateFormat->getInputPattern('d'));
          }
          else
          {
            $value_array = $news['date'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
          }
          $this->news->setDate($value);
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->news->setDate(null);
      }
    }


    $full_local    = $this->news->getFullLocal();
    $thumb_local   = $this->news->getThumbLocal();

    // удаляем изображения
    if (!$this->getRequest()->hasErrors() && isset($news['img_remove']))
    {
      $this->news->setImg('');
      $this->news->setFullPath('');
      $this->news->setThumbPath('');
      // full
      if (is_file($full_local))
      {
        unlink($full_local);
      }
      // thumb
      if (is_file($thumb_local))
      {
        unlink($thumb_local);
      }
    }


    if (!$this->getRequest()->hasErrors() && $this->getRequest()->getFileSize('news[img]'))
    {
      $fileName = $this->news->getId();

      // если новость создаётся, ID ещё неизвестен
      if (!$fileName) {
      	$this->news->save();
      	$fileName = $this->news->getId();
      }

      $original_ext = $this->getRequest()->getFileExtension('news[img]');
      // Images are always converted to JPG
      $ext = '.jpg';
      $mime_type = 'image/jpeg';

      $tmp_full    = sfConfig::get('sf_upload_dir')."/".NewsPeer::FULL_DIR."/tmp/".$fileName.$ext;
      $tmp_thumb   = sfConfig::get('sf_upload_dir')."/".NewsPeer::THUMB_DIR."/tmp/".$fileName.$ext;

      $this->getRequest()->moveFile('news[img]', $tmp_full);
      $this->news->setImg($fileName.$ext);

      // сохраняем исходное изображение (без каптчи)
      PhotoPeer::moveFile($tmp_full, sfConfig::get('sf_upload_dir')."/".NewsPeer::ORIGINAL_DIR."/".$fileName.$original_ext);

	  try {
		// thumb
		$img = new sfImage( $tmp_full );
		$img->thumbnail( NewsPeer::THUMB_WIDTH, NewsPeer::THUMB_HEIGHT, 'scale' );
		$img->setQuality(NewsPeer::THUMB_QUALITY);
		$img->saveAs( $tmp_thumb );

		// full
		$img = new sfImage( $tmp_full );
		if ( $img->getWidth() > NewsPeer::IMG_WIDTH || $img->getHeight() > NewsPeer::IMG_HEIGHT ) {
		    $img->thumbnail( NewsPeer::IMG_WIDTH, NewsPeer::IMG_HEIGHT, 'scale');
		}
		// водяной знак
		if (isset($news['watermark'])) {
		    $img->overlay(new sfImage(sfConfig::get('sf_web_dir') . '/i/watermark.png'), 'bottom-right'); // or you can use coords array($x,$y)
		}
        $img->setQuality(NewsPeer::FULL_QUALITY);
		$img->save();

        // to Picasa
        try
		{
		  $title = $fileName . ($news['title_i18n_en'] !='' ? ' - ' . $news['title_i18n_en'] : '');
		  $title .= ' (' . UserPeer::DOMAIN_NAME_MAIN . ')';

		  // full
		  $remote_post_result = PhotoPeer::remoteStoragePostImage(
		  	NewsPeer::FULL_DIR,
		  	$tmp_full,
		  	$mime_type,
		  	$fileName.$ext,
		  	$title
		  );
		  if ($remote_post_result['error']) {
		  	echo $remote_post_result['error'];
		  	exit();
		  }
		  $this->news->setFullPath( $remote_post_result['url'] );
		  // перемещение файла в локальную директорию, аналогичнцю удалённой
		  PhotoPeer::moveFile(
		    $tmp_full,
		    sfConfig::get('sf_upload_dir')."/".NewsPeer::PHOTO_DIR."/".$remote_post_result['url']."/".$fileName.$ext
  	      );

  	      // creating symlink
  	      $link = sfConfig::get('sf_upload_dir')."/".NewsPeer::FULL_DIR."/".$fileName.$ext;
  	      unlink($link);
  	      symlink('../'.$remote_post_result['url']."/".$fileName.$ext, $link);

		  // thumb
		  $remote_post_result = PhotoPeer::remoteStoragePostImage(
		  	NewsPeer::THUMB_DIR,
		  	$tmp_thumb,
		  	$mime_type,
		  	$fileName.$ext,
		  	$title
		  );

		  if ($remote_post_result['error']) {
		  	echo $remote_post_result['error'];
		  	exit();
		  }
		  $this->news->setThumbPath( $remote_post_result['url'] );
		  // перемещение файла в локальную директорию, аналогичнцю удалённой
		  PhotoPeer::moveFile(
		    $tmp_thumb,
		    sfConfig::get('sf_upload_dir')."/".NewsPeer::PHOTO_DIR."/".$remote_post_result['url']."/".$fileName.$ext
  	      );

  	      // creating symlink
  	      $link = sfConfig::get('sf_upload_dir')."/".NewsPeer::THUMB_DIR."/".$fileName.$ext;
  	      unlink($link);
  	      symlink('../'.$remote_post_result['url']."/".$fileName.$ext, $link);

		} catch( Exception $e ) {
		  echo $e->getMessage();
		  exit();
		}

		// удаляем временные файлы
        if (is_file($tmp_full))
        {
            unlink($tmp_full);
        }
        // thumb
        if (is_file($tmp_thumb))
        {
            unlink($tmp_thumb);
        }

        // удаляем прошлые файлы
		if (is_file($full_local))
		{
			unlink($full_local);
		}
		// thumb
		if (is_file($thumb_local))
		{
			unlink($thumb_local);
		}

      } catch (Exception $e) {
      	echo $e->getMessage();
      	exit();
      }
    } elseif (!isset($news['img_remove'])) {
	  if (isset($news['full_path']))
	  {
	    $this->news->setFullPath($news['full_path']);
	  }
	  if (isset($news['thumb_path']))
	  {
	    $this->news->setThumbPath($news['thumb_path']);
	  }
    }
    /*if (isset($news['type']))
    {
      $this->news->setType($news['type'] ? $news['type'] : null);
    }*/
    // otherwise id does not save original after clearing it in backend
    //if (isset($news['original']))
    //{
    $this->news->setOriginal($news['original']);
    //}
	if (isset($news['title_i18n_en']))
    {
      $this->news->setTitleI18nEn($news['title_i18n_en']);
    }
    if (isset($news['extradate_i18n_en']))
    {
      $this->news->setExtradateI18nEn($news['extradate_i18n_en']);
    }
    if (isset($news['shortbody_i18n_en']))
    {
      $this->news->setShortbodyI18nEn($news['shortbody_i18n_en']);
    }
    if (isset($news['body_i18n_en']))
    {
      $this->news->setBodyI18nEn($news['body_i18n_en']);
    }
    if (isset($news['author_i18n_en']))
    {
      $this->news->setAuthorI18nEn($news['author_i18n_en']);
    }
    if (isset($news['translated_by_i18n_en']))
    {
      $this->news->setTranslatedByI18nEn($news['translated_by_i18n_en']);
    }
    if (isset($news['link_i18n_en']))
    {
      $this->news->setLinkI18nEn($news['link_i18n_en']);
    }
    if (isset($news['doc_i18n_en']))
    {
      $this->news->setDocI18nEn($news['doc_i18n_en']);
    }
    if (isset($news['title_i18n_ru']))
    {
      $this->news->setTitleI18nRu($news['title_i18n_ru']);
    }
    if (isset($news['extradate_i18n_ru']))
    {
      $this->news->setExtradateI18nRu($news['extradate_i18n_ru']);
    }
    if (isset($news['shortbody_i18n_ru']))
    {
      $this->news->setShortbodyI18nRu($news['shortbody_i18n_ru']);
    }
    if (isset($news['body_i18n_ru']))
    {
      $this->news->setBodyI18nRu($news['body_i18n_ru']);
    }
    if (isset($news['author_i18n_ru']))
    {
      $this->news->setAuthorI18nRu($news['author_i18n_ru']);
    }
    if (isset($news['translated_by_i18n_ru']))
    {
      $this->news->setTranslatedByI18nRu($news['translated_by_i18n_ru']);
    }
    if (isset($news['link_i18n_ru']))
    {
      $this->news->setLinkI18nRu($news['link_i18n_ru']);
    }
    if (isset($news['doc_i18n_ru']))
    {
      $this->news->setDocI18nRu($news['doc_i18n_ru']);
    }
    if (isset($news['title_i18n_cs']))
    {
      $this->news->setTitleI18nCs($news['title_i18n_cs']);
    }
    if (isset($news['extradate_i18n_cs']))
    {
      $this->news->setExtradateI18nCs($news['extradate_i18n_cs']);
    }
    if (isset($news['shortbody_i18n_cs']))
    {
      $this->news->setShortbodyI18nCs($news['shortbody_i18n_cs']);
    }
    if (isset($news['body_i18n_cs']))
    {
      $this->news->setBodyI18nCs($news['body_i18n_cs']);
    }
    if (isset($news['author_i18n_cs']))
    {
      $this->news->setAuthorI18nCs($news['author_i18n_cs']);
    }
    if (isset($news['translated_by_i18n_cs']))
    {
      $this->news->setTranslatedByI18nCs($news['translated_by_i18n_cs']);
    }
    if (isset($news['link_i18n_cs']))
    {
      $this->news->setLinkI18nCs($news['link_i18n_cs']);
    }
    if (isset($news['doc_i18n_cs']))
    {
      $this->news->setDocI18nCs($news['doc_i18n_cs']);
    }
    if (isset($news['title_i18n_hu']))
    {
      $this->news->setTitleI18nHu($news['title_i18n_hu']);
    }
    if (isset($news['extradate_i18n_hu']))
    {
      $this->news->setExtradateI18nHu($news['extradate_i18n_hu']);
    }
    if (isset($news['shortbody_i18n_hu']))
    {
      $this->news->setShortbodyI18nHu($news['shortbody_i18n_hu']);
    }
    if (isset($news['body_i18n_hu']))
    {
      $this->news->setBodyI18nHu($news['body_i18n_hu']);
    }
    if (isset($news['author_i18n_hu']))
    {
      $this->news->setAuthorI18nHu($news['author_i18n_hu']);
    }
    if (isset($news['translated_by_i18n_hu']))
    {
      $this->news->setTranslatedByI18nHu($news['translated_by_i18n_hu']);
    }
    if (isset($news['link_i18n_hu']))
    {
      $this->news->setLinkI18nHu($news['link_i18n_hu']);
    }
    if (isset($news['doc_i18n_hu']))
    {
      $this->news->setDocI18nHu($news['doc_i18n_hu']);
    }
    if (isset($news['title_i18n_pl']))
    {
      $this->news->setTitleI18nPl($news['title_i18n_pl']);
    }
    if (isset($news['extradate_i18n_pl']))
    {
      $this->news->setExtradateI18nPl($news['extradate_i18n_pl']);
    }
    if (isset($news['shortbody_i18n_pl']))
    {
      $this->news->setShortbodyI18nPl($news['shortbody_i18n_pl']);
    }
    if (isset($news['body_i18n_pl']))
    {
      $this->news->setBodyI18nPl($news['body_i18n_pl']);
    }
    if (isset($news['author_i18n_pl']))
    {
      $this->news->setAuthorI18nPl($news['author_i18n_pl']);
    }
    if (isset($news['translated_by_i18n_pl']))
    {
      $this->news->setTranslatedByI18nPl($news['translated_by_i18n_pl']);
    }
    if (isset($news['link_i18n_pl']))
    {
      $this->news->setLinkI18nPl($news['link_i18n_pl']);
    }
    if (isset($news['doc_i18n_pl']))
    {
      $this->news->setDocI18nPl($news['doc_i18n_pl']);
    }
    if (isset($news['title_i18n_fr']))
    {
      $this->news->setTitleI18nFr($news['title_i18n_fr']);
    }
    if (isset($news['extradate_i18n_fr']))
    {
      $this->news->setExtradateI18nFr($news['extradate_i18n_fr']);
    }
    if (isset($news['shortbody_i18n_fr']))
    {
      $this->news->setShortbodyI18nFr($news['shortbody_i18n_fr']);
    }
    if (isset($news['body_i18n_fr']))
    {
      $this->news->setBodyI18nFr($news['body_i18n_fr']);
    }
    if (isset($news['author_i18n_fr']))
    {
      $this->news->setAuthorI18nFr($news['author_i18n_fr']);
    }
    if (isset($news['translated_by_i18n_fr']))
    {
      $this->news->setTranslatedByI18nFr($news['translated_by_i18n_fr']);
    }
    if (isset($news['link_i18n_fr']))
    {
      $this->news->setLinkI18nFr($news['link_i18n_fr']);
    }
    if (isset($news['doc_i18n_fr']))
    {
      $this->news->setDocI18nFr($news['doc_i18n_fr']);
    }
    if (isset($news['title_i18n_zh_cn']))
    {
      $this->news->setTitleI18nZhCN($news['title_i18n_zh_cn']);
    }
    if (isset($news['extradate_i18n_zh_cn']))
    {
      $this->news->setExtradateI18nZhCN($news['extradate_i18n_zh_cn']);
    }
    if (isset($news['shortbody_i18n_zh_cn']))
    {
      $this->news->setShortbodyI18nZhCN($news['shortbody_i18n_zh_cn']);
    }
    if (isset($news['body_i18n_zh_cn']))
    {
      $this->news->setBodyI18nZhCN($news['body_i18n_zh_cn']);
    }
    if (isset($news['author_i18n_zh_cn']))
    {
      $this->news->setAuthorI18nZhCN($news['author_i18n_zh_cn']);
    }
    if (isset($news['translated_by_i18n_zh_cn']))
    {
      $this->news->setTranslatedByI18nZhCN($news['translated_by_i18n_zh_cn']);
    }
    if (isset($news['link_i18n_zh_cn']))
    {
      $this->news->setLinkI18nZhCN($news['link_i18n_zh_cn']);
    }
    if (isset($news['doc_i18n_zh_cn']))
    {
      $this->news->setDocI18nZhCN($news['doc_i18n_zh_cn']);
    }
    if (isset($news['title_i18n_vi']))
    {
      $this->news->setTitleI18nVi($news['title_i18n_vi']);
    }
    if (isset($news['extradate_i18n_vi']))
    {
      $this->news->setExtradateI18nVi($news['extradate_i18n_vi']);
    }
    if (isset($news['shortbody_i18n_vi']))
    {
      $this->news->setShortbodyI18nVi($news['shortbody_i18n_vi']);
    }
    if (isset($news['body_i18n_vi']))
    {
      $this->news->setBodyI18nVi($news['body_i18n_vi']);
    }
    if (isset($news['author_i18n_vi']))
    {
      $this->news->setAuthorI18nVi($news['author_i18n_vi']);
    }
    if (isset($news['translated_by_i18n_vi']))
    {
      $this->news->setTranslatedByI18nVi($news['translated_by_i18n_vi']);
    }
    if (isset($news['link_i18n_vi']))
    {
      $this->news->setLinkI18nVi($news['link_i18n_vi']);
    }
    if (isset($news['doc_i18n_vi']))
    {
      $this->news->setDocI18nVi($news['doc_i18n_vi']);
    }
    if (isset($news['title_i18n_it']))
    {
      $this->news->setTitleI18nIt($news['title_i18n_it']);
    }
    if (isset($news['extradate_i18n_it']))
    {
      $this->news->setExtradateI18nIt($news['extradate_i18n_it']);
    }
    if (isset($news['shortbody_i18n_it']))
    {
      $this->news->setShortbodyI18nIt($news['shortbody_i18n_it']);
    }
    if (isset($news['body_i18n_it']))
    {
      $this->news->setBodyI18nIt($news['body_i18n_it']);
    }
    if (isset($news['author_i18n_it']))
    {
      $this->news->setAuthorI18nIt($news['author_i18n_it']);
    }
    if (isset($news['translated_by_i18n_it']))
    {
      $this->news->setTranslatedByI18nIt($news['translated_by_i18n_it']);
    }
    if (isset($news['link_i18n_it']))
    {
      $this->news->setLinkI18nIt($news['link_i18n_it']);
    }
    if (isset($news['doc_i18n_it']))
    {
      $this->news->setDocI18nIt($news['doc_i18n_it']);
    }
    if (isset($news['title_i18n_ja']))
    {
      $this->news->setTitleI18nJa($news['title_i18n_ja']);
    }
    if (isset($news['extradate_i18n_ja']))
    {
      $this->news->setExtradateI18nJa($news['extradate_i18n_ja']);
    }
    if (isset($news['shortbody_i18n_ja']))
    {
      $this->news->setShortbodyI18nJa($news['shortbody_i18n_ja']);
    }
    if (isset($news['body_i18n_ja']))
    {
      $this->news->setBodyI18nJa($news['body_i18n_ja']);
    }
    if (isset($news['author_i18n_ja']))
    {
      $this->news->setAuthorI18nJa($news['author_i18n_ja']);
    }
    if (isset($news['translated_by_i18n_ja']))
    {
      $this->news->setTranslatedByI18nJa($news['translated_by_i18n_ja']);
    }
    if (isset($news['link_i18n_ja']))
    {
      $this->news->setLinkI18nJa($news['link_i18n_ja']);
    }
    if (isset($news['doc_i18n_ja']))
    {
      $this->news->setDocI18nJa($news['doc_i18n_ja']);
    }
    if (isset($news['title_i18n_es']))
    {
      $this->news->setTitleI18nEs($news['title_i18n_es']);
    }
    if (isset($news['extradate_i18n_es']))
    {
      $this->news->setExtradateI18nEs($news['extradate_i18n_es']);
    }
    if (isset($news['shortbody_i18n_es']))
    {
      $this->news->setShortbodyI18nEs($news['shortbody_i18n_es']);
    }
    if (isset($news['body_i18n_es']))
    {
      $this->news->setBodyI18nEs($news['body_i18n_es']);
    }
    if (isset($news['author_i18n_es']))
    {
      $this->news->setAuthorI18nEs($news['author_i18n_es']);
    }
    if (isset($news['translated_by_i18n_es']))
    {
      $this->news->setTranslatedByI18nEs($news['translated_by_i18n_es']);
    }
    if (isset($news['link_i18n_es']))
    {
      $this->news->setLinkI18nEs($news['link_i18n_es']);
    }
    if (isset($news['doc_i18n_es']))
    {
      $this->news->setDocI18nEs($news['doc_i18n_es']);
    }
    if (isset($news['title_i18n_et']))
    {
      $this->news->setTitleI18nEt($news['title_i18n_et']);
    }
    if (isset($news['extradate_i18n_et']))
    {
      $this->news->setExtradateI18nEt($news['extradate_i18n_et']);
    }
    if (isset($news['shortbody_i18n_et']))
    {
      $this->news->setShortbodyI18nEt($news['shortbody_i18n_et']);
    }
    if (isset($news['body_i18n_et']))
    {
      $this->news->setBodyI18nEt($news['body_i18n_et']);
    }
    if (isset($news['author_i18n_et']))
    {
      $this->news->setAuthorI18nEt($news['author_i18n_et']);
    }
    if (isset($news['translated_by_i18n_et']))
    {
      $this->news->setTranslatedByI18nEt($news['translated_by_i18n_et']);
    }
    if (isset($news['link_i18n_et']))
    {
      $this->news->setLinkI18nEt($news['link_i18n_et']);
    }
    if (isset($news['doc_i18n_et']))
    {
      $this->news->setDocI18nEt($news['doc_i18n_et']);
    }
    if (isset($news['title_i18n_ne']))
    {
      $this->news->setTitleI18nNe($news['title_i18n_ne']);
    }
    if (isset($news['extradate_i18n_ne']))
    {
      $this->news->setExtradateI18nNe($news['extradate_i18n_ne']);
    }
    if (isset($news['shortbody_i18n_ne']))
    {
      $this->news->setShortbodyI18nNe($news['shortbody_i18n_ne']);
    }
    if (isset($news['body_i18n_ne']))
    {
      $this->news->setBodyI18nNe($news['body_i18n_ne']);
    }
    if (isset($news['author_i18n_ne']))
    {
      $this->news->setAuthorI18nNe($news['author_i18n_ne']);
    }
    if (isset($news['translated_by_i18n_ne']))
    {
      $this->news->setTranslatedByI18nNe($news['translated_by_i18n_ne']);
    }
    if (isset($news['link_i18n_ne']))
    {
      $this->news->setLinkI18nNe($news['link_i18n_ne']);
    }
    if (isset($news['doc_i18n_ne']))
    {
      $this->news->setDocI18nNe($news['doc_i18n_ne']);
    }
    if (isset($news['title_i18n_bn']))
    {
      $this->news->setTitleI18nBn($news['title_i18n_bn']);
    }
    if (isset($news['extradate_i18n_bn']))
    {
      $this->news->setExtradateI18nBn($news['extradate_i18n_bn']);
    }
    if (isset($news['shortbody_i18n_bn']))
    {
      $this->news->setShortbodyI18nBn($news['shortbody_i18n_bn']);
    }
    if (isset($news['body_i18n_bn']))
    {
      $this->news->setBodyI18nBn($news['body_i18n_bn']);
    }
    if (isset($news['author_i18n_bn']))
    {
      $this->news->setAuthorI18nBn($news['author_i18n_bn']);
    }
    if (isset($news['translated_by_i18n_bn']))
    {
      $this->news->setTranslatedByI18nBn($news['translated_by_i18n_bn']);
    }
    if (isset($news['link_i18n_bn']))
    {
      $this->news->setLinkI18nBn($news['link_i18n_bn']);
    }
    if (isset($news['doc_i18n_bn']))
    {
      $this->news->setDocI18nBn($news['doc_i18n_bn']);
    }
    if (isset($news['title_i18n_he']))
    {
      $this->news->setTitleI18nHe($news['title_i18n_he']);
    }
    if (isset($news['extradate_i18n_he']))
    {
      $this->news->setExtradateI18nHe($news['extradate_i18n_he']);
    }
    if (isset($news['shortbody_i18n_he']))
    {
      $this->news->setShortbodyI18nHe($news['shortbody_i18n_he']);
    }
    if (isset($news['body_i18n_he']))
    {
      $this->news->setBodyI18nHe($news['body_i18n_he']);
    }
    if (isset($news['author_i18n_he']))
    {
      $this->news->setAuthorI18nHe($news['author_i18n_he']);
    }
    if (isset($news['translated_by_i18n_he']))
    {
      $this->news->setTranslatedByI18nHe($news['translated_by_i18n_he']);
    }
    if (isset($news['link_i18n_he']))
    {
      $this->news->setLinkI18nHe($news['link_i18n_he']);
    }
    if (isset($news['doc_i18n_he']))
    {
      $this->news->setDocI18nHe($news['doc_i18n_he']);
    }
    if (isset($news['title_i18n_zh_tw']))
    {
      $this->news->setTitleI18nZhTw($news['title_i18n_zh_tw']);
    }
    if (isset($news['extradate_i18n_zh_tw']))
    {
      $this->news->setExtradateI18nZhTw($news['extradate_i18n_zh_tw']);
    }
    if (isset($news['shortbody_i18n_zh_tw']))
    {
      $this->news->setShortbodyI18nZhTw($news['shortbody_i18n_zh_tw']);
    }
    if (isset($news['body_i18n_zh_tw']))
    {
      $this->news->setBodyI18nZhTw($news['body_i18n_zh_tw']);
    }
    if (isset($news['author_i18n_zh_tw']))
    {
      $this->news->setAuthorI18nZhTw($news['author_i18n_zh_tw']);
    }
    if (isset($news['translated_by_i18n_zh_tw']))
    {
      $this->news->setTranslatedByI18nZhTw($news['translated_by_i18n_zh_tw']);
    }
    if (isset($news['link_i18n_zh_tw']))
    {
      $this->news->setLinkI18nZhTw($news['link_i18n_zh_tw']);
    }
    if (isset($news['doc_i18n_zh_tw']))
    {
      $this->news->setDocI18nZhTW($news['doc_i18n_zh_tw']);
    }
    if (isset($news['title_i18n_de']))
    {
      $this->news->setTitleI18nDe($news['title_i18n_de']);
    }
    if (isset($news['extradate_i18n_de']))
    {
      $this->news->setExtradateI18nDe($news['extradate_i18n_de']);
    }
    if (isset($news['shortbody_i18n_de']))
    {
      $this->news->setShortbodyI18nDe($news['shortbody_i18n_de']);
    }
    if (isset($news['body_i18n_de']))
    {
      $this->news->setBodyI18nDe($news['body_i18n_de']);
    }
    if (isset($news['author_i18n_de']))
    {
      $this->news->setAuthorI18nDe($news['author_i18n_de']);
    }
    if (isset($news['translated_by_i18n_de']))
    {
      $this->news->setTranslatedByI18nDe($news['translated_by_i18n_de']);
    }
    if (isset($news['link_i18n_de']))
    {
      $this->news->setLinkI18nDe($news['link_i18n_de']);
    }
    if (isset($news['doc_i18n_de']))
    {
      $this->news->setDocI18nDe($news['doc_i18n_de']);
    }

    // clear cache of a changed item
    ClearcachePeer::processItem($this->news);
  }

  /**
   * Save News
   *
   * @param unknown_type $news
   */
  protected function saveNews($news)
  {
    $news->save();

    // Process Item Categories
    $news = $this->getRequestParameter('news');
    if ($news['itemcategory'] && $this->news->getId()) {
      Item2itemcategoryPeer::updateItemCategories($news['itemcategory'], ItemtypesPeer::ITEM_TYPE_NEWS, $this->news->getId());
    }
  }


  public function executeEdit($request)
  {
  	parent::executeEdit($request);

  	// проверка авторизации
  	if (!PhotoPeer::remoteStorageCheckAutenthication()) {
  	  $this->url_to_login_page = Picasa::getUrlToLoginPage($_SERVER['SCRIPT_URI']);
  	} else {
  	  $this->url_to_login_page = '';
  	}
  }

 /**
   * Загрузка фото в удалённое хранилище (Picasa)
   *
   * @param unknown_type $request
   */
  public function executeToremotestorage($request)
  {
  	exit();
  	$c = new Criteria();
  	$c->add(NewsPeer::SHOW, 1);
  	$c->add(NewsPeer::IMG, '', Criteria::NOT_EQUAL);
  	//$c->setLimit(2);
  	$news_list = NewsPeer::doSelect($c);

  	foreach ($news_list as $news) {

  		echo $news->getId() . '<br>';

  		$full_old_path = sfConfig::get('sf_upload_dir')."/".NewsPeer::FULL_DIR."/".$news->getImg();

  		$title    = $news->getId() . ($news->getTitle() !='' ? ' - ' . $news->getTitle() : '');
  		$pathinfo = pathinfo($full_old_path);
  		$ext      = $pathinfo['extension'];
  		if (!$ext) {
  			echo 'no ext';
  			echo '<br><br>';
  			continue;
  		}
  		$filename = $news->getId() . '.' . $ext;

  		if ( file_exists($news->getFullLocal()) && file_exists($news->getThumbLocal()) ) {
  			echo 'exists';
  			continue;
  		}

  		//$mime_type = mime_content_type($full_old_path); //'image/jpeg';
  		switch (strtolower($ext)) {
  			case 'jpg':
  				$mime_type = 'image/jpeg';
  				break;
  			case 'gif':
  				$mime_type = 'image/gif';
  				break;
  			/*default:
  				$mime_type = 'image/jpeg';
  				break;  				*/
  		}

  		// full
  		echo 'full<br>';

		$remote_post_result = PhotoPeer::remoteStoragePostImage(
			NewsPeer::FULL_DIR,
			$full_old_path,
			$mime_type,
			$filename,
			$title
		);
		if ($remote_post_result['error']) {
			echo $remote_post_result['error'] . '<br>';
		}
		$news->setFullPath( $remote_post_result['url'] );
		// перемещение файла в локальную директорию, аналогичнцю удалённой
		PhotoPeer::moveFile(
			$full_old_path,
			sfConfig::get('sf_upload_dir')."/".NewsPeer::PHOTO_DIR."/".$remote_post_result['url']."/".$filename
		);
		/*PhotoPeer::moveFile(
			$full_old_path,
			sfConfig::get('sf_upload_dir')."/".NewsPeer::FULL_DIR."/".$filename
		);*/
		echo $remote_post_result['url'] . '<br>';

  		// thumb
  		echo 'thumb<br>';
  		$thumb_old_path = sfConfig::get('sf_upload_dir')."/".NewsPeer::THUMB_DIR."/".$news->getImg();

		$remote_post_result = PhotoPeer::remoteStoragePostImage(
			NewsPeer::THUMB_DIR,
			$thumb_old_path,
			$mime_type,
			$filename,
			$title
		);
		if ($remote_post_result['error']) {
			echo $remote_post_result['error'] . '<br>';
		}
		$news->setThumbPath( $remote_post_result['url'] );
		// перемещение файла в локальную директорию, аналогичнцю удалённой
		PhotoPeer::moveFile(
			$thumb_old_path,
			sfConfig::get('sf_upload_dir')."/".NewsPeer::PHOTO_DIR."/".$remote_post_result['url']."/".$filename
		);
		echo $remote_post_result['url'] . '<br>';

		$news->setPrevImg( $filename );
		$news->save();

		echo '<br><br>';
  	}

  }

  /**
   * Очистка кэша
   *
   * @param unknown_type $request
   */
  public function executeCache($request)
  {
    // остановка обновления кэша
    if (!empty($_POST['kill']) && !empty($_POST['pid'])) {
      sfSuperCache::stopRefershCacheTask($_POST['pid']);
    }

    // остановка обновления кэша
    if (!empty($_POST['log']) && !empty($_POST['pid'])) {
      echo sfSuperCache::refreshCacheGetLogContent($_POST['pid']);
      exit();
    }

    // загрузка информации о логах
    if (!empty($_POST['load_log_list'])) {
      $this->log_list = sfSuperCache::refreshCacheGetLogList();
    }

    // запуск обновления кэша
    // исключение страниц из обработки
    if (!empty($_POST['refresh_cache'])) {

      // исключение объектов
	  if (!empty($_POST['refresh_exclude_path_regexp_flag']) && !empty($_POST['refresh_exclude_path_regexp'])) {
	  	$refresh_exclude_path_regexp = $_POST['refresh_exclude_path_regexp'];
	  	// экранируем символы \ и -
	  	$refresh_exclude_path_regexp = preg_replace("/[\/-]/", "\\\\$0", $refresh_exclude_path_regexp);
	  } else {
	  	$refresh_exclude_path_regexp = '';
	  }

      // включение объектов
	  if (!empty($_POST['refresh_include_path_regexp_flag']) && !empty($_POST['refresh_include_path_regexp'])) {
	  	$refresh_include_path_regexp = $_POST['refresh_include_path_regexp'];
	  	// экранируем символы \ и -
	  	$refresh_include_path_regexp = preg_replace("/[\/-]/", "\\\\$0", $refresh_include_path_regexp);
	  } else {
	  	$refresh_include_path_regexp = '';
	  }

      sfSuperCache::runRefreshCacheTask(
        $_POST['refresh_cache_domain_name'],
        @$_POST['refresh_cache_multi_process'],
        @$_POST['refresh_cache_console'],
        $refresh_exclude_path_regexp,
        $refresh_include_path_regexp
      );
    }

    // информация о процессах, обновляющих кэш
    $this->refresh_cache_daemon_info = sfSuperCache::refreshCacheGetDaemonInfo();

    // очистка/восстановление кэша
  	if (!empty($_POST['path'])) {
  	  if (!empty($_POST['al_cultures'])) {
  	    $all_cultures = true;
  	  } else {
  	  	$all_cultures = false;
  	  }
  	  // определяем, удаляем объекты или восстанавливаем
  	  if (!empty($_POST['clear'])) {
  	  	$delete = true;
  	  } else {
  	  	$delete = false;
  	  }
  	  try {
		$this->clear_pathes = sfSuperCache::alterCacheByPath($delete, $_POST['path'], $all_cultures);
		// запуск удаления запомненных путей
	    sfSuperCache::executRemoveFilePathListProcess();
  	  } catch(Exception $e) {
  	  	$this->error_message = $e->getMessage();
  	  }
  	}

  	// Удаление страниц кэша, которое необходимо выполнять при добавлении/изменении любого окнтента.
  	if (!empty($_POST['clear_on_any_change_submit'])) {
  	  $this->clear_pathes = sfSuperCache::clearCacheOnAnyContentChange($_POST['clear_on_any_change_culture']);
  	}

  	// Удаление страниц элемента контента и страниц всех связанных с ним элементов
  	$this->item_types = ItemtypesPeer::doSelect(new Criteria());
  	if (!empty($_POST['clear_item_submit'])) {
  	  $this->clear_pathes = sfSuperCache::clearCacheOfItem(
  	    						$_POST['clear_item_id'],
  	    						$_POST['clear_item_type_name'],
  	    						$_POST['clear_item_culture']
  	  );
  	}


  	// информация об объёме и кол-ве файлов
  	if (!empty($_POST['info'])) {
	  $this->cache_info = sfSuperCache::getInfo($_POST['info_domain_name'], $_POST['info_path_filter']);
  	}

  	// очистка кэша CloudFlare
  	if (!empty($_POST['submit_purge_cloudfront'])) {
	  $purge_cloudfront_result = sfSuperCache::cloudFlareRequest('fpurge_ts');
	  $this->cloudfront_result = $purge_cloudfront_result;
  	}

  	// Console cache refresh
  	if (!empty($_POST['submit_console_refresh'])) {
	  sfSuperCache::consoleRefreshCache('fpurge_ts');
  	}

  	if (!empty($_POST['submit_console_refresh_kill'])) {
	  sfSuperCache::consoleRefreshCacheProcessKill($_POST['console_refresh_pid']);
  	}

  	$this->console_refresh_processes_list = sfSuperCache::listConsoleRefreshProcesses();

  }

  /**
   * Работа с файлами переводов
   *
   * @param unknown_type $request
   */
  public function executeTranslate($request)
  {
      $this->result = '';

      if ($_POST['submit_convert'] && $_POST['plain_text']) {
          // конвертация plain текста в messages файл
          $this->result = $_POST['plain_text'];

          // удаляется первый разделитель
          $this->result = preg_replace("/^" . preg_quote(TextPeer::TRANSLATE_ITEMS_DELIMITER) . "(\r)?\n/", '', $this->result);

          // удаляется последний разделитель
          $this->result = preg_replace("/(\r)?\n" . preg_quote(TextPeer::TRANSLATE_ITEMS_DELIMITER) . "([\s]+)?$/", '', $this->result);

          // разделитель между элементами
          $this->result = preg_replace(
            "/(\r)?\n" . preg_quote(TextPeer::TRANSLATE_ITEMS_DELIMITER) . "(\r)?\n/",
            '</target>
      </trans-unit>

      <trans-unit id="1">
        <source>',
            $this->result);

          // разделитель между текстом и переводом
          $this->result = preg_replace(
            "/(\r)?\n" . preg_quote(TextPeer::TRANSLATE_BETWEEN_DELIMITER) . "(\r)?\n/",
            '</source>
        <target>',
            $this->result);

          $this->result = '<?xml version="1.0" ?>
<xliff version="1.0">
  <file original="global" source-language="en" datatype="plaintext">
    <body>

      <trans-unit id="1">
        <source>' . $this->result . '</target>
      </trans-unit>

<!-- утф -->
    </body>
  </file>
</xliff>';



          if ($_POST['get_as_file']) {
            ob_clean();
        	header('Content-Type: application/xml;');
        	header('Content-Description: File Transfer');
    		if ( preg_match( "/MSIE/", $_SERVER["HTTP_USER_AGENT"] ) ) {
    			header('Content-Disposition: attachment; filename=' . str_replace('+', ' ', urlencode('messages.xml')) );
    		} else {
    			header('Content-Disposition: attachment; filename=messages.xml' );
    		}
    		header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
    		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
    		header('Content-Length: ' . strlen($this->result) );

    		echo $this->result;
          }
      }
  }

 /**
   * Temporatry function
   *
   * @param unknown_type $request
   */
  public function executePhotosymlinks($request)
  {
    exit();
  	$c = new Criteria();
  	//$c->setLimit(10);
  	$list = PhotoPeer::doSelect($c);

  	$result = array(
  		'photo_count' 		  => 0,
  		'full_count'     	  => 0,
  		'preview_count'       => 0,
  		'thumb_count'         => 0,
  		'full_symlink'     	  => 0,
  		'preview_symlink'     => 0,
  		'thumb_symlink'       => 0,
  	);

  	$result['photo_count'] = count($list);

  	foreach ($list as $item) {
  	  $file_name = $item->getImg();

  	  if (!$file_name) {
  	    continue;
  	  }

  	  $full_path 	   = $item->getFullPath();
  	  $full_path_local = $item->getFullLocal();

  	  if ( $full_path && file_exists($full_path_local) ) {
  	  	$result['full_count']++;

  	  	$symlink_result = symlink('../'.$full_path."/".$file_name, sfConfig::get('sf_upload_dir')."/".PhotoPeer::FULL_DIR."/".$file_name);
  	  	if ($symlink_result) {
  	  		$result['full_symlink']++;
  	  	}
  	  }

  	  $preview_path 	  = $item->getPreviewPath();
  	  $preview_path_local = $item->getPreviewLocal();

  	  if ( $preview_path && file_exists($preview_path_local) ) {
  	  	$result['preview_count']++;

  	  	$symlink_result = symlink('../'.$preview_path."/".$file_name, sfConfig::get('sf_upload_dir')."/".PhotoPeer::PREVIEW_DIR."/".$file_name);
  	  	if ($symlink_result) {
  	  		$result['preview_symlink']++;
  	  	}
  	  }

  	  $thumb_path 	  = $item->getThumbPath();
  	  $thumb_path_local = $item->getThumbLocal();

  	  if ( $thumb_path && file_exists($thumb_path_local) ) {
  	  	$result['thumb_count']++;

  	  	$symlink_result = symlink('../'.$thumb_path."/".$file_name, sfConfig::get('sf_upload_dir')."/".PhotoPeer::THUMB_DIR."/".$file_name);
  	  	if ($symlink_result) {
  	  		$result['thumb_symlink']++;
  	  	}
  	  }
  	}
  	echo "<pre>";
  	print_r( $result );
  	exit();

  }

 /**
   * Temporatry function
   *
   * @param unknown_type $request
   */
  public function executeNewssymlinks($request)
  {
    exit();
  	$c = new Criteria();
  	//$c->setLimit(10);
  	$list = NewsPeer::doSelect($c);

  	$result = array(
  		'count' 		      => 0,
  		'full_count'     	  => 0,
  		'thumb_count'         => 0,
  		'full_symlink'     	  => 0,
  		'thumb_symlink'       => 0,
  	);

  	$result['count'] = count($list);

  	foreach ($list as $item) {

  	  $file_name = $item->getImg();

  	  if (!$file_name) {
  	    continue;
  	  }

  	  $full_path 	   = $item->getFullPath();
  	  $full_path_local = $item->getFullLocal();

  	  if ( $full_path && file_exists($full_path_local) ) {
  	  	$result['full_count']++;

  	  	$symlink_result = symlink('../'.$full_path."/".$file_name, sfConfig::get('sf_upload_dir')."/".NewsPeer::FULL_DIR."/".$file_name);
  	  	if ($symlink_result) {
  	  		$result['full_symlink']++;
  	  	}
  	  }

  	  $thumb_path 	  = $item->getThumbPath();
  	  $thumb_path_local = $item->getThumbLocal();

  	  if ( $thumb_path && file_exists($thumb_path_local) ) {
  	  	$result['thumb_count']++;

  	  	$symlink_result = symlink('../'.$thumb_path."/".$file_name, sfConfig::get('sf_upload_dir')."/".NewsPeer::THUMB_DIR."/".$file_name);
  	  	if ($symlink_result) {
  	  		$result['thumb_symlink']++;
  	  	}
  	  }
  	}
  	echo "<pre>";
  	print_r( $result );
  	exit();

  }

  public function executeAccelerator($request)
  {
    ob_start();

    /*** CONFIG ***/
    $auth = false;		// Set to false to disable authentication
    $user = "admin";
    $pw = "eAccelerator";

    $npp = 50;		// Number of records per page (script / key cache listings)

    /*** TODO for API / reporting / this script:
         + want script ttl from API
         + would be cool to have init_time for scripts (time of caching) - could then get hit rates etc.
    */

    // Inline media
    if (isset($_GET['img']) && $_GET['img']) {
        $img = strtolower($_GET['img']);
        $imgs['dnarr'][0] = 199;
        $imgs['dnarr'][1] = 'H4sIAAAAAAAAA3P3dLOwTORlEGBoZ2BYsP3Y0t0nlu85ueHQ2U1Hzu86efnguetHL968cPPBtbuPbzx4+vTV24+fv3768u3nr9+/f//59+/f////GUbBKBgWQPEnCzMDgyCDDogDyhMMHP4MyhwyHhsWHGzmENaKOSHAyMDAKMWTI/BAkYmDTU6oQuAhY2M7m4JLgcGDh40c7HJ8BQaBBw4z8bMaaOx4sPAsK7voDZ8GAadTzEqSXLJWBgoM1gBhknrUcgMAAA==';
        $imgs['uparr'][0] = 201;
        $imgs['uparr'][1] = 'H4sIAAAAAAAAA3P3dLOwTORlEGBoZ2BYsP3Y0t0nlu85ueHQ2U1Hzu86efnguetHL968cPPBtbuPbzx4+vTV24+fv3768u3nr9+/f//59+/f////GUbBKBgWQPEnCzMDgyCDDogDyhMMHIEMyhwyHhsWHGzmENaKOTFBoYWZgc/BYQVDw1EWdvGIOzsWJDAzinFHiBxIWNDMKMbv0sCR0NDMIcATofJB4RAzkxivg0OCoUNzIy9ThMuFDRqHGxisAZtUvS50AwAA';

        if (!$imgs[$img] || strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') === false)
            exit();

        header("Expires: ".gmdate("D, d M Y H:i:s", time()+(86400*30))." GMT");
        header("Last-Modified: ".gmdate("D, d M Y H:i:s", time())." GMT");
        header('Content-Length: '.$imgs[$img][0]);
        header('Content-Type: image/gif');
        header('Content-Encoding: gzip');

        echo base64_decode($imgs[$img][1]);
        exit();
    }

    // Authenticate before proceeding
    if ($auth && (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
            $_SERVER['PHP_AUTH_USER'] != $user || $_SERVER['PHP_AUTH_PW'] != $pw)) {
        header('WWW-Authenticate: Basic realm="eAccelerator control panel"');
        header('HTTP/1.0 401 Unauthorized');
        exit;
    }

    $sec = isset($_GET['sec']) ? (int)$_GET['sec'] : 0;

    // No-cache headers
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: no-store, no-cache, must-revalidate");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    function print_footer() {
        global $info;
        ?>
        </div>
        <div class="footer">
        <?php
        if (is_array($info)) {
        ?>
        <br/><br/>
            <hr style="width:500px; color: #cdcdcd" noshade="noshade" size="1" />
            <strong>Created by the eAccelerator team &ndash; <a href="http://eaccelerator.net">http://eaccelerator.net</a></strong><br /><br />
            eAccelerator <?php echo $info['version']; ?> [shm:<?php echo $info['shm_type']?> sem:<?php echo $info['sem_type']; ?>]<br />
            PHP <?php echo phpversion();?> [ZE <?php echo zend_version(); ?>]<br />
            Using <?php echo php_sapi_name();?> on <?php echo php_uname(); ?><br />
        <?php
        }
        ?>
        </div>
        <?php
    }

    if (!function_exists('eaccelerator_info')) {
        die('eAccelerator isn\'t installed or isn\'t compiled with info support!');
    }

    // formats sizes
    function format_size ($x) {
        $a = array('bytes', 'kb', 'mb', 'gb');
        $i = 0;
        while ($x >= 1024) {
            $i++;
            $x = $x / 1024;
        }
        return number_format($x, ($i > 0)?2:0, '.', ',').' '.$a[$i];
    }

    // Generates a simple & colourful horizontal bar graph. $x:$y is used:free
    function space_graph ($x, $y) {
        $colr = 183; $colg = 225; $colb = 149;	// #B7E195

        $colr = base_convert($colr + floor(($x/$y)*(50+exp($x*3/$y))), 10, 16);
        $colg = base_convert($colg - floor(($x/$y)*(100+exp($x*4/$y))), 10, 16);
        $colb = base_convert($colb - floor(($x/$y)*(70+exp($x*4/$y))), 10, 16);

        $s = '<table class="hgraph"><tr>';
        $s .= '<td class="hgraph_pri" style="width:'.floor(($x/$y)*100).'%">&nbsp;</td>';
        $s .= '<td class="hgraph_sec" style="background-color: #'.$colr.$colg.$colb.'; width:'.ceil(100 - ($x/$y)*100).'%">&nbsp;</td></tr></table>';
        return $s;
    }

    // Messy algorithm to generate neat page selectors
    function pageselstr ($pg, $pgs) {
        $pg += 1;
        $st = max(1, $pg - 2) - max(0, 2 - ($pgs - $pg));
        $nd = $pg + 2 + max(0, 3 - $pg);
        $d = $st - 1 - 1;
        if (abs($nd - $pg) > 2) $sp[] = $nd - 2;
        if (abs($pg - $st) > 2) $sp[] = $st + 2;
        if (($d-2)/3 >= 2) {
            $sp[] = (ceil($d/3)+1);
            $sp[] = (ceil($d/3)*2+1);
        }
        elseif (($d-1)/2 > 0) $sp[] = (ceil($d/2)+1);
        $d = $pgs - $nd - 1;
        if (($d-2)/3 >= 2) {
            $sp[] = (ceil($d/3)+$nd);
            $sp[] = (ceil($d/3)*2+$nd);
        }
        elseif (($d-1)/2 > 0) $sp[] = (ceil($d/2)+$nd);
        $sp[] = $st;$sp[] = $nd;$sp[] = $pg;$sp[] = 1;$sp[] = $pgs;
        $lp = 1;
        $pgstr = 'Page: ';
        if ($pgs < 1) $pgstr .= '-';
        for ($i = 1; $i <= $pgs; $i++) {
            if (in_array($i, $sp)) {
                if ($i - $lp <= 2 && $i > 2 && !in_array($i-1, $sp)) $pgstr .= '<a href="'.$_SERVER['PHP_SELF'].'?'.qstring_update(array('pg' => $i-2)).'">'.($i-1).'</a> ';
                if ($i - $lp > 2) $pgstr .= '..';
                if ($i == $pg) $pgstr .= ' ['.$i.'] ';
                else {
                    $pgstr .= ' <a href="'.$_SERVER['PHP_SELF'].'?'.qstring_update(array('pg' => $i-1)).'">'.$i.'</a> ';
                }
                $lp = $i;
            }
        }
        return $pgstr;
    }

    // Returns qstring with updated key / value pairs.
    function qstring_update ($arr) {
        $qs = '';
        $combo = array_merge($_GET, $arr);
        foreach ($combo as $a => $b) {
            if ($qs) $qs .= '&';
            $qs .= urlencode($a).'='.urlencode($b);
        }
        return $qs;
    }

    // Returns standard column headers for the lists
    function colheadstr ($nme, $id) {
        $cursrt = isset($_GET['ordby']) ? $_GET['ordby'] : 0;
        $srtdir = isset($_GET['dir']) ? $_GET['dir'] : "";
        return '<a href="'.$_SERVER['PHP_SELF'].'?'.qstring_update(array('ordby' => $id, 'dir' => ($cursrt == $id)?1-$srtdir:0)).'">'.$nme.'&nbsp;'.(($cursrt == $id)?'<img src="'.$_SERVER['PHP_SELF'].'?img='.(($srtdir)?'dnarr':'uparr').'" width="13" height="16" border="0" alt="'.(($srtdir)?'v':'^').'"/>':'');
    }

    // Array sorting callback function
    function arrsort ($a, $b) {
        global $ordby, $ordbystr;
        if ($ordbystr)
            $val = strnatcmp($a[$ordby], $b[$ordby]);
        else
            $val = ($a[$ordby] == $b[$ordby]) ? 0 : (($a[$ordby] < $b[$ordby]) ? -1: 1);
        if (isset($_GET['dir']) && $_GET['dir'])
            $val = -1*$val;
        return $val;
    }

    // Global info array
    $info = eaccelerator_info();

    ?>
    <style type="text/css" media="all">
        #sf_admin_container.accelerator_wrapper .head1 {background-color: #A9CFDD; width: 100%; font-size: 32px; color: #ffffff;padding-top: 20px;font-family: Tahoma, sans-serif;}
        #sf_admin_container.accelerator_wrapper .head1_item {padding-left: 15px;}
        #sf_admin_container.accelerator_wrapper .head2 {background-color: #62ADC2; width: 100%; font-size: 18px; color: #ffffff;text-align: right; font-family: Tahoma, sans-serif;border-top: #ffffff 2px solid;}
        #sf_admin_container.accelerator_wrapper .head2 a:link {color: #ffffff;}
        #sf_admin_container.accelerator_wrapper .head2 a:visited {color: #ffffff;}
        #sf_admin_container.accelerator_wrapper .head2 a:active {color: #ffffff;}
        #sf_admin_container.accelerator_wrapper .head2 a:hover {color: #000000;}

        #sf_admin_container.accelerator_wrapper .menuitem {padding-left: 15px;padding-right: 15px;}
        #sf_admin_container.accelerator_wrapper .menuitem_sel {padding-left: 15px;padding-right: 15px;background-color: #ffffff; color: #000000;}
        #sf_admin_container.accelerator_wrapper .menuitem_hov {padding-left: 15px;padding-right: 15px;cursor:pointer;color: #000000;}
        #sf_admin_container.accelerator_wrapper .mnbody {padding:15px; padding-top: 30px; margin-right: auto; margin-left: auto; text-align: center;bottom: 60px;}

        #sf_admin_container.accelerator_wrapper .mnbody table {border-collapse: collapse; margin-right: auto; margin-left: auto;}

        #sf_admin_container.accelerator_wrapper td {padding: 3px 10px 3px 10px; border: #ffffff 2px solid;vertical-align:top}
        #sf_admin_container.accelerator_wrapper .el {text-align: left;background-color: #e1eff8;}
        #sf_admin_container.accelerator_wrapper .er {text-align: right;background-color: #e1eff8;}
        #sf_admin_container.accelerator_wrapper .ec {text-align: center;background-color: #e1eff8;}

        #sf_admin_container.accelerator_wrapper .fl {text-align: left;background-color: #efefef;}
        #sf_admin_container.accelerator_wrapper .fr {text-align: right;background-color: #efefef;}

        #sf_admin_container.accelerator_wrapper .h {text-align: center; font-weight: bold;}
        #sf_admin_container.accelerator_wrapper .h a:link {color: #000000;}
        #sf_admin_container.accelerator_wrapper .h a:visited {color: #000000;}
        #sf_admin_container.accelerator_wrapper .h a:active {color: #ababab;}
        #sf_admin_container.accelerator_wrapper .h a:hover {color: #ababab;}

        #sf_admin_container.accelerator_wrapper .hgraph {width:100%;}
        #sf_admin_container.accelerator_wrapper .hgraph td {border: 0px;padding: 0px;}
        #sf_admin_container.accelerator_wrapper .hgraph_pri {background-color: #62ADC2;}
        #sf_admin_container.accelerator_wrapper .hgraph_sec {}


        #sf_admin_container.accelerator_wrapper .footer {width: 100%;text-align: center;font-size: 9pt;color: #ababab;}
        #sf_admin_container.accelerator_wrapper .footer a:link {color: #ababab;}
        #sf_admin_container.accelerator_wrapper .footer a:visited {color: #ababab;}
        #sf_admin_container.accelerator_wrapper .footer a:active {color: #000000;}
        #sf_admin_container.accelerator_wrapper .footer a:hover {color: #000000;}

        #sf_admin_container.accelerator_wrapper small {font-size: 10pt;}
        #sf_admin_container.accelerator_wrapper .s {color: #676767;}

    </style>

    <script type="text/javascript">
      function menusel(i) {
        if (i.className == "menuitem_hov") i.className = "menuitem";
        else if (i.className == "menuitem") i.className = "menuitem_hov";
      }
      function gosec(i) {
        document.location = "<?php echo $_SERVER['PHP_SELF']?>?sec="+i;
      }
    </script>

    <div class="head1"><span class="head1_item">eAccelerator control panel</span></div>
    <div class="head2">
    <?php
    $items = array(0 => 'Status', 1 => 'Script Cache');

    foreach ($items as $i => $item) {
        echo '<span class="menuitem'.(($sec == $i)?'_sel':'').'" onmouseover="menusel(this)" onmouseout="menusel(this)" onclick="gosec('.$i.')">'.(($sec != $i)?'<a href="'.$_SERVER['PHP_SELF'].'?sec='.$i.'">'.$item.'</a>':$item).'</span>';
    }
    ?>
    </div>
    <div class="mnbody">
    <?php
    switch ($sec) {
        default:
        case 0:
            /******************************     STATUS / CONTROL     ******************************/

            if (isset($_POST['cachingoff'])) eaccelerator_caching(false);
            if (isset($_POST['cachingon'])) eaccelerator_caching(true);

            if (isset($_POST['optoff']) && function_exists('eaccelerator_optimizer')) eaccelerator_optimizer(false);
            if (isset($_POST['opton']) && function_exists('eaccelerator_optimizer')) eaccelerator_optimizer(true);

            if (isset($_POST['mtimeoff'])) eaccelerator_check_mtime(false);
            if (isset($_POST['mtimeon'])) eaccelerator_check_mtime(true);

            if (isset($_POST['clear'])) eaccelerator_clear();
            if (isset($_POST['clean'])) eaccelerator_clean();
            if (isset($_POST['purge'])) eaccelerator_purge();

            $info = eaccelerator_info();

    ?>
    <table>
    <tr><td>

    <form action="<?php echo $_SERVER['PHP_SELF']?>?sec=0" method="post">
    <table>
    <tr>
        <td class="h" colspan="2">Usage statistics</td>
    </tr>
    <tr>
        <td class="er">Caching enabled</td>
        <td class="fl"><?php echo $info['cache'] ? '<span style="color:green"><b>yes</b></span>&nbsp;&nbsp;&nbsp;<input type="submit" name="cachingoff" value=" Disable "/>':'<span style="color:red"><b>no</b></span>&nbsp;&nbsp;&nbsp;<input type="submit" name="cachingon" value=" Enable "/>' ?></td>
    </tr>
    <tr>
        <td class="er">Optimizer enabled</td>
        <td class="fl"><?php echo $info['optimizer'] ? '<span style="color:green"><b>yes</b></span>&nbsp;&nbsp;&nbsp;<input type="submit" name="optoff" value=" Disable "/>':'<span style="color:red"><b>no</b></span>&nbsp;&nbsp;&nbsp;<input type="submit" name="opton" value=" Enable "/>' ?></td>
    </tr>
    <tr>
        <td class="er">Check mtime enabled</td>
        <td class="fl"><?php echo $info['check_mtime'] ? '<span style="color:green"><b>yes</b></span>&nbsp;&nbsp;&nbsp;<input type="submit" name="mtimeoff" value=" Disable "/>':'<span style="color:red"><b>no</b></span>&nbsp;&nbsp;&nbsp;<input type="submit" name="mtimeon" value=" Enable "/>' ?></td>
    </tr>
    <tr>
        <td class="er">Total memory</td>
        <td class="fl"><?php echo format_size($info['memorySize']); ?></td>
    </tr>
    <tr>
        <td class="er">Memory in use</td>
        <td class="fl"><?php echo format_size($info['memoryAllocated']).' ('.number_format(100 * $info['memoryAllocated'] / max(1, $info['memorySize']), 0).'%)';?></td>
    </tr>
    <tr>
        <td class="er" colspan="2"><?php echo space_graph($info['memoryAllocated'], $info['memorySize']);?></td>
    </tr>
    <tr>
        <td class="er">Free memory</td>
        <td class="fl"><?php echo format_size($info['memoryAvailable'])?></td>
    </tr>
    <tr>
        <td class="er">Cached scripts</td>
        <td class="fl"><?php echo number_format($info['cachedScripts']); ?></td>
    </tr>
    <tr>
        <td class="er">Removed scripts</td>
        <td class="fl"><?php echo number_format($info['removedScripts']); ?></td>
    </tr>
    </table>
    </form>

    </td><td>

    <table>
    <tr>
        <td class="h" colspan="2">Build information</td>
    </tr>
    <tr>
        <td class="er">eAccelerator version</td>
        <td class="fl"><?php echo $info['version']; ?></td>
    </tr>
    <tr>
        <td class="er">Shared memory type</td>
        <td class="fl"><?php echo $info['shm_type']; ?></td>
    </tr>
    <tr>
        <td class="er">Semaphore type</td>
        <td class="fl"><?php echo $info['sem_type']; ?></td>
    </tr>
    </table>

    </td></tr>
    </table>

    <br/><br/>

    <form action="<?php echo $_SERVER['PHP_SELF']?>?sec=0" method="post">
    <table>
    <tr>
        <td class="h" colspan="2">Maintenance</td>
    </tr>
    <tr>
        <td class="ec"><input type="submit" name="clear" value=" Clear cache "/></td>
        <td class="fl">Removed all scripts and data from shared memory and / or disk.</td>
    </tr>
    <tr>
        <td class="ec"><input type="submit" name="clean" value=" Delete expired "/></td>
        <td class="fl">Removed all expired scripts and data from shared memory and / or disk.</td>
    </tr>
    <tr>
        <td class="ec"><input type="submit" name="purge" value=" Purge cache "/></td>
        <td class="fl">Delete all 'removed' scripts from shared memory.</td>
    </tr>
    </table>
    </form>

    <?php
            break;
        case 1:
            /******************************     SCRIPT CACHE     ******************************/

            $scripts = eaccelerator_cached_scripts();
            $removed = eaccelerator_removed_scripts();

            // combine arrays
            function removedmod ($val) {
                $val['removed'] = true;
                return $val;
            }
            $scripts = array_merge($scripts, array_map('removedmod', $removed));

            // search
            function scriptsearch ($val) {
                $str = isset($_GET['str']) ? $_GET['str'] : '';
                return preg_match('/'.preg_quote($str, '/').'/i', $val['file']);
            }
            $scripts = array_filter($scripts, 'scriptsearch');

            // sort
            $ordby = isset($_GET['ordby']) ? intval($_GET['ordby']) : 0;
            switch ($ordby) {
                default:
                case 0: $ordby = 'file'; $ordbystr = true; break;
                case 1: $ordby = 'mtime'; $ordbystr = false; break;
                case 2: $ordby = 'ts'; $ordbystr = false; break;
                case 3: $ordby = 'ttl'; $ordbystr = false; break;
                case 4: $ordby = 'size'; $ordbystr = false; break;
                case 5: $ordby = 'reloads'; $ordbystr = false; break;
                case 6: $ordby = 'hits'; $ordbystr = false; break;
            }
            usort($scripts, 'arrsort');

            // slice
            $numtot = count($scripts);

            $pg = (isset($_GET['pg']) ? (int)$_GET['pg'] : 0); // zero-starting
            $pgs = ceil($numtot/$npp);

            if ($pg + 1 > $pgs)
                $pg = $pgs-1;
            if ($pg < 0)
                $pg = 0;

            $scripts = array_slice($scripts, $pg*$npp, $npp);
            $numres = count($scripts);
    ?>
    <table class="center">
    <tr>
        <td class="h" colspan="2">Search</td>
    </tr>
    <tr>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="get"><input type="hidden" name="sec" value="1"/>
        <td class="el">Match filename:</td>
        <td class="fl"><input type="text" name="str" size="40" value="<?php echo isset($_GET['str']) ? $_GET['str'] : '' ?>"/>&nbsp;<input type="submit" value=" Find "/></td>
        </form>
    </tr>
    </table>

    <br/><br/>

    <?php
            if (count($scripts) == 0)
                echo '<div class="center"><i>No scripts found</i></div>';
            else {
    ?>
    <table class="center">
    <tr>
        <td colspan="1" style="text-align: left">Showing <?php echo $pg*$npp+1?> &ndash; <?php echo $pg*$npp+min($npp, $numres)?> of <?php echo $numtot?></td>
        <td colspan="4" style="text-align: right;"><small><?php echo pageselstr($pg, $pgs)?></small></td>
    </tr>
    <tr>
        <td class="h"><?php echo colheadstr('File', 0)?></td>
        <td class="h"><?php echo colheadstr('Last Modified', 1)?></td>
        <td class="h"><?php echo colheadstr('Added', 2)?></td>
        <td class="h"><?php echo colheadstr('TTL', 3)?></td>
        <td class="h"><?php echo colheadstr('Size', 4)?></td>
        <td class="h"><?php echo colheadstr('Reloads', 5)?></td>
        <td class="h"><?php echo colheadstr('Hits', 6)?></td>
    </tr>
    <?php
                $disassembler = function_exists('eaccelerator_dasm_file');
                for ($i = 0; $i < $numres; $i++) {
                    $removed = (isset($scripts[$i]['removed']) && $scripts[$i]['removed']);
                    if ($disassembler && !$removed) {
                        $file_col = sprintf('<a href="dasm.php?file=%s">%s</a>', $scripts[$i]['file'], $scripts[$i]['file']);
                    } elseif ($removed) {
                        $file_col = sprintf('<span class="s">%s</span>', $scripts[$i]['file']);
                    } else {
                        $file_col = $scripts[$i]['file'];
                    }

                    if ($scripts[$i]['ttl'] != 0) {
                        $ttl_col = $scripts[$i]['ttl'] - time();
                        if ($ttl_col <= 0) {
                            $ttl_col = "expired";
                        }
                    } else {
                        $ttl_col = "&infin;";
                    }
    ?>
    <tr>
        <td class="el"><small><?php echo $file_col ?></small></td>
        <td class="fl"><small><?php echo date('Y-m-d H:i:s', $scripts[$i]['mtime'])?></small></td>
        <td class="fl"><small><?php echo date('Y-m-d H:i:s', $scripts[$i]['ts'])?></small></td>
        <td class="fr"><small><?php echo $ttl_col ?></small></td>
        <td class="fr"><small><?php echo format_size($scripts[$i]['size'])?></small></td>
        <td class="fr"><small><?php echo $scripts[$i]['reloads']?> (<?php echo $scripts[$i]['usecount']?>)</small></td>
        <td class="fr"><small><?php echo number_format($scripts[$i]['hits'])?></small></td>
    </tr>
    <?php
          }
    ?>
    <tr>
        <td colspan="1" style="text-align: left">&nbsp;</td>
        <td colspan="4" style="text-align: right;"><small><?php echo pageselstr($pg, ceil($numtot/$npp))?></small></td>
    </tr>
    </table>
    <?php
                }
                break;
        }

    print_footer();

    $this->content = ob_get_contents();
    ob_clean();
  }

  protected function addFiltersCriteria($c)
  {
if (isset($this->filters['show_is_empty']))
    {
      $criterion = $c->getNewCriterion(NewsPeer::SHOW, '');
      $criterion->addOr($c->getNewCriterion(NewsPeer::SHOW, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['show']) && $this->filters['show'] !== '')
    {
      $c->add(NewsPeer::SHOW, $this->filters['show']);
    }
    if (isset($this->filters['date_is_empty']))
    {
      $criterion = $c->getNewCriterion(NewsPeer::DATE, '');
      $criterion->addOr($c->getNewCriterion(NewsPeer::DATE, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['date']))
    {
      if (isset($this->filters['date']['from']) && $this->filters['date']['from'] !== '')
      {
        $criterion = $c->getNewCriterion(NewsPeer::DATE, date('Y-m-d', $this->filters['date']['from']), Criteria::GREATER_EQUAL);
      }
      if (isset($this->filters['date']['to']) && $this->filters['date']['to'] !== '')
      {
        if (isset($criterion))
        {
          $criterion->addAnd($c->getNewCriterion(NewsPeer::DATE, date('Y-m-d', $this->filters['date']['to']), Criteria::LESS_EQUAL));
        }
        else
        {
          $criterion = $c->getNewCriterion(NewsPeer::DATE, date('Y-m-d', $this->filters['date']['to']), Criteria::LESS_EQUAL);
        }
      }

      if (isset($criterion))
      {
        $c->add($criterion);
      }
    }

    // Title
    if (!empty($this->filters['title']))
    {
      $c->add(NewsI18nPeer::TITLE, '%'.$this->filters['title'].'%', Criteria::LIKE);
    }
    // Short body
    if (!empty($this->filters['shortbody']))
    {
      $c->add(NewsI18nPeer::SHORTBODY, '%'.$this->filters['shortbody'].'%', Criteria::LIKE);
    }
    // Body
    if (!empty($this->filters['body']))
    {
      $c->add(NewsI18nPeer::BODY, '%'.$this->filters['body'].'%', Criteria::LIKE);
    }
    // Extradate
    if (!empty($this->filters['extradate']))
    {
      $c->add(NewsI18nPeer::EXTRADATE, '%'.$this->filters['extradate'].'%', Criteria::LIKE);
    }
    // Author
    if (!empty($this->filters['author']))
    {
      $c->add(NewsI18nPeer::AUTHOR, '%'.$this->filters['author'].'%', Criteria::LIKE);
    }
    // Translated by
    if (!empty($this->filters['translated_by']))
    {
      $c->add(NewsI18nPeer::TRANSLATED_BY, '%'.$this->filters['translated_by'].'%', Criteria::LIKE);
    }
    // Link
    if (!empty($this->filters['link']))
    {
      $c->add(NewsI18nPeer::LINK, '%'.$this->filters['link'].'%', Criteria::LIKE);
    }
  }

}
