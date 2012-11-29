<?php

class Liste extends Layout{
	
	public function __construct($core) {
		parent::__construct($core);

		Core::addDebug("InListe");
		if(isset($_POST['a_adding']))
		{
			$eleveadd = new Eleve();
			$eleveadd->nom = $_POST['nom'];
			$eleveadd->prenom = $_POST['prenom'];

			if($eleveadd->addToDatabase())
				Core::addDebug("Eleve ajouté.");
			else 
				Core::addDebug("<br /> Erreur d'ajout.");
		}
	}
	
	public function bodyHTML() {
// -----------------------------------
// Debut Body
// -----------------------------------
?>

<script type="text/javascript">
<!-- 

function request(callback) {
	var xhr = getXMLHttpRequest();
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			callback(xhr.responseText);
		}
	};
	
	var nom = encodeURIComponent(document.getElementById("nom").value);
	var prenom = encodeURIComponent(document.getElementById("prenom").value);
	
	xhr.open("POST", "post.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("action=adduser&nom="+nom+"&prenom="+prenom);
}

function readData(sData) {

	alert("m"+sData);
}

//-->
</script>
		<h1>Liste des Eleves :</h1>
		<br/>
		Ajouter un élève : 
		
				<input type="hidden" name="action" value="adduser">
				<p>
					<label for="nom">Nom :</label>
					<input type="text" name="nom" id="nom" placeholder="Ex : Taton" size="30" />
					<label for="prenom">Prenom :</label>
					<input type="text" name="prenom" id="prenom" placeholder="Ex : Sven" size="30" />
				</p>
				<button onclick="request(readData);"> Ajouter </button>
		
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
		<br/><br/><b>Liste :</b><br /><br />
		<table id="liste">
			<tr>
				<th>Id</th>
				<th>Nom</th>
				<th>Prenom</th>
			</tr>

		<?php
			$result=Eleve::getListe();
			if(!($result))
			{
				echo "Erreur de requete : ".Database::errorMsg();
			}
			else
			{
				while($res = Database::fetch($result))
				{ 
					echo "<tr>";
					$eleve = new Eleve($res);
					echo "<td>".$eleve->id."</td>";
					echo "<td>".$eleve->nom."</td>";
					echo "<td>".$eleve->prenom."</td>";
					echo "</tr>";
				} 
			}
		?>
		</table>
		
		<?php
// -----------------------------------
// Fin Body
// -----------------------------------
	}
}
?>
