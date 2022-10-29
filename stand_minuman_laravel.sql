/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.24-MariaDB : Database - stand_minuman_laravel
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`stand_minuman_laravel` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `stand_minuman_laravel`;

/*Table structure for table `category_minuman` */

DROP TABLE IF EXISTS `category_minuman`;

CREATE TABLE `category_minuman` (
  `id_category_minuman` double NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_category_minuman`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `category_minuman` */

insert  into `category_minuman`(`id_category_minuman`,`nama`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'No Category',NULL,NULL,NULL),
(2,'Teh',NULL,NULL,NULL),
(3,'Jus',NULL,NULL,NULL),
(4,'Milkshake',NULL,NULL,NULL);

/*Table structure for table `diskon` */

DROP TABLE IF EXISTS `diskon`;

CREATE TABLE `diskon` (
  `id_diskon` double NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `potongan` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_diskon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `diskon` */

/*Table structure for table `dtrans` */

DROP TABLE IF EXISTS `dtrans`;

CREATE TABLE `dtrans` (
  `no_nota` varchar(50) NOT NULL,
  `id_minuman` double NOT NULL,
  `id_topping` double NOT NULL DEFAULT 1,
  `jumlah` double NOT NULL,
  `subtotal_minuman` double DEFAULT NULL,
  `subtotal_topping` double DEFAULT NULL,
  `subtotal` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`no_nota`,`id_minuman`,`id_topping`),
  KEY `id_minuman` (`id_minuman`),
  KEY `id_topping` (`id_topping`),
  CONSTRAINT `dtrans_ibfk_1` FOREIGN KEY (`no_nota`) REFERENCES `htrans` (`no_nota`),
  CONSTRAINT `dtrans_ibfk_2` FOREIGN KEY (`id_minuman`) REFERENCES `minuman` (`id_minuman`),
  CONSTRAINT `dtrans_ibfk_3` FOREIGN KEY (`id_topping`) REFERENCES `topping` (`id_topping`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `dtrans` */

insert  into `dtrans`(`no_nota`,`id_minuman`,`id_topping`,`jumlah`,`subtotal_minuman`,`subtotal_topping`,`subtotal`,`created_at`,`updated_at`,`deleted_at`) values 
('H2205120001',1,1,2,20000,0,20000,NULL,NULL,NULL),
('H2205120002',2,2,1,12000,2000,14000,NULL,NULL,NULL),
('H2205120003',2,1,2,12000,0,24000,NULL,NULL,NULL),
('H2205120003',2,2,1,12000,2000,14000,NULL,NULL,NULL),
('H2205120003',3,3,1,15000,3000,18000,NULL,NULL,NULL),
('H2205230001',2,3,2,24000,6000,30000,NULL,NULL,NULL),
('H2205230001',3,3,1,15000,3000,18000,NULL,NULL,NULL),
('H2205240001',3,3,2,30000,6000,36000,NULL,NULL,NULL),
('H2205240001',4,1,1,16000,0,16000,NULL,NULL,NULL),
('H2205250001',1,1,2,20000,0,20000,NULL,NULL,NULL),
('H2205250001',2,4,1,12000,2500,14500,NULL,NULL,NULL),
('H2205250001',4,3,1,16000,3000,19000,NULL,NULL,NULL);

/*Table structure for table `htrans` */

DROP TABLE IF EXISTS `htrans`;

CREATE TABLE `htrans` (
  `no_nota` varchar(50) NOT NULL,
  `id_users` double NOT NULL,
  `id_diskon` double DEFAULT NULL,
  `id_member` double DEFAULT NULL,
  `subtotal` double NOT NULL,
  `potongan` double DEFAULT 0,
  `total` double NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`no_nota`),
  KEY `id_users` (`id_users`),
  CONSTRAINT `htrans_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `htrans` */

insert  into `htrans`(`no_nota`,`id_users`,`id_diskon`,`id_member`,`subtotal`,`potongan`,`total`,`tanggal`,`created_at`,`updated_at`,`deleted_at`) values 
('H2205120001',2,NULL,NULL,0,0,20000,'2022-05-12 14:01:58',NULL,NULL,NULL),
('H2205120002',3,NULL,NULL,0,0,14000,'2022-05-12 14:04:45',NULL,NULL,NULL),
('H2205120003',2,NULL,NULL,0,0,56000,'2022-05-12 14:07:27',NULL,NULL,NULL),
('H2205230001',2,NULL,NULL,0,0,48000,'2022-05-23 15:14:19',NULL,NULL,NULL),
('H2205240001',2,NULL,NULL,0,0,52000,'2022-05-24 11:35:53',NULL,NULL,NULL),
('H2205250001',3,NULL,NULL,0,0,53500,'2022-05-25 21:05:50',NULL,NULL,NULL);

/*Table structure for table `member` */

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `id_member` double NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_member`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `member` */

/*Table structure for table `minuman` */

DROP TABLE IF EXISTS `minuman`;

CREATE TABLE `minuman` (
  `id_minuman` double NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `gambar` varchar(50) DEFAULT NULL,
  `stok` double NOT NULL,
  `harga` double NOT NULL,
  `id_category_minuman` double NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_minuman`),
  KEY `id_category_minuman` (`id_category_minuman`),
  CONSTRAINT `minuman_ibfk_1` FOREIGN KEY (`id_category_minuman`) REFERENCES `category_minuman` (`id_category_minuman`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `minuman` */

insert  into `minuman`(`id_minuman`,`nama`,`gambar`,`stok`,`harga`,`id_category_minuman`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'Es Teh Manis',NULL,194,10000,2,NULL,NULL,NULL),
(2,'Jus Jeruk',NULL,4957,12000,3,NULL,NULL,NULL),
(3,'Milkshake',NULL,27,15000,4,NULL,NULL,NULL),
(4,'Chocolate Milkshake',NULL,98,16000,4,NULL,NULL,NULL);

/*Table structure for table `topping` */

DROP TABLE IF EXISTS `topping`;

CREATE TABLE `topping` (
  `id_topping` double NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `gambar` varchar(50) DEFAULT NULL,
  `harga` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_topping`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `topping` */

insert  into `topping`(`id_topping`,`nama`,`gambar`,`harga`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'No Topping',NULL,0,NULL,NULL,NULL),
(2,'Gula',NULL,2000,NULL,NULL,NULL),
(3,'Chocolate Chip',NULL,3000,NULL,NULL,NULL),
(4,'Jeruk Nipis',NULL,2500,NULL,NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_users` double NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_users`),
  UNIQUE KEY `Username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id_users`,`username`,`password`,`nama`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'admin','21232F297A57A5A743894A0E4A801FC3','admin',NULL,NULL,NULL),
(2,'Azhure','8875A6E498FF20B1553FF264E9B07A53','Azhure Raven',NULL,NULL,NULL),
(3,'Kevin','C1F80EDDEA77F14650A2062DDA3EB15C','Kevin Jonathan',NULL,NULL,NULL),
(4,'Rocky','DE03C6DE427184AFE57262DE14D084D7','Rocky Chandra',NULL,NULL,NULL);

/* Function  structure for function  `genNoNota` */

/*!50003 DROP FUNCTION IF EXISTS `genNoNota` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `genNoNota`() RETURNS varchar(100) CHARSET utf8mb4
BEGIN
 DECLARE hasil VARCHAR(100) DEFAULT ''; 
 DECLARE counted INT; 			
 
 SELECT IFNULL(COUNT(*),0) INTO counted FROM htrans
 WHERE no_nota LIKE CONCAT('%H',DATE_FORMAT(NOW(), '%y%m%d'),'%');
 SET counted = counted + 1;
 
 SET hasil = CONCAT('H',DATE_FORMAT(NOW(),'%y%m%d'),LPAD(counted,4,'0'));
 RETURN hasil;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
