<?php
/**
 * Класс сначала относился к модели User.
 * Потом модель стала не нужна, и стал использоваться самостоятельно.
 *
 */

class UserPeer /* extends BaseUserPeer*/
{
	const SERVERS_FRONTENDS = 'frontends';
	const SERVERS_BACKENDS  = 'backends';

	// почтовый адрес
	const MAIL_ADDRESS     = 'info@etapasvi.com';
	const EMAIL_PREFIX     = '[etapasvi mail]';

	const ALL_CULTURES  = 'all';

	// языки
	static protected $cultures = array(

		'en' => array('name'    			 => 'English',
					  'en_name'    			 => 'English',
		              'iso'     			 => 'en',
		              //http://us2.admin.mailchimp.com/lists/settings/?id=428077
		              //'mail_id' 			 => '39719cc12b',
		              // категория Disqus
		              'comments_category_id' => 668704,
		              // язык интерфейса FeedBurner
		              'feedburner_loc' 		 => 'en_US',
		              'twitter' 		 	 => 'etapasvi',
		              'fb_group' 		 	 => 'etapasvi.en',
		              'google_group' 		 => 'maha-sambodhi-dharma-sangha-',
		              'blessing_ln' 		 => '',
                               // https://www.paypalobjects.com/pl_PL/PL/i/btn/btn_subscribeCC_LG.gif
                               // https://www.paypalobjects.com/zh_CN/i/btn/btn_donateCC_LG.gif
		              'paypal_button' 		 => 'en_US'
		),
		'ru' => array('name'    			 => 'Русский',
					  'en_name'    			 => 'Russian',
		              'iso'     			 => 'ru',
		              //'mail_id' 			 => '25b1a7f858',
		              'comments_category_id' => 686465,
		              'feedburner_loc' 		 => 'ru_RU',
		              'fb_group' 		 	 => 'pages/eTapasvicom-ru-%D0%A0%D1%83%D1%81%D1%81%D0%BA%D0%B8%D0%B9/367816743307548',
		              'blessing_ln' 		 => 'ru-RU',
                              'paypal_button' 		 => 'ru_RU/RU'
		),
		'cs' => array('name'    			 => 'Čeština',
					  'en_name'    			 => 'Czech',
		              'iso'     			 => 'cz',
		              'comments_category_id' => 686584,
		              'feedburner_loc' 		 => '',
		              'fb_group' 		 	 => 'pages/eTapasvicom-cz-%C4%8Ce%C5%A1tina/217592821707394',
		              'google_group' 		 => 'etapasvi-cz',
		              'blessing_ln' 		 => 'cs-CZ',
                              'paypal_button' 		 => 'en_US'
		),
		'hu' => array('name'    			 => 'Magyar',
					  'en_name'    			 => 'Hungarian',
		              'iso'     			 => 'hu',
		              'comments_category_id' => 686585,
		              'feedburner_loc' 		 => '',
		              'fb_group' 		 	 => 'pages/eTapasvicom-hu-Magyar/422601807795163',
		              'google_group' 		 => 'etapasvi-hu',
		              'blessing_ln' 		 => 'hu-HU',
                              'paypal_button' 		 => 'en_US'
		),
		'pl' => array('name'    			 => 'Polski',
		              'en_name'    			 => 'Polish',
		              'iso'     			 => 'pl',
		              //'mail_id' 			 => '99862a8230',
		              'comments_category_id' => 686580,
		              'feedburner_loc' 		 => '',
		              'fb_group' 		 	 => 'pages/eTapasvicom-pl-Polski/509286569090423',
		              'google_group' 		 => 'etapasvi-pl',
		              'blessing_ln' 		 => 'pl-PL',
                              'paypal_button' 		 => 'pl_PL/PL'
		),
		'fr' => array('name'    			 => 'Français',
					  'en_name'    			 => 'French',
		              'iso'     			 => 'fr',
		              //'mail_id' 			 => '430d7d6d8b',
		              'comments_category_id' => 686581,
		              'feedburner_loc' 		 => 'fr_FR',
		              'fb_group' 		 	 => 'pages/eTapasvicom-fr-Français/417833841617774',
		              'google_group' 		 => 'etapasvi-fr',
		              'blessing_ln' 		 => 'fr-FR',
                              'paypal_button' 		 => 'fr_FR'
		),
		// Mandarin Chinese (Simplified script) - упрошённый китайский
		'zh_CN'  => array(
					  'name'          		 => '简体中文',
					  'en_name'    			 => 'Mandarin Chinese',
		              'iso'           		 => 'zh-cn',
		              'hieroglyphic'  		 => true,
		              //'mail_id' 	  		 => '33bb475372',
		              'comments_category_id' => 686582,
		              'feedburner_loc' 		 => '',
		              'fb_group' 		 	 => 'pages/eTapasvicom-zh-cn-%E7%AE%80%E4%BD%93%E4%B8%AD%E6%96%87/300889923359900',
		              'google_group' 		 => 'etapasvi-zh',
		              'blessing_ln' 		 => 'zh-CN',
                              'paypal_button' 		 => 'zh_CN'
		),
		'vi' => array('name'    			 => 'Tiếng Việt',
					  'en_name'    			 => 'Vietnamese',
		              'iso'     			 => 'vn',
		              //'mail_id' 			 => '68f2a2996d',
		              'comments_category_id' => 686583,
		              'feedburner_loc' 		 => '',
		              'fb_group' 		 	 => 'pages/eTapasvicom-vn-Ti%E1%BA%BFng-Vi%E1%BB%87t/365871553502958',
		              'google_group' 		 => 'etapasvi-vietnamese',
		              'google_group' 		 => 'etapasvi-vn',
		              'blessing_ln' 		 => 'vi-VN',
                              'paypal_button' 		 => 'en_US'
		),
		'ja' => array('name'    			 => '日本語',
					  'en_name'    			 => 'Japanese',
		              'iso'     			 => 'jp',
		              'hieroglyphic'  		 => true,
		              //'mail_id' 			 => '77a5eb7cd2',
		              'comments_category_id' => 686578,
		              'feedburner_loc' 		 => 'ja_JP',
		              'fb_group' 		 	 => 'pages/eTapasvicom-jp-日本語/216899785109288',
		              'google_group' 		 => 'dharmasangha-jp',
		              'blessing_ln' 		 => 'ja-JP',
                              'paypal_button' 		 => 'ja_JP'
		),
		'es' => array('name'    			 => 'Español',
					  'en_name'    			 => 'Spanish',
		              'iso'     			 => 'es',
		              //'mail_id' 			 => '6f9b50c196',
		              'comments_category_id' => 686579,
		              'feedburner_loc' 		 => 'es_ES',
		              'disqus_culture' 		 => 'es_ES',
		              'fb_group' 		 	 => 'pages/eTapasvicom-es-Espa%C3%B1ol/162128630600687',
		              'google_group' 		 => 'etapasvi-es',
		              'blessing_ln' 		 => 'es-ES',
                               'paypal_button' 		 => 'en_US'
		),
		'it' => array('name'    			 => 'Italiano',
					  'en_name'    			 => 'Italian',
		              'iso'     			 => 'it',
		              //'mail_id' 			 => 'ddd87d0746',
		              'comments_category_id' => 686577,
		              'feedburner_loc' 		 => '',
		              'fb_group' 		 	 => 'pages/eTapasvicom-it-Italiano/482400528458711',
		              'google_group' 		 => 'etapasvi-it',
		              'blessing_ln' 		 => 'it-IT',
                              'paypal_button' 		 => 'it_IT'
		),
/*

		'sk' => array('name'    => 'sk - Slovenčina',
		              'iso'     => 'sk'),

		'uk' => array('name'    => 'ua - Українська',
		              'iso'     => 'ua'),*/
		'et' => array('name'    			 => 'Eesti',
					  'en_name'    			 => 'Estonian',
		              'iso'     			 => 'ee',
		              'comments_category_id' => 997486,
		              'feedburner_loc' 		 => '',
		              'fb_group' 		 	 => 'pages/eTapasvicom-ee-Eesti/262816543841522',
		              'google_group' 		 => 'etapasvi-ee',
		              'blessing_ln' 		 => 'et-EE',
                              'paypal_button' 		 => 'en_US'
		),
		'ne' => array('name'    			 => 'नेाी',
					  'en_name'    			 => 'Nepali',
		              'iso'     			 => 'ne',
		              'hieroglyphic'  		 => true,
		              'comments_category_id' => 1102690,
		              //'feedburner_loc' 		 => 'ru_RU'
		              'disqus_culture' 		 => 'en',
		              'fb_group' 		 	 => 'pages/eTapasvicom-ne-%E0%A4%A8%E0%A5%87%E0%A4%BE%E0%A5%80/427189564014033',
		              'google_group' 		 => 'etapasvi-ne',
		              'blessing_ln' 		 => 'ne-NP',
                              'paypal_button' 		 => 'en_US'
		),
		'bn' => array('name'    			 => 'বাংলা',
		              'en_name'    			 => 'Bengali',
		              'iso'     			 => 'bn',
		              'hieroglyphic'  		 => true,
		              'large_text'	 		 => true,
		              'comments_category_id' => 1110606,
		              //'feedburner_loc' 		 => 'ru_RU'
					  'disqus_culture' 		 => 'en',
					  'fb_group' 		 	 => 'pages/eTapasvicom-bn-%E0%A6%AC%E0%A6%BE%E0%A6%82%E0%A6%B2%E0%A6%BE/434001003314417',
					  'google_group' 		 => 'etapasvi-bn',
					  'blessing_ln' 		 => 'bn-BD',
                               'paypal_button' 		 => 'en_US'
		),
		'he' => array(
					  'name'     			 => 'עברית',
					  'en_name'    			 => 'Hebrew',
                      'iso'      			 => 'he',
		              'hieroglyphic'  		 => true,
		              'large_text'	 		 => true,
		              'comments_category_id' => 1417916,
		              'feedburner_loc' 		 => '',
		              'direction_rtl' 		 => true,
		              'fb_group' 		 	 => 'pages/eTapasvicom-he-%D7%A2%D7%91%D7%A8%D7%99%D7%AA/389776024435475',
		              'google_group' 		 => 'etapasvi-he',
		              'blessing_ln' 		 => 'he-IL',
                              'paypal_button' 		 => 'he_IL'
         ),
         // Taiwan / Lee Ming / Traditional Chinese language
		'zh_TW' => array(
					  'name'     			 => '傳統漢字',
					  'en_name'    			 => 'Traditional Chinese',
                      'iso'      			 => 'zh-tw',
		              'hieroglyphic'  		 => true,
		              'comments_category_id' => 1417917,
		              'feedburner_loc' 		 => '',
		              'disqus_culture' 		 => 'zh_HANT',
		              'fb_group' 		 	 => 'pages/eTapasvicom-zh-tw-%E5%82%B3%E7%B5%B1%E6%BC%A2%E5%AD%97/124329524389601',
		              'google_group' 		 => 'etapasvi-zh',
		              'blessing_ln' 		 => 'zh-TW',
                              'paypal_button' 		 => 'zh_CN'
         ),
		'de' => array('name'     			 => 'Deutsch',
					  'en_name'    		     => 'German',
                      'iso'      			 => 'de',
		              'comments_category_id' => 1456893,
		              'feedburner_loc' 		 => '',
		              'disqus_culture' 		 => 'de_formal',
		              'fb_group' 		 	 => 'pages/eTapasvicom-de-Deutsch/245816235544764',
		              'google_group' 		 => 'etapasvi-de',
		              'blessing_ln' 		 => 'de-DE',
                              'paypal_button' 		 => 'de_DE'
		),
	);


