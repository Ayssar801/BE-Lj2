-- MySQL dump 10.13  Distrib 8.4.7, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: be-laravel
-- ------------------------------------------------------
-- Server version	8.4.7

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `allergenen`
--

DROP TABLE IF EXISTS `allergenen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `allergenen` (
  `AllergeenId` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Naam` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Omschrijving` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IsActief` tinyint(1) NOT NULL DEFAULT '1',
  `Opmerking` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DatumAangemaakt` datetime(6) NOT NULL,
  `DatumGewijzigd` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`AllergeenId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `allergenen`
--

LOCK TABLES `allergenen` WRITE;
/*!40000 ALTER TABLE `allergenen` DISABLE KEYS */;
INSERT INTO `allergenen` VALUES (1,'Gluten','Dit product bevat gluten',1,NULL,'2026-09-13 16:52:10.000000',NULL),(2,'Gelatine','Dit product bevat gelatine',1,NULL,'2026-09-13 16:52:10.000000',NULL),(3,'AZO-Kleurstof','Dit product bevat AZO-kleurstoffen',1,NULL,'2026-09-13 16:52:10.000000',NULL),(4,'Lactose','Dit product bevat lactose',1,NULL,'2026-09-13 16:52:10.000000',NULL),(5,'Soja','Dit product bevat soja',1,NULL,'2026-09-13 16:52:10.000000',NULL);
/*!40000 ALTER TABLE `allergenen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leveranciers`
--

DROP TABLE IF EXISTS `leveranciers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leveranciers` (
  `LeverancierId` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Naam` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ContactPersoon` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LeverancierNummer` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Mobiel` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IsActief` tinyint(1) NOT NULL DEFAULT '1',
  `Opmerking` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DatumAangemaakt` datetime(6) NOT NULL,
  `DatumGewijzigd` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`LeverancierId`),
  UNIQUE KEY `leveranciers_leveranciernummer_unique` (`LeverancierNummer`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
LOCK TABLES `leveranciers` WRITE;
/*!40000 ALTER TABLE `leveranciers` DISABLE KEYS */;
INSERT INTO `leveranciers` VALUES (1,'Venco','Bert van Linge','L1029384719','06-28493827',1,NULL,'2026-09-13 16:44:37.000000',NULL),(2,'Astra Sweets','Jasper del Monte','L1029284315','06-39398734',1,NULL,'2026-09-13 16:44:37.000000',NULL),(3,'Haribo','Sven Stalman','L1029324748','06-24383291',1,NULL,'2026-09-13 17:23:09.000000',NULL),(4,'Basset','Joyce Stelterberg','L1023845773','06-48293823',1,NULL,'2026-09-13 16:50:27.000000',NULL),(5,'De Bron','Remco Veenstra','L1023857736','06-34291234',1,NULL,'2026-09-13 17:23:09.000000',NULL);
/*!40000 ALTER TABLE `leveranciers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `magazijnen`
--

DROP TABLE IF EXISTS `magazijnen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `magazijnen` (
  `MagazijnId` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ProductId` bigint unsigned NOT NULL,
  `VerpakkingsEenheidInKilogram` decimal(5,2) NOT NULL,
  `AantalAanwezig` int unsigned DEFAULT NULL,
  `IsActief` tinyint(1) NOT NULL DEFAULT '1',
  `Opmerking` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DatumAangemaakt` datetime(6) NOT NULL,
  `DatumGewijzigd` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`MagazijnId`),
  KEY `magazijnen_productid_foreign` (`ProductId`),
  CONSTRAINT `magazijnen_productid_foreign` FOREIGN KEY (`ProductId`) REFERENCES `producten` (`ProductId`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `magazijnen`
--

LOCK TABLES `magazijnen` WRITE;
/*!40000 ALTER TABLE `magazijnen` DISABLE KEYS */;
INSERT INTO `magazijnen` VALUES (1,1,5.00,453,1,NULL,'2026-09-13 15:05:52.000000',NULL),(2,2,2.50,400,1,NULL,'2026-09-13 15:05:52.000000',NULL),(3,3,5.00,14,1,NULL,'2026-09-13 17:23:09.000000',NULL),(4,4,1.00,800,1,NULL,'2026-09-13 17:23:09.000000',NULL),(5,5,3.00,234,1,NULL,'2026-09-13 17:23:09.000000',NULL),(6,6,2.00,345,1,NULL,'2026-09-13 17:23:09.000000',NULL),(7,7,1.00,795,1,NULL,'2026-09-13 17:23:09.000000',NULL),(8,8,10.00,233,1,NULL,'2026-09-13 17:23:09.000000',NULL),(9,9,2.50,123,1,NULL,'2026-09-13 17:23:09.000000',NULL),(10,10,3.00,NULL,1,NULL,'2026-09-13 16:50:27.000000',NULL),(11,11,2.00,367,1,NULL,'2026-09-13 17:23:27.000000',NULL),(12,12,1.00,467,1,NULL,'2026-09-13 17:23:27.000000',NULL),(13,13,5.00,20,1,NULL,'2026-09-13 17:23:27.000000',NULL);
/*!40000 ALTER TABLE `magazijnen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_09_13_142714_create_producten_table',2),(5,'2026_09_13_142715_create_magazijnen_table',2),(6,'2026_09_13_142716_create_allergenen_table',2),(7,'2026_09_13_142717_create_product_per_allergenen_table',2),(8,'2026_09_13_142718_create_leveranciers_table',2),(9,'2026_09_13_142719_create_product_per_leveranciers_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_per_allergenen`
--

DROP TABLE IF EXISTS `product_per_allergenen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_per_allergenen` (
  `ProductPerAllergeenId` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ProductId` bigint unsigned NOT NULL,
  `AllergeenId` bigint unsigned NOT NULL,
  `IsActief` tinyint(1) NOT NULL DEFAULT '1',
  `Opmerking` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DatumAangemaakt` datetime(6) NOT NULL,
  `DatumGewijzigd` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`ProductPerAllergeenId`),
  UNIQUE KEY `product_per_allergenen_productid_allergeenid_unique` (`ProductId`,`AllergeenId`),
  KEY `product_per_allergenen_allergeenid_foreign` (`AllergeenId`),
  CONSTRAINT `product_per_allergenen_allergeenid_foreign` FOREIGN KEY (`AllergeenId`) REFERENCES `allergenen` (`AllergeenId`) ON DELETE CASCADE,
  CONSTRAINT `product_per_allergenen_productid_foreign` FOREIGN KEY (`ProductId`) REFERENCES `producten` (`ProductId`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_per_allergenen`
--

LOCK TABLES `product_per_allergenen` WRITE;
/*!40000 ALTER TABLE `product_per_allergenen` DISABLE KEYS */;
INSERT INTO `product_per_allergenen` VALUES (1,13,1,1,NULL,'2026-09-13 16:52:10.000000',NULL),(2,13,4,1,NULL,'2026-09-13 16:52:10.000000',NULL),(3,13,5,1,NULL,'2026-09-13 16:52:10.000000',NULL),(4,1,3,1,NULL,'2026-09-13 17:23:27.000000',NULL),(5,6,5,1,NULL,'2026-09-13 17:23:27.000000',NULL),(6,9,2,1,NULL,'2026-09-13 17:23:27.000000',NULL),(7,9,5,1,NULL,'2026-09-13 17:23:27.000000',NULL),(8,10,2,1,NULL,'2026-09-13 17:23:27.000000',NULL),(9,12,4,1,NULL,'2026-09-13 17:23:27.000000',NULL);
/*!40000 ALTER TABLE `product_per_allergenen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_per_leveranciers`
--

DROP TABLE IF EXISTS `product_per_leveranciers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_per_leveranciers` (
  `ProductPerLeverancierId` bigint unsigned NOT NULL AUTO_INCREMENT,
  `LeverancierId` bigint unsigned NOT NULL,
  `ProductId` bigint unsigned NOT NULL,
  `DatumLevering` date NOT NULL,
  `Aantal` int unsigned NOT NULL,
  `DatumEerstVolgendeLevering` date DEFAULT NULL,
  `IsActief` tinyint(1) NOT NULL DEFAULT '1',
  `Opmerking` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DatumAangemaakt` datetime(6) NOT NULL,
  `DatumGewijzigd` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`ProductPerLeverancierId`),
  KEY `product_per_leveranciers_leverancierid_foreign` (`LeverancierId`),
  KEY `product_per_leveranciers_productid_foreign` (`ProductId`),
  CONSTRAINT `product_per_leveranciers_leverancierid_foreign` FOREIGN KEY (`LeverancierId`) REFERENCES `leveranciers` (`LeverancierId`) ON DELETE CASCADE,
  CONSTRAINT `product_per_leveranciers_productid_foreign` FOREIGN KEY (`ProductId`) REFERENCES `producten` (`ProductId`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_per_leveranciers`
--

LOCK TABLES `product_per_leveranciers` WRITE;
/*!40000 ALTER TABLE `product_per_leveranciers` DISABLE KEYS */;
INSERT INTO `product_per_leveranciers` VALUES (1,1,1,'2024-10-09',23,'2024-10-16',1,NULL,'2026-09-13 16:46:19.000000',NULL),(2,1,1,'2024-10-18',21,'2024-10-25',1,NULL,'2026-09-13 16:48:45.000000',NULL),(3,1,2,'2024-10-09',12,'2024-10-16',1,NULL,'2026-09-13 17:23:09.000000',NULL),(4,1,3,'2024-10-10',11,'2024-10-17',1,NULL,'2026-09-13 17:23:09.000000',NULL),(5,2,4,'2024-10-14',16,'2024-10-21',1,NULL,'2026-09-13 17:23:09.000000',NULL),(6,2,4,'2024-10-21',23,'2024-10-28',1,NULL,'2026-09-13 17:23:09.000000',NULL),(7,2,5,'2024-10-14',45,'2024-10-21',1,NULL,'2026-09-13 17:23:09.000000',NULL),(8,2,6,'2024-10-14',30,'2024-10-21',1,NULL,'2026-09-13 17:23:09.000000',NULL),(9,3,7,'2024-10-12',12,'2024-10-19',1,NULL,'2026-09-13 17:23:09.000000',NULL),(10,3,7,'2024-10-19',23,'2024-10-26',1,NULL,'2026-09-13 17:23:09.000000',NULL),(11,3,8,'2024-10-10',12,'2024-10-17',1,NULL,'2026-09-13 17:23:09.000000',NULL),(12,3,9,'2024-10-11',1,'2024-10-18',1,NULL,'2026-09-13 17:23:09.000000',NULL),(13,4,10,'2024-10-16',24,'2024-10-30',1,NULL,'2026-09-13 16:50:27.000000',NULL),(14,5,11,'2024-10-10',47,'2024-10-17',1,NULL,'2026-09-13 17:23:09.000000',NULL),(15,5,12,'2024-10-11',45,NULL,1,NULL,'2026-09-13 17:23:09.000000',NULL),(16,5,13,'2024-10-12',23,NULL,1,NULL,'2026-09-13 17:23:09.000000',NULL);
/*!40000 ALTER TABLE `product_per_leveranciers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producten`
--

DROP TABLE IF EXISTS `producten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producten` (
  `ProductId` bigint unsigned NOT NULL AUTO_INCREMENT,
  `Naam` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Barcode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IsActief` tinyint(1) NOT NULL DEFAULT '1',
  `Opmerking` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DatumAangemaakt` datetime(6) NOT NULL,
  `DatumGewijzigd` datetime(6) DEFAULT NULL,
  PRIMARY KEY (`ProductId`),
  UNIQUE KEY `producten_barcode_unique` (`Barcode`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producten`
--

LOCK TABLES `producten` WRITE;
/*!40000 ALTER TABLE `producten` DISABLE KEYS */;
INSERT INTO `producten` VALUES (1,'Mintnopjes','8719587231278',1,NULL,'2026-09-13 15:01:14.000000',NULL),(2,'Schoolkrijt','8719587326713',1,NULL,'2026-09-13 15:01:14.000000',NULL),(3,'Honingdrop','8719587327836',1,NULL,'2026-09-13 15:01:14.000000',NULL),(4,'Zure Beren','8719587321441',1,NULL,'2026-09-13 15:01:14.000000',NULL),(5,'Cola Flesjes','8719587321237',1,NULL,'2026-09-13 15:01:14.000000',NULL),(6,'Turtles','8719587322245',1,NULL,'2026-09-13 15:01:14.000000',NULL),(7,'Witte Muizen','8719587328256',1,NULL,'2026-09-13 15:01:14.000000',NULL),(8,'Reuzen Slangen','8719587325641',1,NULL,'2026-09-13 15:01:14.000000',NULL),(9,'Zoute Rijen','8719587322739',1,NULL,'2026-09-13 15:01:14.000000',NULL),(10,'Winegums','8719587327527',1,NULL,'2026-09-13 15:01:14.000000',NULL),(11,'Drop Munten','8719587322345',1,NULL,'2026-09-13 15:01:14.000000',NULL),(12,'Kruis Drop','8719587322265',1,NULL,'2026-09-13 15:01:14.000000',NULL),(13,'Zoute Ruitjes','8719587323256',1,NULL,'2026-09-13 15:01:14.000000',NULL);
/*!40000 ALTER TABLE `producten` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('3eIQph1hUue3co7ymssafndCjc7Ghzbi0d2Aw0LE',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.137.0 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36','eyJfdG9rZW4iOiJlMzNrSDhYRHk2UDVVQXRDeURhZHFab1ZwenhCckM1U0ZyMUx2YXNFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1789320095),('evOj9uEwDQtLsvUKtMLjsWAwWEmTmuwkbyF7eYsX',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.137.0 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36','eyJfdG9rZW4iOiJuWTZOcEhSbWpmQmFRN0ZKc3lxVUljYjdDS0tnbHRKaklGU2tmVnRBIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAyIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1789314001),('kJKzwXcundUP3m1iIAJPwJjgU8Bg2WjDbO00pdnR',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','eyJfdG9rZW4iOiJrNkp5bzNabEtVQTI3dU5iY1RnekJZdHoxZXRJV2phNXJKVG1xU2VrIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9tYWdhemlqbiIsInJvdXRlIjoibWFnYXppam4uaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=',1789320101),('pkEwyUwHZtZYaeR9ra9DCq8DG3Wl74PvHZVpj9Hm',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','eyJfdG9rZW4iOiI4Ulk5ejVRRWRydXM1Zk1CalplRXRxeUdVYjNpOWV3bURkS0M4bDJoIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAxIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==',1789313928),('TGg2LluBAIiqxYsXMZzNXb2LSwcZnUCARRvNquah',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/153.0.0.0 Safari/537.36 Edg/153.0.0.0','eyJfdG9rZW4iOiI1UHM5UWJPeWVybEI3UjJCYVJ3eTFBRFdkaUFQUUNDMUhqNmxHQkNKIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==',1789315595),('Z5QN2gPv1C7F6diEMuBaF5zvGNcRVnYOg6pdVLFk',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.137.0 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36','eyJfdG9rZW4iOiJaQkc3aEZNV1BPTHpia2hGQmNBMkhqYXNTd2tmUk04VEFWbGZnNWNKIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19',1789315787);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'MagazijnMedewerker3','magazijnmedewerker3@jamin.com',NULL,'$2y$12$2hrQ7KbB5VkscbFC05j71OrhOKzprIg4Fr2rdomG44yKn9gDtcu4i',NULL,'2026-09-13 13:30:51','2026-09-13 13:30:51');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-13 19:24:07
