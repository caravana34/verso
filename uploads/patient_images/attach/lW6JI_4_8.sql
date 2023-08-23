/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.3.28-MariaDB : Database - socialcommerce
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`socialcommerce` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `socialcommerce`;

/*Table structure for table `brand` */

DROP TABLE IF EXISTS `brand`;

CREATE TABLE `brand` (
  `id_brand` bigint(22) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` bigint(22) unsigned NOT NULL,
  `id_supplier` bigint(22) unsigned NOT NULL,
  `brand_name` varchar(150) NOT NULL,
  `brand_image` varchar(250) DEFAULT NULL,
  `brand_description` varchar(250) DEFAULT NULL,
  `brand_active` tinyint(1) DEFAULT 1,
  `brand_deleted` tinyint(1) DEFAULT 0,
  `brand_creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_brand`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `campaign` */

DROP TABLE IF EXISTS `campaign`;

CREATE TABLE `campaign` (
  `id_campaign` bigint(22) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` bigint(22) unsigned NOT NULL,
  `campaign_name` varchar(45) NOT NULL,
  `campaign_date_start` datetime DEFAULT NULL,
  `campaign_date_created` datetime DEFAULT NULL,
  `id_user_created` bigint(22) NOT NULL,
  `campaign_foto` varchar(250) DEFAULT NULL,
  `campaign_status` bigint(1) DEFAULT NULL COMMENT '1 pendiente, 2 publicada, 3 inactiva, 4 eliminada, 5 vendida',
  PRIMARY KEY (`id_campaign`),
  KEY `campaign_company` (`id_company`),
  CONSTRAINT `campaign_company` FOREIGN KEY (`id_company`) REFERENCES `company` (`id_company`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `campaign_photos` */

DROP TABLE IF EXISTS `campaign_photos`;

CREATE TABLE `campaign_photos` (
  `id` int(11) NOT NULL,
  `id_campaign` bigint(22) NOT NULL,
  `id_product` bigint(22) NOT NULL,
  `campaign_photo_name` varchar(255) DEFAULT NULL,
  `campaign_photo_date_created` datetime DEFAULT NULL,
  `id_user_created` bigint(22) DEFAULT NULL,
  `campaign_photo_orden` bigint(22) DEFAULT NULL,
  `campaign_photo_status` bigint(22) DEFAULT NULL,
  `id_company` bigint(22) NOT NULL,
  `campaign_photo_route` varchar(250) DEFAULT NULL,
  `campaign_photo_type` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `campaign_publication` */

DROP TABLE IF EXISTS `campaign_publication`;

CREATE TABLE `campaign_publication` (
  `id` bigint(22) NOT NULL,
  `id_campaign` bigint(22) NOT NULL,
  `id_publication` bigint(22) NOT NULL,
  `fechacrea` datetime DEFAULT NULL,
  `usercrea` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `campaign_status` */

DROP TABLE IF EXISTS `campaign_status`;

CREATE TABLE `campaign_status` (
  `id_status` bigint(22) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id_category` bigint(22) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` bigint(22) unsigned NOT NULL,
  `category_name` varchar(150) NOT NULL,
  `category_description` varchar(150) DEFAULT NULL,
  `category_image` varchar(250) DEFAULT NULL,
  `category_deleted` tinyint(1) DEFAULT 0,
  `category_active` tinyint(1) DEFAULT 1,
  `category_creation_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_category`),
  KEY `category_company` (`id_company`),
  CONSTRAINT `category_company` FOREIGN KEY (`id_company`) REFERENCES `company` (`id_company`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `client` */

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `id_client` bigint(22) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` bigint(22) unsigned NOT NULL,
  `client_name` varchar(150) NOT NULL,
  `client_identification` varchar(45) NOT NULL,
  `client_phone` varchar(20) DEFAULT NULL,
  `client_address` varchar(150) DEFAULT NULL,
  `client_city` varchar(60) DEFAULT NULL,
  `client_country` varchar(3) DEFAULT NULL,
  `client_creation_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_client`),
  KEY `client_company` (`id_company`),
  CONSTRAINT `client_company` FOREIGN KEY (`id_company`) REFERENCES `company` (`id_company`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `company` */

DROP TABLE IF EXISTS `company`;

CREATE TABLE `company` (
  `id_company` bigint(22) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(150) NOT NULL,
  `company_id` varchar(50) DEFAULT NULL,
  `company_country` varchar(50) DEFAULT NULL,
  `company_city` varchar(50) DEFAULT NULL,
  `company_enable` tinyint(1) NOT NULL DEFAULT 1,
  `company_creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_company`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Table structure for table `log_tracker` */

DROP TABLE IF EXISTS `log_tracker`;

CREATE TABLE `log_tracker` (
  `id_log` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_company_id` bigint(20) NOT NULL,
  `log_whodid` bigint(20) NOT NULL,
  `log_type` enum('error','track') DEFAULT NULL,
  `log_id_record` bigint(20) NOT NULL,
  `log_module` varchar(50) DEFAULT NULL,
  `log_action` enum('Insert','Update','Delete','Error') DEFAULT NULL,
  `log_ip` varchar(50) DEFAULT NULL,
  `log_date_log` datetime NOT NULL,
  `log_json_evidence` text DEFAULT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

/*Table structure for table `order` */

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `id_order` bigint(22) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` bigint(22) unsigned NOT NULL,
  `id_client` bigint(22) unsigned NOT NULL,
  `order_url_pay` varchar(256) DEFAULT NULL,
  `order_status` varchar(60) NOT NULL,
  `order_total` float DEFAULT NULL,
  `order_creation_date` datetime NOT NULL,
  `order_phone` varchar(45) DEFAULT NULL,
  `order_address` varchar(45) DEFAULT NULL,
  `order_city` varchar(60) DEFAULT NULL,
  `order_country` varchar(3) DEFAULT NULL,
  `order_pay_type` varchar(45) DEFAULT NULL,
  `order_payment_recived` float DEFAULT NULL,
  `order_payment_completed` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_order`),
  KEY `order_company` (`id_company`),
  KEY `order_client` (`id_client`),
  CONSTRAINT `order_client` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `order_company` FOREIGN KEY (`id_company`) REFERENCES `company` (`id_company`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `orderproduct` */

DROP TABLE IF EXISTS `orderproduct`;

CREATE TABLE `orderproduct` (
  `id_orderproduct` bigint(22) unsigned NOT NULL AUTO_INCREMENT,
  `id_order` bigint(22) unsigned NOT NULL,
  `id_product` bigint(22) unsigned NOT NULL,
  `orderproduct_quantity` float NOT NULL,
  `orderproductc_value` float DEFAULT NULL,
  `orderproductc_total` float DEFAULT NULL,
  `orderproductc_tax` float DEFAULT NULL,
  `orderproduct_taxvalue` float DEFAULT NULL,
  `orderproduct_comment` varchar(256) DEFAULT NULL,
  `orderproducto_discount` float DEFAULT NULL,
  PRIMARY KEY (`id_orderproduct`),
  KEY `orderpro_order` (`id_order`),
  KEY `orderpro_product` (`id_product`),
  CONSTRAINT `orderpro_order` FOREIGN KEY (`id_order`) REFERENCES `order` (`id_order`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `orderpro_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_produc`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `presource` */

DROP TABLE IF EXISTS `presource`;

CREATE TABLE `presource` (
  `id_presource` bigint(22) unsigned NOT NULL AUTO_INCREMENT,
  `id_product` bigint(22) unsigned DEFAULT NULL,
  `id_company` bigint(22) unsigned DEFAULT NULL,
  `id_user` bigint(22) unsigned DEFAULT NULL,
  `presource_type` varchar(100) DEFAULT NULL,
  `presource_name` varchar(150) NOT NULL,
  `presource_route` varchar(250) DEFAULT NULL,
  `presource_creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_presource`),
  KEY `presouce_produc` (`id_product`),
  KEY `presource_company` (`id_company`),
  CONSTRAINT `presouce_produc` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_produc`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `presource_company` FOREIGN KEY (`id_company`) REFERENCES `company` (`id_company`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id_produc` bigint(22) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` bigint(22) unsigned DEFAULT NULL,
  `id_user` bigint(22) unsigned NOT NULL,
  `id_category` bigint(22) unsigned DEFAULT NULL,
  `id_brand` bigint(22) unsigned DEFAULT NULL,
  `id_supplier` bigint(22) unsigned DEFAULT NULL,
  `product_name` varchar(150) NOT NULL,
  `product_description` text DEFAULT NULL,
  `product_main_image` varchar(250) DEFAULT NULL,
  `product_unit` varchar(50) DEFAULT NULL,
  `product_stock` float DEFAULT NULL,
  `product_cost` float DEFAULT NULL,
  `product_price` float DEFAULT NULL,
  `product_taxes` float DEFAULT NULL,
  `product_height` float DEFAULT NULL,
  `product_width` float DEFAULT NULL,
  `product_length` float DEFAULT NULL,
  `product_weight` float DEFAULT NULL,
  `product_creation_date` datetime NOT NULL,
  `product_modif_date` datetime NOT NULL,
  `product_modif_id_user` bigint(22) unsigned NOT NULL,
  `product_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_produc`),
  KEY `product_brand` (`id_brand`),
  KEY `product_category` (`id_category`),
  KEY `product_company` (`id_company`),
  KEY `product_mofif_user` (`product_modif_id_user`),
  KEY `product_supplier` (`id_supplier`),
  KEY `product_user` (`id_user`),
  CONSTRAINT `product_brand` FOREIGN KEY (`id_brand`) REFERENCES `brand` (`id_brand`) ON UPDATE CASCADE,
  CONSTRAINT `product_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON UPDATE CASCADE,
  CONSTRAINT `product_company` FOREIGN KEY (`id_company`) REFERENCES `company` (`id_company`) ON UPDATE CASCADE,
  CONSTRAINT `product_mofif_user` FOREIGN KEY (`product_modif_id_user`) REFERENCES `user` (`id_user`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `product_supplier` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON UPDATE CASCADE,
  CONSTRAINT `product_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*Table structure for table `product_var` */

DROP TABLE IF EXISTS `product_var`;

CREATE TABLE `product_var` (
  `id_product_var` bigint(22) unsigned NOT NULL AUTO_INCREMENT,
  `id_product` bigint(22) unsigned NOT NULL,
  `id_company` bigint(22) unsigned DEFAULT NULL,
  `product_var_name` varchar(100) NOT NULL,
  `product_var_values` text DEFAULT NULL COMMENT 'semicolum separated',
  `product_var_creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_product_var`),
  KEY `product_var_ibfk_1` (`id_product`),
  CONSTRAINT `product_var_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_produc`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

/*Table structure for table `publication` */

DROP TABLE IF EXISTS `publication`;

CREATE TABLE `publication` (
  `id_publication` bigint(22) unsigned NOT NULL AUTO_INCREMENT,
  `id_campaign` bigint(22) unsigned DEFAULT NULL,
  `id_product` bigint(22) unsigned DEFAULT NULL,
  `publication_text` varchar(256) NOT NULL,
  `publication_source` varchar(256) NOT NULL,
  `publication_datetime` datetime NOT NULL,
  `publication_net` varchar(45) NOT NULL,
  PRIMARY KEY (`id_publication`),
  KEY `publication_campaign` (`id_campaign`),
  KEY `publication_product` (`id_product`),
  CONSTRAINT `publication_campaign` FOREIGN KEY (`id_campaign`) REFERENCES `campaign` (`id_campaign`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `publication_product` FOREIGN KEY (`id_product`) REFERENCES `product` (`id_produc`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `social` */

DROP TABLE IF EXISTS `social`;

CREATE TABLE `social` (
  `id_social` bigint(22) NOT NULL,
  `social_name` varchar(50) NOT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `social_publication` */

DROP TABLE IF EXISTS `social_publication`;

CREATE TABLE `social_publication` (
  `id_social` bigint(22) NOT NULL,
  `name` bigint(22) NOT NULL,
  `id_publication` bigint(22) NOT NULL,
  `fechacrea` datetime DEFAULT NULL,
  `usercrea` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `supplier` */

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `id_supplier` bigint(22) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` bigint(22) unsigned DEFAULT NULL,
  `supplier_name` varchar(150) NOT NULL,
  `supplier_email` varchar(100) DEFAULT NULL,
  `supplier_phone` varchar(50) DEFAULT NULL,
  `supplier_country` varchar(150) DEFAULT NULL,
  `supplier_department` varchar(150) DEFAULT NULL,
  `supplier_city` varchar(150) DEFAULT NULL,
  `supplier_image` varchar(250) DEFAULT NULL,
  `supplier_active` tinyint(1) DEFAULT 1,
  `supplier_deleted` tinyint(1) DEFAULT 0,
  `supplier_creation_date` datetime NOT NULL,
  PRIMARY KEY (`id_supplier`),
  KEY `supplier_company` (`id_company`),
  CONSTRAINT `supplier_company` FOREIGN KEY (`id_company`) REFERENCES `company` (`id_company`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` bigint(22) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` bigint(22) unsigned NOT NULL,
  `user_firstname` varchar(100) DEFAULT NULL,
  `user_lastname` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_password` varchar(256) DEFAULT NULL,
  `user_document` varchar(50) DEFAULT NULL,
  `user_document_type` varchar(50) DEFAULT NULL,
  `user_phone` varchar(20) DEFAULT NULL,
  `user_birthday` date DEFAULT NULL,
  `user_country` varchar(3) DEFAULT NULL,
  `user_city` varchar(100) DEFAULT NULL,
  `user_role` enum('superadmin','admin','user') DEFAULT NULL,
  `user_image` varchar(100) DEFAULT 'default.png',
  `user_enable` tinyint(1) NOT NULL DEFAULT 1,
  `user_creation_date` datetime NOT NULL,
  `user_last_use` datetime NOT NULL,
  `token_recover_pass` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `user_company` (`id_company`),
  CONSTRAINT `user_company` FOREIGN KEY (`id_company`) REFERENCES `company` (`id_company`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
