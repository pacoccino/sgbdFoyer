<?php
class Core {
	
	private static $debugText="";
	public static $eleve_co;
	public static $_clean_post;
	public static $_clean_get;
	
	public function __construct() {
		Config::init();
		$this->createDB();

		if(isset($_SESSION['loggedin']))
		{
			Core::$eleve_co = new Eleve();
			Core::$eleve_co->getFromDatabase($_SESSION['loggedin']);
		}
		foreach(array_keys($_POST) as $key)
		{
		  Core::$_clean_post[$key] = mysql_real_escape_string($_POST[$key]);
		}
		foreach(array_keys($_GET) as $key)
		{
		  Core::$_clean_get[$key] = mysql_real_escape_string($_GET[$key]);
		}
	}
	
	public function createDB() {

		switch(Config::$dbType){
		/*case "sqlite":
			if(class_exists('SQLite3'))
			{
				$this->dbInter = new sqliteInterface($config);
				$this->addDebug("SQLite3 connected.");
			}
			elseif(class_exists('SQLiteDatabase') && class_exists('PDO'))
			{
				$this->dbInter = new oldSqliteInterface($config);
				$this->addDebug("SQLite2 with PDO connected.");
			}
			else 
				die("SQLite NOT supported.");
			break;*/
		case "mysql":
			if(class_exists('MYSQLi'))
			{
				Database::init();
				$this->addDebug("MySQLi connected.");
			}
			else 
				die("MySQL NOT supported.");

			break;
		default:
			/*if(class_exists('SQLite3'))
				$this->dbInter = new sqliteInterface($config);
			else*/if(class_exists('Mysqli'))
				Database::init();
			else
				die("You don't support any databases :(");
		}
	}

	public function showPage()
	{
		
		$page=null;
		if(isset($_GET['raz']))
		{
			$this::razDB();
			unset($_SESSION['loggedin']);
		}	
		elseif(isset($_GET['test']))
			$this->testP();
		elseif(isset($_GET['action'])) {
			switch($_GET['action']) {
				case "eleves":
					$page = new ElevesPage();
					break;
				case "bureau":
					$page = new BureauPage();
					break;
				case "livres":
					$page = new LivrePage();
					break;
				case "jeux":
					$page = new JeuxPage();
					break;
				case "evt":
					$page = new EvenementsPage();
					break;
				case "sql":
					$page = new SqlPage();
					break;
				case "stats":
					$page = new StatsPage();
					break;
				case "comment":
					$page = new CommentPage();
					break;
				case "emprunt":
					$page = new EmpruntPage();
					break;
				case "participer":
					$page = new ParticiperPage();
					break;
				case "tools":
					$page = new ToolsPage();
					break;
				case "login":
					$page = new UserPage();
					break;
				case "logout":
					$page = new UserPage();
					break;
				case "suppression":
					$page = new Suppression();
					break;
				/* Pour ajouter une page, décommenter ici
				case "nouvellepage":
					$page = new NouvellePage($this);
					break;
				*/
				default:
					$page = new Accueil();
			}
			
		}
		else
			$page = new Accueil($this);
		if($page && $page->showHTML())
			$page->toHTML();
		
	}
	
	public static function debugHTML() {
		echo Core::$debugText;
	}
	
	public static function addDebug($string) {
		Core::$debugText = Core::$debugText.$string."<br />";
	}
		
	public function pageHTML() {
		echo "Moi, j'aime le nougat:<br/>";
		echo "Marcel a un poisson rouge.";
		
		
	}
	public function sqlHTML() {
		if(isset($_POST['sqlreq']))
		{
			$result= Database::query($_POST['sqlreq']);
			if($result==false)
			{
				echo "Erreur de requete : ".Database::errorMsg();
			}
			elseif(Database::testEmpty())
				echo "Requete executee avec succes, mais sans resultat";
			else
			{
				echo "Donnees : <br />";
				while($res = Database::fetch()){ 
					foreach($res as $field=>$value) {
						echo $field ." : ".$value." <br />";
					}
				} 
			}
		}
		else
			echo "null";
		
	}
	
	public static function razDB() {
		Core::addDebug("<b>Reinitialisation de la base de donnees : </b><br />");
		
		Database::executeSqlFile("sql/deleteDatabase.sql");
		Database::executeSqlFile("sql/createDatabase.sql");
		Database::executeSqlFile("sql/initialData.sql");
		
		Core::addDebug("<a href='index.php'>Retour a l'accueil</a><br />");
		
		Core::debugHTML();
	}
	 
	public function testP() {
		$bdd=new SQLiteDatabase("all/sql.db");
		$bdd->query("create table ACTEUR(ID NUMBER(3)  not null,NAME   CHAR(20)  not null,constraint pk_member primary key (ID))");
		echo "Reinitialisation de la base de donnees : ".$bdd->lastError();
		echo "test";
	}
	 
}
?>
