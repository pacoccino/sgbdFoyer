/* Historique des membres du bureau depuis sa création

SELECT *
FROM ELEVE, MEMBRE
WHERE ELEVE.id_eleve = MEMBRE.id_eleve;
*/

/* Membres du bureau à une date donnée, ici avec annee = 2009

SELECT *
FROM ELEVE, MEMBRE
WHERE ELEVE.id_eleve = MEMBRE.id_eleve AND MEMBRE.annee = 2009;
*/

/* Liste des jeux utilisés pour un évènement donné, ici avec id = 3

SELECT *
FROM JEU, EVENEMENT, UTILISE
WHERE JEU.id_jeu = UTILISE.id_jeu
AND UTILISE.id_evt = EVENEMENT.id_evt
AND EVENEMENT.id_evt = 3;
*/

/* Liste des membres du bureau qui ont été à un évènement avant de rejoindre le bureau

SELECT DISTINCT *
FROM ELEVE, EVENEMENT, PARTICIPE, MEMBRE
WHERE ELEVE.id_eleve = PARTICIPE.id_eleve
AND ELEVE.id_eleve = MEMBRE.id_eleve
AND PARTICIPE.id_evt = EVENEMENT.id_evt
AND year(EVENEMENT.date_evt) > MEMBRE.annee;
*/

/* Nombre d'évènements auquel a participé un membre depuis le début de l'année, ici id_eleve = 4, annee = 2012

SELECT COUNT(*)
FROM ELEVE, EVENEMENT, PARTICIPE
WHERE PARTICIPE.id_eleve = ELEVE.id_eleve
AND ELEVE.id_eleve = 22
AND PARTICIPE.id_evt = EVENEMENT.id_evt
AND year(EVENEMENT.date_evt) = 2012;
*/

/* Nombre de participants à un évènement, ici avec id_evt

SELECT COUNT(*)
FROM EVENEMENT, PARTICIPE
WHERE EVENEMENT.id_evt = PARTICIPE.id_evt
AND EVENEMENT.id_evt = 3;
*/

/* Nombre d'emprunt par élève pour un livre donné

select COUNT(*), nom_eleve 
FROM ELEVE, LIVRE, EXEMPLAIRE, EMPRUNT 
WHERE ELEVE.id_eleve = EMPRUNT.id_eleve 
AND EMPRUNT.id_exemplaire = EXEMPLAIRE.id_exemplaire 
AND EXEMPLAIRE.id_livre = LIVRE.id_livre 
AND LIVRE.titre = "Fascination" 
GROUP BY nom_eleve;
*/

/* Moyenne des emprunts de livres par mois sur une année donnée
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