-- MySQL dump 10.13  Distrib 8.2.0, for macos14.0 (arm64)
--
-- Host: localhost    Database: irpay
-- ------------------------------------------------------
-- Server version	8.2.0

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
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint unsigned DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint unsigned DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_log`
--

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
INSERT INTO `activity_log` VALUES (1,'KycLevel','created','App\\Models\\KycLevel','created',1,NULL,NULL,'{\"attributes\": {\"name\": \"SILVER\", \"daily_limit\": 100000}}',NULL,'2024-02-01 16:38:00','2024-02-01 16:38:00'),(2,'KycLevel','created','App\\Models\\KycLevel','created',2,NULL,NULL,'{\"attributes\": {\"name\": \"GOLD\", \"daily_limit\": 200000}}',NULL,'2024-02-01 16:38:00','2024-02-01 16:38:00'),(3,'KycLevel','created','App\\Models\\KycLevel','created',3,NULL,NULL,'{\"attributes\": {\"name\": \"DIAMOND\", \"daily_limit\": 500000}}',NULL,'2024-02-01 16:38:00','2024-02-01 16:38:00'),(4,'KycLevel','created','App\\Models\\KycLevel','created',4,NULL,NULL,'{\"attributes\": {\"name\": \"MERCHANT\", \"daily_limit\": 1000000}}',NULL,'2024-02-01 16:38:00','2024-02-01 16:38:00'),(5,'Users','created','App\\Models\\User','created',1,NULL,NULL,'{\"attributes\": {\"name\": \"Irpay Admin\", \"email\": \"admin@irpay.ng\"}}',NULL,'2024-02-01 16:38:00','2024-02-01 16:38:00'),(6,'Wallet','created','App\\Models\\Wallet','created',1,NULL,NULL,'{\"attributes\": {\"status\": \"ACTIVE\", \"account_number\": \"8081234567\"}}',NULL,'2024-02-01 16:38:00','2024-02-01 16:38:00'),(7,'Service','created','App\\Models\\Service','created',1,NULL,NULL,'{\"attributes\": {\"name\": \"CABLE TV\", \"provider\": null, \"description\": null}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(8,'Service','updated','App\\Models\\Service','updated',1,NULL,NULL,'{\"old\": {\"name\": \"CABLE TV\", \"provider\": null, \"description\": null}, \"attributes\": {\"name\": \"CABLE TV\", \"provider\": {\"id\": 1, \"name\": \"Spout\", \"created_at\": \"2024-02-01T16:38:04.000000Z\", \"service_id\": 1, \"updated_at\": \"2024-02-01T16:38:04.000000Z\"}, \"description\": null}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(9,'Service','created','App\\Models\\Service','created',2,NULL,NULL,'{\"attributes\": {\"name\": \"AIRTIME\", \"provider\": null, \"description\": null}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(10,'Service','updated','App\\Models\\Service','updated',2,NULL,NULL,'{\"old\": {\"name\": \"AIRTIME\", \"provider\": null, \"description\": null}, \"attributes\": {\"name\": \"AIRTIME\", \"provider\": {\"id\": 2, \"name\": \"Spout\", \"created_at\": \"2024-02-01T16:38:04.000000Z\", \"service_id\": 2, \"updated_at\": \"2024-02-01T16:38:04.000000Z\"}, \"description\": null}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(11,'Service','created','App\\Models\\Service','created',3,NULL,NULL,'{\"attributes\": {\"name\": \"INTERNET DATA\", \"provider\": null, \"description\": null}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(12,'Service','updated','App\\Models\\Service','updated',3,NULL,NULL,'{\"old\": {\"name\": \"INTERNET DATA\", \"provider\": null, \"description\": null}, \"attributes\": {\"name\": \"INTERNET DATA\", \"provider\": {\"id\": 3, \"name\": \"Spout\", \"created_at\": \"2024-02-01T16:38:04.000000Z\", \"service_id\": 3, \"updated_at\": \"2024-02-01T16:38:04.000000Z\"}, \"description\": null}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(13,'Service','created','App\\Models\\Service','created',4,NULL,NULL,'{\"attributes\": {\"name\": \"ELECTRICITY\", \"provider\": null, \"description\": null}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(14,'Service','updated','App\\Models\\Service','updated',4,NULL,NULL,'{\"old\": {\"name\": \"ELECTRICITY\", \"provider\": null, \"description\": null}, \"attributes\": {\"name\": \"ELECTRICITY\", \"provider\": {\"id\": 4, \"name\": \"Spout\", \"created_at\": \"2024-02-01T16:38:04.000000Z\", \"service_id\": 4, \"updated_at\": \"2024-02-01T16:38:04.000000Z\"}, \"description\": null}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(15,'Service','created','App\\Models\\Service','created',5,NULL,NULL,'{\"attributes\": {\"name\": \"BANK TRANSFER\", \"provider\": null, \"description\": null}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(16,'Service','updated','App\\Models\\Service','updated',5,NULL,NULL,'{\"old\": {\"name\": \"BANK TRANSFER\", \"provider\": null, \"description\": null}, \"attributes\": {\"name\": \"BANK TRANSFER\", \"provider\": {\"id\": 5, \"name\": \"Spout\", \"created_at\": \"2024-02-01T16:38:04.000000Z\", \"service_id\": 5, \"updated_at\": \"2024-02-01T16:38:04.000000Z\"}, \"description\": null}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(17,'Service','created','App\\Models\\Service','created',6,NULL,NULL,'{\"attributes\": {\"name\": \"CASHOUT/WITHDRAWAL\", \"provider\": null, \"description\": null}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(18,'Service','created','App\\Models\\Service','created',7,NULL,NULL,'{\"attributes\": {\"name\": \"WALLET TRANSFER\", \"provider\": null, \"description\": null}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(19,'Service','created','App\\Models\\Service','created',8,NULL,NULL,'{\"attributes\": {\"name\": \"FUNDING/INBOUND\", \"provider\": null, \"description\": null}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(20,'Service','created','App\\Models\\Service','created',9,NULL,NULL,'{\"attributes\": {\"name\": \"LOAN\", \"provider\": null, \"description\": null}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(21,'GL','created','App\\Models\\GeneralLedger','created',1,NULL,NULL,'{\"attributes\": {\"balance\": 0}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(22,'GL','created','App\\Models\\GeneralLedger','created',2,NULL,NULL,'{\"attributes\": {\"balance\": 0}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(23,'GL','created','App\\Models\\GeneralLedger','created',3,NULL,NULL,'{\"attributes\": {\"balance\": 0}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(24,'GL','created','App\\Models\\GeneralLedger','created',4,NULL,NULL,'{\"attributes\": {\"balance\": 0}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(25,'GL','created','App\\Models\\GeneralLedger','created',5,NULL,NULL,'{\"attributes\": {\"balance\": 0}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(26,'GL','created','App\\Models\\GeneralLedger','created',6,NULL,NULL,'{\"attributes\": {\"balance\": 0}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(27,'GL','created','App\\Models\\GeneralLedger','created',7,NULL,NULL,'{\"attributes\": {\"balance\": 0}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(28,'GL','created','App\\Models\\GeneralLedger','created',8,NULL,NULL,'{\"attributes\": {\"balance\": 0}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(29,'GL','created','App\\Models\\GeneralLedger','created',9,NULL,NULL,'{\"attributes\": {\"balance\": 0}}',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04');
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `amount_configs`
--

DROP TABLE IF EXISTS `amount_configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `amount_configs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `min_amount` double(12,2) NOT NULL,
  `max_amount` double(12,2) NOT NULL,
  `primary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary_id` bigint unsigned NOT NULL,
  `secondary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondary_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amount_configs`
--

LOCK TABLES `amount_configs` WRITE;
/*!40000 ALTER TABLE `amount_configs` DISABLE KEYS */;
INSERT INTO `amount_configs` VALUES (1,1.00,4000.00,'3LINE',2,'INTERSWITCH',1,'2024-02-01 16:38:00','2024-02-01 16:38:00'),(2,4001.00,2000000.00,'INTERSWITCH',1,'3LINE',2,'2024-02-01 16:38:00','2024-02-01 16:38:00');
/*!40000 ALTER TABLE `amount_configs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_updates`
--

DROP TABLE IF EXISTS `app_updates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_updates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version_code` int NOT NULL,
  `old_device` enum('HORIZONPAY_K11','MOBILE','ASINO_A75') COLLATE utf8mb4_unicode_ci NOT NULL,
  `device` enum('HORIZONPAY_K11','ASINO_A75','MOBILE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'HORIZONPAY_K11',
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `download_count` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `app_updates_version_device_unique` (`version`,`device`),
  UNIQUE KEY `app_updates_path_unique` (`path`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_updates`
