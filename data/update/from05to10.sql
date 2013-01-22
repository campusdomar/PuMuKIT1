--------------------------------------------------------------
------     BORRO DATOS VIEJOS
--------------------------------------------------------------
DROP TABLE IF EXISTS `bar_body`;
DROP TABLE IF EXISTS `bar_index_l`;
DROP TABLE IF EXISTS `bar_index_r`;
DROP TABLE IF EXISTS `body_index`;
DROP TABLE IF EXISTS `info`;
DROP TABLE IF EXISTS `info_i18n`;
DROP TABLE IF EXISTS `widget`;
DROP TABLE IF EXISTS `widget_index`;

DROP TABLE IF EXISTS `ground`;
DROP TABLE IF EXISTS `ground_i18n`;
--DROP TABLE IF EXISTS `ground_video`;
DROP TABLE IF EXISTS `direct`;
DROP TABLE IF EXISTS `direct_i18n`;
DROP TABLE IF EXISTS `broadcast`;
DROP TABLE IF EXISTS `broadcast_i18n`;
DROP TABLE IF EXISTS `rol`;
DROP TABLE IF EXISTS `rol_i18n`;

--------------------------------------------------------------
------     CAMBIOS DE NOMBRE
--------------------------------------------------------------

DROP TABLE IF EXISTS mime_type;
ALTER TABLE package RENAME mime_type;
DROP TABLE IF EXISTS notice;
ALTER TABLE nova RENAME notice;
DROP TABLE IF EXISTS notice_i18n;
ALTER TABLE nova_i18n RENAME notice_i18n;
DROP TABLE IF EXISTS mm_person;
ALTER TABLE video_person RENAME mm_person;
DROP TABLE IF EXISTS pic_mm;
ALTER TABLE pic_video RENAME pic_mm;
DROP TABLE IF EXISTS mm;
ALTER TABLE video RENAME mm;
DROP TABLE IF EXISTS mm_i18n;
ALTER TABLE video_i18n RENAME mm_i18n;




--------------------------------------------------------------
------      METO DATOS QUE NO EXISTEN
--------------------------------------------------------------
--/* Falata pasar broadcat para mm*/
--/* Falta quitar working de serie*/
-- MySQL dump 10.11
--
-- Host: localhost    Database: tvtres
-- ------------------------------------------------------
-- Server version	5.0.51a-3ubuntu5.1-log

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
-- Table structure for table `bar_widget`
--

DROP TABLE IF EXISTS `bar_widget`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `bar_widget` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(25) collate utf8_spanish_ci NOT NULL,
  `widget_type_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `bar_widget_name_unique` (`name`),
  KEY `bar_widget_FI_1` (`widget_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `bar_widget`
--

