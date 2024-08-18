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
    `type` ENUM('NEW', 'BRONZE', 'SILVER', 'GOLD') NOT NULL
) ENGINE=INNODB;

CREATE TABLE `account` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `first_name` VARCHAR(30) NOT NULL,
    `last_name` VARCHAR(30) NOT NULL,
    `email` VARCHAR(40) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `type_id` INT UNSIGNED NOT NULL DEFAULT 1001,
    `status` ENUM('ACTIVE', 'INACTIVE') NOT NULL DEFAULT 'ACTIVE',
    `created_at` DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY (`type_id`) REFERENCES `account_type`(`id`)
) ENGINE=INNODB;

CREATE TABLE `billing` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `account_id` INT UNSIGNED NOT NULL,
    `quotation` DECIMAL(10,2) NULL,
    `status` ENUM('OPEN', 'CLOSED') NOT NULL DEFAULT 'OPEN',
    `payment_method` ENUM('BDO', 'UNIONBANK', 'GCASH'),
    `payment_reference` VARCHAR(255) NOT NULL,
    `payment_date` DATETIME NOT NULL DEFAULT NOW() ON UPDATE NOW(),
    `payment_status` ENUM('VERIFYING', 'PAID', 'UNPAID') NOT NULL DEFAULT 'UNPAID',
    `delivery_date` DATETIME NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY (`account_id`) REFERENCES `account`(`id`)
) ENGINE=INNODB;

CREATE TABLE `wall_form_block` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(30) NOT NULL,
    `design_name` varchar(30),
    `description` text NOT NULL,
    `cart_image` text NOT NULL,
    `wfb_image` text NOT NULL,
    `status` ENUM('AVAIL','NOT AVAIL') NOT NULL DEFAULT 'AVAIL',
    `default` tinyint(1) NOT NULL DEFAULT 0,
    `updated_at` timestamp NOT NULL DEFAULT NOW() ON UPDATE NOW()
) ENGINE=INNODB;

CREATE TABLE `cart` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `account_id` INT UNSIGNED NOT NULL,
    `wall_form_block_id` INT UNSIGNED NOT NULL,
    `size` ENUM('4"', '5"', '6"', '8"') NOT NULL,
    `quantity` INT(10) NOT NULL,
    FOREIGN KEY (`account_id`) REFERENCES `account`(`id`),
    FOREIGN KEY (`wall_form_block_id`) REFERENCES `wall_form_block`(`id`)
) ENGINE=INNODB;

CREATE TABLE `order` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `billing_id` INT UNSIGNED NOT NULL,
    `wall_form_block_id` INT UNSIGNED NOT NULL,
    `size` ENUM('4"', '5"', '6"', '8"') NOT NULL,
    `quantity` INT(10) NOT NULL,
    FOREIGN KEY (`billing_id`) REFERENCES `billing`(`id`),
    FOREIGN KEY (`wall_form_block_id`) REFERENCES `wall_form_block`(`id`)
) ENGINE=INNODB;

CREATE TABLE `chat` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `billing_id` INT UNSIGNED NOT NULL,
    `message` TEXT NOT NULL,
    `sender` ENUM('CLIENT', 'ADMIN') NOT NULL DEFAULT 'CLIENT',
    `date_time_sent` DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY (`billing_id`) REFERENCES `billing`(`id`)
) ENGINE=INNODB;

CREATE TABLE `moderator` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(70) NOT NULL,
    `email` VARCHAR(40) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `type` ENUM('Admin', 'Editor') NOT NULL DEFAULT 'Editor',
    `status` ENUM('ACTIVE', 'INACTIVE') NOT NULL DEFAULT 'ACTIVE',
    `created_at` DATETIME NOT NULL DEFAULT NOW()
) ENGINE=INNODB;

CREATE TABLE `content` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `page` enum('HOME','ABOUT','PROJECTS','CONTACT','USERGUIDE','WFB') NOT NULL,
  `section` enum('HERO','ABOUT','MISSIONVISION','PROJECTS','WFB','CONTACT','CONTACTS','TABLECONTENT','CONTENT1','CONTENT2','PRECONTENT','WFB','DESIGNS','DIMENSIONS','STRENGTH') NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('TEXT','IMAGE','HERO','VIDEO') NOT NULL,
  `object` text DEFAULT NULL,
  `default` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT NOW() ON UPDATE NOW()
) ENGINE=INNODB;

CREATE TABLE `projects` (
  `cardID` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(30) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `location` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `mainImage` varchar(50) NOT NULL,
  `subImage1` varchar(50) NOT NULL,
  `subImage2` varchar(50) NOT NULL,
  `default` tinyint(1) DEFAULT NULL,
  `UpdatedAt` timestamp NULL DEFAULT NOW()
) ENGINE=INNODB;

ALTER TABLE `account_type` AUTO_INCREMENT = 1001;
ALTER TABLE `account` AUTO_INCREMENT = 1001;
ALTER TABLE `billing` AUTO_INCREMENT = 1001;
ALTER TABLE `cart` AUTO_INCREMENT = 1001;
ALTER TABLE `order` AUTO_INCREMENT = 1001;
ALTER TABLE `wall_form_block` AUTO_INCREMENT = 1001;
ALTER TABLE `chat` AUTO_INCREMENT = 1001;
ALTER TABLE `moderator` AUTO_INCREMENT = 1001;
ALTER TABLE `content` AUTO_INCREMENT = 1001;
ALTER TABLE `projects` AUTO_INCREMENT = 1001;

-- initialize client account types
INSERT INTO `account_type` (`type`) VALUES 
('NEW'), ('BRONZE'), ('SILVER'), ('GOLD'); 

