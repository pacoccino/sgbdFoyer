SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `projetSGBD` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `projetSGBD` ;

-- -----------------------------------------------------
-- Table `projetSGBD`.`Eleves`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projetSGBD`.`Eleves` ;

CREATE  TABLE IF NOT EXISTS `projetSGBD`.`Eleves` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `Nom` VARCHAR(45) NULL ,
  `Prenom` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `projetSGBD`.`Membres`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `projetSGBD`.`Membres` ;

CREATE  TABLE IF NOT EXISTS `projetSGBD`.`Membres` (
  `id` INT NOT NULL ,
  `Annee` INT NULL ,
  `Eleves_id` INT NOT NULL ,
  PRIMARY KEY (`id`, `Eleves_id`) ,
  INDEX `fk_Membres_Eleves` (`Eleves_id` ASC) ,
  CONSTRAINT `fk_Membres_Eleves`
    FOREIGN KEY (`Eleves_id` )
    REFERENCES `projetSGBD`.`Eleves` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Placeholder table for view `projetSGBD`.`view1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `projetSGBD`.`view1` (`id` INT);

-- -----------------------------------------------------
-- View `projetSGBD`.`view1`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `projetSGBD`.`view1` ;
DROP TABLE IF EXISTS `projetSGBD`.`view1`;
USE `projetSGBD`;
CREATE  OR REPLACE VIEW `mydb`.`view1` AS 
SELECT * FROM Membres outer join Eleves;
;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
