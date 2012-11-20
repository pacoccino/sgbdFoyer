<?php

class mysqlInterface implements genericInterface {
	private $base;
	public $lastResult;
	
	public function __construct($config) {
		$mysqlDB=$config->mysqlDB;
		
		try {
		$this->base = new mysqli($mysqlDB->host, $mysqlDB->user, $mysqlDB->password, $mysqlDB->db);
		} catch(Exception $e)
		{
			die($e);
		}

		
	}
    public function test()
    {
        echo "mysql test";
    }
	

	// en MySQL, les requetes multiples doivent etre separees par des ';'
	public function query($query, $debug=false) {
		$return = $this->base->query($query);
		$this->lastResult=$return;
		if($debug == true && $return == false)
			echo $this->base->error;
		return $return;
	}
    
    // execute un fichier sql (chemin relatif a la racine)
    public function executeSqlFile($file)
    {
		$sqlbrut=file_get_contents($file);
		$this->base->multi_query($sqlbrut);
    }
    
    public function errorMsg()
    {
		return $this->base->error;
	}
	
	// recupere la ligne suivante du resultat de la derniere requete, ou du resultat fourni en parametre. A iterer.
	public function fetch($result = false)
	{
		if(result==false)
			return $this->lastResult->fetch_assoc();
		else
			return $result->fetch_assoc();
	}
	
	// Retourne vrai si la derniere requete n'a retourne aucun resultat
	public function testEmpty()
	{
		return $this->lastResult->numrows == 0;
	}
	
}
?>
