-- MariaDB dump 10.17  Distrib 10.4.6-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: oswa_inv
-- ------------------------------------------------------
-- Server version	10.4.6-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `oswa_inv`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `oswa_inv` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `oswa_inv`;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idpagina` int(1) NOT NULL DEFAULT 0,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (3,2,'METROS'),(4,3,'ACTIVO'),(5,5,'CUYO'),(6,6,'MUEBLE LLAVE 1'),(7,7,'ESTANTE 1'),(8,6,'MUEBLE LLAVE 2'),(9,6,'MUEBLE LLAVE 7'),(10,7,'ESTANTE 2'),(11,7,'ESTANTE 3'),(12,3,'INACTIVO'),(13,3,'PRESTADO'),(14,5,'SEDE'),(15,7,'ESTANTE 4'),(16,7,'ESTANTE 5'),(17,1,'CORTE'),(18,1,'MEDICION'),(19,1,'GOLPE'),(20,1,'SOLDADURA'),(21,1,'TALADRADO'),(22,1,'ATORNILLADO'),(23,1,'SUJECION'),(24,1,'LIMADO'),(25,1,'INSUMOS'),(26,1,'PROTECCIÃ“N PERSONAL'),(27,1,'ELECTRICIDAD'),(28,1,'VARIOS'),(29,1,'DISPOSITIVO'),(46,4,'Profesor 13'),(47,4,'Profesor 14'),(48,4,'Profesor 15'),(49,4,'Profesor 16'),(50,4,'Profesor 17'),(51,4,'Profesor 18'),(52,4,'Profesor 19'),(53,4,'Profesor 20'),(54,4,'Profesor 21'),(55,4,'Profesor 22'),(56,4,'Profesor 23'),(57,4,'Profesor 24'),(58,4,'Profesor 25'),(59,4,'Profesor 26'),(60,4,'Profesor 27'),(61,4,'Profesor 28'),(62,4,'Profesor 29'),(63,4,'Profesor 30');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle`
--

DROP TABLE IF EXISTS `detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detalle` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `idpedido` int(11) DEFAULT 0,
  `idprofesor` int(11) DEFAULT 0,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `idherramienta` int(11) unsigned NOT NULL DEFAULT 0,
  `idestado` char(1) NOT NULL DEFAULT 'p',
  `prestadas` int(11) unsigned NOT NULL DEFAULT 0,
  `devueltas` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle`
--

LOCK TABLES `detalle` WRITE;
/*!40000 ALTER TABLE `detalle` DISABLE KEYS */;
INSERT INTO `detalle` VALUES (1,1,46,'2020-06-18',6,'p',1,0);
/*!40000 ALTER TABLE `detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `error`
--

DROP TABLE IF EXISTS `error`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `error` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `fecha` varchar(50) DEFAULT NULL,
  `error_1` varchar(300) DEFAULT NULL,
  `error_2` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `error`
--

