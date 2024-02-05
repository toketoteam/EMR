-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: emrs
-- ------------------------------------------------------
-- Server version	8.0.34

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
-- Table structure for table `emr_login`
--

DROP TABLE IF EXISTS `emr_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emr_login` (
  `id` varchar(45) NOT NULL,
  `pw` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emr_login`
--

LOCK TABLES `emr_login` WRITE;
/*!40000 ALTER TABLE `emr_login` DISABLE KEYS */;
INSERT INTO `emr_login` VALUES ('admin','1234');
/*!40000 ALTER TABLE `emr_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pt_reser`
--

DROP TABLE IF EXISTS `pt_reser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pt_reser` (
  `hiddenidx` int(7) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `ptid` int(7) unsigned zerofill NOT NULL,
  `ptname` varchar(45) DEFAULT NULL,
  `gender` int NOT NULL,
  `wanjang` varchar(45) DEFAULT NULL,
  `reser_time` time DEFAULT NULL,
  `pt_state` int DEFAULT NULL,
  `reser_date` date DEFAULT NULL,
  PRIMARY KEY (`hiddenidx`)
) ENGINE=InnoDB AUTO_INCREMENT=1234597 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_reser`
--

LOCK TABLES `pt_reser` WRITE;
/*!40000 ALTER TABLE `pt_reser` DISABLE KEYS */;
INSERT INTO `pt_reser` VALUES (1234568,1234568,'김영희',2,'박원장','03:12:03',1,'2023-08-30'),(1234569,1234569,'고길동',1,'김원장','03:31:14',1,'2023-08-31'),(1234572,1234568,'김영희',2,'김원장','06:12:00',1,'2024-02-06'),(1234573,1234569,'고길동',1,'김원장','01:00:00',1,'2024-02-06'),(1234596,1234567,'김철수',1,'김원장','02:18:42',3,'2024-02-06');
/*!40000 ALTER TABLE `pt_reser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pt_table`
--

DROP TABLE IF EXISTS `pt_table`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pt_table` (
  `ptid` int(7) unsigned zerofill NOT NULL,
  `ptname` varchar(45) NOT NULL,
  `gender` int NOT NULL,
  `birthdate` int(8) unsigned zerofill NOT NULL,
  `insurance` int DEFAULT NULL,
  `contact` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ptid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pt_table`
--

LOCK TABLES `pt_table` WRITE;
/*!40000 ALTER TABLE `pt_table` DISABLE KEYS */;
INSERT INTO `pt_table` VALUES (0488664,'김철수',2,19940822,1,NULL,NULL),(1234567,'김철수',1,19821002,2,'',''),(1234568,'김영희',2,19651001,3,'010-1234-1111','둔산동'),(1234569,'고길동',1,19641002,1,NULL,NULL),(1239999,'테스트',1,19920928,2,NULL,NULL);
/*!40000 ALTER TABLE `pt_table` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-06  3:14:45
