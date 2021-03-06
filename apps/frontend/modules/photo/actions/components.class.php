<?php

class photoComponents extends sfComponents
{
  public function executeShow()
  {
  	$this->photo = PhotoPeer::retrieveByPk( $this->id );
    $this->short = true;
    $this->embed = true;
  }

  /**
   * Вывод превьюшного изображения
   *
   */
  public function executePreview()
  {
  	$this->photo = PhotoPeer::retrieveByPk( $this->id );
  }

  /**
   * Встраивание полной картинки
   *
   */
  public function executeEmbed()
  {
  	$this->photo = PhotoPeer::retrieveByPk( $this->id );
  }

  public function executeLatest()
  {
  	/*
  	$c = new Criteria();
    $c->add( PhotoPeer::SHOW, 1);
    $c->addDescendingOrderByColumn( PhotoPeer::ID );
  	$c->addGroupByColumn( PhotoPeer::PHOTOALBUM_ID );
    //$c->addAscendingOrderByColumn( PhotoPeer::ID );
  	//$c->setDistinct( PhotoPeer::PHOTOALBUM_ID );
  	//$c->addHaving($c->getNewCriterion(PhotoPeer::ID, PhotoPeer::ID.'= MAX('.PhotoPeer::ID.')', Criteria::CUSTOM));
  	$c->add(PhotoPeer::ID, PhotoPeer::ID.'= MAX('.PhotoPeer::ID.')', Criteria::CUSTOM);
    */

  	$photo_list = array();

    // выбираем первую
    $c = new Criteria();
    $c->add( PhotoPeer::SHOW, 1);
    $c->addJoin( PhotoalbumPeer::ID, PhotoPeer::PHOTOALBUM_ID);
    $c->add( PhotoalbumPeer::SHOW, 1);
    $c->addDescendingOrderByColumn( PhotoPeer::ID );
    $c->setLimit( 1 );
    $first_photo_list = PhotoPeer::doSelectWithI18n( $c );
    if (!$first_photo_list) {
    	$first_photo_list = PhotoPeer::doSelect( $c );
    }
    $photo_list[] = $first_photo_list[0];

    if (!empty($photo_list[0])) {
    	$prev_ids = array();
    	$prev_ids[] = $photo_list[0]->getPhotoalbumId();
        for($i=0; $i<PhotoPeer::LATEST_COUNT-1; $i++) {

		    $c = new Criteria();
		    $c->add( PhotoPeer::SHOW, 1);
            $c->addJoin( PhotoalbumPeer::ID, PhotoPeer::PHOTOALBUM_ID);
            $c->add( PhotoalbumPeer::SHOW, 1);
		    $c->add( PhotoPeer::PHOTOALBUM_ID, $prev_ids, Criteria::NOT_IN);

		    $c->addDescendingOrderByColumn( PhotoPeer::ID );
		    $c->setLimit( 1 );
		    $next_photo_list        = PhotoPeer::doSelectWithI18n( $c );
		    if (!$next_photo_list) {
		    	$next_photo_list = PhotoPeer::doSelect( $c );
		    }
		    if ($next_photo_list[0]) {
		        $prev_ids[]   = $next_photo_list[0]->getPhotoalbumId();
		    }
		    $photo_list[] = $next_photo_list[0];
        }
    }
    $this->photo_list = $photo_list;
      	/*
  	$c->setLimit( 3 );
  	$photo_list = PhotoPeer::doSelect( $c );

    if ($photo_list) {
      $this->photo_list = $photo_list;
    } */
  }

