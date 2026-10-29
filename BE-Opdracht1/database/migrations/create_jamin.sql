-- BE-opdracht 2: Jamin database create script
-- Run this script against MySQL or MariaDB.
-- It is safe to run more than once: it does not drop the database or tables.

CREATE DATABASE IF NOT EXISTS `be-laravel`;
USE `be-laravel`;

CREATE TABLE IF NOT EXISTS `producten` (
    `ProductId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `Naam` VARCHAR(100) NOT NULL,
    `Barcode` VARCHAR(20) NOT NULL,
    `IsActief` BIT NOT NULL DEFAULT b'1',
    `Opmerking` VARCHAR(255) NULL DEFAULT NULL,
    `DatumAangemaakt` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    `DatumGewijzigd` DATETIME(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (`ProductId`),
    UNIQUE KEY `UQ_producten_Barcode` (`Barcode`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `allergenen` (
    `AllergeenId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `Naam` VARCHAR(100) NOT NULL,
    `Omschrijving` VARCHAR(250) NOT NULL,
    `IsActief` BIT NOT NULL DEFAULT b'1',
    `Opmerking` VARCHAR(255) NULL DEFAULT NULL,
    `DatumAangemaakt` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    `DatumGewijzigd` DATETIME(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (`AllergeenId`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `leveranciers` (
    `LeverancierId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `Naam` VARCHAR(100) NOT NULL,
    `ContactPersoon` VARCHAR(100) NOT NULL,
    `LeverancierNummer` VARCHAR(20) NOT NULL,
    `Mobiel` VARCHAR(20) NOT NULL,
    `IsActief` BIT NOT NULL DEFAULT b'1',
    `Opmerking` VARCHAR(255) NULL DEFAULT NULL,
    `DatumAangemaakt` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    `DatumGewijzigd` DATETIME(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (`LeverancierId`),
    UNIQUE KEY `UQ_leveranciers_Nummer` (`LeverancierNummer`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `magazijnen` (
    `MagazijnId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `ProductId` INT UNSIGNED NOT NULL,
    `VerpakkingsEenheidInKilogram` DECIMAL(5,2) NOT NULL,
    `AantalAanwezig` INT UNSIGNED NULL,
    `IsActief` BIT NOT NULL DEFAULT b'1',
    `Opmerking` VARCHAR(255) NULL DEFAULT NULL,
    `DatumAangemaakt` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    `DatumGewijzigd` DATETIME(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (`MagazijnId`),
    CONSTRAINT `FK_magazijnen_product`
        FOREIGN KEY (`ProductId`) REFERENCES `producten` (`ProductId`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `product_per_allergenen` (
    `ProductPerAllergeenId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `ProductId` INT UNSIGNED NOT NULL,
    `AllergeenId` INT UNSIGNED NOT NULL,
    `IsActief` BIT NOT NULL DEFAULT b'1',
    `Opmerking` VARCHAR(255) NULL DEFAULT NULL,
    `DatumAangemaakt` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    `DatumGewijzigd` DATETIME(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (`ProductPerAllergeenId`),
    UNIQUE KEY `UQ_product_allergeen` (`ProductId`, `AllergeenId`),
    CONSTRAINT `FK_product_allergeen_product`
        FOREIGN KEY (`ProductId`) REFERENCES `producten` (`ProductId`),
    CONSTRAINT `FK_product_allergeen_allergeen`
        FOREIGN KEY (`AllergeenId`) REFERENCES `allergenen` (`AllergeenId`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `product_per_leveranciers` (
    `ProductPerLeverancierId` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `LeverancierId` INT UNSIGNED NOT NULL,
    `ProductId` INT UNSIGNED NOT NULL,
    `DatumLevering` DATE NOT NULL,
    `Aantal` INT UNSIGNED NOT NULL,
    `DatumEerstVolgendeLevering` DATE NULL,
    `IsActief` BIT NOT NULL DEFAULT b'1',
    `Opmerking` VARCHAR(255) NULL DEFAULT NULL,
    `DatumAangemaakt` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    `DatumGewijzigd` DATETIME(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (`ProductPerLeverancierId`),
    CONSTRAINT `FK_product_leverancier_leverancier`
        FOREIGN KEY (`LeverancierId`) REFERENCES `leveranciers` (`LeverancierId`),
    CONSTRAINT `FK_product_leverancier_product`
        FOREIGN KEY (`ProductId`) REFERENCES `producten` (`ProductId`)
) ENGINE=InnoDB;

ALTER TABLE `producten`
    MODIFY `Opmerking` VARCHAR(255) NULL DEFAULT NULL,
    MODIFY `DatumAangemaakt` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    MODIFY `DatumGewijzigd` DATETIME(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6);

ALTER TABLE `allergenen`
    MODIFY `Opmerking` VARCHAR(255) NULL DEFAULT NULL,
    MODIFY `DatumAangemaakt` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    MODIFY `DatumGewijzigd` DATETIME(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6);

ALTER TABLE `leveranciers`
    MODIFY `Opmerking` VARCHAR(255) NULL DEFAULT NULL,
    MODIFY `DatumAangemaakt` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    MODIFY `DatumGewijzigd` DATETIME(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6);

ALTER TABLE `magazijnen`
    MODIFY `Opmerking` VARCHAR(255) NULL DEFAULT NULL,
    MODIFY `DatumAangemaakt` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    MODIFY `DatumGewijzigd` DATETIME(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6);

ALTER TABLE `product_per_allergenen`
    MODIFY `Opmerking` VARCHAR(255) NULL DEFAULT NULL,
    MODIFY `DatumAangemaakt` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    MODIFY `DatumGewijzigd` DATETIME(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6);

ALTER TABLE `product_per_leveranciers`
    MODIFY `Opmerking` VARCHAR(255) NULL DEFAULT NULL,
    MODIFY `DatumAangemaakt` DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    MODIFY `DatumGewijzigd` DATETIME(6) NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6);

INSERT INTO `producten` (`ProductId`, `Naam`, `Barcode`, `IsActief`)
VALUES
    (1, 'Mintnopjes', '8719587231278', 1),
    (2, 'Schoolkrijt', '8719587326713', 1),
    (3, 'Honingdrop', '8719587327836', 1),
    (4, 'Zure Beren', '8719587321441', 1),
    (5, 'Cola Flesjes', '8719587321237', 1),
    (6, 'Turtles', '8719587322245', 1),
    (7, 'Witte Muizen', '8719587328256', 1),
    (8, 'Reuzen Slangen', '8719587325641', 1),
    (9, 'Zoute Rijen', '8719587322739', 1),
    (10, 'Winegums', '8719587327527', 0),
    (11, 'Drop Munten', '8719587322345', 1),
    (12, 'Kruis Drop', '8719587322265', 1),
    (13, 'Zoute Ruitjes', '8719587323256', 1)
ON DUPLICATE KEY UPDATE
    `Naam` = VALUES(`Naam`),
    `Barcode` = VALUES(`Barcode`),
    `IsActief` = VALUES(`IsActief`);

INSERT INTO `allergenen` (`AllergeenId`, `Naam`, `Omschrijving`)
VALUES
    (1, 'Gluten', 'Dit product bevat gluten'),
    (2, 'Gelatine', 'Dit product bevat gelatine'),
    (3, 'AZO-Kleurstof', 'Dit product bevat AZO-kleurstoffen'),
    (4, 'Lactose', 'Dit product bevat lactose'),
    (5, 'Soja', 'Dit product bevat soja')
ON DUPLICATE KEY UPDATE
    `Naam` = VALUES(`Naam`),
    `Omschrijving` = VALUES(`Omschrijving`);

INSERT INTO `leveranciers` (`LeverancierId`, `Naam`, `ContactPersoon`, `LeverancierNummer`, `Mobiel`)
VALUES
    (1, 'Venco', 'Bert van Linge', 'L1029384719', '06-28493827'),
    (2, 'Astra Sweets', 'Jasper del Monte', 'L1029284315', '06-39398734'),
    (3, 'Haribo', 'Sven Stalman', 'L1029324748', '06-24383291'),
    (4, 'Basset', 'Joyce Stelterberg', 'L1023845773', '06-48293823'),
    (5, 'De Bron', 'Remco Veenstra', 'L1023857736', '06-34291234'),
    (6, 'Quality Street', 'Johan Nooij', 'L1029234586', '06-23458456')
ON DUPLICATE KEY UPDATE
    `Naam` = VALUES(`Naam`),
    `ContactPersoon` = VALUES(`ContactPersoon`),
    `LeverancierNummer` = VALUES(`LeverancierNummer`),
    `Mobiel` = VALUES(`Mobiel`);

INSERT INTO `magazijnen` (`MagazijnId`, `ProductId`, `VerpakkingsEenheidInKilogram`, `AantalAanwezig`)
VALUES
    (1, 1, 5, 453),
    (2, 2, 2.5, 400),
    (3, 3, 5, 1),
    (4, 4, 1, 800),
    (5, 5, 3, 234),
    (6, 6, 2, 345),
    (7, 7, 1, 795),
    (8, 8, 10, 233),
    (9, 9, 2.5, 123),
    (10, 10, 3, NULL),
    (11, 11, 2, 367),
    (12, 12, 1, 467),
    (13, 13, 5, 20)
ON DUPLICATE KEY UPDATE
    `ProductId` = VALUES(`ProductId`),
    `VerpakkingsEenheidInKilogram` = VALUES(`VerpakkingsEenheidInKilogram`),
    `AantalAanwezig` = VALUES(`AantalAanwezig`);

INSERT INTO `product_per_allergenen` (`ProductId`, `AllergeenId`)
VALUES
    (1, 2),
    (1, 1),
    (1, 3),
    (3, 4),
    (6, 5),
    (9, 2),
    (9, 5),
    (10, 2),
    (12, 4),
    (13, 1),
    (13, 4),
    (13, 5)
ON DUPLICATE KEY UPDATE
    `ProductId` = VALUES(`ProductId`);

INSERT INTO `product_per_leveranciers`
    (`ProductPerLeverancierId`, `LeverancierId`, `ProductId`, `DatumLevering`, `Aantal`, `DatumEerstVolgendeLevering`)
VALUES
    (1, 1, 1, '2024-11-09', 23, '2024-11-16'),
    (2, 1, 1, '2024-11-18', 21, '2024-11-25'),
    (3, 1, 2, '2024-11-09', 12, '2024-11-16'),
    (4, 1, 3, '2024-11-10', 11, '2024-11-17'),
    (5, 2, 4, '2024-11-14', 16, '2024-11-21'),
    (6, 2, 4, '2024-11-21', 23, '2024-11-28'),
    (7, 2, 5, '2024-11-14', 45, '2024-11-21'),
    (8, 2, 6, '2024-11-14', 30, '2024-11-21'),
    (9, 3, 7, '2024-11-12', 12, '2024-11-19'),
    (10, 3, 7, '2024-11-19', 23, '2024-11-26'),
    (11, 3, 8, '2024-11-10', 12, '2024-11-17'),
    (12, 3, 9, '2024-11-11', 1, '2024-11-18'),
    (13, 4, 10, '2024-11-16', 24, '2023-04-30'),
    (14, 5, 11, '2024-11-10', 47, '2024-11-17'),
    (15, 5, 11, '2024-11-19', 60, '2024-11-26'),
    (16, 5, 12, '2024-11-11', 45, NULL),
    (17, 5, 13, '2024-11-12', 23, NULL)
ON DUPLICATE KEY UPDATE
    `LeverancierId` = VALUES(`LeverancierId`),
    `ProductId` = VALUES(`ProductId`),
    `DatumLevering` = VALUES(`DatumLevering`),
    `Aantal` = VALUES(`Aantal`),
    `DatumEerstVolgendeLevering` = VALUES(`DatumEerstVolgendeLevering`);

DROP PROCEDURE IF EXISTS `jamin_overzicht_leveranciers`;
DROP PROCEDURE IF EXISTS `jamin_geleverde_producten`;
DROP PROCEDURE IF EXISTS `jamin_voeg_levering_toe`;

DELIMITER $$

CREATE PROCEDURE `jamin_overzicht_leveranciers`()
BEGIN
    SELECT l.LeverancierId, l.Naam, l.ContactPersoon, l.LeverancierNummer, l.Mobiel,
           COUNT(DISTINCT ppl.ProductId) AS AantalVerschillendeProducten
    FROM leveranciers l
    LEFT JOIN product_per_leveranciers ppl
        ON ppl.LeverancierId = l.LeverancierId AND ppl.IsActief = 1
    WHERE l.IsActief = 1
    GROUP BY l.LeverancierId, l.Naam, l.ContactPersoon, l.LeverancierNummer, l.Mobiel
    ORDER BY AantalVerschillendeProducten DESC, l.Naam ASC;
END$$

CREATE PROCEDURE `jamin_geleverde_producten`(IN p_leverancier_id INT UNSIGNED)
BEGIN
    SELECT p.ProductId, p.Naam, p.IsActief, m.AantalAanwezig,
           m.VerpakkingsEenheidInKilogram,
           MAX(ppl.DatumLevering) AS LaatsteLevering
    FROM product_per_leveranciers ppl
    JOIN producten p ON p.ProductId = ppl.ProductId
    LEFT JOIN magazijnen m ON m.ProductId = p.ProductId
    WHERE ppl.LeverancierId = p_leverancier_id AND ppl.IsActief = 1
    GROUP BY p.ProductId, p.Naam, p.IsActief, m.AantalAanwezig,
             m.VerpakkingsEenheidInKilogram
    ORDER BY COALESCE(m.AantalAanwezig, 0) DESC, p.Naam ASC;
END$$

CREATE PROCEDURE `jamin_voeg_levering_toe`(
    IN p_leverancier_id INT UNSIGNED,
    IN p_product_id INT UNSIGNED,
    IN p_aantal INT UNSIGNED,
    IN p_datum_levering DATE,
    IN p_datum_eerst_volgende_levering DATE
)
BEGIN
    DECLARE v_product_actief BOOLEAN DEFAULT FALSE;

    SELECT IsActief INTO v_product_actief
    FROM producten
    WHERE ProductId = p_product_id
    FOR UPDATE;

    IF v_product_actief AND EXISTS (
        SELECT 1
        FROM product_per_leveranciers
        WHERE LeverancierId = p_leverancier_id
          AND ProductId = p_product_id
          AND IsActief = 1
    ) THEN
        INSERT INTO product_per_leveranciers
            (LeverancierId, ProductId, DatumLevering, Aantal, DatumEerstVolgendeLevering)
        VALUES
            (p_leverancier_id, p_product_id, p_datum_levering, p_aantal,
             p_datum_eerst_volgende_levering);

        UPDATE magazijnen
        SET AantalAanwezig = COALESCE(AantalAanwezig, 0) + p_aantal,
            DatumGewijzigd = NOW(6)
        WHERE ProductId = p_product_id;

        IF ROW_COUNT() <> 1 THEN
            SIGNAL SQLSTATE '45000'
                SET MESSAGE_TEXT = 'Voor dit product is geen magazijnrecord gevonden.';
        END IF;

        SELECT 1 AS Opgeslagen;
    ELSE
        SELECT 0 AS Opgeslagen;
    END IF;
END$$

DELIMITER ;
