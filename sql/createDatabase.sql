SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `projetSGBD` ;
CREATE SCHEMA IF NOT EXISTS `projetSGBD` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `projetSGBD` ;

-- -----------------------------------------------------
-- Table `projetSGBD`.`ELEVE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projetSGBD`.`ELEVE` ;

CREATE  TABLE IF NOT EXISTS `projetSGBD`.`ELEVE` (
  `id_eleve` INT NOT NULL AUTO_INCREMENT ,
  `nom_eleve` VARCHAR(45) NOT NULL ,
  `prenom_eleve` VARCHAR(45) NOT NULL ,
  `filliere` VARCHAR(45) NOT NULL ,
  `login` VARCHAR(45) NOT NULL ,
  `promo` INT NOT NULL ,
  PRIMARY KEY (`id_eleve`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetSGBD`.`MEMBRE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projetSGBD`.`MEMBRE` ;

CREATE  TABLE IF NOT EXISTS `projetSGBD`.`MEMBRE` (
  `id_eleve` INT NOT NULL ,
  `Annee` INT NULL ,
  PRIMARY KEY (`id_eleve`) ,
  INDEX `fk_Membres_Eleves` (`id_eleve` ASC) ,
  CONSTRAINT `fk_Membres_Eleves`
    FOREIGN KEY (`id_eleve` )
    REFERENCES `projetSGBD`.`ELEVE` (`id_eleve` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetSGBD`.`JEU`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projetSGBD`.`JEU` ;

CREATE  TABLE IF NOT EXISTS `projetSGBD`.`JEU` (
  `id_jeu` INT NOT NULL AUTO_INCREMENT ,
  `nom_jeu` VARCHAR(45) NOT NULL ,
  `date_jeu` DATE NULL ,
  `prix_jeu` FLOAT NULL ,
  `etat` VARCHAR(45) NULL ,
  PRIMARY KEY (`id_jeu`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetSGBD`.`EVENEMENT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projetSGBD`.`EVENEMENT` ;

CREATE  TABLE IF NOT EXISTS `projetSGBD`.`EVENEMENT` (
  `id_evt` INT NOT NULL AUTO_INCREMENT ,
  `date_evt` DATE NOT NULL ,
  `nbparticipants` INT NOT NULL DEFAULT 0 ,
  `lieu` VARCHAR(45) NULL DEFAULT 'enseirb' ,
  PRIMARY KEY (`id_evt`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetSGBD`.`COMMENTAIRE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projetSGBD`.`COMMENTAIRE` ;

CREATE  TABLE IF NOT EXISTS `projetSGBD`.`COMMENTAIRE` (
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
    REFERENCES `projetSGBD`.`ELEVE` (`id_eleve` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_COMMENTAIRE_JEU1`
    FOREIGN KEY (`id_jeu` )
    REFERENCES `projetSGBD`.`JEU` (`id_jeu` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_COMMENTAIRE_EVENEMENT1`
    FOREIGN KEY (`id_evt` )
    REFERENCES `projetSGBD`.`EVENEMENT` (`id_evt` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetSGBD`.`LIVRE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projetSGBD`.`LIVRE` ;

CREATE  TABLE IF NOT EXISTS `projetSGBD`.`LIVRE` (
  `id_livre` INT NOT NULL AUTO_INCREMENT ,
  `titre` VARCHAR(45) NOT NULL ,
  `auteur` VARCHAR(45) NOT NULL ,
  `editeur` VARCHAR(45) NOT NULL ,
  `ISBN` INT NOT NULL ,
  PRIMARY KEY (`id_livre`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetSGBD`.`EXEMPLAIRE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projetSGBD`.`EXEMPLAIRE` ;

CREATE  TABLE IF NOT EXISTS `projetSGBD`.`EXEMPLAIRE` (
  `id_exemplaire` INT NOT NULL AUTO_INCREMENT ,
  `empruntable` TINYINT(1) NOT NULL DEFAULT true ,
  `date_livre` DATE NULL ,
  `prix_livre` FLOAT NOT NULL DEFAULT 0 ,
  `id_livre` INT NOT NULL ,
  PRIMARY KEY (`id_exemplaire`) ,
  INDEX `fk_EXEMPLAIRE_LIVRE1` (`id_livre` ASC) ,
  CONSTRAINT `fk_EXEMPLAIRE_LIVRE1`
    FOREIGN KEY (`id_livre` )
    REFERENCES `projetSGBD`.`LIVRE` (`id_livre` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetSGBD`.`PARTICIPE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projetSGBD`.`PARTICIPE` ;

CREATE  TABLE IF NOT EXISTS `projetSGBD`.`PARTICIPE` (
  `id_eleve` INT NULL ,
  `id_evt` INT NULL ,
  INDEX `fk_PARTICIPE_EVENEMENT1` (`id_evt` ASC) ,
  CONSTRAINT `fk_PARTICIPE_ELEVE1`
    FOREIGN KEY (`id_eleve` )
    REFERENCES `projetSGBD`.`ELEVE` (`id_eleve` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PARTICIPE_EVENEMENT1`
    FOREIGN KEY (`id_evt` )
    REFERENCES `projetSGBD`.`EVENEMENT` (`id_evt` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetSGBD`.`UTILISE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projetSGBD`.`UTILISE` ;

CREATE  TABLE IF NOT EXISTS `projetSGBD`.`UTILISE` (
  `id_jeu` INT NOT NULL ,
  `id_evt` INT NOT NULL ,
  PRIMARY KEY (`id_jeu`, `id_evt`) ,
  INDEX `fk_UTILISE_EVENEMENT1` (`id_evt` ASC) ,
  CONSTRAINT `fk_UTILISE_JEU1`
    FOREIGN KEY (`id_jeu` )
    REFERENCES `projetSGBD`.`JEU` (`id_jeu` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_UTILISE_EVENEMENT1`
    FOREIGN KEY (`id_evt` )
    REFERENCES `projetSGBD`.`EVENEMENT` (`id_evt` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetSGBD`.`EMPRUNT`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projetSGBD`.`EMPRUNT` ;

CREATE  TABLE IF NOT EXISTS `projetSGBD`.`EMPRUNT` (
  `id_eleve` INT NOT NULL ,
  `date_rendu` DATE NULL ,
  `id_emprunt` INT NOT NULL AUTO_INCREMENT ,
  `id_exemplaire` INT NOT NULL ,
  INDEX `fk_EMPRUNT_ELEVE1` (`id_eleve` ASC) ,
  PRIMARY KEY (`id_emprunt`) ,
  INDEX `fk_EMPRUNT_EXEMPLAIRE1` (`id_exemplaire` ASC) ,
  CONSTRAINT `fk_EMPRUNT_ELEVE1`
    FOREIGN KEY (`id_eleve` )
    REFERENCES `projetSGBD`.`ELEVE` (`id_eleve` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_EMPRUNT_EXEMPLAIRE1`
    FOREIGN KEY (`id_exemplaire` )
    REFERENCES `projetSGBD`.`EXEMPLAIRE` (`id_exemplaire` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
