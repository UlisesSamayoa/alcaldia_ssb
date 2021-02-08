/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.5.5-10.4.11-MariaDB : Database - alcaldia_ssb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`alcaldia_ssb` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `alcaldia_ssb`;

/*Table structure for table `cliente` */

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `id_cliente` int(10) NOT NULL AUTO_INCREMENT,
  `medidor` varchar(20) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `direccion` varchar(300) DEFAULT NULL,
  `municipio` varchar(100) NOT NULL,
  `unicom` varchar(100) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `cliente` */

/*Table structure for table `cobal` */

DROP TABLE IF EXISTS `cobal`;

CREATE TABLE `cobal` (
  `id_cobal` int(10) NOT NULL AUTO_INCREMENT,
  `unicom` varchar(10) NOT NULL,
  `cuenta_alcaldia` varchar(10) NOT NULL,
  `aseo` varchar(10) NOT NULL,
  `alumbrado` varchar(10) NOT NULL,
  `desechos_solidos` varchar(10) NOT NULL,
  `otros_conceptos` varchar(10) NOT NULL,
  `cuenta_pendiente` varchar(10) NOT NULL,
  `pavimento` varchar(10) NOT NULL,
  `fondo_fiesta` varchar(10) NOT NULL,
  `periodo` varchar(10) NOT NULL,
  `fecha_pago` date NOT NULL,
  `nic` varchar(20) NOT NULL,
  `nis` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  PRIMARY KEY (`id_cobal`),
  KEY `id_usuario` (`id_usuario`),
  KEY `cobal_ibfk_1` (`id_cliente`),
  CONSTRAINT `cobal_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `cobal_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `cobal` */

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id_usuario` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) NOT NULL,
  `apellido_usuario` varchar(50) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `tipo` int(1) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `usuario` */

insert  into `usuario`(`id_usuario`,`nombre_usuario`,`apellido_usuario`,`correo`,`clave`,`tipo`) values (1,'admin','admin','admin','admin',3);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