	// список языков по
	// http://msdn.microsoft.com/en-us/library/ms533052%28v=vs.85%29.aspx
	// http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
	// и имеющихся в симфони
	// в симфони нет:
    //    Array
    //    (
    //        [0] => gd
    //        [1] => rm
    //        [2] => ro-mo
    //        [3] => ru-mo
    //        [4] => sb
    //        [5] => sx
    //        [6] => ts
    //        [7] => ji
    //        [8] => sz
    //        [9] => tn
    //        [10] => ve
    //        [11] => xh
    //    )
    /*
      '' => array('name'     => '',
                  'en'       => '',
                  'iso'      => ''
      ),
    */
    static public $all_cultures = array (
      'af' => array('name'     => 'Afrikaans',
                    'en'       => 'Afrikaans',
                    'iso'      => 'af'
      ),
      'sq' => array('name'     => 'Shqip',
                    'en'       => 'Albanian',
                    'iso'      => 'sq'
      ),
      'ar_IQ' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Iraq)',
                       'iso'      => 'ar'
      ),
      'ar_LY' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Libya)',
                       'iso'      => 'ar'
      ),
      'ar_MA' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Morocco)',
                       'iso'      => 'ar'
      ),
      'ar_OM' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Oman)',
                       'iso'      => 'ar'
      ),
      'ar_SY' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Syria)',
                       'iso'      => 'ar'
      ),
      'ar_LB' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Lebanon)',
                       'iso'      => 'ar'
      ),
      'ar_AE' => array('name'     => 'العربية',
                       'en'       => 'Arabic (U.A.E.)',
                       'iso'      => 'ar'
      ),
      'ar_QA' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Qatar)',
                       'iso'      => 'ar'
      ),
      'ar_SA' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Saudi Arabia)',
                       'iso'      => 'ar'
      ),
      'ar_EG' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Egypt)',
                       'iso'      => 'ar'
      ),
      'ar_DZ' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Algeria)',
                       'iso'      => 'ar'
      ),
      'ar_TN' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Tunisia)',
                       'iso'      => 'ar'
      ),
      'ar_YE' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Yemen)',
                       'iso'      => 'ar'
      ),
      'ar_JO' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Jordan)',
                       'iso'      => 'ar'
      ),
      'ar_KW' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Kuwait)',
                       'iso'      => 'ar'
      ),
      'ar_BH' => array('name'     => 'العربية',
                       'en'       => 'Arabic (Bahrain)',
                       'iso'      => 'ar'
      ),
      'eu' => array('name'     => 'Euskara',
                    'en'       => 'Basque',
                    'iso'      => 'eu'
      ),
      'be' => array('name'     => 'Беларуская',
                    'en'       => 'Belarusian',
                    'iso'      => 'be'
      ),
	  'bn' => array('name'     => 'বাংলা',
					'en'       => 'Bengali',
                    'iso'      => 'bn'
	  ),
      'bg' => array('name'     => 'Български език',
                    'en'       => 'Bulgarian',
                    'iso'      => 'bg'
      ),
      'ca' => array('name'     => 'Català',
                    'en'       => 'Catalan',
                    'iso'      => 'ca'
      ),
      'zh_CN' => array('name'     => '简体中文',
                       'en'       => 'Chinese (PRC)',
                       'iso'      => 'zh'
      ),
      'zh_SG' => array('name'     => '简体中文',
                       'en'       => 'Chinese (Singapore)',
                       'iso'      => 'zh'
      ),
      'zh_TW' => array('name'     => '简体中文',
                       'en'       => 'Chinese (Taiwan)',
                       'iso'      => 'zh-tw'
      ),
      'zh_HK' => array('name'     => '简体中文',
                       'en'       => 'Chinese (Hong Kong SAR)',
                       'iso'      => 'zh'
      ),
      'hr' => array('name'     => 'Hrvatski',
                    'en'       => 'Croatian',
                    'iso'      => 'hr'
      ),
      'cs' => array('name'     => 'Čeština',
                    'en'       => 'Czech',
                    'iso'      => 'cs'
      ),
      'da' => array('name'     => 'Dansk',
                    'en'       => 'Danish',
                    'iso'      => 'da'
      ),
      'nl' => array('name'     => 'Nederlands',
                    'en'       => 'Dutch',
                    'iso'      => 'nl'
      ),
