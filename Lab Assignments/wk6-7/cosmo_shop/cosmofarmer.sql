-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 18, 2010 at 12:20 PM
-- Server version: 5.1.37
-- PHP Version: 5.2.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cosmofarmer`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(64) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` VALUES(1, 'Plants');
INSERT INTO `categories` VALUES(2, 'Seeds');
INSERT INTO `categories` VALUES(3, 'Tools');
INSERT INTO `categories` VALUES(4, 'Pest Control');
INSERT INTO `categories` VALUES(5, 'Clothing');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productID` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `productName` varchar(64) CHARACTER SET utf8 NOT NULL,
  `price` double(10,2) NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `inventory` varchar(12) CHARACTER SET utf8 NOT NULL,
  `vendorID` mediumint(9) NOT NULL,
  `categoryID` mediumint(9) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 NOT NULL,
  `onSale` tinyint(4) NOT NULL,
  PRIMARY KEY (`productID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` VALUES(1, 'Bathtub Hydroponic Tomato Starts', 45.95, 'Raising hydroponic tomatos from seed is a difficult and time consuming process. Get a head start with these ready to use tomato starts. Just fill up the bathtub, turn on the gro-light and plop it in.', 'in stock', 5, 1, 'tomato_starts.jpg', 1);
INSERT INTO `products` VALUES(2, 'Gotcha Cucaracha', 2.95, 'Let this urban pest become your friend. The cockroach makes a great natural pesticide protecting your indoor agriculture with its fierce territorial instincts', 'out of stock', 2, 4, 'cockroach.jpg', 0);
INSERT INTO `products` VALUES(3, 'Genetically Modified Ladybugs', 145.95, 'Ladybugs have always been a friend to gardeners who wish to keep their gardens pest free. These genetically modified warriors aren''t your mom''s ladybugs. Equipped with street saavy, a five year life span, and mandibles made of titanium alloy, these bugs WILL spell the end of your pest troubles. Not recommended for pet owners.', 'in stock', 2, 4, 'ladybugs.jpg', 0);
INSERT INTO `products` VALUES(4, 'Porsche Ball Widger', 89.55, 'German engineered of space-age aluminum this cross between a trowel and a dibber is the perfect tool for levering plants from their pots. It''s sophisticated design just shouts "Urban Ag-Chic."', 'in stock', 13, 3, 'widger.jpg', 1);
INSERT INTO `products` VALUES(5, 'Kudzu Saplings', 1.29, 'Looking for that instant "been growing for years" look? Fast growing Kudzu will turn your apartment into a tropical wilderness in a matter of weeks. Highly recommended for homesick southerners.', 'in stock', 7, 1, 'kudzu.jpg', 1);
INSERT INTO `products` VALUES(6, 'CosmoFarmer 2.0 Tee', 25.95, 'Celebrate the urban-ag revolution with this 100% organic, T-shirt. This fashionable Tee designed by a famous NY designer shouts urban hipness. It''s also completely edible with a protein content of 20g.', 'in stock', 7, 5, 'cosmo_tee1.jpg', 0);
INSERT INTO `products` VALUES(7, 'John Dear T-Shirt', 19.95, 'Show your love of heavy machinery. ', 'in stock', 11, 5, 'deer_t.jpg', 0);
INSERT INTO `products` VALUES(8, 'SOHO Bathtub Hydroponic Starter Kit', 249.95, 'The original...and still the best. Urban Farming Collective''s SOHO Bathtub Hydroponic Starter Kit is the most effective and stylish hydroponic system ever devised. Aparment Compost magazine raves: "It looks like an iPod for the bathtub!"', 'out of stock', 1, 3, 'soho_kit.jpg', 1);
INSERT INTO `products` VALUES(9, 'Distressed Denim Rose Bush', 39.95, 'Finally, a rose to match your urban lifestyle. This unique hybrid has the texture and appearance of denim. Process especially for Gap Plants, the distressed look, which includes dirt marks and small tears, makes this rose look like you''ve had it around for years. Even though it''s brand new!', 'in stock', 9, 1, 'none.gif', 0);
INSERT INTO `products` VALUES(10, 'Carpetorium Pratensis Seeds', 4.95, 'The must luxurious of indoor lawns are now available as seeds. There''s nothing as satisfying as growing an indoor lawn from scratch. We recommend the Carpetorium Pratensis carpet patch kit to fill in areas of no-growth or heavy wear.', 'in stock', 3, 2, 'seeds.jpg', 0);
INSERT INTO `products` VALUES(11, 'Carpetorium Pratensis carpet patch kit', 29.95, 'Nothing''s worse than a spotty indoor lawn. Whether it''s from heavy wear, low sunlight or incomplete watering, holes in your Carpetorium Pratensis are simply unattractive. Patch those holes quickly and easily with the Carpetorium Pratensis carpet patch kit.', 'in stock', 3, 1, 'pratensis.jpg', 1);
INSERT INTO `products` VALUES(12, 'CAT Indoor Lawn Tractor', 598.95, 'The ultimate in convenient lawn maintenance. This lawn tractor has a zero turning radius that makes it easy to navigate around sofas, coffee tables, and small pets. The dual hydrostatic transmissions frees you from any gear changes, and the redesigned emission system is much safer than previous models.', 'out of stock', 12, 3, 'none.gif', 0);
INSERT INTO `products` VALUES(13, 'John Dear Deluxe Apartment Mower', 154.88, 'An all around excellent indoor mower at an affordable price. The fine blades turn even large weeds into tiny cuttings, perfect for composting or salad garnish', 'in stock', 11, 3, 'dear_mower.jpg', 1);
INSERT INTO `products` VALUES(14, 'Periwinkle Daisy Seeds', 4.95, 'Periwinkle. It''s the new black...not that black flowers were ever in. But Periwinkle ones will be.', 'in stock', 3, 2, 'seeds.jpg', 0);
INSERT INTO `products` VALUES(15, 'Chardonnay Yellow Daisy Seeds', 4.95, 'Chardonnay. It''s the new periwinkle.', 'in stock', 3, 2, 'seeds.jpg', 0);
INSERT INTO `products` VALUES(16, 'Cabarnet Begonia Seeds', 4.95, 'Cabarnet. It''s new the Chardonnay!', 'in stock', 3, 2, 'seeds.jpg', 0);
INSERT INTO `products` VALUES(20, 'Titanium Dhalia Seeds', 29.95, 'Perfect companion to a Capresso Espresso machine, Bosch dishwasher, or any other stainless steel appliance.', 'in stock', 7, 2, 'seeds,jpg', 0);
INSERT INTO `products` VALUES(18, 'No Sunlight Super Carrot seeds', 4.95, 'For dark industrial basement apartments, these special hybrids require nearly no light, but, amazingly, give you the power to see in the dark. ', 'in stock', 5, 2, 'seeds.jpg', 0);
INSERT INTO `products` VALUES(19, 'Broccolini', 12.95, 'Plant these exquisite starts in a porcelain planter on your favorite coffee table. It''s like edible bonsai!', 'in stock', 9, 1, 'broccoli.jpg', 1);
INSERT INTO `products` VALUES(21, 'Tuscan Sun Rose Seeds', 29.95, 'Bongiorno! Wake up to the beauty of this mediterranean love.', 'in stock', 10, 2, 'seeds.jpg', 1);
INSERT INTO `products` VALUES(22, 'CAT Mini-Combine 5000', 999.99, 'We know you''re a busy professional. Time is precious and you just don''t have the time to labor over your apartment grain crops using traditional methods. The CAT Mini-Combine 5000, simplifies the tasks of harvesting, threshing and cleaning grain. This precision machine, co-designed with Porsche AG, is fast, lean and beautiful. Runs on normal 120 volt current. (European adapter included.)', 'in stock', 12, 3, 'combine.jpg', 1);
INSERT INTO `products` VALUES(23, 'Diamond Handled Trowel', 999.99, 'Even though you like to get your hands dirty, there''s no reason to skimp on the tools of your beloved hobby. The diamond-encrusted handle on this ergonomic trowel tells the world: I apartment farm, I''m proud and I''m rich. ', 'out of stock', 7, 3, 'trowel.jpg', 0);
INSERT INTO `products` VALUES(24, 'Bug Eradicator (Lavender scented)', 19.95, 'A small infestation is enough to ruin your carefully manicured indoor garden. Bug Eradicator kills over 1000 species of invasive pests that threaten the well being of your apartment farm. Keep out of reach of children; people of child-bearing age should avoid this product; may be harmful to the elderly. Lavender scented.', 'in stock', 2, 4, 'none.gif', 0);
INSERT INTO `products` VALUES(25, 'Praying Mantis', 399.95, 'No pest''s prayers will be answered when the praying mantis comes to your apartment. This powerful, ruthless, and loyal companion will rid your indoor crops of all infestations. Recently featured in the National Exasperator!', 'in stock', 14, 4, 'mantis.jpg', 1);
INSERT INTO `products` VALUES(26, 'Super Tomato Seed', 69.50, 'Why waste your time on thousands of little cherry tomatoes, when only a single super tomato can feed a family of 10 for three weeks. Pasta, anyone?', 'in stock', 3, 2, 'seeds,jpg', 0);
INSERT INTO `products` VALUES(27, 'Iceberg Lettuce Starts', 4.95, 'Even the titanic wouldn''t steer clear of this delcious salad ingredient.', 'in stock', 1, 1, 'lettuce.jpg', 0);
INSERT INTO `products` VALUES(28, 'Leather Coveralls', 386.95, 'Inspired by the rugged look and feel of the traditional, denim overall, these soft leather coveralls work hard at making you look fine.', 'in stock', 7, 5, 'none.gif', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `userEmail` varchar(64) CHARACTER SET utf8 NOT NULL,
  `password` varchar(64) CHARACTER SET utf8 NOT NULL,
  `access` varchar(32) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 'dibble@cosmofarmer.com', 'sesame', 'admin');
INSERT INTO `users` VALUES(2, 'john@nationalexasperator.com', 'open', 'guest');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendorID` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `vendorName` varchar(64) CHARACTER SET utf8 NOT NULL,
  `vendorStreet` varchar(64) CHARACTER SET utf8 NOT NULL,
  `vendorCity` varchar(64) CHARACTER SET utf8 NOT NULL,
  `vendorState` varchar(32) CHARACTER SET utf8 NOT NULL,
  `vendorZip` varchar(16) CHARACTER SET utf8 NOT NULL,
  `vendorPhone` varchar(18) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`vendorID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` VALUES(1, 'Urban Farming Collective', '457 Elm St.', 'Portland', 'OR', '97213', '503-555-1234');
