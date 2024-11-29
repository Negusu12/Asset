-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: it_asset
-- ------------------------------------------------------
-- Server version	8.0.37

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
-- Table structure for table `adjust_asset`
--

DROP TABLE IF EXISTS `adjust_asset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `adjust_asset` (
  `u_asset` int NOT NULL AUTO_INCREMENT,
  `item_code` int NOT NULL,
  `qty` int DEFAULT NULL,
  `doc_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` longtext,
  `user_name` varchar(45) DEFAULT NULL,
  `add_qty` int DEFAULT NULL,
  PRIMARY KEY (`u_asset`),
  KEY `item_code` (`item_code`),
  CONSTRAINT `adjust_asset_ibfk_1` FOREIGN KEY (`item_code`) REFERENCES `asset_record` (`item_code`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `item_condition` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`loan_id`),
  KEY `item_code` (`item_code`),
  KEY `employee_id` (`employee_id`),
  CONSTRAINT `asset_loan_ibfk_1` FOREIGN KEY (`item_code`) REFERENCES `asset_record` (`item_code`),
  CONSTRAINT `asset_loan_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=582 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
 1 AS `model`,
 1 AS `brand`,
 1 AS `item_type`,
 1 AS `item_category`,
 1 AS `item_condition`,
 1 AS `serial_no`,
 1 AS `borrower_title`,
 1 AS `full_name`,
 1 AS `department`,
 1 AS `location`,
 1 AS `uom`,
 1 AS `qty`,
 1 AS `qty_taken`,
 1 AS `doc_date`,
 1 AS `description`,
 1 AS `item_image`,
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
  `model` varchar(100) DEFAULT NULL,
  `brand` varchar(25) DEFAULT NULL,
  `item_type` varchar(10) DEFAULT NULL,
  `item_image` longblob,
  `u_doc_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `u_user_name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`item_code`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `asset_register_record`
--

DROP TABLE IF EXISTS `asset_register_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `asset_register_record` (
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
  `model` varchar(100) DEFAULT NULL,
  `brand` varchar(25) DEFAULT NULL,
  `item_type` varchar(10) DEFAULT NULL,
  `item_image` longblob,
  PRIMARY KEY (`item_code`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
 1 AS `brand`,
 1 AS `model`,
 1 AS `item_category`,
 1 AS `item_type`,
 1 AS `full_name`,
 1 AS `uom`,
 1 AS `qty`,
 1 AS `loned_date`,
 1 AS `return_date`,
 1 AS `description`,
 1 AS `user_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `asset_total_summury_v`
--

DROP TABLE IF EXISTS `asset_total_summury_v`;
/*!50001 DROP VIEW IF EXISTS `asset_total_summury_v`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `asset_total_summury_v` AS SELECT 
 1 AS `item_code`,
 1 AS `item_name`,
 1 AS `model`,
 1 AS `item_category`,
 1 AS `uom`,
 1 AS `total_store_qty`,
 1 AS `total_loan_qty`,
 1 AS `sum_qty`*/;
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
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
 1 AS `brand`,
 1 AS `model`,
 1 AS `item_category`,
 1 AS `item_type`,
 1 AS `uom`,
 1 AS `qty`,
 1 AS `doc_date`,
 1 AS `description`,
 1 AS `user_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `charges`
--

DROP TABLE IF EXISTS `charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `charges` (
  `charge_id` int NOT NULL AUTO_INCREMENT,
  `Charge` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` longtext,
  PRIMARY KEY (`charge_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `location` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `list_id` int DEFAULT NULL,
  `borrower_title` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`employee_id`),
  KEY `fk_location` (`list_id`),
  CONSTRAINT `fk_location` FOREIGN KEY (`list_id`) REFERENCES `drop_down_list` (`list_id`)
) ENGINE=InnoDB AUTO_INCREMENT=214 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `record_adjustment_report`
--