-- initialize client accounts

-- initialize moderator accounts
INSERT INTO `moderator` (`name`, `email`, `password`, `type`)
VALUES ('Justine Casiano', 'jcasiano.k12151755@umak.edu.ph', '$2y$10$3SOI5NGIGbkzpCs302WxWOEsRsj2B8.OiJvCxuLHfUpEd3mfMuNvO', 'Admin');

INSERT INTO `moderator` (`name`, `email`, `password`, `type`)
VALUES ('Sangilbie', 'sangilbie@gmail.com', '$2y$10$HhLbweq/D4NkqMCFwj5gjunVaIjopwDle2dN412g/6Zk6yeey/dC2', 'Editor');

INSERT INTO `account` (`first_name`, `last_name`, `email`, `password`)
VALUES ('Justine', 'Casiano', 'justinecasiano30@gmail.com', '$2y$10$1G.XD0dYd/7h9hlYpB1TkuCq0emV3EA5ADKQL12wEcyfxpFsq6goi');

-- initialize content

-- for hero images
INSERT INTO `content` (`page`, `section`, `name`, `type`, `object`, `default`) VALUES
("HOME", "HERO", "homeHeroDefault", "HERO", "indexHeroDefault.webm", 1),
("ABOUT", "HERO", "aboutHeroDefault", "HERO", "aboutHeroDefault.webp", 1),
("CONTACT", "HERO", "contactHeroDefault", "HERO", "contactHeroDefault.png", 1),
("PROJECTS", "HERO", "projectsHeroDefault", "HERO", "projectsHeroDefault.webp", 1),
("USERGUIDE", "HERO", "userHeroDefault", "HERO", "userHeroDefault.webp", 1),
("WFB", "HERO", "wfbHeroDefault", "HERO", "wfbHeroDefault.webp", 1),
("HOME", "HERO", "homeHeroDefault", "HERO", "indexHeroDefault.webm", 0),
("ABOUT", "HERO", "aboutHeroDefault", "HERO", "aboutHeroDefault.webp", 0),
("CONTACT", "HERO", "contactHeroDefault", "HERO", "contactHeroDefault.png", 0),
("PROJECTS", "HERO", "projectsHeroDefault", "HERO", "projectsHeroDefault.webp", 0),
("USERGUIDE", "HERO", "userHeroDefault", "HERO", "userHeroDefault.webp", 0),
("WFB", "HERO", "wfbHeroDefault", "HERO", "wfbHeroDefault.webp", 0);

-- for home page
INSERT INTO content (page, section, name, type, object, `default`) VALUES
("HOME", "HERO", "CAPTION1", "TEXT", "Quality is the building block of beauty", 1),
("HOME", "WFB", "CAPTION1", "TEXT", "Less cost, high quality construction", 1),
("HOME", "WFB", "CAPTION2", "TEXT", "Less cost, high quality wall system", 1),
("HOME", "WFB", "IMAGE1", "IMAGE", "wall-form-blocks.png", 1),
("HOME", "WFB", "BUTTON", "TEXT", "Learn more", 1),
("HOME", "PROJECTS", "TITLE1", "TEXT", "Projects", 1),
("HOME", "PROJECTS", "CAPTION1", "TEXT", "Government", 1),
("HOME", "PROJECTS", "CAPTION2", "TEXT", "House", 1),
("HOME", "PROJECTS", "CAPTION3", "TEXT", "Townhouse", 1),
("HOME", "PROJECTS", "CAPTION4", "TEXT", "Bungalow", 1),
("HOME", "PROJECTS", "BUTTON1", "TEXT", "Learn more", 1),
("HOME", "PROJECTS", "BUTTON2", "TEXT", "Learn more", 1),
("HOME", "PROJECTS", "BUTTON3", "TEXT", "Learn more", 1),
("HOME", "PROJECTS", "BUTTON4", "TEXT", "Learn more", 1),
("HOME", "PROJECTS", "IMAGE1", "IMAGE", "project-1.png", 1),
("HOME", "PROJECTS", "IMAGE2", "IMAGE", "project-2.png", 1),
("HOME", "PROJECTS", "IMAGE3", "IMAGE", "project-3.png", 1),
("HOME", "PROJECTS", "IMAGE4", "IMAGE", "project-4.png", 1),
("HOME", "CONTACT", "CAPTION1", "TEXT", "Ready to discuss your next project?", 1),
("HOME", "CONTACT", "BUTTON1", "TEXT", "Get in touch", 1),
("HOME", "CONTACT", "IMAGE1", "IMAGE", "contact-us.png", 1),
("HOME", "HERO", "CAPTION1", "TEXT", "Quality is the building block of beauty", 0),
("HOME", "WFB", "CAPTION1", "TEXT", "Less cost, high quality construction", 0),
("HOME", "WFB", "CAPTION2", "TEXT", "Less cost, high quality wall system", 0),
("HOME", "WFB", "IMAGE1", "IMAGE", "wall-form-blocks.png", 0),
("HOME", "WFB", "BUTTON", "TEXT", "Learn more", 0),
("HOME", "PROJECTS", "TITLE1", "TEXT", "Projects", 0),
("HOME", "PROJECTS", "CAPTION1", "TEXT", "Government", 0),
("HOME", "PROJECTS", "CAPTION2", "TEXT", "House", 0),
("HOME", "PROJECTS", "CAPTION3", "TEXT", "Townhouse", 0),
("HOME", "PROJECTS", "CAPTION4", "TEXT", "Bungalow", 0),
("HOME", "PROJECTS", "BUTTON1", "TEXT", "Learn more", 0),
("HOME", "PROJECTS", "BUTTON2", "TEXT", "Learn more", 0),
("HOME", "PROJECTS", "BUTTON3", "TEXT", "Learn more", 0),
("HOME", "PROJECTS", "BUTTON4", "TEXT", "Learn more", 0),
("HOME", "PROJECTS", "IMAGE1", "IMAGE", "project-1.png", 0),
("HOME", "PROJECTS", "IMAGE2", "IMAGE", "project-2.png", 0),
("HOME", "PROJECTS", "IMAGE3", "IMAGE", "project-3.png", 0),
("HOME", "PROJECTS", "IMAGE4", "IMAGE", "project-4.png", 0),
("HOME", "CONTACT", "CAPTION1", "TEXT", "Ready to discuss your next project?", 0),
("HOME", "CONTACT", "BUTTON1", "TEXT", "Get in touch", 0),
("HOME", "CONTACT", "IMAGE1", "IMAGE", "contact-us.png", 0);

