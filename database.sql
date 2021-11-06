CREATE DATABASE IF NOT EXISTS `demo_kelompok_8`;

USE `demo_kelompok_8`;

CREATE TABLE IF NOT EXISTS `accounts` (
	`id` INTEGER UNSIGNED AUTO_INCREMENT,
	`email` VARCHAR(255),
	`username` VARCHAR(128),
	`password` VARCHAR(255),
	`first_name` VARCHAR(128),
	`last_name` VARCHAR(128),
	`birth_date` DATE,
	`gender` BIT NOT NULL DEFAULT 0,
	`is_admin` BIT NOT NULL DEFAULT 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`deleted_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE (`email`),
	UNIQUE (`username`)
) ENGINE=InnoDB;