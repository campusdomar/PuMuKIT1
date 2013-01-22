---------------
--
--  VER http://sentidoweb.com/2008/06/18/script-php-para-sincronizar-estructuras-de-bd-mysql.php
--
--------------




DROP TABLE IF EXISTS `bar_body`;
DROP TABLE IF EXISTS `bar_index_l`;
DROP TABLE IF EXISTS `bar_index_r`;
DROP TABLE IF EXISTS `body_index`;
DROP TABLE IF EXISTS `info`;
DROP TABLE IF EXISTS `info_i18n`;
DROP TABLE IF EXISTS `widget`;
DROP TABLE IF EXISTS `widget_index`;

----

DROP TABLE IF EXISTS `broadcast_type`;
CREATE TABLE `broadcast_type` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(15) collate utf8_spanish_ci default NULL,
  `default_sel` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

LOCK TABLES `broadcast_type` WRITE;
/*!40000 ALTER TABLE `broadcast_type` DISABLE KEYS */;
INSERT INTO `broadcast_type` VALUES (1,'pub',1),(2,'pri',0),(3,'cor',0);
/*!40000 ALTER TABLE `broadcast_type` ENABLE KEYS */;
UNLOCK TABLES;


--
ALTER TABLE `user` ADD `email` VARCHAR(30);
--


ALTER TABLE `broadcast` ADD `broadcast_type_id` int(11) default NULL, ADD KEY `broadcast_FI_1` (`broadcast_type_id`);
UPDATE `broadcast` SET broadcast_type_id = 1 where name = 'pub';
UPDATE `broadcast` SET broadcast_type_id = 3 where name = 'pri';



--

DROP TABLE IF EXISTS mime_type;
ALTER TABLE package RENAME mime_type;
ALTER TABLE mat_type ADD `mime_type` VARCHAR(40)  NOT NULL;
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


--


DROP TABLE IF EXISTS `direct`;
DROP TABLE IF EXISTS `direct_i18n`;

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

