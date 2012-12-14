<?php

class CommentPage extends Layout{
	private $status="";
	
	public function __construct()
	{
		$this->pageTitle = "Commenter";
		if(isset($_POST['posted']))
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
					
				$sql="INSERT INTO COMMENTAIRE (id_eleve, texte, note, $type) values ( ".$id_eleve.", '".$_POST['texte']."', '".$_POST['note']."', $id )";
				if(Database::query($sql))
					$this->status = "Commentaire ajouté";
				else
					$this->status = "Erreur de requete".Database::errorMsg();
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
<h1>Faire un commentaire</h1>
<?php echo $this->status;?>
<form action="index.php?action=comment" method=post>
<input type="hidden" name="posted" value="yes"/>
<table style="padding: :20px;">
<tr>
	<td><label for="evt">Ajouter en tant que</label></td>
<td><select name="id_el" id="id_el">
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
					$eleve = new Eleve($res);
					
					echo "<option value='".$eleve->id."'>".$eleve->prenom." ".$eleve->nom."</option>";
				} 
			}
        ?>
</select></td>
</tr>
<tr>
	<td><label for="evt">Evenement</label></td>
<td><select name="evt" id="evt" onchange="$('#jeu').val('-1')">
        <option value="-1">Aucun evenement</option>
        <?php
        
        $result=Evenement::getListe();
			if(!($result))
			{
				echo "Erreur de requete : ".Database::errorMsg();
			}
			else
			{
				while($res = Database::fetch($result))
				{
					$evenement = new Evenement($res);
					
					echo "<option value='".$evenement->id."'>".$evenement->date." a ".$evenement->lieu."</option>";
				} 
			}
        ?>
</select></td>
</tr>
<tr>
<td><label for="jeu">Jeu</label></td>
<td><select name="jeu" id="jeu" onchange="$('#evt').val('-1')">
        <option value="-1">Aucun jeu</option>
        <?php
        
        $result=Jeu::getListe();
			if(!($result))
			{
				echo "Erreur de requete : ".Database::errorMsg();
			}
			else
			{
				while($res = Database::fetch($result))
				{
					$jeu = new Jeu($res);
					
					echo "<option value='".$jeu->id."'>".$jeu->nom."</option>";
				} 
			}
        ?>
</select></td>
<tr>
<td><label for="text">Commentaire</label></td>
<td><textarea rows="5" cols="30" name="texte" id="texte"></textarea></td>
</tr><tr>
<td><label for="note">Note</label></td>
<td><select id="note">
	<?php
	for($i=0; $i<=10; $i++)
	{
		echo "<option value='$i''>$i</option>";
	}
 ?>
</select></td></tr>
</table>

<button id="post">Ajouter</button>
</form>
	
<?php
	}
}
?>
