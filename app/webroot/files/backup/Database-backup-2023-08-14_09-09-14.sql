-- Database: `dm`
-- Generation time: Mon 14th Aug 2023 09:09:14


DROP TABLE IF EXISTS announcements;

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `permission` int(1) NOT NULL,
  `read` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS backup;

CREATE TABLE `backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `file_size` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS company;

CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groups` mediumtext DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `address` mediumtext NOT NULL,
  `city` varchar(250) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `website` varchar(255) NOT NULL,
  `skype` mediumtext NOT NULL,
  `facebook` mediumtext NOT NULL,
  `linkedIn` mediumtext NOT NULL,
  `twitter` mediumtext NOT NULL,
  `youtube` mediumtext DEFAULT NULL,
  `google_plus` mediumtext DEFAULT NULL,
  `pinterest` mediumtext DEFAULT NULL,
  `tumblr` mediumtext DEFAULT NULL,
  `instagram` mediumtext DEFAULT NULL,
  `github` mediumtext DEFAULT NULL,
  `digg` mediumtext DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `id_2` (`id`),
  KEY `id_3` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO company VALUES('1',NULL,'Company Demo','3452357809','company@example.com','Demo Address','California','USA','123456','USA','Demo company description is here','','','','','','','','','','','','','2018-10-30 00:56:46','2018-10-30 00:56:46');



DROP TABLE IF EXISTS contact;

CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` mediumtext NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip_code` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `location` varchar(100) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `website` mediumtext DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `linkedIn` varchar(100) NOT NULL,
  `skype` varchar(100) NOT NULL,
  `youtube` mediumtext DEFAULT NULL,
  `google_plus` mediumtext DEFAULT NULL,
  `pinterest` mediumtext DEFAULT NULL,
  `tumblr` mediumtext DEFAULT NULL,
  `instagram` mediumtext DEFAULT NULL,
  `github` mediumtext DEFAULT NULL,
  `digg` mediumtext DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `company_id` (`company_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS contact_deals;

CREATE TABLE `contact_deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_id` (`contact_id`),
  KEY `deal_id` (`deal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS custom_company;

CREATE TABLE `custom_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `custom_id` int(11) NOT NULL,
  `value` text NOT NULL,
  `company_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `custom_id` (`custom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS custom_contacts;

CREATE TABLE `custom_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `custom_id` int(11) NOT NULL,
  `value` text NOT NULL,
  `contact_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS custom_deals;

CREATE TABLE `custom_deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `custom_id` int(11) NOT NULL,
  `value` text NOT NULL,
  `deal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO custom_deals VALUES('1','1','','1');



DROP TABLE IF EXISTS custom_fields;

CREATE TABLE `custom_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` int(2) NOT NULL,
  `module` int(2) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO custom_fields VALUES('1','Custom Field','1','1','2018-10-29 23:23:23');
INSERT INTO custom_fields VALUES('2','Custom Field','1','2','2018-10-29 23:23:38');
INSERT INTO custom_fields VALUES('3','Custom Field','1','3','2018-10-29 23:24:17');



DROP TABLE IF EXISTS deal;

CREATE TABLE `deal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `stage_id` int(11) NOT NULL,
  `pipeline_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `permission` mediumtext DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `stage_id` (`stage_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO deal VALUES('1','Meeting UBC','400','0','1','16','4','1','1',NULL,'2023-08-11 16:08:14','2023-08-11 16:16:28');



DROP TABLE IF EXISTS discussion;

CREATE TABLE `discussion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` mediumtext NOT NULL,
  `deal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent` int(2) NOT NULL DEFAULT 0,
  `type` int(1) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS events;

CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `color` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS expenses;

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,2) NOT NULL,
  `deal_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS expenses_category;

CREATE TABLE `expenses_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO expenses_category VALUES('1','Expense Category','Description');



DROP TABLE IF EXISTS files;

CREATE TABLE `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS history;

CREATE TABLE `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deal_id` int(11) NOT NULL,
  `deal_name` varchar(255) NOT NULL,
  `reason` mediumtext DEFAULT NULL,
  `pipeline` varchar(250) NOT NULL,
  `stage` varchar(250) NOT NULL,
  `user` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT 0,
  `status` smallint(2) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS invoice_products;

CREATE TABLE `invoice_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` mediumtext NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_unit_price` decimal(10,2) NOT NULL,
  `product_total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS invoices;

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `custom_id` varchar(255) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `deal_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `currency` varchar(250) DEFAULT NULL,
  `note` mediumtext DEFAULT NULL,
  `discount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `custom_tax` decimal(10,2) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS label_deals;

CREATE TABLE `label_deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS labels;

CREATE TABLE `labels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `pipeline_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO labels VALUES('1','Service','label-one','1');
INSERT INTO labels VALUES('2','Social','label-two','1');
INSERT INTO labels VALUES('3','Digital','label-three','1');
INSERT INTO labels VALUES('4','almost done','label-one','5');
INSERT INTO labels VALUES('5','breaking deal','label-six','5');



DROP TABLE IF EXISTS message;

CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` mediumtext NOT NULL,
  `message_to` int(11) NOT NULL,
  `message_by` int(11) NOT NULL,
  `read` int(1) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO message VALUES('1','hello','2','1','0','2023-08-11 16:43:13');



DROP TABLE IF EXISTS note_deals;

CREATE TABLE `note_deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS notes;

CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `color` varchar(50) NOT NULL,
  `text_color` varchar(50) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




DROP TABLE IF EXISTS payment_methods;

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO payment_methods VALUES('1','Cash');
INSERT INTO payment_methods VALUES('2','Bank Transfer');



DROP TABLE IF EXISTS payments;

CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `deal_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `method` int(11) NOT NULL,
  `note` mediumtext DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS pipeline;

CREATE TABLE `pipeline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO pipeline VALUES('3','Visitation','2023-08-11 15:33:18');
INSERT INTO pipeline VALUES('4','Services','2023-08-11 15:33:34');
INSERT INTO pipeline VALUES('5','Issue','2023-08-14 08:23:17');



DROP TABLE IF EXISTS pipeline_permission;

CREATE TABLE `pipeline_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pipeline_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS product_deals;

CREATE TABLE `product_deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `discount` float NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS products;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS settings;

CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` int(2) NOT NULL,
  `title_text` varchar(255) NOT NULL,
  `title_logo` varchar(255) NOT NULL,
  `language` varchar(50) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `currency_symbol` varchar(10) NOT NULL,
  `date_format` varchar(100) NOT NULL,
  `time_format` varchar(10) NOT NULL,
  `time_zone` varchar(50) NOT NULL,
  `pipeline` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO settings VALUES('1','2','aiDvantage-CRM','dm.png','en','Dollars','$','Y-m-d','g:i A','America/Adak','3');



DROP TABLE IF EXISTS settings_company;

CREATE TABLE `settings_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` mediumtext NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `country` varchar(100) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `system_email` varchar(100) NOT NULL,
  `system_email_from` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO settings_company VALUES('1','aiDvantage-CRM','New York ,USA','New York','New York','160000','USA','12345678','taskmanager@gmail.com','Task Manager');



DROP TABLE IF EXISTS settings_email;

CREATE TABLE `settings_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocol` varchar(255) DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `port` int(10) DEFAULT NULL,
  `message` int(2) NOT NULL DEFAULT 0,
  `ticket` int(2) NOT NULL DEFAULT 0,
  `add_user` int(2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO settings_email VALUES('1','0','','','',NULL,'0','0','0');



DROP TABLE IF EXISTS source;

CREATE TABLE `source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS source_deals;

CREATE TABLE `source_deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS stages;

CREATE TABLE `stages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` int(2) NOT NULL,
  `pipeline_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO stages VALUES('11','Idea','1','3','2023-08-11 15:33:18');
INSERT INTO stages VALUES('12','Qualified','2','3','2023-08-11 15:33:18');
INSERT INTO stages VALUES('13','Proposal','3','3','2023-08-11 15:33:18');
INSERT INTO stages VALUES('14','Negotation','4','3','2023-08-11 15:33:18');
INSERT INTO stages VALUES('15','Final','5','3','2023-08-11 15:33:18');
INSERT INTO stages VALUES('16','Idea','1','4','2023-08-11 15:33:34');
INSERT INTO stages VALUES('17','Qualified','2','4','2023-08-11 15:33:34');
INSERT INTO stages VALUES('18','Proposal','3','4','2023-08-11 15:33:34');
INSERT INTO stages VALUES('19','Negotation','4','4','2023-08-11 15:33:34');
INSERT INTO stages VALUES('20','Final','5','4','2023-08-11 15:33:34');
INSERT INTO stages VALUES('26','Submission','1','5','2023-08-14 08:23:59');
INSERT INTO stages VALUES('27','Assign','2','5','2023-08-14 08:24:12');
INSERT INTO stages VALUES('28','Resolved','3','5','2023-08-14 08:24:33');
INSERT INTO stages VALUES('29','Closed','4','5','2023-08-14 08:24:45');



DROP TABLE IF EXISTS tasks;

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task` mediumtext NOT NULL,
  `motive` int(1) NOT NULL,
  `priority` int(1) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `note` mediumtext DEFAULT NULL,
  `deal_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS taxes;

CREATE TABLE `taxes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO taxes VALUES('1','Vat','10.00');



DROP TABLE IF EXISTS ticket_message;

CREATE TABLE `ticket_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` mediumtext NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS ticket_type;

CREATE TABLE `ticket_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO ticket_type VALUES('1','General','General description');
INSERT INTO ticket_type VALUES('2','Service','Services Description');



DROP TABLE IF EXISTS tickets;

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL DEFAULT 0,
  `subject` varchar(255) NOT NULL,
  `message` mediumtext NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `type_id` int(2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `assign` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `attachment` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS timeline;

CREATE TABLE `timeline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity` varchar(250) NOT NULL,
  `module` varchar(50) NOT NULL,
  `deal_id` int(11) NOT NULL,
  `pipeline_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `deal_id` (`deal_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO timeline VALUES('1','Meeting UBC','add_Deal','1','4','1','Matthew Smith','2023-08-11 16:08:14');
INSERT INTO timeline VALUES('2','Idea to Qualified','move_Stage','1','4','1','Matthew Smith','2023-08-11 16:08:19');
INSERT INTO timeline VALUES('3','Qualified to Proposal','move_Stage','1','4','1','Matthew Smith','2023-08-11 16:08:22');
INSERT INTO timeline VALUES('4','Proposal to Negotation','move_Stage','1','4','1','Matthew Smith','2023-08-11 16:08:22');
INSERT INTO timeline VALUES('5','Negotation to Final','move_Stage','1','4','1','Matthew Smith','2023-08-11 16:08:24');
INSERT INTO timeline VALUES('6','Final to Negotation','move_Stage','1','4','1','Matthew Smith','2023-08-11 16:08:25');
INSERT INTO timeline VALUES('7','Negotation to Qualified','move_Stage','1','4','1','Matthew Smith','2023-08-11 16:08:27');
INSERT INTO timeline VALUES('8','Qualified to Idea','move_Stage','1','4','1','Matthew Smith','2023-08-11 16:08:29');
INSERT INTO timeline VALUES('9','Idea to Final','move_Stage','1','4','1','Matthew Smith','2023-08-11 16:10:07');
INSERT INTO timeline VALUES('10','Services to Services','move_Pipeline','1','4','1','Matthew Smith','2023-08-11 16:16:28');



DROP TABLE IF EXISTS todo;

CREATE TABLE `todo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `todo` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




DROP TABLE IF EXISTS user_deals;

CREATE TABLE `user_deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `deal_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO user_deals VALUES('1','1','1');



DROP TABLE IF EXISTS user_details;

CREATE TABLE `user_details` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `location` varchar(256) DEFAULT NULL,
  `cellphone` varchar(15) DEFAULT NULL,
  `web_page` mediumtext DEFAULT NULL,
  `about` mediumtext DEFAULT NULL,
  `skype` mediumtext DEFAULT NULL,
  `facebook` mediumtext DEFAULT NULL,
  `twitter` mediumtext DEFAULT NULL,
  `google_plus` mediumtext DEFAULT NULL,
  `linkedin` mediumtext DEFAULT NULL,
  `youtube` mediumtext DEFAULT NULL,
  `pinterest` mediumtext DEFAULT NULL,
  `digg` mediumtext DEFAULT NULL,
  `github` mediumtext DEFAULT NULL,
  `instagram` mediumtext DEFAULT NULL,
  `tumblr` mediumtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO user_details VALUES('1','1','1','','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO user_details VALUES('2','2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO user_details VALUES('3','3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO user_details VALUES('4','4',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);



DROP TABLE IF EXISTS user_groups;

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO user_groups VALUES('1','Marketing Team');
INSERT INTO user_groups VALUES('2','Supervising Group');



DROP TABLE IF EXISTS user_roles;

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` smallint(1) NOT NULL,
  `permission` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO user_roles VALUES('1','Admin Role','1','1,2,3,4,5,6,7,8,51');
INSERT INTO user_roles VALUES('2','Staff Role','2','11,12,13,14,21,22,23,24,31,32,33,34,41,42,43,44,51,52,53,54');



DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` varchar(256) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `job_title` varchar(250) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT 0,
  `company_id` int(11) DEFAULT NULL,
  `picture` varchar(255) NOT NULL,
  `active` varchar(3) DEFAULT '0',
  `role` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`username`),
  KEY `mail` (`email`),
  KEY `users_FKIndex1` (`user_group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO users VALUES('1','1','admin@admin.com','12a7b21289d320241dd1f2fcaf536d1a60ca63b2','admin@admin.com','Matthew','Smith','Super Admin','0',NULL,'user.png','1',NULL,'2014-08-20 05:01:54','2018-11-01 01:30:25');
INSERT INTO users VALUES('2','1','john@doe.com','12a7b21289d320241dd1f2fcaf536d1a60ca63b2','john@doe.com','John','Doe','Software Developer','0',NULL,'user.png','1','1','2023-08-11 15:55:10','2023-08-11 15:55:10');
INSERT INTO users VALUES('3','2','nkuru@gideon.com','12a7b21289d320241dd1f2fcaf536d1a60ca63b2','nkuru@gideon.com','Nkuru','Gideon','C.E.O','1',NULL,'user.png','1','2','2023-08-11 15:56:30','2023-08-11 15:56:30');
INSERT INTO users VALUES('4','3','mbabazi@charity.com','12a7b21289d320241dd1f2fcaf536d1a60ca63b2','mbabazi@charity.com','Mbabazi ','Charity','Writer','1',NULL,'user.png','1','2','2023-08-11 15:59:54','2023-08-11 15:59:54');



