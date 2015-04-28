-- MySQL dump 10.13  Distrib 5.6.23, for Win64 (x86_64)
--
-- Host: byteme.c1hwkftnnf4i.us-west-2.rds.amazonaws.com    Database: innodb
-- ------------------------------------------------------
-- Server version	5.6.19-log

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
-- Table structure for table `junior`
--

DROP TABLE IF EXISTS `junior`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `junior` (
  `jid` int(10) NOT NULL AUTO_INCREMENT,
  `studentNum` int(11) NOT NULL,
  `yearStand` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `programOfStudy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `courses` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `csid` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `coop` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`jid`)
) ENGINE=InnoDB AUTO_INCREMENT=5477 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kickoffgroup`
--

DROP TABLE IF EXISTS `kickoffgroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kickoffgroup` (
  `kgid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grouping` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`kgid`,`grouping`)
) ENGINE=InnoDB AUTO_INCREMENT=358 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `kickoffresult`
--

DROP TABLE IF EXISTS `kickoffresult`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kickoffresult` (
  `kid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`kid`)
) ENGINE=InnoDB AUTO_INCREMENT=358 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `logID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`logID`),
  KEY `name_idx` (`email`),
  CONSTRAINT `email` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=45411 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mentor`
--

DROP TABLE IF EXISTS `mentor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mentor` (
  `mid` int(10) NOT NULL AUTO_INCREMENT,
  `job` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'position',
  `yearofcs` int(4) NOT NULL,
  `edulvl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=5480 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mentorapp`
--

DROP TABLE IF EXISTS `mentorapp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mentorapp` (
  `mappid` int(11) NOT NULL AUTO_INCREMENT,
  `kickoff` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extra` blob,
  `year` int(11) NOT NULL,
  `deadline` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`mappid`,`year`),
  UNIQUE KEY `year_UNIQUE` (`year`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO mentorapp VALUES (1,'Nov 13 2015, Nov 14 2015, Nov 15 2015','textarea|Hobbies|Hobbies and Interests (please enter as comma-seperated list)`textarea|AdditionalComments|Additional questions or comments?', 2015, '2015-12-13');
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
-- Table structure for table `parameter`
--

DROP TABLE IF EXISTS `parameter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parameter` (
  `pid` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `extra` blob COMMENT '{“name”:”bob”,”gender”:female”}',
  PRIMARY KEY (`pid`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `participant`
--

DROP TABLE IF EXISTS `participant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participant` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `First name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Family name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kickoff` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `phone alt` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth year` varchar(45) COLLATE utf8_unicode_ci DEFAULT 'null',
  `genderpref` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `past participation` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'No',
  `waitlist` tinyint(1) NOT NULL,
  `year` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `interest` blob,
  PRIMARY KEY (`pid`,`email`,`year`)
) ENGINE=InnoDB AUTO_INCREMENT=5480 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report` (
  `rid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mentor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `senior` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `junior` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `satisfaction` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB AUTO_INCREMENT=19626 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `senior`
--

DROP TABLE IF EXISTS `senior`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `senior` (
  `sid` int(10) NOT NULL AUTO_INCREMENT,
  `studentNum` int(11) NOT NULL,
  `yearStand` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `programOfStudy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `courses` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `csid` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `coop` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=5479 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `studentapp`
--

DROP TABLE IF EXISTS `studentapp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studentapp` (
  `sappid` int(11) NOT NULL AUTO_INCREMENT,
  `program` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `kickoff` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  `extra` blob,
  `year` int(11) NOT NULL,
  `deadline` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`sappid`),
  UNIQUE KEY `year_UNIQUE` (`year`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO studentapp VALUES (1,'BA - Computer Science,BComm - Combined Business / Computer Science (BUCS),BCS (Bachelor of CS - 2nd Degree),BSc - Cognitive Systems (Comp. Intelligence and Design),BSc - Computer Science,BSc - Combined Major (Computer Science and Biology),BSc - Combined Major (Computer Science and Mathematics),BSc - Combined Major (Computer Science and Microbiology and Immunology),BSc - Combined Major (Computer Science and Statistics),BSc - Combined Major (Computer Science and Physics),BSc - Combined Major (Computer Science and Another Science Subject),BSc - Honours Computer Science', 'Nov 13 2015, Nov 14 2015, Nov 15 2015', 'checkbox|CareerPlan|Future career plans(choose all that apply)|Work in CS-related job immediately after graduation,Work for a start-up,Own my own business,Complete a Masters of PHD,Work as an academic,Career plans still unsure`textarea|Hobbies|Hobbies and Interests (please enter as comma-seperated list)`textarea|AdditionalComments|Additional questions or comments?', 2015, '2015-12-13');
--
-- Table structure for table `trioMatching`
--

DROP TABLE IF EXISTS `trioMatching`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trioMatching` (
  `tid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wid` int(11) NOT NULL,
  `mentor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `senior` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `junior` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `satisfaction` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`tid`),
  KEY `wid_idx` (`wid`),
  CONSTRAINT `wid` FOREIGN KEY (`wid`) REFERENCES `weighting` (`wid`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1942 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`,`email`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

INSERT INTO users values (1,'admin','admin@tmms.com','$2y$10$Hv8VNue9I80NUFpcH4bypun0lcUTM2T79FYeaV8VloaB8rhRm7rpW',null,'0000-00-00 00:00:00','0000-00-00 00:00:00');
-- Table structure for table `weighting`
--

DROP TABLE IF EXISTS `weighting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `weighting` (
  `wid` int(10) NOT NULL AUTO_INCREMENT,
  `must` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `helpful` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `optional` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avgSat` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `median` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `setAsFinal` tinyint(1) NOT NULL DEFAULT '0',
  `year` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`wid`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-09 23:19:12