LOCK TABLES `bar_widget` WRITE;
/*!40000 ALTER TABLE `bar_widget` DISABLE KEYS */;
INSERT INTO `bar_widget` VALUES (1,'Headerbar',2),(2,'Footerbar',2),(3,'IndexbarLeft',1),(4,'IndexbarRight',1),(5,'Slidebar',1),(6,'IndexBody',3);
/*!40000 ALTER TABLE `bar_widget` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `broadcast_type`
--

DROP TABLE IF EXISTS `broadcast_type`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `broadcast_type` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(15) collate utf8_spanish_ci default NULL,
  `default_sel` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `broadcast_type`
--

LOCK TABLES `broadcast_type` WRITE;
/*!40000 ALTER TABLE `broadcast_type` DISABLE KEYS */;
INSERT INTO `broadcast_type` VALUES (1,'pub',1),(2,'cor',0),(3,'pri',0);
/*!40000 ALTER TABLE `broadcast_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `channel`
--

DROP TABLE IF EXISTS `channel`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `channel` (
  `id` int(11) NOT NULL auto_increment,
  `pic` varchar(250) collate utf8_spanish_ci NOT NULL,
  `working` int(11) NOT NULL default '1',
  `sql` varchar(250) collate utf8_spanish_ci NOT NULL,
  `rank` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `channel`
--

LOCK TABLES `channel` WRITE;
/*!40000 ALTER TABLE `channel` DISABLE KEYS */;
/*!40000 ALTER TABLE `channel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `channel_i18n`
--

DROP TABLE IF EXISTS `channel_i18n`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `channel_i18n` (
  `name` varchar(25) collate utf8_spanish_ci NOT NULL,
  `description` varchar(255) collate utf8_spanish_ci NOT NULL,
  `id` int(11) NOT NULL,
  `culture` varchar(7) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`,`culture`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `channel_i18n`
--

LOCK TABLES `channel_i18n` WRITE;
/*!40000 ALTER TABLE `channel_i18n` DISABLE KEYS */;
/*!40000 ALTER TABLE `channel_i18n` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `cpu`
--

DROP TABLE IF EXISTS `cpu`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `cpu` (
  `id` int(11) NOT NULL auto_increment,
  `ip` char(15) collate utf8_spanish_ci NOT NULL,
  `max` int(11) NOT NULL,
  `min` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `cpu`
--

LOCK TABLES `cpu` WRITE;
/*!40000 ALTER TABLE `cpu` DISABLE KEYS */;
INSERT INTO `cpu` VALUES (1,'172.20.209.68',2,0,1),(2,'172.20.209.59',2,0,1);
/*!40000 ALTER TABLE `cpu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cpu_i18n`
--

DROP TABLE IF EXISTS `cpu_i18n`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `cpu_i18n` (
  `description` varchar(200) collate utf8_spanish_ci NOT NULL,
  `id` int(11) NOT NULL,
  `culture` varchar(7) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`,`culture`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `cpu_i18n`
--

LOCK TABLES `cpu_i18n` WRITE;
/*!40000 ALTER TABLE `cpu_i18n` DISABLE KEYS */;
/*!40000 ALTER TABLE `cpu_i18n` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direct`
--

DROP TABLE IF EXISTS `direct`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `direct` (
  `id` int(11) NOT NULL auto_increment,
  `resolution_id` int(11) default NULL,
  `url` varchar(250) collate utf8_spanish_ci NOT NULL,
  `precinct_id` int(11) default NULL,
  `mime_type_id` int(11) default NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `direct_FI_1` (`resolution_id`),
  KEY `direct_FI_2` (`precinct_id`),
  KEY `direct_FI_3` (`mime_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `direct`
--

LOCK TABLES `direct` WRITE;
/*!40000 ALTER TABLE `direct` DISABLE KEYS */;
/*!40000 ALTER TABLE `direct` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direct_i18n`
--

DROP TABLE IF EXISTS `direct_i18n`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `direct_i18n` (
  `name` varchar(100) collate utf8_spanish_ci NOT NULL,
  `description` text collate utf8_spanish_ci,
  `event` varchar(100) collate utf8_spanish_ci NOT NULL,
  `id` int(11) NOT NULL,
  `culture` varchar(7) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`,`culture`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `direct_i18n`
--

LOCK TABLES `direct_i18n` WRITE;
/*!40000 ALTER TABLE `direct_i18n` DISABLE KEYS */;
/*!40000 ALTER TABLE `direct_i18n` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `element_widget`
--

DROP TABLE IF EXISTS `element_widget`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `element_widget` (
  `bar_widget_id` int(11) NOT NULL,
  `widget_id` int(11) NOT NULL,
  `rank` int(11) NOT NULL default '0',
  PRIMARY KEY  (`bar_widget_id`,`widget_id`),
  KEY `element_widget_FI_2` (`widget_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `element_widget`
--

LOCK TABLES `element_widget` WRITE;
/*!40000 ALTER TABLE `element_widget` DISABLE KEYS */;
INSERT INTO `element_widget` VALUES (1,1,1),(2,3,1),(3,6,1),(3,8,2),(3,7,3),(3,10,4),(5,6,1),(5,8,2),(5,7,3),(4,12,1),(4,13,2),(4,14,3),(6,21,1),(6,22,2),(6,24,3);
/*!40000 ALTER TABLE `element_widget` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `ground`
--

DROP TABLE IF EXISTS `ground`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `ground` (
  `id` int(11) NOT NULL auto_increment,
  `cod` varchar(25) collate utf8_spanish_ci NOT NULL,
  `ground_type_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `ground_cod_unique` (`cod`),
  KEY `ground_FI_1` (`ground_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `ground`
--

LOCK TABLES `ground` WRITE;
/*!40000 ALTER TABLE `ground` DISABLE KEYS */;
INSERT INTO `ground` VALUES (1,'U110000',1),(2,'U120000',1),(3,'U210000',1),(4,'U220000',1),(5,'U230000',1),(6,'U240000',1),(7,'U250000',1),(8,'U310000',1),(9,'U320000',1),(10,'U330000',1),(11,'U510000',1),(12,'U520000',1),(13,'U530000',1),(14,'U540000',1),(15,'U550000',1),(16,'U560000',1),(17,'U570000',1),(18,'U580000',1),(19,'U590000',1),(20,'U610000',1),(21,'U620000',1),(22,'U630000',1),(23,'U710000',1),(24,'U720000',1),(25,'U910000',1),(26,'U920000',1),(27,'U930000',1),(28,'Dsalud',2),(29,'Dciencia',2),(30,'Djuridicosocial',2),(31,'Dtecnologia',2),(32,'Dhumanistica',2);
/*!40000 ALTER TABLE `ground` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ground_i18n`
--

DROP TABLE IF EXISTS `ground_i18n`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `ground_i18n` (
  `name` varchar(100) collate utf8_spanish_ci NOT NULL,
  `id` int(11) NOT NULL,
  `culture` varchar(7) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`,`culture`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `ground_i18n`
--

LOCK TABLES `ground_i18n` WRITE;
/*!40000 ALTER TABLE `ground_i18n` DISABLE KEYS */;
INSERT INTO `ground_i18n` VALUES ('Lóxica',1,'gl'),('Lógica',1,'es'),('Logic',1,'en'),('Matemáticas',2,'gl'),('Matemáticas',2,'es'),('Math',2,'en'),('Astronomía e Astrofísica',3,'gl'),('Astronomía y Astrofísica',3,'es'),('Astronomy and Astrophysics',3,'en'),('Física',4,'gl'),('Física',4,'es'),('Physics',4,'en'),('Química',5,'gl'),('Química',5,'es'),('Chemistry',5,'en'),('Ciencias da Vida',6,'gl'),('Ciencias de la Vida',6,'es'),('Life science',6,'en'),('Ciencias da Terra e do Cosmos',7,'gl'),('Ciencias de la Tierra y del Cosmos',7,'es'),('Earth and Cosmos science',7,'en'),('Ciencias Agronómicas e Veterinarias',8,'gl'),('Ciencias Agronómicas y Veterinarias',8,'es'),('Agronomist science and Veterinarian',8,'en'),('Medicina e Patoloxías Humans',9,'gl'),('Medicina y Patologías Humanas',9,'es'),('Medicine and Human Pathology',9,'en'),('Ciencias da Tecnoloxía',10,'gl'),('Ciencias de la Tecnología',10,'es'),('Technology science',10,'en'),('Antropoloxía',11,'gl'),('Antropología',11,'es'),('Anthropology',11,'en'),('Demografía',12,'gl'),('Demografía',12,'es'),('Demography',12,'en'),('Ciencias Económicas',13,'gl'),('Ciencias Económicas',13,'es'),('Economic science',13,'en'),('Xeografía',14,'gl'),('Geografía',14,'es'),('Geography',14,'en'),('Historia',15,'gl'),('Historia',15,'es'),('History',15,'en'),('Ciencia Xurídicas e Dereito',16,'gl'),('Ciencia Jurídicas y Derecho',16,'es'),('Legal science and Law',16,'en'),('Lingüística',17,'gl'),('Lingüística',17,'es'),('Linguistics',17,'en'),('Pedagoxía',18,'gl'),('Pedagogía',18,'es'),('Pedagogy',18,'en'),('Ciencias Políticas',19,'gl'),('Ciencias Políticas',19,'es'),('Political science',19,'en'),('Psicoloxía',20,'gl'),('Psicología',20,'es'),('Psychology',20,'en'),('Artes e Letras',21,'gl'),('Artes e Letras',21,'es'),('Arts and Letters',21,'en'),('Socioloxía',22,'gl'),('Sociología',22,'es'),('Sociology',22,'en'),('Ética',23,'gl'),('Ética',23,'es'),('Ethic',23,'en'),('Filosofía',24,'gl'),('Filosofía',24,'es'),('Philosophy',24,'en'),('Corporativo',25,'gl'),('Corporativo',25,'es'),('Corporative',25,'en'),('Vida Universitaria',26,'gl'),('Vida Universitaria',26,'es'),('University life',26,'en'),('Noticias',27,'gl'),('Noticias',27,'es'),('News',27,'en'),('Ciencias da Saude',28,'gl'),('Ciencias de la Salud',28,'es'),('Health Sciences',28,'en'),('Ciencias Experimentais',29,'gl'),('Ciencias Experimentales',29,'es'),('Experimental sciences',29,'en'),('Ciencias Xuridico-Sociais',30,'gl'),('Ciencias Juridico-Sociales',30,'es'),('Social and Legal sciences',30,'en'),('Ciencias tecnoloxicas',31,'gl'),('Ciencias tecnologicas',31,'es'),('Technical sciences',31,'en'),('Humanidades',32,'gl'),('Humanidades',32,'es'),('Humanities',32,'en');
/*!40000 ALTER TABLE `ground_i18n` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ground_mm`
--

--DROP TABLE IF EXISTS `ground_mm`;
--SET @saved_cs_client     = @@character_set_client;
--SET character_set_client = utf8;
--CREATE TABLE `ground_mm` (
--  `ground_id` int(11) NOT NULL,
--  `mm_id` int(11) NOT NULL,
--  `rank` int(11) NOT NULL default '0',
--  PRIMARY KEY  (`ground_id`,`mm_id`),
--  KEY `ground_mm_FI_2` (`mm_id`)
--) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
--SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `ground_mm`
--

--LOCK TABLES `ground_mm` WRITE;
--/*!40000 ALTER TABLE `ground_mm` DISABLE KEYS */;
--/*!40000 ALTER TABLE `ground_mm` ENABLE KEYS */;
--UNLOCK TABLES;

--
-- Table structure for table `ground_type`
--

DROP TABLE IF EXISTS `ground_type`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `ground_type` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) collate utf8_spanish_ci NOT NULL,
  `display` int(11) NOT NULL default '1',
  `rank` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `ground_type_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `ground_type`
--

LOCK TABLES `ground_type` WRITE;
/*!40000 ALTER TABLE `ground_type` DISABLE KEYS */;
INSERT INTO `ground_type` VALUES (1,'Unesco',1,1),(2,'Directriz',1,2);
/*!40000 ALTER TABLE `ground_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ground_type_i18n`
--

DROP TABLE IF EXISTS `ground_type_i18n`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `ground_type_i18n` (
  `description` varchar(100) collate utf8_spanish_ci NOT NULL,
  `id` int(11) NOT NULL,
  `culture` varchar(7) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`,`culture`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `ground_type_i18n`
--

