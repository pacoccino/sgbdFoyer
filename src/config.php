<?php 
$config = new stdClass();
$config->dbType = "mysql";

//configuration pour sqlite
$config->sqliteFile = dirname(__FILE__)."/../sql/sqlite.db";
//$config->sqliteFile = dirname(__FILE__)."/../all/sqlite.db"; //pour l'ecole, creer un dossier avec permissions 777

//configuration pour mysql
$config->mysqlDB = new stdClass();
$config->mysqlDB->host = "localhost";
$config->mysqlDB->user = "root";
$config->mysqlDB->password = "pouet";
$config->mysqlDB->db = "projetSGBD";
$config->mysqlDB->port = 3306;
?>
