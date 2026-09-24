-- Step: 01
-- Goal: Create a new database be-laravel
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            11-09-2026      Ayssar Akoudad             New
-- **********************************************************************************/

DROP DATABASE IF EXISTS `be-laravel`;
CREATE DATABASE IF NOT EXISTS `be-laravel`;
USE `be-laravel`;

-- Step: 02
-- Goal: Create a new table producten
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            11-09-2026      Ayssar Akoudad             New
-- **********************************************************************************/

CREATE TABLE IF NOT EXISTS `producten` (
    `ProductId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `Naam` VARCHAR(100) NOT NULL,
    `Barcode` VARCHAR(20) NOT NULL,
    `IsActief` BIT NOT NULL DEFAULT 1,
    `Opmerking` VARCHAR(250) NULL,
    `DatumAangemaakt` DATETIME(6) NOT NULL,
    `DatumGewijzigd` DATETIME(6) NULL,
    PRIMARY KEY (`ProductId`),
    UNIQUE KEY `UQ_producten_Barcode` (`Barcode`)
) ENGINE=InnoDB;

-- Step: 03
-- Goal: Create a new table allergenen
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            11-09-2026      Ayssar Akoudad             New
-- **********************************************************************************/

CREATE TABLE IF NOT EXISTS `allergenen` (
    `AllergeenId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `Naam` VARCHAR(100) NOT NULL,
    `Omschrijving` VARCHAR(250) NOT NULL,
    `IsActief` BIT NOT NULL DEFAULT 1,
    `Opmerking` VARCHAR(250) NULL,
    `DatumAangemaakt` DATETIME(6) NOT NULL,
    `DatumGewijzigd` DATETIME(6) NULL,
    PRIMARY KEY (`AllergeenId`)
) ENGINE=InnoDB;

-- Step: 04
-- Goal: Create a new table leveranciers
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            11-09-2026      Ayssar Akoudad             New
-- **********************************************************************************/

CREATE TABLE IF NOT EXISTS `leveranciers` (
    `LeverancierId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `Naam` VARCHAR(100) NOT NULL,
    `ContactPersoon` VARCHAR(100) NOT NULL,
    `LeverancierNummer` VARCHAR(20) NOT NULL,
    `Mobiel` VARCHAR(20) NOT NULL,
    `IsActief` BIT NOT NULL DEFAULT 1,
    `Opmerking` VARCHAR(250) NULL,
    `DatumAangemaakt` DATETIME(6) NOT NULL,
    `DatumGewijzigd` DATETIME(6) NULL,
    PRIMARY KEY (`LeverancierId`),
    UNIQUE KEY `UQ_leveranciers_Nummer` (`LeverancierNummer`)
) ENGINE=InnoDB;

-- Step: 05
-- Goal: Create a new table magazijnen
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            11-09-2026      Ayssar Akoudad             New
-- **********************************************************************************/

CREATE TABLE IF NOT EXISTS `magazijnen` (
    `MagazijnId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `ProductId` INT UNSIGNED NOT NULL,
    `VerpakkingsEenheidInKilogram` DECIMAL(5,2) NOT NULL,
    `AantalAanwezig` INT UNSIGNED NULL,
    `IsActief` BIT NOT NULL DEFAULT 1,
    `Opmerking` VARCHAR(250) NULL,
    `DatumAangemaakt` DATETIME(6) NOT NULL,
    `DatumGewijzigd` DATETIME(6) NULL,
    PRIMARY KEY (`MagazijnId`),
    CONSTRAINT `FK_magazijnen_product` FOREIGN KEY (`ProductId`) REFERENCES `producten` (`ProductId`)
) ENGINE=InnoDB;

-- Step: 06
-- Goal: Create a new table product_per_allergenen
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            11-09-2026      Ayssar Akoudad             New
-- **********************************************************************************/

CREATE TABLE IF NOT EXISTS `product_per_allergenen` (
    `ProductPerAllergeenId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `ProductId` INT UNSIGNED NOT NULL,
    `AllergeenId` INT UNSIGNED NOT NULL,
    `IsActief` BIT NOT NULL DEFAULT 1,
    `Opmerking` VARCHAR(250) NULL,
    `DatumAangemaakt` DATETIME(6) NOT NULL,
    `DatumGewijzigd` DATETIME(6) NULL,
    PRIMARY KEY (`ProductPerAllergeenId`),
    UNIQUE KEY `UQ_product_allergeen` (`ProductId`, `AllergeenId`),
    CONSTRAINT `FK_product_allergeen_product` FOREIGN KEY (`ProductId`) REFERENCES `producten` (`ProductId`),
    CONSTRAINT `FK_product_allergeen_allergeen` FOREIGN KEY (`AllergeenId`) REFERENCES `allergenen` (`AllergeenId`)
) ENGINE=InnoDB;

-- Step: 07
-- Goal: Create a new table product_per_leveranciers
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            11-09-2026      Ayssar Akoudad             New
-- **********************************************************************************/

CREATE TABLE IF NOT EXISTS `product_per_leveranciers` (
    `ProductPerLeverancierId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `LeverancierId` INT UNSIGNED NOT NULL,
    `ProductId` INT UNSIGNED NOT NULL,
    `DatumLevering` DATE NOT NULL,
    `Aantal` INT UNSIGNED NOT NULL,
    `DatumEerstVolgendeLevering` DATE NULL,
    `IsActief` BIT NOT NULL DEFAULT 1,
    `Opmerking` VARCHAR(250) NULL,
    `DatumAangemaakt` DATETIME(6) NOT NULL,
    `DatumGewijzigd` DATETIME(6) NULL,
    PRIMARY KEY (`ProductPerLeverancierId`),
    CONSTRAINT `FK_product_leverancier_leverancier` FOREIGN KEY (`LeverancierId`) REFERENCES `leveranciers` (`LeverancierId`),
    CONSTRAINT `FK_product_leverancier_product` FOREIGN KEY (`ProductId`) REFERENCES `producten` (`ProductId`)
) ENGINE=InnoDB;
