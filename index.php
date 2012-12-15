<?php
/* projet SGBD Foyer

*/ 

session_start();

// Debug mode
ini_set('display_errors', E_ERROR);
error_reporting(E_ERROR);

// Chargement automatique des classes et librairies
function class_autoload($class) {
	 include 'src/classes/' . $class . '.class.php';
}
function lib_autoload($class) {
	 include 'src/libs/' . $class . '.lib.php';
}
function pages_autoload($class) {
	 include 'src/pages/' . $class . '.class.php';
}

spl_autoload_register('class_autoload');
spl_autoload_register('lib_autoload');
spl_autoload_register('pages_autoload');

// Demarrage de l'application
$core = new Core();
$core->showPage();

?>

