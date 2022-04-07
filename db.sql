-- MySQL dump 10.13  Distrib 8.0.26, for Linux (x86_64)
--
-- Host: localhost    Database: ivan
-- ------------------------------------------------------
-- Server version	8.0.26-0ubuntu0.20.04.3



DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `genero` varchar(20) DEFAULT NULL,
  `edad` int DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
);


LOCK TABLES `cliente` WRITE;

UNLOCK TABLES;
DROP TABLE IF EXISTS `pre_test`;

CREATE TABLE `pre_test` (
  `id_pre_test` int NOT NULL AUTO_INCREMENT,
  `hash_file` varchar(200) DEFAULT NULL,
  `pregunta_2` text,
  `pregunta_3` text,
  `pregunta_4` text,
  `id_session` int DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_pre_test`)
);

LOCK TABLES `pre_test` WRITE;
UNLOCK TABLES;
