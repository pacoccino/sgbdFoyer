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
	$.post("post.php", { action: "addjeu", nom: param[0].value, date: param[1].value , prix: param[2].value , etat: param[3].value, id: param[4].value },
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

function edit( id ) {
	$("#id_jeu").val(id);
	$("#dialog-form").dialog("option", "title", "Modifier jeu");
	$.get("get.php", { action: "get_jeu_data", id_el: id },
	  function(data){
	    $("#nom").val(data.nom);
	    $("#date").val(data.date);
	    $("#prix").val(data.prix);
	    $("#etat").val(data.etat);
	  } , "json");
	$( "#dialog-form" ).dialog( "open" );
}

function open_comments( id ) {
	$.get("get.php", { action: "get_jeu_comments", id_jeu: id },
	  function(data){
	    $( "#dialog-info" ).html(data);
   		 $( "#dialog-info" ).dialog( "open" );
	  });
}


$(function() {
    var nom = $( "#nom" ),
        date = $( "#date" ),
        prix = $( "#prix" ),
        etat = $( "#etat" ),
        id = $( "#id_jeu" ),
        allFields = $( [] ).add( nom ).add( date ).add( prix).add( etat).add( id );
 
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
        	$("#id_jeu").val(-1);
        	$("#dialog-form").dialog("option", "title", "Creer un nouveau jeu");
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
        
        $( "#dialog-info" ).dialog({
	        autoOpen: false,
	        height: 500,
	        width: 350,
	        modal: true,
	        show: "explode",
	        buttons: {
	            "Fermer": function() {
	                $( this ).dialog( "close" );
	            }}
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
        $('.bubu_edit').button({
            icons: {
                primary: "ui-icon-contact"
            },
            text: false
        });
        $('.bubu_com').button({
            icons: {
                primary: "ui-icon-script"
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
				<th>Infos</th>
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
							<button title='Commentaires' class='bubu_com' onclick='javascript:open_comments(".$jeu->id.")'></button>
							<button title='Editer' class='bubu_edit' onclick='javascript:edit(".$jeu->id.")'></button>
							<button title='Supprimer' class='bubu_del' onclick='javascript:delete_jeu(".$jeu->id.", \"".$jeu->nom."\")'></button>
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
        <input type="hidden" id="id_jeu" name="id_jeu" value="-1" />
    </fieldset>
    </form>
</div>
<br /><div id="dialog-info" title="Informations">
   infos
</div>
		<?php
// -----------------------------------
// Fin Body
// -----------------------------------
	}
}
?>
