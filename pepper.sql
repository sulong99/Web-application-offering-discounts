-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 30 Maj 2020, 13:05
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `pepper`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `komentarze`
--

CREATE TABLE `komentarze` (
  `ID` int(11) NOT NULL,
  `ID_OFERTY` int(11) NOT NULL,
  `TRESC` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `ID_USERA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `komentarze`
--

INSERT INTO `komentarze` (`ID`, `ID_OFERTY`, `TRESC`, `ID_USERA`) VALUES
(19, 43, 'Uwielbiam, mój ulubiony jogurt pitny', 64),
(20, 46, 'Wow super okazja, chyba trzeba sięgnąć do portfela', 55),
(21, 46, 'lolek, przemysl swoje zachowanie', 62),
(22, 37, 'nie lubie tego picia...', 62),
(23, 39, 'ciekawe kto da sie nabrac na taka okazje...', 62),
(24, 41, 'juz nic innego nie mogli wymyslec', 62),
(25, 44, 'Super, akurat szukalem telewizora', 56),
(27, 45, 'Bardzo fajna okazja, polecam', 57),
(28, 38, 'Świetnie, ostatnio zepsuł mi się telefon. Na pewno skorzystam', 58),
(29, 40, 'Bardzo wygodna opcja', 59),
(30, 38, 'Kto normalny kupi ajfona.. tylko xiaomi', 62),
(31, 42, 'Już wiem co kupie mężowi na urodziny', 64),
(32, 37, 'Nawodnienie zawsze się przyda', 60),
(33, 44, 'Chyba zakupie dla rodziców', 60),
(35, 40, 'Użytkuję na codzień, polecam', 61),
(36, 38, 'Kocham IPhony, akurat moge wymienić na nowszy', 63),
(37, 43, 'Lubię wypić po wysiłku fizycznym, chyba trzeba zrobić zapasy', 63),
(39, 47, 'Moja ulubiona gra', 55),
(40, 48, 'Nie polecam i mój tata też', 62),
(41, 48, 'Polecam, używam do remontu', 56),
(42, 42, 'Super, polecam', 55),
(43, 41, 'Dobre', 55),
(66, 49, 'Świetny produkt', 55),
(68, 47, 'Super', 54);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `okazje`
--

CREATE TABLE `okazje` (
  `ID` int(20) NOT NULL,
  `NAZWA` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `OPIS` varchar(600) COLLATE utf8_polish_ci NOT NULL,
  `STARA_CENA` double DEFAULT NULL,
  `NOWA_CENA` double DEFAULT NULL,
  `PROCENT` tinyint(1) DEFAULT NULL,
  `HOT` tinyint(1) DEFAULT NULL,
  `REKOMENDACJA` tinyint(1) DEFAULT NULL,
  `ZDJECIE` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `LINK_DO_OKAZJI` varchar(1000) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `okazje`
--

INSERT INTO `okazje` (`ID`, `NAZWA`, `OPIS`, `STARA_CENA`, `NOWA_CENA`, `PROCENT`, `HOT`, `REKOMENDACJA`, `ZDJECIE`, `LINK_DO_OKAZJI`) VALUES
(37, 'Lipton Ice Tea Green Tea', 'Pyszny napój, gorąco polecam', 5, 2, 1, NULL, NULL, 'zimnaherbata.jpg', 'https://stokrotka.pl/'),
(38, 'IPhone XR 64GB', 'Świetny telefon, za świetną cenę', 2800, 2400, 0, 1, 1, 'iphonello.jpg', 'https://www.apple.com/shop'),
(39, 'Płyn do spryskiwaczy', 'Zimowy płyn ułatwi sprawę nawet najbardziej wymagającym kierowcą', 20, 15, 0, NULL, NULL, 'plyn.jpg', 'https://www.orlen.pl/PL/Strony/default.aspx'),
(40, 'Szczoteczka rotacyjna Oral B', 'Pomaga dbać o higienę jamy ustnej', 150, 100, 0, 1, NULL, 'szczota.jpg', 'https://www.rossmann.pl/produkty?Page=1&PageSize=12&PriceFrom=0&PriceTo=600'),
(41, 'Pepsi 2L', 'Orzeźwiający i pyszny', 4, 3, 0, NULL, NULL, 'napoj.jpg', 'https://leclerc.pl/e-zakupy/'),
(42, 'Golarka Philips', 'Super w codziennym użytkowaniu', 199, 149, 0, 1, NULL, 'golarka.jpg', 'https://www.philips.pl/'),
(43, 'Jogurt Pitny Danone', 'Polecam na śniadanie. Pychota', 2, 1, 0, 1, 1, 'danonek.jpg', 'https://www.kaufland.pl/'),
(44, 'Telewizor Kernau 42 Cale', 'Świetna okazja. Bardzo fajny telewizor dla całej rodziny', 2599, 999, 1, 1, 1, 'pudlo.jpg', 'https://www.mediaexpert.pl/'),
(45, 'Pendrive SanDisk 64 GB', 'Polecam okazję', 150, 75, 0, 1, 1, 'nosnik.jpg', 'https://www.morele.net/'),
(46, 'Laptop HP', 'Dobry laptop do codziennej pracy', 2499, 2199, 0, NULL, 1, 'komputerek.jpg', 'https://www.x-kom.pl/'),
(47, 'Fifa 20 PS4', 'Super gra', 199, 89, 1, 1, 0, 'fifka.jpg', 'https://www.ea.com/pl-pl/games/fifa/fifa-20'),
(49, 'Biała farba Atlas', 'Polecam do wielu zadań', 35, 19, 0, 1, NULL, 'farba.jpg', 'https://www.atlas.com.pl/');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `ID` int(11) NOT NULL,
  `NAZWA` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `HASLO` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `EMAIL` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `STATUS` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`ID`, `NAZWA`, `HASLO`, `EMAIL`, `STATUS`) VALUES
(54, 'piotrsulich', '$2y$10$G9seNtr3vNjAmcXU5tR.vel2ONAzsZG35gLfUPbqRJzfMYeAJq1gG', 'sulichpiotr@wp.pl', 1),
(55, 'lolek', '$2y$10$ACTQES0bJdZcohfMF1iiSe6sZbCTaOdYaekwkVRWl3tgDJ.Liasfy', 'lolo12@gmail.com', 0),
(56, 'bolek', '$2y$10$foKA1nwy97Z5plvr5u92HeQjVhlbbhgdZepssptejgqKc3v1my7eG', 'bolekxd@interia.pl', 0),
(57, 'artek', '$2y$10$QuQ5lm6YOMqZlqEypnLbQ.aB6/mgGouetm1kdLyd7JOWW4cs80z4m', 'arturo88@op.pl', 0),
(58, 'kamilos', '$2y$10$SuIlEbep3UElx8WAXeMSg.ngzoHVbWm1k.PW1Wvz.Ou4anZffIYjO', 'kama23@vp.pl', 0),
(59, 'krzysio', '$2y$10$WEAwmcFFZpy4OLlay3UQ7.gLY1c7.hioaAOWIgf3esf3Qmu1jbQ.q', 'krzysztofk@xd.com', 0),
(60, 'lusia', '$2y$10$8EzUI45JKH7AFpjmA4Ra0OcT30lzvhEKl/Pk8LG6YFd.Ved6ccbx2', 'lui11@gmail.com', 0),
(61, 'trol', '$2y$10$nI.fPpJt9cYtAyFt1I4Eo.VWRgDyUvMk77eXkysvUR5H9jEW987WS', 'aluzja@hihi.pl', 0),
(62, 'hejter', '$2y$10$f1OL3mu13Vvg32v8WOhoiet5Wf8QmmGGTTIy3qsevFCvz5F46ggEe', 'slabosc@slabo.pl', 0),
(63, 'anula12', '$2y$10$TY7zR5wADlLAbHN.LUyM2eqsqmb4hm1M0LKO4Eh/b5EHkT2BqcC/q', 'anna@anna.pl', 0),
(64, 'karola', '$2y$10$WIdYob1IiYGCQbrH7Kh6H./XggcuEtI/s0m6pvkAoL2oJen9CE0eC', 'kara234@wp.pl', 0),
(65, 'liptonek99', '$2y$10$Yudask6H5ZP7FKvryp27S.s8Iy7pGYSbuIuWyWnglZ.knwsT2Fqha', 'lipton@icetea.pl', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `komentarze`
--
ALTER TABLE `komentarze`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `okazje`
--
ALTER TABLE `okazje`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT dla tabel zrzutów
--

--
-- AUTO_INCREMENT dla tabeli `komentarze`
--
ALTER TABLE `komentarze`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT dla tabeli `okazje`
--
ALTER TABLE `okazje`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
