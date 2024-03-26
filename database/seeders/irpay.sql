-- MySQL dump 10.13  Distrib 8.0.35, for Linux (x86_64)
--
-- Host: localhost    Database: irpay
-- ------------------------------------------------------
-- Server version	8.0.35-0ubuntu0.22.04.1

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
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_log`
--

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
INSERT INTO `activity_log` VALUES (1,'KycLevel','created','App\\Models\\KycLevel','created',1,NULL,NULL,'{\"attributes\": {\"name\": \"SILVER\", \"daily_limit\": 100000}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(2,'KycLevel','created','App\\Models\\KycLevel','created',2,NULL,NULL,'{\"attributes\": {\"name\": \"GOLD\", \"daily_limit\": 200000}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(3,'KycLevel','created','App\\Models\\KycLevel','created',3,NULL,NULL,'{\"attributes\": {\"name\": \"DIAMOND\", \"daily_limit\": 500000}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(4,'KycLevel','created','App\\Models\\KycLevel','created',4,NULL,NULL,'{\"attributes\": {\"name\": \"MERCHANT\", \"daily_limit\": 1000000}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(5,'Users','created','App\\Models\\User','created',1,NULL,NULL,'{\"attributes\": {\"name\": \"Irpay Admin\", \"email\": \"admin@irpay.com\"}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(6,'Wallet','created','App\\Models\\Wallet','created',1,NULL,NULL,'{\"attributes\": {\"status\": \"ACTIVE\", \"account_number\": \"8081234567\"}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(7,'Service','created','App\\Models\\Service','created',1,NULL,NULL,'{\"attributes\": {\"name\": \"CABLE TV\", \"provider\": null, \"description\": null}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(8,'Service','updated','App\\Models\\Service','updated',1,NULL,NULL,'{\"old\": {\"name\": \"CABLE TV\", \"provider\": null, \"description\": null}, \"attributes\": {\"name\": \"CABLE TV\", \"provider\": {\"id\": 1, \"name\": \"Spout\", \"created_at\": \"2023-11-30T07:41:39.000000Z\", \"service_id\": 1, \"updated_at\": \"2023-11-30T07:41:39.000000Z\"}, \"description\": null}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(9,'Service','created','App\\Models\\Service','created',2,NULL,NULL,'{\"attributes\": {\"name\": \"AIRTIME\", \"provider\": null, \"description\": null}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(10,'Service','updated','App\\Models\\Service','updated',2,NULL,NULL,'{\"old\": {\"name\": \"AIRTIME\", \"provider\": null, \"description\": null}, \"attributes\": {\"name\": \"AIRTIME\", \"provider\": {\"id\": 2, \"name\": \"Spout\", \"created_at\": \"2023-11-30T07:41:39.000000Z\", \"service_id\": 2, \"updated_at\": \"2023-11-30T07:41:39.000000Z\"}, \"description\": null}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(11,'Service','created','App\\Models\\Service','created',3,NULL,NULL,'{\"attributes\": {\"name\": \"INTERNET DATA\", \"provider\": null, \"description\": null}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(12,'Service','updated','App\\Models\\Service','updated',3,NULL,NULL,'{\"old\": {\"name\": \"INTERNET DATA\", \"provider\": null, \"description\": null}, \"attributes\": {\"name\": \"INTERNET DATA\", \"provider\": {\"id\": 3, \"name\": \"Spout\", \"created_at\": \"2023-11-30T07:41:39.000000Z\", \"service_id\": 3, \"updated_at\": \"2023-11-30T07:41:39.000000Z\"}, \"description\": null}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(13,'Service','created','App\\Models\\Service','created',4,NULL,NULL,'{\"attributes\": {\"name\": \"ELECTRICITY\", \"provider\": null, \"description\": null}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(14,'Service','updated','App\\Models\\Service','updated',4,NULL,NULL,'{\"old\": {\"name\": \"ELECTRICITY\", \"provider\": null, \"description\": null}, \"attributes\": {\"name\": \"ELECTRICITY\", \"provider\": {\"id\": 4, \"name\": \"Spout\", \"created_at\": \"2023-11-30T07:41:39.000000Z\", \"service_id\": 4, \"updated_at\": \"2023-11-30T07:41:39.000000Z\"}, \"description\": null}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(15,'Service','created','App\\Models\\Service','created',5,NULL,NULL,'{\"attributes\": {\"name\": \"BANK TRANSFER\", \"provider\": null, \"description\": null}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(16,'Service','updated','App\\Models\\Service','updated',5,NULL,NULL,'{\"old\": {\"name\": \"BANK TRANSFER\", \"provider\": null, \"description\": null}, \"attributes\": {\"name\": \"BANK TRANSFER\", \"provider\": {\"id\": 5, \"name\": \"Spout\", \"created_at\": \"2023-11-30T07:41:39.000000Z\", \"service_id\": 5, \"updated_at\": \"2023-11-30T07:41:39.000000Z\"}, \"description\": null}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(17,'Service','created','App\\Models\\Service','created',6,NULL,NULL,'{\"attributes\": {\"name\": \"CASHOUT/WITHDRAWAL\", \"provider\": null, \"description\": null}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(18,'Service','created','App\\Models\\Service','created',7,NULL,NULL,'{\"attributes\": {\"name\": \"WALLET TRANSFER\", \"provider\": null, \"description\": null}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(19,'Service','created','App\\Models\\Service','created',8,NULL,NULL,'{\"attributes\": {\"name\": \"FUNDING/INBOUND\", \"provider\": null, \"description\": null}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(20,'Service','created','App\\Models\\Service','created',9,NULL,NULL,'{\"attributes\": {\"name\": \"LOAN\", \"provider\": null, \"description\": null}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(21,'GL','created','App\\Models\\GeneralLedger','created',1,NULL,NULL,'{\"attributes\": {\"balance\": 0}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(22,'GL','created','App\\Models\\GeneralLedger','created',2,NULL,NULL,'{\"attributes\": {\"balance\": 0}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(23,'GL','created','App\\Models\\GeneralLedger','created',3,NULL,NULL,'{\"attributes\": {\"balance\": 0}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(24,'GL','created','App\\Models\\GeneralLedger','created',4,NULL,NULL,'{\"attributes\": {\"balance\": 0}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(25,'GL','created','App\\Models\\GeneralLedger','created',5,NULL,NULL,'{\"attributes\": {\"balance\": 0}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(26,'GL','created','App\\Models\\GeneralLedger','created',6,NULL,NULL,'{\"attributes\": {\"balance\": 0}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(27,'GL','created','App\\Models\\GeneralLedger','created',7,NULL,NULL,'{\"attributes\": {\"balance\": 0}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(28,'GL','created','App\\Models\\GeneralLedger','created',8,NULL,NULL,'{\"attributes\": {\"balance\": 0}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(29,'GL','created','App\\Models\\GeneralLedger','created',9,NULL,NULL,'{\"attributes\": {\"balance\": 0}}',NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(30,'Users','created','App\\Models\\User','created',2,NULL,NULL,'{\"attributes\": {\"name\": \"Webster John\", \"email\": \"johnwebster221@gmail.com\"}}',NULL,'2023-11-30 08:46:23','2023-11-30 08:46:23'),(31,'Wallet','created','App\\Models\\Wallet','created',2,NULL,NULL,'{\"attributes\": {\"status\": \"ACTIVE\", \"account_number\": \"8107042127\"}}',NULL,'2023-11-30 08:46:23','2023-11-30 08:46:23'),(32,'Users','updated','App\\Models\\User','updated',2,'App\\Models\\User',1,'{\"old\": [], \"attributes\": []}',NULL,'2023-11-30 08:47:23','2023-11-30 08:47:23'),(33,'Wallet','updated','App\\Models\\Wallet','updated',2,'App\\Models\\User',1,'{\"old\": {\"status\": \"ACTIVE\", \"account_number\": \"8107042127\"}, \"attributes\": {\"status\": \"ACTIVE\", \"account_number\": \"8107042127\"}}',NULL,'2023-11-30 08:48:38','2023-11-30 08:48:38'),(34,'Wallet-transaction','created','App\\Models\\WalletTransaction','created',1,'App\\Models\\User',1,'{\"attributes\": {\"status\": \"SUCCESSFUL\"}}',NULL,'2023-11-30 08:48:38','2023-11-30 08:48:38'),(35,'GL','updated','App\\Models\\GeneralLedger','updated',8,'App\\Models\\User',1,'{\"old\": {\"balance\": 0}, \"attributes\": {\"balance\": -1000}}',NULL,'2023-11-30 08:48:38','2023-11-30 08:48:38'),(36,'Users','created','App\\Models\\User','created',3,NULL,NULL,'{\"attributes\": {\"name\": \"Canaan Etai\", \"email\": \"canaan@gmail.com\"}}',NULL,'2023-11-30 09:21:46','2023-11-30 09:21:46'),(37,'Wallet','created','App\\Models\\Wallet','created',3,NULL,NULL,'{\"attributes\": {\"status\": \"ACTIVE\", \"account_number\": \"8107042122\"}}',NULL,'2023-11-30 09:21:46','2023-11-30 09:21:46'),(38,'Users','updated','App\\Models\\User','updated',3,'App\\Models\\User',1,'{\"old\": [], \"attributes\": []}',NULL,'2023-11-30 09:22:36','2023-11-30 09:22:36'),(39,'Users','updated','App\\Models\\User','updated',1,NULL,NULL,'{\"old\": [], \"attributes\": []}',NULL,'2023-11-30 12:12:31','2023-11-30 12:12:31'),(40,'User','login','App\\Models\\User',NULL,1,'App\\Models\\User',1,'{\"attributes\": {\"name\": \"Irpay Admin\", \"email\": \"admin@irpay.com\"}}',NULL,'2023-11-30 12:47:11','2023-11-30 12:47:11'),(41,'Wallet','updated','App\\Models\\Wallet','updated',3,'App\\Models\\User',1,'{\"old\": {\"status\": \"ACTIVE\", \"account_number\": \"8107042122\"}, \"attributes\": {\"status\": \"ACTIVE\", \"account_number\": \"8107042122\"}}',NULL,'2023-11-30 12:48:25','2023-11-30 12:48:25'),(42,'Wallet-transaction','created','App\\Models\\WalletTransaction','created',2,'App\\Models\\User',1,'{\"attributes\": {\"status\": \"SUCCESSFUL\"}}',NULL,'2023-11-30 12:48:25','2023-11-30 12:48:25'),(43,'GL','updated','App\\Models\\GeneralLedger','updated',8,'App\\Models\\User',1,'{\"old\": {\"balance\": -1000}, \"attributes\": {\"balance\": -2000}}',NULL,'2023-11-30 12:48:25','2023-11-30 12:48:25'),(44,'Wallet','updated','App\\Models\\Wallet','updated',2,'App\\Models\\User',1,'{\"old\": {\"status\": \"ACTIVE\", \"account_number\": \"8107042127\"}, \"attributes\": {\"status\": \"ACTIVE\", \"account_number\": \"8107042127\"}}',NULL,'2023-11-30 12:48:29','2023-11-30 12:48:29'),(45,'Wallet-transaction','created','App\\Models\\WalletTransaction','created',3,'App\\Models\\User',1,'{\"attributes\": {\"status\": \"SUCCESSFUL\"}}',NULL,'2023-11-30 12:48:29','2023-11-30 12:48:29'),(46,'GL','updated','App\\Models\\GeneralLedger','updated',8,'App\\Models\\User',1,'{\"old\": {\"balance\": -2000}, \"attributes\": {\"balance\": -3000}}',NULL,'2023-11-30 12:48:29','2023-11-30 12:48:29'),(47,'Transaction','created','App\\Models\\Transaction','created',1,'App\\Models\\User',3,'{\"attributes\": {\"status\": \"PENDING\", \"bank_name\": null, \"account_name\": null, \"total_amount\": 50}}',NULL,'2023-11-30 13:05:59','2023-11-30 13:05:59'),(48,'Wallet','updated','App\\Models\\Wallet','updated',3,'App\\Models\\User',3,'{\"old\": {\"status\": \"ACTIVE\", \"account_number\": \"8107042122\"}, \"attributes\": {\"status\": \"ACTIVE\", \"account_number\": \"8107042122\"}}',NULL,'2023-11-30 13:05:59','2023-11-30 13:05:59'),(49,'Wallet-transaction','created','App\\Models\\WalletTransaction','created',4,'App\\Models\\User',3,'{\"attributes\": {\"status\": \"SUCCESSFUL\"}}',NULL,'2023-11-30 13:05:59','2023-11-30 13:05:59'),(50,'GL','updated','App\\Models\\GeneralLedger','updated',2,'App\\Models\\User',3,'{\"old\": {\"balance\": 0}, \"attributes\": {\"balance\": 50}}',NULL,'2023-11-30 13:05:59','2023-11-30 13:05:59'),(51,'Transaction','updated','App\\Models\\Transaction','updated',1,'App\\Models\\User',3,'{\"old\": {\"status\": \"PENDING\", \"bank_name\": null, \"account_name\": null, \"total_amount\": 50}, \"attributes\": {\"status\": \"PENDING\", \"bank_name\": null, \"account_name\": null, \"total_amount\": 50}}',NULL,'2023-11-30 13:05:59','2023-11-30 13:05:59'),(52,'Transaction','updated','App\\Models\\Transaction','updated',1,'App\\Models\\User',3,'{\"old\": {\"status\": \"PENDING\", \"bank_name\": null, \"account_name\": null, \"total_amount\": 50}, \"attributes\": {\"status\": \"SUCCESSFUL\", \"bank_name\": null, \"account_name\": null, \"total_amount\": 50}}',NULL,'2023-11-30 13:06:00','2023-11-30 13:06:00'),(53,'Users','created','App\\Models\\User','created',4,NULL,NULL,'{\"attributes\": {\"name\": \"Sanusi David\", \"email\": \"segsan4u@gmail.com\"}}',NULL,'2023-11-30 13:44:31','2023-11-30 13:44:31'),(54,'Wallet','created','App\\Models\\Wallet','created',4,NULL,NULL,'{\"attributes\": {\"status\": \"ACTIVE\", \"account_number\": \"8036830944\"}}',NULL,'2023-11-30 13:44:31','2023-11-30 13:44:31'),(55,'User','login','App\\Models\\User',NULL,1,'App\\Models\\User',1,'{\"attributes\": {\"name\": \"Irpay Admin\", \"email\": \"admin@irpay.com\"}}',NULL,'2023-11-30 13:48:32','2023-11-30 13:48:32'),(56,'Users','updated','App\\Models\\User','updated',4,'App\\Models\\User',1,'{\"old\": [], \"attributes\": []}',NULL,'2023-11-30 13:59:03','2023-11-30 13:59:03'),(57,'Users','updated','App\\Models\\User','updated',3,'App\\Models\\User',3,'{\"old\": {\"name\": \"Canaan Etai\"}, \"attributes\": {\"name\": \"Sanusi Segun\"}}',NULL,'2023-12-01 10:20:31','2023-12-01 10:20:31'),(58,'User','login','App\\Models\\User',NULL,1,'App\\Models\\User',1,'{\"attributes\": {\"name\": \"Irpay Admin\", \"email\": \"admin@irpay.com\"}}',NULL,'2023-12-01 10:25:57','2023-12-01 10:25:57'),(59,'User','login','App\\Models\\User',NULL,1,'App\\Models\\User',1,'{\"attributes\": {\"name\": \"Irpay Admin\", \"email\": \"admin@irpay.com\"}}',NULL,'2023-12-01 12:15:42','2023-12-01 12:15:42'),(60,'User','login','App\\Models\\User',NULL,1,'App\\Models\\User',1,'{\"attributes\": {\"name\": \"Irpay Admin\", \"email\": \"admin@irpay.com\"}}',NULL,'2023-12-01 12:36:07','2023-12-01 12:36:07'),(61,'Users','updated','App\\Models\\User','updated',1,'App\\Models\\User',1,'{\"old\": [], \"attributes\": []}',NULL,'2023-12-02 14:13:41','2023-12-02 14:13:41'),(62,'User','login','App\\Models\\User',NULL,1,'App\\Models\\User',1,'{\"attributes\": {\"name\": \"Irpay Admin\", \"email\": \"admin@irpay.com\"}}',NULL,'2023-12-02 14:13:41','2023-12-02 14:13:41'),(63,'User','login','App\\Models\\User',NULL,1,'App\\Models\\User',1,'{\"attributes\": {\"name\": \"Irpay Admin\", \"email\": \"admin@irpay.com\"}}',NULL,'2023-12-02 20:19:56','2023-12-02 20:19:56'),(64,'User','login','App\\Models\\User',NULL,1,'App\\Models\\User',1,'{\"attributes\": {\"name\": \"Irpay Admin\", \"email\": \"admin@irpay.com\"}}',NULL,'2023-12-03 18:50:24','2023-12-03 18:50:24'),(65,'User','Logged Out','App\\Models\\User',NULL,1,'App\\Models\\User',1,'{\"attributes\": {\"name\": \"Irpay Admin\", \"email\": \"admin@irpay.com\"}}',NULL,'2023-12-03 18:52:21','2023-12-03 18:52:21'),(66,'Users','updated','App\\Models\\User','updated',1,'App\\Models\\User',1,'{\"old\": [], \"attributes\": []}',NULL,'2023-12-03 18:52:21','2023-12-03 18:52:21'),(67,'User','login','App\\Models\\User',NULL,1,'App\\Models\\User',1,'{\"attributes\": {\"name\": \"Irpay Admin\", \"email\": \"admin@irpay.com\"}}',NULL,'2023-12-03 18:52:46','2023-12-03 18:52:46'),(68,'Transaction','created','App\\Models\\Transaction','created',18,'App\\Models\\User',3,'{\"attributes\": {\"status\": \"PENDING\", \"bank_name\": null, \"account_name\": null, \"total_amount\": 100}}',NULL,'2023-12-03 18:59:58','2023-12-03 18:59:58'),(69,'Wallet','updated','App\\Models\\Wallet','updated',3,'App\\Models\\User',3,'{\"old\": {\"status\": \"ACTIVE\", \"account_number\": \"8107042122\"}, \"attributes\": {\"status\": \"ACTIVE\", \"account_number\": \"8107042122\"}}',NULL,'2023-12-03 18:59:58','2023-12-03 18:59:58'),(70,'Wallet-transaction','created','App\\Models\\WalletTransaction','created',7,'App\\Models\\User',3,'{\"attributes\": {\"status\": \"SUCCESSFUL\"}}',NULL,'2023-12-03 18:59:58','2023-12-03 18:59:58'),(71,'GL','updated','App\\Models\\GeneralLedger','updated',2,'App\\Models\\User',3,'{\"old\": {\"balance\": 50}, \"attributes\": {\"balance\": 150}}',NULL,'2023-12-03 18:59:58','2023-12-03 18:59:58'),(72,'Transaction','updated','App\\Models\\Transaction','updated',18,'App\\Models\\User',3,'{\"old\": {\"status\": \"PENDING\", \"bank_name\": null, \"account_name\": null, \"total_amount\": 100}, \"attributes\": {\"status\": \"PENDING\", \"bank_name\": null, \"account_name\": null, \"total_amount\": 100}}',NULL,'2023-12-03 18:59:58','2023-12-03 18:59:58'),(73,'Transaction','updated','App\\Models\\Transaction','updated',18,'App\\Models\\User',3,'{\"old\": {\"status\": \"PENDING\", \"bank_name\": null, \"account_name\": null, \"total_amount\": 100}, \"attributes\": {\"status\": \"SUCCESSFUL\", \"bank_name\": null, \"account_name\": null, \"total_amount\": 100}}',NULL,'2023-12-03 19:00:00','2023-12-03 19:00:00'),(74,'User','login','App\\Models\\User',NULL,1,'App\\Models\\User',1,'{\"attributes\": {\"name\": \"Irpay Admin\", \"email\": \"admin@irpay.com\"}}',NULL,'2023-12-04 12:02:49','2023-12-04 12:02:49');
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
INSERT INTO `amount_configs` VALUES (1,1.00,4000.00,'SpoutSwitch',1,'SpoutSwitch',1,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(2,4001.00,2000000.00,'SpoutSwitch',1,'SpoutSwitch',1,'2023-11-30 08:41:39','2023-11-30 08:41:39');
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
  `device` enum('HORIZONPAY_K11','ASINO_A75') COLLATE utf8mb4_unicode_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvals`
