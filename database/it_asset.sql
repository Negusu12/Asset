-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: it_asset_test
-- ------------------------------------------------------
-- Server version	8.0.29

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `asset_loan`
--

DROP TABLE IF EXISTS `asset_loan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asset_loan` (
  `loan_id` int NOT NULL AUTO_INCREMENT,
  `item_code` int DEFAULT NULL,
  `employee_id` int DEFAULT NULL,
  `qty_taken` int DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `doc_date` datetime DEFAULT NULL,
  `description` longtext,
  `user_name` varchar(45) DEFAULT NULL,
  `serial_no` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`loan_id`),
  KEY `item_code` (`item_code`),
  KEY `employee_id` (`employee_id`),
  CONSTRAINT `asset_loan_ibfk_1` FOREIGN KEY (`item_code`) REFERENCES `asset_record` (`item_code`),
  CONSTRAINT `asset_loan_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_loan`
--

LOCK TABLES `asset_loan` WRITE;
/*!40000 ALTER TABLE `asset_loan` DISABLE KEYS */;
INSERT INTO `asset_loan` VALUES (90,28,48,1,1,'2024-02-22 00:00:00','ለሰኒ ፊክሩ የተሰጠ(PSNP)','Yohannes',NULL),(91,28,71,1,1,'2023-12-19 00:00:00','PSNP ','Yohannes',NULL),(92,28,70,1,1,'2023-06-30 00:00:00','PSNP and with mouth','Yohannes',NULL),(93,28,69,1,1,'2023-06-30 00:00:00','PSNP and with mouth','Yohannes',NULL),(94,28,68,1,1,'2023-06-30 00:00:00','PSNP and with mouth','Yohannes',NULL),(95,28,67,1,1,'2023-06-30 00:00:00','PSNP and with mouth','Yohannes',NULL),(96,28,66,1,1,'2023-06-30 00:00:00','PSNP and with mouth','Yohannes',NULL),(97,28,65,1,1,'2023-06-30 00:00:00','PSNP and with mouth','Yohannes',NULL),(98,28,64,1,0,'2023-08-30 00:00:00','PSNP','Yohannes',NULL),(99,28,63,1,1,'2023-07-04 00:00:00','PSNP and with mouth','Yohannes',NULL),(100,28,62,1,1,'2023-07-03 00:00:00','PSNP and with mouth','Yohannes',NULL),(101,28,61,1,1,'2023-07-04 00:00:00','PSNP and with mouth','Yohannes',NULL),(102,28,60,1,1,'2023-07-05 00:00:00','PSNP and with mouth','Yohannes',NULL),(103,28,59,1,1,'2023-07-05 00:00:00','PSNP and with mouth','Yohannes',NULL),(104,28,58,1,1,'2023-07-05 00:00:00','PSNP and with mouth','Yohannes',NULL),(105,28,57,1,1,'2023-07-18 00:00:00','Pharma ','Yohannes',NULL),(106,28,56,1,1,'2023-08-11 00:00:00','Girma (General Service)','Yohannes',NULL),(107,28,55,1,1,'2023-03-03 00:00:00','','Yohannes',NULL),(108,28,54,1,1,'2022-11-14 00:00:00','Project(Nutrition), with Mouse','Yohannes',NULL),(109,28,51,1,1,'2023-03-10 00:00:00','','Yohannes',NULL),(110,28,49,1,1,'2023-07-09 00:00:00','','Yohannes',NULL),(111,25,53,1,1,'2020-05-14 00:00:00','','Yohannes',NULL),(112,25,52,1,1,'2019-06-10 00:00:00','ለዋሺንግተን የተሰጠ','Yohannes',NULL),(113,31,73,48,48,'2022-06-06 00:00:00','PSNP Field ላይ የተሰጠ','Yohannes',NULL),(114,31,74,42,42,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(115,31,75,30,30,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(116,31,76,30,30,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(117,31,65,42,42,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(118,31,77,42,42,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(119,31,60,36,36,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(120,31,78,24,24,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(121,31,79,30,30,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(122,31,61,42,42,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(123,31,71,42,42,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(124,31,80,36,36,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(125,31,81,42,42,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(126,31,82,36,36,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(127,31,62,36,36,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(128,31,83,42,42,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(129,31,84,36,36,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(130,31,85,42,42,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(131,31,86,42,42,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(132,31,87,36,36,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(133,31,88,36,36,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(134,31,89,36,36,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(135,31,68,36,36,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(136,31,67,36,36,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(137,31,70,36,36,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(138,31,90,36,36,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(139,31,91,36,36,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(140,31,92,36,36,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(141,31,69,36,36,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(142,31,66,42,42,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(143,31,58,36,36,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(144,31,93,42,42,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(145,31,94,36,36,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(146,31,95,36,36,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(147,31,96,36,36,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(148,31,97,42,42,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(149,31,98,42,42,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(150,31,99,36,36,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(151,31,100,30,30,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(152,31,101,1,1,'2022-06-06 00:00:00','','Yohannes',NULL),(153,31,102,1,1,'2022-06-06 00:00:00','','Yohannes',NULL),(154,31,103,1,1,'2022-06-06 00:00:00','','Yohannes',NULL),(155,25,104,1,1,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(156,27,53,1,1,'2024-03-05 00:00:00','aaaaaa','Negusu','12354879');
/*!40000 ALTER TABLE `asset_loan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `asset_loan_v`
--

DROP TABLE IF EXISTS `asset_loan_v`;
/*!50001 DROP VIEW IF EXISTS `asset_loan_v`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `asset_loan_v` AS SELECT 
 1 AS `loan_id`,
 1 AS `item_code`,
 1 AS `item_name`,
 1 AS `item_condition`,
 1 AS `full_name`,
 1 AS `uom`,
 1 AS `qty`,
 1 AS `qty_taken`,
 1 AS `doc_date`,
 1 AS `description`,
 1 AS `user_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `asset_record`
--

DROP TABLE IF EXISTS `asset_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asset_record` (
  `item_code` int NOT NULL AUTO_INCREMENT,
  `item_c` varchar(45) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_condition` varchar(45) DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `doc_date` datetime DEFAULT NULL,
  `description` longtext,
  `user_name` varchar(45) DEFAULT NULL,
  `uom` varchar(15) DEFAULT NULL,
  `item_category` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`item_code`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_record`
--

LOCK TABLES `asset_record` WRITE;
/*!40000 ALTER TABLE `asset_record` DISABLE KEYS */;
INSERT INTO `asset_record` VALUES (24,'TECNO_TAB_F','TECNO TAB','Functional',16,'2024-02-07 00:00:00','','jo','Each','tablet'),(25,'TOSHIBA_LAPTOP_F','TOSHIBA LAPTOP','Functional',7,'2024-02-07 00:00:00','ስንቱ እንደሚሰራ አይታወቅም','jo','Each','laptop'),(27,'EPSON_PROJECTOR_F','EPSON PROJECTOR','Functional',1,'2024-02-07 00:00:00','','jo','Each','projector'),(28,'LENOVO_LAPTOP_F','LENOVO LAPTOP','Functional',1,'2024-03-04 00:00:00','','Yohannes','Each','laptop'),(29,'DeDsk9010','Dell Desktop 9010','Functional',21,'2024-03-04 00:00:00','','Yohannes','Each','all_in_one_desktop'),(30,'DeDsk9020','Dell Desktop 9020','Functional',0,'2024-03-04 00:00:00','','Yohannes','Each','all_in_one_desktop'),(31,'ABH_TAB_F','ABH TAB','Functional',39,'2019-03-04 00:00:00','ተገዝተው የገቡ አጠቃላይ black tabs','Yohannes','Each','tablet'),(32,'Kuame Kirby','Linda Romero','Damaged',0,'2005-03-26 00:00:00','Germane Austin','Negusu','Meter','5'),(33,'Leonard Baxter','Carl Santos','Damaged and Non-Functional',0,'1983-02-20 00:00:00','Adara Castaneda','Negusu','Each','pc');
/*!40000 ALTER TABLE `asset_record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asset_return`
--

DROP TABLE IF EXISTS `asset_return`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asset_return` (
  `return_id` int NOT NULL AUTO_INCREMENT,
  `loan_id` int DEFAULT NULL,
  `employee_id` int DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `doc_date` datetime DEFAULT NULL,
  `description` longtext,
  `item_code` int DEFAULT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`return_id`),
  KEY `loan_id` (`loan_id`),
  KEY `item_code` (`item_code`),
  CONSTRAINT `asset_return_ibfk_1` FOREIGN KEY (`loan_id`) REFERENCES `asset_loan` (`loan_id`),
  CONSTRAINT `asset_return_ibfk_2` FOREIGN KEY (`item_code`) REFERENCES `asset_record` (`item_code`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_return`
--

LOCK TABLES `asset_return` WRITE;
/*!40000 ALTER TABLE `asset_return` DISABLE KEYS */;
INSERT INTO `asset_return` VALUES (37,98,64,1,'2024-03-04 00:00:00','Power Cable missing!!! claster 7(Ask Feven)',28,'Yohannes');
/*!40000 ALTER TABLE `asset_return` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `asset_return_v`
--

DROP TABLE IF EXISTS `asset_return_v`;
/*!50001 DROP VIEW IF EXISTS `asset_return_v`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `asset_return_v` AS SELECT 
 1 AS `return_id`,
 1 AS `loan_id`,
 1 AS `item_name`,
 1 AS `item_condition`,
 1 AS `full_name`,
 1 AS `uom`,
 1 AS `qty`,
 1 AS `doc_date`,
 1 AS `description`,
 1 AS `user_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `buy_asset`
--

DROP TABLE IF EXISTS `buy_asset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `buy_asset` (
  `b_asset` int NOT NULL AUTO_INCREMENT,
  `item_code` int NOT NULL,
  `qty` int NOT NULL,
  `doc_date` datetime NOT NULL,
  `description` longtext,
  `user_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`b_asset`),
  KEY `item_code` (`item_code`),
  CONSTRAINT `buy_asset_ibfk_1` FOREIGN KEY (`item_code`) REFERENCES `asset_record` (`item_code`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buy_asset`
--

LOCK TABLES `buy_asset` WRITE;
/*!40000 ALTER TABLE `buy_asset` DISABLE KEYS */;
INSERT INTO `buy_asset` VALUES (22,24,16,'2024-02-07 00:00:00','ገች ጋር ያሉ የተመለሱ አዲሶቹ ታቦች(ቢሮ ሊታደስ ሲል የቆጠርናቸው)','jo'),(23,25,7,'2024-02-07 00:00:00','ስንቱ እንደሚሰራ አይታወቅም እና 3 ቻርጀር ብቻ ነው ያላቸው','jo'),(25,27,2,'2024-02-07 00:00:00','','jo'),(28,28,17,'2024-03-04 00:00:00','ከዋሺንግተን የመጣ','Yohannes'),(29,28,6,'2024-03-04 00:00:00','ገች ጋር የነበሩ','Yohannes'),(30,25,2,'2024-03-04 00:00:00','','Yohannes'),(31,29,21,'2024-03-04 00:00:00','ላይብረሪ ያሉ Desktop 9010','Yohannes'),(32,31,1500,'2019-03-04 00:00:00','አጠቃላይ ተገዝተው የገቡ Black Tabs','Yohannes'),(33,25,1,'2022-06-06 00:00:00','','Yohannes');
/*!40000 ALTER TABLE `buy_asset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `buy_asset_report`
--

DROP TABLE IF EXISTS `buy_asset_report`;
/*!50001 DROP VIEW IF EXISTS `buy_asset_report`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `buy_asset_report` AS SELECT 
 1 AS `b_asset`,
 1 AS `item_code`,
 1 AS `item_name`,
 1 AS `item_condition`,
 1 AS `uom`,
 1 AS `qty`,
 1 AS `doc_date`,
 1 AS `description`,
 1 AS `user_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `drop_down_list`
--

DROP TABLE IF EXISTS `drop_down_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `drop_down_list` (
  `list_id` int NOT NULL AUTO_INCREMENT,
  `department` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `uom` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drop_down_list`
--

LOCK TABLES `drop_down_list` WRITE;
/*!40000 ALTER TABLE `drop_down_list` DISABLE KEYS */;
INSERT INTO `drop_down_list` VALUES (1,'Information Technology','',NULL),(2,'','laptop',NULL),(3,'','Switch',NULL),(4,'Operation','',NULL),(5,'','pc',NULL),(6,'Finance','',NULL),(7,'','','Package'),(8,'','','Meter');
/*!40000 ALTER TABLE `drop_down_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employee` (
  `employee_id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (47,'PSNP','hr'),(48,'Bontu','hr'),(49,'Feven','hr'),(50,'Feven Tesfaye','hr'),(51,'Lensa Chala','Research'),(52,'Dereje(WMC)','others'),(53,'Yigzaw Kebede','Research'),(54,'Shiferaw Fussum','project'),(55,'Tesfaye Koji','Pharma'),(56,'Girma Chane','Operation'),(57,'Lidiya Dula','Pharma'),(58,'Juki Muluneh','hr'),(59,'Alemayehu Derse','hr'),(60,'Tolosa Benti','hr'),(61,'Mergitu Ephrem','hr'),(62,'Bekele Regasa','hr'),(63,'Natnael Solomon','hr'),(64,'Ayenew Washelign','hr'),(65,'Mastewal Amare','hr'),(66,'Biniyam Bihonegn','hr'),(67,'Desta Yirsie','hr'),(68,'Nardos Sintayew','hr'),(69,'Hana Tisase','hr'),(70,'Etsegenet Tsidu','hr'),(71,'Ashebir Hunegnaw','hr'),(72,'Bontu Berhane','hr'),(73,'Bisrat Desalegn','hr'),(74,'Natnael Wendemagenew','hr'),(75,'Mahider Tilahun','hr'),(76,'Abdulkadir gelgelu','hr'),(77,'Abdisa Gyrmessa','hr'),(78,'Naol Abay','hr'),(79,'Segni Fikiru','hr'),(80,'Hundaol Tefera','hr'),(81,'Yidideya Asrat','hr'),(82,'Hiwot Animo','hr'),(83,'Desalegn Beachew','hr'),(84,'Abel Adugna','hr'),(85,'Kasahun Shumetie','hr'),(86,'Aschalew Getu','hr'),(87,'Abenezer wassie','hr'),(88,'Dawit Getaneh','hr'),(89,'Tsion Temesgen','hr'),(90,'Natnael Tamin','hr'),(91,'Giorgis Girma','hr'),(92,'Bezawit W/Yohannes','hr'),(93,'Tahire Aliye','hr'),(94,'Robsan Bekele','hr'),(95,'Dinka Geleta','hr'),(96,'Sheleme Tesfaye','hr'),(97,'Biniyam Amensa','hr'),(98,'Mengistu Girma','hr'),(99,'Tariku Ayalew','hr'),(100,'Teshome Zikarye','hr'),(101,'Desta Werash','hr'),(102,'Melaku Kassa','hr'),(103,'Abel Tesfaye','hr'),(104,'Amiti Abasimel','hr');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `use_asset`
--

DROP TABLE IF EXISTS `use_asset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `use_asset` (
  `u_asset` int NOT NULL AUTO_INCREMENT,
  `item_code` int NOT NULL,
  `qty` int NOT NULL,
  `doc_date` datetime NOT NULL,
  `description` longtext,
  `user_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`u_asset`),
  KEY `item_code` (`item_code`),
  CONSTRAINT `use_asset_ibfk_1` FOREIGN KEY (`item_code`) REFERENCES `asset_record` (`item_code`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `use_asset`
--

LOCK TABLES `use_asset` WRITE;
/*!40000 ALTER TABLE `use_asset` DISABLE KEYS */;
INSERT INTO `use_asset` VALUES (21,28,2,'2024-03-04 00:00:00','በስተት የገባ','Yohannes');
/*!40000 ALTER TABLE `use_asset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `used_asset_report`
--

DROP TABLE IF EXISTS `used_asset_report`;
/*!50001 DROP VIEW IF EXISTS `used_asset_report`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `used_asset_report` AS SELECT 
 1 AS `u_asset`,
 1 AS `item_code`,
 1 AS `item_name`,
 1 AS `item_condition`,
 1 AS `uom`,
 1 AS `qty`,
 1 AS `doc_date`,
 1 AS `description`,
 1 AS `user_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `role` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (15,201583,'Yohannes','$2y$10$9mWQQmBAbQlj0KCt4lNSL.W21l2qtdrinDIiAdxQYa6wj82a.Wbma',NULL,'2'),(16,85387,'Negusu','$2y$10$ZpCSc8Zgr6yaUfPaIvnNoe1.3wepALf8fsewjMubxjBp8toqUDYmq',NULL,'1'),(17,58586543133683,'Zerihun','$2y$10$.MGK5zDXqYuRrd6JaySE5uuKG6OGJrjaDtADySiuAxbvDOMYvqLWe',NULL,'2'),(18,65300158,'Getachew','$2y$10$fW6CR3rtA3wZOZK.mAxPgOs8GpoSpXREv.n2YKpXPQOwRmnNIHAVu',NULL,'1');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `asset_loan_v`
--

/*!50001 DROP VIEW IF EXISTS `asset_loan_v`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `asset_loan_v` AS select `al`.`loan_id` AS `loan_id`,`al`.`item_code` AS `item_code`,`ar`.`item_name` AS `item_name`,`ar`.`item_condition` AS `item_condition`,`e`.`full_name` AS `full_name`,`ar`.`uom` AS `uom`,`al`.`qty` AS `qty`,`al`.`qty_taken` AS `qty_taken`,`al`.`doc_date` AS `doc_date`,`al`.`description` AS `description`,`al`.`user_name` AS `user_name` from ((`asset_loan` `al` left join `asset_record` `ar` on((`al`.`item_code` = `ar`.`item_code`))) left join `employee` `e` on((`al`.`employee_id` = `e`.`employee_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `asset_return_v`
--

/*!50001 DROP VIEW IF EXISTS `asset_return_v`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `asset_return_v` AS select `ar`.`return_id` AS `return_id`,`ar`.`loan_id` AS `loan_id`,`are`.`item_name` AS `item_name`,`are`.`item_condition` AS `item_condition`,`e`.`full_name` AS `full_name`,`are`.`uom` AS `uom`,`ar`.`qty` AS `qty`,`ar`.`doc_date` AS `doc_date`,`ar`.`description` AS `description`,`ar`.`user_name` AS `user_name` from ((`asset_return` `ar` left join `asset_record` `are` on((`ar`.`item_code` = `are`.`item_code`))) left join `employee` `e` on((`ar`.`employee_id` = `e`.`employee_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `buy_asset_report`
--

/*!50001 DROP VIEW IF EXISTS `buy_asset_report`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `buy_asset_report` AS select `al`.`b_asset` AS `b_asset`,`al`.`item_code` AS `item_code`,`ar`.`item_name` AS `item_name`,`ar`.`item_condition` AS `item_condition`,`ar`.`uom` AS `uom`,`al`.`qty` AS `qty`,`al`.`doc_date` AS `doc_date`,`al`.`description` AS `description`,`al`.`user_name` AS `user_name` from (`buy_asset` `al` left join `asset_record` `ar` on((`al`.`item_code` = `ar`.`item_code`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `used_asset_report`
--

/*!50001 DROP VIEW IF EXISTS `used_asset_report`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `used_asset_report` AS select `al`.`u_asset` AS `u_asset`,`al`.`item_code` AS `item_code`,`ar`.`item_name` AS `item_name`,`ar`.`item_condition` AS `item_condition`,`ar`.`uom` AS `uom`,`al`.`qty` AS `qty`,`al`.`doc_date` AS `doc_date`,`al`.`description` AS `description`,`al`.`user_name` AS `user_name` from (`use_asset` `al` left join `asset_record` `ar` on((`al`.`item_code` = `ar`.`item_code`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-05  5:22:20
