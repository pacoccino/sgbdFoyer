-- ============================================================
--    ELEVE
-- ============================================================


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


select count(*), '= 24 ?','ELEVE' from ELEVE ;

-- ============================================================
--    MEMBRE
-- ============================================================

INSERT INTO MEMBRE (id_eleve, annee) values (1, 2009);
INSERT INTO MEMBRE (id_eleve, annee) values (19, 2009);
INSERT INTO MEMBRE (id_eleve, annee) values (8, 2010);
INSERT INTO MEMBRE (id_eleve, annee) values (12, 2010);
INSERT INTO MEMBRE (id_eleve, annee) values (15, 2011);
INSERT INTO MEMBRE (id_eleve, annee) values (21, 2011);
INSERT INTO MEMBRE (id_eleve, annee) values (17, 2012);
INSERT INTO MEMBRE (id_eleve, annee) values (11, 2012);
INSERT INTO MEMBRE (id_eleve, annee) values (22, 2012);
INSERT INTO MEMBRE (id_eleve, annee) values (18, 2012);


select count(*), '= 8 ?','MEMBRE' from MEMBRE ;

-- ============================================================
--    EVENEMENT
-- ============================================================


INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values ('2009-06-23', 2, 'Pin Galant');
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values ('2010-03-03', 3, 'Enseirb');
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values ('2011-01-13', 3, 'Cock and Bull');
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values ('2012-05-27', 2, 'Enseirb');
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values ('2012-12-05', 3, 'Enseirb');
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values ('2013-07-07', 3, 'La MAC');
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values ('2013-09-14', 3, 'Ibiza');
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values ('2013-12-15', 2, 'Pin Galant');



select count(*), '= 8 ?','EVENEMENT' from EVENEMENT ;

-- ============================================================
--    PARTICIPE
-- ============================================================


INSERT INTO PARTICIPE (id_evt, id_eleve) values (1, 1);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (2, 2);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (2, 3);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (3, 4);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (3, 5);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (3, 6);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (4, 2);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (4, 3);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (4, 4);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (4, 5);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (6, 3);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (6, 4);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (7, 4);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (7, 5);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (7, 6);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (7, 7);

select count(*), '= 16 ?','PARTICIPE' from PARTICIPE ;

-- ============================================================
--    JEU
-- ============================================================

INSERT INTO JEU (nom_jeu, date_jeu, prix_jeu, etat) values ('Monopoly', '2007-05-01', 29.99, 'BON ETAT');
INSERT INTO JEU (nom_jeu, date_jeu, prix_jeu, etat) values ('Jungle Speed', '2007-05-01', 19.99, 'MAUVAIS ETAT');
INSERT INTO JEU (nom_jeu, date_jeu, prix_jeu, etat) values ('Dr Maboule', '2008-06-03', 30.87, 'TRES BON ETAT');
INSERT INTO JEU (nom_jeu, date_jeu, prix_jeu, etat) values ('Tarot', '2010-02-19', 30.87, 'BON ETAT');
INSERT INTO JEU (nom_jeu, date_jeu, prix_jeu, etat) values ('Cluedo', '2011-04-23', 30.87, 'TRES BON ETAT');

select count(*), '= 5 ?','JEU' from JEU ;

-- ============================================================
--    UTILISE
-- ============================================================

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

select count(*), '= 16 ?','UTILISE' from UTILISE ;

-- ============================================================
--    LIVRE
-- ============================================================

INSERT INTO LIVRE (titre, auteur, editeur, ISBN) values ('Fascination', 'Meyer', 'Coucou', 12);
INSERT INTO LIVRE (titre, auteur, editeur, ISBN) values ('Tentation', 'Meyer', 'Coucou', 13);
INSERT INTO LIVRE (titre, auteur, editeur, ISBN) values ('Hésitation', 'Meyer', 'Hachette', 14);
INSERT INTO LIVRE (titre, auteur, editeur, ISBN) values ('Révélation', 'Meyer', 'Gallimard', 1278);
INSERT INTO LIVRE (titre, auteur, editeur, ISBN) values ('Le Hobbit', 'Tolkien', 'Hachette', 1223);
INSERT INTO LIVRE (titre, auteur, editeur, ISBN) values ('H2G2', 'Adams', 'Coucou',  42);

select count(*), '= 6 ?','LIVRE' from LIVRE ;

-- ============================================================
--    EXEMPLAIRE
-- ============================================================

