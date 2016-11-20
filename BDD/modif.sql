-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mqc
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mqc` ;

-- -----------------------------------------------------
-- Schema mqc
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mqc` DEFAULT CHARACTER SET utf8 ;
USE `mqc` ;

-- -----------------------------------------------------
-- Table `mqc`.`langue`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mqc`.`langue` (
  `id_langue` INT(11) NOT NULL AUTO_INCREMENT,
  `libelle` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_langue`))
  ENGINE = InnoDB
  AUTO_INCREMENT = 3
  DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mqc`.`article`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mqc`.`article` (
  `id_article` INT(11) NOT NULL AUTO_INCREMENT,
  `titre_article` VARCHAR(45) NOT NULL,
  `titre_short_texte` VARCHAR(45) NOT NULL,
  `short_texte` MEDIUMTEXT NOT NULL,
  `texte` LONGTEXT NOT NULL,
  `date_add` DATETIME NOT NULL,
  `date_upd` DATETIME NULL DEFAULT NULL,
  `active` TINYINT(4) NOT NULL,
  `id_langue` INT(11) NOT NULL,
  PRIMARY KEY (`id_article`),
  INDEX `fk_article_langue1_idx` (`id_langue` ASC),
  CONSTRAINT `fk_article_langue1`
  FOREIGN KEY (`id_langue`)
  REFERENCES `mqc`.`langue` (`id_langue`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB
  AUTO_INCREMENT = 2
  DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mqc`.`droit`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mqc`.`droit` (
  `id_droit` INT(11) NOT NULL AUTO_INCREMENT,
  `libelle` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_droit`))
  ENGINE = InnoDB
  AUTO_INCREMENT = 4
  DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mqc`.`utilisateur`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mqc`.`utilisateur` (
  `id_utilisateur` INT(11) NOT NULL AUTO_INCREMENT,
  `id_droit` INT(11) NOT NULL,
  `nom` VARCHAR(45) NOT NULL,
  `prenom` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `date_add` DATETIME NOT NULL,
  `date_upd` DATETIME NULL DEFAULT NULL,
  `active` TINYINT(4) NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  INDEX `fk_utilisateur_droit_idx` (`id_droit` ASC),
  CONSTRAINT `fk_utilisateur_droit`
  FOREIGN KEY (`id_droit`)
  REFERENCES `mqc`.`droit` (`id_droit`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB
  AUTO_INCREMENT = 2
  DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mqc`.`produit`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mqc`.`produit` (
  `id_produit` INT(11) NOT NULL AUTO_INCREMENT,
  `libelle` VARCHAR(45) NOT NULL,
  `libelle_anglais` VARCHAR(45) NULL,
  `prix` FLOAT NOT NULL,
  `id_utilisateur` INT(11) NOT NULL,
  `active` TINYINT(4) NOT NULL,
  `stock` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_produit`),
  INDEX `fk_Produit_utilisateur1_idx` (`id_utilisateur` ASC),
  CONSTRAINT `fk_Produit_utilisateur1`
  FOREIGN KEY (`id_utilisateur`)
  REFERENCES `mqc`.`utilisateur` (`id_utilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB
  AUTO_INCREMENT = 2
  DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mqc`.`type_mouvement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mqc`.`type_mouvement` (
  `id_type_mouvement` INT(11) NOT NULL AUTO_INCREMENT,
  `libelle` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_type_mouvement`))
  ENGINE = InnoDB
  AUTO_INCREMENT = 3
  DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mqc`.`stock_mouvement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mqc`.`stock_mouvement` (
  `id_stock_mouvement` INT(11) NOT NULL AUTO_INCREMENT,
  `quantite` INT(11) NOT NULL,
  `date_add` DATETIME NOT NULL,
  `id_type_mouvement` INT(11) NOT NULL,
  `id_produit` INT(11) NOT NULL,
  `id_panier` INT NOT NULL,
  PRIMARY KEY (`id_stock_mouvement`),
  INDEX `fk_stock_mouvement_type_mouvement1_idx` (`id_type_mouvement` ASC),
  INDEX `fk_stock_mouvement_Produit1_idx` (`id_produit` ASC),
  CONSTRAINT `fk_stock_mouvement_Produit1`
  FOREIGN KEY (`id_produit`)
  REFERENCES `mqc`.`produit` (`id_produit`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_mouvement_type_mouvement1`
  FOREIGN KEY (`id_type_mouvement`)
  REFERENCES `mqc`.`type_mouvement` (`id_type_mouvement`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mqc`.`Panier`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mqc`.`Panier` (
  `id_panier` INT NOT NULL AUTO_INCREMENT,
  `id_utilisateur` INT(11) NOT NULL,
  `total` FLOAT NOT NULL DEFAULT 0,
  `date_add` DATETIME NOT NULL,
  `date_upd` DATETIME NULL,
  PRIMARY KEY (`id_panier`),
  INDEX `fk_Panier_utilisateur1_idx` (`id_utilisateur` ASC),
  CONSTRAINT `fk_Panier_utilisateur1`
  FOREIGN KEY (`id_utilisateur`)
  REFERENCES `mqc`.`utilisateur` (`id_utilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mqc`.`Panier_has_produit`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mqc`.`Panier_has_produit` (
  `id_panier` INT NOT NULL,
  `id_produit` INT(11) NOT NULL,
  `quantite` INT NOT NULL,
  `date_add` DATETIME NOT NULL,
  `date_upd` DATETIME NULL,
  INDEX `fk_Panier_has_produit_produit1_idx` (`id_produit` ASC),
  INDEX `fk_Panier_has_produit_Panier1_idx` (`id_panier` ASC),
  PRIMARY KEY (`id_panier`, `id_produit`),
  CONSTRAINT `fk_Panier_has_produit_Panier1`
  FOREIGN KEY (`id_panier`)
  REFERENCES `mqc`.`Panier` (`id_panier`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Panier_has_produit_produit1`
  FOREIGN KEY (`id_produit`)
  REFERENCES `mqc`.`produit` (`id_produit`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mqc`.`langue`
-- -----------------------------------------------------
START TRANSACTION;
USE `mqc`;
INSERT INTO `mqc`.`langue` (`id_langue`, `libelle`) VALUES (1, 'français');
INSERT INTO `mqc`.`langue` (`id_langue`, `libelle`) VALUES (2, 'anglais');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mqc`.`droit`
-- -----------------------------------------------------
START TRANSACTION;
USE `mqc`;
INSERT INTO `mqc`.`droit` (`id_droit`, `libelle`) VALUES (1, 'administratuer');
INSERT INTO `mqc`.`droit` (`id_droit`, `libelle`) VALUES (2, 'commerçant');
INSERT INTO `mqc`.`droit` (`id_droit`, `libelle`) VALUES (3, 'utilisateur');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mqc`.`utilisateur`
-- -----------------------------------------------------
START TRANSACTION;
USE `mqc`;
INSERT INTO `mqc`.`utilisateur` (`id_utilisateur`, `id_droit`, `nom`, `prenom`, `email`, `password`, `date_add`, `date_upd`, `active`) VALUES (DEFAULT, 1, 'Doe', 'John', 'DoeJohn@gmail.com', 'johndoe', '2016-11-19 00:00:00', NULL, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mqc`.`type_mouvement`
-- -----------------------------------------------------
START TRANSACTION;
USE `mqc`;
INSERT INTO `mqc`.`type_mouvement` (`id_type_mouvement`, `libelle`) VALUES (1, 'entree');
INSERT INTO `mqc`.`type_mouvement` (`id_type_mouvement`, `libelle`) VALUES (2, 'sortie');

COMMIT;

