<?php

class JeuxPage extends Layout{
	
	public function __construct() {
		$this->pageTitle = "Jeux";
	}
	
	public function headerPlus() {

	}
	
	public function bodyHTML() {
// -----------------------------------
// Debut Body
// -----------------------------------
?>

<script type="text/javascript">
function addJeu(param) {
	$.post("post.php", { action: "addjeu", nom: param[0].value, date: param[1].value , prix: param[2].value , etat: param[3].value },
	  function(data){
	    $( "#jeu-added" ).html(data); 
	    $( "#jeu-added" ).dialog( "open" );
	  });
}

function delete_jeu( id, nom ) {
	if(confirm("Etes vous sur de vouloir supprimer le jeu "+nom+" ?"))
	{
		$.get("get.php", { action: "delete_jeu", id_el: id },
	  function(data){
	    alert(data);
	    location.reload();
	  });
	}
	
}

$(function() {
    var nom = $( "#nom" ),
        date = $( "#date" ),
        prix = $( "#prix" ),
        etat = $( "#etat" ),
        allFields = $( [] ).add( nom ).add( date ).add( prix).add( etat);
 
        $( "#dialog-form" ).dialog({
        autoOpen: false,
        height: 410,
        width: 350,
        modal: true,
        show: "explode",
        buttons: {
            "Ajouter": function() {
                var bValid = true;
                
                bValid = bValid && checkLength( nom, "nom", 2, 20 );
                //bValid = bValid && checkLength( date, "date", 2, 20 );
                //bValid = bValid && checkLength( prix, "prix", 1, 20 );
                //bValid = bValid && checkLength( etat, "etat", 2, 30 );
 
                    if ( bValid ) {

                    	addJeu(allFields);
                    $( this ).dialog( "close" );
               		}
            },
            "Annuler": function() {
                $( this ).dialog( "close" );
            }
        },
        close: function() {
            allFields.val( "" ).removeClass( "ui-state-error" );
            }
        });
 
        $( "#create-user" )
        .button()
        .click(function() {
            $( "#dialog-form" ).dialog( "open" );
        });
        
        $( "#jeu-added" ).dialog({
            autoOpen: false,
            show: "blind",
            hide: "explode",
            buttons: {
            "Ok": function() {
  				 location.reload();
               		}
            }
        });
        
        $( "#date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd"
        });
        
        $( "button" ).button();
        $('.bubu_del').button({
            icons: {
                primary: "ui-icon-trash"
            },
            text: false
        });
});
</script>


<div id="liste" class="ui-widget">
    <h1>Liste des jeux :</h1>
	<button id="create-user">Ajouter un nouveau jeu</button>
	<div id="jeu-added" title="Status">
	<p>Le jeu a bien été ajouté.</p>
	</div>
    <table id="users" class="ui-widget ui-widget-content">
        <thead>
            <tr class="ui-widget-header ">
				<th>Id</th>
				<th>Nom</th>
				<th>Date d'achat</th>
				<th>Prix d'achat</th>
				<th>Etat</th>
				<th>Edition</th>
            </tr>
        </thead>
        <tbody>
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
						echo "<tr>";
						echo "<td>".$jeu->id."</td>";
						echo "<td>".$jeu->nom."</td>";
						echo "<td>".$jeu->date."</td>";
						echo "<td>".$jeu->prix."</td>";
						echo "<td>".$jeu->etat."</td>";
						echo "<td>
							<button class='bubu_del' onclick='javascript:delete_jeu(".$jeu->id.", \"".$jeu->nom."\")'></button>
						</td>";
						echo "</tr>";
				} 
			}
		?>
        </tbody>
    </table>
</div>
		

    <div id="dialog-form" title="Ajouter un jeu">
    <p class="validateTips">Tous les champs sont requis.</p>
 
    <form>
    <fieldset>
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" class="text ui-widget-content ui-corner-all" />
        <label for="date">Date d'achat</label>
        <input type="text" id="date"  class="text ui-widget-content ui-corner-all"/>
        <label for="prix">Prix d'achat</label>
        <input type="text" name="prix" id="prix" value="" class="text ui-widget-content ui-corner-all" />
        <label for="etat">Etat</label>
        <input type="text" name="etat" id="etat" value="" class="text ui-widget-content ui-corner-all" />
    </fieldset>
    </form>
</div>
		<?php
// -----------------------------------
// Fin Body
// -----------------------------------
	}
}
?>
