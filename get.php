<?php
/* projet SGBD Foyer

*/

// Debug mode
ini_set('display_errors', E_ERROR);
error_reporting(E_ERROR);


// Chargement automatique des classes et librairies
function class_autoload($class) {
	 include 'src/classes/' . $class . '.class.php';
}
function lib_autoload($class) {
	 include 'src/libs/' . $class . '.lib.php';
}
function pages_autoload($class) {
	 include 'src/pages/' . $class . '.class.php';
}

spl_autoload_register('class_autoload');
spl_autoload_register('lib_autoload');
spl_autoload_register('pages_autoload');

// Demarrage de l'application

header("Content-Type: text/plain");

$core = new Core();

if(isset($_GET['action']))
{
	if($_GET['action'] == 'get_evt_info' && $_GET['id_evt'])
	{
			echo "<h3>Liste des jeux utilisés :</h3>";
			$result=Database::query("SELECT *
				FROM JEU, EVENEMENT, UTILISE
				WHERE JEU.id_jeu = UTILISE.id_jeu
				AND UTILISE.id_evt = EVENEMENT.id_evt
				AND EVENEMENT.id_evt = ".$_GET['id_evt']);
			echo "<ul>";
			while($res = Database::fetch($result))
			{
				echo "<li>".$res['nom_jeu']."</li>";
			} 
			echo "</ul>";
	}
	if($_GET['action'] == 'get_eleve_info' && $_GET['id_el'])
	{
			$eleve = new Eleve();
			$eleve->getFromDatabase($_GET['id_el']);
			echo $eleve->prenom." ".$eleve->nom." a participé depuis le debut de l'année a ".$eleve->part_evt." évenements.";
	}
	if($_GET['action'] == 'get_eleve_data' && $_GET['id_el'])
	{
			$eleve = new Eleve();
			$eleve->getFromDatabase($_GET['id_el']);
			$out = array(
				"nom" => $eleve->nom,
				"prenom" => $eleve->prenom,
				"login" => $eleve->login,
				"filliere" => $eleve->filliere,
				"promo" => $eleve->promo,
				"mem_an" => $eleve->annee_membre
			);
			echo json_encode($out);
	}
	if($_GET['action'] == 'get_evt_data' && $_GET['id_el'])
	{
			$evenement = new Evenement();
			$evenement->getFromDatabase($_GET['id_el']);
			$out = array(
				"date" => $evenement->date,
				"lieu" => $evenement->lieu,
				"nb_part" => $evenement->nbParticipantsMax
			);
			echo json_encode($out);
	}
	if($_GET['action'] == 'get_jeu_data' && $_GET['id_el'])
	{
			$jeu = new Jeu();
			$jeu->getFromDatabase($_GET['id_el']);
			$out = array(
				"nom" => $jeu->nom,
				"date" => $jeu->date,
				"prix" => $jeu->prix,
				"etat" => $jeu->etat
			);
			echo json_encode($out);
	}
	if($_GET['action'] == 'get_livre_data' && $_GET['id_el'])
	{
			$livre = new Livre();
			$livre->getFromDatabase($_GET['id_el']);
			$out = array(
				"titre" => $livre->titre,
				"auteur" => $livre->auteur,
				"editeur" => $livre->editeur,
				"isbn" => $livre->isbn
			);
			echo json_encode($out);
	}
	if($_GET['action'] == 'delete_eleve' && $_GET['id_el'])
	{
			$eleve = new Eleve();
			$eleve->getFromDatabase($_GET['id_el']);
			if($eleve->id!=0 && $eleve->deleteFromDatabase())
			{
				echo "L'utilisateur a bien été supprimé";
			}
			else {
				echo "Requete invalide";
			}
	}
	if($_GET['action'] == 'delete_evt' && $_GET['id_el'])
	{
			$evenement = new Evenement();
			$evenement->getFromDatabase($_GET['id_el']);
			if($evenement->id!=0 && $evenement->deleteFromDatabase())
			{
				echo "L'évènement a bien été supprimé";
			}
			else {
				echo "Requete invalide";
			}
	}
	if($_GET['action'] == 'delete_jeu' && $_GET['id_el'])
	{
			$jeu = new Jeu();
			$jeu->getFromDatabase($_GET['id_el']);
			if($jeu->id!=0 && $jeu->deleteFromDatabase())
			{
				echo "Le jeu a bien été supprimé";
			}
			else {
				echo "Requete invalide";
			}
	}
	if($_GET['action'] == 'delete_livre' && $_GET['id_el'])
	{
			$livre = new Livre();
			$livre->getFromDatabase($_GET['id_el']);
			if($livre->id!=0 && $livre->deleteFromDatabase())
			{
				echo "Le livre a bien été supprimé";
			}
			else {
				echo "Requete invalide";
			}
	}
	if($_GET['action'] == 'get_livre_info' && $_GET['id_li'])
	{
			echo "<h3>Liste adhérents ayant lu :</h3>";
			$livre = new Livre();
			$livre->getFromDatabase($_GET['id_li']);
			echo "<b>".$livre->titre."</b><br/>";
			$result=Database::query("SELECT date_rendu, nom_eleve, prenom_eleve 
			FROM ELEVE, LIVRE, EXEMPLAIRE, EMPRUNT  
			WHERE ELEVE.id_eleve = EMPRUNT.id_eleve  
			AND EMPRUNT.id_exemplaire = EXEMPLAIRE.id_exemplaire  
			AND EXEMPLAIRE.id_livre = LIVRE.id_livre  
			AND LIVRE.id_livre=".$_GET['id_li']." ORDER BY date_rendu DESC");
			echo "<div id='liste'><table><tr><th>Nom</th><th>Prenom</th><th>Date de rendu</th></tr>";
			while($res = Database::fetch($result))
			{
				echo "<tr>";
				echo "<td>".$res['nom_eleve']."</td>";
				echo "<td>".$res['prenom_eleve']."</td>";
				echo "<td>".$res['date_rendu']."</td>";
				echo "</tr>";
			} 
			echo "</table></div>";
	}
	if($_GET['action'] == 'get_jeu_comments' && $_GET['id_jeu'])
	{
			echo "<h3>Commentaires du jeu :</h3>";
			$jeu = new Jeu();
			$jeu->getFromDatabase($_GET['id_jeu']);
			echo "<b>".$jeu->nom."</b><br/>";
			$result=Database::query("SELECT id_eleve, texte, note 
						FROM COMMENTAIRE
						WHERE COMMENTAIRE.id_jeu = ".$_GET['id_jeu']);

			echo "<div id='liste'><table><tr><th>Eleve</th><th>Commentaire</th><th>Note</th></tr>";
			while($res = Database::fetch($result))
			{
				$eleve= new Eleve();
				$eleve->getFromDatabase($res['id_eleve']);
				echo "<tr>";
				echo "<td>".$eleve->prenom." ".$eleve->nom."</td>";
				echo "<td>".$res['texte']."</td>";
				echo "<td>".$res['note']."</td>";
				echo "</tr>";
			} 
			echo "</table></div>";
	}
	if($_GET['action'] == 'get_evt_comments' && $_GET['id_evt'])
	{
			echo "<h3>Commentaires de l'évènement :</h3>";
			$evt = new Evenement();
			$evt->getFromDatabase($_GET['id_evt']);
			echo "<b>Le ".$evt->date." à ".$evt->lieu."</b><br/>";
			$result=Database::query("SELECT id_eleve, texte, note 
						FROM COMMENTAIRE
						WHERE COMMENTAIRE.id_evt = ".$_GET['id_evt']);

			echo "<div id='liste'><table><tr><th>Eleve</th><th>Commentaire</th><th>Note</th></tr>";
			while($res = Database::fetch($result))
			{
				$eleve= new Eleve();
				$eleve->getFromDatabase($res['id_eleve']);
				echo "<tr>";
				echo "<td>".$eleve->prenom." ".$eleve->nom."</td>";
				echo "<td>".$res['texte']."</td>";
				echo "<td>".$res['note']."</td>";
				echo "</tr>";
			} 
			echo "</table></div>";
	}

}
else echo "Moutonneux Sven Taton";
?>
