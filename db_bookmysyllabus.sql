-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Oct 09, 2017 at 08:56 AM
-- Server version: 5.5.38
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_bookmysyllabus`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address`
--

CREATE TABLE `tbl_address` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `address` text NOT NULL,
  `landmark` varchar(100) NOT NULL,
  `postoffice` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_address`
--

INSERT INTO `tbl_address` (`id`, `user_id`, `type`, `address`, `landmark`, `postoffice`, `district`, `mobile`, `pincode`, `state`) VALUES
(2, 1, '', '2nd Floor, Kapoor Complex\r\nSujata Chowk', 'landmark', 'Ranchi Court S.O', 'Ranchi', '7739576693', '834001', 'Jharkhand'),
(3, 1, '', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'JHARKHAND'),
(4, 1, '', 'RSG Software Services Pvt Ltd', 'Jharkhand', 'Hulhundu B.O', 'Ranchi', '7739576693', '835221', 'JHARKHAND'),
(5, 2, '', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'JHARKHAND'),
(6, 3, NULL, 'Near Sunday Markey, Shivaji Marg, Ratu\r\nFirst Online School Books in Ranchi', 'Jharkhand', 'Hehal S.O', 'Ranchi', '8877177468', '834005', 'JHARKHAND'),
(7, 3, NULL, 'Near Sunday Markey, Shivaji Marg, Ratu\r\nFirst Online School Books in Ranchi', 'Jharkhand', 'Ratu S.O', 'Ranchi', '8877177468', '835222', 'JHARKHAND'),
(8, 3, NULL, 'Near Sunday Markey, Shivaji Marg, Ratu\r\nFirst Online School Books in Ranchi', 'Jharkhand', 'Indrapuri Colony S.O', 'Ranchi', '8877177468', '834001', 'JHARKHAND'),
(9, 3, NULL, 'Near Sunday Markey, Shivaji Marg, Ratu\r\nFirst Online School Books in Ranchi', 'Jharkhand', 'Jharkhand High Court S.O', 'Ranchi', '8877177468', '834002', 'JHARKHAND'),
(10, 2, NULL, 'RSG Software Services Pvt Ltd', 'Ranchi', 'Hulhundu B.O', 'Ranchi', '7739576693', '835221', 'JHARKHAND'),
(11, 2, NULL, 'RSG Software Services Pvt Ltd', 'Ranchi', 'Hulhundu B.O', 'Ranchi', '7739576693', '835221', 'JHARKHAND'),
(12, 5, NULL, 'Ranchi', 'Seven day', 'Lame Baragaon B.O', 'Ranchi', '9504304862', '834009', 'JHARKHAND'),
(13, 6, NULL, 'fjfjfjh', 'hvkvkj', 'Hehal S.O', 'Ranchi', '9970970970', '834005', 'JHARKHAND'),
(14, 13, NULL, 'Ranchi', 'JHARKHAND', 'Kantatoli S.O', 'Ranchi', '7894048210', '834001', 'JHARKHAND');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booklist`
--

CREATE TABLE `tbl_booklist` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL DEFAULT '0',
  `school` varchar(200) NOT NULL,
  `class_id` int(11) NOT NULL,
  `path` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tbl_booklist`
--

INSERT INTO `tbl_booklist` (`id`, `user_id`, `school_id`, `school`, `class_id`, `path`) VALUES
(10, 1, 2, 'St. Michael''s Public School', 5, 'booklist/cce-banner-new.jpg'),
(11, 1, 1, 'D A V BARIATU', 3, 'booklist/cce-banner-new.jpg'),
(14, 2, 0, 'school', 6, 'booklist/cce-banner-new.jpg'),
(15, 2, 2, 'St. Michael''s Public School', 6, 'booklist/stmichaelsbanner.jpg'),
(17, 3, 2, 'St. Michael''s Public School', 13, 'booklist/Desert.jpg'),
(18, 3, 2, 'St. Michael''s Public School', 12, 'booklist/2.jpg'),
(19, 2, 2, 'St. Michael''s Public School', 6, 'booklist/demo.jpg'),
(20, 2, 2, 'St. Michael''s Public School', 8, 'booklist/demo.jpg'),
(21, 3, 2, 'St. Michael''s Public School', 6, 'booklist/demo.jpg'),
(22, 13, 2, 'St. Michael''s Public School', 15, 'booklist/IMG-20170521-WA0002.jpg'),
(23, 14, 2, 'St. Michael''s Public School', 5, 'booklist/LEFT1 (2).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_books`
--

CREATE TABLE `tbl_books` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mrp` float NOT NULL,
  `discount` float NOT NULL DEFAULT '0',
  `cost` float NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tbl_books`
--

INSERT INTO `tbl_books` (`id`, `name`, `mrp`, `discount`, `cost`, `subject_id`, `class_id`, `school_id`) VALUES
(1, 'New Enjoying maths-3', 200, 5, 190, 1, 5, 1),
(2, 'Drill Exercise In Maths-3', 300, 2, 294, 1, 5, 1),
(3, 'New Learning To Communicate ENG. C/B-3', 200, 2, 196, 2, 5, 1),
(4, 'ESSE ENG. Grammar and COMP.-3', 200, 2, 196, 2, 5, 1),
(5, 'New Learning To Communicate ENG. C/B-3', 200, 10, 180, 2, 7, 2),
(6, 'ESSE ENG. Grammar and COMP.-3', 150, 5, 142.5, 2, 7, 2),
(7, 'Dialogue-3', 100, 2, 98, 2, 7, 2),
(8, 'Cursive Writing at Its Best', 180, 5, 171, 2, 7, 2),
(9, 'Oxford Reading Circle-3', 160, 5, 152, 2, 7, 2),
(10, 'Utakarsh Hindi Pathala (CCE) - 3 ', 200, 5, 190, 3, 7, 2),
(11, 'Main Aur Mera Vyakaran (CCE) - 3', 200, 10, 180, 3, 7, 2),
(12, 'Sadabahar Hindi Likhai - 4', 150, 2, 147, 3, 7, 2),
(13, 'Kahanee Parayan - 3', 150, 2, 147, 3, 7, 2),
(14, 'New Enjoying Maths-3', 200, 5, 190, 1, 7, 2),
(15, 'Drill Exercise In Maths-3', 180, 6, 169.2, 1, 7, 2),
(16, 'New Green Tree - 3', 120, 6, 112.8, 8, 7, 2),
(17, 'Knowledge Links - 3', 150, 5, 142.5, 6, 7, 2),
(18, 'Computer For School - 3', 250, 5, 237.5, 4, 7, 2),
(19, 'Splashes Art & Craft - 3', 100, 10, 90, 5, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `client_id` varchar(40) DEFAULT NULL,
  `school_id` int(11) NOT NULL DEFAULT '0',
  `class_id` int(11) NOT NULL DEFAULT '0',
  `product` text,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `booklist_id` int(11) NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `amount` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=338 ;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`id`, `user_id`, `client_id`, `school_id`, `class_id`, `product`, `product_id`, `booklist_id`, `price`, `quantity`, `amount`) VALUES
