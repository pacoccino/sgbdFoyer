<?php

class ParticiperPage extends Layout{
	private $statusquitte="";
	private $statuspart="";
	
	public function __construct()
	{
		if(!isset($_SESSION['loggedin']))
			die("Bad request");
		$this->pageTitle = "Participation";
		if(isset($_GET['quitter']))
		{
			$sql = "DELETE FROM PARTICIPE WHERE id_eleve = ".$_SESSION['loggedin']." AND id_evt = ".$_GET['quitter'];
			if(Database::query($sql))
				$this->statusquitte="<font color='green'>Vous avez bien été désinscrit</font>";
			else {
				$this->statusquitte="<font color='red'>Erreur inconnue</font>";
			}
			
		}
		if(isset($_POST['posted']))
		{
			$query = "INSERT INTO PARTICIPE (id_eleve, id_evt) values ( ".$_SESSION['loggedin'].", ".$_POST['id_ev'].")";
			if(Database::query($query))
				$this->statuspart = "<font color='green'>Vous avez été inscrit</font>";
			else
				$this->statuspart = "<font color='red'>Vous participez déja a cet evenement</font>";
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
echo $this->statusquitte;
$sql= "SELECT * FROM PARTICIPE JOIN EVENEMENT ON PARTICIPE.id_evt = EVENEMENT.id_evt WHERE EVENEMENT.date_evt > DATE(NOW()) AND  PARTICIPE.id_eleve = ".$_SESSION['loggedin'];
$result = Database::query($sql);
if(!($result))
{
	echo "Erreur de requete : ".Database::errorMsg();
}
elseif($result->num_rows==0)
{
	echo "<p>Vous ne participez a aucun evenement futur</p>";
}
else
{
	echo "<ul>";
	while($res = Database::fetch($result))
	{
		echo "<li>".$res['date_evt']." a ".$res['lieu'].". <a href='index.php?action=participer&quitter=".$res['id_evt']."'>Quitter l'évènement</a></li>";
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
					echo "<option value='".$res['id_evt']."'>".$res['date_evt']." a ".$res['lieu']."</option>";
				} 
			}
        ?>
</select></td>
</tr>

</table>
<button id="post">S'inscrire</button>
</form>
	
<?php
	}
}
?>
