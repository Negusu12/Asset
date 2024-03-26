-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: it_asset
-- ------------------------------------------------------
-- Server version	8.0.36

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
) ENGINE=InnoDB AUTO_INCREMENT=443 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_loan`
--

LOCK TABLES `asset_loan` WRITE;
/*!40000 ALTER TABLE `asset_loan` DISABLE KEYS */;
INSERT INTO `asset_loan` VALUES (90,28,48,1,1,'2024-02-22 00:00:00','ለሰኒ ፊክሩ የተሰጠ(PSNP)','Yohannes',NULL),(91,28,71,1,1,'2023-12-19 00:00:00','PSNP ','Yohannes',NULL),(92,28,70,1,1,'2023-06-30 00:00:00','PSNP and with mouth','Yohannes',NULL),(93,28,69,1,1,'2023-06-30 00:00:00','PSNP and with mouth','Yohannes',NULL),(94,28,68,1,1,'2023-06-30 00:00:00','PSNP and with mouth','Yohannes',NULL),(95,28,67,1,1,'2023-06-30 00:00:00','PSNP and with mouth','Yohannes',NULL),(96,28,66,1,1,'2023-06-30 00:00:00','PSNP and with mouth','Yohannes',NULL),(97,28,65,1,1,'2023-06-30 00:00:00','PSNP and with mouth','Yohannes',NULL),(98,28,64,1,0,'2023-08-30 00:00:00','PSNP','Yohannes',NULL),(99,28,63,1,1,'2023-07-04 00:00:00','PSNP and with mouth','Yohannes',NULL),(100,28,62,1,1,'2023-07-03 00:00:00','PSNP and with mouth','Yohannes',NULL),(101,28,61,1,1,'2023-07-04 00:00:00','PSNP and with mouth','Yohannes',NULL),(102,28,60,1,1,'2023-07-05 00:00:00','PSNP and with mouth','Yohannes',NULL),(103,28,59,1,1,'2023-07-05 00:00:00','PSNP and with mouth','Yohannes',NULL),(104,28,58,1,1,'2023-07-05 00:00:00','PSNP and with mouth','Yohannes',NULL),(105,28,57,1,1,'2023-07-18 00:00:00','Pharma ','Yohannes',NULL),(106,28,56,1,1,'2023-08-11 00:00:00','Girma (General Service)','Yohannes',NULL),(107,28,55,1,1,'2023-03-03 00:00:00','','Yohannes',NULL),(108,28,54,1,1,'2022-11-14 00:00:00','Project(Nutrition), with Mouse','Yohannes',NULL),(109,28,51,1,1,'2023-03-10 00:00:00','','Yohannes',NULL),(110,28,49,1,1,'2023-07-09 00:00:00','','Yohannes',NULL),(111,25,53,1,1,'2020-05-14 00:00:00','','Yohannes',NULL),(112,25,52,1,1,'2019-06-10 00:00:00','ለዋሺንግተን የተሰጠ','Yohannes',NULL),(155,25,104,1,1,'2022-06-06 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(156,32,105,1,1,'2024-03-04 00:00:00','','Yohannes',NULL),(157,32,106,1,1,'2024-03-04 00:00:00','','Yohannes',NULL),(168,24,53,1,1,'2020-05-08 00:00:00','','Yohannes',NULL),(169,24,113,1,1,'2021-02-06 00:00:00','Speed Limiter','Yohannes',NULL),(170,24,68,4,4,'2022-01-07 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',NULL),(171,24,56,1,1,'2023-01-17 00:00:00','','Yohannes',NULL),(172,24,114,1,1,'2023-02-02 00:00:00','','Yohannes',NULL),(173,24,115,1,1,'2023-02-04 00:00:00','Pharma ','Yohannes',NULL),(174,24,116,1,1,'2023-07-21 00:00:00','','Yohannes',NULL),(175,24,71,1,1,'2023-07-21 00:00:00','PSNP','Yohannes',NULL),(176,32,55,1,1,'2024-03-05 00:00:00','Pharma ','Yohannes',''),(177,32,57,1,1,'2024-03-05 00:00:00','Pharma ','Yohannes',''),(178,29,117,1,1,'2024-03-05 00:00:00','Pharma ','Yohannes',''),(179,29,118,1,1,'2024-03-05 00:00:00','Pharma ','Yohannes',''),(180,29,119,1,1,'2024-03-05 00:00:00','Pharma ','Yohannes',''),(181,29,120,1,1,'2024-03-05 00:00:00','Pharma ','Yohannes',''),(182,29,114,1,1,'2024-03-05 00:00:00','Pharma ','Yohannes',''),(183,32,121,1,1,'2024-03-05 00:00:00','Finance','Yohannes',''),(184,32,122,1,1,'2024-03-05 00:00:00','Finance','Yohannes',''),(185,34,122,1,1,'2024-03-05 00:00:00','Finance','Yohannes',''),(186,32,127,1,1,'2024-03-05 00:00:00','Finance','Yohannes',''),(187,32,126,1,1,'2024-03-05 00:00:00','Finance','Yohannes',''),(188,32,125,1,1,'2024-03-05 00:00:00','Finance','Yohannes',''),(189,32,124,1,1,'2024-03-05 00:00:00','Finance','Yohannes',''),(190,29,123,1,1,'2024-03-05 00:00:00','Finance','Yohannes',''),(191,32,128,1,1,'2024-03-05 00:00:00','Finance','Yohannes',''),(192,29,129,1,1,'2024-03-05 00:00:00','Operation','Yohannes',''),(193,29,130,1,1,'2024-03-05 00:00:00','Operation','Yohannes',''),(194,29,131,1,1,'2024-03-06 00:00:00','','Yohannes',''),(195,29,132,1,1,'2024-03-06 00:00:00','','Yohannes',''),(196,29,51,1,1,'2024-03-06 00:00:00','Project','Yohannes',''),(197,32,116,1,1,'2024-03-06 00:00:00','HR','Yohannes',''),(198,32,135,1,1,'2024-03-06 00:00:00','HR','Yohannes',''),(199,32,134,1,1,'2024-03-06 00:00:00','HR','Yohannes',''),(200,32,133,1,1,'2024-03-06 00:00:00','HR','Yohannes',''),(201,32,136,1,1,'2024-03-06 00:00:00','HR','Yohannes',''),(202,29,137,1,1,'2024-03-06 00:00:00','3rd floor Metting room','Yohannes',''),(203,32,139,1,0,'2024-03-06 00:00:00','የ metting room pc ወስዳ','Yohannes',''),(204,32,138,1,1,'2024-03-06 00:00:00','','Yohannes',''),(205,29,141,1,1,'2024-03-06 00:00:00','Project','Yohannes',''),(206,29,48,1,1,'2024-03-06 00:00:00','Technical','Yohannes',''),(207,29,50,1,1,'2024-03-06 00:00:00','Technical','Yohannes',''),(208,32,140,1,1,'2024-03-06 00:00:00','Project','Yohannes',''),(209,32,111,1,1,'2024-03-06 00:00:00','Technical','Yohannes',''),(210,32,107,1,1,'2024-03-06 00:00:00','Technical','Yohannes',''),(211,32,142,1,1,'2024-03-06 00:00:00','Safaricom','Yohannes',''),(212,32,143,1,1,'2024-03-06 00:00:00','Safaricom','Yohannes',''),(213,32,53,1,1,'2024-03-06 00:00:00','Project','Yohannes',''),(214,32,144,1,1,'2024-03-06 00:00:00','Technical','Yohannes',''),(215,32,145,1,1,'2024-03-06 00:00:00','Project','Yohannes',''),(216,35,132,1,1,'2024-03-06 00:00:00','','Yohannes',''),(217,35,135,1,1,'2024-03-06 00:00:00','','Yohannes',''),(218,35,128,1,1,'2024-03-06 00:00:00','','Yohannes',''),(219,35,146,1,1,'2024-03-06 00:00:00','','Yohannes',''),(220,35,147,1,0,'2024-03-06 00:00:00','','Yohannes',''),(221,35,148,1,1,'2024-03-06 00:00:00','','Yohannes',''),(222,35,48,1,1,'2024-03-06 00:00:00','','Yohannes',''),(223,38,134,1,1,'2024-03-06 00:00:00','','Yohannes',''),(224,38,136,1,1,'2024-03-06 00:00:00','','Yohannes',''),(225,38,123,1,1,'2024-03-06 00:00:00','','Yohannes',''),(226,38,130,1,1,'2024-03-06 00:00:00','','Yohannes',''),(227,38,105,1,1,'2024-03-06 00:00:00','','Yohannes',''),(228,38,53,1,1,'2024-03-06 00:00:00','','Yohannes',''),(229,38,107,1,1,'2024-03-06 00:00:00','','Yohannes',''),(230,38,111,1,1,'2024-03-06 00:00:00','','Yohannes',''),(231,36,133,1,1,'2024-03-06 00:00:00','','Yohannes',''),(232,36,138,1,1,'2024-03-06 00:00:00','','Yohannes',''),(233,36,140,1,1,'2024-03-06 00:00:00','','Yohannes',''),(234,36,141,1,1,'2024-03-06 00:00:00','','Yohannes',''),(235,37,142,1,1,'2024-03-06 00:00:00','','Yohannes',''),(236,37,116,1,1,'2024-03-06 00:00:00','','Yohannes',''),(237,37,127,1,1,'2024-03-06 00:00:00','','Yohannes',''),(238,37,126,1,1,'2024-03-06 00:00:00','','Yohannes',''),(239,37,125,1,1,'2024-03-06 00:00:00','','Yohannes',''),(240,37,124,1,1,'2024-03-06 00:00:00','','Yohannes',''),(241,37,121,1,1,'2024-03-06 00:00:00','','Yohannes',''),(242,37,129,1,1,'2024-03-06 00:00:00','','Yohannes',''),(243,37,131,1,1,'2024-03-06 00:00:00','','Yohannes',''),(244,37,51,1,1,'2024-03-06 00:00:00','','Yohannes',''),(245,37,56,1,1,'2024-03-06 00:00:00','','Yohannes',''),(246,37,149,1,1,'2024-03-06 00:00:00','','Yohannes',''),(247,39,150,1,1,'2024-03-06 00:00:00','ፋርማ ያለ black printer','Yohannes',''),(248,40,151,1,1,'2024-03-06 00:00:00','','Yohannes',''),(249,41,151,1,1,'2024-03-06 00:00:00','Black Printer on 3rd Floor','Yohannes',''),(250,42,152,1,1,'2024-03-06 00:00:00','5th Floor Color Printer','Yohannes',''),(251,43,152,1,0,'2024-03-06 00:00:00','5th Floor Color Printer(ሙሉ አጠገብ ያለው)','Yohannes',''),(252,32,153,1,1,'2024-03-06 00:00:00','','Yohannes',''),(253,32,154,1,1,'2024-03-06 00:00:00','','Yohannes',''),(254,31,73,1,0,'2024-03-06 00:00:00','PSNP and with Charger','Yohannes',''),(255,44,155,1,1,'2024-03-06 00:00:00','4th floor Technical Team አጠገብ ያለ','Yohannes',''),(256,47,152,1,1,'2024-03-06 00:00:00','5th Floor ላይ ያለ','Yohannes',''),(257,46,152,1,1,'2024-03-06 00:00:00','5th Floor ላይ ያለ','Yohannes',''),(258,45,152,1,1,'2024-03-06 00:00:00','5th Floor ላይ ያለ','Yohannes',''),(259,47,155,1,1,'2024-03-06 00:00:00','4th Floor ላይ ያለ','Yohannes',''),(260,45,155,1,1,'2024-03-06 00:00:00','4th Floor ላይ ያለ','Yohannes',''),(261,47,151,1,1,'2024-03-06 00:00:00','3rd Floor ላይ ያለ','Yohannes',''),(262,45,151,1,1,'2024-03-06 00:00:00','3rd Floor ላይ ያለ','Yohannes',''),(263,48,156,1,1,'2024-03-06 00:00:00','2nd Floor ላይ ያለ','Yohannes',''),(264,46,156,1,1,'2024-03-06 00:00:00','2nd Floor ላይ ያለ','Yohannes',''),(265,48,150,1,1,'2024-03-06 00:00:00','1st Floor ላይ ያለ','Yohannes',''),(266,45,150,1,1,'2024-03-06 00:00:00','1st Floor ላይ ያለ','Yohannes',''),(267,47,157,1,1,'2024-03-07 00:00:00','IT Office','Yohannes',''),(268,45,157,1,1,'2024-03-07 00:00:00','IT Office','Yohannes',''),(269,41,147,1,0,'2024-03-07 00:00:00','Black Printer in Sunel Office','Yohannes',''),(270,49,147,1,0,'2024-03-07 00:00:00','','Yohannes',''),(271,50,152,1,1,'2024-03-07 00:00:00','Reception At Managemnent','Yohannes',''),(272,51,152,1,1,'2024-03-07 00:00:00','5th Floor Canon Scaner(ሙሉ አጠገብ ያለው)','Yohannes',''),(273,52,53,1,1,'2024-03-07 00:00:00','','Yohannes',''),(274,52,127,1,1,'2024-03-07 00:00:00','','Yohannes',''),(275,52,125,1,1,'2024-03-07 00:00:00','','Yohannes',''),(276,52,126,1,1,'2024-03-07 00:00:00','','Yohannes',''),(277,52,128,1,1,'2024-03-07 00:00:00','','Yohannes',''),(278,50,151,1,1,'2024-03-07 00:00:00','3rd Floor ላይ ያለ','Yohannes',''),(279,50,155,1,1,'2024-03-07 00:00:00','4rd Floor technical office ውስጥ ያለ','Yohannes',''),(280,52,55,1,1,'2024-03-07 00:00:00','','Yohannes',''),(281,50,150,1,1,'2024-03-07 00:00:00','1st Floor Printer አጠገብ ያለ','Yohannes',''),(282,41,154,1,0,'2024-03-07 00:00:00','','Yohannes',''),(283,53,118,1,1,'2024-03-07 00:00:00','Pharma ','Yohannes',''),(284,54,157,1,0,'2024-03-07 00:00:00','Only System Unit','Yohannes',''),(285,55,104,1,1,'2024-03-07 00:00:00','PSNP(Old Team)','Yohannes',''),(286,55,158,1,1,'2024-03-07 00:00:00','Technical','Yohannes',''),(287,55,53,1,1,'2024-03-07 00:00:00','Project','Yohannes',''),(288,56,129,1,1,'2024-03-07 00:00:00','','Yohannes',''),(289,29,159,2,2,'2024-03-07 00:00:00','','Yohannes',''),(290,29,160,21,21,'2024-03-08 00:00:00','','Yohannes',''),(291,27,160,1,1,'2024-03-08 00:00:00','','Yohannes',''),(292,46,160,3,3,'2024-03-08 00:00:00','Library ውስጥ ያሉ','Yohannes',''),(293,48,160,2,2,'2024-03-08 00:00:00','Library ውስጥ ያሉ','Yohannes',''),(294,57,144,1,1,'2024-03-08 00:00:00','Unlimited Internet and Voice Package','Yohannes','995000121'),(295,57,74,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','991007646'),(296,57,85,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','991007603'),(297,57,71,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','991007699'),(298,57,77,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','991007699'),(299,57,84,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3611'),(300,57,86,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3613'),(301,57,87,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','995002911'),(302,57,64,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3716'),(303,57,73,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3715'),(304,57,67,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3717'),(305,57,161,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3713'),(306,57,163,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3712'),(307,57,70,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3741'),(308,57,91,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3742'),(309,57,69,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3743'),(310,57,68,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','974024281'),(311,57,90,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3746'),(312,57,62,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3747'),(313,57,166,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3748'),(314,57,167,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3749'),(315,57,168,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3751'),(316,57,83,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3752'),(317,57,169,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3750'),(318,57,65,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3710'),(319,57,170,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3709'),(320,57,171,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','995002886'),(321,57,112,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3553'),(322,57,60,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3552'),(323,57,63,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3617'),(324,57,61,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3614'),(325,57,79,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3616'),(326,57,58,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3615'),(327,57,172,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','995003057'),(328,57,173,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3550'),(329,57,174,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3548'),(330,57,175,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3618'),(331,57,59,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','995003072'),(332,57,176,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3549'),(333,57,177,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3620'),(334,57,94,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','3551'),(335,57,66,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','995003072'),(336,57,107,1,1,'2024-03-08 00:00:00','Unlimited Internet Package','Yohannes','974024291'),(338,35,55,1,1,'2024-03-11 00:00:00','','Yohannes',''),(339,38,57,1,1,'2024-03-11 00:00:00','','Yohannes',''),(340,58,150,1,1,'2024-03-11 00:00:00','','Yohannes',''),(341,49,139,1,1,'2024-03-11 00:00:00','I hereby agree to replace the Apple Laptop in the event of loss or damage.','Yohannes',''),(342,35,139,1,1,'2024-03-11 00:00:00','','Yohannes',''),(343,41,139,1,0,'2024-03-11 00:00:00','','Yohannes',''),(344,59,151,1,1,'2024-03-11 00:00:00','3rd Floor ላይ ያለ','Yohannes',''),(345,60,140,1,1,'2024-03-11 00:00:00','ከ ዘርሽ ወስዳ ያልተመለሰ','Yohannes',''),(346,32,178,1,1,'2024-03-12 00:00:00','የ metting room pc የነበረው','Yohannes',''),(347,61,179,1,1,'2024-03-13 00:00:00','metting room ውስ ያለ','Yohannes',''),(348,58,179,1,1,'2024-03-13 00:00:00','metting room ውስ ያለ','Yohannes',''),(349,62,137,1,1,'2024-03-13 00:00:00','3rd floor metting room ውስ ያለ','Yohannes',''),(350,31,73,48,21,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(351,31,74,42,15,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(352,31,75,30,3,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(353,31,76,30,29,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(354,31,65,30,17,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(355,31,77,42,38,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(356,31,65,12,12,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(357,31,60,36,10,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(358,31,78,24,9,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(359,31,79,30,13,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(360,31,61,42,33,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(361,31,71,42,42,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(362,31,80,36,36,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(363,31,81,42,42,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(364,31,82,36,36,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(365,31,62,36,36,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(366,31,83,42,42,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(367,31,84,36,36,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(368,31,85,42,42,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(369,31,86,42,42,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(370,31,87,36,36,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(371,31,88,36,36,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(372,31,89,36,36,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(373,31,68,36,36,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(374,31,67,36,36,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(375,31,70,36,36,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(376,31,90,36,36,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(377,31,91,36,36,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(378,31,92,36,36,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(379,31,69,36,36,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(380,31,66,42,42,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(381,31,58,36,36,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(382,31,93,42,22,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(383,31,94,36,11,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(384,31,95,36,36,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(385,31,96,36,36,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(386,31,97,42,42,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(387,31,98,42,42,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(388,31,99,36,36,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(389,31,100,30,30,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(390,31,101,1,1,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(391,31,102,1,1,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(392,31,103,1,1,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(393,31,72,9,0,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(394,31,109,1,1,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(395,31,68,6,6,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(396,31,110,1,1,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(397,31,48,9,9,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(398,31,48,5,5,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(399,31,180,1,1,'2024-03-13 00:00:00','ለ gambela region የተሰጠ የነ bontu ፕሮጀክት','Yohannes',''),(400,31,181,1,1,'2024-03-13 00:00:00','ለ gambela region የተሰጠ የነ bontu ፕሮጀክት','Yohannes',''),(401,31,182,1,1,'2024-03-13 00:00:00','ለ Amhara region የተሰጠ የነ bontu ፕሮጀክት','Yohannes',''),(402,31,185,1,1,'2024-03-13 00:00:00','ለ SNNP region የተሰጠ የነ bontu ፕሮጀክት','Yohannes',''),(403,31,186,1,1,'2024-03-13 00:00:00','ለ SNNP region የተሰጠ የነ bontu ፕሮጀክት','Yohannes',''),(404,31,187,1,1,'2024-03-13 00:00:00','ለ SNNP region የተሰጠ የነ bontu ፕሮጀክት','Yohannes',''),(405,31,188,1,1,'2024-03-13 00:00:00','ለ SNNP region የተሰጠ የነ bontu ፕሮጀክት','Yohannes',''),(406,31,189,1,1,'2024-03-13 00:00:00','ለ SNNP region የተሰጠ የነ bontu ፕሮጀክት','Yohannes',''),(407,31,193,1,1,'2024-03-13 00:00:00','ለ SNNP region የተሰጠ የነ bontu ፕሮጀክት','Yohannes',''),(408,31,191,1,1,'2024-03-13 00:00:00','ለ SNNP region የተሰጠ የነ bontu ፕሮጀክት','Yohannes',''),(409,31,192,1,1,'2024-03-13 00:00:00','ለ SNNP region የተሰጠ የነ bontu ፕሮጀክት','Yohannes',''),(410,31,194,1,1,'2024-03-13 00:00:00','ለ Oromia region የተሰጠ የነ bontu ፕሮጀክት','Yohannes',''),(411,31,65,1,1,'2024-03-13 00:00:00','Field ላሉ ልጆች ተሰቷል','Yohannes',''),(412,31,112,1,1,'2024-03-13 00:00:00','PSNP claster(7/8)','Yohannes',''),(413,31,169,1,1,'2024-03-13 00:00:00','Field ላሉ ልጆች ተሰቷል Claster(7/8)','Yohannes',''),(414,31,68,1,1,'2024-03-13 00:00:00','PSNP claster 9','Yohannes',''),(415,31,111,7,7,'2024-03-13 00:00:00','PSNP claster 8 የተሰጠ','Yohannes',''),(416,31,107,6,6,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(417,31,111,31,31,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(418,31,50,11,11,'2024-03-13 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(419,31,73,1,1,'2024-03-13 00:00:00','PSNP claster 9','Yohannes',''),(420,31,84,1,1,'2024-03-13 00:00:00','PSNP claster 9','Yohannes',''),(421,31,86,1,1,'2024-03-13 00:00:00','PSNP claster 9','Yohannes',''),(422,31,195,92,92,'2024-03-13 00:00:00','ከ PSNP ፊልድ ላይ ተሰብረው የተመለሱ','Yohannes',''),(423,63,142,4,4,'2024-03-14 00:00:00','Safaricom','Yohannes',''),(424,55,142,4,4,'2024-03-14 00:00:00','Safaricom','Yohannes',''),(425,63,133,1,1,'2024-03-14 00:00:00','HR','Yohannes',''),(426,24,134,1,0,'2024-03-14 00:00:00','HR','Yohannes',''),(427,64,48,31,31,'2022-01-14 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(428,64,48,11,11,'2022-02-15 00:00:00','PSNP ፊልድ ላይ የተሰጠ','Yohannes',''),(429,64,48,2,2,'2023-05-01 00:00:00','PSNP ፊልድ ላይ የተሰጠ (ከ 24 power bank 22 ተመልሶ 2 ቀርሪ ነው)','Yohannes',''),(430,67,196,4,4,'2024-03-16 00:00:00','with Cable for Finot Department','Yohannes',' '),(431,41,152,1,1,'2024-03-20 00:00:00','5th Floor Dr. Amare and Dr Tadele','Yohannes',''),(432,69,197,1,1,'2024-03-21 00:00:00','','Getachew',''),(433,70,153,1,1,'2024-03-20 00:00:00','','Yohannes',''),(434,70,154,1,1,'2024-03-20 00:00:00','','Yohannes',''),(435,71,151,1,1,'2024-03-20 00:00:00','3rd Floor HR እሚጠቀሙበት','Yohannes',''),(436,72,154,1,1,'2024-03-20 00:00:00','eyob ቢሮ ያለው black printer','Yohannes',''),(437,41,198,1,1,'2024-03-20 00:00:00','Functional Printer','Yohannes',''),(438,73,195,2,2,'2024-03-20 00:00:00','ተበላሽተው የተቀመጡ 2 hp 4525 color printer','Yohannes',''),(439,74,195,1,1,'2024-03-20 00:00:00','ተበላሽቶ የተቀመጠ HP-cp3525 Printer','Yohannes',''),(440,44,195,1,1,'2024-03-20 00:00:00','የተበባሽ HP-9000 printer','Yohannes',''),(441,75,139,1,1,'2024-03-22 00:00:00','I hereby agree to replace the Apple iPhone 15 Pro 1 terabyte titanium phone in the event of loss or damage.','Yohannes','DGY0H9HP2G'),(442,76,199,1,1,'2024-03-25 00:00:00','','Negusu','');
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
 1 AS `model`,
 1 AS `brand`,
 1 AS `item_type`,
 1 AS `item_category`,
 1 AS `item_condition`,
 1 AS `serial_no`,
 1 AS `full_name`,
 1 AS `department`,
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
  `model` varchar(20) DEFAULT NULL,
  `brand` varchar(25) DEFAULT NULL,
  `item_type` varchar(10) DEFAULT NULL,
  `item_image` longblob,
  PRIMARY KEY (`item_code`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_record`
