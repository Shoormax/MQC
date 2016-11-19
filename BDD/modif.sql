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
  `id_langue` INT(11) NULL DEFAULT NULL,
  `image` VARCHAR(250) NOT NULL,
  `titre_navbar` VARCHAR(45) NOT NULL,
  `image_navbar` VARCHAR(250) NOT NULL,
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
  AUTO_INCREMENT = 3
  DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mqc`.`panier`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mqc`.`panier` (
  `id_panier` INT(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` INT(11) NOT NULL,
  `total` FLOAT NOT NULL DEFAULT '0',
  `date_add` DATETIME NOT NULL,
  `date_upd` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id_panier`),
  INDEX `fk_Panier_utilisateur1_idx` (`id_utilisateur` ASC),
  CONSTRAINT `fk_Panier_utilisateur1`
  FOREIGN KEY (`id_utilisateur`)
  REFERENCES `mqc`.`utilisateur` (`id_utilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mqc`.`Boutique`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mqc`.`Boutique` (
  `id_boutique` INT NOT NULL AUTO_INCREMENT,
  `libelle` VARCHAR(200) NOT NULL,
  `adresse` VARCHAR(50) NULL,
  `code_postal` VARCHAR(45) NULL,
  `Ville` VARCHAR(45) NULL,
  PRIMARY KEY (`id_boutique`))
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mqc`.`produit`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mqc`.`produit` (
  `id_produit` INT(11) NOT NULL AUTO_INCREMENT,
  `libelle` VARCHAR(45) NOT NULL,
  `libelle_anglais` VARCHAR(45) NULL DEFAULT NULL,
  `prix` FLOAT NOT NULL,
  `active` TINYINT(4) NOT NULL,
  `stock` INT(11) NULL DEFAULT '0',
  `image` MEDIUMTEXT NULL DEFAULT NULL,
  `id_boutique` INT NOT NULL,
  PRIMARY KEY (`id_produit`),
  INDEX `fk_produit_Boutique1_idx` (`id_boutique` ASC),
  CONSTRAINT `fk_produit_Boutique1`
  FOREIGN KEY (`id_boutique`)
  REFERENCES `mqc`.`Boutique` (`id_boutique`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB
  AUTO_INCREMENT = 2
  DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mqc`.`panier_has_produit`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mqc`.`panier_has_produit` (
  `id_panier` INT(11) NOT NULL,
  `id_produit` INT(11) NOT NULL,
  `quantite` INT(11) NOT NULL,
  `date_add` DATETIME NOT NULL,
  `date_upd` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id_panier`, `id_produit`),
  INDEX `fk_Panier_has_produit_produit1_idx` (`id_produit` ASC),
  INDEX `fk_Panier_has_produit_Panier1_idx` (`id_panier` ASC),
  CONSTRAINT `fk_Panier_has_produit_Panier1`
  FOREIGN KEY (`id_panier`)
  REFERENCES `mqc`.`panier` (`id_panier`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Panier_has_produit_produit1`
  FOREIGN KEY (`id_produit`)
  REFERENCES `mqc`.`produit` (`id_produit`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB
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
  `id_panier` INT(11) NOT NULL,
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
-- Table `mqc`.`Boutique_has_utilisateur`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mqc`.`Boutique_has_utilisateur` (
  `id_boutique` INT NOT NULL,
  `id_utilisateur` INT(11) NOT NULL,
  PRIMARY KEY (`id_boutique`, `id_utilisateur`),
  INDEX `fk_Boutique_has_utilisateur_utilisateur1_idx` (`id_utilisateur` ASC),
  INDEX `fk_Boutique_has_utilisateur_Boutique1_idx` (`id_boutique` ASC),
  CONSTRAINT `fk_Boutique_has_utilisateur_Boutique1`
  FOREIGN KEY (`id_boutique`)
  REFERENCES `mqc`.`Boutique` (`id_boutique`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Boutique_has_utilisateur_utilisateur1`
  FOREIGN KEY (`id_utilisateur`)
  REFERENCES `mqc`.`utilisateur` (`id_utilisateur`)
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
INSERT INTO `mqc`.`droit` (`id_droit`, `libelle`) VALUES (1, 'administrateur');
INSERT INTO `mqc`.`droit` (`id_droit`, `libelle`) VALUES (2, 'commerçant');
INSERT INTO `mqc`.`droit` (`id_droit`, `libelle`) VALUES (3, 'utilisateur');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mqc`.`utilisateur`
-- -----------------------------------------------------
START TRANSACTION;
USE `mqc`;
INSERT INTO `mqc`.`utilisateur` (`id_utilisateur`, `id_droit`, `nom`, `prenom`, `email`, `password`, `date_add`, `date_upd`, `active`) VALUES (1, 1, 'Doe', 'John', 'DoeJohn@gmail.com', 'JohnDoe', '2016-11-19 00:00:00', NULL, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mqc`.`Boutique`
-- -----------------------------------------------------
START TRANSACTION;
USE `mqc`;
INSERT INTO `mqc`.`Boutique` (`id_boutique`, `libelle`, `adresse`, `code_postal`, `Ville`) VALUES (1, 'La boutique à John Doe', '25 route de la ripaille', '69002', 'Lyon');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mqc`.`type_mouvement`
-- -----------------------------------------------------
START TRANSACTION;
USE `mqc`;
INSERT INTO `mqc`.`type_mouvement` (`id_type_mouvement`, `libelle`) VALUES (1, 'entree');
INSERT INTO `mqc`.`type_mouvement` (`id_type_mouvement`, `libelle`) VALUES (2, 'sortie');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mqc`.`Boutique_has_utilisateur`
-- -----------------------------------------------------
START TRANSACTION;
USE `mqc`;
INSERT INTO `mqc`.`Boutique_has_utilisateur` (`id_boutique`, `id_utilisateur`) VALUES (1, 1);

COMMIT;
ALTER TABLE `boutique_has_utilisateur` ADD `active` TINYINT NOT NULL DEFAULT '1' AFTER `id_utilisateur`;
ALTER TABLE `article` CHANGE `active` `active` TINYINT(4) NOT NULL DEFAULT '1';
ALTER TABLE `article` CHANGE `id_langue` `id_langue` INT(11) NULL DEFAULT '1';
INSERT INTO
  `article`(
    `id_article`,
    `titre_article`,
    `titre_short_texte`,
    `short_texte`,
    `texte`,
    `date_add`,
    `date_upd`,
    `active`,
    `id_langue`,
    `image`,
    `titre_navbar`,
    `image_navbar`
  )
VALUES
  (1,'Accessibilité','Bonjour','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean lobortis orci eget semper ornare. Etiam sed porttitor nisl. Nunc pretium semper dolor, vitae dapibus diam condimentum sed. Suspendisse tincidunt aliquet mauris, at auctor ante sagittis vel. Pellentesque vitae nisl nulla. Donec vitae accumsan orci.','','2016-11-19 21:02:32',NULL,DEFAULT,DEFAULT,'img/min/musee.jpg','Bonjour',''),
  (2,'Accueil','Clapette','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean lobortis orci eget semper ornare. Etiam sed porttitor nisl. Nunc pretium semper dolor, vitae dapibus diam condimentum sed. Suspendisse tincidunt aliquet mauris, at auctor ante sagittis vel. Pellentesque vitae nisl nulla. Donec vitae accumsan orci.','','2016-11-19 21:02:32',NULL,DEFAULT,DEFAULT,'img/min/musee.jpg','Clapette',''),
  (3,'Musée','On boit','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean lobortis orci eget semper ornare. Etiam sed porttitor nisl. Nunc pretium semper dolor, vitae dapibus diam condimentum sed. Suspendisse tincidunt aliquet mauris, at auctor ante sagittis vel. Pellentesque vitae nisl nulla. Donec vitae accumsan orci.','','2016-11-19 21:02:32',NULL,DEFAULT,DEFAULT,'img/min/musee.jpg','On boit',''),
  (4,'Architecture','Une bière','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean lobortis orci eget semper ornare. Etiam sed porttitor nisl. Nunc pretium semper dolor, vitae dapibus diam condimentum sed. Suspendisse tincidunt aliquet mauris, at auctor ante sagittis vel. Pellentesque vitae nisl nulla. Donec vitae accumsan orci.','','2016-11-19 21:02:32',NULL,DEFAULT,DEFAULT,'img/min/musee.jpg','Une bière',''),
  (5,'Commerces','Ou pas ?','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean lobortis orci eget semper ornare. Etiam sed porttitor nisl. Nunc pretium semper dolor, vitae dapibus diam condimentum sed. Suspendisse tincidunt aliquet mauris, at auctor ante sagittis vel. Pellentesque vitae nisl nulla. Donec vitae accumsan orci.','','2016-11-19 21:02:32',NULL,DEFAULT,DEFAULT,'img/min/musee.jpg','Ou pas ?',''),
  (6,'Quais','Lol','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean lobortis orci eget semper ornare. Etiam sed porttitor nisl. Nunc pretium semper dolor, vitae dapibus diam condimentum sed. Suspendisse tincidunt aliquet mauris, at auctor ante sagittis vel. Pellentesque vitae nisl nulla. Donec vitae accumsan orci.','','2016-11-19 21:02:32',NULL,DEFAULT,DEFAULT,'img/min/musee.jpg','Lol',''),
  (7,'Aller','Aller','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean lobortis orci eget semper ornare. Etiam sed porttitor nisl. Nunc pretium semper dolor, vitae dapibus diam condimentum sed. Suspendisse tincidunt aliquet mauris, at auctor ante sagittis vel. Pellentesque vitae nisl nulla. Donec vitae accumsan orci.','','2016-11-19 21:02:32',NULL,DEFAULT,DEFAULT,'img/min/musee.jpg','Aller',''),
  (8,'Bisous','Bisous','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean lobortis orci eget semper ornare. Etiam sed porttitor nisl. Nunc pretium semper dolor, vitae dapibus diam condimentum sed. Suspendisse tincidunt aliquet mauris, at auctor ante sagittis vel. Pellentesque vitae nisl nulla. Donec vitae accumsan orci.','','2016-11-19 21:02:32',NULL,DEFAULT,DEFAULT,'img/min/musee.jpg','Bisous',''),
  (9,'Refré','Refré','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean lobortis orci eget semper ornare. Etiam sed porttitor nisl. Nunc pretium semper dolor, vitae dapibus diam condimentum sed. Suspendisse tincidunt aliquet mauris, at auctor ante sagittis vel. Pellentesque vitae nisl nulla. Donec vitae accumsan orci.','','2016-11-19 21:02:32',NULL,DEFAULT,DEFAULT,'img/min/musee.jpg','Refré',''),
  (10,'A toute','A toute','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean lobortis orci eget semper ornare. Etiam sed porttitor nisl. Nunc pretium semper dolor, vitae dapibus diam condimentum sed. Suspendisse tincidunt aliquet mauris, at auctor ante sagittis vel. Pellentesque vitae nisl nulla. Donec vitae accumsan orci.','','2016-11-19 21:02:32',NULL,DEFAULT,DEFAULT,'img/min/musee.jpg','A toute','')