-- MySQL dump 10.16  Distrib 10.1.16-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: pttibd
-- ------------------------------------------------------
-- Server version	10.1.16-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `pttibd`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `pttibd` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `pttibd`;

--
-- Table structure for table `grupo`
--

DROP TABLE IF EXISTS `grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grupo` (
  `codigoGrupo` int(11) NOT NULL,
  `clasificacion` varchar(45) NOT NULL,
  `jornada` varchar(45) NOT NULL,
  `grado` int(11) NOT NULL,
  `institucion_codigoInstitucion` int(11) NOT NULL,
  PRIMARY KEY (`codigoGrupo`),
  KEY `fk_grupo_institucion1_idx` (`institucion_codigoInstitucion`),
  CONSTRAINT `fk_grupo_institucion1` FOREIGN KEY (`institucion_codigoInstitucion`) REFERENCES `institucion` (`codigoInstitucion`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grupo`
--
-- ORDER BY:  `codigoGrupo`

LOCK TABLES `grupo` WRITE;
/*!40000 ALTER TABLE `grupo` DISABLE KEYS */;
INSERT INTO `grupo` VALUES (0,'Drogadicción','Tarde',10,3),(2,'Inge','Tarde',5,3),(3,'Lab','Tarde',2,4),(123,'NPI','Mañana',11,1234);
/*!40000 ALTER TABLE `grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `informe`
--

DROP TABLE IF EXISTS `informe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `informe` (
  `codigoInforme` int(11) NOT NULL,
  `graficas` longblob,
  `cantidadTest` int(11) NOT NULL,
  `finalizados` int(11) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `pendientes` int(11) DEFAULT NULL,
  `realizados` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`codigoInforme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `informe`
--
-- ORDER BY:  `codigoInforme`

LOCK TABLES `informe` WRITE;
/*!40000 ALTER TABLE `informe` DISABLE KEYS */;
/*!40000 ALTER TABLE `informe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `institucion`
--

DROP TABLE IF EXISTS `institucion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `institucion` (
  `codigoInstitucion` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `telefono` int(11) NOT NULL,
  `sitioWeb` varchar(45) NOT NULL,
  `ciudad` varchar(45) NOT NULL,
  PRIMARY KEY (`codigoInstitucion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `institucion`
--
-- ORDER BY:  `codigoInstitucion`

LOCK TABLES `institucion` WRITE;
/*!40000 ALTER TABLE `institucion` DISABLE KEYS */;
INSERT INTO `institucion` VALUES (2,'UPB','alla',1234566,'upb.edu.co','Medellin'),(3,'UTP','Aqui',0,'http://www.utp.edu.co','Pereira'),(4,'UCP','',0,'',''),(6,'Maria Auxiliadora','Alla',1234321,'http://maria.com','Cartago'),(1234,'Universidad Tecnologica de Pereira','La Julita',3333333,'http://www.utp.edu.co','Pereira');
/*!40000 ALTER TABLE `institucion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_100000_create_password_resets_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('quirogacj@gmail.com','2d452748ddb8033cefc15e2cdd0f8f671ed8b6bfbcd3fa741c40b0bff32d8641','2016-10-10 20:32:47');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preguntastest`
--

DROP TABLE IF EXISTS `preguntastest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preguntastest` (
  `codigoPregunta` int(11) NOT NULL,
  `enunciado` varchar(45) NOT NULL,
  `opcionesRespuesta` varchar(200) NOT NULL,
  `respuestaCorrecta` varchar(45) NOT NULL,
  `test_codigoTest` int(11) NOT NULL,
  `test_tipoTest_codigoTipoTest` int(11) NOT NULL,
  PRIMARY KEY (`codigoPregunta`),
  KEY `fk_preguntasTest_test1_idx` (`test_codigoTest`,`test_tipoTest_codigoTipoTest`),
  CONSTRAINT `fk_preguntasTest_test1` FOREIGN KEY (`test_codigoTest`, `test_tipoTest_codigoTipoTest`) REFERENCES `test` (`codigoTest`, `tipoTest_codigoTipoTest`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preguntastest`
--
-- ORDER BY:  `codigoPregunta`

LOCK TABLES `preguntastest` WRITE;
/*!40000 ALTER TABLE `preguntastest` DISABLE KEYS */;
/*!40000 ALTER TABLE `preguntastest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `psicologo_has_grupo`
--

DROP TABLE IF EXISTS `psicologo_has_grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `psicologo_has_grupo` (
  `users_id` int(11) NOT NULL,
  `users_tipoUsuario_codigoTipoUsuario` int(11) NOT NULL,
  `grupo_codigoGrupo` int(11) NOT NULL,
  PRIMARY KEY (`users_id`,`users_tipoUsuario_codigoTipoUsuario`,`grupo_codigoGrupo`),
  KEY `fk_users_has_grupo_grupo1_idx` (`grupo_codigoGrupo`),
  KEY `fk_users_has_grupo_users1_idx` (`users_id`,`users_tipoUsuario_codigoTipoUsuario`),
  CONSTRAINT `fk_users_has_grupo_grupo1` FOREIGN KEY (`grupo_codigoGrupo`) REFERENCES `grupo` (`codigoGrupo`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_users_has_grupo_users1` FOREIGN KEY (`users_id`, `users_tipoUsuario_codigoTipoUsuario`) REFERENCES `users` (`id`, `tipoUsuario_codigoTipoUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `psicologo_has_grupo`
--
-- ORDER BY:  `users_id`,`users_tipoUsuario_codigoTipoUsuario`,`grupo_codigoGrupo`

LOCK TABLES `psicologo_has_grupo` WRITE;
/*!40000 ALTER TABLE `psicologo_has_grupo` DISABLE KEYS */;
INSERT INTO `psicologo_has_grupo` VALUES (1088023098,2,123),(1111222333,2,3),(2147483647,2,0);
/*!40000 ALTER TABLE `psicologo_has_grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitudes`
--

DROP TABLE IF EXISTS `solicitudes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitudes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `tipoDocumento` varchar(45) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `password` varchar(60) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `genero` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `grupo_codigoGrupo` int(11) DEFAULT NULL,
  `institucion_codigoInstitucion` int(11) DEFAULT NULL,
  `tipoUsuario_codigoTipoUsuario` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`,`tipoUsuario_codigoTipoUsuario`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_usuario_grupo1_idx` (`grupo_codigoGrupo`),
  KEY `fk_usuario_institucion1_idx` (`institucion_codigoInstitucion`),
  KEY `fk_usuario_tipoUsuario1_idx` (`tipoUsuario_codigoTipoUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitudes`
--
-- ORDER BY:  `id`,`tipoUsuario_codigoTipoUsuario`

LOCK TABLES `solicitudes` WRITE;
/*!40000 ALTER TABLE `solicitudes` DISABLE KEYS */;
INSERT INTO `solicitudes` VALUES (1088098098,'Aquiles','Bailo','aquilesbailo@consabor.com','CC','2016-10-11',1,'$2y$10$LJUi5Y0hUvvWVLqkyDUOtutbsPivVi3oAUmM7T8WEXmzrYC5HlUVO',NULL,'Masculino','4321432',123,1234,1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `solicitudes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `codigoTest` int(11) NOT NULL,
  `resultado` varchar(45) NOT NULL,
  `diagnostico` varchar(100) DEFAULT NULL,
  `descripcion` varchar(45) NOT NULL,
  `enunciado` varchar(200) NOT NULL,
  `estadoTest` varchar(45) NOT NULL,
  `usuario_numeroDocumento` int(11) NOT NULL,
  `usuario_tipoUsuario_codigoTipoUsuario` int(11) NOT NULL,
  `tipoTest_codigoTipoTest` int(11) NOT NULL,
  `informe_codigoInforme` int(11) NOT NULL,
  PRIMARY KEY (`codigoTest`,`tipoTest_codigoTipoTest`),
  KEY `fk_test_usuario1_idx` (`usuario_numeroDocumento`,`usuario_tipoUsuario_codigoTipoUsuario`),
  KEY `fk_test_tipoTest1_idx` (`tipoTest_codigoTipoTest`),
  KEY `fk_test_informe1_idx` (`informe_codigoInforme`),
  CONSTRAINT `fk_test_informe1` FOREIGN KEY (`informe_codigoInforme`) REFERENCES `informe` (`codigoInforme`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_test_tipoTest1` FOREIGN KEY (`tipoTest_codigoTipoTest`) REFERENCES `tipotest` (`codigoTipoTest`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_test_usuario1` FOREIGN KEY (`usuario_numeroDocumento`, `usuario_tipoUsuario_codigoTipoUsuario`) REFERENCES `usuario` (`numeroDocumento`, `tipoUsuario_codigoTipoUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--
-- ORDER BY:  `codigoTest`,`tipoTest_codigoTipoTest`

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipotest`
--

DROP TABLE IF EXISTS `tipotest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipotest` (
  `codigoTipoTest` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`codigoTipoTest`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipotest`
--
-- ORDER BY:  `codigoTipoTest`

LOCK TABLES `tipotest` WRITE;
/*!40000 ALTER TABLE `tipotest` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipotest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipousuario`
--

DROP TABLE IF EXISTS `tipousuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipousuario` (
  `codigoTipoUsuario` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`codigoTipoUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipousuario`
--
-- ORDER BY:  `codigoTipoUsuario`

LOCK TABLES `tipousuario` WRITE;
/*!40000 ALTER TABLE `tipousuario` DISABLE KEYS */;
INSERT INTO `tipousuario` VALUES (0,'root'),(1,'administrador'),(2,'psicologo'),(3,'estudiante');
/*!40000 ALTER TABLE `tipousuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `tipoDocumento` varchar(45) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `password` varchar(60) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `genero` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `grupo_codigoGrupo` int(11) DEFAULT NULL,
  `institucion_codigoInstitucion` int(11) DEFAULT NULL,
  `tipoUsuario_codigoTipoUsuario` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`,`tipoUsuario_codigoTipoUsuario`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_usuario_grupo1_idx` (`grupo_codigoGrupo`),
  KEY `fk_usuario_institucion1_idx` (`institucion_codigoInstitucion`),
  KEY `fk_usuario_tipoUsuario1_idx` (`tipoUsuario_codigoTipoUsuario`),
  CONSTRAINT `fk_usuario_grupo1` FOREIGN KEY (`grupo_codigoGrupo`) REFERENCES `grupo` (`codigoGrupo`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_usuario_institucion1` FOREIGN KEY (`institucion_codigoInstitucion`) REFERENCES `institucion` (`codigoInstitucion`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_usuario_tipoUsuario1` FOREIGN KEY (`tipoUsuario_codigoTipoUsuario`) REFERENCES `tipousuario` (`codigoTipoUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--
-- ORDER BY:  `id`,`tipoUsuario_codigoTipoUsuario`

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (987654321,'Elbis','Tek','elbis@hotmail.net','CC','2016-10-11',1,'$2y$10$mxL7TfMKZhdJJDcX6.vFluS3dNWgCrJWMuhEteU8wCT/zRT2BF1n.','YFdV5RvylqZmmiqOmps5WFORAYmvNafnWZauxEHEB8mgbDjA8gOptNmtP3m1','Masculino','1234567',NULL,1234,2,'2016-10-11 10:35:58','2016-10-23 10:36:42'),(1018282135,'Lavinia','Bogisich','anissa.dach@example.com','TI','1995-02-28',0,'$2y$10$m7KUIyyT9PhsQdi9m36WM.8gItZuxFp5Uiap/Qu7mGvIWf8dNr6ie','Kavnr3brKB','0','+3168169608671',0,3,2,'2016-10-10 04:06:13','2016-10-14 09:15:23'),(1020857594,'Jazlyn','Hamill','schuppe.dena@example.net','TI','1997-09-12',0,'$2y$10$c6HonmE7ZCLs92QRi2p1c.2eIDHIKyJrpRhT7KKEn6JJpgYeK8lH2','PRp5HUM413','0','+1987101669315',0,3,3,'2016-10-10 04:06:13','2016-10-10 04:06:13'),(1024015285,'Ahmed','Morar','ara90@example.org','TI','2005-03-21',0,'$2y$10$j9fOgjxG0QkJg5ajB4IV1.MyCpfCxKwLjbPZHjrBQuw/jVTr4UkN.','sIIbZqjZWe','1','+5249974159109',0,3,3,'2016-10-10 04:06:13','2016-10-10 04:06:13'),(1036694470,'Gust','Wiza','mmarquardt@example.net','TI','2009-04-22',1,'$2y$10$9SlV404HT3QBHVxYxMJx1ueoolzOabO9tjQk6W6jjNvo8kHDaklKS','xoS9sFgkEW','Otro','+6366957401570',0,3,3,'2016-10-10 04:06:13','2016-10-24 09:04:07'),(1078900121,'Jeanette','Haley','muller.priscilla@example.org','CC','1994-03-04',0,'$2y$10$RgYuFm4a9..hOlY3ea2LZ.OuwwydcrRpzHKPzz4W.Q2Z3ygCPgf.a','3gLIsdH2CX','0','+6366741346516',NULL,3,1,'2016-10-10 04:06:14','2016-10-10 04:06:14'),(1081841367,'Cleve','Hartmann','flossie.lind@example.com','TI','2006-01-14',0,'$2y$10$AQGKRahwrLtENMvXmFELvOK6RYL2epZs25D/118bXn0VnNV1IR7QC','2s7jhpx7kn','1','+5676911901957',NULL,3,1,'2016-10-10 04:06:14','2016-10-14 09:15:32'),(1085293547,'Grady','Muller','tiara.treutel@example.org','TI','1986-12-03',0,'$2y$10$9ZpfDprekLZ.hC2uhfUDCeHwE.7aqpJq.v5vg1o2rVI6ZGE0xEgCy','y4bbwTSe9U','0','+7615354050301',0,3,3,'2016-10-10 04:06:14','2016-10-10 04:06:14'),(1088023094,'Johan','Quiroga','quirogacj@gmail.com','CC','1995-07-19',1,'$2y$10$mxL7TfMKZhdJJDcX6.vFluS3dNWgCrJWMuhEteU8wCT/zRT2BF1n.','IChVeXqkYwav2KJ1HC32OwPvbsFVcZZwOGsdNBLjBwBD6sOmYQNG28zXUwRC','Masculino','3420543',NULL,1234,1,'2016-10-10 08:56:53','2016-10-24 09:11:28'),(1088023098,'Camilo','Quiroga','quirogacj@hotmail.co','CC','2016-10-18',1,'$2y$10$mxL7TfMKZhdJJDcX6.vFluS3dNWgCrJWMuhEteU8wCT/zRT2BF1n.','ZaUZXfLV9GDKWkZigjRFopAwJis836GCYTpEmFnctXXvngvPV5MqgS3rvKfy','Masculino','1234321',0,6,2,'2016-10-18 09:51:31','2016-10-23 10:33:18'),(1088335384,'Jimy Andres','Alzate Ramirez','jimmy.andres.23@gmail.com','CC','1996-06-01',1,'$2y$10$mxL7TfMKZhdJJDcX6.vFluS3dNWgCrJWMuhEteU8wCT/zRT2BF1n.','v7oB9IlFvFdxIGzcZ1PmgWWG62Jj0y46xRAzzkzqZSmnOx4L8LKVJ1cTFPNd','Otro','1234567',NULL,4,2,'2016-10-18 10:22:13','2016-10-24 09:05:24'),(1088623591,'Heidi','Christiansen','glenna49@example.net','TI','1998-06-18',0,'$2y$10$XvD8k9Hu/dQ2/25E9FvKn.zEJ5YeNniI5cxlgcdg1FHCwO.9W/fHm','ZhKGKIw1At','1','+0770978911705',0,3,3,'2016-10-10 04:06:14','2016-10-10 04:06:14'),(1098098098,'Prueba','Prueba','prueba@gmail.com','CC','2016-10-13',1,'$2y$10$hvujfSgdBtPLJO5G03FAmeKI9d2nW7GVPu9Kha5CJQ1ozwSayCdse','pfn4wsWJIPXadHjHPCXb5CIBjVAjrP8dwFtvJfPoPDazNnnd1EcZGKFgFgyP','Femenino','1122334',123,1234,3,'2016-10-13 23:37:28','2016-10-23 10:30:24'),(1099174696,'Uriah','Fadel','angelo.cummerata@example.com','TI','1996-02-29',1,'$2y$10$4.QFZauI7DDbyKI1p20aLOakmVJUaqnliRwNfedWTsIsftQBZqhV6','dQUUJ4k0ld','Otro','+8552100086264',0,3,3,'2016-10-10 04:06:13','2016-10-23 01:54:02'),(1111222333,'Valentina','Franco Rendon','valenfranco@hotmail.com','TI','1995-11-09',1,'$2y$10$aD8QxJ28I0VV45p5WqbGge2qtr9kyhQ.XgjzPAiwsvv/sUk7kZh.C','IDYYENNulmZXfj4iHOOg7gmVW86L4CqDPiF0to8CVZu98HNMwc33se3gawEl','Masculino','1314613',NULL,4,2,'2016-10-15 12:36:47','2016-10-24 09:34:56'),(1112786872,'Luis David','Arias Manjarrez','david-0296@hotmail.com','CC','1996-03-02',1,'$2y$10$SfWSW8jJr8g1qdqrnGIjUejo9tQAsGic.rUuiiiPpLkx13jPRNb2W','rjzmnlI4ySU8clc9Ok4HcTNKLAlvTwAkvIwnJKnh9UvMkjmrVwe7exQJ4aP3','Masculino','2144919',NULL,6,1,'2016-10-14 16:25:47','2016-10-24 09:34:33'),(1113546978,'Daniel Felipe','Agudelo Caicedo Guayabita','pipe.0325@hotmail.com','CC','1996-03-25',1,'$2y$10$UO94IrnmmH6FsbgnhM/.hOsN0s8nmCw/.sKw7ZbCz4.HM26eMG6ty','KchDHJQhgoqjnv8wLZbFgjYscMvfHfjvQWNryJi2mvWECHER6bjjxpXnKSVm','Masculino','2011467',123,1234,3,'2016-10-12 07:18:04','2016-10-24 09:33:55'),(1122146927,'Jaclyn','Bergstrom','hkertzmann@example.com','TI','1971-09-15',1,'$2y$10$L5KP3aLWoZDkTebbdocQW.4oCBcPIzkkqEpbUtDYIKrisongyOUtO','ZPCKKy5CDS','0','+1273257790182',0,3,3,'2016-10-10 04:06:13','2016-10-10 04:06:13'),(1124255167,'Neal','VonRueden','ythompson@example.net','TI','1997-08-07',0,'$2y$10$IRZDYHNo603.gKMyvKHe0eWuza3RssaJN3CtpoO1.dqyLaKQGp9ZG','2fwyPmvvob','0','+1054204248533',NULL,3,1,'2016-10-10 04:06:14','2016-10-10 04:06:14'),(1124552572,'Connie','Orn','ulabadie@example.com','CC','1996-12-21',0,'$2y$10$lwSiRJcK.JAARmzTMfXRFuqEdjONECrs9N9DR.L855coMoOTe2EPq','EUcbaLGu4Y','0','+0591751630353',0,3,3,'2016-10-10 04:06:13','2016-10-14 09:16:16'),(1124850957,'Renee','Wilkinson','homenick.simeon@example.net','CC','1998-10-05',0,'$2y$10$U015W6cYrdN8zINzuMx9WeIVe3gd5ZqbRhw..jTFlM2w28Hbu/dnS','1KMJRqVJjV','0','+8071895762366',0,3,2,'2016-10-10 04:06:14','2016-10-10 04:06:14'),(1131836828,'Felicita','Goyette','norwood84@example.net','CC','1982-05-09',1,'$2y$10$L8RF8HOdKm5t80IepSy9s.TuYqgIPt3qu6fnCtpm/kEDtyvbL4TFm','RvP1aTa66P','Masculino','+6399971671570',NULL,3,2,'2016-10-10 04:06:13','2016-10-23 01:09:58'),(1143852627,'Angeline','Bashirian','jamie.ritchie@example.com','CC','1990-12-24',0,'$2y$10$JnWMshXtdiHy9rktCjfdN.51R0uOUU3DVMr/LMKJZjC4Lr1cKcn96','75ipq8EzMo','1','+6569860286932',0,3,2,'2016-10-10 04:06:13','2016-10-10 04:06:13'),(1156847824,'Willa','Rolfson','kheathcote@example.org','TI','1990-05-28',1,'$2y$10$GX/BrZW0TGNJcfnymlYz1e60EF9yAoA.I8.kQVzLSppAjwqDWC5ju','jYT3oKBMec','Femenino','+3834992671966',NULL,3,2,'2016-10-10 04:06:14','2016-10-23 01:10:12'),(1164266215,'Noah','Kessler','voconner@example.org','CC','2012-04-23',0,'$2y$10$4r5DAapNGTJDr0AAgK28NeSio6aN.cU.WNESWS1Jsqc0U1yzkwbtm','jp2Ho9QUM4','1','+2918692766124',0,3,3,'2016-10-10 04:06:12','2016-10-10 04:06:12'),(1191085295,'Webster','Kilback','paucek.caterina@example.net','TI','2007-01-21',0,'$2y$10$9S1U4yQobjkAVd./PQb.8eRB5xTaP0jQpR3LdJk0qvY59pXT/kp3G','OblhDtNWnG','0','+6109000712629',0,3,2,'2016-10-10 04:06:14','2016-10-10 04:06:14'),(1208863805,'Tod','Rodriguez','mariana15@example.org','CC','2001-08-05',0,'$2y$10$Hr6ZUrCY6hp35MTufKy2GOBupCS6p7PSHITWhzy083EqbPVc1Z.1O','xMe6MJchmF','0','+1375095750023',NULL,3,1,'2016-10-10 04:06:14','2016-10-16 00:16:17'),(1212550919,'Sincere','Rippin','greyson.williamson@example.net','TI','1998-09-21',0,'$2y$10$d2oyzr4DEbeRW11sABNARev0fmesRPVDzwmEgqE2.0Rw6ayE5ozMG','H0dxmpEBbZ','0','+4140904648686',0,3,3,'2016-10-10 04:06:14','2016-10-10 04:06:14'),(1214361020,'Orie','Hintz','cristobal21@example.com','CC','1998-09-22',1,'$2y$10$LNDWFosdCbR.iv6YIS1ogOIZ98C1puhY5BveuajaXf.B4T5vCRWJ6','fOSUVXn5Fc','Otro','+4297045620240',0,3,3,'2016-10-10 04:06:13','2016-10-23 00:35:44'),(1239488312,'Lina','Wolff','sreichert@example.com','CC','2013-03-25',0,'$2y$10$VyctobpaVsfRwKiCumbl0Ot5biUbh/QuKWa2Fd50EH4LpXc9JscZS','zNv56aM1ZM','1','+6400261311838',0,3,3,'2016-10-10 04:06:13','2016-10-10 04:06:13'),(1241982018,'Fanny','Medhurst','reinhold75@example.org','CC','1979-08-02',0,'$2y$10$bnj7kgiCIyr5J4cTHZkMWu3GkbqBkdrIuDeMUucoIP2Lul.w.N8KS','vAns3YqB4A','1','+0249432549591',NULL,3,1,'2016-10-10 04:06:13','2016-10-10 04:06:13'),(1256418942,'Lon','Kautzer','heller.izaiah@example.org','TI','2002-11-19',0,'$2y$10$LfU4PE5F0j5MVEZhBBa/BOKfhG73.7O0jtYGNR04UIhraGRk1nA.2','qXebk4demQ','0','+8452691787407',0,3,2,'2016-10-10 04:06:14','2016-10-10 04:06:14'),(1260750939,'Marianna','Roob','xstark@example.com','CC','2010-01-01',0,'$2y$10$P6LCgVSQCEenU8U2nvJzze.F9cYP62/zR9xlynlMgRM8M4P5LiCLm','S9w3DulQYu','0','+2119374169005',0,3,2,'2016-10-10 04:06:14','2016-10-10 04:06:14'),(1262043848,'Pansy','Doyle','gayle58@example.net','CC','1999-01-23',0,'$2y$10$OsQrdlGx1HwfrLSDonBAbuB90JugE9a4gySt1Lpiw1niOLgbIbCbO','RsJyLSormv','0','+2426002331258',0,3,3,'2016-10-10 04:06:14','2016-10-10 04:06:14'),(1267261823,'Maureen','Nolan','jfisher@example.org','TI','1990-11-25',0,'$2y$10$fjjZIE9k9yqLg0hn7BRw2.SVujwP/e0oVKWg.0bYfZ5.wzBUpmXP.','UUvdLihA6N','1','+9622208759455',0,3,3,'2016-10-10 04:06:13','2016-10-10 04:06:13'),(1267756941,'Davin','Hermiston','eleanore20@example.net','CC','1997-11-27',0,'$2y$10$NF47XKZTyKEqAwf2gYjgUOeej7f/41Vt5wpbQQKw/0l7bxDN6bZmm','SJkN3L701e','0','+0959358048095',NULL,3,1,'2016-10-10 04:06:14','2016-10-10 04:06:14'),(1281134551,'Lon','Doyle','solon15@example.org','TI','1999-07-29',0,'$2y$10$Que64qjMDRKLlBRHOaMTBO28H3rBW1wIinEjBwLiz2JaowvfSI3Qi','bLw6rPcLbt','0','+4618912547818',NULL,3,1,'2016-10-10 04:06:14','2016-10-10 04:06:14'),(1285582528,'root','root','root@ptti.com','CC','1984-06-14',1,'$2y$10$twuPw5PTXnugZXNzJacoNObPzx9qY9mchFoiz9ky9uTMTgDJ6toJO','hNstOXEDW6OIdGz2fLtINrGLouf1VpLv4hEwHUQfEmFwR5HatYWc2K0lKt89','Masculino','+8729690697702',0,3,0,'2016-10-10 04:06:08','2016-10-24 09:12:24'),(1290841971,'Jared','Quitzon','sister.rippin@example.org','TI','1991-10-15',0,'$2y$10$MVaVvi9D2EsizedkcNGNzeOkxwiartvZKOEN3GwaW5.YS7/ZLKMJi','A2rn29EObs','0','+9852251260277',0,3,2,'2016-10-10 04:06:13','2016-10-10 04:06:13'),(1296231414,'Emory','Heidenreich','lawrence52@example.org','TI','2014-12-21',1,'$2y$10$4vgi1HlMk5Ys0L4pKMYEIuMnBacndUhcqTcSFlf1ma0ULplmeZFdm','y3IqoM339f','Masculino','+7948729138030',NULL,3,1,'2016-10-10 04:06:13','2016-10-18 00:39:06'),(1300877298,'Marlen','Harris','lester87@example.org','TI','1986-04-11',1,'$2y$10$ma9lnItDre7BQMgaRaiQc.pGrS.JnFUAabAmmBSFPZBdMsZXXk9LC','6efWUNTehZ','Otro','+7328244462327',NULL,3,1,'2016-10-10 04:06:14','2016-10-17 11:37:15'),(1302285198,'Joannie','Stracke','ava.pouros@example.org','CC','2014-05-30',1,'$2y$10$q1TMtvzVQmiljDnJsMcKc.QGzSvNluFhEGx3C/WwIRlJgR/BJzTFu','2IUOJ67gcv','Otro','+9582720774783',NULL,3,2,'2016-10-10 04:06:12','2016-10-23 01:10:21'),(1304315965,'Dan','Hand','meaghan55@example.net','CC','1995-03-03',0,'$2y$10$lBXKvr5reb0/8J9bUgbZGuxjzcu/PehBI0RMexqcaTjVLSIYWfxL2','g59eTZNRkO','0','+2640602584195',0,3,3,'2016-10-10 04:06:14','2016-10-10 04:06:14'),(1311581083,'Margarita','McKenzie','dickinson.river@example.org','CC','1973-09-14',0,'$2y$10$GyR79vcEGj4WWFmCGrOmX.PzcTEKyfi30GYXYPfMvCWVwtnjAhINy','OsvSi16wsx','0','+9666717932815',0,3,2,'2016-10-10 04:06:13','2016-10-10 04:06:13'),(1312771001,'Lauryn','Lemke','serena.hilll@example.net','CC','1977-06-02',0,'$2y$10$FI8zrvTGta/0B9ZfxJbzb.3S5nVg1aH8Tj2.E0S5hYJMU.p1mZu7C','5o9CVSQ2SV','0','+9160495603900',NULL,3,1,'2016-10-10 04:06:14','2016-10-16 01:39:43'),(1315827882,'Dewitt','Blanda','lehner.conner@example.com','CC','1998-09-17',0,'$2y$10$CFJ1Ifg0KgFXp2wIUvS2zO0dMGBIHPGC3PosLo4WQ9TeZy8XPTRbG','vuQQliErgw','1','+1243152615639',NULL,3,1,'2016-10-10 04:06:13','2016-10-16 00:36:15'),(1320946851,'Abigayle','Terry','genevieve.keeling@example.com','TI','1995-11-29',0,'$2y$10$gMlKEpIVSIle6GQ/.Mtofutank7AKP0HtwI2TvuTU3LZXfa6b0gcK','N1u0q6jQu3','0','+7388114580103',0,3,3,'2016-10-10 04:06:13','2016-10-10 04:06:13'),(1321278139,'Rosie','Torphy','hackett.enola@example.com','TI','2003-02-27',1,'$2y$10$dzL11S3lXWsz7JaIkE4O6OY5lmmtml/NT8l2IncDkgF.GkjpiO3ha','Iei761SqAP','Femenino','+6261910184399',NULL,3,2,'2016-10-10 04:06:13','2016-10-23 01:10:40'),(1324245340,'Candace','Harris','zboyer@example.org','CC','2001-06-20',1,'$2y$10$KkUAQKj1xVRA/SU/4WVhKOTxw9gA26zs1JVjjWmsC3s/T9wAoB9Su','C8tAk7jHKf','Femenino','+7280312753408',NULL,3,2,'2016-10-10 04:06:13','2016-10-23 01:29:13'),(1340161901,'Noemie','Huels','golden.stark@example.org','TI','1981-01-31',0,'$2y$10$dlZc.hUh/PP45C6Go11FleasRT87wWj5lOi7xMxJo42XpZXzokqOW','NCqvxff5LC','1','+2464094779928',0,3,2,'2016-10-10 04:06:14','2016-10-10 04:06:14'),(1345733586,'Lula','Grimes','doyle.rachael@example.org','TI','2005-05-06',0,'$2y$10$SOF271bKFK1I1otCBLqBhO2CFEOJFYgRRUTfC8yMiv8HSYNE6NuzC','y5uOiQv7vt','0','+7305840982103',0,3,3,'2016-10-10 04:06:12','2016-10-10 04:06:12'),(1348339663,'Elda','Hartmann','rbreitenberg@example.org','CC','1992-09-13',0,'$2y$10$q2eabte0Knlegm4DH9IjYuUo1dRdMDz7aiiK7i59AEw.g9smhAXUG','spdSwUkGnN','0','+0014704476858',0,3,3,'2016-10-10 04:06:13','2016-10-10 04:06:13'),(1372153123,'Fermin','Nader','orunolfsdottir@example.org','TI','1974-09-01',1,'$2y$10$lVZy/.FBuxXIPZHI9P8wMOFJwvIhH7RssNSeXl/w4lpknLFRri8ie','jb8W38U1Tu','1','+7346867029455',0,3,3,'2016-10-10 04:06:13','2016-10-10 04:06:13'),(1389226608,'Leta','Spinka','maurice.fritsch@example.net','TI','1976-11-25',0,'$2y$10$QiCUxqc88Y4/QSIwBT6ZVep.N4j.4tzbAJQyTV6SaqkFeE859KORO','5xsHMQNcpX','0','+0985895196636',0,3,3,'2016-10-10 04:06:13','2016-10-10 04:06:13'),(1394090721,'Margret','Wunsch','moen.cristopher@example.org','TI','1972-01-16',0,'$2y$10$HTTjA0IAW1fkZh/99/XXueBfsVYCBi23c5M1ibAKZ2bT6R3CYn7zK','YyGwuYb7yN','1','+5621471425976',0,3,3,'2016-10-10 04:06:13','2016-10-10 04:06:13'),(1400671460,'Brennon','Mante','emery69@example.org','TI','1991-05-07',0,'$2y$10$QIq7C/2P.tBhZlYNXe33EeghD02.cs0hBXm2KLbTUqu.A9NNSRw3q','g7Jtm69amA','0','+9518567248756',0,3,2,'2016-10-10 04:06:14','2016-10-10 04:06:14'),(1400745215,'Ellis','Abshire','lhyatt@example.net','TI','2016-03-30',0,'$2y$10$q36YnMJffL1MFHM4YcK5cuGl06wssI91VU5b0YXjja/5yf/DAheDi','EduH0Mg9pY','0','+9290291509924',0,3,2,'2016-10-10 04:06:14','2016-10-10 04:06:14'),(1403908801,'Fleta','Rogahn','walter.daniella@example.org','TI','1989-12-10',0,'$2y$10$uXNQ5F/VgbXEh5Xn.6QCnOVv40nEX90jB4drRK6FORGYfRwhNBZqa','BlYbU0tvyl','1','+8150896703814',0,3,2,'2016-10-10 04:06:14','2016-10-10 04:06:14'),(2147483646,'No','Se','nose@gmail.com','CC','2016-10-22',1,'$2y$10$FFhODz07TwRO9nMwm3kkROW1UQZqSdjVth3U79ztT.nvFmGN/joe6','cKFzeOpkjEUHdx0zyxnI0Sp206FO403xgHHs6FKykKFpj9AJGvpp37eQpWwf','Masculino','1111111',123,1234,3,'2016-10-23 01:50:49','2016-10-23 01:51:50'),(2147483647,'Test','Test','test@test.net','CC','2016-10-22',1,'$2y$10$j8IsFZZePLf7fNXOif8pMuw3SgEAK2glfnQIqrolW.5MWQnrSeYt2',NULL,'Otro','1232121',NULL,3,2,'2016-10-23 00:26:19','2016-10-23 00:29:12');
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

-- Dump completed on 2016-10-23 23:44:54
