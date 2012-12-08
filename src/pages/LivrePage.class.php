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
<!-- 

function addLivre(param) {
	$.post("post.php", { action: "adduser", titre: param[0].value, auteur: param[1].value , editeur: param[2].value , isbn: param[3].value , promo: param[4].value , isMember: param[5].value },
	  function(data){
	    $( "#livre-added" ).html(data); 
	    $( "#livre-added" ).dialog( "open" );
	  });
}

$(function() {
    $( "button" ).button()
});
//-->
</script>
<script>
$(function() {
    var titre = $( "#titre" ),
        auteur = $( "#auteur" ),
        editeur = $( "#editeur" ),
        isbn = $( "#isbn" ),
        allFields = $( [] ).add( titre ).add( auteur ).add( editeur).add( isbn),
        tips = $( ".validateTips" );
 
        function updateTips( t ) {
            tips
                .text( t )
                .addClass( "ui-state-highlight" );
        setTimeout(function() {
            tips.removeClass( "ui-state-highlight", 1500 );
            }, 500 );
        }
 
        function checkLength( o, n, min, max ) {
            if ( o.val().length > max || o.val().length < min ) {
                o.addClass( "ui-state-error" );
            updateTips( "La taille de " + n + " doit etre comprise entre " +
                min + " et " + max + "." );
                return false;
            } else {
                return true;
            }
        }
 
        function checkRegexp( o, regexp, n ) {
            if ( !( regexp.test( o.val() ) ) ) {
                o.addClass( "ui-state-error" );
                updateTips( n );
                return false;
            } else {
                return true;
            }
        }
 
        $( "#dialog-form" ).dialog({
        autoOpen: false,
        height: 500,
        width: 350,
        modal: true,
        show: "explode",
        buttons: {
            "Create an account": function() {
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
            Cancel: function() {
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
				<th>isbn</th>
				<th>Promo</th>
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
					if($livre->isMember)
					{
						echo "<tr>";
						echo "<td>".$livre->id."</td>";
						echo "<td>".$livre->titre."</td>";
						echo "<td>".$livre->auteur."</td>";
						echo "<td>".$livre->editeur."</td>";
						echo "<td>".$livre->isbn."</td>";
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
