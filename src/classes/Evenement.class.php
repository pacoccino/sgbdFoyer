<?php

class Evenement {
	public $id;
	public $date;
	public $lieu;
	public $nbParticipants;
	
	private static $tableName="EVENEMENT";
	
	public function __construct($evenement = false)
	{
		if($evenement != false)
			$this->fetch($evenement);
	}
	
	public function fetch($result)
	{
		$this->id = $result['id_evt'];
		$this->date = $result['date_evt'];
		$this->lieu = $result['lieu'];
		Database::query("SELECT COUNT(*)
			FROM EVENEMENT, PARTICIPE
			WHERE EVENEMENT.id_evt = PARTICIPE.id_evt
			AND EVENEMENT.id_evt = ".$this->id);
		$res=Database::fetch();
		$this->nbParticipants=$res['COUNT(*)'];
	}

	public static function get($i)
	{
		$query = "select * from ".Evenement::$tableName." where id_eleve=$i";
		$results = Database::query($query);
		return $results;
	}
	
	public static function getListe() 
	{

		$query = "select * from ".Evenement::$tableName;
		$results = Database::query($query);
		return $results;
	}
	
	public function getFromDatabase($i)
	{
		$query = "select * from ".Evenement::$tableName." where id_evt=$i";
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
		$query="insert into ".Evenement::$tableName." (lieu, date_evt) values ('".$this->lieu."', '".$this->date."')";

		return Database::query($query, true);
	}
}
?>
