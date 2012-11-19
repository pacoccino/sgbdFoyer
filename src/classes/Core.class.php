<?php

class Core {
	
	public $dbInter;
	
	public function __construct() {
		global $config;
		switch($config->sqlImpl){
		case "sqlite":
			if(class_exists('SQLiteDatabase'))
				$this->dbInter = new sqliteInterface($config);
			else 
				die("SQLite 3 NOT supported.");
			break;
		case "mysql":
			if(class_exists('MYSQLi'))
			$this->dbInter = new mysqlInterface($config);
			else 
				die("MySQL NOT supported.");
			break;
		default:
			$dbInter = new mysqlInterface($config);
			if(class_exists('SQLiteDatabase'))
				$this->dbInter = new sqliteInterface($config);
			elseif(class_exists('Mysqli'))
				$this->dbInter = new mysqlInterface($config);
			else
				die("You don't support any databases :(");
		}
		
		$this->dbInter->connect();
	}

	public function start()
	{
		global $core;
		if(isset($_GET['raz']))
			razDB();
		else {

			include("src/ressources/index.php");
			$this->dbInter->connect();
		}
	}
	
	public function razDB() {
		$this->dbInter->executeSqlFile("../sql/deleteDatabase.sql");
		$this->dbInter->executeSqlFile("../sql/createDatabase.sql");
		$this->dbInter->executeSqlFile("../sql/initialData.sql");
	}
	 
}
?>
