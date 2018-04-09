-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 09, 2018 at 04:14 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom244`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `email` (`ime` VARCHAR(50), `prezime` VARCHAR(50)) RETURNS VARCHAR(50) CHARSET latin1 begin
return concat(left(lower(pocisti(ime)),1),lower(pocisti(prezime)),'@edunova.hr');
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `pocisti` (`tekst` VARCHAR(50)) RETURNS VARCHAR(50) CHARSET latin1 begin
return lower(
replace(
replace(
replace(
replace(
replace(replace(upper(tekst),' ',''),'Č','C')
,'Š','S')
,'Đ','D')
,'Ć','C')
,'Ž','Z'));
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`) VALUES
(7, 'Levis'),
(69, 'I Phone'),
(43, 'Addidas'),
(67, 'Samsung'),
(68, 'Motorola');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `items` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `expire_date` datetime NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `shipped` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `items`, `expire_date`, `paid`, `shipped`) VALUES
(245, '[{\"id\":\"1\",\"size\":\"28\",\"quantity\":2}]', '2018-05-06 04:15:15', 0, 0),
(246, '[{\"id\":\"2\",\"size\":\"medium\",\"quantity\":2}]', '2018-05-06 04:27:05', 0, 0),
(248, '[{\"id\":\"2\",\"size\":\"Medium\",\"quantity\":2},{\"id\":\"1\",\"size\":\"Large\",\"quantity\":2}]', '2018-05-08 18:36:48', 0, 0),
(249, '[{\"id\":\"1\",\"size\":\"Medium\",\"quantity\":\"1\"}]', '2018-05-08 20:29:13', 0, 0),
(253, '[{\"id\":\"1\",\"size\":\"Medium\",\"quantity\":1}]', '2018-05-08 21:29:12', 1, 1),
(254, '[{\"id\":\"1\",\"size\":\"Medium\",\"quantity\":\"1\"}]', '2018-05-09 05:04:17', 1, 1),
(255, '[{\"id\":\"1\",\"size\":\"Large\",\"quantity\":\"2\"}]', '2018-05-09 05:06:16', 1, 1),
(256, '[{\"id\":\"1\",\"size\":\"Medium\",\"quantity\":\"1\"}]', '2018-05-09 07:26:33', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent`) VALUES
(1, 'Men', 0),
(2, 'Woman', 0),
(3, 'Boys', 0),
(4, 'Girls', 0),
(5, 'Shirts', 1),
(6, 'Pants', 1),
(7, 'Shoes', 1),
(8, 'Accessories', 1),
(9, 'Shirts', 2),
(10, 'Pants', 2),
(11, 'Shoes', 2),
(12, 'Dresses', 2),
(13, 'Shirts', 3),
(14, 'Pants', 3),
(15, 'Dresses', 4),
(16, 'Shoes', 4),
(127, 'muhuhu', 0),
(31, 'Shoes', 3),
(32, 'Pants', 4),
(128, 'mish', 127);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(175) NOT NULL,
  `password` varchar(255) NOT NULL,
  `datum_prijave` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `zadnja_prijava` date NOT NULL,
  `permissions` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `full_name`, `email`, `password`, `datum_prijave`, `zadnja_prijava`, `permissions`) VALUES
(7, 'ivan', 'admin@admin.com', 'f6fdffe48c908deb0f4c3bd36c032e72', '2018-03-31 01:26:05', '2018-03-29', 'admin'),
(8, 'domagoj', 'user@user.com', '5cc32e366c87c4cb49e4309b75f57d64', '2018-03-31 01:26:51', '2018-03-29', 'editor');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `brand` int(11) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `sizes` text NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `featured`, `sizes`, `deleted`) VALUES
(1, 'Levi&#039;s Jeans', '29.99', '39.99', 7, '6', '/E-Shop/images/products/acacf1480e976e32d82fbc06c00f5d44.jpg', 'These Jeans are super freaky and awesome.', 1, 'Medium:2,Large:2,Small:4,', 0),
(2, 'Addidas Footbal', '251.00', '49.99', 43, '7', '/E-Shop/images/products/1a69548e47542225b3c48d006bf24d0c.jpg', 'What an amazing shoes...Buy now!', 1, '', 0),
(4, 'Pants ', '32.99', '33.99', 7, '6', '', '', 0, 'Medium:2,Large:2,Small:4,Medium:3,', 0),
(8, 'Samsung', '33.99', '29.99', 7, '8', '/EcomApp/images/products/d68b6169540efdb88630a19ff5a454b4.png', 'Hellou Banjo\r\n123', 0, 'Medium:2,Large:4', 1),
(6, 'interface', '42.00', '23.00', 2, '', '/ecomdva/images/products/38ee655c6fa641d85d296c8d7ff3ee27.png', 'X123', 0, 'Large:2,Medium:3,Extra Small:2,Large:4', 0),
(7, 'Produkt 123', '31.99', '21.99', 9, '14', '/E-Shop/images/products/e101f4bee7744af2c96aad7beb7a5f59.jpeg', 'Description is important \r\nIsn&#039;t it.', 0, '', 1),
(9, 'Produkt 1', '31.00', '42.00', 2, '14', '/EcomApp/images/products/586d8bd2dba262ef482359514f8f5de5.png', 'This is my new product,enyoj', 0, '', 1),
(10, 'Test Product', '399.00', '299.00', 2, '15', '/EcomApp/images/products/ffec396609913dadf1137fad7bdcd020.png', '', 0, '', 1),
(11, 'Iphone', '311.00', '111.00', 7, '16', '/E-Shop/images/products/192639178baf251577c0a60f56093c88.png', '', 0, '', 1),
(12, 'Produkt 9', '388.00', '913.00', 7, '14', '/EcomApp/images/products/adef0cc17325e6a29e442a4a58d2c6df.png', 'I am the best', 0, '', 1),
(13, 'Produkt X', '561.00', '751.00', 9, '9', '/EcomApp/images/products/3ad5302fb823799f1075b8384ef963de.png', 'Samsung za na&scaron;e korisnike', 0, '', 1),
(14, 'dada', '2.00', '111.00', 9, '3', '/EcomApp/images/products/b91808c69af903b1bc474fde766b8254.png', 'gtc', 0, '', 1),
(26, 'Produkt 123', '31.00', '7.00', 14, '15', '/E-Shop/images/products/9efe6a0f26c9310724b04c57120cb853.jpg', '', 0, '', 1),
(15, '6t5', '751.00', '561.00', 9, '31', '/EcomApp/images/products/2f477a2d009cca1b62967186094f66a8.jpg', '', 0, '', 1),
(16, 'test2', '2.00', '751.00', 2, '2', '/EcomApp/images/products/32231f1700c0eff844197d14921aa7f0.png', '', 0, '', 1),
(17, 'test2', '222.00', '111.00', 9, '2', '/EcomApp/images/products/d103e79935b7b0b98c634a78f97e6322.png', '', 0, '', 1),
(18, 'produkt anton', '31.00', '32.00', 13, '1', '/EcomApp/images/products/2561f88810d4f70a543177eef388b9ac.jpg', '2', 0, '', 1),
(19, 'produkt anton', '31.00', '32.00', 13, '1', '/EcomApp/images/products/afcf218389fbff58a13d8db68db27609.jpg', '2', 0, '', 1),
(20, 'betmen', '123.00', '345.00', 2, '6', '/betmen/images/products/0e74b9dd887697527bc4f65fc7a05e28.jpg', '', 0, '', 1),
(21, 'Proba 123', '7777.00', '2222.00', 9, '14', '/E-Shop/images/products/9ad59b50adf17ddc1db1b8c703204c9d.png', 'DFes', 0, '', 1),
(22, 'wtf', '31.00', '666.00', 9, '14', '/E-Shop/images/products/54bda4bf38131cdce80747bb709b6fbe.png', 'aa', 0, '', 1),
(23, 'Produkt 123', '12345.00', '6789.00', 13, '8', '/E-Shop/images/products/5846addb24bfeb63262bdbc652385aac.png', 'qadad', 0, '', 1),
(24, 'Produkt 1e333', '31.00', '42.00', 2, '14', '/E-Shop/images/products/450284d3bf6f1151170f76218144317d.png', '', 0, '', 1),
(25, 'adaa2', '223.00', '442.00', 9, '14', '/E-Shop/images/products/301f13a542ceaf6b3c748830c4530cae.jpg', 'BATMAN', 0, '', 1),
(27, 'I phone 5', '222.00', '200.00', 13, '8', '/E-Shop/images/products/92310629c63034cfb2a5a66c38fe5000.png', 'Amazing mobile phone !', 0, '', 1),
(28, 'test2', '222.00', '38.00', 2, '14', '/E-Shop/images/products/14ba921907ed37a4699273d768a88ba7.jpg', '', 0, '', 1),
(29, 'List price is 38', '25.00', '38.00', 2, '14', '/E-Shop/images/products/be9e9bb78a93feafea401d7f4c26a189.png', '', 0, '', 1),
(30, 'test2', '521.00', '621.00', 17, '8', '', 'Some information', 0, '', 1),
(31, 'List price is 38', '25.00', '751.00', 43, '14', '/E-Shop/images/products/ec18e5e10110328dfd400b2276606648.png', '', 0, '', 1),
(32, 'dad', '25.00', '621.00', 43, '128', '/E-Shop/images/products/a02bceb08f9ad3f8e3b1e1456330d428.png', '', 0, '', 1),
(33, 'List price is 38', '222.00', '621.00', 43, '14', '/E-Shop/images/products/cbe91a4b48aa0a1d9bace6134d450a20.png', 'ddd', 0, '', 1),
(34, 'test2', '2.00', '751.00', 43, '13', '/E-Shop/images/products/28393c24bf461e95aaee0751f6d78423.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam lacus arcu, sagittis nec aliquet a, molestie sit amet nulla. Aenean aliquam lacus a luctus vulputate. Suspendisse magna tortor, pharetra eu congue sed, consequat eu dui. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus elit arcu, blandit vel rhoncus ut, porttitor ut ex. Nullam pellentesque maximus massa ac facilisis. ', 1, '', 0),
(35, '2Samsung', '25.00', '38.00', 67, '128', '/E-Shop/images/products/faff3509e39f60acf072c99c77759a69.png', 'Samsung mobile phone, it is great !!', 1, '', 0),
(37, 'test2231231', '2.00', '621.00', 7, '14', '/E-Shop/images/products/87a3cfd908ccd87f7b52b0ce91f28f95.png', '', 1, '', 0),
(38, 'Zlatni mobitel', '1500000.00', '1000000.00', 69, '128', '/E-Shop/images/products/6ef744d01c600acbe4268ccb4a1c010a.jpg', 'test', 1, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `charge_id` varchar(255) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(175) NOT NULL,
  `street` varchar(255) NOT NULL,
  `street2` varchar(255) NOT NULL,
  `city` varchar(175) NOT NULL,
  `state` varchar(175) NOT NULL,
  `zip_code` varchar(40) NOT NULL,
  `country` varchar(159) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `txn_type` varchar(255) NOT NULL,
  `txn_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `charge_id`, `cart_id`, `full_name`, `email`, `street`, `street2`, `city`, `state`, `zip_code`, `country`, `sub_total`, `tax`, `grand_total`, `description`, `txn_type`, `txn_date`) VALUES