--

LOCK TABLES `approvals` WRITE;
/*!40000 ALTER TABLE `approvals` DISABLE KEYS */;
INSERT INTO `approvals` VALUES (1,NULL,'App\\Models\\Terminal',NULL,'pending','{\"mid\": \"202300000000000\", \"tid\": \"07042127\", \"device\": \"HorizonPay K11\", \"serial\": \"98220902708268\", \"user_id\": 2}','[]','2023-11-30 08:46:23','2023-11-30 08:46:23'),(2,1,'App\\Models\\Wallet',2,'approved','{\"info\": \"Test - By Irpay Admin\", \"action\": \"CREDIT\", \"amount\": 1000, \"account_holder\": \"Webster John\", \"account_number\": \"8107042127\"}',NULL,'2023-11-30 08:47:56','2023-11-30 08:48:38'),(3,NULL,'App\\Models\\Terminal',NULL,'pending','{\"mid\": \"202300000000000\", \"tid\": \"07042122\", \"device\": \"HorizonPay K11\", \"serial\": \"98210709981589\", \"user_id\": 3}','[]','2023-11-30 09:21:46','2023-11-30 09:21:46'),(4,1,'App\\Models\\Wallet',3,'approved','{\"info\": \"Test - By Irpay Admin\", \"action\": \"CREDIT\", \"amount\": 1000, \"account_holder\": \"Canaan Etai\", \"account_number\": \"8107042122\"}',NULL,'2023-11-30 12:47:55','2023-11-30 12:48:25'),(5,1,'App\\Models\\Wallet',2,'approved','{\"info\": \"Test - By Irpay Admin\", \"action\": \"CREDIT\", \"amount\": 1000, \"account_holder\": \"Webster John\", \"account_number\": \"8107042127\"}',NULL,'2023-11-30 12:48:17','2023-11-30 12:48:29'),(6,NULL,'App\\Models\\Terminal',NULL,'pending','{\"mid\": \"202300000000000\", \"tid\": \"36830944\", \"device\": \"HorizonPay K11\", \"serial\": \"98220902708255\", \"user_id\": 4}','[]','2023-11-30 13:44:31','2023-11-30 13:44:31');
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
INSERT INTO `card_configs` VALUES (1,'MASTERCARD','SpoutSwitch',1,'SpoutSwitch',1,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(2,'VISA','SpoutSwitch',1,'SpoutSwitch',1,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(3,'VERVE','SpoutSwitch',1,'SpoutSwitch',1,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(4,'OTHERS','SpoutSwitch',1,'SpoutSwitch',1,'2023-11-30 08:41:39','2023-11-30 08:41:39');
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
INSERT INTO `configs` VALUES (1,'DEFAULT_GROUP_ID','1','2023-11-30 08:41:38','2023-11-30 08:41:38');
/*!40000 ALTER TABLE `configs` ENABLE KEYS */;
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
  `service_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('CHARGE','COMMISSION') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CHARGE',
  `amount` double(12,2) NOT NULL,
  `amount_type` enum('FIXED','PERCENTAGE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'FIXED',
  `cap` double(8,2) NOT NULL DEFAULT '0.00',
  `info` text COLLATE utf8mb4_unicode_ci,
  `config` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_fee` (`group_id`,`service_id`,`title`),
  CONSTRAINT `fees_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `terminal_groups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fees`
--

LOCK TABLES `fees` WRITE;
/*!40000 ALTER TABLE `fees` DISABLE KEYS */;
INSERT INTO `fees` VALUES (1,1,'1','CABLE TV','CHARGE',10.00,'FIXED',0.00,NULL,'[]','2023-11-30 08:41:39','2023-11-30 08:41:39'),(2,1,'4','ELECTRICITY','CHARGE',10.00,'FIXED',0.00,NULL,'[]','2023-11-30 08:41:39','2023-11-30 08:41:39'),(3,1,'5','BANK TRANSFER','CHARGE',10.00,'FIXED',0.00,NULL,'[]','2023-11-30 08:41:39','2023-11-30 08:41:39'),(4,1,'6','CASHOUT/WITHDRAWAL','CHARGE',10.00,'FIXED',0.00,NULL,'[]','2023-11-30 08:41:39','2023-11-30 08:41:39'),(5,1,'7','WALLET TRANSFER','CHARGE',10.00,'FIXED',0.00,NULL,'[]','2023-11-30 08:41:39','2023-11-30 08:41:39'),(6,1,'8','FUNDING/INBOUND','CHARGE',10.00,'FIXED',0.00,NULL,'[]','2023-11-30 08:41:39','2023-11-30 08:41:39'),(7,1,'9','LOAN','CHARGE',10.00,'FIXED',0.00,NULL,'[]','2023-11-30 08:41:39','2023-11-30 08:41:39');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `g_l_t_s`
--

LOCK TABLES `g_l_t_s` WRITE;
/*!40000 ALTER TABLE `g_l_t_s` DISABLE KEYS */;
INSERT INTO `g_l_t_s` VALUES (1,2,8,1000.00,0.00,-1000.00,'DEBIT','Test - By Irpay Admin','2023-11-30 08:48:38','2023-11-30 08:48:38'),(2,3,8,1000.00,-1000.00,-2000.00,'DEBIT','Test - By Irpay Admin','2023-11-30 12:48:25','2023-11-30 12:48:25'),(3,2,8,1000.00,-2000.00,-3000.00,'DEBIT','Test - By Irpay Admin','2023-11-30 12:48:29','2023-11-30 12:48:29'),(4,3,2,50.00,0.00,50.00,'CREDIT','Airtime purchase of MTN - ₦50.00 for 08107042127','2023-11-30 13:05:59','2023-11-30 13:05:59'),(5,3,6,100.00,0.00,100.00,'DEBIT','CASHOUT/WITHDRAWAL of ₦100.0 from debit card 539983*******787(01)','2023-12-02 11:04:47',NULL),(6,3,6,100.00,100.00,200.00,'DEBIT','CASHOUT/WITHDRAWAL of ₦100.0 from debit card 539983*******787(01)','2023-12-03 17:55:28',NULL),(7,3,2,100.00,50.00,150.00,'CREDIT','Airtime purchase of MTN - ₦100.00 for 07032703085','2023-12-03 18:59:58','2023-12-03 18:59:58');
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
INSERT INTO `general_ledgers` VALUES (1,1,0.00,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(2,2,150.00,'2023-11-30 08:41:39','2023-12-03 18:59:58'),(3,3,0.00,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(4,4,0.00,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(5,5,0.00,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(6,6,200.00,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(7,7,0.00,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(8,8,-3000.00,'2023-11-30 08:41:39','2023-11-30 12:48:29'),(9,9,0.00,'2023-11-30 08:41:39','2023-11-30 08:41:39');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (1,'default','{\"uuid\":\"81b48559-3886-4a81-baa8-d7f3ac2df8d2\",\"displayName\":\"Closure (UserObserver.php:38)\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Queue\\\\CallQueuedClosure\",\"command\":\"O:34:\\\"Illuminate\\\\Queue\\\\CallQueuedClosure\\\":1:{s:7:\\\"closure\\\";O:47:\\\"Laravel\\\\SerializableClosure\\\\SerializableClosure\\\":1:{s:12:\\\"serializable\\\";O:46:\\\"Laravel\\\\SerializableClosure\\\\Serializers\\\\Signed\\\":2:{s:12:\\\"serializable\\\";s:466:\\\"O:46:\\\"Laravel\\\\SerializableClosure\\\\Serializers\\\\Native\\\":5:{s:3:\\\"use\\\";a:1:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:8:\\\"function\\\";s:50:\\\"fn() => $user->sendEmailVerificationNotification()\\\";s:5:\\\"scope\\\";s:26:\\\"App\\\\Observers\\\\UserObserver\\\";s:4:\\\"this\\\";N;s:4:\\\"self\\\";s:32:\\\"0000000000000c700000000000000000\\\";}\\\";s:4:\\\"hash\\\";s:44:\\\"t1uX8veOQ7MyebrnuOUKl8okS5c+0TkGF2MUb15jdpI=\\\";}}}\"}}',0,NULL,1701330099,1701330099),(2,'default','{\"uuid\":\"1c055ba3-8a5c-4049-bb2c-fc5fbde7809e\",\"displayName\":\"Closure (UserObserver.php:38)\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Queue\\\\CallQueuedClosure\",\"command\":\"O:34:\\\"Illuminate\\\\Queue\\\\CallQueuedClosure\\\":1:{s:7:\\\"closure\\\";O:47:\\\"Laravel\\\\SerializableClosure\\\\SerializableClosure\\\":1:{s:12:\\\"serializable\\\";O:46:\\\"Laravel\\\\SerializableClosure\\\\Serializers\\\\Signed\\\":2:{s:12:\\\"serializable\\\";s:466:\\\"O:46:\\\"Laravel\\\\SerializableClosure\\\\Serializers\\\\Native\\\":5:{s:3:\\\"use\\\";a:1:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:2;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:8:\\\"function\\\";s:50:\\\"fn() => $user->sendEmailVerificationNotification()\\\";s:5:\\\"scope\\\";s:26:\\\"App\\\\Observers\\\\UserObserver\\\";s:4:\\\"this\\\";N;s:4:\\\"self\\\";s:32:\\\"00000000000006b10000000000000000\\\";}\\\";s:4:\\\"hash\\\";s:44:\\\"9G4jHICT9A5u\\/pWjKuWFVAtSnA5xtS\\/hvxY0mWg\\/xOg=\\\";}}}\"}}',0,NULL,1701330383,1701330383),(3,'default','{\"uuid\":\"38370553-93f4-4def-a372-57a9fcbac1ad\",\"displayName\":\"Closure (HasWalletMethods.php:94)\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Queue\\\\CallQueuedClosure\",\"command\":\"O:34:\\\"Illuminate\\\\Queue\\\\CallQueuedClosure\\\":1:{s:7:\\\"closure\\\";O:47:\\\"Laravel\\\\SerializableClosure\\\\SerializableClosure\\\":1:{s:12:\\\"serializable\\\";O:46:\\\"Laravel\\\\SerializableClosure\\\\Serializers\\\\Signed\\\":2:{s:12:\\\"serializable\\\";s:1938:\\\"O:46:\\\"Laravel\\\\SerializableClosure\\\\Serializers\\\\Native\\\":5:{s:3:\\\"use\\\";a:1:{s:6:\\\"amount\\\";d:1000;}s:8:\\\"function\\\";s:59:\\\"fn() => \\\\App\\\\Repository\\\\Viral::creditWallet($this, $amount)\\\";s:5:\\\"scope\\\";s:17:\\\"App\\\\Models\\\\Wallet\\\";s:4:\\\"this\\\";O:17:\\\"App\\\\Models\\\\Wallet\\\":33:{s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:7:\\\"wallets\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:0;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:11:{s:2:\\\"id\\\";i:2;s:4:\\\"uwid\\\";s:36:\\\"00000021-8f54-21ee-9600-cae0951c884d\\\";s:7:\\\"user_id\\\";i:2;s:14:\\\"account_number\\\";s:10:\\\"8107042127\\\";s:7:\\\"balance\\\";d:1000;s:6:\\\"income\\\";d:0;s:6:\\\"status\\\";s:6:\\\"ACTIVE\\\";s:13:\\\"disable_debit\\\";i:0;s:4:\\\"meta\\\";N;s:10:\\\"created_at\\\";s:19:\\\"2023-11-30 08:46:23\\\";s:10:\\\"updated_at\\\";s:19:\\\"2023-11-30 08:48:38\\\";}s:11:\\\"\\u0000*\\u0000original\\\";a:11:{s:2:\\\"id\\\";i:2;s:4:\\\"uwid\\\";s:36:\\\"00000021-8f54-21ee-9600-cae0951c884d\\\";s:7:\\\"user_id\\\";i:2;s:14:\\\"account_number\\\";s:10:\\\"8107042127\\\";s:7:\\\"balance\\\";d:1000;s:6:\\\"income\\\";d:0;s:6:\\\"status\\\";s:6:\\\"ACTIVE\\\";s:13:\\\"disable_debit\\\";i:0;s:4:\\\"meta\\\";N;s:10:\\\"created_at\\\";s:19:\\\"2023-11-30 08:46:23\\\";s:10:\\\"updated_at\\\";s:19:\\\"2023-11-30 08:48:38\\\";}s:10:\\\"\\u0000*\\u0000changes\\\";a:2:{s:7:\\\"balance\\\";d:1000;s:10:\\\"updated_at\\\";s:19:\\\"2023-11-30 08:48:38\\\";}s:8:\\\"\\u0000*\\u0000casts\\\";a:1:{s:4:\\\"meta\\\";s:6:\\\"object\\\";}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:1;s:13:\\\"usesUniqueIds\\\";b:0;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:0:{}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:2:\\\"id\\\";}s:16:\\\"\\u0000*\\u0000oldAttributes\\\";a:0:{}s:21:\\\"\\u0000*\\u0000activitylogOptions\\\";N;s:25:\\\"enableLoggingModelsEvents\\\";b:1;}s:4:\\\"self\\\";s:32:\\\"00000000000006e60000000000000000\\\";}\\\";s:4:\\\"hash\\\";s:44:\\\"kN5Vqcrw5ckwLVGLN0yOfvbvd15bfbezfpGvZUoeGbY=\\\";}}}\"}}',0,NULL,1701330518,1701330518),(4,'default','{\"uuid\":\"a3ca02bf-c67b-463a-9883-ff893ee33cee\",\"displayName\":\"Closure (UserObserver.php:38)\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Queue\\\\CallQueuedClosure\",\"command\":\"O:34:\\\"Illuminate\\\\Queue\\\\CallQueuedClosure\\\":1:{s:7:\\\"closure\\\";O:47:\\\"Laravel\\\\SerializableClosure\\\\SerializableClosure\\\":1:{s:12:\\\"serializable\\\";O:46:\\\"Laravel\\\\SerializableClosure\\\\Serializers\\\\Signed\\\":2:{s:12:\\\"serializable\\\";s:466:\\\"O:46:\\\"Laravel\\\\SerializableClosure\\\\Serializers\\\\Native\\\":5:{s:3:\\\"use\\\";a:1:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:3;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:8:\\\"function\\\";s:50:\\\"fn() => $user->sendEmailVerificationNotification()\\\";s:5:\\\"scope\\\";s:26:\\\"App\\\\Observers\\\\UserObserver\\\";s:4:\\\"this\\\";N;s:4:\\\"self\\\";s:32:\\\"00000000000006b10000000000000000\\\";}\\\";s:4:\\\"hash\\\";s:44:\\\"NhHOjWDrPS0FwhKXB9+1MMMowUt66TTCAlZqh5d\\/YuY=\\\";}}}\"}}',0,NULL,1701332506,1701332506),(5,'default','{\"uuid\":\"e6d058c0-0f74-4992-97ee-f6d0dac2b006\",\"displayName\":\"Closure (HasWalletMethods.php:94)\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Queue\\\\CallQueuedClosure\",\"command\":\"O:34:\\\"Illuminate\\\\Queue\\\\CallQueuedClosure\\\":1:{s:7:\\\"closure\\\";O:47:\\\"Laravel\\\\SerializableClosure\\\\SerializableClosure\\\":1:{s:12:\\\"serializable\\\";O:46:\\\"Laravel\\\\SerializableClosure\\\\Serializers\\\\Signed\\\":2:{s:12:\\\"serializable\\\";s:1938:\\\"O:46:\\\"Laravel\\\\SerializableClosure\\\\Serializers\\\\Native\\\":5:{s:3:\\\"use\\\";a:1:{s:6:\\\"amount\\\";d:1000;}s:8:\\\"function\\\";s:59:\\\"fn() => \\\\App\\\\Repository\\\\Viral::creditWallet($this, $amount)\\\";s:5:\\\"scope\\\";s:17:\\\"App\\\\Models\\\\Wallet\\\";s:4:\\\"this\\\";O:17:\\\"App\\\\Models\\\\Wallet\\\":33:{s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:7:\\\"wallets\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:0;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:11:{s:2:\\\"id\\\";i:3;s:4:\\\"uwid\\\";s:36:\\\"00000021-8f59-21ee-ad00-cae0951c884d\\\";s:7:\\\"user_id\\\";i:3;s:14:\\\"account_number\\\";s:10:\\\"8107042122\\\";s:7:\\\"balance\\\";d:1000;s:6:\\\"income\\\";d:0;s:6:\\\"status\\\";s:6:\\\"ACTIVE\\\";s:13:\\\"disable_debit\\\";i:0;s:4:\\\"meta\\\";N;s:10:\\\"created_at\\\";s:19:\\\"2023-11-30 09:21:46\\\";s:10:\\\"updated_at\\\";s:19:\\\"2023-11-30 12:48:25\\\";}s:11:\\\"\\u0000*\\u0000original\\\";a:11:{s:2:\\\"id\\\";i:3;s:4:\\\"uwid\\\";s:36:\\\"00000021-8f59-21ee-ad00-cae0951c884d\\\";s:7:\\\"user_id\\\";i:3;s:14:\\\"account_number\\\";s:10:\\\"8107042122\\\";s:7:\\\"balance\\\";d:1000;s:6:\\\"income\\\";d:0;s:6:\\\"status\\\";s:6:\\\"ACTIVE\\\";s:13:\\\"disable_debit\\\";i:0;s:4:\\\"meta\\\";N;s:10:\\\"created_at\\\";s:19:\\\"2023-11-30 09:21:46\\\";s:10:\\\"updated_at\\\";s:19:\\\"2023-11-30 12:48:25\\\";}s:10:\\\"\\u0000*\\u0000changes\\\";a:2:{s:7:\\\"balance\\\";d:1000;s:10:\\\"updated_at\\\";s:19:\\\"2023-11-30 12:48:25\\\";}s:8:\\\"\\u0000*\\u0000casts\\\";a:1:{s:4:\\\"meta\\\";s:6:\\\"object\\\";}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:1;s:13:\\\"usesUniqueIds\\\";b:0;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:0:{}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:2:\\\"id\\\";}s:16:\\\"\\u0000*\\u0000oldAttributes\\\";a:0:{}s:21:\\\"\\u0000*\\u0000activitylogOptions\\\";N;s:25:\\\"enableLoggingModelsEvents\\\";b:1;}s:4:\\\"self\\\";s:32:\\\"00000000000006e60000000000000000\\\";}\\\";s:4:\\\"hash\\\";s:44:\\\"uF8ryG7MkWCeYntGAsaRCl6wY0\\/2GU3rNQH95dX2ZC4=\\\";}}}\"}}',0,NULL,1701344905,1701344905),(6,'default','{\"uuid\":\"e9668122-7bf2-4e81-8ac4-81246a5cebb8\",\"displayName\":\"Closure (HasWalletMethods.php:94)\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Queue\\\\CallQueuedClosure\",\"command\":\"O:34:\\\"Illuminate\\\\Queue\\\\CallQueuedClosure\\\":1:{s:7:\\\"closure\\\";O:47:\\\"Laravel\\\\SerializableClosure\\\\SerializableClosure\\\":1:{s:12:\\\"serializable\\\";O:46:\\\"Laravel\\\\SerializableClosure\\\\Serializers\\\\Signed\\\":2:{s:12:\\\"serializable\\\";s:1938:\\\"O:46:\\\"Laravel\\\\SerializableClosure\\\\Serializers\\\\Native\\\":5:{s:3:\\\"use\\\";a:1:{s:6:\\\"amount\\\";d:1000;}s:8:\\\"function\\\";s:59:\\\"fn() => \\\\App\\\\Repository\\\\Viral::creditWallet($this, $amount)\\\";s:5:\\\"scope\\\";s:17:\\\"App\\\\Models\\\\Wallet\\\";s:4:\\\"this\\\";O:17:\\\"App\\\\Models\\\\Wallet\\\":33:{s:13:\\\"\\u0000*\\u0000connection\\\";s:5:\\\"mysql\\\";s:8:\\\"\\u0000*\\u0000table\\\";s:7:\\\"wallets\\\";s:13:\\\"\\u0000*\\u0000primaryKey\\\";s:2:\\\"id\\\";s:10:\\\"\\u0000*\\u0000keyType\\\";s:3:\\\"int\\\";s:12:\\\"incrementing\\\";b:1;s:7:\\\"\\u0000*\\u0000with\\\";a:0:{}s:12:\\\"\\u0000*\\u0000withCount\\\";a:0:{}s:19:\\\"preventsLazyLoading\\\";b:0;s:10:\\\"\\u0000*\\u0000perPage\\\";i:15;s:6:\\\"exists\\\";b:1;s:18:\\\"wasRecentlyCreated\\\";b:0;s:28:\\\"\\u0000*\\u0000escapeWhenCastingToString\\\";b:0;s:13:\\\"\\u0000*\\u0000attributes\\\";a:11:{s:2:\\\"id\\\";i:2;s:4:\\\"uwid\\\";s:36:\\\"00000021-8f54-21ee-9600-cae0951c884d\\\";s:7:\\\"user_id\\\";i:2;s:14:\\\"account_number\\\";s:10:\\\"8107042127\\\";s:7:\\\"balance\\\";d:2000;s:6:\\\"income\\\";d:0;s:6:\\\"status\\\";s:6:\\\"ACTIVE\\\";s:13:\\\"disable_debit\\\";i:0;s:4:\\\"meta\\\";N;s:10:\\\"created_at\\\";s:19:\\\"2023-11-30 08:46:23\\\";s:10:\\\"updated_at\\\";s:19:\\\"2023-11-30 12:48:29\\\";}s:11:\\\"\\u0000*\\u0000original\\\";a:11:{s:2:\\\"id\\\";i:2;s:4:\\\"uwid\\\";s:36:\\\"00000021-8f54-21ee-9600-cae0951c884d\\\";s:7:\\\"user_id\\\";i:2;s:14:\\\"account_number\\\";s:10:\\\"8107042127\\\";s:7:\\\"balance\\\";d:2000;s:6:\\\"income\\\";d:0;s:6:\\\"status\\\";s:6:\\\"ACTIVE\\\";s:13:\\\"disable_debit\\\";i:0;s:4:\\\"meta\\\";N;s:10:\\\"created_at\\\";s:19:\\\"2023-11-30 08:46:23\\\";s:10:\\\"updated_at\\\";s:19:\\\"2023-11-30 12:48:29\\\";}s:10:\\\"\\u0000*\\u0000changes\\\";a:2:{s:7:\\\"balance\\\";d:2000;s:10:\\\"updated_at\\\";s:19:\\\"2023-11-30 12:48:29\\\";}s:8:\\\"\\u0000*\\u0000casts\\\";a:1:{s:4:\\\"meta\\\";s:6:\\\"object\\\";}s:17:\\\"\\u0000*\\u0000classCastCache\\\";a:0:{}s:21:\\\"\\u0000*\\u0000attributeCastCache\\\";a:0:{}s:13:\\\"\\u0000*\\u0000dateFormat\\\";N;s:10:\\\"\\u0000*\\u0000appends\\\";a:0:{}s:19:\\\"\\u0000*\\u0000dispatchesEvents\\\";a:0:{}s:14:\\\"\\u0000*\\u0000observables\\\";a:0:{}s:12:\\\"\\u0000*\\u0000relations\\\";a:0:{}s:10:\\\"\\u0000*\\u0000touches\\\";a:0:{}s:10:\\\"timestamps\\\";b:1;s:13:\\\"usesUniqueIds\\\";b:0;s:9:\\\"\\u0000*\\u0000hidden\\\";a:0:{}s:10:\\\"\\u0000*\\u0000visible\\\";a:0:{}s:11:\\\"\\u0000*\\u0000fillable\\\";a:0:{}s:10:\\\"\\u0000*\\u0000guarded\\\";a:1:{i:0;s:2:\\\"id\\\";}s:16:\\\"\\u0000*\\u0000oldAttributes\\\";a:0:{}s:21:\\\"\\u0000*\\u0000activitylogOptions\\\";N;s:25:\\\"enableLoggingModelsEvents\\\";b:1;}s:4:\\\"self\\\";s:32:\\\"00000000000006e60000000000000000\\\";}\\\";s:4:\\\"hash\\\";s:44:\\\"v7scr8q4XpsCFjwL621eI+Yqx3vWLNlrkRg15kU6SpU=\\\";}}}\"}}',0,NULL,1701344909,1701344909),(7,'default','{\"uuid\":\"2eb9a6fb-0d99-4a6c-95c3-06f3c5188279\",\"displayName\":\"Closure (UserObserver.php:38)\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Queue\\\\CallQueuedClosure\",\"command\":\"O:34:\\\"Illuminate\\\\Queue\\\\CallQueuedClosure\\\":1:{s:7:\\\"closure\\\";O:47:\\\"Laravel\\\\SerializableClosure\\\\SerializableClosure\\\":1:{s:12:\\\"serializable\\\";O:46:\\\"Laravel\\\\SerializableClosure\\\\Serializers\\\\Signed\\\":2:{s:12:\\\"serializable\\\";s:466:\\\"O:46:\\\"Laravel\\\\SerializableClosure\\\\Serializers\\\\Native\\\":5:{s:3:\\\"use\\\";a:1:{s:4:\\\"user\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";i:4;s:9:\\\"relations\\\";a:1:{i:0;s:5:\\\"roles\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}}s:8:\\\"function\\\";s:50:\\\"fn() => $user->sendEmailVerificationNotification()\\\";s:5:\\\"scope\\\";s:26:\\\"App\\\\Observers\\\\UserObserver\\\";s:4:\\\"this\\\";N;s:4:\\\"self\\\";s:32:\\\"00000000000006b10000000000000000\\\";}\\\";s:4:\\\"hash\\\";s:44:\\\"Qd8ess4ABIB8TsJc8G3H0yS9gzTmhkC8C5w8bgQ3pJE=\\\";}}}\"}}',0,NULL,1701348271,1701348271);
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
INSERT INTO `kyc_levels` VALUES (1,'SILVER',100000.00,30000.00,200000.00,NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(2,'GOLD',200000.00,50000.00,500000.00,NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(3,'DIAMOND',500000.00,70000.00,750000.00,NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(4,'MERCHANT',1000000.00,100000.00,1200000.00,NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39');
/*!40000 ALTER TABLE `kyc_levels` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loans`
--

LOCK TABLES `loans` WRITE;
/*!40000 ALTER TABLE `loans` DISABLE KEYS */;
INSERT INTO `loans` VALUES (1,3,5000,'[\"ghjjjjjhhh\"]','PENDING',NULL,NULL,NULL,NULL,NULL,'2023-12-01 10:22:22','2023-12-01 10:22:22');
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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_09_12_213240_create_permission_tables',1),(6,'2022_09_14_115759_create_iso_transactions_table',1),(7,'2022_09_14_123309_create_terminals_table',1),(8,'2022_09_14_173429_create_settlement_banks_table',1),(9,'2022_09_14_173829_create_configs_table',1),(10,'2022_09_14_174206_create_hosts_table',1),(11,'2022_09_15_080004_create_wallets_table',1),(12,'2022_09_15_092846_create_wallet_transactions_table',1),(13,'2022_09_15_093131_create_services_table',1),(14,'2022_09_15_110641_create_service_providers_table',1),(15,'2022_09_15_113500_create_transactions_table',1),(16,'2022_09_18_083510_create_kyc_levels_table',1),(17,'2022_09_18_083526_create_kyc_docs_table',1),(18,'2022_09_21_205934_create_general_ledgers_table',1),(19,'2022_09_21_210529_create_g_l_t_s_table',1),(20,'2022_09_23_113720_create_cache_table',1),(21,'2022_10_02_063242_create_terminal_groups_table',1),(22,'2022_10_06_063206_create_fees_table',1),(23,'2023_01_31_113350_create_activity_log_table',1),(24,'2023_01_31_113351_add_event_column_to_activity_log_table',1),(25,'2023_01_31_113352_add_batch_uuid_column_to_activity_log_table',1),(26,'2023_05_02_205515_2022_02_12_195950_create_approvals_table',1),(27,'2023_05_21_112805_service_terminal',1),(28,'2023_05_21_154142_create_routing_types_table',1),(29,'2023_05_21_154538_create_processors_table',1),(30,'2023_05_21_154853_create_amount_configs_table',1),(31,'2023_05_21_154925_create_card_configs_table',1),(32,'2023_05_25_205421_add_expires_at_to_personal_access_tokens_table',1),(33,'2023_05_28_082436_create_banks_table',1),(34,'2023_06_04_232102_create_jobs_table',1),(35,'2023_06_24_035421_create_loans_table',1),(36,'2023_06_30_075909_create_terminal_processors_table',1),(37,'2023_07_11_050055_add_stan_to_transactons_table',1),(38,'2023_09_27_150324_create_app_upates_table',1),(39,'2023_10_16_204818_create_virtual_accounts_table',1),(40,'2023_10_19_221824_create_virtual_account_credits_table',1);
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
INSERT INTO `model_has_roles` VALUES (2,'App\\Models\\User',1),(5,'App\\Models\\User',2),(5,'App\\Models\\User',3),(5,'App\\Models\\User',4);
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
INSERT INTO `permissions` VALUES (1,'read admin',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(2,'read customers',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(3,'create users',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(4,'edit users',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(5,'disable users',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(6,'read kyc-level',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(7,'create kyc-level',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(8,'edit kyc-level',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(9,'read roles',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(10,'create roles',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(11,'edit roles',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(12,'delete roles',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(13,'edit permissions',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(14,'read wallets',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(15,'edit wallets',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(16,'read groups',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(17,'create groups',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(18,'edit groups',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(19,'delete groups',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(20,'read terminals',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(21,'create terminals',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(22,'edit terminals',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(23,'delete terminals',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(24,'read fees',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(25,'edit fees',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(26,'read general ledger',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(27,'edit general ledger',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(28,'read ledger',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(29,'read dispute',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(30,'create dispute',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(31,'edit dispute',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(32,'read settings',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(33,'create settings',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(34,'edit settings',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(35,'read transactions',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(36,'approve actions',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(37,'read menus',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(38,'edit menus',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(39,'create terminal-processors',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(40,'read terminal-processors',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(41,'delete terminal-processors',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(42,'update terminal-processors',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(43,'read loans',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38'),(44,'approve loans',NULL,'web','2023-11-30 08:41:38','2023-11-30 08:41:38');
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'App\\Models\\User',2,'98220902708268 terminal token','ed28998160193e71bf39d30740d46a560669442396b6c589838a8e59a69ade39','[\"*\"]','2023-11-30 14:46:49','2023-11-30 08:48:52','2023-11-30 14:46:49',NULL),(2,'App\\Models\\User',3,'98210709981589 terminal token','b63f6c8c5b1832f81df1a1c929ea779c91a600f932e2ef150b6d0ed5c91ac69e','[\"*\"]','2023-12-01 09:05:14','2023-11-30 09:22:39','2023-12-01 09:05:14',NULL),(3,'App\\Models\\User',4,'98220902708255 terminal token','1a610c8768d1f086da2305e53af3b2668207b86af8bf0f5d6c16d806d99222d9','[\"*\"]','2023-12-01 13:36:25','2023-11-30 14:04:18','2023-12-01 13:36:25',NULL),(4,'App\\Models\\User',3,'98210709981589 terminal token','a7be186afa8a6f46c68194a541cfd44c1ac9caed85e245b392fb8785913596fd','[\"*\"]','2023-12-01 10:12:12','2023-12-01 10:10:47','2023-12-01 10:12:12',NULL),(5,'App\\Models\\User',3,'98210709981589 terminal token','fec77024ae5dddcbe18ca967d960a393e2c1b0b1965f8e9efbbb14d803a874f3','[\"*\"]','2023-12-01 15:46:50','2023-12-01 10:19:47','2023-12-01 15:46:50',NULL),(6,'App\\Models\\User',2,'98220902708268 terminal token','7a3aeb5f14a0fb629e638c3b7f0a290868c19a80dc926f26d32b2e9486c34e16','[\"*\"]','2023-12-01 10:31:20','2023-12-01 10:31:19','2023-12-01 10:31:20',NULL),(7,'App\\Models\\User',3,'98210709981589 terminal token','622867173211166807bf7865e706d9bf15a5fcfc1eca7eca32ddfc7aa0a61c51','[\"*\"]','2023-12-02 12:05:53','2023-12-02 10:18:58','2023-12-02 12:05:53',NULL),(8,'App\\Models\\User',3,'98210709981589 terminal token','f4764aaff2d52457838c97d6d0bbeb92e72295b8bc3396e619b9b4cf81050e7e','[\"*\"]',NULL,'2023-12-02 11:41:08','2023-12-02 11:41:08',NULL),(9,'App\\Models\\User',3,'98210709981589 terminal token','7dd3783e06b6a6875ce0e93299536412a604dbc225d06dd30b29cda5dfe7c70f','[\"*\"]','2023-12-03 20:07:28','2023-12-03 18:47:46','2023-12-03 20:07:28',NULL),(10,'App\\Models\\User',4,'98220902708255 terminal token','1d6bc79f97c7eb05eb89d73a1583a4dbbc30493d374f90be8fa19570640b0aca','[\"*\"]','2023-12-07 08:55:48','2023-12-07 06:41:18','2023-12-07 08:55:48',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processors`
--

LOCK TABLES `processors` WRITE;
/*!40000 ALTER TABLE `processors` DISABLE KEYS */;
INSERT INTO `processors` VALUES (1,'SpoutSwitch','139.162.245.59',6000,0,'87580702D2B8ABB35AC58A5A50B73EE8','87580702D2B8ABB35AC58A5A50B73EE8',NULL,0,NULL,NULL,'2023-07-08 08:00:58','2023-07-08 08:00:58'),(2,'3LINE','108.129.63.76',8080,0,'619C213428CFC2F1F0EB820478073A7F','619C213428CFC2F1F0EB820478073A7F',NULL,0,NULL,NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(3,'INTERSWITCH','167.71.6.36',8081,0,'11111111111111111111111111111111','11111111111111111111111111111111',NULL,0,'2DP','2DP','2023-11-30 08:41:39','2023-11-30 08:41:39');
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
INSERT INTO `roles` VALUES (1,'ADMIN','web','Admins','2023-11-30 08:41:38','2023-11-30 08:41:38'),(2,'SUPER-ADMIN','web','Admins','2023-11-30 08:41:38','2023-11-30 08:41:38'),(3,'APPROVER','web','Admins','2023-11-30 08:41:39','2023-11-30 08:41:39'),(4,'SUPER-AGENT','web','Agents','2023-11-30 08:41:39','2023-11-30 08:41:39'),(5,'AGENT','web','Agents','2023-11-30 08:41:39','2023-11-30 08:41:39');
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
INSERT INTO `routing_types` VALUES (1,'AMOUNT',1,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(2,'CARD',0,'2023-11-30 08:41:39','2023-11-30 08:41:39');
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
INSERT INTO `service_providers` VALUES (1,1,'Spout','\\App\\Repository\\Spout','2023-11-30 08:41:39','2023-11-30 08:41:39'),(2,2,'Spout','\\App\\Repository\\Spout','2023-11-30 08:41:39','2023-11-30 08:41:39'),(3,3,'Spout','\\App\\Repository\\Spout','2023-11-30 08:41:39','2023-11-30 08:41:39'),(4,4,'Spout','\\App\\Repository\\Spout','2023-11-30 08:41:39','2023-11-30 08:41:39'),(5,5,'Spout','\\App\\Repository\\Spout','2023-11-30 08:41:39','2023-11-30 08:41:39');
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_terminal`
--

LOCK TABLES `service_terminal` WRITE;
/*!40000 ALTER TABLE `service_terminal` DISABLE KEYS */;
INSERT INTO `service_terminal` VALUES (1,1,1,'2023-11-30 08:46:23','2023-11-30 08:46:23'),(2,2,1,'2023-11-30 08:46:23','2023-11-30 08:46:23'),(3,3,1,'2023-11-30 08:46:23','2023-11-30 08:46:23'),(4,4,1,'2023-11-30 08:46:23','2023-11-30 08:46:23'),(5,5,1,'2023-11-30 08:46:23','2023-11-30 08:46:23'),(6,6,1,'2023-11-30 08:46:23','2023-11-30 08:46:23'),(7,7,1,'2023-11-30 08:46:23','2023-11-30 08:46:23'),(8,8,1,'2023-11-30 08:46:23','2023-11-30 08:46:23'),(9,9,1,'2023-11-30 08:46:23','2023-11-30 08:46:23'),(10,1,2,'2023-11-30 09:21:46','2023-11-30 09:21:46'),(11,2,2,'2023-11-30 09:21:46','2023-11-30 09:21:46'),(12,3,2,'2023-11-30 09:21:46','2023-11-30 09:21:46'),(13,4,2,'2023-11-30 09:21:46','2023-11-30 09:21:46'),(14,5,2,'2023-11-30 09:21:46','2023-11-30 09:21:46'),(15,6,2,'2023-11-30 09:21:46','2023-11-30 09:21:46'),(16,7,2,'2023-11-30 09:21:46','2023-11-30 09:21:46'),(17,8,2,'2023-11-30 09:21:46','2023-11-30 09:21:46'),(18,9,2,'2023-11-30 09:21:46','2023-11-30 09:21:46'),(19,1,3,'2023-11-30 13:44:31','2023-11-30 13:44:31'),(20,2,3,'2023-11-30 13:44:31','2023-11-30 13:44:31'),(21,3,3,'2023-11-30 13:44:31','2023-11-30 13:44:31'),(22,4,3,'2023-11-30 13:44:31','2023-11-30 13:44:31'),(23,5,3,'2023-11-30 13:44:31','2023-11-30 13:44:31'),(24,6,3,'2023-11-30 13:44:31','2023-11-30 13:44:31'),(25,7,3,'2023-11-30 13:44:31','2023-11-30 13:44:31'),(26,8,3,'2023-11-30 13:44:31','2023-11-30 13:44:31'),(27,9,3,'2023-11-30 13:44:31','2023-11-30 13:44:31');
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
INSERT INTO `services` VALUES (1,1,'cabletv','CABLE TV','CABLE TV',1,NULL,1,0,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(2,2,'airtime','AIRTIME','AIRTIME',1,NULL,1,0,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(3,3,'internetdata','INTERNET DATA','INTERNET DATA',1,NULL,1,0,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(4,4,'electricity','ELECTRICITY','ELECTRICITY',1,NULL,1,0,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(5,5,'banktransfer','BANK TRANSFER','BANK TRANSFER',1,NULL,1,0,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(6,NULL,'cashoutwithdrawal','CASHOUT/WITHDRAWAL','CASHOUT',1,NULL,1,0,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(7,NULL,'wallettransfer','WALLET TRANSFER','WALLET TRANSFER',1,NULL,1,1,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(8,NULL,'fundinginbound','FUNDING/INBOUND','FUNDING',1,NULL,1,0,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(9,NULL,'loan','LOAN','LOAN',1,NULL,1,1,'2023-11-30 08:41:39','2023-11-30 08:41:39');
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
INSERT INTO `terminal_groups` VALUES (1,'DEFAULT','Default terminal groups','2023-11-30 08:41:39','2023-11-30 08:41:39');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terminal_processors`
--

LOCK TABLES `terminal_processors` WRITE;
/*!40000 ALTER TABLE `terminal_processors` DISABLE KEYS */;
INSERT INTO `terminal_processors` VALUES (1,2,'98220902708268','1','INTERSWITCH','00000000','000000000000000',NULL,NULL,NULL,'566','566','0000','Webster John-IRPAY                 LA NG','2023-11-30 08:46:23','2023-11-30 08:46:23'),(2,2,'98220902708268','2','3LINE','00000000','000000000000000',NULL,NULL,NULL,'566','566','0000','Webster John-IRPAY                 LA NG','2023-11-30 08:46:23','2023-11-30 08:46:23'),(3,3,'98210709981589','3','INTERSWITCH','00000000','000000000000000',NULL,NULL,NULL,'566','566','0000','Canaan Etai-IRPAY                  LA NG','2023-11-30 09:21:46','2023-11-30 09:21:46'),(4,3,'98210709981589','2','3LINE','00000000','000000000000000',NULL,NULL,NULL,'566','566','0000','Canaan Etai-IRPAY                  LA NG','2023-11-30 09:21:46','2023-11-30 09:21:46'),(5,4,'98220902708255','1','SpoutSwitch','2SPL0002','2302BA000009611','6CA5D080327AF5B1C14B436EE49B40AED85B92','20A6635C65185E79CC5679499ED8504FF33B37','AAD1524ECFC4E4D677341760F41B399451FEA2','566','566','5411','SPOUT PAYMENT INTERNATIONAL LIMITED     ','2023-11-30 13:44:31','2023-12-07 07:55:51'),(6,4,'98220902708255','2','3LINE','00000000','000000000000000',NULL,NULL,NULL,'566','566','0000','Sanusi David-IRPAY                 LA NG','2023-11-30 13:44:31','2023-11-30 13:44:31'),(8,4,'98220902708255','3','INTERSWITCH','00000000','000000000000000',NULL,NULL,NULL,'566','566','0000','Sanusi David-IRPAY                 LA NG','2023-11-30 13:44:31','2023-11-30 13:44:31'),(9,3,'98210709981589','1','SpoutSwitch','2SPL0002','2302BA000009611','22095901E40C5B06E26515E16D01E90E691186','5AA240A4C73E5A542988BC581C26F6E9FE35BB','CB0BD72A1CD1134EFDD66EAD3AB790DDD90EF6','566','566','5411','SPOUT PAYMENT INTERNATIONAL LIMITED     ','2023-11-30 13:44:31','2023-12-03 17:59:14');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terminals`
--

LOCK TABLES `terminals` WRITE;
/*!40000 ALTER TABLE `terminals` DISABLE KEYS */;
INSERT INTO `terminals` VALUES (1,2,1,'HorizonPay K11','98220902708268','ACTIVE','07042127','202300000000000','F35D99B4E315B0E04B5E0A92226C5CCBD462B2','AE54B4B68EBA3C8AF6D4576DBA5188ED059FEE','C3124FC500B40F49C6770CE1F1070E445D3F6F','30/11/23 08:46',60,'566','566','1234','Webster John-IRPAY                 LA NG','0000','0000',0,0,'2023-11-30 08:46:23','2023-11-30 08:46:23'),(2,3,1,'HorizonPay K11','98210709981589','ACTIVE','07042122','202300000000000','9757E872C594DE673A05A0E7658714C304AB3D','A7B2B0AD79EC4194580A28D89F7DCD58BE84EA','6A2DAF727757AFE2DFB7020C71D29006FA0B6C','30/11/23 09:21',60,'566','566','1234','Canaan Etai-IRPAY                  LA NG','0000','$2y$10$fmm08NIxs9B43EwJ0/5Z9.lNibqAbamnYe3FwmrAQIxZzYdYTrRAC',0,1,'2023-11-30 09:21:46','2023-12-03 18:59:58'),(3,4,1,'HorizonPay K11','98220902708255','ACTIVE','36830944','202300000000000','CA02423721E2555323790C2C1A224524295364','E4D22468066179DED7BAA9ED9D44C5B13F3CBE','4B5029AFC96BFDC1E20AE0E1BC62A1E6A75866','30/11/23 13:44',60,'566','566','1234','Sanusi David-IRPAY                 LA NG','0000','0000',0,0,'2023-11-30 13:44:31','2023-11-30 13:44:31');
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
  `response_code` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stan` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (1,3,2,2,50.00,0.00,50.00,'XXDNW8FIJPUSIZHR',NULL,NULL,NULL,NULL,NULL,NULL,'Airtime purchase of MTN - ₦50.00 for 08107042127',NULL,'SUCCESSFUL','POS','SPOUT','{\"message\": \"Successful\", \"response\": {\"amount\": 50, \"account\": \"08107042127\", \"reversal\": false, \"uniqueId\": \"XXDNW8FIJPUSIZHR\", \"reference\": \"VASMTN1742643891701345959832\"}, \"reference\": \"VASMTN1742643891701345959832\", \"responseCode\": \"00\", \"transactionStatus\": \"successful\"}',1,NULL,'1.0.4','HorizonPay K11','2023-11-30 13:05:59','2023-11-30 13:06:00'),(2,4,3,6,58.88,0.00,58.88,'231201111710',NULL,'111710',NULL,NULL,NULL,NULL,NULL,NULL,'PENDING','POS',NULL,NULL,0,0,'1.0.4','HorizonPay K11','2023-12-01 11:17:11',NULL),(3,4,3,6,50.00,0.00,50.00,'231201115058',NULL,'115058',NULL,NULL,NULL,NULL,NULL,NULL,'PENDING','POS',NULL,NULL,0,0,'1.0.4','HorizonPay K11','2023-12-01 11:50:59',NULL),(4,4,3,6,58.80,0.00,58.80,'231201115524',NULL,'115524',NULL,NULL,NULL,NULL,NULL,NULL,'PENDING','POS',NULL,NULL,0,0,'1.0.4','HorizonPay K11','2023-12-01 11:55:25',NULL),(5,4,3,6,566.88,0.00,566.88,'231201115853',NULL,'115853',NULL,NULL,NULL,NULL,NULL,NULL,'PENDING','POS',NULL,NULL,0,0,'1.0.4','HorizonPay K11','2023-12-01 11:58:54',NULL),(6,4,3,6,56.58,0.00,56.58,'231201120007','13','120007',NULL,NULL,NULL,NULL,'Invalid amount',NULL,'FAILED','POS','SpoutSwitch','{\"aid\": \"A0000003710001\", \"pan\": \"506109*********214\", \"rrn\": \"231201120007\", \"tid\": \"2SPL0002\", \"tsi\": \"E800\", \"tvr\": \"4280048000\", \"stan\": \"120007\", \"authCode\": \"0\", \"expireDate\": \"2405\", \"holderName\": \"DEBIT/VERVE\", \"responseCode\": \"13\"}',0,0,'1.0.4','HorizonPay K11','2023-12-01 12:00:08','2023-12-01 12:00:08'),(7,4,3,6,100.00,0.00,100.00,'231201120029','55','120029',NULL,NULL,NULL,NULL,'Incorrect PIN',NULL,'FAILED','POS','SpoutSwitch','{\"aid\": \"A0000003710001\", \"pan\": \"506109*********214\", \"rrn\": \"231201120029\", \"tid\": \"2SPL0002\", \"tsi\": \"E800\", \"tvr\": \"4280048000\", \"stan\": \"120029\", \"authCode\": \"0\", \"expireDate\": \"2405\", \"holderName\": \"DEBIT/VERVE\", \"responseCode\": \"55\"}',0,0,'1.0.4','HorizonPay K11','2023-12-01 12:00:30','2023-12-01 12:00:33'),(8,4,3,6,10.00,0.00,10.00,'231201120909','13','120909',NULL,NULL,NULL,NULL,'Invalid amount',NULL,'FAILED','POS','SpoutSwitch','{\"aid\": \"A0000003710001\", \"pan\": \"506109*********214\", \"rrn\": \"231201120909\", \"tid\": \"2SPL0002\", \"tsi\": \"E800\", \"tvr\": \"4280048000\", \"stan\": \"120909\", \"authCode\": \"0\", \"expireDate\": \"2405\", \"holderName\": \"DEBIT/VERVE\", \"responseCode\": \"13\"}',0,0,'1.0.4','HorizonPay K11','2023-12-01 12:09:10','2023-12-01 12:09:10'),(9,4,3,6,50.00,0.00,50.00,'231201120929','13','120929',NULL,NULL,NULL,NULL,'Invalid amount',NULL,'FAILED','POS','SpoutSwitch','{\"aid\": \"A0000003710001\", \"pan\": \"506109*********214\", \"rrn\": \"231201120929\", \"tid\": \"2SPL0002\", \"tsi\": \"E800\", \"tvr\": \"4280048000\", \"stan\": \"120929\", \"authCode\": \"0\", \"expireDate\": \"2405\", \"holderName\": \"DEBIT/VERVE\", \"responseCode\": \"13\"}',0,0,'1.0.4','HorizonPay K11','2023-12-01 12:09:30','2023-12-01 12:09:30'),(10,4,3,6,1000.00,0.00,1000.00,'231201120949','55','120949',NULL,NULL,NULL,NULL,'Incorrect PIN',NULL,'FAILED','POS','SpoutSwitch','{\"aid\": \"A0000003710001\", \"pan\": \"506109*********214\", \"rrn\": \"231201120949\", \"tid\": \"2SPL0002\", \"tsi\": \"E800\", \"tvr\": \"4280048000\", \"stan\": \"120949\", \"authCode\": \"0\", \"expireDate\": \"2405\", \"holderName\": \"DEBIT/VERVE\", \"responseCode\": \"55\"}',0,0,'1.0.4','HorizonPay K11','2023-12-01 12:09:50','2023-12-01 12:09:51'),(11,3,2,6,100.00,0.00,100.00,'231201144228',NULL,'144228',NULL,NULL,NULL,NULL,NULL,NULL,'PENDING','POS',NULL,NULL,0,0,'1.0.4','HorizonPay K11','2023-12-01 14:42:28',NULL),(12,3,2,6,50.00,0.00,50.00,'231201144318',NULL,'144318',NULL,NULL,NULL,NULL,NULL,NULL,'PENDING','POS',NULL,NULL,0,0,'1.0.4','HorizonPay K11','2023-12-01 14:43:18',NULL),(13,3,2,6,50.00,0.00,50.00,'231202092023',NULL,'092023',NULL,NULL,NULL,NULL,NULL,NULL,'PENDING','POS',NULL,NULL,0,0,'1.0.4','HorizonPay K11','2023-12-02 09:20:24',NULL),(14,3,2,6,50.00,0.00,50.00,'231202110415','13','110415',NULL,NULL,NULL,NULL,'Invalid amount',NULL,'FAILED','POS','SpoutSwitch','{\"aid\": \"A0000000041010\", \"pan\": \"539983*******787\", \"rrn\": \"231202110415\", \"tid\": \"2SPL0002\", \"tsi\": \"E800\", \"tvr\": \"0080048000\", \"stan\": \"110415\", \"authCode\": \"0\", \"expireDate\": \"2703\", \"holderName\": \"SEGUN/SANUSI\", \"responseCode\": \"13\"}',0,0,'1.0.4','HorizonPay K11','2023-12-02 11:04:15','2023-12-02 11:04:16'),(15,3,2,6,100.00,0.00,100.00,'231202110443','00','110443',NULL,NULL,NULL,NULL,'Approved or completed successfully',NULL,'SUCCESSFUL','POS','SpoutSwitch','{\"aid\": \"A0000000041010\", \"pan\": \"539983*******787\", \"rrn\": \"231202110443\", \"tid\": \"2SPL0002\", \"tsi\": \"E800\", \"tvr\": \"0080048000\", \"stan\": \"110443\", \"authCode\": \"UNI000\", \"expireDate\": \"2703\", \"holderName\": \"SEGUN/SANUSI\", \"responseCode\": \"00\"}',0,1,'1.0.4','HorizonPay K11','2023-12-02 11:04:44','2023-12-02 11:04:47'),(16,3,2,6,50.00,0.00,50.00,'231203175458','13','175458',NULL,NULL,NULL,NULL,'Invalid amount',NULL,'FAILED','POS','SpoutSwitch','{\"aid\": \"A0000000041010\", \"pan\": \"539983*******787\", \"rrn\": \"231203175458\", \"tid\": \"2SPL0002\", \"tsi\": \"E800\", \"tvr\": \"0080048000\", \"stan\": \"175458\", \"authCode\": \"0\", \"expireDate\": \"2703\", \"holderName\": \"SEGUN/SANUSI\", \"responseCode\": \"13\"}',0,0,'1.0.4','HorizonPay K11','2023-12-03 17:54:59','2023-12-03 17:54:59'),(17,3,2,6,100.00,0.00,100.00,'231203175526','00','175526',NULL,NULL,NULL,NULL,'Approved or completed successfully',NULL,'SUCCESSFUL','POS','SpoutSwitch','{\"aid\": \"A0000000041010\", \"pan\": \"539983*******787\", \"rrn\": \"231203175526\", \"tid\": \"2SPL0002\", \"tsi\": \"E800\", \"tvr\": \"0080048000\", \"stan\": \"175526\", \"authCode\": \"UNI000\", \"expireDate\": \"2703\", \"holderName\": \"SEGUN/SANUSI\", \"responseCode\": \"00\"}',0,1,'1.0.4','HorizonPay K11','2023-12-03 17:55:27','2023-12-03 17:55:28'),(18,3,2,2,100.00,0.00,100.00,'YPWVH3FUGDH07CG3',NULL,NULL,NULL,NULL,NULL,NULL,'Airtime purchase of MTN - ₦100.00 for 07032703085',NULL,'SUCCESSFUL','POS','SPOUT','{\"message\": \"Successful\", \"response\": {\"amount\": 100, \"account\": \"07032703085\", \"reversal\": false, \"uniqueId\": \"YPWVH3FUGDH07CG3\", \"reference\": \"VASMTN1742643891701626399198\"}, \"reference\": \"VASMTN1742643891701626399198\", \"responseCode\": \"00\", \"transactionStatus\": \"successful\"}',1,NULL,'1.0.4','HorizonPay K11','2023-12-03 18:59:58','2023-12-03 19:00:00'),(19,4,3,6,50.00,0.00,50.00,'231207054159','13','054159',NULL,NULL,NULL,NULL,'Invalid amount',NULL,'FAILED','POS','SpoutSwitch','{\"aid\": \"A0000003710001\", \"pan\": \"506109*********214\", \"rrn\": \"231207054159\", \"tid\": \"2SPL0002\", \"tsi\": \"E800\", \"tvr\": \"4280048000\", \"stan\": \"054159\", \"authCode\": \"0\", \"expireDate\": \"2405\", \"holderName\": \"DEBIT/VERVE\", \"responseCode\": \"13\"}',0,0,'1.0.4','HorizonPay K11','2023-12-07 05:41:59','2023-12-07 05:42:00'),(20,4,3,6,50.00,0.00,50.00,'231207075708','13','075708',NULL,NULL,NULL,NULL,'Invalid amount',NULL,'FAILED','POS','SpoutSwitch','{\"aid\": \"A0000003710001\", \"pan\": \"506109*********214\", \"rrn\": \"231207075708\", \"tid\": \"2SPL0002\", \"tsi\": \"E800\", \"tvr\": \"4280048000\", \"stan\": \"075708\", \"authCode\": \"0\", \"expireDate\": \"2405\", \"holderName\": \"DEBIT/VERVE\", \"responseCode\": \"13\"}',0,0,'1.0.4','HorizonPay K11','2023-12-07 07:57:09','2023-12-07 07:57:09'),(21,4,3,6,50.00,0.00,50.00,'231207080500','13','080500',NULL,NULL,NULL,NULL,'Invalid amount',NULL,'FAILED','POS','SpoutSwitch','{\"aid\": \"A0000000041010\", \"pan\": \"539983*******512\", \"rrn\": \"231207080500\", \"tid\": \"2SPL0002\", \"tsi\": \"E800\", \"tvr\": \"0080048000\", \"stan\": \"080500\", \"authCode\": \"0\", \"expireDate\": \"2603\", \"holderName\": \"CANAAN/ETAIGBENU\", \"responseCode\": \"13\"}',0,0,'1.0.4','HorizonPay K11','2023-12-07 08:05:00','2023-12-07 08:05:01');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,NULL,'Irpay','Admin','admin@irpay.com','08081234567','MALE',NULL,NULL,'Nigeria',NULL,'ACTIVE',NULL,NULL,NULL,'2023-11-30 12:12:31','2023-11-30 08:41:39','$2y$10$qjW3uwSAgCLsylfdg0CocOWunp6XZ2S7OoDVnBr.NAUgFE.wV8Vu.','eLmR6e5pocEV0PKW7K2hW9U5inCQ7JtjQEHGdkopCmi4o5xq21yLRqnfeiY0','2023-11-30 08:41:39','2023-11-30 12:12:31',NULL),(2,1,NULL,'Webster','John','johnwebster221@gmail.com','08107042127','MALE','1993-06-24','Lagos','Nigeria','9, Onitire road','ACTIVE',NULL,'1234567890',NULL,NULL,NULL,'$2y$10$heYsitnTamjZi6Y9b82DiuJ1ZIxbZ/j9puvyDgWCQ3qiYlbOGlLE.',NULL,'2023-11-30 08:46:23','2023-11-30 08:47:23',NULL),(3,1,NULL,'Sanusi','Segun','canaan@gmail.com','08107042122','MALE','2013-05-21','Lagos','Nigeria','23, Olutosin Ajayi','ACTIVE',NULL,'1245879762',NULL,NULL,NULL,'$2y$10$r/TYn5ieUyGWJnyVXizVq.qnIs//9oD9Ip44wdrP5zR0aMGfRgbxO',NULL,'2023-11-30 09:21:46','2023-12-01 10:20:31',NULL),(4,1,NULL,'Sanusi','David','segsan4u@gmail.com','08036830944','MALE','2013-11-30','Lagos','Nigeria','3 freedom','ACTIVE',NULL,'258036985',NULL,NULL,NULL,'$2y$10$xEC37LYiDerprQEpnhlDOew38YxY53NfFBKphGZlnqrSKGiabJYg6',NULL,'2023-11-30 13:44:31','2023-11-30 13:59:03',NULL);
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
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `type` enum('TRANSACTION','CHARGE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'TRANSACTION',
  `info` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallet_transactions`
--

LOCK TABLES `wallet_transactions` WRITE;
/*!40000 ALTER TABLE `wallet_transactions` DISABLE KEYS */;
INSERT INTO `wallet_transactions` VALUES (1,8,2,'traTZCshCXZ8g5g',1000.00,0.00,1000.00,'SUCCESSFUL','CREDIT','TRANSACTION','Test - By Irpay Admin','2023-11-30 08:48:38','2023-11-30 08:48:38'),(2,8,3,'trariBVNCLkgT6Y',1000.00,0.00,1000.00,'SUCCESSFUL','CREDIT','TRANSACTION','Test - By Irpay Admin','2023-11-30 12:48:25','2023-11-30 12:48:25'),(3,8,2,'tra7cQZUTBmJ31O',1000.00,1000.00,2000.00,'SUCCESSFUL','CREDIT','TRANSACTION','Test - By Irpay Admin','2023-11-30 12:48:29','2023-11-30 12:48:29'),(4,2,3,'XXDNW8FIJPUSIZHR',50.00,1000.00,950.00,'SUCCESSFUL','DEBIT','TRANSACTION','Airtime purchase of MTN - ₦50.00 for 08107042127','2023-11-30 13:05:59','2023-11-30 13:05:59'),(5,6,3,'231202110443',100.00,950.00,1050.00,'SUCCESSFUL','CREDIT','TRANSACTION','CASHOUT/WITHDRAWAL of ₦100.0 from debit card 539983*******787(01)','2023-12-02 11:04:47',NULL),(6,6,3,'231203175526',100.00,1050.00,1150.00,'SUCCESSFUL','CREDIT','TRANSACTION','CASHOUT/WITHDRAWAL of ₦100.0 from debit card 539983*******787(01)','2023-12-03 17:55:28',NULL),(7,2,3,'YPWVH3FUGDH07CG3',100.00,1150.00,1050.00,'SUCCESSFUL','DEBIT','TRANSACTION','Airtime purchase of MTN - ₦100.00 for 07032703085','2023-12-03 18:59:58','2023-12-03 18:59:58');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` VALUES (1,'00000000-8f53-21ee-b300-cae0951c884d',1,'8081234567',0.00,0.00,'ACTIVE',0,NULL,'2023-11-30 08:41:39','2023-11-30 08:41:39'),(2,'00000021-8f54-21ee-9600-cae0951c884d',2,'8107042127',2000.00,0.00,'ACTIVE',0,NULL,'2023-11-30 08:46:23','2023-11-30 12:48:29'),(3,'00000021-8f59-21ee-ad00-cae0951c884d',3,'8107042122',1050.00,0.00,'ACTIVE',0,NULL,'2023-11-30 09:21:46','2023-12-03 18:59:58'),(4,'00000021-8f7e-21ee-8a00-cae0951c884d',4,'8036830944',0.00,0.00,'ACTIVE',0,NULL,'2023-11-30 13:44:31','2023-11-30 13:44:31');
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

-- Dump completed on 2023-12-07  8:54:07
