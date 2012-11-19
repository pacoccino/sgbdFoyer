ag<?php

error_reporting(E_ALL);
/* projet SGBD Foyer

*/
//include("src/config.php");

$config->sqlImpl = "sqlite";
$config->datbaseName = "sql/sqlit.db";
function class_autoload($class) {
	 include 'src/classes/' . $class . '.class.php';
}
function lib_autoload($class) {
	 include 'src/libs/' . $class . '.lib.php';
}

spl_autoload_register('class_autoload');
spl_autoload_register('lib_autoload');
echo $config->databaseName;
$core = new Core();
$core->start();


?>