//      'nl_BE' => array('name'     => 'Nederlands',
//                       'en'       => 'Dutch (Belgium)',
//                       'iso'      => 'nl'
//      ),
//      'en_US' => array('name'     => 'English',
//                       'en'       => 'English (United States)',
//                       'iso'      => 'en'
//      ),
//      'en_AU' => array('name'     => '',
//                  'en'       => 'English (Australia)',
//                  'iso'      => ''
//      ),
//      'en_NZ' => array('name'     => '',
//                  'en'       => 'English (New Zealand)',
//                  'iso'      => ''
//      ),
//      'en_ZA' => array('name'     => '',
//                  'en'       => 'English (South Africa)',
//                  'iso'      => ''
//      ),
      'en' => array('name'     => 'English',
                    'en'       => 'English',
                    'iso'      => 'en'
      ),
//      'en_TT' => array('name'     => '',
//                  'en'       => 'English (Trinidad)',
//                  'iso'      => ''
//      ),
//      'en_GB' => array('name'     => '',
//                  'en'       => 'English (United Kingdom)',
//                  'iso'      => ''
//      ),
//      'en_CA' => array('name'     => '',
//                  'en'       => 'English (Canada)',
//                  'iso'      => ''
//      ),
//      'en_IE' => array('name'     => '',
//                  'en'       => 'English (Ireland)',
//                  'iso'      => ''
//      ),
//      'en_JM' => array('name'     => '',
//                  'en'       => 'English (Jamaica)',
//                  'iso'      => ''
//      ),
//      'en_BZ' => array('name'     => '',
//                  'en'       => 'English (Belize)',
//                  'iso'      => ''
//      ),
      'et' => array('name'     => 'Eesti',
                    'en'       => 'Estonian',
                    'iso'      => 'et'
      ),
      'fo' => array('name'     => 'Føroyskt',
                    'en'       => 'Faeroese',
                    'iso'      => 'fo'
      ),
      'fa' => array('name'     => 'فارسی',
                    'en'       => 'Farsi',
                    'iso'      => 'fa'
      ),
      'fi' => array('name'     => 'Suomi',
                    'en'       => 'Finnish',
                    'iso'      => 'fi'
      ),
      'fr' => array('name'     => 'Français',
                    'en'       => 'French',
                    'iso'      => 'fr'
      ),
