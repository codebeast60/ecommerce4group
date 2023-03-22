-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 11, 2022 at 04:58 PM
-- Server version: 10.5.16-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u399445477_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `parent` int(11) NOT NULL,
  `Ordering` int(11) DEFAULT NULL,
  `Visibility` tinyint(4) NOT NULL DEFAULT 0,
  `Allow_Comment` tinyint(4) NOT NULL DEFAULT 0,
  `Allow_Ads` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Description`, `parent`, `Ordering`, `Visibility`, `Allow_Comment`, `Allow_Ads`) VALUES
(10, 'cell phones', 'iphone samsung LG ...', 0, 3, 0, 0, 0),
(14, 'handle made', 'handle made for men', 0, 0, 1, 1, 1),
(15, 'Computer', 'Computer stuff for programmer for designer...', 0, 2, 0, 0, 0),
(17, 'clothing', 'adidas puma lacost jeox ....', 0, 4, 0, 0, 0),
(18, 'tools', 'Home tools', 0, 6, 0, 0, 0),
(20, 'Nokia', 'Nikia phones', 10, 1, 0, 0, 0),
(22, 'Hammers', 'Hammers disc', 18, 1, 0, 0, 0),
(23, 'boxes', 'boxes hand made', 0, 1, 0, 1, 0),
(24, 'games', 'hand made games', 18, 3, 0, 0, 0),
(28, 'clean', 'clean test', 0, 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `comment` text CHARACTER SET utf8mb4 NOT NULL,
  `statusC` tinyint(4) NOT NULL,
  `comment_date` date NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`c_id`, `comment`, `statusC`, `comment_date`, `item_id`, `user_id`) VALUES
(23, 'Hello i am user2', 0, '2022-06-16', 73, 70),
(26, 'hello i\'m user three and i write a comment', 1, '2022-06-18', 90, 71),
(27, 'hello i am user one and i write a comment', 1, '2022-06-19', 90, 62),
(28, 'hello i\'m user three and i write a comment', 1, '2022-06-20', 90, 71),
(29, 'test comment', 1, '2022-06-28', 90, 62),
(40, 'Hi ', 1, '2022-07-11', 73, 104),
(41, 'Hiii', 1, '2022-07-11', 73, 104),
(42, 'i am user one comment one', 1, '2022-07-11', 81, 62),
(43, 'i am user one comment two', 0, '2022-07-11', 81, 62),
(44, 'hello i\'m user test and i wrote a comment', 1, '2022-07-16', 88, 116),
(46, 'hello from user 3', 1, '2022-09-19', 131, 71),
(47, 'hello from user one', 1, '2022-09-23', 121, 62),
(48, 'test form user one', 1, '2022-09-23', 121, 62),
(50, 'hello from user one', 1, '2022-09-23', 131, 62),
(51, 'hello from user one', 1, '2022-09-23', 120, 62),
(54, 'hello from user two', 1, '2022-09-23', 121, 70),
(55, 'hi im user one', 1, '2022-09-23', 133, 62),
(58, 'hey i\'m mark and i wrote this comment', 1, '2022-10-08', 131, 128);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_ID` int(11) NOT NULL,
  `Name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Description` text CHARACTER SET utf8 NOT NULL,
  `Price` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Add_Date` date NOT NULL,
  `Country_Made` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Status` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Rating` smallint(6) NOT NULL,
  `Approve` tinyint(4) NOT NULL DEFAULT 0,
  `Cat_ID` int(11) NOT NULL,
  `Member_ID` int(11) NOT NULL,
  `tags` varchar(255) CHARACTER SET utf8 NOT NULL,
  `address` text CHARACTER SET utf8 NOT NULL COMMENT 'address of item',
  `itemPics` varchar(255) CHARACTER SET utf8 NOT NULL,
  `itemPics2` varchar(255) CHARACTER SET utf8 NOT NULL,
  `itemPics3` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_ID`, `Name`, `Description`, `Price`, `Add_Date`, `Country_Made`, `Status`, `Rating`, `Approve`, `Cat_ID`, `Member_ID`, `tags`, `address`, `itemPics`, `itemPics2`, `itemPics3`) VALUES
