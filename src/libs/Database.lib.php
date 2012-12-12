<?php

class Database implements genericInterface {
	private static $base;
	public static $lastResult;
	public static $initialized=false;
	
	public static function init() {
		$mysqlDB=Config::$mysqlDB;

		Database::$base = new mysqli($mysqlDB->host, $mysqlDB->user, $mysqlDB->password, "", $mysqlDB->port);
		
		if (Database::$base->connect_error) {
			Core::addDebug("Erreur de connexion");
			die('Erreur de connexion (' . Database::$base->connect_errno . ') '
			            . Database::$base->connect_error);
		}
		
		Database::$initialized=true;		
		
		if(!Database::$base->select_db($mysqlDB->db))
		{
			if(!Database::query("CREATE DATABASE IF NOT EXISTS ".$mysqlDB->db))
				die('Erreur de creation base de donnée: '.Database::$base->error);
			else {
				Core::addDebug("Base de donnée créée");
				if(!isset($_GET['raz']))
					Core::razDB();
			}	
		}
	}
	
	public static function chkinit()
	{
		if(!Database::$initialized)
			die("Erreur critique");
	}

	// en MySQL, les requetes multiples doivent etre separees par des ';'
	public static function query($query, $debug=false) {
		Database::chkinit();
		$return = Database::$base->query($query);
		Database::$lastResult=$return;
		if($debug == true && $return == false)
			Core::addDebug(Database::$base->error);
		return $return;
	}
    
    // execute un fichier sql (chemin relatif a la racine)
    public static function executeSqlFile($file)
    {
		Database::chkinit();	
		$sqlbrut=file_get_contents($file);
		Core::addDebug("Execution de $file");
		if(Database::$base->multi_query($sqlbrut)==true)
		{
			do {
		        /* Stockage du premier résultat */
				$err = Database::$base->error;
				if (!empty($err))
				{
					Core::addDebug($err);
					return false;
				}
				if ($result = Database::$base->store_result())
		            $result->free();
		    } while (Database::$base->more_results() && Database::$base->next_result());
		    Core::addDebug("Fichier execute avec succes");
			return true;
		}
		else 
		{
			Core::addDebug("Erreur :".Database::$base->error);
			return false;
		}
    }
    
    public static function errorMsg()
    {
    	Database::chkinit();
		return Database::$base->error;
	}
	
	// recupere la ligne suivante du resultat de la derniere requete, ou du resultat fourni en parametre. A iterer.
	public static function fetch($result = false)
	{
		Database::chkinit();
		if($result==false)
			return Database::$lastResult->fetch_assoc();
		else
			return $result->fetch_assoc();
	}
	
	// Retourne vrai si la derniere requete n'a retourne aucun resultat
	public static function testEmpty()
	{
		Database::chkinit();
		return (Database::$lastResult->num_rows == 0);
	}
		
    public function test()
    {
        echo "mysql test";
    }
}
?>
