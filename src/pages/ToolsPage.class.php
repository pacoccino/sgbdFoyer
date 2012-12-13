<?php

class ToolsPage extends Layout{
	
	public function __construct()
	{
		$this->pageTitle = "Outils";
	}
	// cette fonction est ce que va afficher la page web
	public function bodyHTML() {
?>

<h1>Outils</h1>
<a href="index.php?raz">Réinitialiser la base de données.</a>

<?php
	}
}
?>
