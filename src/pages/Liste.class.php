<?php

class Liste extends Layout{
	
	public function __construct($core) {
		parent::__construct($core);
		echo "liste";
		$this->core->debugText = $this->core->debugText."<br /> Poil";
		if(isset($_POST['posted']))
		{
			echo "pos";
			$insert = "insert into ELEVE (NOM, PRENOM) values ('".$_POST['nom']."', '".$_POST['prenom']."')";
			if($this->core->dbInter->query($insert))
				$this->core->debugText = $this->core->debugText."<br /> Eleve ajouté.";
			else 
				$this->core->debugText = $this->core->debugText."<br /> Erreur d'ajout.";
		}
	}
	
	public function bodyHTML() {
?>
		<h1>Liste des Eleves :</h1>
		<br/>
		Ajouter un élève : 
		<form method="post" action="index.php?action=liste">
				<input type="hidden" name="posted" value="true">
				<p>
					<label for="nom">Nom :</label>
					<input type="text" name="nom" id="nom" placeholder="Ex : Taton" size="30" />
					<label for="prenom">Prenom :</label>
					<input type="text" name="prenom" id="prenom" placeholder="Ex : Sven" size="30" />
				</p>
				<input type="submit" />
		</form>
		<br/><u>Liste :</u><br /><br />
		<?php
			$query = "select * from ELEVE";
			$result= $this->core->dbInter->query($query);
			if(!($result))
			{
				echo "Erreur de requete : ".$this->core->dbInter->errorMsg();
			}
			else
			{
				while($res = $this->core->dbInter->fetch($result)){ 
					foreach($res as $field=>$value) {
						echo $field ." : ".$value." <br />";
					}
				} 
				if($this->core->dbInter->testEmpty() == true)
					$st = "true";
				else
					$st = "false";
				echo "<br />IsEmpty: ".$st;
			}
	}
}
?>
