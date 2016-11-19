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
  `id_langue` INT NOT NULL AUTO_INCREMENT,
  `libelle` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_langue`))
  ENGINE = InnoDB;


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
  `active` INT(11) NOT NULL,
  `id_langue` INT NOT NULL,
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

INSERT INTO `langue` (`id_langue`, `libelle`) VALUES (NULL, 'français'), (NULL, 'anglais');
INSERT INTO `droit` (`id_droit`, `libelle`) VALUES (NULL, 'administrateur'), (NULL, 'commerçant'), (NULL, 'utilisateur');

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
