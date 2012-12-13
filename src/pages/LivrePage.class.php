<?php

class LivrePage extends Layout{
	
	public function __construct() {
		$this->pageTitle = "Livres";
	}
	
	public function headerPlus() {

	}
	
	public function bodyHTML() {
// -----------------------------------
// Debut Body
// -----------------------------------
?>

<script type="text/javascript">

function addLivre(param) {
	$.post("post.php", { action: "addlivre", titre: param[0].value, auteur: param[1].value , editeur: param[2].value , isbn: param[3].value },
	  function(data){
	    $( "#livre-added" ).html(data); 
	    $( "#livre-added" ).dialog( "open" );
	  });
}

function open_info( id ) {
	$.get("get.php", { action: "get_livre_info", id_li: id },
	  function(data){
	    $( "#dialog-info" ).html(data);
   		 $( "#dialog-info" ).dialog( "open" );
	  });
}

function delete_livre( id, nom ) {
	if(confirm("Etes vous sur de vouloir supprimer le livre "+nom+" ?"))
	{
		$.get("get.php", { action: "delete_livre", id_el: id },
	  function(data){
	    alert(data);
	    location.reload();
	  });
	}
	
}
    
$(function() {
    var titre = $( "#titre" ),
        auteur = $( "#auteur" ),
        editeur = $( "#editeur" ),
        isbn = $( "#isbn" ),
        allFields = $( [] ).add( titre ).add( auteur ).add( editeur).add( isbn);
 
        $( "#dialog-form" ).dialog({
        autoOpen: false,
        height: 410,
        width: 350,
        modal: true,
        show: "explode",
        buttons: {
            "Ajouter": function() {
                var bValid = true;
                
                bValid = bValid && checkLength( titre, "titre", 2, 20 );
                bValid = bValid && checkLength( auteur, "auteur", 2, 20 );
                bValid = bValid && checkLength( editeur, "editeur", 2, 20 );
                bValid = bValid && checkLength( isbn, "isbn", 2, 7 );

 
                    if ( bValid ) {

                    	addLivre(allFields);
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
        
        $( "#livre-added" ).dialog({
            autoOpen: false,
            show: "blind",
            hide: "explode",
            buttons: {
            "Ok": function() {
  				 location.reload();
               		}
            }
        });
        
        $( "button" ).button();
        
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
        $('.bubu_del').button({
            icons: {
                primary: "ui-icon-trash"
            },
            text: false
        });
});
</script>

<div id="liste" class="ui-widget">
    <h1>Liste des livres :</h1>
	<button id="create-user">Ajouter un nouveau livre</button>
	<div id="livre-added" title="Status">
	<p>Le livre a bien été ajouté.</p>
	</div>
    <table id="users" class="ui-widget ui-widget-content">
        <thead>
            <tr class="ui-widget-header ">
				<th>Id</th>
				<th>Titre</th>
				<th>Auteur</th>
				<th>Editeur</th>
				<th>ISBN</th>
				<th>Infos</th>
            </tr>
        </thead>
        <tbody>
		<?php
			$result=Livre::getListe();
			if(!($result))
			{
				echo "Erreur de requete : ".Database::errorMsg();
			}
			else
			{
				while($res = Database::fetch($result))
				{
					$livre = new Livre($res);
						echo "<tr>";
						echo "<td>".$livre->id."</td>";
						echo "<td>".$livre->titre."</td>";
						echo "<td>".$livre->auteur."</td>";
						echo "<td>".$livre->editeur."</td>";
						echo "<td>".$livre->isbn."</td>";
						echo "<td>
							<button class='bubu' onclick='javascript:open_info(".$livre->id.")'></button>
							<button class='bubu_del' onclick='javascript:delete_livre(".$livre->id.", \"".$livre->titre."\")'></button>
							</td>";
						echo "</tr>";
				} 
			}
		?>
        </tbody>
    </table>
</div>


    <div id="dialog-form" title="Ajouter un livre">
    <p class="validateTips">Tous les champs sont requis.</p>
 
    <form>
    <fieldset>
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre" class="text ui-widget-content ui-corner-all" />
        <label for="auteur">Auteur</label>
        <input type="text" name="auteur" id="auteur" value="" class="text ui-widget-content ui-corner-all" />
        <label for="editeur">Editeur</label>
        <input type="text" name="editeur" id="editeur" value="" class="text ui-widget-content ui-corner-all" />
        <label for="isbn">ISBN</label>
        <input type="text" name="isbn" id="isbn" value="" class="text ui-widget-content ui-corner-all" />
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
