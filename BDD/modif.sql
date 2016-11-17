-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema MQC
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `MQC` ;

-- -----------------------------------------------------
-- Schema MQC
-- -----------------------------------------------------
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
  `stock` INT NULL,
  PRIMARY KEY (`id_produit`),
  INDEX `fk_Produit_utilisateur1_idx` (`id_utilisateur` ASC),
  CONSTRAINT `fk_Produit_utilisateur1`
  FOREIGN KEY (`id_utilisateur`)
  REFERENCES `MQC`.`utilisateur` (`id_utilisateur`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MQC`.`type_mouvement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MQC`.`type_mouvement` (
  `id_type_mouvement` INT NOT NULL AUTO_INCREMENT,
  `libelle` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_type_mouvement`))
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MQC`.`stock_mouvement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MQC`.`stock_mouvement` (
  `id_stock_mouvement` INT NOT NULL AUTO_INCREMENT,
  `quantite` INT NOT NULL,
  `date_add` DATETIME NOT NULL,
  `id_type_mouvement` INT NOT NULL,
  `id_produit` INT NOT NULL,
  PRIMARY KEY (`id_stock_mouvement`),
  INDEX `fk_stock_mouvement_type_mouvement1_idx` (`id_type_mouvement` ASC),
  INDEX `fk_stock_mouvement_Produit1_idx` (`id_produit` ASC),
  CONSTRAINT `fk_stock_mouvement_type_mouvement1`
  FOREIGN KEY (`id_type_mouvement`)
  REFERENCES `MQC`.`type_mouvement` (`id_type_mouvement`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_stock_mouvement_Produit1`
  FOREIGN KEY (`id_produit`)
  REFERENCES `MQC`.`Produit` (`id_produit`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `MQC`.`article`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `MQC`.`article` (
  `id_article` INT NOT NULL AUTO_INCREMENT,
  `titre_article` VARCHAR(45) NOT NULL,
  `titre_short_texte` VARCHAR(45) NOT NULL,
  `short_texte` VARCHAR(500) NOT NULL,
  `texte` VARCHAR(1000) NOT NULL,
  PRIMARY KEY (`id_article`))
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
INSERT INTO `MQC`.`Produit` (`id_produit`, `libelle`, `prix`, `id_utilisateur`, `active`, `stock`) VALUES (DEFAULT, 'ProduitTest', 18.37, 1, 1, 10);

COMMIT;


-- -----------------------------------------------------
-- Data for table `MQC`.`type_mouvement`
-- -----------------------------------------------------
START TRANSACTION;
USE `MQC`;
INSERT INTO `MQC`.`type_mouvement` (`id_type_mouvement`, `libelle`) VALUES (DEFAULT, 'entree');
INSERT INTO `MQC`.`type_mouvement` (`id_type_mouvement`, `libelle`) VALUES (DEFAULT, 'sortie');

COMMIT;

ALTER TABLE `utilisateur` ADD `date_add` DATETIME NOT NULL AFTER `password`;
ALTER TABLE `utilisateur` ADD `date_upd` DATETIME NULL AFTER `date_add`;
ALTER TABLE `utilisateur` ADD `nom` VARCHAR(45) NOT NULL AFTER `id_droit`, ADD `prenom` VARCHAR(45) NOT NULL AFTER `nom`;
UPDATE `utilisateur` SET `date_add` = '2016-11-16 21:15:26' WHERE `utilisateur`.`id_utilisateur` = 1;
UPDATE `mqc`.`utilisateur` SET `nom` = 'Doe', `prenom` = 'John' WHERE `utilisateur`.`id_utilisateur` = 1;
ALTER TABLE `article` CHANGE `short_texte` `short_texte` MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `article` CHANGE `texte` `texte` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `article` ADD `date_add` DATETIME NOT NULL AFTER `texte`;
ALTER TABLE `article` ADD `date_upd` DATETIME NULL AFTER `date_add`;
ALTER TABLE `article` ADD `active` INTEGER  NOT NULL AFTER `date_upd`;
INSERT INTO `article` (`id_article`, `titre_article`, `titre_short_texte`, `short_texte`, `texte`, `date_add`, `date_upd`, `active`) VALUES (NULL, 'Les commerces', 'Commerces et activités', 'Le centre commercial de Confluence, ouvert depuis le 4 avril 2012, est situé au 112 Cours Charlemagne à Lyon 69002.<br>
                Il comprend aujourd\'hui 106 commerces de toutes sortes, 12 restaurants, un <a href="http://www.ugc.fr/cinema.html">cinéma UGC</a> ainsi qu\'un parking de 1500 places et un hôtel <a href="http://www.novotel.com/fr/hotel-7325-novotel-lyon-confluence/index.shtml">Novotel</a> de 150 chambres.<br>
               <br>
                Par ailleurs le centre commercial comprend le plus grand mur d\'escalade de France !<br>
               <br>
               <br>
                <a href="#Accessibilite">Cliquer ici pour voir les moyens de vous y rendre.</a>', 'test', '2016-11-17 01:53:07', NULL, 1);


