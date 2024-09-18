-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: gestion_viajes
-- ------------------------------------------------------
-- Server version	8.0.39

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
-- Table structure for table `destinos`
--

DROP TABLE IF EXISTS `destinos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `destinos` (
  `destino_id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `descripcion` text,
  `costo` decimal(10,2) NOT NULL,
  PRIMARY KEY (`destino_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `destinos`
--

LOCK TABLES `destinos` WRITE;
/*!40000 ALTER TABLE `destinos` DISABLE KEYS */;
INSERT INTO `destinos` VALUES (1,'París 2','Francia','La ciudad del amor y la Torre Eiffel.',1500.00),(2,'Tokio','Japón','La vibrante capital con rascacielos y templos antiguos.',2000.00),(3,'Nueva York','Estados Unidos','La ciudad que nunca duerme, famosa por la Estatua de la Libertad.',1800.00),(4,'Cancún','México','Destacado destino turístico por sus playas y resorts.',1200.00),(5,'Sídney','Australia','Famosa por la Ópera y el puerto de Sídney.',2500.00);
/*!40000 ALTER TABLE `destinos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservas` (
  `reserva_id` int NOT NULL AUTO_INCREMENT,
  `turista_id` int DEFAULT NULL,
  `destino_id` int DEFAULT NULL,
  `fecha_reserva` date NOT NULL,
  `numero_personas` int NOT NULL,
  `costo_final` decimal(10,2) NOT NULL,
  PRIMARY KEY (`reserva_id`),
  KEY `turista_id` (`turista_id`),
  KEY `destino_id` (`destino_id`),
  CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`turista_id`) REFERENCES `turistas` (`turista_id`),
  CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`destino_id`) REFERENCES `destinos` (`destino_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservas`
--

LOCK TABLES `reservas` WRITE;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
INSERT INTO `reservas` VALUES (1,1,1,'2024-09-17',1,1500.00),(2,2,5,'2024-09-05',3,7500.00),(3,3,3,'2024-09-10',1,1800.00),(4,4,4,'2024-09-15',4,4800.00),(6,2,2,'2024-09-17',1,2000.00);
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turistas`
--

DROP TABLE IF EXISTS `turistas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `turistas` (
  `turista_id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`turista_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turistas`
--

LOCK TABLES `turistas` WRITE;
/*!40000 ALTER TABLE `turistas` DISABLE KEYS */;
INSERT INTO `turistas` VALUES (1,'Carlos Alberto','González','carlos.gonzalez@example.com','1234567890'),(2,'Lucía','Martínez','lucia.martinez@example.com','0987654321'),(3,'Juan','Pérez','juan.perez@example.com','1122334455'),(4,'Ana','López','ana.lopez@example.com','5566778899'),(5,'Diego','Fernández','diego.fernandez@example.com','6677889900');
/*!40000 ALTER TABLE `turistas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-18 13:11:23
