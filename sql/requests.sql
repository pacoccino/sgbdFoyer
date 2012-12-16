/* Historique des membres du bureau depuis sa création

SELECT *
FROM ELEVE, MEMBRE
WHERE ELEVE.id_eleve = MEMBRE.id_eleve AND MEMBRE.annee < YEAR(NOW());
*/

/* Membres du bureau à une date donnée, ici avec annee = 2009

SELECT *
FROM ELEVE, MEMBRE
WHERE ELEVE.id_eleve = MEMBRE.id_eleve AND MEMBRE.annee = 2009;
*/

/* Membres du bureau actuellement

SELECT *
FROM ELEVE, MEMBRE
WHERE ELEVE.id_eleve = MEMBRE.id_eleve AND MEMBRE.annee = YEAR(NOW());
*/

/* Liste des jeux utilisés pour un évènement donné, ici avec id = 3

SELECT *
FROM JEU, EVENEMENT, UTILISE
WHERE JEU.id_jeu = UTILISE.id_jeu
AND UTILISE.id_evt = EVENEMENT.id_evt
AND EVENEMENT.id_evt = 3;
*/

/* Liste des membres du bureau qui ont été à un évènement apres avoir rejoint le bureau

SELECT DISTINCT *
FROM ELEVE, EVENEMENT, PARTICIPE, MEMBRE
WHERE ELEVE.id_eleve = PARTICIPE.id_eleve
AND ELEVE.id_eleve = MEMBRE.id_eleve
AND PARTICIPE.id_evt = EVENEMENT.id_evt
AND year(EVENEMENT.date_evt) > MEMBRE.annee;
*/

/* Nombre d'évènements auquel a participé un membre depuis le début de l'année, ici id_eleve = 18

SELECT COUNT(*)
			FROM EVENEMENT, PARTICIPE
			WHERE PARTICIPE.id_eleve = 18
			AND PARTICIPE.id_evt = EVENEMENT.id_evt
			AND year(EVENEMENT.date_evt) = YEAR(NOW())
*/

/* Nombre de participants à un évènement, ici avec id_evt

SELECT COUNT(*)
FROM EVENEMENT, PARTICIPE
WHERE EVENEMENT.id_evt = PARTICIPE.id_evt
AND EVENEMENT.id_evt = 3;
*/

/* Nombre d'emprunt par élève pour un livre donné (ici "Fascination")

select COUNT(*), nom_eleve 
FROM ELEVE, LIVRE, EXEMPLAIRE, EMPRUNT 
WHERE ELEVE.id_eleve = EMPRUNT.id_eleve 
AND EMPRUNT.id_exemplaire = EXEMPLAIRE.id_exemplaire 
AND EXEMPLAIRE.id_livre = LIVRE.id_livre 
AND LIVRE.titre = "Fascination" 
GROUP BY nom_eleve;
*/

/* Historique des emprunts d'un livre donné (ici "Fascination")

SELECT date_rendu, nom_eleve  FROM ELEVE, LIVRE, EXEMPLAIRE, EMPRUNT  WHERE ELEVE.id_eleve = EMPRUNT.id_eleve  AND EMPRUNT.id_exemplaire = EXEMPLAIRE.id_exemplaire  AND EXEMPLAIRE.id_livre = LIVRE.id_livre  AND LIVRE.titre = "Fascination" ORDER BY date_rendu DESC;
*/


/* Moyenne des emprunts de livres par mois sur une année donnée (ici 2012)

SELECT sum(total.an)/ 12 AS moyenne 
FROM (SELECT count(*) AS an 
        FROM EMPRUNT 
  	WHERE YEAR(date_rendu)='2012' 
	GROUP BY MONTH(date_rendu)) AS total;
*/

/* Classement des livres les plus lus

SELECT LIVRE.titre, count(*) as nombre 
FROM LIVRE, EXEMPLAIRE, EMPRUNT 
WHERE LIVRE.id_livre = EXEMPLAIRE.id_livre 
AND EXEMPLAIRE.id_exemplaire = EMPRUNT.id_exemplaire 
GROUP BY LIVRE.titre 
ORDER BY nombre DESC;
*/

/* Classement des evenemnts le nombre d’entrée total réalisé

SELECT date_evt, lieu, count(*) AS nombre 
FROM PARTICIPE, EVENEMENT 
WHERE EVENEMENT.id_evt = PARTICIPE.id_evt 
GROUP BY EVENEMENT.id_evt 
ORDER BY nombre DESC;
*/

/* Classement des jeux selon le nombre de participants aux evenements l'utilisant

SELECT nom_jeu, SUM(nombre) AS total
FROM JEU, UTILISE, 
     (SELECT EVENEMENT.id_evt, count(*) AS nombre 
     FROM PARTICIPE, EVENEMENT 
     WHERE EVENEMENT.id_evt = PARTICIPE.id_evt 
     GROUP BY EVENEMENT.id_evt) AS PARTICIPATION
WHERE JEU.id_jeu = UTILISE.id_jeu
AND UTILISE.id_evt = PARTICIPATION.id_evt
GROUP BY JEU.id_jeu
ORDER BY total DESC;
*/

/* Les commentaires d'un jeu
SELECT texte, note 
FROM COMMENTAIRE
WHERE COMMENTAIRE.id_jeu = 4;
*/

/*Les commentaires d'un evenement
SELECT texte, note 
FROM COMMENTAIRE
WHERE COMMENTAIRE.id_evt = 4;
*/

/* Affichage de la liste des commentaires d'un élève
SELECT IFNULL(texte, 'Non renseigné') AS texte,
       IFNULL(note, 'Non renseigné') AS note,
       IF(COMMENTAIRE.id_evt, 'evt', 'jeu') AS type, 
       IF(COMMENTAIRE.id_evt, COMMENTAIRE.id_evt, COMMENTAIRE.id_jeu) AS id
FROM COMMENTAIRE
WHERE id_eleve = 1;
*/

/* Nombres d'exemplaires disponibles a l'emprunt pour un livre

SELECT COUNT(*) FROM EXEMPLAIRE LEFT JOIN LIVRE_EMPRUNTE ON EXEMPLAIRE.id_exemplaire = LIVRE_EMPRUNTE.id_exemplaire WHERE EXEMPLAIRE.empruntable = TRUE AND LIVRE_EMPRUNTE.id_emprunt is null AND EXEMPLAIRE.id_livre = 4;

*/
