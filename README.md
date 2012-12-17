sgbdFoyer
=========

Projet Base de Données Foyer

-- Installation :
 
-Modifier le fichier config.php dans la racine.
-Editer les variables $config->mysqlDB pour concorder avec les paramètres de votre serveur.

Si votre login MySQL ne permet pas de creer/supprimer des bases de données (schema), alors creez manuellement celle-ci puis accedez, dans le site à Outils->Reinitialiser la base de données

Les fichiers dans le dossier sql permettent de supprimer, creer, et remplir la base de données. 
Le modèle de données est donné en format MySQL workbench dans le fichier model.mwb.
La plupart des requètes utiles sont dans le fichier requests.sql.
Les fichiers SQL dans le dossier sql/phpSQL sont similaires a ceux du dossier parent à la difference qu'ils sont executables par mysqli (entre autre a cause des delimiteurs)
