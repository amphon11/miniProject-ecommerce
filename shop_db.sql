-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for shop_db
CREATE DATABASE IF NOT EXISTS `shop_db2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `shop_db2`;

-- Dumping structure for table shop_db.address
CREATE TABLE IF NOT EXISTS `address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `houseNumber` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tambon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `amphure` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `province` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `postelCode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`,`username`) USING BTREE,
  KEY `FK_address_tb_users` (`username`),
  CONSTRAINT `FK_address_tb_users` FOREIGN KEY (`username`) REFERENCES `tb_users` (`username`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table shop_db.address: ~9 rows (approximately)
REPLACE INTO `address` (`id`, `username`, `houseNumber`, `tambon`, `amphure`, `province`, `postelCode`) VALUES
	(1, 'admin', '444', 'เตย', 'ม่วงสามสิบ', 'อุบลราชธานี', '34140'),
	(1, 'nooy', '388', 'เตย', 'ม่วงสามสิบ', 'อุบลราชธานี', '34140'),
	(19, 'au', '933', 'ท่าตะเกียบ - Tha Takiap', 'ท่าตะเกียบ - Tha Takiap', 'ฉะเชิงเทรา - Chachoengsao', '24332'),
	(20, 'bass', '333', 'นิคมสร้างตนเอง - Nikhom Sang Ton-eng', 'พิมาย - Phimai', 'นครราชสีมา - Nakhon Ratchasima', '30000'),
	(21, 'copter', '888', 'ในเมือง - Nai Mueang', 'เมืองยโสธร - Mueang Yasothon', 'ยโสธร - Yasothon', '30000'),
	(22, 'few', '555', 'ในเมือง - Nai Mueang', 'เมืองนครราชสีมา - Mueang Nakhon Ratchasima', 'นครราชสีมา - Nakhon Ratchasima', '40000'),
	(23, 'bew', '999', 'ในเมือง - Nai Mueang', 'เมืองนครราชสีมา - Mueang Nakhon Ratchasima', 'นครราชสีมา - Nakhon Ratchasima', '30000'),
	(24, 'kla', '789', 'ในเมือง - Nai Mueang', 'เมืองนครราชสีมา - Mueang Nakhon Ratchasima', 'นครราชสีมา - Nakhon Ratchasima', '30000'),
	(25, 'fon', '567', 'มะขามหย่ง - Makham Yong', 'เมืองชลบุรี - Mueang Chon Buri', 'ชลบุรี - Chon Buri', '32000');

-- Dumping structure for view shop_db.order_list
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `order_list` (
	`order_id` INT(6) UNSIGNED ZEROFILL NOT NULL,
	`order_Date` DATETIME NULL,
	`username` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_general_ci',
	`order_name` VARCHAR(511) NOT NULL COLLATE 'utf8mb3_general_ci',
	`sum_amount` DECIMAL(32,0) NULL,
	`sum_price` DECIMAL(42,0) NULL
) ENGINE=MyISAM;

-- Dumping structure for table shop_db.tb_brand
CREATE TABLE IF NOT EXISTS `tb_brand` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name_brand` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table shop_db.tb_brand: ~12 rows (approximately)
REPLACE INTO `tb_brand` (`id`, `name_brand`) VALUES
	(31, 'AULA'),
	(33, 'EGA'),
	(34, 'FANTECH'),
	(35, 'LOGITECH'),
	(36, 'Hyperx'),
	(50, 'SIGNO'),
	(51, 'NUBWO'),
	(52, 'DUOCAST'),
	(53, 'ELGATO'),
	(54, 'ONIKUMA'),
	(55, 'ASUS'),
	(56, 'RAZER');

-- Dumping structure for table shop_db.tb_image_product
CREATE TABLE IF NOT EXISTS `tb_image_product` (
  `product_id` int NOT NULL,
  `main_image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `preview_image1` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `preview_image2` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `preview_image3` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`product_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table shop_db.tb_image_product: ~40 rows (approximately)
REPLACE INTO `tb_image_product` (`product_id`, `main_image`, `preview_image1`, `preview_image2`, `preview_image3`) VALUES
	(34, 'A0139993OK_BIG_1.webp', 'A0139993OK_BIG_3.webp', 'A0139993OK_BIG_4.webp', 'A0139993OK_BIG_5.webp'),
	(43, 'A0142431OK_BIG_1.webp', 'A0142431OK_BIG_2.jpg', 'A0142431OK_BIG_3.jpg', 'A0142431OK_BIG_5.jpg'),
	(44, '202304282817622662.webp', 'A0145684OK_BIG_2.jpg', 'A0145684OK_BIG_3.jpg', 'A0145684OK_BIG_5.jpg'),
	(45, 'A0148179OK_BIG_1.jpg', 'A0148179OK_BIG_2.jpg', 'A0148179OK_BIG_3 (1).jpg', 'A0148179OK_BIG_4.jpg'),
	(46, 'A0133853OK_BIG_1.webp', 'A0133853OK_BIG_2.jpg', 'A0133853OK_BIG_3.jpg', 'A0133853OK_BIG_4.jpg'),
	(47, 'A0138573OK_BIG_1.webp', 'A0138573OK_BIG_3.jpg', 'A0138573OK_BIG_4.jpg', 'A0138573OK_BIG_2.jpg'),
	(48, 'A0144176OK_BIG_1.webp', 'A0144176OK_BIG_2.webp', 'A0144176OK_BIG_3.webp', 'A0148179OK_BIG_4.jpg'),
	(51, '1707141449th-11134004-7r98x-lo5d4m5xarxud8.png', '5b7aa404423ad5a76dd09dc47180fb85.jpeg', '619dda43d4bba9ea3e1520be64d892d5.jpeg', 'bf0b5c6a4e54d49e1741db3e436ddad8.jpeg'),
	(55, '1707152842A0120110OK_BIG_1.webp', 'A0120110OK_BIG_2.webp', 'A0120110OK_BIG_3.webp', 'A0120110OK_BIG_4.webp'),
	(56, 'A0131487OK_BIG_1.webp', 'A0131487OK_BIG_2.jpg', 'A0131487OK_BIG_3.jpg', 'A0131487OK_BIG_4.jpg'),
	(57, 'A0154577OK_BIG_1.webp', 'A0154577OK_BIG_2.webp', 'A0154577OK_BIG_3.webp', 'A0154577OK_BIG_5.webp'),
	(58, '1707153463A0146849OK_BIG_1.webp', 'A0146849OK_BIG_2.webp', 'A0146849OK_BIG_3.webp', 'A0146849OK_BIG_4.webp'),
	(59, '1707153706A0146857OK_BIG_1.webp', 'A0146857OK_BIG_2.webp', 'A0146857OK_BIG_3.webp', 'A0146857OK_BIG_4.webp'),
	(60, 'A0151250OK_BIG_1.webp', 'A0151250OK_BIG_2.webp', 'A0151250OK_BIG_3.webp', 'A0151250OK_BIG_4.webp'),
	(61, 'A0153887OK_BIG_1.webp', 'A0153887OK_BIG_2.jpg', 'A0153887OK_BIG_4.jpg', 'A0153887OK_BIG_5.jpg'),
	(62, 'A0144403OK_BIG_1.webp', 'A0144404OK_BIG_2.jpg', 'A0144404OK_BIG_3.jpg', 'A0144404OK_BIG_4.jpg'),
	(63, '1707154475A0144404OK_BIG_1.webp', 'A0144404OK_BIG_2.jpg', 'A0144404OK_BIG_3.jpg', 'A0144404OK_BIG_4.jpg'),
	(64, 'A0138578OK_BIG_1.webp', 'A0138578OK_BIG_2 (1).jpg', 'A0138578OK_BIG_2.jpg', 'A0138578OK_BIG_4.jpg'),
	(65, 'A0153659OK_BIG_1.webp', 'A0153659OK_BIG_2.jpg', 'A0153659OK_BIG_4.jpg', 'A0153659OK_BIG_5.jpg'),
	(66, 'A0157113OK_BIG_1.webp', 'A0157113OK_BIG_2.jpg', 'A0157113OK_BIG_4.jpg', 'A0157113OK_BIG_5.jpg'),
	(67, 'A0151325OK_BIG_1.jpg', 'A0151325OK_BIG_2.jpg', 'A0151325OK_BIG_3.jpg', 'A0151325OK_BIG_5.jpg'),
	(68, '1707155688A0138583OK_BIG_1.webp', 'A0138583OK_BIG_2.jpg', 'A0138583OK_BIG_3.jpg', 'A0138583OK_BIG_5.jpg'),
	(69, 'A0147450OK_BIG_1.webp', 'A0147450OK_BIG_2.jpg', 'A0147450OK_BIG_3.jpg', 'A0147450OK_BIG_5.jpg'),
	(70, 'A0138584OK_BIG_1.webp', 'A0138584OK_BIG_2.webp', 'A0138584OK_BIG_3.webp', 'A0138584OK_BIG_5.webp'),
	(80, 'A0127313OK_BIG_6.webp', 'A0127313OK_BIG_4.jpg', 'A0127313OK_BIG_3.jpg', 'A0127313OK_BIG_2.jpg'),
	(88, 'A0142432OK_BIG_1.webp', 'A0142432OK_BIG_3.jpg', 'A0142432OK_BIG_2.jpg', 'A0142432OK_BIG_5.jpg'),
	(89, '1708603262A0134341OK_BIG_1.jpg', 'A0134341OK_BIG_3.jpg', 'A0134341OK_BIG_2.jpg', 'A0134341OK_BIG_4.jpg'),
	(90, 'A0150269OK_BIG_1.webp', 'A0150269OK_BIG_2.webp', 'A0150269OK_BIG_3.jpg', 'A0150269OK_BIG_4.webp'),
	(91, 'A0134426OK_BIG_1.webp', 'A0134426OK_BIG_2.webp', 'A0134426OK_BIG_3.webp', 'A0134426OK_BIG_4.webp'),
	(92, 'A0138767OK_BIG_1.jpg', 'A0138767OK_BIG_2.jpg', 'A0138767OK_BIG_3.jpg', 'A0138767OK_BIG_4.jpg'),
	(93, 'A0145847OK_BIG_1.webp', 'A0145847OK_BIG_3.webp', 'A0145847OK_BIG_4.webp', 'A0145847OK_BIG_5.webp'),
	(94, 'A0135899OK_BIG_1.webp', 'A0135899OK_BIG_2.webp', 'A0135899OK_BIG_3.webp', 'A0135899OK_BIG_4.webp'),
	(95, 'A0147451OK_BIG_1.webp', 'A0147451OK_BIG_2.jpg', 'A0147451OK_BIG_3.jpg', 'A0147451OK_BIG_4.jpg'),
	(96, 'A0137005OK_BIG_1 (1).jpg', 'A0137005OK_BIG_2.jpg', 'A0137005OK_BIG_3.jpg', 'A0137005OK_BIG_4.jpg'),
	(97, 'A0154661OK_BIG_1.webp', 'A0154661OK_BIG_2.jpg', 'A0154661OK_BIG_3.jpg', 'A0154661OK_BIG_4.jpg'),
	(98, 'A0127466OK_BIG_1.webp', 'A0127466OK_BIG_2.jpg', 'A0127466OK_BIG_3.jpg', 'A0127466OK_BIG_4.jpg'),
	(99, 'A0142621OK_BIG_1.webp', '202203032578694857.png', '202203033063694555.png', '202203034691851285.png'),
	(100, 'A0139528OK_BIG_1.webp', 'A0139528OK_BIG_1.webp', 'A0139528OK_BIG_2.webp', 'A0139528OK_BIG_3.webp'),
	(101, 'A0155850OK_BIG_1.webp', 'A0155850OK_BIG_2.webp', 'A0155850OK_BIG_3.webp', 'A0155850OK_BIG_5.jpg'),
	(102, 'A0144527OK_BIG_1.jpg', 'A0144527OK_BIG_2.jpg', 'A0144527OK_BIG_3.jpg', 'A0144527OK_BIG_5.jpg');

-- Dumping structure for table shop_db.tb_order
CREATE TABLE IF NOT EXISTS `tb_order` (
  `order_id` int(6) unsigned zerofill NOT NULL,
  `order_Date` datetime DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `FK_tb_order_tb_users` (`username`),
  CONSTRAINT `FK_tb_order_tb_users` FOREIGN KEY (`username`) REFERENCES `tb_users` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table shop_db.tb_order: ~8 rows (approximately)
REPLACE INTO `tb_order` (`order_id`, `order_Date`, `username`) VALUES
	(000002, '2024-02-22 20:38:39', 'copter'),
	(000003, '2024-02-22 22:30:01', 'au'),
	(000004, '2024-02-22 22:37:10', 'nooy'),
	(000005, '2024-02-23 22:39:24', 'nooy'),
	(000006, '2024-02-22 22:42:15', 'bass'),
	(000007, '2024-02-23 22:45:19', 'bass'),
	(000008, '2024-02-22 22:50:10', 'fon'),
	(000009, '2024-02-22 22:52:28', 'few'),
	(000010, '2024-02-22 22:56:04', 'kla');

-- Dumping structure for table shop_db.tb_order_product
CREATE TABLE IF NOT EXISTS `tb_order_product` (
  `order_id` int(6) unsigned zerofill NOT NULL,
  `product_id` int unsigned NOT NULL,
  `amount` int DEFAULT NULL,
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `FK_tb_order_product_tb_product` (`product_id`),
  CONSTRAINT `FK_tb_order_product_tb_product` FOREIGN KEY (`product_id`) REFERENCES `tb_product` (`product_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table shop_db.tb_order_product: ~11 rows (approximately)
REPLACE INTO `tb_order_product` (`order_id`, `product_id`, `amount`) VALUES
	(000002, 34, 1),
	(000002, 56, 1),
	(000002, 70, 1),
	(000002, 88, 1),
	(000003, 51, 1),
	(000003, 57, 1),
	(000004, 34, 1),
	(000004, 88, 1),
	(000005, 89, 1),
	(000006, 100, 1),
	(000007, 43, 1),
	(000008, 47, 1),
	(000008, 62, 2),
	(000009, 67, 4),
	(000009, 96, 2),
	(000010, 62, 1);

-- Dumping structure for table shop_db.tb_product
CREATE TABLE IF NOT EXISTS `tb_product` (
  `product_id` int unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` int DEFAULT NULL,
  `type_id` int DEFAULT NULL,
  `model` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `frequency` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `impedance` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cableLenght` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `feature` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `connector` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bluetoothVer` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `resolution` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `battery` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sentivity` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `grossweight` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `volume` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `color` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `store` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` int DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `brand_id` (`brand_id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `brand_id` FOREIGN KEY (`brand_id`) REFERENCES `tb_brand` (`id`),
  CONSTRAINT `type_id` FOREIGN KEY (`type_id`) REFERENCES `tb_type_product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table shop_db.tb_product: ~40 rows (approximately)
REPLACE INTO `tb_product` (`product_id`, `brand_id`, `type_id`, `model`, `frequency`, `impedance`, `cableLenght`, `feature`, `connector`, `bluetoothVer`, `resolution`, `battery`, `sentivity`, `grossweight`, `volume`, `color`, `store`, `price`) VALUES
	(34, 31, 3, 'F3010', 'none', 'none', '1.65m', 'RGB 	\r\nNon-Mechanical', ' USB AUX3.5', '5.0', '1111', 'none', 'none', '1.05KG', '4,630 cm3', 'Black', '48', 1000),
	(43, 31, 3, 'F3018', 'none', 'none', '1.6m', 'เมมโมรี่คีย์บอร์ด', ' USB2.0', 'none', 'none', 'none', 'none', '0.90 KG', '3,595.50 cm3', 'none', '19', 770),
	(44, 31, 3, 'S2022 PINK', 'none', 'none', '1.6m', 'FN MultiMedia key\r\nAnti-ghosting 26 keys ', ' USB2.0', 'none', 'none', 'none', 'none', '	0.82 KG', '3,895.00 cm3', 'PINK', '7', 750),
	(45, 33, 1, 'TYPE-H13', '20Hz-20kHz', '20 Ohm', 'none', 'Microphone Range : 0 Hz - 10 kHz\r\nMicrophone Sensitivity : -38dB\r\nMicrophone Impedance : 2.2k Ohm', ' USB2.0', 'none', 'none', 'none', '103 dB', '0.68 KG', '(W x D x 11.20 x 24.50 x 22.50 cm', 'Black', '19', 690),
	(46, 34, 1, 'CAPTAIN HG11 RGB GAMING', '20Hz-20KHz', '21Ω ± 15%', '2.2m', 'Omni directional\r\nMic Dimensions : 4.0*1.5mm', ' USB2.0', 'none', 'none', 'none', '119dB ± 3dB', '0.58 KG', '5,914.78 cm3', 'none', '8', 1050),
	(47, 31, 2, 'H512', 'none', 'none', '1.8m', '12 Buttons', ' USB2.0', 'none', '800/1200/1600/2000/2400/3000 DPI', 'none', 'none', '0.23 KG', '1,443.96 cm3', 'none', '2', 350),
	(48, 34, 2, 'Thor II X16 V2', 'none', 'none', '1.8m', 'Sensor : Instant A825\r\nRunning RGB with 7 RGB modes', ' USB2.0', 'none', '200-12,800 DPI', 'none', 'none', '0.23 KG', '1,463.00 cm3', 'BLACK', '7', 440),
	(51, 35, 2, 'G PRO X SUPERLIGHT BLACK', ' 1000 Hz', 'None', 'None', 'ไม่ถึง 63 กรัม ระบบไร้สาย LIGHTSPEED ขั้นสูงความหน่วงแฝงต่ำ ความแม่นยำระดับซับไมครอนด้วยเซ็นเซอร์ HERO 25K ขจัดทุกอุปสรรคด้วยเมาส์ PRO ที่เร็วที่สุดและเบาที่สุดของเรา\r\n-การเคลื่อนไหวต่อเนื่อง: 70h', ' USB2.0 Bluetooth', 'none', '25600DPI', 'none', 'None', '63g', '125.0 mmx63.5x40.0 mm', 'Black', '19', 3990),
	(55, 36, 2, 'PULSEFIRE CORE RGB', ' 1000 Hz', 'none', '1.8m', 'ประเภทการเชื่อมต่อ : USB\r\nจำนวนปุ่ม : 7 Buttons\r\nSoftware Marco : HyperX NGEUNITY\r\nเซ็นเซอร์ออพติคอล Pixart 3327\r\nปุ่มตั้งโปรแกรมได้เจ็ดปุ่ม', ' USB2.0', 'none', '6,200 DPI', 'none', 'None', '0.10 KG', '1,296.00 cm3', 'Black', '10', 590),
	(56, 36, 2, 'PULSEFIRE RAID', ' 1000 Hz', 'None', '1.8 m', 'เชื่อมต่อด้วย USB 2.0\r\nเมาส์ 11 ปุ่มที่เหมาะมือ\r\nเซ็นเซอร์ Pixart 3389\r\n16,000 DPI / 450 IPS / 50G\r\nปรับแต่งได้ผ่านซอฟต์แวร์ HyperX NGENUITY', ' USB2.0', 'none', '16,000 DPI ', 'none', 'None', '0.22 KG', '1,135.26 cm3', 'Black', '9', 1240),
	(57, 36, 2, 'PULSEFIRE HASTE 2', ' 1000 Hz', 'None', 'N/A', 'Interface : USB 2.0\r\nResolution : 26,000 DPI\r\nButtons : 6 Buttons\r\nUltra-lightweight 53g design\r\nPrecision HyperX 26K Sensor\r\n8000Hz Polling Rate\r\nSuper-flexible HyperFlex 2 Cable', ' USB', 'none', '26,000 DPI', 'none', 'None', '0.23 KG', '1,072.50 cm3', 'white', '9', 1590),
	(58, 33, 2, 'TYPE-M12', ' 1000 Hz', 'none', '1.65 M', 'RGB lighting makes you have a wondeful gaming\r\n5 Mouse buttons can be programmed via software\r\nHuano switches 20 million clicking life times\r\nChipset instant sunplus 6662', ' USB2.0', 'none', '12,000 DPI', 'none', 'None', '0.19 KG', '1,827.00 cm3', 'white', '10', 329),
	(59, 33, 3, ' LITE K103 CIY BLACK - BLUE SWITCH', ' 1000 Hz', 'None', '1.5m', 'Mini RGB light makes you have a wonderful\r\n12 Hotkeys and non-slip mat\r\n50 Millons touch life keys\r\nKeycar 104 keys Blue/Red switches\r\nCIY outemu switches dust proof\r\nAnti ghosting 25 keys', ' USB2.0', 'none', 'None', 'none', 'None', 'N/A', '42.60 x 12.20 x 3.60 cm', 'Black', '3', 729),
	(60, 33, 3, ' CMK1 CIY LAYOUT A - BLUE SWITCH', ' 1000 Hz', 'None', ' N/A', 'Interface : USB 2.0\r\nBack light : Mini RGB\r\nประเภท Key Switch : Outemu Blue switch\r\nจำนวน Keys : 100 Keys\r\nประเภท Keycap : EN / TH', ' USB2.0 Bluetooth', 'none', 'None', 'none', 'None', '0.00 KG', '39.10 x 14.20 x 4.05 cm', 'Black', '9', 890),
	(61, 33, 3, ' CMK3 BLACK - BLUE SWITCH', ' 1000 Hz', 'None', '1.2 M', 'Interface : USB Type-C \r\nBack light : RGB\r\nประเภท Key Switch : RGB Spectrum\r\nจำนวน Keys : 108 Keys\r\nประเภท Keycap : EN / TH', ' USB2.0', 'none', 'None', 'none', 'None', 'N/A', ' 44.40 x 13.40 x 4.48 cm', 'Black', '8', 1490),
	(62, 33, 1, 'TYPE-H11', '20Hz-20kHz', 'None', '1.5 M.', 'RGB LIGHTING\r\n7.1 VIRTUAL SURROUND SOUND\r\nOVER-EAR DESIGN PERFECT COMFORT\r\nSHORT MICROPHONE ENSURES A CLEAR CONVERSATION\r\nSUPPORT ALL TYPES OF GAMES\r\nPERFECT COMFORT SOFT EAR CUSHION ', ' USB2.0', 'none', 'None', 'none', 'None', '0.50 KG', '5,940.00 cm3', 'Black', '5', 390),
	(63, 33, 1, ' TYPE-H12 BLACK', '20Hz-20kHz', 'None', '1.5m', 'RGB LIGHTING\r\n7.1 VIRTUAL SURROUND SOUND\r\nOVER-EAR DESIGN PERFECT COMFORT\r\nFLEXIBLR MICROPHONE 360 ROTATABLE DEGREE\r\nSUPPORT ALL TYPES OF GAMES\r\nPERFECT COMFORT SOFT EAR CUSHION', ' USB2.0', 'none', 'None', 'none', 'None', '0.50 KG', '5,940.00 cm3', 'Black', '8', 470),
	(64, 31, 3, ' S2022 BLACK - BLUE-SWITCH', ' 1000 Hz', 'None', '1.6 M', 'รองรับการกด 60 ล้านครั้ง\r\nเคส ABS อย่างหนา\r\n เอฟเฟกต์แสงไฟ 20 โหมด\r\n ซอฟต์แวร์ปรับตั้งค่าปุ่ม / 1 โปรไฟล์ / เอฟเฟกต์ไฟ / Macro\r\n ฟังก์ชัน FN ปุ่มลัด Multimedia / เพิ่ม-ลดแสงไฟ', ' USB2.0', 'None', 'None', 'none', 'None', '0.82 KG', '3,895.00 cm3', 'Black', '10', 690),
	(65, 31, 3, 'GREEN/WHITE BLUE-SWITCH', ' 1000 Hz', 'None', '1.65 M', 'Interface : USB 2.0\r\nBack light : RGB\r\nประเภท Key Switch : Mechanical Blue switch\r\nจำนวน Keys : 104 Keys\r\nประเภท Keycap : EN / TH', ' USB2.0', 'none', 'None', 'none', 'None', '1.10 KG', '4,200.00 cm3', 'Blue', '7', 1150),
	(66, 31, 3, ' F99 BLACK WHITE-SWITCH', ' 1000 Hz', 'Bluetooth 5.0', 'None', 'Interface : USB Type-C / Wireless 2.4G / Bluetooth 5.0  \r\nBack Light : RGB\r\nKey Switch : LEOBOG GRAYWOOD V.3 Mechanical Switch\r\nNumber of Keys : 99 Keys\r\nKeycap : EN-TH', ' USB2.0', '5.0', 'None', '	 8,000 mAh', 'None', '1.13 KG', '39.10 x 14.70 x 4.30 cm', 'Black', '10', 2490),
	(67, 31, 3, 'AK205', ' 1000 Hz', 'none', '1.5m', 'Interface : USB 2.0\r\nKeys Windows Layout : 104 Keys\r\nประเภท Keycap : EN / TH\r\nรองรับการกดได้มากกว่า 10ล้านครั้ง\r\nแรงดันกระแสไฟฟ้า DC 5V./ 50mA\r\nดีไซน์กันน้ำ \r\nรองรับ Windows XP/7/8/10/11 /Vista', ' USB2.0', 'none', 'None', 'none', 'None', '0.53 KG', '2,829.00 cm3', 'Black', '6', 190),
	(68, 31, 1, 'F606', '20Hz-20kHz', 'None', '2.1m', 'ลำโพงขนาด 50 มม. / ความต้านทานลำโพง 22 โอมห์\r\nความถี่ 20Hz-20kHz /ความดังเสียง 112 ±3dB\r\nความไวของเสียงไมค์โคโฟน-42dB ±3dB - ปุ่ม Volume Control / ปุ่ม ปิด-เปิด ไมโครโฟน\r\nไมค์โครโฟนตัดสัญญาณเสียงรบกวน', ' USB2.0', 'none', 'None', 'none', 'None', '0.55 KG', '6,949.80 cm3', 'Black', '10', 600),
	(69, 31, 1, 'S503', '20Hz ~ 20kHz', 'none', '2.1 M', 'ลำโพงขนาด 50มม.\r\nที่คาดศีรษะ แสงไฟ RGB \r\nความต้านทานลำโพง 20โอมห์ \r\nความถี่ 20Hz-20kHz /ความดังเสียง 117 ±3dB\r\nความไวของเสียงไมค์โคโฟน-38dB ±3dB\r\nไมค์โครโฟนมีระบบตัดเสียงรบกวน', ' USB2.0', 'none', 'None', 'none', 'None', '0.40 KG', '5,775.00 cm3', 'Black', '9', 650),
	(70, 31, 1, 'S600', '20Hz-20kHz', 'None', '2.1m', 'Connector : USB\r\nFrequency : 20Hz-20kHz\r\nCable Length : 2.1m', ' USB2.0', 'none', 'None', 'none', 'None', '0.64 KG', '7,007.00 cm3', 'Black', '9', 790),
	(80, 50, 28, 'MP-702', '100Hz- 10KHz', '2.2KΩ', 'none', 'FULL DIRECTION\r\nไฟ RGB ปรับได้ 15 โหมดไฟ', ' USB', 'none', 'none', 'none', '-58 ±2dB', 'none', 'none', 'none', '50', 490),
	(88, 31, 28, 'T1', '20Hz-20kHz', 'none', 'none', 'none', ' USB', 'none', 'none', 'none', '-45 ±3dB', '0.70 KG', '3,595.50 cm3', 'none', '18', 890),
	(89, 35, 2, 'LOGITECH G PRO X SUPERLIGHT WHITE', 'none', 'none', 'N/A', '-การเคลื่อนไหวต่อเนื่อง : 70h\r\nขจัดทุกอุปสรรคที่ขวางทางสู่ชัยชนะด้วยเมาส์ PRO ที่เร็วที่สุดและเบาที่สุดของเรา อาวุธใหม่ที่ยอดเยี่ยมสำหรับนักกีฬาอีสปอร์ตระดับมืออาชีพชั้นนำของโลก ด้วยน้ำหนักไม่ถึง 63 กรัม', ' Bluetooth', 'none', '100 - 25,400 DPI', 'N/A', 'none', '0.34 KG', '1,368.50 cm3', 'WHITE', '19', 3990),
	(90, 50, 28, 'MP-706', '20Hz-20KHz', '16 ohms', 'none', 'Support : All Windows Versions & Mac\r\nCord Length : 1.5m', ' USB', 'none', 'none', 'none', '-38dB±3dB', '0.55 KG', '2,916.10 cm3', 'none', '30', 920),
	(91, 34, 28, 'LEVIOSA-MCX01', '20Hz-20kHz', '16 Ohm', 'none', 'Compatibility\r\nOS : Windows. USB Port Required\r\nSoftware : Windows (7 or Newer)', ' USB', 'none', 'none', 'none', '-38dB±3dB', '0.80 KG', '3,600.00 cm3', 'none', '30', 990),
	(92, 51, 28, 'X400 KIT', '20Hz - 20kHz', 'none', 'none', 'Nubwo-X SEEKER Microphone\r\nTripod Stand\r\n360 Degree Stand Adapter\r\nPop filter\r\nScissor arm stand holder\r\nAnti-wind foam cap\r\nUSB TYPE-C cable 1.5 m.', ' USB', 'none', 'none', 'none', 'none', '1.50 KG', '7,717.50 cm3', 'none', '30', 990),
	(93, 52, 28, 'HYPER-X', '20Hz-20kHz', 'none', 'none', 'PC, PS5, PS4 , Mac', ' USB', 'none', 'none', 'none', '-6dBFS', '0.80 KG', '4,186.00 cm3', 'none', '30', 3290),
	(94, 53, 28, 'WAVE 1', '70 - 20000 Hz', 'none', 'none', 'Wave : 1\r\nUSB-C Cable\r\nDesktop Stand\r\nBoom Arm Adapter\r\nQuick Start Guide', ' USB', 'none', 'none', 'none', '-25dBFS', '1.04 KG', '4,402.20 cm3', 'none', '20', 4200),
	(95, 31, 1, 'S506', '20Hz-20kHz', 'none', '2.1 M', 'ปุ่มปรับความดังเสียงข้าง + Y Audio conect\r\nรองรับระบบ Windows XP / 7 / 8 / 10 / Vista / Mac', ' USB', 'none', 'none', 'none', '117 ±3dB', '0.50 KG', '5,775.00 cm3', 'PINK', '40', 740),
	(96, 54, 1, 'K10 RGB', '20 - 20000 Hz', '32Ω ±15%', '2.4 m', '• Mic Directivity : Omnidirectional\r\n• Mic sensitivity : -42±1dB\r\n• Mic impedance : 2.2K ohms\r\nAll windows\r\nK10 RGB\r\nUser Manual\r\n3.5 Jack', ' USB', 'none', 'none', 'none', '105±3dB', '0.53 KG', '5,018.16 cm3', 'BLACK', '28', 790),
	(97, 50, 1, 'HP-836W WARDORF', '20-20000Hz', '16 Ohm ±10%', '2.1m', 'Built - in Remote Controller for easy control Volume Up&Down Microphone & lighting On-Off\r\nAll Windows', ' USB', 'none', 'none', 'none', '111dB±3dB', '0.65 KG', '5,658.80 cm3', 'WHITE', '40', 890),
	(98, 50, 2, 'GM-907', 'none', 'none', '1.5M', '6 Buttons\r\nAll Windows', ' USB', 'none', '4800 DPI', 'none', 'none', '0.18 KG', '1,080.00 cm3', 'BLACK', '50', 290),
	(99, 55, 2, 'TUF Gaming M4 Air', 'none', 'none', 'TUF Gaming Paracord Cable', 'Gaming-grade 16,000 dpi optical sensor for pixel-precise tracking, plus DPI button for four-level sensitivity adjustment\r\nDurable and ultralight 47-gram Air Shell design\r\nIPX6 water repellent protective coating on the printed circuit board assembly (PCBA) guards against accidental spills and moisture', ' USB', 'none', '16000 DPI', 'none', 'none', '0.20 KG', '1,122.00 cm3', 'BLACK', '20', 1290),
	(100, 56, 28, 'SEIREN MINI', '20Hz-20kHz', 'none', 'none', 'Polar Pattern : Supercardioid', ' USB', 'none', 'none', 'none', '17.8 mV/Pa (at 1 kHz)', '0.40 KG', '1,836.00 cm3', 'BLACK', '19', 1290),
	(101, 54, 28, 'M730 RGB', '100 Hz - 10,000 Hz', '2.2K Ohm', 'none', 'ไมโครโฟนแบบตั้งโต๊ะมาพร้อมแสงไฟ RGB ไล่ระดับที่งดงาม ใช้งานง่ายเพียงเสียบสาย USB เข้ากับอุปกรณ์ที่รองรับก็สามารถใช้ทันที เหมาะกับการสตรีมมิ่ง เล่นเกม พอดแคสต์ ฯลฯ มาพร้อมผ่นกันเสียง ให้เสียงที่ชัดเจนและเป็นธรรมชาติ ไมโครโฟนมีขนาดเล็กกระทัดรัดไม่เปลืองพื้นที่ สามารถหมุนปรับองศาของตัวไมค์ให้ตรงกับปากชองผู้ใช้ได้และถอดตัวไมค์ออกจากฐานได้ เปิด-ปิดไมค์ได้ง่าย ๆ เพียงแตะที่สัญลักษณ์ปิดเสียงบนตัวไมค์เบา ๆ', ' USB', 'none', 'none', 'none', '-38±3dB', '0.48 KG', '2,316.41 cm3', 'none', '20', 1190),
	(102, 36, 28, 'QUADCAST S', '20Hz–20kHz', '32 Ω', 'none', '	\r\nLighting\r\nRGB (16,777,216 colors)\r\n\r\nLight effects\r\n2 zones', ' USB', 'none', 'none', 'none', '-36dB (1V/Pa/1kHz)', '1.00 KG', '4,928.00 cm3', 'none', '20', 5990);

-- Dumping structure for table shop_db.tb_type_product
CREATE TABLE IF NOT EXISTS `tb_type_product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table shop_db.tb_type_product: ~3 rows (approximately)
REPLACE INTO `tb_type_product` (`id`, `type`) VALUES
	(1, 'HEADSET'),
	(2, 'MOUSE'),
	(3, 'KEYBOARD'),
	(28, 'MICROPHONE');

-- Dumping structure for table shop_db.tb_users
CREATE TABLE IF NOT EXISTS `tb_users` (
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table shop_db.tb_users: ~9 rows (approximately)
REPLACE INTO `tb_users` (`username`, `password`, `firstname`, `lastname`, `email`, `phone`, `status`) VALUES
	('admin', '$2y$10$QucpdHV0tFpk.y4pV8iMgOdjlRgVKL1M7.SUmap59jrDebkmaN2G6', 'admin', 'rmuti', 'admin@rmuti', '0555555555', 'admin'),
	('au', '$2y$10$XgM9RA7jT/4CNGg.g9DGdeRIFyBvuUWz29mUK0MXTKk2/47uXaTUu', 'สุกฤษฏิ์', 'แสงประสาร', 'sukrit.sa@rmuti.com', '0999999999', 'member'),
	('bass', '$2y$10$i/jCBegZ8bl9bv56xT6TFuWk.1IwO9HUyEASrPuB3xP2QCaMcbG2i', 'ปัญญากร', 'โสมะวงศ์', 'panyakorn@gmail.com', '0888888888', 'member'),
	('bew', '$2y$10$GtUj60MV7tPSiiOWVmjPN.GYeQ.JYSEpztDxq.6I00enBxoTPUPY.', 'ณัฐวุฒิ', 'สถาวรัตนกุล', 'natthawut.sa@rmuti.ac.th', '0222222222', 'member'),
	('copter', '$2y$10$aGhzOD6WkJ18rJMI9ZDpMuMwFsS/3CvW6GqzZyJyNH8OsfovBSmPK', 'กฤตภาส', 'สัมฤทธิ์', 'kritaphat.sa@rmuti.ac.th', '0877777777', 'member'),
	('few', '$2y$10$XtBmDOZXkjvjW4Z9oMl0a.5Z3thHUHrtmC2QE5G6whkpjz1q4lI1.', 'ศิวกร', 'โพธิ์งาม', 'siwakorn.po@rmuti.ac.th', '0666666666', 'member'),
	('fon', '$2y$10$EusIR.TUxYlLTSXlHgw6s.dyQw.jy/i6rNa5TXJhzB0W7K6cP.w/e', 'ชนม์นิภา', 'เวชกิจ', 'chonnipha.wa@rmuti.ac.th', '0456789022', 'member'),
	('kla', '$2y$10$HWCFaIi/E5wkT3BKFP.MCuTtFUi74SiRds6MMaTh8YfVqq4jvJSoO', 'ธัญทร', 'ดีขุนทด', 'tunyatorn.de@rmuti.ac.th', '0333333333', 'member'),
	('nooy', '$2y$10$jLG2e3BiLZWiYQO3drGqn.q6cJeK.zJEGB51PATZS6aHzj5jkW43u', 'อำพล', 'ศรีบัวรายณ์', 'amphon.si@rmuti.ac.th', '0621530741', 'member');

-- Dumping structure for view shop_db.order_list
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `order_list`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `order_list` AS select `tb_order`.`order_id` AS `order_id`,`tb_order`.`order_Date` AS `order_Date`,`tb_order`.`username` AS `username`,concat(`tb_users`.`firstname`,' ',`tb_users`.`lastname`) AS `order_name`,sum(`tb_order_product`.`amount`) AS `sum_amount`,sum((`tb_order_product`.`amount` * `tb_product`.`price`)) AS `sum_price` from (((`tb_order` join `tb_order_product`) join `tb_product`) join `tb_users`) where ((`tb_order`.`order_id` = `tb_order_product`.`order_id`) and (`tb_product`.`product_id` = `tb_order_product`.`product_id`) and (`tb_order`.`username` = `tb_users`.`username`)) group by `tb_order`.`order_id`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
