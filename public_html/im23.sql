-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 23 2024 г., 12:04
-- Версия сервера: 5.7.39-log
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `im23`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `menu_position` int(11) DEFAULT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `name`, `parent_id`, `menu_position`, `content`) VALUES
(1, 'art 1', NULL, 1, 'test'),
(2, 'test', NULL, 2, NULL),
(3, 'art 3', NULL, 3, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO catalog (`id`, `name`) VALUES
(1, 'Cat 1'),
(2, 'Cat 2');

-- --------------------------------------------------------

--
-- Структура таблицы `filters`
--

CREATE TABLE `filters` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text,
  `parent_id` int(11) DEFAULT NULL,
  `menu_position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `filters`
--

INSERT INTO `filters` (`id`, `name`, `content`, `parent_id`, `menu_position`) VALUES
(9, 'red', 'content - 0', 17, 1),
(10, 'green', 'content - 1', 17, 2),
(11, '200', NULL, 18, 1),
(12, '300', NULL, 18, 2),
(15, '400', NULL, 18, 3),
(16, 'light-red', NULL, 17, 3),
(17, 'Color', NULL, NULL, 3),
(18, 'Width', NULL, NULL, 4),
(21, 'Height', '', NULL, 4),
(22, '1 px', '', 21, 2),
(25, '2px', '', 21, 1),
(26, '3px', '', 21, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `filters_categories`
--

CREATE TABLE `filters_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `filters_categories`
--

INSERT INTO `filters_categories` (`id`, `name`) VALUES
(1, 'Цвет'),
(2, 'Ширина');

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` text,
  `img` varchar(255) DEFAULT NULL,
  `gallery_img` text,
  `menu_position` int(11) DEFAULT NULL,
  `visible` int(11) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `main_img` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `content`, `img`, `gallery_img`, `menu_position`, `visible`, `keywords`, `date`, `datetime`, `alias`, `main_img`, `parent_id`) VALUES
(21, 'test', '<p><img title=\"orig (1).webp\" src=\"/userfiles/goods/content_file/orig-1webp.webp\" alt=\"\" width=\"500\" height=\"499\" /></p>', '2.jpg', '[\"frame-19.jpg\",\"img20230426183137.jpg\",\"frame-25.jpg\"]', 2, 1, 'dwd', '2024-04-11', '2024-04-11 04:59:36', 'good-3', 'frame-31_3230bbc4.png', 1),
(22, 'test imge', '', 'goods/orig-1.webp', '{\"0\":\"frame-22.jpg\",\"2\":\"frame-23.jpg\"}', 1, 1, '', '2024-04-11', '2024-04-11 04:44:05', 'test-imge', NULL, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `goods_filters`
--

CREATE TABLE `goods_filters` (
  `filters_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `goods_filters`
--

INSERT INTO `goods_filters` (`filters_id`, `goods_id`) VALUES
(10, 21),
(12, 21),
(16, 21),
(25, 21);

-- --------------------------------------------------------

--
-- Структура таблицы `old_alias`
--

CREATE TABLE `old_alias` (
  `alias` varchar(255) DEFAULT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `table_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `new_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `name`, `new_name`) VALUES
(1, 'test', NULL),
(2, 'page 2', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `parsing_data`
--

CREATE TABLE `parsing_data` (
  `all_links` longtext,
  `temp_links` longtext,
  `bad_links` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `parsing_data`
--

INSERT INTO `parsing_data` (`all_links`, `temp_links`, `bad_links`) VALUES
('', '', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_pages_id_fk` (`parent_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE catalog
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `filters`
--
ALTER TABLE `filters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filters_filters_id_fk` (`parent_id`);

--
-- Индексы таблицы `filters_categories`
--
ALTER TABLE `filters_categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goods_categories_id_fk` (`parent_id`);

--
-- Индексы таблицы `goods_filters`
--
ALTER TABLE `goods_filters`
  ADD PRIMARY KEY (`filters_id`,`goods_id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE catalog
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `filters`
--
ALTER TABLE `filters`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `filters_categories`
--
ALTER TABLE `filters_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_pages_id_fk` FOREIGN KEY (`parent_id`) REFERENCES `pages` (`id`);

--
-- Ограничения внешнего ключа таблицы `filters`
--
ALTER TABLE `filters`
  ADD CONSTRAINT `filters_filters_id_fk` FOREIGN KEY (`parent_id`) REFERENCES `filters` (`id`);

--
-- Ограничения внешнего ключа таблицы `goods`
--
ALTER TABLE `goods`
  ADD CONSTRAINT `goods_categories_id_fk` FOREIGN KEY (`parent_id`) REFERENCES catalog (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
