# Sequel Pro dump
# Version 2210
# http://code.google.com/p/sequel-pro
#
# Host: 127.0.0.1 (MySQL 5.1.44)
# Database: mindspider
# Generation Time: 2011-01-09 21:07:53 +0000
# ************************************************************

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table graphs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `graphs`;

CREATE TABLE `graphs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

LOCK TABLES `graphs` WRITE;
/*!40000 ALTER TABLE `graphs` DISABLE KEYS */;
INSERT INTO `graphs` (`id`,`name`)
VALUES
	(1,'tasks a'),
	(2,'tasks b'),
	(3,'tasks c');

/*!40000 ALTER TABLE `graphs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table nodes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `nodes`;

CREATE TABLE `nodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `number` int(11) DEFAULT NULL,
  `x_position` int(11) DEFAULT NULL,
  `y_position` int(11) DEFAULT NULL,
  `graph_id` int(11) DEFAULT NULL,
  `nucleus` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

LOCK TABLES `nodes` WRITE;
/*!40000 ALTER TABLE `nodes` DISABLE KEYS */;
INSERT INTO `nodes` (`id`,`name`,`number`,`x_position`,`y_position`,`graph_id`,`nucleus`)
VALUES
	(1,'wash up',NULL,538,109,1,0),
	(2,'vacuum living room',NULL,569,210,1,0),
	(3,'have bath',NULL,492,21,1,0),
	(4,'get boxes from shop',NULL,174,65,1,0),
	(5,'cancel bills',NULL,266,51,2,0),
	(6,'tasks a',NULL,67,464,1,1),
	(7,'tasks b',NULL,119,376,2,1),
	(8,'Node 4',NULL,528,181,2,0),
	(9,'Node 4',NULL,64,156,2,0),
	(10,'Node 5',NULL,546,74,2,0),
	(11,'Node 6',NULL,551,285,2,0),
	(12,'test new',NULL,382,491,2,0),
	(13,'test new 2',NULL,458,389,2,0),
	(14,'tasks c',NULL,260,270,3,1),
	(15,'Node 4',NULL,564,233,3,0),
	(16,'Node 3',NULL,611,317,3,0),
	(17,'Node 4',NULL,276,35,3,0),
	(18,'Node 5',NULL,480,66,3,0),
	(19,'Node 6',NULL,526,149,3,0),
	(20,'make sandwich',NULL,611,311,1,0),
	(21,'Node 4',NULL,17,203,1,0),
	(22,'Node 8',NULL,624,448,1,0);

/*!40000 ALTER TABLE `nodes` ENABLE KEYS */;
UNLOCK TABLES;





/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
