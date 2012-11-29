<?php

interface genericInterface
{
	// execute un fichier sql (chemin relatif a la racine)
	public static function executeSqlFile($file);
	
	// execute une requete sql basique, la renvoie et la stocke dans lastResult
	public static function query($query);
	
	// recupere la ligne suivante du resultat de la derniere requete, ou du resultat fourni en parametre. A iterer.
	public static function fetch($result);
	
	// Retourne vrai si la derniere requete n'a retourne aucun resultat
    public static function testEmpty();
    
	// Retourne le dernier message d'erreur
    public static function errorMsg();
}

?>
