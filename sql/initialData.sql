INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Smith', 'Will', 'INFO', 'wsmith', 2010);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Willis', 'Bruce', 'INFO', 'bwillis', 2011);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Norris', 'Chuck', 'INFO', 'cnorris', 2012);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Schwarzeneger', 'Arnold', 'INFO', 'aschwarzeneger', 2013);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Statham', 'Jason', 'INFO', 'jstatham', 2014);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Stalone', 'Sylvester', 'INFO', 'sstalone', 2012);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Stewart', 'Kristen', 'ELEC', 'kstewart', 2010);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Pattinson', 'Robert', 'ELEC', 'rpattison', 2011);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Lautner', 'Taylor', 'ELEC', 'tlautner', 2012);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Burke', 'Billy', 'ELEC', 'bburke', 2013);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Facinelli', 'Peter', 'ELEC', 'pfacinelli', 2014);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Reaser', 'Elisabeth', 'ELEC', 'ereaser', 2011);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Neill', 'Sam', 'TCOM', 'sneill', 2010);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Dern', 'Laura', 'TCOM', 'ldern', 2011);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Goldblum', 'Jeff', 'TCOM', 'jgoldblum', 2012);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Attenborough', 'Richard', 'TCOM', 'rattenborough', 2013);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Peck', 'Bob', 'TCOM', 'bpeck', 2014);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Ferrero', 'Martin', 'TCOM', 'mferrero', 2013);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Hamill', 'Mark', 'MTMK', 'mhamill', 2010);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Fisher', 'Carrie', 'MTMK', 'cfisher', 2011);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Ford', 'Harrison', 'MTMK', 'fharrison', 2012);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Prowse', 'David', 'MTMK', 'dprowse', 2013);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Guinness', 'Alec', 'MTMK', 'aguinness', 2014);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Cushing', 'Peter', 'MTMK', 'pcushing', 2014);

INSERT INTO MEMBRE (id_eleve, Annee) values (1, 2009);
INSERT INTO MEMBRE (id_eleve, Annee) values (19, 2009);
INSERT INTO MEMBRE (id_eleve, Annee) values (8, 2010);
INSERT INTO MEMBRE (id_eleve, Annee) values (12, 2010);
INSERT INTO MEMBRE (id_eleve, Annee) values (15, 2011);
INSERT INTO MEMBRE (id_eleve, Annee) values (21, 2011);
INSERT INTO MEMBRE (id_eleve, Annee) values (22, 2012);
INSERT INTO MEMBRE (id_eleve, Annee) values (18, 2012);

INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values ('2009-01-06', 3, 'Enseirb');
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values ('2009-06-23', 2, 'Pin Galant');
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values ('2010-05-03', 3, 'Enseirb');
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values ('2010-12-09', 2, '7eme Art');
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values ('2011-04-13', 3, 'Cock and Bull');
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values ('2011-11-27', 2, 'Enseirb');
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values ('2012-02-14', 3, 'Enseirb');
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values ('2012-12-15', 2, 'Pin Galant');

INSERT INTO PARTICIPE (id_evt, id_eleve) values (1, 1);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (1, 6);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (1, 13);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (2, 19);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (2, 2);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (3, 8);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (3, 10);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (3, 21);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (4, 8);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (4, 4);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (5, 15);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (5, 5);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (5, 10);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (6, 21);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (6, 8);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (7, 22);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (7, 23);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (7, 10);

INSERT INTO JEU (nom_jeu, date_jeu, prix_jeu, etat) values ('Monopoly', '2007-05-01', 29.99, 'BON ETAT');
INSERT INTO JEU (nom_jeu, date_jeu, prix_jeu, etat) values ('Jungle Speed', '2007-05-01', 19.99, 'MAUVAIS ETAT');
INSERT INTO JEU (nom_jeu, date_jeu, prix_jeu, etat) values ('Dr Maboule', '2008-06-03', 30.87, 'TRES BON ETAT');
INSERT INTO JEU (nom_jeu, date_jeu, prix_jeu, etat) values ('Tarot', '2010-02-19', 30.87, 'BON ETAT');
INSERT INTO JEU (nom_jeu, date_jeu, prix_jeu, etat) values ('Cluedo', '2011-04-23', 30.87, 'TRES BON ETAT');

INSERT INTO UTILISE (id_jeu, id_evt) values (1, 1);
INSERT INTO UTILISE (id_jeu, id_evt) values (2, 1);
INSERT INTO UTILISE (id_jeu, id_evt) values (2, 2);
INSERT INTO UTILISE (id_jeu, id_evt) values (3, 2);
INSERT INTO UTILISE (id_jeu, id_evt) values (3, 3);
INSERT INTO UTILISE (id_jeu, id_evt) values (1, 3);
INSERT INTO UTILISE (id_jeu, id_evt) values (3, 4);
INSERT INTO UTILISE (id_jeu, id_evt) values (2, 4);
INSERT INTO UTILISE (id_jeu, id_evt) values (4, 5);
INSERT INTO UTILISE (id_jeu, id_evt) values (1, 5);
INSERT INTO UTILISE (id_jeu, id_evt) values (4, 6);
INSERT INTO UTILISE (id_jeu, id_evt) values (2, 6);
INSERT INTO UTILISE (id_jeu, id_evt) values (5, 7);
INSERT INTO UTILISE (id_jeu, id_evt) values (4, 7);
INSERT INTO UTILISE (id_jeu, id_evt) values (5, 8);
INSERT INTO UTILISE (id_jeu, id_evt) values (2, 8);



-- ============================================================
--    verification des donnees
-- ============================================================

<<<<<<< HEAD
INSERT INTO EMPRUNT (id_exemplaire, id_eleve, date_rendu) values (2, 2, '2010-04-14');
INSERT INTO EMPRUNT (id_exemplaire, id_eleve, date_rendu) values (4, 8, '2011-06-08');
INSERT INTO EMPRUNT (id_exemplaire, id_eleve, date_rendu) values (1, 8, '2012-09-20');
INSERT INTO EMPRUNT (id_exemplaire, id_eleve, date_rendu) values (11, 2, '2013-02-11');
INSERT INTO EMPRUNT (id_exemplaire, id_eleve, date_rendu) values (2, 2, '2011-04-14');
INSERT INTO EMPRUNT (id_exemplaire, id_eleve, date_rendu) values (3, 1, '2010-04-14');
INSERT INTO EMPRUNT (id_exemplaire, id_eleve, date_rendu) values (2, 17, '2012-04-14');

select count(*), '= 6 ?','EMPRUNT' from EMPRUNT ;

=======
select count(*), '= 1 ?','ELEVE' from ELEVE ;
>>>>>>> 60ca5fdec012134fa40411e6be6936171ef83305