LOCK TABLES `ground_type_i18n` WRITE;
/*!40000 ALTER TABLE `ground_type_i18n` DISABLE KEYS */;
INSERT INTO `ground_type_i18n` VALUES ('Area de conocimento da NESCO',1,'gl'),('Area de conocimento da UNESCO',1,'es'),('UNESCO subject areas',1,'en'),('Area Directriz',2,'gl'),('Area Directriz',2,'es'),('Directriz domain',2,'en');
/*!40000 ALTER TABLE `ground_type_i18n` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `log_transcoding`
--

DROP TABLE IF EXISTS `log_transcoding`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `log_transcoding` (
  `id` int(11) NOT NULL auto_increment,
  `mm_id` int(11) NOT NULL,
  `language_id` int(11) default NULL,
  `perfil_id` int(11) default NULL,
  `cpu_id` int(11) default NULL,
  `url` varchar(250) collate utf8_spanish_ci NOT NULL,
  `status_id` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `name` varchar(150) collate utf8_spanish_ci NOT NULL,
  `timeini` datetime NOT NULL,
  `timestart` datetime NOT NULL,
  `timeend` datetime NOT NULL,
  `pid` int(11) default NULL,
  `path_ini` varchar(250) collate utf8_spanish_ci NOT NULL,
  `path_end` varchar(250) collate utf8_spanish_ci NOT NULL,
  `ext_ini` char(3) collate utf8_spanish_ci NOT NULL,
  `ext_end` char(3) collate utf8_spanish_ci NOT NULL,
  `duration` int(11) NOT NULL default '0',
  `size` int(11) NOT NULL default '0',
  `email` varchar(30) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `log_transcoding_FI_1` (`mm_id`),
  KEY `log_transcoding_FI_2` (`language_id`),
  KEY `log_transcoding_FI_3` (`perfil_id`),
  KEY `log_transcoding_FI_4` (`cpu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `log_transcoding`
--

LOCK TABLES `log_transcoding` WRITE;
/*!40000 ALTER TABLE `log_transcoding` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_transcoding` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `perfil` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(25) collate utf8_spanish_ci NOT NULL,
  `rank` int(11) NOT NULL default '1',
  `display` int(11) NOT NULL default '1',
  `wizard` int(11) NOT NULL default '1',
  `format` varchar(35) collate utf8_spanish_ci default NULL,
  `codec` varchar(35) collate utf8_spanish_ci default NULL,
  `mime_type` varchar(35) collate utf8_spanish_ci default NULL,
  `extension` char(3) collate utf8_spanish_ci NOT NULL,
  `resolution_hor` int(11) NOT NULL default '0',
  `resolution_ver` int(11) NOT NULL default '0',
  `bitrate` varchar(50) collate utf8_spanish_ci NOT NULL,
  `framerate` int(11) NOT NULL default '25',
  `channels` int(11) NOT NULL default '1',
  `audio` int(11) NOT NULL default '0',
  `bat` varchar(150) collate utf8_spanish_ci NOT NULL,
  `file_cfg` varchar(150) collate utf8_spanish_ci default NULL,
  `dir_out` varchar(150) collate utf8_spanish_ci default NULL,
  `url_out` varchar(150) collate utf8_spanish_ci default NULL,
  `app` varchar(50) collate utf8_spanish_ci NOT NULL,
  `rel_duration_size` DOUBLE default 1,
  `rel_duration_trans` DOUBLE default 1,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` VALUES (1,'wmv',1,1,1,'wmv','wmv9','video/x-ms-asf','wmv',720,576,'957Kbps',25,1,0,'cscript.exe \"C:\\\\Archivos de programa\\\\Windows Media Components\\\\Encoder\\\\WMCmd.vbs\" -input \"%1\" -output \"%2\" -loadprofile \"%3\" -v_preproc 1','/uploads/profiles/wmv.prx','/mnt/vodhosting','mms://videoserver.uvigo.es/VoDhosting/','cscript',1,1),(2,'wma',2,1,0,'wma','wma','audio/x-ms-asf','wma',0,0,'199Kbps',0,1,1,'cscript.exe \"C:\\\\Archivos de programa\\\\Windows Media Components\\\\Encoder\\\\WMCmd.vbs\" -input \"%1\" -output \"%2\" -loadprofile \"%3\" -audioonly','/uploads/profiles/wma.prx','/mnt/vodhosting','mms://videoserver.uvigo.es/VoDhosting/','cscript',1,1),(3,'wmv_ag',3,1,0,'wmv','wmv','video/x-ms-asf','wmv',1024,768,'957Kbps',25,1,0,'cscript.exe \"C:\\\\Archivos de programa\\\\Windows Media Components\\\\Encoder\\\\WMCmd.vbs\" -input \"%1\" -output \"%2\" -loadprofile \"%3\" -v_preproc 1','/uploads/profiles/wmv_ag.prx','/mnt/vodhosting','mms://videoserver.uvigo.es/VoDhosting/','cscript',1,1),(4,'wmv_HD',4,1,0,'wmv','wmv','video/x-ms-asf','wmv',720,406,'957Kbps',0,1,0,'cscript.exe \"C:\\\\Archivos de programa\\\\Windows Media Components\\\\Encoder\\\\WMCmd.vbs\" -input \"%1\" -output \"%2\" -loadprofile \"%3\" -v_preproc 1','/uploads/profiles/wmv_16_9.prx','/mnt/vodhosting','mms://videoserver.uvigo.es/VoDhosting/','cscript',1,1),(5,'wmv_16_9',5,1,0,'wmv','wmv','video/x-ms-asf','wmv',720,406,'957Kbps',25,1,0,'cscript.exe \"C:\\\\Archivos de programa\\\\Windows Media Components\\\\Encoder\\\\WMCmd.vbs\" -input \"%1\" -output \"%2\" -loadprofile \"%3\" -v_preproc 1','/uploads/profiles/wmv_16_9.prx','/mnt/vodhosting','mms://videoserver.uvigo.es/VoDhosting/','cscript',1,1),(6,'mpeg4',6,0,0,'avi','mpeg4','??????????','avi',720,576,'?????????????',25,1,0,'\"C:\\\\Archivos de programa\\\\VirtualDub\\\\vdub.exe\" /i %3 %1 %2','/uploads/profiles/mpeg4.script','/mnt/vodhosting',NULL,'vdub',1,1),(7,'raw',7,0,0,'??','??','??','???',0,0,'??',0,1,0,'copy \"%1\" \"%2\"','??','/mnt/vodhosting',NULL,'copy',1,1),(8,'wmv_old',8,1,0,'wmv','wmv','video/x-ms-asf','wmv',0,0,'??',0,1,0,'cscript.exe \"C:\\\\Archivos de programa\\\\Windows Media Components\\\\Encoder\\\\WMCmd.vbs\" -input \"%1\" -output \"%2\" -v_preproc 1','??','/mnt/vodhosting','mms://videoserver.uvigo.es/VoDhosting/','cscript',1,1),(9,'flv',9,0,0,'flv','flv','video/x-flv','flv',720,576,'??',0,1,0,'c:\\\\ffmpeg\\\\ffmpeg.exe -i \"%1\" -ab 48  -ar 22050 -s 720x576 -f flv \"%2\"',NULL,'/mnt/vodhosting',NULL,'ffmpeg',1,1);
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil_i18n`
--

DROP TABLE IF EXISTS `perfil_i18n`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `perfil_i18n` (
  `description` varchar(200) collate utf8_spanish_ci NOT NULL,
  `id` int(11) NOT NULL,
  `culture` varchar(7) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`,`culture`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `perfil_i18n`
--

LOCK TABLES `perfil_i18n` WRITE;
/*!40000 ALTER TABLE `perfil_i18n` DISABLE KEYS */;
INSERT INTO `perfil_i18n` VALUES ('Perfil de video por defecto con tres calidades de la Universidad de Vigo',1,'es'),('Perfil de audio por defecto con tres calidades de la Universidad de Vigo',2,'es'),('Perfil de audio por defecto con tres calidades de la Universidad de Vigo',3,'es'),('Perfil de audio por defecto con tres calidades de la Universidad de Vigo',4,'es'),('Perfil de audio por defecto con tres calidades de la Universidad de Vigo',5,'es'),('Perfil de audio por defecto con tres calidades de la Universidad de Vigo',6,'es'),('Perfil de audio por defecto con tres calidades de la Universidad de Vigo',7,'es'),('Perfil de video antiguo',8,'es'),('Perfil Flash',9,'es');
/*!40000 ALTER TABLE `perfil_i18n` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relation_ground`
--

DROP TABLE IF EXISTS `relation_ground`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `relation_ground` (
  `one_id` int(11) NOT NULL,
  `two_id` int(11) NOT NULL,
  PRIMARY KEY  (`one_id`,`two_id`),
  KEY `relation_ground_FI_2` (`two_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `relation_ground`
--

LOCK TABLES `relation_ground` WRITE;
/*!40000 ALTER TABLE `relation_ground` DISABLE KEYS */;
INSERT INTO `relation_ground` VALUES (1,31),(2,31),(3,31),(4,29),(5,29),(6,28),(7,29),(8,29),(9,28),(10,31),(11,30),(12,30),(13,30),(14,30),(15,32),(16,30),(17,32),(18,32),(19,30),(20,28),(21,32),(22,30),(23,32),(24,32),(28,6),(28,9),(28,20),(29,4),(29,5),(29,7),(29,8),(30,11),(30,12),(30,13),(30,14),(30,16),(30,19),(30,22),(31,1),(31,2),(31,3),(31,10),(32,15),(32,17),(32,18),(32,21),(32,23),(32,24);
/*!40000 ALTER TABLE `relation_ground` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `role` (
  `id` int(11) NOT NULL auto_increment,
  `cod` char(5) collate utf8_spanish_ci NOT NULL,
  `rank` int(11) NOT NULL default '0',
  `xml` char(25) collate utf8_spanish_ci NOT NULL,
  `display` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `role_cod_unique` (`cod`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'actor',1,'actor',1), (2,'org',2,'organizador',0), (3,'postp',3,'postpro',0), (4,'rea',4,'realizador',0), (5,'pub',5,'Publicador',0), (6,'pre',6,'presentador',1);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_i18n`
--

DROP TABLE IF EXISTS `role_i18n`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `role_i18n` (
  `name` varchar(25) collate utf8_spanish_ci NOT NULL,
  `text` varchar(25) collate utf8_spanish_ci NOT NULL,
  `id` int(11) NOT NULL,
  `culture` varchar(7) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`,`culture`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `role_i18n`
--

LOCK TABLES `role_i18n` WRITE;
/*!40000 ALTER TABLE `role_i18n` DISABLE KEYS */;
INSERT INTO `role_i18n` VALUES ('Actor','',1,'gl'),('Actor','',1,'es'),('Actor','',1,'en'),('Organizador','',2,'gl'),('Organizador','',2,'es'),('Organizador','',2,'en'),('Postproducion','',3,'gl'),('Postproducion','',3,'es'),('Postproducter','',3,'en'),('Realizador','',4,'gl'),('Realizador','',4,'es'),('Realizator','',4,'en'),('Publicador','',5,'gl'),('Publicador','',5,'es'),('Publicador','',5,'en'),('Presentador','Presenta: ',6,'gl'),('Presentador','Presenta: ',6,'es'),('Presentador','Presenta: ',6,'en');
/*!40000 ALTER TABLE `role_i18n` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `template`
--

DROP TABLE IF EXISTS `template`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `template` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) collate utf8_spanish_ci NOT NULL,
  `type` char(3) collate utf8_spanish_ci NOT NULL,
  `user` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `template`
--

LOCK TABLES `template` WRITE;
/*!40000 ALTER TABLE `template` DISABLE KEYS */;
INSERT INTO `template` VALUES (1,'error404','2',0),(2,'header','3',0),(3,'footer','3',0),(4,'servicio','3',1),(5,'Info','2',1),(6,'FAQ','2',1),(7,'Lista','2',1),(8,'layout','1',0),(9,'style','1',0),(10,'email_HTML','4',0),(11,'email_TXT','4',0);
/*!40000 ALTER TABLE `template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template_i18n`
--

DROP TABLE IF EXISTS `template_i18n`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `template_i18n` (
  `description` varchar(255) collate utf8_spanish_ci NOT NULL,
  `text` text collate utf8_spanish_ci,
  `id` int(11) NOT NULL,
  `culture` varchar(7) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`,`culture`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `template_i18n`
--

LOCK TABLES `template_i18n` WRITE;
/*!40000 ALTER TABLE `template_i18n` DISABLE KEYS */;
INSERT INTO `template_i18n` VALUES ('error404','<h1>error404</h1>',1,'gl'),('error404','<h1>error404</h1>',1,'es'),('error404','<h1>error404</h1>',1,'en'),('Template para  header','0',2,'gl'),('Template para  header','0',2,'es'),('Template para  header','0',2,'en'),('Template para  footer','0',3,'gl'),('Template para  footer','0',3,'es'),('Template para  footer','0',3,'en'),('Template para  servicio','1',4,'gl'),('Template para  servicio','1',4,'es'),('Template para  servicio','1',4,'en'),('Template para  info','1',5,'gl'),('Template para  info','1',5,'es'),('Template para  info','1',5,'en'),('Template para  faq','1',6,'gl'),('Template para  faq','1',6,'es'),('Template para  faq','1',6,'en'),('Template para  lista','1',7,'gl'),('Template para  lista','1',7,'es'),('Template para  lista','1',7,'en'),('Template para email_HTML','1',10,'gl'),('Template para email_HTML','1',10,'es'),('Template para email_HTML','1',10,'en'),('Template para email_TXT','1',11,'gl'),('Template para email_TXT','1',11,'es'),('Template para email_TXT','1',11,'en'),('Template para  layout','/*LAYOUT CSS*/\nbody{\n  font-family: \"Trebuchet MS\";\n  font-size: 11px;\n  font-style: normal;\n  line-height: normal;\n  font-weight: normal;\n  font-variant: normal;\n  text-transform: none;\n  color: #333333;\n  text-decoration: none;\n}\n\nbody #content{\n  width: 740px;\n  margin: 0px auto;\n}\n\nbody #body{\n  margin-top: 10px;\n  margin-bottom: 10px;\n}\n\nbody #slidebar, #indexbar_left{\n  float: left;\n  width: 21%;\n}\n\nbody #indexbar_right{\n  float: right;\n  width: 21%;\n}\n\nbody #index_body{\n  margin: 0px 23% 0px 23%;\n}\n\nbody #other_body{\n  margin: 0px 0px 0px 23%;\n}\n\ndiv.widget_Slidebar, div.widget_IndexbarRight, div.widget_IndexbarLeft{\n  width: 100%;\n  margin-bottom: 1em;\n  float: left;\n  font-size: 13px;\n  text-align: center;\n}\n\ndiv.index_widget{\n        margin: 1em 0em;\n}',8,'css'),('Template para  style','1',9,'css');
/*!40000 ALTER TABLE `template_i18n` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transcoding`
--

DROP TABLE IF EXISTS `transcoding`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `transcoding` (
  `id` int(11) NOT NULL auto_increment,
  `mm_id` int(11) NOT NULL,
  `language_id` int(11) default NULL,
  `perfil_id` int(11) default NULL,
  `cpu_id` int(11) default NULL,
  `url` varchar(250) collate utf8_spanish_ci NOT NULL,
  `status_id` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `name` varchar(150) collate utf8_spanish_ci NOT NULL,
  `timeini` datetime NOT NULL,
  `timestart` datetime NOT NULL,
  `timeend` datetime NOT NULL,
  `pid` int(11) default NULL,
  `path_ini` varchar(250) collate utf8_spanish_ci NOT NULL,
  `path_end` varchar(250) collate utf8_spanish_ci NOT NULL,
  `ext_ini` char(3) collate utf8_spanish_ci NOT NULL,
  `ext_end` char(3) collate utf8_spanish_ci NOT NULL,
  `duration` int(11) NOT NULL default '0',
  `size` int(11) NOT NULL default '0',
  `email` varchar(30) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `transcoding_FI_1` (`mm_id`),
  KEY `transcoding_FI_2` (`language_id`),
  KEY `transcoding_FI_3` (`perfil_id`),
  KEY `transcoding_FI_4` (`cpu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `transcoding`
--

LOCK TABLES `transcoding` WRITE;
/*!40000 ALTER TABLE `transcoding` DISABLE KEYS */;
/*!40000 ALTER TABLE `transcoding` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transcoding_i18n`
--

DROP TABLE IF EXISTS `transcoding_i18n`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `transcoding_i18n` (
  `Description` varchar(200) collate utf8_spanish_ci NOT NULL,
  `id` int(11) NOT NULL,
  `culture` varchar(7) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`,`culture`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `transcoding_i18n`
--

LOCK TABLES `transcoding_i18n` WRITE;
/*!40000 ALTER TABLE `transcoding_i18n` DISABLE KEYS */;
/*!40000 ALTER TABLE `transcoding_i18n` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `widget`
--

DROP TABLE IF EXISTS `widget`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `widget` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(25) collate utf8_spanish_ci NOT NULL,
  `widget_type_id` int(11) default NULL,
  `configurable` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `widget_FI_1` (`widget_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `widget`
--

LOCK TABLES `widget` WRITE;
/*!40000 ALTER TABLE `widget` DISABLE KEYS */;
INSERT INTO `widget` VALUES (1,'header',2,1),(2,'subheader',2,0),(3,'footer',2,1),(4,'idioma',1,0),(5,'noidioma',1,0),(6,'menu',1,0),(7,'contacto',1,1),(8,'total',1,0),(9,'proximas',1,1),(10,'software',1,1),(11,'buscar',1,0),(12,'google',1,0),(13,'rss',1,0),(14,'masvistostotal',1,1),(15,'masvistosmes',1,1),(16,'masvistossemana',1,1),(17,'masvistosdia',1,1),(18,'masvistostotalfalso',1,1),(19,'masvistosmesfalso',1,1),(20,'listacorreo',1,0),(21,'infowebtv',3,1),(22,'announces',3,1),(23,'lastvistos',3,1),(24,'news',3,1),(25,'timeline',3,0),(26,'auth',1,0);
/*!40000 ALTER TABLE `widget` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `widget_constant`
--

DROP TABLE IF EXISTS `widget_constant`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `widget_constant` (
  `id` int(11) NOT NULL auto_increment,
  `widget_id` int(11) default NULL,
  `name` varchar(25) collate utf8_spanish_ci default NULL,
  `text` varchar(255) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `widget_constant_name_unique` (`name`),
  KEY `widget_constant_FI_1` (`widget_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `widget_constant`
--

LOCK TABLES `widget_constant` WRITE;
/*!40000 ALTER TABLE `widget_constant` DISABLE KEYS */;
INSERT INTO `widget_constant` VALUES (1,18,'T1.','1'),(2,18,'T2.','2'),(3,18,'T3.','3'),(4,19,'M1.','1'),(5,19,'M2.','2'),(6,19,'M3.','3');
/*!40000 ALTER TABLE `widget_constant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widget_i18n`
--

DROP TABLE IF EXISTS `widget_i18n`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `widget_i18n` (
  `description` varchar(255) collate utf8_spanish_ci NOT NULL,
  `id` int(11) NOT NULL,
  `culture` varchar(7) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`,`culture`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `widget_i18n`
--

LOCK TABLES `widget_i18n` WRITE;
/*!40000 ALTER TABLE `widget_i18n` DISABLE KEYS */;
INSERT INTO `widget_i18n` VALUES ('Widget genera la cabecera de la pagina',1,'gl'),('Widget que muesta informacion sobre la seccion activa',2,'gl'),('Widget genera el pie de la pagina',3,'gl'),('Widget que permite la modificacion del idioma del usuario',4,'gl'),('Widget de las mismas dimensiones que idioma, pero vacio. Usado para buscar simetria',5,'gl'),('Widget que proporciona el menu de portal WebTv',6,'gl'),('Widget que proporciona informacion sobre el portal WebTv',7,'gl'),('Widget que proporciona informacion sobre el numero de series, videos y horas grabadas',8,'gl'),('Widget configurable a taves de info, que informa de los proximos videos',9,'gl'),('Widget que lista el software aconsejado para reproducir los videos',10,'gl'),('Widget que crea un formulario para facilitar la busqueda de videos',11,'gl'),('Widget que crea un formulario para facilitar la busqueda de videos en Google',12,'gl'),('Widget que crea un formulario para autentificarse',26,'gl'),('Widget para aceder al feed arca',13,'gl'),('Widget que lista los videos mas vistos del portal WebTv',14,'gl'),('Widget que lista los videos mas vistos del portal WebTv durante los ultimos 30 dias',15,'gl'),('Widget que lista los videos mas vistos del portal WebTv durante los ultimos 7 dias',16,'gl'),('Widget que lista los videos mas vistos del portal WebTv del ultimo dia',17,'gl'),('Widget que lista los videos mas vistos del portal WebTv en un acordeon, al estilo apple',18,'gl'),('Widget que lista los videos mas vistos del portal WebTv, configurable por el usuario',19,'gl'),('Widget que proporciona acceso al formulario para entrar en la lista de correo',20,'gl'),('Mustra informacion del portal WebTv configurable a traves de info',21,'gl'),('Muestra los ultimos  anuncios del portal',22,'gl'),('Muestra los ultimos videos reproducidos del portal',23,'gl'),('Muestra la ultimas noticias que hay',24,'gl'),('Widget que proporciona una estadistica temporal sobre la fecha de grabacion de las series',25,'gl'),('Widget genera la cabecera de la pagina',1,'es'),('Widget que muesta informacion sobre la seccion activa',2,'es'),('Widget genera el pie de la pagina',3,'es'),('Widget que permite la modificacion del idioma del usuario',4,'es'),('Widget de las mismas dimensiones que idioma, pero vacio. Usado para buscar simetria',5,'es'),('Widget que proporciona el menu de portal WebTv',6,'es'),('Widget que proporciona informacion sobre el portal WebTv',7,'es'),('Widget que proporciona informacion sobre el numero de series, videos y horas grabadas',8,'es'),('Widget configurable a taves de info, que informa de los proximos videos',9,'es'),('Widget que lista el software aconsejado para reproducir los videos',10,'es'),('Widget que crea un formulario para facilitar la busqueda de videos',11,'es'),('Widget que crea un formulario para facilitar la busqueda de videos en Gooese',12,'es'),('Widget que crea un formulario para autentificarse',26,'es'),('Widget para aceder al feed arca',13,'es'),('Widget que lista los videos mas vistos del portal WebTv',14,'es'),('Widget que lista los videos mas vistos del portal WebTv durante los ultimos 30 dias',15,'es'),('Widget que lista los videos mas vistos del portal WebTv durante los ultimos 7 dias',16,'es'),('Widget que lista los videos mas vistos del portal WebTv del ultimo dia',17,'es'),('Widget que lista los videos mas vistos del portal WebTv en un acordeon, al estilo apple',18,'es'),('Widget que lista los videos mas vistos del portal WebTv, configurable por el usuario',19,'es'),('Widget que proporciona acceso al formulario para entrar en la lista de correo',20,'es'),('Mustra informacion del portal WebTv configurable a traves de info',21,'es'),('Muestra los ultimos  anuncios del portal',22,'es'),('Muestra los ultimos videos reproducidos del portal',23,'es'),('Muestra la ultimas noticias que hay',24,'es'),('Widget que proporciona una estadistica temporal sobre la fecha de grabacion de las series',25,'es'),('Widget genera la cabecera de la pagina',1,'en'),('Widget que muesta informacion sobre la seccion activa',2,'en'),('Widget genera el pie de la pagina',3,'en'),('Widget que permite la modificacion del idioma del usuario',4,'en'),('Widget de las mismas dimensiones que idioma, pero vacio. Usado para buscar simetria',5,'en'),('Widget que proporciona el menu de portal WebTv',6,'en'),('Widget que proporciona informacion sobre el portal WebTv',7,'en'),('Widget que proporciona informacion sobre el numero de series, videos y horas grabadas',8,'en'),('Widget configurable a taves de info, que informa de los proximos videos',9,'en'),('Widget que lista el software aconsejado para reproducir los videos',10,'en'),('Widget que crea un formulario para facilitar la busqueda de videos',11,'en'),('Widget que crea un formulario para facilitar la busqueda de videos en Google',12,'en'),('Widget que crea un formulario para autentificarse',26,'en'),('Widget para aceder al feed arca',13,'en'),('Widget que lista los videos mas vistos del portal WebTv',14,'en'),('Widget que lista los videos mas vistos del portal WebTv durante los ultimos 30 dias',15,'en'),('Widget que lista los videos mas vistos del portal WebTv durante los ultimos 7 dias',16,'en'),('Widget que lista los videos mas vistos del portal WebTv del ultimo dia',17,'en'),('Widget que lista los videos mas vistos del portal WebTv en un acordeon, al estilo apple',18,'en'),('Widget que lista los videos mas vistos del portal WebTv, configurable por el usuario',19,'en'),('Widget que proporciona acceso al formulario para entrar en la lista de correo',20,'en'),('Mustra informacion del portal WebTv configurable a traves de info',21,'en'),('Muestra los ultimos  anuncios del portal',22,'en'),('Muestra los ultimos videos reproducidos del portal',23,'en'),('Muestra la ultimas noticias que hay',24,'en'),('Widget que proporciona una estadistica temporal sobre la fecha de grabacion de las series',25,'en');
/*!40000 ALTER TABLE `widget_i18n` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widget_template`
--

DROP TABLE IF EXISTS `widget_template`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `widget_template` (
  `id` int(11) NOT NULL auto_increment,
  `widget_id` int(11) default NULL,
  `name` varchar(25) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `widget_template_name_unique` (`name`),
  KEY `widget_template_FI_1` (`widget_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `widget_template`
--

LOCK TABLES `widget_template` WRITE;
/*!40000 ALTER TABLE `widget_template` DISABLE KEYS */;
INSERT INTO `widget_template` VALUES (1,1,'header'),(2,3,'footer'),(3,21,'infowebtv'),(4,9,'proximas');
/*!40000 ALTER TABLE `widget_template` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widget_template_i18n`
--

DROP TABLE IF EXISTS `widget_template_i18n`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `widget_template_i18n` (
  `text` text collate utf8_spanish_ci,
  `id` int(11) NOT NULL,
  `culture` varchar(7) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`,`culture`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `widget_template_i18n`
--

LOCK TABLES `widget_template_i18n` WRITE;
/*!40000 ALTER TABLE `widget_template_i18n` DISABLE KEYS */;
INSERT INTO `widget_template_i18n` VALUES ('<h1 class=\"default\">Inserte aqui HTML de su cabecera</h1>',1,'gl'),('<h1 class=\"default\">Inserte aqui HTML de su cabecera</h1>',1,'es'),('<h1 class=\"default\">Inserte aqui HTML de su cabecera</h1>',1,'en'),('<h1 class=\"default\">Inserte aqui HTML de su pie</h1>',2,'gl'),('<h1 class=\"default\">Inserte aqui HTML de su pie</h1>',2,'es'),('<h1 class=\"default\">Inserte aqui HTML de su pie</h1>',2,'en'),('<h2>info portal webtv</h2>\nPuMuKIT (PUblicador MUltimedia en KIT) permite publicar vía Internet los contenidos audiovisuales\nproducidos en una Institución, Universidad, etc..  PuMuKIT publica los contenidos multimedia\nalmacenados en su base de datos de dos modos diferentes: Generando un portal WEB, una WEB-TV y\ncreando flujos RSS compatibles ARCA.',3,'gl'),('<h2>info portal webtv</h2>\nPuMuKIT (PUblicador MUltimedia en KIT) permite publicar vía Internet los contenidos audiovisuales\nproducidos en una Institución, Universidad, etc..  PuMuKIT publica los contenidos multimedia\nalmacenados en su base de datos de dos modos diferentes: Generando un portal WEB, una WEB-TV y\ncreando flujos RSS compatibles ARCA.',3,'es'),('<h2>info portal webtv</h2>\nPuMuKIT (PUblicador MUltimedia en KIT) permite publicar vía Internet los contenidos audiovisuales\nproducidos en una Institución, Universidad, etc..  PuMuKIT publica los contenidos multimedia\nalmacenados en su base de datos de dos modos diferentes: Generando un portal WEB, una WEB-TV y\ncreando flujos RSS compatibles ARCA.',3,'en'),('proximas',4,'gl'),('proximas',4,'es'),('proximas',4,'en');
/*!40000 ALTER TABLE `widget_template_i18n` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `broadcast`
--

DROP TABLE IF EXISTS `broadcast`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `broadcast` (
  `id` int(11) NOT NULL auto_increment,
  `name` char(100) collate utf8_spanish_ci NOT NULL,
  `broadcast_type_id` int(11) default NULL,
  `passwd` char(8) collate utf8_spanish_ci NOT NULL,
  `default_sel` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `broadcast_FI_1` (`broadcast_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `broadcast`
--

LOCK TABLES `broadcast` WRITE;
/*!40000 ALTER TABLE `broadcast` DISABLE KEYS */;
INSERT INTO `broadcast` VALUES (1,'pub',1,'',1),(2,'pri',2,'',0);
/*!40000 ALTER TABLE `broadcast` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `broadcast_i18n`
--

DROP TABLE IF EXISTS `broadcast_i18n`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `broadcast_i18n` (
  `description` text collate utf8_spanish_ci,
  `id` int(11) NOT NULL,
  `culture` varchar(7) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`,`culture`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `broadcast_i18n`
--

LOCK TABLES `broadcast_i18n` WRITE;
/*!40000 ALTER TABLE `broadcast_i18n` DISABLE KEYS */;
INSERT INTO `broadcast_i18n` VALUES ('Público',1,'gl'),('Público',1,'es'),('Public',1,'en'),('Privado',2,'gl'),('Privado',2,'es'),('Private',2,'en');
/*!40000 ALTER TABLE `broadcast_i18n` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widget_type`
--

DROP TABLE IF EXISTS `widget_type`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `widget_type` (
  `id` int(11) NOT NULL auto_increment,
  `type` varchar(25) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `widget_type`
--

LOCK TABLES `widget_type` WRITE;
/*!40000 ALTER TABLE `widget_type` DISABLE KEYS */;
INSERT INTO `widget_type` VALUES (1,'lateral'),(2,'banner'),(3,'index');
/*!40000 ALTER TABLE `widget_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2008-07-03  9:13:59


--------------------------------------------------------------
------     CAMBIOS VACIOS
--------------------------------------------------------------

--
-- PIC_ALGO
--
ALTER TABLE pic_person CHANGE sort `rank` INTEGER default 1 NOT NULL;
ALTER TABLE pic_serial CHANGE sort `rank` INTEGER default 1 NOT NULL;
ALTER TABLE pic_mm CHANGE sort `rank` INTEGER default 1 NOT NULL;
ALTER TABLE pic_person CHANGE person_id `other_id` INTEGER  NOT NULL;
ALTER TABLE pic_serial CHANGE serial_id`other_id` INTEGER  NOT NULL;
ALTER TABLE pic_mm CHANGE video_id`other_id` INTEGER  NOT NULL;
ALTER TABLE pic_person DROP PRIMARY KEY;
ALTER TABLE pic_serial DROP PRIMARY KEY;
ALTER TABLE pic_mm DROP PRIMARY KEY;
ALTER TABLE pic_person DROP KEY `pic_person_FI_2`;
ALTER TABLE pic_serial DROP KEY `pic_serial_FI_2`;
ALTER TABLE pic_mm DROP KEY  `pic_video_FI_2`;
ALTER TABLE pic_serial ADD PRIMARY KEY (`pic_id`,`other_id`);
ALTER TABLE pic_serial ADD CONSTRAINT `pic_serial_FK_1` FOREIGN KEY (`pic_id`) REFERENCES `pic` (`id`);
ALTER TABLE pic_serial ADD INDEX `pic_serial_FI_2` (`other_id`);
ALTER TABLE pic_serial ADD CONSTRAINT `pic_serial_FK_2` FOREIGN KEY (`other_id`) REFERENCES `serial` (`id`);
ALTER TABLE pic_mm ADD PRIMARY KEY (`pic_id`,`other_id`);
ALTER TABLE pic_mm ADD CONSTRAINT `pic_mm_FK_1` FOREIGN KEY (`pic_id`) REFERENCES `pic` (`id`);
ALTER TABLE pic_mm ADD INDEX `pic_mm_FI_2` (`other_id`);
ALTER TABLE pic_mm ADD CONSTRAINT `pic_mm_FK_2` FOREIGN KEY (`other_id`) REFERENCES `mm` (`id`);
ALTER TABLE pic_person ADD PRIMARY KEY (`pic_id`,`other_id`);
ALTER TABLE pic_person ADD CONSTRAINT `pic_person_FK_1` FOREIGN KEY (`pic_id`) REFERENCES `pic` (`id`);
ALTER TABLE pic_person ADD INDEX `pic_person_FI_2` (`other_id`);
ALTER TABLE pic_person ADD CONSTRAINT `pic_person_FK_2` FOREIGN KEY (`other_id`) REFERENCES `person` (`id`);



--
-- USER
--
ALTER TABLE user ADD `email` VARCHAR(30);


--
-- MM
--
ALTER TABLE mm CHANGE sort `rank` INTEGER default 1 NOT NULL;
ALTER TABLE mm ADD `broadcast_id` INTEGER;
ALTER TABLE mm CHANGE recordData `recordDate` DATETIME  NOT NULL;
ALTER TABLE mm CHANGE publicDate `publicDate` DATETIME  NOT NULL;
ALTER TABLE mm CHANGE working `status_id` INTEGER default 0 NOT NULL;
ALTER TABLE mm DROP KEY video_FI_1;
ALTER TABLE mm DROP KEY video_FI_2;
ALTER TABLE mm DROP KEY video_FI_3;
ALTER TABLE mm ADD INDEX `mm_FI_1` (`serial_id`);
ALTER TABLE mm ADD CONSTRAINT `mm_FK_1` FOREIGN KEY (`serial_id`) REFERENCES `serial` (`id`) ON DELETE CASCADE;
ALTER TABLE mm ADD INDEX `mm_FI_2` (`precinct_id`);
ALTER TABLE mm ADD CONSTRAINT `mm_FK_2` FOREIGN KEY (`precinct_id`) REFERENCES `precinct` (`id`);
ALTER TABLE mm ADD INDEX `mm_FI_3` (`genre_id`);
ALTER TABLE mm ADD CONSTRAINT `mm_FK_3` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`);
ALTER TABLE mm ADD INDEX `mm_FI_4` (`broadcast_id`);
ALTER TABLE mm ADD CONSTRAINT `mm_FK_4` FOREIGN KEY (`broadcast_id`) REFERENCES `broadcast` (`id`);

UPDATE mm,serial SET mm.broadcast_id = serial.broadcast_id  WHERE mm.serial_id=serial.id;

--
-- SERIAL
--
ALTER TABLE serial DROP working;
ALTER TABLE serial DROP broadcast_id;
ALTER TABLE serial CHANGE publicDate `publicDate` DATETIME  NOT NULL;
--ALTER TABLE serial DROP KEY `serial_FI_1`;
ALTER TABLE serial DROP KEY `serial_FI_2`;
ALTER TABLE serial DROP KEY `serial_FI_3`;
ALTER TABLE serial ADD INDEX `serial_FI_1` (`serial_type_id`);
ALTER TABLE serial ADD CONSTRAINT `serial_FK_1` FOREIGN KEY (`serial_type_id`) REFERENCES `serial_type` (`id`);
ALTER TABLE serial ADD INDEX `serial_FI_2` (`serial_template_id`);
ALTER TABLE serial ADD CONSTRAINT `serial_FK_2` FOREIGN KEY (`serial_template_id`) REFERENCES `serial_template` (`id`);
ALTER TABLE serial_type_i18n ADD `description` TEXT;


--
-- PERSON
--
ALTER TABLE person_i18n ADD `honorific` VARCHAR(20);


--
-- MM_PERSON
--
ALTER TABLE mm_person CHANGE sort `rank` INTEGER default 1 NOT NULL;
ALTER TABLE mm_person CHANGE video_id `mm_id` INTEGER  NOT NULL;
ALTER TABLE mm_person CHANGE rol_id `role_id` INTEGER default 1 NOT NULL;
ALTER TABLE mm_person DROP PRIMARY KEY;
ALTER TABLE mm_person DROP KEY `video_person_FI_2`;
ALTER TABLE mm_person DROP KEY `video_person_FI_3`;
ALTER TABLE mm_person ADD PRIMARY KEY (`mm_id`,`person_id`,`role_id`);
ALTER TABLE mm_person ADD CONSTRAINT `mm_person_FK_1` FOREIGN KEY (`mm_id`) REFERENCES `mm` (`id`) ON DELETE CASCADE;
ALTER TABLE mm_person ADD INDEX `mm_person_FI_2` (`person_id`);
ALTER TABLE mm_person ADD CONSTRAINT `mm_person_FK_2` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE CASCADE;
ALTER TABLE mm_person ADD INDEX `mm_person_FI_3` (`role_id`);
ALTER TABLE mm_person ADD CONSTRAINT `mm_person_FK_3` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE SET DEFAULT;



--
-- MATERIAL
--
ALTER TABLE material CHANGE video_id `mm_id` INTEGER NOT NULL;
ALTER TABLE material DROP KEY material_FI_1;
ALTER TABLE material DROP KEY material_FI_2;
ALTER TABLE material ADD INDEX `material_FI_1` (`mm_id`);
ALTER TABLE material ADD CONSTRAINT `material_FK_1` FOREIGN KEY (`mm_id`) REFERENCES `mm` (`id`) ON DELETE CASCADE;
ALTER TABLE material ADD INDEX `material_FI_2` (`mat_type_id`);
ALTER TABLE material ADD CONSTRAINT `material_FK_2` FOREIGN KEY (`mat_type_id`) REFERENCES `mat_type` (`id`);
ALTER TABLE material CHANGE sort `rank` INTEGER default 1 NOT NULL;

--
-- MATTYPE
--
ALTER TABLE mat_type ADD  `mime_type` VARCHAR(40)  NOT NULL;

--
-- LINK
--
ALTER TABLE link CHANGE video_id `mm_id` INTEGER NOT NULL;
ALTER TABLE link DROP KEY link_FI_1;
ALTER TABLE link ADD INDEX `link_FI_1` (`mm_id`);
ALTER TABLE link ADD CONSTRAINT `link_FK_1` FOREIGN KEY (`mm_id`) REFERENCES `mm` (`id`) ON DELETE CASCADE;
ALTER TABLE link CHANGE sort `rank` INTEGER default 1 NOT NULL;
ALTER TABLE link_i18n CHANGE title `name` VARCHAR(200) NOT NULL;


--
-- FILE
--

ALTER TABLE file CHANGE video_id `mm_id` INTEGER NOT NULL;
ALTER TABLE file CHANGE sort `rank` INTEGER default 1 NOT NULL;
ALTER TABLE file CHANGE package_id `mime_type_id` INTEGER;
ALTER TABLE file ADD `perfil_id` INTEGER;
ALTER TABLE file ADD `file` VARCHAR(250)  NOT NULL;
ALTER TABLE file ADD `size` INTEGER default 0 NOT NULL;
ALTER TABLE file_i18n CHANGE title `description` VARCHAR(200) NOT NULL;


ALTER TABLE file DROP KEY file_FI_1;
ALTER TABLE file DROP KEY file_FI_2;
ALTER TABLE file DROP KEY file_FI_3;
ALTER TABLE file DROP KEY file_FI_4;
ALTER TABLE file DROP KEY file_FI_5;
ALTER TABLE file DROP KEY file_FI_6;

ALTER TABLE file ADD INDEX `file_FI_1` (`mm_id`);
ALTER TABLE file ADD CONSTRAINT `file_FK_1` FOREIGN KEY (`mm_id`) REFERENCES `mm` (`id`) ON DELETE CASCADE;
ALTER TABLE file ADD INDEX `file_FI_2` (`perfil_id`);
ALTER TABLE file ADD CONSTRAINT `file_FK_2` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`);
ALTER TABLE file ADD INDEX `file_FI_3` (`language_id`);
ALTER TABLE file ADD CONSTRAINT `file_FK_3` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`);
ALTER TABLE file ADD INDEX `file_FI_4` (`format_id`);
ALTER TABLE file ADD CONSTRAINT `file_FK_4` FOREIGN KEY (`format_id`) REFERENCES `format` (`id`);
ALTER TABLE file ADD INDEX `file_FI_5` (`codec_id`);
ALTER TABLE file ADD CONSTRAINT `file_FK_5` FOREIGN KEY (`codec_id`) REFERENCES `codec` (`id`);
ALTER TABLE file ADD INDEX `file_FI_6` (`mime_type_id`);
ALTER TABLE file ADD CONSTRAINT `file_FK_6` FOREIGN KEY (`mime_type_id`) REFERENCES `mime_type` (`id`);
ALTER TABLE file ADD INDEX `file_FI_7` (`resolution_id`);
ALTER TABLE file ADD CONSTRAINT `file_FK_7` FOREIGN KEY (`resolution_id`) REFERENCES `resolution` (`id`);

UPDATE file SET perfil_id = 1;
--
-- I18N
--
ALTER TABLE material_i18n ADD  CONSTRAINT `material_i18n_FK_1` FOREIGN KEY (`id`) REFERENCES `material` (`id`) ON DELETE CASCADE;
ALTER TABLE mat_type_i18n ADD  CONSTRAINT `mat_type_i18n_FK_1` FOREIGN KEY (`id`) REFERENCES `mat_type` (`id`) ON DELETE CASCADE;
ALTER TABLE link_i18n ADD  CONSTRAINT `link_i18n_FK_1` FOREIGN KEY (`id`) REFERENCES `link` (`id`) ON DELETE CASCADE;
ALTER TABLE file_i18n ADD  CONSTRAINT `file_i18n_FK_1` FOREIGN KEY (`id`) REFERENCES `file` (`id`) ON DELETE CASCADE;
ALTER TABLE genre_i18n ADD  CONSTRAINT `genre_i18n_FK_1` FOREIGN KEY (`id`) REFERENCES `genre` (`id`) ON DELETE CASCADE;
ALTER TABLE language_i18n ADD  CONSTRAINT `language_i18n_FK_1` FOREIGN KEY (`id`) REFERENCES `language` (`id`) ON DELETE CASCADE;
ALTER TABLE mm_i18n ADD  CONSTRAINT `mm_i18n_FK_1` FOREIGN KEY (`id`) REFERENCES `mm` (`id`) ON DELETE CASCADE;
ALTER TABLE notice_i18n ADD  CONSTRAINT `notice_i18n_FK_1` FOREIGN KEY (`id`) REFERENCES `notice` (`id`) ON DELETE CASCADE;
ALTER TABLE person_i18n ADD  CONSTRAINT `person_i18n_FK_1` FOREIGN KEY (`id`) REFERENCES `person` (`id`) ON DELETE CASCADE;
ALTER TABLE place_i18n ADD  CONSTRAINT `place_i18n_FK_1` FOREIGN KEY (`id`) REFERENCES `place` (`id`) ON DELETE CASCADE;
ALTER TABLE precinct_i18n ADD  CONSTRAINT `precinct_i18n_FK_1` FOREIGN KEY (`id`) REFERENCES `precinct` (`id`) ON DELETE CASCADE;
ALTER TABLE serial_i18n ADD CONSTRAINT `serial_i18n_FK_1` FOREIGN KEY (`id`) REFERENCES `serial` (`id`) ON DELETE CASCADE;
ALTER TABLE serial_type ADD CONSTRAINT `serial_type_i18n_FK_1` FOREIGN KEY (`id`) REFERENCES `serial_type` (`id`) ON DELETE CASCADE;


--------------------------------------------------------------
------     COMPETO
--------------------------------------------------------------

UPDATE `mat_type` SET mime_type = "applicaion/msword" WHERE type = "doc";
UPDATE `mat_type` SET mime_type = "x-gzip" WHERE type = "gz";
UPDATE `mat_type` SET mime_type = "applicaion/mp3" WHERE type = "mp3";
UPDATE `mat_type` SET mime_type = "application/pdf" WHERE type = "pdf";
UPDATE `mat_type` SET mime_type = "application/vnd.ms-powerpoint" WHERE type = "pps";
UPDATE `mat_type` SET mime_type = "application/vnd.ms-powerpoint" WHERE type = "ppt";
UPDATE `mat_type` SET mime_type = "application/x-compressed" WHERE type = "rar";
UPDATE `mat_type` SET mime_type = "application/x-shockwave-flash" WHERE type = "swf";
UPDATE `mat_type` SET mime_type = "application/x-tar" WHERE type = "tar";
UPDATE `mat_type` SET mime_type = "application/x-compressed" WHERE type = "tgz";
UPDATE `mat_type` SET mime_type = "application/octet-stream" WHERE type = "xxx";
UPDATE `mat_type` SET mime_type = "application/x-compressed" WHERE type = "zip";

UPDATE mm SET status_id = 3 WHERE status_id = 0;
UPDATE mm SET status_id = 0 WHERE status_id = 1;



ALTER TABLE ground_video CHANGE sort `rank` INTEGER default 1 NOT NULL;
ALTER TABLE ground_video CHANGE video_id `mm_id` INTEGER  NOT NULL;
ALTER TABLE ground_video DROP PRIMARY KEY;
ALTER TABLE ground_video DROP KEY `ground_video_FI_2`;
ALTER TABLE ground_video ADD PRIMARY KEY (`ground_id`,`mm_id`);
ALTER TABLE ground_video ADD CONSTRAINT `ground_mm_FK_1` FOREIGN KEY (`ground_id`) REFERENCES `ground` (`id`) ON DELETE CASCADE;
ALTER TABLE ground_video ADD INDEX `ground_mm_FI_2` (`mm_id`);
ALTER TABLE ground_video ADD CONSTRAINT `ground_mm_FK_2` FOREIGN KEY (`mm_id`) REFERENCES `mm` (`id`) ON DELETE CASCADE;
DROP TABLE IF EXISTS ground_mm;
ALTER TABLE ground_video RENAME ground_mm;
