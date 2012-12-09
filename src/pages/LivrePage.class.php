<?php

class LivrePage extends Layout{
	
	public function __construct($core) {
		parent::__construct($core);

		Core::addDebug("InListe");
		if(isset($_POST['a_adding']))
		{
			$livreadd = new Livre();
			$livreadd->titre = $_POST['titre'];
			$livreadd->auteur = $_POST['auteur'];

			if($livreadd->addToDatabase())
				Core::addDebug("Livre ajouté.");
			else 
				Core::addDebug("<br /> Erreur d'ajout.");
		}
	}
	
	public function headerPlus() {
		?>
		    <style>
		#dialog-form { font-size: 62.5%; }
        label, input { display:block; }
        input.text { margin-bottom:12px; width:95%; padding: .4em; }
        fieldset { padding:0; border:0; margin-top:25px; }
        h1 { font-size: 1.2em; margin: .6em 0; }
        div#liste { width: 350px; margin: 20px 0; }
        div#liste table { margin: 1em 0; border-collapse: collapse; width: 100%; }
        div#liste table td, div#liste table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
        .ui-dialog .ui-state-error { padding: .3em; }
        .validateTips { border: 1px solid transparent; padding: 0.3em; }
    </style>
    <?php
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
                        $( "#users tbody" ).append( "<tr>" +
                        "<td>0</td>" + 
                        "<td>" + titre.val() + "</td>" + 
                        "<td>" + auteur.val() + "</td>" + 
                        "<td>" + editeur.val() + "</td>" +
                        "<td>" + isbn.val() + "</td>" +
                    "</tr>" ); 
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
            hide: "explode"
        });
        
        $( "button" ).button();
});
</script>
<div id="liste" class="ui-widget">
    <h1>Liste des livres :</h1>
    <table id="users" class="ui-widget ui-widget-content">
        <thead>
            <tr class="ui-widget-header ">
				<th>Id</th>
				<th>Titre</th>
				<th>Auteur</th>
				<th>Editeur</th>
				<th>ISBN</th>
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
						echo "</tr>";
				} 
			}
		?>
        </tbody>
    </table>
</div>

    <button id="create-user">Ajouter un nouveau livre</button>
    <div id="livre-added" title="Status">
    <p>Le livre a bien été ajouté.</p>
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

		
		<?php
// -----------------------------------
// Fin Body
// -----------------------------------
	}
}
?>
