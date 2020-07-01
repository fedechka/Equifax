-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июл 01 2020 г., 16:14
-- Версия сервера: 8.0.20-cluster
-- Версия PHP: 7.3.14-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii2basic`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_birth` date DEFAULT NULL,
  `biography` text NOT NULL,
  `date_create` timestamp NULL DEFAULT NULL,
  `date_change` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `name`, `date_birth`, `biography`, `date_create`, `date_change`) VALUES
(1, 'Александр Пушкин', '1799-05-26', 'Убит на дуэли', '2020-07-01 06:21:04', '2020-07-01 07:22:23'),
(2, 'Михаил Лермонтов', '1814-10-03', 'Тоже был убит на дуэли', '2020-07-01 06:21:04', '2020-07-01 06:21:04'),
(3, 'Ягья Наджи Сулейманович Байбуртлы', '1876-01-01', 'крымскотатарский писатель, лингвист, педагог. Автор учебника крымскотатарского языка. Репрессирован в 1937 году. Посмертно реабилитирован в 1957 году.', '2020-07-01 06:22:21', '2020-07-01 06:22:21'),
(5, 'Ted I. Rodiontsev', '1981-12-12', 'Соискатель', '2020-07-01 07:28:50', '2020-07-01 07:28:50');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_manuf` datetime DEFAULT NULL,
  `author_id` int NOT NULL,
  `date_create` timestamp NULL DEFAULT NULL,
  `date_change` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `name`, `date_manuf`, `author_id`, `date_create`, `date_change`) VALUES
(2, 'Сказка о Царе Салтане2', '2000-03-08 00:00:00', 1, '2020-07-01 08:38:16', '2020-07-01 10:07:24'),
(3, 'Рассказы о металлах', '1985-09-24 00:00:00', 5, '2020-07-01 11:23:44', '2020-07-01 11:23:44'),
(4, 'Рыбы России, т.1', '2010-05-01 00:00:00', 5, '2020-07-01 11:25:35', '2020-07-01 11:25:35'),
(5, 'Рыбы России, т.2', '2010-05-01 00:00:00', 5, '2020-07-01 11:26:00', '2020-07-01 11:26:00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
