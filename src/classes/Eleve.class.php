<?php

class Eleve {
	public $id;
	public $nom;
	public $prenom;
	public $login;
	public $filliere;
	public $promo;
	public $isMember=false;
	public $c;
	
	private static $tableName="ELEVE";
	
	public function __construct($eleve = false)
	{
		if($eleve != false)
			$this->fetch($eleve);
	}
	
	public function fetch($result)
	{
		$this->id = $result['id_eleve'];
		$this->nom = $result['nom_eleve'];
		$this->prenom = $result['prenom_eleve'];
		$this->filliere = $result['filliere'];
		$this->login = $result['login'];
		$this->promo = $result['promo'];
		
		$query = "select * from MEMBRE where id_eleve=".$this->id;
		Database::query($query);
		if(Database::$lastResult->num_rows == 1)
			$isMember=true;
	}

	public static function get($i)
	{
		$query = "select * from ".Eleve::$tableName." where id_eleve=$i";
		$results = Database::query($query);
		return $results;
	}
	
	public static function getListe() 
	{

		$query = "select * from ".Eleve::$tableName;
		$results = Database::query($query);
		return $results;
	}
	
	public function getFromDatabase($i)
	{
		$query = "select * from ".Eleve::$tableName." where id_eleve=$i";
		Database::query($query,true);
		$result = Database::fetch();
		$this->fetch($result);

	}
	
	public function addToDatabase()
	{
		if($this->nom=="" || $this->prenom=="")
		{
			Core::addDebug("Il manque des arguments");
			return false;
		}
		$query="insert into ".Eleve::$tableName." (nom_eleve, prenom_eleve, filliere, login, promo) values ('".$this->nom."', '".$this->prenom."', '".$this->filliere."', '".$this->login."', '".$this->promo."')";

		return Database::query($query, true);
	}
}
?>
