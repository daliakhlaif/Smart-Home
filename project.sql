-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 07, 2022 at 08:36 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-3`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `des` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `visibility` tinyint(4) NOT NULL DEFAULT '0',
  `allow_comment` tinyint(4) NOT NULL DEFAULT '0',
  `allow_ads` tinyint(4) NOT NULL DEFAULT '0',
  `img` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `des`, `ordering`, `visibility`, `allow_comment`, `allow_ads`, `img`) VALUES
(1, 'Smart Cam', '', 1, 1, 1, 1, '../images/cctv-camera.png'),
(2, 'Lighting', '', 2, 1, 1, 0, '../images/smart-light.png'),
(3, 'Smart Heating', '', 3, 0, 0, 0, '../images/temperature-control.png'),
(4, 'Speakers', '', 4, 0, 0, 0, '../images/speaker.png'),
(5, 'Smart Cleaners', '', 5, 0, 0, 0, '../images/vacuum-cleaner.png'),
(6, 'Smoke Detectors', '', 6, 0, 0, 0, '../images/smoke-detector.png'),
(7, 'Smart Tvs', '', 7, 0, 0, 0, '../images/smart-tv.png'),
(8, 'Sensors', '', 8, 0, 0, 0, '../images/sensor.png');

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

DROP TABLE IF EXISTS `checkouts`;
CREATE TABLE IF NOT EXISTS `checkouts` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `u_address` varchar(500) NOT NULL,
  `u_phone` int(10) NOT NULL,
  `totalprice` float NOT NULL,
  `checking_status` int(11) NOT NULL,
  `paying_method` varchar(50) NOT NULL,
  `code` varchar(50) DEFAULT '0',
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

DROP TABLE IF EXISTS `device`;
CREATE TABLE IF NOT EXISTS `device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `d_name` varchar(255) NOT NULL,
  `d_img` varchar(1000) NOT NULL,
  `d_price` float NOT NULL,
  `d_desc` varchar(50) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `wish` varchar(1000) NOT NULL DEFAULT '../images/gheart.png',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`id`, `d_name`, `d_img`, `d_price`, `d_desc`, `cat_id`, `wish`) VALUES