LOCK TABLES `error` WRITE;
/*!40000 ALTER TABLE `error` DISABLE KEYS */;
INSERT INTO `error` VALUES (69,NULL,'',''),(70,NULL,'.',''),(71,NULL,'INSERT INTO detalle ( idherramienta, prestadas ) V','SQLSTATE[HY000]: General error'),(72,NULL,'INSERT INTO detalle ( idherramienta, prestadas ) VALUES ( :idherramienta, :prestadas )','SQLSTATE[HY000]: General error'),(73,NULL,'INSERT INTO detalle ( idherramienta, prestadas ) VALUES ( :idherramienta, :prestadas )','SQLSTATE[HY000]: General error');
/*!40000 ALTER TABLE `error` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `herramientas`
--

DROP TABLE IF EXISTS `herramientas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `herramientas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `idcategoria` int(11) unsigned DEFAULT NULL,
  `date` date DEFAULT NULL,
  `idubicacion1` int(11) unsigned DEFAULT 0,
  `idubicacion2` int(11) unsigned DEFAULT 0,
  `idubicacion3` int(11) unsigned DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `herramientas`
--

LOCK TABLES `herramientas` WRITE;
/*!40000 ALTER TABLE `herramientas` DISABLE KEYS */;
INSERT INTO `herramientas` VALUES (6,' SOLDADORES ESTAÃ‘O 75W ',2,20,'0000-00-00',5,6,7),(7,' SOLDADORES ESTAÃ‘O 45W ',4,20,'0000-00-00',5,6,7),(8,' BUSCAPOLOS  ',2,27,'0000-00-00',5,6,7),(9,' PELACABLES ',1,27,'0000-00-00',5,6,7),(10,' MULTIMETRO ',1,27,'0000-00-00',5,6,7),(11,' DESTORNILLADOR PH ',25,22,'0000-00-00',5,6,10),(12,' DESTORNILLADOR PL ',20,22,'0000-00-00',5,6,10),(13,' CLAVOS VARIOS ',0,25,'0000-00-00',5,6,10),(14,' COLA VINILICA ',1,25,'0000-00-00',5,6,10),(16,' SIERRAS CHICAS  ',11,17,'0000-00-00',5,6,11),(17,' REMACHADORAS ',3,0,'0000-00-00',5,6,11),(18,' PINZAS ',10,17,'0000-00-00',5,6,11),(19,' ALICATES ',13,17,'0000-00-00',5,6,11),(20,' PINZAS DE PUNTA ',7,17,'0000-00-00',5,6,11),(21,' ALARGUES ',10,27,'0000-00-00',5,6,11),(22,' CALADORAS ',2,17,'0000-00-00',5,8,7),(23,' AGUJEREADORAS ',3,21,'0000-00-00',5,8,7),(24,' PISTOLA DE SILICONA ',1,28,'0000-00-00',5,8,7),(25,' ESCUADRAS METALICAS ',11,18,'0000-00-00',5,8,7),(26,' PIE METALICO ',10,18,'0000-00-00',5,8,7),(27,' FALSA ESCUADRA ',8,18,'0000-00-00',5,8,7),(28,' CALIBRES  ',3,18,'0000-00-00',5,8,7),(29,' TRANSPORTADOR METALICO ',1,18,'0000-00-00',5,8,7),(30,' GUANTES SOLDADURA ',6,20,'0000-00-00',5,9,7),(31,' PIQUETA ',2,20,'0000-00-00',5,9,7),(32,' CEPILLO ACERO ',3,20,'0000-00-00',5,9,7),(33,' SOLDADORA ',2,20,'0000-00-00',5,9,7),(34,' DELANTAL CUERO ',6,20,'0000-00-00',5,9,7),(35,' MASCARA FOTOSENSIBLE ',3,20,'0000-00-00',5,9,7),(36,' SIERRAS  ',13,17,'0000-00-00',5,8,10),(37,' PRENSAS ',22,23,'0000-00-00',5,8,10),(38,' TENAZAS ',7,0,'0000-00-00',5,8,10),(39,' LLAVE FRANCESA ',1,17,'0000-00-00',5,8,10),(40,' CINTA METRICA ',1,18,'0000-00-00',5,8,10),(41,' METRO CARPINTERO ',6,18,'0000-00-00',5,8,10),(42,' MANDRILES  ',7,21,'0000-00-00',5,8,10),(43,' ACOPLES MECHA COPA ',2,21,'0000-00-00',5,8,10),(44,' PUNTAS VARIAS ',6,28,'0000-00-00',5,8,10),(45,' SERRUCHOS  ',12,17,'0000-00-00',5,8,10),(46,' TIJERA MULTIFUNCION ',10,17,'0000-00-00',5,8,11),(47,' TIJERA HOJALATERIA ',5,17,'0000-00-00',5,8,11),(48,' ESPATULAS ',13,28,'0000-00-00',5,8,11),(49,' MARTILLOS ',23,19,'0000-00-00',5,8,11),(50,' MARTILLOS GALPONEROS ',5,19,'0000-00-00',5,8,11),(51,' KIT MECHAS DE COPA GRIS ',2,21,'0000-00-00',5,8,11),(52,' KIT DE MECHAS DE COPA NARANJA ',0,21,'0000-00-00',5,8,11),(53,' KIT MECHAS DE COPA AMARILLO ',1,21,'0000-00-00',5,8,11),(54,' KIT MECHAS ROJO ',1,21,'0000-00-00',5,8,11),(55,' MECHAS PLANAS VARIAS MEDIDAS ',21,21,'0000-00-00',5,8,11),(56,' MASA DE GOMA ',7,19,'0000-00-00',5,8,15),(57,' MARTILLO DE PLASTICO ',3,19,'0000-00-00',5,8,15),(58,' MARTILLO BOLITA ',15,19,'0000-00-00',5,8,15),(59,' ANTEOJOS DE SEGURIDAD ',21,26,'0000-00-00',5,8,15),(60,' GUBIAS ',11,17,'0000-00-00',5,8,15),(61,' FORMONES ',12,17,'0000-00-00',5,8,15),(62,' CUTTER ',9,17,'0000-00-00',5,8,15),(63,' ESCOFINAS MEDIA CAÃ‘A ',31,24,'0000-00-00',5,8,15),(64,' ESCOFINAS REDONDA ',7,24,'0000-00-00',5,8,15),(65,' GUANTES ',18,26,'0000-00-00',5,8,16),(66,' INGLETERA ',2,28,'0000-00-00',5,8,16),(67,' LIMAS VARIAS MEDIDAS ',8,24,'0000-00-00',5,8,16),(68,' CORTAHIERROS ',6,17,'0000-00-00',5,8,16),(69,'Proyector',3,29,'0000-00-00',14,6,7);
/*!40000 ALTER TABLE `herramientas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reparacion`
--

DROP TABLE IF EXISTS `reparacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reparacion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idherramienta` int(10) unsigned NOT NULL DEFAULT 0,
  `fecha` date NOT NULL,
  `idestado` char(1) NOT NULL DEFAULT 'R',
  `problema` varchar(100) NOT NULL,
  `solucion` varchar(100) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reparacion`
--

LOCK TABLES `reparacion` WRITE;
/*!40000 ALTER TABLE `reparacion` DISABLE KEYS */;
INSERT INTO `reparacion` VALUES (6,6,'2020-05-04','R','punta',''),(7,43,'0000-00-00','R','','');
/*!40000 ALTER TABLE `reparacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_groups`
--

DROP TABLE IF EXISTS `user_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_level` (`group_level`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_groups`
--

LOCK TABLES `user_groups` WRITE;
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
INSERT INTO `user_groups` VALUES (1,'Admin',1,1),(2,'PAÃ‘OL',2,1),(3,'User',3,1);
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `user_level` (`user_level`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin Users','admin','d033e22ae348aeb5660fc2140aec35850c4da997',1,'pzg9wa7o1.jpg',1,'2020-06-18 15:24:31'),(2,'Special User','special','ba36b97a41e7faf742ab09bf88405ac04f99599a',2,'no_image.jpg',1,'2017-06-16 07:11:26'),(3,'Default User','user','12dea96fec20593566ab75692c9949596833adc9',3,'no_image.jpg',1,'2019-11-08 16:21:24');
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

-- Dump completed on 2020-06-18 15:42:06
