<?php

class Liste extends Layout{
	
	public function __construct($core) {
		parent::__construct($core);
		echo "liste";
		$this->core->addDebug("Poil");
		if(isset($_POST['a_adding']))
		{
			echo "pos";
			$insert = "insert into ELEVE (NOM, PRENOM) values ('".$_POST['nom']."', '".$_POST['prenom']."')";
			if(Database::query($insert))
				$this->core->addDebug("Eleve ajouté.");
			else 
				$this->core->addDebug("<br /> Erreur d'ajout.");
		}
	}
	
	public function bodyHTML() {
?>
		<h1>Liste des Eleves :</h1>
		<br/>
		Ajouter un élève : 
		<form method="post" action="index.php?action=liste">
				<input type="hidden" name="a_adding" value="true">
				<p>
					<label for="nom">Nom :</label>
					<input type="text" name="nom" id="nom" placeholder="Ex : Taton" size="30" />
					<label for="prenom">Prenom :</label>
					<input type="text" name="prenom" id="prenom" placeholder="Ex : Sven" size="30" />
				</p>
				<input type="submit" />
		</form>
		<br/>Vue d'un eleve : 
		<form method="post" action="index.php?action=liste">
				<input type="hidden" name="a_viewone" value="true">
				<p>
					<label for="id">Nom :</label>
					<input type="text" name="id" id="id" placeholder="Ex : 3" size="30" />
				</p>
				<input type="submit" />
		</form>
		<?php
		if(isset($_POST['a_viewone']) && !empty($_POST['id']))
		{
			$eleve_view = new Eleve();
			$eleve_view->getFromDatabase($_POST['id']);
			echo "Nom : ".$eleve_view->nom;
		}
		?>
		<br/><br/><u>Liste :</u><br /><br />
		<?php
			$result=Eleve::getListe();
			if(!($result))
			{
				echo "Erreur de requete : ".Database::errorMsg();
			}
			else
			{
				while($res = Database::fetch($result)){ 
					foreach($res as $field=>$value) {
						echo $field ." : ".$value." <br />";
					}
				} 
				if(Database::testEmpty() == true)
					$st = "true";
				else
					$st = "false";
				echo "<br />IsEmpty: ".$st;
			}
			
	}
}
?>
