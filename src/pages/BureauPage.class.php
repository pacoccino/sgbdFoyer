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
    var nom = $( "#nom" ),
        prenom = $( "#prenom" ),
        login = $( "#login" ),
        filliere = $( "#filliere" ),
        promo = $( "#promo" ),
		isMember = $( "#isMember" ),
        allFields = $( [] ).add( nom ).add( prenom ).add( login).add( filliere).add( promo ).add( isMember );
 
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
        
        $( "button" ).button();
        $( "input[type=submit]" ).button();
        $("#annee_actuelle").click(function(){
		     document.location.href='index.php?action=bureau';
		  });
        $("#historique").click(function(){
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
        <input type="text" name="annee_bureau" id="annee_bureau" value="<?php echo $this->annee_bureau; ?>" class="text ui-widget-content ui-corner-all" />
        <input type="submit" value="Changer année" />
    </form>
    <button id="annee_actuelle">Membres actuels</button> 
    <button id="historique">Historique</button> 
    <table id="users" class="ui-widget ui-widget-content">
        <thead>
            <tr class="ui-widget-header ">
				<th>Id</th>
				<th>Nom</th>
				<th>Prenom</th>
				<th>Login</th>
				<th>Filliere</th>
				<th>Promo</th>
				<th>Année</th>
            </tr>
        </thead>
        <tbody>
		<?php
			if(isset($_GET['historique']))
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
