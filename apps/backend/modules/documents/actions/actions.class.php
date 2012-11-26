<?php

/**
 * audio actions.
 *
 * @package    sf_sandbox
 * @subpackage audio
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 5125 2007-09-16 00:53:55Z dwhittle $
 */
class documentsActions extends autodocumentsActions
{
  protected function updateDocumentsFromRequest()
  {
    $documents = $this->getRequestParameter('documents');
    
    // set change_updated_at
    $this->documents->setChangeUpdatedAt($documents['change_updated_at']);
    $documents_i18ns = $this->documents->getDocumentsI18ns();
    foreach ($documents_i18ns as $documents_i18n) {
    	$documents_i18n->setChangeUpdatedAt($documents['change_updated_at']);
    }
    
    if (isset($documents['created_at']))
    {
      if ($documents['created_at'])
      {
        try
        {
          $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                              if (!is_array($documents['created_at']))
          {
            $value = $dateFormat->format($documents['created_at'], 'I', $dateFormat->getInputPattern('g'));
          }
          else
          {
            $value_array = $documents['created_at'];
            $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
          }
          $this->documents->setCreatedAt($value);
        }
        catch (sfException $e)
        {
          // not a date
        }
      }
      else
      {
        $this->documents->setCreatedAt(null);
      }
    }
    if (isset($documents['news_id']))
    {
    $this->documents->setNewsId($documents['news_id'] ? $documents['news_id'] : null);
    }
    $this->documents->setShow(isset($documents['show']) ? $documents['show'] : 0);
    $currentFile = sfConfig::get('sf_upload_dir')."/documents/".$this->documents->getFile();
    if (!$this->getRequest()->hasErrors() && isset($documents['file_remove']))
    {
      $this->documents->setFile('');
      if (is_file($currentFile))
      {
        unlink($currentFile);
      }
    }

    if (!$this->getRequest()->hasErrors() && $this->getRequest()->getFileSize('documents[file]'))
    {
      //$fileName = md5($this->getRequest()->getFileName('documents[file]').time().rand(0, 99999));
      $fileName = $this->getRequest()->getFileName('documents[file]');      
      $ext = strtolower($this->getRequest()->getFileExtension('documents[file]'));
      $fileName = substr($fileName, 0, strlen($fileName) - strlen($ext));
      if (is_file($currentFile))
      {
        unlink($currentFile);
      }
      $this->getRequest()->moveFile('documents[file]', sfConfig::get('sf_upload_dir')."/documents/".$fileName.$ext);
      $this->documents->setFile($fileName.$ext);
    } else {
	  if (isset($documents['file']))
	  {
	    $this->documents->setFile($documents['file']);

	    // check if file exists
	    if (!file_exists(sfConfig::get('sf_upload_dir')."/documents/".$documents['file'])) {
	      $this->getUser()->setFlash('warning', 'Warning: File ' . $documents['file'] . ' not found.');
	    }
	  }
    }
    if (isset($documents['size']))
    {
      $this->documents->setSize($documents['size']);
    }
    if (isset($documents['order']))
    {
      $this->documents->setOrder($documents['order']);
    }
    $this->documents->setAllCultures(isset($documents['all_cultures']) ? $documents['all_cultures'] : 0);
    if (isset($documents['title_i18n_en']))
    {
      $this->documents->setTitleI18nEn($documents['title_i18n_en']);
    }
    if (isset($documents['body_i18n_en']))
    {
      $this->documents->setBodyI18nEn($documents['body_i18n_en']);
    }
    if (isset($documents['title_i18n_ru']))
    {
      $this->documents->setTitleI18nRu($documents['title_i18n_ru']);
    }
    if (isset($documents['body_i18n_ru']))
    {
      $this->documents->setBodyI18nRu($documents['body_i18n_ru']);
    }
    if (isset($documents['title_i18n_cs']))
    {
      $this->documents->setTitleI18nCs($documents['title_i18n_cs']);
    }
    if (isset($documents['body_i18n_cs']))
    {
      $this->documents->setBodyI18nCs($documents['body_i18n_cs']);
    }
    if (isset($documents['title_i18n_hu']))
    {
      $this->documents->setTitleI18nHu($documents['title_i18n_hu']);
    }
    if (isset($documents['body_i18n_hu']))
    {
      $this->documents->setBodyI18nHu($documents['body_i18n_hu']);
    }
    if (isset($documents['title_i18n_pl']))
    {
      $this->documents->setTitleI18nPl($documents['title_i18n_pl']);
    }
    if (isset($documents['body_i18n_pl']))
    {
      $this->documents->setBodyI18nPl($documents['body_i18n_pl']);
    }
    if (isset($documents['title_i18n_fr']))
    {
      $this->documents->setTitleI18nFr($documents['title_i18n_fr']);
    }
    if (isset($documents['body_i18n_fr']))
    {
      $this->documents->setBodyI18nFr($documents['body_i18n_fr']);
    }
    if (isset($documents['title_i18n_zh_cn']))
    {
      $this->documents->setTitleI18nZhCN($documents['title_i18n_zh_cn']);
    }
    if (isset($documents['body_i18n_zh_cn']))
    {
      $this->documents->setBodyI18nZhCN($documents['body_i18n_zh_cn']);
    }
    if (isset($documents['title_i18n_vi']))
    {
      $this->documents->setTitleI18nVi($documents['title_i18n_vi']);
    }
    if (isset($documents['body_i18n_vi']))
    {
      $this->documents->setBodyI18nVi($documents['body_i18n_vi']);
    }
    if (isset($documents['title_i18n_it']))
    {
      $this->documents->setTitleI18nIt($documents['title_i18n_it']);
    }
    if (isset($documents['body_i18n_it']))
    {
      $this->documents->setBodyI18nIt($documents['body_i18n_it']);
    }
    if (isset($documents['title_i18n_ja']))
    {
      $this->documents->setTitleI18nJa($documents['title_i18n_ja']);
    }
    if (isset($documents['body_i18n_ja']))
    {
      $this->documents->setBodyI18nJa($documents['body_i18n_ja']);
    }
    if (isset($documents['title_i18n_es']))
    {
      $this->documents->setTitleI18nEs($documents['title_i18n_es']);
    }
    if (isset($documents['body_i18n_es']))
    {
      $this->documents->setBodyI18nEs($documents['body_i18n_es']);
    }
    if (isset($documents['title_i18n_et']))
    {
      $this->documents->setTitleI18nEt($documents['title_i18n_et']);
    }
    if (isset($documents['body_i18n_et']))
    {
      $this->documents->setBodyI18nEt($documents['body_i18n_et']);
    }
    if (isset($documents['title_i18n_ne']))
    {
      $this->documents->setTitleI18nNe($documents['title_i18n_ne']);
    }
    if (isset($documents['body_i18n_ne']))
    {
      $this->documents->setBodyI18nNe($documents['body_i18n_ne']);
    }
    if (isset($documents['title_i18n_bn']))
    {
      $this->documents->setTitleI18nBn($documents['title_i18n_bn']);
    }
    if (isset($documents['body_i18n_bn']))
    {
      $this->documents->setBodyI18nBn($documents['body_i18n_bn']);
    }
    if (isset($documents['title_i18n_he']))
    {
      $this->documents->setTitleI18nHe($documents['title_i18n_he']);
    }
    if (isset($documents['body_i18n_he']))
    {
      $this->documents->setBodyI18nHe($documents['body_i18n_he']);
    }
    if (isset($documents['title_i18n_zh_tw']))
    {
      $this->documents->setTitleI18nZhTW($documents['title_i18n_zh_tw']);
    }
    if (isset($documents['body_i18n_zh_tw']))
    {
      $this->documents->setBodyI18nZhTW($documents['body_i18n_zh_tw']);
    }
    if (isset($documents['title_i18n_de']))
    {
      $this->documents->setTitleI18nDe($documents['title_i18n_de']);
    }
    if (isset($documents['body_i18n_de']))
    {
      $this->documents->setBodyI18nDe($documents['body_i18n_de']);
    }
    // clear cache of a changed item
    ClearcachePeer::processItem($this->documents);
  }
  
  /**
   * Save documents
   *
   * @param unknown_type $documents
   */
  protected function saveDocuments($documents)
  {
    $documents->save();

    // Process Item Categories
    $documents = $this->getRequestParameter('documents');
    if ($documents['itemcategory'] && $this->documents->getId()) {
      Item2itemcategoryPeer::updateItemCategories($documents['itemcategory'], ItemtypesPeer::ITEM_TYPE_DOCUMENTS, $this->documents->getId());
    }
  }
}
