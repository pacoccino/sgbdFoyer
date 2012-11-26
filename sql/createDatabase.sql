create table ACTEUR
(
    ID                   NUMBER(3)              not null,
    NAME                      CHAR(20)               not null,
    constraint pk_member primary key (ID)
);

create table ELEVE
(
    ID                   NUMBER(3)              not null,
    NOM                      CHAR(20)               not null,
    PRENOM                      CHAR(20)               not null,
    FILLIERE                      CHAR(2)               not null,
    LOGIN                      CHAR(20)               not null,
    PROMO                      NUMBER(4)               not null,
    constraint pk_member primary key (ID)
);

