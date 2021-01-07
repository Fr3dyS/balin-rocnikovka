-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1:3306
-- Vytvořeno: Čtv 07. led 2021, 10:15
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
  `account_republika` varchar(100) COLLATE utf8mb4_czech_ci NOT NULL,
  `account_ulice` text CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `account_mesto` varchar(50) COLLATE utf8mb4_czech_ci NOT NULL,
  `account_psc` int(11) NOT NULL,
  `account_ip` text COLLATE utf8mb4_czech_ci NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `accounts`
--

INSERT INTO `accounts` (`account_id`, `account_name`, `account_password`, `account_mail`, `account_rank`, `account_reg_date`, `account_phone`, `account_republika`, `account_ulice`, `account_mesto`, `account_psc`, `account_ip`) VALUES
(11, 'TomÃ¡Å¡ KadleÄek', '$2y$10$suZGWd9xVf6ZOuNzfNqlxOwkWYSpoJQnE90nyttl4/ivrDiJI7wzK', 'tom@gmail.com', 1, '2020-12-06 23:17:27', 771199664, '', 'NovÃ¡ 1410', 'ÃšstÃ­ nad Labem-StÅ™ekov', 40003, '::1'),
(12, 'TomÃ¡Å¡ KadleÄek', '$2y$10$8j2TrDSpBbTW14RVnhf3UelXRn16h/s58prY33hqWxW33Qdcq0CHu', 'kadle.tom@gmail.com', 3, '2020-12-07 22:17:59', 771199666, '', '356', 'Ãºsotewtg', 41801, '::1'),
(13, 'TomÃ¡Å¡ KadleÄek', '$2y$10$QU1q.Iw8iL0PHKpbg9WG2uyTybp37tAAuPLyqIzgOlxzfspIf/rpm', 'kaqqdle.tom@gmail.comq', 1, '2020-12-29 01:00:46', 771199666, '', 'Na VÃ½slunÃ­', 'BÃ­lina', 41801, '::1');

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
-- Struktura tabulky `kits_doprava`
--

DROP TABLE IF EXISTS `kits_doprava`;
CREATE TABLE IF NOT EXISTS `kits_doprava` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazev` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `typ` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `cena` decimal(6,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `kits_doprava`
--

INSERT INTO `kits_doprava` (`id`, `nazev`, `typ`, `cena`) VALUES
(1, 'Balin-expres', 'doprava', '100.00'),
(2, 'Balin-box', 'doprava', '0.00'),
(3, 'Balin do ruky', 'doprava', '5000.00'),
(4, 'PayPal', 'Platba', '0.00'),
(5, 'Platba na místě', 'Platba', '40.00');

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
  `kits_product_img` text COLLATE utf8mb4_czech_ci NOT NULL,
  PRIMARY KEY (`kits_product_id`),
  KEY `fk_category_products` (`kits_category_id`),
  KEY `fk_brand_products` (`kits_brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `kits_products`
--

INSERT INTO `kits_products` (`kits_product_id`, `kits_category_id`, `kits_brand_id`, `kits_product_date`, `kits_product_name`, `kits_product_desc`, `kits_product_price`, `kits_product_status`, `kits_product_img`) VALUES
(1, 1, 1, '2020-11-30', 'rychlikovy vuz', 'je to vlak ', '100.00', 'dostupny ', 'data:image/jpg;charset=utf8;base64'),
(2, 2, 2, '2020-11-30', 'cz tank', 'je to tank', '100000.00', 'ywerg', 'data:image/jpg;charset=utf8;base64'),
(3, 1, 2, '2021-01-06', 'rychlikovy vozidlo', 'ewfefewffw', '105.00', '25', 'wefewf'),
(4, 2, 2, '2021-01-07', 'TomÃ¡Å¡ KadleÄek', 'rgre', '300.00', '20', ''),
(5, 2, 2, '2021-01-07', 'TomÃ¡Å¡ KadleÄek', 'rgreweewf', '5000.00', '20', ''),
(6, 2, 2, '2021-01-07', 'TomÃ¡Å¡ KadleÄek', 'rgreweewf', '5000.00', '20', ''),
(7, 2, 2, '2021-01-07', 'TomÃ¡Å¡ KadleÄek', 'rgreweewf', '5000.00', '20', ''),
(8, 2, 2, '2021-01-07', 'TomÃ¡Å¡ KadleÄek', 'rgre', '500000.00', '300', ''),
(9, 2, 2, '2020-11-30', 'rychlikovy vuz', 'je to tank', '100000.00', '20000', 'FERWFE'),
(10, 2, 2, '2021-01-07', 'TomÃ¡Å¡ KadleÄek', 'rgre', '500000.00', '300', ''),
(11, 2, 2, '2021-01-07', 'TomÃ¡Å¡ KadleÄek', 'rgre', '500000.00', '300', ''),
(12, 2, 2, '2021-01-07', 'TomÃ¡Å¡ KadleÄek', 'rgre', '500000.00', '300', ''),
(13, 2, 2, '2021-01-07', 'TomÃ¡Å¡', 'rgreweewf', '300.00', '20', 'unknown.png'),
(14, 2, 2, '2021-01-08', 'TomÃ¡Å¡ KadleÄek', 'ewfewfwe', '2000.00', '100', 'unknown.png');

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
  `rank_name_en` text CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `rank_name_cs` text CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
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
