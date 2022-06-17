-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_pos_app
CREATE DATABASE IF NOT EXISTS `db_pos_app` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `db_pos_app`;

-- Dumping structure for table db_pos_app.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_pos_app.product: ~6 rows (approximately)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`id`, `name`, `price`) VALUES
	(1, 'Oreo 200gr', 2000),
	(2, 'Ale-ale Jeruk 120ml', 1000),
	(3, 'Teh gelas 120 ml', 1000),
	(4, 'Richeese Nabati 250gr', 3000),
	(5, 'Pilus Pedas', 500),
	(6, 'Pilus Rumput Laut', 500),
	(7, 'Ultra Milk Coklat 100ml', 3500);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Dumping structure for table db_pos_app.receipt
CREATE TABLE IF NOT EXISTS `receipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_id` varchar(50) NOT NULL,
  `total_paid` float NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_pos_app.receipt: ~0 rows (approximately)
/*!40000 ALTER TABLE `receipt` DISABLE KEYS */;
INSERT INTO `receipt` (`id`, `receipt_id`, `total_paid`, `created_at`) VALUES
	(1, '02217620', 5000, '2022-06-17 18:08:44'),
	(2, '02126027', 10000, '2022-06-17 18:55:57');
/*!40000 ALTER TABLE `receipt` ENABLE KEYS */;

-- Dumping structure for table db_pos_app.receipt_detail
CREATE TABLE IF NOT EXISTS `receipt_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_id` varchar(50) NOT NULL,
  `product_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_receipt_detail_product` (`product_id`),
  CONSTRAINT `FK_receipt_detail_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table db_pos_app.receipt_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `receipt_detail` DISABLE KEYS */;
INSERT INTO `receipt_detail` (`id`, `receipt_id`, `product_id`, `count`) VALUES
	(1, '02217620', 1, 2),
	(2, '02217620', 3, 1),
	(3, '02126027', 1, 2),
	(4, '02126027', 7, 1);
/*!40000 ALTER TABLE `receipt_detail` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
