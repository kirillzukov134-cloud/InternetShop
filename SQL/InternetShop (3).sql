-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 08 2026 г., 11:55
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
(3, 'Кирилл', 'kirillzukov134@gmail.com', '89996457959'),
(4, '1212', 'werewrw@gmail.com', '89371244878'),
(5, 'Даня', 'mojebkura1488@gmail.com', '+7 996 472-30-21');

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
(25, 3, '2026-10-08 11:06:28', '113995.00', 'Активный'),
(26, 5, '2026-10-08 11:23:53', '5850.00', 'Активный'),
(27, 4, '2026-10-08 11:32:40', '113995.00', 'Активный'),
(28, 4, '2026-10-08 11:39:58', '11700.00', 'Активный'),
(29, 3, '2026-10-08 11:48:37', '1170.00', 'Активный'),
(30, 3, '2026-10-08 11:50:50', '1170.00', 'Активный'),
(31, 4, '2026-10-08 11:52:35', '220000.00', 'Активный'),
(32, 5, '2026-10-08 11:53:44', '55000.00', 'Активный'),
(33, 4, '2026-10-08 11:54:13', '110000.00', 'Активный'),
(34, 3, '2026-10-08 11:54:33', '660000.00', 'Активный'),
(35, 4, '2026-10-08 11:54:48', '55000.00', 'Активный');

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
(16, 1, '113995.00', 2, 25),
(17, 5, '1170.00', 3, 26),
(18, 1, '113995.00', 2, 27),
(19, 10, '1170.00', 3, 28),
(20, 1, '1170.00', 3, 29),
(21, 1, '1170.00', 3, 30),
(22, 4, '55000.00', 5, 31);

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
(2, 'Sumsung S26 Ultra (12 ГБ / 256 ГБ)', '113990', '6', 1),
(3, 'футболки с принтом «Пивные войска»', '1175', '12', 1),
(5, 'Стиральная машина ', '55000', '0', 8);

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
(8, 'Бытовая техника');

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
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id`, `name`, `email`, `phone`, `password`, `role`, `client_id`) VALUES
(1, 'Кирилл', 'kirillzukov134@gmail.com', '89996457959', '$2y$10$dNpv2O8z6wGgx24L2hsJfu3UHBJciDxD2ZSxeoQJsrzdZJABOX8h.', 'Admin', 3),
(2, '1212', 'Zulfianurekenova@gmail.com', '89371244878', '$2y$10$Cw6nQBNakv1Tw4yE0DmEiOqTLjvmmJbYdkvQWS4VNbceeMZI2XmuC', 'User', 4),
(3, 'dgsgfsf', 'aefwrwewe@gmail.com', '89371244878', '$2y$10$t.A18KAt0sCjZhA95pUteeKBPnTG/NSQN3/y0whkmfcTCa/B5zK3K', 'User', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `Order_position`
--
ALTER TABLE `Order_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `Product`
--
ALTER TABLE `Product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Product_category`
--
ALTER TABLE `Product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
