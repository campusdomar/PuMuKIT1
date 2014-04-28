#-----------------------------------------------------------------------------
#-- serial 
#-----------------------------------------------------------------------------

ALTER TABLE serial ADD `display` INTEGER default 1 NOT NULL;

#-----------------------------------------------------------------------------
#-- mm
#-----------------------------------------------------------------------------

ALTER TABLE mm
ADD `audio` INTEGER default 0 NOT NULL,
ADD `duration` INTEGER default 0 NOT NULL,
ADD `num_view` INTEGER default 0 NOT NULL,
ADD `comments` TEXT;

#-----------------------------------------------------------------------------
#-- file
#-----------------------------------------------------------------------------

ALTER TABLE file
MODIFY `size` BIGINT default 0 NOT NULL,
ADD `download` INTEGER default 0 NOT NULL;

#-----------------------------------------------------------------------------
#-- material
#-----------------------------------------------------------------------------

ALTER  TABLE `material`
ADD `size` BIGINT default 0 NOT NULL;

#-----------------------------------------------------------------------------
#-- log_file
#-----------------------------------------------------------------------------

ALTER  TABLE log_file
MODIFY `created_at` DATETIME  NOT NULL,
ADD KEY `log_file_created_at_index`(`created_at`);

#-----------------------------------------------------------------------------
#-- log_transcoding
#-----------------------------------------------------------------------------

ALTER TABLE log_transcoding
MODIFY `size` BIGINT default 0 NOT NULL;

#-----------------------------------------------------------------------------
#-- direct_type
#-----------------------------------------------------------------------------

ALTER TABLE direct_type
MODIFY `name` CHAR(250);

#-----------------------------------------------------------------------------
#-- perfil
#-----------------------------------------------------------------------------

ALTER TABLE perfil
ADD `master` INTEGER default 0 NOT NULL,
ADD `accepted_mime_type` VARCHAR(100);

#-----------------------------------------------------------------------------
#-- transcoding
#-----------------------------------------------------------------------------

ALTER TABLE transcoding 
MODIFY `size` BIGINT default 0 NOT NULL;

 
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
