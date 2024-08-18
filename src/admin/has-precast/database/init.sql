-- For reinitializing database easily
DROP DATABASE IF EXISTS `has_precast`;

DROP USER IF EXISTS 'has_admin'@'localhost';
FLUSH PRIVILEGES;

-- Initialize database
CREATE DATABASE `has_precast`;

CREATE USER 'has_admin'@'localhost' IDENTIFIED BY 'wc8KTRfrJrTpe8';
GRANT ALL ON `has_precast`.* TO 'has_admin'@'localhost';

USE has_precast;

CREATE TABLE `account_type` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `type` ENUM('NEW', 'BRONZE', 'SILVER', 'GOLD') NOT NULL,
    `discount` INT(2) NOT NULL
) ENGINE=INNODB;

CREATE TABLE `account` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(30) NOT NULL,
    `last_name` VARCHAR(30) NOT NULL,
    `email` VARCHAR(40) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `type_id` INT UNSIGNED NOT NULL DEFAULT 1001,
    `created_at` DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY (`type_id`) REFERENCES `account_type`(`id`)
) ENGINE=INNODB;

CREATE TABLE `billing` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `account_id` INT UNSIGNED NOT NULL,
    `quotation` DECIMAL(10,2) NOT NULL,
    `status` ENUM('OPEN', 'CLOSED', 'CANCELED') NOT NULL DEFAULT 'OPEN',
    `created_at` DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY (`account_id`) REFERENCES `account`(`id`)
) ENGINE=INNODB;

CREATE TABLE `wall_form_block` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `billing_id` INT UNSIGNED NOT NULL,
    `design` ENUM('VCUT', 'SHIPLAP', 'CONVENTIONAL') NOT NULL,
    `size` ENUM('4"', '5"', '6"', '8"') NOT NULL,
    `quantity` INT(10) NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (`billing_id`) REFERENCES `billing`(`id`)
) ENGINE=INNODB;

CREATE TABLE `chat` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `billing_id` INT UNSIGNED NOT NULL,
    `message` TEXT NOT NULL,
    `type` ENUM('TEXT', 'QUOTATION') NOT NULL,
    `date_time_sent` DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY (`billing_id`) REFERENCES `billing`(`id`)
) ENGINE=INNODB;

CREATE TABLE `moderator` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(70) NOT NULL,
    `email` VARCHAR(40) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `type` ENUM('ADMIN', 'EDITOR') NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT NOW()
) ENGINE=INNODB;

CREATE TABLE `content` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `page` ENUM('PROJECTS') NOT NULL DEFAULT 'PROJECTS',
    `section` ENUM('HERO', 'PROJECTS') NOT NULL DEFAULT 'PROJECTS',
    `name` VARCHAR(50) NOT NULL,
    `type` ENUM('TEXT', 'IMAGE') NOT NULL,
    `object` TEXT NOT NULL,
    `default` BOOLEAN DEFAULT FALSE,
    `created_at` DATETIME NOT NULL DEFAULT NOW()
) ENGINE=INNODB;

ALTER TABLE `account_type` AUTO_INCREMENT = 1001;
ALTER TABLE `account` AUTO_INCREMENT = 1001;
ALTER TABLE `billing` AUTO_INCREMENT = 1001;
ALTER TABLE `wall_form_block` AUTO_INCREMENT = 1001;
ALTER TABLE `chat` AUTO_INCREMENT = 1001;
ALTER TABLE `moderator` AUTO_INCREMENT = 1001;
ALTER TABLE `content` AUTO_INCREMENT = 1001;

INSERT INTO `account_type` (`type`, `discount`) 
VALUES ('NEW', 0), ('BRONZE', 2), ('SILVER', 5), ('GOLD', 10); 

