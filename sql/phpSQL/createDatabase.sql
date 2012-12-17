SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `ELEVE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ELEVE` ;

CREATE  TABLE IF NOT EXISTS `ELEVE` (
  `id_eleve` INT NOT NULL AUTO_INCREMENT ,
  `nom_eleve` VARCHAR(45) NOT NULL ,
  `prenom_eleve` VARCHAR(45) NOT NULL ,
  `filliere` VARCHAR(45) NOT NULL ,
  `login` VARCHAR(45) NOT NULL ,
  `promo` INT NOT NULL ,
  PRIMARY KEY (`id_eleve`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MEMBRE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `MEMBRE` ;

CREATE  TABLE IF NOT EXISTS `MEMBRE` (
  `id_eleve` INT NOT NULL ,
  `annee` INT NULL ,
  PRIMARY KEY (`id_eleve`) ,
  INDEX `fk_Membres_Eleves` (`id_eleve` ASC) ,
  CONSTRAINT `fk_Membres_Eleves`
    FOREIGN KEY (`id_eleve` )
    REFERENCES `ELEVE` (`id_eleve` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `JEU`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `JEU` ;

CREATE  TABLE IF NOT EXISTS `JEU` (
  `id_jeu` INT NOT NULL AUTO_INCREMENT ,
  `nom_jeu` VARCHAR(45) NOT NULL ,
  `date_jeu` DATE NULL ,
  `prix_jeu` FLOAT NULL ,
  `etat` VARCHAR(45) NULL ,
  PRIMARY KEY (`id_jeu`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `EVENEMENT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `EVENEMENT` ;

CREATE  TABLE IF NOT EXISTS `EVENEMENT` (
  `id_evt` INT NOT NULL AUTO_INCREMENT ,
  `date_evt` DATE NOT NULL ,
  `nbparticipants` INT NOT NULL DEFAULT 0 ,
  `lieu` VARCHAR(45) NULL DEFAULT 'enseirb' ,
  PRIMARY KEY (`id_evt`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `COMMENTAIRE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `COMMENTAIRE` ;

CREATE  TABLE IF NOT EXISTS `COMMENTAIRE` (
  `id_commentaire` INT NOT NULL AUTO_INCREMENT ,
  `texte` BLOB NULL ,
  `note` TINYINT NULL ,
  `id_eleve` INT NOT NULL ,
  `id_jeu` INT NULL ,
  `id_evt` INT NULL ,
  PRIMARY KEY (`id_commentaire`) ,
  INDEX `fk_COMMENTAIRE_ELEVE1` (`id_eleve` ASC) ,
  INDEX `fk_COMMENTAIRE_JEU1` (`id_jeu` ASC) ,
  INDEX `fk_COMMENTAIRE_EVENEMENT1` (`id_evt` ASC) ,
  CONSTRAINT `fk_COMMENTAIRE_ELEVE1`
    FOREIGN KEY (`id_eleve` )
    REFERENCES `ELEVE` (`id_eleve` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_COMMENTAIRE_JEU1`
    FOREIGN KEY (`id_jeu` )
    REFERENCES `JEU` (`id_jeu` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_COMMENTAIRE_EVENEMENT1`
    FOREIGN KEY (`id_evt` )
    REFERENCES `EVENEMENT` (`id_evt` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `LIVRE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `LIVRE` ;

CREATE  TABLE IF NOT EXISTS `LIVRE` (
  `id_livre` INT NOT NULL AUTO_INCREMENT ,
  `titre` VARCHAR(45) NOT NULL ,
  `auteur` VARCHAR(45) NOT NULL ,
  `editeur` VARCHAR(45) NOT NULL ,
  `ISBN` INT NOT NULL ,
  PRIMARY KEY (`id_livre`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `EXEMPLAIRE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `EXEMPLAIRE` ;

CREATE  TABLE IF NOT EXISTS `EXEMPLAIRE` (
  `id_exemplaire` INT NOT NULL AUTO_INCREMENT ,
  `empruntable` TINYINT(1) NOT NULL DEFAULT true ,
  `date_livre` DATE NULL ,
  `prix_livre` FLOAT NOT NULL DEFAULT 0 ,
  `id_livre` INT NOT NULL ,
  PRIMARY KEY (`id_exemplaire`) ,
  INDEX `fk_EXEMPLAIRE_LIVRE1` (`id_livre` ASC) ,
  CONSTRAINT `fk_EXEMPLAIRE_LIVRE1`
    FOREIGN KEY (`id_livre` )
    REFERENCES `LIVRE` (`id_livre` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `PARTICIPE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `PARTICIPE` ;

CREATE  TABLE IF NOT EXISTS `PARTICIPE` (
  `id_eleve` INT NOT NULL ,
  `id_evt` INT NOT NULL ,
  INDEX `fk_PARTICIPE_EVENEMENT1` (`id_evt` ASC) ,
  PRIMARY KEY (`id_eleve`, `id_evt`) ,
  CONSTRAINT `fk_PARTICIPE_ELEVE1`
    FOREIGN KEY (`id_eleve` )
    REFERENCES `ELEVE` (`id_eleve` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PARTICIPE_EVENEMENT1`
    FOREIGN KEY (`id_evt` )
    REFERENCES `EVENEMENT` (`id_evt` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `UTILISE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `UTILISE` ;

CREATE  TABLE IF NOT EXISTS `UTILISE` (
  `id_jeu` INT NOT NULL ,
  `id_evt` INT NOT NULL ,
  PRIMARY KEY (`id_jeu`, `id_evt`) ,
  INDEX `fk_UTILISE_EVENEMENT1` (`id_evt` ASC) ,
  CONSTRAINT `fk_UTILISE_JEU1`
    FOREIGN KEY (`id_jeu` )
    REFERENCES `JEU` (`id_jeu` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_UTILISE_EVENEMENT1`
    FOREIGN KEY (`id_evt` )
    REFERENCES `EVENEMENT` (`id_evt` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `EMPRUNT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `EMPRUNT` ;

CREATE  TABLE IF NOT EXISTS `EMPRUNT` (
  `id_emprunt` INT NOT NULL AUTO_INCREMENT ,
  `id_eleve` INT NOT NULL ,
  `date_emprunt` DATE NULL ,
  `date_rendu` DATE NULL ,
  `id_exemplaire` INT NOT NULL ,
  INDEX `fk_EMPRUNT_ELEVE1` (`id_eleve` ASC) ,
  PRIMARY KEY (`id_emprunt`) ,
  INDEX `fk_EMPRUNT_EXEMPLAIRE1` (`id_exemplaire` ASC) ,
  CONSTRAINT `fk_EMPRUNT_ELEVE1`
    FOREIGN KEY (`id_eleve` )
    REFERENCES `ELEVE` (`id_eleve` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EMPRUNT_EXEMPLAIRE1`
    FOREIGN KEY (`id_exemplaire` )
    REFERENCES `EXEMPLAIRE` (`id_exemplaire` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Placeholder table for view `HISTORIQUE_MEMBRE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `HISTORIQUE_MEMBRE` (`id_eleve` INT, `nom_eleve` INT, `prenom_eleve` INT, `filliere` INT, `login` INT, `promo` INT, `annee` INT);

-- -----------------------------------------------------
-- Placeholder table for view `MEMBRE_ACTUEL`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MEMBRE_ACTUEL` (`id_eleve` INT, `nom_eleve` INT, `prenom_eleve` INT, `filliere` INT, `login` INT, `promo` INT, `annee` INT);

-- -----------------------------------------------------
-- Placeholder table for view `LIVRE_EMPRUNTE`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `LIVRE_EMPRUNTE` (`id_emprunt` INT, `id_eleve` INT, `date_emprunt` INT, `id_exemplaire` INT, `id_livre` INT);

-- -----------------------------------------------------
-- View `HISTORIQUE_MEMBRE`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `HISTORIQUE_MEMBRE` ;
DROP TABLE IF EXISTS `HISTORIQUE_MEMBRE`;
CREATE  OR REPLACE VIEW HISTORIQUE_MEMBRE AS 
SELECT ELEVE.id_eleve,
       ELEVE.nom_eleve,
       ELEVE.prenom_eleve,
       ELEVE.filliere,
       ELEVE.login,
       ELEVE.promo,
       MEMBRE.annee
FROM ELEVE, MEMBRE 
WHERE ELEVE.id_eleve = MEMBRE.id_eleve AND MEMBRE.annee < YEAR(NOW());

-- -----------------------------------------------------
-- View `MEMBRE_ACTUEL`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `MEMBRE_ACTUEL` ;
DROP TABLE IF EXISTS `MEMBRE_ACTUEL`;

CREATE  OR REPLACE VIEW MEMBRE_ACTUEL AS 
SELECT ELEVE.id_eleve,
       ELEVE.nom_eleve,
       ELEVE.prenom_eleve,
       ELEVE.filliere,
       ELEVE.login,
       ELEVE.promo,
       MEMBRE.annee
FROM ELEVE, MEMBRE 
WHERE ELEVE.id_eleve = MEMBRE.id_eleve AND MEMBRE.annee = YEAR(NOW());


-- -----------------------------------------------------
-- View `LIVRE_EMPRUNTE`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `LIVRE_EMPRUNTE` ;
DROP TABLE IF EXISTS `LIVRE_EMPRUNTE`;

CREATE  OR REPLACE VIEW LIVRE_EMPRUNTE AS
SELECT em.id_emprunt, em.id_eleve, em.date_emprunt, ex.id_exemplaire, ex.id_livre
FROM EMPRUNT em INNER JOIN EXEMPLAIRE ex ON em.id_exemplaire = ex.id_exemplaire
WHERE em.date_rendu is null;


CREATE TRIGGER `MULTIPLE_COMMENT`
BEFORE INSERT
ON `COMMENTAIRE`
FOR EACH ROW
BEGIN
	DECLARE NB_ID INTEGER;
	
    IF(NEW.id_evt is not null) THEN
        SELECT COUNT(*) INTO NB_ID FROM `COMMENTAIRE` WHERE id_eleve=NEW.id_eleve AND id_evt=NEW.id_evt;
	END IF;
    IF(NEW.id_jeu is not null) THEN
        SELECT COUNT(*) INTO NB_ID FROM `COMMENTAIRE` WHERE id_eleve=NEW.id_eleve AND id_jeu=NEW.id_jeu;
	END IF;

	IF (NB_ID>0) THEN
		SET NEW.id_eleve = NULL;
		SET NEW.id_jeu = NULL;
		SET NEW.id_evt = NULL;
	END IF;
END; 

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
