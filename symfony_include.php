<?php
// #!/dh/cgi-system/php53.cgi
// #!/usr/local/bin/php-5.3 -c /etc/php53/php.ini
// #!/usr/local/php5/bin/php
// #!www/cgi-bin/php-wrapper-s3r.fcgi

// when script lanunched in console HTTP_HOST is not set, so it should be hardcoded
// otherwise links on website will be generated incorrectly by Symfony
if (!$_SERVER['HTTP_HOST']) {
	$_SERVER['HTTP_HOST']        		= 'www.etapasvi.com';
}

// Если на сервере веб-директория не /www/, заменяем:
//    [DOCUMENT_ROOT] => /home/user/public_html
//    [REQUEST_URI] => /t.php
//    [SCRIPT_NAME] => /www/t.php
//    [PHP_SELF] => /www/t.php
// на
//    [DOCUMENT_ROOT] => /home/user/etapasvi.com/www
//    [REQUEST_URI] => /t.php
//    [SCRIPT_NAME] => /t.php
//    [PHP_SELF] => /t.php
if (preg_match("/^\/www\/.*/", $_SERVER['SCRIPT_NAME'])) {
	$_SERVER['DOCUMENT_ROOT'] .= '/www';
	$_SERVER['SCRIPT_NAME']   = preg_replace("/^\/www/", '', $_SERVER['SCRIPT_NAME']);
	$_SERVER['PHP_SELF']      = preg_replace("/^\/www/", '', $_SERVER['PHP_SELF']);
}

// к скрипту обратились из консоли, подменяем пермененные в $_SERVER
// /frontfrontend2.php/ru/photo/836

// if script name does not contain '.php' sfWebRequest->getRelativeUrlRoot() do not cut script name
$_SERVER['argv'][0] = '';
$_SERVER['SCRIPT_NAME']      = preg_replace("/.*\//", '/', $_SERVER['argv'][0]);

// /ru/
$_SERVER['PATH_INFO']        = $_SERVER['argv'][1];

// убрано название скрипта
// http://bsds.etapasvi.com/issues/116
// /frontfrontend2.php/ru/photo/836
$_SERVER['SCRIPT_URL']       = /*$_SERVER['SCRIPT_NAME'] .*/ $_SERVER['PATH_INFO'];

// http://www.etapasvi.com/frontfrontend2.php/ru/photo/836
$_SERVER['SCRIPT_URI']       = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['SCRIPT_URL'];

// /home/user/etapasvi.com/www
$_SERVER['DOCUMENT_ROOT']    = preg_replace("/\/[^\/]+$/", '/', $_SERVER['argv'][0]);

// /home/user/etapasvi.com/www/frontfrontend2.php
$_SERVER['SCRIPT_FILENAME']  = $_SERVER['argv'][0];

// /frontfrontend2.php/ru/photo/836
$_SERVER['REQUEST_URI']      = $_SERVER['SCRIPT_URL'];

// /frontfrontend2.php/ru/photo/836
$_SERVER['PHP_SELF']         = $_SERVER['SCRIPT_URL'];	


/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// project exists?
if (file_exists('config/ProjectConfiguration.class.php'))
{
  require_once('config/ProjectConfiguration.class.php');
  $dir = sfCoreAutoload::getInstance()->getBaseDir();
}
else
{
  if (is_readable(dirname(__FILE__).'/../../lib/autoload/sfCoreAutoload.class.php'))
  {
    // SVN
    $dir = realpath(dirname(__FILE__).'/../../lib');
  }
  else
  {
    // PEAR
    $dir = '@PEAR-DIR@/symfony';

    if (!is_dir($dir))
    {
      throw new Exception('Unable to find symfony libraries');
    }
  }
}

include($dir.'/command/cli.php');