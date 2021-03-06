<?php

class Audio extends BaseAudio
{
    /**
	 * Handle I18n DB fields in Admin Generator
	 *
	 * @param string $method
	 * @param mixed $arguments
	 * @return mixed
	 */
	public function __call($method, $arguments)
	{
	  $data = preg_split('/I18n/', $method, 2);

	  if( count($data) != 2 )
	  {
	    // original call for support sfPropelBehavior
	    return parent::__call($method, $arguments);
	  }

	  list( $method, $culture ) = $data;

	  if (4 == strlen($culture))
	  {
	    $culture = strtolower(substr($culture, 0, 2)) . '_' . strtoupper(substr($culture, 2, 2));
	  }
	  else
	  {
	    $culture = strtolower($culture);
	  }

	  $this->setCulture( $culture );

	  return call_user_func_array(array($this, $method), $arguments);
	}

	/**
	 * Расширенный метод для получения заголовка.
	 * Если $use_default_culture_if_empty, то возвращается значение на языке по умолчанию.
	 */
	public function getTitle($culture = null, $use_default_culture_if_empty = false)
	{
	  $title = parent::getTitle($culture);

	  if ($use_default_culture_if_empty) {
        if (!$title) {
          $title = $this->getTitle(sfConfig::get('sf_default_culture'));
        }
	  }
      return trim($title);
	}

	/**
	 * Расширенный метод для получения заголовка.
	 * Если $use_default_culture_if_empty, то возвращается значение на языке по умолчанию.
	 */
	public function getBody($culture = null, $use_default_culture_if_empty = false)
	{
	  $body = parent::getBody($culture);

	  if ($use_default_culture_if_empty) {
        if (!$body) {
          $body = $this->getBody(sfConfig::get('sf_default_culture'));
        }
	  }
      return trim($body);
	}

	/**
	 * Получение тела, подготовленного к выводу
	 *
	 * @return unknown
	 */
	public function getBodyPrepared($culture = null, $use_default_culture_if_empty = false) {
		return TextPeer::prepareText( $this->getBody($culture, $use_default_culture_if_empty), 1 );
	}

	/**
	 * Расширенный метод для получения автора.
	 * Если $use_default_culture_if_empty, то возвращается значение на языке по умолчанию.
	 */
	public function getAuthor($culture = null, $use_default_culture_if_empty = false)
	{
	  $author = parent::getAuthor($culture);

	  if ($use_default_culture_if_empty) {
        if (!$author) {
          $author = $this->getAuthor(sfConfig::get('sf_default_culture'));
        }
	  }
      return trim($author);
	}



	public function getDurationFormatted()
	{
      $duration = $this->getDuration() * 1.0;
      if (!$duration) {
      	return '00:00';
      }
      return sprintf("%02d:%02d", floor($duration), ($duration - floor($duration))*100);
	}
	
	/**
	 * Получение прямого адреса файла
	 *
	 * @return unknown
	 */
	public function getDirectUrl($remote = false)
	{
	  if ($remote) {
        return AudioPeer::REMOTE_URL . $this->getRemote();
	  } else {
	  	return 'http://' . sfConfig::get('app_domain_name') . AudioPeer::AUDIO_DIR . $this->getFile();
	  }
	}

    /**
     * Получение ссылки на аудиозапись
     */
	public function getUrl($culture = '') {

	  if (empty($culture)){
		$culture = sfContext::getInstance()->getUser()->getCulture();
	  }

      $url_pattern = 'audio/show?id=' . $this->getId();

	  $title_translit = TextPeer::urlTranslit($this->getTitle( $culture ), $culture );
	  if (!empty($title_translit)) {
	    $url_pattern .= '&title=' . $title_translit;
	  }

	  $url = sfContext::getInstance()->getController()->genUrl($url_pattern, true, $culture);
	  return $url;
	}


	/**
	 * Получение прямой ссылки для скачивания файла
	 *
	 * @return unknown
	 */
	public function getDownloadUrl()
	{
      return AudioPeer::REMOTE_DOWNLOAD_URL . $this->getRemote();
	}

	/**
	 * Заголовок для RSS
	 *
	 * @return unknown
	 */
	public function getRssTitle() {
	  $culture = sfContext::getInstance()->getUser()->getCulture();
	  $context = sfContext::getInstance();
	  $i18n    =  $context->getI18N();

	  return '[' . $i18n->__('Audio') . '] ' . $this->getAuthor($culture, true) . ' - ' . $this->getTitle($culture, true);
	}

	/**
	 * Ссылка для RSS
	 *
	 * @return unknown
	 */
	public function getRssLink() {
	  return $this->getUrl();
	}

	/**
	 * Описание для RSS
	 *
	 * @return unknown
	 */
	public function getRssDescription() {
	  return '';
	}

	/**
	 * Дата публикации для RSS.
	 *
	 * @return unknown
	 */
	public function getRssPubDate() {
	  return max($this->getUpdatedAt(), $this->getUpdatedAtExtra());
	}

	/**
	 * Get formatted size
	 *
	 * @param unknown_type $culture
	 * @param unknown_type $use_default_culture_if_empty
	 * @return unknown
	 */
	public function getSizePrepared() {
		$size = $this->getSize();

		$FS = array("B","kB","MB","GB","TB","PB","EB","ZB","YB");

		$size = (float)number_format($size/pow(1024, $I=floor(log($size, 1024))), ($I >= 1) ? 2 : 0) . ' ' . $FS[$I];

		return $size;
	}

	/**
	 * Retrieving IDs of Item Categories connected to item
	 *
	 */
	public function getItemcategoryIdList()
	{
	  $id_list = array();
	  $itemcategory_list = Item2itemcategoryPeer::getItemCategories(ItemtypesPeer::ITEM_TYPE_AUDIO, $this->getId());
	  foreach ($itemcategory_list as $itemcategory) {
	  	$id_list[] = $itemcategory->getId();
	  }

	  return $id_list;
	}

	/**
	 * Get item type name
	 *
	 * @return unknown
	 */
	public function getItemTypeName()
	{
		return ItemtypesPeer::ITEM_TYPE_NAME_AUDIO;
	}
}
