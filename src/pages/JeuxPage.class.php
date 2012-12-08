<?php

class JeuxPage extends Layout{
	
	public function __construct($core) {
		parent::__construct($core);

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
	$.post("post.php", { action: "adduser", nom: param[0].value, prenom: param[1].value , login: param[2].value , filliere: param[3].value , promo: param[4].value , isMember: param[5].value },
	  function(data){
	    $( "#eleve-added" ).html(data); 
	    $( "#eleve-added" ).dialog( "open" );
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
        prenom = $( "#prenom" ),
        login = $( "#login" ),
        filliere = $( "#filliere" ),
        promo = $( "#promo" ),
		isMember = $( "#isMember" ),
        allFields = $( [] ).add( nom ).add( prenom ).add( login).add( filliere).add( promo ).add( isMember ),
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
                
                bValid = bValid && checkLength( nom, "nom", 2, 20 );
                bValid = bValid && checkLength( prenom, "prenom", 2, 20 );
                bValid = bValid && checkLength( login, "login", 3, 20 );
                bValid = bValid && checkLength( filliere, "filliere", 2, 5 );
                bValid = bValid && checkLength( promo, "promo", 4, 4 );
 
                    if ( bValid ) {

                    	addEleve(allFields);
                        $( "#users tbody" ).append( "<tr>" +
                        "<td>0</td>" + 
                        "<td>" + nom.val() + "</td>" + 
                        "<td>" + prenom.val() + "</td>" + 
                        "<td>" + login.val() + "</td>" +
                        "<td>" + filliere.val() + "</td>" +
                        "<td>" + promo.val() + "</td>" +
                        "<td>" + isMember.val() + "</td>" +
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
        
        $( "#eleve-added" ).dialog({
            autoOpen: false,
            show: "blind",
            hide: "explode"
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
				<th>Prenom</th>
				<th>Login</th>
				<th>Filliere</th>
				<th>Promo</th>
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
					if($eleve->isMember)
					{
						echo "<tr>";
						echo "<td>".$eleve->id."</td>";
						echo "<td>".$eleve->nom."</td>";
						echo "<td>".$eleve->prenom."</td>";
						echo "<td>".$eleve->login."</td>";
						echo "<td>".$eleve->filliere."</td>";
						echo "<td>".$eleve->promo."</td>";
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
