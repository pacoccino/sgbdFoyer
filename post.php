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

if(isset($_POST['action']))
{
	if($_POST['action'] == 'adduser')
	{
			$eleveadd = new Eleve();
			$eleveadd->nom = $_POST['nom'];
			$eleveadd->prenom = $_POST['prenom'];
			$eleveadd->login = $_POST['login'];
			$eleveadd->filliere = $_POST['filliere'];
			$eleveadd->promo = $_POST['promo'];
			if($_POST['isMember'] == "on")
				$eleveadd->isMember = true;
			else
				$eleveadd->isMember = false;

			if($eleveadd->addToDatabase())
				echo "Eleve ajouté.";
			else 
			{
				echo "Erreur d'ajout: ".Database::errorMsg();
				Core::debugHTML();
			}
				
	}
	if($_POST['action'] == 'addlivre')
	{
			$livreadd = new Livre();
			$livreadd->titre = $_POST['titre'];
			$livreadd->auteur = $_POST['auteur'];
			$livreadd->editeur = $_POST['editeur'];
			$livreadd->isbn = $_POST['isbn'];
			
			if($livreadd->addToDatabase())
				echo "Livre ajouté.";
			else 
				echo "Erreur d'ajout: ".Database::errorMsg();
	}
	if($_POST['action'] == 'addevt')
	{
			$evtadd = new Evenement();
			$evtadd->date = $_POST['date'];
			$evtadd->lieu = $_POST['lieu'];
			
			if($evtadd->addToDatabase())
				echo "Evènement ajouté.";
			else 
			{
				echo "Erreur d'ajout: ".Database::errorMsg();
				Core::debugHTML();
			}
				
	}
	if($_POST['action'] == 'addjeu')
	{
			$jeuadd = new Jeu();
			$jeuadd->nom = $_POST['nom'];
			$jeuadd->date = $_POST['date'];
			$jeuadd->prix = $_POST['prix'];
			$jeuadd->etat = $_POST['etat'];
			
			if($jeuadd->addToDatabase())
				echo "Jeu ajouté.";
			else 
				{
					echo "Erreur d'ajout: ".Database::errorMsg();
					Core::debugHTML();
				}
	}
	if($_POST['action'] == 'sqlreq')
	{
			$result= Database::query($_POST['sql']);
			if($result==false)
			{
				echo "Erreur de requete : ".Database::errorMsg();
			}
			elseif(Database::testEmpty())
				echo "Requete executee avec succes, mais sans resultat";
			else
			{
				while($res = Database::fetch()){ 
					foreach($res as $field=>$value) {
						echo $field ." : ".$value." <br />";
					}
					echo "<br/>";
				} 
			}
	}
}
else echo "Moutonneux Sven Taton";
?>