DROP TABLE IF EXISTS `record_adjustment_report`;
/*!50001 DROP VIEW IF EXISTS `record_adjustment_report`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `record_adjustment_report` AS SELECT 
 1 AS `u_asset`,
 1 AS `item_code`,
 1 AS `item_name`,
 1 AS `brand`,
 1 AS `model`,
 1 AS `item_category`,
 1 AS `uom`,
 1 AS `subtract_qty`,
 1 AS `add_qty`,
 1 AS `doc_date`,
 1 AS `description`,
 1 AS `user_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `sim_card_transactions`
--

DROP TABLE IF EXISTS `sim_card_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sim_card_transactions` (
  `transaction_id` int NOT NULL AUTO_INCREMENT,
  `current_holder` int DEFAULT NULL,
  `given_date` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `current_holder` (`current_holder`),
  CONSTRAINT `sim_card_transactions_ibfk_1` FOREIGN KEY (`current_holder`) REFERENCES `employee` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sim_card_transactions_line`
--

DROP TABLE IF EXISTS `sim_card_transactions_line`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sim_card_transactions_line` (
  `transaction_id_line` int NOT NULL AUTO_INCREMENT,
  `transaction_id` int DEFAULT NULL,
  `charge` int DEFAULT NULL,
  `owner` int DEFAULT NULL,
  `phone_number` varchar(25) DEFAULT NULL,
  `payment_period` varchar(25) NOT NULL,
  `expire_date` date DEFAULT NULL,
  `taken_date` date DEFAULT NULL,
  `payment_type` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `description_line` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`transaction_id_line`),
  KEY `transaction_id` (`transaction_id`),
  KEY `charge` (`charge`),
  KEY `owner` (`owner`),
  CONSTRAINT `sim_card_transactions_line_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `sim_card_transactions` (`transaction_id`),
  CONSTRAINT `sim_card_transactions_line_ibfk_2` FOREIGN KEY (`charge`) REFERENCES `charges` (`charge_id`),
  CONSTRAINT `sim_card_transactions_line_ibfk_3` FOREIGN KEY (`owner`) REFERENCES `employee` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Temporary view structure for view `store_loan_dash_v`
--

DROP TABLE IF EXISTS `store_loan_dash_v`;
/*!50001 DROP VIEW IF EXISTS `store_loan_dash_v`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `store_loan_dash_v` AS SELECT 
 1 AS `item_category`,
 1 AS `total_store_qty`,
 1 AS `total_loan_qty`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `total_item_qty_view`
--

DROP TABLE IF EXISTS `total_item_qty_view`;
/*!50001 DROP VIEW IF EXISTS `total_item_qty_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `total_item_qty_view` AS SELECT 
 1 AS `item_code`,
 1 AS `item_name`,
 1 AS `brand`,
 1 AS `model`,
 1 AS `item_category`,
 1 AS `item_type`,
 1 AS `uom`,
 1 AS `total_qty_record`,
 1 AS `total_qty_loan`,
 1 AS `total_qty_inactive`,
 1 AS `total_qty`*/;
