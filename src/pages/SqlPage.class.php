<?php

class SqlPage extends Layout{
		
	public function __construct() {
		$this->pageTitle = "Requete SQL";
	}
	
	// cette fonction est ce que va afficher la page web
	public function bodyHTML() {
?>
<script type="text/javascript">
<!-- 

function request() {
	$.post("post.php", { action: "sqlreq", sql: document.getElementById("sqlreq").value },
	  function(data){
	    document.getElementById("reqresult").innerHTML = data; 
	  });
}

$(function() {
    $( "button" ).button();
    $( "button" ).click(function(event) {
  			event.preventDefault();
		});
});
//-->
</script>
		<div>
			<h1>Requete SQL :</h1>
				<p>
				<form>
					<label for="sqlreq">Requete :</label>
					<input type="text" name="sqlreq" id="sqlreq" placeholder="Ex : select * from TABLE;" size="30"  class="text ui-widget-content ui-corner-all"/>
					<button onclick="request();"> Lancer </button>
				</form>
				</p>
				<p>Resultat : </p>
				<p><div id='reqresult'></div></p>
		</div>
<?php
	}
}
?>
