<?php
/**
 * Developer: Raja Pandiyarajan
 * Date: 21/06/2016
 * Revision: 1
 * Purpose of the file: defining default parameters for the application
 */

// Report all PHP errors
error_reporting(E_ALL);
// get the base path 
define('BASE_PATH', realpath(dirname(__FILE__)));
define('DBHOST','localhost');
define('DBNAME','foodora-test');
define('DBUNAME','root');
define('DBPASS','');
define("MYSQL_CONN", "Connected to database");
define("LOG_PATH", "\\application\\foodora\\Data\\Logs");
spl_autoload_register('foodora_autoloader');

?>
