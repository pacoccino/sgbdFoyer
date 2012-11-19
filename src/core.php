<?php
include("config.php");


include("libs/dbInterface.php");

class Core {
	
	public $dbInter;
	
	public function __construct() {
		global $config;
		switch($config->sqlImpl){
		case "mysql":
			$this->dbInter = new mysqlInterface();
			break;
		default:
			//$dbInter = new mysqlInterface();
			$this->dbInter = new mysqlInterface();
		}
	}

	public function start()
	 {
		global $core;
		include("src/ressources/index.php");
		$this->dbInter->connect();
	 }
	 
}
?>
