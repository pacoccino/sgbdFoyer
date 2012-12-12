USE 'projetSGBD';

insert into ACTEUR values (  1 , 'ROBERT') ;

insert into ELEVE values (1, 'MARTIN', 'Francois', 'I2', 'fmartin', '2014') ;
insert into ELEVE values (2, 'Coucou', 'Francois', 'I2', 'fcoucou', '2014') ;

-- ============================================================
--    verification des donnees
-- ============================================================

select count(*), '= 1 ?','ACTEUR' from ACTEUR ;
select count(*), '= 1 ?','ELEVE' from ELEVE ;
