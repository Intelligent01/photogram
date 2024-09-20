-- Adminer 4.8.1 MySQL 8.3.0 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `captain_ecom` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `captain_ecom`;

DROP TABLE IF EXISTS `auth`;
CREATE TABLE `auth` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(22) NOT NULL,
  `email` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `phone` varchar(10) NOT NULL,
  `blocked` int NOT NULL DEFAULT '0',
  `active` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `email` (`email`(40))
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

INSERT INTO `auth` (`id`, `username`, `email`, `password`, `phone`, `blocked`, `active`) VALUES
(1,	'loko',	'loki@loki.com',	'$argon2i$v=19$m=65536,t=4,p=1$dzJZaTFIM1lNZ29Ta0Y0ZQ$51dTswR98QEKlV4GzTLM647+kByi/KBJXJPlu6YCuJA',	'987654321',	0,	1),
(2,	'thor',	'thor@thor.com',	'$argon2i$v=19$m=65536,t=4,p=1$d1UvRnpkL3ZaS3pxZHAzSA$xb8ubcoQ1sCBg+JgFJIXn7FeD5ErD9b3fbgwA3i15ok',	'thor',	0,	1);

DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uid` int NOT NULL,
  `login_time` datetime NOT NULL,
  `token` varchar(32) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `user_agent` varchar(256) NOT NULL,
  `active` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  CONSTRAINT `session_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `auth` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `session` (`id`, `uid`, `login_time`, `token`, `ip`, `user_agent`, `active`) VALUES
(7,	1,	'2024-09-20 17:24:12',	'0cc4e32e054ebea493cfc20c184b6373',	'10.11.3.171',	'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:129.0) Gecko/20100101 Firefox/129.0',	1),
(11,	1,	'2024-09-20 17:24:12',	'0acd20c9ac5dbfa429095f69e7373ccd',	'10.11.1.184',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36 Edg/129.0.0.0',	1);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL,
  `bio` longtext NOT NULL,
  `avatar` varchar(1024) NOT NULL,
  `first_name` tinytext NOT NULL,
  `last_name` tinytext NOT NULL,
  `dob` date NOT NULL,
  `instagram` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `facebook` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `youtube` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id`) REFERENCES `auth` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `users` (`id`, `bio`, `avatar`, `first_name`, `last_name`, `dob`, `instagram`, `facebook`, `youtube`) VALUES
(1,	'welcome',	'avatar',	'captain',	'jack sparrow',	'2024-07-23',	'thirudde',	NULL,	NULL);

-- 2024-09-20 17:33:46
