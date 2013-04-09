
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- content_sequence
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `content_sequence`;


CREATE TABLE `content_sequence`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`type` TINYINT(1)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- content
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `content`;


CREATE TABLE `content`
(
	`id` INTEGER  NOT NULL,
	`is_free` TINYINT default 0 NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `id`(`id`),
	CONSTRAINT `content_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `content_sequence` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- content_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `content_i18n`;


CREATE TABLE `content_i18n`
(
	`name` VARCHAR(255)  NOT NULL,
	`version` INTEGER default 1 NOT NULL,
	`text` LONGTEXT  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `content_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `content` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- content_attachment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `content_attachment`;


CREATE TABLE `content_attachment`
(
	`id` INTEGER  NOT NULL,
	`content_id` INTEGER  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `id`(`id`),
	KEY `content_id`(`content_id`),
	CONSTRAINT `content_attachment_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `content_sequence` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
	CONSTRAINT `content_attachment_FK_2`
		FOREIGN KEY (`content_id`)
		REFERENCES `content` (`id`)
		ON UPDATE CASCADE
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- content_attachment_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `content_attachment_i18n`;


CREATE TABLE `content_attachment_i18n`
(
	`filename` VARCHAR(255)  NOT NULL,
	`original_filename` VARCHAR(255)  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `content_attachment_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `content_attachment` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;


CREATE TABLE `user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`login` VARCHAR(50)  NOT NULL,
	`password` VARCHAR(50)  NOT NULL,
	`session_key` CHAR(32),
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `id`(`id`),
	KEY `login`(`login`),
	KEY `session_key`(`session_key`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- config
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `config`;


CREATE TABLE `config`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`code` VARCHAR(50)  NOT NULL,
	`value` INTEGER(11)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