-- for about us page
INSERT INTO content (page, section, name, type, object, `default`) VALUES
("ABOUT", "HERO", "TITLE1", "TEXT", "About the Company", 1),
("ABOUT", "HERO", "CAPTION1", "TEXT", "We Build with Passion", 1),
("ABOUT", "HERO", "BUTTON", "TEXT", "Discover our Purpose!", 1),
("ABOUT", "ABOUT", "TITLE1", "TEXT", "About H&A’s", 1),
("ABOUT", "ABOUT", "PARAGRAPH1", "TEXT", "Manufacturing of precast wall form blocks has been a family business since the invention of the product by our late uncle Engr. Ferdinand D. Crisologo, catering most clients in the South.", 1),
("ABOUT", "ABOUT", "PARAGRAPH2", "TEXT", "H&As’ Concrete Products Manufacturing was set up in Central Luzon to cater the demands in Metro Manila, Central and North Luzon", 1),
("ABOUT", "ABOUT", "PARAGRAPH3", "TEXT", "We offer a cost saving and yet high quality and modern construction system.", 1),
("ABOUT", "ABOUT", "PARAGRAPH4", "TEXT", "A team that opens innovation and massivedevelopmentin constructions, developers, builders and engineering.", 1),
("ABOUT", "ABOUT", "PARAGRAPH5", "TEXT", "Provides quality products and services to meet the utmost satisfaction of our clients to adapt more logical, easy and reasonable lifestyle", 1),
("ABOUT", "MISSIONVISION", "TITLE1", "TEXT", "Our Mission and Vision", 1),
("ABOUT", "MISSIONVISION", "SUBTITLE1", "TEXT", "Mission", 1),
("ABOUT", "MISSIONVISION", "PARAGRAPH1", "TEXT", "The mission of our company is to build a strong foundation and form partnership to a known infrastructure contractor, engineers and architects in the Philippines resulting in innovative, costeffective and qualityguaranteed services and products in construction industry.", 1),
("ABOUT", "MISSIONVISION", "SUBTITLE2", "TEXT", "Vision", 1),
("ABOUT", "MISSIONVISION", "PARAGRAPH2", "TEXT", "Our vision is to be be the leading manufacturing company of precast in the Philippines that bring forth innovation, transformation and development in building and constructions.", 1),
("ABOUT", "ABOUT", "IMAGE1", "IMAGE", "aboutdefault.webp", 1),
("ABOUT", "MISSIONVISION", "IMAGE1", "IMAGE", "mv_backgrounddefault.webp", 1),
("ABOUT", "HERO", "TITLE1", "TEXT", "About the Company", 0),
("ABOUT", "HERO", "CAPTION1", "TEXT", "We Build with Passion", 0),
("ABOUT", "HERO", "BUTTON", "TEXT", "Discover our Purpose!", 0),
("ABOUT", "ABOUT", "TITLE1", "TEXT", "About H&A’s", 0),
("ABOUT", "ABOUT", "PARAGRAPH1", "TEXT", "Manufacturing of precast wall form blocks has been a family business since the invention of the product by our late uncle Engr. Ferdinand D. Crisologo, catering most clients in the South.", 0),
("ABOUT", "ABOUT", "PARAGRAPH2", "TEXT", "H&As’ Concrete Products Manufacturing was set up in Central Luzon to cater the demands in Metro Manila, Central and North Luzon", 0),
("ABOUT", "ABOUT", "PARAGRAPH3", "TEXT", "We offer a cost saving and yet high quality and modern construction system.", 0),
("ABOUT", "ABOUT", "PARAGRAPH4", "TEXT", "A team that opens innovation and massivedevelopmentin constructions, developers, builders and engineering.", 0),
("ABOUT", "ABOUT", "PARAGRAPH5", "TEXT", "Provides quality products and services to meet the utmost satisfaction of our clients to adapt more logical, easy and reasonable lifestyle", 0),
("ABOUT", "MISSIONVISION", "TITLE1", "TEXT", "Our Mission and Vision", 0),
("ABOUT", "MISSIONVISION", "SUBTITLE1", "TEXT", "Mission", 0),
("ABOUT", "MISSIONVISION", "PARAGRAPH1", "TEXT", "The mission of our company is to build a strong foundation and form partnership to a known infrastructure contractor, engineers and architects in the Philippines resulting in innovative, costeffective and qualityguaranteed services and products in construction industry.", 0),
("ABOUT", "MISSIONVISION", "SUBTITLE2", "TEXT", "Vision", 0),
("ABOUT", "MISSIONVISION", "PARAGRAPH2", "TEXT", "Our vision is to be be the leading manufacturing company of precast in the Philippines that bring forth innovation, transformation and development in building and constructions.", 0),
("ABOUT", "ABOUT", "IMAGE1", "IMAGE", "about.webp", 0),
("ABOUT", "MISSIONVISION", "IMAGE1", "IMAGE", "mv_backgrounddefault.webp", 0);

