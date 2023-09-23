-- MySQL dump 10.13  Distrib 8.0.31, for Linux (x86_64)
--
-- Host: localhost    Database: ewc
-- ------------------------------------------------------
-- Server version	8.0.31-0ubuntu0.20.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Article`
--

DROP TABLE IF EXISTS `Article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `columnSize` int NOT NULL,
  `verbage` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Binder`
--

DROP TABLE IF EXISTS `Binder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Binder` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `original` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Block`
--

DROP TABLE IF EXISTS `Block`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Block` (
  `id` int NOT NULL AUTO_INCREMENT,
  `containerReference` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '(DC2Type:object)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Book`
--

DROP TABLE IF EXISTS `Book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Book` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fileid` int DEFAULT NULL,
  `wordageid` int DEFAULT NULL,
  `pictureid` int DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `original` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Broadsheet`
--

DROP TABLE IF EXISTS `Broadsheet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Broadsheet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pageNo` int NOT NULL,
  `pageWidth` int NOT NULL,
  `pageHeight` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `CodeBase`
--

DROP TABLE IF EXISTS `CodeBase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `CodeBase` (
  `id` int NOT NULL AUTO_INCREMENT,
  `binder_id` int DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `fileid` int DEFAULT NULL,
  `description` text,
  `code` text,
  `author` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `original` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `CodeSample`
--

DROP TABLE IF EXISTS `CodeSample`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `CodeSample` (
  `id` int NOT NULL AUTO_INCREMENT,
  `binder_id` int DEFAULT NULL,
  `fileid` int DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `code` text,
  `first_line` int DEFAULT NULL,
  `last_line` int DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `original` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Component`
--

DROP TABLE IF EXISTS `Component`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Component` (
  `id` int NOT NULL AUTO_INCREMENT,
  `component_type` varchar(50) DEFAULT NULL,
  `credit` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `width` int DEFAULT NULL,
  `height` int DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `original` datetime DEFAULT NULL,
  `title` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Container`
--

DROP TABLE IF EXISTS `Container`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Container` (
  `id` int NOT NULL AUTO_INCREMENT,
  `container_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `title` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `backgroundwidth` int NOT NULL,
  `backgroundheight` int NOT NULL,
  `original` datetime DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `background` tinyint(1) DEFAULT NULL,
  `frame` tinyint(1) DEFAULT NULL,
  `bgColor` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ContainerItems`
--

DROP TABLE IF EXISTS `ContainerItems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ContainerItems` (
  `id` int NOT NULL AUTO_INCREMENT,
  `containerid` int NOT NULL,
  `container_order` int DEFAULT NULL,
  `itemid` int NOT NULL,
  `itemtype` varchar(35) DEFAULT NULL,
  `original` datetime DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Correspondant`
--

DROP TABLE IF EXISTS `Correspondant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Correspondant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `handle` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `wordage` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `picture` longblob,
  `width` int DEFAULT NULL,
  `height` int DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Experience`
--

DROP TABLE IF EXISTS `Experience`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Experience` (
  `username` varchar(50) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `original` datetime DEFAULT NULL,
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `skills` varchar(50) DEFAULT NULL,
  `company` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  `binder_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `File`
--

