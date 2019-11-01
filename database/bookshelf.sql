-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 31 2019 г., 21:24
-- Версия сервера: 10.4.8-MariaDB
-- Версия PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bookshelf`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(1, 'Абай Кунанбаев'),
(2, 'Еркін Қыдыр'),
(3, 'О.К. Жанайдаров'),
(4, 'О. Памук'),
(5, 'Т. Жумаханов, Б. Жуматаев'),
(6, 'Е. Жайнаков'),
(7, 'Дмитрий Глуховский'),
(8, 'Стивен Кинг'),
(9, 'Мишель Обама'),
(10, 'Gillian Flinn');

-- --------------------------------------------------------

--
-- Структура таблицы `bindings`
--

CREATE TABLE `bindings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `bindings`
--

INSERT INTO `bindings` (`id`, `name`) VALUES
(1, 'Твердый'),
(2, 'Мягкая обложка'),
(3, 'Переплет из картона'),
(4, 'Интегральный переплет'),
(5, 'Папка'),
(6, 'Суперобложка');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `pages` smallint(6) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `language_id` int(11) NOT NULL,
  `binding_id` int(11) NOT NULL,
  `weight` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `name`, `image`, `pages`, `isbn`, `language_id`, `binding_id`, `weight`) VALUES
(1, 'Слова Назидания', '335591_550.jpg', 224, '978-601-01-2611-4', 1, 1, 250),
(2, 'Отырар. Книга-альбом', '359901_550.jpg', 304, '9965-35-847-8', 2, 1, 350),
(3, 'Предания древнего Казахстана', '400758_550.jpg', 256, '400758', 1, 1, 300),
(4, 'Ақ қамал', '1399530_550.jpg', 224, '9786013382135', 2, 1, 350),
(5, 'Казахское ханство', '358792_550.jpg', 224, '9789965261701', 1, 1, 250),
(6, 'Ұлы дала мемлекеттері', '358997_550.jpg', 216, '9789965884009', 2, 1, 500),
(7, 'Текст', '24426353-dmitriy-gluhovskiy-tekst.jpg', 330, '978-5-17-103521-1', 1, 1, 350),
(8, 'Чужак', '40848833-stiven-king-chuzhak.jpg', 590, '978-5-17-110170-1', 1, 2, 350),
(9, 'Becoming', '45175584-mishel-obama-becoming-moya-istoriya.jpg', 600, '978-5-04-101892-4', 3, 1, 600),
(10, 'Исчезнувшая', '6028900-gillian-flinn-ischeznuvshaya.jpg', 530, '978-5-389-06518-5', 3, 1, 600);

-- --------------------------------------------------------

--
-- Структура таблицы `books_authors`
--

CREATE TABLE `books_authors` (
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `books_authors`
--

INSERT INTO `books_authors` (`book_id`, `author_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(6, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `languages`
--

INSERT INTO `languages` (`id`, `name`) VALUES
(1, 'Русский'),
(2, 'Казахский'),
(3, 'Английский');

-- --------------------------------------------------------

--
-- Структура таблицы `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  `module` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1572516634),
('m191030_162701_Authors', 1572516637),
('m191030_162838_BooksAuthors', 1572516953),
('m191030_162948_Books', 1572516916),
('m191030_163022_Bindings', 1572516769),
('m191030_163058_LanguagesBook', 1572516770),
('m191030_163138_User', 1572516770),
('m191030_163731_InsertUser', 1572516771),
('m191030_163812_Logs', 1572516771);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `name`, `password_hash`, `access_token`, `auth_key`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', '$2y$13$iZNFiLfJ44zKDdmbhzAifOGFo1TpcACmWE.2JvDev38LVkCoC3/o.', NULL, NULL, 1572516771, 1572516771);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `bindings`
--
ALTER TABLE `bindings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-books-language_id` (`language_id`),
  ADD KEY `idx-books-binding_id` (`binding_id`);

--
-- Индексы таблицы `books_authors`
--
ALTER TABLE `books_authors`
  ADD KEY `idx-books_authors-book_id` (`book_id`),
  ADD KEY `idx-books_authors-author_id` (`author_id`);

--
-- Индексы таблицы `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `bindings`
--
ALTER TABLE `bindings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk-books-binding_id` FOREIGN KEY (`binding_id`) REFERENCES `bindings` (`id`),
  ADD CONSTRAINT `fk-books-language_id` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`);

--
-- Ограничения внешнего ключа таблицы `books_authors`
--
ALTER TABLE `books_authors`
  ADD CONSTRAINT `fk-books_authors-binding_id` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `fk-books_authors-book_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