INSERT INTO EXEMPLAIRE (empruntable, date_livre, prix_livre, id_livre) values (TRUE, '2007-03-21', 12, 1);
INSERT INTO EXEMPLAIRE (empruntable, date_livre, prix_livre, id_livre) values (TRUE, '2012-03-12', 7, 2);
INSERT INTO EXEMPLAIRE (empruntable, date_livre, prix_livre, id_livre) values (TRUE, '2007-04-21', 7, 2);
INSERT INTO EXEMPLAIRE (empruntable, date_livre, prix_livre, id_livre) values (TRUE, '2008-06-21', 5, 3);
INSERT INTO EXEMPLAIRE (empruntable, date_livre, prix_livre, id_livre) values (FALSE, '2012-12-21', 20, 3);
INSERT INTO EXEMPLAIRE (empruntable, date_livre, prix_livre, id_livre) values (TRUE, '2009-02-21', 42, 3);
INSERT INTO EXEMPLAIRE (empruntable, date_livre, prix_livre, id_livre) values (FALSE, '2011-03-21', 6, 4);
INSERT INTO EXEMPLAIRE (empruntable, date_livre, prix_livre, id_livre) values (TRUE, '2012-03-21', 12, 4);
INSERT INTO EXEMPLAIRE (empruntable, date_livre, prix_livre, id_livre) values (TRUE, '2009-02-14', 8, 6);

select count(*), '= 9 ?','EXEMPLAIRE' from EXEMPLAIRE ;

-- ============================================================
--    EMPRUNT
-- ============================================================

INSERT INTO EMPRUNT (id_exemplaire, id_eleve, date_emprunt, date_rendu) values (1, 2, '2010-02-14', '2010-04-14');
INSERT INTO EMPRUNT (id_exemplaire, id_eleve, date_emprunt, date_rendu) values (2, 3, '2011-06-04', '2011-06-08');
INSERT INTO EMPRUNT (id_exemplaire, id_eleve, date_emprunt, date_rendu) values (2, 4, '2012-08-16', '2012-09-20');
INSERT INTO EMPRUNT (id_exemplaire, id_eleve, date_emprunt, date_rendu) values (4, 5, '2010-01-4', '2011-02-11');
INSERT INTO EMPRUNT (id_exemplaire, id_eleve, date_emprunt, date_rendu) values (4, 6, '2011-03-5', '2011-04-14');
INSERT INTO EMPRUNT (id_exemplaire, id_eleve, date_emprunt, date_rendu) values (6, 1, '2012-01-7', '2012-02-09');
INSERT INTO EMPRUNT (id_exemplaire, id_eleve, date_emprunt) values (1, 1, '2012-11-08');
INSERT INTO EMPRUNT (id_exemplaire, id_eleve, date_emprunt) values (2, 7, '2012-01-14');

select count(*), '= 7 ?','EMPRUNT' from EMPRUNT ;

-- ============================================================
--    COMMENTAIRE
-- ============================================================

INSERT INTO COMMENTAIRE (texte, note, id_eleve, id_jeu) values ('Tres rigolo', 10, 1, 1);
INSERT INTO COMMENTAIRE (texte, note, id_eleve, id_jeu) values ('Bon', 6, 1, 2);
INSERT INTO COMMENTAIRE (texte, note, id_eleve, id_jeu) values ('NUL NUL !!', 1, 1, 2);
INSERT INTO COMMENTAIRE (texte, note, id_eleve, id_jeu) values ('Moyen... :|', 4, 2, 3);
INSERT INTO COMMENTAIRE (texte, id_eleve, id_jeu) values ('distrayant', 3, 3);
INSERT INTO COMMENTAIRE (note, id_eleve, id_jeu) values (9, 4, 3);
INSERT INTO COMMENTAIRE (note, id_eleve, id_jeu) values (16, 7, 4);

INSERT INTO COMMENTAIRE (texte, note, id_eleve, id_evt) values ('Y avait que des cons', 3, 12 , 1);
INSERT INTO COMMENTAIRE (texte, note, id_eleve, id_evt) values ('On a bien rigole', 7, 6, 2);
INSERT INTO COMMENTAIRE (texte, note, id_eleve, id_evt) values ('Les parties etaient trop longues. dommage...', 6, 12, 2);
INSERT INTO COMMENTAIRE (texte, note, id_eleve, id_evt) values ('Commentaire de remplissage', 4, 1, 3);
INSERT INTO COMMENTAIRE (texte, id_eleve, id_evt) values ('Trop facile le tournoi', 1, 4);
INSERT INTO COMMENTAIRE (note, id_eleve, id_evt) values (5, 14, 3);
INSERT INTO COMMENTAIRE (note, id_eleve, id_evt) values (9, 8, 4);

select count(*), '= 14 ?','COMMENTAIRE' from COMMENTAIRE ;