-- for wall form blocks page
INSERT INTO content (page, section, name, type, object, `default`) VALUES
("WFB", "HERO", "TITLE1", "TEXT", "Wall Form Blocks", 1),
("WFB", "HERO", "CAPTION1", "TEXT", "A cost saving yet high quality innovation", 1),
("WFB", "HERO", "BUTTON", "TEXT", "Order Now!", 1),
("WFB", "TABLECONTENT", "TITLE1", "TEXT", "Table of Contents", 1),
("WFB", "TABLECONTENT", "CONTENT1", "TEXT", "What is Precast Wall Form Blocks?", 1),
("WFB", "TABLECONTENT", "CONTENT2", "TEXT", "Designs", 1),
("WFB", "TABLECONTENT", "CONTENT3", "TEXT", "Dimensions and Sizes", 1),
("WFB", "TABLECONTENT", "CONTENT4", "TEXT", "Strength and Durability", 1),
("WFB", "TABLECONTENT", "CONTENT5", "TEXT", "Advantages", 1),
("WFB", "TABLECONTENT", "CONTENT6", "TEXT", "Comparative Cost Analysis", 1),
("WFB", "WFB", "TITLE1", "TEXT", "What is Precast Wall Form Blocks?", 1),
("WFB", "WFB", "PARAGRAPH1", "TEXT", "Its a patented Filipino invention of a new type of construction material that greatly reduces the time and cost of constructing a house, building or wall.", 1),
("WFB", "WFB", "PARAGRAPH2", "TEXT", "Precast concrete wall form block is made up of a pair of concrete panel with indigenous reinforcing material such as bamboo sticks, a layer of finished outer surface and a number of arranged dowels disposed on the inner rough surface that when assembled together creates a space in between that allows the installation of the electrical and plumbing pipes before filling up with cement, mortar and the likes that provides an instant wall without the need for costly finishing and painting jobs afterwards.", 1),
("WFB", "WFB", "PARAGRAPH3", "TEXT", "It eliminates the use of Conventional Hollow Blocks (CHB) without sacrificing the strength, durability and sturdiness.", 1),
("WFB", "WFB", "PARAGRAPH4", "TEXT", "The outer surface is smooth finished, thus eliminating the finishing jobs required when using a conventional hollow blocks. NO PLASTERING NEEDED.", 1),
("WFB", "WFB", "PARAGRAPH5", "TEXT", "Manufactured by casting concrete into a mold. The filled mold is cured in a controlled environment to ensure the quality of the product and will then be delivered to project site for installation.", 1),
("WFB", "WFB", "IMAGE1", "IMAGE", "wfb1-default.webp", 1),
("WFB", "WFB", "IMAGE2", "IMAGE", "wfb2-default.webp", 1),
("WFB", "DESIGNS", "TITLE1", "TEXT", "Wall Form Blocks Design", 1),
("WFB", "DIMENSIONS", "TITLE1", "TEXT", "Dimensions and Sizes", 1),
("WFB", "DIMENSIONS", "DETAIL1", "TEXT", "Thickness: 4” 5” 6” and 8”", 1),
("WFB", "DIMENSIONS", "DETAIL2", "TEXT", "Length: 1 meter(Standard)", 1),
("WFB", "DIMENSIONS", "DETAIL3", "TEXT", "Height: 0.25 meter", 1),
("WFB", "DIMENSIONS", "IMAGE1", "IMAGE", "dimensions-default.webp", 1),
("WFB", "STRENGTH", "TITLE1", "TEXT", "Strength and Durability", 1),
("WFB", "STRENGTH", "LABEL1", "TEXT", "Strength and Durability:", 1),
("WFB", "STRENGTH", "DETAIL1", "TEXT", "2500-3500 Per square inch(PSI)", 1),
("WFB", "STRENGTH", "LABEL2", "TEXT", "PSI:", 1),
("WFB", "STRENGTH", "DETAIL2", "TEXT", "measures the strength of a concrete to carry a load.", 1),
("WFB", "STRENGTH", "IMAGE1", "IMAGE", "strength-default.webp", 1),
("WFB", "HERO", "TITLE1", "TEXT", "Wall Form Blocks", 0),
("WFB", "HERO", "CAPTION1", "TEXT", "A cost saving yet high quality innovation", 0),
("WFB", "HERO", "BUTTON", "TEXT", "Order Now!", 0),
("WFB", "TABLECONTENT", "TITLE1", "TEXT", "Table of Contents", 0),
("WFB", "TABLECONTENT", "CONTENT1", "TEXT", "What is Precast Wall Form Blocks?", 0),
("WFB", "TABLECONTENT", "CONTENT2", "TEXT", "Designs", 0),
("WFB", "TABLECONTENT", "CONTENT3", "TEXT", "Dimensions and Sizes", 0),
("WFB", "TABLECONTENT", "CONTENT4", "TEXT", "Strength and Durability", 0),
("WFB", "TABLECONTENT", "CONTENT5", "TEXT", "Advantages", 0),
("WFB", "TABLECONTENT", "CONTENT6", "TEXT", "Comparative Cost Analysis", 0),
("WFB", "WFB", "TITLE1", "TEXT", "What is Precast Wall Form Blocks?", 0),
("WFB", "WFB", "PARAGRAPH1", "TEXT", "Its a patented Filipino invention of a new type of construction material that greatly reduces the time and cost of constructing a house, building or wall.", 0),
("WFB", "WFB", "PARAGRAPH2", "TEXT", "Precast concrete wall form block is made up of a pair of concrete panel with indigenous reinforcing material such as bamboo sticks, a layer of finished outer surface and a number of arranged dowels disposed on the inner rough surface that when assembled together creates a space in between that allows the installation of the electrical and plumbing pipes before filling up with cement, mortar and the likes that provides an instant wall without the need for costly finishing and painting jobs afterwards.", 0),
("WFB", "WFB", "PARAGRAPH3", "TEXT", "It eliminates the use of Conventional Hollow Blocks (CHB) without sacrificing the strength, durability and sturdiness.", 0),
("WFB", "WFB", "PARAGRAPH4", "TEXT", "The outer surface is smooth finished, thus eliminating the finishing jobs required when using a conventional hollow blocks. NO PLASTERING NEEDED.", 0),
("WFB", "WFB", "PARAGRAPH5", "TEXT", "Manufactured by casting concrete into a mold. The filled mold is cured in a controlled environment to ensure the quality of the product and will then be delivered to project site for installation.", 0),
("WFB", "WFB", "IMAGE1", "IMAGE", "wfb1-default.webp", 0),
("WFB", "WFB", "IMAGE2", "IMAGE", "wfb2-default.webp", 0),
("WFB", "DESIGNS", "TITLE1", "TEXT", "Wall Form Blocks Design", 0),
("WFB", "DIMENSIONS", "TITLE1", "TEXT", "Dimensions and Sizes", 0),
("WFB", "DIMENSIONS", "DETAIL1", "TEXT", "Thickness: 4” 5” 6” and 8”", 0),
("WFB", "DIMENSIONS", "DETAIL2", "TEXT", "Length: 1 meter(Standard)", 0),
("WFB", "DIMENSIONS", "DETAIL3", "TEXT", "Height: 0.25 meter", 0),
("WFB", "DIMENSIONS", "IMAGE1", "IMAGE", "dimensions-default.webp", 0),
("WFB", "STRENGTH", "TITLE1", "TEXT", "Strength and Durability", 0),
("WFB", "STRENGTH", "LABEL1", "TEXT", "Strength and Durability:", 0),
("WFB", "STRENGTH", "DETAIL1", "TEXT", "2500-3500 Per square inch(PSI)", 0),
("WFB", "STRENGTH", "LABEL2", "TEXT", "PSI:", 0),
("WFB", "STRENGTH", "DETAIL2", "TEXT", "measures the strength of a concrete to carry a load.", 0),
("WFB", "STRENGTH", "IMAGE1", "IMAGE", "strength-default.webp", 0);