--

LOCK TABLES `app_updates` WRITE;
/*!40000 ALTER TABLE `app_updates` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_updates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvals`
--

DROP TABLE IF EXISTS `approvals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `approvals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `performed_by` bigint unsigned DEFAULT NULL,
  `approvalable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approvalable_id` bigint unsigned DEFAULT NULL,
  `state` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `new_data` json DEFAULT NULL,
  `original_data` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `approvals_approvalable_type_approvalable_id_index` (`approvalable_type`,`approvalable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvals`
--

LOCK TABLES `approvals` WRITE;
/*!40000 ALTER TABLE `approvals` DISABLE KEYS */;
/*!40000 ALTER TABLE `approvals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banks`
--

DROP TABLE IF EXISTS `banks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` enum('ETRANZACT','SPOUT','PAYGATE') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banks`
--

LOCK TABLES `banks` WRITE;
/*!40000 ALTER TABLE `banks` DISABLE KEYS */;
/*!40000 ALTER TABLE `banks` ENABLE KEYS */;
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
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
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
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
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
-- Table structure for table `card_configs`
--

DROP TABLE IF EXISTS `card_configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `card_configs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `card_type` enum('MASTERCARD','VISA','VERVE','OTHERS') COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary_id` bigint unsigned NOT NULL,
  `secondary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondary_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `card_configs`
