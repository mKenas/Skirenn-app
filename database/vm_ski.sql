



SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET FOREIGN_KEY_CHECKS=0;


DROP DATABASE IF EXISTS vm_ski;

CREATE DATABASE `vm_ski` CHARACTER SET "utf8";

use `vm_ski`;

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
  `ØvelsesId` INT NULL,
  PRIMARY KEY (`PersonId`),
  foreign key(`ØvelsesId`)
  references Øvels(`ØvelsId`)
  ON DELETE SET NULL )
  ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `Publikum` (
  `PublikumId` INT NOT NULL AUTO_INCREMENT ,
  `BillettType` VARCHAR(45) NOT NULL,
  `PersonId` INT NULL,
  PRIMARY KEY (`PublikumId`),
  foreign key(`PersonId`)
  references Person(`PersonId`)
  ON DELETE SET NULL)
  ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `Utøver` (
  `UtøverId` INT NOT NULL AUTO_INCREMENT,
  `Nasjonalitet` VARCHAR(45) NOT NULL,
  `PersonId` INT NULL,
  PRIMARY KEY (`UtøverId`),
  foreign key(`PersonId`)
  references Person(`PersonId`)
  ON DELETE SET NULL)
  ENGINE=InnoDB DEFAULT CHARSET=latin1;


  INSERT INTO `Øvels` (`ØvelsId`, `Dato`, `Type`, `Sted`)
  VALUES (NULL, '2018-04-01 09:00:00', 'Alpint', 'Oslo'),
  (NULL, '2018-05-16 08:00:00', 'Hopp', 'Bergen'),
  (NULL, '2018-06-08 16:00:00', 'Slalom', 'Tromsø'),
  (NULL, '2018-07-15 11:00:00', 'Langrenn', 'Finnmark');


  INSERT INTO `Person` (`PersonId`, `Fornavn`, `Etternavn`, `Adresse`, `PostNum`, `Poststed`, `Telefonnr`, `ØvelsesId`)
  VALUES (NULL, 'Mohamad', 'Kenas', 'Refstadveien', '0589', 'Oslo', '41116333', 1),
  (NULL, 'Ada', 'Andersen', 'Tverrveien 15', '1358', 'JAR', '45111388', 2),
  (NULL, 'Peter', 'Rasmussen', 'Heiloveien 153', '8616', 'MO I RANA', '42592616', 3),
  (NULL, 'Kaia', 'Andreassen', 'Kleivaneset 57', '6090', 'FOSNAVÅG', '47623013', 4),
  (NULL, 'Oliver', 'Johnsen', 'Bekkelistubben 65', '0375', 'OSLO', '44174799', 1),

  (NULL, 'Matilde', 'Ness', 'Johan Nygaardsvolds gate 233', '8622', 'MO I RANA', '99677830', 2),
  (NULL, 'Sverre', 'Jensen', 'Hagelinveien 29', '6511', 'KRISTIANSUND', '46686548', 3),
  (NULL, 'Maria', 'Gravdal', 'Oscar Pettersensvei 160', '1678', 'KRÅKERØY', '43129808', 4);

  INSERT INTO `Publikum` (`PublikumId`, `BillettType`, `PersonId`)
  VALUES (NULL, 'VIP',1),
  (NULL, 'Voksen', 2),
  (NULL, 'Voksen',3),
  (NULL, 'Voksen', 4);

  INSERT INTO `Utøver` (`UtøverId`, `Nasjonalitet`, `PersonId`)
  VALUES (NULL, 'Norge',5),
  (NULL, 'Norge', 6),
    (NULL, 'Sverige', 7),
  (NULL, 'Danmark', 8);
