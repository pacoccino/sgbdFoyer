<?php

class ParticiperPage extends Layout{
	private $statusrend="";
	private $statusemp="";
	
	public function __construct()
	{
		if(!isset($_SESSION['loggedin']))
			die("Bad request");
		$this->pageTitle = "Participation";
		if(isset($_GET['rendre']))
		{
			$testifgood = Database::query("SELECT id_emprunt FROM EMPRUNT WHERE date_rendu is null AND id_emprunt = ".$_GET['rendre']." AND id_eleve = ".$_SESSION['loggedin']);
			if($testifgood->num_rows ==1)
			{
				$sql = "UPDATE EMPRUNT SET date_rendu = DATE(NOW()) WHERE id_emprunt = ".$_GET['rendre'];
				if(Database::query($sql))
					$this->statusrend="<font color='green'>Vous avez bien rendu le livre</font>";
				else {
					$this->statusrend="<font color='red'>Erreur inconnue</font>";
				}
			}
			else
				$this->statusrend="<font color='red'>Requete invalide...</font>";
			
		}
		if(isset($_POST['posted']))
		{
			// Nombre d'exemplaires dispos
			$query = "SELECT EXEMPLAIRE.id_exemplaire
			FROM EXEMPLAIRE LEFT JOIN LIVRE_EMPRUNTE ON EXEMPLAIRE.id_exemplaire = LIVRE_EMPRUNTE.id_exemplaire 
			WHERE EXEMPLAIRE.empruntable = TRUE AND LIVRE_EMPRUNTE.id_emprunt is null AND EXEMPLAIRE.id_livre = ".$_POST['id_li'];
			$exempdispo = Database::query($query);
			
			if($exempdispo->num_rows > 0)
			{
				$firstex = Database::fetch();
				$query = "INSERT INTO EMPRUNT (id_eleve, date_emprunt, id_exemplaire) values ( ".$_SESSION['loggedin'].", DATE(NOW()), ".$firstex['id_exemplaire'].")";
				if(Database::query($query))
					$this->statusemp = "<font color='green'>Vous avez bien emprunté le livre</font>";
				else
					$this->statusemp = "<font color='red'>Vous n'avez pas pu emprunter le livre</font>";
			}
			else
			{
				$this->statusemp="Erreur, il n'y a aucun exemplaire disponible de ce livre";
			}
		}
	}
	// cette fonction est ce que va afficher la page web
	public function bodyHTML() {
?>
<style>
	input {margin : 10px;}
</style>
    <script>
$(function() {
 
    $( "button" ).button();

});
    </script>
<h1>Liste des évenements auxquels vous participez</h1>
<?php
echo $this->statusrend;
$sql= "SELECT * FROM EMPRUNT WHERE date_rendu is null AND id_eleve = ".$_SESSION['loggedin'];
$result = Database::query($sql);
if(!($result))
{
	echo "Erreur de requete : ".Database::errorMsg();
}
elseif($result->num_rows==0)
{
	echo "<p>Vous n'avez aucun emprunt en cours</p>";
}
else
{
	echo "<ul>";
	while($res = Database::fetch($result))
	{
		$sql = "SELECT DISTINCT LIVRE.id_livre, LIVRE.titre 
		FROM EXEMPLAIRE LEFT JOIN LIVRE ON EXEMPLAIRE.id_livre = LIVRE.id_livre 
		WHERE EXEMPLAIRE.id_exemplaire = ".$res['id_exemplaire'];
		$livretitre = Database::query($sql);
		$livretitre = Database::fetch($livretitre);
		$livretitre = $livretitre['titre'];
		echo "<li>".$livretitre." depuis le ".$res['date_emprunt'].". <a href='index.php?action=participer&quitter=".$res['id_emprunt']."'>Quitter l'évènement</a></li>";
	} 
	echo "</ul>";
}
?>
<h1>Participer a un évènement</h1>
<?php echo $this->statuspart; ?>
<form action="index.php?action=participer" method=post>
<input type="hidden" name="posted" value="yes"/>
<table >
<tr>
	<td><label for="id_ev">Prochains évènements</label></td>
<td><select name="id_ev" id="id_ev">

        <?php
        $sql = "SELECT * FROM EVENEMENT WHERE date_evt > DATE(NOW())";
        $result=Database::query($sql);
			if(!($result))
			{
				echo "Erreur de requete : ".Database::errorMsg();
			}
			else
			{
				while($res = Database::fetch($result))
				{					
					echo "<option value='".$res['id_evt']."'>".$res['date']." a ".$res['lieu']."</option>";
				} 
			}
        ?>
</select></td>
</tr>

</table>
<button id="post">Emprunter</button>
</form>
	
<?php
	}
}
?>