--

LOCK TABLES `card_configs` WRITE;
/*!40000 ALTER TABLE `card_configs` DISABLE KEYS */;
INSERT INTO `card_configs` VALUES (1,'MASTERCARD','3LINE',2,'INTERSWITCH',1,'2024-02-01 16:38:00','2024-02-01 16:38:00'),(2,'VISA','INTERSWITCH',1,'3LINE',2,'2024-02-01 16:38:00','2024-02-01 16:38:00'),(3,'VERVE','INTERSWITCH',1,'3LINE',2,'2024-02-01 16:38:00','2024-02-01 16:38:00'),(4,'OTHERS','INTERSWITCH',1,'3LINE',2,'2024-02-01 16:38:00','2024-02-01 16:38:00');
/*!40000 ALTER TABLE `card_configs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configs`
--

DROP TABLE IF EXISTS `configs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `configs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configs`
--

LOCK TABLES `configs` WRITE;
/*!40000 ALTER TABLE `configs` DISABLE KEYS */;
INSERT INTO `configs` VALUES (1,'DEFAULT_GROUP_ID','1','2024-02-01 16:38:00','2024-02-01 16:38:00');
/*!40000 ALTER TABLE `configs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document_level`
--

DROP TABLE IF EXISTS `document_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `document_level` (
  `document_id` bigint unsigned NOT NULL,
  `kyc_level_id` bigint unsigned NOT NULL,
  KEY `document_level_document_id_foreign` (`document_id`),
  KEY `document_level_kyc_level_id_foreign` (`kyc_level_id`),
  CONSTRAINT `document_level_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  CONSTRAINT `document_level_kyc_level_id_foreign` FOREIGN KEY (`kyc_level_id`) REFERENCES `kyc_levels` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document_level`
--

LOCK TABLES `document_level` WRITE;
/*!40000 ALTER TABLE `document_level` DISABLE KEYS */;
INSERT INTO `document_level` VALUES (1,2),(2,3),(3,4),(4,4);
/*!40000 ALTER TABLE `document_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('text','file') COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `documents_name_unique` (`name`),
  UNIQUE KEY `documents_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES (1,'BVN','bvn','text',NULL,NULL,NULL),(2,'Identity Card','id-card','file',NULL,NULL,NULL),(3,'Utility Bill','utility-bill','file',NULL,NULL,NULL),(4,'CAC Document','cac','file',NULL,NULL,NULL);
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
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
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
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
-- Table structure for table `fees`
--

DROP TABLE IF EXISTS `fees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `group_id` bigint unsigned NOT NULL,
  `service_id` int unsigned NOT NULL,
  `type` enum('CHARGE','COMMISSION') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CHARGE',
  `amount` double(12,2) NOT NULL,
  `amount_type` enum('FIXED','PERCENTAGE','CONFIG') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'FIXED',
  `cap` double(8,2) NOT NULL DEFAULT '0.00',
  `info` text COLLATE utf8mb4_unicode_ci,
  `config` json DEFAULT NULL,
  `structure` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_fee` (`group_id`,`service_id`,`type`),
  CONSTRAINT `fees_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `terminal_groups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fees`
--

LOCK TABLES `fees` WRITE;
/*!40000 ALTER TABLE `fees` DISABLE KEYS */;
INSERT INTO `fees` VALUES (1,1,1,'CHARGE',10.00,'FIXED',0.00,NULL,NULL,NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(2,1,1,'COMMISSION',0.00,'PERCENTAGE',0.00,NULL,NULL,NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(3,1,2,'COMMISSION',0.00,'PERCENTAGE',0.00,NULL,NULL,NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(4,1,3,'COMMISSION',0.00,'PERCENTAGE',0.00,NULL,NULL,NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(5,1,4,'CHARGE',10.00,'FIXED',0.00,NULL,NULL,NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(6,1,4,'COMMISSION',0.00,'PERCENTAGE',0.00,NULL,NULL,NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(7,1,5,'CHARGE',0.00,'CONFIG',50.00,NULL,'[{\"range\": \"0-5000\", \"amount\": 10}, {\"range\": \"5001-50000\", \"amount\": 21.51}, {\"range\": \"50001-1000000\", \"amount\": 30}]',NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(8,1,5,'COMMISSION',0.00,'PERCENTAGE',0.00,NULL,NULL,NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(9,1,6,'CHARGE',10.00,'FIXED',0.00,NULL,NULL,NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(10,1,6,'COMMISSION',0.00,'PERCENTAGE',0.00,NULL,NULL,NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(11,1,7,'CHARGE',10.00,'FIXED',0.00,NULL,NULL,NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(12,1,7,'COMMISSION',0.00,'PERCENTAGE',0.00,NULL,NULL,NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(13,1,8,'CHARGE',10.00,'FIXED',0.00,NULL,NULL,NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(14,1,8,'COMMISSION',0.00,'PERCENTAGE',0.00,NULL,NULL,NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(15,1,9,'CHARGE',10.00,'FIXED',0.00,NULL,NULL,NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(16,1,9,'COMMISSION',0.00,'PERCENTAGE',0.00,NULL,NULL,NULL,'2024-02-01 16:38:04','2024-02-01 16:38:04');
/*!40000 ALTER TABLE `fees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `g_l_t_s`
--

DROP TABLE IF EXISTS `g_l_t_s`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `g_l_t_s` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `from_user_id` bigint unsigned DEFAULT NULL,
  `gl_id` bigint unsigned DEFAULT NULL,
  `amount` double(12,2) NOT NULL DEFAULT '0.00',
  `prev_balance` double(12,2) NOT NULL DEFAULT '0.00',
  `new_balance` double(12,2) NOT NULL DEFAULT '0.00',
  `type` enum('CREDIT','DEBIT') COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g_l_t_s`
--

LOCK TABLES `g_l_t_s` WRITE;
/*!40000 ALTER TABLE `g_l_t_s` DISABLE KEYS */;
/*!40000 ALTER TABLE `g_l_t_s` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `general_ledgers`
--

DROP TABLE IF EXISTS `general_ledgers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `general_ledgers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_id` bigint unsigned NOT NULL,
  `balance` double(12,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `general_ledgers_service_id_unique` (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `general_ledgers`
--

LOCK TABLES `general_ledgers` WRITE;
/*!40000 ALTER TABLE `general_ledgers` DISABLE KEYS */;
INSERT INTO `general_ledgers` VALUES (1,1,0.00,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(2,2,0.00,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(3,3,0.00,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(4,4,0.00,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(5,5,0.00,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(6,6,0.00,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(7,7,0.00,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(8,8,0.00,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(9,9,0.00,'2024-02-01 16:38:04','2024-02-01 16:38:04');
/*!40000 ALTER TABLE `general_ledgers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hosts`
--

DROP TABLE IF EXISTS `hosts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hosts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `port` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ssl` tinyint(1) NOT NULL DEFAULT '1',
  `comkey` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hosts_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hosts`
--

LOCK TABLES `hosts` WRITE;
/*!40000 ALTER TABLE `hosts` DISABLE KEYS */;
/*!40000 ALTER TABLE `hosts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `iso_transactions`
--

DROP TABLE IF EXISTS `iso_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `iso_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(12,2) NOT NULL,
  `charge` double(12,2) NOT NULL,
  `total_amount` double(12,2) NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f2` varchar(19) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f3` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f4` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f5` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f7` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f9` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f11` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f12` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f13` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f14` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f15` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f16` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f18` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f22` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f23` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f25` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '00',
  `f26` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '04',
  `f28` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f30` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f31` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f32` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f33` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f35` varchar(37) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f37` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f38` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f39` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f40` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f41` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f42` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f43` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f44` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f45` varchar(76) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f48` longtext COLLATE utf8mb4_unicode_ci,
  `f49` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f50` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f52` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f53` varchar(96) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f54` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f55` longtext COLLATE utf8mb4_unicode_ci,
  `f56` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f58` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f59` longtext COLLATE utf8mb4_unicode_ci,
  `f98` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f100` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f102` varchar(28) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f103` varchar(28) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `f123` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_trans_id` (`f4`,`f11`,`f13`,`f37`,`f41`),
  UNIQUE KEY `iso_transactions_reference_unique` (`reference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iso_transactions`
--

LOCK TABLES `iso_transactions` WRITE;
/*!40000 ALTER TABLE `iso_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `iso_transactions` ENABLE KEYS */;
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
  `attempts` tinyint unsigned NOT NULL,
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
-- Table structure for table `kyc_docs`
--

DROP TABLE IF EXISTS `kyc_docs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kyc_docs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('id-card','utility-bill','cac') COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kyc_docs`
--

LOCK TABLES `kyc_docs` WRITE;
/*!40000 ALTER TABLE `kyc_docs` DISABLE KEYS */;
/*!40000 ALTER TABLE `kyc_docs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kyc_levels`
--

DROP TABLE IF EXISTS `kyc_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kyc_levels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `daily_limit` double(12,2) NOT NULL,
  `single_trans_max` double(12,2) NOT NULL,
  `max_balance` double(12,2) NOT NULL,
  `no_of_agents` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kyc_levels_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kyc_levels`
--

LOCK TABLES `kyc_levels` WRITE;
/*!40000 ALTER TABLE `kyc_levels` DISABLE KEYS */;
INSERT INTO `kyc_levels` VALUES (1,'SILVER',100000.00,30000.00,200000.00,NULL,'2024-02-01 16:38:00','2024-02-01 16:38:00'),(2,'GOLD',200000.00,50000.00,500000.00,NULL,'2024-02-01 16:38:00','2024-02-01 16:38:00'),(3,'DIAMOND',500000.00,70000.00,750000.00,NULL,'2024-02-01 16:38:00','2024-02-01 16:38:00'),(4,'MERCHANT',1000000.00,100000.00,1200000.00,NULL,'2024-02-01 16:38:00','2024-02-01 16:38:00');
/*!40000 ALTER TABLE `kyc_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kycs`
--

DROP TABLE IF EXISTS `kycs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kycs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `document_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `verified_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kycs_user_id_foreign` (`user_id`),
  KEY `kycs_document_id_foreign` (`document_id`),
  KEY `kycs_verified_by_foreign` (`verified_by`),
  CONSTRAINT `kycs_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`),
  CONSTRAINT `kycs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `kycs_verified_by_foreign` FOREIGN KEY (`verified_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kycs`
--

LOCK TABLES `kycs` WRITE;
/*!40000 ALTER TABLE `kycs` DISABLE KEYS */;
/*!40000 ALTER TABLE `kycs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loans`
--

DROP TABLE IF EXISTS `loans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `amount` double NOT NULL,
  `items` json NOT NULL,
  `status` enum('PENDING','APPROVED','CONFIRMED','DECLINED','REPAID') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decline_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_by` bigint unsigned DEFAULT NULL,
  `confirmed_by` bigint unsigned DEFAULT NULL,
  `declined_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loans_user_id_foreign` (`user_id`),
  KEY `loans_approved_by_foreign` (`approved_by`),
  KEY `loans_confirmed_by_foreign` (`confirmed_by`),
  KEY `loans_declined_by_foreign` (`declined_by`),
  CONSTRAINT `loans_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`),
  CONSTRAINT `loans_confirmed_by_foreign` FOREIGN KEY (`confirmed_by`) REFERENCES `users` (`id`),
  CONSTRAINT `loans_declined_by_foreign` FOREIGN KEY (`declined_by`) REFERENCES `users` (`id`),
  CONSTRAINT `loans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loans`
--

LOCK TABLES `loans` WRITE;
/*!40000 ALTER TABLE `loans` DISABLE KEYS */;
/*!40000 ALTER TABLE `loans` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_09_12_213240_create_permission_tables',1),(6,'2022_09_14_115759_create_iso_transactions_table',1),(7,'2022_09_14_123309_create_terminals_table',1),(8,'2022_09_14_173429_create_settlement_banks_table',1),(9,'2022_09_14_173829_create_configs_table',1),(10,'2022_09_14_174206_create_hosts_table',1),(11,'2022_09_15_080004_create_wallets_table',1),(12,'2022_09_15_092846_create_wallet_transactions_table',1),(13,'2022_09_15_093131_create_services_table',1),(14,'2022_09_15_110641_create_service_providers_table',1),(15,'2022_09_15_113500_create_transactions_table',1),(16,'2022_09_18_083510_create_kyc_levels_table',1),(17,'2022_09_18_083526_create_kyc_docs_table',1),(18,'2022_09_21_205934_create_general_ledgers_table',1),(19,'2022_09_21_210529_create_g_l_t_s_table',1),(20,'2022_09_23_113720_create_cache_table',1),(21,'2022_10_02_063242_create_terminal_groups_table',1),(22,'2022_10_06_063206_create_fees_table',1),(23,'2023_01_31_113350_create_activity_log_table',1),(24,'2023_01_31_113351_add_event_column_to_activity_log_table',1),(25,'2023_01_31_113352_add_batch_uuid_column_to_activity_log_table',1),(26,'2023_05_02_205515_2022_02_12_195950_create_approvals_table',1),(27,'2023_05_21_112805_service_terminal',1),(28,'2023_05_21_154142_create_routing_types_table',1),(29,'2023_05_21_154538_create_processors_table',1),(30,'2023_05_21_154853_create_amount_configs_table',1),(31,'2023_05_21_154925_create_card_configs_table',1),(32,'2023_05_25_205421_add_expires_at_to_personal_access_tokens_table',1),(33,'2023_05_28_082436_create_banks_table',1),(34,'2023_06_04_232102_create_jobs_table',1),(35,'2023_06_24_035421_create_loans_table',1),(36,'2023_06_30_075909_create_terminal_processors_table',1),(37,'2023_09_27_150324_create_app_upates_table',1),(38,'2023_10_16_204818_create_virtual_accounts_table',1),(39,'2023_10_19_221824_create_virtual_account_credits_table',1),(40,'2023_12_23_145753_create_documents_table',1),(41,'2023_12_23_154052_document_level',1),(42,'2023_12_23_175920_create_kycs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (2,'App\\Models\\User',1);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'read admin',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(2,'read customers',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(3,'create users',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(4,'edit users',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(5,'disable users',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(6,'read kyc-level',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(7,'create kyc-level',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(8,'edit kyc-level',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(9,'read roles',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(10,'create roles',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(11,'edit roles',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(12,'delete roles',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(13,'edit permissions',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(14,'read wallets',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(15,'edit wallets',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(16,'read groups',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(17,'create groups',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(18,'edit groups',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(19,'delete groups',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(20,'read terminals',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(21,'create terminals',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(22,'edit terminals',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(23,'delete terminals',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(24,'read fees',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(25,'edit fees',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(26,'read general ledger',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(27,'edit general ledger',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(28,'read ledger',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(29,'read dispute',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(30,'create dispute',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(31,'edit dispute',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(32,'read settings',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(33,'create settings',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(34,'edit settings',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(35,'read transactions',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(36,'approve actions',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(37,'read menus',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(38,'edit menus',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(39,'create terminal-processors',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(40,'read terminal-processors',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(41,'delete terminal-processors',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(42,'update terminal-processors',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(43,'read loans',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00'),(44,'approve loans',NULL,'web','2024-02-01 16:38:00','2024-02-01 16:38:00');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `processors`
--

DROP TABLE IF EXISTS `processors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `processors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `host` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `port` int unsigned NOT NULL,
  `ssl` tinyint(1) NOT NULL DEFAULT '1',
  `comp1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comp2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zpk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requiresKey` tinyint(1) NOT NULL DEFAULT '0',
  `tid_prefix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mid_prefix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processors`
--

LOCK TABLES `processors` WRITE;
/*!40000 ALTER TABLE `processors` DISABLE KEYS */;
INSERT INTO `processors` VALUES (1,'INTERSWITCH','167.71.6.36',8081,0,'11111111111111111111111111111111','11111111111111111111111111111111',NULL,0,'2DP','2DP','2024-02-01 16:38:00','2024-02-01 16:38:00'),(2,'3LINE','108.129.63.76',8080,0,'619C213428CFC2F1F0EB820478073A7F','619C213428CFC2F1F0EB820478073A7F',NULL,0,NULL,NULL,'2024-02-01 16:38:00','2024-02-01 16:38:00');
/*!40000 ALTER TABLE `processors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(41,1),(42,1),(43,1),(44,1),(1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2),(13,2),(14,2),(15,2),(16,2),(17,2),(18,2),(19,2),(20,2),(21,2),(22,2),(23,2),(24,2),(25,2),(26,2),(27,2),(28,2),(29,2),(30,2),(31,2),(32,2),(33,2),(34,2),(35,2),(36,2),(37,2),(38,2),(39,2),(40,2),(41,2),(42,2),(43,2),(44,2),(36,3),(2,4),(3,4),(4,4),(14,4),(20,4),(21,4),(22,4),(28,4),(35,4),(43,4);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Admins','Agents') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Admins',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'ADMIN','web','Admins','2024-02-01 16:38:00','2024-02-01 16:38:00'),(2,'SUPER-ADMIN','web','Admins','2024-02-01 16:38:00','2024-02-01 16:38:00'),(3,'APPROVER','web','Admins','2024-02-01 16:38:00','2024-02-01 16:38:00'),(4,'SUPER-AGENT','web','Agents','2024-02-01 16:38:00','2024-02-01 16:38:00'),(5,'AGENT','web','Agents','2024-02-01 16:38:00','2024-02-01 16:38:00');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `routing_types`
--

DROP TABLE IF EXISTS `routing_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `routing_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` enum('AMOUNT','CARD','PRIORITY') COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `routing_types`
--

LOCK TABLES `routing_types` WRITE;
/*!40000 ALTER TABLE `routing_types` DISABLE KEYS */;
INSERT INTO `routing_types` VALUES (1,'AMOUNT',1,'2024-02-01 16:38:00','2024-02-01 16:38:00'),(2,'CARD',0,'2024-02-01 16:38:00','2024-02-01 16:38:00');
/*!40000 ALTER TABLE `routing_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_providers`
--

DROP TABLE IF EXISTS `service_providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_providers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_providers`
--

LOCK TABLES `service_providers` WRITE;
/*!40000 ALTER TABLE `service_providers` DISABLE KEYS */;
INSERT INTO `service_providers` VALUES (1,1,'Spout','\\App\\Repository\\Spout','2024-02-01 16:38:04','2024-02-01 16:38:04'),(2,2,'Spout','\\App\\Repository\\Spout','2024-02-01 16:38:04','2024-02-01 16:38:04'),(3,3,'Spout','\\App\\Repository\\Spout','2024-02-01 16:38:04','2024-02-01 16:38:04'),(4,4,'Spout','\\App\\Repository\\Spout','2024-02-01 16:38:04','2024-02-01 16:38:04'),(5,5,'Spout','\\App\\Repository\\Spout','2024-02-01 16:38:04','2024-02-01 16:38:04');
/*!40000 ALTER TABLE `service_providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_terminal`
--

DROP TABLE IF EXISTS `service_terminal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_terminal` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int unsigned NOT NULL,
  `terminal_id` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_terminal`
--

LOCK TABLES `service_terminal` WRITE;
/*!40000 ALTER TABLE `service_terminal` DISABLE KEYS */;
/*!40000 ALTER TABLE `service_terminal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `provider_id` int unsigned DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  `description` mediumtext COLLATE utf8mb4_unicode_ci,
  `menu` tinyint(1) NOT NULL DEFAULT '1',
  `internal` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_slug_unique` (`slug`),
  UNIQUE KEY `services_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,1,'cabletv','CABLE TV','CABLE TV',1,NULL,1,0,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(2,2,'airtime','AIRTIME','AIRTIME',1,NULL,1,0,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(3,3,'internetdata','INTERNET DATA','INTERNET DATA',1,NULL,1,0,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(4,4,'electricity','ELECTRICITY','ELECTRICITY',1,NULL,1,0,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(5,5,'banktransfer','BANK TRANSFER','BANK TRANSFER',1,NULL,1,0,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(6,NULL,'cashoutwithdrawal','CASHOUT/WITHDRAWAL','CASHOUT',1,NULL,1,0,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(7,NULL,'wallettransfer','WALLET TRANSFER','WALLET TRANSFER',1,NULL,1,1,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(8,NULL,'fundinginbound','FUNDING/INBOUND','FUNDING',1,NULL,1,0,'2024-02-01 16:38:04','2024-02-01 16:38:04'),(9,NULL,'loan','LOAN','LOAN',1,NULL,1,1,'2024-02-01 16:38:04','2024-02-01 16:38:04');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settlement_banks`
--

DROP TABLE IF EXISTS `settlement_banks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settlement_banks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rid` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settlement_banks`
--

LOCK TABLES `settlement_banks` WRITE;
/*!40000 ALTER TABLE `settlement_banks` DISABLE KEYS */;
/*!40000 ALTER TABLE `settlement_banks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `terminal_groups`
--

DROP TABLE IF EXISTS `terminal_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `terminal_groups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terminal_groups`
--

LOCK TABLES `terminal_groups` WRITE;
/*!40000 ALTER TABLE `terminal_groups` DISABLE KEYS */;
INSERT INTO `terminal_groups` VALUES (1,'DEFAULT','Default terminal groups','2024-02-01 16:38:04','2024-02-01 16:38:04');
/*!40000 ALTER TABLE `terminal_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `terminal_processors`
--

DROP TABLE IF EXISTS `terminal_processors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `terminal_processors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `serial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processor_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tmk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tpk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tsk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '566',
  `country_code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '566',
  `category_code` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_location` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terminal_processors`
--

LOCK TABLES `terminal_processors` WRITE;
/*!40000 ALTER TABLE `terminal_processors` DISABLE KEYS */;
/*!40000 ALTER TABLE `terminal_processors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `terminals`
--

DROP TABLE IF EXISTS `terminals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `terminals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `group_id` bigint unsigned NOT NULL DEFAULT '1',
  `device` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `tid` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mid` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tmk` varchar(38) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tsk` varchar(38) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tpk` varchar(38) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_time` varchar(14) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timeout` smallint NOT NULL DEFAULT '60',
  `currency_code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '566',
  `country_code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '566',
  `category_code` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_location` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_pin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0000',
  `pin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0000',
  `wrong_pin_count` int NOT NULL DEFAULT '0',
  `has_changed_pin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `terminals_tid_unique` (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terminals`
--

LOCK TABLES `terminals` WRITE;
/*!40000 ALTER TABLE `terminals` DISABLE KEYS */;
/*!40000 ALTER TABLE `terminals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `terminal_id` bigint unsigned NOT NULL,
  `type_id` bigint unsigned NOT NULL,
  `amount` double(12,2) NOT NULL,
  `charge` double(12,2) NOT NULL DEFAULT '0.00',
  `total_amount` double(12,2) NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stan` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `response_code` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `power_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('PENDING','SUCCESSFUL','FAILED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `channel` enum('POS','WEB','MOBILE','OTHERS') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'POS',
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta` json DEFAULT NULL,
  `wallet_debited` tinyint(1) DEFAULT NULL,
  `wallet_credited` tinyint(1) DEFAULT NULL,
  `version` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `level_id` int unsigned DEFAULT NULL,
  `super_agent_id` bigint unsigned DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_names` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('MALE','FEMALE') COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Nigeria',
  `address` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` enum('ACTIVE','INACTIVE','SUSPENDED','DISABLED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bvn` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nin` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_change_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`),
  UNIQUE KEY `users_bvn_unique` (`bvn`),
  UNIQUE KEY `users_nin_unique` (`nin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,NULL,'Irpay','Admin','admin@irpay.ng','08081234567','FEMALE',NULL,NULL,'Nigeria',NULL,'ACTIVE',NULL,NULL,NULL,'BFDDuQA2Dgc6MFcT',NULL,'2024-02-01 16:38:00','$2y$10$wF1HL69Aa.RqpChfPZvFYe1QXXk88XcUahhhSAMgoXCXM5AgZwVaq',NULL,'2024-02-01 16:38:00','2024-02-01 16:38:00',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `virtual_account_credits`
--

DROP TABLE IF EXISTS `virtual_account_credits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `virtual_account_credits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `virtual_account_id` int unsigned NOT NULL,
  `amount` double(12,2) NOT NULL DEFAULT '0.00',
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` text COLLATE utf8mb4_unicode_ci,
  `meta` json DEFAULT NULL,
  `paid_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `virtual_account_credits`
--

LOCK TABLES `virtual_account_credits` WRITE;
/*!40000 ALTER TABLE `virtual_account_credits` DISABLE KEYS */;
/*!40000 ALTER TABLE `virtual_account_credits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `virtual_accounts`
--

DROP TABLE IF EXISTS `virtual_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `virtual_accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `account_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` double(12,2) NOT NULL DEFAULT '0.00',
  `unique_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `virtual_accounts_unique_id_provider_unique` (`unique_id`,`provider`),
  KEY `virtual_accounts_user_id_foreign` (`user_id`),
  CONSTRAINT `virtual_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `virtual_accounts`
--

LOCK TABLES `virtual_accounts` WRITE;
/*!40000 ALTER TABLE `virtual_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `virtual_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallet_transactions`
--

DROP TABLE IF EXISTS `wallet_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wallet_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `wallet_id` bigint unsigned NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(12,2) NOT NULL,
  `prev_balance` double(12,2) NOT NULL,
  `new_balance` double(12,2) NOT NULL,
  `status` enum('SUCCESSFUL','FAILED') COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` enum('CREDIT','DEBIT') COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('TRANSACTION','CHARGE','COMMISSION') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'TRANSACTION',
  `info` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallet_transactions`
--

LOCK TABLES `wallet_transactions` WRITE;
/*!40000 ALTER TABLE `wallet_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `wallet_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wallets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uwid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `account_number` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` double(12,2) NOT NULL DEFAULT '0.00',
  `income` double(12,2) NOT NULL DEFAULT '0.00',
  `status` enum('ACTIVE','SUSPENDED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  `disable_debit` tinyint(1) NOT NULL DEFAULT '0',
  `meta` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wallets_user_id_foreign` (`user_id`),
  CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` VALUES (1,'000001f5-c120-21ee-9400-ee6e5e501c76',1,'8081234567',0.00,0.00,'ACTIVE',0,NULL,'2024-02-01 16:38:00','2024-02-01 16:38:00');
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-01 17:43:11
