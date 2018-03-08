



SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET FOREIGN_KEY_CHECKS=0;


DROP DATABASE IF EXISTS vm_ski;





CREATE DATABASE `vm_ski` CHARACTER SET "utf8";

use `vm_ski`;

-- Oppretter tabellen

CREATE TABLE `Øvels` (
  `ØvelsId` INT NOT NULL AUTO_INCREMENT,
  `Dato` DATETIME NOT NULL,
  `Type` VARCHAR(45) NOT NULL,
  `Sted` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`ØvelsId`))ENGINE=InnoDB DEFAULT CHARSET=latin1;





CREATE TABLE `Person` (
  `PersonId` INT NOT NULL AUTO_INCREMENT,
  `Fornavn` VARCHAR(45) NOT NULL,
  `Etternavn` VARCHAR(45) NOT NULL,
  `Adresse` VARCHAR(60) NULL,
  `PostNum` CHAR(4) NULL,
  `Poststed` VARCHAR(45) NULL,
  `Telefonnr` VARCHAR(8) NULL,
  `ØvelsesInfo` VARCHAR(60) NULL,
  PRIMARY KEY (`PersonId`))ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `Publikum` (
  `PublikumId` INT NOT NULL AUTO_INCREMENT ,
  `BillettType` VARCHAR(45) NOT NULL,
  `PersonId` INT NOT NULL,
  PRIMARY KEY (`PublikumId`),
  foreign key(`PersonId`) references Person(`PersonId`) )ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `Utøver` (
  `UtøverId` INT NOT NULL AUTO_INCREMENT,
  `Nasjonalitet` VARCHAR(45) NOT NULL,
  `PersonId` INT NOT NULL,
  PRIMARY KEY (`UtøverId`),
foreign key(`PersonId`) references Person(`PersonId`) )ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `Person_deltakelse` (
  `Øvels_ØvelsId` INT(11) NOT NULL,
  `Person_PersonId` INT(11) NOT NULL,
  PRIMARY KEY (`Øvels_ØvelsId`, `Person_PersonId`))ENGINE=InnoDB DEFAULT CHARSET=latin1;



  INSERT INTO `Øvels` (`ØvelsId`, `Dato`, `Type`, `Sted`)
  VALUES (NULL, '2018-04-01 09:00:00', 'Alpint', 'Oslo'),
  (NULL, '2018-05-16 08:00:00', 'Hopp', 'Bergen'),
  (NULL, '2018-06-08 16:00:00', 'Slalom', 'Tromsø'),
  (NULL, '2018-07-15 11:00:00', 'Langrenn', 'Finnmark');