--

LOCK TABLES `asset_record` WRITE;
/*!40000 ALTER TABLE `asset_record` DISABLE KEYS */;
INSERT INTO `asset_record` VALUES (24,'TECNO_TAB_F','TECNO TAB','Functional',17,'2024-03-25 00:00:00','','jo','Each','Tablet','','','asset',NULL),(25,'TOSHIBA_LAPTOP_F','TOSHIBA LAPTOP','Functional',7,'2024-03-25 00:00:00','ስንቱ እንደሚሰራ አይታወቅም','jo','Each','Laptop','','','asset',NULL),(27,'EPSON_PROJECTOR_F','EPSON PROJECTOR','Functional',2,'2024-03-25 00:00:00','','jo','Each','Projector','','','asset',NULL),(28,'LENOVO_LAPTOP_F','LENOVO LAPTOP','Functional',1,'2024-03-22 00:00:00','','Yohannes','Each','Laptop','','Lenovo','asset',NULL),(29,'DeDsk9010','Dell Desktop 9010','Functional',0,'2024-03-25 00:00:00','','Yohannes','Each','All In One Desktop','9010','','asset',NULL),(31,'ABH_TAB_F','ABH TAB','Functional',62,'2024-03-25 00:00:00','ተገዝተው የገቡ አጠቃላይ black tabs','Yohannes','Each','Tablet','','','asset',NULL),(32,'DeDsk9020','Dell Desktop 9020','Functional',0,'2024-03-25 00:00:00','','Yohannes','Each','All In One Desktop','9020','Dell','asset',NULL),(34,'DlOpt7020','Dell Optiplex 7020','Functional',0,'2024-03-05 00:00:00','','Yohannes','Each','Desktop','Optiplex 7020',NULL,NULL,NULL),(35,'saph705','Sangoma 705','Functional',0,'2024-03-06 00:00:00','','Yohannes','Each','Phone','705',NULL,NULL,NULL),(36,'saph500','Sangoma 500','Functional',0,'2024-03-06 00:00:00','','Yohannes','Each','Phone','500',NULL,NULL,NULL),(37,'saph300','Sangoma 300','Functional',0,'2024-03-06 00:00:00','','Yohannes','Each','Phone','300',NULL,NULL,NULL),(38,'astph','Asterisks','Functional',0,'2024-03-06 00:00:00','','Yohannes','Each','Phone','Asterisks',NULL,NULL,NULL),(39,'priLJ4345','HP LaserJet4345','Functional',0,'2024-03-06 00:00:00','','Yohannes','Each','Printer','M4345 MFP Series',NULL,NULL,NULL),(40,'cpCHDir3300','Canon Heavy Duty Photo Copy Machine ir3300','Functional',0,'2024-03-06 00:00:00','','Yohannes','Each','Copy Machen','ir3300',NULL,NULL,NULL),(41,'priLJ4015','HP LaserJet P4015','Functional',0,'2024-03-06 00:00:00','','Yohannes','Each','Printer','P4015',NULL,NULL,NULL),(42,'priLJ2025','Printer','Functional',0,'2024-03-20 00:00:00','5th Floor Color Printer(ሙሉ አጠገብ ያለው)','Yohannes','Each','Printer','CP2025dn','HP','asset',NULL),(43,'priLJ680','HP Printer MFP M680','Functional',0,'2024-03-06 00:00:00','','Yohannes','Each','Printer','M680',NULL,NULL,NULL),(44,'priLJ9500','Printer','Functional',0,'2024-03-20 00:00:00','','Yohannes','Each','Printer','9000DN','HP','asset',NULL),(45,'swDLP','D-Link POE','Functional',0,'2024-03-06 00:00:00','','Yohannes','Each','Switch','D-Link POE',NULL,NULL,NULL),(46,'swGBT','Giga Bit TP-Link','Functional',2,'2024-03-06 00:00:00','','Yohannes','Each','Switch','Giga Bit TP-Link',NULL,NULL,NULL),(47,'r2U','Rack (2U)','Functional',0,'2024-03-06 00:00:00','','Yohannes','Each','Rack','2U',NULL,NULL,NULL),(48,'r4U','Rack (4U)','Functional',0,'2024-03-06 00:00:00','','Yohannes','Each','Rack','4U',NULL,NULL,NULL),(49,'lpMP','Laptop','Functional',0,'2024-03-22 00:00:00','','Yohannes','Each','Laptop','Macbook Pro','Apple','asset',NULL),(50,'stG2000VA','GATO Stablizer','Functional',0,'2024-03-07 00:00:00','','Yohannes','Each','Stablizer','SVC2000VA',NULL,NULL,NULL),(51,'scCL220','Canon Scaner','Functional',0,'2024-03-07 00:00:00','','Yohannes','Each','Scaner','Lide220',NULL,NULL,NULL),(52,'ueE5','Epton 1100 VA','Functional',0,'2024-03-07 00:00:00','','Yohannes','Each','UPS','E5',NULL,NULL,NULL),(53,'sEPv19','Epson perfection V19','Functional',0,'2024-03-07 00:00:00','','Yohannes','Each','Scaner','perfection V19',NULL,NULL,NULL),(54,'DeDsk620','Dell Desk Top 620','Functional',1,'2024-03-07 00:00:00','','Yohannes','Each','Desktop',' Optiplex 620',NULL,NULL,NULL),(55,'rHR','Huawei Router','Functional',0,'2024-03-07 00:00:00','','Yohannes','Each','Router','Huawei Router',NULL,NULL,NULL),(56,'pTB1F','TECNO Phone','Functional',0,'2024-03-07 00:00:00','','Yohannes','Each','Phone','B1F',NULL,NULL,NULL),(57,'tS','Tele Simcard','Functional',0,'2024-03-08 00:00:00','','Yohannes','Each','SIM Card','Simcard',NULL,NULL,NULL),(58,'rTLWR','TP-Link Wifi Router','Functional',0,'2024-03-11 00:00:00','','Yohannes','Each','Router','TP-Link',NULL,NULL,NULL),(59,'rNGWR','Netgear Wifi router','Functional',0,'2024-03-11 00:00:00','','Yohannes','Each','Router','Netgear',NULL,NULL,NULL),(60,'fSd','Sandisk Flash 16 GB','Functional',0,'2024-03-11 00:00:00','','Yohannes','GB','Flash Disk','Sandisk',NULL,NULL,NULL),(61,'tL','LG Tv',NULL,0,'2024-03-13 00:00:00','','Yohannes','Each','TV','LG',NULL,NULL,NULL),(62,'tS','Samsung Tv',NULL,0,'2024-03-13 00:00:00','','Yohannes','Each','TV','Samsung',NULL,NULL,NULL),(63,'pTPS7','TECNO Phone Spark 7',NULL,0,'2024-03-14 00:00:00','','Yohannes','Each','Phone','Spark 7',NULL,NULL,NULL),(64,'pHPB','Huawei PowerBank',NULL,0,'2024-03-14 00:00:00','','Yohannes','Each','Power Bank','PowerBank',NULL,NULL,NULL),(65,'tHT','Hisense TV',NULL,2,'2024-03-14 00:00:00','','Yohannes','Each','TV','Hisense',NULL,NULL,NULL),(66,'PBX','PBX',NULL,1,'2024-03-16 00:00:00','','Yohannes','Each','Phone','Sangoma PBX',NULL,NULL,NULL),(67,'vrP','Panasonyc Voice Recorder',NULL,7,'2024-03-16 00:00:00','','Yohannes','Each','Voice Recorder','Panasonyc',NULL,NULL,NULL),(68,'pSES7','Sony Projector ES7',NULL,1,'2024-03-25 00:00:00','','Yohannes','Each','Projector','ES7','Sony','asset',NULL),(69,'uAPC10VA','APS Smart UPS',NULL,0,'2024-03-21 00:00:00','','Getachew','Each','UPS','SRT-10000',NULL,NULL,NULL),(70,'mHPV24','HP Monitor',NULL,0,'2024-03-20 00:00:00','23 inch Monitor','Yohannes','Each','Monitor','v24ib',NULL,NULL,NULL),(71,'uC24v','Compaq UPS',NULL,0,'2024-03-20 00:00:00','','Yohannes','Each','UPS','2400V',NULL,NULL,NULL),(72,'priLJ2055','Printer',NULL,0,'2024-03-20 00:00:00','','Yohannes','Each','Printer','LaserJet 2055','HP','asset',NULL),(73,'priLJ4525','Printer',NULL,0,'2024-03-20 00:00:00','','Yohannes','Each','Printer','LaserJet 4525','HP','asset',NULL),(74,'priLJ3525','Printer',NULL,0,'2024-03-20 00:00:00','','Yohannes','Each','Printer','cp3525','HP','asset',NULL),(75,'pAPPI15pro','Iphone',NULL,0,'2024-03-22 00:00:00','','Yohannes','Each','Phone','15 Pro','Apple','asset',NULL),(76,'cable_reel','Electric Cable Reel',NULL,0,'2024-03-25 00:00:00','50 Meter Heavy Duty Cable Reel','Negusu','Each','Cable','','','asset',NULL);
/*!40000 ALTER TABLE `asset_record` ENABLE KEYS */;
UNLOCK TABLES;

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
  `model` varchar(20) DEFAULT NULL,
  `brand` varchar(25) DEFAULT NULL,
  `item_type` varchar(10) DEFAULT NULL,
  `item_image` longblob,
  PRIMARY KEY (`item_code`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_register_record`
--

LOCK TABLES `asset_register_record` WRITE;
/*!40000 ALTER TABLE `asset_register_record` DISABLE KEYS */;
INSERT INTO `asset_register_record` VALUES (1,'priLJ2055','Printer',NULL,1,'2024-03-20 00:00:00','','Yohannes','Each','Printer','LaserJet 2055','HP','asset',NULL),(2,'priLJ4525','Printer',NULL,2,'2024-03-20 00:00:00','','Yohannes','Each','Printer','LaserJet 4525','HP','asset',NULL),(3,'priLJ3525','Printer',NULL,1,'2024-03-20 00:00:00','','Yohannes','Each','Printer','cp3525','HP','asset',NULL),(4,'pAPPI15pro','Iphone',NULL,1,'2024-03-22 00:00:00','','Yohannes','Each','Phone','15 Pro','Apple','asset',NULL),(5,'cable_reel','Electric Cable Reel',NULL,1,'2024-03-25 00:00:00','50 Meter Heavy Duty Cable Reel','Negusu','Each','Cable','','','asset',NULL);
/*!40000 ALTER TABLE `asset_register_record` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_return`
--

LOCK TABLES `asset_return` WRITE;
/*!40000 ALTER TABLE `asset_return` DISABLE KEYS */;
INSERT INTO `asset_return` VALUES (37,98,64,1,'2024-03-04 00:00:00','Power Cable missing!!! claster 7(Ask Feven)',28,'Yohannes'),(38,284,157,1,'2024-03-09 00:00:00','',54,'Yohannes'),(40,270,147,1,'2024-03-11 00:00:00','',49,'Yohannes'),(41,220,147,1,'2024-03-11 00:00:00','',35,'Yohannes'),(42,269,147,1,'2024-03-11 00:00:00','',41,'Yohannes'),(43,203,139,1,'2024-03-12 00:00:00','',32,'Yohannes'),(44,393,72,7,'2024-03-13 00:00:00','በስተት የገባ',31,'Yohannes'),(45,393,72,2,'2024-03-13 00:00:00','በስተት የገባ',31,'Yohannes'),(46,350,73,27,'2024-03-13 00:00:00','PSNP ከተማ ከፊልድ ያመጣቸው የሚሰሩ ታቦች 27 እና 25 የሚሰሩ ቻችጀሮች',31,'Yohannes'),(47,351,74,27,'2024-03-13 00:00:00','PSNP ከተማ ከፊልድ ያመጣቸው የሚሰሩ 27 ታቦች እና 25 የሚሰሩ ቻችጀሮች',31,'Yohannes'),(48,352,75,27,'2024-03-13 00:00:00','PSNP ከተማ ከፊልድ ያመጣቸው የሚሰሩ ታቦች 27 እና 25 የሚሰሩ ቻችጀሮች',31,'Yohannes'),(49,353,76,1,'2024-03-13 00:00:00','PSNP ከተማ ከፊልድ ያመጣው የሚሰራ 1 ታብ',31,'Yohannes'),(50,354,65,13,'2024-03-13 00:00:00','PSNP ፈቨን ከፊልድ ያመጣችው የሚሰሩ 13 ታቦች እና 25 የሚሰሩ 2 ቻችጀሮች',31,'Yohannes'),(51,355,77,4,'2024-03-13 00:00:00','PSNP ናቲ ከፊልድ ያመጣቸው የሚሰሩ ታቦች 4',31,'Yohannes'),(52,357,60,26,'2024-03-13 00:00:00','PSNP ከተማ ከፊልድ ያመጣቸው የሚሰሩ ታቦች 26 እና 7 የሚሰሩ ቻችጀሮች',31,'Yohannes'),(53,358,78,15,'2024-03-13 00:00:00','PSNP ፈቨን ከፊልድ ያመጣቸው የማይሰሩ ታቦች 15 እና 7 የሚሰሩ ቻችጀሮች',31,'Yohannes'),(54,359,79,17,'2024-03-13 00:00:00','PSNP ናቲ ከፊልድ ያመጣቸው የማይሰሩ ታቦች 17',31,'Yohannes'),(55,360,61,9,'2024-03-13 00:00:00','PSNP አማን ከፊልድ ያመጣቸው የማይሰሩ ታቦች 9',31,'Yohannes'),(56,382,93,20,'2024-03-13 00:00:00','PSNP አማን ከፊልድ ያመጣቸው የሚሰሩ ታቦች 20 እና 11 ቻችጀሮች እና 4 ኬብሎች',31,'Yohannes'),(57,383,94,25,'2024-03-13 00:00:00','PSNP አማን ከፊልድ ያመጣቸው የሚሰሩ ታቦች 25',31,'Yohannes'),(58,426,134,1,'2024-03-14 00:00:00','HR',24,'Yohannes'),(59,343,139,1,'2024-03-20 00:00:00','',41,'Yohannes'),(60,251,152,1,'2024-03-20 00:00:00','',43,'Yohannes'),(61,282,154,1,'2024-03-20 00:00:00','',41,'Yohannes');
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
 1 AS `brand`,
 1 AS `model`,
 1 AS `item_category`,
 1 AS `item_type`,
 1 AS `full_name`,
 1 AS `uom`,
 1 AS `qty`,
 1 AS `doc_date`,
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
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buy_asset`
--

LOCK TABLES `buy_asset` WRITE;
/*!40000 ALTER TABLE `buy_asset` DISABLE KEYS */;
INSERT INTO `buy_asset` VALUES (22,24,16,'2024-02-07 00:00:00','ገች ጋር ያሉ የተመለሱ አዲሶቹ ታቦች(ቢሮ ሊታደስ ሲል የቆጠርናቸው)','jo'),(23,25,7,'2024-02-07 00:00:00','ስንቱ እንደሚሰራ አይታወቅም እና 3 ቻርጀር ብቻ ነው ያላቸው','jo'),(25,27,2,'2024-02-07 00:00:00','','jo'),(28,28,17,'2024-03-04 00:00:00','ከዋሺንግተን የመጣ','Yohannes'),(29,28,6,'2024-03-04 00:00:00','ገች ጋር የነበሩ','Yohannes'),(30,25,2,'2024-03-04 00:00:00','','Yohannes'),(31,29,21,'2024-03-04 00:00:00','ላይብረሪ ያሉ Desktop 9010','Yohannes'),(33,25,1,'2022-06-06 00:00:00','','Yohannes'),(34,32,2,'2024-03-04 00:00:00','IT Office ያሉ','Yohannes'),(46,24,11,'2020-03-05 00:00:00','በፊት የነበሩ','Yohannes'),(47,32,2,'2024-03-05 00:00:00','','Yohannes'),(48,29,5,'2024-03-05 00:00:00','','Yohannes'),(49,32,2,'2024-03-05 00:00:00','','Yohannes'),(50,34,1,'2024-03-05 00:00:00','','Yohannes'),(51,32,4,'2024-03-05 00:00:00','','Yohannes'),(52,29,1,'2024-03-05 00:00:00','','Yohannes'),(53,32,1,'2024-03-05 00:00:00','','Yohannes'),(54,29,2,'2024-03-05 00:00:00','','Yohannes'),(55,29,3,'2024-03-06 00:00:00','','Yohannes'),(56,32,5,'2024-03-06 00:00:00','','Yohannes'),(57,29,1,'2024-03-06 00:00:00','','Yohannes'),(58,32,2,'2024-03-06 00:00:00','','Yohannes'),(59,32,3,'2024-03-06 00:00:00','','Yohannes'),(60,29,3,'2024-03-06 00:00:00','','Yohannes'),(61,32,2,'2024-03-06 00:00:00','','Yohannes'),(62,32,3,'2024-03-06 00:00:00','','Yohannes'),(63,35,7,'2024-03-06 00:00:00','','Yohannes'),(64,38,8,'2024-03-06 00:00:00','','Yohannes'),(65,36,4,'2024-03-06 00:00:00','','Yohannes'),(66,37,12,'2024-03-06 00:00:00','','Yohannes'),(67,39,1,'2024-03-06 00:00:00','','Yohannes'),(68,40,1,'2024-03-06 00:00:00','','Yohannes'),(69,41,1,'2024-03-06 00:00:00','','Yohannes'),(70,42,1,'2024-03-06 00:00:00','','Yohannes'),(71,43,1,'2024-03-06 00:00:00','','Yohannes'),(72,32,2,'2024-03-06 00:00:00','','Yohannes'),(73,44,1,'2024-03-06 00:00:00','','Yohannes'),(74,45,1,'2024-03-06 00:00:00','','Yohannes'),(75,46,1,'2024-03-06 00:00:00','','Yohannes'),(76,47,1,'2024-03-06 00:00:00','','Yohannes'),(77,45,1,'2024-03-06 00:00:00','','Yohannes'),(78,47,1,'2024-03-06 00:00:00','','Yohannes'),(79,47,1,'2024-03-06 00:00:00','','Yohannes'),(80,45,1,'2024-03-06 00:00:00','','Yohannes'),(81,48,1,'2024-03-06 00:00:00','','Yohannes'),(82,46,1,'2024-03-06 00:00:00','','Yohannes'),(83,48,1,'2024-03-06 00:00:00','','Yohannes'),(84,45,1,'2024-03-06 00:00:00','','Yohannes'),(85,47,1,'2024-03-07 00:00:00','','Yohannes'),(86,45,1,'2024-03-07 00:00:00','','Yohannes'),(87,41,1,'2024-03-07 00:00:00','','Yohannes'),(88,49,1,'2024-03-07 00:00:00','','Yohannes'),(89,50,1,'2024-03-07 00:00:00','','Yohannes'),(90,51,1,'2024-03-07 00:00:00','','Yohannes'),(91,52,4,'2024-03-07 00:00:00','','Yohannes'),(92,52,1,'2024-03-07 00:00:00','','Yohannes'),(93,50,1,'2024-03-07 00:00:00','','Yohannes'),(94,50,1,'2024-03-07 00:00:00','','Yohannes'),(95,52,1,'2024-03-07 00:00:00','','Yohannes'),(96,50,1,'2024-03-07 00:00:00','','Yohannes'),(97,41,1,'2024-03-07 00:00:00','','Yohannes'),(98,53,1,'2024-03-07 00:00:00','','Yohannes'),(99,54,1,'2024-03-07 00:00:00','','Yohannes'),(100,55,3,'2024-03-07 00:00:00','','Yohannes'),(101,56,1,'2024-03-07 00:00:00','','Yohannes'),(102,29,2,'2024-03-07 00:00:00','','Yohannes'),(103,27,1,'2024-03-08 00:00:00','','Yohannes'),(104,48,2,'2024-03-08 00:00:00','','Yohannes'),(105,46,3,'2024-03-08 00:00:00','','Yohannes'),(106,57,43,'2024-03-08 00:00:00','','Yohannes'),(107,46,2,'2024-03-09 00:00:00','','Yohannes'),(108,38,1,'2024-03-11 00:00:00','','Yohannes'),(109,35,1,'2024-03-11 00:00:00','','Yohannes'),(110,58,1,'2024-03-11 00:00:00','','Yohannes'),(112,59,1,'2024-03-11 00:00:00','','Negusu'),(113,60,16,'2024-03-11 00:00:00','','Yohannes'),(114,31,1500,'2024-03-12 00:00:00','','Yohannes'),(115,61,1,'2024-03-13 00:00:00','','Yohannes'),(116,62,1,'2024-03-13 00:00:00','','Yohannes'),(117,58,1,'2024-03-13 00:00:00','','Yohannes'),(118,63,4,'2024-03-14 00:00:00','','Yohannes'),(119,55,4,'2024-03-14 00:00:00','','Yohannes'),(120,63,1,'2024-03-14 00:00:00','','Yohannes'),(121,24,1,'2024-03-14 00:00:00','','Yohannes'),(122,64,2,'2024-03-14 00:00:00','','Yohannes'),(123,64,31,'2024-03-14 00:00:00','','Yohannes'),(124,64,11,'2024-03-14 00:00:00','','Yohannes'),(125,65,2,'2024-03-14 00:00:00','','Yohannes'),(126,66,1,'2024-03-16 00:00:00','','Yohannes'),(127,67,11,'2024-03-16 00:00:00','','Yohannes'),(128,68,1,'2024-03-20 00:00:00','','Yohannes'),(129,69,1,'2024-03-21 00:00:00','','Getachew'),(130,70,2,'2024-03-20 00:00:00','','Yohannes'),(131,71,1,'2024-03-20 00:00:00','','Yohannes'),(132,43,1,'2024-03-20 00:00:00','','Yohannes'),(133,41,1,'2024-03-20 00:00:00','','Yohannes'),(134,44,1,'2024-03-20 00:00:00','','Yohannes');
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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drop_down_list`
--

LOCK TABLES `drop_down_list` WRITE;
/*!40000 ALTER TABLE `drop_down_list` DISABLE KEYS */;
INSERT INTO `drop_down_list` VALUES (5,'Information Technology','',NULL),(6,'Human Resources','',NULL),(7,'Operation','',NULL),(8,'Finance','',NULL),(9,'Project','',NULL),(10,'WMC','',NULL),(11,'Pharma','',NULL),(12,'Technical','',NULL),(13,'','','Each'),(14,'','','Meter'),(15,'','Desktop',''),(16,'Executive','',''),(17,'Safaricom','',''),(18,'','Phone',''),(19,'Security','',''),(20,'','Printer',''),(21,'','Copy Machen',''),(22,'','UPS',''),(23,'','Switch',''),(24,'','Rack',''),(25,'Harvard (Fenot)','',''),(26,'','Stablizer',''),(27,'','Scaner',''),(28,'','Router',''),(29,'','SIM Card',''),(30,'','Flash Disk',''),(31,'','','GB'),(32,'','TV',''),(33,'Damaged','',''),(34,'Ground','',''),(35,'Survey Oromia(Bontu USAID))','',''),(36,'Survey SNNP(Bontu USAID)','',''),(37,'Survey Gumuz(Bontu USAID)','',''),(38,'Survey Amhara(Bontu USAID)','',''),(39,'Survey Gambela(Bontu USAID)','',''),(40,'','Power Bank',''),(41,'','Voice Recorder',''),(42,'Finot','',''),(44,'Server Room','',''),(45,'','Server',''),(46,'','Monitor',''),(47,'','Tablet',''),(48,'','Laptop',''),(49,'','All In One Desktop',''),(50,'','Projector',''),(51,'Store','',''),(52,'','','kilogram (KG)'),(53,'','','Liter'),(54,'','Cable','');
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
) ENGINE=InnoDB AUTO_INCREMENT=200 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (47,'PSNP','Technical'),(48,'Bontu Birehanu','Technical'),(49,'Feven','Technical'),(50,'Feven Tesfaye','Technical'),(51,'Lensa Chala','Project'),(52,'Dereje(WMC)','WMC'),(53,'Yigzaw Kebede','Project'),(54,'Shiferaw Fussum','Project'),(55,'Tesfaye Koji','Pharma'),(56,'Girma Chane','Operation'),(57,'Lidiya Dula','Pharma'),(58,'Juki Muluneh','Project'),(59,'Alemayehu Derse','Project'),(60,'Tolosa Benti','Project'),(61,'Mergitu Ephrem','Project'),(62,'Bekele Regasa','Project'),(63,'Natnael Solomon','Project'),(64,'Ayenew Washelign','Project'),(65,'Mastewal Amare','Project'),(66,'Biniyam Bihonegn','Project'),(67,'Desta Yirsie','Project'),(68,'Nardos Sintayew','Project'),(69,'Hana Tisase','Project'),(70,'Etsegenet Tsidu','Project'),(71,'Ashebir Hunegnaw','Project'),(72,'Bontu Berhane','Project'),(73,'Bisrat Desalegn','Project'),(74,'Natnael Wendemagenew','Project'),(75,'Mahider Tilahun','Project'),(76,'Abdulkadir gelgelu','Project'),(77,'Abdisa Gyrmessa','Project'),(78,'Naol Abay','Project'),(79,'Segni Fikiru','Project'),(80,'Hundaol Tefera','Project'),(81,'Yidideya Asrat','Project'),(82,'Hiwot Animo','Project'),(83,'Desalegn Beachew','Project'),(84,'Abel Adugna','Project'),(85,'Kasahun Shumetie','Project'),(86,'Aschalew Getu','Project'),(87,'Abenezer wassie','Project'),(88,'Dawit Getaneh','Project'),(89,'Tsion Temesgen','Project'),(90,'Natnael Tamin','Project'),(91,'Giorgis Girma','Project'),(92,'Bezawit W/Yohannes','Project'),(93,'Tahire Aliye','Project'),(94,'Robsan Bekele','Project'),(95,'Dinka Geleta','Project'),(96,'Sheleme Tesfaye','Project'),(97,'Biniyam Amensa','Project'),(98,'Mengistu Girma','Project'),(99,'Tariku Ayalew','Project'),(100,'Teshome Zikarye','Project'),(101,'Desta Werash','Project'),(102,'Melaku Kassa','Project'),(103,'Abel Tesfaye','Project'),(104,'Amiti Abasimel','Project'),(105,'Yohannes Feleke','Information Technology'),(106,'Nigusu Solomon','Information Technology'),(107,'Ketema T/Yohannes','Technical'),(109,'Yetnayet Kefelegn','Project'),(110,'Suki Muluneh','Project'),(111,'Amanuel Nigatu','Technical'),(112,'Robera Fetena','Project'),(113,'Mamush Seid','Operation'),(114,'Henok Melese','Pharma'),(115,'Yademi Abebe','Pharma'),(116,'Meheret Admasu','Human Resources'),(117,'Maereg Kibru','Pharma'),(118,'Genet Tufa','Pharma'),(119,'Eyosiyas Pharma','Pharma'),(120,'Mengistu Pharma','Pharma'),(121,'Zinash Tegene','Finance'),(122,'Rediet  Birhanu','Finance'),(123,'Azeb Matewos','Finance'),(124,'Hamere Gulilat','Finance'),(125,'Liya G/Egziabher','Finance'),(126,'Cherenet Getu','Finance'),(127,'Yohannes Demeke','Finance'),(128,'Tesfay Abebe','Finance'),(129,'Tsion Geremew','Operation'),(130,'Kalkidan Teshome','Operation'),(131,'Remrim Gebeyehu','Project'),(132,'Samrawit Solomon','Project'),(133,'Mitiku Gashu','Human Resources'),(134,'Etenesh Asres','Human Resources'),(135,'Girma  Asfaw','Human Resources'),(136,'Getaneh Abera','Human Resources'),(137,'3rd Metting room','Human Resources'),(138,'Muluwork Hailu Tadese','Executive'),(139,'Rahel  HM Kidane','Technical'),(140,'Bitaniya Tizazu','Project'),(141,'Meron Kitaw ','Project'),(142,'Bruck Safari','Safaricom'),(143,'Rahel Safari','Safaricom'),(144,'Beakal Zinabu ','Technical'),(145,'Betelihem Haileselassie','Technical'),(146,'Zerihun Sisay','Information Technology'),(147,'Sunel Project','Project'),(148,'Dr. Markos','Executive'),(149,'Security','Security'),(150,'1st Floor Office','Pharma'),(151,'3rd Floor Office','Human Resources'),(152,'5th Floor Office','Executive'),(153,'Dr. Mengistu Tafesse','Executive'),(154,'Eyob  Kifle','Executive'),(155,'4th Floor Office','Technical'),(156,'2nd Floor Office','Harvard (Fenot)'),(157,'Ground Floor','Information Technology'),(158,'Prof. Eshetu Gurmu','Project'),(159,'Timar Dawit','WMC'),(160,'Library','Information Technology'),(161,'Eden Elfenw','Project'),(163,'Enyew Assefa ','Project'),(166,'Alazar Biru ','Project'),(167,'Biruktawit Adamu','Project'),(168,'Dereje Misgana','Project'),(169,'Lalisa Shafe','Project'),(170,'Musbah Hawi','Project'),(171,'Rahel Getu','Project'),(172,'Abiyot Negash Terefe','Project'),(173,'Shibiru Jabessa','Project'),(174,'Wossen Assefa ','Project'),(175,'Reta Lemessa','Project'),(176,'Dechasa Bedada','Project'),(177,'Ebisa Desalegn','Project'),(178,'Dr. Tadele Bogale','Project'),(179,'Ground Floor Meeting','Ground'),(180,'Chaltu Baja','Survey Gambela(Bontu USAID)'),(181,'Ezra Anjulo','Survey Gambela(Bontu USAID)'),(182,'Yordanos Mezemir','Survey Amhara(Bontu USAID)'),(183,'Musa Jemal','Survey Gumuz(Bontu USAID)'),(184,'Shemsu Kedir','Survey Gumuz(Bontu USAID)'),(185,'Yasin Yana','Survey SNNP(Bontu USAID)'),(186,'Eyob Henok','Survey SNNP(Bontu USAID)'),(187,'Bezabih Bekele','Survey SNNP(Bontu USAID)'),(188,'Nebiyu Melese','Survey SNNP(Bontu USAID)'),(189,'Yerukneh Solomon','Survey SNNP(Bontu USAID)'),(190,'Akalu Atile','Survey SNNP(Bontu USAID)'),(191,'Abyot Wolie','Survey SNNP(Bontu USAID)'),(192,'Abera Kuche','Survey SNNP(Bontu USAID)'),(193,'Akalu Woyza','Survey SNNP(Bontu USAID)'),(194,'Abraham Irena','Survey Oromia(Bontu USAID))'),(195,'Damaged','Damaged'),(196,'Frehiwot Getachew','Finot'),(197,'Server Room','ServerRoom'),(198,'Store','Store'),(199,'IT Staff','Information Technology');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

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
 1 AS `item_category`,
 1 AS `model`,
 1 AS `total_qty_record`,
 1 AS `total_qty_loan`,
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `use_asset`
--