(1, 'ch_1CEjFCAWkKYwwTZdkEZFZJha', 253, 'Domagoj', 'edunova@edunova.hr', 'Ulica', 'Street', 'Osijek', 'Croatia', '31000', 'Croatia', '29.99', '2.61', '32.60', '1itemfrom Trgovinica.', 'charge', '2018-04-08 21:32:06'),
(2, 'ch_1CEqJuAWkKYwwTZdTt8839FL', 254, 'Ime Prezime', 'mario@edunova.hr', 'Ulica', 'Street', 'Osijek', 'Croatia', '131313', 'Croatia', '29.99', '2.61', '32.60', '1itemfrom Trgovinica.', 'charge', '2018-04-09 05:05:27'),
(3, 'ch_1CEqOKAWkKYwwTZdmXlMxDEX', 255, 'Viktor Maksimovi?', 'ViktorM@gmail.com', 'Bisevska 2', '', 'Zagreb', 'Croatia', '10000', 'Croatia', '59.98', '5.22', '65.20', '2itemsfrom Trgovinica.', 'charge', '2018-04-09 05:10:01'),
(4, 'ch_1CEsX2AWkKYwwTZdHciOqW3r', 256, 'Viktor Maksimovi?', 'edunova@edunova.hr', 'Bisevska 2', 'Street', 'Osijek', 'Croatia', '10000', 'Croatia', '29.99', '2.61', '32.60', '1itemfrom Trgovinica.', 'charge', '2018-04-09 07:27:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