INSERT INTO `vendors` VALUES(2, 'Pests Be Gone', '5748 Industrial Drive', 'Detroit', 'MI', '48226', '313-555-4837');
INSERT INTO `vendors` VALUES(3, 'Seeds ''R Us', '85738 5th Ave.', 'New York', 'NY', '10019', '212-555-2851');
INSERT INTO `vendors` VALUES(4, 'High-Rise Tool and Die', '4775', 'San Francisco', 'CA', '95030', '415-555-8882');
INSERT INTO `vendors` VALUES(5, 'Burpee', '300 Park Avenue', 'Warminster', 'PA', '18974', '215-555-9389');
INSERT INTO `vendors` VALUES(6, 'Johnson''s Feed & Seed', '4578 Saskwatch Ridge', 'Humboldt', 'CA', '95501', '707-555-2858');
INSERT INTO `vendors` VALUES(7, 'DKNY Plants', '57444 Bleeker St', 'New York', 'NY', '10048', '212-555-8411');
INSERT INTO `vendors` VALUES(8, 'Pottery Barn', '4474 Park Ave.', 'New York', 'NY', '10019', '555-212-3854');
INSERT INTO `vendors` VALUES(9, 'GAP Plants', '4578 Folsom St.', 'San Francisco', 'CA', '95080', '415-555-2834');
INSERT INTO `vendors` VALUES(10, 'GAP Seeds', '4578 Folsom St.', 'San Francisco', 'CA', '95080', '415-555-2837');
INSERT INTO `vendors` VALUES(11, 'John Dear', '58 Combine Drive', 'Wilmington', 'OH', '88437', '555-555-5555');
INSERT INTO `vendors` VALUES(12, 'Caterpillar', '3899 Post Hole Digger Alley', 'Kansas City', 'MO', '64106', '414-555-5928');
INSERT INTO `vendors` VALUES(13, 'GAP Tools', '4578 Folsom St.', 'San Francisco', 'CA', '95080', '415-555-2835');
INSERT INTO `vendors` VALUES(14, 'GAP Pest Control', '4578 Folsom St.', 'San Francisco', 'CA', '95080', '415-555-2836');
