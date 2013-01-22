#-----------------------------------------------------------------------------
#-- direct
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `direct_type`;


CREATE TABLE `direct_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` CHAR(8),
	PRIMARY KEY (`id`)
)Type=MyISAM;

INSERT INTO `direct_type` VALUES (1,'WMS'),(2,'FMS');


ALTER TABLE direct DROP precinct_id;
ALTER TABLE direct DROP mime_type_id;
ALTER TABLE direct DROP date;
ALTER TABLE direct ADD `direct_type_id` INTEGER;
ALTER TABLE direct ADD `calidades` VARCHAR(250)  NOT NULL;
ALTER TABLE direct ADD `ip_source` VARCHAR(100);
ALTER TABLE direct ADD `source_name` VARCHAR(100);
ALTER TABLE direct ADD `index_play` INTEGER default 0 NOT NULL;
ALTER TABLE direct ADD `broadcasting` INTEGER default 0 NOT NULL;
ALTER TABLE direct ADD `debug` INTEGER default 0 NOT NULL;


#-----------------------------------------------------------------------------
#-- virtual_ground
#-----------------------------------------------------------------------------


ALTER TABLE virtual_ground ADD `description` TEXT;
ALTER TABLE virtual_ground ADD `editorial1` INTEGER default 0 NOT NULL;
ALTER TABLE virtual_ground ADD `editorial2` INTEGER default 0 NOT NULL;
ALTER TABLE virtual_ground ADD `editorial3` INTEGER default 0 NOT NULL;
ALTER TABLE virtual_ground ADD `other` INTEGER default 0 NOT NULL;
ALTER TABLE virtual_ground ADD `ground_type_id` INTEGER;
ALTER TABLE virtual_ground ADD CONSTRAINT `virtual_ground_FK_1` FOREIGN KEY (`ground_type_id`) REFERENCES `ground_type` (`id`);


#-----------------------------------------------------------------------------
#-- mm
#-----------------------------------------------------------------------------

ALTER TABLE mm ADD `editorial1` INTEGER default 0 NOT NULL;
ALTER TABLE mm ADD `editorial2` INTEGER default 0 NOT NULL;
ALTER TABLE mm ADD `editorial3` INTEGER default 0 NOT NULL;


