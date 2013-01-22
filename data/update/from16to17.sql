
ALTER TABLE `pub_channel_perfil` ADD `perfil_audio_id` INTEGER  NOT NULL;

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
