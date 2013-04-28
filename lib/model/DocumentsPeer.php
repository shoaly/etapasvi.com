<?php

require 'lib/model/om/BaseDocumentsPeer.php';


/**
 * Skeleton subclass for performing query and update operations on the 'documents' table.
 *
 *
 *
 * This class was autogenerated by Propel 1.4.2
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class DocumentsPeer extends BaseDocumentsPeer {

  // число элементов в блоке Последнее
  const LATEST_COUNT 			= 3;
  // количество элементов в списке
  const ITEMS_PER_PAGE 			= 30;

  // ссылка на файл в удалённом хранилище
  //const REMOTE_URL 		= 'http://k002.kiwi6.com/uploads/hotlink/';
  const DOCUMENTS_DIR 		= 'documents';

  const CREATE_FROM_HTML_FILE_EXTENSION = 'docx';

  const ORDER_INCREMENT = 1000;

  // ссылка на скачивание из удалённого хранилища
  //const REMOTE_DOWNLOAD_URL		= 'http://k002.kiwi6.com/download/';

  /**
   * Добавляет условие, при котором элемент отображается на языке пользователя
   *
   * @param unknown_type $c
   */
  public static function addVisibleCriteria($c)
  {
    $c->add( DocumentsPeer::SHOW, 1 );
    $c->add( DocumentsPeer::FILE, '', Criteria::NOT_EQUAL );

    $culture = sfContext::getInstance()->getUser()->getCulture();

    $c_extra = $c->getNewCriterion(DocumentsI18nPeer::TITLE, '', Criteria::NOT_EQUAL);
    $c_extra->addAnd( $c->getNewCriterion(DocumentsI18nPeer::CULTURE, $culture) );

    $c_extra->addOr( $c->getNewCriterion(DocumentsPeer::ALL_CULTURES, 1) );

	$c->add($c_extra);
  }

  /**
   * Для RSS: добавляет условие, при котором элемент отображается на языке пользователя
   *
   * @param unknown_type $c
   */
  public static function addRssVisibleCriteria($c)
  {
    self::addVisibleCriteria($c);
  }

  /**
   * Add new document
   *
   * @param unknown_type $title
   * @param unknown_type $show
   * @param unknown_type $file
   * @param unknown_type $all_cultures
   * @param unknown_type $news_id
   */
  public static function add($culture, $title, $show = 1, $file, $all_cultures = false, $news_id = '')
  {
  	$document = new Documents();

    $document->setCulture($culture);
    $document->setTitle($title);
    $document->setShow($show);
  	$document->setFile($file);
  	$document->setAllCultures($all_cultures);
  	$document->setNewsId($news_id);

  	// determine size
  	$size = number_format(filesize(sfConfig::get('sf_upload_dir').'/'.self::DOCUMENTS_DIR.'/'.$file), 2, '.', '');
  	$document->setSize($size);

  	// determine order
  	$criteria = new Criteria();
  	$criteria->addDescendingOrderByColumn(DocumentsPeer::ORDER);

  	$last_document = DocumentsPeer::doSelectOne($criteria);

  	$document->setOrder($last_document->getOrder() + self::ORDER_INCREMENT);

  	try {
  	  $document->save();
  	  return $document;
  	} catch(Exception $e) {
  	  return false;
  	}
  }

  /**
   * Create document from given HTML rewriting exsiting file
   *
   * @param unknown_type $c
   */
  public static function createFromHtml($html, $title, $item_id, $culture, $item_type_id, $file_name = '', $clear_cache = true)
  {
    if (!$file_name) {
      $file_name = strtolower(ItemtypesPeer::$item_type_names[ $item_type_id ]) . '_' . $item_id;
    }

  	$file = sfConfig::get('app_domain_name').'_'.$file_name.'_'.$culture.'.'.self::CREATE_FROM_HTML_FILE_EXTENSION;

  	$file_path =  sfConfig::get('sf_upload_dir').'/'.DocumentsPeer::DOCUMENTS_DIR.'/'.$file;

  	self::saveHtmlToDocx($html, $file_path);

  	// create document record
  	$add_result = false;

  	// get document generated for the given item
  	$criteria = new Criteria();
  	$criteria->add(DocumentsPeer::NEWS_ID, $item_id);
  	$criteria->add(DocumentsI18nPeer::CULTURE, $culture);
  	$document_list = DocumentsPeer::doSelectWithI18n($criteria);
  	$document = $document_list[0];
  	if ($document) {
  	  // update
  	  $document->setCulture($culture);
  	  $document->setTitle($title);
  	  $document->setFile($file);
  	  $size = number_format(filesize($file_path), 2, '.', '');
  	  $document->setSize($size);
  	  try {
  	    $add_result = $document->save();
  	  } catch(Exception $e) {
  	    $add_result = false;
  	  }
  	} else {
  	  // insert
  	  $document = self::add($culture, $title, 1, $file, false, $item_id);
  	}

	if (!$document) {
	  return false;
	}
    // add a record into Item2item
    try {
    	$item2item = new Item2item();
    	$item2item->setItem1Id($item_id);
    	$item2item->setItem1Type(ItemtypesPeer::ITEM_TYPE_NEWS);
    	$item2item->setItem2Id($document->getId());
    	$item2item->setItem2Type(ItemtypesPeer::ITEM_TYPE_DOCUMENTS);
    	$item2item->save();
    } catch(Exception $e) {}

    // clear cache
    if ($clear_cache) {
	  sfSuperCache::clearCacheOfItem(
	    $document->getId(),
	    ItemtypesPeer::ITEM_TYPE_NAME_DOCUMENTS,
	    $culture
	  );
    }

    return $document->getId();
  }

  /**
   * Save HTML to Docs file
   *
   * @param unknown_type $html
   * @param unknown_type $file_path
   */
  public static function saveHtmlToDocx($html, $file_path)
  {
	// Load the files we need:
	require_once(sfConfig::get('sf_lib_dir') . '/PHPWord/PHPWord.php');
	require_once(sfConfig::get('sf_lib_dir') . '/htmltodocx/simplehtmldom/simple_html_dom.php');
	require_once(sfConfig::get('sf_lib_dir') . '/htmltodocx/htmltodocx_converter/h2d_htmlconverter.php');
	// require_once 'example_files/styles.inc';

    // Set of default styles -
    // to set initially whatever the element is:
    // NB - any defaults not set here will be provided by PHPWord.
    $styles['default'] = array (
      'size' => 11,
    );
    // Element styles:
    // The keys of the elements array are valid HTML tags;
    // The arrays associated with each of these tags is a set
    // of PHPWord style definitions.
    $styles['elements'] = array (
      'h1' => array (
        'bold' => TRUE,
        'size' => 20,
        ),
      'h2' => array (
        'bold' => TRUE,
        'size' => 15,
        'spaceAfter' => 150,
        ),
      'h3' => array (
        'size' => 12,
        'bold' => TRUE,
        'spaceAfter' => 100,
        ),
      'li' => array (
        ),
      'ol' => array (
        'spaceBefore' => 200,
        ),
      'ul' => array (
        'spaceAfter' => 150,
        ),
      'b' => array (
        'bold' => TRUE,
        ),
      'em' => array (
        'italic' => TRUE,
        ),
      'i' => array (
        'italic' => TRUE,
        ),
      'strong' => array (
        'bold' => TRUE,
        ),
      'b' => array (
        'bold' => TRUE,
        ),
      'sup' => array (
        'superScript' => TRUE,
        'size' => 6,
        ), // Superscript not working in PHPWord
      'u' => array (
        'underline' => PHPWord_Style_Font::UNDERLINE_SINGLE,
        ),
      'a' => array (
        'color' => '0000FF',
        'underline' => PHPWord_Style_Font::UNDERLINE_SINGLE,
        ),
      'table' => array (
        // Note that applying a table style in PHPWord applies the relevant style to
        // ALL the cells in the table. So, for example, the borderSize applied here
        // applies to all the cells, and not just to the outer edges of the table:
        'borderColor' => '000000',
        'borderSize' => 10,
        ),
      'th' => array (
        'borderColor' => '000000',
        'borderSize' => 10,
        ),
      'td' => array (
        'borderColor' => '000000',
        'borderSize' => 10,
        ),
    );
    // Classes:
    // The keys of the classes array are valid CSS classes;
    // The array associated with each of these classes is a set
    // of PHPWord style definitions.
    // Classes will be applied in the order that they appear here if
    // more than one class appears on an element.
    $styles['classes'] =
      array (
      'underline' => array (
        'underline' => PHPWord_Style_Font::UNDERLINE_SINGLE,
        ),
       'purple' => array (
        'color' => '901391',
       ),
       'green' => array (
        'color' => '00A500',
       ),
    );
    // Inline style definitions, of the form:
    // array(css attribute-value - separated by a colon and a single space => array of
    // PHPWord attribute value pairs.
    $styles['inline'] = array(
      'text-decoration: underline' => array (
        'underline' => PHPWord_Style_Font::UNDERLINE_SINGLE,
      ),
      'vertical-align: left' => array (
        'align' => 'left',
      ),
      'vertical-align: middle' => array (
        'align' => 'center',
      ),
      'vertical-align: right' => array (
        'align' => 'right',
      ),
    );

	// New Word Document:
	$phpword_object = new PHPWord();
	$section = $phpword_object->createSection();

	// HTML Dom object:
	$html_dom = new simple_html_dom();
	$html_dom->load('<html><body>' . $html . '</body></html>');
	// Note, we needed to nest the html in a couple of dummy elements.

	// Create the dom array of elements which we are going to work on:
	$html_dom_array = $html_dom->find('html',0)->children();

	// Provide some initial settings:
	$initial_state = array(
	  // Required parameters:
	  'phpword_object' 					=> $phpword_object, // Must be passed by reference.
	  // 'base_root' => 'http://test.local', // Required for link elements - change it to your domain.
	  // 'base_path' => '/htmltodocx/documentation/', // Path from base_root to whatever url your links are relative to.
	  'base_root' 						=> 'http://'.sfConfig::get('app_domain_name'),
	  'base_path' 						=> '/',
	  // Optional parameters - showing the defaults if you don't set anything:
	  'current_style' 					=> array('size' => '11'), // The PHPWord style on the top element - may be inherited by descendent elements.
	  'parents' 						=> array(0 => 'body'), // Our parent is body.
	  'list_depth' 						=> 0, // This is the current depth of any current list.
	  'context' 						=> 'section', // Possible values - section, footer or header.
	  'pseudo_list' 					=> TRUE, // NOTE: Word lists not yet supported (TRUE is the only option at present).
	  'pseudo_list_indicator_font_name' => 'Wingdings', // Bullet indicator font.
	  'pseudo_list_indicator_font_size' => '7', // Bullet indicator size.
	  'pseudo_list_indicator_character' => 'l ', // Gives a circle bullet point with wingdings.
	  'table_allowed'					=> TRUE, // Note, if you are adding this html into a PHPWord table you should set this to FALSE: tables cannot be nested in PHPWord.
	  'treat_div_as_paragraph' => TRUE, // If set to TRUE, each new div will trigger a new line in the Word document.
	  // Optional - no default:
	  'style_sheet' => $styles,
	  );

	// Convert the HTML and put it into the PHPWord object
	htmltodocx_insert_html($section, $html_dom_array[0]->nodes, $initial_state);

	// Clear the HTML dom object:
	$html_dom->clear();
	unset($html_dom);

	// Save File
	$objWriter = PHPWord_IOFactory::createWriter($phpword_object, 'Word2007');
	$objWriter->save($file_path);
  }

} // DocumentsPeer

