<?php

class EmpruntPage extends Layout{
	private $status="";
	
	public function __construct()
	{
		if(!isset($_SESSION['loggedin']))
			die("Bad request");
		$this->pageTitle = "Emprunts";
		/*if(isset($_POST['posted']) && isset($_SESSION['loggedin']))
		{
			if($_POST['evt']!="-1" && $_POST['jeu']!="-1")
			{
				$this->status="Erreur ...";
			}
			else
			{
				if($_POST['evt']!=-1)
				{
					$type = "id_evt";
					$id = intval($_POST['evt']);
				}
				elseif($_POST['jeu']!=-1)
				{
					$type = "id_jeu";
					$id = intval($_POST['jeu']);
				}
				$id_eleve=1;
					
				$sql="INSERT INTO COMMENTAIRE (id_eleve, texte, note, $type) values ( ".$_SESSION['loggedin'].", '".Core::$_clean_post['texte']."', ".intval(Core::$_clean_post['note']).", $id )";
				if(Database::query($sql))
					$this->status = "<font color='green'>Commentaire ajouté</font>";
				else
					$this->status = "Erreur de requete".Database::errorMsg();
			}
		}*/
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
<h1>Liste de vos emprunts en cours</h1>
<?php
$sql= "SELECT * FROM EMPRUNT WHERE date_rendu is null AND id_eleve = ".$_SESSION['loggedin'];
$result = Database::query($sql);
if(!($result))
{
	echo "Erreur de requete : ".Database::errorMsg();
}
elseif($result->num_rows==0)
{
	echo "Vous n'avez aucun emprunt en cours";
}
else
{
	echo "<ul>";
	while($res = Database::fetch($result))
	{
		echo "<li>".$res['id_emprunt']."</li>";
	} 
	echo "</ul>";
}
?>
<h1>Emprunter un livre</h1>
<?php echo $this->status; ?>
<form action="index.php?action=comment" method=post>
<input type="hidden" name="posted" value="yes"/>
<table >
<tr>
	<td><label for="evt">Livres disponibles à l'emprunt</label></td>
<td><select name="id_li" id="id_li">

        <?php
        $sql = "SELECT DISTINCT EXEMPLAIRE.id_livre 
        		FROM EXEMPLAIRE LEFT JOIN LIVRE_EMPRUNTE ON EXEMPLAIRE.id_exemplaire = LIVRE_EMPRUNTE.id_exemplaire
				WHERE EXEMPLAIRE.empruntable = TRUE AND LIVRE_EMPRUNTE.id_emprunt is null";
        $result=Database::query($sql);
			if(!($result))
			{
				echo "Erreur de requete : ".Database::errorMsg();
			}
			else
			{
				while($res = Database::fetch($result))
				{
					$livre = new Livre();
					$livre->getFromDatabase($res['id_livre']);
					
					echo "<option value='".$livre->id."'>".$livre->titre."</option>";
				} 
			}
        ?>
</select></td>
</tr>

</table>
<button id="post">Emprunterr</button>
</form>
	
<?php
	}
}
?>
