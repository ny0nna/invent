-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Дек 15 2022 г., 14:59
-- Версия сервера: 10.6.5-MariaDB-1:10.6.5+maria~focal
-- Версия PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `541-19_invent`
--

-- --------------------------------------------------------

--
-- Структура таблицы `checkprod`
--

CREATE TABLE `checkprod` (
  `id_ch` int(11) NOT NULL,
  `id_t` int(11) NOT NULL,
  `id_u` int(11) NOT NULL,
  `date_start` enum('ОК','ОШИБКА') NOT NULL,
  `date_end` enum('ОК','Подходит к концу','ПРОСРОЧЕНО') NOT NULL,
  `num` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `checkprod`
--

INSERT INTO `checkprod` (`id_ch`, `id_t`, `id_u`, `date_start`, `date_end`, `num`) VALUES
(4, 5, 3, 'ОК', 'ОК', 200),
(5, 3, 9, 'ОК', 'ОК', 300),
(6, 6, 8, 'ОК', 'ОК', 300);

-- --------------------------------------------------------

--
-- Структура таблицы `doc`
--

CREATE TABLE `doc` (
  `id_doc` int(11) NOT NULL,
  `id_u` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `doc`
--

INSERT INTO `doc` (`id_doc`, `id_u`, `name`) VALUES
(5, 2, 'a6a674d67522fe5e2c726680be98d9a1928ca4a9cb1824bef16ec743460f9b8c.docx'),
(6, 9, 'a6a674d67522fe5e2c726680be98d9a1928ca4a9cb1824bef16ec743460f9b8c.docx'),
(7, 6, 'a6a674d67522fe5e2c726680be98d9a1928ca4a9cb1824bef16ec743460f9b8c.docx');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id_t` int(11) NOT NULL,
  `t_name` varchar(100) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id_t`, `t_name`, `date_start`, `date_end`, `num`) VALUES
(3, 'Хлебъ', '2022-01-01', '2022-01-10', 25),
(5, 'Вода', '2022-05-14', '2023-08-07', 200),
(6, 'Вода aqua', '2022-05-14', '2023-08-07', 200),
(9, 'Вода св источник', '2022-05-14', '2023-08-07', 200),
(10, 'Вода св источник', '2022-05-14', '2023-08-07', 200);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id_u` int(11) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `login` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `otchestvo` varchar(50) DEFAULT NULL,
  `email` varchar(70) NOT NULL,
  `phone` bigint(11) NOT NULL,
  `password` varchar(200) NOT NULL,
  `age` int(11) NOT NULL,
  `pol` enum('М','Ж') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id_u`, `token`, `login`, `first_name`, `last_name`, `otchestvo`, `email`, `phone`, `password`, `age`, `pol`) VALUES
(2, 'q3GtJtRD1lIedqVvWwZnvubM4zSOHb3N', 'Ivanov_I_I', 'Иван', 'Иванов', 'Иванович', 'test@gmail.com', 79999999999, '$2y$13$iYrLkXsNwjC7Mk0cdX8eVON.0/fB848QT0R407/CaIt4v7RJe.d16', 19, 'М'),
(3, '9rr4dz51p5T-MZT5WeHQD_amDiICdI5H', 'kaytryna_buk', 'Кактерина', 'Букасова', 'Фисташковна', 'test2@gmail.com', 79999999988, '$2y$13$K16xlaUsfCwznJS5GKAXxu2VrfwTrZ6kynilZwZ8r40FzhYYX9a1a', 20, 'Ж'),
(6, 'JfghjHGFD90Tbnm', 'Petrov_P_I', 'Петр', 'Петров', 'Иванович', 'test3@gmail.com', 79999999977, '$2y$13$v8fsNAe0yMijNkQTM7KNWOqLvqvHoehv5sAmVa5NAtiisDSWvGRbu', 34, 'М'),
(7, 'OIUhbnm5c5drtyhssdfGHj', 'BOSS_OF_GYM', 'Билли', 'Херрингтон', 'Владимирович', 'BOSS@gmail.com', 78005553555, '$2y$13$oWQudvifngoL8eetZU5FFOyseq3MupW7qk25A0HAWajvTFhlT9Fbu', 39, 'М'),
(8, 'ERTynbvcfgHJK45HTdcvb', 'ВМВВч', 'CCSDVSDVSDVSDV', 'GHFHFBB', NULL, 'dsfsdfsghgdxvfdb@gmail.com', 79650304250, 'fvfdvdfvszd', 20, 'Ж'),
(9, 'r8vHke88BlhM2wzCNq7sLwmO_H_YatY2', 'DUNGEON MASTER', 'Даркхолм', 'Ван', NULL, 'MASTER@gmail.com', 78005553554, '$2y$13$3Q76ok7OPX17aKz.5ouN9uHpO97.nGjX.W6deyRT7S3K3Q/9f33o.', 50, 'М'),
(10, NULL, 'Mafioznic', 'Михаил', 'Зубенко', '', 'mafia@gmail.com', 78005553513, '$2y$13$SiEpuQM4qTlg45P4PJnOk.lGlgA99BRtfqWMRh7eHZWbD3lPt0/ZG', 60, 'М');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `checkprod`
--
ALTER TABLE `checkprod`
  ADD PRIMARY KEY (`id_ch`),
  ADD UNIQUE KEY `id_t` (`id_t`),
  ADD UNIQUE KEY `id_u` (`id_u`);

--
-- Индексы таблицы `doc`
--
ALTER TABLE `doc`
  ADD PRIMARY KEY (`id_doc`),
  ADD UNIQUE KEY `id_u` (`id_u`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_t`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_u`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `checkprod`
--
ALTER TABLE `checkprod`
  MODIFY `id_ch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `doc`
--
ALTER TABLE `doc`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id_t` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `checkprod`
--
ALTER TABLE `checkprod`
  ADD CONSTRAINT `checkprod_ibfk_1` FOREIGN KEY (`id_t`) REFERENCES `product` (`id_t`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `checkprod_ibfk_2` FOREIGN KEY (`id_u`) REFERENCES `user` (`id_u`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `doc`
--
ALTER TABLE `doc`
  ADD CONSTRAINT `doc_ibfk_1` FOREIGN KEY (`id_u`) REFERENCES `user` (`id_u`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
