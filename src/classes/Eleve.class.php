<?php

class Eleve {
	public $id;
	public $nom;
	public $prenom;
	public $login;
	public $filliere;
	public $promo;
	public $isMember;
	public $c;
	
	private static $tableName="Eleves";
	
	public function __construct($eleve = false)
	{
		if($eleve != false)
			$this->fetch($eleve);
	}
	
	public function fetch($result)
	{
		$this->id = $result['id'];
		$this->nom = $result['Nom'];
		$this->prenom = $result['Prenom'];
	}

	public static function getEleve($i)
	{
		$query = "select * from $this->tablename where id_eleve=$i";
	}
	
	public static function getListe() 
	{

		$query = "select * from ".Eleve::$tableName;
		$results = Database::query($query);
		return $results;
	}
	
	public function getFromDatabase($i)
	{
		$query = "select * from ".Eleve::$tableName." where id=$i";
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
		$query="insert into Eleves (Nom, Prenom) values ('".$this->nom."', '".$this->prenom."')";

		return Database::query($query, true);
	}
}
?>
