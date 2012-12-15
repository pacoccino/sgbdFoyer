<?php

class BureauPage extends Layout{
	
	private $annee_bureau;
	
	public function __construct() {
		$this->pageTitle = "Bureau des élèves";
		
		if(isset($_GET['annee_bureau']))
		{
			$this->annee_bureau = $_GET['annee_bureau'];
		}
		else 
			$this->annee_bureau = date('Y');
	}
	
	public function headerPlus() {

	}
	
	public function bodyHTML() {
// -----------------------------------
// Debut Body
// -----------------------------------
?>

<script type="text/javascript">

function addEleve(param) {
	$.post("post.php", { action: "adduser", nom: param[0].value, prenom: param[1].value , login: param[2].value , filliere: param[3].value , promo: param[4].value , isMember: param[5].value },
	  function(data){
	    $( "#eleve-added" ).html(data); 
	    $( "#eleve-added" ).dialog( "open" );
	  });
}

$(function() {
      
        $( "button" ).button();
        $( "#change_year" ).button({
        	icons: {
                primary: "ui-icon-calendar"
           }});
        $( "#annee_actuelle" ).button({
        	icons: {
                primary: "ui-icon-play"
           }});
		$( "#historique" ).button({
        	icons: {
                primary: "ui-icon-script"
           }});

        $("#annee_actuelle").click(function(){
        	event.preventDefault();
		    document.location.href='index.php?action=bureau';
		  });
        $("#historique").click(function(){
        	event.preventDefault();
		    document.location.href='index.php?action=bureau&historique';
		  });
});
</script>
<div id="liste" class="ui-widget">
	<?php
	if(isset($_GET['historique']))
		echo "<h1>Historique des Membres du bureau :</h1>";
	else 
		echo "<h1>Liste des Membres du bureau :</h1>";
    ?>
    <form method=GET action="index.php">
    	<input type="hidden" name="action" id="action" value="bureau">
    	<label for="annee_bureau">Année :</label>
        <input type="text" name="annee_bureau" id="annee_bureau" value="<?php echo $this->annee_bureau; ?>" class="ui-widget-content ui-corner-all" />
        <button id="change_year">Changer année</button>
        <button id="annee_actuelle">Membres actuels</button> 
   		<button id="historique">Historique</button> 
    </form>

    <table id="users" class="ui-widget ui-widget-content">
        <thead>
            <tr class="ui-widget-header ">
				<th width="4em">Id</th>
				<th>Nom</th>
				<th>Prenom</th>
				<th>Login</th>
				<th>Filliere</th>
				<th width="6em">Promo</th>
				<th width="6em">Année</th>
            </tr>
        </thead>
        <tbody>
		<?php
			if(isset($_GET['historique']) || (isset($_GET['annee_bureau']) && $_GET['annee_bureau']!=date('Y')))
				$result=Database::query("
							SELECT *
							FROM HISTORIQUE_MEMBRE");
			else {
				$result=Database::query("SELECT *
							FROM MEMBRE_ACTUEL");
			}
			if(!($result))
			{
				echo "Erreur de requete : ".Database::errorMsg();
			}
			else
			{
				while($res = Database::fetch($result))
				{
					$eleve = new Eleve($res);
					if(!(isset($_GET['annee_bureau']) && $_GET['annee_bureau']!=$res['annee']))
					{
						echo "<tr>";
						echo "<td>".$eleve->id."</td>";
						echo "<td>".$eleve->nom."</td>";
						echo "<td>".$eleve->prenom."</td>";
						echo "<td>".$eleve->login."</td>";
						echo "<td>".$eleve->filliere."</td>";
						echo "<td>".$eleve->promo."</td>";
						echo "<td>".$res['annee']."</td>";
						echo "</tr>";
					}
				} 
			}
		
		?>
        </tbody>
    </table>
</div>
		
		<?php
// -----------------------------------
// Fin Body
// -----------------------------------
	}
}
?>
