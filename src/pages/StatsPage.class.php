<?php

class StatsPage extends Layout{
	
	public function __construct()
	{
		$this->pageTitle = "Statistiques";
	}
	// cette fonction est ce que va afficher la page web
	public function bodyHTML() {
?>

<h1>Statistiques</h1>
<p align='center'><b>Moyenne des livres empruntés durant un mois sur un an : </b>
<i>
<?php
$sql ="SELECT sum(total.an)/ 12 AS moyenne 
FROM (SELECT count(*) AS an 
        FROM EMPRUNT 
  	WHERE YEAR(date_rendu)='2012' 
	GROUP BY MONTH(date_rendu)) AS total;";
Database::query($sql);
$res=Database::fetch();
$nb=$res['moyenne'];
echo $nb;
?>
</i></p>

	<?php
$sql ="SELECT LIVRE.titre, count(*) as nombre 
		FROM LIVRE, EXEMPLAIRE, EMPRUNT 
		WHERE LIVRE.id_livre = EXEMPLAIRE.id_livre 
		AND EXEMPLAIRE.id_exemplaire = EMPRUNT.id_exemplaire 
		GROUP BY LIVRE.titre 
		ORDER BY nombre DESC;";
Database::query($sql);
echo "<div id='liste'><table>
<caption><b>Classement des livres les plus lus :</b></caption>
<tr><th>Titre</th><th>Nombre</th></tr>";
while($res = Database::fetch($result))
	{
		echo "<tr>";
		echo "<td>".$res['titre']."</td>";
		echo "<td>".$res['nombre']."</td>";
		echo "</tr>";
		} 
echo "</table></div>";
?>

	<?php
$sql ="SELECT nom_jeu, SUM(nombre) AS total
		FROM JEU, UTILISE, 
		     (SELECT EVENEMENT.id_evt, count(*) AS nombre 
		     FROM PARTICIPE, EVENEMENT 
		     WHERE EVENEMENT.id_evt = PARTICIPE.id_evt 
		     GROUP BY EVENEMENT.id_evt) AS PARTICIPATION
		WHERE JEU.id_jeu = UTILISE.id_jeu
		AND UTILISE.id_evt = PARTICIPATION.id_evt
		GROUP BY JEU.id_jeu
		ORDER BY total DESC;";
Database::query($sql);
echo "<div id='liste'><table>
<caption><b>Classement des jeux selon le nombre d'entrées total réalisé lors des évènements durant lesquels ils ont étés utilisés :</b></caption>
<tr><th>Nom du jeu</th><th>Entrées</th></tr>";
while($res = Database::fetch($result))
	{
		echo "<tr>";
		echo "<td>".$res['nom_jeu']."</td>";
		echo "<td>".$res['total']."</td>";
		echo "</tr>";
		} 
echo "</table></div>";
?>

<?php
	}
}
?>
