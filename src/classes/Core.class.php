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
		case "sqlite":
			if(class_exists('SQLite3'))
				$this->dbInter = new sqliteInterface($config);
			elseif(class_exists('SQLiteDatabase') && class_exists('PDO'))
				$this->dbInter = new oldSqliteInterface($config);
			else 
				die("SQLite NOT supported.");
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
		
		$page=null;
		if(isset($_GET['raz']))
			$this->razDB();
		elseif(isset($_GET['test']))
			$this->testP();
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
					$page = new Accueil($this);
			}
			
		}
		else
			$page = new Accueil($this);
		if($page)
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
		
		echo "Reinitialisation de la base de donnees : ".$this->dbInter->errorMsg();
	}
	 
	public function testP() {
		$bdd=new SQLiteDatabase("all/sql.db");
		$bdd->query("create table ACTEUR(ID NUMBER(3)  not null,NAME   CHAR(20)  not null,constraint pk_member primary key (ID))");
		echo "Reinitialisation de la base de donnees : ".$bdd->lastError();
		echo "test";
	}
	 
}
?>
