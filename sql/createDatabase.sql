create table ACTEUR
(
    ID                   NUMBER(3)              not null,
    NAME                      CHAR(20)               not null,
    constraint pk_member primary key (ID)
);

create table ELEVE
(
    ID                   NUMBER(3)            ,
    NOM                      CHAR(20)               ,
    PRENOM                      CHAR(20)               ,
    FILLIERE                      CHAR(2)               ,
    LOGIN                      CHAR(20)               ,
    PROMO                      NUMBER(4)             ,
    constraint pk_eleve primary key (ID)
);

