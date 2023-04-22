-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 22 Nis 2023, 17:03:28
-- Sunucu sürümü: 10.4.25-MariaDB
-- PHP Sürümü: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `hajans-test-case`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Default', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` decimal(19,4) NOT NULL,
  `image_url` varchar(2048) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `weight` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `image_url`, `color`, `size`, `weight`) VALUES
(44, '1', '1', 1, 1.5000, NULL, 'red', '1', 1.00),
(45, '1', '1', 1, 1.5000, NULL, 'red', '1', 1.00),
(46, '1', '1', 1, 1.5000, NULL, 'red', '1', 1.00),
(47, '1', '1', 1, 1.5000, NULL, 'red1', '1', 1.00),
(48, '1', '1', 1, 1.5000, NULL, 'red', '1', 1.00),
(49, '1', '1', 1, 1.5000, NULL, 'red', '1', 1.00),
(50, '1', '1', 1, 1.5000, NULL, 'red', '1', 1.00),
(51, '1', '1', 1, 1.5000, NULL, 'red', '1', 1.00),
(52, '1', '1', 1, 1.5000, NULL, 'red', '1', 1.00),
(53, '1', '1', 1, 1.5000, NULL, 'red', '1', 1.00),
(54, '1', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(55, '1', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(56, '1', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(57, '1', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(58, '1', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(59, '1', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(60, '1', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(61, '1', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(62, '1', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(63, '1', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(64, '1', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(65, '1', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(66, '1', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(67, '1', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(68, '1', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(69, '1', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(70, '1', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(71, '1', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(72, '1', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(73, '1', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(74, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(75, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(76, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(77, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(78, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(79, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(80, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(81, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(82, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(83, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(84, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(85, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(86, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(87, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(88, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(89, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(90, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(91, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(92, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(93, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(94, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(95, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(96, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(97, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(98, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(99, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(100, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(101, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(102, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(103, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(104, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 1.00),
(105, 'test', '1', 1, 1.5000, NULL, 'red11', '1', 123.00);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `stock_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `stocks`
--

INSERT INTO `stocks` (`id`, `product_id`, `stock_count`) VALUES
(1, 71, 2),
(6, 74, 2),
(7, 75, 2),
(8, 76, 2),
(9, 77, 2),
(10, 78, 2),
(11, 80, 2),
(12, 81, 2),
(13, 82, 2),
(14, 83, 2),
(15, 84, 2),
(16, 85, 2),
(17, 86, 2),
(18, 87, 2),
(19, 88, 2),
(20, 89, 2),
(21, 90, 2),
(22, 91, 2),
(23, 92, 2),
(24, 93, 2),
(25, 94, 2),
(26, 95, 2),
(27, 96, 2),
(28, 97, 2),
(29, 98, 2),
(30, 99, 2),
(31, 100, 0),
(32, 101, 0),
(33, 102, 0),
(34, 103, 0),
(35, 104, 2),
(36, 105, 551);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_ibfk_2` (`category_id`);

--
-- Tablo için indeksler `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- Tablo için AUTO_INCREMENT değeri `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
