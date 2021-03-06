
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- text
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `text`;


CREATE TABLE `text`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- text_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `text_i18n`;


CREATE TABLE `text_i18n`
(
	`title` VARCHAR(255)  NOT NULL,
	`body` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `text_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `text` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- itemtypes
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `itemtypes`;


CREATE TABLE `itemtypes`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(13)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- item2item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `item2item`;


CREATE TABLE `item2item`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`item1_id` INTEGER  NOT NULL,
	`item1_type` INTEGER  NOT NULL,
	`item2_id` INTEGER  NOT NULL,
	`item2_type` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `item` (`item1_id`, `item1_type`, `item2_id`, `item2_type`),
	KEY `item2item_I_1`(`item1_id`),
	KEY `item2item_I_2`(`item1_type`),
	KEY `item2item_I_3`(`item2_id`),
	KEY `item2item_I_4`(`item2_type`),
	CONSTRAINT `item2item_FK_1`
		FOREIGN KEY (`item1_type`)
		REFERENCES `itemtypes` (`id`),
	CONSTRAINT `item2item_FK_2`
		FOREIGN KEY (`item2_type`)
		REFERENCES `itemtypes` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- itemcategory
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `itemcategory`;


CREATE TABLE `itemcategory`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`itemcategory_id` INTEGER,
	`show` TINYINT default 1,
	`order` INTEGER  NOT NULL,
	`code` VARCHAR(255),
	PRIMARY KEY (`id`),
	UNIQUE KEY `code` (`code`),
	KEY `order`(`order`),
	KEY `show`(`show`),
	INDEX `itemcategory_FI_1` (`itemcategory_id`),
	CONSTRAINT `itemcategory_FK_1`
		FOREIGN KEY (`itemcategory_id`)
		REFERENCES `itemcategory` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- itemcategory_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `itemcategory_i18n`;


CREATE TABLE `itemcategory_i18n`
(
	`title` TEXT  NOT NULL,
	`items_count` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	KEY `title`(`title`),
	CONSTRAINT `itemcategory_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `itemcategory` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- item2itemcategory
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `item2itemcategory`;


CREATE TABLE `item2itemcategory`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`itemcategory_id` INTEGER,
	`item_id` INTEGER  NOT NULL,
	`item_type` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `item` (`itemcategory_id`, `item_id`, `item_type`),
	KEY `itemcategory_id`(`itemcategory_id`),
	KEY `item_id`(`item_id`),
	KEY `item_type`(`item_type`),
	CONSTRAINT `item2itemcategory_FK_1`
		FOREIGN KEY (`itemcategory_id`)
		REFERENCES `itemcategory` (`id`),
	CONSTRAINT `item2itemcategory_FK_2`
		FOREIGN KEY (`item_type`)
		REFERENCES `itemtypes` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- news
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `news`;


CREATE TABLE `news`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`date` DATE,
	`updated_at` DATETIME,
	`show` TINYINT default 1,
	`order` INTEGER  NOT NULL,
	`img` VARCHAR(255),
	`full_path` VARCHAR(255),
	`thumb_path` VARCHAR(255),
	`original` TEXT  NOT NULL,
	`type` INTEGER default 1 NOT NULL,
	PRIMARY KEY (`id`),
	KEY `news_I_1`(`type`),
	KEY `updated_at`(`updated_at`),
	KEY `date`(`date`),
	KEY `show`(`show`),
	KEY `order`(`order`),
	CONSTRAINT `news_FK_1`
		FOREIGN KEY (`type`)
		REFERENCES `newstypes` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- news_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `news_i18n`;


CREATE TABLE `news_i18n`
(
	`updated_at_extra` DATETIME,
	`title` TEXT  NOT NULL,
	`shortbody` TEXT  NOT NULL,
	`body` TEXT  NOT NULL,
	`author` VARCHAR(255),
	`translated_by` VARCHAR(255),
	`link` VARCHAR(255),
	`extradate` VARCHAR(255),
	`doc` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	KEY `culture`(`culture`),
	KEY `updated_at_extra`(`updated_at_extra`),
	KEY `body`(`body`),
	CONSTRAINT `news_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `news` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- newstypes
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `newstypes`;


CREATE TABLE `newstypes`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(20)  NOT NULL,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- upload
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `upload`;


CREATE TABLE `upload`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255)  NOT NULL,
	`url` VARCHAR(255),
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- photo
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `photo`;


CREATE TABLE `photo`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`photoalbum_id` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`show` TINYINT default 1,
	`order` INTEGER  NOT NULL,
	`img` VARCHAR(255),
	`full_path` VARCHAR(255),
	`preview_path` VARCHAR(255),
	`thumb_path` VARCHAR(255),
	`link` VARCHAR(255),
	`width` INTEGER,
	`height` INTEGER,
	`carousel` TINYINT default 0,
	PRIMARY KEY (`id`),
	UNIQUE KEY `photoalbum_order` (`photoalbum_id`, `order`),
	KEY `photoalbum_id`(`photoalbum_id`),
	KEY `updated_at`(`updated_at`),
	KEY `show`(`show`),
	KEY `img`(`img`),
	KEY `full_path`(`full_path`),
	KEY `preview_path`(`preview_path`),
	KEY `thumb_path`(`thumb_path`),
	KEY `carousel`(`carousel`),
	CONSTRAINT `photo_FK_1`
		FOREIGN KEY (`photoalbum_id`)
		REFERENCES `photoalbum` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- photo_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `photo_i18n`;


CREATE TABLE `photo_i18n`
(
	`updated_at_extra` DATETIME,
	`title` TEXT,
	`body` TEXT,
	`author` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	KEY `updated_at_extra`(`updated_at_extra`),
	CONSTRAINT `photo_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `photo` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- photoalbum
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `photoalbum`;


CREATE TABLE `photoalbum`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`show` TINYINT default 1,
	`order` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `show`(`show`),
	KEY `order`(`order`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- photoalbum_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `photoalbum_i18n`;


CREATE TABLE `photoalbum_i18n`
(
	`title` TEXT,
	`body` TEXT,
	`author` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `photoalbum_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `photoalbum` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- video
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `video`;


CREATE TABLE `video`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`show` TINYINT default 1,
	`order` INTEGER  NOT NULL,
	`link` VARCHAR(255),
	`live` TINYINT default 0,
	`all_cultures` TINYINT default 0,
	PRIMARY KEY (`id`),
	KEY `updated_at`(`updated_at`),
	KEY `show`(`show`),
	KEY `order`(`order`),
	KEY `all_cultures`(`all_cultures`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- video_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `video_i18n`;


CREATE TABLE `video_i18n`
(
	`updated_at_extra` DATETIME,
	`img` VARCHAR(255)  NOT NULL,
	`code` TEXT  NOT NULL,
	`title` TEXT,
	`body` TEXT,
	`author` VARCHAR(255),
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	KEY `updated_at_extra`(`updated_at_extra`),
	KEY `code`(`code`),
	CONSTRAINT `video_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `video` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- quote
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `quote`;


CREATE TABLE `quote`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`show` TINYINT default 1,
	`news_id` INTEGER,
	PRIMARY KEY (`id`),
	KEY `show`(`show`),
	INDEX `quote_FI_1` (`news_id`),
	CONSTRAINT `quote_FK_1`
		FOREIGN KEY (`news_id`)
		REFERENCES `news` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- quote_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `quote_i18n`;


CREATE TABLE `quote_i18n`
(
	`title` TEXT  NOT NULL,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `quote_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `quote` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- audio
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `audio`;


CREATE TABLE `audio`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`show` TINYINT default 1,
	`file` VARCHAR(255)  NOT NULL,
	`remote` VARCHAR(255),
	`size` FLOAT,
	`duration` FLOAT,
	`order` INTEGER  NOT NULL,
	PRIMARY KEY (`id`),
	KEY `audio_I_1`(`order`),
	KEY `updated_at`(`updated_at`),
	KEY `show`(`show`),
	KEY `file`(`file`),
	KEY `remote`(`remote`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- audio_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `audio_i18n`;


CREATE TABLE `audio_i18n`
(
	`updated_at_extra` DATETIME,
	`title` TEXT,
	`body` TEXT,
	`author` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	KEY `updated_at_extra`(`updated_at_extra`),
	CONSTRAINT `audio_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `audio` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- revisionhistory
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `revisionhistory`;


CREATE TABLE `revisionhistory`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`show` TINYINT default 1,
	`page_mnemonic` VARCHAR(255),
	`item_id` INTEGER,
	`itemtypes_id` INTEGER,
	`item_culture` VARCHAR(7),
	`body` TEXT,
	PRIMARY KEY (`id`),
	KEY `main`(`page_mnemonic`, `show`),
	KEY `item_id`(`item_id`),
	KEY `itemtypes_id`(`itemtypes_id`),
	KEY `item_culture`(`item_culture`),
	CONSTRAINT `revisionhistory_FK_1`
		FOREIGN KEY (`itemtypes_id`)
		REFERENCES `itemtypes` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- documents
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `documents`;


CREATE TABLE `documents`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`news_id` INTEGER,
	`show` TINYINT default 1,
	`file` VARCHAR(255)  NOT NULL,
	`size` FLOAT,
	`order` INTEGER  NOT NULL,
	`all_cultures` TINYINT default 0,
	PRIMARY KEY (`id`),
	UNIQUE KEY `file` (`file`),
	KEY `documents_I_1`(`order`),
	KEY `updated_at`(`updated_at`),
	KEY `show`(`show`),
	KEY `all_cultures`(`all_cultures`),
	INDEX `documents_FI_1` (`news_id`),
	CONSTRAINT `documents_FK_1`
		FOREIGN KEY (`news_id`)
		REFERENCES `news` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- documents_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `documents_i18n`;


CREATE TABLE `documents_i18n`
(
	`updated_at_extra` DATETIME,
	`title` TEXT,
	`body` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	KEY `updated_at_extra`(`updated_at_extra`),
	CONSTRAINT `documents_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `documents` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- clearcache
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `clearcache`;


CREATE TABLE `clearcache`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`sf_guard_user_id` INTEGER  NOT NULL,
	`item_id` INTEGER  NOT NULL,
	`itemtypes_id` INTEGER,
	`item_culture` VARCHAR(7)  NOT NULL,
	`cleared` TINYINT default 0,
	`document_created` TINYINT default 0,
	PRIMARY KEY (`id`),
	KEY `sf_guard_user_id`(`sf_guard_user_id`),
	KEY `item_id`(`item_id`),
	KEY `itemtypes_id`(`itemtypes_id`),
	KEY `item_culture`(`item_culture`),
	KEY `cleared`(`cleared`),
	KEY `document_created`(`document_created`),
	CONSTRAINT `clearcache_FK_1`
		FOREIGN KEY (`sf_guard_user_id`)
		REFERENCES `sf_guard_user` (`id`),
	CONSTRAINT `clearcache_FK_2`
		FOREIGN KEY (`itemtypes_id`)
		REFERENCES `itemtypes` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- contactus
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `contactus`;


CREATE TABLE `contactus`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`show` TINYINT default 1,
	`order` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	`title` VARCHAR(255),
	`link` VARCHAR(255),
	PRIMARY KEY (`id`),
	KEY `show`(`show`),
	KEY `culture`(`culture`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- location
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `location`;


CREATE TABLE `location`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`location_id` INTEGER,
	`created_at` DATETIME,
	`show` TINYINT default 1,
	`order` INTEGER  NOT NULL,
	`lat` DOUBLE,
	`lng` DOUBLE,
	PRIMARY KEY (`id`),
	KEY `order`(`order`),
	KEY `show`(`show`),
	INDEX `location_FI_1` (`location_id`),
	CONSTRAINT `location_FK_1`
		FOREIGN KEY (`location_id`)
		REFERENCES `location` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- location_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `location_i18n`;


CREATE TABLE `location_i18n`
(
	`title` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	CONSTRAINT `location_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `location` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- locationlink
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `locationlink`;


CREATE TABLE `locationlink`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`location_id` INTEGER,
	`upto_location_id` INTEGER,
	`created_at` DATETIME,
	`show` TINYINT default 1,
	`order` INTEGER  NOT NULL,
	`title` VARCHAR(255),
	`link` VARCHAR(255),
	PRIMARY KEY (`id`),
	KEY `show`(`show`),
	KEY `order`(`order`),
	INDEX `locationlink_FI_1` (`location_id`),
	CONSTRAINT `locationlink_FK_1`
		FOREIGN KEY (`location_id`)
		REFERENCES `location` (`id`),
	INDEX `locationlink_FI_2` (`upto_location_id`),
	CONSTRAINT `locationlink_FK_2`
		FOREIGN KEY (`upto_location_id`)
		REFERENCES `location` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- announcements
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `announcements`;


CREATE TABLE `announcements`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`active_till` DATE  NOT NULL,
	`show` TINYINT default 1,
	`order` INTEGER  NOT NULL,
	`all_cultures` TINYINT default 0,
	PRIMARY KEY (`id`),
	KEY `announcements_I_1`(`order`),
	KEY `updated_at`(`updated_at`),
	KEY `show`(`show`),
	KEY `all_cultures`(`all_cultures`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- announcements_i18n
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `announcements_i18n`;


CREATE TABLE `announcements_i18n`
(
	`updated_at_extra` DATETIME,
	`title` TEXT,
	`body` TEXT,
	`id` INTEGER  NOT NULL,
	`culture` VARCHAR(7)  NOT NULL,
	PRIMARY KEY (`id`,`culture`),
	KEY `updated_at_extra`(`updated_at_extra`),
	CONSTRAINT `announcements_i18n_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `announcements` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
