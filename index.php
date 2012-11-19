<?php
ini_set('display_errors', E_ALL);
error_reporting(E_ALL);
/* projet SGBD Foyer

*/
include("src/config.php");


function class_autoload($class) {
	 include 'src/classes/' . $class . '.class.php';
}
function lib_autoload($class) {
	 include 'src/libs/' . $class . '.lib.php';
}

spl_autoload_register('class_autoload');
spl_autoload_register('lib_autoload');

$core = new Core();
$core->start();


?>

