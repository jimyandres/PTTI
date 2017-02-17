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

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `pttibd` /*!40100 DEFAULT CHARACTER SET latin1 */;

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
INSERT INTO `grupo` VALUES (0,'Drogadicción','Tarde',10,3),(2,'Inge','Tarde',6,6),(3,'Lab','Tarde',2,4),(123,'NPI','Mañana',11,1234),(456,'Maria','Mañana',6,6),(999,'UPB','Tarde',8,2);
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
  `codigoPregunta` int(11) NOT NULL AUTO_INCREMENT,
  `enunciado` varchar(45) NOT NULL,
  `opcionesRespuesta` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`codigoPregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preguntastest`
--
-- ORDER BY:  `codigoPregunta`

LOCK TABLES `preguntastest` WRITE;
/*!40000 ALTER TABLE `preguntastest` DISABLE KEYS */;
INSERT INTO `preguntastest` VALUES (3,'Pregunta modificada 2','Opcion A 3#Opcion B 3#Opciona C 3#Opcion D 3'),(4,'Pregunta 1 de muchas','A#B#C#D'),(5,'Pregunta 2 de muchas','A2#B2#C2#D2'),(6,'Pregunta modificada 2','Opcion A3#Opcion B3#Opciona C3#Opcion D3'),(7,'Cuando aprendo...','me gusta vivir sensaciones#me gusta pensar sobre ideas#me gusta estar haciendo cosas#me gusta observar y escuchar'),(8,'Aprendo mejor cuando...','escucho y observo cuidadosamente#confío en el pensamiento lógico#confío en mi intuición y sentimientos#trabajo duro para lograr hacer las cosas'),(9,'Cuando estoy aprendiendo...','tiendo a usar el razonamiento#soy responsable con lo que hago#soy callado y reservado#tengo fuertes sensaciones y reacciones'),(10,'Yo aprendo...','sintiendo#haciendo#observando#pensando'),(11,'Cuando aprendo... modificada','estoy abierto a nuevas experiencias#observo todos los aspectos del asunto#me gusta analizar las cosas, descomponerlas en sus partes#me gusta probar e intentar hacer las cosas'),(12,'Prueba nuevo separador','Opcion A#Opcion B#Opcion C#Opcion D'),(14,'Prueba pregunta nueva modificada','A#B#C#D'),(15,'PRueba','A#B#C#D'),(16,'Cuando aprendo...','estoy abierto a nuevas experiencias#observo todos los aspectos del asunto#me gusta analizar las cosas, descomponerlas en sus partes#me gusta probar e intentar hacer las cosas'),(17,'Cuando estoy aprendiendo...','soy una persona observadora#soy una persona activa#soy una persona intuitiva#soy una persona lógica'),(18,'Yo aprendo mejor de...','la observacion#la relación con otras personas#las teorías racionales#la oportunidad de probar y practicar'),(19,'Cuando aprendo...','me gusta ver los resultados de mi trabajo#me gustan las ideas y las teorías#me tomo mi tiempo antes de actuar#me siento personalmente involucrado en las cosas'),(20,'Aprendo mejor cuando...','confío en mis observaciones#confío en mis sentimientos#puedo probar por mi cuenta#confío en mis ideas'),(21,'Cuando estoy aprendiendo...','soy una persona reservada#soy una persona receptiva#soy una persona responsable#soy una persona racional'),(22,'Cuando aprendo...','me involucro#me gusta observar#evalúo las cosas#me gusta ser activo'),(23,'Aprendo mejor cuando...','analizo ideas#soy receptivo y abierto#soy cuidadoso#soy práctico');
/*!40000 ALTER TABLE `preguntastest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `psicologo_has_grupo`
--

DROP TABLE IF EXISTS `psicologo_has_grupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `psicologo_has_grupo` (
  `users_id` varchar(11) NOT NULL,
  `users_tipoUsuario_codigoTipoUsuario` int(11) NOT NULL,
  `grupo_codigoGrupo` int(11) NOT NULL,
  PRIMARY KEY (`users_id`,`users_tipoUsuario_codigoTipoUsuario`,`grupo_codigoGrupo`),
  KEY `fk_users_has_grupo_grupo2` (`grupo_codigoGrupo`),
  CONSTRAINT `fk_users_has_grupo_grupo2` FOREIGN KEY (`grupo_codigoGrupo`) REFERENCES `grupo` (`codigoGrupo`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_users_has_grupo_users2` FOREIGN KEY (`users_id`, `users_tipoUsuario_codigoTipoUsuario`) REFERENCES `users` (`id`, `tipoUsuario_codigoTipoUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `psicologo_has_grupo`
--
-- ORDER BY:  `users_id`,`users_tipoUsuario_codigoTipoUsuario`,`grupo_codigoGrupo`

LOCK TABLES `psicologo_has_grupo` WRITE;
/*!40000 ALTER TABLE `psicologo_has_grupo` DISABLE KEYS */;
INSERT INTO `psicologo_has_grupo` VALUES ('57079417015',2,2),('57079417015',2,456);
/*!40000 ALTER TABLE `psicologo_has_grupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respuestas`
--

DROP TABLE IF EXISTS `respuestas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `respuestas` (
  `idRespuestas` int(11) NOT NULL AUTO_INCREMENT,
  `preguntasTest_codigoPregunta` int(11) NOT NULL,
  `respuesta` varchar(10) NOT NULL,
  `users_id` varchar(11) NOT NULL,
  `users_tipoUsuario_codigoTipoUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idRespuestas`),
  KEY `fk_respuestas_preguntasTest1` (`preguntasTest_codigoPregunta`),
  KEY `fk_respuestas_users1` (`users_id`,`users_tipoUsuario_codigoTipoUsuario`),
  CONSTRAINT `fk_respuestas_preguntasTest1` FOREIGN KEY (`preguntasTest_codigoPregunta`) REFERENCES `preguntastest` (`codigoPregunta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_respuestas_users1` FOREIGN KEY (`users_id`, `users_tipoUsuario_codigoTipoUsuario`) REFERENCES `users` (`id`, `tipoUsuario_codigoTipoUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respuestas`
--
-- ORDER BY:  `idRespuestas`

LOCK TABLES `respuestas` WRITE;
/*!40000 ALTER TABLE `respuestas` DISABLE KEYS */;
INSERT INTO `respuestas` VALUES (1,7,'1#2#3#4','3533965187',3),(2,8,'4#3#2#1','3533965187',3),(3,9,'2#1#4#3','3533965187',3);
/*!40000 ALTER TABLE `respuestas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitudes`
--

DROP TABLE IF EXISTS `solicitudes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitudes` (
  `id` varchar(11) NOT NULL,
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
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tipoUsuario_codigoTipoUsuario` int(11) NOT NULL,
  `institucion_codigoInstitucion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`tipoUsuario_codigoTipoUsuario`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_solicitudes_grupo1` (`grupo_codigoGrupo`),
  KEY `fk_solicitudes_tipoUsuario1` (`tipoUsuario_codigoTipoUsuario`),
  KEY `fk_solicitudes_institucion1` (`institucion_codigoInstitucion`),
  CONSTRAINT `fk_solicitudes_grupo1` FOREIGN KEY (`grupo_codigoGrupo`) REFERENCES `grupo` (`codigoGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_solicitudes_institucion1` FOREIGN KEY (`institucion_codigoInstitucion`) REFERENCES `institucion` (`codigoInstitucion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_solicitudes_tipoUsuario1` FOREIGN KEY (`tipoUsuario_codigoTipoUsuario`) REFERENCES `tipousuario` (`codigoTipoUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitudes`
--
-- ORDER BY:  `id`,`tipoUsuario_codigoTipoUsuario`

LOCK TABLES `solicitudes` WRITE;
/*!40000 ALTER TABLE `solicitudes` DISABLE KEYS */;
INSERT INTO `solicitudes` VALUES ('12345678999','luis','romero','luis@utp.edu','CC','1990-11-03',1,'$2y$10$dUu8IEr10Bwqryi/NU2tOO053x1MlCv36PPhP9JnrCLHLmiqzXoI6',NULL,'Masculino','3333333',NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',2,3);
/*!40000 ALTER TABLE `solicitudes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `codigoTest` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tipoTest_codigoTipoTest` int(11) NOT NULL,
  `informe_codigoInforme` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigoTest`,`tipoTest_codigoTipoTest`),
  KEY `fk_test_tipoTest1` (`tipoTest_codigoTipoTest`),
  KEY `fk_test_informe1` (`informe_codigoInforme`),
  CONSTRAINT `fk_test_informe1` FOREIGN KEY (`informe_codigoInforme`) REFERENCES `informe` (`codigoInforme`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_test_tipoTest1` FOREIGN KEY (`tipoTest_codigoTipoTest`) REFERENCES `tipotest` (`codigoTipoTest`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--
-- ORDER BY:  `codigoTest`,`tipoTest_codigoTipoTest`

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
INSERT INTO `test` VALUES (3,'Prueba Kolb 3',0,NULL),(6,'Prueba muchas preguntas seleccionadas',0,NULL),(7,'Test de Kolb 1',0,NULL),(8,'Test de Kolb 1 prueba 2 seleccionando y agregando preguntas',0,NULL),(9,'Test de Kolb 2',0,NULL),(10,'Test de kolb prueba repitiendo preguntas iguales',0,NULL),(11,'Prueba con cambios de bd',0,NULL),(12,'En el siguiente test se te pide que completes 12 frases. Cada frase puede terminarse en cuatro formas distintas. Ordena las cuatro opciones según pienses que se ajustan a tu manera de aprender algo nuevo.',0,NULL);
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test_has_preguntastest`
--

DROP TABLE IF EXISTS `test_has_preguntastest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_has_preguntastest` (
  `test_codigoTest` int(11) NOT NULL,
  `test_tipoTest_codigoTipoTest` int(11) NOT NULL,
  `preguntasTest_codigoPregunta` int(11) NOT NULL,
  PRIMARY KEY (`test_codigoTest`,`test_tipoTest_codigoTipoTest`,`preguntasTest_codigoPregunta`),
  KEY `fk_test_has_preguntasTest_preguntasTest1` (`preguntasTest_codigoPregunta`),
  CONSTRAINT `fk_test_has_preguntasTest_preguntasTest1` FOREIGN KEY (`preguntasTest_codigoPregunta`) REFERENCES `preguntastest` (`codigoPregunta`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_test_has_preguntasTest_test1` FOREIGN KEY (`test_codigoTest`, `test_tipoTest_codigoTipoTest`) REFERENCES `test` (`codigoTest`, `tipoTest_codigoTipoTest`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=big5;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test_has_preguntastest`
--
-- ORDER BY:  `test_codigoTest`,`test_tipoTest_codigoTipoTest`,`preguntasTest_codigoPregunta`

LOCK TABLES `test_has_preguntastest` WRITE;
/*!40000 ALTER TABLE `test_has_preguntastest` DISABLE KEYS */;
INSERT INTO `test_has_preguntastest` VALUES (3,0,3),(3,0,7),(6,0,6),(7,0,7),(7,0,8),(7,0,9),(8,0,7),(8,0,8),(8,0,9),(8,0,10),(8,0,11),(9,0,12),(10,0,3),(10,0,11),(10,0,14),(11,0,3),(11,0,15),(12,0,7),(12,0,8),(12,0,9),(12,0,10),(12,0,16),(12,0,17),(12,0,18),(12,0,19),(12,0,20),(12,0,21),(12,0,22),(12,0,23);
/*!40000 ALTER TABLE `test_has_preguntastest` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipotest`
--
-- ORDER BY:  `codigoTipoTest`

LOCK TABLES `tipotest` WRITE;
/*!40000 ALTER TABLE `tipotest` DISABLE KEYS */;
INSERT INTO `tipotest` VALUES (0,'kolb'),(1,'johari');
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
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
  `id` varchar(11) NOT NULL,
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
  KEY `fk_usuario_grupo1` (`grupo_codigoGrupo`),
  KEY `fk_usuario_institucion1` (`institucion_codigoInstitucion`),
  KEY `fk_usuario_tipoUsuario1` (`tipoUsuario_codigoTipoUsuario`),
  CONSTRAINT `fk_usuario_grupo1` FOREIGN KEY (`grupo_codigoGrupo`) REFERENCES `grupo` (`codigoGrupo`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_usuario_institucion1` FOREIGN KEY (`institucion_codigoInstitucion`) REFERENCES `institucion` (`codigoInstitucion`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_usuario_tipoUsuario1` FOREIGN KEY (`tipoUsuario_codigoTipoUsuario`) REFERENCES `tipousuario` (`codigoTipoUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--
-- ORDER BY:  `id`,`tipoUsuario_codigoTipoUsuario`

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('0007167149','Felicity','Herzog','leonor39@example.org','CC','2010-01-25',1,'$2y$10$1aHxDEmu/BbjYuEQy8T3D.F3bCDIyTEsenW3AKviw8MsjVEY5qFFC',NULL,'Masculino','+9631840826296',NULL,2,1,'2016-11-03 08:48:52','2016-11-03 08:48:52'),('06924944100','Laurine','Ondricka','dare.veda@example.org','CC','2015-07-18',0,'$2y$10$TFquoxQgxC5J80.gIpPsoePxQWk0XLoXcQi7mcgMiYeELlNgvlxX2',NULL,'Femenino','+3307253120725',NULL,3,1,'2016-11-03 08:48:51','2016-11-03 08:48:51'),('0768330647','Sheila','Roberts','sincere.lesch@example.com','CC','2012-02-25',1,'$2y$10$EDt6q353Isx1JDqvfO1zR.T7JrOlR1ndMnVirBhaHq0Ts2G6X1VxC',NULL,'Femenino','+1018965034021',3,4,3,'2016-11-03 08:48:52','2016-11-03 09:33:30'),('1088023094','Johan','Quiroga','quirogacj@gmail.com','CC','1995-07-19',1,'$2y$10$xGAiNeTKEdyjWU1KRuXq1e0epG47slDKCWehdo116xWgfW1H5TIyW','m4I7c0qaNnHfJDo0iKH5dU7pTgqMcv7OZ8jPVm39v2M1QKJkbGaJE0vCxVn5','Masculino','3420543',0,3,1,'2016-11-03 09:02:54','2016-11-07 08:36:04'),('15062388075','Hoyt','Walsh','qwaters@example.org','TI','1984-11-30',1,'$2y$10$p9Kkrx4l3qUzR7XiVrIQHukt0QxjMLJ6rB/zTYRkTQeviKThU65Qa',NULL,'Femenino','+6575380409035',2,6,3,'2016-11-03 08:48:52','2016-11-03 21:09:40'),('19761317444','Audrey','Krajcik','grant.jerrold@example.net','CC','1988-11-06',0,'$2y$10$H4/OUH5DVWGJv0NdcgyL.e1sYUkIPfghfVVNwVNVEWDvk.ajM9ltK',NULL,'Masculino','+6902390291997',NULL,1234,1,'2016-11-03 08:48:51','2016-11-03 08:48:51'),('2345070819','Wilford','Lueilwitz','lukas.stoltenberg@example.org','TI','2016-09-13',1,'$2y$10$gB3gECwpEpZePMGYKjzPr.NI0kkYxR8lHjSAfkgMz0S5pzqIb8oPW',NULL,'Masculino','+5818169914157',NULL,2,1,'2016-11-03 08:48:53','2016-11-03 08:48:53'),('26813278769','Allene','Ziemann','aaufderhar@example.net','TI','2012-07-28',1,'$2y$10$ce/g/ICQk1f2.w8N.s0oJOMGiguuE2EHNDvmomSUyvLr.yeBFmKiu',NULL,'Masculino','+6887883154970',0,3,3,'2016-11-03 08:48:53','2016-11-03 21:09:17'),('2835447784','Leonard','Corwin','willard.sanford@example.net','TI','1998-05-18',0,'$2y$10$bBpkg6BzMaQlpc/V/mkuVe0AWwBIr7kTvXvwU/o2WAgz9IosbNr1q',NULL,'Femenino','+5505861020038',NULL,4,2,'2016-11-03 08:48:51','2016-11-06 08:20:48'),('28678400619','Luis David','Klein','david-0296@hotmail.com','CC','1994-08-02',1,'$2y$10$nMGFTWVEbNeqaorr8Ecr6.Ec/dhxxS45ZvCiOiGhUPw1erFRW8eZy','7TnaVNJwnUrdftHeWzbiNTsktVoQwKXuJR0FC1cbfb4SIjTsXL1vuDRhkt3S','Femenino','+1206836155768',NULL,6,1,'2016-11-03 08:48:45','2016-11-08 02:04:19'),('29839445378','Adolphus','Considine','marcelle.predovic@example.org','TI','1995-05-15',1,'$2y$10$FPDTaix3gRJcZNfjoNe8.OGkFhut6LTornFWghA5e1E0nTpWkqOHC',NULL,'Masculino','+2209871320700',NULL,1234,1,'2016-11-03 08:48:53','2016-11-03 08:48:53'),('2987791457','Michaela','Reinger','jaeden76@example.org','CC','1980-07-23',0,'$2y$10$o3mCi0oZKxznVMZzH81m/e5OrGhm9vtxej79HZn81O9D/oid3TDfK',NULL,'Masculino','+2990835737209',NULL,2,2,'2016-11-03 08:48:53','2016-11-03 08:48:53'),('30422643343','Bell','Klein','gabe99@example.com','TI','1998-02-24',0,'$2y$10$npYVlDF1QVt3YxpP5bVJ6uqYDqDZUEuj6kPkDJsKMVRTOrVbgxUJ2',NULL,'Masculino','+2675758797404',NULL,3,1,'2016-11-03 08:48:52','2016-11-03 08:48:52'),('3097880842','Mike','Ortiz','toy22@example.com','CC','1986-03-20',0,'$2y$10$ymhFoJgejsngqdoLEw3Pe.btkjVJxRG6QVY9sCmdAO7RxitQlq4lO',NULL,'Masculino','+8144992346984',NULL,4,1,'2016-11-03 08:48:53','2016-11-03 08:48:53'),('34354743814','Krystal','Casper','sienna82@example.com','CC','2001-10-15',1,'$2y$10$0byKTXUWPhB55mcH2XbwUenrWX1LLM4jjE4UUZJvzN9rrnlwajd5m',NULL,'Masculino','+4233228221165',NULL,6,1,'2016-11-03 08:48:53','2016-11-03 08:48:53'),('3527238678','Casandra','Bechtelar','roy64@example.net','TI','1976-09-20',1,'$2y$10$.WOkeYwIn9Als23IV8M3nub1GQ8TpCCoyLJYmAssi4M/jM3fbZ0aG',NULL,'Femenino','+9296610416553',NULL,1234,1,'2016-11-03 08:48:52','2016-11-03 08:48:52'),('3533965187','Felipe','Hilll','pipe.0325@hotmail.com','TI','1977-12-09',1,'$2y$10$PMXE9a3uLaLNzAfzKYGVxuxG7dqYl4MIvSB.dHYya8vNKM6Pv3LHi','Rvhw7Mo8w53jc662F8sW0KFbLwmLfLZKBgxwLm1IdfWkIQZmJqXvdU1Udopj','Masculino','+3717365545915',2,6,3,'2016-11-03 08:48:45','2016-11-08 06:05:06'),('36230088091','Aron','Mills','flehner@example.org','CC','2011-04-23',1,'$2y$10$93PmfCCfvlZHoKHuuGqxWOn1/FUW7SsSQx5o9iv6bfO09psid/5i6',NULL,'Femenino','+4106848239667',NULL,3,2,'2016-11-03 08:48:51','2016-11-03 08:48:51'),('36287153249','Dawn','Funk','funk.rylee@example.net','CC','1990-10-03',1,'$2y$10$iy0Kemjb0n/GVToAngk8zuPM6/jr/lnf6oLZ5HSku7nuzqAlHkqD6',NULL,'Femenino','+1499945260398',NULL,4,2,'2016-11-03 08:48:52','2016-11-03 08:48:52'),('3680902685','Fannie','Kub','okon.aurelio@example.com','CC','1981-07-28',0,'$2y$10$wweoIeUHkCWeDwOzbz.z8uiceBqPGb8k2Z7e/7WpnBTMYhBH4rGTC',NULL,'Femenino','+6840509921481',NULL,6,2,'2016-11-03 08:48:52','2016-11-03 08:48:52'),('37018327435','Jeramie','Schroeder','ally.herman@example.org','TI','2006-03-24',1,'$2y$10$xLFPSVyZqBoKalxcdF0rWe2.wEDP3x1y1j2o3OPICZGPhqzVYORly',NULL,'Masculino','+0369374941281',NULL,1234,1,'2016-11-03 08:48:51','2016-11-03 08:48:51'),('41961036123','Karli','Daugherty','tommie14@example.net','TI','1997-07-16',1,'$2y$10$S.KkxyyrUvceCO78j66wb.AEB38IGQrId.guJK7LKfiyGnRsP21qa',NULL,'Femenino','+4248943556862',NULL,2,1,'2016-11-03 08:48:51','2016-11-03 08:48:51'),('44959585331','Efren','Nolan','beaulah65@example.org','CC','2010-05-25',1,'$2y$10$L/RvuYgEwllR1RFcMsLhEuU6V5ge03jXOjRJAUaYpPN0p09PeyfU.',NULL,'Masculino','+4363834004496',NULL,3,1,'2016-11-03 08:48:51','2016-11-03 08:48:51'),('4512276668','Mackenzie','DuBuque','monahan.jalen@example.net','TI','2014-05-30',0,'$2y$10$41mbOiXp8AsLl3j8IyOF1eSZifGj7qWUmKAqdJUO5PGlcQDzXPdwm',NULL,'Femenino','+2819718466967',NULL,4,2,'2016-11-03 08:48:53','2016-11-03 08:48:53'),('45167771458','Jacky','Abshire','anna43@example.com','TI','2007-12-30',0,'$2y$10$JCiDh.xKjqYdTmOVp0AS1.l8Y9.cRe2ZqZfE6uTQdhIXPIKfqRrjG',NULL,'Masculino','+1183486424382',NULL,6,1,'2016-11-03 08:48:51','2016-11-03 08:48:51'),('46126186283','Floy','Aufderhar','vkeebler@example.net','TI','1982-01-01',0,'$2y$10$VrSZ4W7qj3JGPsmvt9UqOOgJlTx1L4B0c.0X5NNoXyBRwCNwnE.0C',NULL,'Femenino','+0939453092450',NULL,1234,2,'2016-11-03 08:48:52','2016-11-07 08:53:49'),('4862977262','Jena','Kozey','keeling.raina@example.org','CC','1999-08-09',1,'$2y$10$Y9hOJQYPz9EGLF15JJnkQe0g7wbqGY.ACAp1uS7LvB8g5rE7YZ4cy',NULL,'Masculino','+9718282266230',NULL,2,2,'2016-11-03 08:48:51','2016-11-03 08:48:51'),('5284481837','Sylvia','Kemmer','carmelo.hirthe@example.org','CC','1987-09-29',0,'$2y$10$de9kkcUa/.ilou89ezRKHO5VFDqePcs8v7fkDDEP.gkjFfNZ8aLRW',NULL,'Masculino','+2845033997490',NULL,3,3,'2016-11-03 08:48:52','2016-11-03 08:48:52'),('53626367855','Estella','Klocko','iritchie@example.net','TI','2002-08-23',1,'$2y$10$bwv4ZtWdPHhTRNyiyFmMKONcallo26M3r1qgGJ6ZXFzBLLIcHaxAK',NULL,'Femenino','+7543000984786',NULL,4,1,'2016-11-03 08:48:52','2016-11-03 08:48:52'),('57079417015','Valentina','Franco','valenfranco@hotmail.com','CC','2013-05-25',1,'$2y$10$M3CyKwJ2fRna.stno22C3ePAfAMkQX2EnBOZyJI74K0Kg0bMk1OgS','ofFYvbmB1qtUyTWN5FTjnhQerJeiKp4RJ3MBBivoWcmgf2YPcI8dRN8TDaAj','Masculino','+2335307506171',NULL,6,2,'2016-11-03 08:48:46','2016-11-08 06:08:44'),('5944458241','Vickie','Jerde','cassandra.romaguera@example.com','CC','1991-07-24',0,'$2y$10$isBhMyTuEHhhVjGd3XlvNe3x.3HKEVBHVQOURLynpeh8eZmyRjB46',NULL,'Masculino','+3188612172472',NULL,1234,3,'2016-11-03 08:48:51','2016-11-03 08:48:51'),('6000011355','Bernardo','Treutel','tracy05@example.net','TI','1993-03-15',0,'$2y$10$ozmVOu8zqhKOiqz49S1W5uFbJVd2dE8Mods5NVk/QGU2pp72GM6VK',NULL,'Femenino','+2741667631843',NULL,2,3,'2016-11-03 08:48:53','2016-11-03 08:48:53'),('6088700275','Kaelyn','Kiehn','melody40@example.com','TI','1993-06-18',1,'$2y$10$I7AwscbRM3pfQ0AloZFgkevgK6KtgkTljKDVS2bJSd7fR6xM7uDRa',NULL,'Femenino','+5346722659804',0,3,3,'2016-11-03 08:48:51','2016-11-03 09:35:02'),('67626552492','Sydni','Murray','romaguera.keaton@example.net','TI','1993-08-21',1,'$2y$10$qsAZItBGDfVQbjUYAkcbo./hHo98dUQDknfqOK5/Qf3TAW..JZE0y',NULL,'Masculino','+0917715123920',NULL,4,2,'2016-11-03 08:48:50','2016-11-03 08:48:50'),('7122181871','Myles','Dibbert','libby20@example.org','CC','2010-01-01',0,'$2y$10$bEjYpHvuMmTSZs3xL/.io.wb0DfeMcTmPULFu8r7tApiNxORVefFy',NULL,'Femenino','+6851289955405',NULL,6,1,'2016-11-03 08:48:51','2016-11-03 08:48:51'),('7229152827','root','Russel','root@ptti.com','TI','1998-04-01',1,'$2y$10$I2Nqkc5/JRP1RMnXPc0FkOW/tz9fVJP/Sb7jF0vJDmEhuxm9VAYta','O1nSJO2tmBEZLngb2jvf00NwVHDb3sx5DawwH2o6YinUGpgsBB22wcPv6DjG','Masculino','+4061590884884',NULL,NULL,0,'2016-11-03 08:48:45','2016-11-08 02:04:10'),('73616381537','Mathew','Vandervort','tina12@example.com','TI','2016-10-26',0,'$2y$10$A0PKaNvrRXy3xs6t.Ppizu5YHBd0B6PMEvy/o/BFIWNoSrazwAa7C',NULL,'Masculino','+0221766592447',NULL,1234,2,'2016-11-03 08:48:53','2016-11-03 08:48:53'),('76655155464','Katelyn','Wisoky','bschumm@example.com','CC','1996-02-10',1,'$2y$10$zRNAWWD4hnzTMV1EqqkTo.3s7l3BxbWdZslScmGshAWPlR7CDTHEy',NULL,'Femenino','+2348632304397',NULL,2,1,'2016-11-03 08:48:50','2016-11-03 08:48:50'),('7732821023','Caesar','Crist','russ.pfannerstill@example.com','CC','1976-02-21',1,'$2y$10$1J4apiaNtV4F2HYBOrFI5u/uDAYKB6sRIAk4XjDmt/w854D2awIGa',NULL,'Masculino','+8576033159890',2,6,3,'2016-11-03 08:48:53','2016-11-03 21:06:53'),('79364555614','Mabel','Rice','ernest08@example.net','TI','2006-05-26',0,'$2y$10$rMOOR7UGVXZxsdSsHNJF8eV2Qs7OLDzqSnbH.Cq45zagQMwbsWp.S',NULL,'Masculino','+3670573305435',NULL,4,1,'2016-11-03 08:48:51','2016-11-03 08:48:51'),('79560853938','Caroline','Schamberger','bernhard.konopelski@example.com','TI','2013-09-20',0,'$2y$10$XcUdwpmAbPeMdGne8otfCeUADAd0CcfCb7.N8Q4QeZEzM1qaGUamC',NULL,'Femenino','+9445700555750',NULL,6,3,'2016-11-03 08:48:51','2016-11-03 08:48:51'),('8497970027','Jerald','Cormier','bridgette51@example.net','CC','1976-05-12',1,'$2y$10$ZkwnAUXDpKNMOpUoyewHS.dwsXS7ooRCpgnREBrvuBd/SfaXvaKpS',NULL,'Femenino','+7900467757582',123,1234,3,'2016-11-03 08:48:52','2016-11-03 09:35:16'),('8526501265','Jaiden','Pagac','gharvey@example.com','CC','2011-05-26',1,'$2y$10$ZW7nvfCNyGyxoWdiie6ICOVSWS4sVcxkgZlPustCgUw9Gidf/tHxW',NULL,'Masculino','+0655995830201',999,2,3,'2016-11-03 08:48:51','2016-11-03 09:35:23'),('8562264484','Amanda','Roob','qwaters@example.com','TI','2012-01-05',0,'$2y$10$FkhUD8ph0E1JsL0dq2pgQeDT0sWrimqm9JtbReFpZg12q3AUofZM2',NULL,'Masculino','+5685746827558',NULL,3,1,'2016-11-03 08:48:53','2016-11-03 08:48:53'),('8627141906','Brycen','Bergstrom','qwolff@example.org','TI','1971-07-25',1,'$2y$10$3OGEDZYYz7xwSVCVhX6pmec1FlPu2WkXXtTNajloKlMjDs8Ii6AcW',NULL,'Masculino','+4155243537930',NULL,4,2,'2016-11-03 08:48:51','2016-11-03 08:48:51'),('8666483569','Miracle','Bergnaum','hane.geovany@example.net','TI','2011-01-21',1,'$2y$10$sH1SHycEp/bffe.AHwu3BOS8doJ6oN2PxwOFgwM/lAXJSpziyYx7i',NULL,'Femenino','+8191839343607',NULL,6,1,'2016-11-03 08:48:52','2016-11-03 08:48:52'),('8715170700','Albina','Hickle','nathanial.douglas@example.org','TI','2012-09-07',1,'$2y$10$WRIJmQL/xdt4h4sZmK9OyeA1ykSkRZJpDXLxyS4oqUniKsGTWxWNq',NULL,'Femenino','+4325470942961',123,1234,3,'2016-11-03 08:48:53','2016-11-03 09:35:29'),('8805061214','Sterling','Bradtke','ankunding.flo@example.org','TI','1996-09-19',1,'$2y$10$xPViClsL0hv7BmiEwVJzzOpZOzIcndJYL2OhQJZ9QtlrzcW2z8IAO',NULL,'Masculino','+4984433989635',999,2,3,'2016-11-03 08:48:51','2016-11-03 09:35:35'),('88325494205','Joany','Sauer','norval18@example.com','TI','1974-12-08',1,'$2y$10$z7gewJR/HHUP3m0HViPSjOgIDFrzCLeIQlmCZWAbHTJ5XgOfOf0y6',NULL,'Masculino','+4373427711708',NULL,3,1,'2016-11-03 08:48:50','2016-11-03 08:48:50'),('9419367225','Percy','Wilderman','ona.glover@example.net','TI','2015-03-12',1,'$2y$10$zBKmZFhRGfTsBX6bCCM/o.38VQZrK2rsNUayULPiyq6XWmUnRiNmu',NULL,'Femenino','+3771725164922',3,4,3,'2016-11-03 08:48:52','2016-11-03 09:35:41'),('94724770051','Earnest','Dietrich','kautzer.eli@example.org','CC','1987-01-13',0,'$2y$10$aQzaHDFHXMVbr0IctvrqoeLVy7E1V72WU3ngYHvTD771PeP.leSa6',NULL,'Masculino','+6543386544317',NULL,6,3,'2016-11-03 08:48:50','2016-11-03 08:48:50'),('95015532430','Natasha','Hayes','waldo.heller@example.net','CC','1982-10-31',1,'$2y$10$J7nkZJZjD8L7GotUZLDfGOacvmvX7bY1Nk/AbQlH3EBiQLhee4S9.',NULL,'Masculino','+2898493003661',123,1234,3,'2016-11-03 08:48:52','2016-11-03 08:59:55'),('95716235410','Quinton','Conroy','ilene.krajcik@example.net','CC','1995-02-03',1,'$2y$10$UeymIrDZF9QWeJwF8jiCO.hF/aMJzPNg6SEUsmwMpfRKD4FH0sJIa',NULL,'Masculino','+1155314432506',NULL,2,1,'2016-11-03 08:48:53','2016-11-03 08:48:53'),('98402102217','Chasity','Oberbrunner','phoppe@example.net','TI','2016-03-14',0,'$2y$10$WTd2XvF0nHOKzc4Bdjb2lOhsCi4zedxrcqZQBZZnrwDrthJabUqBa',NULL,'Masculino','+6751390964406',NULL,3,2,'2016-11-03 08:48:51','2016-11-07 10:05:19');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_has_test`
--

DROP TABLE IF EXISTS `users_has_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_has_test` (
  `estadoTest` tinyint(1) NOT NULL,
  `users_id` varchar(11) NOT NULL,
  `users_tipoUsuario_codigoTipoUsuario` int(11) NOT NULL,
  `test_codigoTest` int(11) NOT NULL,
  `test_tipoTest_codigoTipoTest` int(11) NOT NULL,
  `resultado` varchar(45) DEFAULT NULL,
  `diagnostico` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`users_id`,`users_tipoUsuario_codigoTipoUsuario`,`test_codigoTest`,`test_tipoTest_codigoTipoTest`),
  KEY `fk_users_has_test_test1` (`test_codigoTest`,`test_tipoTest_codigoTipoTest`),
  CONSTRAINT `fk_users_has_test_test1` FOREIGN KEY (`test_codigoTest`, `test_tipoTest_codigoTipoTest`) REFERENCES `test` (`codigoTest`, `tipoTest_codigoTipoTest`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `fk_users_has_test_users1` FOREIGN KEY (`users_id`, `users_tipoUsuario_codigoTipoUsuario`) REFERENCES `users` (`id`, `tipoUsuario_codigoTipoUsuario`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_has_test`
--
-- ORDER BY:  `users_id`,`users_tipoUsuario_codigoTipoUsuario`,`test_codigoTest`,`test_tipoTest_codigoTipoTest`

LOCK TABLES `users_has_test` WRITE;
/*!40000 ALTER TABLE `users_has_test` DISABLE KEYS */;
INSERT INTO `users_has_test` VALUES (0,'15062388075',3,3,0,NULL,NULL),(0,'15062388075',3,6,0,NULL,NULL),(0,'15062388075',3,7,0,NULL,NULL),(0,'15062388075',3,8,0,NULL,NULL),(0,'15062388075',3,9,0,NULL,NULL),(0,'15062388075',3,10,0,NULL,NULL),(1,'3533965187',3,7,0,'Divergente',NULL),(0,'3533965187',3,8,0,NULL,NULL),(0,'7732821023',3,7,0,NULL,NULL),(0,'7732821023',3,8,0,NULL,NULL);
/*!40000 ALTER TABLE `users_has_test` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-07 21:15:20
