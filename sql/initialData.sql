delete from MEMBERS ;

commit ;

insert into REALISATEUR values (  1 , 'ROBERT') ;

commit ;


-- ============================================================
--    verification des donnees
-- ============================================================

select count(*), '= 1 ?','MEMBERS' from MEMBERS ;