//      'fr_CA' => array('name'     => '',
//                       'en'       => 'French (Canada)',
//                       'iso'      => ''
//      ),
//      'fr_LU' => array('name'     => '',
//                  'en'       => 'French (Luxembourg)',
//                  'iso'      => ''
//      ),
//      'fr_BE' => array('name'     => '',
//                       'en'       => 'French (Belgium)',
//                       'iso'      => ''
//      ),
//      'fr_CH' => array('name'     => '',
//                  'en'       => 'French (Switzerland)',
//                  'iso'      => ''
//      ),
      'gd' => array('name'     => 'Gàidhlig',
                    'en'       => 'Gaelic (Scotland)',
                    'iso'      => 'gd'
      ),
      'de' => array('name'     => 'Deutsch',
                    'en'       => 'German',
                    'iso'      => 'de'
      ),
//      'de_CH' => array('name'     => '',
//                  'en'       => 'German (Switzerland)',
//                  'iso'      => ''
//      ),
//      'de_LU' => array('name'     => '',
//                  'en'       => 'German (Luxembourg)',
//                  'iso'      => ''
//      ),
//      'de_AT' => array('name'     => '',
//                       'en'       => 'German (Austria)',
//                       'iso'      => ''
//      ),
//      'de_LI' => array('name'     => '',
//                  'en'       => 'German (Liechtenstein)',
//                  'iso'      => ''
//      ),
      'el' => array('name'     => 'Ελληνικά',
                    'en'       => 'Greek',
                    'iso'      => 'el'
      ),
      'he' => array('name'     => 'עברית',
                    'en'       => 'Hebrew',
                    'iso'      => 'he'
      ),
      'hi' => array('name'     => 'हिन्दी',
                    'en'       => 'Hindi',
                    'iso'      => 'hi'
      ),
      'hu' => array('name'     => 'Magyar',
                    'en'       => 'Hungarian',
                    'iso'      => 'hu'
      ),
      'is' => array('name'     => 'Íslenska',
                    'en'       => 'Icelandic',
                    'iso'      => 'is'
      ),
      'id' => array('name'     => 'Bahasa Indonesia',
                    'en'       => 'Indonesian',
                    'iso'      => 'id'
      ),
      'ga' => array('name'     => 'Gaeilge',
                    'en'       => 'Irish',
                    'iso'      => 'ga'
      ),
      'it' => array('name'     => 'Italiano',
                    'en'       => 'Italian',
                    'iso'      => 'it'
      ),
//      'it_CH' => array('name'     => 'Italiano',
//                       'en'       => 'Italian (Switzerland)',
//                       'iso'      => 'it'
//      ),
      'ja' => array('name'     => '日本語',
                    'en'       => 'Japanese',
                    'iso'      => 'ja'
      ),
      'ko' => array('name'     => '한국어 (韓國語)',
                    'en'       => 'Korean (Johab)',
                    'iso'      => 'ko'
      ),
      'lv' => array('name'     => 'Latviešu valoda',
                    'en'       => 'Latvian',
                    'iso'      => 'lv'
      ),
      'lt' => array('name'     => 'Lietuvių kalba',
                    'en'       => 'Lithuanian',
                    'iso'      => 'lt'
      ),
      'mk' => array('name'     => 'Македонски јазик',
                    'en'       => 'Macedonian (FYROM)',
                    'iso'      => 'mk'
      ),
      'ms' => array('name'     => 'Bahasa Melayu, بهاس ملايو',
                    'en'       => 'Malay',
                    'iso'      => 'ms'
      ),
      'mt' => array('name'     => 'Malti',
                    'en'       => 'Maltese',
                    'iso'      => 'mt'
      ),
      'ne' => array('name'     => 'नेपाली',
                    'en'       => 'Nepali',
                    'iso'      => 'ne'
      ),
      'no' => array('name'     => 'Norsk bokmål',
                    'en'       => 'Norwegian (Bokmal)',
                    'iso'      => 'nb'
      ),
      'pl' => array('name'     => 'Polski',
                    'en'       => 'Polish',
                    'iso'      => 'pl'
      ),
      'pt' => array('name'     => 'Português',
                    'en'       => 'Portuguese (Portugal)',
                    'iso'      => 'pt',
                    'disqus_culture' => 'pt_EU',
      ),
//      'pt_BR' => array('name'     => 'Português',
//                       'en'       => 'Portuguese (Brazil)',
//                       'iso'      => 'pt'
//      ),
      'ro' => array('name'     => 'Română',
                    'en'       => 'Romanian',
                    'iso'      => 'ro'
      ),
