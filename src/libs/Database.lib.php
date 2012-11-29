<?php

class Database implements genericInterface {
	private static $base;
	public static $lastResult;
	
	public static function init() {
		$mysqlDB=Config::$mysqlDB;
		
		try {
		Database::$base = new mysqli($mysqlDB->host, $mysqlDB->user, $mysqlDB->password, $mysqlDB->db);
		} catch(Exception $e)
		{
			die($e);
		}

		
	}

	// en MySQL, les requetes multiples doivent etre separees par des ';'
	public static function query($query, $debug=false) {
		$return = Database::$base->query($query);
		Database::$lastResult=$return;
		if($debug == true && $return == false)
			Core::addDebug(Database::$base->error);
		return $return;
	}
    
    // execute un fichier sql (chemin relatif a la racine)
    public static function executeSqlFile($file)
    {
		$sqlbrut=file_get_contents($file);
		Database::$base->multi_query($sqlbrut);
    }
    
    public static function errorMsg()
    {
		return Database::$base->error;
	}
	
	// recupere la ligne suivante du resultat de la derniere requete, ou du resultat fourni en parametre. A iterer.
	public static function fetch($result = false)
	{
		if($result==false)
			return Database::$lastResult->fetch_assoc();
		else
			return $result->fetch_assoc();
	}
	
	// Retourne vrai si la derniere requete n'a retourne aucun resultat
	public static function testEmpty()
	{
		return (Database::$lastResult->num_rows == 0);
	}
		
    public function test()
    {
        echo "mysql test";
    }
}
?>
