-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1:3306
-- Vytvořeno: Ned 06. pro 2020, 20:20
-- Verze serveru: 5.7.31
-- Verze PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `kits`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The id of account',
  `account_name` varchar(100) COLLATE utf8mb4_czech_ci NOT NULL COMMENT 'name of account',
  `account_password` text COLLATE utf8mb4_czech_ci NOT NULL COMMENT 'the password for this account',
  `account_mail` varchar(200) COLLATE utf8mb4_czech_ci NOT NULL COMMENT 'The email for this account',
  `account_rank` int(11) NOT NULL DEFAULT '3' COMMENT 'The foreign ID of administration group of accounts...',
  `account_reg_date` datetime NOT NULL COMMENT 'The date when this account was registred',
  `account_phone` int(12) NOT NULL,
  `account_ulice` text CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `account_mesto` varchar(50) COLLATE utf8mb4_czech_ci NOT NULL,
  `account_psc` int(11) NOT NULL,
  `account_ip` text COLLATE utf8mb4_czech_ci NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `accounts`
--

INSERT INTO `accounts` (`account_id`, `account_name`, `account_password`, `account_mail`, `account_rank`, `account_reg_date`, `account_phone`, `account_ulice`, `account_mesto`, `account_psc`, `account_ip`) VALUES
(10, 'TomÃ¡Å¡ KadleÄek', '$2y$10$edCZlH8s36EajJPXwXPBYu54Wu1cb7v7Xt3uTWoPAkniCCa.7EeEK', 'tom@gmail.com', 1, '2020-11-30 00:21:37', 771199666, 'novÃ¡ 1410', 'BÃ­lina', 400003, '::1');

-- --------------------------------------------------------

--
-- Struktura tabulky `kits_brands`
--

DROP TABLE IF EXISTS `kits_brands`;
CREATE TABLE IF NOT EXISTS `kits_brands` (
  `kits_brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `kits_brand_title` varchar(100) COLLATE utf8mb4_czech_ci NOT NULL,
  PRIMARY KEY (`kits_brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `kits_brands`
--

INSERT INTO `kits_brands` (`kits_brand_id`, `kits_brand_title`) VALUES
(1, 'PIKO'),
(2, 'herpa');

-- --------------------------------------------------------

--
-- Struktura tabulky `kits_category`
--

DROP TABLE IF EXISTS `kits_category`;
CREATE TABLE IF NOT EXISTS `kits_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(250) COLLATE utf8mb4_czech_ci NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `kits_category`
--

INSERT INTO `kits_category` (`category_id`, `category_title`) VALUES
(1, 'vláčky'),
(2, 'tanky'),
(3, 'automobil');

-- --------------------------------------------------------

--
-- Struktura tabulky `kits_payment`
--

DROP TABLE IF EXISTS `kits_payment`;
CREATE TABLE IF NOT EXISTS `kits_payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `payment_date` timestamp NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `fk_account_payments` (`customer_id`),
  KEY `fk_product_payments` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

-- --------------------------------------------------------

--
-- Struktura tabulky `kits_products`
--

DROP TABLE IF EXISTS `kits_products`;
CREATE TABLE IF NOT EXISTS `kits_products` (
  `kits_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `kits_category_id` int(11) NOT NULL,
  `kits_brand_id` int(11) NOT NULL,
  `kits_product_date` date NOT NULL,
  `kits_product_name` varchar(50) COLLATE utf8mb4_czech_ci NOT NULL,
  `kits_product_desc` varchar(40) COLLATE utf8mb4_czech_ci NOT NULL,
  `kits_product_price` decimal(9,2) NOT NULL,
  `kits_product_status` text COLLATE utf8mb4_czech_ci NOT NULL,
  `kits_product_img1` text COLLATE utf8mb4_czech_ci NOT NULL,
  `kits_product_img2` text COLLATE utf8mb4_czech_ci NOT NULL,
  `kits_product_img3` text COLLATE utf8mb4_czech_ci NOT NULL,
  PRIMARY KEY (`kits_product_id`),
  KEY `fk_category_products` (`kits_category_id`),
  KEY `fk_brand_products` (`kits_brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `kits_products`
--

INSERT INTO `kits_products` (`kits_product_id`, `kits_category_id`, `kits_brand_id`, `kits_product_date`, `kits_product_name`, `kits_product_desc`, `kits_product_price`, `kits_product_status`, `kits_product_img1`, `kits_product_img2`, `kits_product_img3`) VALUES
(1, 1, 1, '2020-11-30', 'rychlikovy vuz', 'je to vlak ', '100.00', 'dostupny ', '', '', ''),
(2, 2, 2, '2020-11-30', 'cz tank', 'je to tank', '100000.00', 'ywerg', '', '', '');

-- --------------------------------------------------------

--
-- Struktura tabulky `ranks`
--

DROP TABLE IF EXISTS `ranks`;
CREATE TABLE IF NOT EXISTS `ranks` (
  `rank_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `rank_priority` int(10) UNSIGNED NOT NULL COMMENT 'Higher the value is, the more rights the account has.	',
  `rank_protected` int(11) NOT NULL DEFAULT '0' COMMENT 'Protected records cannot be deleted.	',
  PRIMARY KEY (`rank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `ranks`
--

INSERT INTO `ranks` (`rank_id`, `rank_priority`, `rank_protected`) VALUES
(1, 100, 1),
(2, 50, 0),
(3, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `rank_name_terms`
--

DROP TABLE IF EXISTS `rank_name_terms`;
CREATE TABLE IF NOT EXISTS `rank_name_terms` (
  `rank_name_term_id` int(10) UNSIGNED NOT NULL,
  `rank_name_en` text COLLATE utf8mb4_czech_ci NOT NULL,
  `rank_name_cs` text COLLATE utf8mb4_czech_ci NOT NULL,
  PRIMARY KEY (`rank_name_term_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `rank_name_terms`
--

INSERT INTO `rank_name_terms` (`rank_name_term_id`, `rank_name_en`, `rank_name_cs`) VALUES
(1, 'Administrator', 'Administrátor'),
(2, 'Moderator', 'Moderátor'),
(3, 'Customer', 'Zákazník');

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `kits_payment`
--
ALTER TABLE `kits_payment`
  ADD CONSTRAINT `fk_account_payments` FOREIGN KEY (`customer_id`) REFERENCES `accounts` (`account_id`),
  ADD CONSTRAINT `fk_product_payments` FOREIGN KEY (`product_id`) REFERENCES `kits_products` (`kits_product_id`);

--
-- Omezení pro tabulku `kits_products`
--
ALTER TABLE `kits_products`
  ADD CONSTRAINT `fk_brand_products` FOREIGN KEY (`kits_brand_id`) REFERENCES `kits_brands` (`kits_brand_id`),
  ADD CONSTRAINT `fk_category_products` FOREIGN KEY (`kits_category_id`) REFERENCES `kits_category` (`category_id`);

--
-- Omezení pro tabulku `ranks`
--
ALTER TABLE `ranks`
  ADD CONSTRAINT `fk_ranks` FOREIGN KEY (`rank_id`) REFERENCES `rank_name_terms` (`rank_name_term_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
