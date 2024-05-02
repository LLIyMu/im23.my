-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 02 2024 г., 13:53
-- Версия сервера: 8.0.30
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
-- Структура таблицы `advantages`
--

CREATE TABLE `advantages` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `menu_position` int DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `advantages`
--

INSERT INTO `advantages` (`id`, `name`, `img`, `menu_position`, `visible`) VALUES
(1, 'Преимущество 1', 'advantages/adv1.png', 1, 0),
(2, 'Преимущество 2', 'advantages/adv2.png', 2, 1),
(3, 'Преимущество 3', 'advantages/adv3.png', 3, 1),
(4, 'Преимущество 4', 'advantages/adv4.png', 4, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `menu_position` int DEFAULT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `name`, `parent_id`, `menu_position`, `content`) VALUES
(1, 'art 1', NULL, 1, 'test'),
(3, 'art 3', NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `blocked_access`
--

CREATE TABLE `blocked_access` (
  `id` int NOT NULL,
  `login` varchar(255) DEFAULT NULL,
  `ip` varchar(32) DEFAULT NULL,
  `trying` tinyint(1) DEFAULT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `catalog`
--

CREATE TABLE `catalog` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `keywords` varchar(400) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `menu_position` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `catalog`
--

INSERT INTO `catalog` (`id`, `name`, `keywords`, `description`, `alias`, `img`, `visible`, `parent_id`, `menu_position`) VALUES
(1, 'Cat 1', '', '', 'cat-1', NULL, 1, NULL, 2),
(2, 'Cat 2', '', '', 'cat-2', NULL, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `filters`
--

CREATE TABLE `filters` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text,
  `parent_id` int DEFAULT NULL,
  `menu_position` int DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `filters`
--

INSERT INTO `filters` (`id`, `name`, `content`, `parent_id`, `menu_position`, `visible`) VALUES
(9, 'red', 'content - 0', 17, 1, 1),
(10, 'green', 'content - 1', 17, 2, 1),
(11, '200', NULL, 18, 1, 1),
(12, '300', NULL, 18, 2, 1),
(15, '400', NULL, 18, 3, 1),
(16, 'light-red', NULL, 17, 3, 1),
(17, 'Color', NULL, NULL, 3, 1),
(18, 'Width', NULL, NULL, 4, 1),
(21, 'Height', '', NULL, 4, 1),
(22, '1 px', '', 21, 2, 1),
(25, '2px', '', 21, 1, 1),
(26, '3px', '', 21, 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `filters_categories`
--

CREATE TABLE `filters_categories` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` text,
  `img` varchar(255) DEFAULT NULL,
  `gallery_img` text,
  `menu_position` int DEFAULT NULL,
  `visible` int DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `main_img` varchar(255) DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `price` float DEFAULT '0',
  `hit` int DEFAULT '0',
  `sale` int DEFAULT '0',
  `new` int DEFAULT '0',
  `hot` int DEFAULT '0',
  `discount` int DEFAULT '0',
  `short_content` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `content`, `img`, `gallery_img`, `menu_position`, `visible`, `keywords`, `date`, `datetime`, `alias`, `main_img`, `parent_id`, `price`, `hit`, `sale`, `new`, `hot`, `discount`, `short_content`) VALUES
(21, 'test', '<p><img title=\"orig (1).webp\" src=\"/userfiles/goods/content_file/orig-1webp.webp\" alt=\"\" width=\"500\" height=\"499\" /></p>', '2.jpg', '[\"frame-19.jpg\",\"img20230426183137.jpg\",\"frame-25.jpg\"]', 1, 1, 'dwd', '2024-05-02', '2024-05-02 05:29:50', 'test', 'frame-31_3230bbc4.png', 1, 15, 1, 1, 0, 0, 5, 'Какое то описание'),
(22, 'test imge', '', 'goods/orig-1.webp', '[\"frame-22.jpg\",\"frame-23.jpg\"]', 3, 1, '', '2024-05-01', '2024-05-01 08:43:41', 'test-imge', NULL, 2, 25, 0, 0, 1, 0, 0, NULL),
(23, 'Digitronic', '<p>Фильтр гбо</p>', 'goods/frame-31.png', '[\"goods\\/frame-31_9277aa53.png\",\"goods\\/frame-27.png\",\"goods\\/frame-29.png\",\"goods\\/frame-28.png\",\"goods\\/frame-27_7f256d3f.png\",\"goods\\/frame-28_8ae5d128.png\",\"goods\\/frame-29_62b5c883.png\"]', 2, 1, '', '2024-05-01', '2024-05-01 08:44:38', 'digitronic', 'goods/filtr.png', 2, 30, 1, 0, 0, 0, 0, NULL),
(24, 'Кофе', '', 'goods/1.jpg', '[\"goods\\/1_fd064095.jpg\",\"goods\\/2.jpg\",\"goods\\/3.jpg\"]', 1, 1, '', '2024-05-02', '2024-05-02 05:30:03', 'kofe', NULL, 2, 150, 0, 0, 0, 1, 50, 'Какое то описание опять');

-- --------------------------------------------------------

--
-- Структура таблицы `goods_filters`
--

CREATE TABLE `goods_filters` (
  `filters_id` int NOT NULL,
  `goods_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `goods_filters`
--

INSERT INTO `goods_filters` (`filters_id`, `goods_id`) VALUES
(9, 24),
(10, 21),
(10, 22),
(10, 23),
(10, 24),
(11, 23),
(12, 21),
(12, 22),
(12, 24),
(15, 24),
(16, 21),
(22, 22),
(25, 21),
(25, 22),
(25, 24),
(26, 22),
(26, 23);

-- --------------------------------------------------------

--
-- Структура таблицы `information`
--

CREATE TABLE `information` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `keywords` varchar(400) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  `menu_position` int DEFAULT NULL,
  `show_top_menu` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `information`
--

INSERT INTO `information` (`id`, `name`, `alias`, `keywords`, `description`, `visible`, `menu_position`, `show_top_menu`) VALUES
(1, 'Оплата и доставка', 'oplata-i-dostavka', '', '', 1, 2, 1),
(2, 'Акции и скидки', 'aktsii-i-skidki', '', '', 1, 1, 1),
(3, 'Политика конфиденциальности', 'politika-konfidentsialnosti', '', '', 1, 3, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `short_content` varchar(400) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_general_ci,
  `visible` tinyint(1) DEFAULT '1',
  `alias` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `name`, `date`, `short_content`, `content`, `visible`, `alias`) VALUES
(1, 'Новость 1', '2024-05-02', 'Описание новости 1 и снова новость 1', '<p>Описание новости 1 и снова новость 1Описание новости 1 и снова новость 1Описание новости 1 и снова новость 1Описание новости 1 и снова новость 1Описание новости 1 и снова новость 1Описание новости 1 и снова новость 1Описание новости 1 и снова новость 1Описание новости 1 и снова новость 1Описание новости 1 и снова новость 1</p>', 1, NULL),
(2, 'Новость 2', '2024-06-03', 'Описание новости 2и снова новость 2', '<p>Описание новости 2и снова новость 2Описание новости 2и снова новость 2Описание новости 2и снова новость 2Описание новости 2и снова новость 2Описание новости 2и снова новость 2</p>', 1, NULL),
(3, 'Новость 3', '2024-05-02', 'Описание новости 3 и снова новость 3', '<p>Описание новости 3 и снова новость 3Описание новости 3 и снова новость 3Описание новости 3 и снова новость 3Описание новости 3 и снова новость 3Описание новости 3 и снова новость 3Описание новости 3 и снова новость 3Описание новости 3 и снова новость 3</p>', 1, NULL),
(4, 'Новость 4', '2024-05-02', 'Описание новости 4 и снова новость 4 ', '<p>Описание новости 4 и снова новость 4 Описание новости 4 и снова новость 4 Описание новости 4 и снова новость 4 Описание новости 4 и снова новость 4 Описание новости 4 и снова новость 4 Описание новости 4 и снова новость 4 Описание новости 4 и снова новость 4 Описание новости 4 и снова новость 4 Описание новости 4 и снова новость 4 Описание новости 4 и снова новость 4&nbsp;</p>', 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `old_alias`
--

CREATE TABLE `old_alias` (
  `alias` varchar(255) DEFAULT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `table_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `old_alias`
--

INSERT INTO `old_alias` (`alias`, `table_name`, `table_id`) VALUES
('good-3', 'goods', 21);

-- --------------------------------------------------------

--
-- Структура таблицы `parsing_data`
--

CREATE TABLE `parsing_data` (
  `all_links` longtext,
  `temp_links` longtext,
  `bad_links` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `parsing_data`
--

INSERT INTO `parsing_data` (`all_links`, `temp_links`, `bad_links`) VALUES
('', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `sales`
--

CREATE TABLE `sales` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `menu_position` int DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `external_alias` varchar(255) DEFAULT NULL,
  `short_content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `sales`
--

INSERT INTO `sales` (`id`, `name`, `sub_title`, `menu_position`, `visible`, `img`, `external_alias`, `short_content`) VALUES
(1, 'Акция 1', 'Продажа', 1, 1, 'sales/1.jpg', '/catalog/autozapchasti', 'Мы что то продаём'),
(2, 'Акция 2', 'Услуга', 2, 1, 'sales/4ehaqclh78m.jpg', '/catalog/usluga', 'Мы предлагаем услуги');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `keywords` varchar(400) DEFAULT NULL,
  `description` varchar(400) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `address` varchar(400) DEFAULT NULL,
  `img_years` varchar(255) DEFAULT NULL,
  `number_of_years` varchar(255) DEFAULT NULL,
  `content` text,
  `short_content` text,
  `promo_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `name`, `keywords`, `description`, `phone`, `email`, `img`, `address`, `img_years`, `number_of_years`, `content`, `short_content`, `promo_img`) VALUES
(1, 'АвтоЗапчасти', '', '', '8(951)9511119', 'pbc1@mail.ru', 'settings/logo.svg', 'г. Лысьва ул. Перовской д 26 Б', 'settings/15.svg', '15', '<p>Привет мир пока земля !</p>', 'Какое то краткое описание контента !!!', 'settings/about.png');

-- --------------------------------------------------------

--
-- Структура таблицы `socials`
--

CREATE TABLE `socials` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `external_alias` varchar(255) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  `menu_position` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `socials`
--

INSERT INTO `socials` (`id`, `name`, `img`, `external_alias`, `visible`, `menu_position`) VALUES
(1, 'VK', 'socials/1486147202-social-media-circled-network10_79475.png', 'https://vk.com', 1, 1),
(2, 'instagramm', 'socials/1491580635-yumminkysocialmedia26_83102.png', 'https://instagramm.com', 1, 2),
(3, 'youtube', 'socials/1486147197-social-media-circled-network04_79460.png', 'https://youtube.com', 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `credentials` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `login`, `password`, `credentials`) VALUES
(1, 'admin', 'admin', '202cb962ac59075b964b07152d234b70', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `advantages`
--
ALTER TABLE `advantages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `blocked_access`
--
ALTER TABLE `blocked_access`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `catalog`
--
ALTER TABLE `catalog`
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
-- Индексы таблицы `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `advantages`
--
ALTER TABLE `advantages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `blocked_access`
--
ALTER TABLE `blocked_access`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `catalog`
--
ALTER TABLE `catalog`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `filters`
--
ALTER TABLE `filters`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `filters_categories`
--
ALTER TABLE `filters_categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `information`
--
ALTER TABLE `information`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `filters`
--
ALTER TABLE `filters`
  ADD CONSTRAINT `filters_filters_id_fk` FOREIGN KEY (`parent_id`) REFERENCES `filters` (`id`);

--
-- Ограничения внешнего ключа таблицы `goods`
--
ALTER TABLE `goods`
  ADD CONSTRAINT `goods_categories_id_fk` FOREIGN KEY (`parent_id`) REFERENCES `catalog` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
