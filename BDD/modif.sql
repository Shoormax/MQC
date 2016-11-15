-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema MQC
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema MQC
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `MQC`;
CREATE SCHEMA IF NOT EXISTS `MQC` DEFAULT CHARACTER SET utf8 ;
USE `MQC` ;

-- -----------------------------------------------------
-- Table `MQC`.`droit`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MQC`.`droit` (
  `id_droit` INT NOT NULL AUTO_INCREMENT,
  `libelle` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_droit`))
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MQC`.`utilisateur`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MQC`.`utilisateur` (
  `id_utilisateur` INT NOT NULL AUTO_INCREMENT,
  `id_droit` INT NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `active` TINYINT NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  INDEX `fk_utilisateur_droit_idx` (`id_droit` ASC),
  CONSTRAINT `fk_utilisateur_droit`
  FOREIGN KEY (`id_droit`)
  REFERENCES `MQC`.`droit` (`id_droit`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MQC`.`Produit`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MQC`.`Produit` (
  `id_produit` INT NOT NULL AUTO_INCREMENT,
  `libelle` VARCHAR(45) NOT NULL,
  `prix` FLOAT NOT NULL,
  `id_utilisateur` INT NOT NULL,
  `active` TINYINT NOT NULL,
  PRIMARY KEY (`id_produit`, `id_utilisateur`),
  INDEX `fk_Produit_utilisateur1_idx` (`id_utilisateur` ASC),
  CONSTRAINT `fk_Produit_utilisateur1`
  FOREIGN KEY (`id_utilisateur`)
  REFERENCES `MQC`.`utilisateur` (`id_utilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `MQC`.`droit`
-- -----------------------------------------------------
START TRANSACTION;
USE `MQC`;
INSERT INTO `MQC`.`droit` (`id_droit`, `libelle`) VALUES (DEFAULT, 'Administrateur');
INSERT INTO `MQC`.`droit` (`id_droit`, `libelle`) VALUES (DEFAULT, 'Commerçant');
INSERT INTO `MQC`.`droit` (`id_droit`, `libelle`) VALUES (DEFAULT, 'Utilisateur');

COMMIT;


-- -----------------------------------------------------
-- Data for table `MQC`.`utilisateur`
-- -----------------------------------------------------
START TRANSACTION;
USE `MQC`;
INSERT INTO `MQC`.`utilisateur` (`id_utilisateur`, `id_droit`, `email`, `password`, `active`) VALUES (DEFAULT, 1, 'test@test.com', 'test', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `MQC`.`Produit`
-- -----------------------------------------------------
START TRANSACTION;
USE `MQC`;
INSERT INTO `MQC`.`Produit` (`id_produit`, `libelle`, `prix`, `id_utilisateur`, `active`) VALUES (DEFAULT, 'ProduitTest', 18.37, 1, 1);

COMMIT;

