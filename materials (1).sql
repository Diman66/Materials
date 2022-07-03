-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июл 03 2022 г., 19:28
-- Версия сервера: 10.4.21-MariaDB
-- Версия PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `materials`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Деловые/Бизнес-процессы'),
(2, 'Деловые/Найм'),
(3, 'Деловые/Реклама'),
(4, 'Деловые/Управление бизнесом'),
(5, 'Деловые/Управление людьми'),
(6, 'Деловые/Управление проектами'),
(7, 'Детские/Воспитание'),
(8, 'Дизайн/Общее'),
(9, 'Дизайн/Logo'),
(10, 'Дизайн/Web дизайн'),
(11, 'Разработка/PHP'),
(12, 'Разработка/HTML и CSS'),
(13, 'Разработка/Проектирование');

-- --------------------------------------------------------

--
-- Структура таблицы `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `autor` varchar(200) NOT NULL,
  `id_type` varchar(200) NOT NULL,
  `id_category` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `materials`
--

INSERT INTO `materials` (`id`, `name`, `autor`, `id_type`, `id_category`, `description`, `slug`) VALUES
(1, 'Путь джедая', 'Максим Дорофеев', '1', '1', '', 'put'),
(2, 'Полное руководство по Yii 2.0', 'Александр Макаров', '2', '2', 'hjn', 'dfg'),
(20, 'жизнь', 'xcfghjk,.', '1', '2', 'fghjk,.', 'zhizn'),
(21, 'fghjkl', '', '3', '1', '', 'fghjkl');

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'Продуктивность'),
(2, 'Эффективность');

-- --------------------------------------------------------

--
-- Структура таблицы `tags_material`
--

CREATE TABLE `tags_material` (
  `id` int(11) NOT NULL,
  `id_tags` int(11) NOT NULL,
  `id_material` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tags_material`
--

INSERT INTO `tags_material` (`id`, `id_tags`, `id_material`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `type_materials`
--

CREATE TABLE `type_materials` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `type_materials`
--

INSERT INTO `type_materials` (`id`, `name`) VALUES
(1, 'Книга'),
(2, 'Статья'),
(3, 'Видео'),
(4, 'Сайт/Блог'),
(5, 'Подборка'),
(6, 'Ключевые идеи книги');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Индексы таблицы `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tags_material`
--
ALTER TABLE `tags_material`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `type_materials`
--
ALTER TABLE `type_materials`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `tags_material`
--
ALTER TABLE `tags_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `type_materials`
--
ALTER TABLE `type_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
