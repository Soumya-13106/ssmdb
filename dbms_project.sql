-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: dbms_project1
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

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
-- Table structure for table `actor`
--

DROP TABLE IF EXISTS `actor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actor` (
  `aid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actor`
--

LOCK TABLES `actor` WRITE;
/*!40000 ALTER TABLE `actor` DISABLE KEYS */;
INSERT INTO `actor` VALUES (1,'Benedict Cumberbatch','1981-09-18'),(2,'Shahrukh Khan','1975-03-21'),(3,'Deepika Padukone','1991-05-02'),(4,'Srishti Sengupta','1995-07-16'),(5,'Sambhav Satija','1995-03-29'),(6,'Naman Gupta','1994-11-27'),(7,'Ranbir Kapoor','1985-10-14'),(8,'Amitabh Bacchan','1965-06-17'),(9,'Kareena Kapoor','1975-11-22'),(10,'Priyanka Chopra','1979-01-12'),(11,'Soumya Sharma','1994-07-13'),(12,'Parineeti Chopra','1989-03-17'),(13,'Rani Mukherjee','1970-06-15'),(14,'Vidya Balan','1979-03-25'),(15,'Alia Bhatt','1990-04-30');
/*!40000 ALTER TABLE `actor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `actor_director`
--

DROP TABLE IF EXISTS `actor_director`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `actor_director` (
  `aid` int(10) DEFAULT NULL,
  `did` int(10) DEFAULT NULL,
  KEY `actor_director_fk1` (`aid`),
  KEY `actor_director_fk2` (`did`),
  CONSTRAINT `actor_director_fk1` FOREIGN KEY (`aid`) REFERENCES `actor` (`aid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `actor_director_fk2` FOREIGN KEY (`did`) REFERENCES `director` (`did`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `actor_director`
--

LOCK TABLES `actor_director` WRITE;
/*!40000 ALTER TABLE `actor_director` DISABLE KEYS */;
INSERT INTO `actor_director` VALUES (2,34),(8,33),(4,35);
/*!40000 ALTER TABLE `actor_director` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `acts_in`
--

DROP TABLE IF EXISTS `acts_in`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acts_in` (
  `aid` int(10) DEFAULT NULL,
  `mid` int(10) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  KEY `acts_in_fk1` (`aid`),
  KEY `acts_in_fk2` (`mid`),
  CONSTRAINT `acts_in_fk1` FOREIGN KEY (`aid`) REFERENCES `actor` (`aid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `acts_in_fk2` FOREIGN KEY (`mid`) REFERENCES `movies` (`mid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acts_in`
--

LOCK TABLES `acts_in` WRITE;
/*!40000 ALTER TABLE `acts_in` DISABLE KEYS */;
INSERT INTO `acts_in` VALUES (1,102,'Lead Role'),(5,100,'Bulla'),(6,100,'Khayega kela?'),(4,101,'Princess'),(2,100,'Bleh!');
/*!40000 ALTER TABLE `acts_in` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `directed_by`
--

DROP TABLE IF EXISTS `directed_by`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `directed_by` (
  `did` int(10) DEFAULT NULL,
  `mid` int(10) DEFAULT NULL,
  KEY `directed_by_fk1` (`did`),
  KEY `directed_by_fk2` (`mid`),
  CONSTRAINT `directed_by_fk1` FOREIGN KEY (`did`) REFERENCES `director` (`did`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `directed_by_fk2` FOREIGN KEY (`mid`) REFERENCES `movies` (`mid`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `directed_by`
--

LOCK TABLES `directed_by` WRITE;
/*!40000 ALTER TABLE `directed_by` DISABLE KEYS */;
INSERT INTO `directed_by` VALUES (30,100),(34,101),(31,102),(33,103);
/*!40000 ALTER TABLE `directed_by` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `director`
--

DROP TABLE IF EXISTS `director`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `director` (
  `did` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `director`
--

LOCK TABLES `director` WRITE;
/*!40000 ALTER TABLE `director` DISABLE KEYS */;
INSERT INTO `director` VALUES (30,'Yash Raj','1928-05-21'),(31,'Christopher Nolan','1981-08-21'),(32,'Raj Kumar Hirani','1939-03-07'),(33,'Amitabh Bacchan','1965-06-17'),(34,'Shahrukh Khan','1975-03-21'),(35,'Srishti Sengupta','1995-07-16'),(36,'Sanjay Leela Bhansali','1970-03-12');
/*!40000 ALTER TABLE `director` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genre` (
  `gid` int(10) NOT NULL AUTO_INCREMENT,
  `genrename` varchar(20) NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre`
--

LOCK TABLES `genre` WRITE;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` VALUES (70,'Horror'),(71,'Drama'),(72,'Romance'),(73,'Thriller');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genre_mapping`
--

DROP TABLE IF EXISTS `genre_mapping`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genre_mapping` (
  `gid` int(10) DEFAULT NULL,
  `mid` int(10) DEFAULT NULL,
  KEY `genre_mapping_fk1` (`gid`),
  KEY `genre_mapping_fk2` (`mid`),
  CONSTRAINT `genre_mapping_fk1` FOREIGN KEY (`gid`) REFERENCES `genre` (`gid`) ON UPDATE CASCADE,
  CONSTRAINT `genre_mapping_fk2` FOREIGN KEY (`mid`) REFERENCES `movies` (`mid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre_mapping`
--

LOCK TABLES `genre_mapping` WRITE;
/*!40000 ALTER TABLE `genre_mapping` DISABLE KEYS */;
INSERT INTO `genre_mapping` VALUES (70,100),(71,100),(72,102),(73,101);
/*!40000 ALTER TABLE `genre_mapping` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movies` (
  `mid` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `yearofrelease` int(4) NOT NULL,
  `length` time DEFAULT NULL,
  `sid` int(10) DEFAULT NULL,
  `pid` int(10) DEFAULT NULL,
  PRIMARY KEY (`mid`),
  KEY `plot_fk1` (`pid`),
  KEY `movies_fk1` (`sid`),
  CONSTRAINT `movies_fk1` FOREIGN KEY (`sid`) REFERENCES `studio` (`sid`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `plot_fk1` FOREIGN KEY (`pid`) REFERENCES `plot` (`pid`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movies`
--

LOCK TABLES `movies` WRITE;
/*!40000 ALTER TABLE `movies` DISABLE KEYS */;
INSERT INTO `movies` VALUES (100,'Gunda',1997,'00:02:04',11,21),(101,'Princess Kaguya',2001,'01:42:04',10,22),(102,'PS I love you',2003,'00:00:00',12,20),(103,'Kabhi Khushi Kabhi Gham',2005,'03:00:00',14,23);
/*!40000 ALTER TABLE `movies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plot`
--

DROP TABLE IF EXISTS `plot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plot` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `plot` text,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plot`
--

LOCK TABLES `plot` WRITE;
/*!40000 ALTER TABLE `plot` DISABLE KEYS */;
INSERT INTO `plot` VALUES (20,'Still court no small think death so an wrote. Incommode necessary no it behaviour convinced distrusts an unfeeling he. Could death since do we hoped is in. Exquisite no my attention extensive. The determine conveying moonlight age. Avoid for see marry sorry child. Sitting so totally forbade hundred to.'),(21,'At as in understood an remarkably solicitude. Mean them very seen she she. Use totally written the observe pressed justice. Instantly cordially far intention recommend estimable yet her his. Ladies stairs enough esteem add fat all enable. Needed its design number winter see. Oh be me sure wise sons no. Piqued ye of am spirit regret. Stimulated discretion impossible admiration in particular conviction up.'),(22,'Considered an invitation do introduced sufficient understood instrument it. Of decisively friendship in as collecting at. No affixed be husband ye females brother garrets proceed. Least child who seven happy yet balls young. Discovery sweetness principle discourse shameless bed one excellent. Sentiments of surrounded friendship dispatched connection is he. Me or produce besides hastily up as pleased. Bore less when had and john shed hope. \n\nPiqued favour stairs it enable exeter as seeing. Remainder met improving but engrossed sincerity age. Better but length gay denied abroad are. Attachment astonished to on appearance imprudence so collecting in excellence. Tiled way blind lived whose new. The for fully had she there leave merit enjoy forth. '),(23,'RandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomTextRandomText');
/*!40000 ALTER TABLE `plot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote_by`
--

DROP TABLE IF EXISTS `quote_by`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quote_by` (
  `qid` int(10) NOT NULL AUTO_INCREMENT,
  `mid` int(10) DEFAULT NULL,
  `quote` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`qid`),
  KEY `quote_by_fk2` (`mid`),
  CONSTRAINT `quote_by_fk2` FOREIGN KEY (`mid`) REFERENCES `movies` (`mid`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=504 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quote_by`
--

LOCK TABLES `quote_by` WRITE;
/*!40000 ALTER TABLE `quote_by` DISABLE KEYS */;
INSERT INTO `quote_by` VALUES (500,102,'PS - I love you'),(501,100,'Mera naam hai bulla. Rakhta hoon khullaaaaaaaaaaa!!!'),(502,102,'My husband died at the age of 31. He wasn\'t supposed to die'),(503,101,'Bhuchuk');
/*!40000 ALTER TABLE `quote_by` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studio`
--

DROP TABLE IF EXISTS `studio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studio` (
  `sid` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `addid` int(10) DEFAULT NULL,
  PRIMARY KEY (`sid`),
  KEY `studio_fk1` (`addid`),
  CONSTRAINT `studio_fk1` FOREIGN KEY (`addid`) REFERENCES `studio_address` (`aid`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studio`
--

LOCK TABLES `studio` WRITE;
/*!40000 ALTER TABLE `studio` DISABLE KEYS */;
INSERT INTO `studio` VALUES (10,'Gibli',6287),(11,'Yash Raj',1234),(12,'Warner Bros',7465),(13,'Paramount',2345),(14,'Sharma Studios',3456);
/*!40000 ALTER TABLE `studio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studio_address`
--

DROP TABLE IF EXISTS `studio_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studio_address` (
  `aid` int(10) NOT NULL AUTO_INCREMENT,
  `street1` varchar(100) DEFAULT NULL,
  `street2` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zipcode` int(10) DEFAULT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=7466 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studio_address`
--

LOCK TABLES `studio_address` WRITE;
/*!40000 ALTER TABLE `studio_address` DISABLE KEYS */;
INSERT INTO `studio_address` VALUES (1234,'Jogeshwari','Andheri','Bombay','Mahrashtra',914734),(2345,'Parker Street','London','England','Great Britain',234656),(3456,'MG Road','Vasant Kunj','New Delhi','India',110076),(6287,'Ring Road','Poo Poo','Ludhiana','Punjab',372639),(7465,'221B','Baker Street','London','UK',274635);
/*!40000 ALTER TABLE `studio_address` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-01  3:21:40