//      'ro_MO' => array('name'     => 'Română',
//                       'en'       => 'Romanian (Republic of Moldova)',
//                       'iso'      => 'ro'
//      ),
      'rm' => array('name'     => 'Rumantsch grischun',
                    'en'       => 'Romansh',
                    'iso'      => 'rm'
      ),
      'ru' => array('name'     => 'Русский',
                    'en'       => 'Russian',
                    'iso'      => 'ru'
      ),
//      'ru_MO' => array('name'     => '',
//                  'en'       => 'Russian (Republic of Moldova)',
//                  'iso'      => ''
//      ),
     'sz' => array('name'     => 'Davvisámegiella',
                    'en'       => 'Sami (Lappish)',
                    'iso'      => 'se'
      ),
      'sr' => array('name'     => 'Српски језик',
                    'en'       => 'Serbian (Latin)',
                    'iso'      => 'sr',
                    'disqus_culture'      => 'sr_LATIN'
      ),
      'sk' => array('name'     => 'Slovenčina',
                    'en'       => 'Slovak',
                    'iso'      => 'sk'
      ),
      'sl' => array('name'     => 'Slovenščina',
                    'en'       => 'Slovenian',
                    'iso'      => 'sl'
      ),
      'sb' => array('name'     => 'Serbsce',
                    'en'       => 'Sorbian',
                    'iso'      => 'sb' // не найдено
      ),
      'es' => array('name'     => 'Español',
                    'en'       => 'Spanish (Spain)',
                    'iso'      => 'es'
      ),
//      'es_GT' => array('name'     => '',
//                  'en'       => 'Spanish (Guatemala)',
//                  'iso'      => ''
//      ),
//      'es_PA' => array('name'     => '',
//                  'en'       => 'Spanish (Panama)',
//                  'iso'      => ''
//      ),
//      'es_VE' => array('name'     => '',
//                  'en'       => 'Spanish (Venezuela)',
//                  'iso'      => ''
//      ),
//      'es_PE' => array('name'     => '',
//                  'en'       => 'Spanish (Peru)',
//                  'iso'      => ''
//      ),
//      'es_EC' => array('name'     => '',
//                  'en'       => 'Spanish (Ecuador)',
//                  'iso'      => ''
//      ),
//      'es_UY' => array('name'     => '',
//                  'en'       => 'Spanish (Uruguay)',
//                  'iso'      => ''
//      ),
//      'es_BO' => array('name'     => '',
//                  'en'       => 'Spanish (Bolivia)',
//                  'iso'      => ''
//      ),
//      'es_HN' => array('name'     => '',
//                  'en'       => 'Spanish (Honduras)',
//                  'iso'      => ''
//      ),
//      'es_PR' => array('name'     => '',
//                  'en'       => 'Spanish (Puerto Rico)',
//                  'iso'      => ''
//      ),
//      'es_MX' => array('name'     => '',
//                  'en'       => 'Spanish (Mexico)',
//                  'iso'      => ''
//      ),
//      'es_CR' => array('name'     => '',
//                  'en'       => 'Spanish (Costa Rica)',
//                  'iso'      => ''
//      ),
//      'es_DO' => array('name'     => '',
//                  'en'       => 'Spanish (Dominican Republic)',
//                  'iso'      => ''
//      ),
//      'es_CO' => array('name'     => '',
//                  'en'       => 'Spanish (Colombia)',
//                  'iso'      => ''
//      ),
//      'es_AR' => array('name'     => '',
//                  'en'       => 'Spanish (Argentina)',
//                  'iso'      => ''
//      ),
//      'es_CL' => array('name'     => '',
//                  'en'       => 'Spanish (Chile)',
//                  'iso'      => ''
//      ),
//      'es_PY' => array('name'     => '',
//                  'en'       => 'Spanish (Paraguay)',
//                  'iso'      => ''
//      ),
//      'es_SV' => array('name'     => '',
//                  'en'       => 'Spanish (El Salvador)',
//                  'iso'      => ''
//      ),
//      'es_NI' => array('name'     => '',
//                  'en'       => 'Spanish (Nicaragua)',
//                  'iso'      => ''
//      ),
      'sv' => array('name'     => 'Svenska',
                    'en'       => 'Swedish',
                    'iso'      => 'sv',
                    'disqus_culture' => 'sv_SE',
      ),

      // неизвестный