DROP TABLE IF EXISTS `direct_i18n`;
CREATE TABLE `direct_i18n` (
  `name` varchar(100) collate utf8_spanish_ci NOT NULL,
  `description` text collate utf8_spanish_ci,
  `event` varchar(100) collate utf8_spanish_ci NOT NULL,
  `id` int(11) NOT NULL,
  `culture` varchar(7) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`,`culture`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;


--


ALTER TABLE file CHANGE video_id `mm_id` int(11) NOT NULL;
ALTER TABLE file DROP KEY file_FI_1;
ALTER TABLE file ADD KEY `file_FI_1` (`mm_id`);

ALTER TABLE file CHANGE package_id `mime_type_id` int(11) default NULL;
ALTER TABLE file DROP KEY `file_FI_5`;
ALTER TABLE file ADD KEY `file_FI_5` (`mime_type_id`);

ALTER TABLE file CHANGE `sort` `rank` int(11) NOT NULL default '1';
ALTER TABLE file ADD `size` int(11) NOT NULL default '0';

ALTER TABLE file_i18n CHANGE `title` `description` varchar(200) collate utf8_spanish_ci NOT NULL;


--

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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` VALUES (1,'wmv',1,1,'wmv','wmv9','video/x-ms-asf','wmv',720,576,'957Kbps',25,1,0,'cscript.exe \"C:\\\\Archivos de programa\\\\Windows Media Components\\\\Encoder\\\\WMCmd.vbs\" -input \"%1\" -output \"%2\" -loadprofile \"%3\" -v_preproc 1','/uploads/profiles/wmv.prx','/mnt/wmpub/VoDhosting/','mms://videoserver.uvigo.es/VoDhosting/','cscript'),(2,'wma',2,1,'wma','wma','audio/x-ms-asf','wma',0,0,'199Kbps',0,1,1,'cscript.exe \"C:\\\\Archivos de programa\\\\Windows Media Components\\\\Encoder\\\\WMCmd.vbs\" -input \"%1\" -output \"%2\" -loadprofile \"%3\" -audioonly','/uploads/profiles/wma.prx','/mnt/wmpub/VoDhosting/','mms://videoserver.uvigo.es/VoDhosting/','cscript'),(3,'wmv_ag',3,1,'wmv','wmv','video/x-ms-asf','wmv',1024,768,'957Kbps',25,1,0,'cscript.exe \"C:\\\\Archivos de programa\\\\Windows Media Components\\\\Encoder\\\\WMCmd.vbs\" -input \"%1\" -output \"%2\" -loadprofile \"%3\" -v_preproc 1','/uploads/profiles/wmv_ag.prx','/mnt/wmpub/VoDhosting/','mms://videoserver.uvigo.es/VoDhosting/','cscript'),(4,'wmv_HD',4,1,'wmv','wmv','video/x-ms-asf','wmv',720,406,'957Kbps',0,1,0,'cscript.exe \"C:\\\\Archivos de programa\\\\Windows Media Components\\\\Encoder\\\\WMCmd.vbs\" -input \"%1\" -output \"%2\" -loadprofile \"%3\" -v_preproc 1','/uploads/profiles/wmv_16_9.prx','/mnt/wmpub/VoDhosting/','mms://videoserver.uvigo.es/VoDhosting/','cscript'),(5,'wmv_16_9',5,1,'wmv','wmv','video/x-ms-asf','wmv',720,406,'957Kbps',25,1,0,'cscript.exe \"C:\\\\Archivos de programa\\\\Windows Media Components\\\\Encoder\\\\WMCmd.vbs\" -input \"%1\" -output \"%2\" -loadprofile \"%3\" -v_preproc 1','/uploads/profiles/wmv_16_9.prx','/mnt/wmpub/VoDhosting/','mms://videoserver.uvigo.es/VoDhosting/','cscript'),(6,'mpeg4',6,0,'avi','mpeg4','??????????','avi',720,576,'?????????????',25,1,0,'\"C:\\\\Archivos de programa\\\\VirtualDub\\\\vdub.exe\" /i \"%3\" \"%1\" \"%2\"','/uploads/profiles/mpeg4.script','/mnt/wmpub/VoDhosting/',NULL,'vdub'),(7,'raw',7,0,'??','??','??','???',0,0,'??',0,1,0,'copy \"%1\" \"%2\"','??','/mnt/wmpub/VoDhosting/',NULL,'copy'),(8,'wmv_old',8,1,'wmv','wmv','video/x-ms-asf','wmv',0,0,'??',0,1,0,'cscript.exe \"C:\\\\Archivos de programa\\\\Windows Media Components\\\\Encoder\\\\WMCmd.vbs\" -input \"%1\" -output \"%2\" -v_preproc 1','??','/mnt/wmpub/VoDhosting/','mms://videoserver.uvigo.es/VoDhosting/','cscript'),(9,'flv',9,0,'flv','flv','video/x-flv','flv',720,576,'??',0,1,0,'c:\\\\ffmpeg\\\\ffmpeg.exe -i \"%1\" -ab 48  -ar 22050 -s 720x576 -f flv \"%2\"',NULL,'/mnt/wmpub/VoDhosting/',NULL,'ffmpeg');
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

ALTER TABLE file ADD `perfil_id` int(11) default 8;
ALTER TABLE file ADD `file` varchar(250)  NOT NULL;
ALTER TABLE file ADD KEY `file_FI_7` (`perfil_id`);

--
ALTER TABLE link CHANGE video_id `mm_id` int(11) NOT NULL;
ALTER TABLE link DROP KEY link_FI_1;
ALTER TABLE link ADD KEY `link_FI_1` (`mm_id`);

ALTER TABLE link CHANGE `sort` `rank` int(11) NOT NULL default '1';

ALTER TABLE link_i18n CHANGE `title` `name` varchar(200) collate utf8_spanish_ci NOT NULL;


--


ALTER TABLE material CHANGE video_id `mm_id` int(11) NOT NULL;
ALTER TABLE material DROP KEY material_FI_1;
ALTER TABLE material ADD KEY `material_FI_1` (`mm_id`);

ALTER TABLE material CHANGE `sort` `rank` int(11) NOT NULL default '1';


--


ALTER TABLE serial_type_i18n ADD `description` text collate utf8_spanish_ci;


--

DROP TABLE IF EXISTS ground_mm;
ALTER TABLE ground_video RENAME ground_mm;

ALTER TABLE ground_mm CHANGE video_id `mm_id` int(11) NOT NULL;
ALTER TABLE ground_mm DROP KEY ground_video_FI_2;
ALTER TABLE ground_mm ADD KEY `ground_mm_FI_2` (`mm_id`);

ALTER TABLE `ground` ADD `ground_type_id` int(11) default NULL, ADD KEY `ground_FI_2` (`ground_type_id`);
UPDATE `ground` SET ground_type_id = 1;

ALTER TABLE ground_mm CHANGE `sort` `rank` int(11) NOT NULL default '1';




--

DROP TABLE IF EXISTS notice;
ALTER TABLE nova RENAME notice;
DROP TABLE IF EXISTS notice_i18n;
ALTER TABLE nova_i18n RENAME notice_i18n;


--


DROP TABLE IF EXISTS role;
ALTER TABLE rol RENAME role;

DROP TABLE IF EXISTS role_i18n;
ALTER TABLE rol_i18n RENAME role_i18n;

ALTER TABLE role ADD `rank` int(11) NOT NULL default '0';
ALTER TABLE role ADD `xml` char(25) collate utf8_spanish_ci NOT NULL;
ALTER TABLE role ADD `display` int(11) NOT NULL default '0';
ALTER TABLE role_i18n ADD `text` varchar(25) collate utf8_spanish_ci NOT NULL;
UPDATE role SET display=1 WHERE cod = 'act' OR cod = 'pre';


--

DROP TABLE IF EXISTS mm_person;
ALTER TABLE video_person RENAME mm_person;

ALTER TABLE mm_person CHANGE video_id `mm_id` int(11) NOT NULL;

ALTER TABLE mm_person CHANGE rol_id `role_id` int(11) NOT NULL;
ALTER TABLE mm_person DROP KEY `video_person_FI_3`;
ALTER TABLE mm_person ADD KEY `mm_person_FI_3` (`role_id`);

ALTER TABLE mm_person CHANGE `sort` `rank` int(11) NOT NULL default '1';


--


ALTER TABLE person_i18n ADD `honorific` varchar(20) collate utf8_spanish_ci default NULL;


--


ALTER TABLE pic_person CHANGE `sort` `rank` int(11) NOT NULL default '1';
ALTER TABLE pic_person CHANGE person_id `other_id` int(11) NOT NULL;
ALTER TABLE pic_person DROP KEY `pic_person_FI_2`;
ALTER TABLE pic_person ADD KEY `pic_person_FI_2` (`other_id`);

ALTER TABLE pic_serial CHANGE `sort` `rank` int(11) NOT NULL default '1';
ALTER TABLE pic_serial CHANGE serial_id `other_id` int(11) NOT NULL;
ALTER TABLE pic_serial DROP KEY `pic_serial_FI_2`;
ALTER TABLE pic_serial ADD KEY `pic_serial_FI_2` (`other_id`);


ALTER TABLE pic_video CHANGE `sort` `rank` int(11) NOT NULL default '1';
ALTER TABLE pic_video CHANGE video_id `other_id` int(11) NOT NULL;
ALTER TABLE pic_video DROP KEY `pic_video_FI_2`;
ALTER TABLE pic_video ADD KEY `pic_video_FI_2` (`other_id`);

DROP TABLE IF EXISTS pic_mm;
ALTER TABLE pic_video RENAME pic_mm;


--


----YA
--DROP TABLE IF EXISTS `serial_template`;
--CREATE TABLE `serial_template` (
--  `id` int(11) NOT NULL auto_increment,
--  `name` varchar(25) collate utf8_spanish_ci NOT NULL,
--  PRIMARY KEY  (`id`)
--) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
--
--LOCK TABLES `serial_template` WRITE;
--/*!40000 ALTER TABLE `serial_template` DISABLE KEYS */;
--INSERT INTO `serial_template` VALUES (1,'date'),(2,'date_all'),(3,'date_subserial'),(4,'subserial');
--/*!40000 ALTER TABLE `serial_template` ENABLE KEYS */;
--UNLOCK TABLES;
--
--ALTER TABLE serial ADD `serial_template_id` int(11) default NULL;
--ALTER TABLE serial ADD KEY `serial_FI_3` (`serial_template_id`);
--UPDATE `serial` SET serial_template_id = 1;
----END YA

ALTER TABLE serial CHANGE `publicDate` `publicDate` datetime NOT NULL;


--

ALTER TABLE video CHANGE `sort` `rank` int(11) NOT NULL default '1';
ALTER TABLE video CHANGE `recordData` `recordDate` datetime NOT NULL;
ALTER TABLE video CHANGE `publicDate` `publicDate` datetime NOT NULL;

----YA
--ALTER TABLE video_i18n ADD `subserial_title` varchar(150) collate utf8_spanish_ci NOT NULL;
----END YA

DROP TABLE IF EXISTS mm;
ALTER TABLE video RENAME mm;
DROP TABLE IF EXISTS mm_i18n;
ALTER TABLE video_i18n RENAME mm_i18n;




--


--
-- Table structure for table `bar_widget`
--

DROP TABLE IF EXISTS `bar_widget`;
CREATE TABLE `bar_widget` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(25) collate utf8_spanish_ci NOT NULL,
  `widget_type_id` int(11) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `bar_widget_name_unique` (`name`),
  KEY `bar_widget_FI_1` (`widget_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `bar_widget`
--

LOCK TABLES `bar_widget` WRITE;
/*!40000 ALTER TABLE `bar_widget` DISABLE KEYS */;
INSERT INTO `bar_widget` VALUES (1,'Headerbar',2),(2,'Footerbar',2),(3,'IndexbarLeft',1),(4,'IndexbarRight',1),(5,'Slidebar',1),(6,'IndexBody',3);
/*!40000 ALTER TABLE `bar_widget` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `widget`
--

DROP TABLE IF EXISTS `widget`;
CREATE TABLE `widget` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(25) collate utf8_spanish_ci NOT NULL,
  `widget_type_id` int(11) default NULL,
  `configurable` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `widget_FI_1` (`widget_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `widget`
--

/*!40000 ALTER TABLE `widget` DISABLE KEYS */;
LOCK TABLES `widget` WRITE;
INSERT INTO `widget` VALUES (1,'header',2,1),(2,'subheader',2,0),(3,'footer',2,1),(4,'idioma',1,0),(5,'noidioma',1,0),(6,'menu',1,0),(7,'contacto',1,1),(8,'total',1,0),(9,'proximas',1,1),(10,'software',1,1),(11,'buscar',1,0),(12,'google',1,0),(13,'rss',1,0),(14,'masvistostotal',1,1),(15,'masvistosmes',1,1),(16,'masvistossemana',1,1),(17,'masvistosdia',1,1),(18,'masvistostotalfalso',1,1),(19,'masvistosmesfalso',1,1),(20,'listacorreo',1,0),(21,'infowebtv',3,1),(22,'announces',3,1),(23,'lastvistos',3,1),(24,'news',3,1),(25,'timeline',3,0);
UNLOCK TABLES;
/*!40000 ALTER TABLE `widget` ENABLE KEYS */;


--
-- Table structure for table `widget_constant`
--

DROP TABLE IF EXISTS `widget_constant`;
CREATE TABLE `widget_constant` (
  `id` int(11) NOT NULL auto_increment,
  `widget_id` int(11) default NULL,
  `name` varchar(25) collate utf8_spanish_ci default NULL,
  `text` varchar(255) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `widget_constant_name_unique` (`name`),
  KEY `widget_constant_FI_1` (`widget_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `widget_constant`
--

LOCK TABLES `widget_constant` WRITE;
/*!40000 ALTER TABLE `widget_constant` DISABLE KEYS */;
/*!40000 ALTER TABLE `widget_constant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widget_i18n`
--

DROP TABLE IF EXISTS `widget_i18n`;
CREATE TABLE `widget_i18n` (
  `description` varchar(255) collate utf8_spanish_ci NOT NULL,
  `id` int(11) NOT NULL,
  `culture` varchar(7) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`,`culture`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `widget_i18n`
--

LOCK TABLES `widget_i18n` WRITE;
/*!40000 ALTER TABLE `widget_i18n` DISABLE KEYS */;
INSERT INTO `widget_i18n` VALUES ('Widget genera la cabecera de la pagina',1,'gl'),('Widget que muesta informacion sobre la seccion activa',2,'gl'),('Widget genera el pie de la pagina',3,'gl'),('Widget que permite la modificacion del idioma del usuario',4,'gl'),('Widget de las mismas dimensiones que idioma, pero vacio. Usado para buscar simetria',5,'gl'),('Widget que proporciona el menu de portal WebTv',6,'gl'),('Widget que proporciona informacion sobre el portal WebTv',7,'gl'),('Widget que proporciona informacion sobre el numero de series, videos y horas grabadas',8,'gl'),('Widget configurable a taves de info, que informa de los proximos videos',9,'gl'),('Widget que lista el software aconsejado para reproducir los videos',10,'gl'),('Widget que crea un formulario para facilitar la busqueda de videos',11,'gl'),('Widget que crea un formulario para facilitar la busqueda de videos en Google',12,'gl'),('Widget para aceder al feed arca',13,'gl'),('Widget que lista los videos mas vistos del portal WebTv',14,'gl'),('Widget que lista los videos mas vistos del portal WebTv durante los ultimos 30 dias',15,'gl'),('Widget que lista los videos mas vistos del portal WebTv durante los ultimos 7 dias',16,'gl'),('Widget que lista los videos mas vistos del portal WebTv del ultimo dia',17,'gl'),('Widget que lista los videos mas vistos del portal WebTv en un acordeon, al estilo apple',18,'gl'),('Widget que lista los videos mas vistos del portal WebTv, configurable por el usuario',19,'gl'),('Widget que proporciona acceso al formulario para entrar en la lista de correo',20,'gl'),('Mustra informacion del portal WebTv configurable a traves de info',21,'gl'),('Muestra los ultimos  anuncios del portal',22,'gl'),('Muestra los ultimos videos reproducidos del portal',23,'gl'),('Muestra la ultimas noticias que hay',24,'gl'),('Widget que proporciona una estadistica temporal sobre la fecha de grabacion de las series',25,'gl'),('Widget genera la cabecera de la pagina',1,'es'),('Widget que muesta informacion sobre la seccion activa',2,'es'),('Widget genera el pie de la pagina',3,'es'),('Widget que permite la modificacion del idioma del usuario',4,'es'),('Widget de las mismas dimensiones que idioma, pero vacio. Usado para buscar simetria',5,'es'),('Widget que proporciona el menu de portal WebTv',6,'es'),('Widget que proporciona informacion sobre el portal WebTv',7,'es'),('Widget que proporciona informacion sobre el numero de series, videos y horas grabadas',8,'es'),('Widget configurable a taves de info, que informa de los proximos videos',9,'es'),('Widget que lista el software aconsejado para reproducir los videos',10,'es'),('Widget que crea un formulario para facilitar la busqueda de videos',11,'es'),('Widget que crea un formulario para facilitar la busqueda de videos en Gooese',12,'es'),('Widget para aceder al feed arca',13,'es'),('Widget que lista los videos mas vistos del portal WebTv',14,'es'),('Widget que lista los videos mas vistos del portal WebTv durante los ultimos 30 dias',15,'es'),('Widget que lista los videos mas vistos del portal WebTv durante los ultimos 7 dias',16,'es'),('Widget que lista los videos mas vistos del portal WebTv del ultimo dia',17,'es'),('Widget que lista los videos mas vistos del portal WebTv en un acordeon, al estilo apple',18,'es'),('Widget que lista los videos mas vistos del portal WebTv, configurable por el usuario',19,'es'),('Widget que proporciona acceso al formulario para entrar en la lista de correo',20,'es'),('Mustra informacion del portal WebTv configurable a traves de info',21,'es'),('Muestra los ultimos  anuncios del portal',22,'es'),('Muestra los ultimos videos reproducidos del portal',23,'es'),('Muestra la ultimas noticias que hay',24,'es'),('Widget que proporciona una estadistica temporal sobre la fecha de grabacion de las series',25,'es'),('Widget genera la cabecera de la pagina',1,'en'),('Widget que muesta informacion sobre la seccion activa',2,'en'),('Widget genera el pie de la pagina',3,'en'),('Widget que permite la modificacion del idioma del usuario',4,'en'),('Widget de las mismas dimensiones que idioma, pero vacio. Usado para buscar simetria',5,'en'),('Widget que proporciona el menu de portal WebTv',6,'en'),('Widget que proporciona informacion sobre el portal WebTv',7,'en'),('Widget que proporciona informacion sobre el numero de series, videos y horas grabadas',8,'en'),('Widget configurable a taves de info, que informa de los proximos videos',9,'en'),('Widget que lista el software aconsejado para reproducir los videos',10,'en'),('Widget que crea un formulario para facilitar la busqueda de videos',11,'en'),('Widget que crea un formulario para facilitar la busqueda de videos en Google',12,'en'),('Widget para aceder al feed arca',13,'en'),('Widget que lista los videos mas vistos del portal WebTv',14,'en'),('Widget que lista los videos mas vistos del portal WebTv durante los ultimos 30 dias',15,'en'),('Widget que lista los videos mas vistos del portal WebTv durante los ultimos 7 dias',16,'en'),('Widget que lista los videos mas vistos del portal WebTv del ultimo dia',17,'en'),('Widget que lista los videos mas vistos del portal WebTv en un acordeon, al estilo apple',18,'en'),('Widget que lista los videos mas vistos del portal WebTv, configurable por el usuario',19,'en'),('Widget que proporciona acceso al formulario para entrar en la lista de correo',20,'en'),('Mustra informacion del portal WebTv configurable a traves de info',21,'en'),('Muestra los ultimos  anuncios del portal',22,'en'),('Muestra los ultimos videos reproducidos del portal',23,'en'),('Muestra la ultimas noticias que hay',24,'en'),('Widget que proporciona una estadistica temporal sobre la fecha de grabacion de las series',25,'en');
/*!40000 ALTER TABLE `widget_i18n` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `widget_template`
--

DROP TABLE IF EXISTS `widget_template`;
CREATE TABLE `widget_template` (
  `id` int(11) NOT NULL auto_increment,
  `widget_id` int(11) default NULL,
  `name` varchar(25) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `widget_template_name_unique` (`name`),
  KEY `widget_template_FI_1` (`widget_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
CREATE TABLE `widget_template_i18n` (
  `text` text collate utf8_spanish_ci,
  `id` int(11) NOT NULL,
  `culture` varchar(7) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`,`culture`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `widget_template_i18n`
--


/*!40000 ALTER TABLE `widget_template_i18n` DISABLE KEYS */;
LOCK TABLES `widget_template_i18n` WRITE;
INSERT INTO `widget_template_i18n` VALUES ('<!-- CABEZERA -->\n<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"125\" width=\"740\">\n <tbody>\n  <tr>\n\n   <td align=\"left\" valign=\"bottom\">\n    <img src=\"/uploads/uvigo/banner.gif\" height=\"109\" width=\"600\" />\n   </td>\n\n   <td align=\"left\" valign=\"bottom\">\n    <a href=\"http://uvigo.es\" target=\"_self\">\n     <img src=\"/uploads/uvigo/logo_tv.gif\" border=\"0\" height=\"88\" width=\"102\">\n    </a>\n   </td>\n\n<table align=\"center\" border=\"0\" cellpadding=\"6\" cellspacing=\"0\" height=\"25\" width=\"740\">\n <tbody>\n  <tr>\n   <td class=\"grisnegrita\" align=\"right\" background=\"/uploads/uvigo/fondo_tabla_tv3.gif\" valign=\"middle\">\n    uvigo-tv | recursos multimedia de la universidad de vigo\n   </td>\n  </tr>\n </tbody>\n</table>\n<!-- Fin CAB -->',1,'gl'),('<!-- CABEZERA -->\n<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"125\" width=\"740\">\n <tbody>\n  <tr>\n\n   <td align=\"left\" valign=\"bottom\">\n    <img src=\"/uploads/uvigo/banner.gif\" height=\"109\" width=\"600\" />\n   </td>\n\n   <td align=\"left\" valign=\"bottom\">\n    <a href=\"http://uvigo.es\" target=\"_self\">\n     <img src=\"/uploads/uvigo/logo_tv.gif\" border=\"0\" height=\"88\" width=\"102\">\n    </a>\n   </td>\n\n<table align=\"center\" border=\"0\" cellpadding=\"6\" cellspacing=\"0\" height=\"25\" width=\"740\">\n <tbody>\n  <tr>\n   <td class=\"grisnegrita\" align=\"right\" background=\"/uploads/uvigo/fondo_tabla_tv3.gif\" valign=\"middle\">\n    uvigo-tv  | recursos multimedia da universidade de vigo \n   </td>\n  </tr>\n </tbody>\n</table>\n<!-- Fin CAB -->',1,'es'),('<h1 class=\"default\">Inserte aqui HTML de su cabecera</h1>',1,'en'),('<!-- PIE -->\n<table align=\"center\" border=\"0\" cellpadding=\"6\" cellspacing=\"0\" height=\"35\" width=\"740\">\n <tbody>\n  <tr>\n   <td align=\"left\" valign=\"top\">\n     <p class=\"grisnegrita\" style=\"margin:0\">\n      uvigo-tv  | vicerrectorado de nuevas tecnolog&iacute;as y calidad | servicios inform&aacute;ticos de investigaci&oacute;n\n     </p>\n   </td>\n  </tr>\n  <tr>\n   <td align=\"right\" background=\"/uploads/uvigo/fondo_tabla_tv3.gif\" valign=\"top\" style=\"padding:6px\">\n    <img src=\"/uploads/uvigo/logo.gif\" width=\"224\" height=\"107\" />\n   </td>\n  </tr>\n </tbody>\n</table>\n<!-- FIN PIE -->',2,'gl'),('<!-- PIE -->\n<table align=\"center\" border=\"0\" cellpadding=\"6\" cellspacing=\"0\" height=\"35\" width=\"740\">\n <tbody>\n  <tr>\n   <td align=\"left\" valign=\"top\">\n     <p class=\"grisnegrita\" style=\"margin:0\">\n      uvigo-tv  | vicerreitor&iacute;a de novas tecnolox&iacute;as e calidade | servizos inform&aacute;ticos de investigaci&oacute;n\n     </p>\n   </td>\n  </tr>\n  <tr>\n   <td align=\"right\" background=\"/uploads/uvigo/fondo_tabla_tv3.gif\" valign=\"top\" style=\"padding:6px\">\n    <img src=\"/uploads/uvigo/logo.gif\" width=\"224\" height=\"107\" />\n   </td>\n  </tr>\n </tbody>\n</table>\n<!-- FIN PIE -->',2,'es'),('<h1 class=\"default\">Inserte aqui HTML de su pie</h1>',2,'en'),('<h2 id=\"index_index_es\">¿Que es Uvigo-TV?</h2>\n<br />\n<table width=\"100%\" border=\"0\">\n <tr> \n  <td> <div align=\"justify\"> \n     <p align=\"justify\"> &nbsp;&nbsp;&nbsp;&nbsp;Uvigo-TV es un servicio\n     de televisi&oacute;n por Internet prestado por el &Aacute;rea \n     de las Tecnolog&iacute;as de la Informaci&oacute;n y las Comunicaciones \n     (ATIC) del Vicerrectorado de Innovaci&oacute;n y Calidad de \n     la Universidad de Vigo.<br>\n     &nbsp;&nbsp;&nbsp;&nbsp;Agrupa todos los servicios de transmisi&oacute;n \n     de v&iacute;deo sobre Internet de la Universidad de Vigo, poniendo \n     a disposici&oacute;n de los usuarios de la Universidad contenidos \n     audiovisuales de car&aacute;cter educativo e institucional.</p>\n  </div></td>\n </tr>\n</table>\n<br />\n',3,'gl'),('<h2 id=\"index_index_gl\">¿Que &eacute; Uvigo-TV?</h2>\n<br />\n<table width=\"100%\" border=\"0\">\n <tr> \n  <td> <div align=\"justify\"> \n   <p align=\"justify\"> &nbsp;&nbsp;&nbsp;&nbsp;Uvigo-TV &eacute;\n      un servizo de televisi&oacute;n por Internet prestado pola &Aacute;rea\n      das Tecnolox&iacute;as da Informaci&oacute;n e as Comunicaci&oacute;ns\n      (ATIC) da Vicerreitor&iacute;a de Novas Tecnolox&iacute;as e\n      Calidade da Universidade de Vigo.<br>\n      &nbsp;&nbsp;&nbsp;&nbsp;Agrupa t&oacute;dolos servizos de transmisi&oacute;n \n      de v&iacute;deo sobre Internet da Universidade de Vigo, po&ntilde;endo \n      &aacute; disposici&oacute;n dos usuarios da Universidade contidos \n      audiovisuais de car&aacute;cter educativo e institucional.</p>\n  </div></td>\n </tr>\n</table>\n<br />\n',3,'es'),('<h2>info portal webtv</h2>\nPuMuKIT (PUblicador MUltimedia en KIT) permite publicar vía Internet los contenidos audiovisuales\nproducidos en una Institución, Universidad, etc..  PuMuKIT publica los contenidos multimedia\nalmacenados en su base de datos de dos modos diferentes: Generando un portal WEB, una WEB-TV y\ncreando flujos RSS compatibles ARCA.',3,'en'),('proximas',4,'gl'),('proximas',4,'es'),('proximas',4,'en');
UNLOCK TABLES;
/*!40000 ALTER TABLE `widget_template_i18n` ENABLE KEYS */;


--
-- Table structure for table `widget_type`
--

DROP TABLE IF EXISTS `widget_type`;
CREATE TABLE `widget_type` (
  `id` int(11) NOT NULL auto_increment,
  `type` varchar(25) collate utf8_spanish_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `widget_type`
--

LOCK TABLES `widget_type` WRITE;
/*!40000 ALTER TABLE `widget_type` DISABLE KEYS */;
INSERT INTO `widget_type` VALUES (1,'lateral'),(2,'banner'),(3,'index');
/*!40000 ALTER TABLE `widget_type` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Table structure for table `template`
--

DROP TABLE IF EXISTS `template`;
CREATE TABLE `template` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) collate utf8_spanish_ci NOT NULL,
  `type` char(3) collate utf8_spanish_ci NOT NULL,
  `user` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `template`
--

/*!40000 ALTER TABLE `template` DISABLE KEYS */;
LOCK TABLES `template` WRITE;
INSERT INTO `template` VALUES (1,'error404','2',0),(2,'header','3',0),(3,'footer','3',0),(4,'servicio','3',1),(5,'Info','2',1),(6,'FAQ','2',1),(7,'Lista','2',1),(8,'layout','1',0),(9,'style','1',0),(10,'email_HTML','4',0),(11,'email_TXT','4',0),(12,'Contacto','2',1);
UNLOCK TABLES;
/*!40000 ALTER TABLE `template` ENABLE KEYS */;


--
-- Table structure for table `template_i18n`
--

DROP TABLE IF EXISTS `template_i18n`;
CREATE TABLE `template_i18n` (
  `description` varchar(255) collate utf8_spanish_ci NOT NULL,
  `text` text collate utf8_spanish_ci,
  `id` int(11) NOT NULL,
  `culture` varchar(7) collate utf8_spanish_ci NOT NULL,
  PRIMARY KEY  (`id`,`culture`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `template_i18n`
--


/*!40000 ALTER TABLE `template_i18n` DISABLE KEYS */;
LOCK TABLES `template_i18n` WRITE;
INSERT INTO `template_i18n` VALUES ('error404','<h1>error404</h1>',1,'gl'),('error404','<h1>error404</h1>',1,'es'),('error404','<h1>error404</h1>',1,'en'),('Template para  header','0',2,'gl'),('Template para  header','0',2,'es'),('Template para  header','0',2,'en'),('Template para  footer','0',3,'gl'),('Template para  footer','0',3,'es'),('Template para  footer','0',3,'en'),('Template para  servicio','1',4,'gl'),('Template para  servicio','1',4,'es'),('Template para  servicio','1',4,'en'),('Template para  info','<h1 id=\"info_h1\">Servicio</h1>\n\n<h2 id=\"serv_desc_es\">Descripci&oacute;n</h2>\n\n        <img src=\"/uploads/uvigo/camara.jpg\" width=\"250\" height=\"250\" align=\"right\"> \n        <p align=\"justify\">&nbsp;&nbsp;&nbsp;&nbsp;Uvigo-TV es un servicio de televisi&oacute;n \n          por Internet prestado por el &Aacute;rea de las Tecnolog&iacute;as de \n          la Informaci&oacute;n y las Comunicaciones (ATIC) del Vicerrectorado \n          de Nuevas Tecnolog&iacute;as y Calidad de la Universidad de Vigo.<br>\n\n          &nbsp;&nbsp;&nbsp;&nbsp;Agrupa todos los servicios de transmisi&oacute;n \n          de v&iacute;deo sobre Internet de la Universidad de Vigo, poniendo a \n          disposici&oacute;n de los usuarios de la Universidad contenidos audiovisuales \n          de car&aacute;cter educativo e institucional.<br>\n          &nbsp;&nbsp;&nbsp;&nbsp;Uvigo-TV, como televisi&oacute;n corporativa \n          sobre Internet, permite la transmisi&oacute;n en directo de eventos \n          a toda la red de Uvigo o a todo Internet, seg&uacute;n se desee. Su \n          recepci&oacute;n se hace a trav&eacute;s del computador personal con \n          la misma facilidad que la visi&oacute;n de una p&aacute;gina web. Asimismo, \n          este sistema permite grabar esos eventos y ponerlos disponibles en Uvigo-TV \n          a trav&eacute;s de la Videoteca bajo demanda.<br>\n\n          &nbsp;&nbsp;&nbsp;&nbsp;Para poder visualizar correctamente Uvigo-TV \n          en su equipo se recomienda tener instalada la &uacute;ltima versi&oacute;n \n          actualizada del reproductor <a href=\"http://www.microsoft.com/windows/windowsmedia/player/download/\" target=\"_blank\">Windows \n          Media Player</a>. Es recomendable el empleo de Internet Explorer como \n          navegador, aunque tambien ser&aacute; posible la recepci&oacute;n de \n          Uvigo-TV desde Linux o Mac, haciendo uso de los programas adecuados \n          para la reproducci&oacute;n. Para poder acceder a Uvigo-TV en directo \n          s&oacute;lo es necesario pinchar en<a href=\"http://tv.uvigo.es/tvuvigodirecto.es.html\" target=\"_self\"> \n          Uvigo-TV en directo</a>.</p>\n\n            <h2 id=\"serv_soli_es\">Solicitudes</h2>\n	  \n        <p align=\"justify\">&nbsp;&nbsp;&nbsp;&nbsp;Para la retransmisi&oacute;n de los eventos en directo \n          se requiere la solicitud del servicio a ATIC.Uvigo-TV. Para la retransmisi&oacute;n \n          de actos y el dep&oacute;sito de documentos en la Videoteca de Uvigo-TV \n          se necesitan los permisos legales correspondientes por parte de los \n          ponentes.<br>\n          &nbsp;&nbsp;&nbsp;&nbsp;Puede solicitar que se le env&iacute;en a su \n          cuenta de correo electr&oacute;nico notificaci&oacute;n de las pr&oacute;ximas \n          transmisiones de Uvigo-TV en directo y avisos de las &uacute;ltimas \n          incorporaciones realizadas a la Mediateca del Servicio.\n       </p>		  \n',5,'gl'),('Template para  info','<h1 id=\"info_h1\">Servizo</h1>\n <h2 id=\"serv_desc_gl\">Descripci&oacute;n</h2>\n        <img src=\"/uploads/uvigo/camara.jpg\" width=\"250\" height=\"250\" align=\"right\"> \n        <p align=\"justify\">&nbsp;&nbsp;&nbsp;&nbsp;Uvigo-TV &eacute; un servizo \n          de televisi&oacute;n por Internet prestado pola &Aacute;rea das Tecnolox&iacute;as \n          da Informaci&oacute;n e as Comunicaci&oacute;ns (ATIC) da Vicerreitor&iacute;a \n          de Novas Tecnolox&iacute;as e Calidade da Universidade de Vigo.<br>\n\n          &nbsp;&nbsp;&nbsp;&nbsp;Agrupa t&oacute;dolos servizos de transmisi&oacute;n \n          de v&iacute;deo sobre Internet da Universidade de Vigo, po&ntilde;endo \n          &aacute; disposici&oacute;n dos usuarios da Universidade contidos audiovisuais \n          de car&aacute;cter educativo e institucional.<br>\n          &nbsp;&nbsp;&nbsp;&nbsp;Uvigo-TV, como televisi&oacute;n corporativa sobre \n          Internet, permite a transmisi&oacute;n en directo de eventos a toda \n          a rede de Uvigo ou a todo Internet, seg&uacute;n se desexe. A s&uacute;a \n          recepci&oacute;n faise a trav&eacute;s do computador persoal coa mesma \n          facilidade que a visi&oacute;n dunha p&aacute;xina web. Asimesmo, este \n          sistema permite gravar eses eventos e facelos dispo&ntilde;ibles baixo \n          demanda a trav&eacute;s da Videoteca de Uvigo-TV.<br>&nbsp;&nbsp;&nbsp;&nbsp;Para poder visualizar correctamente \n                Uvigo-TV no seu equipo recom&eacute;ndase ter instalada a &uacute;ltima \n                versi&oacute;n actualizada do reproductor <a href=\"http://www.microsoft.com/windows/windowsmedia/player/download/\" target=\"_blank\">Windows \n                Media Player</a>. &Eacute; recomendable o emprego de Internet \n                Explorer como navegador, a&iacute;nda que tam&eacute;n ser&aacute; \n                posible a recepci&oacute;n de Uvigo-TV desde Linux ou Mac, facendo \n                uso dos programas axeitados para a reproducci&oacute;n. Para poder \n                acceder a Uvigo-TV en directo s&oacute; &eacute; preciso premer \n                en <a href=\"http://tv.uvigo.es/tvuvigodirecto.html\" target=\"_self\">Uvigo-TV \n                en directo</a>.</p>\n\n            <h2  id=\"serv_soli_es\">Solicitudes</h2>\n  \n        <p align=\"justify\">&nbsp;&nbsp;&nbsp;&nbsp;Para a retransmisi&oacute;n \n          dos eventos en directo requ&iacute;rese a solicitude do servizo a ATIC.Uvigo-TV. \n          Para retransmisi&oacute;n de actos e o dep&oacute;sito de documentos \n          na Videoteca de Uvigo-TV neces&iacute;tanse os permisos legais correspondentes \n          por parte dos po&ntilde;entes.<br>\n\n          &nbsp;&nbsp;&nbsp;&nbsp;Pode solicitar que se lle env&iacute;en &aacute; \n          s&uacute;a conta de correo electr&oacute;nico notificaci&oacute;n das \n          pr&oacute;ximas transmisi&oacute;ns que realizar&aacute; Uvigo-TV en \n          directo e avisos das &uacute;ltimas incorporaci&oacute;ns &aacute; Mediateca \n          do Servizo. </p>\n',5,'es'),('Template para  info','1',5,'en'),('Template para  faq','<h1 id=\"info_h1\">Preguntas Frecuentes</h1>\n<h2 id=\"faq_es\">FAQ</h2>\n\n<table width=\"100%\">\n<tbody><tr> \n            <td>&nbsp;</td>\n          </tr>\n          <tr> \n            <td><strong>1. <a href=\"#faq1\">Cuando intento ver un video me descarga \n              un fichero de texto con extension .ASX</a></strong></td>\n          </tr>\n          <tr> \n            <td><strong>2. <a href=\"#faq2\">Los videos se ven pero a cada momento \n              se cortan y el reproductor dice \"Buffering\"</a></strong></td>\n          </tr>\n\n          <tr> \n            <td><strong>3. <a href=\"#faq3\">Como ver los videos desde Macintosh \n              ?</a> </strong></td>\n          </tr>\n          <tr> \n            <td><strong>4. <a href=\"#faq4\">Como ver los videos desde Linux ?</a></strong></td>\n          </tr>\n          <tr> \n            <td><strong>5.<a href=\"#faq5\"> Pueden enviarme una copia de sus videos \n              ?</a></strong></td>\n\n          </tr>\n          <tr> \n            <td><strong>6. <a href=\"#faq6\">Al intentar ver cualquier video solo \n              veo la careta de entrada con el escudo azul</a></strong></td>\n          </tr>\n          <tr> \n            <td>&nbsp;</td>\n          </tr>\n          <tr> \n            <td bgcolor=\"#ccccff\"><strong><a name=\"faq1\" id=\"faq1\">1. Cuando intento \n              ver un video me descarga un fichero de texto con extension .ASX</a></strong></td>\n\n          </tr>\n          <tr> \n            <td bgcolor=\"#ffffff\">Tu sistema no tiene asociado ningun reproductor \n              a los ficheros .ASX. Instala el Windows Media Player (WMP) <a href=\"http://www.microsoft.com/windows/windowsmedia/player/download/\">http://www.microsoft.com/windows/windowsmedia/player/download/</a> \n              o similar.</td>\n          </tr>\n          <tr> \n            <td bgcolor=\"#ffffff\">&nbsp;</td>\n          </tr>\n          <tr> \n            <td bgcolor=\"#ccccff\"><strong><a name=\"faq2\" id=\"faq2\"></a>2. Los \n              videos se ven pero a cada momento se cortan y el reproductor dice \n              \"Buffering\"</strong></td>\n\n          </tr>\n          <tr> \n            <td height=\"18\"> <p>El reproductor no esta detectando adecuadamente \n                su velocidad de conexion, Los videos de Uvigo TV se encuentran \n                codificados en 3 calidades: 50kbps, 220 kbps y 950 kbps. Si utiliza \n                WMP como reproductor puede ir al menu Tools-Options-preformance \n                y elija manualmente una velocidad de conexion inferior.</p></td>\n          </tr>\n          <tr> \n            <td bgcolor=\"#ffffff\">&nbsp;</td>\n          </tr>\n          <tr> \n            <td bgcolor=\"#ccccff\"><strong><a name=\"faq3\" id=\"faq3\"></a>3. Como \n              ver los videos desde Macintosh ? </strong></td>\n\n          </tr>\n          <tr> \n            <td height=\"22\">Una solucion es utilizar los codecs de WMV para el \n              quicktime, para obtenerlos visitar la pagina:<a href=\"http://www.flip4mac.com/wmv_download.htm\">www.flip4mac.com/wmv_download.htm</a> \n            </td>\n          </tr>\n          <tr> \n            <td bgcolor=\"#ffffff\">&nbsp;</td>\n          </tr>\n          <tr> \n            <td bgcolor=\"#ccccff\"><strong><a name=\"faq4\" id=\"faq4\"></a>4. Como \n              ver los videos desde Linux ?</strong></td>\n\n          </tr>\n          <tr> \n            <td>Copio aqui parte de la info preparada gracias a GALPON (www.galpon.org) \n              sobre el tema: <p>**Dende o Mozilla Firefox 1.5</p>\n              <p>Reproductor de vídeo MPlayer ou Xine<br>\n                Extensión do Mozilla Firefox chamada MediaPlayerConnectivity \n                que fai de intermediario excelente para reproducir os enlaces.</p>\n              <p>Codecs de Windows</p>\n              <p>OpenSuSE: o repositorio de Packman buscando o paquete w32codec-all \n                ou Win32-Codecs</p>\n\n              <p><br>\n                **En Ubuntu</p>\n              <p>Para ver los vídeos en Ubuntu Dapper hay que instalar \n                los siguientes paquetes:</p>\n              <p>sudo apt-get install gxine libxine-extracodecs</p>\n              <p>y este otro indispensable paquete extra con los codecs de Windows \n                (válido sólo para arquitecturas i386):</p>\n              <p>wget -c http://www.debian-multimedia.org/pool/main/w/w32codecs/w32codecs_20060611-0.0_i386.deb<br>\n\n                sudo dpkg -i w32codecs_20060611-0.0_i386.deb</p>\n              <p><br>\n                Articulo original en el WIKI de Galpon:<br>\n                <a href=\"http://www.galpon.org/wiki/index.php/Servizo_Uvigo-TV\">http://www.galpon.org/wiki/index.php/Servizo_Uvigo-TV</a></p></td>\n          </tr>\n          <tr> \n            <td bgcolor=\"#ffffff\">&nbsp;</td>\n          </tr>\n\n          <tr> \n            <td bgcolor=\"#ccccff\"><strong><a name=\"faq5\" id=\"faq5\"></a>5. Pueden \n              enviarme una copia de sus videos ?</strong></td>\n          </tr>\n          <tr> \n            <td>Como norma general, no. Normalmente los ponentes permiten la grabacion \n              de sus conferencias y clases para la difusion via Uvigo.Tv pero \n              no autorizan la liberación de copias de sus intervenciones. \n              Para la liberación de copias es preciso el permiso del ponente.</td>\n          </tr>\n          <tr>\n            <td bgcolor=\"#ffffff\">&nbsp;</td>\n          </tr>\n\n          <tr> \n            <td bgcolor=\"#ccccff\"><strong><a name=\"faq6\" id=\"faq6\"></a>6. Al intentar \n              ver cualquier video solo veo la careta de entrada con el escudo \n              azul</strong></td>\n          </tr>\n          <tr> \n            <td>Su reproductor no interpreta bien los codigos SMIL y no es capaz \n              de seguir las listas de reproduccion. Esto pasa con VLC y winamp, \n              por ejemplo. Emplee Windows Media Player o Mplayer para reproducir \n              los videos de Uvigo.TV. si no sabe como hacer esto reinstale el \n              WMP, puede descargar aqui la última versión <a href=\"http://www.microsoft.com/windows/windowsmedia/player/download/\">http://www.microsoft.com/windows/windowsmedia/player/download/</a></td>\n          </tr>\n        </tbody>\n</table>',6,'gl'),('Template para  faq','<h1 id=\"info_h1\">Preguntas Frecuentes</h1>\n<h2 id=\"faq_gl\">FAQ</h2>\n\n<table width=\"100%\">\n<tbody><tr> \n            <td>&nbsp;</td>\n          </tr>\n          <tr> \n            <td><strong>1. <a href=\"#faq1\">Cuando intento ver un video me descarga \n              un fichero de texto con extension .ASX</a></strong></td>\n          </tr>\n          <tr> \n            <td><strong>2. <a href=\"#faq2\">Los videos se ven pero a cada momento \n              se cortan y el reproductor dice \"Buffering\"</a></strong></td>\n          </tr>\n\n          <tr> \n            <td><strong>3. <a href=\"#faq3\">Como ver los videos desde Macintosh \n              ?</a> </strong></td>\n          </tr>\n          <tr> \n            <td><strong>4. <a href=\"#faq4\">Como ver los videos desde Linux ?</a></strong></td>\n          </tr>\n          <tr> \n            <td><strong>5.<a href=\"#faq5\"> Pueden enviarme una copia de sus videos \n              ?</a></strong></td>\n\n          </tr>\n          <tr> \n            <td><strong>6. <a href=\"#faq6\">Al intentar ver cualquier video solo \n              veo la careta de entrada con el escudo azul</a></strong></td>\n          </tr>\n          <tr> \n            <td>&nbsp;</td>\n          </tr>\n          <tr> \n            <td bgcolor=\"#ccccff\"><strong><a name=\"faq1\" id=\"faq1\">1. Cuando intento \n              ver un video me descarga un fichero de texto con extension .ASX</a></strong></td>\n\n          </tr>\n          <tr> \n            <td bgcolor=\"#ffffff\">Tu sistema no tiene asociado ningun reproductor \n              a los ficheros .ASX. Instala el Windows Media Player (WMP) <a href=\"http://www.microsoft.com/windows/windowsmedia/player/download/\">http://www.microsoft.com/windows/windowsmedia/player/download/</a> \n              o similar.</td>\n          </tr>\n          <tr> \n            <td bgcolor=\"#ffffff\">&nbsp;</td>\n          </tr>\n          <tr> \n            <td bgcolor=\"#ccccff\"><strong><a name=\"faq2\" id=\"faq2\"></a>2. Los \n              videos se ven pero a cada momento se cortan y el reproductor dice \n              \"Buffering\"</strong></td>\n\n          </tr>\n          <tr> \n            <td height=\"18\"> <p>El reproductor no esta detectando adecuadamente \n                su velocidad de conexion, Los videos de Uvigo TV se encuentran \n                codificados en 3 calidades: 50kbps, 220 kbps y 950 kbps. Si utiliza \n                WMP como reproductor puede ir al menu Tools-Options-preformance \n                y elija manualmente una velocidad de conexion inferior.</p></td>\n          </tr>\n          <tr> \n            <td bgcolor=\"#ffffff\">&nbsp;</td>\n          </tr>\n          <tr> \n            <td bgcolor=\"#ccccff\"><strong><a name=\"faq3\" id=\"faq3\"></a>3. Como \n              ver los videos desde Macintosh ? </strong></td>\n\n          </tr>\n          <tr> \n            <td height=\"22\">Una solucion es utilizar los codecs de WMV para el \n              quicktime, para obtenerlos visitar la pagina:<a href=\"http://www.flip4mac.com/wmv_download.htm\">www.flip4mac.com/wmv_download.htm</a> \n            </td>\n          </tr>\n          <tr> \n            <td bgcolor=\"#ffffff\">&nbsp;</td>\n          </tr>\n          <tr> \n            <td bgcolor=\"#ccccff\"><strong><a name=\"faq4\" id=\"faq4\"></a>4. Como \n              ver los videos desde Linux ?</strong></td>\n\n          </tr>\n          <tr> \n            <td>Copio aqui parte de la info preparada gracias a GALPON (www.galpon.org) \n              sobre el tema: <p>**Dende o Mozilla Firefox 1.5</p>\n              <p>Reproductor de vídeo MPlayer ou Xine<br>\n                Extensión do Mozilla Firefox chamada MediaPlayerConnectivity \n                que fai de intermediario excelente para reproducir os enlaces.</p>\n              <p>Codecs de Windows</p>\n              <p>OpenSuSE: o repositorio de Packman buscando o paquete w32codec-all \n                ou Win32-Codecs</p>\n\n              <p><br>\n                **En Ubuntu</p>\n              <p>Para ver los vídeos en Ubuntu Dapper hay que instalar \n                los siguientes paquetes:</p>\n              <p>sudo apt-get install gxine libxine-extracodecs</p>\n              <p>y este otro indispensable paquete extra con los codecs de Windows \n                (válido sólo para arquitecturas i386):</p>\n              <p>wget -c http://www.debian-multimedia.org/pool/main/w/w32codecs/w32codecs_20060611-0.0_i386.deb<br>\n\n                sudo dpkg -i w32codecs_20060611-0.0_i386.deb</p>\n              <p><br>\n                Articulo original en el WIKI de Galpon:<br>\n                <a href=\"http://www.galpon.org/wiki/index.php/Servizo_Uvigo-TV\">http://www.galpon.org/wiki/index.php/Servizo_Uvigo-TV</a></p></td>\n          </tr>\n          <tr> \n            <td bgcolor=\"#ffffff\">&nbsp;</td>\n          </tr>\n\n          <tr> \n            <td bgcolor=\"#ccccff\"><strong><a name=\"faq5\" id=\"faq5\"></a>5. Pueden \n              enviarme una copia de sus videos ?</strong></td>\n          </tr>\n          <tr> \n            <td>Como norma general, no. Normalmente los ponentes permiten la grabacion \n              de sus conferencias y clases para la difusion via Uvigo.Tv pero \n              no autorizan la liberación de copias de sus intervenciones. \n              Para la liberación de copias es preciso el permiso del ponente.</td>\n          </tr>\n          <tr>\n            <td bgcolor=\"#ffffff\">&nbsp;</td>\n          </tr>\n\n          <tr> \n            <td bgcolor=\"#ccccff\"><strong><a name=\"faq6\" id=\"faq6\"></a>6. Al intentar \n              ver cualquier video solo veo la careta de entrada con el escudo \n              azul</strong></td>\n          </tr>\n          <tr> \n            <td>Su reproductor no interpreta bien los codigos SMIL y no es capaz \n              de seguir las listas de reproduccion. Esto pasa con VLC y winamp, \n              por ejemplo. Emplee Windows Media Player o Mplayer para reproducir \n              los videos de Uvigo.TV. si no sabe como hacer esto reinstale el \n              WMP, puede descargar aqui la última versión <a href=\"http://www.microsoft.com/windows/windowsmedia/player/download/\">http://www.microsoft.com/windows/windowsmedia/player/download/</a></td>\n          </tr>\n        </tbody>\n</table>',6,'es'),('Template para  faq','1',6,'en'),('Template para  lista','<h1 id=\"info_h1\">Lista de Correo</h1>\n<div align=\"justify\">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Reciba \n          en su cuenta de correo electr&oacute;nico avisos de las pr&oacute;ximas \n          transmisiones de Uvigo-TV en directo y de las &uacute;ltimas incorporaciones \n          a la Mediateca del Servicio.</strong><br>\n          <br>\n        </div>\n\n\n<h2 id=\"serv_desc_es\">descripcion</h2>\n\n      </tbody></table>\n        <p align=\"justify\">&nbsp;&nbsp;&nbsp;&nbsp;Uvigo-TV cuenta con una lista \n          de correo propia a la que los usuarios del servicio podr&aacute;n apuntarse. Los miembros de esta lista de correo recibir&aacute;n \n          en su correo electr&oacute;nico avisos y novedades relativas al servicio, \n          fundamentalmente fechas y horarios de las pr&oacute;ximas retransmisiones \n          en directo, o enlaces a nuevos v&iacute;deos y grabaciones realizadas \n          por el servicio y puestos a disposici&oacute;n de los usuarios.\n        </p>\n\n\n<h2 id=\"serv_soli_es\">solicitudes</h2>\n  \n        <p align=\"justify\">&nbsp;&nbsp;&nbsp;&nbsp;Para la retransmisi&oacute;n \n          de los eventos en directo se requiere la solicitud del servicio a ATIC.Uvigo-TV. \n          Para la retransmisi&oacute;n de actos y el dep&oacute;sito de documentos \n          en la Videoteca de Uvigo-TV se necesitan los permisos legales correspondientes \n          por parte de los ponentes.\n        </p>		  \n        <table width=\"100%\" border=\"0\">\n          <tr> \n            <td width=\"7%\"><div align=\"right\">Para</div></td>\n            <td width=\"16%\" bgColor=\"#CC0000\"><div align=\"center\"><font color=\"#FFFFFF\"> \n                <strong><font size=\"1\">DARSE DE</font> ALTA</strong></font></div></td>\n\n            <td width=\"77%\"><div align=\"left\">indique su dirección de correo electrónico \n                (cuenta de <em>uvigo</em>) y su nombre</div></td>\n          </tr>\n        </table>\n        <FORM Method=POST ACTION=\"https://listas.uvigo.es/mailman/subscribe/uvigotv\">\n          <div align=\"center\">\n            <table width=\"64%\" border=\"0\">\n              <tr> \n                <td width=\"40%\" align=\"right\"><strong>Correo Electrónico:</strong></td>\n\n                <td width=\"60%\"><INPUT type=\"Text\" name=\"email\" size=\"30\" value=\"\"></td>\n              </tr>\n              <tr> \n                <td align=\"right\"><strong>Nombre:</strong></td>\n                <td><INPUT type=\"Text\" name=\"fullname\" size=\"30\" value=\"\"></td>\n              </tr>\n            </table><br>\n            <INPUT type=\"Submit\" name=\"Enviar\" value=\"Enviar datos\">\n          </div>\n\n        </FORM>\n<table width=\"100%\" border=\"0\">\n          <tr> \n            <td colspan=\"3\" style=\"border-bottom:1px solid #003399;\"><div align=\"center\">&nbsp;</div></td>\n          </tr>\n          <tr> \n            <td colspan=\"3\"><div align=\"center\">&nbsp;</div></td>\n          </tr>		  \n          <tr> \n            <td width=\"7%\"><div align=\"right\">Para</div></td>\n            <td width=\"16%\" bgColor=\"#CC0000\"><div align=\"center\"><font color=\"#FFFFFF\"> \n                <strong><font size=\"1\">DARSE DE</font> BAJA</strong></font></div></td>\n\n            <td width=\"77%\"><div align=\"left\">indique su dirección de correo electrónico \n                (cuenta de <em>uvigo</em>)</div></td>\n          </tr>\n        </table>\n<FORM Method=POST ACTION=\"https://listas.uvigo.es/mailman/options/uvigotv\">\n<INPUT type=\"hidden\" name=\"login-unsub\" value=\"1\"><div align=\"center\">\n<table width=\"64%\" border=\"0\">\n  <tr><td width=\"40%\" align=\"right\"><strong>Correo Electrónico:</strong></td>\n    <td><INPUT type=\"Text\" name=\"email\" size=\"30\" value=\"\"></td>\n\n  </tr>\n</table><br>\n            <INPUT type=\"Submit\" name=\"Enviar\" value=\"Enviar datos\">\n          </div>\n        </FORM>',7,'gl'),('Template para  lista','<h1 id=\"info_h1\">Lista de Correo</h1>\n<div align=\"justify\">&nbsp;&nbsp;&nbsp;&nbsp;<strong>Reciba \n          na s&uacute;a conta de correo electr&oacute;nico avisos das pr&oacute;ximas \n          transmisi&oacute;ns de Uvigo-TV en directo e das &uacute;ltimas incorporaci&oacute;ns \n          &aacute; Mediateca do Servizo.</strong><br>\n          <br>\n        </div>\n\n<h2 id=\"serv_desc_gl\">descripcion</h2>\n\n        <p align=\"justify\">&nbsp;&nbsp;&nbsp;&nbsp;Uvigo-TV conta cunha lista \n          de correo propia &aacute; que os usuarios do servizo poder&aacute;n \n          apuntarse. Os membros desta lista de correo recibir&aacute;n no \n          seu correo electr&oacute;nico avisos e novidades relativas &oacute; \n          servizo, tales como datas e horarios das pr&oacute;ximas retransmisi&oacute;ns \n          en directo, ou enlaces a novos v&iacute;deos e grabaci&oacute;ns realizadas \n          polo servizo e postos a disposici&oacute;n dos usuarios.\n        </p>\n	\n\n<h2 id=\"serv_soli_gl\">solicitudes</h2>\n  \n        <p align=\"justify\">&nbsp;&nbsp;&nbsp;&nbsp;Para a retransmisi&oacute;n \n          dos eventos en directo requ&iacute;rese a solicitude do servizo a ATIC.Uvigo-TV. \n          Para retransmisi&oacute;n de actos e o dep&oacute;sito de documentos \n          na Videoteca de Uvigo-TV neces&iacute;tanse os permisos legais correspondentes \n          por parte dos po&ntilde;entes.\n        </p>\n\n        <table width=\"100%\" border=\"0\">\n          <tr> \n            <td width=\"7%\"><div align=\"right\">Para</div></td>\n            <td width=\"16%\" bgColor=\"#CC0000\"><div align=\"center\"><font color=\"#FFFFFF\"><strong><font size=\"1\">DARSE \n                DE</font> ALTA</strong></font></div></td>\n            <td width=\"77%\"><div align=\"left\">indique a s&uacute;a dirección de \n                correo electrónico (conta de <em>uvigo</em>) e o seu nome</div></td>\n\n          </tr>\n        </table>\n        <FORM Method=POST ACTION=\"https://listas.uvigo.es/mailman/subscribe/uvigotv\">\n          <div align=\"center\">\n            <table width=\"64%\" border=\"0\">\n              <tr> \n                <td width=\"40%\" align=\"right\"><strong>Correo Electrónico:</strong></td>\n                <td width=\"60%\"><INPUT type=\"Text\" name=\"email\" size=\"30\" value=\"\"></td>\n              </tr>\n\n              <tr> \n                <td align=\"right\"><strong>Nome:</strong></td>\n                <td><INPUT type=\"Text\" name=\"fullname\" size=\"30\" value=\"\"></td>\n              </tr>\n            </table><br>\n            <INPUT type=\"Submit\" name=\"Enviar\" value=\"Enviar datos\">\n          </div>\n        </FORM>\n<table width=\"100%\" border=\"0\">\n\n          <tr> \n            <td colspan=\"3\" style=\"border-bottom:1px solid #003399;\"><div align=\"center\">&nbsp;</div></td>\n          </tr>\n          <tr> \n            <td colspan=\"3\"><div align=\"center\">&nbsp;</div></td>\n          </tr>		  \n          <tr> \n            <td width=\"7%\"><div align=\"right\">Para</div></td>\n            <td width=\"16%\" bgColor=\"#CC0000\"><div align=\"center\"><font color=\"#FFFFFF\"> \n                <strong><font size=\"1\">DARSE DE</font> BAIXA</strong></font></div></td>\n\n            <td width=\"77%\"><div align=\"left\">indique a s&uacute;a dirección de \n                correo electrónico (conta de <em>uvigo</em>)</div></td>\n          </tr>\n        </table>\n<FORM Method=POST ACTION=\"https://listas.uvigo.es/mailman/options/uvigotv\">\n<INPUT type=\"hidden\" name=\"login-unsub\" value=\"1\"><div align=\"center\">\n<table width=\"64%\" border=\"0\">\n  <tr><td width=\"40%\" align=\"right\"><strong>Correo Electrónico:</strong></td>\n    <td><INPUT type=\"Text\" name=\"email\" size=\"30\" value=\"\"></td>\n\n  </tr>\n</table><br>\n            <INPUT type=\"Submit\" name=\"Enviar\" value=\"Enviar datos\">\n          </div>\n        </FORM>\n',7,'es'),('Template para  lista','1',7,'en'),('Template para email_HTML','<table width=\"740\">\n<tbody>\n<tr>\n<td>\n\n<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"125\" width=\"740\">\n <tbody>\n  <tr>\n\n   <td align=\"left\" valign=\"bottom\">\n    <a href=\"http://tv.uvigo.es\" target=\"_self\">\n      <img src=\"%img1%\" height=\"109\" width=\"600\" />\n    </a>\n   </td>\n\n   <td align=\"left\" valign=\"bottom\">\n    <a href=\"http://uvigo.es\" target=\"_self\">\n     <img src=\"%img2%\" border=\"0\" height=\"88\" width=\"102\">\n    </a>\n   </td>\n  </tr>\n </tbody>\n</table>\n\n<table align=\"center\" border=\"0\" cellpadding=\"6\" cellspacing=\"0\" height=\"25\" width=\"740\">\n <tbody>\n  <tr>\n   <td style=\"font-size: 9px; font-weight: bold; color: #999999;\" align=\"right\" valign=\"top\">\n    uvigo-tv | recursos multimedia da universidade de vigo\n   </td>\n  </tr>\n </tbody>\n</table>\n\n<table align=\"center\" border=\"0\" cellpadding=\"6\" cellspacing=\"0\" height=\"25\" width=\"740\" style=\"padding: 5px; margin-top: 5px;\">\n <tbody>\n  <tr style=\"background-color: #f0f0ff;\">\n   <td align=\"left\" style=\"width:130px\" width=\"1%\">\n     <div id=\"pic\" style=\"width:130px\">\n       <a href=\"%title%\">\n         <img src=\"%img3%\" border=\"0\" height=\"106\" width=\"130\">\n       </a>\n     </div>\n   </td>\n   <td>\n     &nbsp;&nbsp;&nbsp;\n </td>\n   <td align=\"left\">\n      <div id=\"info\" style=\"margin-left: 5px;\" width:100%; text-align:left\">\n        <div id=\"title\">\n          <a href=\"%url%\">%title%</a>\n        </div>\n        <div id=\"line2\">%line2%</div>\n          <span id=\"date\" style=\"color: #990000; font-weight: bold;\">%date%</span>\n          <span id=\"number\" style=\"\">&nbsp;&nbsp;&nbsp;(%number%) </span>\n        </div>\n      </div>\n     </td>\n  </tr>\n\n  <tr>\n   <td colspan=\"3\">&nbsp;\n   </td>\n  </tr>\n  <tr>\n   <td colspan=\"3\" align=\"left\">\n\n<p>\nCorreo para anunciar o v&iacute;deo: \"%title%\". M&aacute;is informaci&oacute;n en:\n<a href=\"%url%\">link</a>\n</p>\n\n<p>\nUn saudo\n</p>\n\n<p style=\"font-size: 9px; font-weight: bold; color: #999999;\">\nUvigoTv\n</p>\n     </td>\n  </tr>\n </tbody>\n</table>\n\n   </td>\n  </tr>\n </tbody>\n</table>\n\n',10,'gl'),('Template para email_HTML','<table width=\"740\">\n<tbody>\n<tr>\n<td>\n\n<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"125\" width=\"740\">\n <tbody>\n  <tr>\n\n   <td align=\"left\" valign=\"bottom\">\n    <a href=\"http://tv.uvigo.es\" target=\"_self\">\n      <img src=\"%img1%\" height=\"109\" width=\"600\" />\n    </a>\n   </td>\n\n   <td align=\"left\" valign=\"bottom\">\n    <a href=\"http://uvigo.es\" target=\"_self\">\n     <img src=\"%img2%\" border=\"0\" height=\"88\" width=\"102\">\n    </a>\n   </td>\n  </tr>\n </tbody>\n</table>\n\n<table align=\"center\" border=\"0\" cellpadding=\"6\" cellspacing=\"0\" height=\"25\" width=\"740\">\n <tbody>\n  <tr>\n   <td style=\"font-size: 9px; font-weight: bold; color: #999999;\" align=\"right\" valign=\"top\">\n    uvigo-tv | recursos multimedia de la universidad de vigo\n   </td>\n  </tr>\n </tbody>\n</table>\n\n<table align=\"center\" border=\"0\" cellpadding=\"6\" cellspacing=\"0\" height=\"25\" width=\"740\" style=\"padding: 5px; margin-top: 5px;\">\n <tbody>\n  <tr style=\"background-color: #f0f0ff;\">\n   <td align=\"left\" style=\"width:130px\" width=\"1%\">\n     <div id=\"pic\" style=\"width:130px\">\n       <a href=\"%url%\">\n         <img src=\"%img3%\" border=\"0\" height=\"106\" width=\"130\">\n       </a>\n     </div>\n   </td>\n   <td>\n  &nbsp;&nbsp;&nbsp;\n   </td>\n   <td align=\"left\">\n      <div id=\"info\" style=\"margin-left: 5px;\" width:100%; text-align:left\">\n        <div id=\"title\">\n          <a href=\"%url%\">%title%</a>\n        </div>\n        <div id=\"line2\">%line2%</div>\n          <span id=\"date\" style=\"color: #990000; font-weight: bold;\">%date%</span>\n          <span id=\"number\" style=\"\">&nbsp;&nbsp;&nbsp;(%number%) </span>\n        </div>\n      </div>\n     </td>\n  </tr>\n<tr>\n   <td colspan=\"3\">&nbsp;\n   </td>\n  </tr>\n  <tr>\n   <td colspan=\"3\" align=\"left\">\n\n<p>\nCorreo para anunciar el v&iacute;deo: \"%title%\". Mas informaci&oacute;n en:\n<a href=\"%title%\">link</a>\n</p>\n\n<p>\nUn saludo\n</p>\n\n<p style=\"font-size: 9px; font-weight: bold; color: #999999;\">\nUvigoTv\n</p>\n     </td>\n  </tr>\n </tbody>\n</table>\n\n   </td>\n  </tr>\n </tbody>\n</table>\n',10,'es'),('Template para email_HTML','1',10,'en'),('Template para email_TXT','UVigo-Tv | Recursos multimedia da Universidade de Vigo\n\nCorreo para anunciar o v?deo: \"%title%\". Máis información en: %url%\n\nUn saudo.',11,'gl'),('Template para email_TXT','UVigo-TV | Recursos multimedia de la Universidad de Vigo\n\nCorreo para anunciar el v?deo: \"%title%\". Más información en: %url%\n\n\nUn saludo.',11,'es'),('Template para email_TXT','1',11,'en'),('Template para  layout','/*LAYOUT CSS*/\nbody{\n  font-family: \"Trebuchet MS\";\n  font-size: 11px;\n  font-style: normal;\n  line-height: normal;\n  font-weight: normal;\n  font-variant: normal;\n  text-transform: none;\n  color: #333333;\n  text-decoration: none;\n}\n\nbody #content{\n  width: 740px;\n  margin: 0px auto;\n}\n\nbody #body{\n  margin-top: 10px;\n  margin-bottom: 10px;\n}\n\nbody #slidebar, #indexbar_left{\n  float: left;\n  width: 21%;\n}\n\nbody #indexbar_right{\n  float: right;\n  width: 21%;\n}\n\nbody #index_body{\n  margin: 0px 23% 0px 23%;\n}\n\nbody #other_body{\n  margin: 0px 0px 0px 23%;\n}\n\ndiv.widget_Slidebar, div.widget_IndexbarRight, div.widget_IndexbarLeft{\n  width: 100%;\n  margin-bottom: 1em;\n  float: left;\n  font-size: 13px;\n  text-align: center;\n}\n\ndiv.index_widget{\n        margin: 1em 0em;\n}',8,'css'),('Template para  style','#header .grisnegrita, #footer .grisnegrita {\n  font-family: \"Trebuchet MS\";\n  font-size: 9px;\n  font-style: normal;\n  line-height: normal;\n  font-weight: bold;\n  font-variant: normal;\n  text-transform: none;\n  color: #999999;\n  text-decoration: none;\n}\n\ndiv#index_body h1, div#other_body h1 {\n  background:transparent url(/uploads/uvigo/h1.gif) no-repeat scroll left 4px;\n  font-size:22px;\n  font-weight:bold;\n  margin:0px 0px 22px;\n  padding-left:65px;   \n}\n\nh2#index_announce_es{\n  background: url(\'/uploads/uvigo/h2s/novidvideotec.es.gif\') left top no-repeat;\n  text-indent: -9999px;\n  border-bottom: 1px solid #039;\n  height: 19px;\n}\n\n\nh2#index_announce_gl{\n  background: url(\'/uploads/uvigo/h2s/novidvideotec.gif\') left top no-repeat;\n  text-indent: -9999px;\n  border-bottom: 1px solid #039;\n  height: 19px;\n}\n\nh2#reco_es{\n  background: url(\'/uploads/uvigo/h2s/recomendacion.es.gif\') left top no-repeat;\n  text-indent: -9999px;\n  border-bottom: 1px solid #039;\n  height: 19px;\n}\n\n\nh2#reco_gl{\n  background: url(\'/uploads/uvigo/h2s/recomendacion.gif\') left top no-repeat;\n  text-indent: -9999px;\n  border-bottom: 1px solid #039;\n  height: 19px;\n}\n\nh2#index_notices_es, h2#notices_es{\n  background: url(\'/uploads/uvigo/h2s/novasuvtv.es.gif\') left top no-repeat;\n  text-indent: -9999px;\n  border-bottom: 1px solid #039;\n  height: 19px;\n}\n\n\nh2#index_notices_gl, h2#notices_gl{\n  background: url(\'/uploads/uvigo/h2s/novasuvtv.gif\') left top no-repeat;\n  text-indent: -9999px;\n  border-bottom: 1px solid #039;\n  height: 19px;\n}\n\n\nh2#index_index_es{\n  background: url(\'/uploads/uvigo/h2s/queuvtv.es.gif\') left top no-repeat;\n  text-indent: -9999px;\n  border-bottom: 1px solid #039;\n  height: 19px;\n}\n\n\nh2#index_index_gl{\n  background: url(\'/uploads/uvigo/h2s/queuvtv.gif\') left top no-repeat;\n  text-indent: -9999px;\n  border-bottom: 1px solid #039;\n  height: 19px;\n}\n\n\nh2#serv_desc_es{\n  background: url(\'/uploads/uvigo/h2s/descripcion.gif\') left top no-repeat;\n  text-indent: -9999px;\n  border-bottom: 1px solid #039;\n  height: 19px;\n}\n\n\nh2#serv_desc_gl{\n  background: url(\'/uploads/uvigo/h2s/descricion.gif\') left top no-repeat;\n  text-indent: -9999px;\n  border-bottom: 1px solid #039;\n  height: 19px;\n}\n\n\nh2#serv_soli_es{\n  background: url(\'/uploads/uvigo/h2s/solicitudes.gif\') left top no-repeat;\n  text-indent: -9999px;\n  border-bottom: 1px solid #039;\n  height: 19px;\n}\n\n\nh2#serv_soli_gl{\n  background: url(\'/uploads/uvigo/h2s/solicitudes.gif\') left top no-repeat;\n  text-indent: -9999px;\n  border-bottom: 1px solid #039;\n  height: 19px;\n}\n\nh2#faq_es{\n  background: url(\'/uploads/uvigo/h2s/faq.gif\') left top no-repeat;\n  text-indent: -9999px;\n  border-bottom: 1px solid #039;\n  height: 19px;\n}\n\nh2#faq_gl{\n  background: url(\'/uploads/uvigo/h2s/faq.gif\') left top no-repeat;\n  text-indent: -9999px;\n  border-bottom: 1px solid #039;\n  height: 19px;\n}\n\n\nh2#annouce_es{\n  background: url(\'/uploads/uvigo/h2s/novosvideos.es.gif\') left top no-repeat;\n  text-indent: -9999px;\n  border-bottom: 1px solid #039;\n  height: 19px;\n}\n\nh2#annouce_gl{\n  background: url(\'/uploads/uvigo/h2s/novosvideos.gif\') left top no-repeat;\n  text-indent: -9999px;\n  border-bottom: 1px solid #039;\n  height: 19px;\n}\n\n\nh2#library_es{\n  background: url(\'/uploads/uvigo/h2s/catalogo.gif\') left top no-repeat;\n  text-indent: -9999px;\n  border-bottom: 1px solid #039;\n  height: 19px;\n}\n\nh2#library_gl{\n  background: url(\'/uploads/uvigo/h2s/catalogo.gif\') left top no-repeat;\n  text-indent: -9999px;\n  border-bottom: 1px solid #039;\n  height: 19px;\n}\n\nh2#nada{\n  background: url(\'/uploads/uvigo/h2s/nada.gif\') left top no-repeat;\n  color: #fff;\n  border-bottom: 1px solid #039;\n  text-transform: uppercase;\n  font-size: 14px !important;\n  padding-left: 2px;\n  height: 19px;\n  font-weight: lighter;\n}\n',9,'css'),('Template de usuario','<h1 id=\"info_h1\">Contacto</h1>\n\n<p align=\"justify\">&nbsp;&nbsp;&nbsp;&nbsp;El contacto \n          con los responsables de Uvigo-TV podr&aacute; realizarse a trav&eacute;s \n          de las seguintes v&iacute;as:</p>\n        <table width=\"40%\" border=\"0\" align=\"center\">\n          <tr bgcolor=\"#F0F0FF\"> \n            <td valign=\"top\"> <div align=\"right\"><strong>Direcci&oacute;n&nbsp;</strong></div></td>\n\n            <td><div align=\"center\"><font size=\"2\">S</font>ERVICIOS<font size=\"2\"> \n                I</font>NFORM&Aacute;TICOS<br>\n                Edificio Biblioteca Central<br>\n                Campus Universitario<br>\n                (36310) Vigo </div></td>\n\n          </tr>\n          <tr bgcolor=\"#DFDFFF\"> \n            <td width=\"29%\" valign=\"top\"> <div align=\"right\"><strong>Correo-e&nbsp;</strong></div></td>\n            <td width=\"71%\"><div align=\"center\">tv@uvigo.es</div></td>\n          </tr>\n          <tr bgcolor=\"#F0F0FF\"> \n            <td valign=\"top\"> <div align=\"right\"><strong>Tel&eacute;fono&nbsp;</strong></div></td>\n\n            <td><div align=\"center\">986 8<strong>11 937</strong><br>\n                647 3<strong>43 021</strong></div></td>\n          </tr>\n        </table>\n        <br>\n       <h2 id=\"reco_es\">Recomendaciones</h2>\n        <p align=\"justify\">&nbsp;&nbsp;&nbsp;&nbsp;Para facilitar el correcto \n          desarrollo de los servicios prestados por el grupo de Uvigo-TV se agradecer&aacute; \n          a los usuarios que quieran solicitarlos:</p>\n        <ul>\n          <li> \n            <div align=\"justify\"> Describir con exactitud el tipo de servicio \n              deseado, haciendo constar los datos de la persona de contacto, su \n              n&uacute;mero de tel&eacute;fono y su correo electr&oacute;nico.<br>\n\n            </div>\n          </li>\n          <li> \n            <div align=\"justify\"> Hacer la solicitud del servicio con la mayor \n              antelaci&oacute;n posible, especialmente en aquellos casos en los \n              que no se disponga de una conexi&oacute;n previamente probada en \n              servicios realizados con anterioridad por el grupo de Uvigo-TV, \n              ya que este es un punto cr&iacute;tico para las transmisiones en \n              directo y para las reuniones punto a punto y multipunto.</div>\n          </li>\n        </ul>\n\n',12,'gl'),('Template de usuario','<h1 id=\"info_h1\">Contacto</h1>\n\n<p align=\"justify\">&nbsp;&nbsp;&nbsp;&nbsp; \n          O contacto cos responsables de Uvigo-TV poder&aacute; realizarse a trav&eacute;s \n          das seguintes v&iacute;as:</p>\n        <table width=\"40%\" border=\"0\" align=\"center\">\n          <tr bgcolor=\"#F0F0FF\"> \n            <td valign=\"top\"> <div align=\"right\"><strong>Enderezo&nbsp;</strong></div></td>\n\n            <td><div align=\"center\"><font size=\"2\">S</font>ERVIZOS<font size=\"2\"> \n                I</font>NFORM&Aacute;TICOS<br>\n                Edifizo Biblioteca Central<br>\n                Campus Universitario<br>\n                (36310) Vigo </div></td>\n\n          </tr>\n          <tr bgcolor=\"#DFDFFF\"> \n            <td width=\"29%\" valign=\"top\"> <div align=\"right\"><strong>Correo-e&nbsp;</strong></div></td>\n            <td width=\"71%\"><div align=\"center\">tv@uvigo.es</div></td>\n          </tr>\n          <tr bgcolor=\"#F0F0FF\"> \n            <td valign=\"top\"> <div align=\"right\"><strong>Tel&eacute;fono&nbsp;</strong></div></td>\n\n            <td><div align=\"center\">986 8<strong>11 937</strong><br>\n                647 3<strong>43 021</strong></div></td>\n          </tr>\n        </table>\n        <br>\n       <h2 id=\"reco_gl\">Recomendaci&oacute;ns</h2>\n        <p align=\"justify\">&nbsp;&nbsp;&nbsp;&nbsp;Para facilitar o correcto desenvolvemento \n          dos servizos prestados polo grupo de Uvigo-TV agrad&eacute;ceselle &oacute;s \n          usuarios que queiran solicitalos:</p>\n        <ul>\n          <li> \n            <div align=\"justify\"> Describir con exactitude o tipo de servizo desexado, \n              facendo constar os datos da persona de contacto, o seu n&uacute;mero \n              de tel&eacute;fono e o seu correo electr&oacute;nico.<br>\n\n            </div>\n          </li>\n          <li> \n            <div align=\"justify\"> Facer a solicitude do servizo coa maior antelaci&oacute;n \n              posible, especialmente naqueles casos nos que non se dispo&ntilde;a \n              dunha conexi&oacute;n previamente probada en servizos realizados \n              con anterioridad polo grupo de Uvigo-TV, xa que este &eacute; un \n              punto cr&iacute;tico para as transmisi&oacute;ns en directo e para \n              as reuni&oacute;ns punto a punto e multipunto.</div>\n\n          </li>\n        </ul>	\n\n\n',12,'es'),('User template',NULL,12,'en');
UNLOCK TABLES;
/*!40000 ALTER TABLE `template_i18n` ENABLE KEYS */;

--
-- Table structure for table `element_widget`
--

DROP TABLE IF EXISTS `element_widget`;
CREATE TABLE `element_widget` (
  `bar_widget_id` int(11) NOT NULL,
  `widget_id` int(11) NOT NULL,
  `rank` int(11) NOT NULL default '0',
  PRIMARY KEY  (`bar_widget_id`,`widget_id`),
  KEY `element_widget_FI_2` (`widget_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `element_widget`
--


/*!40000 ALTER TABLE `element_widget` DISABLE KEYS */;
LOCK TABLES `element_widget` WRITE;
INSERT INTO `element_widget` VALUES (1,1,1),(2,3,1),(3,6,2),(3,13,5),(3,7,3),(3,10,4),(5,6,2),(5,8,3),(5,7,4),(4,12,2),(4,20,3),(4,18,4),(6,21,1),(6,22,2),(6,24,3),(3,4,1),(4,5,1),(4,19,5),(5,4,1);
UNLOCK TABLES;
/*!40000 ALTER TABLE `element_widget` ENABLE KEYS */;















-----*****-----
-----*****-----
-----*****-----
/* Falata pasar broadcat para mm*/
/* Falta quitar working de serie*/
