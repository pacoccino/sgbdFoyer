<?php

class Config {
	public static $dbType;
	public static $mysqlDB;
	
	public static function init() {
		include "config.php";
		Config::$dbType = $config->dbType;
		Config::$mysqlDB = $config->mysqlDB;
	}
}