(73, 'women tshirt', 'tshirt black good quality ', '44', '2022-06-14', 'usa', '2', 0, 1, 17, 62, '', '', 'banner-04.jpg_22.07.20.jpg', '866816_banner-04.jpg', 'gallery-04.jpg_22.07.20.jpg'),
(74, 'watch', 'black watch', '125', '2022-06-14', 'china', '3', 0, 1, 18, 62, '', '', '804102_product-06.jpg', '', ''),
(76, 'jinz hat', 'jinz hat for men in good condition', '7', '2022-06-14', 'usa', '1', 0, 1, 17, 62, '', '', '40063_gallery-07.jpg', '', ''),
(78, 'camera', 'canon camera', '558', '2022-06-14', 'china', '1', 0, 1, 18, 62, '', '', '808503_gallery-03.jpg', '', ''),
(81, 'cloth', 'women cloth', '550', '2022-06-14', 'usa', '1', 0, 1, 17, 70, '', '', '575672_product-08.jpg', '', ''),
(82, 'cloth', 'cloth for women', '400', '2022-06-14', 'usa', '1', 0, 1, 17, 70, '', '', '412554_product-05.jpg', '', ''),
(83, 'tool', 'tools for men', '44', '2022-06-14', 'usa', '1', 0, 1, 18, 70, '', '', '674145_banner-09.jpg', '', ''),
(84, 'tools', 'tool for men', '50', '2022-06-14', 'usa', '2', 0, 1, 18, 70, '', '', '798365_banner-08.jpg', '', ''),
(85, 'tool ', 'tools for women', '60', '2022-06-14', 'usa', '2', 0, 1, 18, 70, '', '', '581322_blog-03.jpg', '', ''),
(86, 'tool', 'tools for men and women', '60', '2022-06-14', 'usa', '2', 0, 1, 18, 71, '', '', '418318_product-12.jpg', '', ''),
(87, 'cloth', 'cloths for women', '500', '2022-06-14', 'china', '1', 0, 1, 17, 71, '', '', '425981_gallery-09.jpg', '', ''),
(88, 'pc computer', 'case pc in good condition', '500', '2022-06-15', 'germany', '1', 0, 1, 15, 72, '', 'british London', '620587_c25122dc8c499b1b5877782788c4b792.jpg', '632169_hero.jpg', '337837_technology.jpg'),
(90, 'computer', 'computer desktop', '350', '2022-06-15', 'usa', '3', 0, 1, 15, 72, '', '', '338958_FULL-HP.jpg', '', ''),
(91, 'computer', 'desktop good for pubg', '655', '2022-06-15', 'usa', '1', 0, 1, 15, 72, '', '', '330950_gaming-desktop-computer-250x250.jpg', '', ''),
(92, 'computer', 'computer desktop', '700', '2022-06-15', 'china', '1', 0, 1, 15, 72, '', '', '333027_it_photo_146266.jpg', '', ''),
(93, 'computer case', 'computer case', '500', '2022-06-15', 'united state of america', '1', 0, 1, 15, 72, '', '', '403227_pc case.jpg', '', ''),
(94, 'vga nvidia', 'nvidia vga 10/60', '200', '2022-06-15', 'usa', '2', 0, 1, 15, 72, '', '', '312139_Source-List-of-Used-pc-parts-buy-and-sell-in-Bangladesh.jpg', '', ''),
(95, 'computer desktop', 'computer desktop', '870', '2022-06-15', 'usa', '1', 0, 1, 15, 73, '', '', '747290_it_photo_146266.jpg', '', ''),
(96, 'computer', 'computer case in good condition', '230', '2022-06-15', 'usa', '1', 0, 1, 15, 73, '', '', '383509_gaming-pc-build.jpg', '', ''),
(97, 'desktop stuff', 'computer desktop stuff', '1000', '2022-06-15', 'usa', '1', 0, 1, 15, 73, '', '', '980359_KaYQvCz6KuKfhJZEEYLKiR.jpg', '', ''),
(98, 'computer accessorises', 'computer accessories', '50', '2022-06-15', 'usa', '1', 0, 1, 15, 73, '', '', '600143_capture-20130107-090018.jpg', '', ''),
(99, 'hand made', 'hand made', '25', '2022-06-15', 'china', '1', 0, 1, 14, 74, '', '', '331354_5ad94fcc41755248ee41898c260bfa0f--corkboard-ideas-ideas-for-gifts.jpg', '', ''),
(101, 'hand made book ', 'hand made completly 100% hand made ', '50', '2022-06-15', 'usa', '1', 0, 1, 14, 74, '', '', '904879_Cool-Black-Cover-Big-36-26CM-Photo-Album-Handmade-DIY-Scrap-Black-Card-Kraft-Paper-Sheets.jpg', '', ''),
(102, 'hadn made ', 'hand made for personal using', '8', '2022-06-15', 'china', '1', 0, 1, 14, 74, '', '', '285691_handmade-art-and-craft.jpg', '', ''),
(103, 'hand made ', 'personal hand made', '20', '2022-06-15', 'Russa', '1', 0, 1, 14, 74, '', '', '904855_handmade-soap-bars-homemade-soap-with-lavender-flowers-PGCJ57.jpg', '', ''),
(104, 'hand made ', 'hand made for beauty', '44', '2022-06-15', 'usa', '1', 0, 1, 14, 74, '', '', '981104_handmade-soap-bars-homemade-soap-with-lavender-flowers-PGCJ57.jpg', '', ''),
(105, 'handa made', 'tree hand made', '100', '2022-06-15', 'usa', '1', 0, 1, 14, 74, '', '', '285580_7ef647ff3640fc88321bf0fd4e30bc5d.jpg', '', ''),
(106, 'hand made', 'hand made for crismas', '120', '2022-06-15', 'china', '1', 0, 1, 14, 74, '', '', '996029_Christmas-Handmade-Paper-Craft-Decorations_30.jpg', '', ''),
(107, 'iphone 10', 'iphone 10 in good condition', '350', '2022-06-15', 'usa', '2', 0, 1, 10, 75, '', '', '358750_71AGpzbW7WL.jpg', '', ''),
(108, 'iphone 11', 'iphone 11 new not used', '600', '2022-06-15', 'usa', '1', 0, 1, 10, 75, '', '', '34204_iphone-11-Lavender.jpg', '', ''),
(109, 'iphone 11 pro', 'iphone 11 pro new not used', '800', '2022-06-15', 'usa', '1', 0, 1, 10, 75, '', '', '474887_iphone-11-pro-max.jpg', '', ''),
(110, 'iphone 12', 'iphone 12 like new', '500', '2022-06-15', 'usa', '2', 0, 1, 10, 75, '', '', '6790_iphone-12-pro-graphite-hero.png', '', ''),
(111, 'iphone 13 ', 'iphone 13 pro max', '900', '2022-06-15', 'usa', '2', 0, 1, 10, 75, '', '', '282729_Apple-iPhone-13-Pro-Max-vs-OnePlus-10-Pro.jpg', '', ''),
(112, 'computer desktop', 'computer desktop in good condition with all component including monitor and mouse and 16gb Ram', '600', '2022-06-16', 'usa', '2', 0, 1, 15, 70, '', '', 'desktop-system-500x500.jpg_22.08.22.jpg', 'technology.jpg_22.08.22.jpg', 'computer.jpg_22.08.22.jpg'),
(113, 'computer desktop', 'case desktop in good condition', '340', '2022-06-18', 'usa', '2', 0, 1, 15, 62, '', '', '270466_pc.jpg', '', ''),
(114, 'computer desktop', 'computer in good condition', '300', '2022-06-18', 'usa', '2', 0, 1, 15, 71, '', '', '347478_pc.jpg', '', ''),
(116, 'computer desktop', 'desktop in good condition with guaranti for more than three years', '350', '2022-06-19', 'usa', '2', 0, 1, 15, 62, '', '', '685914_lenovo-desktop-computer-500x500.jpg', '', ''),
(119, 'test item', 'test for 3 picture item', '77', '2022-06-29', 'lebanon', '1', 0, 1, 14, 62, '', '', '95282_avatar5.jpg', '692215_avatar7.png', '435312_avatar7.png'),
(120, 'test 2', 'test two for more than one picture', '54', '2022-06-30', 'usa', '1', 0, 1, 15, 62, '', 'test address', '608954_banner-06.jpg', '470084_hero.jpg', 'Screenshot_20211122-170701_Facebook.jpg_22.07.14.jpg'),
(121, 'Note 10', 'Note 10 marble colir khare2 el nadafe like new ya3ni telephone a5u samsungeye', '250', '2022-07-11', 'Vietnam ', '2', 0, 1, 10, 104, '', '', '102054_20220628_121401.jpg', '67770_20220628_121019.jpg', '393946_20220628_121401.jpg'),
(130, 'test item', 'test item for test image', '45', '2022-07-16', 'united kingdom', '1', 0, 0, 28, 70, '', 'united kingdom', 'about-02.jpg_22.07.16.jpg', 'no-image.png', 'no-image.png'),
(131, 'test item', 'test item for address', '3', '2022-07-16', 'australia', '1', 0, 1, 28, 116, '', 'test address for item', 'gallery-05.jpg_22.07.16.jpg', 'no-image.png', 'no-image.png'),
(133, 'test item ', 'test item for adding comment for not activating account', '33', '2022-09-23', 'usa', '1', 0, 1, 28, 71, '', 'Lebanon', 'about-02.jpg_22.10.08.jpg', 'item-cart-02.jpg_22.10.08.jpg', 'gallery-04.jpg_22.09.23.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `l_id` int(11) NOT NULL,
  `ip` text CHARACTER SET utf8 NOT NULL,
  `continent_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `country_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `country_capital` varchar(255) CHARACTER SET utf8 NOT NULL,
  `district` text CHARACTER SET utf8 NOT NULL,
  `city` varchar(50) CHARACTER SET utf8 NOT NULL,
  `latitude` varchar(255) CHARACTER SET utf8 NOT NULL,
  `longitude` varchar(255) CHARACTER SET utf8 NOT NULL,
  `flag` text CHARACTER SET utf8 NOT NULL,
  `calling_code` text CHARACTER SET utf8 NOT NULL,
  `languages` text CHARACTER SET utf8 NOT NULL,
  `time_zone` text CHARACTER SET utf8 NOT NULL,
  `user_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`l_id`, `ip`, `continent_name`, `country_name`, `country_capital`, `district`, `city`, `latitude`, `longitude`, `flag`, `calling_code`, `languages`, `time_zone`, `user_name`) VALUES
(10, '94.187.1.59', 'Asia', 'Lebanon', 'Beirut', 'Minet El Hosn', 'Beirut', '33.90220', '35.49912', 'https://ipgeolocation.io/static/flags/lb_64.png', '+961', 'ar-LB,fr-LB,en,hy', '2022-07-11 15:53:45.222+0300', 'Dr.phone'),
(11, '94.187.0.7', 'Asia', 'Lebanon', 'Beirut', 'Minet El Hosn', 'Beirut', '33.90220', '35.49912', 'https://ipgeolocation.io/static/flags/lb_64.png', '+961', 'ar-LB,fr-LB,en,hy', '2022-07-11 16:22:41.741+0300', 'Bob'),
(16, '94.187.3.152', 'Asia', 'Lebanon', 'Beirut', 'Minet El Hosn', 'Beirut', '33.8624512', '35.5106816', 'https://ipgeolocation.io/static/flags/lb_64.png', '+961', 'ar-LB,fr-LB,en,hy', '2022-07-16 19:30:57.875+0300', 'testUser'),
(17, '185.114.88.165', 'Asia', 'Lebanon', 'Beirut', 'Tripoli', 'Tripoli', '34.4388059', '35.8455481', 'https://ipgeolocation.io/static/flags/lb_64.png', '+961', 'ar-LB,fr-LB,en,hy', '2022-07-17 10:57:30.186+0300', 'yaya'),
(19, '94.187.0.16', 'Asia', 'Lebanon', 'Beirut', 'Minet El Hosn', 'Beirut', '33.8937913', '35.5017767', 'https://ipgeolocation.io/static/flags/lb_64.png', '+961', 'ar-LB,fr-LB,en,hy', '2022-07-17 14:35:24.306+0300', 'drago'),
(23, '94.187.2.223', 'Asia', 'Lebanon', 'Beirut', 'Minet El Hosn', 'Beirut', '33.8591744', '35.5139584', 'https://ipgeolocation.io/static/flags/lb_64.png', '+961', 'ar-LB,fr-LB,en,hy', '2022-09-24 12:21:34.777+0300', 'zack'),
(25, '185.114.88.98', 'Asia', 'Lebanon', 'Beirut', 'Tripoli', 'Tripoli', '34.4427492', '35.8359734', 'https://ipgeolocation.io/static/flags/lb_64.png', '+961', 'ar-LB,fr-LB,en,hy', '2022-09-28 10:42:37.969+0300', 'malek'),
(26, '114.79.55.242', 'Asia', 'Indonesia', 'Jakarta', 'Menteng', 'Jakarta Pusat', '-6.9936215', '107.6716619', 'https://ipgeolocation.io/static/flags/id_64.png', '+62', 'id,en,nl,jv', '2022-10-05 19:23:23.786+0700', 'adikadik'),
(27, '94.187.3.118', 'Asia', 'Lebanon', 'Beirut', 'Minet El Hosn', 'Beirut', '33.8755584', '35.504128', 'https://ipgeolocation.io/static/flags/lb_64.png', '+961', 'ar-LB,fr-LB,en,hy', '2022-10-08 20:18:16.183+0300', 'mark');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `stars` smallint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rating_id`, `item_id`, `user_id`, `stars`) VALUES
(1, 131, 62, 5),
(2, 131, 71, 5),
(3, 121, 62, 3),
(4, 121, 71, 4),
(5, 133, 71, 3),
(6, 116, 71, 1),
(7, 108, 71, 3),
(8, 113, 71, 2),
(9, 131, 128, 3),
(10, 120, 128, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL COMMENT 'to identify users',
  `userName` varchar(255) NOT NULL COMMENT 'username to login',
  `password` varchar(255) NOT NULL COMMENT 'password to login',
  `email` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL COMMENT 'phone number',
  `fullName` varchar(255) NOT NULL,
  `groupID` int(11) NOT NULL DEFAULT 0 COMMENT 'indetify user group',
  `trustStatus` int(11) NOT NULL DEFAULT 0 COMMENT 'seller rank',
  `regStatus` int(11) NOT NULL DEFAULT 0 COMMENT 'user approval',
  `Date` date NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 NOT NULL,
  `code` int(20) NOT NULL,
  `status` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `password`, `email`, `phone`, `fullName`, `groupID`, `trustStatus`, `regStatus`, `Date`, `image`, `code`, `status`) VALUES
