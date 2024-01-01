-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: asset
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
  PRIMARY KEY (`loan_id`),
  KEY `item_code` (`item_code`),
  KEY `employee_id` (`employee_id`),
  CONSTRAINT `asset_loan_ibfk_1` FOREIGN KEY (`item_code`) REFERENCES `asset_record` (`item_code`),
  CONSTRAINT `asset_loan_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_loan`
--

LOCK TABLES `asset_loan` WRITE;
/*!40000 ALTER TABLE `asset_loan` DISABLE KEYS */;
INSERT INTO `asset_loan` VALUES (82,14,44,1,1,'2023-08-01 00:00:00','with charger','Negusu');
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
  PRIMARY KEY (`item_code`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_record`
--

LOCK TABLES `asset_record` WRITE;
/*!40000 ALTER TABLE `asset_record` DISABLE KEYS */;
INSERT INTO `asset_record` VALUES (14,'LL01','Lenovo Laptop X230',NULL,16,'2023-08-01 00:00:00','With 17 Chargers and 2 non-functional cable','Negusu'),(15,'TabletAbh','Tablet ABH','Functional',99,'2023-08-05 00:00:00','Ketema - Functional Tablets','Negusu'),(16,'TabletAbh','Tablet ABH','Non Functional',26,'2023-08-05 00:00:00','','Negusu'),(17,'TabletAbh','Tablet ABH','Damaged or Non-Functional',27,'2023-08-05 00:00:00','It\'s either damaged or non functional','Negusu');
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_return`
--

LOCK TABLES `asset_return` WRITE;
/*!40000 ALTER TABLE `asset_return` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buy_asset`
--

LOCK TABLES `buy_asset` WRITE;
/*!40000 ALTER TABLE `buy_asset` DISABLE KEYS */;
INSERT INTO `buy_asset` VALUES (9,15,11,'2023-08-05 00:00:00','ketema - Damaged and Non Functional Tablets','Negusu'),(10,16,11,'2023-08-07 00:00:00','Ketema-->Damaged and Non Functional Tablets','Negusu'),(11,15,1,'2023-08-05 00:00:00','Ketema --> Functional','Negusu'),(12,16,15,'2023-08-05 00:00:00','Ketema--> Non Functional','Negusu'),(13,15,13,'2023-08-07 00:00:00','Feven --> With 9 functional charger and 4 non-functional charger','Negusu'),(14,17,10,'2023-08-07 00:00:00','Feven --> No charger','Negusu'),(15,15,4,'2023-08-07 00:00:00','Nati (PNSNP)-->No charger','Negusu'),(16,17,17,'2023-08-05 00:00:00','Nati (PNSNP)-->No charger','Negusu');
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
 1 AS `qty`,
 1 AS `doc_date`,
 1 AS `description`,
 1 AS `user_name`*/;
SET character_set_client = @saved_cs_client;

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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (44,'Lidiya Dula','Pharma');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (11,3876201,'Negusu','0906',NULL),(12,77458883,'yohannes','12qw!@QW',NULL),(13,1016658484506093528,'zerihun','1234',NULL);
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
/*!50001 VIEW `asset_loan_v` AS select `al`.`loan_id` AS `loan_id`,`al`.`item_code` AS `item_code`,`ar`.`item_name` AS `item_name`,`ar`.`item_condition` AS `item_condition`,`e`.`full_name` AS `full_name`,`al`.`qty` AS `qty`,`al`.`qty_taken` AS `qty_taken`,`al`.`doc_date` AS `doc_date`,`al`.`description` AS `description`,`al`.`user_name` AS `user_name` from ((`asset_loan` `al` left join `asset_record` `ar` on((`al`.`item_code` = `ar`.`item_code`))) left join `employee` `e` on((`al`.`employee_id` = `e`.`employee_id`))) */;
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
/*!50001 VIEW `asset_return_v` AS select `ar`.`return_id` AS `return_id`,`ar`.`loan_id` AS `loan_id`,`are`.`item_name` AS `item_name`,`are`.`item_condition` AS `item_condition`,`e`.`full_name` AS `full_name`,`ar`.`qty` AS `qty`,`ar`.`doc_date` AS `doc_date`,`ar`.`description` AS `description`,`ar`.`user_name` AS `user_name` from ((`asset_return` `ar` left join `asset_record` `are` on((`ar`.`item_code` = `are`.`item_code`))) left join `employee` `e` on((`ar`.`employee_id` = `e`.`employee_id`))) */;
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
/*!50001 VIEW `buy_asset_report` AS select `al`.`b_asset` AS `b_asset`,`al`.`item_code` AS `item_code`,`ar`.`item_name` AS `item_name`,`ar`.`item_condition` AS `item_condition`,`al`.`qty` AS `qty`,`al`.`doc_date` AS `doc_date`,`al`.`description` AS `description`,`al`.`user_name` AS `user_name` from (`buy_asset` `al` left join `asset_record` `ar` on((`al`.`item_code` = `ar`.`item_code`))) */;
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

-- Dump completed on 2024-01-01 10:08:16
