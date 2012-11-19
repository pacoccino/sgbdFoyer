<?php
/* projet SGBD Foyer

*/ 

// Debug mode
ini_set('display_errors', E_ALL);
error_reporting(E_ALL);

include("src/config.php");

// Chargement automatique des classes et librairies
function class_autoload($class) {
	 include 'src/classes/' . $class . '.class.php';
}
function lib_autoload($class) {
	 include 'src/libs/' . $class . '.lib.php';
}
function ressources_autoload($class) {
	 include 'src/ressources/' . $class . '.class.php';
}

spl_autoload_register('class_autoload');
spl_autoload_register('lib_autoload');
spl_autoload_register('ressources_autoload');

// Demarrage de l'application
$core = new Core();
$core->start();


?>

