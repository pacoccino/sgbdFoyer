<?php

class Jeu {
	public $id;
	public $nom;
	public $date;
	public $prix;
	public $etat;
	
	private static $tableName="JEU";
	
	public function __construct($jeu = false)
	{
		if($jeu != false)
			$this->fetch($jeu);
	}
	
	public function fetch($result)
	{
		$this->id = $result['id_jeu'];
		$this->nom = $result['nom_jeu'];
		$this->date = $result['date_jeu'];
		$this->prix = $result['prix_jeu'];
		$this->etat = $result['etat'];		
	}

	public static function get($i)
	{
		$query = "select * from ".Jeu::$tableName." where id_jeu=$i";
		$results = Database::query($query);
		return $results;
	}
	
	public static function getListe() 
	{

		$query = "select * from ".Jeu::$tableName;
		$results = Database::query($query);
		return $results;
	}
	
	public function getFromDatabase($i)
	{
		$query = "select * from ".Jeu::$tableName." where id_jeu=$i";
		Database::query($query,true);
		$result = Database::fetch();
		$this->fetch($result);

	}
	
	public function deleteFromDatabase()
	{
		$query = "DELETE FROM ".Jeu::$tableName." WHERE id_jeu=".$this->id;
		return Database::query($query);
	}
	
	
	public function addToDatabase()
	{
		if($this->nom=="")
		{
			Core::addDebug("Il manque des arguments");
			return false;
		}
		$query="insert into ".Jeu::$tableName." (nom_jeu, date_jeu, prix_jeu, etat) values ('".$this->nom."', '".$this->date."', ".$this->prix.", '".$this->etat."')";

		return Database::query($query, true);
	}

	public function modifyDatabase()
	{
		if($this->nom=="")
		{
			Core::addDebug("Il manque des arguments");
			return false;
		}
		$query="UPDATE ".Jeu::$tableName." SET nom_jeu='".$this->nom."', date_jeu='".$this->date."', prix_jeu='".$this->prix."', etat='".$this->etat."' WHERE id_jeu=".$this->id;
		
		return Database::query($query, true);
	}
}
?>
