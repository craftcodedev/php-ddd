GRANT ALL PRIVILEGES ON * . * TO 'user'@'%';
FLUSH PRIVILEGES;
DROP DATABASE app;
CREATE DATABASE IF NOT EXISTS app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
use app;
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
`id` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
`email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
`password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
`first_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
`last_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
`phone` varchar(30) COLLATE utf8mb4_unicode_ci default '',
`roles` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
`status` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
`created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
`updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
UNIQUE KEY `email_roles` (`email`, `roles`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
 `hash` TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
 `user_id` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
 `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
 `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `domain_event`;
CREATE TABLE `domain_event` (
    `id` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
    `origin` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    `aggregate_id` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
    `body` TEXT NOT NULL,
    `version` TINYINT(2) NOT NULL,
    `occurred_on` timestamp DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;