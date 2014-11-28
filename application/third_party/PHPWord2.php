<?php


namespace PhpOffice\PhpWord;

	/**
 * Header file
 */
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\IOFactory;

error_reporting(E_ALL);
define('CLI', (PHP_SAPI == 'cli') ? true : false);
define('EOL', CLI ? PHP_EOL : '<br />');
define('SCRIPT_FILENAME', basename($_SERVER['SCRIPT_FILENAME'], '.php'));
define('IS_INDEX', SCRIPT_FILENAME == 'index');

require_once __DIR__ . '\PhpWord2\Autoloader.php';

Autoloader::register();
Settings::loadConfig();

//////////////******************************************/////////////////////////////




/*////////////////////////////////////////////****************///////////////////////



?>