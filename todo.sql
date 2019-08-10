# Host: localhost  (Version 5.5.5-10.1.16-MariaDB)
# Date: 2016-12-22 11:44:04
# Generator: MySQL-Front 5.4  (Build 4.3)
# Internet: http://www.mysqlfront.de/

/*!40101 SET NAMES utf8 */;

#
# Structure for table "admin"
#

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "admin"
#


#
# Structure for table "comment"
#

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtodo` varchar(255) DEFAULT NULL,
  `idmhs` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "comment"
#


#
# Structure for table "dosen"
#

DROP TABLE IF EXISTS `dosen`;
CREATE TABLE `dosen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=214124145 DEFAULT CHARSET=latin1;

#
# Data for table "dosen"
#

INSERT INTO `dosen` VALUES (214124144,'Juned1','Bandung','0812222222','juned@juned.com');

#
# Structure for table "group"
#

DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idmatkul` varchar(255) DEFAULT NULL,
  `max` varchar(255) DEFAULT NULL,
  `min` varchar(255) DEFAULT NULL,
  `date_created` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "group"
#

INSERT INTO `group` VALUES (3,'1','6','4','2016-12-21 04:51:35am','Kelompok 2'),(4,'1','6','3','2016-12-21 04:44:04am','Kelompok 1');

#
# Structure for table "group_list"
#

DROP TABLE IF EXISTS `group_list`;
CREATE TABLE `group_list` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `idgroup` varchar(255) DEFAULT NULL,
  `idmhs` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "group_list"
#

INSERT INTO `group_list` VALUES (1,'4','17130043',''),(2,'3','17130041',NULL),(3,'4','17130044',NULL);

#
# Structure for table "mahasiswa"
#

DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE `mahasiswa` (
  `id` varchar(255) NOT NULL DEFAULT '',
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "mahasiswa"
#

INSERT INTO `mahasiswa` VALUES ('17130041','zidan','Jl. sana ke sini','zidan@abc.efg'),('17130042','Julian','Jl. sana ke sini','jusn@abc.efg'),('17130043','ahmad','Jl. sana ke sini','ahmad@abc.efg'),('17130044','Uliana','Jl. sana ke sini','ulin@abc.efg');

#
# Structure for table "matkul"
#

DROP TABLE IF EXISTS `matkul`;
CREATE TABLE `matkul` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `iddosen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "matkul"
#

INSERT INTO `matkul` VALUES (1,'Jaringan Komputer','214124144');

#
# Structure for table "matkul_mhs"
#

DROP TABLE IF EXISTS `matkul_mhs`;
CREATE TABLE `matkul_mhs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idmatkul` varchar(255) DEFAULT NULL,
  `idmhs` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "matkul_mhs"
#

INSERT INTO `matkul_mhs` VALUES (1,'1','17130043');

#
# Structure for table "todo"
#

DROP TABLE IF EXISTS `todo`;
CREATE TABLE `todo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(255) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `idmhs` varchar(255) DEFAULT NULL,
  `idgroup` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "todo"
#

INSERT INTO `todo` VALUES (1,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco',NULL,NULL,'a',NULL,'17130041','3',0),(3,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco','1899-12-29 00:00:00','2016-12-22 05:05:55','Membuat Footer','1899-12-29 00:00:00','17130043','4',0),(4,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco','1899-12-29 00:00:00','2016-12-22 05:06:44','Membuat Database','1899-12-29 00:00:00','17130043','4',0),(6,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco','1899-12-29 00:00:00','1899-12-29 00:00:00','Membuat Header','1899-12-29 00:00:00','17130043','4',1),(7,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco','1899-12-29 00:00:00','1899-12-29 00:00:00','3123',NULL,'17130044','4',1),(8,'242342rwerwerwfg asdfasdfasfsdfsd fsdfsd','2016-12-22 05:41:20',NULL,'Ini judul','2016-12-31 12:00:00','17130043','4',0),(9,'242342rwerwerwfg asdfasdfasfsdfsd fsdfsd','2016-12-22 05:42:20',NULL,'Ini judul','2016-12-31 12:00:00','17130043','4',0);

#
# Structure for table "users"
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

#
# Data for table "users"
#

INSERT INTO `users` VALUES (3,'214124144','$2y$10$VnlYkPTbJvxObbloCDYAEOnHwyKGnI1K3X/gupI4esuxWCybeXLEK','dosen'),(4,'17130043','$2y$10$YyoBWavrFDpbMOOLUVxzxe9CIuVr9aNg5PYeQ6j6GO/Iyl.Y5UBdu','mahasiswa');