//      'sx' => array('name'     => '',
//                  'en'       => 'Sutu',
//                  'iso'      => ''
//      ),
//      'sv_FI' => array('name'     => '',
//                  'en'       => 'Swedish (Finland)',
//                  'iso'      => ''
//      ),
      'th' => array('name'     => 'ไทย',
                    'en'       => 'Thai',
                    'iso'      => 'th'
      ),
      'ts' => array('name'     => 'Xitsonga',
                    'en'       => 'Tsonga',
                    'iso'      => 'ts'
      ),
      'tn' => array('name'     => 'Setswana',
                    'en'       => 'Tswana',
                    'iso'      => 'tn'
      ),
      'tr' => array('name'     => 'Türkçe',
                    'en'       => 'Turkish',
                    'iso'      => 'tr'
      ),
      'uk' => array('name'     => 'українська',
                    'en'       => 'Ukrainian',
                    'iso'      => 'uk'
      ),
      'ur' => array('name'     => 'اردو',
                    'en'       => 'Urdu',
                    'iso'      => 'ur'
      ),
      've' => array('name'     => 'Tshivenḓa',
                    'en'       => 'Venda',
                    'iso'      => 've'
      ),
      'vi' => array('name'     => 'Tiếng Việt',
                    'en'       => 'Vietnamese',
                    'iso'      => 'vi'
      ),
      'xh' => array('name'     => 'isiXhosa',
                    'en'       => 'Xhosa',
                    'iso'      => 'xh'
      ),
      'ji' => array('name'     => 'ייִדיש',
                    'en'       => 'Yiddish',
                    'iso'      => 'yi'
      ),
      'zu' => array('name'     => 'isiZulu',
                    'en'       => 'Zulu',
                    'iso'      => 'zu'
      )
    );

	//const DEFAULT_CULTURE = 'en';

	// доменное имя, которое используется по умолчанию вне приложения
	const DOMAIN_NAME_MAIN   		 = 'www.etapasvi.com';

	const FORUM_URL   		 		 = 'http://forum.etapasvi.com';
	// список доменных имён
	public static $domain_name_list  = array('www.etapasvi.com', 'm.etapasvi.com');

	// Email for sending requests for blessing
	const BLESSING_EMAIL 	   		 = 'etapasvi+blessing@gmail.com';
	const BLESSING_URL  			 = 'http://blessing.etapasvi.com/Default.aspx';

	/**
	 * Вся информация о языках
	 *
	 * @return unknown
	 */
	public static function getCulturesData()
	{
		return self::$cultures;
	}

	/**
	 * Список языков
	 *
	 * @return unknown
	 */
	public static function getCultures()
	{
		return array_keys( self::$cultures );
	}

	/**
	 * Названия языков
	 *
	 * @return unknown
	 */
	public static function getCultureNames()
	{
	    $result = array();
	    foreach (self::$cultures as $culture => $culture_data) {
	       $result[$culture] = $culture_data['name'];
	    }
		return $result;
	}

	/**
	 * ISO-код языка
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureIso( $culture )
	{
		return self::$cultures[ $culture ][ 'iso' ];
	}

	/**
	 * Основная часть языка.
	 * Для zh_CN вернёт zh
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureMain( $culture )
	{
		return substr( sfContext::getInstance()->getUser()->getCulture(), 0, 2 );
	}

	/**
	 * Get Diqus ISO culture code
	 * http://docs.disqus.com/help/97/
	 *
	 * ISO 639-1 two-letter code exceptions
	 * Most languages can be set using their standard two-letter ISO 639-1 code (full list). Exceptions are:
	 *
	 * Chinese (Traditional) = zh_HANT
	 * German (Formal) = de_formal
	 * German (Informal) = de_inf
	 * Portuguese (Brazil) = pt_BR
	 * Portuguese (European) = pt_EU
	 * Serbian (Cyrillic) = sr_CYRL
	 * Serbian (Latin) = sr_LATIN
	 * Spanish (Argentina) = es_AR
	 * Spanish (Mexico) = es_MX
	 * Spanish (Spain) = es_ES
	 * Swedish = sv_SE
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getDisqusCulture( $culture = '' )
	{
		if (!$culture) {
			$culture = sfContext::getInstance()->getUser()->getCulture();
		}

		if (self::$cultures[ $culture ]['disqus_culture']) {
			return self::$cultures[ $culture ]['disqus_culture'];
		} else {
			return self::getCultureMain($culture);
		}
	}

	/**
	 * Название языка
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureName( $culture )
	{
		return self::$cultures[ $culture ][ 'name' ];
	}

	/**
	 * Название языка
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	/*public static function getCultureMailId( $culture = '' )
	{
		if (!$culture) {
			$culture = sfContext::getInstance()->getUser()->getCulture();
		}
		return self::$cultures[ $culture ][ 'mail_id' ];
	}*/

	/**
	 * Полученеи языка в формате MSDS: http://msdn.microsoft.com/en-us/library/ms533052%28v=vs.85%29.aspx
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
    public static function getCultureMsdn( $culture = '' )
	{
		if (!$culture) {
			$culture = sfContext::getInstance()->getUser()->getCulture();
		}
		return strtolower( str_replace("_", "-", $culture) );
	}

	/**
	 * Категория для системы комментирования
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureCommentsCategoryId( $culture = '' )
	{
		if (!$culture) {
			$culture = sfContext::getInstance()->getUser()->getCulture();
		}
		return self::$cultures[ $culture ][ 'comments_category_id' ];
	}

	/**
	 * Получение языка интерфейса FeedBurner для языка
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureFeedburderLoc( $culture = '' )
	{
		if (!$culture) {
			$culture = sfContext::getInstance()->getUser()->getCulture();
		}
		$loc = self::$cultures[ $culture ][ 'feedburner_loc' ];
		if (!$loc) {
			$loc = self::$cultures[ sfConfig::get('sf_default_culture') ][ 'feedburner_loc' ];
		}
		return $loc;
	}

	/**
	 * Полученеи кода языка в модуле blessing.etapasvi.com
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
    public static function getCultureBlessingLn( $culture = '' )
	{
		if (!$culture) {
			$culture = sfContext::getInstance()->getUser()->getCulture();
		}
		return self::$cultures[ $culture ][ 'blessing_ln' ];
	}

	/**
	 * Используются ли в языке иероглифы
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function isCultureHieroglyphic( $culture = '' )
	{
	    if (!$culture) {
	        $culture = sfContext::getInstance()->getUser()->getCulture();
	    }
	    if (!empty(self::$cultures[ $culture ][ 'hieroglyphic' ])) {
			return (bool)self::$cultures[ $culture ][ 'hieroglyphic' ];
	    } else {
	    	return false;
	    }
	}

	/**
	 * Используется ли для языка увеличенный размер текста
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function isCultureLargeText( $culture = '' )
	{
	    if (!$culture) {
	        $culture = sfContext::getInstance()->getUser()->getCulture();
	    }
	    if (!empty(self::$cultures[ $culture ][ 'large_text' ])) {
			return (bool)self::$cultures[ $culture ][ 'large_text' ];
	    } else {
	    	return false;
	    }
	}

	/**
	 * Направление текста - справа налево.
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function isCultureDirectionRtl( $culture = '' )
	{
	    if (!$culture) {
	        $culture = sfContext::getInstance()->getUser()->getCulture();
	    }
	    if (!empty(self::$cultures[ $culture ][ 'direction_rtl' ])) {
			return (bool)self::$cultures[ $culture ][ 'direction_rtl' ];
	    } else {
	    	return false;
	    }
	}

	/**
	 * Полное название языка, пример: Afrikaans [af] &nbsp;&nbsp;-&nbsp;&nbsp; Afrikaans
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureFullName( $culture = '' )
	{
		if (!$culture || empty(self::$all_cultures[$culture])) {
			return '';
		}
	    return self::$all_cultures[$culture]['en'] .' [' . $culture . '] &nbsp;&nbsp;-&nbsp;&nbsp; ' . self::$all_cultures[$culture]['name'];
	}

	/**
	 * Get the name of FB-group for the culture
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureFbGroup( $culture = '' )
	{
		if (!$culture) {
			$culture = sfContext::getInstance()->getUser()->getCulture();
		}
		$fb_group = self::$cultures[ $culture ][ 'fb_group' ];
		if (!$fb_group) {
			$fb_group = 'etapasvi.' . str_replace('-', '.', self::$cultures[ $culture ][ 'iso' ]);
		}
		return $fb_group;
	}

	/**
	 * Get the name of Twitter for the culture
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureTwitter( $culture = '' )
	{
		if (!$culture) {
			$culture = sfContext::getInstance()->getUser()->getCulture();
		}
		$twitter = self::$cultures[ $culture ][ 'twitter' ];
		if (!$twitter) {
			$twitter = 'etapasvi_' . str_replace('-', '_', self::$cultures[ $culture ][ 'iso' ]);
		}
		return $twitter;
	}

	/**
	 * Get name of Google Group for the culture
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getCultureGoogle( $culture = '' )
	{
		if (!$culture) {
			$culture = sfContext::getInstance()->getUser()->getCulture();
		}
		return self::$cultures[ $culture ][ 'google_group' ];
	}

	public static function getCulturePaypalButton( $culture = '' )
	{
		if (!$culture) {
			$culture = sfContext::getInstance()->getUser()->getCulture();
		}

		if (self::$cultures[ $culture ]['paypal_button']) {
			return self::$cultures[ $culture ]['paypal_button'];
		} else {
			return self::$cultures[ 'en' ]['paypal_button'];
		}
	}

	/**
	 * Проверка, является ли страница главной
	 *
	 * @param string $url адрес для проверки
	 * @return unknown
	 */
	public static function isHomePage( $url = '' )
	{
	    if (!$url) {
	        $url = sfContext::getInstance()->getRequest()->getUri();
	    }
	    // если в адресе только 2 слэша, значит мы на главной
	    $parse_url = parse_url($url);
	    if ( in_array( str_replace('/' , '', $parse_url['path']), UserPeer::getCultures()) ) {
	        return true;
	    } else {
	        return false;
	    }
	}

	/**
	 * Переключение адреса на мобильную версию и обратно
	 *
	 * @param string $url адрес
	 * @return string
	 */
	public static function switchUrlMobile( $url = '' )
	{
	    if (!$url) {
            $url = sfContext::getInstance()->getRequest()->getUri();

            // on photo/view we show link to the main page
            $sf_context  = sfContext::getInstance();

            if ($sf_context->getModuleName() == 'photo' && $sf_context->getActionName() == 'show') {
                $parse_url = parse_url($url);
                $url = $parse_url['scheme'] . '://' . $parse_url['host'] . '/' . sfContext::getInstance()->getUser()->getCulture() . '/';
            }
	    }

	    if (strstr($url, sfConfig::get('app_domain_name_full'))) {
	        // переключаем на мобильную версию
	        $result_url = str_replace(sfConfig::get('app_domain_name_full'), sfConfig::get('app_domain_name_mobile'), $url);

	        // удаление "version/full" из адреса
	        $result_url = str_replace('version/full', '', $result_url);
	    } else {
	        // переключение на полную версию
	        $result_url = str_replace(sfConfig::get('app_domain_name_mobile'), sfConfig::get('app_domain_name_full'), $url);
	    }

	    // убираем название скрипта
	    //if (sfConfig::get('sf_no_script_name') || sfConfig::get('sf_environment') == 'prod') {
	    $parse_url = parse_url($url);
	    $result_url = str_replace('/' . UserPeer::getApplicationScript($parse_url['host'], sfConfig::get('sf_environment')), '', $result_url);
	    //}

	    return $result_url;
	}

	/**
	 * Получение названия скрипта по Доменному имени и окружению
	 *
	 * @param unknown_type $domain_name
	 * @return unknown
	 */
	public static function getApplicationScript( $domain_name )
	{
	  return 'frontend_' . str_replace('.', '_', $domain_name) . '.php';
	}

	/**
	 * Получение языка из URL
	 * url:
	 * http://www.etapasvi.com/zh_CN/biography
	 * /zh_CN/biography
	 */
	public static function getCultureFromUrl( $url )
	{
		preg_match("/(?:http:\/\/[^\/]+)?\/([^\/]+)\/.*/", $url, $matches);
		return $matches[1];
	}

	/**
	 * Получение относительного адреса страницы 404
	 */
	public static function getError404Url($culture = '')
	{
		if (empty($culture )) {
		  $culture = sfContext::getInstance()->getUser()->getCulture();
		}
		// если передан URL /abrakadabra, язык неопределён
		if (empty($culture)) {
			$culture = sfConfig::get('sf_default_culture');
		}
		$url = '/' . $culture . '/default/errors';
		return $url;
	}

	/**
	 * Получение доменного имени веба
	 *
	 * @param unknown_type $culture
	 * @return unknown
	 */
	public static function getWebDomain($web, $mobile = false)
	{
		$web = (int)$web;
		if ($web == 0) {
			return '';
		}
		$web_domain = 'web' . $web . '.';
		if ($mobile) {
			$web_domain .= sfConfig::get('app_domain_name_mobile');
		} else {
		    $web_domain .= sfConfig::get('app_domain_name_full');
		}
		return $web_domain;
	}

	/**
	 * Отправка уведомления администратору
	 *
	 * @param unknown_type $msg
	 * @param unknown_type $subject
	 */
	public static function adminNotify( $msg, $subject)
	{
		mail(sfConfig::get('app_admin_email'), self::EMAIL_PREFIX . ' ' . $subject . ' (' . sfConfig::get('app_domain_name') . ')', $msg );
	}

	/**
	 * Проверка, находимся ли мы на основном бэкенде
	 *
	 * @return unknown
	 */
	public static function isMainBack()
	{
	   return file_exists(sfConfig::get('sf_web_dir') . '/main_back.conf');
	}

  /**
   * Получение объекта для генерации путей.
   * Берётся из файла routing.yml фронтенда.
   *
   */
  public static function getRouting()
  {
  	// подготовка путей для поиска файлов
  	// http://www.symfony-project.org/cookbook/1_2/en/cross-application-links
  	$config = new sfRoutingConfigHandler();
	$routes = $config->evaluate(array(sfConfig::get('sf_apps_dir') . '/frontend/config/routing.yml'));
	$routing = new sfPatternRouting(new sfEventDispatcher());
	$routing->setRoutes($routes);

	return $routing;
  }

  /**
   * Получение информации о серверах.
   *
   */
  public static function getServers($servers)
  {
  	// получение списка серверов из Google Docs
  	$servers_array = array();

  	if (!$servers) {
  		return array();
  	}

  	switch ($servers) {
  	  case self::SERVERS_BACKENDS:
  		$servers_array = TextPeer::getGoogleDocAsArray(sfConfig::get('app_backends'));
  		break;
  	  case self::SERVERS_FRONTENDS:
  		$servers_array = TextPeer::getGoogleDocAsArray(sfConfig::get('app_frontends'));
  		break;
  	}

  	// цикл по строкам
  	foreach ($servers_array as $row) {

	  switch ($servers) {
	  	case self::SERVERS_BACKENDS:
	  	  $servers_item = array(
			'number'      	=> $row[0],
			'host'	  	  	=> $row[1],
			'owner'	  	  	=> $row[2],
			'user'	      	=> $row[3],
			'web_dir' 	  	=> $row[4],
			'owner_email' 	=> $row[5],
			'hosting'     	=> $row[6],
			'db_server'   	=> $row[7],
			'db_port'     	=> $row[8],
			'db_username' 	=> $row[9],
			'db_password' 	=> $row[10],
			'db_name'     	=> $row[11],
			'git_remote'    => $row[12],
			'replicate_db'  => $row[13],
			'active'     	=> $row[14],
			'comment'     	=> $row[15]
	  	  );
	  	  break;

	  	case self::SERVERS_FRONTENDS:
	  	  $servers_item = array(
			'number'      => $row[0],
			'host'	  	  => $row[1],
			'owner'	  	  => $row[2],
			'user'	      => $row[3],
			'web_dir' 	  => $row[4],
			'owner_email' => $row[5],
			'hosting'     => $row[6],
			'rsync_www'   => $row[7],
			'active'      => $row[8],
			'comment'     => $row[9]
	  	  );
	  	  break;
	  }

  	  // названия полей и сервера, у которых не указн путь на сервере пропускаем
  	  if ($servers_item['active'] == 1) {
  	  	// проверяем не добавлен ли ещё сервер с таким IP
  	  	$server_added = false;
  	  	foreach ($servers_list as $server_info) {
  	  	  if ($server_info['host'] == $servers_item['host']) {
  	  		$server_added = true;
  	  		break;
  	      }
  	  	}
  	  	if (!$server_added) {
  	      $servers_list[] = $servers_item;
  	  	}
      }
  	}

  	return $servers_list;
  }

  /**
   * Get config from tools/config/config.yml
   *
   */
  public static function getToolsConfig()
  {
	$config = sfYaml::load(sfConfig::get('sf_root_dir') . '/tools/config/config.yml');
	return $config;
  }

  /**
	* Convert object to array
	*
	* @param unknown_type $object
	* @return unknown
	*/
  public static function object2array($object)
  {
  	$array = array();

	if (is_object($object)) {
	  foreach ($object as $key => $value) {
	    $array[$key] = self::object2array($value);
	  }
	} elseif (is_array($object)) {
	  foreach ($object as $key => $value) {
	    $array[$key] = self::object2array($value);
	  }
	} else {
	  return $object;
	}

	return $array;
  }

  /**
   * Running a task
   *
   * @param unknown_type $task_class
   * @param unknown_type $dispatcher
   * @param unknown_type $arguments
   * @param unknown_type $options
   */
  public static function runTask($task_class, $dispatcher, $arguments = array(), $options = array())
  {
  	$result = array(
  		'result' 		=> false,
  		'error_message' => ''
  	);

  	// Trick plugin into thinking you are in a project directory
  	try {
      chdir(sfConfig::get('sf_root_dir'));

      $task = new $task_class($dispatcher, new sfFormatter());
      $task->run($arguments, $options);

      $result['result'] = true;
  	} catch(Exception $e) {
  	  $result['result'] = false;
  	  $result['error_message'] = $e->getMessage();
  	}
  	return $result;
  }
}
