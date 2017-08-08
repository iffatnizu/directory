-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 17, 2013 at 05:12 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cpr_directory`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_additional_service`
--

CREATE TABLE IF NOT EXISTS `tbl_additional_service` (
  `additionalServiceId` int(11) NOT NULL AUTO_INCREMENT,
  `additionalService` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=InActive, 1=Active',
  PRIMARY KEY (`additionalServiceId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_additional_service`
--

INSERT INTO `tbl_additional_service` (`additionalServiceId`, `additionalService`, `status`) VALUES
(1, 'Additional Photographer(s)', '1'),
(2, 'Addl/Upgraded Album(s)', '1'),
(3, 'Additional Prints', '1'),
(4, 'Engagement Session', '1'),
(5, 'Hi-Res DVD/CD', '1'),
(6, 'Mounted Prints', '1'),
(7, 'Musical Photo Montage', '1'),
(8, 'Online Photo Proofs', '1'),
(9, ' Parent Albums', '1'),
(10, 'Rehearsal Coverage', '1'),
(11, 'Other', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `adminId` int(11) NOT NULL AUTO_INCREMENT,
  `adminUsername` varchar(200) NOT NULL,
  `adminPassword` varchar(200) NOT NULL,
  `adminLastLoginTime` varchar(200) NOT NULL,
  `adminIsActive` enum('0','1') NOT NULL,
  `adminPreviledge` enum('1','2','3','4','5') NOT NULL,
  PRIMARY KEY (`adminId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminUsername`, `adminPassword`, `adminLastLoginTime`, `adminIsActive`, `adminPreviledge`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '1375293109', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_age_range`
--

CREATE TABLE IF NOT EXISTS `tbl_age_range` (
  `ageRangeId` int(11) NOT NULL AUTO_INCREMENT,
  `ageRange` varchar(255) NOT NULL,
  `isActive` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=InActive, 1=Active',
  PRIMARY KEY (`ageRangeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_age_range`
--

INSERT INTO `tbl_age_range` (`ageRangeId`, `ageRange`, `isActive`) VALUES
(1, 'Under 10s', '1'),
(2, 'Teens', '1'),
(3, 'Young Adults', '1'),
(4, 'Adults', '1'),
(5, 'Senior', '1'),
(6, 'Elderly', '1'),
(7, 'Mixed', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_amenities_type`
--

CREATE TABLE IF NOT EXISTS `tbl_amenities_type` (
  `amenitiesTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `amenitiesType` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=InActive, 1=Active',
  PRIMARY KEY (`amenitiesTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_amenities_type`
--

INSERT INTO `tbl_amenities_type` (`amenitiesTypeId`, `amenitiesType`, `status`) VALUES
(1, 'Variety of rooms', '1'),
(2, ' Wireless', '1'),
(3, 'Bridal changing room', '1'),
(4, 'Business meeting amenities', '1'),
(5, 'Onsite parking', '1'),
(6, 'Overnight accommodations', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_arrangement_type`
--

CREATE TABLE IF NOT EXISTS `tbl_arrangement_type` (
  `arrangementTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `arrangementType` varchar(255) NOT NULL,
  PRIMARY KEY (`arrangementTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_arrangement_type`
--

INSERT INTO `tbl_arrangement_type` (`arrangementTypeId`, `arrangementType`) VALUES
(1, 'Bouquets'),
(2, 'Boutonnieres'),
(3, 'Boxed Flowers'),
(4, 'Centerpieces'),
(5, 'Corsages'),
(6, 'Floral Arrangements'),
(7, 'Flowering Plants'),
(8, 'Garlands'),
(9, 'Potted Plants'),
(10, 'Table Pieces'),
(11, 'Wreathes'),
(12, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bookmark`
--

CREATE TABLE IF NOT EXISTS `tbl_bookmark` (
  `bookmarkId` bigint(20) NOT NULL AUTO_INCREMENT,
  `bookmarkVendorId` int(11) NOT NULL,
  `bookmarkServiceId` int(11) NOT NULL,
  `bookmarkEventsInfoId` int(11) NOT NULL,
  `bookmarkServiceListId` int(11) NOT NULL,
  `bookmarkDate` bigint(20) NOT NULL,
  PRIMARY KEY (`bookmarkId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_bookmark`
--

INSERT INTO `tbl_bookmark` (`bookmarkId`, `bookmarkVendorId`, `bookmarkServiceId`, `bookmarkEventsInfoId`, `bookmarkServiceListId`, `bookmarkDate`) VALUES
(1, 2, 6, 1, 1, 1372236712),
(2, 2, 5, 1, 1, 1372236714),
(3, 2, 3, 1, 1, 1372236716),
(4, 2, 1, 1, 1, 1372236717),
(5, 2, 5, 5, 2, 1372237103);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_budget_per_person`
--

CREATE TABLE IF NOT EXISTS `tbl_budget_per_person` (
  `budgetPerPersonId` int(11) NOT NULL AUTO_INCREMENT,
  `budgetPerPerson` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=InActive, 1=Active',
  PRIMARY KEY (`budgetPerPersonId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_budget_per_person`
--

INSERT INTO `tbl_budget_per_person` (`budgetPerPersonId`, `budgetPerPerson`, `status`) VALUES
(1, '$15-$25', '1'),
(2, '$26-$35', '1'),
(3, '$36-$50', '1'),
(4, '$51-$75', '1'),
(5, '$76-$100', '1'),
(6, '$101-$145', '1'),
(7, '$146-$180', '1'),
(8, '$181+', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `categoryId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Category Auto Incriment Id',
  `categoryName` varchar(255) NOT NULL COMMENT 'Top Category Name',
  PRIMARY KEY (`categoryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`categoryId`, `categoryName`) VALUES
(1, 'Catering'),
(2, 'Reception Halls'),
(3, 'DJ/Entertainers'),
(4, 'Florists'),
(5, 'Photographers/Video'),
(6, 'Limos');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_catering`
--

CREATE TABLE IF NOT EXISTS `tbl_catering` (
  `cateringId` bigint(20) NOT NULL AUTO_INCREMENT,
  `eventInfoId` bigint(20) NOT NULL,
  `eventStartDate` bigint(20) NOT NULL,
  `approxStartTime` bigint(20) NOT NULL,
  `eventEndDate` bigint(20) NOT NULL,
  `approxEndTime` bigint(20) NOT NULL,
  `datesFlexible` enum('1','2') NOT NULL COMMENT '1=Yes, 2=No',
  `guestsNumber` int(11) NOT NULL,
  `serviceId` int(11) NOT NULL,
  `foodTypeId` int(11) NOT NULL,
  `othersFoodType` varchar(255) NOT NULL,
  `courses` varchar(255) NOT NULL,
  `equipment` varchar(255) NOT NULL,
  `otherEquipment` varchar(255) NOT NULL,
  `additionalServices` varchar(255) NOT NULL,
  `otherAdditionalServices` varchar(255) NOT NULL,
  `setEventLocation` enum('1','2') NOT NULL COMMENT '1=Yes, 2=No',
  `venueTypeId` int(11) NOT NULL,
  `kitchenAvailablity` enum('1','2','3') NOT NULL COMMENT '1=Yes, 2=No, 3= Unsure',
  `budgetPerPersonId` int(11) NOT NULL,
  `additionalComments` text NOT NULL,
  PRIMARY KEY (`cateringId`),
  KEY `eventInfoId` (`eventInfoId`),
  KEY `serviceId` (`serviceId`),
  KEY `foodTypeId` (`foodTypeId`),
  KEY `venueTypeId` (`venueTypeId`),
  KEY `budgetPerPersonId` (`budgetPerPersonId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_catering`
--

INSERT INTO `tbl_catering` (`cateringId`, `eventInfoId`, `eventStartDate`, `approxStartTime`, `eventEndDate`, `approxEndTime`, `datesFlexible`, `guestsNumber`, `serviceId`, `foodTypeId`, `othersFoodType`, `courses`, `equipment`, `otherEquipment`, `additionalServices`, `otherAdditionalServices`, `setEventLocation`, `venueTypeId`, `kitchenAvailablity`, `budgetPerPersonId`, `additionalComments`) VALUES
(1, 1, 1371686400, 0, 1372550400, 0, '', 20, 2, 13, '', '', '1,2,7', '', '1,2,3', '', '1', 4, '1', 4, 'There a kitchen available for food preparation.'),
(2, 5, 1372204800, 1371983400, 1372377600, 1372024800, '1', 25, 5, 5, '', '1,4', '4,5,7', 'Test', '4,5,7,8', 'Test 1', '1', 4, '1', 3, 'Test Additional Comments for Comments.'),
(3, 13, 1374012000, 1374015600, 1374098400, 1374015600, '2', 4, 3, 3, '23', '1,2,3,4', '3,4,5,6,7,8', '12312312', '7,8,10,11', '123123', '1', 2, '1', 2, 'sdfadf'),
(4, 14, 1375221600, 1374638700, 1375221600, 1374620400, '1', 6, 2, 2, '8', '1,2,4', '1,2,5,7,8', '8', '2,3,4,8,9,10', '0', '1', 1, '3', 5, 'this test'),
(5, 20, 1377280800, 1376679600, 1377885600, 1376679600, '1', 20, 3, 2, '0', '3,4', '1,3', '0', '1,3,5', '0', '2', 2, '1', 2, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_city`
--

CREATE TABLE IF NOT EXISTS `tbl_city` (
  `cityId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'City Auto Incriment Id',
  `cityName` varchar(255) NOT NULL COMMENT 'City Name',
  `stateId` int(11) NOT NULL COMMENT 'city of this state',
  PRIMARY KEY (`cityId`),
  KEY `stateId` (`stateId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `tbl_city`
--

INSERT INTO `tbl_city` (`cityId`, `cityName`, `stateId`) VALUES
(1, 'Canberra', 1),
(2, 'Sydney', 2),
(3, 'Albury', 2),
(4, 'Armidale', 2),
(5, 'Bathurst', 2),
(6, 'Coffs Harbour', 2),
(7, 'Dubbo', 2),
(8, 'Gosford', 2),
(9, 'Goulburn', 2),
(10, 'Grafton', 2),
(11, 'Lismore', 2),
(12, 'Maitland', 2),
(13, 'Newcastle', 2),
(14, 'Orange', 2),
(15, 'Tamworth', 2),
(16, 'Wagga Wagga', 2),
(17, 'Wollongong', 2),
(18, 'Darwin', 3),
(19, 'Alice Springs', 3),
(20, 'Brisbane', 4),
(21, 'Bundaberg', 4),
(22, 'Cairns', 4),
(23, 'Gold Coast', 4),
(24, 'Gympie', 4),
(25, 'Ipswich', 4),
(26, 'Maryborough', 4),
(27, 'Mount Isa', 4),
(28, 'Rockhampton', 4),
(29, 'Sunshine Coast', 4),
(30, 'Toowoomba', 4),
(31, 'Townsville', 4),
(32, 'Adelaide', 5),
(33, 'Gladstone', 5),
(34, 'Port Augusta', 5),
(35, 'Port Lincoln', 5),
(36, 'Whyalla', 5),
(37, 'Hobart', 6),
(38, 'Launceston', 6),
(39, 'Melbourne', 7),
(40, 'Benalla', 7),
(41, 'Ballarat', 7),
(42, 'Bendigo', 7),
(43, 'Geelong', 7),
(44, 'Shepparton', 7),
(45, 'Wangaratta', 7),
(46, 'Warrnambool', 7),
(47, 'Wodonga', 7),
(48, 'Perth', 8),
(49, 'Albany', 8),
(50, 'Bunbury', 8),
(51, 'Geraldton', 8),
(52, 'Fremantle', 8),
(53, 'Kalgoorlie', 8),
(54, 'Mandurah', 8),
(55, 'Port Hedland', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_content`
--

CREATE TABLE IF NOT EXISTS `tbl_content` (
  `contentId` int(11) NOT NULL AUTO_INCREMENT,
  `contentName` text NOT NULL,
  `contentTitle` tinytext NOT NULL,
  `contentDetails` longtext NOT NULL,
  PRIMARY KEY (`contentId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_content`
--

INSERT INTO `tbl_content` (`contentId`, `contentName`, `contentTitle`, `contentDetails`) VALUES
(1, 'howitworks', 'This how it works title', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n'),
(2, 'contact', 'This is contact us title', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n'),
(3, 'about', 'This is about us title', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n'),
(4, 'terms', 'Terms and Condition', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n'),
(5, 'privacy', 'Privacy Policy', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n'),
(6, 'affiliate', 'Affiliate and Advertisement', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n'),
(7, 'quote', 'Home Content', '<div class="box">\r\n<h3><i class="icon-anchor"></i> Finding the Best Catering Services for Your Event</h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt="img" src="http://localhost/directory/assets/images/img_1.jpg" /> Things to know when searching for caterers in your city When looking for catering services for your party, wedding caterers for your big day or corporate caterers for your business event, you don&#39;t want to spend all of your valuable planning time researching and evaluating caterers in your area. This task can quickly become an overwhelming one, especially if you live in a larger cities and are looking for New York Caterers or Los Angeles caterers, the options can seem endless. This is where LocalCatering.com can help you. Our site enables you to do quick searches for caterers in your area that meet the needs of your particular event. It is important to secure catering services for your event early on. You want to ensure that the guests at your event will be given the best cuisine possible and will leave your party happy and satisfied. LocalCatering.com helps make this happen by getting you quotes fast from local caterers. When filling out the form, be as specific as possible and include any special requirements you might have. Caterers should be able to propose menu options for your special occasion and make estimates as to how much it will cost. The quotes you receive will typically be on a price-per-guest basis and specified to meet the needs of your individual event. Many caterers will provide you with an array of optional catering extras to choose from. You may realize that some of these are exactly what your particular event needs, but remember these are just extras and you may choose to decline them.</p>\r\n</div>\r\n\r\n<div class="box" style="background: #F6F6F6">\r\n<h3><i class="icon-beaker"></i> It is important that you clarify with your caterer</h3>\r\n&nbsp;\r\n\r\n<p><img alt="img" src="http://localhost/directory/assets/images/img_2.jpg" /> It is important that you clarify with your caterer what is and is not included in their catering package to make sure you are both on the same page and can avoid any road bumps later on. When looking at caterers for your event, there are several things that you can do to make sure you find the best for your event. Here are a few suggestions: BBB Ratings - Check the caterer&#39;s Better Business Bureau rating for additional information on the company. Look at pictures from past events - Pay attention to the presentation of the food and decorations to determine if the caterer&#39;s style will fit with your ideas and preferences. References - Check around for additional reviews and references of the catering service and find reviews from previous clients to find out if they were pleased with the services they received. All caterers who are members of LocalCatering.com are held to a certain standard. We collect reviews on our vendors and suspend accounts of those vendor that do not perform at a high quality and that socre high on customer satisfaction. Many caterers will provide you with an array of optional catering extras to choose from. You may realize that some of these are exactly what your particular event needs, but remember these are just extras and you may choose to decline them.</p>\r\n</div>\r\n\r\n<div class="box">\r\n<h3><i class="icon-question"></i> Questions to ask Catering Services</h3>\r\n&nbsp;\r\n\r\n<p><img alt="img" src="http://localhost/directory/assets/images/img_3.jpg" /> Whether you need catering for a corporate event in Dallas, a lavish wedding on a San Diego beach or your holiday party in Boston, it&#39;s important that you find the perfect catering service that can provide your event with the right cuisine and presentation that fits with the theme of your event. To ensure that you get exactly what you are looking for, there are certain questions that you need to ask as you begin searching out local catering services. What is the catering service&#39;s availability on the day of your event and will they be working any other events on the same day? You want to be sure they will be devoting sufficient time to your event. Does the company specialize in any particular types of foods? Catering services should provide you with sample menus to review. Can the caterer schedule a taste-testing of the specific foods you are interested in before hiring them? This is something that most catering services will do. Does the caterer handle all table settings? Will they be putting out place cards and favors? Find out what non-food items of this nature that they will provide and if it is not a part of their service, then will they make arrangements for rentals or is this something you will be responsible for? Does the catering company have a valid license and proper insurance? A license lets you know that catering services have met health department standards and that they have liability insurance should an accident occur. Where will the food be prepared? Will there be on-site facilities that the catering company can use? If the caterer has to bring in their own equipment, will this cost extra? Does the caterer work with top wedding banquet halls in the area? Can they suggest photographers, event florists and entertainers for your event? Does the catering service provide their own wait staff? How many would they recommend for an event the size of yours? What will the servers wear? Many catering services will provide their own wait staff because they understand the catering service&#39;s way of doing business. Does the catering company provide alcohol? Is the bar something you can handle on your own? If so, is there a corkage fee? These questions are just a starting place to help you start narrowing down your search. Your event may have several special requirements in which you will need to inquire about. Keeping all of the above in mind will help make choosing a caterer easier. If you find a caterer you like, go with your gut feeling, but don&#39;t forget to let your taste buds have a say in the matter too!</p>\r\n</div>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dj_quotes`
--

CREATE TABLE IF NOT EXISTS `tbl_dj_quotes` (
  `djQuotesId` bigint(20) NOT NULL AUTO_INCREMENT,
  `eventId` bigint(20) NOT NULL,
  `musicTypes` varchar(255) NOT NULL,
  `serviceBudgetId` int(11) NOT NULL,
  `djType` enum('0','1') NOT NULL COMMENT '0=Indoor, 1=Outdoor',
  `eventComments` text NOT NULL,
  PRIMARY KEY (`djQuotesId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_dj_quotes`
--

INSERT INTO `tbl_dj_quotes` (`djQuotesId`, `eventId`, `musicTypes`, `serviceBudgetId`, `djType`, `eventComments`) VALUES
(1, 15, '2,6', 2, '0', 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_drinks_type`
--

CREATE TABLE IF NOT EXISTS `tbl_drinks_type` (
  `drinksTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `drinksType` varchar(255) NOT NULL,
  PRIMARY KEY (`drinksTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_drinks_type`
--

INSERT INTO `tbl_drinks_type` (`drinksTypeId`, `drinksType`) VALUES
(1, 'Beer'),
(2, 'Soft Drinks'),
(3, 'Spirits'),
(4, 'Wine'),
(5, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_template`
--

CREATE TABLE IF NOT EXISTS `tbl_email_template` (
  `emailTemplateId` int(11) NOT NULL AUTO_INCREMENT,
  `emailTemplateTitle` text NOT NULL,
  `emailTemplateDetails` mediumtext NOT NULL,
  `emailTemplateFooterTxt` text NOT NULL,
  PRIMARY KEY (`emailTemplateId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_email_template`
--

INSERT INTO `tbl_email_template` (`emailTemplateId`, `emailTemplateTitle`, `emailTemplateDetails`, `emailTemplateFooterTxt`) VALUES
(1, '<div style="width:580px;background:#FCFCFC;padding:15px;text-align:justify;float:left;border:1px solid #AAB8C6;border-radius:5px;color:#333333"><h4 style="float:left;margin-top:0px;color:#3B73AF">Directory Email Template</h4><span style="float:right"><img src="https://corepiler.atlassian.net/s/en_US-hgwqx6-1988229788/6132/42/_/jira-logo-scaled.png" alt="logo"/></span><br clear="all"/>', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', '<p style="float:right;color:#3B73AF">Sincere Directory.com support.<br/> Thank you</p></div></body></html>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_entertainment`
--

CREATE TABLE IF NOT EXISTS `tbl_entertainment` (
  `entertainmentId` bigint(20) NOT NULL AUTO_INCREMENT,
  `eventInfoId` bigint(20) NOT NULL,
  `eventStartDate` bigint(20) NOT NULL,
  `approxStartTime` bigint(20) NOT NULL,
  `eventEndDate` bigint(20) NOT NULL,
  `approxEndTime` bigint(20) NOT NULL,
  `datesFlexible` enum('1','2') NOT NULL COMMENT '1=Yes, 2=No',
  `guestsNumber` int(11) NOT NULL,
  `ageRangeId` int(11) NOT NULL,
  `eventSetting` enum('1','2','3') NOT NULL COMMENT '1=Unsure, 2=Indoors, 3=Outdoor',
  `settingAdditional` varchar(255) NOT NULL,
  `entertainmentType` varchar(255) NOT NULL,
  `otherEntertainment` varchar(255) NOT NULL,
  `entertainmentBudgetId` int(11) NOT NULL,
  `additionalComments` text NOT NULL,
  PRIMARY KEY (`entertainmentId`),
  KEY `eventInfoId` (`eventInfoId`),
  KEY `ageRangeId` (`ageRangeId`),
  KEY `entertainmentBudgetId` (`entertainmentBudgetId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_entertainment`
--

INSERT INTO `tbl_entertainment` (`entertainmentId`, `eventInfoId`, `eventStartDate`, `approxStartTime`, `eventEndDate`, `approxEndTime`, `datesFlexible`, `guestsNumber`, `ageRangeId`, `eventSetting`, `settingAdditional`, `entertainmentType`, `otherEntertainment`, `entertainmentBudgetId`, `additionalComments`) VALUES
(1, 1, 1371772800, 1371467760, 1372291200, 1371510960, '1', 23, 4, '3', '', '1,2,3,4,6', '', 5, 'Entertainment Additional Comments'),
(2, 5, 1372032000, 1371985200, 1372464000, 1372021200, '1', 25, 4, '2', 'New Settings', '7,8,12,16', 'Testing', 5, 'Entertainment Additional Comments'),
(3, 17, 1374969600, 1374928200, 1375056000, 1374948000, '1', 35, 2, '2', 'New Settings Event Setting Additional Information', '1,4,6', '0', 4, 'Event Setting Additional Information  Additional Comments'),
(4, 18, 1375228800, 1375210800, 1375315200, 1375221600, '1', 50, 3, '2', 'New Settings Event Setting Additional Information', '6,9,13,14,20', '0', 5, 'Vendor Additional Comments. '),
(5, 19, 1375228800, 1375178400, 1375315200, 1375203600, '1', 25, 2, '1', 'New Settings Additional Information', '9,10,11', '0', 3, 'Additional Information Comments');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_entertainment_budget`
--

CREATE TABLE IF NOT EXISTS `tbl_entertainment_budget` (
  `budgetId` int(11) NOT NULL AUTO_INCREMENT,
  `budgetRange` varchar(255) NOT NULL,
  PRIMARY KEY (`budgetId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_entertainment_budget`
--

INSERT INTO `tbl_entertainment_budget` (`budgetId`, `budgetRange`) VALUES
(1, 'No Budget Selected'),
(2, '< $200'),
(3, '$201 - $350'),
(4, '$351 - $500'),
(5, '$501 - $1000'),
(6, '$1001 - $1500'),
(7, '$1501 - $2000'),
(8, '$2001 - $3500'),
(9, '$3501 - $5000'),
(10, '> $5001');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_entertainment_type`
--

CREATE TABLE IF NOT EXISTS `tbl_entertainment_type` (
  `entertainmentTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `entertainmentType` varchar(255) NOT NULL,
  `isActive` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=InActive, 1=Active',
  PRIMARY KEY (`entertainmentTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tbl_entertainment_type`
--

INSERT INTO `tbl_entertainment_type` (`entertainmentTypeId`, `entertainmentType`, `isActive`) VALUES
(1, 'Balloon Artist', '1'),
(2, 'Caricaturist', '1'),
(3, 'Children''s Characters (Santa, etc.)', '1'),
(4, 'Clown', '1'),
(5, 'Comedian', '1'),
(6, 'DJs', '1'),
(7, 'Face & Body Painter', '1'),
(8, 'Fortune Teller/ Psychic', '1'),
(9, 'Hypnotist', '1'),
(10, 'Impersonator/ Look A Like', '1'),
(11, 'Juggler', '1'),
(12, 'Karaoke', '1'),
(13, 'Live Band', '1'),
(14, 'Live Musician', '1'),
(15, 'Magician', '1'),
(16, 'Mime', '1'),
(17, 'Mind Reader/ Mentalist', '1'),
(18, 'Professional Dancer(s)', '1'),
(19, 'Puppeteer', '1'),
(20, 'Singer', '1'),
(21, 'Temporary Tattoos', '1'),
(22, 'Ventriloquist', '1'),
(23, 'Other', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_equipment`
--

CREATE TABLE IF NOT EXISTS `tbl_equipment` (
  `equipmentId` int(11) NOT NULL AUTO_INCREMENT,
  `equipmentName` varchar(255) NOT NULL,
  PRIMARY KEY (`equipmentId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_equipment`
--

INSERT INTO `tbl_equipment` (`equipmentId`, `equipmentName`) VALUES
(1, 'None Required'),
(2, 'Chair Covers'),
(3, 'Cutlery'),
(4, 'Decorations'),
(5, 'Glasses'),
(6, 'Plates'),
(7, 'Tables'),
(8, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event`
--

CREATE TABLE IF NOT EXISTS `tbl_event` (
  `eventId` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Event Auto Incriment Id',
  `categoryId` int(11) NOT NULL COMMENT 'Event Category Id',
  `eventDate` bigint(20) NOT NULL COMMENT 'Event Date',
  `cityId` int(11) NOT NULL COMMENT 'Event City',
  `eventTypeId` int(11) NOT NULL COMMENT 'Event Type Id',
  `numberOfGuests` int(11) NOT NULL COMMENT 'Number of Guests',
  `eventLocation` enum('0','1','2') NOT NULL COMMENT '0 =none; 1=I need a location, 2= I already have a location',
  `name` varchar(255) NOT NULL COMMENT 'Event Creator Name',
  `phone` varchar(255) NOT NULL COMMENT 'Event Creator Phone Number',
  `email` varchar(255) NOT NULL COMMENT 'Event Creator Email Address',
  `venueBudgetId` int(11) NOT NULL COMMENT 'Venue Budget Id For Reception Halls',
  `startTime` bigint(20) NOT NULL COMMENT 'DJ Start Time',
  `eventCreatedDate` bigint(20) NOT NULL COMMENT 'Event Created Date',
  `status` enum('0','1') NOT NULL COMMENT '0=Pending, 1=Active',
  PRIMARY KEY (`eventId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_event`
--

INSERT INTO `tbl_event` (`eventId`, `categoryId`, `eventDate`, `cityId`, `eventTypeId`, `numberOfGuests`, `eventLocation`, `name`, `phone`, `email`, `venueBudgetId`, `startTime`, `eventCreatedDate`, `status`) VALUES
(1, 1, 1370822400, 2, 4, 100, '1', 'Jobayer Ahmed', '01818531201', 'jobayer@corepiler.com', 0, 0, 1369855533, '0'),
(2, 2, 1371679200, 3, 3, 230, '0', 'Jobayer Ahmed', '017123456789', 'jobayer@corepiler.com', 5, 0, 1369914061, '0'),
(3, 2, 1371247200, 5, 7, 230, '0', 'Jobayer Ahmed', '017123456789', 'jobayer@corepiler.com', 6, 0, 1369914183, '0'),
(4, 3, 1372543200, 13, 11, 120, '0', 'Jobayer Ahmed', '017123456789', 'jobayer@corepiler.com', 0, 1369922700, 1369915284, '0'),
(5, 2, 1371600000, 4, 6, 100, '0', 'Jobayer Ahmed', '01818531201', 'jobayer704@yahoo.com', 4, 0, 1370111957, '0'),
(6, 4, 1372291200, 6, 7, 100, '0', 'Jobayer Ahmed', '018185312012', 'jobayer@corepiler.com', 0, 0, 1370117135, '0'),
(7, 4, 1372550400, 8, 12, 150, '0', 'Jobayer Ahmed', '01818531201', 'jobayer@corepiler.com', 0, 0, 1370117962, '0'),
(8, 5, 1372550400, 3, 6, 150, '0', 'Jobayer Ahmed', '01818531201', 'jobayer@corepiler.com', 0, 0, 1370118017, '0'),
(9, 6, 1372118400, 19, 15, 500, '0', 'Jobayer Ahmed', '01818531201', 'jobayer@corepiler.com', 0, 0, 1370118157, '0'),
(10, 1, 1372204800, 6, 6, 150, '1', 'Jobayer Ahmed', '01818531201', 'jobayer@corepiler.com', 0, 0, 1370193660, '0'),
(11, 1, 1372204800, 6, 6, 150, '2', 'Jobayer Ahmed', '01818531201', 'jobayer@corepiler.com', 0, 0, 1370194812, '0'),
(12, 1, 1372118400, 10, 13, 100, '2', 'Jobayer Ahmed', '1111111111-111', 'jobayer@corepiler.com', 0, 0, 1370326568, '0'),
(13, 1, 1372291200, 13, 6, 100, '1', 'Jobayer Ahmed', '1111111111', 'jobayer@corepiler.com', 0, 0, 1370349149, '0'),
(14, 2, 1372204800, 5, 7, 50, '0', 'Jobayer Ahmed', '1111111111', 'jobayer@corepiler.com', 3, 0, 1370543081, '0'),
(15, 3, 1372032000, 10, 12, 50, '0', 'Jobayer Ahmed', '1111111111', 'admin@admin.com', 0, 1370484000, 1370548687, '0'),
(16, 2, 1371679200, 2, 1, 4, '0', 'Test', '1232323-23', 'test@corepiler.com', 2, 0, 1371543987, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_info`
--

CREATE TABLE IF NOT EXISTS `tbl_event_info` (
  `eventInfoId` bigint(20) NOT NULL AUTO_INCREMENT,
  `eventTypeId` int(11) NOT NULL,
  `otherEventType` varchar(255) NOT NULL,
  `eventCategory` enum('0','1','2','3','4') NOT NULL COMMENT '0=None, 1=Black Tie, 2=Casual, 3=Formal, 4=Semiformal',
  `eventName` varchar(255) NOT NULL,
  `stateId` int(11) NOT NULL,
  `cityId` int(11) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `addedDate` bigint(20) NOT NULL,
  PRIMARY KEY (`eventInfoId`),
  KEY `eventTypeId` (`eventTypeId`),
  KEY `stateId` (`stateId`),
  KEY `cityId` (`cityId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `tbl_event_info`
--

INSERT INTO `tbl_event_info` (`eventInfoId`, `eventTypeId`, `otherEventType`, `eventCategory`, `eventName`, `stateId`, `cityId`, `userId`, `addedDate`) VALUES
(1, 3, '', '2', 'New Test Event', 2, 3, 2, 1371114957),
(2, 2, '', '2', 'Test Events', 2, 16, 3, 1371544064),
(3, 8, '', '1', 'My Events', 4, 21, 1, 1371544133),
(4, 4, '', '2', 'Birthday of My Little Baby', 4, 20, 2, 1372006093),
(5, 5, '', '3', 'Birthday of My Little Baby 2', 5, 35, 1, 1372006378),
(6, 7, '', '2', 'New User Event', 3, 18, 1, 1372185679),
(7, 5, '', '', 'Birthday of My Little Baby 2', 4, 24, 0, 1373390166),
(8, 10, '', '', 'New User Event', 2, 5, 0, 1373392876),
(9, 1, '', '', '7112013', 1, 1, 0, 1373520198),
(10, 9, 'Test', '2', 'New User Event', 4, 25, 0, 1373827862),
(11, 9, '', '3', 'New User Event', 4, 23, 0, 1373830713),
(12, 9, '', '3', 'New User Event', 4, 23, 0, 1373830713),
(13, 5, 'sdfsf', '3', 'this is test', 2, 18, 0, 1374038907),
(14, 4, '1245', '2', 'advertise', 4, 20, 0, 1374645708),
(15, 3, 'res', '2', 'advertise', 2, 17, 0, 1374647352),
(16, 4, '', '2', 'After Weading Serimony', 2, 2, 0, 1374945610),
(17, 5, '', '3', 'Weading Serimony', 4, 20, 12, 1374952264),
(18, 1, '', '2', '1st Weading Anniversary Party', 2, 2, 0, 1375210286),
(19, 2, '', '3', 'Baby 1st  Shower', 2, 2, 0, 1375210713),
(20, 2, '', '2', 'j', 2, 17, 0, 1376725179);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_message`
--

CREATE TABLE IF NOT EXISTS `tbl_event_message` (
  `messageId` int(11) NOT NULL AUTO_INCREMENT,
  `eventInfoId` int(11) NOT NULL,
  `messageSenderId` int(11) NOT NULL,
  `messageSenderType` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1=vendor, 2=normal user',
  `messageReceiverId` int(11) NOT NULL,
  `messageTitle` varchar(200) NOT NULL,
  `messageDescription` mediumtext NOT NULL,
  `messageSendingDate` varchar(200) NOT NULL,
  `messageIsRead` enum('0','1') NOT NULL,
  PRIMARY KEY (`messageId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tbl_event_message`
--

INSERT INTO `tbl_event_message` (`messageId`, `eventInfoId`, `messageSenderId`, `messageSenderType`, `messageReceiverId`, `messageTitle`, `messageDescription`, `messageSendingDate`, `messageIsRead`) VALUES
(1, 1, 2, '1', 2, 'event message 31', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and\n typesetting industry. Lorem Ipsum has been the industry''s standard \ndummy text ever since the 1500s, when an unknown printer took a galley \nof type and scrambled it to make a type specimen book. <br></p><p><br></p><p>It has survived \nnot only five centuries, but also the leap into electronic typesetting, \nremaining essentially unchanged. It was popularised in the 1960s with \nthe release of <b><b>Letraset sheets containing Lorem Ipsum passages, and more\n recently with desktop</b> </b>publishing software like Aldus PageMaker \nincluding versions of Lorem Ipsum.</p>', '1372672038', '1'),
(2, 1, 2, '2', 2, 'messageTitle', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '1372583394', '1'),
(3, 6, 2, '1', 1, 'Poem status', '<h5>"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain..."</h5>', '1372672484', '1'),
(4, 6, 1, '2', 2, 'messageTitle', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', '1372583394', '1'),
(5, 6, 2, '1', 1, 'reply of ', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It \nhas roots in a piece of classical Latin literature from 45 BC, making it\n over 2000', '1372675246', '1'),
(6, 6, 2, '1', 1, 'reply of ', 'accompanied by English versions from the 1914 translation by H. Rackham.', '1372675487', '1'),
(7, 1, 2, '1', 2, 'reply', 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like', '1372675533', '1'),
(8, 1, 2, '1', 2, 'reply', 'their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy', '1372675581', '1'),
(9, 1, 2, '1', 2, 'reply', 'test send<br>', '1372675662', '1'),
(10, 1, 2, '1', 2, 'reply', '<b><b>Letraset sheets containing Lorem Ipsum passages, and more\n recently with desktop</b></b>', '1372675700', '1'),
(11, 6, 2, '1', 1, 'reply', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced', '1372675738', '1'),
(12, 6, 2, '1', 1, 'reply', 'hi this is new&nbsp;', '1372750028', '1'),
(13, 6, 1, '2', 2, 'reply', 'hellow this is jobayer<br>', '1372751613', '1'),
(14, 6, 2, '1', 1, 'reply', 'ok nice', '1372751643', '1'),
(15, 6, 1, '2', 2, 'reply', 'lol bolco kinu <br>', '1372751660', '1'),
(16, 6, 1, '2', 2, 'reply', 'im user<br>', '1372751703', '1'),
(17, 6, 2, '1', 1, 'reply', 'ok i need your service', '1372751733', '1'),
(18, 1, 2, '1', 2, 'reply', 'hellow', '1372751739', '1'),
(19, 6, 1, '2', 2, 'reply', 'hi this is interval test<br>', '1372752106', '1'),
(20, 6, 2, '1', 1, 'reply', 'what is interval test', '1372752140', '1'),
(21, 6, 1, '2', 2, 'reply', 'oh i see you lolz coder <br>', '1372752164', '1'),
(22, 6, 1, '2', 2, 'reply', 'hello world notification<br>', '1372753434', '1'),
(23, 6, 1, '2', 2, 'reply', 'hi', '1373956184', '1'),
(24, 6, 2, '1', 1, 'reply', 'hi', '1373960972', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_message_report_violation`
--

CREATE TABLE IF NOT EXISTS `tbl_event_message_report_violation` (
  `reportViolationId` int(11) NOT NULL AUTO_INCREMENT,
  `reportViolationEventInfoId` int(11) NOT NULL,
  `reportViolationReporterId` int(11) NOT NULL,
  `reportViolatedById` int(11) NOT NULL,
  `reportViolationReporterType` enum('1','2') NOT NULL COMMENT '1 = normal user, 2 = vendor',
  `reportViolationReportingTime` varchar(200) NOT NULL,
  PRIMARY KEY (`reportViolationId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_event_message_report_violation`
--

INSERT INTO `tbl_event_message_report_violation` (`reportViolationId`, `reportViolationEventInfoId`, `reportViolationReporterId`, `reportViolatedById`, `reportViolationReporterType`, `reportViolationReportingTime`) VALUES
(1, 6, 1, 2, '1', '1373958701'),
(4, 1, 2, 2, '2', '1373960438'),
(5, 6, 2, 1, '2', '1373961757');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_type`
--

CREATE TABLE IF NOT EXISTS `tbl_event_type` (
  `eventId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Event Auto Incriment Id',
  `eventName` varchar(255) NOT NULL COMMENT 'Catering Event Name',
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=InActive, 1=Active',
  PRIMARY KEY (`eventId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_event_type`
--

INSERT INTO `tbl_event_type` (`eventId`, `eventName`, `status`) VALUES
(1, 'Anniversary Party', '1'),
(2, 'Baby Shower', '1'),
(3, 'Barbecue / Picnic', '1'),
(4, 'Birthday Party', '1'),
(5, 'Bridal Shower', '1'),
(6, 'Craft Services', '1'),
(7, 'Corporate Event', '1'),
(8, 'Dinner Party', '1'),
(9, 'Family Reunion', '1'),
(10, 'Fundraiser / Benefit Function', '1'),
(11, 'Graduation Party', '1'),
(12, 'Holiday Party', '1'),
(13, 'Luncheon Office Party', '1'),
(14, 'Religious Event', '1'),
(15, 'School Event', '1'),
(16, 'Wedding', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faq`
--

CREATE TABLE IF NOT EXISTS `tbl_faq` (
  `faqId` int(11) NOT NULL AUTO_INCREMENT,
  `faqQuestion` text NOT NULL,
  `faqAnswer` text NOT NULL,
  `addedTime` bigint(20) NOT NULL,
  PRIMARY KEY (`faqId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_faq`
--

INSERT INTO `tbl_faq` (`faqId`, `faqQuestion`, `faqAnswer`, `addedTime`) VALUES
(1, 'Lorem ipsum dolor sit amet', '\r\n\r\nInteger felis tortor, lacinia sit amet gravida id, adipiscing mattis ligula. Donec pharetra mollis nibh, sed tincidunt est tempor eu. Quisque dapibus neque vitae libero tempus volutpat. Suspendisse ut sapien lorem. Donec arcu diam, commodo semper venenatis sit amet, imperdiet quis nulla. Mauris scelerisque dignissim lectus vel rhoncus. Nullam vitae augue vitae ligula fermentum sodales. In ac erat eget turpis rhoncus feugiat. Quisque sed mauris in turpis semper porta. Nam vestibulum convallis molestie. Praesent at est in mi faucibus mollis. Nullam volutpat pulvinar quam, eget faucibus ante vehicula nec.\r\n', 1370858673),
(5, 'Quisque id scelerisque ante. Ut ac metus orci.', '\r\n\r\nAliquam sit amet arcu id nunc pretium facilisis. Praesent ut orci vitae arcu dignissim iaculis eget vitae dolor. Sed magna nisl, pharetra id malesuada in, sagittis in lectus. Duis at vulputate nulla. Vestibulum consequat dictum purus, at tempor augue iaculis non. Suspendisse tempus gravida blandit. Sed placerat pharetra nulla et ultrices. Suspendisse dignissim bibendum venenatis. Aenean in nisi lacus. Etiam libero mauris, rhoncus non auctor eu, sagittis et enim. Fusce adipiscing tempor varius. Proin dictum dignissim luctus. Cras dapibus rutrum lobortis. Curabitur augue libero, tempor in aliquet nec, dapibus quis odio. Fusce condimentum, urna et bibendum ullamcorper, eros mi vestibulum tellus, at accumsan risus dui sed lectus. Nullam vel orci sit amet est ultrices pharetra. In a diam luctus elit tincidunt lobortis quis non massa.\r\n', 1370859074),
(6, 'In hac habitasse platea dictumst.', '\r\n\r\nAliquam sit amet arcu id nunc pretium facilisis. Praesent ut orci vitae arcu dignissim iaculis eget vitae dolor. Sed magna nisl, pharetra id malesuada in, sagittis in lectus. Duis at vulputate nulla. Vestibulum consequat dictum purus, at tempor augue iaculis non. Suspendisse tempus gravida blandit. Sed placerat pharetra nulla et ultrices. Suspendisse dignissim bibendum venenatis. Aenean in nisi lacus. Etiam libero mauris, rhoncus non auctor eu, sagittis et enim. Fusce adipiscing tempor varius. Proin dictum dignissim luctus. Cras dapibus rutrum lobortis. Curabitur augue libero, tempor in aliquet nec, dapibus quis odio. Fusce condimentum, urna et bibendum ullamcorper, eros mi vestibulum tellus, at accumsan risus dui sed lectus. Nullam vel orci sit amet est ultrices pharetra. In a diam luctus elit tincidunt lobortis quis non massa.\r\n', 1370859140);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_favorite`
--

CREATE TABLE IF NOT EXISTS `tbl_favorite` (
  `favoriteId` bigint(20) NOT NULL AUTO_INCREMENT,
  `vendorId` bigint(20) NOT NULL COMMENT 'Favorite Bendor Id',
  `userId` bigint(20) NOT NULL COMMENT 'Favorite By User',
  `favoriteDate` bigint(20) NOT NULL COMMENT 'Favorite added Date',
  PRIMARY KEY (`favoriteId`),
  KEY `vendorId` (`vendorId`,`userId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_favorite`
--

INSERT INTO `tbl_favorite` (`favoriteId`, `vendorId`, `userId`, `favoriteDate`) VALUES
(2, 3, 1, 1372531675);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_florists`
--

CREATE TABLE IF NOT EXISTS `tbl_florists` (
  `floristsId` bigint(20) NOT NULL AUTO_INCREMENT,
  `eventInfoId` bigint(20) NOT NULL,
  `eventStartDate` bigint(20) NOT NULL,
  `approxStartTime` bigint(20) NOT NULL,
  `eventEndDate` bigint(20) NOT NULL,
  `approxEndTime` bigint(20) NOT NULL,
  `datesFlexible` enum('1','2') NOT NULL COMMENT '1=Yes, 2=No',
  `guestsNumber` int(11) NOT NULL,
  `floristsService` enum('1','2','3') NOT NULL COMMENT '1=Delivery, 2=Delivery & setup, 3=Pick-Up',
  `flowerType` varchar(255) NOT NULL,
  `arrangementType` varchar(255) NOT NULL,
  `flowersDetails` text NOT NULL,
  `floristBudgetId` int(11) NOT NULL,
  `additionalComment` text NOT NULL,
  PRIMARY KEY (`floristsId`),
  KEY `eventInfoId` (`eventInfoId`),
  KEY `floristBudgetId` (`floristBudgetId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_florists`
--

INSERT INTO `tbl_florists` (`floristsId`, `eventInfoId`, `eventStartDate`, `approxStartTime`, `eventEndDate`, `approxEndTime`, `datesFlexible`, `guestsNumber`, `floristsService`, `flowerType`, `arrangementType`, `flowersDetails`, `floristBudgetId`, `additionalComment`) VALUES
(1, 1, 1371772800, 1371430800, 1371772800, 1371488760, '1', 25, '2', '2,2,3,4,4', '9,7,5,4,3', 'Tessy 1|Tessy 2|Tessy 3|Tessy 4|Tessy 5', 4, 'Tessy Comments'),
(2, 5, 1372032000, 1371981600, 1372377600, 1372006800, '1', 50, '2', '1,2,1', '1,4,1', 'test 1|test 2|test 3', 6, 'Test additional comments'),
(3, 10, 1373846400, 1373824800, 1375228800, 1373803200, '1', 50, '2', '2', '5', 'test 1', 4, 'Additional Comments'),
(4, 16, 1374883200, 1374919200, 1375228800, 1374955200, '1', 50, '1', '1', '2', 'Flowers Needed', 4, 'Florists Additional Comments.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_flowers_type`
--

CREATE TABLE IF NOT EXISTS `tbl_flowers_type` (
  `flowersTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `flowersType` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=InActive, 1=Active',
  PRIMARY KEY (`flowersTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_flowers_type`
--

INSERT INTO `tbl_flowers_type` (`flowersTypeId`, `flowersType`, `status`) VALUES
(1, 'Table pieces', '1'),
(2, 'Bouquets', '1'),
(3, 'Centerpieces', '1'),
(4, 'Floral arrangments', '1'),
(5, 'Garlands', '1'),
(6, 'Boutonnieres', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food_preference`
--

CREATE TABLE IF NOT EXISTS `tbl_food_preference` (
  `foodPreferenceId` bigint(20) NOT NULL AUTO_INCREMENT,
  `eventId` bigint(20) NOT NULL,
  `serviceId` int(11) NOT NULL,
  `budgetPerPersonId` int(11) NOT NULL,
  `foodType` varchar(255) NOT NULL,
  `venueName` varchar(500) NOT NULL,
  `kitchen` enum('0','1') NOT NULL COMMENT '0=No, 1=Yes',
  `aboutEvent` text NOT NULL,
  PRIMARY KEY (`foodPreferenceId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_food_preference`
--

INSERT INTO `tbl_food_preference` (`foodPreferenceId`, `eventId`, `serviceId`, `budgetPerPersonId`, `foodType`, `venueName`, `kitchen`, `aboutEvent`) VALUES
(1, 12, 2, 2, '2,7', 'New Rejion', '1', 'Test items you would like to see on menu.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food_type`
--

CREATE TABLE IF NOT EXISTS `tbl_food_type` (
  `foodTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `foodType` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=InActive, 1=Active',
  PRIMARY KEY (`foodTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `tbl_food_type`
--

INSERT INTO `tbl_food_type` (`foodTypeId`, `foodType`, `status`) VALUES
(1, 'American', '1'),
(2, 'Asian(Other)', '1'),
(3, 'Barbecue', '1'),
(4, 'Cajun', '1'),
(5, 'Caribbean', '1'),
(6, 'Chinese', '1'),
(7, 'French', '1'),
(8, 'Greek', '1'),
(9, 'Hawaiian', '1'),
(10, 'Indian', '1'),
(11, 'Italian', '1'),
(12, 'Japanese', '1'),
(13, 'Korean', '1'),
(14, 'Kosher', '1'),
(15, 'Mediterranean', '1'),
(16, 'Mexican', '1'),
(17, 'Middle Eastern', '1'),
(18, 'Sandwiches/Subs', '1'),
(19, 'Southwestern', '1'),
(20, 'Spanish', '1'),
(21, 'Sushi', '1'),
(22, 'Thai', '1'),
(23, 'Vegetarian', '1'),
(24, 'Vietnamese', '1'),
(25, 'Pig Roast', '1'),
(26, 'Seafood', '1'),
(27, 'Southern Food', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_halls_quotes`
--

CREATE TABLE IF NOT EXISTS `tbl_halls_quotes` (
  `hallsQuotesId` bigint(20) NOT NULL AUTO_INCREMENT,
  `eventId` bigint(20) NOT NULL,
  `hallType` enum('0','1') NOT NULL COMMENT '0=Informal, 1= Formal',
  `startTime` bigint(20) NOT NULL,
  `endTime` bigint(20) NOT NULL,
  `needCatering` enum('0','1','2') NOT NULL COMMENT '0=No Need, 1=Yes Want, 2=Alrady have',
  `venueChoice` varchar(255) NOT NULL,
  `amenitiesTypes` varchar(255) NOT NULL,
  `eventComments` text NOT NULL,
  PRIMARY KEY (`hallsQuotesId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_halls_quotes`
--

INSERT INTO `tbl_halls_quotes` (`hallsQuotesId`, `eventId`, `hallType`, `startTime`, `endTime`, `needCatering`, `venueChoice`, `amenitiesTypes`, `eventComments`) VALUES
(1, 14, '1', 1370505600, 1370538000, '1', '2,3', '1,2,4', 'Test Hall Quotation For a event.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_liquor`
--

CREATE TABLE IF NOT EXISTS `tbl_liquor` (
  `liquorId` bigint(20) NOT NULL AUTO_INCREMENT,
  `eventInfoId` bigint(20) NOT NULL,
  `eventStartDate` bigint(20) NOT NULL,
  `approxStartTime` bigint(20) NOT NULL,
  `eventEndDate` bigint(20) NOT NULL,
  `approxEndTime` bigint(20) NOT NULL,
  `datesFlexible` enum('1','2') NOT NULL COMMENT '1=Yes, 2=No',
  `guestsNumber` int(11) NOT NULL,
  `serviceId` int(11) NOT NULL,
  `drinkTypes` varchar(255) NOT NULL,
  `rentGlasses` enum('1','2') NOT NULL COMMENT '1=Yes, 2=No',
  `glassesQuantity` int(11) NOT NULL,
  `additionalComments` text NOT NULL,
  PRIMARY KEY (`liquorId`),
  KEY `eventInfoId` (`eventInfoId`),
  KEY `serviceId` (`serviceId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_liquor`
--

INSERT INTO `tbl_liquor` (`liquorId`, `eventInfoId`, `eventStartDate`, `approxStartTime`, `eventEndDate`, `approxEndTime`, `datesFlexible`, `guestsNumber`, `serviceId`, `drinkTypes`, `rentGlasses`, `glassesQuantity`, `additionalComments`) VALUES
(1, 1, 1371600000, 1371499440, 1372550400, 1371496200, '1', 25, 2, '1,4', '1', 0, 'Additional Comments for Limos'),
(2, 5, 1372032000, 1371974400, 1372291200, 1372017600, '1', 30, 4, '1,2,4', '1', 0, 'Test Additional Comments'),
(3, 8, 1373414400, 1373331600, 1374624000, 1373331600, '1', 23, 2, '1,4', '1', 234, ''),
(4, 11, 1374624000, 1373796000, 1375228800, 1373832000, '1', 30, 2, '1,5', '1', 234, 'Liquor Additional Comments'),
(5, 12, 1374624000, 1373796000, 1375228800, 1373832000, '1', 30, 2, '1,5', '1', 234, 'Liquor Additional Comments');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_music_type`
--

CREATE TABLE IF NOT EXISTS `tbl_music_type` (
  `musicTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `musicType` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=InActive, 1=Active',
  PRIMARY KEY (`musicTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `tbl_music_type`
--

INSERT INTO `tbl_music_type` (`musicTypeId`, `musicType`, `status`) VALUES
(1, 'Alternative', '1'),
(2, 'Ballroom', '1'),
(3, 'Big Band', '1'),
(4, 'Blues', '1'),
(5, 'Jazz', '1'),
(6, 'Klezmer', '1'),
(7, 'Latin', '1'),
(8, 'Motown', '1'),
(9, 'Swing', '1'),
(10, 'Broadway', '1'),
(11, 'Classical', '1'),
(12, 'Country', '1'),
(13, 'Disco', '1'),
(14, 'Oldies', '1'),
(15, 'Opera', '1'),
(16, 'Popular/Top 40', '1'),
(17, 'R&B', '1'),
(18, 'Zydeco', '1'),
(19, 'Ethnic', '1'),
(20, 'Folk', '1'),
(21, 'Hip Hop/Rap', '1'),
(22, 'Irish', '1'),
(23, 'Reggae', '1'),
(24, 'Religious', '1'),
(25, 'Rock', '1'),
(26, 'Scottish', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_photography`
--

CREATE TABLE IF NOT EXISTS `tbl_photography` (
  `photographyId` bigint(20) NOT NULL AUTO_INCREMENT,
  `eventInfoId` bigint(20) NOT NULL,
  `eventStartDate` bigint(20) NOT NULL,
  `approxStartTime` bigint(20) NOT NULL,
  `eventEndDate` bigint(20) NOT NULL,
  `approxEndTime` bigint(20) NOT NULL,
  `datesFlexible` enum('1','2') NOT NULL COMMENT '1=Yes, 2=No',
  `guestsNumber` int(11) NOT NULL,
  `photographyStyleId` int(11) NOT NULL,
  `settingType` enum('1','2','3') NOT NULL COMMENT '1=Indoors, 2=Outdoors, 3=Both',
  `settingLocation` text NOT NULL,
  `requirements` text NOT NULL,
  `photographyBudgetId` int(11) NOT NULL,
  `additionalComment` text NOT NULL,
  PRIMARY KEY (`photographyId`),
  KEY `eventInfoId` (`eventInfoId`),
  KEY `photographyStyleId` (`photographyStyleId`),
  KEY `photographyBudgetId` (`photographyBudgetId`),
  KEY `photographyBudgetId_2` (`photographyBudgetId`),
  KEY `photographyBudgetId_3` (`photographyBudgetId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_photography`
--

INSERT INTO `tbl_photography` (`photographyId`, `eventInfoId`, `eventStartDate`, `approxStartTime`, `eventEndDate`, `approxEndTime`, `datesFlexible`, `guestsNumber`, `photographyStyleId`, `settingType`, `settingLocation`, `requirements`, `photographyBudgetId`, `additionalComment`) VALUES
(1, 1, 1372118400, 1371499200, 1372550400, 1371510000, '1', 34, 2, '2', 'Test Setting Location', 'Test Post-Production Requirements', 3, 'Test Setting Location'),
(2, 5, 1372291200, 1371978000, 1372377600, 1372017600, '1', 150, 2, '2', 'Photography Settings Location', 'Photography Post Product Requirements', 2, 'Photography Additional Comments'),
(3, 6, 1372377600, 1372194000, 1372550400, 1372201200, '1', 50, 2, '2', 'New Setting Location', 'New Post-Production Requirements', 2, 'New Additional Comments'),
(5, 10, 1374019200, 1373808600, 1375228800, 1373839200, '1', 150, 2, '3', 'Setting Location', 'Post-Production Requirements', 3, 'Additional Comments'),
(6, 12, 1373846400, 1373832000, 1374624000, 1373828400, '2', 50, 3, '2', 'Setting location', 'Post-Production Requirements', 4, 'Additional Comments');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_photography_style`
--

CREATE TABLE IF NOT EXISTS `tbl_photography_style` (
  `styleId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'photography style auto incriment id',
  `style` varchar(255) NOT NULL COMMENT 'photography style',
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=InActive, 1=Active',
  PRIMARY KEY (`styleId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_photography_style`
--

INSERT INTO `tbl_photography_style` (`styleId`, `style`, `status`) VALUES
(1, 'Candid', '1'),
(2, 'Photojournalistic', '1'),
(3, 'Posed', '1'),
(4, 'Traditional', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reception_halls`
--

CREATE TABLE IF NOT EXISTS `tbl_reception_halls` (
  `receptionId` bigint(20) NOT NULL AUTO_INCREMENT,
  `eventInfoId` bigint(20) NOT NULL,
  `eventStartDate` bigint(20) NOT NULL,
  `approxStartTime` bigint(20) NOT NULL,
  `eventEndDate` bigint(20) NOT NULL,
  `approxEndTime` bigint(20) NOT NULL,
  `datesFlexible` enum('1','2') NOT NULL COMMENT '1=Yes, 2=No',
  `guestsNumber` int(11) NOT NULL,
  `serviceId` int(11) NOT NULL,
  `amenitiesType` varchar(255) NOT NULL,
  `additionalComments` text NOT NULL,
  PRIMARY KEY (`receptionId`),
  KEY `eventInfoId` (`eventInfoId`),
  KEY `serviceId` (`serviceId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_reception_halls`
--

INSERT INTO `tbl_reception_halls` (`receptionId`, `eventInfoId`, `eventStartDate`, `approxStartTime`, `eventEndDate`, `approxEndTime`, `datesFlexible`, `guestsNumber`, `serviceId`, `amenitiesType`, `additionalComments`) VALUES
(1, 1, 1371686400, 1371484800, 1372291200, 1371499200, '1', 23, 3, '1,2,3', 'Reception Halls Additional Comments'),
(2, 5, 1372204800, 1371967200, 1372464000, 1372021200, '1', 100, 2, '1,3,5', 'Reception Additional Comments'),
(4, 8, 1373500800, 1373331600, 1374796800, 1373331600, '1', 30, 3, '1,3', ''),
(5, 15, 1374703200, 1374620400, 1375221600, 1374620400, '2', 15, 3, '1,3,4,6', 'Service Requested:');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service`
--

CREATE TABLE IF NOT EXISTS `tbl_service` (
  `serviceId` int(11) NOT NULL AUTO_INCREMENT,
  `service` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`serviceId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_service`
--

INSERT INTO `tbl_service` (`serviceId`, `service`, `status`) VALUES
(1, 'Drop off', '1'),
(2, 'Buffet', '1'),
(3, 'Buffet w/ servers', '1'),
(4, 'Stations', '1'),
(5, 'Full Sit Down', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_budget`
--

CREATE TABLE IF NOT EXISTS `tbl_service_budget` (
  `serviceBudgetId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Service Budget Auto Incriment Id',
  `serviceBudget` varchar(255) NOT NULL COMMENT 'Service Budget',
  PRIMARY KEY (`serviceBudgetId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_service_budget`
--

INSERT INTO `tbl_service_budget` (`serviceBudgetId`, `serviceBudget`) VALUES
(1, '$400 - $549'),
(2, '$550 - $699'),
(3, '$700 - $849'),
(4, '$850 - $999'),
(5, '$1,000 - $1,249'),
(6, '$1,250+');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_list`
--

CREATE TABLE IF NOT EXISTS `tbl_service_list` (
  `serviceListId` int(11) NOT NULL AUTO_INCREMENT,
  `serviceListName` varchar(200) NOT NULL,
  PRIMARY KEY (`serviceListId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_service_list`
--

INSERT INTO `tbl_service_list` (`serviceListId`, `serviceListName`) VALUES
(1, 'I am responsible for ordering food for my office'),
(3, 'I am responsible for planning events'),
(4, 'I typically eat out a few times per week during lunch time '),
(5, 'I rarely use catering services');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siteTitle` varchar(250) NOT NULL,
  `siteMetaKeyword` text NOT NULL,
  `siteMetaDescription` text NOT NULL,
  `siteLogo` varchar(200) NOT NULL,
  `siteEmail` varchar(50) NOT NULL,
  `sitePhone` varchar(100) NOT NULL,
  `siteVendorLogo` varchar(200) NOT NULL,
  `hideHomeContent` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=Hidden, 1=Show',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `siteTitle`, `siteMetaKeyword`, `siteMetaDescription`, `siteLogo`, `siteEmail`, `sitePhone`, `siteVendorLogo`, `hideHomeContent`) VALUES
(1, 'Directory', 'directory, services, restaurent', 'Your Local Catering', '51bc1b0c6a2c351359a5948f3dcorepiler_logo.jpg', 'admin@directory.com', '1-555-555-555', '51f3702766aaabveyron.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE IF NOT EXISTS `tbl_state` (
  `stateId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'State Auto Incriment Id',
  `stateName` varchar(255) NOT NULL COMMENT 'State Full Name',
  `countryId` int(11) NOT NULL COMMENT 'State of This Country',
  PRIMARY KEY (`stateId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`stateId`, `stateName`, `countryId`) VALUES
(1, 'Australian Capital Territory', 13),
(2, 'New South Wales', 13),
(3, 'Northern Territory', 13),
(4, 'Queensland', 13),
(5, 'South Australia', 13),
(6, 'Tasmania', 13),
(7, 'Victoria', 13),
(8, 'Western Australia', 13);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscriber`
--

CREATE TABLE IF NOT EXISTS `tbl_subscriber` (
  `subscriberId` int(11) NOT NULL AUTO_INCREMENT,
  `subscriberName` varchar(200) NOT NULL,
  `subscriberEmail` varchar(250) NOT NULL,
  `subscriberZipcode` varchar(200) NOT NULL,
  `subscriberDetails` varchar(250) NOT NULL,
  `subscriberDatetime` bigint(20) NOT NULL,
  PRIMARY KEY (`subscriberId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_subscriber`
--

INSERT INTO `tbl_subscriber` (`subscriberId`, `subscriberName`, `subscriberEmail`, `subscriberZipcode`, `subscriberDetails`, `subscriberDatetime`) VALUES
(2, 'Akram', 'akram@corepiler.com', '1207', '["1","4","5"]', 1371291170),
(3, 'jobaye', 'jobaye@lol.com', '2583', '["1","3","4"]', 1371291319);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transportation_type`
--

CREATE TABLE IF NOT EXISTS `tbl_transportation_type` (
  `transportationTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `transportationType` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=InActive, 1=Active',
  PRIMARY KEY (`transportationTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_transportation_type`
--

INSERT INTO `tbl_transportation_type` (`transportationTypeId`, `transportationType`, `status`) VALUES
(1, 'Escalade', '1'),
(2, 'Limousine', '1'),
(3, 'Luxury Bus', '1'),
(4, 'Luxury Sedan', '1'),
(5, 'Stretch Limousines', '1'),
(6, 'Super Stretch', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `userId` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `stateId` int(11) NOT NULL,
  `cityId` int(11) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `whichBest` varchar(255) NOT NULL,
  `ipAddress` varchar(255) NOT NULL,
  `lastLoginDate` datetime NOT NULL,
  `registrationDate` datetime NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0=Inactive, 1=Active',
  PRIMARY KEY (`userId`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userId`, `name`, `email`, `password`, `stateId`, `cityId`, `zipcode`, `whichBest`, `ipAddress`, `lastLoginDate`, `registrationDate`, `status`) VALUES
(1, 'Jobayer Ahmed', 'jobayer@corepiler.com', '4297f44b13955235245b2497399d7a93', 2, 2, '10000', '1,3,4', '::1', '2013-07-27 10:00:45', '2013-05-25 20:37:03', '1'),
(2, 'Test User', 'test@corepiler.com', '4297f44b13955235245b2497399d7a93', 0, 2, '1200', '1,3', '', '0000-00-00 00:00:00', '2013-05-25 20:42:02', '0'),
(3, 'Jobayer', 'jobayer@yahoo.com', '4297f44b13955235245b2497399d7a93', 0, 0, '', '1,2', '', '0000-00-00 00:00:00', '2013-06-25 18:21:33', '1'),
(4, 'nameee', 'Sign@up.com', '4297f44b13955235245b2497399d7a93', 0, 0, '', '', '', '0000-00-00 00:00:00', '2013-07-07 11:21:01', '0'),
(5, 'name123', 'name123@yahoo.com', '4297f44b13955235245b2497399d7a93', 0, 0, '', '', '', '0000-00-00 00:00:00', '2013-07-08 10:01:30', '1'),
(6, 'Test Store', 'test@yahoo.com', '4297f44b13955235245b2497399d7a93', 0, 0, '', '', '', '0000-00-00 00:00:00', '2013-07-09 09:13:44', '1'),
(7, 'Jobayer Ahmed', 'sumon@corepiler.com', '4297f44b13955235245b2497399d7a93', 0, 0, '', '1,2,3,4', '', '0000-00-00 00:00:00', '2013-07-09 16:14:44', '1'),
(8, 'Test User', 'tests@corepiler.com', '4297f44b13955235245b2497399d7a93', 0, 0, '', '', '127.0.0.1', '2013-07-22 17:18:07', '2013-07-09 16:16:00', '1'),
(9, 'Rejwan Khan', 'reza@yahoo.com', '4297f44b13955235245b2497399d7a93', 0, 0, '', '2,3', '', '0000-00-00 00:00:00', '2013-07-22 17:34:44', '1'),
(10, 'Faisal Ahmed', 'faisal@gmail.com', '4297f44b13955235245b2497399d7a93', 0, 0, '', '2,3,4', '', '0000-00-00 00:00:00', '2013-07-22 17:35:51', '1'),
(11, 'Mir Washi', 'washi@gmail.com', '4297f44b13955235245b2497399d7a93', 0, 0, '', '1', '', '0000-00-00 00:00:00', '2013-07-22 17:37:01', '1'),
(12, 'Wahid Rahman', 'wahid@yahoo.com', '4297f44b13955235245b2497399d7a93', 0, 0, '', '1,3,4', '127.0.0.1', '2013-07-27 19:36:15', '2013-07-27 19:36:15', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor`
--

CREATE TABLE IF NOT EXISTS `tbl_vendor` (
  `vendorId` bigint(20) NOT NULL AUTO_INCREMENT,
  `vendorBusinessName` varchar(150) NOT NULL,
  `vendorProfileImage` varchar(200) NOT NULL,
  `vendorName` varchar(150) NOT NULL,
  `vendorPhone` varchar(200) NOT NULL,
  `vendorEmail` varchar(100) NOT NULL,
  `vendorPassword` varchar(250) NOT NULL,
  `vendorAddress` text NOT NULL,
  `vendorStateId` int(11) NOT NULL,
  `vendorCityId` int(11) NOT NULL,
  `vendorZip` varchar(200) NOT NULL,
  `vendorWebUrl` varchar(250) NOT NULL,
  `vendorServices` varchar(250) NOT NULL,
  `vendorStatus` enum('0','1') NOT NULL DEFAULT '0',
  `vendorRegistrationDate` bigint(20) NOT NULL,
  `vendorLastLogin` bigint(20) NOT NULL,
  `vendorRegistrationToken` varchar(200) NOT NULL,
  PRIMARY KEY (`vendorId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_vendor`
--

INSERT INTO `tbl_vendor` (`vendorId`, `vendorBusinessName`, `vendorProfileImage`, `vendorName`, `vendorPhone`, `vendorEmail`, `vendorPassword`, `vendorAddress`, `vendorStateId`, `vendorCityId`, `vendorZip`, `vendorWebUrl`, `vendorServices`, `vendorStatus`, `vendorRegistrationDate`, `vendorLastLogin`, `vendorRegistrationToken`) VALUES
(1, 'Software', '', 'Carolina Kitchen & BBQ Co.', '1234', 'test@corepiler.com', '4297f44b13955235245b2497399d7a93', '12tt', 2, 2, '1234', 'http://www.test.com', '["1","2","3","4","5"]', '1', 1371113863, 1375197870, ''),
(2, 'Software', '51f367703f43614.png', 'Dining by Design-Personal Chef', '1234', 'akram@corepiler.com', '4297f44b13955235245b2497399d7a93', '12tt', 8, 1, '1234', 'http://www.test.com', '["1","2","4"]', '1', 1371114829, 1376725045, 'd3a312f63ede0fb7b0b4a1a63211be59'),
(3, 'Software', '', 'Gordon''s Backyard BBQ & Catering', '1234', 'akram@corepiler1.com', 'e10adc3949ba59abbe56e057f20f883e', '12tt', 1, 1, '1234', 'http://www.test.com', '["1","2","3","4"]', '1', 1371114918, 0, '7096baf3809dd490958c12e99eb7f7dc'),
(4, 'Software', '', 'Jimmy G''s Catering LLC', '1234', 'test2@corepiler.com', '827ccb0eea8a706c4c34a16891f84e7b', '12tt', 2, 1, '1234', 'http://www.test.com', '["1","2","3","4","5"]', '1', 1371114957, 0, '535679cfd3526cda9a59b2f7508b27ab'),
(5, 'Franch Bangladesh Ltd.', '', 'Wiliam Thomson', '02-78965420', 'franchise@bd.com', '4297f44b13955235245b2497399d7a93', 'Dhaka-1216', 2, 2, '1216', '', '["1","4","6"]', '0', 1374515275, 0, '22e1d4b096c3307b76d3f7764ce28a49'),
(6, 'Territory Mobile & Software Ltb.', '', 'Assad Khan', '01678965520', 'assad@mobile.com', '4297f44b13955235245b2497399d7a93', 'Begum Rokeya Sharani, Mirpur, Sydney', 2, 2, '1216', '', '["1","2","3","4"]', '0', 1374517071, 0, '352719f6d45b332b4484fdb5e5b09b06'),
(7, 'K&Sk Services', '', 'safiq', '123456', 'safiq@corepiler.com', 'cf1b8022f80e7d7b1f77ab74cc9c957f', '12 jatra bari', 1, 1, '1234', '', '["2","5"]', '1', 1374645046, 1374645077, '022e708f960408d0838220c541f8c227');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor_rating`
--

CREATE TABLE IF NOT EXISTS `tbl_vendor_rating` (
  `ratingId` bigint(20) NOT NULL AUTO_INCREMENT,
  `userId` bigint(20) NOT NULL,
  `vendorId` bigint(20) NOT NULL,
  `rating` double NOT NULL,
  `ratedDate` bigint(20) NOT NULL,
  PRIMARY KEY (`ratingId`),
  KEY `userId` (`userId`),
  KEY `vendorId` (`vendorId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_vendor_rating`
--

INSERT INTO `tbl_vendor_rating` (`ratingId`, `userId`, `vendorId`, `rating`, `ratedDate`) VALUES
(1, 1, 3, 4, 1373452860),
(2, 1, 2, 4, 1373519896),
(3, 1, 4, 3, 1373529037);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor_rating_report`
--

CREATE TABLE IF NOT EXISTS `tbl_vendor_rating_report` (
  `reportId` int(11) NOT NULL AUTO_INCREMENT,
  `ratingId` int(11) NOT NULL,
  `vendorId` int(11) NOT NULL,
  `reportReason` mediumtext NOT NULL,
  `time` varchar(250) NOT NULL,
  `reportStatus` enum('0','2') NOT NULL COMMENT '0 = inqueue, 2 = mark as invalid ',
  PRIMARY KEY (`reportId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_vendor_rating_report`
--

INSERT INTO `tbl_vendor_rating_report` (`reportId`, `ratingId`, `vendorId`, `reportReason`, `time`, `reportStatus`) VALUES
(1, 2, 2, 'Why you going to report this rating! write a short note', '1374303094', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendor_review`
--

CREATE TABLE IF NOT EXISTS `tbl_vendor_review` (
  `reviewId` bigint(20) NOT NULL AUTO_INCREMENT,
  `vendorId` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `review` text NOT NULL,
  `reviewDate` bigint(20) NOT NULL,
  `isActive` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=Inactive, 1=Active',
  PRIMARY KEY (`reviewId`),
  KEY `vendorId` (`vendorId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_vendor_review`
--

INSERT INTO `tbl_vendor_review` (`reviewId`, `vendorId`, `userId`, `review`, `reviewDate`, `isActive`) VALUES
(2, 3, 1, ' Gordon''s Backyard BBQ & Catering, Gordon''s Backyard BBQ & Catering Gordon''s Backyard BBQ', 1373452860, '1'),
(3, 2, 1, 'hello test', 1373519896, '1'),
(4, 4, 1, 'hellow', 1373529037, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_venue_budget`
--

CREATE TABLE IF NOT EXISTS `tbl_venue_budget` (
  `venueBudgetId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Venue Budget Auto incriment Id',
  `budgetRange` varchar(255) NOT NULL COMMENT 'Venue Budget Range',
  PRIMARY KEY (`venueBudgetId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_venue_budget`
--

INSERT INTO `tbl_venue_budget` (`venueBudgetId`, `budgetRange`) VALUES
(1, 'Under $2,000'),
(2, '$2,001-$5,000'),
(3, '$5,001-$10,000'),
(4, '$10,001-$15,000'),
(5, '$15,0001-$23,000'),
(6, '$23,001-$50,000'),
(7, '$50,001+');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_venue_type`
--

CREATE TABLE IF NOT EXISTS `tbl_venue_type` (
  `venueTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `venueType` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '0=InActive, 1=Active',
  PRIMARY KEY (`venueTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_venue_type`
--

INSERT INTO `tbl_venue_type` (`venueTypeId`, `venueType`, `status`) VALUES
(1, 'Banquet Hall', '1'),
(2, 'Outdoor Venue', '1'),
(3, ' Hotel', '1'),
(4, ' Restaurant/Bar', '1'),
(5, 'Bed Breakfast', '1'),
(6, ' Yacht', '1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_catering`
--
ALTER TABLE `tbl_catering`
  ADD CONSTRAINT `tbl_catering_ibfk_1` FOREIGN KEY (`eventInfoId`) REFERENCES `tbl_event_info` (`eventInfoId`),
  ADD CONSTRAINT `tbl_catering_ibfk_2` FOREIGN KEY (`serviceId`) REFERENCES `tbl_service` (`serviceId`),
  ADD CONSTRAINT `tbl_catering_ibfk_3` FOREIGN KEY (`foodTypeId`) REFERENCES `tbl_food_type` (`foodTypeId`),
  ADD CONSTRAINT `tbl_catering_ibfk_4` FOREIGN KEY (`venueTypeId`) REFERENCES `tbl_venue_type` (`venueTypeId`),
  ADD CONSTRAINT `tbl_catering_ibfk_5` FOREIGN KEY (`budgetPerPersonId`) REFERENCES `tbl_budget_per_person` (`budgetPerPersonId`);

--
-- Constraints for table `tbl_city`
--
ALTER TABLE `tbl_city`
  ADD CONSTRAINT `tbl_city_ibfk_1` FOREIGN KEY (`stateId`) REFERENCES `tbl_state` (`stateId`);

--
-- Constraints for table `tbl_entertainment`
--
ALTER TABLE `tbl_entertainment`
  ADD CONSTRAINT `tbl_entertainment_ibfk_1` FOREIGN KEY (`eventInfoId`) REFERENCES `tbl_event_info` (`eventInfoId`),
  ADD CONSTRAINT `tbl_entertainment_ibfk_2` FOREIGN KEY (`ageRangeId`) REFERENCES `tbl_age_range` (`ageRangeId`),
  ADD CONSTRAINT `tbl_entertainment_ibfk_3` FOREIGN KEY (`entertainmentBudgetId`) REFERENCES `tbl_entertainment_budget` (`budgetId`);

--
-- Constraints for table `tbl_event_info`
--
ALTER TABLE `tbl_event_info`
  ADD CONSTRAINT `tbl_event_info_ibfk_4` FOREIGN KEY (`eventTypeId`) REFERENCES `tbl_event_type` (`eventId`),
  ADD CONSTRAINT `tbl_event_info_ibfk_5` FOREIGN KEY (`stateId`) REFERENCES `tbl_state` (`stateId`),
  ADD CONSTRAINT `tbl_event_info_ibfk_6` FOREIGN KEY (`cityId`) REFERENCES `tbl_city` (`cityId`);

--
-- Constraints for table `tbl_favorite`
--
ALTER TABLE `tbl_favorite`
  ADD CONSTRAINT `tbl_favorite_ibfk_1` FOREIGN KEY (`vendorId`) REFERENCES `tbl_vendor` (`vendorId`),
  ADD CONSTRAINT `tbl_favorite_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `tbl_user` (`userId`);

--
-- Constraints for table `tbl_florists`
--
ALTER TABLE `tbl_florists`
  ADD CONSTRAINT `tbl_florists_ibfk_1` FOREIGN KEY (`eventInfoId`) REFERENCES `tbl_event_info` (`eventInfoId`),
  ADD CONSTRAINT `tbl_florists_ibfk_2` FOREIGN KEY (`floristBudgetId`) REFERENCES `tbl_entertainment_budget` (`budgetId`);

--
-- Constraints for table `tbl_liquor`
--
ALTER TABLE `tbl_liquor`
  ADD CONSTRAINT `tbl_liquor_ibfk_1` FOREIGN KEY (`eventInfoId`) REFERENCES `tbl_event_info` (`eventInfoId`),
  ADD CONSTRAINT `tbl_liquor_ibfk_2` FOREIGN KEY (`serviceId`) REFERENCES `tbl_service` (`serviceId`);

--
-- Constraints for table `tbl_photography`
--
ALTER TABLE `tbl_photography`
  ADD CONSTRAINT `tbl_photography_ibfk_1` FOREIGN KEY (`eventInfoId`) REFERENCES `tbl_event_info` (`eventInfoId`),
  ADD CONSTRAINT `tbl_photography_ibfk_2` FOREIGN KEY (`photographyStyleId`) REFERENCES `tbl_photography_style` (`styleId`),
  ADD CONSTRAINT `tbl_photography_ibfk_3` FOREIGN KEY (`photographyBudgetId`) REFERENCES `tbl_service_budget` (`serviceBudgetId`);

--
-- Constraints for table `tbl_reception_halls`
--
ALTER TABLE `tbl_reception_halls`
  ADD CONSTRAINT `tbl_reception_halls_ibfk_1` FOREIGN KEY (`eventInfoId`) REFERENCES `tbl_event_info` (`eventInfoId`),
  ADD CONSTRAINT `tbl_reception_halls_ibfk_2` FOREIGN KEY (`serviceId`) REFERENCES `tbl_service` (`serviceId`);

--
-- Constraints for table `tbl_vendor_rating`
--
ALTER TABLE `tbl_vendor_rating`
  ADD CONSTRAINT `tbl_vendor_rating_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `tbl_user` (`userId`),
  ADD CONSTRAINT `tbl_vendor_rating_ibfk_2` FOREIGN KEY (`vendorId`) REFERENCES `tbl_vendor` (`vendorId`);

--
-- Constraints for table `tbl_vendor_review`
--
ALTER TABLE `tbl_vendor_review`
  ADD CONSTRAINT `tbl_vendor_review_ibfk_1` FOREIGN KEY (`vendorId`) REFERENCES `tbl_vendor` (`vendorId`),
  ADD CONSTRAINT `tbl_vendor_review_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `tbl_user` (`userId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
