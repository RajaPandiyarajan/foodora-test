<?php
/**
 * Developer: Raja Pandiyarajan
 * Date: 21/06/2016
 * Revision: 1
 * Purpose of file: Defining common functions and function variables
 */

 include "defaults.php";

// using default magic function to load classes
function foodora_autoloader($class) {
	echo "calling or not"."<br/>";
	$className = BASE_PATH . '/../' . str_replace('\\', '/', $class) . '.php';	
	include($className);
	echo $className;
}

// Connecting to database
function dbConnect() {
	$dbConnect = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUNAME, DBPASS);	
	 $dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbConnect->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	return $dbConnect;
}

function createLog($data){ 
    $logFile = str_replace('\\','/',BASE_PATH.'/../'.LOG_PATH.'/log.txt');
	file_put_contents($logFile, date("Y/m/d H:i:s")."----".$data."\r\n", FILE_APPEND | LOCK_EX);
}


?>