DROP TABLE IF EXISTS `File`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `File` (
  `id` int NOT NULL AUTO_INCREMENT,
  `binder_id` int DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `original` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Headline`
--

DROP TABLE IF EXISTS `Headline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Headline` (
  `id` int NOT NULL AUTO_INCREMENT,
  `binder_id` int DEFAULT NULL,
  `headline` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `original` datetime DEFAULT NULL,
  `fontsize` varchar(255) DEFAULT NULL,
  `fontstyle` varchar(255) DEFAULT NULL,
  `fontfamily` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Issue`
--

DROP TABLE IF EXISTS `Issue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Issue` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dateOfPublication` datetime NOT NULL,
  `toggleDivTagsOn` tinyint(1) NOT NULL,
  `priceOfCopy` decimal(10,0) NOT NULL,
  `tagLine` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `QRImage` longblob NOT NULL,
  `headingTheme` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `secondTheme` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `brace` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Outline`
--

DROP TABLE IF EXISTS `Outline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Outline` (
  `id` int NOT NULL AUTO_INCREMENT,
  `binder_id` int DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `username` varchar(255) DEFAULT NULL,
  `original` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `OutlineEntry`
--

DROP TABLE IF EXISTS `OutlineEntry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `OutlineEntry` (
  `id` int NOT NULL AUTO_INCREMENT,
  `outline_id` int DEFAULT NULL,
  `binder_id` int DEFAULT NULL,
  `order_no` int DEFAULT NULL,
  `label` varchar(10) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `original` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PageContainer`
--

DROP TABLE IF EXISTS `PageContainer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PageContainer` (
  `pageid` int NOT NULL,
  `containerid` int NOT NULL,
  `pagetype` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Picture`
--

DROP TABLE IF EXISTS `Picture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Picture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `binder_id` int DEFAULT NULL,
  `credit` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `subfolder` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `caption` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `width` int NOT NULL,
  `height` int NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `original` datetime DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PixLink`
--

DROP TABLE IF EXISTS `PixLink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PixLink` (
  `id` int NOT NULL AUTO_INCREMENT,
  `width` int NOT NULL,
  `height` int NOT NULL,
  `gluex` tinyint(1) NOT NULL,
  `gluey` tinyint(1) NOT NULL,
  `prevx` tinyint(1) NOT NULL,
  `prevy` tinyint(1) NOT NULL,
  `resetx` tinyint(1) NOT NULL,
  `resety` tinyint(1) NOT NULL,
  `drift` tinyint(1) NOT NULL,
  `gravity` tinyint(1) NOT NULL,
  `offsetx` int NOT NULL,
  `offsety` int NOT NULL,
  `pixclass` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `pixReference` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '(DC2Type:object)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Product`
--

DROP TABLE IF EXISTS `Product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `binder_id` int DEFAULT NULL,
  `name` char(50) NOT NULL,
  `sku` char(30) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `original` datetime DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `RichColumn`
--

DROP TABLE IF EXISTS `RichColumn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `RichColumn` (
  `id` int NOT NULL AUTO_INCREMENT,
  `width` int NOT NULL,
  `height` int NOT NULL,
  `gluex` tinyint(1) NOT NULL,
  `gluey` tinyint(1) NOT NULL,
  `prevx` tinyint(1) NOT NULL,
  `prevy` tinyint(1) NOT NULL,
  `resetx` tinyint(1) NOT NULL,
  `resety` tinyint(1) NOT NULL,
  `drift` tinyint(1) NOT NULL,
  `gravity` tinyint(1) NOT NULL,
  `offsetx` int NOT NULL,
  `offsety` int NOT NULL,
  `article` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '(DC2Type:object)',
  `startLine` int NOT NULL,
  `endLine` int NOT NULL,
  `useRemainder` tinyint(1) NOT NULL,
  `useContinuedOn` tinyint(1) NOT NULL,
  `continuedOn` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `useContinuedFrom` tinyint(1) NOT NULL,
  `continuedFrom` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `charsPerLine` int NOT NULL,
  `textClass` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `addLineHeight` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `SchematicParts`
--

DROP TABLE IF EXISTS `SchematicParts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `SchematicParts` (
  `containerid` int NOT NULL,
  `partid` int NOT NULL,
  `parttype` char(30) NOT NULL,
  `original` datetime DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `TextColumn`
--

DROP TABLE IF EXISTS `TextColumn`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `TextColumn` (
  `id` int NOT NULL AUTO_INCREMENT,
  `width` int NOT NULL,
  `height` int NOT NULL,
  `gluex` tinyint(1) NOT NULL,
  `gluey` tinyint(1) NOT NULL,
  `prevx` tinyint(1) NOT NULL,
  `prevy` tinyint(1) NOT NULL,
  `resetx` tinyint(1) NOT NULL,
  `resety` tinyint(1) NOT NULL,
  `drift` tinyint(1) NOT NULL,
  `gravity` tinyint(1) NOT NULL,
  `offsetx` int NOT NULL,
  `offsety` int NOT NULL,
  `startLine` int NOT NULL,
  `endLine` int NOT NULL,
  `fontSize` int NOT NULL,
  `useRemainder` tinyint(1) NOT NULL,
  `useContinuedOn` tinyint(1) NOT NULL,
  `useContinuedFrom` tinyint(1) NOT NULL,
  `continuedOn` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `continuedFrom` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `charsPerLine` int NOT NULL,
  `textclass` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `wordage` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL COMMENT '(DC2Type:object)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Wordage`
--

DROP TABLE IF EXISTS `Wordage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Wordage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `binder_id` int DEFAULT NULL,
  `wordage` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `columnSize` int NOT NULL,
  `title` tinytext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `original` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `blob_chunk`
--

DROP TABLE IF EXISTS `blob_chunk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blob_chunk` (
  `zoid` bigint NOT NULL,
  `tid` bigint NOT NULL,
  `chunk_num` bigint NOT NULL,
  `chunk` longblob NOT NULL,
  PRIMARY KEY (`zoid`,`tid`,`chunk_num`),
  KEY `blob_chunk_lookup` (`zoid`,`tid`),
  CONSTRAINT `blob_chunk_fk` FOREIGN KEY (`zoid`, `tid`) REFERENCES `object_state` (`zoid`, `tid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `current_object`
--

DROP TABLE IF EXISTS `current_object`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `current_object` (
  `zoid` bigint NOT NULL,
  `tid` bigint NOT NULL,
  PRIMARY KEY (`zoid`),
  KEY `zoid` (`zoid`,`tid`),
  KEY `current_object_tid` (`tid`),
  CONSTRAINT `current_object_ibfk_1` FOREIGN KEY (`zoid`, `tid`) REFERENCES `object_state` (`zoid`, `tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log_table_name`
--

DROP TABLE IF EXISTS `log_table_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_table_name` (
  `created` datetime DEFAULT NULL,
  `type` varchar(40) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `timestamp` varchar(60) DEFAULT NULL,
  `priority` varchar(30) DEFAULT NULL,
  `priorityName` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `new_oid`
--

DROP TABLE IF EXISTS `new_oid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `new_oid` (
  `zoid` bigint NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`zoid`)
) ENGINE=MyISAM AUTO_INCREMENT=2046 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `object_ref`
--

DROP TABLE IF EXISTS `object_ref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `object_ref` (
  `zoid` bigint NOT NULL,
  `tid` bigint NOT NULL,
  `to_zoid` bigint NOT NULL,
  PRIMARY KEY (`tid`,`zoid`,`to_zoid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `object_refs_added`
--

DROP TABLE IF EXISTS `object_refs_added`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `object_refs_added` (
  `tid` bigint NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `object_state`
--

DROP TABLE IF EXISTS `object_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `object_state` (
  `zoid` bigint NOT NULL,
  `tid` bigint NOT NULL,
  `prev_tid` bigint NOT NULL,
  `md5` char(32) CHARACTER SET ascii COLLATE ascii_general_ci DEFAULT NULL,
  `state_size` bigint NOT NULL,
  `state` longblob,
  PRIMARY KEY (`zoid`,`tid`),
  KEY `object_state_tid` (`tid`),
  KEY `object_state_prev_tid` (`prev_tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pack_object`
--

DROP TABLE IF EXISTS `pack_object`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pack_object` (
  `zoid` bigint NOT NULL,
  `keep` tinyint(1) NOT NULL,
  `keep_tid` bigint NOT NULL,
  `visited` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`zoid`),
  KEY `pack_object_keep_zoid` (`keep`,`zoid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pack_state`
--

DROP TABLE IF EXISTS `pack_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pack_state` (
  `tid` bigint NOT NULL,
  `zoid` bigint NOT NULL,
  PRIMARY KEY (`tid`,`zoid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pack_state_tid`
--

DROP TABLE IF EXISTS `pack_state_tid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pack_state_tid` (
  `tid` bigint NOT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaction` (
  `tid` bigint NOT NULL,
  `packed` tinyint(1) NOT NULL DEFAULT '0',
  `empty` tinyint(1) NOT NULL DEFAULT '0',
  `username` blob NOT NULL,
  `description` blob NOT NULL,
  `extension` blob,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-09-23 13:16:02
