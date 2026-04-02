-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2020 at 03:00 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lssems_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` int(30) NOT NULL,
  `area` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `area`, `date_created`) VALUES
(1, 'New York City, New York', '2020-11-20 13:41:39'),
(2, 'Los Angeles, California', '2020-11-20 13:44:34'),
(3, 'Chicago, Illinois', '2020-11-20 13:44:52'),
(4, 'San Diego, Califonia', '2020-11-20 13:47:29');

-- --------------------------------------------------------

--
-- Table structure for table `persons_companies`
--

CREATE TABLE `persons_companies` (
  `id` int(30) NOT NULL,
  `service_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1 = single, 2 = group',
  `contact` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `description` text NOT NULL,
  `areas_id` text NOT NULL,
  `img_path` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `persons_companies`
--

INSERT INTO `persons_companies` (`id`, `service_id`, `name`, `type`, `contact`, `address`, `description`, `areas_id`, `img_path`, `date_created`) VALUES
(1, 3, 'Disinfection Group', 2, '+14526-5455-44', '2407  Ashton Lane, LOS ANGELES, California, 90001', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mattis leo in elit posuere sagittis. Cras tristique, orci vitae sollicitudin blandit, lectus eros dignissim turpis, sed tincidunt massa ipsum vel lacus. Vestibulum dolor lectus, convallis et dignissim et, tempus eget ante. Morbi sed orci tempus arcu interdum porttitor at eget risus. Vestibulum eleifend sit amet dolor sed venenatis. Suspendisse varius erat ac interdum iaculis. Suspendisse potenti. Cras quis urna justo.&lt;/span&gt;&lt;/p&gt;&lt;h2&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 24px; text-align: justify;&quot;&gt;&lt;b&gt;Sample:&lt;/b&gt;&lt;/span&gt;&lt;/h2&gt;&lt;ul&gt;&lt;li&gt;&lt;span style=&quot;font-size: 12px;&quot;&gt;﻿&lt;/span&gt;&lt;span style=&quot;font-size: 14px;&quot;&gt;﻿Sample&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&quot;font-size: 14px;&quot;&gt;Sample&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&quot;font-size: 14px;&quot;&gt;Sample&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&quot;font-size: 14px;&quot;&gt;Sample&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&quot;font-size: 14px;&quot;&gt;Sample&lt;/span&gt;&lt;/li&gt;&lt;li&gt;&lt;span style=&quot;font-size: 14px;&quot;&gt;Sample&lt;/span&gt;&lt;/li&gt;&lt;/ul&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Cras condimentum purus eu lacus pretium bibendum. Sed eu volutpat ex. Pellentesque ac felis ac nulla auctor maximus. Vivamus mattis, sapien ut mattis pulvinar, urna leo feugiat arcu, vel dignissim sapien mauris quis leo. In hac habitasse platea dictumst. Morbi vitae interdum urna. Nam semper sagittis congue. Proin aliquam nisl sit amet ex porta varius. Sed blandit hendrerit lectus et facilisis. Quisque molestie felis a consectetur vulputate. Aliquam tristique, mauris ut consectetur dapibus, enim lorem cursus libero, vel dictum nunc lectus vel dui. Nunc efficitur est id pellentesque viverra. Nulla facilisi.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', '2,4', '1605855240_47446233-clean-noir-et-gradient-sombre-image-de-fond-abstrait-.jpg', '2020-11-20 14:45:25'),
(2, 1, 'John Smith', 1, '+18456-5455-55', 'Sample address', '&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mattis leo in elit posuere sagittis. Cras tristique, orci vitae sollicitudin blandit, lectus eros dignissim turpis, sed tincidunt massa ipsum vel lacus. Vestibulum dolor lectus, convallis et dignissim et, tempus eget ante. Morbi sed orci tempus arcu interdum porttitor at eget risus. Vestibulum eleifend sit amet dolor sed venenatis. Suspendisse varius erat ac interdum iaculis. Suspendisse potenti. Cras quis urna justo.&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px;&quot;&gt;Cras condimentum purus eu lacus pretium bibendum. Sed eu volutpat ex. Pellentesque ac felis ac nulla auctor maximus. Vivamus mattis, sapien ut mattis pulvinar, urna leo feugiat arcu, vel dignissim sapien mauris quis leo. In hac habitasse platea dictumst. Morbi vitae interdum urna. Nam semper sagittis congue. Proin aliquam nisl sit amet ex porta varius. Sed blandit hendrerit lectus et facilisis. Quisque molestie felis a consectetur vulputate. Aliquam tristique, mauris ut consectetur dapibus, enim lorem cursus libero, vel dictum nunc lectus vel dui. Nunc efficitur est id pellentesque viverra. Nulla facilisi.&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px;&quot;&gt;Curabitur rutrum pharetra dui at condimentum. Praesent lacus neque, tempus quis magna a, congue laoreet dui. Mauris at tellus aliquam, ultricies ipsum blandit, mollis ante. Donec ullamcorper felis felis, ut feugiat arcu aliquet consectetur. Nullam leo velit, euismod eu malesuada non, rutrum quis arcu. Proin tortor orci, fringilla non quam id, tempor semper diam. Etiam sit amet aliquam erat, eu eleifend est. Morbi dictum justo in ligula egestas semper. Aenean sollicitudin est quis mi ullamcorper, a dapibus nisl mattis.&lt;/p&gt;', '2,1,4', '1605855780_avatar.jpg', '2020-11-20 15:03:11'),
(3, 1, 'Sample', 1, '+12354687', 'Sample address', '&lt;p&gt;Sample&lt;/p&gt;', '3,2,1,4', '1605918720_avatar2.png', '2020-11-21 08:32:50'),
(4, 2, 'Sample Company', 2, '+1234568789', 'Sample Address', '&lt;p&gt;Sample only&lt;/p&gt;', '3,2,4', '1605923700_47446233-clean-noir-et-gradient-sombre-image-de-fond-abstrait-.jpg', '2020-11-21 09:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(30) NOT NULL,
  `service` text NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service`, `description`, `date_created`) VALUES
(1, 'Plumbing Services', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam mattis leo in elit posuere sagittis. Cras tristique, orci vitae sollicitudin blandit, lectus eros dignissim turpis, sed tincidunt massa ipsum vel lacus. Vestibulum dolor lectus, convallis et dignissim et, tempus eget ante. Morbi sed orci tempus arcu interdum porttitor at eget risus. Vestibulum eleifend sit amet dolor sed venenatis. Suspendisse varius erat ac interdum iaculis. Suspendisse potenti. Cras quis urna justo.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', '2020-11-20 13:58:44'),
(2, 'Gardening Services', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Cras condimentum purus eu lacus pretium bibendum. Sed eu volutpat ex. Pellentesque ac felis ac nulla auctor maximus. Vivamus mattis, sapien ut mattis pulvinar, urna leo feugiat arcu, vel dignissim sapien mauris quis leo. In hac habitasse platea dictumst. Morbi vitae interdum urna. Nam semper sagittis congue. Proin aliquam nisl sit amet ex porta varius. Sed blandit hendrerit lectus et facilisis. Quisque molestie felis a consectetur vulputate. Aliquam tristique, mauris ut consectetur dapibus, enim lorem cursus libero, vel dictum nunc lectus vel dui. Nunc efficitur est id pellentesque viverra. Nulla facilisi.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', '2020-11-20 13:59:53'),
(3, 'Disinfection Services', '&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Curabitur rutrum pharetra dui at condimentum. Praesent lacus neque, tempus quis magna a, congue laoreet dui. Mauris at tellus aliquam, ultricies ipsum blandit, mollis ante. Donec ullamcorper felis felis, ut feugiat arcu aliquet consectetur. Nullam leo velit, euismod eu malesuada non, rutrum quis arcu. Proin tortor orci, fringilla non quam id, tempor semper diam. Etiam sit amet aliquam erat, eu eleifend est. Morbi dictum justo in ligula egestas semper. Aenean sollicitudin est quis mi ullamcorper, a dapibus nisl mattis.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', '2020-11-20 14:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `cover_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `address`, `cover_img`) VALUES
(0, 'Local Service Search Engine Management System', 'info@sample.comm', '+6948 8542 623', '2102  Caldwell Road, Rochester, New York, 14608', '1605858480_images (2).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` int(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `type`, `date_created`) VALUES
(1, 'Administrator', '', 'admin', '0192023a7bbd73250516f069df18b500', 1, '2020-11-20 13:25:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `persons_companies`
--
ALTER TABLE `persons_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `persons_companies`
--
ALTER TABLE `persons_companies`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
