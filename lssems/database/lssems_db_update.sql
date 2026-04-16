-- ================================================
-- LSSEMS Database Update - New Tables
-- Run this after the base lssems_db.sql
-- ================================================

-- Messages table (if not exists)
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `sender_name` varchar(200) NOT NULL,
  `sender_email` varchar(200) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `message` text NOT NULL,
  `reply` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=unread, 1=read',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Password Resets table
CREATE TABLE IF NOT EXISTS `password_resets` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_token` (`token`),
  KEY `idx_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Bookings table
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `user_id` int(30) NOT NULL,
  `provider_id` int(30) NOT NULL,
  `service_id` int(30) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=confirmed, 2=completed, 3=cancelled',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_user` (`user_id`),
  KEY `idx_provider` (`provider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Reviews/Ratings table
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `user_id` int(30) NOT NULL,
  `provider_id` int(30) NOT NULL,
  `rating` tinyint(1) NOT NULL DEFAULT 5,
  `review` text DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_provider` (`provider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add missing columns to users table if they dont exist
ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `email` varchar(200) DEFAULT NULL AFTER `username`;
ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `middlename` varchar(200) DEFAULT NULL AFTER `firstname`;
ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `contact` varchar(50) DEFAULT NULL AFTER `email`;
ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `address` text DEFAULT NULL AFTER `contact`;
ALTER TABLE `users` ADD COLUMN IF NOT EXISTS `avatar` text DEFAULT NULL AFTER `address`;
