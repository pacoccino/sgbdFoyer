<?php

class Eleve {
	public $id=0;
	public $nom;
	public $prenom;
	public $login;
	public $filliere;
	public $promo;
	public $isMember=false;
	public $part_evt=0;
	public $annee_membre=0;
	
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
		
		// L'eleve est il membre ?
		$query = "select COUNT(*) from MEMBRE where id_eleve=".$this->id;
		Database::query($query);
		$cou=Database::fetch();
		if($cou['COUNT(*)']==1)
			$this->isMember=true;
		else
			$this->isMember=false;
		
		// A combien d'evenements l'eleve a t'il participé depuis le debut de l'année ?
		Database::query("SELECT COUNT(*)
			FROM EVENEMENT, PARTICIPE
			WHERE PARTICIPE.id_eleve = ".$this->id."
			AND PARTICIPE.id_evt = EVENEMENT.id_evt
			AND year(EVENEMENT.date_evt) = YEAR(NOW())");
		$res=Database::fetch();
		$this->part_evt=$res['COUNT(*)'];
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
		if(Database::testEmpty())
		{
			$this->id=0;
			Core::addDebug("erreur, getting invalid id");
		}
		else
		{
			$result = Database::fetch();
			$this->fetch($result);
		}
	}
	
	public function deleteFromDatabase()
	{
		$query = "DELETE FROM ".Eleve::$tableName." WHERE id_eleve=".$this->id;
		return Database::query($query);
	}
	
	public function addToDatabase()
	{
		if($this->nom=="" || $this->prenom=="")
		{
			Core::addDebug("Il manque des arguments");
			return false;
		}
		$ret = true;
		$query="insert into ".Eleve::$tableName." (nom_eleve, prenom_eleve, filliere, login, promo) values ('".$this->nom."', '".$this->prenom."', '".$this->filliere."', '".$this->login."', '".$this->promo."')";
		
		$ret = $ret && Database::query($query, true);
		if($this->isMember)
		{
			$query="insert into MEMBRE (id_eleve, annee) values (LAST_INSERT_ID(), ".$this->annee_membre.")";
			$ret = $ret && Database::query($query);
		}
		return $ret;
	}
}
?>
