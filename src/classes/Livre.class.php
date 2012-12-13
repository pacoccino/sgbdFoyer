<?php

class Livre {
	public $id;
	public $titre;
	public $auteur;
	public $editeur;
	public $isbn;
	
	private static $tableName="LIVRE";
	
	public function __construct($livre = false)
	{
		if($livre != false)
			$this->fetch($livre);
	}
	
	public function fetch($result)
	{
		$this->id = $result['id_livre'];
		$this->titre = $result['titre'];
		$this->auteur = $result['auteur'];
		$this->editeur = $result['editeur'];
		$this->isbn = $result['ISBN'];
		
	}

	public static function get($i)
	{
		$query = "select * from ".Livre::$tableName." where id_livre=$i";
		$results = Database::query($query);
		return $results;
	}
	
	public static function getListe() 
	{

		$query = "select * from ".Livre::$tableName;
		$results = Database::query($query);
		return $results;
	}
	
	public function getFromDatabase($i)
	{
		$query = "select * from ".Livre::$tableName." where id_livre=$i";
		Database::query($query,true);
		$result = Database::fetch();
		$this->fetch($result);

	}
	
	public function deleteFromDatabase()
	{
		$query = "DELETE FROM ".Livre::$tableName." WHERE id_livre=".$this->id;
		return Database::query($query);
	}
	
	public function addToDatabase()
	{
		if($this->titre=="" || $this->auteur=="" || $this->isbn=="")
		{
			Core::addDebug("Il manque des arguments");
			return false;
		}
		$query="insert into ".Livre::$tableName." (titre, auteur, editeur, ISBN) values ('".$this->titre."', '".$this->auteur."', '".$this->editeur."', ".$this->isbn.")";

		return Database::query($query, true);
	}
}
?>
