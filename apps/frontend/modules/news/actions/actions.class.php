<?php

/**
 * idea actions.
 *
 * @package    sf_sandbox
 * @subpackage idea
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class newsActions extends sfActions
{

  public function executeShow(sfWebRequest $request)
  {
  	$this->id 	 = $request->getParameter('id');
  	$this->title = $request->getParameter('title');

    $this->newsitem = NewsPeer::retrieveByPk( $this->id );

    if ( !$this->newsitem || !$this->newsitem->getShow()) {
      //sfActions::forward('default', 'error404');
      //@sfActions::forward404('123');
      throw new sfError404Exception();
    }

    if (!$this->newsitem->getBody()) {
      //sfActions::forward('default', 'error404');
      sfActions::forward('default', 'nottranslated');
      //sfActions::redirect('news', 'index');
      //$this->getContext()->getActionStack()->getLastEntry()->getActionInstance()->redirect('default/nottranslated');
      return false;
    }

    $newitem_url = $this->newsitem->getUrl();

    // если адрес новости неверный, редиректим на нужный адрес
    if (!ItemtypesPeer::isItemUrlValid($newitem_url)) {
      sfActions::redirect( $newitem_url );
    }

    // set attributes from revision if needed
    $this->from_revision = ItemtypesPeer::setItemFromRevision($this->newsitem);

	// установка заголовка страницы
	$news_title = $this->newsitem->getTitle();

    //$context = sfContext::getInstance();
    //$i18n =  $context->getI18N();

    //$title = $i18n->__('Dharma Sangha') . ' -';
    $response = $this->getResponse();
    $response->setTitle($news_title);
  }

  /**
   * Redirect to news
   *
   * @param sfWebRequest $request
   */
  public function executeTeachings(sfWebRequest $request)
  {
  	$this->redirect('news/show?id='.$request->getParameter('id'));
  }

  /**
   * Redirect to news
   *
   * @param sfWebRequest $request
   */
  public function executeStories(sfWebRequest $request)
  {
  	$this->redirect('news/show?id='.$request->getParameter('id'));
  }

  /**
   * Redirect to news
   *
   * @param sfWebRequest $request
   */
  public function executeBooks(sfWebRequest $request)
  {
  	$this->redirect('news/show?id='.$request->getParameter('id'));
  }

  /**
   * Redirect to news
   *
   * @param sfWebRequest $request
   */
  public function executeProjects(sfWebRequest $request)
  {
  	$this->redirect('news/show?id='.$request->getParameter('id'));
  }

  public function executePreview(sfWebRequest $request)
  {
  	$this->id 	 = $request->getParameter('id');
  	$this->title = $request->getParameter('title');
    $this->setTemplate('show');
  }

  /**
   * Список новостей
   *
   * @param sfWebRequest $request
   */
  public function executeIndex(sfWebRequest $request)
  {
  	// определение типа новости
	/*$this->type = $request->getParameter('type');
	if (!$this->type) {
	  $this->type = NewstypesPeer::$type_names[ NewstypesPeer::NEWS_TYPE_NEWS ];
	}*/

    $c = $this->getIndexCriteria();

	$pager = new sfPropelPagerI18n('News', NewsPeer::NEWS_PER_PAGE);
    $pager->setCriteriaI18n($c);
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->init();
    $this->pager = $pager;

    // check if Itemcategory exists
    $itemcategory = $this->getRequestParameter('itemcategory');
    if ($itemcategory && !ItemcategoryPeer::getByCode($itemcategory)) {
    	$this->forward404();
    }

    // если передан номер страницы больше, чем имеется страниц
    /*if ($request->getParameter('page') > $this->pager->getLastPage()) {
    	$this->forward404();
    }*/

    // установка типа в зависимости от типа
    $response = $this->getResponse();
	$response->setTitle(ucfirst($this->type));
  }

  /**
   * Получения условия для выбора списка новостей
   *
   * @return unknown
   */
  private function getIndexCriteria()
  {
    $c = new Criteria();
    $c->add( NewsPeer::SHOW, 1);
    //$c->add( NewsI18nPeer::BODY, '', Criteria::NOT_EQUAL );
    NewsPeer::addVisibleCriteria( $c );
    $c->addDescendingOrderByColumn( NewsPeer::ORDER );

    // take Itemcategory into account
    $itemcategory = $this->getRequestParameter('itemcategory');
    ItemcategoryPeer::getIndexCriteria($c, ItemtypesPeer::ITEM_TYPE_NEWS, $itemcategory);

    // на странице с типом News выводятся все новости
    /*$type = $this->getRequestParameter('type');
    if ( !empty($type) && $type != NewstypesPeer::$type_names[NewstypesPeer::NEWS_TYPE_NEWS]) {
        $c->addJoin( NewstypesPeer::ID, NewsPeer::TYPE );
        $c->add( NewstypesPeer::NAME, $type );
    }*/

    return $c;
  }

  public function executeMain(sfWebRequest $request)
  {
    $context = sfContext::getInstance();
    $i18n =  $context->getI18N();

    $response = $this->getResponse();
    $response->setTitle($i18n->__('Maha Sambodhi Dharma Sangha Guru') . ' - ' . $i18n->__('A message of peace, an appeal to the world'));
  }

  /**
   * RSS
   *
   * @param sfWebRequest $request
   */
  public function executeRss(sfWebRequest $request)
  {
  	$this->getResponse()->setHttpHeader('Content-type', 'text/xml; charset=UTF-8');

  	// получаем элементы в $this->feed_list
  	self::getFeed($request, true);

  	$user_culture = $this->getUser()->getCulture();

  	$this->link 			 = sfConfig::get('app_domain_name');
  	$this->last_build_date   = date( 'r', time());
  	$this->language          = UserPeer::getCultureIso( $user_culture );

  	$items = array();
	foreach ($this->feed_list as $group) {
	  foreach ($group['list'] as $item) {
	  	 $link    = $item->getRssLink();

	  	 // description
	  	 $description = $item->getRssDescription();
	  	 if ($group['type'] != ItemtypesPeer::ITEM_TYPE_NAME_PHOTO &&
	  	     $group['type'] != ItemtypesPeer::ITEM_TYPE_NAME_VIDEO && $description
	  	 ) {
	  	 	$description = $description . '...';
	  	 }

	     $items[] = array(
	       'title' 	     => $item->getRssTitle(),
	       'link'  	     => $link,
	       'guid'    	 => $link,
	       'description' => $description,
	       'pub_date'    => date("r", strtotime($item->getRssPubDate()))
	    );
	  }
	}

	$this->items = $items;
  }

  /**
   * Обновления
   *
   * @param sfWebRequest $request
   */
  public function executeFeed(sfWebRequest $request)
  {
    // check if Itemcategory exists
    $itemcategory = $this->getRequestParameter('itemcategory');
    if ($itemcategory && !ItemcategoryPeer::getByCode($itemcategory)) {
    	$this->forward404();
    }

	self::getFeed($request);
  }

  /**
   * Получение Ленты обновлений
   *
   * @param получение элементов для RSS $rss
   */
  public function getFeed( sfWebRequest $request, $rss = false )
  {
	$this->feed_list 	 = array();
	$limit_start 		 = 0;
	$feed_items_per_page = NewsPeer::FEED_ITEMS_PER_PAGE;
	// кол-во страниц влево и вправо от текущей
	$plus_digits 		 = 5;

	// навигация
	$this->page = (int)$request->getParameter('page');
	if ($this->page < 1) {
		$this->page = 1;
	}

	$con = Propel::getConnection();
 /*
SELECT
    id, item_type, updated_at
FROM (SELECT news.id, updated_at, 'News' as item_type FROM `news`, `news_i18n` WHERE news.SHOW=1 AND news_i18n.BODY<>'' and news_i18n.id = news.id
                       and news_i18n.culture = 'ru' UNION SELECT photo.id, updated_at, 'Photo' as item_type FROM `photo` WHERE photo.SHOW=1 AND photo.IMG<>'' AND photo.FULL_PATH<>'' AND photo.PREVIEW_PATH<>'' AND photo.THUMB_PATH<>'' UNION SELECT photo.id, updated_at, 'Photo' as item_type FROM `photo` WHERE photo.SHOW=1 AND photo.IMG<>'' AND photo.FULL_PATH<>'' AND photo.PREVIEW_PATH<>'' AND photo.THUMB_PATH<>'' UNION SELECT video.id, updated_at, 'Video' as item_type FROM `video`, `video_i18n` WHERE video.SHOW=1 AND video_i18n.CODE<>'' and video_i18n.id = video.id
                       and video_i18n.culture = 'ru' UNION SELECT audio.id, updated_at, 'Audio' as item_type FROM `audio` WHERE audio.SHOW=1 AND audio.REMOTE<>'' AND audio.FILE<>'') as feed
ORDER BY
    updated_at DESC
LIMIT 0, 50

	$sql = "SELECT SUM(".LetterBannerPeer::VIEWS.") AS view_total,
		SUM(".LetterBannerPeer::CLICKS.") AS click_total
		FROM ".LetterBannerPeer::TABLE_NAME."
		WHERE ".LetterBannerPeer::LETTER." = ?
		AND ".LetterBannerPeer::REGION_ID." = ?
		GROUP BY (".LetterBannerPeer::LETTER.")";*/

 	// Добавляем SELECT'ы выбора элементов
	$sub_query = '';
    $sub_query_counter = 0;
    $cur_culture = sfContext::getInstance()->getUser()->getCulture();

    $itemcategory = $request->getParameter('itemcategory');

    // добавляем в выборку каждый тип элемента
	foreach (NewsPeer::$feed_item_types as $type) {
	  $table_name 	= strtolower($type);
	  $item_type_id =  ItemtypesPeer::getItemTypeId($type);
	  $c = new Criteria();

	  $fn = array($type . 'Peer', 'addVisibleCriteria');

	  // take Itemcategory into account
	  if (!$rss) {
	    ItemcategoryPeer::getIndexCriteria($c, $item_type_id, $itemcategory);
	  }

	  try {
	    call_user_func( $fn, $c );

	    $criteria_string = $c->toString();

	  	// Criteria:
		// SQL (may not be complete): SELECT  FROM `news`, `news_i18n` WHERE news.SHOW=:p1 AND news_i18n.BODY<>:p2
		// Params: news.SHOW => 1, news_i18n.BODY => ''
	    if (!$criteria_string) {
	  	  continue;
	    }
	    $criteria_sql_list = explode("\n", $criteria_string);
	    $criteria_sql      = str_replace('SQL (may not be complete): ', '', $criteria_sql_list[1]);

	    // join clause
	    if ($rss && (constant($table_name . 'Peer::ALL_CULTURES') || in_array($table_name, array('photo', 'audio')))) {
	    	if (in_array($table_name, array('photo', 'audio'))) {
	    		$join_sql = "FROM {$table_name} LEFT JOIN {$table_name}_i18n ON ({$table_name}_i18n.ID = {$table_name}.ID
	    						AND ({$table_name}_i18n.CULTURE = '{$cur_culture}' OR {$table_name}_i18n.CULTURE = '" . sfConfig::get('sf_default_culture') . "')) ";
	    	} else {
	    		$join_sql = "FROM {$table_name} LEFT JOIN {$table_name}_i18n ON ({$table_name}_i18n.ID = {$table_name}.ID
	    						AND ({$table_name}_i18n.CULTURE = '{$cur_culture}' OR
	    						({$table_name}.ALL_CULTURES = 1 AND {$table_name}_i18n.CULTURE = '" . sfConfig::get('sf_default_culture') . "'))) ";
	    	}
	    } else {
	    	$join_sql = "FROM {$table_name} LEFT JOIN {$table_name}_i18n ON ({$table_name}_i18n.ID = {$table_name}.ID
	    		AND {$table_name}_i18n.CULTURE = '{$cur_culture}') ";
	    }

	    // filter by itemcategory
	    if (!$rss && $itemcategory) {
	        if ($table_name == 'photo') {
	          // instead of photoalbums photos are shown in Feed
	          $join_sql .= " INNER JOIN item2itemcategory ON ({$table_name}.PHOTOALBUM_ID=item2itemcategory.ITEM_ID AND item2itemcategory.ITEM_TYPE=" .
	                       ItemtypesPeer::ITEM_TYPE_PHOTOALBUM . ") ";
	        } else {
			  $join_sql .= " INNER JOIN item2itemcategory ON ({$table_name}.ID=item2itemcategory.ITEM_ID AND item2itemcategory.ITEM_TYPE={$item_type_id}) ";
	        }
	    }

	    $criteria_sql = preg_replace(
	    	'/FROM.*WHERE/',
	    	$join_sql . 'WHERE',
	    	$criteria_sql
	    );

	    // прописываем выбираемые параметры
	    $criteria_sql      = str_replace(
	    	'SELECT  FROM',
	    	"SELECT {$table_name}.id, if({$table_name}.updated_at > {$table_name}_i18n.updated_at_extra || {$table_name}_i18n.updated_at_extra is NULL,
	    	{$table_name}.updated_at, {$table_name}_i18n.updated_at_extra) as updated_at, '"
	    	. $type . "' as item_type FROM",
	    	$criteria_sql
		);

    	// items with ALL_CULTURE attribute are shown if item exists in the current language or ALL_CULTURES = 1
    	// photo and audio are shown always
    	if (constant($table_name . 'Peer::ALL_CULTURES')) {
    		if (!$rss) {
    			$criteria_sql .= " and ({$table_name}_i18n.culture = '" .  $cur_culture . "' OR " .
    						       constant($table_name . 'Peer::ALL_CULTURES') . " = 1) ";
    		}
    	} elseif (!in_array($table_name, array('photo', 'audio'))) {
    		$criteria_sql .= " and {$table_name}_i18n.culture = '" .  $cur_culture . "'";
    	}

	    // for RSS
	    if ($rss) {
	    	// ограничиваем по дате
	    	$min_date = date("Y-m-d H:i:s", strtotime(NewsPeer::RSS_PERIOD));
	    	$criteria_sql .= " and (updated_at >= '" . $min_date . "'
	    					  or {$table_name}_i18n.updated_at_extra >= '" . $min_date . "') ";
	    	// выбираются только элементы с заголовками
	    	$criteria_sql .= " and {$table_name}_i18n.title != '' ";
	    }
        // do not show Documents generated from News
        // do not show Teachings document
        if ($type == ItemtypesPeer::ITEM_TYPE_NAME_DOCUMENTS) {
            $criteria_sql .= " and ({$table_name}.news_id = '' or {$table_name}.news_id is NULL) ";
            $criteria_sql .= " and {$table_name}.file not like '" . sfConfig::get('app_domain_name') . "\_teachings\_%' ";
        }

	    // получаем значения параметров
	    preg_match_all("/ => ([^,]+)/", $criteria_sql_list[2], $criteria_params);
	    foreach ($criteria_params[1] as $i=>$param) {
	      $criteria_sql = str_replace(':p' . ($i + 1), $param, $criteria_sql);
	    }

	    $criteria_sql .= " GROUP BY {$table_name}.ID ";

	    if ($sub_query_counter > 0) {
	      $sub_query .= ' UNION ';
	    }
	    $sub_query .= $criteria_sql;
	  } catch (Exception $e) {
	  	continue;
	  }
	  $sub_query_counter++;
	}

	// подсчитываем кол-во
	$query_count = "
	 	SELECT count(*) as count
		FROM ({$sub_query}) as feed";
 	// выполняем сформированный запрос
 	try {
	  $stmt = $con->prepare($query_count);

	  // ограничиваем кол-во записей
	  //$stmt->bindValue(1, 0);
	  //$stmt->bindValue(2, 20);

	  if ($stmt->execute()) {
	    $count_items = $stmt->fetch();
	  }
 	} catch (Exception $e) {
 		//echo $e->getMessage();
		return;
	}

	// получение списка
	$query_list = "
	 	SELECT
		    id, item_type, updated_at
		FROM
			({$sub_query}) as feed
		ORDER BY
		    updated_at DESC";

	// для RSS используется ограничение по дате, поэтому не используем LIMIT
	if (!$rss) {
	  $this->count_items = $count_items['count'];
	  $this->last_page = ceil($count_items['count'] / $feed_items_per_page);
	  $limit_start 	 = ($this->page-1) * $feed_items_per_page;

	  $query_list .= "
	  	LIMIT {$limit_start}, {$feed_items_per_page}";
	}

 	// выполняем сформированный запрос
 	try {
	  $stmt = $con->prepare($query_list);

	  // ограничиваем кол-во записей
	  //$stmt->bindValue(1, 0);
	  //$stmt->bindValue(2, 20);

	  if ($stmt->execute()) {
	    $all_items = $stmt->fetchAll();
	  }
 	} catch (Exception $e) {
		return;
	}

	// группируем элементы по типам
	$grouped_items = array();

	foreach ($all_items as $i=>$item) {

	  if ($i != 0 && $item['item_type'] == $all_items[$i - 1]['item_type']) {
	    // добавляем в предыдущую группу
	    $grouped_items[ count($grouped_items) - 1 ]['list'][] = $item['id'];
	  } else {
	    // создаём новую группу
	    $grouped_items[] = array('type'=>$item['item_type'], 'list'=>array($item['id']));
	  }
	}

	// выбираем объекты из БД
	foreach ($grouped_items as $group) {
		// получаем тип элементов группы по первому элементу группы
		$type = $group['type'];

		// Использование строки, как имени статического класса позволяет только PHP > 5.3, поэтому хардкодим
		$c = new Criteria();
		$c->add( strtolower($type) . '.ID', $group['list'], Criteria::IN);
		//$c->addDescendingOrderByColumn( strtolower($type) . '.UPDATED_AT' );

		$fn = array($type . 'Peer', 'doSelectWithI18n');
	    try {
	      $list = call_user_func( $fn, $c );
	    } catch (Exception $e) {
	      //echo $e->getMessage();
	      continue;
	    }

	    // упорядочиваем элементы в списке по из ID
	    $list_sorted = array();
	    foreach ($group['list'] as $id) {
	    	foreach ($list as $list_item) {
	    		if ($list_item->getId() == $id) {
	    			$list_sorted[] = $list_item;
	    			break;
	    		}
	    	}
	    }

		$this->feed_list[] = array('type'=>$type, 'list'=>$list_sorted);
	}

	// список номеров страниц навигации - 5 влево и вправо от текущей страницы
	$this->page_numbers_list = array();
	for($i = $this->page - $plus_digits; $i < $this->page + $plus_digits; $i++) {
	  if ($i < 1) {
		continue;
	  }
	  if ($i > $this->last_page) {
		break;
	  }
	  $this->page_numbers_list[] = $i;
	}
  }

  /**
   * Forum
   *
   * @param sfWebRequest $request
   */
  public function executeForum(sfWebRequest $request)
  {

  }

  /**
   * Redirect to the route
   *
   * @param sfWebRequest $request
   */
  public function executeRedirect(sfWebRequest $request)
  {
    $this->redirect($this->generateUrl($request->getParameter('route')));
  }

}