(1, 'admin', '$2y$10$GWepU.7J1F4k5R875GoGZuO4a2XH5IJKdkQL9NK6KTyuhFfRGkhrq', 'admin@gmail.com', 55669988, 'administrator', 1, 0, 1, '2022-01-31', 'admin.jpg_22.07.08.jpg', 474441, 'verified'),
(62, 'user1', '$2y$10$yVrIC5l9E8G3Beb96wGwMufbSJ7OOQKAhPiGeao0BU4PbxEnmjHhG', 'user1@gmail.com', 123123, 'user one ', 0, 0, 1, '2022-06-13', 'avatar9.jpg_22.09.25.jpg', 0, 'verified'),
(70, 'user2', '$2y$10$yVrIC5l9E8G3Beb96wGwMufbSJ7OOQKAhPiGeao0BU4PbxEnmjHhG', 'user2@gmail.com', 123456, 'user two', 0, 0, 0, '2022-06-14', 'o2c-logo@2x.png_22.06.16.png', 0, 'verified'),
(71, 'user3', '$2y$10$yVrIC5l9E8G3Beb96wGwMufbSJ7OOQKAhPiGeao0BU4PbxEnmjHhG', 'user3@gmail.com', 456456, 'user3', 0, 0, 1, '2022-06-14', 'avatar4.png_22.06.20.png', 0, 'verified'),
(72, 'user4', '$2y$10$yVrIC5l9E8G3Beb96wGwMufbSJ7OOQKAhPiGeao0BU4PbxEnmjHhG', 'user4@gmail.com', 456456, 'user four', 0, 0, 1, '2022-06-14', 'avatar8.jpg_22.06.14.jpg', 0, 'verified'),
(73, 'user5', '$2y$10$yVrIC5l9E8G3Beb96wGwMufbSJ7OOQKAhPiGeao0BU4PbxEnmjHhG', 'user5@gmail.com', 456789, 'user five', 0, 0, 1, '2022-06-14', 'avatar7.png_22.06.14.png', 0, 'verified'),
(74, 'user6', '$2y$10$yVrIC5l9E8G3Beb96wGwMufbSJ7OOQKAhPiGeao0BU4PbxEnmjHhG', 'user6@gmail.com', 789789, 'user six', 0, 0, 1, '2022-06-14', 'avatar6.png_22.06.14.png', 0, 'verified'),
(75, 'user7', '601f1889667efaebb33b8c12572835da3f027f78', 'user7@gmail.com', 456456, 'user seven', 0, 0, 1, '2022-06-14', 'avatar5.jpg_22.06.14.jpg', 0, 'verified'),
(76, 'user8', '601f1889667efaebb33b8c12572835da3f027f78', 'user8@gmail.com', 654654, 'user eight', 0, 0, 1, '2022-06-14', 'avatar4.png_22.06.14.png', 0, 'verified'),
(77, 'user9', '601f1889667efaebb33b8c12572835da3f027f78', 'user9@gmail.com', 123321, 'user nine', 0, 0, 1, '2022-06-14', 'avatar3.jpg_22.06.14.jpg', 0, 'verified'),
(86, 'user11', '$2y$10$s3DXMV66.IjP5MGal89N1.ydesiqHow6CORV9a0Y5KfOpSHWb5Psm', 'user11@gmail.com', 962558665, 'user eleven', 0, 0, 1, '2022-06-19', 'avatar4.png_22.06.19.png', 0, 'verified'),
(92, 'Hassan', '$2y$10$yVrIC5l9E8G3Beb96wGwMufbSJ7OOQKAhPiGeao0BU4PbxEnmjHhG', 'arabh60@gmail.com', 71168714, 'Hassan arab', 0, 0, 1, '2022-07-07', 'drago.png_22.10.08.png', 372601, 'verified'),
(93, 'codac', '$2y$10$HNMWZa4JXfo8CUEGWWJlEewlkpqUo9wsKxzGGh.KxlHTg6Q5lcVhS', 'cadach60@gmail.com', 12365445, 'codac', 0, 0, 0, '2022-07-07', 'no-profile.jpg', 0, 'verified'),
(94, 'Ruru', '$2y$10$te.1.Hv03p2/VaQMuhrS.uJNDd6e.vxGgzwy5/V83BPd2LKkpXkcS', 'rawaamoukhayber2021@gmail.com', 2147483647, 'Rorita rorita ', 0, 0, 1, '2022-07-08', 'IMG_20210611_014044_552.jpg_22.07.14.jpg', 0, 'verified'),
(104, 'Dr.phone', '$2y$10$T.PyAgtVQHeyOwsYYk9ZduQe7iozS3.OD40MMclXjoO/ZzMsttYdi', 'symphonyx007@gmail.com', 78902075, 'Abdel karim jerdi', 0, 0, 1, '2022-07-11', 'IMG-20220711-WA0053.jpg_22.07.11.jpg', 0, 'verified'),
(105, 'Bob', '$2y$10$uvxlUphAF0Kkzftt1H30GeSAyHWrVi1JdMYM1KLKwwgCLENzbLLvy', 'bob4000@gmail.com', 71385373, 'Abedalwahab arab', 0, 0, 1, '2022-07-11', 'IMG_20220206_194907_183.jpg_22.07.11.jpg', 0, 'verified'),
(116, 'testUser', '$2y$10$sm8Hzzt3dqaYFzFdejaEie0xWPSCfzFYyYJlMlw5BRdLTdgNEop1m', 'testUser@gmail.com', 455555548, 'test user', 0, 0, 0, '2022-07-16', 'no-profile.jpg', 0, 'verified'),
(117, 'yaya', '$2y$10$BaYmkJ2QjgPga8USCk6VxephEtVJ039kZB9lg/BsBDTnCkG/uuhIy', 'yaya@gmail.com', 66666788, 'yaya', 0, 0, 0, '2022-07-17', 'no-profile.jpg', 700511, 'notverified'),
(119, 'drago', '$2y$10$2n8xc/FaZhbrMUaaDjk6yugK.s2PRyMYxxcA6.p4iTnjIoG1VRdiy', 'dragotube60@gmail.com', 558899, 'drago', 0, 0, 1, '2022-07-17', 'no-profile.jpg', 0, 'verified'),
(122, 'mark2', '$2y$10$UB57qkWNCnTgO4mIzhhRbu88bwDXOB2vLCczIXvHfAA6oMUkLnX5C', 'mark@gmail.com', 8874889, 'mark 2 ', 0, 0, 1, '2022-07-17', 'avarar2.jpg_22.07.17.jpg', 0, 'verified'),
(124, 'zack', '$2y$10$FRyHKdsiq3yZ38adZBrCneVDwafGgD6Xujmn45Q4wr.CkBnFnMndO', 'zack@gmail.com', 2147483647, 'zack ifron', 0, 0, 0, '2022-09-24', 'avatar5.jpg_22.09.24.jpg', 0, 'verified'),
(126, 'malek', '$2y$10$UzEX2AIIxbsXxBPvApVsG.iSU6tTLjfaVuS/npwiO1.nyAXffYgkm', 'malek7amze@gmail.com', 81105988, 'Malek kasha', 0, 0, 1, '2022-09-28', 'anonymus-guy-with-burning-rose-4k-bm.jpg_22.09.28.jpg', 0, 'verified'),
(127, 'adikadik', '$2y$10$IQXZbySEUVyML.JZhfrwLO1PdYMJc8EqjRYlXQOHhCPOwupWJCPtG', 'fluxifluxi16@gmail.com', 898282828, 'hshszzx', 0, 0, 1, '2022-10-05', 'no-profile.jpg', 0, 'verified'),
(128, 'mark', '$2y$10$uJjBADxQvACnT2n7Gyb0e.QX1zmlKE2JH8lEZHqNQv2M/.MsxeTRu', 'rockmark600@gmail.com', 96655899, 'mark rock', 0, 0, 1, '2022-10-08', 'avatar5.jpg_22.10.08.jpg', 0, 'verified');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Name` (`Name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `items_comment` (`item_id`),
  ADD KEY `comment_user` (`user_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_ID`),
  ADD KEY `member_1` (`Member_ID`),
  ADD KEY `cat_1` (`Cat_ID`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`l_id`),
  ADD KEY `member_3` (`user_name`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `member_2` (`item_id`),
  ADD KEY `member_4` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'to identify users', AUTO_INCREMENT=129;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `items_comment` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `cat_1` FOREIGN KEY (`Cat_ID`) REFERENCES `categories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_1` FOREIGN KEY (`Member_ID`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `member_3` FOREIGN KEY (`user_name`) REFERENCES `users` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `member_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
