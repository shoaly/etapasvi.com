<?php

class CommentsPeer /*extends BaseCommentsPeer*/
{
	// для doCountWithI18n
	const COUNT_DISTINCT = 'COUNT(DISTINCT comments.ID)';

	const STATUS_VISIBLE = 0;
	const STATUS_HIDDEN  = 1;

	const DISQUS_EMBED  = 'http://etapasvi.disqus.com/embed.js';
	//const DISQUS_EMBED  = 'http://mediacdn.disqus.com/1299805542/build/system/embed.js';


	/**
	 * ID страницы для систем комментирования, пример:
	 * '/cs/photo/show/502'
	 *
	 * @return unknown
	 */
	public static function getCommentsIdentifier($culture = '', $module = '', $action = '', $parameters = array())
	{
		if (!$culture || !$module || !$action) {

			$sf_context  = sfContext::getInstance();
            if (!$culture) {
                $culture	 = $sf_context->getUser()->getCulture();
            }
		  	$module    	 = $sf_context->getModuleName();

			$action      = $sf_context->getActionName();

			// хардкод для подгружаемых фото
			if ( $module == 'photo' && ($action == 'content' || $action == 'albumcontent') ) {
			    $action = 'show';
			}

			if (empty($parameters['id'])) {
		  		$parameters  = array('id' => $sf_context->getRequest()->getParameter('id'));
			}
		}
		$identifier = 	'/' . $culture . '/' . $module . '/' . $action;
		foreach ($parameters as $k=>$v) {
			if ($v) {
				$identifier .= '/' . $k . '/' . $v;
			}
		}
		return $identifier;
	}

	/**
	 * Подготовка URL к выводу в disqus_url
	 *
	 * @return unknown
	 */
	public static function getCommentsPageUrl($comments_page_url = '') {
  	  // убираем всё что после ?
  	  $comments_page_url = preg_replace("/\?.*/", "", $comments_page_url) ;
  	  // подставляем домен
  	  $comments_page_url = preg_replace('/(http:\/\/)([^\/]+)(\/.*)/', '$1' . UserPeer::DOMAIN_NAME_MAIN . '$3', $comments_page_url);

  	  return $comments_page_url;
	}

}
