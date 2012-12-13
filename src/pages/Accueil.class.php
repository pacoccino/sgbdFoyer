<?php

class Accueil extends Layout{
	
	public function __construct()
	{
		$this->pageTitle = "Accueil";
	}
	// cette fonction est ce que va afficher la page web
	public function bodyHTML() {
?>

<h1>Accueil</h1>
<p>Page d'accueil pour le projet de base de données.</p>

<?php
	}
}
?>
