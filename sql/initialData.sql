INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Smith', 'Will', 'INFO', 'wsmith', 2013);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Willis', 'Bruce', 'INFO', 'bwillis', 2013);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Norris', 'Chuck', 'INFO', 'cnorris', 2014);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Schwarzeneger', 'Arnold', 'INFO', 'aschwarzeneger', 2014);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Statham', 'Jason', 'INFO', 'jstatham', 2015);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Stalone', 'Sylvester', 'INFO', 'sstalone', 2015);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Stewart', 'Kristen', 'ELEC', 'kstewart', 2013);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Pattinson', 'Robert', 'ELEC', 'rpattison', 2013);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Lautner', 'Taylor', 'ELEC', 'tlautner', 2014);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Burke', 'Billy', 'ELEC', 'bburke', 2014);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Facinelli', 'Peter', 'ELEC', 'pfacinelli', 2015);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Reaser', 'Elisabeth', 'ELEC', 'ereaser', 2015);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Neill', 'Sam', 'TCOM', 'sneill', 2013);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Dern', 'Laura', 'TCOM', 'ldern', 2013);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Goldblum', 'Jeff', 'TCOM', 'jgoldblum', 2014);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Attenborough', 'Richard', 'TCOM', 'rattenborough', 2014);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Peck', 'Bob', 'TCOM', 'bpeck', 2015);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Ferrero', 'Martin', 'TCOM', 'mferrero', 2015);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Hamill', 'Mark', 'MTMK', 'mhamill', 2013);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Fisher', 'Carrie', 'MTMK', 'cfisher', 2013);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Ford', 'Harrison', 'MTMK', 'fharrison', 2014);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Prowse', 'David', 'MTMK', 'dprowse', 2014);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Guinness', 'Alec', 'MTMK', 'aguinness', 2015);
INSERT INTO ELEVE (nom_eleve, prenom_eleve, filliere, login, promo) values ('Cushing', 'Peter', 'MTMK', 'pcushing', 2015);

INSERT INTO MEMBRE (id_eleve, Annee) values (1, 2012);
INSERT INTO MEMBRE (id_eleve, Annee) values (7, 2012);
INSERT INTO MEMBRE (id_eleve, Annee) values (13, 2012);
INSERT INTO MEMBRE (id_eleve, Annee) values (3, 2013);
INSERT INTO MEMBRE (id_eleve, Annee) values (9, 2013);
INSERT INTO MEMBRE (id_eleve, Annee) values (21, 2013);
INSERT INTO MEMBRE (id_eleve, Annee) values (11, 2014);
INSERT INTO MEMBRE (id_eleve, Annee) values (17, 2014);
INSERT INTO MEMBRE (id_eleve, Annee) values (23, 2014);

INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values (03-JAN-12, 3, Integration);
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values (30-MAR-12, 4, Muzikorama);
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values (21-DEC-12, 2, Depart);
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values (15-JAN-13, 5, Parainnage);
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values (22-AVR-13, 2, Gala);
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values (14-DEC-13, 4, Noel);
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values (09-JAN-14, 3, Bizutage);
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values (30-MAR-14, 4, Springbreak);
INSERT INTO EVENEMENT (date_evt, nbparticipants, lieu) values (6-NOV-14, 5, Halloween);

INSERT INTO PARTICIPE (id_evt, id_eleve) values (1, 1);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (1, 13);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (1, 11);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (2, 1);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (2, 7);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (2, 13);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (2, 12);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (3, 1);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (3, 12);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (4, 3);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (4, 9);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (4, 15);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (4, 12);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (4, 18);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (5, 21);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (5, 8);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (6, 3);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (6, 21);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (6, 15);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (6, 19);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (7, 24);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (7, 21);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (7, 4);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (8, 15);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (8, 13);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (8, 16);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (8, 13);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (9, 7);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (9, 8);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (9, 14);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (9, 17);
INSERT INTO PARTICIPE (id_evt, id_eleve) values (9, 22);



-- ============================================================
--    verification des donnees
-- ============================================================

select count(*), '= 1 ?','ELEVE' from ELEVE ;
