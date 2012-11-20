<?php

interface genericInterface
{
	// execute un fichier sql (chemin relatif a la racine)
	public function executeSqlFile($file);
	
	// execute une requete sql basique, la renvoie et la stocke dans lastResult
	public function query($query);
	
	// recupere la ligne suivante du resultat de la derniere requete, ou du resultat fourni en parametre. A iterer.
	public function fetch($result);
	
	// Retourne vrai si la derniere requete n'a retourne aucun resultat
    public function testEmpty();
}

?>
