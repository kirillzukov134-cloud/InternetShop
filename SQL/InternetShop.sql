-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 11 2026 г., 21:05
-- Версия сервера: 5.7.39
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `InternetShop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Clients`
--

CREATE TABLE `Clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(65) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Clients`
--

INSERT INTO `Clients` (`id`, `name`, `email`, `phone`) VALUES
(3, 'Кирилл', 'kirillzukov134@gmail.com', '+7 999 645-79-59'),
(4, '1212', 'werewrw@gmail.com', '89371244878'),
(10, '1213123', '123131@gmail.com', '21321321');

-- --------------------------------------------------------

--
-- Структура таблицы `Orders`
--

CREATE TABLE `Orders` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `total_amount` decimal(15,2) DEFAULT NULL,
  `status` enum('Активный','В процессе','Завершён','Прервано') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Orders`
--

INSERT INTO `Orders` (`id`, `client_id`, `created_at`, `total_amount`, `status`) VALUES
(18, 3, '2026-10-07 21:17:46', '1170.00', 'Прервано'),
(19, 3, '2026-10-07 21:18:33', '110000.00', 'Прервано'),
(21, 4, '2026-10-07 23:39:05', '113995.00', 'В процессе'),
(22, 4, '2026-10-07 23:39:52', '227990.00', 'Активный'),
(23, 3, '2026-10-10 17:45:41', '0.00', 'Прервано');

-- --------------------------------------------------------

--
-- Структура таблицы `Order_position`
--

CREATE TABLE `Order_position` (
  `id` int(11) NOT NULL,
  `quanitity` int(11) NOT NULL,
  `purchase_at_price` decimal(15,2) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Order_position`
--

INSERT INTO `Order_position` (`id`, `quanitity`, `purchase_at_price`, `product_id`, `order_id`) VALUES
(7, 1, '1170.00', 3, 18),
(8, 2, '55000.00', 4, 19),
(12, 1, '113995.00', 2, 21),
(13, 2, '113995.00', 2, 22);

-- --------------------------------------------------------

--
-- Структура таблицы `Product`
--

CREATE TABLE `Product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `remains` decimal(10,0) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Product`
--

INSERT INTO `Product` (`id`, `name`, `price`, `remains`, `category_id`) VALUES
(2, 'Sumsung S26 Ultra (12 ГБ / 256 ГБ)', '113995', '10', 3),
(3, 'Футболки с принтом «Пивные войска»', '1185', '5', 1),
(4, 'Стиральная машина', '55000', '15', 8),
(5, 'Grand The Auto V', '1500', '3', 9);

-- --------------------------------------------------------

--
-- Структура таблицы `Product_category`
--

CREATE TABLE `Product_category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Product_category`
--

INSERT INTO `Product_category` (`id`, `category`) VALUES
(1, 'Одежда'),
(2, 'Книга'),
(3, 'Электроника'),
(8, 'Бытовая техника'),
(9, 'Игры');

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Admin','User') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `is_blocked` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id`, `name`, `email`, `phone`, `password`, `role`, `client_id`, `is_blocked`) VALUES
(1, 'Кирилл', 'kirillzukov134@gmail.com', '89996457959', '$2y$10$dNpv2O8z6wGgx24L2hsJfu3UHBJciDxD2ZSxeoQJsrzdZJABOX8h.', 'Admin', 3, 0),
(2, '1212', 'Zulfianurekenova@gmail.com', '89371244878', '$2y$10$Cw6nQBNakv1Tw4yE0DmEiOqTLjvmmJbYdkvQWS4VNbceeMZI2XmuC', 'User', 4, 0),
(6, '1213123', '123131@gmail.com', '21321321', '$2y$10$i9sHdQ4DxBZoFPTHFi0OJu2FpyapA5mQ0/DZAkFNmdeB0hkCX2YZC', 'User', 10, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Clients`
--
ALTER TABLE `Clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Индексы таблицы `Order_position`
--
ALTER TABLE `Order_position`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Индексы таблицы `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `Product_category`
--
ALTER TABLE `Product_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `client_id` (`client_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Clients`
--
ALTER TABLE `Clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `Order_position`
--
ALTER TABLE `Order_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `Product`
--
ALTER TABLE `Product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Product_category`
--
ALTER TABLE `Product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `Clients` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `Order_position`
--
ALTER TABLE `Order_position`
  ADD CONSTRAINT `order_position_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_position_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `Orders` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Product`
--
ALTER TABLE `Product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `Product_category` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Users`
--
ALTER TABLE `Users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `Clients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
