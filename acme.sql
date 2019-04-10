-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 10, 2019 at 12:37 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acme`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(10) UNSIGNED NOT NULL,
  `categoryName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Category classifications of inventory items';

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`) VALUES
(1, 'Cannon'),
(2, 'Explosive'),
(3, 'Misc'),
(4, 'Rocket'),
(5, 'Trap'),
(6, 'Partner-in-Crime');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comments`) VALUES
(1, 'Kirsten', 'Naughton', 'kirsten.naughton@gmail.com', '$2y$10$sD0i2C4S9f9yNNEyKwhW9eFZ5JxUKl2G9Fic.BqtuTbuDgJRqUu6e', '1', ''),
(3, 'James', 'Dean', 'james.dean@dean.com', '$2y$10$jpaneALWnBNMSLWWlb..DOstajJyB2UGYHY5/OIjpSJG71B2wLDRG', '1', ''),
(5, 'Antonio', 'Stark', 'iam@ironman.net', '$2y$10$2J4qH1eWecby/8g.ooL2A.V2IAs7d3lTKvBkrcy04cMffklOUnpQy', '1', ''),
(6, 'Will', 'Naughton', 'will@naughton.com', '$2y$10$4mXbJWmHSVQP9LayVkPqee5yhRFam5LGMzhdh1XPVxKAQxhEIl0Qa', '1', ''),
(8, 'Admin', 'User', 'admin@cit336.net', '$2y$10$hyVQ33vJ1DvOqpdmQKNjZe2jOit6AMo2i4arWkSHfpMycCg4PdeUy', '3', ''),
(9, 'Jane', 'Doe', 'janedoe@doe.com', '$2y$10$a7VRoColJnulPQrlWQCXauZDSAuRF/36VLs62uIHgXBp2NJjNorPC', '1', ''),
(10, 'Lucky', 'Dog', 'lucky@dogslife.com', '$2y$10$ll1Hkp.j/cnnD56t5u6H/.PF6ylMlgbftIGlqWJJ3hvgjOMwjfsgS', '1', ''),
(11, 'acme', 'site', 'acme@site.com', '$2y$10$xMY61IPhXNatyKe9dpdYIueRZq1wJ2BX9p47BBQcrYeJ0.rPi.PcG', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) NOT NULL,
  `imgPath` varchar(150) NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`) VALUES
(1, 8, 'anvil.png', '/acme/images/products/anvil.png', '2019-04-04 06:57:42'),
(2, 8, 'anvil-tn.png', '/acme/images/products/anvil-tn.png', '2019-04-04 06:57:42'),
(3, 17, 'bomb.png', '/acme/images/products/bomb.png', '2019-04-04 06:58:04'),
(4, 17, 'bomb-tn.png', '/acme/images/products/bomb-tn.png', '2019-04-04 06:58:04'),
(5, 3, 'catapult.png', '/acme/images/products/catapult.png', '2019-04-04 06:58:18'),
(6, 3, 'catapult-tn.png', '/acme/images/products/catapult-tn.png', '2019-04-04 06:58:18'),
(7, 16, 'fence.png', '/acme/images/products/fence.png', '2019-04-04 06:58:40'),
(8, 16, 'fence-tn.png', '/acme/images/products/fence-tn.png', '2019-04-04 06:58:40'),
(9, 14, 'helmet.png', '/acme/images/products/helmet.png', '2019-04-04 06:59:11'),
(10, 14, 'helmet-tn.png', '/acme/images/products/helmet-tn.png', '2019-04-04 06:59:11'),
(11, 6, 'hole.png', '/acme/images/products/hole.png', '2019-04-04 06:59:24'),
(12, 6, 'hole-tn.png', '/acme/images/products/hole-tn.png', '2019-04-04 06:59:24'),
(13, 10, 'mallet.png', '/acme/images/products/mallet.png', '2019-04-04 06:59:36'),
(14, 10, 'mallet-tn.png', '/acme/images/products/mallet-tn.png', '2019-04-04 06:59:36'),
(15, 2, 'mortar.jpg', '/acme/images/products/mortar.jpg', '2019-04-04 06:59:51'),
(16, 2, 'mortar-tn.jpg', '/acme/images/products/mortar-tn.jpg', '2019-04-04 06:59:51'),
(17, 6, 'no-image.png', '/acme/images/products/no-image.png', '2019-04-04 07:00:17'),
(18, 6, 'no-image-tn.png', '/acme/images/products/no-image-tn.png', '2019-04-04 07:00:17'),
(19, 13, 'piano.jpg', '/acme/images/products/piano.jpg', '2019-04-04 07:00:29'),
(20, 13, 'piano-tn.jpg', '/acme/images/products/piano-tn.jpg', '2019-04-04 07:00:29'),
(21, 4, 'roadrunner.jpg', '/acme/images/products/roadrunner.jpg', '2019-04-04 07:00:42'),
(22, 4, 'roadrunner-tn.jpg', '/acme/images/products/roadrunner-tn.jpg', '2019-04-04 07:00:42'),
(23, 1, 'rocket.png', '/acme/images/products/rocket.png', '2019-04-04 07:01:01'),
(24, 1, 'rocket-tn.png', '/acme/images/products/rocket-tn.png', '2019-04-04 07:01:01'),
(25, 15, 'rope.jpg', '/acme/images/products/rope.jpg', '2019-04-04 07:01:16'),
(26, 15, 'rope-tn.jpg', '/acme/images/products/rope-tn.jpg', '2019-04-04 07:01:16'),
(27, 9, 'rubberband.jpg', '/acme/images/products/rubberband.jpg', '2019-04-04 07:01:47'),
(28, 9, 'rubberband-tn.jpg', '/acme/images/products/rubberband-tn.jpg', '2019-04-04 07:01:47'),
(29, 12, 'seed.jpg', '/acme/images/products/seed.jpg', '2019-04-04 07:02:11'),
(30, 12, 'seed-tn.jpg', '/acme/images/products/seed-tn.jpg', '2019-04-04 07:02:11'),
(31, 11, 'tnt.png', '/acme/images/products/tnt.png', '2019-04-04 07:02:25'),
(32, 11, 'tnt-tn.png', '/acme/images/products/tnt-tn.png', '2019-04-04 07:02:25'),
(33, 5, 'trap.jpg', '/acme/images/products/trap.jpg', '2019-04-04 07:02:44'),
(34, 5, 'trap-tn.jpg', '/acme/images/products/trap-tn.jpg', '2019-04-04 07:02:44'),
(35, 1, 'acme-rocket.png', '/acme/images/products/acme-rocket.png', '2019-04-04 07:04:55'),
(36, 1, 'acme-rocket-tn.png', '/acme/images/products/acme-rocket-tn.png', '2019-04-04 07:04:55'),
(37, 5, 'box-trap.jpg', '/acme/images/products/box-trap.jpg', '2019-04-04 07:07:05'),
(38, 5, 'box-trap-tn.jpg', '/acme/images/products/box-trap-tn.jpg', '2019-04-04 07:07:05'),
(39, 5, 'mousetrap.png', '/acme/images/products/mousetrap.png', '2019-04-04 07:08:23'),
(40, 5, 'mousetrap-tn.png', '/acme/images/products/mousetrap-tn.png', '2019-04-04 07:08:23'),
(41, 10, 'oversize-hammer.jpg', '/acme/images/products/oversize-hammer.jpg', '2019-04-04 07:10:56'),
(42, 10, 'oversize-hammer-tn.jpg', '/acme/images/products/oversize-hammer-tn.jpg', '2019-04-04 07:10:56'),
(43, 18, 'evil-companion.png', '/acme/images/products/evil-companion.png', '2019-04-06 01:54:51'),
(44, 18, 'evil-companion-tn.png', '/acme/images/products/evil-companion-tn.png', '2019-04-06 01:54:51'),
(45, 18, 'buff-evil-companion.jpeg', '/acme/images/products/buff-evil-companion.jpeg', '2019-04-06 01:58:53'),
(46, 18, 'buff-evil-companion-tn.jpeg', '/acme/images/products/buff-evil-companion-tn.jpeg', '2019-04-06 01:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invName` varchar(50) NOT NULL DEFAULT '',
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL DEFAULT '',
  `invThumbnail` varchar(50) NOT NULL DEFAULT '',
  `invPrice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `invStock` smallint(6) NOT NULL DEFAULT '0',
  `invSize` smallint(6) NOT NULL DEFAULT '0',
  `invWeight` smallint(6) NOT NULL DEFAULT '0',
  `invLocation` varchar(35) NOT NULL DEFAULT '',
  `categoryId` int(10) UNSIGNED NOT NULL,
  `invVendor` varchar(20) NOT NULL DEFAULT '',
  `invStyle` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Acme Inc. Inventory Table';

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invName`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invSize`, `invWeight`, `invLocation`, `categoryId`, `invVendor`, `invStyle`) VALUES
(1, 'Rocket', 'Rocket for multiple purposes. This can be launched independently to deliver a payload or strapped on to help get you to where you want to be FAST!!! Really Fast!', '/acme/images/products/rocket.png', '/acme/images/products/rocket-tn.png', '1320.00', 5, 60, 90, 'California', 4, 'Goddard', 'metal'),
(2, 'Mortar', 'Our Mortar is very powerful. This cannon can launch a projectile or bomb 3 miles. Made of solid steel and mounted on cement or metal stands [not included].', '/acme/images/products/mortar.jpg', '/acme/images/products/mortar-tn.jpg', '1500.00', 26, 250, 750, 'San Jose', 1, 'Smith & Wesson', 'Metal'),
(3, 'Catapult', 'Our best wooden catapult. Ideal for hurling objects for up to 1000 yards. Payloads of up to 300 lbs.', '/acme/images/products/catapult.png', '/acme/images/products/catapult-tn.png', '2500.00', 4, 1569, 400, 'Cedar Point, IO', 1, 'Wooden Creations', 'Wood'),
(4, 'Female RoadRunner Cutout', 'This carbon fiber backed cutout of a female roadrunner is sure to catch the eye of any male roadrunner.', '/acme/images/products/roadrunner.jpg', '/acme/images/products/roadrunner-tn.jpg', '20.00', 500, 27, 2, 'San Jose', 5, 'Picture Perfect', 'Carbon Fiber'),
(5, 'Giant Mouse Trap', 'Our big mouse trap. This trap is multifunctional. It can be used to catch dogs, mountain lions, road runners or even muskrats. Must be staked for larger varmints [stakes not included] and baited with approptiate bait [sold seperately].\r\n', '/acme/images/products/trap.jpg', '/acme/images/products/trap-tn.jpg', '20.00', 34, 470, 28, 'Cedar Point, IO', 5, 'Rodent Control', 'Wood'),
(6, 'Instant Hole', 'Instant hole - Wonderful for creating the appearance of openings.', '/acme/images/products/hole.png', '/acme/images/products/hole-tn.png', '25.00', 269, 24, 2, 'San Jose', 3, 'Hidden Valley', 'Ether'),
(7, 'Koenigsegg CCX', 'This high performance car is sure to get you where you are going fast. It holds the production car land speed record at an amazing 250mph.', '/acme/images/products/no-image.png', '/acme/images/products/no-image.png', '500000.00', 1, 25000, 3000, 'San Jose', 3, 'Koenigsegg', 'Metal'),
(8, 'Anvil', '50 lb. Anvil - perfect for any task requireing lots of weight. Made of solid, tempered steel.', '/acme/images/products/anvil.png', '/acme/images/products/anvil-tn.png', '150.00', 15, 80, 50, 'San Jose', 5, 'Steel Made', 'Metal'),
(9, 'Monster Rubber Band', 'These are not tiny rubber bands. These are MONSTERS! These bands can stop a train locamotive or be used as a slingshot for cows. Only the best materials are used!', '/acme/images/products/rubberband.jpg', '/acme/images/products/rubberband-tn.jpg', '4.00', 4589, 75, 1, 'Cedar Point, IO', 3, 'Rubbermaid', 'Rubber'),
(10, 'Mallet', 'Ten pound mallet for bonking roadrunners on the head. Can also be used for bunny rabbits.', '/acme/images/products/mallet.png', '/acme/images/products/mallet-tn.png', '25.00', 100, 36, 10, 'Cedar Point, IA', 3, 'Wooden Creations', 'Wood'),
(11, 'TNT', 'The biggest bang for your buck with our nitro-based TNT. Price is per stick.', '/acme/images/products/tnt.png', '/acme/images/products/tnt-tn.png', '10.00', 1000, 25, 2, 'San Jose', 2, 'Nobel Enterprises', 'Plastic'),
(12, 'Roadrunner Custom Bird Seed Mix', 'Our best varmint seed mix - varmints on two or four legs can\'t resist this mix. Contains meat, nuts, cereals and our own special ingredient. Guaranteed to bring them in. Can be used with our monster trap.', '/acme/images/products/seed.jpg', '/acme/images/products/seed-tn.jpg', '8.00', 150, 24, 3, 'San Jose', 5, 'Acme', 'Plastic'),
(13, 'Grand Piano', 'This grand piano is guaranteed to play well and smash anything beneath it if dropped from a height.', '/acme/images/products/piano.jpg', '/acme/images/products/piano-tn.jpg', '3500.00', 36, 500, 1200, 'Cedar Point, IA', 3, 'Wulitzer', 'Wood'),
(14, 'Crash Helmet', 'This carbon fiber and plastic helmet is the ultimate in protection for your head. comes in assorted colors.', '/acme/images/products/helmet.png', '/acme/images/products/helmet-tn.png', '100.00', 25, 48, 9, 'San Jose', 3, 'Suzuki', 'Carbon Fiber'),
(15, 'Nylon Rope', 'This nylon rope is ideal for all uses. Each rope is the highest quality nylon and comes in 100 foot lengths.', '/acme/images/products/rope.jpg', '/acme/images/products/rope-tn.jpg', '15.00', 200, 200, 6, 'San Jose', 3, 'Marina Sales', 'Nylon'),
(16, 'Sticky Fence', 'This fence is covered with Gorilla Glue and is guaranteed to stick to anything that touches it and is sure to hold it tight.', '/acme/images/products/fence.png', '/acme/images/products/fence-tn.png', '75.00', 15, 48, 2, 'San Jose', 3, 'Acme', 'Nylon'),
(17, 'Small Bomb', 'Bomb with a fuse - A little old fashioned, but highly effective. This bomb has the ability to devastate anything within 30 feet.', '/acme/images/products/bomb.png', '/acme/images/products/bomb-tn.png', '275.00', 58, 30, 12, 'San Jose', 2, 'Nobel Enterprises', 'Metal'),
(18, 'Evil Companion', 'Sometimes you need a partner-in-crime. Someone to snigger with as you wait behind the highway billboard for your nemesis to come along. This is the perfect evil companion for you.', '/acme/images/products/buff-evil-companion.jpeg', '/acme/images/products/buff-evil-companion-tn.jpeg', '1000000.00', 1, 55, 205, 'Alaska', 6, 'Villains, Inc', 'Evilness');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(2, 'I loved having an evil companion. He is my bestie now.', '2019-04-06 07:41:37', 18, 8),
(3, 'Nothing like having an additional couple of TNT sticks around. These worked great! I recommend also buying the extra long fuse which is not included.... sadly.', '2019-04-06 07:44:10', 11, 8),
(4, 'This cannon backfired.', '2019-04-06 07:46:54', 2, 8),
(5, 'I got carried away', '2019-04-06 07:47:58', 1, 8),
(6, 'I forgot the bait', '2019-04-06 07:50:16', 5, 8),
(7, 'This bomb was too heavy to throw, and the fuse was very short. You have to run very fast.', '2019-04-08 07:03:44', 17, 9),
(8, 'This catapult put me right over the wall as intended.', '2019-04-08 07:42:25', 3, 9),
(9, 'I found this catapult technology to be a little old school.', '2019-04-08 09:08:12', 3, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`),
  ADD UNIQUE KEY `clientEmail` (`clientEmail`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `FK_inv_image` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_reviews_clients` (`clientId`),
  ADD KEY `FK_reviews_inventory` (`invId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_image` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
