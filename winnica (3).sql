-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 23, 2025 at 08:50 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `winnica`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `administratorzy`
--

CREATE TABLE `administratorzy` (
  `id_admin` int(11) NOT NULL,
  `nazwa` text NOT NULL,
  `haslo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administratorzy`
--

INSERT INTO `administratorzy` (`id_admin`, `nazwa`, `haslo`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kraje`
--

CREATE TABLE `kraje` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kraje`
--

INSERT INTO `kraje` (`id`, `nazwa`) VALUES
(1, 'Francja'),
(2, 'Włochy'),
(3, 'Niemcy'),
(4, 'Hiszpania'),
(5, 'Australia');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pozycje_zamowienia`
--

CREATE TABLE `pozycje_zamowienia` (
  `id_pozycji` int(11) NOT NULL,
  `id_zamowienia` int(11) NOT NULL,
  `id_wina` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL,
  `cena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pozycje_zamowienia`
--

INSERT INTO `pozycje_zamowienia` (`id_pozycji`, `id_zamowienia`, `id_wina`, `ilosc`, `cena`) VALUES
(1, 3, 1, 1, 4500),
(2, 3, 2, 2, 3500),
(17, 11, 1, 3, 4500),
(18, 11, 2, 2, 3500),
(19, 11, 3, 1, 2800),
(20, 12, 1, 2, 4500),
(21, 12, 5, 1, 3900),
(22, 13, 1, 3, 4500),
(23, 13, 5, 1, 3900),
(24, 18, 2, 1, 3500),
(25, 20, 4, 2, 2500);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `typy_wina`
--

CREATE TABLE `typy_wina` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `typy_wina`
--

INSERT INTO `typy_wina` (`id`, `nazwa`) VALUES
(1, 'Czerwone'),
(2, 'Białe'),
(3, 'Różowe');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `nazwa` text NOT NULL,
  `imie` text NOT NULL,
  `nazwisko` text NOT NULL,
  `haslo` text NOT NULL,
  `adres` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `nazwa`, `imie`, `nazwisko`, `haslo`, `adres`) VALUES
(3, 'admin', 'Eryk', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Administracja');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wina`
--

CREATE TABLE `wina` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `typ_wina` int(11) NOT NULL,
  `pojemnosc` int(11) NOT NULL,
  `kraj_pochodzenia` int(11) NOT NULL,
  `cena` int(11) NOT NULL,
  `zdjecie` text NOT NULL,
  `opis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wina`
--

INSERT INTO `wina` (`id`, `nazwa`, `typ_wina`, `pojemnosc`, `kraj_pochodzenia`, `cena`, `zdjecie`, `opis`) VALUES
(1, 'Cabernet Sauvignon Reserve', 1, 750, 1, 4500, 'reserveCabernet.png', 'Pełne i intensywne czerwone wino o aromatach czarnej porzeczki, dębu i przypraw. Dojrzewa w beczkach, co nadaje mu głęboki, szlachetny charakter. Idealne do steków, dziczyzny i serów dojrzewających.'),
(2, 'Pinot Grigio Classico', 2, 750, 2, 3500, 'pinot.png', 'Orzeźwiające białe wino o delikatnych nutach gruszki, jabłka i cytrusów. Lekkie i przyjemne w smaku, doskonałe do sałatek, ryb i owoców morza.\r\n\r\n'),
(3, 'Riesling Trocken', 3, 1000, 3, 2800, 'Trocken.png', 'Wytrawny niemiecki Riesling o świeżych aromatach zielonego jabłka, limonki i lekkich nut mineralnych. Idealny do kuchni azjatyckiej, drobiu i dań wegetariańskich.\r\n\r\n'),
(4, 'Merlot Crianza', 1, 500, 4, 2500, 'merlot.png', 'Aksamitne czerwone wino dojrzewające w dębie, z nutami śliwki, czereśni i wanilii. Świetne do makaronów z sosem pomidorowym, pizzy i mięs z grilla.'),
(5, 'Chardonnay Prestige', 2, 750, 1, 3900, 'prestige.png', 'Eleganckie białe wino o kremowej strukturze i nutach ananasa, brzoskwini oraz subtelnej wanilii. Doskonałe do białych mięs, ryb oraz serów pleśniowych.'),
(6, 'Moscato Sweet Delight', 3, 375, 5, 1800, 'moscato.png', 'Słodkie i aromatyczne wino musujące z nutami moreli, kwiatów pomarańczy i miodu. Idealne do deserów, owoców i jako wino na wyjątkowe okazje.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `id` int(11) NOT NULL,
  `id_klienta` int(11) NOT NULL,
  `data_zamowienia` date NOT NULL,
  `suma_zamowienia` int(11) NOT NULL,
  `status` text NOT NULL DEFAULT '\'Nie zakończone!!!\'',
  `adres_dostawy` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zamowienia`
--

INSERT INTO `zamowienia` (`id`, `id_klienta`, `data_zamowienia`, `suma_zamowienia`, `status`, `adres_dostawy`) VALUES
(1, 3, '2022-05-25', 11500, '\'Nie zakończone!!!\'', 'Administracja'),
(3, 3, '2022-05-25', 11500, '\'Nie zakończone!!!\'', 'Administracja'),
(4, 3, '2022-05-25', 11500, '\'Nie zakończone!!!\'', 'Administracja'),
(5, 3, '2022-05-25', 11500, '\'Nie zakończone!!!\'', 'Administracja'),
(6, 3, '2022-05-25', 11500, '\'Nie zakończone!!!\'', 'Administracja'),
(7, 3, '2022-05-25', 11500, '\'Nie zakończone!!!\'', 'Administracja'),
(8, 3, '2022-05-25', 11500, '\'Nie zakończone!!!\'', 'Administracja'),
(9, 3, '2022-05-25', 11500, '\'Nie zakończone!!!\'', 'Administracja'),
(10, 3, '2022-05-25', 11500, '\'Nie zakończone!!!\'', 'Administracja'),
(11, 3, '2022-05-25', 23300, '\'Nie zakończone!!!\'', 'Administracja'),
(12, 3, '2023-05-25', 12900, '\'Nie zakończone!!!\'', 'Administracja'),
(13, 3, '2023-05-25', 17400, '\'Nie zakończone!!!\'', 'Administracja'),
(14, 3, '2023-05-25', 17400, '\'Nie zakończone!!!\'', 'Administracja'),
(15, 3, '2023-05-25', 17400, '\'Nie zakończone!!!\'', 'Administracja'),
(16, 3, '2023-05-25', 17400, '\'Nie zakończone!!!\'', 'Administracja'),
(17, 3, '2023-05-25', 17400, '\'Nie zakończone!!!\'', 'Administracja'),
(18, 3, '2023-05-25', 3500, '\'Nie zakończone!!!\'', 'Administracja'),
(19, 3, '2023-05-25', 3500, '\'Nie zakończone!!!\'', 'Administracja'),
(20, 3, '2023-05-25', 8500, '\'Nie zakończone!!!\'', 'Administracja');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `administratorzy`
--
ALTER TABLE `administratorzy`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeksy dla tabeli `kraje`
--
ALTER TABLE `kraje`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pozycje_zamowienia`
--
ALTER TABLE `pozycje_zamowienia`
  ADD PRIMARY KEY (`id_pozycji`);

--
-- Indeksy dla tabeli `typy_wina`
--
ALTER TABLE `typy_wina`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wina`
--
ALTER TABLE `wina`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administratorzy`
--
ALTER TABLE `administratorzy`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kraje`
--
ALTER TABLE `kraje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pozycje_zamowienia`
--
ALTER TABLE `pozycje_zamowienia`
  MODIFY `id_pozycji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `typy_wina`
--
ALTER TABLE `typy_wina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wina`
--
ALTER TABLE `wina`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