SET character_set_client = @saved_cs_client;

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
 1 AS `brand`,
 1 AS `model`,
 1 AS `item_category`,
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
/*!50001 VIEW `asset_loan_v` AS select `al`.`loan_id` AS `loan_id`,`al`.`item_code` AS `item_code`,`ar`.`item_name` AS `item_name`,`ar`.`model` AS `model`,`ar`.`brand` AS `brand`,`ar`.`item_type` AS `item_type`,`ar`.`item_category` AS `item_category`,`al`.`item_condition` AS `item_condition`,`al`.`serial_no` AS `serial_no`,`e`.`borrower_title` AS `borrower_title`,`e`.`full_name` AS `full_name`,`e`.`department` AS `department`,`li`.`location` AS `location`,`ar`.`uom` AS `uom`,`al`.`qty` AS `qty`,`al`.`qty_taken` AS `qty_taken`,`al`.`doc_date` AS `doc_date`,`al`.`description` AS `description`,`ar`.`item_image` AS `item_image`,`al`.`user_name` AS `user_name` from (((`asset_loan` `al` left join `asset_record` `ar` on((`al`.`item_code` = `ar`.`item_code`))) left join `employee` `e` on((`al`.`employee_id` = `e`.`employee_id`))) left join `drop_down_list` `li` on((`li`.`list_id` = `e`.`list_id`))) */;
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
/*!50001 VIEW `asset_return_v` AS select `ar`.`return_id` AS `return_id`,`ar`.`loan_id` AS `loan_id`,`are`.`item_name` AS `item_name`,`are`.`brand` AS `brand`,`are`.`model` AS `model`,`are`.`item_category` AS `item_category`,`are`.`item_type` AS `item_type`,`e`.`full_name` AS `full_name`,`are`.`uom` AS `uom`,`ar`.`qty` AS `qty`,`al`.`doc_date` AS `loned_date`,`ar`.`doc_date` AS `return_date`,`ar`.`description` AS `description`,`ar`.`user_name` AS `user_name` from (((`asset_return` `ar` left join `asset_record` `are` on((`ar`.`item_code` = `are`.`item_code`))) left join `employee` `e` on((`ar`.`employee_id` = `e`.`employee_id`))) left join `asset_loan` `al` on((`ar`.`loan_id` = `al`.`loan_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `asset_total_summury_v`
--

/*!50001 DROP VIEW IF EXISTS `asset_total_summury_v`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `asset_total_summury_v` AS select max(`ar`.`item_code`) AS `item_code`,`ar`.`item_name` AS `item_name`,max(`ar`.`model`) AS `model`,max(`ar`.`item_category`) AS `item_category`,max(`ar`.`uom`) AS `uom`,sum(`ar`.`qty`) AS `total_store_qty`,coalesce(sum(`al`.`qty`),0) AS `total_loan_qty`,(sum(`ar`.`qty`) + coalesce(sum(`al`.`qty`),0)) AS `sum_qty` from (`asset_record` `ar` left join (select `asset_loan_v`.`item_code` AS `item_code`,sum(`asset_loan_v`.`qty`) AS `qty` from `asset_loan_v` group by `asset_loan_v`.`item_code`) `al` on((`al`.`item_code` = `ar`.`item_code`))) group by `ar`.`item_name` */;
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
/*!50001 VIEW `buy_asset_report` AS select `al`.`b_asset` AS `b_asset`,`al`.`item_code` AS `item_code`,`ar`.`item_name` AS `item_name`,`ar`.`brand` AS `brand`,`ar`.`model` AS `model`,`ar`.`item_category` AS `item_category`,`ar`.`item_type` AS `item_type`,`ar`.`uom` AS `uom`,`al`.`qty` AS `qty`,`al`.`doc_date` AS `doc_date`,`al`.`description` AS `description`,`al`.`user_name` AS `user_name` from (`buy_asset` `al` left join `asset_record` `ar` on((`al`.`item_code` = `ar`.`item_code`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `record_adjustment_report`
--

/*!50001 DROP VIEW IF EXISTS `record_adjustment_report`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `record_adjustment_report` AS select `al`.`u_asset` AS `u_asset`,`al`.`item_code` AS `item_code`,`ar`.`item_name` AS `item_name`,`ar`.`brand` AS `brand`,`ar`.`model` AS `model`,`ar`.`item_category` AS `item_category`,`ar`.`uom` AS `uom`,`al`.`qty` AS `subtract_qty`,`al`.`add_qty` AS `add_qty`,`al`.`doc_date` AS `doc_date`,`al`.`description` AS `description`,`al`.`user_name` AS `user_name` from (`adjust_asset` `al` left join `asset_record` `ar` on((`al`.`item_code` = `ar`.`item_code`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `store_loan_dash_v`
--

/*!50001 DROP VIEW IF EXISTS `store_loan_dash_v`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `store_loan_dash_v` AS select `ar`.`item_category` AS `item_category`,sum(`ar`.`qty`) AS `total_store_qty`,coalesce(sum(`al`.`qty`),0) AS `total_loan_qty` from (`asset_record` `ar` left join (select `asset_loan_v`.`item_code` AS `item_code`,sum(`asset_loan_v`.`qty`) AS `qty` from `asset_loan_v` group by `asset_loan_v`.`item_code`) `al` on((`al`.`item_code` = `ar`.`item_code`))) group by `ar`.`item_category` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `total_item_qty_view`
--

/*!50001 DROP VIEW IF EXISTS `total_item_qty_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `total_item_qty_view` AS select `ar`.`item_code` AS `item_code`,`ar`.`item_name` AS `item_name`,`ar`.`brand` AS `brand`,`ar`.`model` AS `model`,`ar`.`item_category` AS `item_category`,`ar`.`item_type` AS `item_type`,`ar`.`uom` AS `uom`,`ar`.`qty` AS `total_qty_record`,coalesce(sum((case when (`al`.`department` <> 'damaged') then `al`.`qty` else 0 end)),0) AS `total_qty_loan`,coalesce(sum((case when (`al`.`department` = 'damaged') then `al`.`qty` else 0 end)),0) AS `total_qty_inactive`,(`ar`.`qty` + coalesce(sum(`al`.`qty`),0)) AS `total_qty` from (`asset_record` `ar` left join `asset_loan_v` `al` on((`ar`.`item_code` = `al`.`item_code`))) group by `ar`.`item_code`,`ar`.`item_name`,`ar`.`brand`,`ar`.`model`,`ar`.`item_category`,`ar`.`item_type`,`ar`.`uom`,`ar`.`qty` */;
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
/*!50001 VIEW `used_asset_report` AS select `al`.`u_asset` AS `u_asset`,`al`.`item_code` AS `item_code`,`ar`.`item_name` AS `item_name`,`ar`.`brand` AS `brand`,`ar`.`model` AS `model`,`ar`.`item_category` AS `item_category`,`ar`.`uom` AS `uom`,`al`.`qty` AS `qty`,`al`.`doc_date` AS `doc_date`,`al`.`description` AS `description`,`al`.`user_name` AS `user_name` from (`use_asset` `al` left join `asset_record` `ar` on((`al`.`item_code` = `ar`.`item_code`))) */;
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

-- Dump completed on 2024-11-29 11:29:53
