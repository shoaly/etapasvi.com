<?php

class Photo extends BasePhoto
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

	public function __toString() {
		return $this->getTitle();
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
	 * Расширенный метод для получения текста.
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
	 * Расширенный метод для получения автора.
	 * Если $use_default_culture_if_empty, то возвращается значение на языке по умолчанию.
	 * Если у фото не указан автор, то ищется в Фотоальбоме
	 */
	public function getAuthor($culture = null, $use_default_culture_if_empty = false)
	{
	  $author     = parent::getAuthor($culture);

	  if ($use_default_culture_if_empty) {
	    $photoalbum = $this->getPhotoalbum();
	    $culture    = sfContext::getInstance()->getUser()->getCulture();

	    if ($this->getAuthor()) {
            $author = $this->getAuthor();
	    } elseif ($culture != sfConfig::get('sf_default_culture') && !$this->getAuthor() && $this->getAuthor(sfConfig::get('sf_default_culture'))) {
            $author = $this->getAuthor(sfConfig::get('sf_default_culture'));
	    } elseif ($culture != sfConfig::get('sf_default_culture') && $photoalbum && !$photoalbum->getAuthor() && $photoalbum->getAuthor(sfConfig::get('sf_default_culture'))) {
            $author = $photoalbum->getAuthor(sfConfig::get('sf_default_culture'));
	    } elseif ($photoalbum && $photoalbum->getAuthor()) {
            $author = $photoalbum->getAuthor();
	    } else {
            $author = '';
	    }
	  }
      return $author;
	}

	public function getCommentsCount()
	{
		return (int)CommentsPeer::getCommentsCount( ItemtypesPeer::ITEM_TYPE_NAME_PHOTO, $this->getId() );
	}
	public function getBodyPrepared() {
		/*$body = $this->getBody();
		$body = nl2br($body);
		$body = str_ireplace( '<br />', '&nbsp;</p><p>', $body );
		return $body;*/
		return TextPeer::prepareText( $this->getBody(sfContext::getInstance()->getUser()->getCulture(), true) );
	}
    public function getPreview()
    {
        return '/'.sfConfig::get('sf_upload_dir_name').'/photo/preview/'.$this->getImg();
    }
    public function getThumb()
    {
        return '/'.sfConfig::get('sf_upload_dir_name').'/photo/thumb/'.$this->getImg();
    }

    /**
     * Получение ссылки на фото
     */
	public function getUrl($culture = '') {
	  if (empty($culture)){
		$culture = sfContext::getInstance()->getUser()->getCulture();
	  }

      $url_pattern = 'photo/show?id=' . $this->getId();

	  $title_translit = TextPeer::urlTranslit($this->getTitle( $culture ), $culture );
	  if (!empty($title_translit)) {
	    $url_pattern .= '&title=' . $title_translit;
	  }

	  $url = sfContext::getInstance()->getController()->genUrl($url_pattern, true, $culture);
	  return $url;
	}

    /**
     * Получение ссылки на изображение
     */
	public function getFullUrl($constraints = array(), $embed_title_in_src = true) {
	  $path = $this->getFullPath();
	  $file = $this->getImg();

	  if ($path && $file) {
	    //return PhotoPeer::remoteStorageGetUrl( $this->getThumbPath(), $this->getImg() );
	    //return UserPeer::SITE_123PROTOCOL . '://' . $_SERVER['HTTP_HOST'] . '/' . UploadPeer::DIR . '/' . PhotoPeer::PHOTO_DIR . '/' . $path . '/' . $file;

	    $picasa_dimention = '';
	    $max_dimention = $this->getMaxDimention();
	    if ($constraints) {
	      // fit image size
	      if ($this->getWidth() > $this->getHeight()) {
	        // horizonral image
	        if ($constraints['max_width'] && $this->getWidth() > $constraints['max_width']) {
	          $max_dimention = $constraints['max_width'];
	          $new_height = floor(($this->getHeight() * $constraints['max_width']) / $this->getWidth());
	        }
	        if ($constraints['min_height'] && $new_height < $constraints['min_height']) {
	          // set height to min_height
	          $max_dimention = floor(($this->getWidth() * $constraints['min_height']) / $this->getHeight());
	        }
	      } else {
	        // vertical image
	        if ($constraints['max_width'] && $this->getWidth() > $constraints['max_width']) {
	          // calculate new height
	          $max_dimention = floor(($this->getHeight() * $constraints['max_width']) / $this->getWidth());
	        }
	        if ($constraints['min_height'] && $max_dimention < $constraints['min_height']) {
	          // set height to min_height
	          $max_dimention = floor(($this->getWidth() * $constraints['min_height']) / $this->getHeight());
	        }
	      }
	    }
	    if ($max_dimention > PhotoPeer::PICASA_MAX_DIMENTION) {
	      $max_dimention = PhotoPeer::PICASA_MAX_DIMENTION;
	    }
	    if ($max_dimention) {
	    	$picasa_dimention = '/s' . $max_dimention;
	    }

        if ($embed_title_in_src) {
            $file = $this->embedTitleInSrc($file);
        }

	    return PhotoPeer::REMOTE_STORAGE_URL . $path . $picasa_dimention . '/' . $file;
	  } else {
	    return '';
	  }
	}

    /**
     * Получение ссылки на изображение
     */
	public function getPreviewUrl($embed_title_in_src = true) {
	  $path = $this->getPreviewPath();
	  $file = $this->getImg();

	  if ($path && $file) {
	    //return PhotoPeer::remoteStorageGetUrl( $this->getThumbPath(), $this->getImg() );
	    //return UserPeer::SITE_123PROTOCOL . '://' . $_SERVER['HTTP_HOST'] . '/' . UploadPeer::DIR . '/' . PhotoPeer::PHOTO_DIR . '/' . $path . '/' . $file;
	    $picasa_dimention = '/s' . PhotoPeer::IMG_PREVIEW_WIDTH;

        if ($embed_title_in_src) {
            $file = $this->embedTitleInSrc($file);
        }

	    return PhotoPeer::REMOTE_STORAGE_URL . $path . $picasa_dimention . '/' . $file;
	  } else {
	    return '';
	  }
	}

    /**
     * Получение ссылки на изображение
     */
	public function getThumbUrl($embed_title_in_src = true) {
	  $path = $this->getThumbPath();
	  $file = $this->getImg();

	  if ($path && $file) {
	    //return PhotoPeer::remoteStorageGetUrl( $this->getThumbPath(), $this->getImg() );
	    //return UserPeer::SITE_123PROTOCOL . '://' . $_SERVER['HTTP_HOST'] . '/' . UploadPeer::DIR . '/' . PhotoPeer::PHOTO_DIR . '/' . $path . '/' . $file;

        if ($embed_title_in_src) {
            $file = $this->embedTitleInSrc($file);
        }

	    return PhotoPeer::REMOTE_STORAGE_URL . $path . '/' . $file;
	  } else {
	    return '';
	  }
	}

    /**
     * Получение локального пути к изображению
     */
	public function getFullLocal() {
	  $path = $this->getFullPath();
	  $file = $this->getImg();

	  if ($path && $file) {
	    return sfConfig::get('sf_upload_dir') . "/photo/" . $path . "/" . $file;
	  } else {
	    return '';
	  }
	}

    /**
     * Получение локального пути к изображению
     */
	public function getPreviewLocal() {
	  $path = $this->getPreviewPath();
	  $file = $this->getImg();

	  if ($path && $file) {
	    return sfConfig::get('sf_upload_dir') . "/photo/" . $path . "/" . $file;
	  } else {
	    return '';
	  }
	}

    /**
     * Получение локального пути к изображению
     */
	public function getThumbLocal() {
	  $path = $this->getThumbPath();
	  $file = $this->getImg();

	  if ($path && $file) {
	    return sfConfig::get('sf_upload_dir') . "/photo/" . $path . "/" . $file;
	  } else {
	    return '';
	  }
	}

	/**
	 * Заголовок для RSS
	 *
	 * @return unknown
	 */
	public function getRssTitle() {
	  $context = sfContext::getInstance();
	  $i18n    =  $context->getI18N();

	  return '[' . $i18n->__('Photo') . '] ' . $this->getTitle(null, true);
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
	  //return TextPeer::subStr($this->getBody(), NewsPeer::RSS_DESCRIPTION_LENGTH);
	  return '<img src="' . $this->getPreviewUrl() . '">';
	}

	/**
	 * Дата публикации для RSS
	 *
	 * @return unknown
	 */
	public function getRssPubDate() {
	  return max($this->getUpdatedAt(), $this->getUpdatedAtExtra());
	}

	/**
	 * Расширенный метод получения даты.
	 * Если передан $derive_from_photoalbum = true, и у фото не установлена дата, дата берётся из фотоальбома.
	 * Get the [optionally formatted] temporal [created_at] column value.
	 *
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCreatedAt($format = 'Y-m-d H:i:s', $derive_from_photoalbum = false)
	{
	    $created_at = parent::getCreatedAt($format);

	    // если дата не уставнолена, берём из фотоальбома
	    if ($derive_from_photoalbum && empty($created_at)) {
	        $photoalbum = $this->getPhotoalbum();
	        if ($photoalbum) {
	            $created_at = $photoalbum->getCreatedAt();
	        }
	    }

	    return $created_at;
	}

	/**
	 * Получение максимального из значений Ширины и Высоты
	 *
	 * @return unknown
	 */
	public function getMaxDimention() {
	  return max($this->getWidth(), $this->getHeight());
	}

	/**
	 * Get minimum dimention
	 *
	 * @return unknown
	 */
	public function getMinDimention() {
	  return min($this->getWidth(), $this->getHeight());
	}

	/**
	 * Get item type name
	 *
	 * @return unknown
	 */
	public function getItemTypeName()
	{
		return ItemtypesPeer::ITEM_TYPE_NAME_PHOTO;
	}

    /**
     * Before first dot embed transliterated title
     *
     * @param type $file
     */
    public function embedTitleInSrc($file)
    {
        $title_translit = TextPeer::urlTranslit($this->getTitle());
        if (!$title_translit) {
            return $file;
        }

        // before first dot we embed transliterated title
        return str_replace('.', '-' . $title_translit . '.', $file);
    }
}
