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
		$this->id = $i;
		$this->nom = $result['Nom'];
		$this->prenom = $result['Prenom'];
	}

}
?>
