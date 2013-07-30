
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- notice
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `notice`;


CREATE TABLE `notice`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`date` DATE  NOT NULL,
	`working` INTEGER default 1 NOT NULL,
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- notice_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `notice_i18n`;


CREATE TABLE `notice_i18n`
(
	`text` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `notice_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `notice` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- mat_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mat_type`;


CREATE TABLE `mat_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`type` CHAR(3)  NOT NULL,
	`default_sel` INTEGER default 0 NOT NULL,
	`mime_type` VARCHAR(40)  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `mat_type_type_unique` (`type`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- mat_type_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mat_type_i18n`;


CREATE TABLE `mat_type_i18n`
(
	`name` VARCHAR(25)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `mat_type_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `mat_type` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- serial_template
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `serial_template`;


CREATE TABLE `serial_template`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(25)  NOT NULL,
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- serial_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `serial_type`;


CREATE TABLE `serial_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`cod` CHAR(2),
	`default_sel` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- serial_type_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `serial_type_i18n`;


CREATE TABLE `serial_type_i18n`
(
	`name` VARCHAR(100)  NOT NULL,
	`description` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `serial_type_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `serial_type` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- broadcast_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `broadcast_type`;


CREATE TABLE `broadcast_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(15),
	`default_sel` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- broadcast
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `broadcast`;


CREATE TABLE `broadcast`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` CHAR(100)  NOT NULL,
	`broadcast_type_id` INTEGER,
	`passwd` CHAR(15)  NOT NULL,
	`default_sel` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `broadcast_FI_1` (`broadcast_type_id`),
	CONSTRAINT `broadcast_FK_1`
		FOREIGN KEY (`broadcast_type_id`)
		REFERENCES `broadcast_type` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- broadcast_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `broadcast_i18n`;


CREATE TABLE `broadcast_i18n`
(
	`description` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `broadcast_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `broadcast` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- genre
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `genre`;


CREATE TABLE `genre`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`cod` CHAR(2),
	`default_sel` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- genre_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `genre_i18n`;


CREATE TABLE `genre_i18n`
(
	`name` VARCHAR(100)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `genre_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `genre` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- ground
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `ground`;


CREATE TABLE `ground`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`cod` VARCHAR(25)  NOT NULL,
	`ground_type_id` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `ground_cod_unique` (`cod`),
	INDEX `ground_FI_1` (`ground_type_id`),
	CONSTRAINT `ground_FK_1`
		FOREIGN KEY (`ground_type_id`)
		REFERENCES `ground_type` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- ground_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `ground_i18n`;


CREATE TABLE `ground_i18n`
(
	`name` VARCHAR(100)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `ground_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `ground` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- ground_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `ground_type`;


CREATE TABLE `ground_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100)  NOT NULL,
	`display` INTEGER default 1 NOT NULL,
	`rank` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `ground_type_name_unique` (`name`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- ground_type_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `ground_type_i18n`;


CREATE TABLE `ground_type_i18n`
(
	`description` VARCHAR(100)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `ground_type_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `ground_type` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- relation_ground
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `relation_ground`;


CREATE TABLE `relation_ground`
(
	`one_id` INTEGER  NOT NULL,
	`two_id` INTEGER  NOT NULL,
	PRIMARY KEY (`one_id`,`two_id`),
	CONSTRAINT `relation_ground_FK_1`
		FOREIGN KEY (`one_id`)
		REFERENCES `ground` (`id`)
		ON DELETE CASCADE,
	INDEX `relation_ground_FI_2` (`two_id`),
	CONSTRAINT `relation_ground_FK_2`
		FOREIGN KEY (`two_id`)
		REFERENCES `ground` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- virtual_ground
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `virtual_ground`;


CREATE TABLE `virtual_ground`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`cod` VARCHAR(25)  NOT NULL,
	`display` INTEGER default 1 NOT NULL,
	`rank` INTEGER default 0 NOT NULL,
	`description` TEXT,
	`img` VARCHAR(100)  NOT NULL,
	`editorial1` INTEGER default 0 NOT NULL,
	`editorial2` INTEGER default 0 NOT NULL,
	`editorial3` INTEGER default 0 NOT NULL,
	`other` INTEGER default 0 NOT NULL,
	`ground_type_id` INTEGER,
	PRIMARY KEY (`id`),
	INDEX `virtual_ground_FI_1` (`ground_type_id`),
	CONSTRAINT `virtual_ground_FK_1`
		FOREIGN KEY (`ground_type_id`)
		REFERENCES `ground_type` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- virtual_ground_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `virtual_ground_i18n`;


CREATE TABLE `virtual_ground_i18n`
(
	`name` VARCHAR(100)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `virtual_ground_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `virtual_ground` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- virtual_ground_relation
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `virtual_ground_relation`;


CREATE TABLE `virtual_ground_relation`
(
	`virtual_ground_id` INTEGER  NOT NULL,
	`category_id` INTEGER  NOT NULL,
	`enable` INTEGER default 1 NOT NULL,
	PRIMARY KEY (`virtual_ground_id`,`category_id`),
	CONSTRAINT `virtual_ground_relation_FK_1`
		FOREIGN KEY (`virtual_ground_id`)
		REFERENCES `virtual_ground` (`id`)
		ON DELETE CASCADE,
	INDEX `virtual_ground_relation_FI_2` (`category_id`),
	CONSTRAINT `virtual_ground_relation_FK_2`
		FOREIGN KEY (`category_id`)
		REFERENCES `category` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- language
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `language`;


CREATE TABLE `language`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`cod` CHAR(2)  NOT NULL,
	`default_sel` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `language_cod_unique` (`cod`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- language_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `language_i18n`;


CREATE TABLE `language_i18n`
(
	`name` VARCHAR(30)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `language_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `language` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- role
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `role`;


CREATE TABLE `role`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`cod` CHAR(5)  NOT NULL,
	`rank` INTEGER default 0 NOT NULL,
	`xml` CHAR(25)  NOT NULL,
	`display` INTEGER default 1 NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `role_cod_unique` (`cod`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- role_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `role_i18n`;


CREATE TABLE `role_i18n`
(
	`name` VARCHAR(25)  NOT NULL,
	`text` VARCHAR(25)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `role_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `role` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- format
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `format`;


CREATE TABLE `format`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(35),
	`default_sel` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- codec
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `codec`;


CREATE TABLE `codec`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(15),
	`default_sel` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- mime_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mime_type`;


CREATE TABLE `mime_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(25)  NOT NULL,
	`type` VARCHAR(25),
	`default_sel` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- resolution
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `resolution`;


CREATE TABLE `resolution`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`hor` INTEGER default 0 NOT NULL,
	`ver` INTEGER default 0 NOT NULL,
	`default_sel` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- person
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `person`;


CREATE TABLE `person`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100)  NOT NULL,
	`email` VARCHAR(30),
	`web` VARCHAR(150),
	`phone` VARCHAR(30),
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- person_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `person_i18n`;


CREATE TABLE `person_i18n`
(
	`honorific` VARCHAR(20),
	`firm` VARCHAR(100),
	`post` VARCHAR(200),
	`bio` VARCHAR(200),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `person_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `person` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- place
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `place`;


CREATE TABLE `place`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`coorgeo` VARCHAR(50),
	`cod` VARCHAR(10),
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- place_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `place_i18n`;


CREATE TABLE `place_i18n`
(
	`name` VARCHAR(100)  NOT NULL,
	`address` VARCHAR(100)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `place_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `place` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- precinct
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `precinct`;


CREATE TABLE `precinct`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`place_id` INTEGER,
	`default_sel` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `precinct_FI_1` (`place_id`),
	CONSTRAINT `precinct_FK_1`
		FOREIGN KEY (`place_id`)
		REFERENCES `place` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- precinct_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `precinct_i18n`;


CREATE TABLE `precinct_i18n`
(
	`name` VARCHAR(100)  NOT NULL,
	`equipment` VARCHAR(100)  NOT NULL,
	`comment` VARCHAR(200)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `precinct_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `precinct` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- serial
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `serial`;


CREATE TABLE `serial`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`announce` INTEGER default 0 NOT NULL,
	`display` INTEGER default 1 NOT NULL,
	`mail` INTEGER default 0 NOT NULL,
	`copyright` VARCHAR(30) default 'Uvigo-Tv' NOT NULL,
	`serial_type_id` INTEGER,
	`serial_template_id` INTEGER,
	`publicDate` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `serial_FI_1` (`serial_type_id`),
	CONSTRAINT `serial_FK_1`
		FOREIGN KEY (`serial_type_id`)
		REFERENCES `serial_type` (`id`),
	INDEX `serial_FI_2` (`serial_template_id`),
	CONSTRAINT `serial_FK_2`
		FOREIGN KEY (`serial_template_id`)
		REFERENCES `serial_template` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- serial_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `serial_i18n`;


CREATE TABLE `serial_i18n`
(
	`title` VARCHAR(100)  NOT NULL,
	`subtitle` VARCHAR(100)  NOT NULL,
	`keyword` VARCHAR(100)  NOT NULL,
	`description` TEXT,
	`header` TEXT,
	`footer` TEXT,
	`line2` VARCHAR(150)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `serial_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `serial` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- serial_itunes
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `serial_itunes`;


CREATE TABLE `serial_itunes`
(
	`serial_id` INTEGER  NOT NULL,
	`itunes_id` VARCHAR(30)  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (`id`),
	INDEX `serial_itunes_FI_1` (`serial_id`),
	CONSTRAINT `serial_itunes_FK_1`
		FOREIGN KEY (`serial_id`)
		REFERENCES `serial` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- mm
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mm`;


CREATE TABLE `mm`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`subserial` INTEGER default 0 NOT NULL,
	`announce` INTEGER default 0 NOT NULL,
	`mail` INTEGER default 0 NOT NULL,
	`serial_id` INTEGER  NOT NULL,
	`rank` INTEGER default 0 NOT NULL,
	`precinct_id` INTEGER,
	`genre_id` INTEGER,
	`broadcast_id` INTEGER,
	`copyright` VARCHAR(30)  NOT NULL,
	`status_id` INTEGER default 0 NOT NULL,
	`recordDate` DATETIME  NOT NULL,
	`publicDate` DATETIME  NOT NULL,
	`editorial1` INTEGER default 0 NOT NULL,
	`editorial2` INTEGER default 0 NOT NULL,
	`editorial3` INTEGER default 0 NOT NULL,
	`audio` INTEGER default 0 NOT NULL,
	`duration` INTEGER default 0 NOT NULL,
	`num_view` INTEGER default 0 NOT NULL,
	`comments` TEXT,
	PRIMARY KEY (`id`),
	INDEX `mm_FI_1` (`serial_id`),
	CONSTRAINT `mm_FK_1`
		FOREIGN KEY (`serial_id`)
		REFERENCES `serial` (`id`)
		ON DELETE CASCADE,
	INDEX `mm_FI_2` (`precinct_id`),
	CONSTRAINT `mm_FK_2`
		FOREIGN KEY (`precinct_id`)
		REFERENCES `precinct` (`id`),
	INDEX `mm_FI_3` (`genre_id`),
	CONSTRAINT `mm_FK_3`
		FOREIGN KEY (`genre_id`)
		REFERENCES `genre` (`id`),
	INDEX `mm_FI_4` (`broadcast_id`),
	CONSTRAINT `mm_FK_4`
		FOREIGN KEY (`broadcast_id`)
		REFERENCES `broadcast` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- mm_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mm_i18n`;


CREATE TABLE `mm_i18n`
(
	`title` VARCHAR(200)  NOT NULL,
	`subtitle` VARCHAR(150)  NOT NULL,
	`keyword` VARCHAR(100)  NOT NULL,
	`description` TEXT,
	`subserial_title` VARCHAR(150)  NOT NULL,
	`line2` VARCHAR(150)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `mm_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `mm` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- mm_template
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mm_template`;


CREATE TABLE `mm_template`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`subserial` INTEGER default 0 NOT NULL,
	`announce` INTEGER default 0 NOT NULL,
	`mail` INTEGER default 0 NOT NULL,
	`serial_id` INTEGER  NOT NULL,
	`rank` INTEGER default 0 NOT NULL,
	`precinct_id` INTEGER,
	`genre_id` INTEGER,
	`broadcast_id` INTEGER,
	`copyright` VARCHAR(30)  NOT NULL,
	`status_id` INTEGER default 0 NOT NULL,
	`recordDate` DATETIME  NOT NULL,
	`publicDate` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `mm_template_FI_1` (`serial_id`),
	CONSTRAINT `mm_template_FK_1`
		FOREIGN KEY (`serial_id`)
		REFERENCES `serial` (`id`)
		ON DELETE CASCADE,
	INDEX `mm_template_FI_2` (`precinct_id`),
	CONSTRAINT `mm_template_FK_2`
		FOREIGN KEY (`precinct_id`)
		REFERENCES `precinct` (`id`),
	INDEX `mm_template_FI_3` (`genre_id`),
	CONSTRAINT `mm_template_FK_3`
		FOREIGN KEY (`genre_id`)
		REFERENCES `genre` (`id`),
	INDEX `mm_template_FI_4` (`broadcast_id`),
	CONSTRAINT `mm_template_FK_4`
		FOREIGN KEY (`broadcast_id`)
		REFERENCES `broadcast` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- mm_template_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mm_template_i18n`;


CREATE TABLE `mm_template_i18n`
(
	`title` VARCHAR(200)  NOT NULL,
	`subtitle` VARCHAR(150)  NOT NULL,
	`keyword` VARCHAR(100)  NOT NULL,
	`description` TEXT,
	`subserial_title` VARCHAR(150)  NOT NULL,
	`line2` VARCHAR(150)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `mm_template_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `mm_template` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- file
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `file`;


CREATE TABLE `file`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`mm_id` INTEGER  NOT NULL,
	`perfil_id` INTEGER,
	`language_id` INTEGER,
	`url` VARCHAR(250)  NOT NULL,
	`file` VARCHAR(250)  NOT NULL,
	`format_id` INTEGER,
	`codec_id` INTEGER,
	`mime_type_id` INTEGER,
	`resolution_id` INTEGER,
	`bitrate` VARCHAR(50)  NOT NULL,
	`framerate` INTEGER default 25 NOT NULL,
	`channels` INTEGER default 1 NOT NULL,
	`audio` INTEGER default 0 NOT NULL,
	`rank` INTEGER default 1 NOT NULL,
	`duration` INTEGER default 0 NOT NULL,
	`num_view` INTEGER default 0 NOT NULL,
	`punt_sum` INTEGER default 0 NOT NULL,
	`punt_num` INTEGER default 0 NOT NULL,
	`size` BIGINT default 0 NOT NULL,
	`resolution_hor` INTEGER default 0 NOT NULL,
	`resolution_ver` INTEGER default 0 NOT NULL,
	`display` INTEGER default 1 NOT NULL,
	`download` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `file_FI_1` (`mm_id`),
	CONSTRAINT `file_FK_1`
		FOREIGN KEY (`mm_id`)
		REFERENCES `mm` (`id`)
		ON DELETE CASCADE,
	INDEX `file_FI_2` (`perfil_id`),
	CONSTRAINT `file_FK_2`
		FOREIGN KEY (`perfil_id`)
		REFERENCES `perfil` (`id`),
	INDEX `file_FI_3` (`language_id`),
	CONSTRAINT `file_FK_3`
		FOREIGN KEY (`language_id`)
		REFERENCES `language` (`id`),
	INDEX `file_FI_4` (`format_id`),
	CONSTRAINT `file_FK_4`
		FOREIGN KEY (`format_id`)
		REFERENCES `format` (`id`),
	INDEX `file_FI_5` (`codec_id`),
	CONSTRAINT `file_FK_5`
		FOREIGN KEY (`codec_id`)
		REFERENCES `codec` (`id`),
	INDEX `file_FI_6` (`mime_type_id`),
	CONSTRAINT `file_FK_6`
		FOREIGN KEY (`mime_type_id`)
		REFERENCES `mime_type` (`id`),
	INDEX `file_FI_7` (`resolution_id`),
	CONSTRAINT `file_FK_7`
		FOREIGN KEY (`resolution_id`)
		REFERENCES `resolution` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- file_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `file_i18n`;


CREATE TABLE `file_i18n`
(
	`description` VARCHAR(200)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `file_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `file` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- link
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `link`;


CREATE TABLE `link`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`mm_id` INTEGER  NOT NULL,
	`url` VARCHAR(250)  NOT NULL,
	`rank` INTEGER default 1 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `link_FI_1` (`mm_id`),
	CONSTRAINT `link_FK_1`
		FOREIGN KEY (`mm_id`)
		REFERENCES `mm` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- link_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `link_i18n`;


CREATE TABLE `link_i18n`
(
	`name` VARCHAR(200)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `link_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `link` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- mm_person
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mm_person`;


CREATE TABLE `mm_person`
(
	`mm_id` INTEGER  NOT NULL,
	`person_id` INTEGER  NOT NULL,
	`role_id` INTEGER default 1 NOT NULL,
	`rank` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`mm_id`,`person_id`,`role_id`),
	CONSTRAINT `mm_person_FK_1`
		FOREIGN KEY (`mm_id`)
		REFERENCES `mm` (`id`)
		ON DELETE CASCADE,
	INDEX `mm_person_FI_2` (`person_id`),
	CONSTRAINT `mm_person_FK_2`
		FOREIGN KEY (`person_id`)
		REFERENCES `person` (`id`)
		ON DELETE CASCADE,
	INDEX `mm_person_FI_3` (`role_id`),
	CONSTRAINT `mm_person_FK_3`
		FOREIGN KEY (`role_id`)
		REFERENCES `role` (`id`)
		ON DELETE SET DEFAULT
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- mm_template_person
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mm_template_person`;


CREATE TABLE `mm_template_person`
(
	`mm_template_id` INTEGER  NOT NULL,
	`person_id` INTEGER  NOT NULL,
	`role_id` INTEGER default 1 NOT NULL,
	`rank` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`mm_template_id`,`person_id`,`role_id`),
	CONSTRAINT `mm_template_person_FK_1`
		FOREIGN KEY (`mm_template_id`)
		REFERENCES `mm_template` (`id`)
		ON DELETE CASCADE,
	INDEX `mm_template_person_FI_2` (`person_id`),
	CONSTRAINT `mm_template_person_FK_2`
		FOREIGN KEY (`person_id`)
		REFERENCES `person` (`id`)
		ON DELETE CASCADE,
	INDEX `mm_template_person_FI_3` (`role_id`),
	CONSTRAINT `mm_template_person_FK_3`
		FOREIGN KEY (`role_id`)
		REFERENCES `role` (`id`)
		ON DELETE SET DEFAULT
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- pic
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `pic`;


CREATE TABLE `pic`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`url` VARCHAR(250)  NOT NULL,
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- pic_person
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `pic_person`;


CREATE TABLE `pic_person`
(
	`pic_id` INTEGER  NOT NULL,
	`other_id` INTEGER  NOT NULL,
	`rank` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`pic_id`,`other_id`),
	CONSTRAINT `pic_person_FK_1`
		FOREIGN KEY (`pic_id`)
		REFERENCES `pic` (`id`)
		ON DELETE CASCADE,
	INDEX `pic_person_FI_2` (`other_id`),
	CONSTRAINT `pic_person_FK_2`
		FOREIGN KEY (`other_id`)
		REFERENCES `person` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- pic_serial
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `pic_serial`;


CREATE TABLE `pic_serial`
(
	`pic_id` INTEGER  NOT NULL,
	`other_id` INTEGER  NOT NULL,
	`rank` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`pic_id`,`other_id`),
	CONSTRAINT `pic_serial_FK_1`
		FOREIGN KEY (`pic_id`)
		REFERENCES `pic` (`id`)
		ON DELETE CASCADE,
	INDEX `pic_serial_FI_2` (`other_id`),
	CONSTRAINT `pic_serial_FK_2`
		FOREIGN KEY (`other_id`)
		REFERENCES `serial` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- pic_mm
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `pic_mm`;


CREATE TABLE `pic_mm`
(
	`pic_id` INTEGER  NOT NULL,
	`other_id` INTEGER  NOT NULL,
	`rank` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`pic_id`,`other_id`),
	CONSTRAINT `pic_mm_FK_1`
		FOREIGN KEY (`pic_id`)
		REFERENCES `pic` (`id`)
		ON DELETE CASCADE,
	INDEX `pic_mm_FI_2` (`other_id`),
	CONSTRAINT `pic_mm_FK_2`
		FOREIGN KEY (`other_id`)
		REFERENCES `mm` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- ground_mm
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `ground_mm`;


CREATE TABLE `ground_mm`
(
	`ground_id` INTEGER  NOT NULL,
	`mm_id` INTEGER  NOT NULL,
	`rank` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`ground_id`,`mm_id`),
	CONSTRAINT `ground_mm_FK_1`
		FOREIGN KEY (`ground_id`)
		REFERENCES `ground` (`id`)
		ON DELETE CASCADE,
	INDEX `ground_mm_FI_2` (`mm_id`),
	CONSTRAINT `ground_mm_FK_2`
		FOREIGN KEY (`mm_id`)
		REFERENCES `mm` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- ground_mm_template
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `ground_mm_template`;


CREATE TABLE `ground_mm_template`
(
	`ground_id` INTEGER  NOT NULL,
	`mm_template_id` INTEGER  NOT NULL,
	`rank` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`ground_id`,`mm_template_id`),
	CONSTRAINT `ground_mm_template_FK_1`
		FOREIGN KEY (`ground_id`)
		REFERENCES `ground` (`id`)
		ON DELETE CASCADE,
	INDEX `ground_mm_template_FI_2` (`mm_template_id`),
	CONSTRAINT `ground_mm_template_FK_2`
		FOREIGN KEY (`mm_template_id`)
		REFERENCES `mm_template` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- material
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `material`;


CREATE TABLE `material`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`mm_id` INTEGER  NOT NULL,
	`url` VARCHAR(250)  NOT NULL,
	`rank` INTEGER default 1 NOT NULL,
	`mat_type_id` INTEGER,
	`display` INTEGER default 1 NOT NULL,
	`size` BIGINT default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `material_FI_1` (`mm_id`),
	CONSTRAINT `material_FK_1`
		FOREIGN KEY (`mm_id`)
		REFERENCES `mm` (`id`)
		ON DELETE CASCADE,
	INDEX `material_FI_2` (`mat_type_id`),
	CONSTRAINT `material_FK_2`
		FOREIGN KEY (`mat_type_id`)
		REFERENCES `mat_type` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- material_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `material_i18n`;


CREATE TABLE `material_i18n`
(
	`name` VARCHAR(100)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `material_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `material` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;


CREATE TABLE `user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`login` VARCHAR(100)  NOT NULL,
	`name` VARCHAR(250),
	`passwd` CHAR(8)  NOT NULL,
	`email` VARCHAR(30),
	`root` INTEGER default 1 NOT NULL,
	`user_type_id` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `user_name_unique` (`name`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- log_file
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `log_file`;


CREATE TABLE `log_file`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`file_id` INTEGER,
	`ip` VARCHAR(15)  NOT NULL,
	`navigator` VARCHAR(255)  NOT NULL,
	`referer` VARCHAR(255)  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `log_file_created_at_index`(`created_at`),
	INDEX `log_file_FI_1` (`file_id`),
	CONSTRAINT `log_file_FK_1`
		FOREIGN KEY (`file_id`)
		REFERENCES `file` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- log_email
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `log_email`;


CREATE TABLE `log_email`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`type` VARCHAR(15)  NOT NULL,
	`object_id` INTEGER  NOT NULL,
	`email` VARCHAR(60)  NOT NULL,
	`user_name` VARCHAR(250),
	`ip` VARCHAR(15)  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- log_transcoding
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `log_transcoding`;


CREATE TABLE `log_transcoding`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`mm_id` INTEGER  NOT NULL,
	`language_id` INTEGER,
	`perfil_id` INTEGER,
	`cpu_id` INTEGER,
	`url` VARCHAR(250)  NOT NULL,
	`status_id` INTEGER  NOT NULL,
	`priority` INTEGER  NOT NULL,
	`name` VARCHAR(150)  NOT NULL,
	`timeini` DATETIME  NOT NULL,
	`timestart` DATETIME  NOT NULL,
	`timeend` DATETIME  NOT NULL,
	`pid` INTEGER,
	`path_ini` VARCHAR(250)  NOT NULL,
	`path_end` VARCHAR(250)  NOT NULL,
	`ext_ini` CHAR(6)  NOT NULL,
	`ext_end` CHAR(6)  NOT NULL,
	`duration` INTEGER default 0 NOT NULL,
	`size` BIGINT default 0 NOT NULL,
	`email` VARCHAR(30),
	PRIMARY KEY (`id`),
	INDEX `log_transcoding_FI_1` (`mm_id`),
	CONSTRAINT `log_transcoding_FK_1`
		FOREIGN KEY (`mm_id`)
		REFERENCES `mm` (`id`)
		ON DELETE CASCADE,
	INDEX `log_transcoding_FI_2` (`language_id`),
	CONSTRAINT `log_transcoding_FK_2`
		FOREIGN KEY (`language_id`)
		REFERENCES `language` (`id`),
	INDEX `log_transcoding_FI_3` (`perfil_id`),
	CONSTRAINT `log_transcoding_FK_3`
		FOREIGN KEY (`perfil_id`)
		REFERENCES `perfil` (`id`),
	INDEX `log_transcoding_FI_4` (`cpu_id`),
	CONSTRAINT `log_transcoding_FK_4`
		FOREIGN KEY (`cpu_id`)
		REFERENCES `cpu` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- direct
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `direct`;


CREATE TABLE `direct`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`resolution_id` INTEGER,
	`url` VARCHAR(250)  NOT NULL,
	`passwd` CHAR(15)  NOT NULL,
	`direct_type_id` INTEGER,
	`resolution_hor` INTEGER default 0 NOT NULL,
	`resolution_ver` INTEGER default 0 NOT NULL,
	`calidades` VARCHAR(250)  NOT NULL,
	`ip_source` VARCHAR(100),
	`source_name` VARCHAR(100),
	`index_play` INTEGER default 0 NOT NULL,
	`broadcasting` INTEGER default 0 NOT NULL,
	`debug` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `direct_FI_1` (`resolution_id`),
	CONSTRAINT `direct_FK_1`
		FOREIGN KEY (`resolution_id`)
		REFERENCES `resolution` (`id`),
	INDEX `direct_FI_2` (`direct_type_id`),
	CONSTRAINT `direct_FK_2`
		FOREIGN KEY (`direct_type_id`)
		REFERENCES `direct_type` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- direct_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `direct_i18n`;


CREATE TABLE `direct_i18n`
(
	`name` VARCHAR(100)  NOT NULL,
	`description` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `direct_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `direct` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- direct_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `direct_type`;


CREATE TABLE `direct_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` CHAR(250),
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- widget
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `widget`;


CREATE TABLE `widget`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(25)  NOT NULL,
	`widget_type_id` INTEGER,
	`configurable` INTEGER default 1 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `widget_FI_1` (`widget_type_id`),
	CONSTRAINT `widget_FK_1`
		FOREIGN KEY (`widget_type_id`)
		REFERENCES `widget_type` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- widget_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `widget_i18n`;


CREATE TABLE `widget_i18n`
(
	`description` VARCHAR(255)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `widget_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `widget` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- widget_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `widget_type`;


CREATE TABLE `widget_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`type` VARCHAR(25),
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- bar_widget
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `bar_widget`;


CREATE TABLE `bar_widget`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(25)  NOT NULL,
	`widget_type_id` INTEGER,
	PRIMARY KEY (`id`),
	UNIQUE KEY `bar_widget_name_unique` (`name`),
	INDEX `bar_widget_FI_1` (`widget_type_id`),
	CONSTRAINT `bar_widget_FK_1`
		FOREIGN KEY (`widget_type_id`)
		REFERENCES `widget_type` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- element_widget
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `element_widget`;


CREATE TABLE `element_widget`
(
	`bar_widget_id` INTEGER  NOT NULL,
	`widget_id` INTEGER  NOT NULL,
	`rank` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`bar_widget_id`,`widget_id`),
	CONSTRAINT `element_widget_FK_1`
		FOREIGN KEY (`bar_widget_id`)
		REFERENCES `bar_widget` (`id`)
		ON DELETE CASCADE,
	INDEX `element_widget_FI_2` (`widget_id`),
	CONSTRAINT `element_widget_FK_2`
		FOREIGN KEY (`widget_id`)
		REFERENCES `widget` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- widget_template
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `widget_template`;


CREATE TABLE `widget_template`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`widget_id` INTEGER,
	`name` VARCHAR(25),
	PRIMARY KEY (`id`),
	UNIQUE KEY `widget_template_name_unique` (`name`),
	INDEX `widget_template_FI_1` (`widget_id`),
	CONSTRAINT `widget_template_FK_1`
		FOREIGN KEY (`widget_id`)
		REFERENCES `widget` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- widget_template_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `widget_template_i18n`;


CREATE TABLE `widget_template_i18n`
(
	`text` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `widget_template_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `widget_template` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- widget_constant
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `widget_constant`;


CREATE TABLE `widget_constant`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`widget_id` INTEGER,
	`name` VARCHAR(25),
	`text` VARCHAR(255),
	PRIMARY KEY (`id`),
	UNIQUE KEY `widget_constant_name_unique` (`name`),
	INDEX `widget_constant_FI_1` (`widget_id`),
	CONSTRAINT `widget_constant_FK_1`
		FOREIGN KEY (`widget_id`)
		REFERENCES `widget` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- widget_module
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `widget_module`;


CREATE TABLE `widget_module`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`widget_id` INTEGER,
	`module` VARCHAR(255),
	PRIMARY KEY (`id`),
	INDEX `widget_module_FI_1` (`widget_id`),
	CONSTRAINT `widget_module_FK_1`
		FOREIGN KEY (`widget_id`)
		REFERENCES `widget` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- channel
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `channel`;


CREATE TABLE `channel`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`pic` VARCHAR(250)  NOT NULL,
	`working` INTEGER default 1 NOT NULL,
	`sql` VARCHAR(250)  NOT NULL,
	`rank` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- channel_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `channel_i18n`;


CREATE TABLE `channel_i18n`
(
	`name` VARCHAR(25)  NOT NULL,
	`description` VARCHAR(255)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `channel_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `channel` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- template
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `template`;


CREATE TABLE `template`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100)  NOT NULL,
	`type` CHAR(3)  NOT NULL,
	`user` INTEGER default 1 NOT NULL,
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- template_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `template_i18n`;


CREATE TABLE `template_i18n`
(
	`description` VARCHAR(255)  NOT NULL,
	`text` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `template_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `template` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- perfil
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `perfil`;


CREATE TABLE `perfil`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(25)  NOT NULL,
	`rank` INTEGER default 1 NOT NULL,
	`display` INTEGER default 1 NOT NULL,
	`wizard` INTEGER default 1 NOT NULL,
	`master` INTEGER default 0 NOT NULL,
	`format` VARCHAR(35),
	`codec` VARCHAR(35),
	`mime_type` VARCHAR(35),
	`accepted_mime_type` VARCHAR(100),
	`extension` VARCHAR(6)  NOT NULL,
	`resolution_hor` INTEGER default 0 NOT NULL,
	`resolution_ver` INTEGER default 0 NOT NULL,
	`bitrate` VARCHAR(50)  NOT NULL,
	`framerate` INTEGER default 25 NOT NULL,
	`channels` INTEGER default 1 NOT NULL,
	`audio` INTEGER default 0 NOT NULL,
	`bat` TEXT  NOT NULL,
	`file_cfg` VARCHAR(150),
	`streamserver_id` INTEGER,
	`app` VARCHAR(50)  NOT NULL,
	`rel_duration_size` DOUBLE default 1,
	`rel_duration_trans` DOUBLE default 1,
	`prescript` TEXT,
	PRIMARY KEY (`id`),
	INDEX `perfil_FI_1` (`streamserver_id`),
	CONSTRAINT `perfil_FK_1`
		FOREIGN KEY (`streamserver_id`)
		REFERENCES `streamserver` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- perfil_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `perfil_i18n`;


CREATE TABLE `perfil_i18n`
(
	`link` VARCHAR(100)  NOT NULL,
	`description` VARCHAR(200)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `perfil_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `perfil` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- transcoding
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `transcoding`;


CREATE TABLE `transcoding`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`mm_id` INTEGER  NOT NULL,
	`language_id` INTEGER,
	`perfil_id` INTEGER,
	`cpu_id` INTEGER,
	`url` VARCHAR(250)  NOT NULL,
	`status_id` INTEGER  NOT NULL,
	`priority` INTEGER  NOT NULL,
	`name` VARCHAR(150)  NOT NULL,
	`timeini` DATETIME  NOT NULL,
	`timestart` DATETIME  NOT NULL,
	`timeend` DATETIME  NOT NULL,
	`pid` INTEGER,
	`path_ini` VARCHAR(250)  NOT NULL,
	`path_end` VARCHAR(250)  NOT NULL,
	`ext_ini` VARCHAR(6)  NOT NULL,
	`ext_end` VARCHAR(6)  NOT NULL,
	`duration` INTEGER default 0 NOT NULL,
	`size` BIGINT default 0 NOT NULL,
	`email` VARCHAR(30),
	PRIMARY KEY (`id`),
	INDEX `transcoding_FI_1` (`mm_id`),
	CONSTRAINT `transcoding_FK_1`
		FOREIGN KEY (`mm_id`)
		REFERENCES `mm` (`id`)
		ON DELETE CASCADE,
	INDEX `transcoding_FI_2` (`language_id`),
	CONSTRAINT `transcoding_FK_2`
		FOREIGN KEY (`language_id`)
		REFERENCES `language` (`id`),
	INDEX `transcoding_FI_3` (`perfil_id`),
	CONSTRAINT `transcoding_FK_3`
		FOREIGN KEY (`perfil_id`)
		REFERENCES `perfil` (`id`),
	INDEX `transcoding_FI_4` (`cpu_id`),
	CONSTRAINT `transcoding_FK_4`
		FOREIGN KEY (`cpu_id`)
		REFERENCES `cpu` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- transcoding_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `transcoding_i18n`;


CREATE TABLE `transcoding_i18n`
(
	`Description` VARCHAR(200)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `transcoding_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `transcoding` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- cpu
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `cpu`;


CREATE TABLE `cpu`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`ip` CHAR(15)  NOT NULL,
	`max` INTEGER  NOT NULL,
	`min` INTEGER  NOT NULL,
	`number` INTEGER  NOT NULL,
	`type` VARCHAR(10)  NOT NULL,
	`user` VARCHAR(100)  NOT NULL,
	`password` VARCHAR(100)  NOT NULL,
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- cpu_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `cpu_i18n`;


CREATE TABLE `cpu_i18n`
(
	`description` VARCHAR(200)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `cpu_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `cpu` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- ticket
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `ticket`;


CREATE TABLE `ticket`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`file_id` INTEGER  NOT NULL,
	`path` VARCHAR(250)  NOT NULL,
	`url` VARCHAR(250)  NOT NULL,
	`date` DATETIME  NOT NULL,
	`end` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `ticket_FI_1` (`file_id`),
	CONSTRAINT `ticket_FK_1`
		FOREIGN KEY (`file_id`)
		REFERENCES `file` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- event
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `event`;


CREATE TABLE `event`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`direct_id` INTEGER,
	`name` VARCHAR(250)  NOT NULL,
	`place` VARCHAR(250)  NOT NULL,
	`date` DATETIME  NOT NULL,
	`duration` INTEGER  NOT NULL,
	`display` INTEGER default 1 NOT NULL,
	`create_serial` INTEGER default 1 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `event_FI_1` (`direct_id`),
	CONSTRAINT `event_FK_1`
		FOREIGN KEY (`direct_id`)
		REFERENCES `direct` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- streamserver_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `streamserver_type`;


CREATE TABLE `streamserver_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` CHAR(250)  NOT NULL,
	PRIMARY KEY (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- streamserver
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `streamserver`;


CREATE TABLE `streamserver`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`streamserver_type_id` INTEGER,
	`ip` CHAR(15)  NOT NULL,
	`name` CHAR(250)  NOT NULL,
	`description` VARCHAR(200)  NOT NULL,
	`dir_out` VARCHAR(150),
	`url_out` VARCHAR(150),
	PRIMARY KEY (`id`),
	INDEX `streamserver_FI_1` (`streamserver_type_id`),
	CONSTRAINT `streamserver_FK_1`
		FOREIGN KEY (`streamserver_type_id`)
		REFERENCES `streamserver_type` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- pub_channel
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `pub_channel`;


CREATE TABLE `pub_channel`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` CHAR(250)  NOT NULL,
	`broadcast_type_id` INTEGER,
	`default_sel` INTEGER default 0 NOT NULL,
	`rank` INTEGER default 0 NOT NULL,
	`enable` INTEGER default 1 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `pub_channel_FI_1` (`broadcast_type_id`),
	CONSTRAINT `pub_channel_FK_1`
		FOREIGN KEY (`broadcast_type_id`)
		REFERENCES `broadcast_type` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- pub_channel_mm
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `pub_channel_mm`;


CREATE TABLE `pub_channel_mm`
(
	`pub_channel_id` INTEGER  NOT NULL,
	`mm_id` INTEGER  NOT NULL,
	`status_id` INTEGER default 1 NOT NULL,
	PRIMARY KEY (`pub_channel_id`,`mm_id`),
	CONSTRAINT `pub_channel_mm_FK_1`
		FOREIGN KEY (`pub_channel_id`)
		REFERENCES `pub_channel` (`id`)
		ON DELETE CASCADE,
	INDEX `pub_channel_mm_FI_2` (`mm_id`),
	CONSTRAINT `pub_channel_mm_FK_2`
		FOREIGN KEY (`mm_id`)
		REFERENCES `mm` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- pub_channel_perfil
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `pub_channel_perfil`;


CREATE TABLE `pub_channel_perfil`
(
	`pub_channel_id` INTEGER  NOT NULL,
	`perfil_43_id` INTEGER  NOT NULL,
	`perfil_169_id` INTEGER  NOT NULL,
	`perfil_audio_id` INTEGER  NOT NULL,
	PRIMARY KEY (`pub_channel_id`,`perfil_43_id`,`perfil_169_id`,`perfil_audio_id`),
	CONSTRAINT `pub_channel_perfil_FK_1`
		FOREIGN KEY (`pub_channel_id`)
		REFERENCES `pub_channel` (`id`)
		ON DELETE CASCADE,
	INDEX `pub_channel_perfil_FI_2` (`perfil_43_id`),
	CONSTRAINT `pub_channel_perfil_FK_2`
		FOREIGN KEY (`perfil_43_id`)
		REFERENCES `perfil` (`id`)
		ON DELETE CASCADE,
	INDEX `pub_channel_perfil_FI_3` (`perfil_169_id`),
	CONSTRAINT `pub_channel_perfil_FK_3`
		FOREIGN KEY (`perfil_169_id`)
		REFERENCES `perfil` (`id`)
		ON DELETE CASCADE,
	INDEX `pub_channel_perfil_FI_4` (`perfil_audio_id`),
	CONSTRAINT `pub_channel_perfil_FK_4`
		FOREIGN KEY (`perfil_audio_id`)
		REFERENCES `perfil` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- announce_channel
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `announce_channel`;


CREATE TABLE `announce_channel`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` CHAR(250)  NOT NULL,
	`broadcast_type_id` INTEGER,
	`default_sel` INTEGER default 0 NOT NULL,
	`rank` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `announce_channel_FI_1` (`broadcast_type_id`),
	CONSTRAINT `announce_channel_FK_1`
		FOREIGN KEY (`broadcast_type_id`)
		REFERENCES `broadcast_type` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- announce_channel_mm
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `announce_channel_mm`;


CREATE TABLE `announce_channel_mm`
(
	`announce_channel_id` INTEGER  NOT NULL,
	`mm_id` INTEGER  NOT NULL,
	`status_id` INTEGER default 1 NOT NULL,
	PRIMARY KEY (`announce_channel_id`,`mm_id`),
	CONSTRAINT `announce_channel_mm_FK_1`
		FOREIGN KEY (`announce_channel_id`)
		REFERENCES `announce_channel` (`id`)
		ON DELETE CASCADE,
	INDEX `announce_channel_mm_FI_2` (`mm_id`),
	CONSTRAINT `announce_channel_mm_FK_2`
		FOREIGN KEY (`mm_id`)
		REFERENCES `mm` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- serial_matterhorn
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `serial_matterhorn`;


CREATE TABLE `serial_matterhorn`
(
	`id` INTEGER  NOT NULL,
	`mh_id` VARCHAR(255)  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`id`),
	CONSTRAINT `serial_matterhorn_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `serial` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- mm_matterhorn
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `mm_matterhorn`;


CREATE TABLE `mm_matterhorn`
(
	`id` INTEGER  NOT NULL,
	`mh_id` VARCHAR(255)  NOT NULL,
	`created_at` DATETIME,
	`player_url` VARCHAR(255)  NOT NULL,
	`duration` INTEGER default 0 NOT NULL,
	`num_view` INTEGER default 0 NOT NULL,
	`punt_sum` INTEGER default 0 NOT NULL,
	`punt_num` INTEGER default 0 NOT NULL,
	`language_id` INTEGER,
	`display` INTEGER default 1 NOT NULL,
	`invert` INTEGER default 1 NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `mm_matterhorn_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `mm` (`id`)
		ON DELETE CASCADE,
	INDEX `mm_matterhorn_FI_2` (`language_id`),
	CONSTRAINT `mm_matterhorn_FK_2`
		FOREIGN KEY (`language_id`)
		REFERENCES `language` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- serial_hash
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `serial_hash`;


CREATE TABLE `serial_hash`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`serial_id` INTEGER,
	`hash` VARCHAR(100)  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `serial_hash_FI_1` (`serial_id`),
	CONSTRAINT `serial_hash_FK_1`
		FOREIGN KEY (`serial_id`)
		REFERENCES `serial` (`id`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- category
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `category`;


CREATE TABLE `category`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`cod` VARCHAR(25)  NOT NULL,
	`tree_left` INTEGER,
	`tree_right` INTEGER,
	`tree_parent` INTEGER,
	`scope` INTEGER,
	`metacategory` INTEGER default 0 NOT NULL,
	`display` INTEGER default 1 NOT NULL,
	`required` INTEGER default 0 NOT NULL,
	`num_mm` INTEGER default 0 NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `category_cod_unique` (`cod`)
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- category_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `category_i18n`;


CREATE TABLE `category_i18n`
(
	`name` VARCHAR(100)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `category_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `category` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- relation_category
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `relation_category`;


CREATE TABLE `relation_category`
(
	`one_id` INTEGER  NOT NULL,
	`two_id` INTEGER  NOT NULL,
	`recommended` INTEGER default 1 NOT NULL,
	PRIMARY KEY (`one_id`,`two_id`),
	CONSTRAINT `relation_category_FK_1`
		FOREIGN KEY (`one_id`)
		REFERENCES `category` (`id`)
		ON DELETE CASCADE,
	INDEX `relation_category_FI_2` (`two_id`),
	CONSTRAINT `relation_category_FK_2`
		FOREIGN KEY (`two_id`)
		REFERENCES `category` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- category_mm
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `category_mm`;


CREATE TABLE `category_mm`
(
	`category_id` INTEGER  NOT NULL,
	`mm_id` INTEGER  NOT NULL,
	PRIMARY KEY (`category_id`,`mm_id`),
	CONSTRAINT `category_mm_FK_1`
		FOREIGN KEY (`category_id`)
		REFERENCES `category` (`id`)
		ON DELETE CASCADE,
	INDEX `category_mm_FI_2` (`mm_id`),
	CONSTRAINT `category_mm_FK_2`
		FOREIGN KEY (`mm_id`)
		REFERENCES `mm` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- category_mm_template
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `category_mm_template`;


CREATE TABLE `category_mm_template`
(
	`category_id` INTEGER  NOT NULL,
	`mm_template_id` INTEGER  NOT NULL,
	PRIMARY KEY (`category_id`,`mm_template_id`),
	CONSTRAINT `category_mm_template_FK_1`
		FOREIGN KEY (`category_id`)
		REFERENCES `category` (`id`)
		ON DELETE CASCADE,
	INDEX `category_mm_template_FI_2` (`mm_template_id`),
	CONSTRAINT `category_mm_template_FK_2`
		FOREIGN KEY (`mm_template_id`)
		REFERENCES `mm_template` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

#-----------------------------------------------------------------------------
#-- category_mm_timeframe
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `category_mm_timeframe`;


CREATE TABLE `category_mm_timeframe`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`category_id` INTEGER  NOT NULL,
	`mm_id` INTEGER  NOT NULL,
	`timestart` DATETIME  NOT NULL,
	`timeend` DATETIME  NOT NULL,
	`description` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `category_mm_timeframe_FI_1` (`category_id`),
	CONSTRAINT `category_mm_timeframe_FK_1`
		FOREIGN KEY (`category_id`)
		REFERENCES `category` (`id`)
		ON DELETE CASCADE,
	INDEX `category_mm_timeframe_FI_2` (`mm_id`),
	CONSTRAINT `category_mm_timeframe_FK_2`
		FOREIGN KEY (`mm_id`)
		REFERENCES `mm` (`id`)
		ON DELETE CASCADE
)Engine=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
