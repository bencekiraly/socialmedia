-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2016. Máj 01. 12:48
-- Kiszolgáló verziója: 10.1.10-MariaDB
-- PHP verzió: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `social`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hashtags`
--

CREATE TABLE `hashtags` (
  `tweet_id` int(11) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `hashtags`
--

INSERT INTO `hashtags` (`tweet_id`, `keyword`) VALUES
(44, 'teszt'),
(45, 'teszt'),
(46, 'segít'),
(47, 'webterv'),
(50, 'yolo'),
(51, 'yolo'),
(52, 'megint');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `likes`
--

CREATE TABLE `likes` (
  `user_id` int(11) DEFAULT NULL,
  `tweet_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `likes`
--

INSERT INTO `likes` (`user_id`, `tweet_id`) VALUES
(17, 52),
(17, 45);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `mentions`
--

CREATE TABLE `mentions` (
  `user_id` int(11) DEFAULT NULL,
  `tweet_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `mentions`
--

INSERT INTO `mentions` (`user_id`, `tweet_id`) VALUES
(17, 45),
(16, 49),
(16, 51),
(16, 52);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `profile_pics`
--

CREATE TABLE `profile_pics` (
  `user_id` int(11) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `profile_pics`
--

INSERT INTO `profile_pics` (`user_id`, `path`) VALUES
(16, '16.jpg'),
(17, '17.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `shared_pics`
--

CREATE TABLE `shared_pics` (
  `tweet_id` int(11) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `shared_pics`
--

INSERT INTO `shared_pics` (`tweet_id`, `path`) VALUES
(45, '1659487911242.jpg'),
(52, '1735048821247.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tweets`
--

CREATE TABLE `tweets` (
  `id` int(11) NOT NULL,
  `text` text,
  `user_id` int(11) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `tweets`
--

INSERT INTO `tweets` (`id`, `text`, `user_id`, `date`) VALUES
(44, 'Próba1', 16, '2016.05.01 12:41:56'),
(45, 'Próba2', 16, '2016.05.01 12:42:09'),
(46, 'Próba3', 16, '2016.05.01 12:42:19'),
(47, 'Próba4', 16, '2016.05.01 12:42:28'),
(48, 'Próba5', 17, '2016.05.01 12:46:30'),
(49, 'Próba6', 17, '2016.05.01 12:46:34'),
(50, 'Próba7', 17, '2016.05.01 12:46:42'),
(51, 'Próba8', 17, '2016.05.01 12:46:50'),
(52, 'Próba9', 17, '2016.05.01 12:47:02'),
(53, 'Próba11', 17, '2016.05.01 12:47:08');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `logincount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `date`, `logincount`) VALUES
(16, 'Teszt Elek', 'teszt@elek.hu', 'teszt', '2016.05.01 12:45', 2),
(17, 'Segít Elek', 'segit@elek.hu', 'segit', '2016.05.01 12:46', 1);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `hashtags`
--
ALTER TABLE `hashtags`
  ADD KEY `tweet_id` (`tweet_id`);

--
-- A tábla indexei `likes`
--
ALTER TABLE `likes`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tweet_id` (`tweet_id`);

--
-- A tábla indexei `mentions`
--
ALTER TABLE `mentions`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tweet_id` (`tweet_id`);

--
-- A tábla indexei `profile_pics`
--
ALTER TABLE `profile_pics`
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `shared_pics`
--
ALTER TABLE `shared_pics`
  ADD KEY `tweet_id` (`tweet_id`);

--
-- A tábla indexei `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `hashtags`
--
ALTER TABLE `hashtags`
  ADD CONSTRAINT `hashtags_ibfk_1` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`id`);

--
-- Megkötések a táblához `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`id`);

--
-- Megkötések a táblához `mentions`
--
ALTER TABLE `mentions`
  ADD CONSTRAINT `mentions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `mentions_ibfk_2` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`id`);

--
-- Megkötések a táblához `profile_pics`
--
ALTER TABLE `profile_pics`
  ADD CONSTRAINT `profile_pics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Megkötések a táblához `shared_pics`
--
ALTER TABLE `shared_pics`
  ADD CONSTRAINT `shared_pics_ibfk_1` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`id`);

--
-- Megkötések a táblához `tweets`
--
ALTER TABLE `tweets`
  ADD CONSTRAINT `tweets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
