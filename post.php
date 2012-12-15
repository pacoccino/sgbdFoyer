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
		$id = intval(Core::$_clean_post['id']);
		if($id==-1 && is_numeric(Core::$_clean_post['promo']))
		{
			$eleveadd = new Eleve();
			$eleveadd->nom = Core::$_clean_post['nom'];
			$eleveadd->prenom = Core::$_clean_post['prenom'];
			$eleveadd->login = Core::$_clean_post['login'];
			$eleveadd->filliere = Core::$_clean_post['filliere'];
			$eleveadd->promo = Core::$_clean_post['promo'];
			if(!empty($_POST['mem_an']) && is_numeric(Core::$_clean_post['mem_an']))
			{
				$eleveadd->isMember = true;
				$eleveadd->annee_membre = Core::$_clean_post['mem_an'];
			}
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
		elseif($id>0)
		{
			$eleveadd = new Eleve();
			$eleveadd->id = $id;
			$eleveadd->nom = Core::$_clean_post['nom'];
			$eleveadd->prenom = Core::$_clean_post['prenom'];
			$eleveadd->login = Core::$_clean_post['login'];
			$eleveadd->filliere = Core::$_clean_post['filliere'];
			$eleveadd->promo = Core::$_clean_post['promo'];
			if(!empty(Core::$_clean_post['mem_an']) && is_numeric(Core::$_clean_post['mem_an']))
			{
				$eleveadd->isMember = true;
				$eleveadd->annee_membre = Core::$_clean_post['mem_an'];
			}
			else
				$eleveadd->isMember = false;

			if($eleveadd->modifyDatabase())
				echo "Eleve modifié.";
			else 
			{
				echo "Erreur de modification: ".Database::errorMsg();
				Core::debugHTML();
			}
		}
		else {
			echo "Erreur d'arguments.";
		}
	}
	if($_POST['action'] == 'addlivre')
	{
		$id = intval(Core::$_clean_post['id']);
		if($id==-1)
		{
			$livreadd = new Livre();
			$livreadd->titre = Core::$_clean_post['titre'];
			$livreadd->auteur = Core::$_clean_post['auteur'];
			$livreadd->editeur = Core::$_clean_post['editeur'];
			$livreadd->isbn = Core::$_clean_post['isbn'];
			
			if($livreadd->addToDatabase())
				echo "Livre ajouté.";
			else 
				echo "Erreur d'ajout: ".Database::errorMsg();
		}
		elseif($id>0)
		{
			$livreadd = new Livre();
			$livreadd->id = $id;
			$livreadd->titre = Core::$_clean_post['titre'];
			$livreadd->auteur = Core::$_clean_post['auteur'];
			$livreadd->editeur = Core::$_clean_post['editeur'];
			$livreadd->isbn = Core::$_clean_post['isbn'];

			if($livreadd->modifyDatabase())
				echo "Livre modifié.";
			else 
			{
				echo "Erreur de modification: ".Database::errorMsg();
				Core::debugHTML();
			}
		}
		else {
			echo "Erreur d'arguments.";
		}
	}
	if($_POST['action'] == 'addevt')
	{
		$id = intval(Core::$_clean_post['id']);
		if($id==-1)
		{
			$evtadd = new Evenement();
			$evtadd->date = Core::$_clean_post['date'];
			$evtadd->lieu = Core::$_clean_post['lieu'];
			$evtadd->nbParticipantsMax = Core::$_clean_post['nb_part'];
			
			if($evtadd->addToDatabase())
				echo "Evènement ajouté.";
			else 
			{
				echo "Erreur d'ajout: ".Database::errorMsg();
				Core::debugHTML();
			}
		}
		elseif($id>0)
		{
			$evtadd = new Evenement();
			$evtadd->id = $id;
			$evtadd->date = Core::$_clean_post['date'];
			$evtadd->lieu = Core::$_clean_post['lieu'];
			$evtadd->nbParticipantsMax = Core::$_clean_post['nb_part'];
			if($evtadd->modifyDatabase())
				echo "Evenement modifié.";
			else 
			{
				echo "Erreur de modification: ".Database::errorMsg();
				Core::debugHTML();
			}
		}
		else {
			echo "Erreur d'arguments.";
		}		
	}
	if($_POST['action'] == 'addjeu')
	{
		$id = intval(Core::$_clean_post['id']);
		if($id==-1)
		{
			$jeuadd = new Jeu();
			$jeuadd->nom = Core::$_clean_post['nom'];
			$jeuadd->date = Core::$_clean_post['date'];
			$jeuadd->prix = Core::$_clean_post['prix'];
			$jeuadd->etat = Core::$_clean_post['etat'];
			
			if($jeuadd->addToDatabase())
				echo "Jeu ajouté.";
			else 
				{
					echo "Erreur d'ajout: ".Database::errorMsg();
					Core::debugHTML();
				}
		}
		elseif($id>0)
		{
			$jeuadd = new Jeu();
			$jeuadd->id = $id;
			$jeuadd->nom = Core::$_clean_post['nom'];
			$jeuadd->date = Core::$_clean_post['date'];
			$jeuadd->prix = Core::$_clean_post['prix'];
			$jeuadd->etat = Core::$_clean_post['etat'];

			if($jeuadd->modifyDatabase())
				echo "Jeu modifié.";
			else 
			{
				echo "Erreur de modification: ".Database::errorMsg();
				Core::debugHTML();
			}
		}
		else {
			echo "Erreur d'arguments.";
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