  public function executeShowwrapper($action)
  {
  	if (empty($this->photo)) {
	  $this->photo = PhotoPeer::retrieveByPk( $this->id );
  	}
  	//$this->forward404Unless( $this->photo );

  	// in album content we do not check and set title
  	if (!$this->no_check_title){
      if ($this->photo) {
  		$photoalbum = $this->photo->getPhotoalbum();
      }

      // если фото не найдено или фото скрыто и у него есть альбом
  	  if (!$this->photo || ($photoalbum && !$photoalbum->getShow()) || ($photoalbum && !$this->photo->getShow())) {
  		//$action->redirect( $this->photo );
  		//sfActions::forward('photo', 'index');
  		//@sfActions::forward('default', 'error404');
  		throw new sfError404Exception();
  	  }

  	  $photo_title = $this->photo->getTitle();
  	  if ( $photo_title ) {

        // check title in URL on full page only
        if (sfContext::getInstance()->getActionName() != 'content') {
          // если на траницу перешли с другого языка, то title неверный
          //$photo_title_translit = TextPeer::urlTranslit($photo_title);

          // чтобы в том случае, если со страницы фото был запрос за content и title изменился,
          // редиректить content на этот title не надо
//          if ( $this->title != $photo_title_translit) {
//            //$this->redirect( 'photo/show?id=' . (int)$this->id . '&title=' . $photo_title_translit );
//            //sfActions::redirect( 'photo/show?id=' . (int)$this->id . '&title=' . $photo_title_translit );
//            sfActions::redirect( $this->photo->getUrl() );
//          }
          if (!ItemtypesPeer::isItemUrlValid($this->photo->getUrl())) {
            sfActions::redirect( $this->photo->getUrl() );
          }
        }

	    $context = sfContext::getInstance();
	    $i18n =  $context->getI18N();

	    //$title = $i18n->__('Dharma Sangha') . ' -';
	    $response = $this->getResponse();
	    $response->setTitle($photo_title);
  	  } elseif (!$photo_title && $this->title) {
  		// если у элемента нет Заголовка, а в URL передан title, редиректим
  		//sfActions::redirect( $this->photo->getUrl() );
        if (!ItemtypesPeer::isItemUrlValid($this->photo->getUrl())) {
          sfActions::redirect( $this->photo->getUrl() );
        }
      }
  	}

    // set attributes from revision if needed
    $this->from_revision = ItemtypesPeer::setItemFromRevision($this->photo);

  	if (!empty($photoalbum)) {
  		$photoalbum_id = $photoalbum->getId();
  	}


  	// получение следующей и предыдущей фотографии
  	if (!$this->next_photo) {
  	  $c = new Criteria();
      $c->add( PhotoPeer::SHOW, 1);
      $c->add( PhotoPeer::ID, $this->photo->getId(), Criteria::NOT_EQUAL);
      if (!empty($photoalbum_id)) {
        $c->add( PhotoPeer::PHOTOALBUM_ID, $photoalbum_id);
      }
      $c->add( PhotoPeer::ORDER, $this->photo->getOrder(), Criteria::GREATER_EQUAL);
      $c->addAscendingOrderByColumn( PhotoPeer::ORDER );
      $this->next_photo = PhotoPeer::doSelectOne( $c );

      // пробуем получить первую фотографию в качестве следующей
      if (!$this->next_photo && !empty($photoalbum_id)) {
	  	$c = new Criteria();
	    $c->add( PhotoPeer::SHOW, 1);
	    $c->add( PhotoPeer::ID, $this->photo->getId(), Criteria::NOT_EQUAL);
	    $c->add( PhotoPeer::PHOTOALBUM_ID, $photoalbum_id);
	    $c->addAscendingOrderByColumn( PhotoPeer::ORDER );
	    $this->next_photo = PhotoPeer::doSelectOne( $c );
      }
  	}

  	if (!$this->prev_photo) {
  	  $c = new Criteria();
      $c->add( PhotoPeer::SHOW, 1);
      $c->add( PhotoPeer::ID, $this->photo->getId(), Criteria::NOT_EQUAL);
      if (!empty($photoalbum_id)) {
        $c->add( PhotoPeer::PHOTOALBUM_ID, $photoalbum_id);
      }
      $c->add( PhotoPeer::ORDER, $this->photo->getOrder(), Criteria::LESS_EQUAL);
      $c->addDescendingOrderByColumn( PhotoPeer::ORDER );
      $this->prev_photo = PhotoPeer::doSelectOne( $c );
      // получаем последнюю фото в качестве предыдущей
      if (!$this->prev_photo && !empty($photoalbum_id)) {
	  	$c = new Criteria();
	    $c->add( PhotoPeer::SHOW, 1);
	    $c->add( PhotoPeer::ID, $this->photo->getId(), Criteria::NOT_EQUAL);
	    $c->add( PhotoPeer::PHOTOALBUM_ID, $photoalbum_id);
	    $c->addDescendingOrderByColumn( PhotoPeer::ORDER );
	    $this->prev_photo = PhotoPeer::doSelectOne( $c );
      }
  	}
  }
}