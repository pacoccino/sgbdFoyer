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

}
else echo "Moutonneux Sven Taton";
?>
