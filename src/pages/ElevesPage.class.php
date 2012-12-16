<?php

class ElevesPage extends Layout{
	
	public function __construct() {
		$this->pageTitle = "Eleves";
	
		/*	
		Core::addDebug("InListe");
		if(isset($_POST['a_adding']))
		{
			$eleveadd = new Eleve();
			$eleveadd->nom = $_POST['nom'];
			$eleveadd->prenom = $_POST['prenom'];

			if($eleveadd->addToDatabase())
				Core::addDebug("Eleve ajouté.");
			else 
				Core::addDebug("<br /> Erreur d'ajout.");
		}*/
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
	$.post("post.php", { action: "adduser", nom: param[0].value, prenom: param[1].value , login: param[2].value , filliere: param[3].value , promo: param[4].value , mem_an: param[5].value , id: param[6].value},
	  function(data){
	    $( "#eleve-added" ).html(data); 
	    $( "#eleve-added" ).dialog( "open" );
	  });
}

function open_info( id ) {
	$.get("get.php", { action: "get_eleve_info", id_el: id },
	  function(data){
	    $( "#dialog-info" ).html(data);
   		 $( "#dialog-info" ).dialog( "open" );
	  });
}
function edit( id ) {
	$("#id_el").val(id);
	$("#dialog-form").dialog("option", "title", "Modifier élève");
	$.get("get.php", { action: "get_eleve_data", id_el: id },
	  function(data){
	    $("#nom").val(data.nom);
	    $("#prenom").val(data.prenom);
	    $("#login").val(data.login);
	    $("#filliere").val(data.filliere);
	    $("#promo").val(data.promo);
	    $("#mem_an").val(data.mem_an);
	  } , "json");
	$( "#dialog-form" ).dialog( "open" );
}

function delete_el( id, nom ) {
	if(confirm("Etes vous sur de vouloir supprimer l'élève "+nom+" ?"))
	{
		$.get("get.php", { action: "delete_eleve", id_el: id },
	  function(data){
	    alert(data);
	    location.reload();
	  });
	}
	
}
    
$(function() {
    var nom = $( "#nom" ),
        prenom = $( "#prenom" ),
        login = $( "#login" ),
        filliere = $( "#filliere" ),
        promo = $( "#promo" ),
		mem_an = $( "#mem_an" ),
		id = $( "#id_el" ),
        allFields = $( [] ).add( nom ).add( prenom ).add( login).add( filliere).add( promo ).add( mem_an ).add( id );

        $( "#dialog-form" ).dialog({
        autoOpen: false,
        height: 500,
        width: 350,
        modal: true,
        show: "explode",
        buttons: {
            "Creer": function() {
                var bValid = true;
                
                bValid = bValid && checkLength( nom, "nom", 2, 20 );
                bValid = bValid && checkLength( prenom, "prenom", 2, 20 );
                bValid = bValid && checkLength( login, "login", 3, 20 );
                bValid = bValid && checkLength( filliere, "filliere", 2, 5 );
                bValid = bValid && checkLength( promo, "promo", 4, 4 );
 
                    if ( bValid ) {

                    	addEleve(allFields);
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
        	$("#id_el").val(-1);
        	$("#dialog-form").dialog("option", "title", "Creer un nouvel Eleve");
            $( "#dialog-form" ).dialog( "open" );
        });
        
        $( "#eleve-added" ).dialog({
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
	        height: 300,
	        width: 350,
	        modal: true,
	        show: "explode",
	        buttons: {
	            "Fermer": function() {
	                $( this ).dialog( "close" );
	            }}
        	});
 
        $( "#open-info" )
        .button()
        .click(function() {
            $( "#dialog-info" ).dialog( "open" );
        });
        
        $('.bubu').button({
            icons: {
                primary: "ui-icon-search"
            },
            text: false
        });
        $('.bubu_edit').button({
            icons: {
                primary: "ui-icon-contact"
            },
            text: false
        });
        $('.bubu_del').button({
            icons: {
                primary: "ui-icon-trash"
            },
            text: false
        });
        
        $( "button" ).button();
        
        $("#actual").click(function(event){
        	event.preventDefault();
		    document.location.href='index.php?action=eleves';
		  });
        $("#historique").click(function(event){
        	event.preventDefault();
		    document.location.href='index.php?action=eleves&historique';
		  });
		  
		$( "#actual" ).button({
        	icons: {
                primary: "ui-icon-play"
           }});
		$( "#historique" ).button({
        	icons: {
                primary: "ui-icon-script"
           }});
});
</script>

<div id="liste" class="ui-widget">
    <h1>Liste des élèves:</h1>
    
		<button id="actual">Eleves actuels</button> 
		<button id="historique">Historique</button> 
		<button id="create-user">Creer nouvel Eleve</button>
		<div id="eleve-added" title="Status">
		    <p>L'eleve a bien été ajouté.</p>
		</div>
    <table id="users" class="ui-widget ui-widget-content">
        <thead>
            <tr class="ui-widget-header ">
				<th width="4em">Id</th>
				<th>Nom</th>
				<th>Prenom</th>
				<th>Login</th>
				<th>Filliere</th>
				<th width="6em">Promo</th>
				<th>Membre</th>
				<th>Infos</th>
            </tr>
        </thead>
        <tbody>
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
					if((!isset($_GET['historique']) && $eleve->promo >= date('Y')) || (isset($_GET['historique']) && $eleve->promo < date('Y')))
					{
						echo "<tr>";
						echo "<td>".$eleve->id."</td>";
						echo "<td>".$eleve->nom."</td>";
						echo "<td>".$eleve->prenom."</td>";
						echo "<td>".$eleve->login."</td>";
						echo "<td>".$eleve->filliere."</td>";
						echo "<td>".$eleve->promo."</td>";
						if($eleve->isMember)
							echo "<td>Oui (".$eleve->annee_membre.")</td>";
						else
							echo "<td></td>";
						echo "<td>
						<button title='Voir nombre d'evenements' class='bubu' onclick='javascript:open_info(".$eleve->id.")'></button>
						<button title='Editer' class='bubu_edit' onclick='javascript:edit(".$eleve->id.")'></button>
						<button title='Supprimer' class='bubu_del' onclick='javascript:delete_el(".$eleve->id.", \"".$eleve->prenom." ".$eleve->nom."\")'></button>
						</td>";
		
						echo "</tr>";
					}
				} 
			}
		?>
        </tbody>
    </table>
</div>

    <div id="dialog-form" title="Creer un nouvel Eleve">
    <p class="validateTips">Tous les champs sont requis.</p>
 
    <form>
    <fieldset>

        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" class="text ui-widget-content ui-corner-all" />
        <label for="prenom">Prenom</label>
        <input type="text" name="prenom" id="prenom" value="" class="text ui-widget-content ui-corner-all" />
        <label for="login">Login</label>
        <input type="text" name="login" id="login" value="" class="text ui-widget-content ui-corner-all" />
        <label for="filliere">Filliere</label>
        <input type="text" name="filliere" id="filliere" value="" class="text ui-widget-content ui-corner-all" />
        <label for="promo">Promo</label>
        <input type="text" name="promo" id="promo" value="" class="text ui-widget-content ui-corner-all" />
        <label for="mem_an">Année de direction (laisser vide sinon)</label>
        <input type="text" name="mem_an" id="mem_an" class="text ui-widget-content ui-corner-all" placeholder="Facultatif"  />
    	<input type="hidden" id="id_el" name="id_el" value="-1" />
    </fieldset>
    </form>
</div>

<div id="dialog-info" title="Informations">
   infos
</div>

		<?php
// -----------------------------------
// Fin Body
// -----------------------------------
	}
}
?>
