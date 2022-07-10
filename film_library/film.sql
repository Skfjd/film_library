-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2022 at 11:02 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `film`
--

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `id` int(4) NOT NULL,
  `tytul` varchar(50) NOT NULL,
  `rezyser` varchar(30) NOT NULL,
  `wytwornia` varchar(40) NOT NULL,
  `gatunek` varchar(15) NOT NULL,
  `gatunek3` varchar(15) DEFAULT NULL,
  `gatunek2` varchar(15) DEFAULT NULL,
  `rok_wyd` varchar(4) NOT NULL,
  `zdj` varchar(100) NOT NULL,
  `cena` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id`, `tytul`, `rezyser`, `wytwornia`, `gatunek`, `gatunek3`, `gatunek2`, `rok_wyd`, `zdj`, `cena`) VALUES
(1, 'Toy Story', 'John Lasseter', 'Pixar Animation Studios', 'animowany', 'fantasy', 'komedia', '1995', 'zdj/toystory.png', 5),
(2, 'Iron Man', 'Jon Favreau', 'Marvel Studios', 'superbohaterski', 'fantasy', 'film akcji', '2008', 'zdj/ironman.png', 10),
(3, 'John Wick', 'Chad Stahelski', 'Thunder Road Picture', 'film akcji', NULL, 'dramat', '2014', 'zdj/jwick.png', 10),
(4, 'El Camino: Film Breaking Bad', 'Vince Gilligan', 'Sony Pictures Television', 'dramat', NULL, NULL, '2019', 'zdj/elcamino.png', 15),
(5, 'Dunkierka', 'Christopher Nolan', 'Syncopy Inc.', 'wojenny', NULL, 'dramat', '2017', 'zdj/dunkierka.png', 15),
(6, 'Spider-Man', 'Sam Raimi', 'Marvel Studios', 'superbohaterski', 'akcja', 'fantasy', '2002', 'zdj/spiderman.png', 10),
(7, 'Spider-Man 2', 'Sam Raimi', 'Marvel Studios', 'superbohaterski', 'akcja', 'fantasy', '2004', 'zdj/spiderman2.png', 10),
(8, 'BOZE CIALO', ' Jan Komasa', 'Aurum Film', 'dramat', NULL, 'film religijny', '2019', 'zdj/bozecialo.png', 15),
(9, 'Matrix', 'Larry Wachowski', 'Warner Bros. Pictures', 'film akcji', NULL, 'fantasy', '1999', 'zdj/matrix.png', 5),
(10, 'Gwiezdne wojny, czesc IV: Nowa Nadzieja', 'George Lucas', 'Lucasfilm', 'space opera', NULL, 'fantasy', '1977', 'zdj/starwars4.png', 5),
(11, 'Gwiezdne wojny: czesc V – Imperium kontratakuje', 'Irvin Kershner', 'Lucasfilm', 'space opera', NULL, 'fantasy', '1980', 'zdj/starwars5.png', 5),
(12, 'Iniemamocni', 'Brad Bird', 'Pixar Animation Studios', 'animowany', 'komedia', 'fantasy', '2004', 'zdj/iniema.png', 10);

-- --------------------------------------------------------

--
-- Table structure for table `klient`
--

CREATE TABLE `klient` (
  `id` int(4) NOT NULL,
  `imie` varchar(15) NOT NULL,
  `nazwisko` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nr_konta` varchar(26) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `klient`
--

INSERT INTO `klient` (`id`, `imie`, `nazwisko`, `email`, `nr_konta`) VALUES
(1, 'a', 'a', 'a@a.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ocena`
--

CREATE TABLE `ocena` (
  `id` int(6) NOT NULL,
  `id_film` int(4) NOT NULL,
  `ocena` float NOT NULL,
  `opinia` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ocena`
--

INSERT INTO `ocena` (`id`, `id_film`, `ocena`, `opinia`) VALUES
(1, 3, 5, 'O ja cie Keanu Reeves'),
(2, 3, 2, 'Film wybity na fame');

-- --------------------------------------------------------

--
-- Table structure for table `wypozyczenia`
--

CREATE TABLE `wypozyczenia` (
  `id_wyp` int(4) NOT NULL,
  `id_os` int(4) NOT NULL,
  `id_film` int(4) NOT NULL,
  `od` date NOT NULL,
  `do` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wypozyczenia`
--

INSERT INTO `wypozyczenia` (`id_wyp`, `id_os`, `id_film`, `od`, `do`) VALUES
(1, 1, 3, '2022-02-06', '2022-03-01'),
(2, 1, 2, '2022-02-06', '2022-02-07'),
(3, 1, 6, '2022-02-06', '2022-02-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klient`
--
ALTER TABLE `klient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ocena`
--
ALTER TABLE `ocena`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_film` (`id_film`);

--
-- Indexes for table `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD PRIMARY KEY (`id_wyp`),
  ADD KEY `id_os` (`id_os`),
  ADD KEY `id_film` (`id_film`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `klient`
--
ALTER TABLE `klient`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ocena`
--
ALTER TABLE `ocena`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  MODIFY `id_wyp` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ocena`
--
ALTER TABLE `ocena`
  ADD CONSTRAINT `ocena_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id`);

--
-- Constraints for table `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD CONSTRAINT `wypozyczenia_ibfk_1` FOREIGN KEY (`id_os`) REFERENCES `klient` (`id`),
  ADD CONSTRAINT `wypozyczenia_ibfk_2` FOREIGN KEY (`id_film`) REFERENCES `film` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