LOCK TABLES `use_asset` WRITE;
/*!40000 ALTER TABLE `use_asset` DISABLE KEYS */;
INSERT INTO `use_asset` VALUES (21,28,2,'2024-03-04 00:00:00','በስተት የገባ','Yohannes'),(22,59,1,'2024-03-11 00:00:00','','Yohannes'),(23,60,15,'2024-03-11 00:00:00','በስህተት የገባ','Yohannes'),(24,43,1,'2024-03-20 00:00:00','','Yohannes'),(25,43,1,'2024-03-20 00:00:00','','Yohannes'),(26,41,1,'2024-03-20 00:00:00','','Yohannes');
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
INSERT INTO `users` VALUES (15,201583,'Yohannes','$2y$10$9mWQQmBAbQlj0KCt4lNSL.W21l2qtdrinDIiAdxQYa6wj82a.Wbma',NULL,'1'),(16,85387,'Negusu','$2y$10$rwObAdcw3GdqGtMl5wes6eHeOug8XH3R.VzZXcC03DHivSKF2Ib7K',NULL,'1'),(17,58586543133683,'Zerihun','$2y$10$.MGK5zDXqYuRrd6JaySE5uuKG6OGJrjaDtADySiuAxbvDOMYvqLWe',NULL,'2'),(18,65300158,'Getachew','$2y$10$fW6CR3rtA3wZOZK.mAxPgOs8GpoSpXREv.n2YKpXPQOwRmnNIHAVu',NULL,'1');
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
/*!50001 VIEW `asset_loan_v` AS select `al`.`loan_id` AS `loan_id`,`al`.`item_code` AS `item_code`,`ar`.`item_name` AS `item_name`,`ar`.`model` AS `model`,`ar`.`brand` AS `brand`,`ar`.`item_type` AS `item_type`,`ar`.`item_category` AS `item_category`,`ar`.`item_condition` AS `item_condition`,`al`.`serial_no` AS `serial_no`,`e`.`full_name` AS `full_name`,`e`.`department` AS `department`,`ar`.`uom` AS `uom`,`al`.`qty` AS `qty`,`al`.`qty_taken` AS `qty_taken`,`al`.`doc_date` AS `doc_date`,`al`.`description` AS `description`,`al`.`user_name` AS `user_name` from ((`asset_loan` `al` left join `asset_record` `ar` on((`al`.`item_code` = `ar`.`item_code`))) left join `employee` `e` on((`al`.`employee_id` = `e`.`employee_id`))) */;
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
/*!50001 VIEW `asset_return_v` AS select `ar`.`return_id` AS `return_id`,`ar`.`loan_id` AS `loan_id`,`are`.`item_name` AS `item_name`,`are`.`brand` AS `brand`,`are`.`model` AS `model`,`are`.`item_category` AS `item_category`,`are`.`item_type` AS `item_type`,`e`.`full_name` AS `full_name`,`are`.`uom` AS `uom`,`ar`.`qty` AS `qty`,`ar`.`doc_date` AS `doc_date`,`ar`.`description` AS `description`,`ar`.`user_name` AS `user_name` from ((`asset_return` `ar` left join `asset_record` `are` on((`ar`.`item_code` = `are`.`item_code`))) left join `employee` `e` on((`ar`.`employee_id` = `e`.`employee_id`))) */;
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
/*!50001 VIEW `buy_asset_report` AS select `al`.`b_asset` AS `b_asset`,`al`.`item_code` AS `item_code`,`ar`.`item_name` AS `item_name`,`ar`.`item_condition` AS `item_condition`,`ar`.`uom` AS `uom`,`al`.`qty` AS `qty`,`al`.`doc_date` AS `doc_date`,`al`.`description` AS `description`,`al`.`user_name` AS `user_name` from (`buy_asset` `al` left join `asset_record` `ar` on((`al`.`item_code` = `ar`.`item_code`))) */;
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
/*!50001 VIEW `total_item_qty_view` AS select `ar`.`item_code` AS `item_code`,`ar`.`item_name` AS `item_name`,`ar`.`item_category` AS `item_category`,`ar`.`model` AS `model`,`ar`.`qty` AS `total_qty_record`,coalesce(sum(`al`.`qty`),0) AS `total_qty_loan`,(`ar`.`qty` + coalesce(sum(`al`.`qty`),0)) AS `total_qty` from (`asset_record` `ar` left join `asset_loan` `al` on((`ar`.`item_code` = `al`.`item_code`))) group by `ar`.`item_code`,`ar`.`item_code` */;
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

-- Dump completed on 2024-03-26  5:15:14