-- for user guide page
INSERT INTO content (page, section, name, type, object, `default`) VALUES
("USERGUIDE", "HERO", "TITLE1", "TEXT", "User Guide", 1),
("USERGUIDE", "HERO", "CAPTION1", "TEXT", "Two step-by-step guides for ordering and installing our Precast Wall Form Blocks.", 1),
("USERGUIDE", "HERO", "BUTTON", "TEXT", "Click Me to Learn!", 1),
("USERGUIDE", "PRECONTENT", "TITLE1", "TEXT", "Before you start, read this", 1),
("USERGUIDE", "PRECONTENT", "PARAGRAPH1", "TEXT", "This page contains two step-by-step guides about how to order and install our Precast Wall Form Blocks. This will walk you through every step you need to get our product at your doorstep and learn the installation to be able to do it with your own hands.", 1),
("USERGUIDE", "PRECONTENT", "PARAGRAPH2", "TEXT", "It won’t take long, and it will be worth your time as it can guide you thoroughly.", 1),
("USERGUIDE", "TABLECONTENT", "TITLE1", "TEXT", "Table of Contents", 1),
("USERGUIDE", "TABLECONTENT", "CONTENT1", "TEXT", "How to Order Wall Form Blocks", 1),
("USERGUIDE", "TABLECONTENT", "CONTENT2", "TEXT", "How to Install H&A's Precast Wall Form Blocks", 1),
("USERGUIDE", "CONTENT1", "TITLE1", "TEXT", "How to Order Wall Form Blocks?", 1),
("USERGUIDE", "CONTENT1", "STEP1", "TEXT", "Step 1: Add to Cart", 1),
("USERGUIDE", "CONTENT1", "PARAGRAPH1", "TEXT", "First add to cart the wall form blocks that you are planning to get from the sidebar.", 1),
("USERGUIDE", "CONTENT1", "IMAGE1", "IMAGE", "Step1default.webp", 1),
("USERGUIDE", "CONTENT1", "STEP2", "TEXT", "Step 2: Select Orders", 1),
("USERGUIDE", "CONTENT1", "PARAGRAPH2", "TEXT", "Select the wall form blocks in your cart tab that you want to order.", 1),
("USERGUIDE", "CONTENT1", "IMAGE2", "IMAGE", "Step2default.webp", 1),
("USERGUIDE", "CONTENT1", "STEP3", "TEXT", "Step 3: Message for Billing", 1),
("USERGUIDE", "CONTENT1", "PARAGRAPH3", "TEXT", "Once the order is sent, click the message button in the orders tab to initiate the chat with the owner.", 1),
("USERGUIDE", "CONTENT1", "IMAGE3", "IMAGE", "Step3default.webp", 1),
("USERGUIDE", "CONTENT1", "STEP4", "TEXT", "Step 4: Add Quotations", 1),
("USERGUIDE", "CONTENT1", "PARAGRAPH4", "TEXT", "While chatting, both parties have an option to add quotation.", 1),
("USERGUIDE", "CONTENT1", "IMAGE4", "IMAGE", "Step4default.webp", 1),
("USERGUIDE", "CONTENT1", "STEP5", "TEXT", "Step 5: Approve Quotations", 1),
("USERGUIDE", "CONTENT1", "PARAGRAPH5", "TEXT", "The receiving end of the quotation must agree to that price.", 1),
("USERGUIDE", "CONTENT1", "IMAGE5", "IMAGE", "Step5default.webp", 1),
("USERGUIDE", "CONTENT1", "STEP6", "TEXT", "Step 6: Close Deal", 1),
("USERGUIDE", "CONTENT1", "PARAGRAPH6", "TEXT", "Finally, when both agreed to the quotation, the deal is closed.", 1),
("USERGUIDE", "CONTENT1", "IMAGE6", "IMAGE", "Step6default.webp", 1),
("USERGUIDE", "CONTENT2", "TITLE1", "TEXT", "How to Install Wall Form Blocks?", 1),
("USERGUIDE", "CONTENT2", "STEP1", "TEXT", "Step 1: ", 1),
("USERGUIDE", "CONTENT2", "PARAGRAPH1", "TEXT", "Determine the width of your wall, then measure the perimeter of the footing area.", 1),
("USERGUIDE", "CONTENT2", "STEP2", "TEXT", "Step 2: ", 1),
("USERGUIDE", "CONTENT2", "PARAGRAPH2", "TEXT", "Mark the perimeter with stake and tie a string along the perimeter.", 1),
("USERGUIDE", "CONTENT2", "STEP3", "TEXT", "Step 3: ", 1),
("USERGUIDE", "CONTENT2", "PARAGRAPH3", "TEXT", "Dig for the foundation. Usually, 2 rows of form blocks are used as foundation. So, dig 1/2 meter deep and width depends on the size of form blocks you're going to use.", 1),
("USERGUIDE", "CONTENT2", "STEP4", "TEXT", "Step 4: ", 1),
("USERGUIDE", "CONTENT2", "PARAGRAPH4", "TEXT", "After digging, you can already place the first row of form blocks. Make sure that it is aligned.", 1),
("USERGUIDE", "CONTENT2", "STEP5", "TEXT", "Step 5: ", 1),
("USERGUIDE", "CONTENT2", "PARAGRAPH5", "TEXT", "Put at least 1 vertical reinforcement per form block. Advisable, put it at the center of each form block.", 1),
("USERGUIDE", "CONTENT2", "STEP6", "TEXT", "Step 6: ", 1),
("USERGUIDE", "CONTENT2", "PARAGRAPH6", "TEXT", "Then, pour the concrete mix infill.", 1),
("USERGUIDE", "CONTENT2", "STEP7", "TEXT", "Step 7: ", 1),
("USERGUIDE", "CONTENT2", "PARAGRAPH7", "TEXT", "Put at least 3-4 rows of form blocks with infill then let it cure for 2 hours before you place another set of rows.", 1),
("USERGUIDE", "CONTENT2", "NOTE", "TEXT", "Note: Always check if the installation is vertically aligned. If the length has an excess, you can cut the form blocks using a grinder.", 1),
("USERGUIDE", "CONTENT2", "VIDEO", "VIDEO", "videoDefault.mp4", 1),
("USERGUIDE", "HERO", "TITLE1", "TEXT", "User Guide", 0),
("USERGUIDE", "HERO", "CAPTION1", "TEXT", "Two step-by-step guides for ordering and installing our Precast Wall Form Blocks.", 0),
("USERGUIDE", "HERO", "BUTTON", "TEXT", "Click Me to Learn!", 0),
("USERGUIDE", "PRECONTENT", "TITLE1", "TEXT", "Before you start, read this", 0),
("USERGUIDE", "PRECONTENT", "PARAGRAPH1", "TEXT", "This page contains two step-by-step guides about how to order and install our Precast Wall Form Blocks. This will walk you through every step you need to get our product at your doorstep and learn the installation to be able to do it with your own hands.", 0),
("USERGUIDE", "PRECONTENT", "PARAGRAPH2", "TEXT", "It won’t take long, and it will be worth your time as it can guide you thoroughly.", 0),
("USERGUIDE", "TABLECONTENT", "TITLE1", "TEXT", "Table of Contents", 0),
("USERGUIDE", "TABLECONTENT", "CONTENT1", "TEXT", "How to Order Wall Form Blocks", 0),
("USERGUIDE", "TABLECONTENT", "CONTENT2", "TEXT", "How to Install H&A's Precast Wall Form Blocks", 0),
("USERGUIDE", "CONTENT1", "TITLE1", "TEXT", "How to Order Wall Form Blocks?", 0),
("USERGUIDE", "CONTENT1", "STEP1", "TEXT", "Step 1: Add to Cart", 0),
("USERGUIDE", "CONTENT1", "PARAGRAPH1", "TEXT", "First add to cart the wall form blocks that you are planning to get from the sidebar.", 0),
("USERGUIDE", "CONTENT1", "IMAGE1", "IMAGE", "Step1default.webp", 0),
("USERGUIDE", "CONTENT1", "STEP2", "TEXT", "Step 2: Select Orders", 0),
("USERGUIDE", "CONTENT1", "PARAGRAPH2", "TEXT", "Select the wall form blocks in your cart tab that you want to order.", 0),
("USERGUIDE", "CONTENT1", "IMAGE2", "IMAGE", "Step2default.webp", 0),
("USERGUIDE", "CONTENT1", "STEP3", "TEXT", "Step 3: Message for Billing", 0),
("USERGUIDE", "CONTENT1", "PARAGRAPH3", "TEXT", "Once the order is sent, click the message button in the orders tab to initiate the chat with the owner.", 0),
("USERGUIDE", "CONTENT1", "IMAGE3", "IMAGE", "Step3default.webp", 0),
("USERGUIDE", "CONTENT1", "STEP4", "TEXT", "Step 4: Add Quotations", 0),
("USERGUIDE", "CONTENT1", "PARAGRAPH4", "TEXT", "While chatting, both parties have an option to add quotation.", 0),
("USERGUIDE", "CONTENT1", "IMAGE4", "IMAGE", "Step4default.webp", 0),
("USERGUIDE", "CONTENT1", "STEP5", "TEXT", "Step 5: Approve Quotations", 0),
("USERGUIDE", "CONTENT1", "PARAGRAPH5", "TEXT", "The receiving end of the quotation must agree to that price.", 0),
("USERGUIDE", "CONTENT1", "IMAGE5", "IMAGE", "Step5default.webp", 0),
("USERGUIDE", "CONTENT1", "STEP6", "TEXT", "Step 6: Close Deal", 0),
("USERGUIDE", "CONTENT1", "PARAGRAPH6", "TEXT", "Finally, when both agreed to the quotation, the deal is closed.", 0),
("USERGUIDE", "CONTENT1", "IMAGE6", "IMAGE", "Step6default.webp", 0),
("USERGUIDE", "CONTENT2", "TITLE1", "TEXT", "How to Install Wall Form Blocks?", 0),
("USERGUIDE", "CONTENT2", "STEP1", "TEXT", "Step 1: ", 0),
("USERGUIDE", "CONTENT2", "PARAGRAPH1", "TEXT", "Determine the width of your wall, then measure the perimeter of the footing area.", 0),
("USERGUIDE", "CONTENT2", "STEP2", "TEXT", "Step 2: ", 0),
("USERGUIDE", "CONTENT2", "PARAGRAPH2", "TEXT", "Mark the perimeter with stake and tie a string along the perimeter.", 0),
("USERGUIDE", "CONTENT2", "STEP3", "TEXT", "Step 3: ", 0),
("USERGUIDE", "CONTENT2", "PARAGRAPH3", "TEXT", "Dig for the foundation. Usually, 2 rows of form blocks are used as foundation. So, dig 1/2 meter deep and width depends on the size of form blocks you're going to use.", 0),
("USERGUIDE", "CONTENT2", "STEP4", "TEXT", "Step 4: ", 0),
("USERGUIDE", "CONTENT2", "PARAGRAPH4", "TEXT", "After digging, you can already place the first row of form blocks. Make sure that it is aligned.", 0),
("USERGUIDE", "CONTENT2", "STEP5", "TEXT", "Step 5: ", 0),
("USERGUIDE", "CONTENT2", "PARAGRAPH5", "TEXT", "Put at least 1 vertical reinforcement per form block. Advisable, put it at the center of each form block.", 0),
("USERGUIDE", "CONTENT2", "STEP6", "TEXT", "Step 6: ", 0),
("USERGUIDE", "CONTENT2", "PARAGRAPH6", "TEXT", "Then, pour the concrete mix infill.", 0),
("USERGUIDE", "CONTENT2", "STEP7", "TEXT", "Step 7: ", 0),
("USERGUIDE", "CONTENT2", "PARAGRAPH7", "TEXT", "Put at least 3-4 rows of form blocks with infill then let it cure for 2 hours before you place another set of rows.", 0),
("USERGUIDE", "CONTENT2", "NOTE", "TEXT", "Note: Always check if the installation is vertically aligned. If the length has an excess, you can cut the form blocks using a grinder.", 0),
("USERGUIDE", "CONTENT2", "VIDEO", "VIDEO", "videoDefault.mp4", 0);

