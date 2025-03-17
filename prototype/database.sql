CREATE DATABASE  IF NOT EXISTS `biomeddb` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `biomeddb`;
-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: biomeddb
-- ------------------------------------------------------
-- Server version	8.0.40

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
-- Table structure for table `animals`
--

DROP TABLE IF EXISTS `animals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `animals` (
  `id` int NOT NULL AUTO_INCREMENT,
  `common_name` varchar(255) NOT NULL,
  `scientific_name` varchar(255) NOT NULL,
  `class` enum('Mammalia','Aves','Reptilia','Amphibia','Actinopterygii','Chondrichthyes','Agnatha','Insecta','Arachnida','Crustacea','Myriapoda','Cephalopoda','Gastropoda','Bivalvia','Echinodermata','Cnidaria','Porifera') NOT NULL,
  `life_time` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `weight` decimal(10,3) NOT NULL,
  `habitat` enum('Floresta','Floresta Tropical','Savana','Campo','Deserto','Tundra','Taiga','Montanha','Água Doce','Rios e Riachos','Lagos e Lagoas','Pântanos','Manguezais','Recife de Coral','Oceano Aberto','Mar Profundo','Caverna','Urbano','Suburbano','Subterrâneo') NOT NULL,
  `diet` enum('Herbívoro','Carnívoro','Onívoro','Insetívoro','Frugívoro','Granívoro','Folívoro','Nectívoro','Hematófago','Detritívoro','Piscívoro','Filtrador','Saprófago','Coprófago','Mirmecófago','Carniceiro','Omnívoro Oportunista') NOT NULL,
  `activity` enum('Diurno','Noturno','Crepuscular') NOT NULL,
  `venomous` tinyint(1) NOT NULL,
  `description` text,
  `extinction_level` enum('Extinta','Criticamente em perigo','Em perigo','Vulnerável','Quase ameaçada','Menos preocupante','Dados insuficientes','Não avaliada') NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `scientific_name` (`scientific_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animals`
--

LOCK TABLES `animals` WRITE;
/*!40000 ALTER TABLE `animals` DISABLE KEYS */;
/*!40000 ALTER TABLE `animals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plants`
--

DROP TABLE IF EXISTS `plants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plants` (
  `id` int NOT NULL AUTO_INCREMENT,
  `common_name` varchar(255) NOT NULL,
  `scientific_name` varchar(255) NOT NULL,
  `class` enum('Angiospermas','Gimnospermas','Briófitas','Pteridófitas','Lycófitas','Carofitas') NOT NULL,
  `life_time` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `shape` enum('Árvore','Arbusto','Herbácea','Vinha','Trepadeira','Gramínea','Cactos','Palmeira','Suculenta','Planta aquática','Planta epífita','Planta rasteira') NOT NULL,
  `leaf` enum('Nenhuma','Simples','Compostas','Lanceoladas','Ovadas','Elípticas','Coriáceas','Aciculares','Escamadas','Padeceradas','Palmadas','Peninérveas','Cordadas','Em forma de flecha','Lacinadas','Linear','Auriculadas') DEFAULT (0),
  `habitat` enum('Floresta Tropical','Floresta Temperada','Deserto','Pradaria','Tundra','Montanha','Mangue','Pântano','Riacho','Lagoa','Caverna','Planalto','Costas Rochosas','Região Alpina','Região Subtropical','Região Mediterrânea') NOT NULL,
  `water_frequency` enum('Necessita de rega regular','Necessita de rega abundante','Necessita de pouca rega','Resistente à seca','Rega moderada','Preferencialmente solo úmido','Necessita de solo bem drenado','Prefere rega por imersão','Necessita de rega constante','Resistente a alagamentos') NOT NULL,
  `utility` enum('Medicinal','Culinária','Ornamental','Industrial') NOT NULL,
  `toxic` tinyint(1) NOT NULL,
  `extinction_level` enum('Extinta','Criticamente em perigo','Em perigo','Vulnerável','Quase ameaçada','Menos preocupante','Dados insuficientes','Não avaliada') NOT NULL,
  `description` text,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plants`
--

LOCK TABLES `plants` WRITE;
/*!40000 ALTER TABLE `plants` DISABLE KEYS */;
/*!40000 ALTER TABLE `plants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `level` int DEFAULT (1),
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
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

-- Dump completed on 2025-03-16 21:01:35
