-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: finder
-- ------------------------------------------------------
-- Server version	5.5.40-0ubuntu0.14.04.1

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
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `category` int(10) unsigned DEFAULT NULL,
  `sub_category_of` int(10) unsigned DEFAULT NULL,
  `description_url` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES (1,'D',6,NULL,'http://wikipedia.com/D','2014-07-17 01:49:05','2014-07-22 12:38:49'),(2,'ABC',3,3,'http://wikipedia.com/ABC','2014-07-17 01:49:36','2014-07-22 12:38:17'),(3,'A',1,NULL,'http://wikipedia.com/A','2014-07-18 19:37:29','2014-07-18 19:37:29'),(4,'AB',2,3,'http://wikipedia.com/AB','2014-07-18 19:37:49','2014-07-18 19:37:49'),(5,'C',4,NULL,'http://wikipedia.com/C','2014-07-22 12:37:23','2014-07-22 12:37:23'),(6,'CA',5,5,'http://wikipedia.com/CA','2014-07-22 12:37:42','2014-07-22 12:37:42');
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activities_interests`
--

DROP TABLE IF EXISTS `activities_interests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activities_interests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity_id` int(10) unsigned DEFAULT NULL,
  `interest_id` int(10) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities_interests`
--

LOCK TABLES `activities_interests` WRITE;
/*!40000 ALTER TABLE `activities_interests` DISABLE KEYS */;
/*!40000 ALTER TABLE `activities_interests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interests`
--

DROP TABLE IF EXISTS `interests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` int(10) unsigned DEFAULT NULL,
  `activity_id` int(10) unsigned DEFAULT NULL,
  `giving` tinyint(1) DEFAULT '0',
  `recieving` tinyint(1) DEFAULT '0',
  `importance` int(2) unsigned DEFAULT NULL,
  `experience` int(2) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interests`
--

LOCK TABLES `interests` WRITE;
/*!40000 ALTER TABLE `interests` DISABLE KEYS */;
INSERT INTO `interests` VALUES (1,3,3,0,1,2,1,'2014-07-30 19:02:01','2014-07-30 19:02:01'),(2,3,4,0,1,2,2,'2014-07-30 19:02:01','2014-07-30 19:02:01'),(3,3,2,0,1,2,3,'2014-07-30 19:02:01','2014-07-30 19:02:01'),(4,3,0,0,1,1,2,'2014-07-30 19:36:09','2014-07-30 19:36:09');
/*!40000 ALTER TABLE `interests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (7,3,'Testy1\'s First Post','This is my first post Hello','2014-07-18 13:40:10','2014-07-18 13:40:10'),(9,3,'Testy1\'s Second Post','This is my first post Hello Adding More Now','2014-07-18 13:42:18','2014-07-18 13:42:40'),(10,3,'test','test','2014-07-23 18:38:49','2014-07-23 18:38:49'),(11,3,'test1','testttest','2014-07-23 18:39:23','2014-07-23 18:39:23'),(12,1,'hepaestus Post','This is a new post by hepaestus','2014-07-24 13:40:04','2014-07-24 19:32:59');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `scene_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender_identity` varchar(50) DEFAULT NULL,
  `relationship_status` varchar(50) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profiles`
--

LOCK TABLES `profiles` WRITE;
/*!40000 ALTER TABLE `profiles` DISABLE KEYS */;
INSERT INTO `profiles` VALUES (2,85,'testy20_scenename','','','testy20@testy.com','01060','1998-07-07','','',NULL,NULL,'2014-07-21 16:00:52','2014-07-21 16:55:37'),(4,3,'testy_1_scene_name','Tester','Testerson','testy1@testy.com','01062','1971-07-21','','',NULL,NULL,'2014-07-21 19:13:23','2014-07-21 19:45:30'),(5,1,'hep','Pete','FOO BAR','hepaestus@gmail.com','01060','1971-11-10','cis male','married',NULL,NULL,'2014-07-22 12:54:35','2014-07-24 13:49:44');
/*!40000 ALTER TABLE `profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reputation_stats`
--

DROP TABLE IF EXISTS `reputation_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reputation_stats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reputation_stats`
--

LOCK TABLES `reputation_stats` WRITE;
/*!40000 ALTER TABLE `reputation_stats` DISABLE KEYS */;
/*!40000 ALTER TABLE `reputation_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reputations`
--

DROP TABLE IF EXISTS `reputations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reputations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `reviewer_id` int(10) unsigned DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `endoresments_id` int(10) unsigned DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reputations`
--

LOCK TABLES `reputations` WRITE;
/*!40000 ALTER TABLE `reputations` DISABLE KEYS */;
/*!40000 ALTER TABLE `reputations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` int(10) unsigned DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `recovery_hash` varchar(50) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `loggedin` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,5,'hepaestus','08cbca0f9b5310a2ef4c7f6e84d1a962db560119','','admin','2014-07-24 19:32:37',0,NULL,'2014-07-24 19:33:18'),(2,NULL,'tori','08cbca0f9b5310a2ef4c7f6e84d1a962db560119','','admin',NULL,0,NULL,'2014-07-17 01:05:58'),(3,4,'testy1','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,'author','2014-07-31 14:50:13',1,'2014-07-17 16:30:20','2014-07-31 14:50:14'),(4,NULL,'testy2','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,'author','2014-07-24 19:24:12',0,'2014-07-17 16:30:34','2014-07-24 19:26:27'),(6,NULL,'testy3','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,'author',NULL,0,'2014-07-18 15:50:43','2014-07-18 15:50:43'),(14,NULL,'Testy4','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,NULL,0,'2014-07-18 18:02:24','2014-07-18 18:02:24'),(15,NULL,'testy6','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,NULL,0,'2014-07-18 18:03:32','2014-07-18 18:03:32'),(17,NULL,'foobar','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,NULL,0,'2014-07-18 18:50:38','2014-07-18 18:50:38'),(23,NULL,'flimflam','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,NULL,0,'2014-07-18 18:56:36','2014-07-18 18:56:36'),(35,NULL,'susie','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,'2014-07-21 13:18:09',0,'2014-07-18 19:21:00','2014-07-21 13:20:02'),(69,NULL,'testy5','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,'2014-07-21 14:55:10',0,'2014-07-21 14:53:59','2014-07-21 14:57:30'),(70,NULL,'testy7','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,NULL,0,'2014-07-21 14:57:56','2014-07-21 14:57:56'),(71,NULL,'testy8','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,NULL,0,'2014-07-21 15:06:35','2014-07-21 15:06:35'),(72,NULL,'testy9','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,NULL,0,'2014-07-21 15:08:47','2014-07-21 15:08:47'),(73,NULL,'testy10','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,'2014-07-21 18:45:47',1,'2014-07-21 15:11:36','2014-07-21 18:45:47'),(74,NULL,'testy10','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,NULL,0,'2014-07-21 15:12:30','2014-07-21 15:12:30'),(75,NULL,'testy11','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,NULL,0,'2014-07-21 15:13:41','2014-07-21 15:13:41'),(76,NULL,'testy12','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,NULL,0,'2014-07-21 15:16:24','2014-07-21 15:16:24'),(77,NULL,'testy13','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,NULL,0,'2014-07-21 15:17:20','2014-07-21 15:17:20'),(78,NULL,'testy14','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,NULL,0,'2014-07-21 15:18:35','2014-07-21 15:18:35'),(79,NULL,'testy14','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,NULL,0,'2014-07-21 15:19:19','2014-07-21 15:19:19'),(80,NULL,'testy15','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,NULL,0,'2014-07-21 15:22:09','2014-07-21 15:22:09'),(81,NULL,'testy16','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,NULL,0,'2014-07-21 15:24:05','2014-07-21 15:24:05'),(82,NULL,'testy17','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,NULL,0,'2014-07-21 15:25:57','2014-07-21 15:25:57'),(83,NULL,'testy18','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,NULL,0,'2014-07-21 15:27:22','2014-07-21 15:27:22'),(84,NULL,'testy19','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,NULL,0,'2014-07-21 15:28:19','2014-07-21 15:28:19'),(85,2,'testy20','08cbca0f9b5310a2ef4c7f6e84d1a962db560119',NULL,NULL,'2014-07-21 16:01:54',1,'2014-07-21 16:00:51','2014-07-21 16:01:54'),(86,NULL,NULL,NULL,NULL,NULL,NULL,0,'2014-07-22 17:48:46','2014-07-22 17:48:46');
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

-- Dump completed on 2014-10-23 11:18:56
