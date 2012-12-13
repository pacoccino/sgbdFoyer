<?php

class EvenementsPage extends Layout{
	
	private $date_ev="";
	
	public function __construct() {
		$this->pageTitle = "Evènements";
		
		if(isset($_GET['date_ev']))
			$this->date_ev = $_GET['date_ev'];
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
	$.post("post.php", { action: "adduser", date: param[0].value, lieu: param[1].value },
	  function(data){
	    $( "#evenement-added" ).html(data); 
	    $( "#evenement-added" ).dialog( "open" );
	  });
}

function open_info( id ) {
	$.get("get.php", { action: "get_evt_info", id_evt: id },
	  function(data){
	    $( "#dialog-info" ).html(data);
   		 $( "#dialog-info" ).dialog( "open" );
	  });
}
        
$(function() {
    var date = $( "#date" ),
        lieu = $( "#lieu" ),
        allFields = $( [] ).add( date ).add( lieu ) ;
 
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
                
                bValid = bValid && checkLength( lieu, "lieu", 2, 20 );
 
                    if ( bValid ) {

                    	addEleve(allFields);
                        $( "#users tbody" ).append( "<tr>" +
                        "<td>0</td>" + 
                        "<td>" + date.val() + "</td>" + 
                        "<td>" + lieu.val() + "</td>" + 
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
        
        $( "#evt-added" ).dialog({
            autoOpen: false,
            show: "blind",
            hide: "explode"
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
 
        $( "#open-info" )
        .button()
        .click(function() {
            $( "#dialog-info" ).dialog( "open" );
        });
              
        
        $( "button" ).button();
        $( "input[type=submit]" ).button();
        $("#all_evt").click(function(){
		     document.location.href='index.php?action=evt';
		  });
		  
		$( "#date_ev" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd"
        });
        
        $('.bubu').button({
            icons: {
                primary: "ui-icon-search"
            },
            text: false
        });
 		
});
</script>




<div id="liste" class="ui-widget">
	<?php
	if(isset($_GET['historique']))
		echo "<h1>Historique des Membres du bureau :</h1>";
	else 
		echo "<h1>Liste des évènements:</h1>";
    ?>
    <form method=GET action="index.php">
    	<input type="hidden" name="action" id="action" value="evt">
        <input type="text" name="date_ev" id="date_ev" value="<?php echo $this->date_ev; ?>" class="text ui-widget-content ui-corner-all"/>
        <input type="submit" value="Filtrer par date" />
    </form> 
    <button id="all_evt">Tous les évènements</button> 
    <table id="users" class="ui-widget ui-widget-content">
        <thead class="ui-widget-header ">
				<th>Id</th>
				<th>Date</th>
				<th>Nb Participants</th>
				<th>Lieu</th>
				<th></th>
        </thead>
        <tbody>
		<?php
			$result=Evenement::getListe();
			if(!($result))
			{
				echo "Erreur de requete : ".Database::errorMsg();
			}
			else
			{
				while($res = Database::fetch($result))
				{
					$evenement = new Evenement($res);
					if(empty($this->date_ev) || $evenement->date == $this->date_ev)
					{
						echo "<tr onclick='javascript:open_info(".$evenement->id.")'>";
						echo "<td>".$evenement->id."</td>";
						echo "<td>".$evenement->date."</td>";
						echo "<td>".$evenement->nbParticipants."</td>";
						echo "<td>".$evenement->lieu."</td>";
						echo "<td><button class='bubu' onclick='javascript:open_info(".$evenement->id.")'></button></td>";
						echo "</tr>";
					}
				} 
			}
			echo $this->annee_bureau;
		?>
        </tbody>
    </table>
</div>

<button id="create-evt">Ajouter un nouvel évènement</button>
<button id="open-info">Open</button>
<a href="#" onclick="javascript:openn();">pouet</a>
<div id="evt-added" title="Status">
    <p>L'évènement a bien été ajouté.</p>
</div>
<div id="dialog-form" title="Ajouter un évènement">
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

<div id="dialog-info" title="Informations sur un évènement">
   infos
</div>
		
		<?php
// -----------------------------------
// Fin Body
// -----------------------------------
	}
}
?>
