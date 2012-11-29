<?php

class Config {
	public static $dbType;
	public static $mysqlDB;
	
	public static function init() {
		include "src/config.php";
		Config::$dbType = $config->dbType;
		Config::$mysqlDB = $config->mysqlDB;
	}
}
