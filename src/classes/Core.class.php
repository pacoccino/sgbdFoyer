<?php
class Core {
	
	public $dbInter;
	public $debugText="";
	
	public function __construct() {
		$this->createDB();
	}
	
	public function createDB() {
		global $config;
		switch($config->sqlImpl){
		case "sqlite3":
			//if(class_exists('SQLiteDatabase'))
			if(class_exists('SQLite3'))
				$this->dbInter = new sqliteInterface($config);
			else 
				die("SQLite 3 NOT supported.");
			$this->debugText = $this->debugText."SQLite connected.";
			break;
		case "mysql":
			if(class_exists('MYSQLi'))
			$this->dbInter = new mysqlInterface($config);
			else 
				die("MySQL NOT supported.");
			$this->debugText = $this->debugText."mySQL connected.";
			break;
		default:
			//if(class_exists('SQLiteDatabase'))
			if(class_exists('SQLite3'))
				$this->dbInter = new sqliteInterface($config);
			elseif(class_exists('Mysqli'))
				$this->dbInter = new mysqlInterface($config);
			else
				die("You don't support any databases :(");
		}
	}

	public function start()
	{
		$core = $this;

		if(isset($_GET['raz']))
			$this->razDB();
		elseif(isset($_GET['action'])) {
			switch($_GET['action']) {
				case "liste":
					$page = new Liste($this);
					break;
				case "ajout":
					$page = new Ajout($this);
					break;
				case "suppression":
					$page = new Suppression($this);
					break;
				default:
					$page = new Liste($this);
			}
			
		}
		else
			$page = new Liste($this);
		$page->toHTML();
		
	}
	
	public function pouet()
	{
		echo "pouet";
	}
	
	public function debugHTML() {
		echo $this->debugText;
	}
	
	public function pageHTML() {
		echo "Moi, j'aime le nougat:<br/>";
		echo "Marcel a un poisson rouge.";
		
		
	}
	public function sqlHTML() {
		if(isset($_POST['sqlreq']))
		{
			$result= $this->dbInter->query($_POST['sqlreq']);;
			if(!($result))
			{
				echo "Erreur de requete : ".$this->dbInter->errorMsg();
			}
			elseif($this->dbInter->testEmpty())
				echo "Requete executee avec succes, mais sans resultat";
			else
			{
				echo "Donnees : <br />";
				while($res = $this->dbInter->fetch()){ 
					foreach($res as $field=>$value) {
						echo $field ." : ".$value." <br />";
					}
				} 
			}
		}
		else
			echo "null";
		
	}
	public function razDB() {
		$this->dbInter->executeSqlFile("sql/deleteDatabase.sql");
		$this->dbInter->executeSqlFile("sql/createDatabase.sql");
		$this->dbInter->executeSqlFile("sql/initialData.sql");
		echo "db razed";
	}
	 
}
?>