(2, 4, NULL, 0, 0, 'Learning to Communicate C/B - 3', 1, 0, 190, 1, 190),
(28, 3, NULL, 0, 0, 'Brown Rolls', 8, 0, 20, 1, 20),
(29, 3, NULL, 0, 0, 'Utkarsh Hindi Pathala (CCE) - 3', 3, 0, 147, 1, 147),
(30, 3, NULL, 0, 0, 'Oil Pastels', 7, 0, 81, 1, 81),
(31, 3, NULL, 0, 0, 'Drawing Notebook', 6, 0, 78.4, 2, 156.8),
(32, 3, NULL, 0, 0, 'Classmate Double Line Notebook', 5, 0, 39.2, 1, 39.2),
(33, 3, NULL, 0, 0, 'A4 Sheets', 9, 0, 25, 1, 25),
(34, 3, NULL, 2, 6, NULL, 0, 21, 0, 1, 0),
(57, 2, NULL, 0, 0, 'Scrap book', 11, 0, 49, 1, 49),
(58, 2, NULL, 0, 0, 'Drawing Notebook', 6, 0, 78.4, 1, 78.4),
(59, 2, NULL, 0, 0, 'Classmate Double Line Notebook', 5, 0, 39.2, 1, 39.2),
(77, 0, 'cd9980717287e84f000e8815f2ba219f', 0, 0, 'Brown Rolls', 8, 0, 20, 6, 120),
(181, 15, NULL, 0, 0, 'Learning to Communicate C/B - 3', 1, 0, 190, 1, 190),
(334, 14, NULL, 0, 0, 'Utkarsh Hindi Pathala (CCE) - 3', 3, 0, 147, 1, 147),
(335, 14, NULL, 2, 7, 'book,copy', 0, 0, 3133.95, 1, 3133.95),
(336, 14, NULL, 2, 5, '', 0, 0, 0, 1, 0),
(337, 14, NULL, 0, 0, 'New Enjoying Maths - 3', 10, 0, 225, 2, 450);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
`id` int(11) NOT NULL,
  `feature` longtext NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `feature`, `category`) VALUES
(1, 'Sub-category,Class,Subject,ISBN No,Publisher,Author,Language,Exam', 'Book'),
(3, 'Company,Size,Pages', 'Copy'),
(4, 'Company,Type', 'Stationery');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class`
--

CREATE TABLE `tbl_class` (
`id` int(11) NOT NULL,
  `class` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_class`
--

INSERT INTO `tbl_class` (`id`, `class`) VALUES
(1, 'Nursery'),
(2, 'Prep'),
(3, 'LKG'),
(4, 'UKG'),
(5, 'I'),
(6, 'II'),
(7, 'III'),
(8, 'IV'),
(9, 'V'),
(10, 'VI'),
(11, 'VII'),
(12, 'VIII'),
(13, 'IX'),
(14, 'X'),
(15, 'XI'),
(16, 'XII');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_copy`
--

CREATE TABLE `tbl_copy` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pages` int(11) NOT NULL,
  `quality` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `mrp` float NOT NULL,
  `discount` float NOT NULL DEFAULT '0',
  `cost` float NOT NULL,
  `class_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_copy`
--