(2, 'Nest Cam Indoor Security Camera', '../images/Nest-Cam-Indoor-Security-Camera.jpg', 199, '', 1, '../images/gheart.png'),
(3, 'Honeywell Lyric C1 Indoor 720pWi-Fi Security Camera, White', '../images/Honywell-Lyric-C1-Indoor-720p-WiFi-SecurityCamera.jpg', 199, NULL, 1, '../images/gheart.png'),
(4, 'Amazon Cloud Cam Indoor Security Camera', '../images/Amazon-Cloud-Cam-Indoor-Security-Camera.jpg', 119.99, NULL, 1, '../images/gheart.png'),
(5, 'Blink Mini-Compact indoor plug-in smart security camera', '../images/Blink-Mini-Compact-indoor-plug-in-smart-securitycamera.jpg', 34.99, NULL, 1, '../images/gheart.png'),
(6, 'Y1 1080P Smart Home Camera,Indoor IP Security Surveillance System', '../images/Y1-1080P-Smart-Home-Camera,Indoor-IP-Security-Surveillance-System.jpg', 22.99, NULL, 1, '../images/gheart.png'),
(7, 'Arlo Q-wired,1080p HD Security Camera', '../images/Arlo-Q-wired,1080p-HD-SecurityCamera.jpg', 199.99, NULL, 1, '../images/gheart.png'),
(8, 'Aeon Matrix Yardian Indoor/Outdoor Smart Sprinkler,with HD security camera', '../images/Aeon-Matrix-Yardian-IndoorOutdoor-Smart-Sprinkler.jpg', 129.99, NULL, 1, '../images/gheart.png'),
(9, 'Ring Indoor Cam,Compact plug-in HD security camera with two way talk-white', '../images/Ring-Indoor-Cam,Compact-plug-in-HD-security-camera-with-two-way-talk-white.jpg', 59.99, NULL, 1, '../images/gheart.png'),
(10, 'EZVIZ 4MP Indoor CameraPan/Tilt Baby Pet Monitor with AI Human and Pet Detection', '../images/EZVIZ-4MP-Indoor-CameraPanTilt-Baby-Pet-Monitor-with-AI-Human-and-Pet-Detection.jpg', 129.99, NULL, 1, '../images/gheart.png'),
(11, 'Amcrest 4MP Outdoor PTZ POE + AI IP Camera Pan Tilt Zoom', '../images/Amcrest-4Mp-Outdoor-PTZ-POE+AI-IP-Camera-Pan-Tilt-Zoom.jpg', 579.99, NULL, 1, '../images/gheart.png'),
(12, 'Arlo Ultra 2 Spotlight Camera-2 Camera Security System-wireless, 4k Video and HDR', '../images/61KAXTtykLL._AC_UY327_FMwebp_QL65_.jpg', 429.009, NULL, 1, '../images/gheart.png'),
(13, 'Arlo Pro 3 Wireless Security, 2k Video and HDR', '../images/41ryp9BcDIS._AC_UY327_FMwebp_QL65_.jpg', 177.97, NULL, 1, '../images/gheart.png'),
(15, 'AIPER Cordless Robotic Pool Cleaner,Pool Vacuum with Upgraded dual-drive motors', '../images/71nxS7qSCcL._AC_UY327_QL65_.jpg', 379.99, NULL, 5, '../images/gheart.png'),
(16, 'PAXCESS Cordless Robotic Pool Cleaner with Wall-Climbing Function Automatic pool Vacuum with smart Route Plan', '../images/617WJ8jajaS._AC_UY327_QL65_.jpg', 699.99, NULL, 5, '../images/gheart.png'),
(17, 'Smart living steam mop plus', '../images/51Ss2yrLYjL._AC_UY327_QL65_.jpg', 299, NULL, 5, '../images/gheart.png'),
(18, 'Cop Rose X5P Window Cleaner Robot, Remote Controlled Robotic Vacuum Washer', '../images/61F65PY3-aL._AC_UY327_QL65_.jpg', 169.99, NULL, 5, '../images/gheart.png'),
(19, 'LEVOIT Air Purifiers for Home bedroom H13 true HERA filter', '../images/71Xm1E5u+JL._AC_UY327_QL65_.jpg', 159.99, NULL, 5, '../images/gheart.png'),
(20, 'Hoover smart wash automatic carpet cleaner with spot chaser stain remover wand', '../images/61drQXZsVHL._AC_UY327_QL65_.jpg', 230, NULL, 5, '../images/gheart.png'),
(21, 'iRobot braava jet 240 superior robot mop-app enabled,precison jet spray, vibrating cleaning head,dray sweeping modes', '../images/81AWYeKuq0L._AC_UY327_QL65_.jpg', 219.99, NULL, 5, '../images/gheart.png'),
(22, 'Neato D9 Intelligent robot vacuum cleaner-laser smart navm cleaning zones, Wi-Fi connected', '../images/71N6Fj7hoGL._AC_UY327_QL65_.jpg', 59.99, NULL, 5, '../images/gheart.png'),
(23, 'Shark RV912S EZ Robot Vacuum with Self-Empty Base,Bagless, Row-by-Row Cleaning', '../images/71gISOb7A+L._AC_UY327_QL65_.jpg', 149.99, '', 5, '../images/gheart.png'),
(24, 'Ralyss coffee mug warmer auto shut off 3 temperature setting', '../images/51dGJfgJhDL._AC_UL480_FMwebp_QL65_.jpg', 19.99, NULL, 3, '../images/gheart.png'),
(25, 'Heat storm HS-1800-PHX Wi-Fi infrared heater, Wi-Fi wall mounted', '../images/71Hy6nLTJOL._AC_UL480_FMwebp_QL65_.jpg', 125, NULL, 3, '../images/gheart.png'),
(26, 'COSORI electric gooseneck kettle smart bluetooth with variable temperature controlled', '../images/61QOt-qT5ML._AC_UL480_FMwebp_QL65_.jpg', 77.99, NULL, 3, '../images/gheart.png'),
(27, 'Damaila Wi-Fi smart thermostat temperature conroller for tuya, used for electric floor heating', '../images/618eNa1lhPL._AC_UL480_FMwebp_QL65_.jpg', 199.99, NULL, 3, '../images/gheart.png'),
(28, 'Smart water bottle coffee thermos insulated water bottle stainless steel', '../images/51U1Ze2asLL._AC_UL480_FMwebp_QL65_.jpg', 12, NULL, 3, '../images/gheart.png'),
(29, 'Dreo 24 space heater quiet heating portable electric heater with remote', '../images/814UeYmkQRL._AC_UL480_FMwebp_QL65_.jpg', 84.99, NULL, 3, '../images/gheart.png'),
(30, 'Premium 2 in1 car cup warmer cooler smart car cup mug holder', '../images/81F6T9NgXVL._AC_UL480_QL65_.jpg', 39.99, NULL, 3, '../images/gheart.png'),
(31, 'Breville BOV860BSS smart oven air fryer, countertop convection oven, brushed stainless steel', '../images/71+Mo4cc7rL._AC_UL480_QL65_.jpg', 349.99, NULL, 3, '../images/gheart.png'),
(32, 'Philips AVENT fast baby bottle warmer with smart temperature controlled', '../images/714B2RapEWL._AC_UL480_QL65_.jpg', 50, NULL, 3, '../images/gheart.png'),
(33, 'GENIANI extra large electric heating pad for back pain and cramps relief', '../images/81MAxWCmkFL._AC_UL480_QL65_.jpg', 59.99, NULL, 3, '../images/gheart.png'),
(34, 'Philips Hue LightStrip Pulse Dimmable LED', '../images/phiipes3.jpg', 35.99, NULL, 2, '../images/gheart.png'),
(35, 'LIFX Mini A19 E26 App Controlled Wi-Fi Smart LED Light Bulb Color', '../images/lifxmini.png', 35.99, NULL, 2, '../images/gheart.png'),
(36, 'Philips Hue Go Whitte and Color Portable Dimmable LED Smart Table Lamp', '../images/PhilipsHueGoWhitteandColorPortableDimmableLEDSmartTableLamp.jpg', 36, NULL, 2, '../images/gheart.png'),
(37, 'Philips Hue Bluetooth SmartLightstrip', '../images/philips5.jpg', 46.99, NULL, 2, '../images/gheart.png'),
(38, 'Dikaou Bedside Lamp with Bluetooth', '../images/dikauo.jpg', 27.99, NULL, 2, '../images/gheart.png'),
(39, 'lindby-lindum-led-ceiling-light-rgb-cct-dimmable', '../images/lindby-lindum-led-ceiling-light-rgb-cct-dimmable.jpg', 134.99, NULL, 2, '../images/gheart.png'),
(40, 'svean-3-bulb-ceiling-lamp', '../images/svean-3-bulb-ceiling-lamp.jpg', 83.99, NULL, 2, '../images/gheart.png'),
(41, 'lindby-fjella-ceiling-lamp-rgb-cct-colour-changer', '../images/lindby-fjella-ceiling-lamp-rgb-cct-colour-changer.jpg', 27.99, NULL, 2, '../images/gheart.png'),
(42, 'lindby-kourtney-ceiling-light-glass-lampshade', '../images/lindby-kourtney-ceiling-light-glass-lampshade.jpg', 103.99, NULL, 2, '../images/gheart.png'),
(43, 'four-bulb-led-ceiling-light-elaina-nickel-matte', '../images/four-bulb-led-ceiling-light-elaina-nickel-matte.jpg', 99.99, NULL, 2, '../images/gheart.png'),
(44, 'lucande-avilara-led-ceiling-light-aluminium', '../images/lucande-avilara-led-ceiling-light-aluminium.jpg', 300, NULL, 2, '../images/gheart.png'),
(45, 'ilira-led-ceiling-light-dimmable-cct-3-bulb', '../images/ilira-led-ceiling-light-dimmable-cct-3-bulb.jpg', 179.99, NULL, 2, '../images/gheart.png'),
(46, 'artemide-nur-mini-ceiling-light', '../images/artemide-nur-mini-ceiling-light.jpg', 244, NULL, 2, '../images/gheart.png'),
(47, 'SAMSUNG M5 Series 27-Inch FHD 1080p Smart Monitor & Streaming TV', '../images/81dUzXzVIPS._AC_UY327_QL65_.jpg', 249.99, NULL, 7, '../images/gheart.png'),
(48, 'LG Electronics 24LM530S-PU 24-Inch HD webOS 3.5 Smart TV', '../images/713ZK2DXsSL._AC_UY327_QL65_.jpg', 129.99, NULL, 7, '../images/gheart.png'),
(49, 'TCL 65-inch Class 6-Series 8K Mini-LED UHD QLED Dolby Vision HDR Smart Roku TV ', '../images/A1MLXifC2uL._AC_UY327_QL65_.jpg', 189.99, NULL, 7, '../images/gheart.png'),
(50, 'LG OLED C1 Series 55” Alexa Built-in 4k Smart TV', '../images/91n+0a65XFL._AC_UY327_FMwebp_QL65_.jpg', 250, NULL, 7, '../images/gheart.png'),
(51, 'RCA 32-inch Flat Screen 720p Roku Smart LED TV ', '../images/61rAjQA8DnL._AC_UY327_FMwebp_QL65_.jpg', 170, NULL, 7, '../images/gheart.png'),
(52, 'SAMSUNG 32-inch Class LED Smart FHD TV', '../images/91UsHjAPTlL._AC_UY327_FMwebp_QL65_.jpg', 227, NULL, 7, '../images/gheart.png'),
(53, 'Bose Portable Home Speaker Charging Cradle, Black', '../images/41nOMl477EL._AC_UY327_QL65_.jpg', 119.99, NULL, 4, '../images/gheart.png'),
(54, 'Meeting Owl Pro - 360-Degree, 1080p HD Smart Video Conference Camera', '../images/91-o+984YvL._AC_UY327_FMwebp_QL65_.jpg', 129.99, NULL, 4, '../images/gheart.png'),
(55, 'Belkin SoundForm Elite Hi-Fi Smart Speaker + Wireless Charger', '../images/71337XbSNdL._AC_UY327_FMwebp_QL65_.jpg', 199.99, NULL, 4, '../images/gheart.png'),
(56, 'Sonos Move - Battery-Powered Smart Speaker', '../images/712y7nbjc4L._AC_UY327_FMwebp_QL65_.jpg', 109.99, NULL, 4, '../images/gheart.png'),
(57, 'Marshall Stanmore II Wireless Wi-Fi Alexa Voice Smart Speaker', '../images/71jzrhwI2jL._AC_UY327_FMwebp_QL65_.jpg', 398.99, NULL, 4, '../images/gheart.png'),
(58, 'Bose Portable Smart Speaker — Wireless Bluetooth Speaker with Alexa Voice Control Built-In, Black', '../images/616zERCeOhL._AC_UY327_FMwebp_QL65_.jpg', 329.99, NULL, 4, '../images/gheart.png'),
(59, 'Bose Home Speaker 500: Smart Bluetooth Speaker with Alexa Voice Control Built-In, Black', '../images/81NI0UFz4zL._AC_UY327_QL65_.jpg', 349.99, NULL, 4, '../images/gheart.png'),
(60, 'Echo Dot (3rd Gen, 2018 release) - Smart speaker with Alexa - Charcoal', '../images/6182S7MYC2L._AC_UY327_QL65_.jpg', 300, NULL, 4, '../images/gheart.png'),
(61, 'Kidde Carbon Monoxide Detector, AC-Plug-In with Battery Backup, CO Alarm with Replacement Alert', '../images/71EIUICeeRL._AC_UY327_QL65_.jpg', 19.99, NULL, 6, '../images/gheart.png'),
(62, 'Honeywell 5808W3 Wireless Photoelectric Smoke/Heat Detector', '../images/61oTlrkCUQL._AC_UY327_QL65_.jpg', 74.99, NULL, 6, '../images/gheart.png'),
(63, 'X-Sense 10-Year Battery Combination Smoke Carbon Monoxide Alarm Detector with Large LCD Display', '../images/814U96z3JLL._AC_UY327_QL65_.jpg', 38.99, NULL, 6, '../images/gheart.png'),
(64, 'Kidde Nighthawk Carbon Monoxide Detector & Propane, Natural, & Explosive Gas Detector', '../images/71lyaPYRvbL._AC_UY327_QL65_.jpg', 39.99, NULL, 6, '../images/gheart.png'),
(65, 'Universal Security Instruments 4-in-1 Universal Smoke-Sensing Technology Hardwired Smart Alarm', '../images/61N-HjZIDxL._AC_UY327_QL65_.jpg', 39.99, NULL, 6, '../images/gheart.png'),
(66, 'Airthings 2930 Wave Plus', '../images/51wWl20gaJL._AC_UY327_QL65_.jpg', 229.99, NULL, 6, '../images/gheart.png'),
(67, 'Kidde Smoke Detector, Battery Powered, Interconnect Smoke Alarm with LED Lights', '../images/71ScPeOkBfL._AC_UY327_QL65_.jpg', 59.99, NULL, 6, '../images/gheart.png'),
(68, 'Kidde Smoke & Carbon Monoxide Detector, Lithium Battery Powered', '../images/61zCWwn4mPL._AC_UY327_QL65_.jpg', 97, NULL, 6, '../images/gheart.png'),
(69, 'X-Sense 10-Year Battery Combination Smoke and Carbon Monoxide Alarm Detector', '../images/81agUILcdsS._AC_UY327_FMwebp_QL65_.jpg', 38.99, NULL, 6, '../images/gheart.png'),
(70, 'Himalayan Glow Wi-Fi Smoke Detector, Wireless Smart Fire Smoke Alarm', '../images/61C1IGNCjTL._AC_UY327_FMwebp_QL65_.jpg', 97.99, NULL, 6, '../images/gheart.png'),
(71, 'X-Sense 10-Year Battery Smoke and Carbon Monoxide Alarm with Display', '../images/71bLVPIavwL._AC_UY327_FMwebp_QL65_.jpg', 152.99, NULL, 6, '../images/gheart.png'),
(72, 'First Alert SCO5CN Combination Smoke and Carbon Monoxide Detector', '../images/61oc78NKWaL._AC_UY327_FMwebp_QL65_.jpg', 33.99, NULL, 6, '../images/gheart.png'),
(73, 'First Alert Onelink Safe & Sound - Smart Hardwired Smoke + Carbon Monoxide Alarm and Premium Home Speaker with Amazon Alexa', '../images/81LqUU2vHTL._AC_UY327_FMwebp_QL65_.jpg', 250.99, NULL, 6, '../images/gheart.png'),
(74, 'Ring Alarm Contact Sensor', '../images/Ring%20Alarm%20Contact%20Sensor.jpg', 79.99, NULL, 8, '../images/gheart.png'),
(75, 'SENSKY BS010H DC 12V TO 30V 3A mini pir motion sensor', '../images/71Iua6qKcEL._AC_UL480_FMwebp_QL65_.jpg', 10.99, NULL, 8, '../images/gheart.png'),
(76, 'Motion sensor led under cabinet lighting wireless cabinet light reachable', '../images/61I8o3g3j5L._AC_UL480_FMwebp_QL65_.jpg', 29.99, NULL, 8, '../images/gheart.png'),
(77, 'Aotec SmartThings Motion Sensor', '../images/Aotec SmartThings Motion Sensor.jpg', 89.99, NULL, 8, '../images/gheart.png'),
(78, 'Honeywell smart home security window/door access sensor', '../images/vai-pdp-msi-32332-side1-800x800-1a-2018-8-21_360x.jpg', 34.99, NULL, 8, '../images/gheart.png'),
(79, 'GE Z-wave plus wireless hinge pin smart door sensor', '../images/74999-side1_360x.jpg', 39.99, NULL, 8, '../images/gheart.png'),
(80, 'Dreo 24 space heater quiet heating portable electric heater with remote', '../images/510lVT0-i3L._AC_UL480_FMwebp_QL65_.jpg', 84.99, NULL, 8, '../images/gheart.png'),
(81, 'Home zone security smart wireless doorm window sensor and security siren alarm kit', '../images/61Hb2bVspCL._AC_UL480_FMwebp_QL65_.jpg', 59.99, NULL, 8, '../images/gheart.png'),
(82, 'Ecobee smart sensor 2 pack', '../images/513Xb8ggNaL._AC_UL480_FMwebp_QL65_.jpg', 97.99, '', 1, '../images/gheart.png');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` varchar(1000) NOT NULL,
  `msg_date` date NOT NULL,
  `u_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `price` float NOT NULL,
  `img` varchar(1000) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` float GENERATED ALWAYS AS ((`price` * `quantity`)) VIRTUAL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `user_id`, `device_id`, `name`, `price`, `img`, `quantity`) VALUES
(29, 13, 35, 'LIFX Mini A19 E26 App Controlled Wi-Fi Smart LED Light Bulb Color', 35.99, '../images/lifxmini.png', 1),
(35, 8, 38, 'Dikaou Bedside Lamp with Bluetooth', 27.99, '../images/dikauo.jpg', 1),
(37, 13, 5, 'Blink Mini-Compact indoor plug-in smart security camera', 34.99, '../images/Blink-Mini-Compact-indoor-plug-in-smart-securitycamera.jpg', 1),
(38, 13, 2, 'Nest Cam Indoor Security Camera', 199, '../images/Nest-Cam-Indoor-Security-Camera.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'to identify user',
  `username` varchar(255) NOT NULL COMMENT 'username to login',
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `groupID` int(11) NOT NULL DEFAULT '0' COMMENT 'identify user group',
  `date` date DEFAULT NULL,
  `regStatus` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `email`, `fullname`, `password`, `groupID`, `date`, `regStatus`) VALUES
(6, 'dalia', 'dalia.2001.kh@gmail.com', 'Dalia Khlaif', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, '2022-04-30', 1),
(7, 'jannat', 'jannatbassam2001@gmail.com', 'Jannat Dawabsheh', '51eac6b471a284d3341d8c0c63d0f1a286262a18', 1, '2022-04-30', 1),
(10, 'Mahmoud', 'mahmoud@gmail.com', 'Mahmoud Ahmed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, '2022-04-30', 1),
(12, 'adnan', 'adn_34@gmail.com', 'Adnan Sameh', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, '2022-05-01', 1),
(17, 'noor', 'noor@gmail.com', 'noor ahmad', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, '2022-05-07', 1),
(21, 'sara', 'sara345@gmail.com', 'sara Abdulla', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 0, '2022-05-07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `price` float NOT NULL,
  `img` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `name`, `price`, `img`) VALUES
(18, 12, 74, 'Ring Alarm Contact Sensor', 79.99, '../images/Ring%20Alarm%20Contact%20Sensor.jpg'),
(19, 8, 46, 'artemide-nur-mini-ceiling-light', 244, '../images/artemide-nur-mini-ceiling-light.jpg'),
(20, 8, 12, 'Arlo Ultra 2 Spotlight Camera-2 Camera Security System-wireless, 4k Video and HDR', 429.009, '../images/61KAXTtykLL._AC_UY327_FMwebp_QL65_.jpg'),
(15, 8, 1, 'Nest Cam Indoor Security Camera', 199, '../images/nest-camera-stand-3-4-single_360x.jpg'),
(17, 8, 6, 'Y1 1080P Smart Home Camera,Indoor IP Security Surveillance System', 22.99, '../images/Y1-1080P-Smart-Home-Camera,Indoor-IP-Security-Surveillance-System.jpg'),
(21, 8, 2, 'Nest Cam Indoor Security Camera', 199, '../images/Nest-Cam-Indoor-Security-Camera.jpg'),
(22, 13, 17, 'Smart living steam mop plus', 299, '../images/51Ss2yrLYjL._AC_UY327_QL65_.jpg'),
(23, 13, 4, 'Amazon Cloud Cam Indoor Security Camera', 119.99, '../images/Amazon-Cloud-Cam-Indoor-Security-Camera.jpg'),
(24, 13, 5, 'Blink Mini-Compact indoor plug-in smart security camera', 34.99, '../images/Blink-Mini-Compact-indoor-plug-in-smart-securitycamera.jpg'),
(25, 13, 34, 'Philips Hue LightStrip Pulse Dimmable LED', 35.99, '../images/phiipes3.jpg'),
(27, 21, 2, 'Nest Cam Indoor Security Camera', 199, '../images/Nest-Cam-Indoor-Security-Camera.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