-- for projects page
INSERT INTO content (page, section, name, type, object, `default`) VALUES
("PROJECTS", "HERO", "TITLE1", "TEXT", "Projects", 1),
("PROJECTS", "HERO", "CAPTION1", "TEXT", "If you can dream it, you can build it", 1),
("PROJECTS", "HERO", "BUTTON", "TEXT", "View Projects", 1),
("PROJECTS", "PROJECTS", "TITLE1", "TEXT", "Hover through our Projects", 1),
("PROJECTS", "HERO", "TITLE1", "TEXT", "Projects", 0),
("PROJECTS", "HERO", "CAPTION1", "TEXT", "If you can dream it, you can build it", 0),
("PROJECTS", "HERO", "BUTTON", "TEXT", "View Projects", 0),
("PROJECTS", "PROJECTS", "TITLE1", "TEXT", "Hover through our Projects", 0);

-- for contact us page
INSERT INTO content (page, section, name, type, object, `default`) VALUES
('CONTACT', 'HERO', 'TITLE1', 'TEXT', 'Contact us', 1),
('CONTACT', 'CONTACTS', 'GMAPSEMBED', 'TEXT', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3846.6834630674853!2d120.93936827433022!3d15.393619957171632!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33972773c9fc2c59%3A0x59fd767d1ff714f3!2sH%26AS&#39;%20Precast%20Wall%20Form%20Blocks!5e0!3m2!1sen!2sph!4v1704774812073!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 1),
('CONTACT', 'CONTACTS', 'ADDRESS', 'TEXT', '258, Tabuating, San Leonardo, Nueva Ecija, San Leonardo, Philippines', 1),
('CONTACT', 'CONTACTS', 'EMAIL', 'TEXT', 'haoc.trading@gmail.com', 1),
('CONTACT', 'CONTACTS', 'CONTACTNO1', 'TEXT', '09165483343', 1),
('CONTACT', 'CONTACTS', 'CONTACTNO2', 'TEXT', '09608730358', 1),
('CONTACT', 'HERO', 'TITLE1', 'TEXT', 'Contact us', 0),
('CONTACT', 'CONTACTS', 'GMAPSEMBED', 'TEXT', '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3846.6834630674853!2d120.93936827433022!3d15.393619957171632!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33972773c9fc2c59%3A0x59fd767d1ff714f3!2sH%26AS&#39;%20Precast%20Wall%20Form%20Blocks!5e0!3m2!1sen!2sph!4v1704774812073!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 0),
('CONTACT', 'CONTACTS', 'ADDRESS', 'TEXT', '258, Tabuating, San Leonardo, Nueva Ecija, San Leonardo, Philippines', 0),
('CONTACT', 'CONTACTS', 'EMAIL', 'TEXT', 'haoc.trading@gmail.com', 0),
('CONTACT', 'CONTACTS', 'CONTACTNO1', 'TEXT', '09165483343', 0),
('CONTACT', 'CONTACTS', 'CONTACTNO2', 'TEXT', '09608730358', 0);

-- for projects content
INSERT INTO `projects` (`name`, `description`, `type`, `location`, `icon`, `mainImage`, `subImage1`, `subImage2`, `default`) VALUES
('card1', '3 Storey', 'House', 'Bongabon, Nueva Ecija', 'House.svg', 'card1-main.webp', 'card1img1.webp', 'card1img2.webp', 1),
('card2', '22 Buildings', 'Government', 'Palayan City, Nueva Ecija', 'City.svg', 'card2-main.webp', 'card2img1.webp', 'card2img2.webp', 1),
('card3', '3 Storey', 'Townhouse', 'Baguio City', 'House.svg', 'card3-main.webp', 'card3img1.webp', 'card3img2.webp', 1),
('card4', 'Ongoing', 'House', 'Mexico, Pampanga', 'House.svg', 'card4-main.webp', 'card4img1.webp', 'card4img2.webp', 1),
('card5', '2 Storey', 'House', 'Bocaue, Bulacan', 'House.svg', 'card5-main.webp', 'card5img1.webp', 'card5img2.webp', 1),
('card6', 'Bungalow', 'House', 'Gapan City, Nueva Ecija', 'House.svg', 'card6-main.webp', 'card6img1.webp', 'card6img2.webp', 1),
('card7', '2 Storey', 'Townhouse', 'San Fernando, Pampanga', 'House.svg', 'card7-main.webp', 'card7img1.webp', 'card7img2.webp', 1),
('card1', '3 Storey', 'House', 'Bongabon, Nueva Ecija', 'House.svg', 'card1-main.webp', 'card1img1.webp', 'card1img2.webp', 0),
('card2', '22 Buildings', 'Government', 'Palayan City, Nueva Ecija', 'City.svg', 'card2-main.webp', 'card2img1.webp', 'card2img2.webp', 0),
('card3', '3 Storey', 'Townhouse', 'Baguio City', 'House.svg', 'card3-main.webp', 'card3img1.webp', 'card3img2.webp', 0),
('card4', 'Ongoing', 'House', 'Mexico, Pampanga', 'House.svg', 'card4-main.webp', 'card4img1.webp', 'card4img2.webp', 0),
('card5', '2 Storey', 'House', 'Bocaue, Bulacan', 'House.svg', 'card5-main.webp', 'card5img1.webp', 'card5img2.webp', 0),
('card6', 'Bungalow', 'House', 'Gapan City, Nueva Ecija', 'House.svg', 'card6-main.webp', 'card6img1.webp', 'card6img2.webp', 0),
('card7', '2 Storey', 'Townhouse', 'San Fernando, Pampanga', 'House.svg', 'card7-main.webp', 'card7img1.webp', 'card7img2.webp', 0);

-- for wall form block content
INSERT INTO `wall_form_block` (`name`, `design_name`, `description`, `cart_image`, `wfb_image`, `status`, `default`) VALUES
('V-Cut', 'V-Cut', 'If you\'re looking to approach your project in a sophisticated way, this style is for you. The wall form blocks feature little gaps between one another and are designed to be stacked horizontally', 'v-cut-default.webp', 'v-cut-cart-default.webp', 'AVAIL', 1),
('Shiplap', 'Shiplap', 'If you desire the structure of your wall with a more depth, then this design is for you. The wall form blocks feature just a slight gap and a little bit elevated in-between them after they are set and aligned horizontally.', 'shiplap-default.webp', 'shiplap-cart-default.webp', 'AVAIL', 1),
('Conventional', 'Conventional', 'To keep your project\'s construction simple, this style will suit you. The wall form blocks adhere to the classical horizontal stacking construction.', 'conventional-default.webp', 'conventional-cart-default.webp', 'AVAIL', 1),
('V-Cut', 'V-Cut', 'If you\'re looking to approach your project in a sophisticated way, this style is for you. The wall form blocks feature little gaps between one another and are designed to be stacked horizontally', 'v-cut-default.webp', 'v-cut-cart-default.webp', 'AVAIL', 0),
('Shiplap', 'Shiplap', 'If you desire the structure of your wall with a more depth, then this design is for you. The wall form blocks feature just a slight gap and a little bit elevated in-between them after they are set and aligned horizontally.', 'shiplap-default.webp', 'shiplap-cart-default.webp', 'AVAIL', 0),
('Conventional', 'Conventional', 'To keep your project\'s construction simple, this style will suit you. The wall form blocks adhere to the classical horizontal stacking construction.', 'conventional-default.webp', 'conventional-cart-default.webp', 'AVAIL', 0);