INSERT INTO `tbl_copy` (`id`, `name`, `pages`, `quality`, `quantity`, `mrp`, `discount`, `cost`, `class_id`, `school_id`) VALUES
(1, 'Single Lines', 180, 'Classmate', 2, 50, 2, 98, 5, 1),
(2, 'Double Lines', 180, 'Classmate', 2, 50, 5, 95, 5, 1),
(3, 'Hindi(Double line)', 180, 'classmate', 2, 100, 2, 196, 5, 1),
(4, 'Single Line', 108, 'Classmate', 3, 40, 2, 117.6, 7, 2),
(5, 'Single Line', 72, 'Classmate', 7, 32, 0, 224, 7, 2),
(6, 'Double Line', 120, 'Classmate', 2, 40, 2, 78.4, 7, 2),
(7, 'Double Line', 72, 'Classmate', 1, 35, 2, 34.3, 7, 2),
(8, 'Interleaf Single Line', 172, 'Classmate', 2, 50, 5, 95, 7, 2),
(9, 'Interleaf Single Line', 72, 'Classmate', 2, 40, 2, 78.4, 7, 2),
(10, 'Line Copy', 180, 'Classmate', 3, 55, 5, 156.75, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feature`
--

CREATE TABLE `tbl_feature` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `tbl_feature`
--

INSERT INTO `tbl_feature` (`id`, `name`, `value`, `product_id`) VALUES
(3, 'ISBN No', '1234567891234', 20),
(4, 'PUBLISHER', 'Y. Kanetkar', 20),
(5, 'Brand', 'Writometer', 22),
(6, 'Model', 'Writometer', 22),
(7, 'Type', 'Ball-point', 22),
(8, 'Brand', 'Linc', 23),
(9, 'Model', 'Ocean', 23),
(10, 'Type', 'Gel', 23),
(11, 'ISBN No', '1234567891234', 1),
(12, 'PUBLISHER', 'Oxford', 1),
(13, 'ISBN No', '1234567891234', 2),
(14, 'PUBLISHER', 'Arya', 2),
(15, 'ISBN No', '1123212212345', 3),
(16, 'PUBLISHER', 'Madhubun', 3),
(17, 'Company', 'Classmate', 4),
(18, 'Size', '24 *18 cm', 4),
(19, 'Pages', '180', 4),
(20, 'Company', 'Classmate', 5),
(21, 'Size', '24 *18 cm', 5),
(22, 'Pages', '180', 5),
(23, 'Company', 'Classmate', 6),
(24, 'Size', '', 6),
(25, 'Pages', '80', 6),
(26, 'Company', 'Pentel Arts', 7),
(27, 'Type', 'Oil Pastels', 7),
(28, 'Company', 'Company 1', 8),
(29, 'Type', 'Cover Rolls', 8),
(30, 'Company', 'Baker Ross', 9),
(31, 'Type', 'A4 sheet', 9),
(32, 'ISBN No', '1234567264345', 10),
(33, 'PUBLISHER', 'Oxford', 10),
(34, 'Company', 'Classmate', 11),
(35, 'Size', '', 11),
(36, 'Pages', '32', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_footer`
--

CREATE TABLE `tbl_footer` (
`id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `value` longtext,
  `footer` int(10) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `published` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `tbl_footer`
--

INSERT INTO `tbl_footer` (`id`, `title`, `value`, `footer`, `image`, `published`) VALUES
(1, 'Shipping Policies', '', 1, '', 1),
(2, 'Payments', '', 1, '', 1),
(3, 'Exchange Policies', '', 1, '', 1),
(4, 'Privacy Policy', '', 1, '', 1),
(5, 'Terms & Conditions', '', 1, '', 1),
(6, 'Feedback', '', 1, '', 1),
(7, 'About Us', '', 2, '', 1),
(8, 'FAQs', '', 2, '', 1),
(9, 'Careers', '', 2, '', 1),
(10, 'Become a Seller', '', 2, '', 1),
(11, 'Customer Cares', '', 2, '', 1),
(12, 'Blog Seller', '', 2, '', 1),
(13, 'address', ' Near Sunday Market, Shivaji Marg, RatuRanchi - 835222,Jharkhand, India', 3, 'fa fa-globe', 1),
(14, 'mobile', '+91-8877177468', 3, 'fa fa-mobile fa-2x', 1),
(15, 'email', 'bookmysyllabus@gmail.com', 3, 'fa fa-envelope', 1),
(16, 'facebook', 'https://www.facebook.com/bookmysyllabus/', 4, 'images/facebook.png', 1),
(17, 'twitter', 'https://twitter.com/bookmysyllabus', 4, 'images/twitter.png', 1),
(18, 'linked in', 'https://www.linkedin.com/company/13425084/', 4, 'images/linkedin.png', 1),
(19, 'google plus', 'https://plus.google.com/100809176037972183502', 4, 'images/google-plus.png', 1),
(20, 'instagram', 'https://www.instagram.com/bookmysyllabus/', 4, 'images/instagram.png', 1),
(21, 'whatsapp', 'https://web.whatsapp.com', 4, 'images/whatsapp.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_images`
--

CREATE TABLE `tbl_images` (
`id` int(11) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL DEFAULT '0',
  `famous` varchar(10) NOT NULL DEFAULT '0',
  `school_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_images`
--

INSERT INTO `tbl_images` (`id`, `logo`, `banner`, `featured`, `famous`, `school_id`) VALUES
(1, 'logo/150736256235150736245462150736169113LOGO.png', 'banners/1507362562231507362289312.jpg', '1', '1', 1),
(2, 'logo/holy-cross.png', 'banners/banner.jpg', '1', '1', 2),
(3, 'logo/150736245462150736169113LOGO.png', 'banners/150736245401507361691892.jpg', '0', '0', 3),
(4, 'logo/15073618800holy-cross.png', 'banners/1507361880822.jpg', '0', '0', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE `tbl_member` (
`id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `login_id` varchar(255) DEFAULT NULL,
  `login_type` varchar(100) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`id`, `name`, `mobile`, `email`, `password`, `login_id`, `login_type`, `active`) VALUES
(1, 'Chitranjan Mahto', '9504304862', 'chitranjan21@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, NULL, 1),
(2, 'Atal Prateek', '7739576693', 'prateek.atal@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, NULL, 1),
(3, 'SUPRIT SUMAN', '8877177468', 'suprit002@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, 1),
(4, 'Atal Prateek', '7739576694', 'atal@rsgss.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, 1),
(5, 'chitranjan kumar', '9504304862', 'chitranjan21@gmail.com', 'f033ab37c30201f73f142449d037028d', NULL, NULL, 1),
(6, 'gjhgkj', '9970970970', 'khgkjgj@ggkj.com', 'd1fe173d08e959397adf34b1d77e88d7', NULL, NULL, 1),
(7, 'Kr Chitranjan', NULL, NULL, NULL, '1223023954471068', 'facebook', 1),
(8, 'Atal Prateek Barla', NULL, NULL, NULL, '1615143361850069', NULL, 1),
(9, 'Chitranjan kr. ranjan', NULL, 'chitranjan.ssd@gmail.com', NULL, '118194974433148491302', 'googlePlus', 1),
(10, 'Atal Prateek Barla', NULL, 'prateek.atal@gmail.com', NULL, '105376074128049760032', NULL, 1),
(11, 'Manoj Ranjan', NULL, NULL, '202cb962ac59075b964b07152d234b70', '1721318237879339', NULL, 1),
(12, 'Gabbar Singh', NULL, NULL, NULL, '851409315028580', NULL, 1),
(13, 'subham choudhary', NULL, 'isubham007@gmail.com', NULL, '117490103457449023960', NULL, 1),
(14, 'SHOMPA KUMARI', NULL, 'shompa22nanu@gmail.com', NULL, '113071601332934802377', NULL, 1),
(15, 'BookMySyllabus ASR ESYLLABUS PVT. LTD.', NULL, 'bookmysyllabus@gmail.com', NULL, '100809176037972183502', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_news`
--

CREATE TABLE `tbl_news` (
`id` int(11) NOT NULL,
  `date` date NOT NULL,
  `title` varchar(50) NOT NULL,
  `link` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `published` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_news`
--

INSERT INTO `tbl_news` (`id`, `date`, `title`, `link`, `description`, `published`) VALUES
(1, '2017-09-05', 'JVM Shyamali ', 'http://jvmshyamali.com/tcisssue_list', 'View TC''s Issued', 1),
(2, '2017-09-05', ' St. Thomas', 'http://www.stthomasschoolranchi.com/', 'Summary of Result -2017 & Book List is available on it''s website', 1),
(3, '2017-09-05', 'Xavier''s School ', 'http://www.stxaviersschool.com/x/index.php', 'Schedule of First Terminal Examination Routine of Classes KG to V & VI to IX - 2017', 1),
(4, '2017-09-05', 'DPS, Ranchi', 'http://dpsranchi.com/index.php', 'Celebrates it''s 28th Foundation Day', 1),
(5, '2017-09-05', ' Oxford ', 'http://www.oxfordpublicschool.net.in/index.aspx?AspxAutoDetectCookieSupport=1', 'Download Bus Form', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orderlist`
--

CREATE TABLE `tbl_orderlist` (
`id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL DEFAULT '0',
  `class_id` int(11) NOT NULL DEFAULT '0',
  `product` text,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `booklist_id` int(11) NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL DEFAULT '0',
  `amount` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

--
-- Dumping data for table `tbl_orderlist`
--

INSERT INTO `tbl_orderlist` (`id`, `order_id`, `user_id`, `school_id`, `class_id`, `product`, `product_id`, `booklist_id`, `price`, `quantity`, `amount`) VALUES
(1, 2, 1, 1, 5, 'book,copy', 0, 0, 1070.5, 1, 1070.5),
(2, 3, 1, 2, 7, 'book,copy', 0, 0, 3029.45, 1, 3029.45),
(3, 4, 1, 0, 0, 'Writometer', 22, 0, 19.8, 1, 19.8),
(4, 5, 1, 0, 0, 'Writometer', 22, 0, 19.8, 2, 39.6),
(5, 5, 1, 1, 5, 'book,copy,stationery', 0, 0, 1186, 2, 2372),
(6, 5, 1, 0, 0, 'New Enjoying maths-3', 3, 0, 285, 1, 285),
(7, 6, 1, 0, 0, 'Writometer', 22, 0, 19.8, 1, 19.8),
(8, 7, 1, 0, 0, 'New Enjoying maths-3', 14, 0, 285, 10, 2850),
(9, 7, 1, 0, 0, 'Writometer', 22, 0, 19.8, 10, 198),
(10, 7, 1, 0, 0, 'Learning to Communicate C/B - 3', 1, 0, 190, 1, 190),
(11, 7, 1, 0, 0, 'Drill Exercise in Maths - 3', 2, 0, 225, 1, 225),
(12, 7, 1, 0, 0, 'Utkarsh Hindi Pathala (CCE) - 3', 3, 0, 147, 1, 147),
(13, 7, 1, 0, 0, 'Classmate Single Line Notebook', 4, 0, 49, 1, 49),
(14, 7, 1, 0, 0, 'Classmate Double Line Notebook', 5, 0, 39.2, 1, 39.2),
(15, 7, 1, 0, 0, 'Drawing Notebook', 6, 0, 78.4, 1, 78.4),
(16, 7, 1, 0, 0, 'Oil Pastels', 7, 0, 85.5, 1, 85.5),
(17, 7, 1, 0, 0, 'Brown Rolls', 8, 0, 20, 1, 20),
(18, 7, 1, 0, 0, 'A4 Sheets', 9, 0, 25, 1, 25),
(19, 8, 1, 2, 5, '', 0, 10, 0, 1, 0),
(20, 9, 1, 0, 0, 'Classmate Single Line Notebook', 4, 0, 49, 1, 49),
(21, 9, 1, 0, 0, 'Classmate Double Line Notebook', 5, 0, 39.2, 1, 39.2),
(22, 9, 1, 0, 0, 'Scrap book', 11, 0, 49, 1, 49),
(23, 10, 1, 1, 3, '', 0, 11, 0, 1, 0),
(24, 11, 1, 0, 0, 'Learning to Communicate C/B - 3', 1, 0, 190, 1, 190),
(25, 12, 1, 0, 0, 'Oil Pastels', 7, 0, 81, 1, 81),
(26, 13, 2, 0, 0, 'Learning to Communicate C/B - 3', 1, 0, 190, 1, 190),
(27, 14, 2, 0, 0, 'Oil Pastels', 7, 0, 81, 1, 81),
(28, 15, 2, 0, 0, 'Classmate Single Line Notebook', 4, 0, 49, 1, 49),
(29, 15, 2, 0, 0, 'Scrap book', 11, 0, 49, 1, 49),
(30, 16, 2, 0, 0, 'Learning to Communicate C/B - 3', 1, 0, 190, 1, 190),
(31, 16, 2, 0, 0, 'Drill Exercise in Maths - 3', 2, 0, 225, 1, 225),
(32, 17, 2, 0, 0, 'Learning to Communicate C/B - 3', 1, 0, 190, 1, 190),
(33, 18, 2, 0, 0, 'Classmate Double Line Notebook', 5, 0, 39.2, 1, 39.2),
(34, 18, 2, 0, 0, 'Scrap book', 11, 0, 49, 1, 49),
(35, 19, 2, 0, 0, 'Learning to Communicate C/B - 3', 1, 0, 190, 1, 190),
(36, 19, 2, 0, 0, 'New Enjoying Maths - 3', 10, 0, 225, 1, 225),
(37, 20, 2, 0, 0, 'Learning to Communicate C/B - 3', 1, 0, 190, 1, 190),
(38, 21, 2, 0, 0, 'Classmate Single Line Notebook', 4, 0, 49, 1, 49),
(39, 22, 2, 0, 0, 'Learning to Communicate C/B - 3', 1, 0, 190, 1, 190),
(40, 22, 2, 0, 0, 'Utkarsh Hindi Pathala (CCE) - 3', 3, 0, 147, 1, 147),
(41, 23, 2, 0, 0, 'Learning to Communicate C/B - 3', 1, 0, 190, 1, 190),
(42, 24, 2, 0, 0, 'Learning to Communicate C/B - 3', 1, 0, 190, 1, 190),
(43, 25, 2, 0, 0, 'Learning to Communicate C/B - 3', 1, 0, 190, 1, 190),
(44, 26, 2, 0, 0, 'Learning to Communicate C/B - 3', 1, 0, 190, 1, 190),
(45, 27, 2, 0, 0, 'Learning to Communicate C/B - 3', 1, 0, 190, 1, 190),
(46, 27, 2, 0, 0, 'Utkarsh Hindi Pathala (CCE) - 3', 3, 0, 147, 1, 147),
(47, 28, 2, 0, 6, '', 0, 14, 0, 1, 0),
(48, 29, 0, 1, 5, 'book', 0, 0, 876, 1, 876),
(49, 30, 0, 1, 5, 'book', 0, 0, 876, 1, 876),
(50, 31, 0, 1, 5, 'book', 0, 0, 876, 1, 876),
(51, 32, 0, 1, 5, 'book', 0, 0, 876, 1, 876),
(52, 33, 0, 1, 5, 'book', 0, 0, 876, 1, 876),
(53, 34, 2, 2, 7, 'book,copy', 0, 0, 3029.45, 1, 3029.45),
(54, 35, 1, 2, 7, 'book,copy', 0, 0, 3029.45, 3, 9088.35),
(55, 36, 2, 2, 7, 'book,copy', 0, 0, 3029.45, 1, 3029.45),
(56, 36, 2, 1, 5, 'book,copy,stationery', 0, 0, 1186, 1, 1186),
(57, 37, 2, 0, 0, 'Classmate Single Line Notebook', 4, 0, 49, 1, 49),
(58, 37, 2, 2, 7, 'book', 0, 0, 2349.5, 1, 2349.5),
(59, 38, 2, 0, 0, 'Drill Exercise in Maths - 3', 2, 0, 225, 1, 225),
(60, 39, 2, 0, 0, 'Drawing Notebook', 6, 0, 78.4, 1, 78.4),
(61, 40, 2, 2, 6, '', 0, 15, 0, 1, 0),
(62, 41, 3, 2, 7, 'book,copy', 0, 0, 3133.95, 1, 3133.95),
(63, 42, 3, 2, 12, '', 0, 18, 0, 1, 0),
(64, 45, 13, 2, 15, '', 0, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
`id` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment` varchar(20) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `landmark` varchar(100) NOT NULL,
  `postoffice` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `state` varchar(50) NOT NULL,
  `total_amount` float NOT NULL DEFAULT '0',
  `dispatch_date` date DEFAULT '0000-00-00',
  `delivered_date` date DEFAULT '0000-00-00',
  `status` int(11) NOT NULL DEFAULT '0',
  `view` int(11) NOT NULL DEFAULT '0',
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`id`, `date`, `user_id`, `payment`, `student_name`, `name`, `address`, `landmark`, `postoffice`, `district`, `mobile`, `pincode`, `state`, `total_amount`, `dispatch_date`, `delivered_date`, `status`, `view`, `added_on`) VALUES
(1, '2017-09-02', 1, 'cod', '', 'Chitranjan Mahto', 'RSG Software Services Pvt Ltd', 'STPI', 'Namkom', 'Ranchi', '7739576693', '834010', 'Ranchi', 3029, '0000-00-00', '0000-00-00', 0, 0, '2017-09-02 09:42:23'),
(2, '2017-09-02', 1, 'cod', '', 'Chitranjan Mahto', 'RSG Software Services Pvt Ltd', 'STPI', 'Namkom', 'Ranchi', '7739576693', '834010', 'Ranchi', 1071, '0000-00-00', '0000-00-00', 0, 0, '2017-09-02 09:44:38'),
(3, '2017-09-02', 1, 'cod', '', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkom', 'Ranchi', '7739576693', '834002', 'Ranchi', 3029, '0000-00-00', '0000-00-00', 0, 0, '2017-09-02 09:49:00'),
(4, '2017-09-04', 1, 'cod', '', 'Chitranjan Mahto', 'RSG Software Services Pvt Ltd', 'STPI', 'Namkom', 'Ranchi', '7739576693', '834010', 'Ranchi', 20, '0000-00-00', '0000-00-00', 0, 0, '2017-09-04 09:57:10'),
(5, '2017-09-05', 1, 'cod', 'Atal', 'Chitranjan Mahto', '2nd Flor, Kapoor Complex\r\nSujata Chowk', 'landmark', 'Ranchi', 'Ranchi', '7739576693', '834001', 'Jharkhand', 2697, '0000-00-00', '0000-00-00', 0, 0, '2017-09-05 04:25:34'),
(6, '2017-09-05', 1, 'cod', 'Prateek', 'Chitranjan Mahto', '2nd Flor, Kapoor Complex\r\nSujata Chowk', 'landmark', 'Ranchi', 'Ranchi', '7739576693', '834001', 'Jharkhand', 20, '0000-00-00', '0000-00-00', 0, 0, '2017-09-05 04:49:05'),
(7, '2017-09-05', 1, 'cod', 'Prateek', 'Chitranjan Mahto', '2nd Flor, Kapoor Complex\r\nSujata Chowk', 'landmark', 'Ranchi', 'Ranchi', '7739576693', '834001', 'Jharkhand', 3907, '0000-00-00', '0000-00-00', 0, 0, '2017-09-05 11:12:41'),
(8, '2017-09-13', 1, 'cod', 'Prateek', 'Chitranjan Mahto', '2nd Floor, Kapoor Complex\r\nSujata Chowk', 'landmark', 'Ranchi Court S.O', 'Ranchi', '7739576693', '834001', 'Jharkhand', 0, '0000-00-00', '2017-09-13', 2, 0, '2017-09-13 11:51:50'),
(9, '2017-09-13', 1, 'cod', 'Prateek', 'Chitranjan Mahto', '2nd Floor, Kapoor Complex\r\nSujata Chowk', 'landmark', 'Ranchi Court S.O', 'Ranchi', '7739576693', '834001', 'Jharkhand', 137, '0000-00-00', '0000-00-00', 0, 0, '2017-09-13 12:03:11'),
(10, '2017-09-14', 1, 'cod', 'Prateek', 'Chitranjan Mahto', '2nd Floor, Kapoor Complex\r\nSujata Chowk', 'landmark', 'Ranchi Court S.O', 'Ranchi', '7739576693', '834001', 'Jharkhand', 0, '0000-00-00', '0000-00-00', 0, 0, '2017-09-14 04:05:52'),
(11, '2017-09-14', 1, 'cod', 'Prateek', 'Chitranjan Mahto', '2nd Floor, Kapoor Complex\r\nSujata Chowk', 'landmark', 'Hulhundu B.O', 'Ranchi', '7739576693', '835221', 'JHARKHAND', 190, '0000-00-00', '0000-00-00', 0, 0, '2017-09-14 07:01:30'),
(12, '2017-09-14', 1, 'cod', 'Prateek', 'Chitranjan Mahto', '2nd Floor, Kapoor Complex\r\nSujata Chowk', 'landmark', 'Ranchi Court S.O', 'Ranchi', '7739576693', '834001', 'Jharkhand', 81, '0000-00-00', '0000-00-00', 0, 0, '2017-09-14 07:40:42'),
(13, '2017-09-14', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'JHARKHAND', 190, '0000-00-00', '0000-00-00', 3, 0, '2017-09-14 10:24:48'),
(14, '2017-09-14', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'JHARKHAND', 81, '0000-00-00', '0000-00-00', 3, 0, '2017-09-14 10:25:19'),
(15, '2017-09-14', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'JHARKHAND', 98, '0000-00-00', '0000-00-00', 3, 0, '2017-09-14 10:26:41'),
(16, '2017-09-14', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'JHARKHAND', 415, '0000-00-00', '0000-00-00', 3, 0, '2017-09-15 06:26:34'),
(17, '2017-09-14', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'JHARKHAND', 190, '0000-00-00', '0000-00-00', 0, 0, '2017-09-14 07:48:21'),
(18, '2017-09-14', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'JHARKHAND', 88, '0000-00-00', '0000-00-00', 0, 0, '2017-09-14 08:06:37'),
(19, '2017-09-14', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'JHARKHAND', 415, '0000-00-00', '0000-00-00', 0, 0, '2017-09-14 08:08:38'),
(20, '2017-09-14', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'JHARKHAND', 190, '0000-00-00', '0000-00-00', 0, 0, '2017-09-14 08:13:45'),
(21, '2017-09-14', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'JHARKHAND', 49, '0000-00-00', '0000-00-00', 0, 0, '2017-09-14 09:02:26'),
(22, '2017-09-14', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'JHARKHAND', 337, '0000-00-00', '0000-00-00', 0, 0, '2017-09-14 09:49:20'),
(23, '2017-09-14', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'JHARKHAND', 190, '0000-00-00', '0000-00-00', 0, 0, '2017-09-14 09:51:26'),
(24, '2017-09-14', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'JHARKHAND', 190, '2017-09-15', '2017-09-23', 1, 0, '2017-09-15 03:55:43'),
(25, '2017-09-14', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'JHARKHAND', 190, '2017-09-14', '2017-09-17', 2, 1, '2017-09-15 06:17:05'),
(26, '2017-09-14', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'JHARKHAND', 190, '0000-00-00', '0000-00-00', 3, 0, '2017-09-14 11:21:47'),
(27, '2017-09-14', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'JHARKHAND', 337, '0000-00-00', '0000-00-00', 3, 0, '2017-09-14 11:21:06'),
(28, '2017-09-14', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'JHARKHAND', 0, '2017-09-14', '2017-09-23', 3, 0, '2017-09-14 11:20:36'),
(29, '2017-09-15', 0, 'cod', 'Atal Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum', 'Ranchi', '7739576693', '834010', 'Jharkhand', 876, '0000-00-00', '0000-00-00', 0, 0, '2017-09-15 04:01:11'),
(30, '2017-09-15', 0, 'cod', 'Atal Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum', 'Ranchi', '7739576693', '834010', 'Jharkhand', 876, '0000-00-00', '0000-00-00', 0, 0, '2017-09-15 04:01:57'),
(31, '2017-09-15', 0, 'cod', 'Atal Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum', 'Ranchi', '7739576693', '834010', 'Jharkhand', 876, '0000-00-00', '0000-00-00', 0, 0, '2017-09-15 04:02:45'),
(32, '2017-09-15', 0, 'cod', 'Atal Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum', 'Ranchi', '7739576693', '834010', 'Jharkhand', 876, '0000-00-00', '0000-00-00', 0, 1, '2017-09-15 06:29:46'),
(33, '2017-09-15', 0, 'cod', 'Atal Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum', 'Ranchi', '7739576693', '834010', 'Jharkhand', 876, '0000-00-00', '0000-00-00', 0, 0, '2017-09-15 04:10:34'),
(34, '2017-09-15', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'JHARKHAND', 3029, '0000-00-00', '0000-00-00', 0, 0, '2017-09-15 05:52:41'),
(35, '2017-09-15', 1, 'cod', 'Prateek', 'Chitranjan Mahto', '2nd Floor, Kapoor Complex\r\nSujata Chowk', 'landmark', 'Ranchi Court S.O', 'Ranchi', '7739576693', '834001', 'Jharkhand', 9088, '0000-00-00', '0000-00-00', 0, 1, '2017-09-16 04:17:25'),
(36, '2017-09-15', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'JHARKHAND', 4215, '0000-00-00', '0000-00-00', 0, 1, '2017-09-15 06:16:59'),
(37, '2017-09-16', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'Ranchi', 2399, '0000-00-00', '0000-00-00', 0, 1, '2017-09-16 04:28:55'),
(38, '2017-09-16', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'Ranchi', 225, '0000-00-00', '0000-00-00', 0, 0, '2017-09-16 06:26:45'),
(39, '2017-09-16', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'Ranchi', 78, '0000-00-00', '0000-00-00', 0, 0, '2017-09-16 07:01:34'),
(40, '2017-09-16', 2, 'cod', 'Prateek', 'Atal Prateek', 'RSG Software Services Pvt Ltd', 'Ranchi', 'Namkum S.O', 'Ranchi', '7739576693', '834010', 'Ranchi', 0, '0000-00-00', '0000-00-00', 0, 1, '2017-09-20 05:58:54'),
(41, '2017-09-20', 3, 'cod', 'gdhgdh', 'SUPRIT SUMAN', 'Near Sunday Markey, Shivaji Marg, Ratu\r\nFirst Online School Books in Ranchi', 'Jharkhand', 'Indrapuri Colony S.O', 'Ranchi', '8877177468', '834001', 'JHARKHAND', 3134, '0000-00-00', '0000-00-00', 0, 1, '2017-10-05 20:06:19'),
(42, '2017-09-20', 3, 'cod', 'gg', 'SUPRIT SUMAN', 'Near Sunday Markey, Shivaji Marg, Ratu\r\nFirst Online School Books in Ranchi', 'Jharkhand', 'Indrapuri Colony S.O', 'Ranchi', '8877177468', '834001', 'JHARKHAND', 0, '0000-00-00', '0000-00-00', 0, 0, '2017-09-20 10:10:05'),
(43, '2017-09-21', 5, 'cod', 'chitranjan kumar', 'Ranjan Kumar', 'Ranchi', 'Seven day', 'Lame Baragaon B.O', 'Ranchi', '9504304862', '834009', 'JHARKHAND', 876, '0000-00-00', '0000-00-00', 0, 0, '2017-09-21 12:08:33'),
(44, '2017-09-24', 6, 'cod', 'gjhgkj', 'kjgkj', 'fjfjfjh', 'hvkvkj', 'Hehal S.O', 'Ranchi', '9970970970', '834005', 'JHARKHAND', 3134, '0000-00-00', '0000-00-00', 0, 0, '2017-09-23 05:55:13'),
(45, '2017-09-25', 13, 'cod', 'Subham', 'subham choudhary', 'Ranchi', 'JHARKHAND', 'Kantatoli S.O', 'Ranchi', '7894048210', '834001', 'JHARKHAND', 0, '0000-00-00', '0000-00-00', 3, 1, '2017-09-30 06:20:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pincode`
--

CREATE TABLE `tbl_pincode` (
`id` int(11) NOT NULL,
  `pincode` int(11) NOT NULL,
  `po` varchar(100) DEFAULT NULL,
  `district` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_pincode`
--

INSERT INTO `tbl_pincode` (`id`, `pincode`, `po`, `district`, `state`) VALUES
(4, 834002, 'Jharkhand High Court S.O', 'Ranchi', 'JHARKHAND'),
(5, 834005, 'Hehal S.O', 'Ranchi', 'JHARKHAND');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `discount` float NOT NULL DEFAULT '0',
  `cost` float NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `name`, `price`, `discount`, `cost`, `category`, `description`, `image`, `thumbnail`) VALUES
(1, 'Learning to Communicate C/B - 3', 200, 5, 190, 'Book', 'Learning to Communicate C/B - 3', 'products/1504604387-product.jpg', 'thumbnails/1504604387-product.jpg'),
(2, 'Drill Exercise in Maths - 3', 250, 10, 225, 'Book', 'drill exercise in mathematics class 3', 'products/1504604692-product.jpg', 'thumbnails/1504604692-product.jpg'),
(3, 'Utkarsh Hindi Pathala (CCE) - 3', 150, 2, 147, 'Book', 'Utkarsh Hindi Pathala (CCE) - 3', 'products/1504604872-product.jpg', 'thumbnails/1504604872-product.jpg'),
(4, 'Classmate Single Line Notebook', 50, 2, 49, 'Copy', 'Classmate Single Line Notebook', 'products/1504605173-product.jpg', 'thumbnails/1504605173-product.jpg'),
(5, 'Classmate Double Line Notebook', 40, 2, 39.2, 'Copy', 'Classmate Double Line Notebook', 'products/1504605781-product.jpg', 'thumbnails/1504605781-product.jpg'),
(6, 'Drawing Notebook', 80, 2, 78.4, 'Copy', 'Drawing Notebook', 'products/1504605995-product.jpg', 'thumbnails/1504605995-product.jpg'),
(7, 'Oil Pastels', 90, 10, 81, 'Stationery', 'Oil Pastels', 'products/1504606299-product.jpg', 'thumbnails/1504606299-product.jpg'),
(8, 'Brown Rolls', 20, 0, 20, 'Stationery', 'Brown Rolls-Cover Rolls', 'products/1504606574-product.jpg', 'thumbnails/1504606574-product.jpg'),
(9, 'A4 Sheets', 25, 0, 25, 'Stationery', 'A4 Sheets', 'products/1504606681-product.jpeg', 'thumbnails/1504606681-product.jpeg'),
(10, 'New Enjoying Maths - 3', 250, 10, 225, 'Book', 'New Enjoying Maths - 3', 'products/1505205884-product.jpg', 'thumbnails/1505205884-product.jpg'),
(11, 'Scrap book', 50, 2, 49, 'Copy', 'Classmate Scrap book', 'products/1505206012-product.jpg', 'thumbnails/1505206012-product.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_review`
--

CREATE TABLE `tbl_review` (
`id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review` text,
  `rating` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_review`
--

INSERT INTO `tbl_review` (`id`, `product_id`, `user_id`, `review`, `rating`, `added_on`) VALUES
(1, 10, 14, 'nice', 5, '2017-09-30 06:09:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_school`
--

CREATE TABLE `tbl_school` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `board` varchar(10) DEFAULT NULL,
  `session` varchar(20) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `phone` varchar(40) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `published` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_school`
--

INSERT INTO `tbl_school` (`id`, `name`, `board`, `session`, `class`, `email`, `website`, `phone`, `address`, `published`) VALUES
(1, 'D A V BARIATU', 'CBSE', '2017-2018', 'I-XII', 'info@davbariatu.com', 'www.davbariatu.edu.in', '0651-765473', 'ranchi-834009, Jharkhand', 1),
(2, 'St. Michael''s Public School', 'CBSE', '2017-2018', 'LKG-XII', 'stmichaelsranchi123@rediffmail.com', 'http://stmichaelsranchi.org/', '0651 2246098', 'St. Michael''s Public School\r\nRoad No - 4B, Ashok Nagar\r\nRanchi, Jharkhand - 834002', 1),
(3, 'KAIRALI SCHOOL, DHURWA', 'CBSE', '2017-2018', 'IV-VIII', '', '', '', '', 1),
(4, 'S B M, KAMRE', 'CBSE', '2017-2018', '-', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stationary`
--

CREATE TABLE `tbl_stationary` (
`id` int(11) NOT NULL,
  `particulars` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `mrp` float NOT NULL,
  `discount` float NOT NULL DEFAULT '0',
  `cost` float NOT NULL,
  `class_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_stationary`
--

INSERT INTO `tbl_stationary` (`id`, `particulars`, `quantity`, `mrp`, `discount`, `cost`, `class_id`, `school_id`) VALUES
(1, 'Brown Rolls', '3 Sets', 70, 5, 66.5, 5, 1),
(3, 'Oil Pastol Colour', '1 set', 50, 2, 49, 5, 1),
(4, 'bottle', '1 set', 20, 1, 19.8, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE `tbl_subject` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `published` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`id`, `name`, `published`) VALUES
(1, 'Mathematics', '1'),
(2, 'English', '1'),
(3, 'Hindi', '1'),
(4, 'Computer', '1'),
(5, 'Drawing', '1'),
(6, 'General Knowledge', '1'),
(8, 'Environmental Studies', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscriptions`
--

CREATE TABLE `tbl_subscriptions` (
`id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `added_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_subscriptions`
--

INSERT INTO `tbl_subscriptions` (`id`, `email`, `active`, `added_on`) VALUES
(5, 'atal.prateek@rsgss.com', 1, '2017-09-19 07:22:20'),
(6, 'chitranjan.mahto@rsgss.com', 1, '2017-09-19 07:23:16'),
(7, 'suprit002@gmail.com', 1, '2017-09-19 07:42:49'),
(8, 'robin.mohfw@gmIl.com', 1, '2017-09-23 10:01:48'),
(9, 'hubit211@gmail.com', 1, '2017-09-25 14:33:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tempadd`
--

CREATE TABLE `tbl_tempadd` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `address` text NOT NULL,
  `landmark` varchar(100) NOT NULL,
  `postoffice` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `state` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_tempadd`
--

INSERT INTO `tbl_tempadd` (`id`, `user_id`, `name`, `student_name`, `type`, `address`, `landmark`, `postoffice`, `district`, `mobile`, `pincode`, `state`) VALUES
(8, 3, 'SUPRIT SUMAN', 'CHGFJH', NULL, 'Near Sunday Markey, Shivaji Marg, Ratu\r\nFirst Online School Books in Ranchi', 'Jharkhand', 'Ratu S.O', 'Ranchi', '8877177468', '835222', 'JHARKHAND');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_topbar`
--

CREATE TABLE `tbl_topbar` (
`id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `value` varchar(100) NOT NULL,
  `published` int(11) NOT NULL,
  `class` varchar(20) NOT NULL,
  `side` varchar(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_topbar`
--

INSERT INTO `tbl_topbar` (`id`, `title`, `value`, `published`, `class`, `side`) VALUES
(1, 'phone', ' +91-8877177468 ', 1, 'fa fa-phone', 'left'),
(2, 'email', 'bookmysyllabus@gmail.com', 1, 'fa fa-envelope', 'left'),
(3, 'facebook', 'https://www.facebook.com/bookmysyllabus/', 1, 'fa fa-facebook', 'right'),
(4, 'twiter', 'https://twitter.com/bookmysyllabus', 1, 'fa fa-twitter', 'right'),
(5, 'linkedin', 'https://www.linkedin.com/company/13425084/', 1, 'fa fa-linkedin', 'right'),
(6, 'google plus', 'https://plus.google.com/u/0/100809176037972183502', 1, 'fa fa-google-plus', 'right'),
(7, 'instagram', 'https://www.instagram.com/bookmysyllabus/', 1, 'fa fa-instagram', 'right'),
(8, 'whatsapp', 'https://web.whatsapp.com', 1, 'fa fa-whatsapp', 'right');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `client_id` varchar(100) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `product` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`id`, `user_id`, `client_id`, `product_id`, `product`) VALUES
(13, 3, '', 2, 'Drill Exercise in Maths - 3'),
(15, 2, '', 4, 'Classmate Single Line Notebook'),
(16, 14, '', 3, 'Utkarsh Hindi Pathala (CCE) - 3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
`id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` varchar(10) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` int(1) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_on`, `active`) VALUES
(1, 'admin', 'admin', 'admin', '2016-12-27 04:21:01', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_address`
--
ALTER TABLE `tbl_address`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_booklist`
--
ALTER TABLE `tbl_booklist`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_books`
--
ALTER TABLE `tbl_books`
 ADD PRIMARY KEY (`id`), ADD KEY `FK_bid` (`school_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `category` (`category`);

--
-- Indexes for table `tbl_class`
--
ALTER TABLE `tbl_class`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_copy`
--
ALTER TABLE `tbl_copy`
 ADD PRIMARY KEY (`id`), ADD KEY `FK_cid` (`school_id`);

--
-- Indexes for table `tbl_feature`
--
ALTER TABLE `tbl_feature`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_footer`
--
ALTER TABLE `tbl_footer`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_images`
--
ALTER TABLE `tbl_images`
 ADD PRIMARY KEY (`id`), ADD KEY `FK_schoolid` (`school_id`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_news`
--
ALTER TABLE `tbl_news`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_orderlist`
--
ALTER TABLE `tbl_orderlist`
 ADD PRIMARY KEY (`id`), ADD KEY `FK_orderid` (`order_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pincode`
--
ALTER TABLE `tbl_pincode`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_review`
--
ALTER TABLE `tbl_review`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_school`
--
ALTER TABLE `tbl_school`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stationary`
--
ALTER TABLE `tbl_stationary`
 ADD PRIMARY KEY (`id`), ADD KEY `FK_sid` (`school_id`);

--
-- Indexes for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subscriptions`
--
ALTER TABLE `tbl_subscriptions`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_tempadd`
--
ALTER TABLE `tbl_tempadd`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_topbar`
--
ALTER TABLE `tbl_topbar`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
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
-- AUTO_INCREMENT for table `tbl_address`
--
ALTER TABLE `tbl_address`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_booklist`
--
ALTER TABLE `tbl_booklist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tbl_books`
--
ALTER TABLE `tbl_books`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=338;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_class`
--
ALTER TABLE `tbl_class`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbl_copy`
--
ALTER TABLE `tbl_copy`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbl_feature`
--
ALTER TABLE `tbl_feature`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `tbl_footer`
--
ALTER TABLE `tbl_footer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tbl_images`
--
ALTER TABLE `tbl_images`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbl_news`
--
ALTER TABLE `tbl_news`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_orderlist`
--
ALTER TABLE `tbl_orderlist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `tbl_pincode`
--
ALTER TABLE `tbl_pincode`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_review`
--
ALTER TABLE `tbl_review`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_school`
--
ALTER TABLE `tbl_school`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_stationary`
--
ALTER TABLE `tbl_stationary`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_subscriptions`
--
ALTER TABLE `tbl_subscriptions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_tempadd`
--
ALTER TABLE `tbl_tempadd`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_topbar`
--
ALTER TABLE `tbl_topbar`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_books`
--
ALTER TABLE `tbl_books`
ADD CONSTRAINT `FK_bid` FOREIGN KEY (`school_id`) REFERENCES `tbl_school` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_copy`
--
ALTER TABLE `tbl_copy`
ADD CONSTRAINT `FK_cid` FOREIGN KEY (`school_id`) REFERENCES `tbl_school` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_images`
--
ALTER TABLE `tbl_images`
ADD CONSTRAINT `FK_schoolid` FOREIGN KEY (`school_id`) REFERENCES `tbl_school` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_orderlist`
--
ALTER TABLE `tbl_orderlist`
ADD CONSTRAINT `FK_orderid` FOREIGN KEY (`order_id`) REFERENCES `tbl_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_stationary`
--
ALTER TABLE `tbl_stationary`
ADD CONSTRAINT `FK_copyid` FOREIGN KEY (`school_id`) REFERENCES `tbl_school` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_id` FOREIGN KEY (`school_id`) REFERENCES `tbl_school` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_sid` FOREIGN KEY (`school_id`) REFERENCES `tbl_school` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
