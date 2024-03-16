-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: emu_bid
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
-- Table structure for table `bid`
--

DROP TABLE IF EXISTS `bid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bid` (
  `bid_id` bigint NOT NULL AUTO_INCREMENT,
  `bid_no` varchar(20) DEFAULT NULL,
  `bid_name` varchar(50) NOT NULL,
  `bid_owner` varchar(50) NOT NULL,
  `open_date` datetime NOT NULL,
  `Deadline` datetime NOT NULL,
  `prepared_by` bigint NOT NULL,
  `assigned_to` bigint NOT NULL,
  PRIMARY KEY (`bid_id`),
  KEY `prepared_by` (`prepared_by`),
  KEY `assigned_to` (`assigned_to`),
  CONSTRAINT `bid_ibfk_1` FOREIGN KEY (`prepared_by`) REFERENCES `users` (`id`),
  CONSTRAINT `bid_ibfk_2` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bid`
--

LOCK TABLES `bid` WRITE;
/*!40000 ALTER TABLE `bid` DISABLE KEYS */;
INSERT INTO `bid` VALUES (26,'Unicef_001','Unicef Project Child','uniceff','1970-01-01 01:00:00','1970-01-01 01:00:00',8,9),(27,'Fifa01','FIFA Project Ultra h','FIFA','2024-02-21 01:00:00','2024-03-01 01:00:00',8,10),(28,'WHO912','WHO Project','WHO','2024-02-21 01:00:00','2024-03-03 01:00:00',8,10);
/*!40000 ALTER TABLE `bid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) DEFAULT NULL,
  `user_name` varchar(25) NOT NULL,
  `password` varchar(80) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL,
  `doc_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (8,'15652120992801690694','eyosi','$2y$10$rKCrABvUu8759.wmS/ltY.VlOwHXpe1CSkJlChQ3rlXkIyGRTGbGG','eyosiyas','feleke','451215646','negusu01@gmail.com','2','2024-02-20 04:02:32','Active'),(9,'87044691','jo','$2y$10$XYrbxg0IqS2TKentthhnTOOebLnll3dO5xDxRqEu0T8HlApS.OXH2','yohannes','feleke','+251912608380','yohannes_it@abhpartners.com','2','2024-02-21 05:01:35','Active'),(10,'4986','admin','$2y$10$tcynGljjsxFgTXUYV5mkU.kge8GeYLhJue988UePr1yBZJt8mIl0.','Negusu','Wondimu','+251912608380','negusu01@gmail.com','1','2024-02-21 05:09:58','Active');
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

-- Dump completed on 2024-03-04  8:42:23
