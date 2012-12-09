<?php

class JeuxPage extends Layout{
	
	public function __construct($core) {
		parent::__construct($core);

		Core::addDebug("InListe");
		if(isset($_POST['a_adding']))
		{
			$jeuadd = new Eleve();
			$jeuadd->nom = $_POST['nom'];
			$jeuadd->date = $_POST['date'];

			if($jeuadd->addToDatabase())
				Core::addDebug("Eleve ajouté.");
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

function addEleve(param) {
	$.post("post.php", { action: "addjeu", nom: param[0].value, date: param[1].value , prix: param[2].value , etat: param[3].value },
	  function(data){
	    $( "#jeu-added" ).html(data); 
	    $( "#jeu-added" ).dialog( "open" );
	  });
}

$(function() {
    $( "button" ).button()
});
//-->
</script>
<script>
$(function() {
    var nom = $( "#nom" ),
        date = $( "#date" ),
        prix = $( "#prix" ),
        etat = $( "#etat" ),
        allFields = $( [] ).add( nom ).add( date ).add( prix).add( etat),
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

                    	addEleve(allFields);
                        $( "#users tbody" ).append( "<tr>" +
                        "<td>0</td>" + 
                        "<td>" + nom.val() + "</td>" + 
                        "<td>" + date.val() + "</td>" + 
                        "<td>" + prix.val() + "</td>" +
                        "<td>" + etat.val() + "</td>" +
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
        
        $( "#jeu-added" ).dialog({
            autoOpen: false,
            show: "blind",
            hide: "explode"
        });
        
        $( "#date" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd"
        });
});
</script>
<div id="liste" class="ui-widget">
    <h1>Liste des jeux :</h1>
    <table id="users" class="ui-widget ui-widget-content">
        <thead>
            <tr class="ui-widget-header ">
				<th>Id</th>
				<th>Nom</th>
				<th>Date d'achat</th>
				<th>Prix d'achat</th>
				<th>Etat</th>
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
						echo "</tr>";
				} 
			}
		?>
        </tbody>
    </table>
</div>
		
    <button id="create-user">Ajouter un nouveau jeu</button>
    <div id="jeu-added" title="Status">
    <p>Le jeu a bien été ajouté.</p>
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
