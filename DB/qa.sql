-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 22 2019 г., 22:09
-- Версия сервера: 10.4.6-MariaDB
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `qa`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `question`, `answer`) VALUES
(2, 'q2', 'a2'),
(17, 'q3', 'a3'),
(18, 'q4', 'a4'),
(19, 'q5', 'a5');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `first_name`, `last_name`, `role`) VALUES
(1, 'test', 'test', 'imya', 'familua', 0),
(2, 'test1', 'test1', 'imya1', 'familua1', 0),
(3, 'test2', 'test2', 'imya2', 'familua2', 0),
(4, '123', '123', '123', '123', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `usertask`
--

CREATE TABLE `usertask` (
  `id` int(11) NOT NULL,
  `id_task` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `result` int(11) DEFAULT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `usertask`
--

INSERT INTO `usertask` (`id`, `id_task`, `id_user`, `result`, `answer`) VALUES
(5, 17, 4, NULL, '12321'),
(8, 17, 1, NULL, '2324'),
(10, 2, 4, NULL, 'a2'),
(11, 18, 4, NULL, 'a4'),
(32, 19, 4, 1, 'a5'),
(33, 2, 4, 1, 'a2'),
(34, 18, 4, 1, 'a3'),
(35, 17, 4, 1, 'a4'),
(36, 17, 4, 0, 'a4'),
(37, 19, 4, 0, 'ad'),
(38, 2, 4, 1, 'a2'),
(43, 2, 1, 0, '1'),
(44, 17, 1, 0, '1'),
(45, 2, 1, 1, 'a2'),
(46, 2, 1, 1, 'a2'),
(47, 19, 1, 1, 'a5'),
(48, 17, 1, 1, 'a3'),
(49, 2, 1, 1, 'a2'),
(50, 19, 1, 0, 'a4'),
(51, 2, 1, 1, 'a2');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `usertask`
--
ALTER TABLE `usertask`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_task` (`id_task`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `usertask`
--
ALTER TABLE `usertask`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `usertask`
--
ALTER TABLE `usertask`
  ADD CONSTRAINT `usertask_ibfk_1` FOREIGN KEY (`id_task`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
