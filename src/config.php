<?php 
$config = new stdClass();
$config->sqlImpl = "sqlite3";

//configuration pour sqlite
$config->sqliteFile = dirname(__FILE__)."/../sql/sqlite.db";

//configuration pour mysql
$config->mysqlDB = new stdClass();
$config->mysqlDB->host = "localhost";
$config->mysqlDB->user = "root";
$config->mysqlDB->password = "pouet";
$config->mysqlDB->db = "sgbd";
?>
